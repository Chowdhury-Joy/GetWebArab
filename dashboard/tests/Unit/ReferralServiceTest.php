<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Client;
use App\Models\Settings;
use App\Services\ReferralService;

class ReferralServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Settings::create(['founder_client_cap' => 3]); // Lower cap for easier testing
    }

    public function test_founder_status_assigned_up_to_cap()
    {
        $service = new ReferralService();
        $partner = User::factory()->create(['role' => 'partner']);

        // Cap is 3. Initially, they have 0 founder clients.
        $this->assertTrue($service->isFounderForPartner($partner));

        // Create 3 clients that are founders
        for ($i = 0; $i < 3; $i++) {
            Client::create([
                'partner_id' => $partner->id,
                'business_name' => "Client {$i}",
                'setup_fee_fils' => 100000,
                'is_founder' => true,
                'started_at' => now(),
            ]);
        }

        // Now they have 3 founder clients, the cap is hit.
        // The next check should return false.
        $this->assertFalse($service->isFounderForPartner($partner));
    }
}
