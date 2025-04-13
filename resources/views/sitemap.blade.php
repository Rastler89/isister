<?xml version="1.0" encoding="UTF-8"?>
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Home -->
    <url>
        <loc>https://isister.org</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Blog -->
    <url>
        <loc>https://isister.org/blog</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Privacy -->
    <url>
        <loc>https://isister.org/privacy</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Terms -->
    <url>
        <loc>https://isister.org/terms</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
    </url>

    <!-- Artículos dinámicos -->
    @foreach($articles as $article)
        <url>
            <loc>https://isister.org/blog/{{$article->slug}}</loc>
            <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
        </url>
    @endforeach

</urlset>
