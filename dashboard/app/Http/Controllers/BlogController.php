<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\LandingSetting;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('blog.index', [
            'posts' => $posts,
            'landingSetting' => LandingSetting::current(),
        ]);
    }

    public function show(BlogPost $blogPost)
    {
        abort_unless(
            $blogPost->status === 'published' && $blogPost->published_at <= now(),
            404
        );

        return view('blog.show', [
            'post' => $blogPost,
            'landingSetting' => LandingSetting::current(),
        ]);
    }
}
