<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Display the registration form.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'city' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'terms' => ['required', 'accepted']
        ], [
            'name.required' => 'Vardas ir pavardė yra privalomi',
            'email.required' => 'El. pašto adresas yra privalomas',
            'email.email' => 'Neteisingas el. pašto formato',
            'email.unique' => 'Šis el. pašto adresas jau užregistruotas',
            'password.required' => 'Slaptažodis yra privalomas',
            'password.confirmed' => 'Slaptažodžiai nesutampa',
            'birth_date.before' => 'Gimimo data turi būti praeityje',
            'terms.accepted' => 'Turite sutikti su naudojimo sąlygomis'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'city' => $request->city,
            'bio' => $request->bio,
            'is_active' => true
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('conferences.index')
            ->with('success', 'Sveikiname! Jūsų paskyra sėkmingai sukurta. Patvirtinimo laiškas išsiųstas į jūsų el. paštą.');
    }

    public function profile()
    {
        $user = Auth::user();
        $registrations = $user->conferenceRegistrations()
            ->with('conference.subsystem')
            ->latest()
            ->get();

        return view('auth.profile', compact('user', 'registrations'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'city' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update($request->only([
            'name', 'email', 'phone', 'birth_date',
            'gender', 'city', 'bio'
        ]));

        return redirect()->route('profile')
            ->with('success', 'Profilis sėkmingai atnaujintas!');
    }
}
