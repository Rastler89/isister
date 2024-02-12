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
        $pet = new Pet();

        $pet->user_id = $request->user()->id;
        $pet->name = $request->get('name');
        $pet->gender = $request->get('gender');
        $pet->birth = $request->get('birth');
        $pet->breed_id = $request->get('breed');
        $pet->code = $request->get('code');
        $pet->status = 1;

        $pet->save();

        return response()->json($pet->id);

    }

    //Contador de mascotes
    public function count(Request $request) {
        return response()->json(Pet::where('user_id','=',$request->user()->id)->count());
    }
}
