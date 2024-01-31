<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{

    //Torna totes les mascotes
    public function pets(Request $request) {
        return response()->json($request->user()->id);
    }

    //Afegeix una mascota
    public function add(Request $request) {
        echo $request;
    }

    //Contador de mascotes
    public function count(Request $request) {
        return response()->json(Pet::where('user_id','=',$request->user()->id)->count());
    }
}
