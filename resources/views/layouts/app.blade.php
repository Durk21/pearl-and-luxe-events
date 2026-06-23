<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pearl & Luxe Events')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 500: '#a855f7', 600: '#9333ea', 700: '#7e22ce' },
                        magenta: { 500: '#ec4899', 600: '#db2777' }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }

        .gradient-primary {
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #7c3aed, #db2777);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-blur {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.97);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased bg-white text-gray-900">

    {{-- NAVBAR --}}
    <nav class="nav-blur fixed top-0 w-full z-50 border-b border-purple-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-9 h-9 rounded-full gradient-primary flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">P</span>
                    </div>
                    <div>
                        <span class="font-bold text-base gradient-text">Pearl & Luxe</span>
                        <p class="text-gray-400 text-xs -mt-1 hidden sm:block">Events</p>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                       class="text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }}">
                        Home
                    </a>
                    <a href="{{ route('gallery.index') }}"
                       class="text-sm font-medium transition-colors {{ request()->routeIs('gallery') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }}">
                        Gallery
                    </a>
                    <a href="{{ route('packages.index') }}"
                       class="text-sm font-medium transition-colors {{ request()->routeIs('packages') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }}">
                        Packages
                    </a>
                    <a href="{{ route('contact.show') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('contact*') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }}">Contact</a>
                    <a href="{{ route('packages.index') }}"
                       class="gradient-primary text-white px-5 py-2 rounded-full text-sm font-semibold hover:opacity-90 transition shadow-md">
                        Book Now
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-toggle"
                        class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-purple-50 transition">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden md:hidden py-4 border-t border-purple-50 space-y-1">
                <a href="{{ route('home') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                    Home
                </a>
                <a href="{{ route('gallery.index') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                    Gallery
                </a>
                <a href="{{ route('packages.index') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">Packages</a>
                    <a href="{{ route('contact.show') }}" class="text-sm font-medium transition-colors {{ request()->routeIs('contact*') ? 'text-purple-600' : 'text-gray-600 hover:text-purple-600' }}">Contact</a>
                <div class="px-4 pt-2">
                    <a href="{{ route('packages.index') }}"
                       class="block text-center gradient-primary text-white py-2.5 rounded-full text-sm font-semibold">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
    <div class="fixed top-20 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg text-sm font-medium"
         x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
        ✓ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg text-sm font-medium"
         x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
        ✗ {{ session('error') }}
    </div>
    @endif

    {{-- PAGE CONTENT --}}
    <main class="pt-16">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-950 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-gray-800">

                {{-- Brand --}}
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-9 h-9 rounded-full gradient-primary flex items-center justify-center">
                            <span class="text-white font-bold text-sm">P</span>
                        </div>
                        <span class="font-bold text-lg">Pearl & Luxe Events</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                        Creating unforgettable moments and luxury experiences across Kenya.
                        From intimate gatherings to grand celebrations.
                    </p>
                    <div class="flex space-x-3 mt-6">
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition text-sm">f</a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition text-sm">ig</a>
                        <a href="#" class="w-9 h-9 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition text-sm">w</a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">Quick Links</h4>
                    <ul class="space-y-2.5 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition">Gallery</a></li>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Packages</a>
                        <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Book an Event</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-semibold text-white mb-4 text-sm uppercase tracking-wider">Contact</h4>
                    <ul class="space-y-2.5 text-gray-400 text-sm">
                        <li class="flex items-center gap-2">
                            <span>📞</span> {{ $settings['contact_phone'] ?? '+254 700 000 000' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span>✉️</span> {{ $settings['contact_email'] ?? 'bookings@pearlandluxe.co.ke' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📍</span> {{ $settings['contact_address'] ?? 'Nairobi, Kenya' }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span>🕐</span> {{ $settings['contact_hours'] ?? 'Mon-Sat, 8am-6pm' }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center mt-8 text-gray-500 text-xs gap-2">
                <p>© {{ date('Y') }} Pearl & Luxe Events. All rights reserved.</p>
                <p>Crafted with ❤️ in Nairobi, Kenya</p>
            </div>
        </div>
    </footer>

    {{-- Mobile menu script --}}
    <script>
        const toggle = document.getElementById('mobile-toggle');
        const menu   = document.getElementById('mobile-menu');
        const menuIcon  = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>









