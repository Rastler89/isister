<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Treatment;

class TreatmentController extends Controller {

    public function addTreatment(Request $request, $id) {
        $treatment = new Treatment(); 

        $treatment->pet_id = $id;
        $treatment->description = $request->get('description');
        $treatment->repetition = $request->get('repetition');
        $treatment->start = $request->get('start');
        $treatment->end = $request->get('end');

        $treatment->save();

        return response()->json($treatment);
    }

    public function getTreatment($id) {
        $treatment = Treatment::where('pet_id','=',$id)->get();

        return response()->json($treatment);
    }
}