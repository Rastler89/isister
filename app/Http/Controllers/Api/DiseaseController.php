<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Specie;

class DiseaseController extends Controller {

    public function get() {
        return response()->json(Disease::with('species')->get());
    }

    public function getBy($id) {
        $specie = Specie::find($id);

        $diseases = $specie->diseases;

        return response()->json($diseases);
    }
}