<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_index_only_shows_published_posts()
    {
        BlogPost::create([
            'title' => 'Published Post',
            'slug' => 'published-post',
            'content' => '<p>Hello</p>',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        BlogPost::create([
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'published_at' => now()->subDay(),
        ]);

        BlogPost::create([
            'title' => 'Future Post',
            'slug' => 'future-post',
            'content' => '<p>Hello</p>',
            'status' => 'published',
            'published_at' => now()->addDay(),
        ]);

        $response = $this->get('/blog');

        $response->assertOk();
        $response->assertSee('Published Post');
        $response->assertDontSee('Draft Post');
        $response->assertDontSee('Future Post');
    }

    public function test_published_post_is_viewable()
    {
        $post = BlogPost::create([
            'title' => 'My SEO Guide',
            'slug' => 'my-seo-guide',
            'content' => '<p>Some content</p>',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('blog.show', $post));

        $response->assertOk();
        $response->assertSee('My SEO Guide');
        $response->assertSee('Some content', false);
    }

    public function test_draft_post_returns_404()
    {
        $post = BlogPost::create([
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'published_at' => now()->subDay(),
        ]);

        $this->get(route('blog.show', $post))->assertNotFound();
    }

    public function test_future_scheduled_post_returns_404()
    {
        $post = BlogPost::create([
            'title' => 'Future Post',
            'slug' => 'future-post',
            'content' => '<p>Hello</p>',
            'status' => 'published',
            'published_at' => now()->addDay(),
        ]);

        $this->get(route('blog.show', $post))->assertNotFound();
    }

    public function test_post_renders_article_structured_data_and_meta_tags()
    {
        $post = BlogPost::create([
            'title' => 'Structured Data Test',
            'slug' => 'structured-data-test',
            'excerpt' => 'A short excerpt',
            'content' => '<p>Body</p>',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get(route('blog.show', $post));

        $response->assertSee('"@type":"Article"', false);
        $response->assertSee('<link rel="canonical" href="'.route('blog.show', $post).'">', false);
    }

    public function test_meta_title_and_description_fall_back_when_not_set()
    {
        $post = BlogPost::create([
            'title' => 'Fallback Title',
            'slug' => 'fallback-title',
            'excerpt' => 'Fallback excerpt text',
            'content' => '<p>Body</p>',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $this->assertEquals('Fallback Title', $post->display_meta_title);
        $this->assertEquals('Fallback excerpt text', $post->display_meta_description);
    }

    public function test_sitemap_includes_only_published_posts()
    {
        BlogPost::create([
            'title' => 'Published Post',
            'slug' => 'published-post',
            'content' => '<p>Hello</p>',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        BlogPost::create([
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'content' => '<p>Hello</p>',
            'status' => 'draft',
            'published_at' => now()->subDay(),
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertSee('/blog/published-post', false);
        $response->assertDontSee('/blog/draft-post', false);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
    }

    public function test_robots_txt_references_sitemap()
    {
        $response = $this->get('/robots.txt');

        $response->assertOk();
        $response->assertSee('Sitemap: '.url('/sitemap.xml'));
        $response->assertSee('Disallow: /admin');
    }
}
