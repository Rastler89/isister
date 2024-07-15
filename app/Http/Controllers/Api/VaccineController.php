<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Specie;
use App\Models\Vaccine;

class VaccineController extends Controller {

    public function getVaccinesPet($id) {
        $vaccines = Vaccine::where('pet_id','=',$id)->get();

        foreach($vaccines as $vaccine) {
            $array = [];
            foreach(json_decode($vaccine->disease) as $disease) {
                $array[] = Disease::find($disease);
            }
            $vaccine->disease = $array;
        }

        return response()->json($vaccines);
    }

    public function add(Request $request, $id) {
        $vaccine = new Vaccine();

        $vaccine->name = $request->get('name');
        $vaccine->disease = json_encode($request->get('diseases'));
        $vaccine->lot = $request->get('lot');
        $vaccine->application = $request->get('application');
        $vaccine->next = $request->get('next');
        $vaccine->vcode = $request->get('vcode');
        $vaccine->pet_id = $id;

        $vaccine->save();

        return response()->json($vaccine);
    }
}