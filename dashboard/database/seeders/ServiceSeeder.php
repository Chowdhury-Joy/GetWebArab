<?php

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
