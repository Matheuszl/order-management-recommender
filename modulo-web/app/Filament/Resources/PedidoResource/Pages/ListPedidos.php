<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PedidoResource;
use App\Filament\Resources\PedidoResource\Widgets\PedidoChart;
use App\Filament\Resources\PedidoResource\Widgets\StatsOverview;

class ListPedidos extends ListRecords
{
    protected static string $resource = PedidoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            PedidoChart::class,
            // StatsOverview::class
        ];
    }
}
