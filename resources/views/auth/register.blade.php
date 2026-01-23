<!-- conferences/resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Registracija')
@section('navbar-brand', 'Registracija')
@section('navbar-brand-url', url('/'))
@section('navbar-class', 'navbar-client')

@section('navbar-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Pradžia</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('conferences.index') }}">Konferencijos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Prisijungti</a>
    </li>
@endsection

@push('styles')
    <style>
        .navbar-client {
            background: rgba(108, 123, 149, 0.9) !important;
        }
        .registration-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        .form-control:focus {
            border-color: #6c7b95;
            box-shadow: 0 0 0 0.2rem rgba(108, 123, 149, 0.25);
        }
        .btn-primary {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
        }
        .btn-outline-secondary {
            border-color: #6c7b95;
            color: #6c7b95;
            border-radius: 25px;
            padding: 12px 30px;
        }
        .btn-outline-secondary:hover {
            background-color: #6c7b95;
            border-color: #6c7b95;
        }
        .password-requirements {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .step.active {
            background: linear-gradient(45deg, #6c7b95, #8e9aaf);
            color: white;
        }
        .step.inactive {
            background: #e9ecef;
            color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="registration-card p-5">
                    <div class="text-center mb-4">
                        <h2 class="mb-3">Sukurti paskyrą</h2>
                        <p class="text-muted">Užsiregistruokite ir dalyvaukite konferencijose</p>
                    </div>

                    <!-- Step Indicator -->
                    <div class="step-indicator">
                        <div class="step active">1</div>
                        <div class="step inactive">2</div>
                    </div>

                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf

                        <!-- Step 1: Basic Information -->
                        <div class="step-content" id="step1">
                            <h4 class="mb-4">Pagrindinė informacija</h4>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Vardas ir pavardė *</label>
                                    <input type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           required
                                           placeholder="Įveskite vardą ir pavardę">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">El. pašto adresas *</label>
                                    <input type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           placeholder="vardas@example.com">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telefono numeris</label>
                                    <input type="tel"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           placeholder="+370 600 00000">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Slaptažodis *</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           required>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="password-requirements mt-1">
                                        Mažiausiai 8 simboliai
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Pakartoti slaptažodį *</label>
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary" onclick="nextStep()">
                                    Toliau <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Additional Information -->
                        <div class="step-content d-none" id="step2">
                            <h4 class="mb-4">Papildoma informacija</h4>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="birth_date" class="form-label">Gimimo data</label>
                                    <input type="date"
                                           class="form-control @error('birth_date') is-invalid @enderror"
                                           id="birth_date"
                                           name="birth_date"
                                           value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Lytis</label>
                                    <select class="form-control @error('gender') is-invalid @enderror"
                                            id="gender"
                                            name="gender">
                                        <option value="">Pasirinkite</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Vyras</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Moteris</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Kita</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="city" class="form-label">Miestas</label>
                                    <input type="text"
                                           class="form-control @error('city') is-invalid @enderror"
                                           id="city"
                                           name="city"
                                           value="{{ old('city') }}"
                                           placeholder="Jūsų gyvenamasis miestas">
                                    @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="bio" class="form-label">Trumpas aprašymas</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror"
                                              id="bio"
                                              name="bio"
                                              rows="3"
                                              placeholder="Papasakokite trumpai apie save, savo interesus ar veiklą...">{{ old('bio') }}</textarea>
                                    @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimaliai 1000 simbolių</div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror"
                                               type="checkbox"
                                               id="terms"
                                               name="terms"
                                               value="1"
                                               {{ old('terms') ? 'checked' : '' }}
                                               required>
                                        <label class="form-check-label" for="terms">
                                            Sutinku su <a href="#" target="_blank">naudojimo sąlygomis</a> ir
                                            <a href="#" target="_blank">privatumo politika</a> *
                                        </label>
                                        @error('terms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" onclick="prevStep()">
                                    <i class="fas fa-arrow-left me-2"></i> Atgal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i> Sukurti paskyrą
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted">
                            Jau turite paskyrą?
                            <a href="{{ route('login') }}" class="text-decoration-none">Prisijunkite čia</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function nextStep() {
            // Validate step 1 fields
            const requiredFields = ['name', 'email', 'password', 'password_confirmation'];
            let isValid = true;

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            // Check password confirmation
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                document.getElementById('password_confirmation').classList.add('is-invalid');
                isValid = false;
            }

            if (isValid) {
                document.getElementById('step1').classList.add('d-none');
                document.getElementById('step2').classList.remove('d-none');

                // Update step indicator
                document.querySelector('.step.active').classList.remove('active');
                document.querySelector('.step.active').classList.add('inactive');
                document.querySelectorAll('.step')[1].classList.add('active');
                document.querySelectorAll('.step')[1].classList.remove('inactive');
            }
        }

        function prevStep() {
            document.getElementById('step2').classList.add('d-none');
            document.getElementById('step1').classList.remove('d-none');

            // Update step indicator
            document.querySelector('.step.active').classList.remove('active');
            document.querySelector('.step.active').classList.add('inactive');
            document.querySelectorAll('.step')[0].classList.add('active');
            document.querySelectorAll('.step')[0].classList.remove('inactive');
        }

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;

            if (password !== confirmation && confirmation.length > 0) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    </script>
@endpush
