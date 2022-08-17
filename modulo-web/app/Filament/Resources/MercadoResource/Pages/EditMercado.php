<?php

namespace App\Filament\Resources\MercadoResource\Pages;

use App\Filament\Resources\MercadoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMercado extends EditRecord
{
    protected static string $resource = MercadoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
