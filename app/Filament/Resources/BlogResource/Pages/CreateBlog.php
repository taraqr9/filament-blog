<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Enums\BlogStatus;
use App\Filament\Resources\BlogResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected bool $savingAsDraft = false;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        if ($this->savingAsDraft) {
            $data['status'] = BlogStatus::Draft;
        }

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return $this->savingAsDraft ? 'Saved as draft' : parent::getCreatedNotificationTitle();
    }

    public function saveAsDraft(): void
    {
        $this->savingAsDraft = true;

        $this->create();
    }

    public function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            Action::make('saveAsDraft')
                ->label('Save as Draft')
                ->color('gray')
                ->action('saveAsDraft'),
            Action::make('Preview Button')
                ->view('livewire.blog-preview-button'),
        ];
    }
}
