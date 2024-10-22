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
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class SurgeryTypeResource extends Resource
{
    protected static ?string $model = SurgeryType::class;

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
            'index' => Pages\ListSurgeryTypes::route('/'),
            'create' => Pages\CreateSurgeryType::route('/create'),
            'view' => Pages\ViewSurgeryType::route('/{record}'),
            'edit' => Pages\EditSurgeryType::route('/{record}/edit'),
        ];
    }
}
