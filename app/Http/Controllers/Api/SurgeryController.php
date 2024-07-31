<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surgery;
use App\Models\SurgeryType;

class SurgeryController extends Controller {

    public function getTypes() {
        return response()->json(SurgeryType::all());
    }

    public function addSurgery(Request $request, $id) {
        $surgery = new Surgery(); 

        $surgery->pet_id = $id;
        $surgery->type = $request->get('type');
        $surgery->date = $request->get('date');
        $surgery->preop = $request->get('preop');
        $surgery->description = $request->get('description');
        $surgery->result = $request->get('result');
        $surgery->complications = $request->get('complications');

        $surgery->save();

        return response()->json($surgery);
    }

    public function getSurgery($id) {
        $surgeries = Surgery::where('pet_id','=',$id)->get();

        foreach($surgeries as $surgery) {
            $surgery->type = SurgeryType::find($surgery->type);   
        }

        return response()->json($surgeries);
    }
}