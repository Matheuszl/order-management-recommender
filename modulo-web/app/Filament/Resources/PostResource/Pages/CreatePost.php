<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

        /**
     * Esta funcao redireciona para a lista de categorias após criar uma nova
     */
    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
