<?php

namespace App\Filament\Table\Columns;

use App\Enums\BlogStatus;
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
            if ($record->status === BlogStatus::Published) {
                return 'success';
            } elseif ($record->status === BlogStatus::Draft) {
                return 'warning';
            } elseif ($record->status === BlogStatus::Private) {
                return 'danger';
            }
        })
            ->icon(function (Model $record) {
                if ($record->status === BlogStatus::Published) {
                    return 'heroicon-o-check-circle';
                } elseif ($record->status === BlogStatus::Draft) {
                    return 'heroicon-s-bookmark-square';
                } elseif ($record->status === BlogStatus::Private) {
                    return 'heroicon-o-lock-closed';
                }
            })
            ->alignCenter();
    }
}
