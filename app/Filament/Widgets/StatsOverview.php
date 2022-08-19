<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Desenvolvedor', 'Matheus Zalamena')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Card::make('Status do Projeto', '55%')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),

        ];
    }
}
