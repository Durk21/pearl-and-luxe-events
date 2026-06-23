<?php

namespace App\Models;

use App\Events\BookingCreated;
use App\Events\BookingStatusUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $fillable = [
        'reference_number',
        'package_id',
        'client_name',
        'client_email',
        'client_phone',
        'event_date',
        'event_type',
        'guest_count',
        'special_requests',
        'status',
        'total_amount',
        'deposit_amount',
        'deposit_paid',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'deposit_paid' => 'boolean',
        'total_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
    ];

    protected $dispatchesEvents = [
        'created' => BookingCreated::class,
    ];

    protected static function booted(): void
    {
        static::updating(function ($booking) {
            if ($booking->isDirty('status')) {
                $previousStatus = $booking->getOriginal('status');
                event(new BookingStatusUpdated($booking, $previousStatus));
            }
        });
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
