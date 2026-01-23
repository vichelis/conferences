<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\ConferenceRegistration;

class EmployeeController extends Controller
{
    public function index()
    {
        $totalConferences = Conference::count();
        $upcomingConferences = Conference::upcoming()->count();
        $totalRegistrations = ConferenceRegistration::where('status', 'confirmed')->count();

        return view('employee.dashboard', compact('totalConferences', 'upcomingConferences', 'totalRegistrations'));
    }

    public function conferences()
    {
        $conferences = Conference::with(['subsystem', 'confirmedRegistrations'])
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($conference) {
                return [
                    'id' => $conference->id,
                    'title' => $conference->title,
                    'date' => $conference->date->format('Y-m-d'),
                    'location' => $conference->location,
                    'status' => $conference->date->isPast() ? 'completed' : 'upcoming',
                    'registrations_count' => $conference->confirmedRegistrations->count()
                ];
            });

        return view('employee.conferences', compact('conferences'));
    }

    public function showConference($id)
    {
        $conference = Conference::with('subsystem')->findOrFail($id);
        return view('employee.conferences.show', compact('conference'));
    }

    public function registrations($id)
    {
        $conference = Conference::findOrFail($id);
        $registrations = ConferenceRegistration::where('conference_id', $id)
            ->orderBy('registered_at', 'desc')
            ->get()
            ->map(function($reg) {
                return [
                    'id' => $reg->id,
                    'name' => $reg->name,
                    'email' => $reg->email,
                    'registered_at' => $reg->registered_at->format('Y-m-d')
                ];
            });

        return view('employee.conferences.registrations', compact('conference', 'registrations'));
    }
}
