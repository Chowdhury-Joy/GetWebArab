<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [
            [
                'loc' => url('/'),
                'lastmod' => now()->toAtomString(),
                'priority' => '1.0',
            ],
            [
                'loc' => route('blog.index'),
                'lastmod' => now()->toAtomString(),
                'priority' => '0.8',
            ],
        ];

        foreach (BlogPost::published()->get() as $post) {
            $urls[] = [
                'loc' => route('blog.show', $post),
                'lastmod' => $post->updated_at->toAtomString(),
                'priority' => '0.6',
            ];
        }

        $xml = view('sitemap.index', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /partner',
            '',
            'Sitemap: '.url('/sitemap.xml'),
        ]);

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
