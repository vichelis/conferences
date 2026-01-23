<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        // Sample stats for employee dashboard
        $totalConferences = 5;
        $upcomingConferences = 3;
        $totalRegistrations = 45;

        return view('employee.dashboard', compact('totalConferences', 'upcomingConferences', 'totalRegistrations'));
    }

    public function conferences()
    {
        // Sample conference data with status
        $conferences = [
            1 => [
                'id' => 1,
                'title' => 'Tech Conference 2024',
                'date' => '2024-03-15',
                'location' => 'Vilnius, Lithuania',
                'status' => 'upcoming',
                'registrations_count' => 15
            ],
            2 => [
                'id' => 2,
                'title' => 'Business Summit',
                'date' => '2024-01-20',
                'location' => 'Kaunas, Lithuania',
                'status' => 'completed',
                'registrations_count' => 25
            ],
            3 => [
                'id' => 3,
                'title' => 'Digital Marketing Expo',
                'date' => '2024-05-10',
                'location' => 'Klaipėda, Lithuania',
                'status' => 'upcoming',
                'registrations_count' => 8
            ]
        ];

        return view('employee.conferences', compact('conferences'));
    }

    public function showConference($id)
    {
        // Sample conference data
        $conference = [
            'id' => $id,
            'title' => 'Tech Conference 2024',
            'date' => '2024-03-15',
            'location' => 'Vilnius, Lithuania',
            'description' => 'Annual technology conference',
            'status' => 'upcoming'
        ];

        return view('employee.conferences.show', compact('conference'));
    }

    public function registrations($id)
    {
        // Sample registration data
        $conference = [
            'id' => $id,
            'title' => 'Tech Conference 2024',
            'date' => '2024-03-15'
        ];

        $registrations = [
            ['id' => 1, 'name' => 'Jonas Jonaitis', 'email' => 'jonas@example.com', 'registered_at' => '2024-01-15'],
            ['id' => 2, 'name' => 'Petras Petraitis', 'email' => 'petras@example.com', 'registered_at' => '2024-01-16'],
            ['id' => 3, 'name' => 'Ana Anaitė', 'email' => 'ana@example.com', 'registered_at' => '2024-01-17']
        ];

        return view('employee.conferences.registrations', compact('conference', 'registrations'));
    }
}
