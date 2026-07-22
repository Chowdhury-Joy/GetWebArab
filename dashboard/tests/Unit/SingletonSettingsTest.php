<?php

namespace Tests\Unit;

use App\Models\LandingSetting;
use App\Models\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SingletonSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_current_returns_an_updatable_instance()
    {
        $settings = Settings::current();
        $settings->update(['partner_setup_pct' => 55.5]);

        $this->assertEquals(55.5, Settings::find(1)->partner_setup_pct);
    }

    public function test_landing_setting_current_returns_an_updatable_instance()
    {
        $setting = LandingSetting::current();
        $setting->update(['meta_title' => 'Updated Title']);

        $this->assertEquals('Updated Title', LandingSetting::find(1)->meta_title);
    }
}
