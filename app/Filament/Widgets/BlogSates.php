<?php

namespace App\Filament\Widgets;

use App\Enums\BlogStatus;
use App\Models\Blog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogSates extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Blog', Blog::count())
                ->icon('heroicon-c-list-bullet')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Published Blog', Blog::where('status', BlogStatus::Published)->count())
                ->icon('heroicon-o-check-circle')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Private Blog', Blog::where('status', BlogStatus::Private)->count())
                ->icon('heroicon-o-lock-closed')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Draft Blog', Blog::where('status', BlogStatus::Draft)->count())
                ->icon('heroicon-s-bookmark-square')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
