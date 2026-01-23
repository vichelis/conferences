<?php
// conferences/database/seeders/ConferenceSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subsystem;
use App\Models\Conference;
use App\Models\ConferenceSpeaker;
use App\Models\ConferenceRegistration;
use Carbon\Carbon;

class ConferenceSeeder extends Seeder
{
    public function run()
    {
        // Create subsystems
        $subsystems = [
            [
                'name' => 'Technologijos',
                'code' => 'TECH',
                'description' => 'Technologijų ir IT konferencijos',
                'color' => '#6c7b95'
            ],
            [
                'name' => 'Verslas',
                'code' => 'BIZ',
                'description' => 'Verslo ir vadybos konferencijos',
                'color' => '#7d8471'
            ],
            [
                'name' => 'Marketingas',
                'code' => 'MKT',
                'description' => 'Marketingo ir reklamos konferencijos',
                'color' => '#b5838d'
            ],
            [
                'name' => 'Švietimas',
                'code' => 'EDU',
                'description' => 'Švietimo ir mokymo konferencijos',
                'color' => '#d4a574'
            ]
        ];

        foreach ($subsystems as $subsystemData) {
            $subsystem = Subsystem::create($subsystemData);

            // Create conferences for each subsystem
            $conferences = [
                [
                    'title' => $subsystem->name . ' konferencija 2026',
                    'description' => 'Metinė ' . strtolower($subsystem->name) . ' konferencija su naujausiais sprendimais ir tendencijomis.',
                    'date' => '2026-03-15',
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'location' => 'Vilnius, Lietuva',
                    'address' => 'Gedimino pr. 9, Vilnius',
                    'price' => rand(40, 100),
                    'capacity' => rand(100, 300),
                    'status' => 'published'
                ],
                [
                    'title' => $subsystem->name . ' seminaras',
                    'description' => 'Praktinis seminaras ' . strtolower($subsystem->name) . ' srityje su geriausiais ekspertais.',
                    'date' => '2026-05-20',
                    'start_time' => '10:00',
                    'end_time' => '16:00',
                    'location' => 'Kaunas, Lietuva',
                    'address' => 'Laisvės al. 53, Kaunas',
                    'price' => rand(25, 75),
                    'capacity' => rand(50, 150),
                    'status' => 'published'
                ]
            ];

            foreach ($conferences as $conferenceData) {
                $conferenceData['subsystem_id'] = $subsystem->id;
                $conference = Conference::create($conferenceData);

                // Add speakers
                $speakers = [
                    [
                        'name' => 'Jonas Jonaitis',
                        'title' => $subsystem->name . ' ekspertas',
                        'bio' => '10+ metų patirtis ' . strtolower($subsystem->name) . ' srityje'
                    ],
                    [
                        'name' => 'Petras Petraitis',
                        'title' => 'Vadovaujantis specialistas',
                        'bio' => 'Tarptautinės patirties specialistas su daugiau nei 15 metų darbo patirtimi'
                    ]
                ];

                foreach ($speakers as $speakerData) {
                    $speakerData['conference_id'] = $conference->id;
                    ConferenceSpeaker::create($speakerData);
                }

                // Add some sample registrations
                for ($i = 1; $i <= rand(5, 15); $i++) {
                    ConferenceRegistration::create([
                        'conference_id' => $conference->id,
                        'name' => 'Vardas' . $i . ' Pavardė' . $i,
                        'email' => 'vardas' . $i . '@example.com',
                        'registered_at' => Carbon::now()->subDays(rand(1, 30)),
                        'status' => 'confirmed'
                    ]);
                }
            }
        }
    }
}
