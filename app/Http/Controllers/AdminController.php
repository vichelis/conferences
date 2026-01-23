<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'recentUsers'));
    }

    public function conferences()
    {

        $conferences = [
            1 => [
                'id' => 1,
                'title' => 'Tech Conference 2026',
                'date' => '2026-03-15',
                'location' => 'Vilnius, Lithuania',
                'description' => 'Annual technology conference'
            ],
            2 => [
                'id' => 2,
                'title' => 'Business Summit',
                'date' => '2026-04-20',
                'location' => 'Kaunas, Lithuania',
                'description' => 'Business professionals meeting'
            ]
        ];

        return view('admin.conferences', compact('conferences'));
    }

    public function createConference()
    {
        return view('admin.conferences.create');
    }

    public function storeConference(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|date',
            'location' => 'required',
            'description' => 'required'
        ]);

        return redirect()->route('admin.conferences')->with('success', 'Konferencija sėkmingai sukurta!');
    }

    public function editConference($id)
    {

        $conference = [
            'id' => $id,
            'title' => 'Tech Conference 2026',
            'date' => '2026-03-15',
            'location' => 'Vilnius, Lithuania',
            'description' => 'Annual technology conference'
        ];

        return view('admin.conferences.edit', compact('conference'));
    }

    public function updateConference(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|date',
            'location' => 'required',
            'description' => 'required'
        ]);


        return redirect()->route('admin.conferences')->with('success', 'Konferencija atnaujinta!');
    }

    public function destroyConference($id)
    {

        return redirect()->route('admin.conferences')->with('success', 'Konferencija ištrinta!');
    }


    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('admin.users')->with('success', 'Vartotojas atnaujintas!');
    }
}
