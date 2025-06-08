<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DummyBreedController extends Controller
{
    private function loadBreedsData() {
        $path = base_path('mock_data/breeds.json');
        if (!File::exists($path)) return [];
        return json_decode(File::get($path), true);
    }

    public function getBySpecie($id) {
        $allBreeds = $this->loadBreedsData();
        $specieBreeds = [];

        foreach ($allBreeds as $breed) {
            if (isset($breed['specie_id']) && $breed['specie_id'] == $id) {
                $specieBreeds[] = $breed;
            }
        }
        return response()->json(array_values($specieBreeds));
    }
}
