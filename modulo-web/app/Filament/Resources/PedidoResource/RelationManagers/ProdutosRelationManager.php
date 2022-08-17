<?php

namespace App\Filament\Resources\PedidoResource\RelationManagers;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Produto;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;

class ProdutosRelationManager extends RelationManager
{
    protected static string $relationship = 'pedido_produto';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            Section::make('Lista de Produtos')
            ->schema([
                Repeater::make('produtos')->relationship()
                ->schema([
                    Select::make('produto_id')
                    ->label('Produto')
                    ->options(Produto::query()->pluck('nome', 'id'))
                    ->required(),
                    TextInput::make('quantidade')
                    ->numeric()
                    ->required(),
                ])->orderable()
                ->defaultItems(1)
                ->disableLabel(),
            ])
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            TextColumn::make('customer.nome')
            ->label('Produto')
            ->searchable()
            ->sortable(),

            TextColumn::make('quantidade')
            ->label('Quantidade')
            ->searchable()
            ->sortable(),

        ])
            ->filters([
            //
        ])
            ->headerActions([
            CreateAction::make(),
        ])
            ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
            ->bulkActions([
            DeleteBulkAction::make(),
        ]);
    }

}
