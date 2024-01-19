<?php

namespace App\Traits;

trait Translatable {
    protected $casts = [
        'name' => 'array'
    ];

    public function getName() {
        $locale = app()->getLocale();

        return $this->attribute['name']['$locale'] ?? '';
    }
}