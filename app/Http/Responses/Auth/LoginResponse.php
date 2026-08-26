<?php

namespace App\Http\Responses\Auth;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse | Redirector
    {
        if ($request->user()?->isAdmin()) {
            return redirect()->route('filament.admin.pages.dashboard');
        }

        return redirect()->route('site.index');
    }
}
