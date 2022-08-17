<?php

namespace App\Filament\Resources\MercadoResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\MercadoResource;
use App\Filament\Resources\MercadoResource\Widgets\StatsOverview;

class ListMercados extends ListRecords
{
    protected static string $resource = MercadoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class
        ];
    }
}
