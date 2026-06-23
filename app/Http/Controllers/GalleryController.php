<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\EventType;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $eventTypes = EventType::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $selectedType = request('type');
        
        $query = GalleryItem::orderBy('sort_order');
        
        if ($selectedType) {
            $query->where('event_type_id', $selectedType);
        }
        
        $galleryItems = $query->paginate(12);

        return view('gallery.index', compact('galleryItems', 'eventTypes', 'selectedType'));
    }
}
