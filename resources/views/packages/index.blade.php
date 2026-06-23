<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages - Pearl & Luxe Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white shadow">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                Pearl & Luxe Events
            </a>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-600 hover:text-purple-600">Home</a>
                <a href="/packages" class="text-gray-900 font-semibold">Packages</a>
                <a href="/gallery" class="text-gray-600 hover:text-purple-600">Gallery</a>
            </div>
        </nav>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Our Packages</h1>
            <p class="text-xl text-purple-100">Choose the perfect package for your event</p>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($packages as $package)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    <div class="h-48 bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center">
                        <span class="text-white text-5xl">✨</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $package->description }}</p>
                        
                        <div class="space-y-2 mb-6 text-sm text-gray-700 bg-gray-50 p-4 rounded">
                            <p><span class="font-semibold">👥 Max Guests:</span> {{ $package->max_guests }}</p>
                            <p><span class="font-semibold">⏱️ Duration:</span> {{ $package->duration_hours }} hours</p>
                            <p><span class="font-semibold">📍 Venue:</span> {{ $package->venue_type }}</p>
                        </div>

                        <div class="border-t pt-4 mb-6">
                            <p class="text-3xl font-bold text-purple-600">KES {{ number_format($package->price, 0) }}</p>
                            <p class="text-xs text-gray-500 mt-1">Deposit required: {{ $package->deposit_percentage }}%</p>
                        </div>

                        <a href="{{ route('booking.show', $package->slug) }}" 
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 rounded-lg hover:from-purple-700 hover:to-pink-700 transition text-center block">
                            Book Package
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600">No packages available at the moment.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($packages->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $packages->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

