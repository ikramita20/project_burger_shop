<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="BurgerShop - Les meilleurs burgers artisanaux de Paris">
    <title>BurgerShop - @yield('title', 'Accueil')</title>
    
    <link rel="icon" href="{{ asset('burgersite.ico') }}" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        :root {
            --primary-color: #E63946;
            --primary-dark: #C1121F;
            --secondary-color: #F77F00;
            --secondary-dark: #E36414;
            --accent-color: #FCBF49;
            --dark-color: #1D3557;
            --light-color: #F1FAEE;
            --white: #FFFFFF;
            --black: #212529;
            --gray: #6C757D;
            --light-gray: #F8F9FA;
            
            --nav-height: 80px;
            --nav-height-mobile: 70px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--black);
            overflow-x: hidden;
            padding-top: var(--nav-height);
            background-color: var(--light-color);
        }

        h1, h2, h3, h4, h5, .display-font {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
        }

        /* ========= NAVIGATION ========= */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0;
            height: var(--nav-height);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
        }

        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            margin-right: 2rem;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover img {
            transform: rotate(15deg);
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            color: var(--black) !important;
            position: relative;
            font-size: 0.95rem;
            margin: 0 0.3rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(230, 57, 70, 0.05);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        .nav-link.active:after {
            content: '';
            position: absolute;
            width: 70%;
            height: 2px;
            bottom: 5px;
            left: 15%;
            background-color: var(--primary-color);
        }

        /* Boutons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.25);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 57, 70, 0.25);
        }

        .cart-icon {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            background-color: rgba(230, 57, 70, 0.1);
        }

        .cart-badge {
            font-size: 0.65rem;
            top: 2px !important;
            right: 2px !important;
            padding: 0.35em 0.5em;
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            font-size: 1.25rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding-top: 5rem;
            padding-bottom: 2rem;
        }

        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .footer-links h5 {
            color: var(--white);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
            font-size: 1.1rem;
        }

        .footer-links h5:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary-color);
        }

        .footer-links ul {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }

        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 992px) {
            .navbar-collapse {
                background-color: var(--white);
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 8px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .nav-item {
                margin: 0.25rem 0;
            }
            
            .nav-link {
                padding: 0.5rem 1rem !important;
                margin: 0;
            }
            
            .nav-link.active:after {
                display: none;
            }
        }

        @media (max-width: 768px) {
            :root {
                --nav-height: var(--nav-height-mobile);
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }
            
            .navbar-brand img {
                height: 35px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.3rem;
                margin-right: 1rem;
            }
            
            .navbar-brand img {
                height: 30px;
                margin-right: 8px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/burgers/burger-logo.png') }}" alt="BurgerShop Logo">
                BurgerShop
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Avis</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#localisation">Localisation</a>
                    </li>
                    
                </ul>
                
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-2">
                        <a class="nav-link cart-icon" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3"></i>
                            @if(count(session('cart', [])) > 0)
                                <span class="position-absolute translate-middle badge rounded-pill bg-primary cart-badge">
                                    {{ count(session('cart', [])) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    
                    @guest
                        <li class="nav-item me-2">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ Str::limit(Auth::user()->name, 15) }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @include('partials.alerts')
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="{{ route('home') }}" class="footer-logo d-flex align-items-center">
                        <img src="{{ asset('images/burgers/burger-logo.png') }}" alt="BurgerShop Logo" height="40" class="me-2">
                        BurgerShop
                    </a>
                    <p class="text-muted mb-4">Depuis 2010, nous créons des burgers gourmets avec des ingrédients frais et locaux pour une expérience culinaire unique.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-twitter-x fs-5"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-tiktok fs-5"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h5>Navigation</h5>
                        <ul>
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="#menu">Menu</a></li>
                            <li><a href="#about">À propos</a></li>
                            <li><a href="#testimonials">Avis</a></li>
                            <li><a href="#localisation">localisation</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <div class="footer-links">
                        <h5>Légal</h5>
                        <ul>
                            <li><a href="#">CGV</a></li>
                            <li><a href="#">Mentions légales</a></li>
                            <li><a href="#">Politique de confidentialité</a></li>
                            <li><a href="#">Cookies</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="footer-links">
                        <h5>Newsletter</h5>
                        <div class="mt-4">
                            <h6>Nous trouver</h6>
                            <p class="small text-muted mb-1">12 Rue du safae, 23000 beni mellal</p>
                            <p class="small text-muted">Ouvert 7j/7 de 11h à 23h</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-5 border-secondary">
            
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0 text-muted small">&copy; {{ date('Y') }} BurgerShop. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-muted small">
                        Made with <i class="bi bi-heart-fill text-danger"></i> in Morocco
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top btn btn-primary btn-sm rounded-circle shadow">
        <i class="bi bi-arrow-up"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        const backToTop = document.querySelector('.back-to-top');
        window.addEventListener('scroll', function() {
            backToTop.classList.toggle('active', window.scrollY > 300);
        });
        
        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>