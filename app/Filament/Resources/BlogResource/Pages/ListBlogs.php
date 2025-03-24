<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource;
use App\Models\Blog;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListBlogs extends ListRecords
{
    protected static string $resource = BlogResource::class;

    public function mount(): void
    {
        parent::mount();

        $this->activeTab = session('postActiveTab', $this->getDefaultActiveTab());
    }

    public function updatedActiveTab(): void
    {
        parent::updatedActiveTab();
        session(['postActiveTab' => $this->activeTab]);
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->badge(Blog::all()->count())
                ->badgeColor('gray')
                ->icon('heroicon-c-list-bullet')
                ->modifyQueryUsing(fn (Builder $query) => $query->orderByDesc('created_at')),
            BlogStatus::Published->value => Tab::make()
                ->badge(Blog::where('status', BlogStatus::Published)->count())
                ->badgeColor('success')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', BlogStatus::Published)->orderByDesc('created_at')),
            BlogStatus::Private->value => Tab::make()
                ->badge(Blog::where('status', BlogStatus::Private)->count())
                ->badgeColor('danger')
                ->icon('heroicon-o-lock-closed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', BlogStatus::Private)->orderByDesc('created_at')),
            BlogStatus::Draft->value => Tab::make()
                ->badge(Blog::where('status', BlogStatus::Draft)->count())
                ->badgeColor('warning')
                ->icon('heroicon-s-bookmark-square')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', BlogStatus::Draft)->orderByDesc('created_at')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
