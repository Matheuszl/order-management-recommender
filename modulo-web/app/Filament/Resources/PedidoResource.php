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
use Filament\Tables\Filters\Filter;
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
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\PedidoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PedidoResource\Pages\EditPedido;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Filament\Resources\PedidoResource\Pages\ListPedidos;
use App\Filament\Resources\PedidoResource\Pages\CreatePedido;
use App\Filament\Resources\PedidoResource\RelationManagers\ProdutosRelationManager;
use App\Filament\Resources\PedidoResource\Widgets\BlogPostsChart;
use App\Filament\Resources\PedidoResource\Widgets\PedidoChart;
use App\Filament\Resources\PedidoResource\Widgets\StatsOverview;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;
    protected static ?string $recordTitleAttribute = 'descricao';

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
                    ->required()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('preco', Produto::find($state)?->price ?? 0))
                    ->reactive(),
                    TextInput::make('quantidade')
                    ->numeric()
                    ->required(),
                    TextInput::make('preco')
                    ->label('Valor Por Unidade')
                    ->disabled()
                    ->numeric()
                    ->required(),
                ])->orderable()
                ->defaultItems(1)
                ->disableLabel(),
            ])
        ])->columns(1); //FIM DO SCHEMA INICIAL
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('mercado.nome'),
            TextColumn::make('descricao')->sortable()->searchable(),
            TextColumn::make('created_at')->since()->sortable(),
            TextColumn::make('updated_at')->since()->sortable(),
            BooleanColumn::make('realizado')->sortable(),
        ])
            ->filters([

                 
                Filter::make('realizado')
                    ->query(fn (Builder $query): Builder => $query->where('realizado', true)),

                    MultiSelectFilter::make('mercado')->relationship('mercado', 'nome')
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


    public static function getWidgets(): array
    {
        return [
            PedidoChart::class,
            // StatsOverview::class
        ];
    }

    

}
