<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurgeryTypeResource\Pages;
use App\Filament\Resources\SurgeryTypeResource\RelationManagers;
use App\Models\SurgeryType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;

class SurgeryTypeResource extends Resource
{
    protected static ?string $model = SurgeryType::class;

    protected static ?string $navigationGroup = 'Types';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('slug'),
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
                TextColumn::make('slug')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name.es')
                    ->label('Nombre'),
                TextColumn::make('name.en')
                    ->label('Name'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurgeryTypes::route('/'),
            'create' => Pages\CreateSurgeryType::route('/create'),
            'view' => Pages\ViewSurgeryType::route('/{record}'),
            'edit' => Pages\EditSurgeryType::route('/{record}/edit'),
        ];
    }
}
