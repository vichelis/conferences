<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $conference['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #8e9aaf 0%, #cbc0d3 100%);
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            background: rgba(125, 132, 113, 0.9) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        h1 {
            color: white;
            text-align: center;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #7d8471, #a8b5a0);
            border: none;
        }

        .btn-info {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
        }

        .btn-secondary {
            background: linear-gradient(45deg, #8e9aaf, #cbc0d3);
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
        }

        .breadcrumb-item a {
            color: white;
        }

        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('employee.dashboard') }}">Darbuotojo skydelis</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('employee.conferences') }}">Konferencijos</a>
            <a class="nav-link" href="{{ route('employee.dashboard') }}">Dashboard</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.conferences') }}">Konferencijos</a></li>
                    <li class="breadcrumb-item active">{{ $conference['title'] }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-dark">{{ $conference['title'] }}</h2>
                    <p class="card-text">{{ $conference['description'] }}</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6>Konferencijos informacija</h6>
                            <p><strong>Data:</strong> {{ $conference['date'] }}</p>
                            <p><strong>Vieta:</strong> {{ $conference['location'] }}</p>
                            <p><strong>Statusas:</strong>
                                @if($conference['status'] == 'upcoming')
                                    <span class="badge bg-success">Planuojama</span>
                                @else
                                    <span class="badge bg-secondary">Įvykusi</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Darbuotojo veiksmai</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('employee.conferences.registrations', $conference['id']) }}" class="btn btn-primary">
                            Peržiūrėti registracijas
                        </a>
                        <button class="btn btn-info">Eksportuoti duomenis</button>
                        <button class="btn btn-secondary">Spausdinti ataskaitą</button>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            <strong>Pastaba:</strong> Darbuotojai gali tik peržiūrėti informaciją, bet negali redaguoti.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
