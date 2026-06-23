@extends('layouts.app')
@section('title', ($settings['site_name'] ?? 'Pearl & Luxe Events') . ' — Luxury Event Planning in Kenya')

@section('content')

{{-- HERO --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

    {{-- SLIDESHOW BACKGROUND --}}
    <div id="slideshow" class="absolute inset-0 z-0">
        @php $slides = App\Models\GalleryItem::where('is_featured', true)->take(8)->get(); @endphp
        @if($slides->count())
            @foreach($slides as $i => $slide)
            <div class="slide absolute inset-0 bg-cover bg-center transition-opacity duration-[3000ms] {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                 style="background-image: url('{{ $slide->image_url }}')"></div>
            @endforeach
            <div class="absolute inset-0 bg-black/50 z-10"></div>
        @else
            <div class="absolute inset-0 gradient-primary"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        @endif
    </div>

    <div class="absolute top-20 left-10 w-72 h-72 bg-white opacity-5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-pink-300 opacity-10 rounded-full blur-3xl"></div>

    <div class="relative z-20 text-center text-white px-4 max-w-5xl mx-auto">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 rounded-full px-4 py-2 mb-8">
            <span class="w-2 h-2 bg-pink-300 rounded-full animate-pulse"></span>
            <p class="text-pink-100 text-sm font-medium tracking-wider uppercase">
                {{ $settings['hero_tagline'] ?? "Kenya's Premier Event Company" }}
            </p>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            Creating <span class="text-pink-300 italic">Unforgettable</span><br>Moments
        </h1>
        <p class="text-purple-100 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
            {{ $settings['hero_subtitle'] ?? 'From intimate gatherings to grand celebrations — we craft luxury experiences that leave lasting impressions.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('packages.index') }}" class="bg-white text-purple-700 font-semibold px-8 py-4 rounded-full hover:bg-purple-50 transition-all shadow-xl text-base">
                Explore Packages
            </a>
            <a href="{{ route('gallery.index') }}" class="border-2 border-white/60 text-white font-semibold px-8 py-4 rounded-full hover:bg-white/10 transition-all text-base backdrop-blur">
                View Our Work
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16 max-w-3xl mx-auto">
            @foreach([
                [$settings['stat_events'] ?? '500+', 'Events Done'],
                [$settings['stat_rating'] ?? '4.9/5', 'Client Rating'],
                [$settings['stat_guests'] ?? '50K+', 'Happy Guests'],
                [$settings['stat_experience'] ?? '8+', 'Years Experience'],
            ] as $stat)
            <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl p-4">
                <div class="text-2xl font-bold text-white">{{ $stat[0] }}</div>
                <div class="text-purple-200 text-xs mt-1">{{ $stat[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/60 animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- EVENT TYPES --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-purple-600 font-medium text-sm tracking-widest uppercase mb-3">What We Do</p>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Events We Specialise In</h2>
            <p class="text-gray-500 mt-4 max-w-xl mx-auto">Whatever the occasion, we bring expertise, creativity and flawless execution.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($eventTypes as $type)
            <a href="{{ route('gallery.index') }}?type={{ $type->slug }}" class="card-hover group p-8 rounded-2xl border border-gray-100 hover:border-purple-200 text-center cursor-pointer block">
                <div class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @switch($type->icon)
                            @case('rings') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/> @break
                            @case('briefcase') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/> @break
                            @case('cake') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h14a2 2 0 012 2v6zM12 4v3"/> @break
                            @case('graduation') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/> @break
                            @default <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        @endswitch
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $type->name }}</h3>
                <p class="text-purple-600 text-sm font-semibold mb-3">{{ $type->events_count ?? 0 }} Events</p>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">{{ $type->description }}</p>
            </a>
            @empty
            <div class="col-span-2 md:col-span-3 text-center py-12 text-gray-400">
                <p class="text-lg">Event types will appear here once added from the admin panel.</p>
                <a href="/admin" class="text-purple-600 text-sm mt-2 inline-block hover:underline">Go to Admin</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- GALLERY PREVIEW --}}
@if($galleryItems->count())
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-4">
            <div>
                <p class="text-purple-600 font-medium text-sm tracking-widest uppercase mb-3">Our Work</p>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Recent Events</h2>
            </div>
            <a href="{{ route('gallery.index') }}" class="flex items-center gap-2 text-purple-600 font-semibold hover:text-purple-800 transition group">
                View Full Gallery
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[200px]">
            @foreach($galleryItems->take(8) as $i => $item)
            <div class="{{ $i === 0 ? 'col-span-2 row-span-2' : '' }} {{ $i === 3 ? 'col-span-2' : '' }} rounded-2xl overflow-hidden group cursor-pointer relative">
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <div>
                        <p class="text-white font-semibold text-sm">{{ $item->title }}</p>
                        <p class="text-purple-200 text-xs">{{ $item->eventType->name ?? '' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FEATURED PACKAGES --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-purple-600 font-medium text-sm tracking-widest uppercase mb-3">Pricing</p>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900">Our Packages</h2>
            <p class="text-gray-500 mt-4">Transparent pricing — 30% deposit secures your date.</p>
        </div>
        @if($packages->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
            @foreach($packages as $package)
            <div class="relative flex flex-col rounded-2xl border {{ $package->is_featured ? 'border-purple-500 shadow-2xl shadow-purple-100 scale-105' : 'border-gray-200 hover:border-purple-200 hover:shadow-xl' }} transition-all duration-300 overflow-hidden">
                @if($package->is_featured)
                <div class="gradient-primary text-white text-center py-2.5 text-sm font-semibold tracking-wide">Most Popular</div>
                @endif
                <div class="p-8 flex flex-col flex-1">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $package->description }}</p>
                    </div>
                    <div class="mb-6">
                        <span class="text-4xl font-bold gradient-text">KES {{ number_format($package->price) }}</span>
                        <div class="flex items-center gap-4 mt-2 text-sm text-gray-400">
                            <span>Up to {{ $package->max_guests }} guests</span>
                            <span>{{ $package->duration_hours }}hrs</span>
                        </div>
                        <p class="text-purple-600 text-sm font-medium mt-1">Deposit: KES {{ number_format($package->deposit_amount) }}</p>
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
                            <span class="{{ $feature->is_included ? 'text-gray-700' : 'text-gray-400' }}">{{ $feature->feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booking.show', $package->slug) }}" class="block text-center py-3.5 rounded-full font-semibold text-sm transition-all {{ $package->is_featured ? 'gradient-primary text-white shadow-lg hover:opacity-90' : 'border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white' }}">
                        Book {{ $package->name }} Package
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-2 text-purple-600 font-semibold hover:text-purple-800 transition group">
                View all packages &amp; filter by budget
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        @else
        <div class="text-center py-12 text-gray-400">
            <p>Packages will appear here once added from the admin panel.</p>
            <a href="/admin" class="text-purple-600 text-sm mt-2 inline-block hover:underline">Go to Admin</a>
        </div>
        @endif
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="py-24 gradient-primary text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold">Why Pearl &amp; Luxe?</h2>
            <p class="text-purple-100 mt-4 text-lg">We don't just plan events — we create experiences</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'Tailored to You', 'Every event is uniquely designed around your vision, personality and budget.'],
                ['M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'Luxury Standards', 'We source only the finest vendors, venues and suppliers in Kenya.'],
                ['M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'Full Support', 'From first consultation to final cleanup — we handle every detail.'],
            ] as $why)
            <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl p-8 text-center">
                <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $why[0] }}"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $why[1] }}</h3>
                <p class="text-purple-100 text-sm leading-relaxed">{{ $why[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <div class="bg-white rounded-3xl shadow-xl p-12 border border-purple-100">
            <div class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Ready to Plan Your Event?</h2>
            <p class="text-gray-500 mb-8 leading-relaxed">Tell us your vision and we'll make it a reality. Browse our packages, pick your budget and book your date today.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('packages.index') }}" class="gradient-primary text-white font-semibold px-8 py-4 rounded-full hover:opacity-90 transition shadow-lg">Browse Packages</a>
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings['contact_phone'] ?? '254700000000') }}" target="_blank" class="border-2 border-gray-200 text-gray-700 font-semibold px-8 py-4 rounded-full hover:border-purple-300 hover:text-purple-600 transition">
                    Chat on WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

{{-- VIDEOS --}}
@if($videos->count())
<section class="py-24 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-pink-400 font-medium text-sm tracking-widest uppercase mb-3">In Action</p>
            <h2 class="text-4xl md:text-5xl font-bold">Event Highlights</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($videos as $video)
            <div class="rounded-2xl overflow-hidden bg-gray-800">
                @if($video->video_url)
                <div class="relative aspect-video">
                    @php preg_match('/(?:v=|youtu\.be\/)([^&\s]+)/', $video->video_url, $m); $vid = $m[1] ?? null; @endphp
                    @if($vid)
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $vid }}" frameborder="0" allowfullscreen></iframe>
                    @endif
                </div>
                @elseif($video->video_path)
                <div class="relative aspect-video">
                    <video controls class="w-full h-full object-cover"><source src="{{ asset('storage/' . $video->video_path) }}"></video>
                </div>
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-white">{{ $video->title }}</h3>
                    <p class="text-gray-400 text-sm mt-1">{{ $video->event_type }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    const slides = document.querySelectorAll('.slide');
    if (slides.length > 1) {
        let current = 0;
        setInterval(() => {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');
            current = (current + 1) % slides.length;
            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
        }, 5000);
    }
</script>
@endpush


