<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller {

    public function addVisit(Request $request, $id) {
        $visit = new Visit(); 

        $visit->pet_id = $id;
        $visit->description = $request->get('description');
        $visit->date = $request->get('date');

        $visit->save();

        return response()->json($visit);
    }

    public function getVisit($id) {
        $visit = Visit::where('pet_id','=',$id)->get();

        return response()->json($visit);
    }
}