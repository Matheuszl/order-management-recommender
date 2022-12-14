<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Produto;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ProdutoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use App\Filament\Resources\ProdutoResource\Pages\EditProduto;
use App\Filament\Resources\ProdutoResource\Pages\ListProdutos;
use App\Filament\Resources\ProdutoResource\Pages\CreateProduto;
use App\Filament\Resources\ProdutoResource\Widgets\StatsOverview;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;
    protected static ?string $recordTitleAttribute = 'nome';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('imagem')->collection('mercados'),
            TextInput::make('nome')->reactive()
            ->afterStateUpdated(function (Closure $set, $state) {
            $set('slug', Str::slug($state));
        })->required(),
            TextInput::make('slug')->required(),
            TextInput::make('preco')
            ->numeric()
            ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
            ->required(),
            Toggle::make('ativo'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->sortable(),
            SpatieMediaLibraryImageColumn::make('imagem')->collection('mercados'),
            TextColumn::make('nome')->limit(50)->sortable()->searchable(),
            TextColumn::make('slug')->limit(50),
            TextColumn::make('preco'),
            TextColumn::make('created_at')->since()->sortable(),
            TextColumn::make('updated_at')->since()->sortable(),

            BooleanColumn::make('ativo')->sortable(),
        ])
            ->filters([
                Filter::make('realizado')
                ->query(fn (Builder $query): Builder => $query->where('realizado', true))
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }

}
