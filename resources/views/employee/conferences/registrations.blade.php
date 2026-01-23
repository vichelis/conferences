<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konferencijos registracijos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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

                    <div class="mt-3">
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
