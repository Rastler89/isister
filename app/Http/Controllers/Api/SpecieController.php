<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specie;

class SpecieController extends Controller {

    public function getAll() {
        return response()->json(Specie::all());
    }
}