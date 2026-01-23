<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $conference['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                    <h1 class="card-title">{{ $conference['title'] }}</h1>
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
