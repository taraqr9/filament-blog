<?php

namespace App\Filament\Table\Columns;

use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Model;

class BlogStatusColumn extends IconColumn
{
    public static function make(?string $name = 'status'): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        $this->color(function (Model $record) {
            if ($record->status === 'published') {
                return 'success';
            } elseif ($record->status === 'draft') {
                return 'warning';
            } elseif ($record->status === 'private') {
                return 'danger';
            }
        })
            ->icon(function (Model $record) {
                if ($record->status === 'published') {
                    return 'heroicon-o-check-circle';
                } elseif ($record->status === 'draft') {
                    return 'heroicon-s-bookmark-square';
                } elseif ($record->status === 'private') {
                    return 'heroicon-o-lock-closed';
                }
            })
            ->alignCenter();
    }
}
