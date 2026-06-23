<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Pearl & Luxe Events</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow">
            <nav class="max-w-7xl mx-auto px-6 py-4">
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Pearl & Luxe Events
                </a>
            </nav>
        </header>

        <!-- Confirmation Content -->
        <main class="flex-grow max-w-2xl mx-auto w-full px-6 py-12">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-green-100">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-2">Booking Confirmed!</h1>
                <p class="text-gray-600 mb-8">Thank you for choosing Pearl & Luxe Events. Your booking has been submitted successfully.</p>

                <!-- Booking Details -->
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6 text-left mb-8 border border-purple-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Booking Details</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Reference Number:</span>
                            <span class="font-mono font-semibold text-purple-600">{{ $booking->reference_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Your Name:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->client_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="text-gray-900">{{ $booking->client_email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Phone:</span>
                            <span class="text-gray-900">{{ $booking->client_phone }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between">
                            <span class="text-gray-600">Event Type:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->event_type }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Event Date:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->event_date->format('F d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Guest Count:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->guest_count }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Package:</span>
                            <span class="font-semibold text-gray-900">{{ $booking->package->name }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between">
                            <span class="text-gray-600">Total Amount:</span>
                            <span class="text-lg font-bold text-purple-600">KES {{ number_format($booking->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Deposit Due:</span>
                            <span class="font-semibold text-pink-600">KES {{ number_format($booking->deposit_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 rounded-lg p-6 text-left mb-8 border border-blue-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">What's Next?</h3>
                    <ol class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start">
                            <span class="font-semibold text-blue-600 mr-3">1.</span>
                            <span>Check your email ({{ $booking->client_email }}) for a confirmation message with full booking details.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-semibold text-blue-600 mr-3">2.</span>
                            <span>Our team will contact you shortly to arrange payment and discuss final event details.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-semibold text-blue-600 mr-3">3.</span>
                            <span>Complete the deposit payment of <strong>KES {{ number_format($booking->deposit_amount, 2) }}</strong> to confirm your booking.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-semibold text-blue-600 mr-3">4.</span>
                            <span>Our event coordination team will start planning your perfect event!</span>
                        </li>
                    </ol>
                </div>

                <!-- Contact Info -->
                <div class="bg-gray-50 rounded-lg p-6 text-center mb-8">
                    <h3 class="font-semibold text-gray-900 mb-2">Need Help?</h3>
                    <p class="text-gray-600 text-sm mb-2">Contact our team for any questions</p>
                    <p class="text-lg font-semibold text-purple-600">support@pearlandluxeevents.com</p>
                    <p class="text-gray-600">+254 XXX XXX XXX</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/" class="px-6 py-3 border border-purple-600 text-purple-600 font-semibold rounded-lg hover:bg-purple-50 transition">
                        Back to Home
                    </a>
                    <a href="/gallery" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-pink-700 transition">
                        View Our Gallery
                    </a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-300 py-8">
            <div class="max-w-7xl mx-auto text-center">
                <p>&copy; 2026 Pearl & Luxe Events. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
