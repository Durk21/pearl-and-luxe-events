<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'event_type_id', 'image_path',
        'is_featured', 'sort_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}