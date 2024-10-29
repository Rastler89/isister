<?php

namespace App\Filament\Resources\SpecieResource\Pages;

use App\Filament\Resources\SpecieResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSpecie extends ViewRecord
{
    protected static string $resource = SpecieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
