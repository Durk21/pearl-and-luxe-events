<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $package->name }} - Pearl & Luxe Events</title>
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
                <a href="/gallery" class="text-gray-600 hover:text-purple-600 font-medium">Gallery</a>
                <a href="/packages" class="text-gray-600 hover:text-purple-600 font-medium">Packages</a>
                <a href="/contact" class="text-gray-600 hover:text-purple-600 font-medium">Contact</a>
            </div>
        </nav>
    </header>

    <!-- Hero Banner -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-8">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-lg">Fill in the details below and we'll confirm your booking.</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Booking Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('booking.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <input type="hidden" name="package_id" value="{{ $package->id }}">

                    <!-- Your Details Section -->
                    <div class="bg-white">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold">
                                1
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Your Details</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="client_name" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="client_name" name="client_name" required placeholder="Jane Doe"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('client_name') border-red-500 @enderror"
                                    value="{{ old('client_name') }}">
                                @error('client_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="client_phone" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="client_phone" name="client_phone" required placeholder="+254 700 000 000"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('client_phone') border-red-500 @enderror"
                                    value="{{ old('client_phone') }}">
                                @error('client_phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="client_email" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="client_email" name="client_email" required placeholder="jane@example.com"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('client_email') border-red-500 @enderror"
                                    value="{{ old('client_email') }}">
                                @error('client_email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Type -->
                            <div>
                                <label for="event_type" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Event Type <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="event_type" name="event_type" required placeholder="e.g., Wedding, Corporate, Birthday"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('event_type') border-red-500 @enderror"
                                    value="{{ old('event_type') }}">
                                @error('event_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Event Details Section -->
                    <div class="bg-white border-t-4 border-purple-600 pt-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">EVENT DETAILS</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Event Date -->
                            <div>
                                <label for="event_date" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Event Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="event_date" name="event_date" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('event_date') border-red-500 @enderror"
                                    value="{{ old('event_date') }}">
                                @error('event_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Number of Guests -->
                            <div>
                                <label for="guest_count" class="block text-sm font-semibold text-gray-900 mb-2">
                                    Number of Guests <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="guest_count" name="guest_count" required min="1" placeholder="100"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('guest_count') border-red-500 @enderror"
                                    value="{{ old('guest_count') }}">
                                @error('guest_count')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mt-6">
                            <label for="special_requests" class="block text-sm font-semibold text-gray-900 mb-2">
                                Special Requests (Optional)
                            </label>
                            <textarea id="special_requests" name="special_requests" rows="4" placeholder="Tell us about any special requirements, preferences, or ideas..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('special_requests') border-red-500 @enderror">{{ old('special_requests') }}</textarea>
                            @error('special_requests')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-lg">
                        Proceed to Confirmation
                    </button>
                </form>
            </div>

            <!-- Right Column: Package Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-8 border border-purple-200">
                    <!-- Header with Icon -->
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold">
                            <i class="fas fa-check"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Package Summary</h3>
                    </div>

                    <!-- Package Name -->
                    <h2 class="text-2xl font-bold text-purple-600 mb-2">{{ $package->name }}</h2>
                    <p class="text-gray-600 text-sm mb-6">{{ $package->description }}</p>

                    <!-- Divider -->
                    <div class="border-t border-purple-200 my-6"></div>

                    <!-- Package Details -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-start">
                            <span class="text-gray-700 font-medium">Package Price</span>
                            <span class="text-right">
                                <span class="text-2xl font-bold text-purple-600">KES {{ number_format($package->price, 0) }}</span>
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 flex items-center space-x-2">
                                <i class="fas fa-users text-purple-600"></i>
                                <span>Max Guests</span>
                            </span>
                            <span class="font-semibold text-gray-900">{{ $package->max_guests }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 flex items-center space-x-2">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span>Duration</span>
                            </span>
                            <span class="font-semibold text-gray-900">{{ $package->duration_hours }} hours</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                                <span>Venue Type</span>
                            </span>
                            <span class="font-semibold text-gray-900">{{ $package->venue_type }}</span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-purple-200 my-6"></div>

                    <!-- Deposit Due - Highlighted -->
                    <div class="bg-white rounded-lg p-4 mb-6 border-l-4 border-pink-600">
                        <p class="text-gray-600 text-sm mb-1">Deposit Due</p>
                        <p class="text-2xl font-bold text-pink-600">KES {{ number_format($package->price * $package->deposit_percentage / 100, 0) }}</p>
                        <p class="text-xs text-gray-500 mt-2">({{ $package->deposit_percentage }}% of total)</p>
                    </div>

                    <!-- Package Features -->
                    @if($package->features->count() > 0)
                    <div class="bg-white rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Included Features</h4>
                        <ul class="space-y-2">
                            @foreach($package->features as $feature)
                            <li class="flex items-start space-x-3">
                                <i class="fas fa-check text-green-500 mt-1 flex-shrink-0"></i>
                                <span class="text-sm text-gray-700">{{ $feature->name }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-20">
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
