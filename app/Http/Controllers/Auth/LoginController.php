<?php
// conferences/app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El. pašto adresas yra privalomas',
            'email.email' => 'Neteisingas el. pašto formato',
            'password.required' => 'Slaptažodis yra privalomas'
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Neteisingi prisijungimo duomenys.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('conferences.index'))
            ->with('success', 'Sėkmingai prisijungėte!');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('conferences.index')
            ->with('success', 'Sėkmingai atsijungėte!');
    }
}
