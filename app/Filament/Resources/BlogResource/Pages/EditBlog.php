<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    protected bool $savingAsDraft = false;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->savingAsDraft) {
            $data['status'] = BlogStatus::Draft;
        }

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return $this->savingAsDraft ? 'Saved as draft' : parent::getSavedNotificationTitle();
    }

    public function saveAsDraft(): void
    {
        $this->savingAsDraft = true;

        $this->save();
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            Action::make('saveAsDraft')
                ->label('Save as Draft')
                ->color('gray')
                ->action('saveAsDraft'),
            $this->getCancelFormAction(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
