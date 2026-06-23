<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Pearl & Luxe Events</title>
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
                <a href="/packages" class="text-gray-600 hover:text-purple-600">Packages</a>
                <a href="/gallery" class="text-gray-600 hover:text-purple-600">Gallery</a>
                <a href="/contact" class="text-gray-900 font-semibold">Contact</a>
            </div>
        </nav>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Get in Touch</h1>
            <p class="text-xl text-purple-100">We'd love to hear from you. Send us a message!</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20">
        <div class="max-w-2xl mx-auto px-6">
            <!-- Success Message -->
            @if(session('success'))
            <div class="mb-8 bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-green-800 font-semibold">{{ session('success') }}</p>
            </div>
            @endif

            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Contact Information</h2>
                <p class="text-gray-600 mb-8">Fill out the form below and we'll get back to you as soon as possible.</p>

                <!-- Contact Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-lg">
                        <div class="text-3xl mb-4">📧</div>
                        <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                        <p class="text-gray-600 text-sm break-all">{{ \App\Models\SiteSetting::where('key', 'support_email')->value('value') ?? 'support@pearlandluxeevents.com' }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-lg">
                        <div class="text-3xl mb-4">📞</div>
                        <h3 class="font-semibold text-gray-900 mb-2">Phone</h3>
                        <p class="text-gray-600">
                            {{ \App\Models\SiteSetting::where('key', 'support_phone')->value('value') ?? '+254 722 345 678' }}
                        </p>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-lg">
                        <div class="text-3xl mb-4">🕐</div>
                        <h3 class="font-semibold text-gray-900 mb-2">Hours</h3>
                        <p class="text-gray-600">
                            {{ \App\Models\SiteSetting::where('key', 'contact_hours')->value('value') ?? 'Mon-Sat, 9am-6pm' }}
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Your Name *
                        </label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email Address *
                        </label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                            Subject *
                        </label>
                        <input type="text" id="subject" name="subject" required
                            placeholder="e.g., Inquiry about Wedding Packages"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            value="{{ old('subject') }}">
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                            Message *
                        </label>
                        <textarea id="message" name="message" rows="6" required
                            placeholder="Tell us about your event and what you're looking for..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
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
                        <li><a href="/contact" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Support</h4>
                    <p class="text-sm">{{ \App\Models\SiteSetting::where('key', 'support_email')->value('value') ?? 'support@pearlandluxeevents.com' }}</p>
                    <p class="text-sm">{{ \App\Models\SiteSetting::where('key', 'support_phone')->value('value') ?? '+254 722 345 678' }}</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-4">Follow Us</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Instagram</a></li>
                        <li><a href="#" class="hover:text-white">Facebook</a></li>
                        <li><a href="#" class="hover:text-white">Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-sm">&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>

