<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseResource\Pages;
use App\Filament\Resources\DiseaseResource\RelationManagers;
use App\Models\Disease;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;



class DiseaseResource extends Resource
{
    protected static ?string $model = Disease::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('slug'),
                Select::make('type')
                    ->options([
                        'v' => 'Virica',
                        'b' => 'Bacteriana',
                        'p' => 'Parasitaria',
                        'h' => 'Hongos',
                        'g' => 'Genetica',
                        'o' => 'Otros'
                    ])
                    ->native(false)
                    ->searchable(),
                Select::make('category')
                    ->options([
                        1 => 'Sistema Cardiovascular',
                        2 => 'Sistema Respiratorio',
                        3 => 'Sistema Nervioso',
                        4 => 'Sistema Músculo-Esquelético',
                        5 => 'Degenerativas',
                        6 => 'Bucodentales',
                        7 => 'Sistema Ocular',
                        8 => 'Sistema Auditivo',
                        9 => 'Dermatología',
                        10 => 'Endocrinología',
                        11 => 'Infecciosas y Parasitarias',
                        12 => 'Gastrointestinales',
                        13 => 'Renales y Urinarias',
                        14 => 'Oncologia',
                        15 => 'Conductuales y Comportamiento',
                        16 => 'Autoinmunes',
                        17 => 'Hematológicas',
                        18 => 'Hepáticas',
                        19 => 'Nasales',
                        20 => 'Cognitivias y Seniles',
                    ])
                    ->native(false)
                    ->searchable(),
                Section::make('Nombres')
                    ->statePath('name')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ]),
                Section::make('Descripción')
                    ->statePath('description')
                    ->schema([
                        TextArea::make('en'),
                        TextArea::make('es')
                    ]),
                Section::make('Sintomas')
                    ->statePath('symptoms')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ]),
                Checkbox::make('cont_animal')
                    ->label('Contagia animales'),
                Checkbox::make('cont_human')
                    ->label('Contagia humanos'),
                Section::make('Via de transmisión')
                    ->statePath('transmision')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ]),
                Section::make('Pronostico')
                    ->statePath('forecast')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ]),
                Section::make('Prevención')
                    ->statePath('prevention')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ]),
                Section::make('Cuando ir al veterinario?')
                    ->statePath('go')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name.es')
                    ->label('Nombre'),
                TextColumn::make('name.en')
                    ->label('Name'),
                TextColumn::make('species_count')
                    ->label('Species')
                    ->counts('species')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SpeciesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiseases::route('/'),
            'create' => Pages\CreateDisease::route('/create'),
            'view' => Pages\ViewDisease::route('/{record}'),
            'edit' => Pages\EditDisease::route('/{record}/edit'),
        ];
    }
}
