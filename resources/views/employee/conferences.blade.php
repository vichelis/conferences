<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijų sąrašas</title>
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
        }

        .btn-info {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
        }

        .btn-primary {
            background: linear-gradient(45deg, #7d8471, #a8b5a0);
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .table {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .badge {
            font-size: 0.8em;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('employee.dashboard') }}">Darbuotojo skydelis</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ route('employee.dashboard') }}">Skydelis</a>
            <a class="nav-link" href="{{ url('/') }}">Atgal į svetainę</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Konferencijų sąrašas</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Pavadinimas</th>
                            <th>Data</th>
                            <th>Vieta</th>
                            <th>Statusas</th>
                            <th>Registracijos</th>
                            <th>Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($conferences as $conference)
                            <tr>
                                <td>{{ $conference['title'] }}</td>
                                <td>{{ $conference['date'] }}</td>
                                <td>{{ $conference['location'] }}</td>
                                <td>
                                    @if($conference['status'] == 'upcoming')
                                        <span class="badge bg-success">Planuojama</span>
                                    @else
                                        <span class="badge bg-secondary">Įvykusi</span>
                                    @endif
                                </td>
                                <td>{{ $conference['registrations_count'] }}</td>
                                <td>
                                    <a href="{{ route('employee.conferences.show', $conference['id']) }}" class="btn btn-sm btn-info">Peržiūrėti</a>
                                    <a href="{{ route('employee.conferences.registrations', $conference['id']) }}" class="btn btn-sm btn-primary">Registracijos</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
