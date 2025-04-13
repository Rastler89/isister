<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Titulo')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                Select::make('language')
                    ->label('Idioma')
                    ->options([
                        0 => 'Español',
                        1 => 'Ingles'
                    ]),
                Select::make('category')
                    ->label('Categoria')
                    ->options([
                        'health' => 'Salud y bienestar',
                        'nutrition' => 'Nutrición',
                        'training' => 'Entrenamiento',
                        'care' => 'Cuidados básicos',
                        'emergency' => 'Emergencias',
                    ]),
                FileUpload::make('cover_image')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->required(),
                Textarea::make('description')
                    ->label('Descripcion corta')
                    ->rows(3)
                    ->required(),
                RichEditor::make('content')
                    ->label('Contenido')
                    ->columnSpan('full')
                    ->required(),
                TextInput::make('cta_title')
                    ->label('Titulo CTA')
                    ->required(),
                TextInput::make('cta_text')
                    ->label('Descripcion CTA')
                    ->required(),
                Toggle::make('featured')
                    ->label('Aritculo Importante'),
                Toggle::make('published')
                    ->label('Publicado'),
                DateTimePicker::make('date_publish')
                    ->label('Fecha de publicación'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reading_time')
                    ->label('Tiempo de lectura')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
