<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Home -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Blog -->
    <url>
        <loc>{{ url('/blog') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Privacy -->
    <url>
        <loc>{{ url('/privacy') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Terms -->
    <url>
        <loc>{{ url('/terms') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Artículos dinámicos -->
    @foreach($articles as $article)
        <url>
            <loc>{{ url('/blog/' . $article->slug) }}</loc>
            <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
        </url>
    @endforeach

</urlset>
