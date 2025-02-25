<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diet;

class DietController extends Controller {

    public function getDietsPet($id) {
        $actions = Diet::where('pet_id','=',$id)
                    ->orderBy('DayOfWeek','asc')
                    ->orderBy('time','asc')
                    ->get();

        $schedule = getSchedule($actions,'diet');

        return response()->json($schedule);
    }


    public function add(Request $request, $id) {
        $diet = new Diet();

        $diet->DayOfWeek = $request->get('DayOfWeek');
        $diet->time = $request->get('time');
        $diet->description = $request->get('description');
        $diet->brand = $request->get('brand');
        $diet->amount = $request->get('amount');
        $diet->type = $request->get('type');
        $diet->information = $request->get('information');
        $diet->pet_id = $id;

        $diet->save();

        return response()->json($diet);
    }

    public function delete($id, $day, $hour) {
        $diet = Diet::whereIn('DayOfWeek',[$day,8])->where('time','=',$hour.':00:00')->first();

        if($diet->DayOfWeek == 8) {
            for($i = 0; $i < 7; $i++) {
                if($i == $day-1) continue;
                $diet2 = new Diet();
                $diet2->DayOfWeek = $i;
                $diet2->time = $diet->time;
                $diet2->description = $diet->description;
                $diet2->pet_id = $id;
                $diet2->save();
            }
            $diet->delete();
        } else {
            $diet->delete();
        }

        return $this->getDietsPet($id);
    }
}