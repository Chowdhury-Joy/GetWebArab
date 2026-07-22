import os

files = {
    "database/seeders/SettingsSeeder.php": r"""<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Settings::firstOrCreate(
            ['id' => 1],
            [
                'partner_setup_pct' => 40.00,
                'partner_monthly_pct' => 25.00,
                'founder_discount_pct' => 25.00,
                'founder_client_cap' => 5,
            ]
        );
    }
}
""",
    "database/seeders/ServiceSeeder.php": r"""<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::updateOrCreate(['key' => 'website_care'], [
            'name' => 'Website Care',
            'is_mandatory' => true,
            'default_price_fils' => 15000,
            'is_recurring' => true,
            'sort_order' => 1,
        ]);

        Service::updateOrCreate(['key' => 'seo'], [
            'name' => 'SEO',
            'is_mandatory' => false,
            'default_price_fils' => 35000,
            'is_recurring' => true,
            'sort_order' => 2,
        ]);

        Service::updateOrCreate(['key' => 'ads'], [
            'name' => 'Ads',
            'is_mandatory' => false,
            'default_price_fils' => 35000,
            'is_recurring' => true,
            'sort_order' => 3,
        ]);

        Service::updateOrCreate(['key' => 'email'], [
            'name' => 'Email',
            'is_mandatory' => false,
            'default_price_fils' => 35000,
            'is_recurring' => true,
            'sort_order' => 4,
        ]);
    }
}
""",
    "database/seeders/AdminSeeder.php": r"""<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@getwebarab.com'], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
""",
    "database/seeders/DemoSeeder.php": r"""<?php

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
""",
    "database/seeders/DatabaseSeeder.php": r"""<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            ServiceSeeder::class,
            AdminSeeder::class,
            DemoSeeder::class,
        ]);
    }
}
"""
}

for path, content in files.items():
    with open(path, "w") as out:
        out.write(content)
    print(f"Updated {path}")

