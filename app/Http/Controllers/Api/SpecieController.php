<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specie;
use App\Models\Breed;

class SpecieController extends Controller {

    public function getAll() {
        $species = Specie::all();
        foreach($species as $specie) {
            $specie['name'] = $specie['name'];
            $breeds = Breed::where('specie_id','=',$specie['id'])->get();
            $specie['breeds'] = $breeds;
        }


        return response()->json($species);
    }
}