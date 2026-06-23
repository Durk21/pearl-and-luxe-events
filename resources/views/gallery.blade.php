@extends('layouts.app')
@section('title', 'Gallery — Pearl & Luxe Events')

@section('content')

<section class="gradient-primary py-20 text-white text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    <div class="relative z-10">
        <p class="text-pink-200 text-sm font-medium tracking-widest uppercase mb-3">Our Portfolio</p>
        <h1 class="text-5xl font-bold mb-4">Event Gallery</h1>
        <p class="text-purple-100 text-lg max-w-xl mx-auto">Browse through our collection of beautifully crafted events.</p>
    </div>
</section>

<section class="bg-white border-b border-gray-100 sticky top-16 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-4 scrollbar-hide">
            <a href="{{ route('gallery') }}" class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-medium transition-all {{ !request('type') ? 'gradient-primary text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-purple-50 hover:text-purple-600' }}">All Events</a>
            @foreach($eventTypes as $type)
            <a href="{{ route('gallery') }}?type={{ $type->slug }}" class="flex-shrink-0 px-5 py-2 rounded-full text-sm font-medium transition-all {{ request('type') === $type->slug ? 'gradient-primary text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-purple-50 hover:text-purple-600' }}">{{ $type->name }}</a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleryItems->count())
        <p class="text-gray-400 text-sm mb-8">Showing {{ $galleryItems->total() }} photos</p>
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach($galleryItems as $index => $item)
            <div class="break-inside-avoid group relative rounded-2xl overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-300"
                 onclick="openLightbox({{ $index }})">
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                    <div>
                        <p class="text-white font-semibold text-sm">{{ $item->title }}</p>
                        @if($item->eventType)
                        <p class="text-purple-200 text-xs mt-0.5">{{ $item->eventType->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $galleryItems->appends(request()->query())->links() }}
        </div>

        @else
        <div class="text-center py-24">
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No photos yet</h3>
            <p class="text-gray-400 text-sm">Gallery images will appear here once uploaded from the admin panel.</p>
            @if(request('type'))
            <a href="{{ route('gallery') }}" class="text-purple-600 text-sm mt-4 inline-block hover:underline">← View all photos</a>
            @endif
        </div>
        @endif
    </div>
</section>

{{-- LIGHTBOX --}}
<div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4" onclick="closeLightbox()">
    
    {{-- Close button --}}
    <button class="absolute top-4 right-4 text-white/70 hover:text-white z-10 w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition" onclick="closeLightbox()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    {{-- Previous button --}}
    <button id="prev-btn" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition" onclick="event.stopPropagation(); navigateLightbox(-1)">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>

    {{-- Next button --}}
    <button id="next-btn" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition" onclick="event.stopPropagation(); navigateLightbox(1)">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    {{-- Image --}}
    <div class="relative max-w-5xl max-h-full flex flex-col items-center" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" alt="" class="max-h-[80vh] max-w-full rounded-xl object-contain shadow-2xl transition-opacity duration-300">
        <div class="mt-4 text-center">
            <p id="lightbox-title" class="text-white font-semibold text-lg"></p>
            <p id="lightbox-type" class="text-purple-300 text-sm mt-1"></p>
            <p id="lightbox-counter" class="text-white/40 text-xs mt-2"></p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const images = @json($galleryItems->map(fn($item) => [
        'url'   => $item->image_url,
        'title' => $item->title,
        'type'  => $item->eventType->name ?? '',
    ]));

    let currentIndex = 0;

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function updateLightbox() {
        const item = images[currentIndex];
        const img = document.getElementById('lightbox-img');
        img.style.opacity = '0';
        setTimeout(() => {
            img.src = item.url;
            img.onload = () => { img.style.opacity = '1'; };
            document.getElementById('lightbox-title').textContent = item.title;
            document.getElementById('lightbox-type').textContent  = item.type;
            document.getElementById('lightbox-counter').textContent = (currentIndex + 1) + ' / ' + images.length;
        }, 150);
    }

    function navigateLightbox(direction) {
        currentIndex = (currentIndex + direction + images.length) % images.length;
        updateLightbox();
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape')      closeLightbox();
        if (e.key === 'ArrowRight')  navigateLightbox(1);
        if (e.key === 'ArrowLeft')   navigateLightbox(-1);
    });
</script>
@endpush
