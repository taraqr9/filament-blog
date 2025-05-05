<?php

namespace App\Livewire;

use Livewire\Component;

class BlogPreviewComponent extends Component
{
    public $title = '';

    public $content = '';

    public $userName = '';

    public $userAvatar = '/images/person.png';

    public $userProfession = '';

    public $createdAt;

    public function mount()
    {
        $this->title = request('title', '');
        $this->content = request('content', '');
        $this->createdAt = now()->format('F j, Y g:i A');

        $this->userName = auth()->user()->name;
        $this->userProfession = auth()->user()->profession;
    }

    public function render()
    {
        return view('blog.partials.live-preview', [
            'title' => $this->title,
            'content' => $this->content,
            'userName' => $this->userName,
            'userAvatar' => $this->userAvatar,
            'userProfession' => $this->userProfession,
            'createdAt' => $this->createdAt,
        ]);
    }
}
