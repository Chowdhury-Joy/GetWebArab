<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Period;
use App\Models\EarningLine;
use App\Services\PeriodService;
use Exception;
use Carbon\Carbon;

class PeriodServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        Settings::create([
            'founder_client_cap' => 5,
            'founder_discount_pct' => 25.00,
            'partner_setup_pct' => 40.00,
            'partner_monthly_pct' => 25.00,
        ]);
    }

    public function test_close_period_generates_correct_earning_lines()
    {
        $service = app(PeriodService::class);
        $partner = User::factory()->create(['role' => 'partner']);
        
        // New client starting this month
        $newClient = Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'New Client',
            'setup_fee_fils' => 100000,
            'is_founder' => false,
            'discount_pct_applied' => 0,
            'status' => 'active',
            'started_at' => Carbon::create(2026, 2, 10),
        ]);
        $s1 = Service::create(['key' => 'web', 'name' => 'Web', 'default_price_fils' => 50000, 'is_mandatory' => true]);
        $newClient->activeServices()->attach($s1->id, ['price_fils' => 50000, 'added_at' => now()]);
        
        // Existing client from previous month (setup should be ignored if already paid, or just test they only get monthly if setup is created)
        // Wait, for this test, if no setup line exists, it WILL create a setup line because started_at <= period end.
        // Let's manually insert a setup line to pretend they were billed setup last month
        $existingClient = Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Existing Client',
            'setup_fee_fils' => 100000,
            'is_founder' => true,
            'discount_pct_applied' => 25,
            'status' => 'active',
            'started_at' => Carbon::create(2026, 1, 10),
        ]);
        $existingClient->activeServices()->attach($s1->id, ['price_fils' => 50000, 'added_at' => now()]);
        
        EarningLine::create([
            'period_id' => Period::create(['year' => 2026, 'month' => 1, 'state' => 'closed'])->id,
            'partner_id' => $partner->id,
            'client_id' => $existingClient->id,
            'kind' => 'setup',
            'list_fils' => 100000,
            'discount_pct' => 25,
            'charged_fils' => 75000,
            'partner_fils' => 30000,
            'house_fils' => 45000,
        ]);

        $period = Period::create([
            'year' => 2026,
            'month' => 2,
            'state' => 'open'
        ]);

        $service->closePeriod($period);

        $this->assertEquals('closed', $period->fresh()->state);

        // New client should have a setup line and a monthly line for period 2
        $newLines = EarningLine::where('period_id', $period->id)->where('client_id', $newClient->id)->orderBy('id')->get();
        $this->assertCount(2, $newLines);
        $this->assertEquals('monthly', $newLines[0]->kind);
        $this->assertEquals(50000, $newLines[0]->list_fils);
        $this->assertEquals('setup', $newLines[1]->kind);
        $this->assertEquals(100000, $newLines[1]->list_fils);

        // Existing client should only have a monthly line for period 2
        $existingLines = EarningLine::where('period_id', $period->id)->where('client_id', $existingClient->id)->get();
        $this->assertCount(1, $existingLines);
        $this->assertEquals('monthly', $existingLines[0]->kind);
        $this->assertEquals(50000, $existingLines[0]->list_fils);
        $this->assertEquals(37500, $existingLines[0]->charged_fils); // 25% discount on 50k
    }

    public function test_cannot_close_already_closed_period()
    {
        $service = app(PeriodService::class);
        $period = Period::create(['year' => 2026, 'month' => 2, 'state' => 'closed']);

        $this->expectException(Exception::class);
        $service->closePeriod($period);
    }
}
