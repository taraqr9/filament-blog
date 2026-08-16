<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if ($request->user()->hasRole('user')) {
            return redirect()->route('home');
        }

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
