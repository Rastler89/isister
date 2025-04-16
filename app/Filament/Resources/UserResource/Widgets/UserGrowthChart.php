<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UserGrowthChart extends ChartWidget
{
    protected static ?string $heading = 'Crecimiento de Usuarios';

    protected static ?int $sort = 1;

    protected function getFilters(): array {
        return [
            '7' => 'Última semana',
            '30' => 'Último mes',
            '90' => 'Último trimestre',
            '180' => 'Último semestre',
            '365' => 'Último año',
        ];
    }

    protected function getData(): array
    {
        $days = (int) ($this->filter ?? 30); // valor por defecto: 30 días
        $startDate = now()->copy()->subDays($days - 1);

        $isMonthly = $days > 90;

        if ($isMonthly) {
            // Agrupar por mes
            $data = DB::table('users')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as label, COUNT(*) as count")
                ->whereDate('created_at', '>=', $startDate)
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } else {
            // Agrupar por día
            $data = DB::table('users')
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as label, COUNT(*) as count")
                ->whereDate('created_at', '>=', $startDate)
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Usuarios nuevos',
                    'data' => $data->pluck('count'),
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.3)',
                    'fill' => true,
                ],
            ],
            'labels' => $data->pluck('label'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }


}
