<?php
// conferences/app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conference;
use App\Models\Subsystem;
use App\Models\ConferenceSpeaker;

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
        $conferences = Conference::with('subsystem')->orderBy('date', 'desc')->get();
        return view('admin.conferences', compact('conferences'));
    }

    public function createConference()
    {
        $subsystems = Subsystem::active()->get();
        return view('admin.conferences.create', compact('subsystems'));
    }

    public function storeConference(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'address' => 'required',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'subsystem_id' => 'required|exists:subsystems,id'
        ]);

        Conference::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'address' => $request->address,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'subsystem_id' => $request->subsystem_id,
            'status' => 'published'
        ]);

        return redirect()->route('admin.conferences')->with('success', 'Konferencija sėkmingai sukurta!');
    }

    public function editConference($id)
    {
        $conference = Conference::findOrFail($id);
        $subsystems = Subsystem::active()->get();
        return view('admin.conferences.edit', compact('conference', 'subsystems'));
    }

    public function updateConference(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required',
            'address' => 'required',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'subsystem_id' => 'required|exists:subsystems,id'
        ]);

        $conference = Conference::findOrFail($id);
        $conference->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'address' => $request->address,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'subsystem_id' => $request->subsystem_id
        ]);

        return redirect()->route('admin.conferences')->with('success', 'Konferencija atnaujinta!');
    }

    public function destroyConference($id)
    {
        $conference = Conference::findOrFail($id);
        $conference->delete();
        return redirect()->route('admin.conferences')->with('success', 'Konferencija ištrinta!');
    }

    // User Management (keep existing methods)
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

        return redirect()->route('admin.users')->with('success', 'Naudotojas atnaujintas!');
    }
}
