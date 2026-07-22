<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Client;

class ClientPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_any_client()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $partner = User::factory()->create(['role' => 'partner']);
        
        $client = Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'Partner Client',
            'setup_fee_fils' => 100000,
            'is_founder' => false,
            'started_at' => now(),
        ]);

        $this->assertTrue($admin->can('view', $client));
        $this->assertTrue($admin->can('update', $client));
    }

    public function test_partner_can_view_own_client()
    {
        $partner = User::factory()->create(['role' => 'partner']);
        
        $client = Client::create([
            'partner_id' => $partner->id,
            'business_name' => 'My Client',
            'setup_fee_fils' => 100000,
            'is_founder' => false,
            'started_at' => now(),
        ]);

        $this->assertTrue($partner->can('view', $client));
        $this->assertTrue($partner->can('update', $client));
    }

    public function test_partner_cannot_view_others_client()
    {
        $partner1 = User::factory()->create(['role' => 'partner']);
        $partner2 = User::factory()->create(['role' => 'partner']);
        
        $client = Client::create([
            'partner_id' => $partner1->id,
            'business_name' => 'Partner 1 Client',
            'setup_fee_fils' => 100000,
            'is_founder' => false,
            'started_at' => now(),
        ]);

        $this->assertFalse($partner2->can('view', $client));
        $this->assertFalse($partner2->can('update', $client));
    }
}
