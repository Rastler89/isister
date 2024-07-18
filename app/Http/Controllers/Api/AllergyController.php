<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Allergy;

class AllergyController extends Controller {

    public function getAllergiesPet($id) {
        return response()->json(Allergy::where('pet_id','=',$id)->get());
    }

    public function add(Request $request, $id) {
        $allergy = new Allergy();

        $allergy->name = $request->get('name');
        $allergy->description = $request->get('description');
        $allergy->pet_id = $id;

        $allergy->save();

        return response()->json($allergy);
    }
}