<?php

namespace App\Filament\Resources\SurgeryTypeResource\Pages;

use App\Filament\Resources\SurgeryTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSurgeryType extends ViewRecord
{
    protected static string $resource = SurgeryTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
