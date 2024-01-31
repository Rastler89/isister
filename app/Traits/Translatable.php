<?php

namespace App\Traits;

trait Translatable {
    protected $traductions = [
        'name' => 'array'
    ];

    public function getName() {
        $locale = app()->getLocale();

        return $this->attribute['name']['$locale'] ?? '';
    }
}