<?php

/*if (! function_exists('getSchedule')) {
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
}*/
if (!function_exists('getSchedule')) {
    function getSchedule($actions,$type) {
        $daysOfWeek = [
            1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 
            4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'
        ];

        $schedule = [];
        $duration = '30 min'; // Initialize $duration

        foreach ($actions as $action) {
            $hour = intval(explode(':', $action->time)[0]);
            $minutes = intval(explode(':', $action->time)[1]);
            $formattedTime = sprintf('%02d:%02d', $hour, $minutes);
            
            if($type === 'walk') {
                $duration = !empty($action->duration) ? $action->duration . ' min' : '30 min';
            } 

            if ($action->DayOfWeek != 8) {
                $day = $daysOfWeek[$action->DayOfWeek + 1] ?? 'Desconocido';
                if($type==='walk') {
                    $schedule[] = [
                        'day' => $day,
                        'time' => $formattedTime,
                        'description' => $action->description,
                        'duration' => $duration,
                        'intensity' => $action->intensity,
                        'route' => $action->route
                    ];
                } else {
                    $schedule[] = [
                        'day' => $day,
                        'time' => $formattedTime,
                        'description' => $action->description,
                        'type' => $action->type,
                        'amount' => $action->amount,
                        'brand' => $action->brand,
                        'information' => $action->information
                        
                    ];
                }
                
            } else {
                for ($i = 1; $i <= 7; $i++) {
                    if($type==='walk') {
                        $schedule[] = [
                            'day' => $daysOfWeek[$i],
                            'time' => $formattedTime,
                            'description' => $action->description,
                            'duration' => $duration,
                            'intensity' => $action->intensity,
                            'route' => $action->route
                        ];
                    } else {
                        $schedule[] = [
                            'day' => $daysOfWeek[$i],
                            'time' => $formattedTime,
                            'description' => $action->description,
                            'type' => $action->type,
                            'amount' => $action->amount,
                            'brand' => $action->brand,
                            'information' => $action->information
                            
                        ];
                    }
                    
                }
            }
        }

        return $schedule;
    }
}
