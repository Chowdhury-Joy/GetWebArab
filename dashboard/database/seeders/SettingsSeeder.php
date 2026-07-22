<?php

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
