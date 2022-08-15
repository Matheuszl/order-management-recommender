<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Mercado;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\MercadoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MercadoResource\RelationManagers;
use App\Filament\Resources\MercadoResource\Pages\EditMercado;
use App\Filament\Resources\MercadoResource\Pages\ListMercados;
use App\Filament\Resources\MercadoResource\Pages\CreateMercado;

class MercadoResource extends Resource
{
    protected static ?string $model = Mercado::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('nome')->reactive()
            ->afterStateUpdated(function (Closure $set, $state) {
            $set('slug', Str::slug($state));
        })->required(),
            TextInput::make('slug')->required(),
            TextInput::make('endereco')->required(),
            TextInput::make('contato')->required()->mask(fn (TextInput\Mask $mask) => $mask->pattern('(00)00000-0000')),
            Toggle::make('ativo'),
            Select::make('porte')
            ->options([
                'pequeno' => 'Pequeno',
                'medio' => 'Médio ',
                'grande' => 'Grande',
                'rede' => 'Rede',
            ])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMercados::route('/'),
            'create' => Pages\CreateMercado::route('/create'),
            'edit' => Pages\EditMercado::route('/{record}/edit'),
        ];
    }

}
