<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{

    //Torna totes les mascotes
    public function pets(Request $request) {
        $data = Pet::where('user_id','=',$request->user()->id)->get();
        $count = Pet::where('user_id','=',$request->user()->id)->count();

        $response['data'] = $data;
        $response['count'] = $count;

        return response()->json($response);
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
}
