<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Settings;
use App\Services\PricingService;

class PricingServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed base settings
        Settings::create([
            'founder_client_cap' => 5,
            'founder_discount_pct' => 25.00,
            'partner_setup_pct' => 40.00,
            'partner_monthly_pct' => 25.00,
        ]);
    }

    public function test_standard_client_splits_correctly()
    {
        $service = new PricingService();
        
        $partner = User::factory()->create(['role' => 'partner']);
        $client = Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Test',
            'setup_fee_fils' => 100000,
            'is_founder' => false,
            'discount_pct_applied' => 0,
            'started_at' => now(),
        ]);
        
        $s1 = Service::create(['key' => 'web', 'name' => 'Web', 'default_price_fils' => 50000, 'is_mandatory' => true]);
        $client->activeServices()->attach($s1->id, ['price_fils' => 50000, 'added_at' => now()]); // 500 AED

        $breakdown = $service->computeForClient($client);

        // Setup logic: 100000. No founder discount.
        // Partner cut: 40% of 100000 = 40000
        // House cut: 60000
        $this->assertEquals(100000, $breakdown['setup']['list']);
        $this->assertEquals(100000, $breakdown['setup']['charged']);
        $this->assertEquals(40000, $breakdown['setup']['partner']);
        $this->assertEquals(60000, $breakdown['setup']['house']);

        // Monthly logic: 50000. No founder discount.
        // Partner cut: 25% of 50000 = 12500
        // House cut: 37500
        $this->assertEquals(50000, $breakdown['monthly']['list']);
        $this->assertEquals(50000, $breakdown['monthly']['charged']);
        $this->assertEquals(12500, $breakdown['monthly']['partner']);
        $this->assertEquals(37500, $breakdown['monthly']['house']);
    }

    public function test_founder_client_gets_percentage_discount_on_setup_and_monthly()
    {
        $service = new PricingService();
        
        $partner = User::factory()->create(['role' => 'partner']);
        $client = Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Test',
            'setup_fee_fils' => 100000,
            'is_founder' => true,
            'discount_pct_applied' => 25,
            'started_at' => now(),
        ]);
        
        $s1 = Service::create(['key' => 'web2', 'name' => 'Web', 'default_price_fils' => 50000, 'is_mandatory' => true]);
        $client->activeServices()->attach($s1->id, ['price_fils' => 50000, 'added_at' => now()]); // 500 AED

        $breakdown = $service->computeForClient($client);

        // Setup logic: 100000. Founder discount: 25% off = 75000 charged.
        // Partner cut: 40% of 75000 = 30000
        // House cut: 75000 - 30000 = 45000
        $this->assertEquals(100000, $breakdown['setup']['list']);
        $this->assertEquals(75000, $breakdown['setup']['charged']);
        $this->assertEquals(30000, $breakdown['setup']['partner']);
        $this->assertEquals(45000, $breakdown['setup']['house']);

        // Monthly logic: 50000. Founder discount: 25% off = 37500 charged.
        // Partner cut: 25% of 37500 = 9375
        // House cut: 37500 - 9375 = 28125
        $this->assertEquals(50000, $breakdown['monthly']['list']);
        $this->assertEquals(37500, $breakdown['monthly']['charged']);
        $this->assertEquals(9375, $breakdown['monthly']['partner']);
        $this->assertEquals(28125, $breakdown['monthly']['house']);
    }
}
