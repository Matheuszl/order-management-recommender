<?php

namespace App\Filament\Resources\MercadoResource\Pages;

use App\Filament\Resources\MercadoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMercado extends CreateRecord
{
    protected static string $resource = MercadoResource::class;

    /**
     * Esta funcao redireciona para a lista
     */
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
