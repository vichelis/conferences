<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = [
            [
                'id' => 1,
                'title' => 'Tech Conference 2024',
                'date' => '2024-03-15',
                'location' => 'Vilnius, Lithuania',
                'description' => 'Annual technology conference featuring latest innovations.'
            ],
            [
                'id' => 2,
                'title' => 'Business Summit',
                'date' => '2024-04-20',
                'location' => 'Kaunas, Lithuania',
                'description' => 'Leading business professionals sharing insights.'
            ],
            [
                'id' => 3,
                'title' => 'Digital Marketing Expo',
                'date' => '2024-05-10',
                'location' => 'Klaipėda, Lithuania',
                'description' => 'Explore the future of digital marketing strategies.'
            ]
        ];

        return view('conferences.index', compact('conferences'));
    }
    public function show($id)
    {
        $conferences = [
            1 => [
                'id' => 1,
                'title' => 'Tech Conference 2024',
                'date' => '2024-03-15',
                'time' => '09:00 - 17:00',
                'location' => 'Vilnius, Lithuania',
                'address' => 'Gedimino pr. 9, Vilnius',
                'description' => 'Annual technology conference featuring latest innovations in AI, blockchain, and web development.',
                'speakers' => ['John Doe', 'Jane Smith', 'Petras Petraitis'],
                'price' => '€50',
                'capacity' => 200
            ],
            2 => [
                'id' => 2,
                'title' => 'Business Summit',
                'date' => '2024-04-20',
                'time' => '10:00 - 16:00',
                'location' => 'Kaunas, Lithuania',
                'address' => 'Laisvės al. 53, Kaunas',
                'description' => 'Leading business professionals sharing insights on entrepreneurship and leadership.',
                'speakers' => ['Anna Kazlauskienė', 'Mindaugas Jonaitis'],
                'price' => '€75',
                'capacity' => 150
            ],
            3 => [
                'id' => 3,
                'title' => 'Digital Marketing Expo',
                'date' => '2024-05-10',
                'time' => '09:30 - 18:00',
                'location' => 'Klaipėda, Lithuania',
                'address' => 'Tiltų g. 1, Klaipėda',
                'description' => 'Explore the future of digital marketing strategies, social media trends, and analytics.',
                'speakers' => ['Sarah Johnson', 'Tomas Tomauskas', 'Maria Garcia'],
                'price' => '€60',
                'capacity' => 180
            ]
        ];

        $conference = $conferences[$id] ?? null;

        if (!$conference) {
            abort(404);
        }

        return view('conferences.show', compact('conference'));
    }

    public function create()
    {
        return view('conferences.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required',
            'capacity' => 'required|integer'
        ]);

        // Here you would save to database
        // For now, just redirect with success message
        return redirect()->route('conferences.index')->with('success', 'Konferencija sėkmingai sukurta!');
    }

    public function edit($id)
    {
        // Sample data - replace with database lookup
        $conferences = [
            1 => [
                'id' => 1,
                'title' => 'Tech Conference 2024',
                'date' => '2024-03-15',
                'time' => '09:00 - 17:00',
                'location' => 'Vilnius, Lithuania',
                'address' => 'Gedimino pr. 9, Vilnius',
                'description' => 'Annual technology conference featuring latest innovations.',
                'price' => '€50',
                'capacity' => 200
            ]
        ];

        $conference = $conferences[$id] ?? null;

        if (!$conference) {
            abort(404);
        }

        return view('conferences.edit', compact('conference'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required',
            'capacity' => 'required|integer'
        ]);

        // Here you would update in database
        return redirect()->route('conferences.show', $id)->with('success', 'Konferencija sėkmingai atnaujinta!');
    }

    public function destroy($id)
    {
        // Here you would delete from database
        return redirect()->route('conferences.index')->with('success', 'Konferencija sėkmingai ištrinta!');
    }


}
