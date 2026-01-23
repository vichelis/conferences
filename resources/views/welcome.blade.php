<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijų peržiūros sistema</title>

    @vite(['resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #8e9aaf 0%, #cbc0d3 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
        }

        .hero-section {
            padding: 40px 0;
            text-align: center;
            color: white;
        }

        .logo-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(10px);
            margin-bottom: 40px;
            display: inline-block;
        }

        .student-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin-top: 0px;
        }

        .role-btn {
            padding: 12px 25px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            margin: 5px 0;
        }

        .role-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .client-btn {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            color: white;
        }

        .employee-btn {
            background: linear-gradient(45deg, #7d8471, #a8b5a0);
            color: white;
        }

        .admin-btn {
            background: linear-gradient(45deg, #b5838d, #d4a574);
            color: white;
        }

        .time-display {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="hero-section">
        <div class="container">
            <div class="logo-container">
                <svg viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg" style="height: 80px; width: auto;">
                    <rect x="10" y="35" width="80" height="20" rx="4" fill="white"/>

                    <rect x="15" y="25" width="8" height="12" rx="2" fill="white"/>
                    <rect x="30" y="25" width="8" height="12" rx="2" fill="white"/>
                    <rect x="45" y="25" width="8" height="12" rx="2" fill="white"/>
                    <rect x="60" y="25" width="8" height="12" rx="2" fill="white"/>
                    <rect x="75" y="25" width="8" height="12" rx="2" fill="white"/>

                    <rect x="16" y="20" width="6" height="8" rx="1" fill="white"/>
                    <rect x="31" y="20" width="6" height="8" rx="1" fill="white"/>
                    <rect x="46" y="20" width="6" height="8" rx="1" fill="white"/>
                    <rect x="61" y="20" width="6" height="8" rx="1" fill="white"/>
                    <rect x="76" y="20" width="6" height="8" rx="1" fill="white"/>
                </svg>

                <div id="time-output" class="time-display"></div>
            </div>

            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 20px;">Konferencijų peržiūros sistema</h1>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="student-card text-center">
                    <h3 style="color: #2c3e50; font-weight: 700; margin-bottom: 20px;"> Studento informacija</h3>

                    <div style="margin-bottom: 40px;">
                        <p style="font-size: 18px; color: #34495e; margin-bottom: 20px;">
                            <strong>Darbą atliko:</strong> Arnas Nagys
                        </p>
                        <p style="font-size: 18px; color: #34495e;">
                            <strong>Grupė:</strong> PIT-22-I-NT
                        </p>
                    </div>

                    <h4 style="color: #2c3e50; font-weight: 600; margin-bottom: 25px;"> Sistemos vaidmenys</h4>

                    <div class="d-grid gap-3">
                        <a href="{{ route('conferences.index') }}" class="role-btn client-btn">
                             Klientas
                        </a>
                        <a href="{{ url('/employee') }}" class="role-btn employee-btn">
                             Darbuotojas
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="role-btn admin-btn">
                             Administratorius
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
