<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Pearl & Luxe Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-lg">P</span>
                </div>
                <div>
                    <div class="font-bold text-gray-900">Pearl & Luxe</div>
                    <div class="text-xs text-gray-600">Events</div>
                </div>
            </div>
            <div class="hidden md:flex space-x-8 items-center">
                <a href="/" class="text-gray-600 hover:text-purple-600 font-medium">Home</a>
                <a href="/gallery" class="text-purple-600 font-semibold">Gallery</a>
                <a href="/packages" class="text-gray-600 hover:text-purple-600 font-medium">Packages</a>
                <a href="/book" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                    Book Now
                </a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-2">Our Gallery</h1>
            <p class="text-lg text-purple-100">Explore our collection of luxury events</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-wrap gap-3 justify-center mb-12">
            <!-- All Events Button -->
            <a href="/gallery" 
                class="px-6 py-2 rounded-full font-medium transition {{ !$selectedType ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                All Events
            </a>

            <!-- Event Type Buttons -->
            @foreach($eventTypes as $type)
            <a href="/gallery?type={{ $type->id }}" 
                class="px-6 py-2 rounded-full font-medium transition {{ $selectedType == $type->id ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $type->name }}
            </a>
            @endforeach
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        @if($galleryItems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleryItems as $item)
                <div class="group relative overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                    <!-- Image -->
                    <div class="relative h-80 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                            alt="{{ $item->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition duration-300"></div>
                    </div>

                    <!-- Title Bar -->
                    <div class="bg-white p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $item->title }}</h3>
                        @if($item->eventType)
                        <p class="text-sm text-purple-600 mt-1">{{ $item->eventType->name }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($galleryItems->hasPages())
            <div class="mt-16 flex justify-center">
                {{ $galleryItems->links() }}
            </div>
            @endif
        @else
            <div class="text-center py-20">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-image text-5xl"></i>
                </div>
                <p class="text-gray-600 text-lg">No gallery items found for this event type.</p>
            </div>
        @endif
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="font-bold text-white mb-4">Pearl & Luxe Events</h3>
                    <p class="text-sm">Crafting unforgettable luxury experiences in Kenya</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="hover:text-white">Home</a></li>
                        <li><a href="/packages" class="hover:text-white">Packages</a></li>
                        <li><a href="/gallery" class="hover:text-white">Gallery</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Support</h4>
                    <p class="text-sm">{{ \App\Models\SiteSetting::where('key', 'support_email')->value('value') ?? 'support@pearlandluxeevents.com' }}</p>
                    <p class="text-sm">{{ \App\Models\SiteSetting::where('key', 'support_phone')->value('value') ?? '+254 722 345 678' }}</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-sm">&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
