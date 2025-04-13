<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SiteMapController extends Controller
{
    public function index()
    {
        $articles = Article::where('published','=',1)->get(); // o solo los publicados

        $xml = view('sitemap', compact('articles'))->render();

        return Response::make($xml, 200)->header('Content-Type', 'application/xml');
    }
}
