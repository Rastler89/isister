<?php

namespace App\Traits;

trait Translatable {
    protected $traductions = [
        'name' => 'array'
    ];

    public function getName() {
        $locale = app()->getLocale();

        // Correctly use the $locale variable as the array key
        return $this->attributes['name'][$locale] ?? ($this->attributes['name']['en'] ?? '');
    }
}