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

    //    protected function getCreateFormAction(): Action
    //    {
    //        return parent::getCreateFormAction()
    //            ->submit(null)
    //            ->requiresConfirmation(fn (
    //            ) => $this->form->getState()['send_mail'] && $this->form->getState()['status'] === BlogStatus::Published)
    //            ->modalHeading(function () {
    //                if ($this->form->getState()['send_mail'] === true && $this->form->getState()['status'] === BlogStatus::Published) {
    //                    return 'Send Email to Subscribers';
    //                }
    //            })
    //            ->modalDescription(function () {
    //                if ($this->form->getState()['send_mail'] === true && $this->form->getState()['status'] === BlogStatus::Published) {
    //                    return 'Are you sure you want to send this email to all subscribers?';
    //                }
    //            })
    //            ->modalSubmitActionLabel(function () {
    //                if ($this->form->getState()['send_mail'] === true && $this->form->getState()['status'] === BlogStatus::Published) {
    //                    return 'Yes, send it';
    //                }
    //            })
    //            ->action(function () {
    //                $this->closeActionModal();
    //                $this->create();
    //            });
    //    }
}
