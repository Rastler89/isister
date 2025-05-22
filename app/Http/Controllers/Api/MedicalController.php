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
        $medical->description = $request->get('description'); // Corrected variable name

        $medical->save();

        return response()->json($medical);
    }

    public function getMedical($id) {
        // Eager load the medicalType relationship
        $medicals = MedicalTest::where('pet_id','=',$id)->with('medicalType')->get();

        // The 'type' attribute on MedicalTest itself is the foreign key (e.g., an int).
        // The related MedicalType model (with its name, etc.) is now available via $medical->medicalType.
        // No need to loop and re-assign $medical->type.
        // The JSON response will automatically include the loaded relationship.

        return response()->json($medicals);
    }
}