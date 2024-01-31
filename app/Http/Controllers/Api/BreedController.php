<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Breed;

class BreedController extends Controller {

    public function getBySpecie($id) {
        return response()->json(Breed::where('specie_id','=',$id)->get());
    }
}