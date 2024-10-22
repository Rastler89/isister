<?php

namespace App\Filament\Resources\MedicalTypeResource\Pages;

use App\Filament\Resources\MedicalTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMedicalType extends ViewRecord
{
    protected static string $resource = MedicalTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
