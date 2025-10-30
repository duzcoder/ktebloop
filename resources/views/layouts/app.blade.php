<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ktebloop - Partage de Livres')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📚</text></svg>">
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="nav-gradient sticky top-0 z-50 backdrop-blur-lg bg-white/95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#FFB823] to-[#0A400C] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-book-open text-white text-lg"></i>
                            </div>
                            <span class="text-2xl font-bold bg-gradient-to-r from-[#0A400C] to-[#FFB823] bg-clip-text text-transparent">
                                Ktebloop
                            </span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-[#0A400C] hover:text-[#FFB823] font-medium transition-colors duration-300 relative group">
                            Accueil
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#FFB823] group-hover:w-full transition-all duration-300"></span>
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-[#0A400C] hover:text-[#FFB823] font-medium transition-colors duration-300 relative group">
                                Tableau de bord
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#FFB823] group-hover:w-full transition-all duration-300"></span>
                            </a>
                        @endauth
                    </div>

                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-outline text-sm">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-[#0A400C] hover:text-[#FFB823] font-medium transition-colors duration-300">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="btn-primary text-sm">
                                <i class="fas fa-user-plus mr-2"></i>S'inscrire
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gradient-to-b from-white to-gray-50 border-t border-gray-100 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-[#FFB823] to-[#0A400C] rounded-lg flex items-center justify-center">
                                <i class="fas fa-book-open text-white text-sm"></i>
                            </div>
                            <span class="text-xl font-bold text-[#0A400C]">Ktebloop</span>
                        </div>
                        <p class="text-gray-600 mb-4 max-w-md">
                            Plateforme de partage et de réutilisation de livres. 
                            Donnez une seconde vie à vos livres et découvrez de nouvelles lectures gratuitement.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-[#0A400C] text-white rounded-full flex items-center justify-center hover:bg-[#FFB823] hover:text-[#0A400C] transition-all duration-300 transform hover:scale-110">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-[#0A400C] text-white rounded-full flex items-center justify-center hover:bg-[#FFB823] hover:text-[#0A400C] transition-all duration-300 transform hover:scale-110">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-[#0A400C] text-white rounded-full flex items-center justify-center hover:bg-[#FFB823] hover:text-[#0A400C] transition-all duration-300 transform hover:scale-110">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Links -->
                    <div>
                        <h3 class="font-semibold text-[#0A400C] mb-4">Navigation</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-[#FFB823] transition-colors duration-300">Accueil</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#FFB823] transition-colors duration-300">À propos</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#FFB823] transition-colors duration-300">Contact</a></li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-[#0A400C] mb-4">Légal</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-[#FFB823] transition-colors duration-300">Confidentialité</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#FFB823] transition-colors duration-300">Conditions</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-[#FFB823] transition-colors duration-300">Mentions légales</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-200 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-600 text-sm">
                        &copy; {{ date('Y') }} Ktebloop. Tous droits réservés.
                    </p>
                    <p class="text-gray-500 text-sm mt-2 md:mt-0">
                        Fait avec <i class="fas fa-heart text-[#FFB823] mx-1"></i> pour la planète
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add fade-in animation to elements
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.animate-fade-in-up');
            animatedElements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>