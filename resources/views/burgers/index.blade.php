@extends('layouts.app')

@section('title', 'BurgerShop - Accueil')

@section('styles')
<style>
    /* Styles spécifiques à la page d'accueil */
    .hero-section {
        position: relative;
        height: 100vh;
        min-height: 800px;
        display: flex;
        align-items: center;
        overflow: hidden;
        margin-top: calc(-1 * var(--nav-height));
        padding-top: var(--nav-height));
    }

    .hero-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }
    .feature-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(var(--primary-rgb), 0.1);
        border-radius: 50%;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        font-size: 2rem;
    }

    .menu-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        
        
    }

    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .menu-card-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .menu-card:hover .menu-card-img {
        transform: scale(1.05);
    }

    .menu-card-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
    }

    .testimonial-card {
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: 100%;
        position: relative;
        background-color: var(--white);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .testimonial-card:before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 5rem;
        color: rgba(var(--primary-rgb), 0.1);
        font-family: 'Playfair Display', serif;
        line-height: 1;
    }

    .testimonial-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--accent-color);
    }

    .rating {
        color: var(--accent-color);
    }

    .parallax-section {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        padding: 100px 0;
    }

    .parallax-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(var(--dark-rgb), 0.8);
    }

    .counter-item {
        text-align: center;
        padding: 2rem;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .counter-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
    }

    .counter-text {
        color: var(--light-color);
        font-weight: 500;
    }

    /* Animation classes */
    .animate-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .animate-up.animated {
        opacity: 1;
        transform: translateY(0);
    }

    .animate-delay-1 {
        transition-delay: 0.2s;
    }

    .animate-delay-2 {
        transition-delay: 0.4s;
    }

    .animate-delay-3 {
        transition-delay: 0.6s;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .hero-section {
            min-height: 700px;
        }
    }

    @media (max-width: 768px) {
        .hero-section {
            min-height: 600px;
        }
        
        .display-3 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 576px) {
        .hero-section {
            min-height: 500px;
        }
        
        .display-3 {
            font-size: 2rem;
        }
    }
    /* Localisation Section Styles */
    #localisation iframe {
        min-height: 450px;
        border-radius: 12px;
    }

    #localisation .card {
        transition: transform 0.3s ease;
    }

    #localisation .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <video autoplay muted loop class="hero-video">
            <source src="{{ asset('videos/burger-hero.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-3 fw-bold text-white mb-4">Des Burgers Artisanaux Exquis</h1>
                    <p class="lead text-white mb-5">Découvrez des saveurs uniques préparées avec des ingrédients frais et locaux</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#menu" class="btn btn-primary btn-lg px-4 py-3" style="font-size: 1.1rem;">Notre Menu</a>
                        <a href="{{ route('burgers.custom') }}" class="btn btn-outline-light btn-lg px-4 py-3">Créer Votre Burger</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4 animate-up">
                    <div class="text-center p-4">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h3 class="h4 mb-3">Ingrédients Premium</h3>
                        <p class="text-muted mb-0">Nous sélectionnons uniquement les meilleurs ingrédients locaux et biologiques pour une qualité exceptionnelle.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-up animate-delay-1">
                    <div class="text-center p-4">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-cup-hot-fill"></i>
                        </div>
                        <h3 class="h4 mb-3">Recettes Maison</h3>
                        <p class="text-muted mb-0">Nos sauces et pains sont préparés quotidiennement selon nos recettes secrètes.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-up animate-delay-2">
                    <div class="text-center p-4">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3 class="h4 mb-3">Livraison Rapide</h3>
                        <p class="text-muted mb-0">Commandez avant 19h et recevez votre repas en moins de 30 minutes ou il est gratuit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-bold">Notre Menu Signature</h2>
                <p class="text-muted">Découvrez nos créations uniques élaborées par nos chefs</p>
            </div>

            <div class="row g-4">
                @foreach($burgers as $burger)
                <div class="col-lg-4 col-md-6">
                    <div class="menu-card">
                        <div class="position-relative overflow-hidden">
                            <img src="{{ $burger->image_url }}" 
                                alt="{{ $burger->name }}"
                                class="img-fluid menu-card-img"
                                onerror="this.onerror=null;this.src='{{ asset('images/default-burger.jpg') }}'">
                            <div class="menu-card-badge">€ {{ number_format($burger->base_price, 2) }}</div>
                        </div>
                        <div class="card-body" style="padding: 5px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">{{ $burger->name }}</h5>
                                <div class="rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="bi bi-star{{ $i < $burger->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="card-text text-muted mb-4">{{ $burger->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @foreach($burger->ingredients->take(3) as $ingredient)
                                        <span class="badge bg-light text-dark border me-1">{{ $ingredient->name }}</span>
                                    @endforeach
                                    @if($burger->ingredients->count() > 3)
                                        <span class="badge bg-light text-dark border">+{{ $burger->ingredients->count() - 3 }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('burgers.show', $burger) }}" class="btn btn-sm btn-primary rounded-pill px-2 my-2">
                                     Ajouter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('burgers.custom') }}" class="btn btn-secondary btn-lg px-5 py-3">
                    <i class="bi bi-magic me-2"></i> Créer Votre Burger Sur Mesure
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 bg-dark text-white">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate-up">
                    <h2 class="section-title display-5 fw-bold">Notre Histoire</h2>
                    <p class="lead mb-4">Depuis 2010, nous redéfinissons l'art du burger avec passion et créativité.</p>
                    <p>Fondé par deux amis passionnés de gastronomie, BurgerShop est né de l'envie de réinventer le burger traditionnel en y apportant des touches innovantes et des ingrédients d'exception.</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-check2-circle text-primary fs-4 me-3"></i>
                                <span>Produits frais</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-check2-circle text-primary fs-4 me-3"></i>
                                <span>Viandes françaises</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-check2-circle text-primary fs-4 me-3"></i>
                                <span>Pain artisanal</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-check2-circle text-primary fs-4 me-3"></i>
                                <span>Sauces maison</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 animate-up animate-delay-1">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" 
                             alt="Notre équipe" 
                             class="img-fluid rounded-3 shadow">
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white p-3 m-3 rounded">
                            <h4 class="mb-0">12+</h4>
                            <small>Ans d'expérience</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-bold">Ce Que Disent Nos Clients</h2>
                <p class="text-muted">Découvrez les avis de nos clients satisfaits</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card animate-up">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Client" class="testimonial-img me-3">
                            <div>
                                <h5 class="mb-1">Sophie Martin</h5>
                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Les meilleurs burgers que j'ai jamais mangés ! Les ingrédients sont toujours frais et les combinaisons de saveurs sont incroyables."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card animate-up animate-delay-1">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Client" class="testimonial-img me-3">
                            <div>
                                <h5 class="mb-1">Thomas Leroy</h5>
                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Service impeccable et burgers délicieux. J'ai particulièrement apprécié la possibilité de personnaliser mon burger exactement comme je le voulais."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card animate-up animate-delay-2">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="testimonial-img me-3">
                            <div>
                                <h5 class="mb-1">Émilie Dubois</h5>
                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Enfin un burger gourmet qui vaut son prix ! Les portions sont généreuses et la qualité est au rendez-vous. Le burger végétarien est aussi excellent."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="parallax-section" style="background-image: url('https://images.unsplash.com/photo-1512152272829-e3139592d56f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');">
        <div class="parallax-overlay"></div>
        <div class="container py-5">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="counter-item animate-up">
                        <div class="counter-number">2500+</div>
                        <div class="counter-text">Clients Satisfaits</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-item animate-up animate-delay-1">
                        <div class="counter-number">12+</div>
                        <div class="counter-text">Ans d'Expérience</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-item animate-up animate-delay-2">
                        <div class="counter-number">50+</div>
                        <div class="counter-text">Burgers Uniques</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-item animate-up animate-delay-3">
                        <div class="counter-number">98%</div>
                        <div class="counter-text">Retours Positifs</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Localisation Section -->
<section id="localisation" class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="section-title display-5 fw-bold">Nous Trouver à Beni Mellal</h2>
            <p class="text-muted">Venez découvrir nos burgers artisanaux dans notre établissement</p>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-lg-6 animate-up">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <!-- Carte Google Maps -->
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3393.071521362543!2d-6.373323924019669!3d32.33727327395336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda3864a95f304f3%3A0xdad64fa8aed9e29!2sBeni%20Mellal%2C%20Maroc!5e0!3m2!1sfr!2sfr!4v1717699993727!5m2!1sfr!2sfr" 
                            width="100%" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="d-block"
                            title="Localisation BurgerShop Beni Mellal">
                        </iframe>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 animate-up animate-delay-1">
                <div class="ps-lg-5">
                    <h3 class="h4 mb-3 text-primary">BurgerShop Beni Mellal</h3>
                    <p class="mb-4">Nous sommes situés au cœur de Beni Mellal, prêts à vous servir les meilleurs burgers de la région.</p>
                    
                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary">
                            <i class="bi bi-geo-alt-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="h6 mb-1">Adresse</h5>
                            <p class="mb-0">123 Avenue Mohammed V, Beni Mellal, Maroc</p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary">
                            <i class="bi bi-clock-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="h6 mb-1">Horaires d'ouverture</h5>
                            <p class="mb-0">
                                Lundi - Vendredi: 11h - 23h<br>
                                Samedi - Dimanche: 11h - Minuit
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="me-3 text-primary">
                            <i class="bi bi-telephone-fill fs-4"></i>
                        </div>
                        <div>
                            <h5 class="h6 mb-1">Téléphone</h5>
                            <p class="mb-0">+212 5 23 48 56 79</p>
                        </div>
                    </div>
                    
                    <a href="https://maps.google.com?q=32.337273,-6.373324" 
                       target="_blank" 
                       class="btn btn-primary mt-3">
                        <i class="bi bi-arrow-up-right-circle me-2"></i> Itinéraire
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Animation on scroll
    function animateOnScroll() {
        const elements = document.querySelectorAll('.animate-up, .animate-delay-1, .animate-delay-2, .animate-delay-3');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if (elementPosition < screenPosition) {
                element.classList.add('animated');
            }
        });
    }

    window.addEventListener('scroll', animateOnScroll);
    window.addEventListener('load', animateOnScroll);
</script>
@endsection