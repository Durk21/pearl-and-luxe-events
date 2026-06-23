@extends('layouts.app')
@section('title', 'Booking Confirmed — Pearl & Luxe Events')

@section('content')

<section class="min-h-screen bg-gray-50 py-20 flex items-center">
    <div class="max-w-2xl mx-auto px-4 w-full">

        {{-- Success card --}}
        <div class="bg-white rounded-3xl shadow-xl border border-green-100 overflow-hidden">

            {{-- Top banner --}}
            <div class="gradient-primary py-10 text-center text-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-10"
                     style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;">
                </div>
                <div class="relative z-10">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur">
                        <span class="text-4xl">✅</span>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Booking Received!</h1>
                    <p class="text-purple-100">We'll confirm your booking within 24 hours.</p>
                </div>
            </div>

            {{-- Booking details --}}
            <div class="p-8">
                {{-- Reference --}}
                <div class="bg-purple-50 rounded-2xl p-5 mb-8 text-center">
                    <p class="text-purple-600 text-sm font-medium mb-1">Your Booking Reference</p>
                    <p class="text-3xl font-bold gradient-text tracking-widest">{{ $booking->reference_number }}</p>
                    <p class="text-gray-400 text-xs mt-2">Save this reference for all future correspondence</p>
                </div>

                {{-- Details grid --}}
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Client</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $booking->client_name }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Package</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $booking->package->name }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Event Date</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $booking->event_date->format('D, d M Y') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Event Type</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $booking->event_type }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Guests</p>
                        <p class="font-semibold text-gray-800 text-sm">{{ $booking->guest_count }} people</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Status</p>
                        <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">
                            ⏳ Pending Confirmation
                        </span>
                    </div>
                </div>

                {{-- Payment summary --}}
                <div class="border border-purple-100 rounded-2xl p-5 mb-8">
                    <h3 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Payment Summary</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Package Price</span>
                            <span class="font-semibold">KES {{ number_format($booking->total_amount) }}</span>
                        </div>
                        <div class="flex justify-between text-purple-700 font-bold border-t border-purple-100 pt-2 mt-2">
                            <span>Deposit Required (30%)</span>
                            <span>KES {{ number_format($booking->deposit_amount) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Balance Due (7 days before event)</span>
                            <span>KES {{ number_format($booking->total_amount - $booking->deposit_amount) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Next steps --}}
                <div class="bg-blue-50 rounded-2xl p-5 mb-8">
                    <h3 class="font-bold text-gray-800 mb-3 text-sm">📋 Next Steps</h3>
                    <ol class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 gradient-primary rounded-full flex items-center justify-center text-white text-xs flex-shrink-0 mt-0.5">1</span>
                            Our team will review your booking and contact you within 24 hours.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 gradient-primary rounded-full flex items-center justify-center text-white text-xs flex-shrink-0 mt-0.5">2</span>
                            You'll receive M-Pesa payment instructions for your deposit of <strong>KES {{ number_format($booking->deposit_amount) }}</strong>.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 gradient-primary rounded-full flex items-center justify-center text-white text-xs flex-shrink-0 mt-0.5">3</span>
                            Once deposit is received, your date is officially secured!
                        </li>
                    </ol>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', \['contact_phone'] ?? '254700000000') }}?text=Hi! My booking reference is {{ $booking->reference_number }}"
                       target="_blank"
                       class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center font-semibold py-3.5 rounded-full transition text-sm">
                        💬 Chat With Us on WhatsApp
                    </a>
                    <a href="{{ route('home') }}"
                       class="flex-1 border-2 border-gray-200 text-gray-600 text-center font-semibold py-3.5 rounded-full hover:border-purple-300 hover:text-purple-600 transition text-sm">
                        ← Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
