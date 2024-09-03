<?php

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;

if(!function_exists('PetForm')) {
    function PetForm() {
        return [
            TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            Select::make('gender')
                ->options([
                    'F' => 'Hembra',
                    'M' => 'Macho'
                ]),
            DatePicker::make('birth'),
            TextInput::make('code'),
            TextInput::make('breed_id'),
            TextInput::make('status'),
            TextInput::make('image'),
            TextInput::make('character'),
            TextInput::make('description'),
            DateTimePicker::make('created_at')
            ];
    }
}

if(!function_exists('PetTable')) {
    function PetTable() {
        return [
            TextColumn::make('name'),
            TextColumn::make('gender'),
            TextColumn::make('birth'),
            TextColumn::make('code'),
            TextColumn::make('breed_id'),
            TextColumn::make('status'),
            TextColumn::make('image'),
            TextColumn::make('character'),
            TextColumn::make('description'),
            TextColumn::make('created_at'),
        ];
    }
}