@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <h3 class="text-center text-white mb-0">{{ __('Connexion') }}</h3>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">{{ __('Adresse Email') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="votre@email.com">

                            @error('email')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Mot de passe') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   placeholder="••••••••">

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Se souvenir de moi') }}
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Connexion') }}
                            </button>
                        </div>

                        <div class="text-center pt-3">
                            <p class="mb-0">Pas encore de compte ? <a href="{{ route('register') }}" class="fw-bold text-decoration-none">{{ __('Créer un compte') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    :root {
        --primary: #C1121F; 
        --primary-light: rgba(193, 18, 31, 0.1);
        --secondary: #F77F00; 
        --dark: #2D3047; 
        --light: #F8F7F2; 
        --gray: #6D7275; 
    }
    body {
        background-color: white;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary), #D62839);
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-bottom: none;
        font-size: 1.25rem;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(193, 18, 31, 0.15);
    }

    .form-control-lg {
        padding: 1rem 1.5rem;
    }

    .btn-primary {
        background-color: var(--primary);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #A0101A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
    }

    .btn-lg {
        padding: 1rem;
        font-size: 1.1rem;
    }

    .invalid-feedback {
        color: var(--primary);
        font-weight: 500;
        margin-top: 0.5rem;
    }

    a {
        color: var(--primary);
        transition: color 0.2s ease;
    }

    a:hover {
        color: var(--secondary);
        text-decoration: underline;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(193, 18, 31, 0.25);
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }

    .is-invalid {
        animation: shake 0.4s ease;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 2rem;
        }
        
        .card-header {
            padding: 1.5rem;
        }
    }
</style>
@endsection
