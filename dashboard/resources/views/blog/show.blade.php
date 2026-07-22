<!DOCTYPE html>
<html lang="en" dir="ltr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->display_meta_title }}</title>
    <meta name="description" content="{{ $post->display_meta_description }}">
    <link rel="canonical" href="{{ route('blog.show', $post) }}">

    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Get Web Arab">
    <meta property="og:title" content="{{ $post->display_meta_title }}">
    <meta property="og:description" content="{{ $post->display_meta_description }}">
    <meta property="og:url" content="{{ route('blog.show', $post) }}">
    <meta property="article:published_time" content="{{ $post->published_at->toAtomString() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at->toAtomString() }}">
    @if ($post->cover_image_url)
        <meta property="og:image" content="{{ $post->cover_image_url }}">
    @endif

    <meta name="twitter:card" content="{{ $post->cover_image_url ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $post->display_meta_title }}">
    <meta name="twitter:description" content="{{ $post->display_meta_description }}">

    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $post->title,
        'description' => $post->display_meta_description,
        'datePublished' => $post->published_at->toAtomString(),
        'dateModified' => $post->updated_at->toAtomString(),
        'author' => ['@type' => 'Organization', 'name' => 'Get Web Arab'],
        'publisher' => ['@type' => 'Organization', 'name' => 'Get Web Arab'],
        'mainEntityOfPage' => route('blog.show', $post),
    ] + ($post->cover_image_url ? ['image' => $post->cover_image_url] : []), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500;600;700&family=Inter:wght@300;400;500;600;700;800&family=Saira+Extra+Condensed:wght@500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        heading: ['Saira Extra Condensed', 'sans-serif'],
                        sans: ['Inter', 'sans-serif'],
                        mono: ['IBM Plex Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, .font-heading { font-family: 'Saira Extra Condensed', sans-serif; letter-spacing: 0.03em; text-transform: uppercase; }
        .font-mono-tag { font-family: 'IBM Plex Mono', monospace; }
    </style>
</head>
<body class="antialiased bg-white text-slate-900">

    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 px-10 py-5 shadow-sm">
        <div class="max-w-[1320px] mx-auto flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-lg bg-black text-white font-heading text-2xl font-bold tracking-tight shadow-md group-hover:scale-105 transition-transform flex items-center justify-center">G</div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-heading font-extrabold tracking-wider text-slate-950">GET WEB ARAB</span>
                        <span class="font-mono-tag px-2 py-0.5 text-[10px] font-bold bg-slate-100 text-slate-900 border border-slate-300 rounded uppercase">UAE</span>
                    </div>
                    <p class="text-[11px] text-slate-500 font-medium">Digital Growth Agency</p>
                </div>
            </a>
            <nav class="hidden md:flex items-center gap-10 text-xs font-mono-tag font-bold tracking-wide text-slate-700">
                <a href="{{ route('landing') }}" class="hover:text-black transition-colors">Home</a>
                <a href="{{ route('blog.index') }}" class="hover:text-black transition-colors">Blog</a>
            </nav>
            <a href="{{ route('landing') }}#offer-stack" class="hidden sm:inline-flex bg-black hover:bg-slate-800 text-white font-mono-tag text-xs font-bold px-6 py-2.5 rounded transition-all hover:scale-105 shadow-md">
                See What You'll Pay
            </a>
        </div>
    </header>

    <article class="py-16 px-10">
        <div class="max-w-3xl mx-auto">
            <nav class="text-xs font-mono-tag text-slate-500 mb-6">
                <a href="{{ route('landing') }}" class="hover:text-black">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-black">Blog</a>
            </nav>

            <span class="font-mono-tag text-xs text-amber-600 font-bold uppercase tracking-widest">{{ $post->published_at->format('F j, Y') }}</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-950 mt-3 mb-8 leading-tight">{{ $post->title }}</h1>

            @if ($post->cover_image_url)
                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" class="w-full rounded-xl mb-10 object-cover max-h-96">
            @endif

            <div class="prose prose-slate max-w-none prose-headings:font-heading prose-headings:normal-case prose-headings:tracking-normal prose-a:text-amber-600">
                {!! $post->content !!}
            </div>

            <div class="mt-16 pt-8 border-t border-slate-200">
                <a href="{{ route('blog.index') }}" class="text-sm font-mono-tag font-bold text-black hover:text-amber-600">&larr; Back to all posts</a>
            </div>
        </div>
    </article>

    <footer class="bg-black text-slate-400 py-10 px-10 text-center text-xs font-mono-tag">
        © {{ now()->year }} Get Web Arab. Digital Growth Engine for UAE Local Businesses.
        <a href="{{ route('landing') }}" class="underline hover:text-white ml-2">Back to Home</a>
    </footer>

</body>
</html>
