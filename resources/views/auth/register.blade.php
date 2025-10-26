@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark-red text-white py-3">
                    <h4 class="fw-bold mb-0 text-center text-white">{{ __('Inscription') }}</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">{{ __('Nom') }}</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">{{ __('Adresse Email') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Mot de passe') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">

                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-bold">{{ __('Confirmer le mot de passe') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-dark-red btn-lg py-3 fw-bold">
                                <i class="bi bi-person-plus me-2"></i>{{ __('S\'inscrire') }}
                            </button>
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
        --secondary: #F77F00; 
        --light: #F8F7F2; 
        --dark: #2D3047; 
        --gray: #6D7275; 
    }

    body {
        background-color: white;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: var(--primary);
        color: white;
        padding: 1.5rem;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-body {
        padding: 2.5rem;
        background-color: white;
    }

    .form-label {
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #F77F00;
        box-shadow: 0 0 0 0.2rem rgba(193, 18, 31, 0.25);
    }

    .form-control-lg {
        padding: 1rem 1.5rem;
    }

    .btn-dark-red {
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 1rem;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .btn-dark-red:hover {
        background-color: #A0101A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
    }

    .invalid-feedback {
        color: var(--primary);
        font-weight: 500;
        margin-top: 0.5rem;
    }

    .bi-person-plus {
        font-size: 1.2rem;
        vertical-align: middle;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }

    .is-invalid {
        animation: shake 0.4s ease;
    }

    .container.py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .card-header {
            padding: 1rem;
            font-size: 1.3rem;
        }
    }
</style>
@endsection