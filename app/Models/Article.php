<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'language',
        'slug',
        'cover_image',
        'category',
        'description',
        'content',
        'reading_time',
        'cta_title',
        'cta_text',
        'created_at',
        'featured',
        'published',
        'date_publish'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($article) {
            $article->reading_time = self::estimatedReadingTime($article->content);
        });
    }

    public static function estimatedReadingTime($content) {
        $plainText = strip_tags($content);
        $wordCount = str_word_count($plainText);
        $minutes = ceil($wordCount / 200); //200 palabras por minuto
        return max(1, $minutes);
    }
}
