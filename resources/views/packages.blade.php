@extends('layouts.app')
@section('title', 'Packages — Pearl & Luxe Events')

@section('content')

<section class="gradient-primary py-20 text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10">
        <p class="text-pink-200 text-sm font-medium tracking-widest uppercase mb-3">Transparent Pricing</p>
        <h1 class="text-5xl font-bold mb-4">Our Packages</h1>
        <p class="text-purple-100 text-lg max-w-xl mx-auto">Choose a package that fits your budget. A 30% deposit secures your date.</p>
    </div>
</section>

<section class="bg-white border-b border-gray-100 shadow-sm py-6 sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="flex items-center gap-3 flex-shrink-0">
                <span class="text-gray-600 text-sm font-medium">Budget:</span>
                <span id="budget-display" class="gradient-text font-bold text-lg min-w-[140px]">
                    KES {{ number_format($budget) }}
                </span>
            </div>
            <input type="range" id="budget-slider" min="50000" max="600000" step="5000" value="{{ $budget }}" class="w-full accent-purple-600 cursor-pointer">
            <div class="flex items-center gap-2 text-xs text-gray-400 flex-shrink-0">
                <span>KES 50K</span><span>—</span><span>KES 600K+</span>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="packages-grid" class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            @forelse($packages as $package)
            <div class="package-card flex flex-col rounded-2xl border {{ $package->is_featured ? 'border-purple-500 shadow-2xl shadow-purple-100' : 'border-gray-200 bg-white hover:border-purple-200 hover:shadow-xl' }} transition-all duration-300 overflow-hidden bg-white" data-price="{{ $package->price }}">
                @if($package->is_featured)
                <div class="gradient-primary text-white text-center py-2.5 text-sm font-semibold tracking-wide">Most Popular</div>
                @endif
                <div class="p-8 flex flex-col flex-1">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $package->description }}</p>
                    </div>
                    <div class="bg-purple-50 rounded-xl p-4 mb-6">
                        <div class="text-3xl font-bold gradient-text">KES {{ number_format($package->price) }}</div>
                        <div class="flex flex-wrap gap-4 mt-3 text-sm text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Up to {{ $package->max_guests }} guests
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $package->duration_hours }} hours
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                {{ $package->venue_type }}
                            </span>
                        </div>
                        <p class="text-purple-600 text-sm font-semibold mt-3">30% Deposit: KES {{ number_format($package->deposit_amount) }}</p>
                    </div>
                    <ul class="space-y-3 mb-8 flex-1">
                        @foreach($package->features as $feature)
                        <li class="flex items-start gap-3 text-sm">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 {{ $feature->is_included ? 'text-green-500' : 'text-red-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($feature->is_included)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                @endif
                            </svg>
                            <span class="{{ $feature->is_included ? 'text-gray-700' : 'text-gray-400 line-through' }}">{{ $feature->feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booking.show', $package->slug) }}" class="block text-center py-3.5 rounded-full font-semibold text-sm transition-all {{ $package->is_featured ? 'gradient-primary text-white shadow-lg hover:opacity-90' : 'border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white' }}">
                        Book {{ $package->name }} Package
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-24">
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No packages yet</h3>
                <p class="text-gray-400 text-sm">Packages will appear here once added from the admin panel.</p>
            </div>
            @endforelse
        </div>

        <div id="no-results" class="hidden text-center py-24">
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No packages in this budget</h3>
            <p class="text-gray-400 text-sm">Try increasing your budget or <a href="{{ route('contact.show') }}" class="text-purple-600 hover:underline">contact us</a> for a custom quote.</p>
        </div>

        <div class="mt-16 bg-white rounded-3xl border border-purple-100 shadow-lg p-10 text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Need a Custom Package?</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto text-sm">Don't see exactly what you need? We'll build a tailored package around your vision and budget.</p>
            <a href="{{ route('contact.show') }}" class="gradient-primary text-white font-semibold px-8 py-3.5 rounded-full hover:opacity-90 transition shadow-lg inline-block">Get a Custom Quote</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    const slider = document.getElementById('budget-slider');
    const display = document.getElementById('budget-display');
    const cards = document.querySelectorAll('.package-card');
    const noResults = document.getElementById('no-results');

    function formatKES(value) {
        return 'KES ' + parseInt(value).toLocaleString();
    }

    function filterPackages(budget) {
        let visible = 0;
        cards.forEach(card => {
            const price = parseFloat(card.dataset.price);
            if (price <= budget) {
                card.style.display = 'flex';
                card.style.flexDirection = 'column';
                visible++;
            } else {
                card.style.display = 'none';
            }
        });
        noResults.classList.toggle('hidden', visible > 0);
    }

    slider.addEventListener('input', function () {
        const val = parseInt(this.value);
        display.textContent = val >= 600000 ? 'KES 600,000+' : formatKES(val);
        filterPackages(val >= 600000 ? Infinity : val);
    });

    filterPackages({{ $budget >= 600000 ? 'Infinity' : $budget }});
</script>
@endpush
