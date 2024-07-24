<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Walk;

class WalkController extends Controller {

    public function getWalksPet($id) {
        $actions = Walk::where('pet_id','=',$id)
                    ->orderBy('DayOfWeek','asc')
                    ->orderBy('time','asc')
                    ->get();

        $schedule = [];
        for ($i = 0; $i < 24; $i++) {
            $schedule[$i] = array_fill(0, 8, null);
            $schedule[$i][0] = sprintf('%02d:00', $i); // Poner la hora en el índice 0
        }

        // Llenar la matriz con las acciones correspondientes
        foreach ($actions as $action) {
            
            // Convertir el tiempo a horas
            if ($action->DayOfWeek != 8) {
                $hour = intval(explode(':', $action->time)[0]);
                $dayOfWeek = $action->DayOfWeek+1;
        
                // Asignar la descripción de la acción en la posición correspondiente
                $schedule[$hour][$dayOfWeek] = $action->description;
            } else {
                for($i = 0; $i < 7; $i++) {
                    $hour = intval(explode(':', $action->time)[0]);
                $dayOfWeek = $i+1;
        
                // Asignar la descripción de la acción en la posición correspondiente
                $schedule[$hour][$dayOfWeek] = $action->description;
                }
            }
        }

        return response()->json($schedule);
    }


    public function add(Request $request, $id) {
        $Walk = new Walk();

        $Walk->DayOfWeek = $request->get('DayOfWeek');
        $Walk->time = $request->get('time');
        $Walk->description = $request->get('description');
        $Walk->pet_id = $id;

        $Walk->save();

        return response()->json($Walk);
    }

    public function delete($id, $day, $hour) {
        $Walk = Walk::whereIn('DayOfWeek',[$day-1,8])->where('time','=',$hour.':00:00')->first();

        if($Walk->DayOfWeek == 8) {
            for($i = 0; $i < 7; $i++) {
                if($i == $day-1) continue;
                $Walk2 = new Walk();
                $Walk2->DayOfWeek = $i;
                $Walk2->time = $Walk->time;
                $Walk2->description = $Walk->description;
                $Walk2->pet_id = $id;
                $Walk2->save();
            }
            $Walk->delete();
        } else {
            $Walk->delete();
        }

        return $this->getWalksPet($id);
    }
}