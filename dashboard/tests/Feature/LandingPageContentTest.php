<?php

namespace Tests\Feature;

use App\Models\LandingContent;
use App\Models\LandingSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_content_from_database()
    {
        LandingContent::create([
            'key' => 'hero_title',
            'section' => 'hero',
            'sort_order' => 0,
            'en' => 'Custom Edited Headline For Testing',
            'ar' => 'عنوان مخصص للاختبار',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Custom Edited Headline For Testing');
        $response->assertSee('عنوان مخصص للاختبار');
    }

    public function test_landing_page_content_is_editable_without_touching_the_template()
    {
        LandingContent::create([
            'key' => 'hero_title',
            'section' => 'hero',
            'sort_order' => 0,
            'en' => 'Original Headline',
            'ar' => 'العنوان الأصلي',
        ]);

        $this->get('/')->assertSee('Original Headline');

        LandingContent::where('key', 'hero_title')->update(['en' => 'Updated Headline']);

        $this->get('/')->assertSee('Updated Headline')->assertDontSee('Original Headline');
    }

    public function test_as_i18n_groups_rows_by_language()
    {
        LandingContent::create([
            'key' => 'footer_copy',
            'section' => 'footer',
            'sort_order' => 0,
            'en' => 'English copy',
            'ar' => 'نسخة عربية',
        ]);

        $i18n = LandingContent::asI18n();

        $this->assertEquals('English copy', $i18n['en']['footer_copy']);
        $this->assertEquals('نسخة عربية', $i18n['ar']['footer_copy']);
    }

    public function test_landing_page_renders_seo_and_whatsapp_settings_from_database()
    {
        LandingSetting::current()->update([
            'meta_title' => 'Custom SEO Title For Testing',
            'meta_description' => 'Custom meta description for testing',
            'whatsapp_number' => '971509998888',
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('<title>Custom SEO Title For Testing</title>', false);
        $response->assertSee('Custom meta description for testing', false);
        $response->assertSee('wa.me/971509998888', false);
    }

    public function test_landing_page_has_canonical_open_graph_and_structured_data()
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('<link rel="canonical" href="'.url('/').'">', false);
        $response->assertSee('property="og:title"', false);
        $response->assertSee('property="og:url"', false);
        $response->assertSee('name="twitter:card"', false);
        $response->assertSee('"@type":"LocalBusiness"', false);
    }
}
