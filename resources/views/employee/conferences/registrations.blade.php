<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijos registracijos</title>
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

        .table {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
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
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee.conferences') }}">Konferencijos</a></li>
                    <li class="breadcrumb-item active">{{ $conference['title'] }} - Registracijos</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Registracijos: {{ $conference['title'] }}</h5>
                    <small class="text-muted">Data: {{ $conference['date'] }}</small>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vardas, pavardė</th>
                            <th>El. paštas</th>
                            <th>Registracijos data</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($registrations as $registration)
                            <tr>
                                <td>{{ $registration['id'] }}</td>
                                <td>{{ $registration['name'] }}</td>
                                <td>{{ $registration['email'] }}</td>
                                <td>{{ $registration['registered_at'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3 p-3" style="background: rgba(125, 132, 113, 0.1); border-radius: 10px;">
                        <strong>Iš viso registracijų: {{ count($registrations) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
