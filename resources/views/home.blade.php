<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ktebloop - Partagez vos livres gratuitement</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #FFB823;
            --primary-light: #FFD166;
            --primary-dark: #E6A61F;
            --secondary: #0A400C;
            --secondary-light: #0F5A12;
            --secondary-dark: #083009;
            --white: #FFFFFF;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-500: #6B7280;
            --gray-700: #374151;
            --gray-900: #111827;
            --radius-sm: 0.5rem;
            --radius: 1rem;
            --radius-lg: 1.5rem;
            --radius-xl: 2rem;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--white);
            color: var(--gray-900);
            line-height: 1.6;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 80px;
        }

        /* typo*/
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.025em;
            line-height: 1.2;
        }

        h1 {
            font-size: 3.5rem;
        }

        h2 {
            font-size: 2.5rem;
        }

        h3 {
            font-size: 1.875rem;
        }

        p {
            color: var(--gray-700);
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .section-py {
            padding: 5rem 0;
        }

        /* navs*/
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 50;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(10, 64, 12, 0.08);
            transition: all 0.3s ease;
        }

        .nav-scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: var(--shadow-sm);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 5rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.125rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 0;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* btns*/
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border-radius: var(--radius);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--secondary);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--white);
            box-shadow: var(--shadow);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background: transparent;
            color: var(--secondary);
            border: 1.5px solid var(--secondary);
        }

        .btn-outline:hover {
            background: var(--secondary);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* hero*/
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 15% 50%, rgba(255, 184, 35, 0.1) 0%, transparent 25%),
                        radial-gradient(circle at 85% 30%, rgba(10, 64, 12, 0.05) 0%, transparent 25%);
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 184, 35, 0.1);
            color: var(--secondary);
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .hero-stats {
            display: flex;
            gap: 2rem;
        }

        .stat {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .stat-label {
            color: var(--gray-500);
            font-size: 0.875rem;
        }

        .hero-visual {
            position: relative;
        }

        .floating-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            padding: 1.5rem;
            position: relative;
            transform: rotate(3deg);
            transition: transform 0.5s ease;
        }

        .floating-card:hover {
            transform: rotate(0);
        }

        .floating-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: var(--radius-xl);
            padding: 2px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .feature-item {
            background: var(--gray-50);
            border-radius: var(--radius);
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--white);
            font-size: 1.25rem;
        }

        .feature-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 0.5rem;
        }

        .feature-description {
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element-1 {
            width: 6rem;
            height: 6rem;
            background: var(--primary);
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .floating-element-2 {
            width: 4rem;
            height: 4rem;
            background: var(--secondary);
            bottom: 20%;
            left: 5%;
            animation-delay: 2s;
        }

        /* features*/
        .features {
            background: var(--white);
        }

        .section-header {
            text-align: center;
            max-width: 48rem;
            margin: 0 auto 4rem;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(10, 64, 12, 0.1);
            color: var(--secondary);
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-title {
            margin-bottom: 1.5rem;
        }

        .section-description {
            font-size: 1.25rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card-icon {
            width: 5rem;
            height: 5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-card-icon {
            transform: scale(1.1);
        }

        .feature-card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }

        .feature-card-description {
            margin-bottom: 1.5rem;
        }

        .feature-list {
            text-align: left;
            list-style: none;
        }

        .feature-list-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            color: var(--gray-700);
        }

        .feature-list-item i {
            color: var(--primary);
        }

        /* CTA*/
        .cta {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 70%, rgba(255, 184, 35, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 70% 30%, rgba(255, 184, 35, 0.05) 0%, transparent 50%);
        }

        .cta-container {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 48rem;
        }

        .cta-title {
            color: var(--white);
            margin-bottom: 1.5rem;
        }

        .cta-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
        }

        .cta-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-cta-primary {
            background: var(--primary);
            color: var(--secondary);
        }

        .btn-cta-primary:hover {
            background: var(--white);
            transform: translateY(-2px);
        }

        .btn-cta-outline {
            background: transparent;
            color: var(--white);
            border: 1.5px solid var(--white);
        }

        .btn-cta-outline:hover {
            background: var(--white);
            color: var(--secondary);
            transform: translateY(-2px);
        }

        /* footer*/
        .footer {
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
        }

        .footer-container {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 3rem;
            padding: 4rem 0;
        }

        .footer-brand {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .footer-logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .footer-description {
            max-width: 24rem;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 2.5rem;
            height: 2.5rem;
            background: var(--secondary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary);
            color: var(--secondary);
            transform: translateY(-2px);
        }

        .footer-links-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-link {
            color: var(--gray-700);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid var(--gray-200);
            padding: 2rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-copyright {
            color: var(--gray-500);
        }

        .footer-heart {
            color: var(--primary);
        }

        /*animation*/
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.2s;
        }

        .delay-3 {
            animation-delay: 0.3s;
        }

        /*responsiveness*/
        @media (max-width: 1024px) {
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-container {
                grid-template-columns: 1fr 1fr;
            }
            
            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            h2 {
                font-size: 2rem;
            }
            
            .hero-actions, .cta-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
            }
            
            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- nav -->
    <nav class="nav" id="navbar">
        <div class="container nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <span class="logo-text">Ktebloop</span>
            </a>
            
            <div class="nav-links">
                <a href="#" class="nav-link">Accueil</a>
                <a href="#features" class="nav-link">Fonctionnalités</a>
                <a href="#" class="nav-link">À propos</a>
                <a href="#" class="nav-link">Contact</a>
            </div>
            
            <div class="nav-actions">
                <a href="#" class="btn btn-outline">Connexion</a>
                <a href="#" class="btn btn-primary">S'inscrire</a>
            </div>
        </div>
    </nav>

    <!-- hero -->
    <section class="hero section-py">
        <div class="container hero-container">
            <div class="hero-content fade-in">
                <div class="hero-badge">
                    <i class="fas fa-recycle"></i>
                    <span>Économie circulaire</span>
                </div>
                
                <h1 class="hero-title">
                    Donnez une seconde vie
                    <span class="text-gradient">à vos livres</span>
                </h1>
                
                <p class="hero-description">
                    Ktebloop connecte les amateurs de livres pour partager, échanger et découvrir 
                    de nouvelles lectures gratuitement. Rejoignez notre communauté écoresponsable.
                </p>

                <div class="hero-actions">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-rocket"></i>
                        <span>Commencer gratuitement</span>
                    </a>
                    <a href="#features" class="btn btn-outline">
                        <i class="fas fa-play-circle"></i>
                        <span>Découvrir</span>
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat">
                        <div class="stat-value">500+</div>
                        <div class="stat-label">Livres partagés</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">200+</div>
                        <div class="stat-label">Membres actifs</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">100%</div>
                        <div class="stat-label">Gratuit</div>
                    </div>
                </div>
            </div>

            <div class="hero-visual fade-in delay-1">
                <div class="floating-card">
                    <div class="feature-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h3 class="feature-title">Publier</h3>
                            <p class="feature-description">Partagez vos livres</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="feature-title">Découvrir</h3>
                            <p class="feature-description">Trouvez des livres</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3 class="feature-title">Échanger</h3>
                            <p class="feature-description">Rencontrez</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h3 class="feature-title">Recycler</h3>
                            <p class="feature-description">Protégez la planète</p>
                        </div>
                    </div>
                </div>
                
                <div class="floating-element floating-element-1"></div>
                <div class="floating-element floating-element-2"></div>
            </div>
        </div>
    </section>

    <!-- features -->
    <section id="features" class="features section-py">
        <div class="container">
            <div class="section-header fade-in">
                <div class="section-badge">
                    <i class="fas fa-star"></i>
                    <span>Pourquoi choisir Ktebloop ?</span>
                </div>
                <h2 class="section-title">
                    Une expérience de partage
                    <span class="text-gradient">unique</span>
                </h2>
                <p class="section-description">
                    Découvrez comment Ktebloop révolutionne le partage de livres avec une plateforme 
                    simple, sécurisée et écoresponsable.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-card-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h3 class="feature-card-title">Partage Simple</h3>
                    <p class="feature-card-description">
                        Publiez vos livres en quelques clics. Une interface intuitive pour un partage sans effort.
                    </p>
                    <ul class="feature-list">
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Publication rapide</span>
                        </li>
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Gestion facile</span>
                        </li>
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Notifications en temps réel</span>
                        </li>
                    </ul>
                </div>

                <div class="feature-card fade-in delay-1">
                    <div class="feature-card-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="feature-card-title">Découverte Intelligente</h3>
                    <p class="feature-card-description">
                        Trouvez les livres qui vous intéressent avec notre système de recherche et filtres avancés.
                    </p>
                    <ul class="feature-list">
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Recherche par mot-clé</span>
                        </li>
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Filtrage par catégorie</span>
                        </li>
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Suggestions personnalisées</span>
                        </li>
                    </ul>
                </div>

                <div class="feature-card fade-in delay-2">
                    <div class="feature-card-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="feature-card-title">Impact Écologique</h3>
                    <p class="feature-card-description">
                        Contribuez à réduire le gaspillage et préservez les ressources en donnant une seconde vie aux livres.
                    </p>
                    <ul class="feature-list">
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Réduction des déchets</span>
                        </li>
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Économie circulaire</span>
                        </li>
                        <li class="feature-list-item">
                            <i class="fas fa-check"></i>
                            <span>Communauté responsable</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta section-py">
        <div class="container cta-container">
            <h2 class="cta-title">Prêt à rejoindre l'aventure ?</h2>
            <p class="cta-description">
                Rejoignez des centaines de membres qui partagent déjà leurs livres et découvrent de nouvelles lectures gratuitement.
            </p>
            <div class="cta-actions">
                <a href="#" class="btn btn-cta-primary">
                    <i class="fas fa-user-plus"></i>
                    <span>Créer un compte gratuit</span>
                </a>
                <a href="#" class="btn btn-cta-outline">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Se connecter</span>
                </a>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-container">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="footer-logo-text">Ktebloop</span>
                    </div>
                    <p class="footer-description">
                        Plateforme de partage et de réutilisation de livres. 
                        Donnez une seconde vie à vos livres et découvrez de nouvelles lectures gratuitement.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="footer-links-title">Navigation</h3>
                    <ul class="footer-links">
                        <li><a href="#" class="footer-link">Accueil</a></li>
                        <li><a href="#" class="footer-link">À propos</a></li>
                        <li><a href="#" class="footer-link">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-links-title">Légal</h3>
                    <ul class="footer-links">
                        <li><a href="#" class="footer-link">Confidentialité</a></li>
                        <li><a href="#" class="footer-link">Conditions</a></li>
                        <li><a href="#" class="footer-link">Mentions légales</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">
                    &copy; 2023 Ktebloop. Tous droits réservés.
                </p>
                <p class="footer-copyright">
                    Fait avec <i class="fas fa-heart footer-heart"></i> pour la planète
                </p>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }
        });

        const fadeElements = document.querySelectorAll('.fade-in');
        
        const fadeInOnScroll = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            fadeInOnScroll.observe(element);
        });

        // smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>