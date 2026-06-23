<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Quote - Pearl & Luxe Events</title>
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
    <section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Custom Quote Request</h1>
            <p class="text-lg text-purple-100">Tell us about your vision and we'll create a tailored package just for you</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-4xl mx-auto px-6 py-16">
        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <i class="fas fa-check-circle text-green-600 text-xl mt-0.5 flex-shrink-0"></i>
                <div>
                    <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                    <p class="text-green-700 text-sm mt-1">We'll review your request and reach out within 24 hours.</p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <form action="{{ route('quote.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Contact Information Section -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center space-x-3">
                        <i class="fas fa-user text-purple-600"></i>
                        <span>Your Contact Information</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="client_name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="client_name" name="client_name" required
                                placeholder="Jane Doe"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('client_name') border-red-500 @enderror"
                                value="{{ old('client_name') }}">
                            @error('client_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="client_phone" class="block text-sm font-semibold text-gray-900 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="client_phone" name="client_phone" required
                                placeholder="+254 700 000 000"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('client_phone') border-red-500 @enderror"
                                value="{{ old('client_phone') }}">
                            @error('client_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="client_email" class="block text-sm font-semibold text-gray-900 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="client_email" name="client_email" required
                                placeholder="jane@example.com"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('client_email') border-red-500 @enderror"
                                value="{{ old('client_email') }}">
                            @error('client_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Event Details Section -->
                <div class="border-t border-gray-200 pt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center space-x-3">
                        <i class="fas fa-calendar-days text-purple-600"></i>
                        <span>Event Details</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Event Type -->
                        <div>
                            <label for="event_type" class="block text-sm font-semibold text-gray-900 mb-2">
                                Event Type <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="event_type" name="event_type" required
                                placeholder="e.g., Wedding, Corporate, Birthday"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('event_type') border-red-500 @enderror"
                                value="{{ old('event_type') }}">
                            @error('event_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Event Date -->
                        <div>
                            <label for="event_date" class="block text-sm font-semibold text-gray-900 mb-2">
                                Approximate Event Date
                            </label>
                            <input type="date" id="event_date" name="event_date"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('event_date') border-red-500 @enderror"
                                value="{{ old('event_date') }}">
                            @error('event_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estimated Guests -->
                        <div>
                            <label for="estimated_guests" class="block text-sm font-semibold text-gray-900 mb-2">
                                Estimated Number of Guests
                            </label>
                            <input type="number" id="estimated_guests" name="estimated_guests" min="1"
                                placeholder="150"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('estimated_guests') border-red-500 @enderror"
                                value="{{ old('estimated_guests') }}">
                            @error('estimated_guests')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Budget Section -->
                <div class="border-t border-gray-200 pt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center space-x-3">
                        <i class="fas fa-wallet text-purple-600"></i>
                        <span>Budget Range</span>
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Min Budget -->
                        <div>
                            <label for="budget_min" class="block text-sm font-semibold text-gray-900 mb-2">
                                Minimum Budget (KES) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="budget_min" name="budget_min" required min="0"
                                placeholder="50000"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('budget_min') border-red-500 @enderror"
                                value="{{ old('budget_min') }}">
                            @error('budget_min')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Max Budget -->
                        <div>
                            <label for="budget_max" class="block text-sm font-semibold text-gray-900 mb-2">
                                Maximum Budget (KES) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="budget_max" name="budget_max" required min="0"
                                placeholder="500000"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('budget_max') border-red-500 @enderror"
                                value="{{ old('budget_max') }}">
                            @error('budget_max')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Special Requirements -->
                <div class="border-t border-gray-200 pt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center space-x-3">
                        <i class="fas fa-lightbulb text-purple-600"></i>
                        <span>Your Vision</span>
                    </h2>

                    <label for="special_requirements" class="block text-sm font-semibold text-gray-900 mb-2">
                        Special Requirements, Theme, or Vision (Optional)
                    </label>
                    <textarea id="special_requirements" name="special_requirements" rows="5"
                        placeholder="Tell us about your dream event, any specific themes, color preferences, or unique requirements you have in mind..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('special_requirements') border-red-500 @enderror">{{ old('special_requirements') }}</textarea>
                    @error('special_requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="border-t border-gray-200 pt-8">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-6 rounded-lg transition duration-200 text-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>Send Quote Request</span>
                    </button>
                    <p class="text-center text-gray-600 text-sm mt-4">Our team will review your request and get back to you within 24 hours.</p>
                </div>
            </form>
        </div>

        <!-- FAQ Section -->
        <div class="mt-16 bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">What Happens Next?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">1</div>
                    <h4 class="font-semibold text-gray-900 mb-2">We Review</h4>
                    <p class="text-gray-600 text-sm">Our team carefully reviews your requirements and budget</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">2</div>
                    <h4 class="font-semibold text-gray-900 mb-2">We Contact You</h4>
                    <p class="text-gray-600 text-sm">We reach out to discuss your vision in detail</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">3</div>
                    <h4 class="font-semibold text-gray-900 mb-2">Custom Proposal</h4>
                    <p class="text-gray-600 text-sm">You receive a tailored package proposal</p>
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
