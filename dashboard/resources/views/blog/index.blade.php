<!DOCTYPE html>
<html lang="en" dir="ltr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog — {{ $landingSetting->meta_title }}</title>
    <meta name="description" content="Practical guides on websites, local SEO, ads, and email marketing for UAE local businesses.">
    <link rel="canonical" href="{{ route('blog.index') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Get Web Arab">
    <meta property="og:title" content="Blog — Get Web Arab">
    <meta property="og:description" content="Practical guides on websites, local SEO, ads, and email marketing for UAE local businesses.">
    <meta property="og:url" content="{{ route('blog.index') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500;600;700&family=Inter:wght@300;400;500;600;700;800&family=Saira+Extra+Condensed:wght@500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
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
        h1, h2, h3, .font-heading { font-family: 'Saira Extra Condensed', sans-serif; letter-spacing: 0.03em; text-transform: uppercase; }
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
                <a href="{{ route('blog.index') }}" class="text-black">Blog</a>
            </nav>
            <a href="{{ route('landing') }}#offer-stack" class="hidden sm:inline-flex bg-black hover:bg-slate-800 text-white font-mono-tag text-xs font-bold px-6 py-2.5 rounded transition-all hover:scale-105 shadow-md">
                See What You'll Pay
            </a>
        </div>
    </header>

    <section class="bg-black text-white py-20 px-10">
        <div class="max-w-[1320px] mx-auto">
            <span class="font-mono-tag text-xs text-amber-400 font-bold uppercase tracking-widest block mb-3">Guides &amp; Insights</span>
            <h1 class="text-5xl sm:text-6xl font-extrabold">The Get Web Arab Blog</h1>
            <p class="text-slate-300 text-base mt-4 max-w-2xl">Practical, no-fluff guides on websites, local SEO, ads, and email marketing for UAE local businesses.</p>
        </div>
    </section>

    <section class="py-16 px-10">
        <div class="max-w-[1320px] mx-auto">
            @if ($posts->isEmpty())
                <p class="text-slate-500">No blog posts published yet — check back soon.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post) }}" class="block group border border-slate-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow">
                            @if ($post->cover_image_url)
                                <img src="{{ $post->cover_image_url }}" alt="{{ $post->title }}" class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 bg-slate-950 flex items-center justify-center">
                                    <span class="font-heading text-4xl text-amber-400 font-bold">G</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <span class="font-mono-tag text-[11px] text-slate-500 uppercase tracking-wide">{{ $post->published_at->format('M j, Y') }}</span>
                                <h2 class="text-2xl font-bold text-slate-950 mt-2 mb-2 normal-case tracking-normal group-hover:text-amber-600 transition-colors" style="font-family: 'Saira Extra Condensed', sans-serif;">{{ $post->title }}</h2>
                                <p class="text-sm text-slate-600 leading-relaxed">{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 140) }}</p>
                                <span class="inline-block mt-4 text-xs font-mono-tag font-bold text-black group-hover:text-amber-600">Read more &rarr;</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    <footer class="bg-black text-slate-400 py-10 px-10 text-center text-xs font-mono-tag">
        © {{ now()->year }} Get Web Arab. Digital Growth Engine for UAE Local Businesses.
        <a href="{{ route('landing') }}" class="underline hover:text-white ml-2">Back to Home</a>
    </footer>

</body>
</html>
