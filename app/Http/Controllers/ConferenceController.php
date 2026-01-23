<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\Subsystem;
use App\Models\ConferenceRegistration;
use Carbon\Carbon;

class ConferenceController extends Controller
{
    public function index(Request $request)
    {
        $subsystems = Subsystem::active()
            ->withCount(['upcomingConferences'])
            ->get();

        $query = Conference::with(['subsystem', 'speakers'])
            ->published()
            ->upcoming()
            ->orderBy('date');

        if ($request->has('subsystem') && $request->subsystem) {
            $query->bySubsystem($request->subsystem);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%");
            });
        }

        $conferences = $query->get();
        $selectedSubsystem = $request->subsystem;
        $searchTerm = $request->search;

        return view('conferences.index', compact(
            'conferences',
            'subsystems',
            'selectedSubsystem',
            'searchTerm'
        ));
    }

    public function show($id)
    {
        $conference = Conference::with([
            'subsystem',
            'speakers',
            'confirmedRegistrations'
        ])->findOrFail($id);

        return view('conferences.show', compact('conference'));
    }

    public function register(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $conference = Conference::findOrFail($id);

        if ($conference->is_full) {
            return redirect()->back()
                ->with('error', 'Konferencija jau pilna! Laisvų vietų nėra.');
        }

        $existingRegistration = ConferenceRegistration::where('conference_id', $id)
            ->where('email', $request->email)
            ->first();

        if ($existingRegistration) {
            return redirect()->back()
                ->with('error', 'Jūs jau esate užsiregistravę į šią konferenciją!');
        }

        ConferenceRegistration::create([
            'conference_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'registered_at' => Carbon::now(),
            'status' => 'confirmed'
        ]);

        return redirect()->route('conferences.show', $id)
            ->with('success', 'Sėkmingai užsiregistravote į konferenciją!');
    }
}
