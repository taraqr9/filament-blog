<?php

namespace App\Filament\Table\Columns;

use Filament\Notifications\Notification;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Model;

class StatusColumn extends ToggleColumn
{
    public static function make(?string $name = 'status'): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->getStateUsing(fn (Model $record) => $record->status->value === 'active')
            ->updateStateUsing(function (Model $record, bool $state) {
                $record->update([
                    'status' => $state ? 'active' : 'inactive',
                ]);
            })
            ->afterStateUpdated(function () {
                Notification::make('status-updated')
                    ->title(__('Status updated'))
                    ->success()
                    ->send();
            });
    }
}
