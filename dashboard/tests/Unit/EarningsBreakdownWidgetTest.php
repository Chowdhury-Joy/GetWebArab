<?php

namespace Tests\Unit;

use App\Filament\Widgets\EarningsBreakdownWidget;
use App\Models\EarningLine;
use App\Models\Period;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EarningsBreakdownWidgetTest extends TestCase
{
    use RefreshDatabase;

    protected function makeClosedPeriod(int $year, int $month): Period
    {
        return Period::create(['year' => $year, 'month' => $month, 'state' => 'closed']);
    }

    public function test_monthly_range_only_includes_the_latest_closed_period()
    {
        $partner = User::factory()->create(['role' => 'partner']);
        $client = \App\Models\Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Test',
            'setup_fee_fils' => 0,
            'is_founder' => false,
            'started_at' => now(),
        ]);

        $older = $this->makeClosedPeriod(2026, 1);
        $newer = $this->makeClosedPeriod(2026, 2);

        EarningLine::create([
            'period_id' => $older->id, 'partner_id' => $partner->id, 'client_id' => $client->id,
            'kind' => 'monthly', 'list_fils' => 1000, 'discount_pct' => 0, 'charged_fils' => 1000,
            'partner_fils' => 400, 'house_fils' => 600,
        ]);
        EarningLine::create([
            'period_id' => $newer->id, 'partner_id' => $partner->id, 'client_id' => $client->id,
            'kind' => 'monthly', 'list_fils' => 2000, 'discount_pct' => 0, 'charged_fils' => 2000,
            'partner_fils' => 800, 'house_fils' => 1200,
        ]);

        $widget = new EarningsBreakdownWidget();
        $widget->range = 'monthly';

        $this->assertEquals(1200, $widget->getHouseTotal());
        $this->assertEquals(800, $widget->getPartnerBreakdown()->first()->total_earned);
    }

    public function test_lifetime_range_sums_all_closed_periods()
    {
        $partner = User::factory()->create(['role' => 'partner']);
        $client = \App\Models\Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Test',
            'setup_fee_fils' => 0,
            'is_founder' => false,
            'started_at' => now(),
        ]);

        $p1 = $this->makeClosedPeriod(2025, 12);
        $p2 = $this->makeClosedPeriod(2026, 1);

        EarningLine::create([
            'period_id' => $p1->id, 'partner_id' => $partner->id, 'client_id' => $client->id,
            'kind' => 'monthly', 'list_fils' => 1000, 'discount_pct' => 0, 'charged_fils' => 1000,
            'partner_fils' => 400, 'house_fils' => 600,
        ]);
        EarningLine::create([
            'period_id' => $p2->id, 'partner_id' => $partner->id, 'client_id' => $client->id,
            'kind' => 'monthly', 'list_fils' => 2000, 'discount_pct' => 0, 'charged_fils' => 2000,
            'partner_fils' => 800, 'house_fils' => 1200,
        ]);

        $widget = new EarningsBreakdownWidget();
        $widget->range = 'lifetime';

        $this->assertEquals(1800, $widget->getHouseTotal());
        $this->assertEquals(1200, $widget->getPartnerBreakdown()->first()->total_earned);
    }

    public function test_open_periods_are_excluded_from_every_range()
    {
        $partner = User::factory()->create(['role' => 'partner']);
        $client = \App\Models\Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Test',
            'setup_fee_fils' => 0,
            'is_founder' => false,
            'started_at' => now(),
        ]);

        $open = Period::create(['year' => 2026, 'month' => 3, 'state' => 'open']);

        EarningLine::create([
            'period_id' => $open->id, 'partner_id' => $partner->id, 'client_id' => $client->id,
            'kind' => 'monthly', 'list_fils' => 5000, 'discount_pct' => 0, 'charged_fils' => 5000,
            'partner_fils' => 2000, 'house_fils' => 3000,
        ]);

        $widget = new EarningsBreakdownWidget();
        $widget->range = 'lifetime';

        $this->assertEquals(0, $widget->getHouseTotal());
        $this->assertFalse($widget->hasAnyClosedPeriods());
    }

    public function test_partner_breakdown_is_sorted_descending_by_earned_amount()
    {
        $partnerA = User::factory()->create(['role' => 'partner', 'name' => 'Partner A']);
        $partnerB = User::factory()->create(['role' => 'partner', 'name' => 'Partner B']);
        $period = $this->makeClosedPeriod(2026, 1);

        $clientA = \App\Models\Client::create(['partner_id' => $partnerA->id, 'business_name' => 'A', 'setup_fee_fils' => 0, 'is_founder' => false, 'started_at' => now()]);
        $clientB = \App\Models\Client::create(['partner_id' => $partnerB->id, 'business_name' => 'B', 'setup_fee_fils' => 0, 'is_founder' => false, 'started_at' => now()]);

        EarningLine::create([
            'period_id' => $period->id, 'partner_id' => $partnerA->id, 'client_id' => $clientA->id,
            'kind' => 'monthly', 'list_fils' => 1000, 'discount_pct' => 0, 'charged_fils' => 1000,
            'partner_fils' => 300, 'house_fils' => 700,
        ]);
        EarningLine::create([
            'period_id' => $period->id, 'partner_id' => $partnerB->id, 'client_id' => $clientB->id,
            'kind' => 'monthly', 'list_fils' => 5000, 'discount_pct' => 0, 'charged_fils' => 5000,
            'partner_fils' => 900, 'house_fils' => 4100,
        ]);

        $widget = new EarningsBreakdownWidget();
        $widget->range = 'lifetime';

        $breakdown = $widget->getPartnerBreakdown();

        $this->assertEquals('Partner B', $breakdown->first()->name);
        $this->assertEquals(900, $breakdown->first()->total_earned);
        $this->assertEquals('Partner A', $breakdown->last()->name);
    }
}
