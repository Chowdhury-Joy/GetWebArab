<?php

namespace Database\Seeders;

use App\Models\LandingContent;
use Illuminate\Database\Seeder;

class LandingContentSeeder extends Seeder
{
    public function run(): void
    {
        $rows = json_decode(file_get_contents(__DIR__.'/data/landing_content.json'), true);

        foreach ($rows as $row) {
            // firstOrCreate, not updateOrCreate: once seeded, this content is edited
            // via the admin panel, so re-running the seeder must never overwrite it.
            LandingContent::firstOrCreate(
                ['key' => $row['key']],
                [
                    'section' => $row['section'],
                    'sort_order' => $row['sort_order'],
                    'en' => $row['en'],
                    'ar' => $row['ar'],
                ]
            );
        }
    }
}
