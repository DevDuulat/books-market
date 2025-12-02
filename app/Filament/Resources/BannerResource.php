<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Баннеры';
    protected static ?string $pluralLabel = 'Баннеры';
    protected static ?string $modelLabel = 'Баннер';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\FileUpload::make('image_path')
//                    ->label('Изображение')
//                    ->image()
//                    ->required(),

                Forms\Components\ViewField::make('image_path')
                    ->label('Изображение')
                    ->view('filament.custom.banner-upload')
                    ->required(),
                Forms\Components\TextInput::make('is_active')
                    ->label('Активен')
                    ->required()
                    ->numeric()
                    ->default(1),

                Forms\Components\TextInput::make('link')
                    ->label('Ссылка')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Изображение'),

                Tables\Columns\TextColumn::make('is_active')
                    ->label('Активен')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('link')
                    ->label('Ссылка')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Обновлён')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Удалить выбранные'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
