<?php
namespace App\Http\Controllers;
use App\Models\EventType;
use App\Models\Package;
use App\Models\GalleryItem;
use App\Models\Video;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $eventTypes   = EventType::active()->get();
        $packages     = Package::active()->with('features')->where('is_featured', true)->take(3)->get();
        $galleryItems = GalleryItem::with('eventType')->featured()->take(8)->get();
        $videos       = Video::active()->take(3)->get();
        $settings     = SiteSetting::pluck('value', 'key');
        return view('home', compact('eventTypes', 'packages', 'galleryItems', 'videos', 'settings'));
    }
}
