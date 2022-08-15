<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PedidoResource;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\PedidoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PedidoResource\Pages\EditPedido;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Filament\Resources\PedidoResource\Pages\ListPedidos;
use App\Filament\Resources\PedidoResource\Pages\CreatePedido;
use App\Filament\Resources\PedidoResource\RelationManagers\ProdutosRelationManager;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Card::make()->schema([
                Select::make('mercado_id')->relationship('mercado', 'nome'),
                TextInput::make('descricao')->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
            $set('slug', Str::slug($state));
        })->required(),

                TextInput::make('slug')->required(),
                Select::make('tipo')->options([
                    'novo' => 'Novo',
                    'troca' => 'Troca',
                ])->required(),
                Toggle::make('realizado'),
            ]),


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
        ]); //FIM DO SCHEMA INICIAL
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('descricao'),
            TextColumn::make('created_at')->since()->sortable(),
            TextColumn::make('updated_at')->since()->sortable(),
            BooleanColumn::make('realizado')
        ])
            ->filters([
            //
        ])
            ->actions([
            Tables\Actions\EditAction::make(),
        ])
            ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // ProdutosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }

}
