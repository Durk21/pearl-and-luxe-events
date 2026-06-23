<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Package extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'description', 'price',
        'max_guests', 'duration_hours', 'venue_type',
        'deposit_percentage', 'is_active', 'is_featured', 'sort_order'
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'price'       => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function features()
    {
        return $this->hasMany(PackageFeature::class)->orderBy('sort_order');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getDepositAmountAttribute()
    {
        return ($this->price * $this->deposit_percentage) / 100;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeInBudget($query, $budget)
    {
        return $query->where('price', '<=', $budget);
    }
}