<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicalTypeResource\Pages;
use App\Filament\Resources\MedicalTypeResource\RelationManagers;
use App\Models\MedicalType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class MedicalTypeResource extends Resource
{
    protected static ?string $model = MedicalType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
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
            'index' => Pages\ListMedicalTypes::route('/'),
            'create' => Pages\CreateMedicalType::route('/create'),
            'view' => Pages\ViewMedicalType::route('/{record}'),
            'edit' => Pages\EditMedicalType::route('/{record}/edit'),
        ];
    }
}
