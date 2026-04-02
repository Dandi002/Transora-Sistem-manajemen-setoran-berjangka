<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function create(): RedirectResponse
    {
        return redirect()->route('register');
    }

    public function store(): RedirectResponse
    {
        return redirect()->route('register');
    }
}
