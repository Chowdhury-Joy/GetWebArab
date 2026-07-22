<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Settings;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $partner1 = User::updateOrCreate(['email' => 'partner1@example.com'], [
            'name' => 'Partner One',
            'password' => Hash::make('password'),
            'role' => 'partner',
            'referral_code' => 'PARTNERONE',
        ]);

        $partner2 = User::updateOrCreate(['email' => 'partner2@example.com'], [
            'name' => 'Partner Two',
            'password' => Hash::make('password'),
            'role' => 'partner',
            'referral_code' => 'PARTNERTWO',
        ]);

        $websiteCare = Service::where('key', 'website_care')->first();
        $seo = Service::where('key', 'seo')->first();

        // 6 clients for partner1 to trip founder cap
        for ($i = 1; $i <= 6; $i++) {
            $isFounder = $i <= 5; // 5 is founder cap
            $discount = $isFounder ? 25.00 : 0;
            $client = Client::create([
                'partner_id' => $partner1->id,
                'business_name' => "Partner1 Client $i",
                'setup_fee_fils' => 80000,
                'is_founder' => $isFounder,
                'discount_pct_applied' => $discount,
                'status' => 'active',
                'started_at' => Carbon::now()->subDays($i * 10),
            ]);

            $client->services()->attach($websiteCare->id, [
                'price_fils' => $websiteCare->default_price_fils,
                'added_at' => Carbon::now(),
                'is_active' => true,
            ]);

            if ($i % 2 == 0) {
                $client->services()->attach($seo->id, [
                    'price_fils' => $seo->default_price_fils,
                    'added_at' => Carbon::now(),
                    'is_active' => true,
                ]);
            }
        }
        
        // 1 client for partner 2
        $client2 = Client::create([
            'partner_id' => $partner2->id,
            'business_name' => "Partner2 Client 1",
            'setup_fee_fils' => 100000,
            'is_founder' => true,
            'discount_pct_applied' => 25.00,
            'status' => 'active',
            'started_at' => Carbon::now(),
        ]);
        $client2->services()->attach($websiteCare->id, [
            'price_fils' => $websiteCare->default_price_fils,
            'added_at' => Carbon::now(),
            'is_active' => true,
        ]);
    }
}
