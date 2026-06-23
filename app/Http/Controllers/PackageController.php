<?php
namespace App\Http\Controllers;
use App\Models\Package;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $budget   = $request->get('budget', 600000);
        $packages = Package::where('is_active', true)
            ->with('features')
            ->orderBy('sort_order')
            ->get();
        $settings = SiteSetting::pluck('value', 'key');
        return view('packages', compact('packages', 'budget', 'settings'));
    }
}
