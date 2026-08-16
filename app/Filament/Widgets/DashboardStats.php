<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        return [
            Stat::make('Total Users', User::count())
                ->icon('heroicon-o-users'),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
