@extends('layouts.app')
@section('title', 'Book — ' . $package->name . ' | Pearl & Luxe Events')

@section('content')

{{-- PAGE HEADER --}}
<section class="gradient-primary py-16 text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10"
         style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
    </div>
    <div class="relative z-10">
        <p class="text-pink-200 text-sm font-medium tracking-widest uppercase mb-3">Secure Your Date</p>
        <h1 class="text-4xl font-bold mb-2">Book the {{ $package->name }} Package</h1>
        <p class="text-purple-100">Fill in the details below and we'll confirm your booking.</p>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ── BOOKING FORM ── --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                        <span class="w-8 h-8 gradient-primary rounded-lg flex items-center justify-center text-white text-sm">1</span>
                        Your Details
                    </h2>

                    @if($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                        <p class="text-red-600 text-sm font-medium mb-2">Please fix the following:</p>
                        <ul class="text-red-500 text-sm space-y-1">
                            @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('booking.store', $package->slug) }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Personal Info --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="client_name" value="{{ old('client_name') }}"
                                       placeholder="Jane Doe"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition @error('client_name') border-red-400 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" name="client_phone" value="{{ old('client_phone') }}"
                                       placeholder="+254 700 000 000"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition @error('client_phone') border-red-400 @enderror">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" name="client_email" value="{{ old('client_email') }}"
                                   placeholder="jane@example.com"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition @error('client_email') border-red-400 @enderror">
                        </div>

                        {{-- Event Info --}}
                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-4 uppercase tracking-wider">Event Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Event Date *</label>
                                    <input type="date" name="event_date" value="{{ old('event_date') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition @error('event_date') border-red-400 @enderror">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Event Type *</label>
                                    <select name="event_type"
                                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition @error('event_type') border-red-400 @enderror">
                                        <option value="">Select event type</option>
                                        @foreach($eventTypes as $type)
                                        <option value="{{ $type->name }}" {{ old('event_type') === $type->name ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Number of Guests * <span class="text-gray-400 font-normal">(max {{ $package->max_guests }})</span>
                                </label>
                                <input type="number" name="guest_count" value="{{ old('guest_count') }}"
                                       min="1" max="{{ $package->max_guests }}"
                                       placeholder="e.g. 100"
                                       class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition @error('guest_count') border-red-400 @enderror">
                            </div>
                        </div>

                        {{-- Special Requests --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Special Requests <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <textarea name="special_requests" rows="4"
                                      placeholder="Tell us anything special — themes, dietary requirements, accessibility needs..."
                                      class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-transparent transition resize-none">{{ old('special_requests') }}</textarea>
                        </div>

                        {{-- Terms --}}
                        <div class="bg-purple-50 rounded-xl p-4 text-sm text-purple-700">
                            <p class="font-medium mb-1">📋 Booking Terms</p>
                            <p class="text-purple-600 text-xs leading-relaxed">
                                A 30% deposit of <strong>KES {{ number_format($package->deposit_amount) }}</strong> is required to confirm your booking.
                                Our team will contact you within 24 hours with payment instructions.
                                Full balance is due 7 days before your event date.
                            </p>
                        </div>

                        <button type="submit"
                                class="w-full gradient-primary text-white font-semibold py-4 rounded-full hover:opacity-90 transition shadow-lg text-base">
                            Submit Booking Request →
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── PACKAGE SUMMARY ── --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 gradient-primary rounded-lg flex items-center justify-center text-white text-sm">✓</span>
                        Package Summary
                    </h3>

                    <div class="bg-purple-50 rounded-xl p-4 mb-6">
                        <p class="text-purple-700 font-bold text-lg">{{ $package->name }} Package</p>
                        <p class="text-purple-500 text-sm mt-1">{{ $package->description }}</p>
                    </div>

                    <div class="space-y-3 mb-6 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Package Price</span>
                            <span class="font-semibold">KES {{ number_format($package->price) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Max Guests</span>
                            <span class="font-semibold">{{ $package->max_guests }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Duration</span>
                            <span class="font-semibold">{{ $package->duration_hours }} hours</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Venue Type</span>
                            <span class="font-semibold">{{ $package->venue_type }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between">
                            <span class="text-purple-700 font-semibold">Deposit Due</span>
                            <span class="text-purple-700 font-bold">KES {{ number_format($package->deposit_amount) }}</span>
                        </div>
                    </div>

                    <ul class="space-y-2">
                        @foreach($package->features as $feature)
                        <li class="flex items-start gap-2 text-xs">
                            <span class="{{ $feature->is_included ? 'text-green-500' : 'text-red-400' }} font-bold mt-0.5">
                                {{ $feature->is_included ? '✓' : '✗' }}
                            </span>
                            <span class="{{ $feature->is_included ? 'text-gray-600' : 'text-gray-400' }}">
                                {{ $feature->feature }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Need help? --}}
                <div class="bg-gray-900 rounded-2xl p-6 text-white text-center">
                    <p class="font-semibold mb-2">Need help choosing?</p>
                    <p class="text-gray-400 text-xs mb-4">Our team is happy to guide you through the options.</p>
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', \['contact_phone'] ?? '254700000000') }}" target="_blank"
                       class="block bg-green-500 hover:bg-green-600 text-white text-sm font-semibold py-2.5 rounded-full transition">
                        💬 Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
