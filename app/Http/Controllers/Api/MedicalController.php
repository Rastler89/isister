<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalTest;
use App\Models\MedicalType;

class MedicalController extends Controller {

    public function getTypes() {
        return response()->json(MedicalType::all());
    }

    public function addMedical(Request $request, $id) {
        $medical = new MedicalTest(); 

        $medical->pet_id = $id;
        $medical->type = $request->get('type');
        $medical->date = $request->get('date');
        $surgery->description = $request->get('description');

        $medical->save();

        return response()->json($medical);
    }

    public function getMedical($id) {
        $medicals = MedicalTest::where('pet_id','=',$id)->get();

        foreach($medicals as $medical) {
            $medical->type = MedicalType::find($medical->type);   
        }

        return response()->json($medicals);
    }
}