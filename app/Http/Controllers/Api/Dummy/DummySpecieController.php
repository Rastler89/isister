<?php

namespace App\Http\Controllers\Api\Dummy;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DummySpecieController extends Controller
{
    private function loadSpeciesData() {
        $path = base_path('mock_data/species.json');
        if (!File::exists($path)) return [];
        return json_decode(File::get($path), true);
    }

    private function loadBreedsData() {
        $path = base_path('mock_data/breeds.json');
        if (!File::exists($path)) return [];
        return json_decode(File::get($path), true);
    }

    public function getAll() {
        $species = $this->loadSpeciesData();
        $allBreeds = $this->loadBreedsData();
        $result = [];

        foreach ($species as $specie) {
            $specieBreeds = [];
            foreach ($allBreeds as $breed) {
                if (isset($breed['specie_id']) && $breed['specie_id'] == $specie['id']) {
                    $specieBreeds[] = $breed;
                }
            }
            $specie['breeds'] = $specieBreeds;
            $result[] = $specie;
        }
        return response()->json($result);
    }
}
