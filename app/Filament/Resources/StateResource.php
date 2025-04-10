<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;


class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationGroup = 'Geography';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Name')
                    ->statePath('name')
                    ->schema([
                        TextInput::make('en'),
                        TextInput::make('es')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name.es')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name.en')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('country_id')
                    ->label('Country ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('towns_count')
                    ->label('Towns')
                    ->counts('towns')
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
            RelationManagers\TownsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'view' => Pages\ViewState::route('/{record}'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
