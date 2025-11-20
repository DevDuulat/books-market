<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\ItemsRelationManager;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->numeric()
                    ->label('ID пользователя'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Имя клиента'),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255)
                    ->label('Телефон'),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->columnSpanFull()
                    ->label('Адрес доставки'),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->label('Итоговая сумма'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Статус'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Имя клиента'),
                TextColumn::make('phone')->label('Телефон'),
                TextColumn::make('total')->numeric()->label('Сумма заказа'),
            ])
            ->actions([
                Action::make('view')
                    ->label('Просмотр')
                    ->button()
                    ->modalHeading(fn($record) => "Заказ #{$record->id}")
                    ->modalContent(function ($record) {
                        return view('filament.orders.view-order', [
                            'order' => $record,
                            'items' => $record->items,
                        ]);
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
