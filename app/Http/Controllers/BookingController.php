<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function show(Package $package)
    {
        return view('booking.show', compact('package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'event_date' => 'required|date|after:today',
            'event_type' => 'required|string|max:255',
            'guest_count' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        // Generate unique reference number
        $referenceNumber = 'PLE-' . strtoupper(uniqid());

        // Get package for calculations
        $package = Package::find($validated['package_id']);
        
        // Calculate amounts
        $totalAmount = $package->price;
        $depositAmount = $totalAmount * ($package->deposit_percentage / 100);

        // Create booking
        $booking = Booking::create([
            'reference_number' => $referenceNumber,
            'package_id' => $validated['package_id'],
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'event_date' => $validated['event_date'],
            'event_type' => $validated['event_type'],
            'guest_count' => $validated['guest_count'],
            'special_requests' => $validated['special_requests'],
            'status' => 'pending',
            'total_amount' => $totalAmount,
            'deposit_amount' => $depositAmount,
            'deposit_paid' => false,
        ]);

        return redirect()->route('booking.confirmation', $booking->reference_number)
            ->with('success', 'Booking created successfully! Check your email for confirmation.');
    }

    public function confirmation($referenceNumber)
    {
        $booking = Booking::where('reference_number', $referenceNumber)->firstOrFail();
        
        return view('booking.confirmation', compact('booking'));
    }
}
