<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Not strictly needed for these methods but good practice
use Illuminate\Support\Facades\File;

class DummyArticleController extends Controller
{
    private function loadArticlesData() {
        $path = base_path('mock_data/articles.json'); // Corrected path
        if (!File::exists($path)) {
            return [];
        }
        $json = File::get($path);
        return json_decode($json, true);
    }

    public function getArticles() {
        $allArticles = $this->loadArticlesData();
        $publishedArticles = array_filter($allArticles, function ($article) {
            return isset($article['published']) && $article['published'] == 1;
        });
        // Select specific fields as in the original controller
        $selectedFieldsArticles = array_map(function($article){
            return [
                'slug' => $article['slug'],
                'title' => $article['title'],
                'category' => $article['category'],
                'cover_image' => $article['cover_image'],
                'description' => $article['description'],
                'reading_time' => $article['reading_time'],
                'date_publish' => $article['date_publish'],
            ];
        }, array_values($publishedArticles));
        return response()->json($selectedFieldsArticles);
    }

    public function getArticlesByCategory($slug) {
        $allArticles = $this->loadArticlesData();
        $categoryArticles = array_filter($allArticles, function ($article) use ($slug) {
            return isset($article['published']) && $article['published'] == 1 && isset($article['category']) && $article['category'] == $slug;
        });
        $selectedFieldsArticles = array_map(function($article){
            return [
                'slug' => $article['slug'],
                'title' => $article['title'],
                'category' => $article['category'],
                'cover_image' => $article['cover_image'],
                'description' => $article['description'],
                'reading_time' => $article['reading_time'],
                'date_publish' => $article['date_publish'],
            ];
        }, array_values($categoryArticles));
        return response()->json($selectedFieldsArticles);
    }

    public function getArticleBySlug($slug) {
        $allArticles = $this->loadArticlesData();
        $articleData = null;
        foreach ($allArticles as $article) {
            if (isset($article['published']) && $article['published'] == 1 && isset($article['slug']) && $article['slug'] == $slug) {
                $articleData = $article; // Return full article data as per original controller
                break;
            }
        }

        if (!$articleData) {
            return response()->json(['message' => 'Article not found.'], 404);
        }
        return response()->json($articleData);
    }
}
