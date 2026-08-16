<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    public function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),
            Action::make('Preview Button')
                ->view('livewire.blog-preview-button'),
        ];
    }
}
