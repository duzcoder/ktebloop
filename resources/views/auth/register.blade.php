@extends('layouts.app')

@section('content')

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
        /* Added to ensure footer stays at bottom */
        display: flex;
        flex-direction: column;
        min-height: 100vh;
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
        /* Added to ensure footer stays at bottom */
        flex: 1;
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
        padding: 2.5rem;
        position: relative;
        transform: none !important;
        transition: none !important;
        pointer-events: auto;
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
        pointer-events: none;
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
        /* Added to ensure footer stays at bottom */
        margin-top: auto;
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

     .form-input.error {
        border-color: #EF4444;
    }

    .checkbox-input {
        accent-color: var(--secondary);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .floating-card {
            padding: 2rem !important;
        }
        
        .hero-title {
            font-size: 2rem !important;
        }
        
        .hero-description {
            font-size: 1rem !important;
        }
    }
</style>

<section class="hero section-py" style="min-height: 100vh; display:flex; align-items:center; justify-content:center;">
    <div class="container">
        <div class="floating-card" style="max-width:480px; margin:0 auto;">
            <h2 class="text-gradient" style="text-align:center; margin-bottom:1.5rem;">
                Create Your Account
            </h2>
            <p style="text-align:center; color:var(--gray-700); margin-bottom:2rem;">
                Join our community and get started today 🚀
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary-light)] outline-none transition-all duration-200" />
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary-light)] outline-none transition-all duration-200" />
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary-light)] outline-none transition-all duration-200" />
                    @error('phone')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary-light)] outline-none transition-all duration-200" />
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-[var(--primary)] focus:ring-2 focus:ring-[var(--primary-light)] outline-none transition-all duration-200" />
                </div>

                {{-- Terms --}}
                <div class="form-checkbox" style="display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 2rem;">
                    <input type="checkbox" id="terms" name="terms" class="checkbox-input" style="margin-top: 0.25rem; accent-color: var(--secondary);" required {{ old('terms') ? 'checked' : '' }}>
                    <label for="terms" class="checkbox-label" style="font-size: 0.875rem; color: var(--gray-700);">
                        J'accepte les <a href="#" style="color: var(--secondary); text-decoration: none; font-weight: 500;">conditions d'utilisation</a> et la 
                        <a href="#" style="color: var(--secondary); text-decoration: none; font-weight: 500;">politique de confidentialité</a> de Ktebloop
                    </label>
                    @error('terms')
                        <div class="form-error" style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem; display: flex; align-items: center; gap: 0.25rem;">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex flex-col items-center">
                    <button type="submit" class="btn btn-primary w-full mb-4">
                        Register
                    </button>
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-gradient font-medium">Sign in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- footer - moved outside the hero section -->
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
                &copy; 2025 Ktebloop. Tous droits réservés.
            </p>
            <p class="footer-copyright">
                Fait avec <i class="fas fa-heart footer-heart"></i> pour la planète
            </p>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registrationForm');
        
        // Add focus styles to form inputs
        const formInputs = document.querySelectorAll('.form-input');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = 'var(--primary)';
                this.style.boxShadow = '0 0 0 3px rgba(255, 184, 35, 0.2)';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = 'var(--gray-200)';
                this.style.boxShadow = 'none';
            });
        });
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Reset errors
            document.querySelectorAll('.form-input').forEach(input => {
                input.classList.remove('error');
            });
            
            // Password validation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password.length < 8) {
                document.getElementById('password').classList.add('error');
                isValid = false;
            }
            
            if (password !== confirmPassword) {
                document.getElementById('password_confirmation').classList.add('error');
                isValid = false;
            }
            
            // Terms validation
            const terms = document.getElementById('terms').checked;
            if (!terms) {
                alert('Veuillez accepter les conditions d\'utilisation');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection