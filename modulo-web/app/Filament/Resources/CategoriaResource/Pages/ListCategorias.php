<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\CreateAction;
use App\Filament\Resources\CategoriaResource;

class ListCategorias extends ListRecords
{
    protected static string $resource = CategoriaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
