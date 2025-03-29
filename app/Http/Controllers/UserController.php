<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function profile(): View
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->back()->with('toast', config('message.content.updated'));
    }
}
