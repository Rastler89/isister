<?php

namespace App\Filament\Resources\PetResource\Widgets;

use App\Models\Pet;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class MascotasChart extends ChartWidget
{
    protected static ?string $heading = 'Mascotas por tipo';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $resultados = Pet::select('breeds.specie_id', DB::raw('count(*) as total'))
            ->join('breeds', 'pets.breed_id', '=', 'breeds.id')
            ->groupBy('breeds.specie_id')
            ->get();

        $species = [
            1 => 'Gatos',
            2 => 'Perros',
        ];

        $labels = []; // Initialize $labels
        $data = [];   // Initialize $data
        foreach ($resultados as $fila) {
            /** @var object{specie_id: int, total: int} $fila */
            $labels[] = $species[$fila->specie_id] ?? 'Desconocido';
            $data[] = $fila->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Mascotas',
                    'data' => $data,
                    'backgroundColor' => [
                        '#4ade80', // verde para Perros
                        '#60a5fa', // azul para Gatos
                        '#f87171', // rojo para Desconocido u otros
                    ],
                ],
            ],
            'labels' => $labels,
        ];

    }

    protected function getType(): string
    {
        return 'pie';
    }
}
