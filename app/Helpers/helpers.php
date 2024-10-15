<?php

if (! function_exists('getSchedule')) {
    function getSchedule($actions) {
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

        return $schedule;
    }
}