<?php

namespace App\Filament\Resources\CategoriaResource\Widgets;

use App\Models\Categoria;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Categorias', Categoria::all()->count()),
        ];
    }
}
