<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function getArticles() {
        $articles = Article::query()
            ->select('slug','title','category','cover_image','description','reading_time','date_publish')
            ->where('published',1)
            ->latest()
            ->get();
        return response()->json($articles);
    }

    public function getArticlesByCategory($slug) {
        $articles = Article::query()
            ->select('slug','title','category','cover_image','description','reading_time','date_publish')
            ->where('published',1)
            ->where('category', $slug)
            ->latest()
            ->get();
        return response()->json($articles);
    }

    public function getArticleBySlug($slug) {
        $article = Article::where('slug', $slug)->where('published',1)->first();

        return response()->json($article);
    }
}
