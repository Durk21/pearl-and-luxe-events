<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventType;
use App\Models\Package;
use App\Models\PackageFeature;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Site Settings (all editable from admin) ──
        $settings = [
            // Stats
            ['key' => 'stat_events',      'value' => '500+',   'group' => 'stats'],
            ['key' => 'stat_rating',       'value' => '4.9/5',  'group' => 'stats'],
            ['key' => 'stat_guests',       'value' => '50K+',   'group' => 'stats'],
            ['key' => 'stat_experience',   'value' => '8+',     'group' => 'stats'],

            // Hero
            ['key' => 'hero_tagline',      'value' => "Kenya's Premier Event Company", 'group' => 'hero'],
            ['key' => 'hero_title',        'value' => 'Creating Unforgettable Moments', 'group' => 'hero'],
            ['key' => 'hero_subtitle',     'value' => 'From intimate gatherings to grand celebrations — we craft luxury experiences that leave lasting impressions.', 'group' => 'hero'],

            // Contact
            ['key' => 'contact_phone',     'value' => '+254 700 000 000',           'group' => 'contact'],
            ['key' => 'contact_email',     'value' => 'bookings@pearlandluxe.co.ke','group' => 'contact'],
            ['key' => 'contact_address',   'value' => 'Nairobi, Kenya',             'group' => 'contact'],
            ['key' => 'contact_hours',     'value' => 'Mon–Sat, 8am–6pm',           'group' => 'contact'],

            // Social
            ['key' => 'social_facebook',   'value' => '#', 'group' => 'social'],
            ['key' => 'social_instagram',  'value' => '#', 'group' => 'social'],
            ['key' => 'social_whatsapp',   'value' => '#', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // ── Event Types ──
        $eventTypes = [
            ['name' => 'Weddings',     'slug' => 'weddings',    'icon' => 'rings',      'description' => 'Elegant wedding ceremonies and receptions tailored to your love story.', 'events_count' => '120+', 'sort_order' => 1],
            ['name' => 'Corporate',    'slug' => 'corporate',   'icon' => 'briefcase',  'description' => 'Professional corporate events, conferences, and team-building experiences.', 'events_count' => '80+',  'sort_order' => 2],
            ['name' => 'Birthdays',    'slug' => 'birthdays',   'icon' => 'cake',       'description' => 'Memorable birthday celebrations from intimate parties to grand galas.', 'events_count' => '150+', 'sort_order' => 3],
            ['name' => 'Graduations',  'slug' => 'graduations', 'icon' => 'graduation', 'description' => 'Celebrate academic milestones with style and sophistication.', 'events_count' => '60+',  'sort_order' => 4],
            ['name' => 'Social',       'slug' => 'social',      'icon' => 'party',      'description' => 'Social gatherings, cocktail parties, and community celebrations.', 'events_count' => '70+',  'sort_order' => 5],
            ['name' => 'Music Events', 'slug' => 'music',       'icon' => 'music',      'description' => 'Concerts, music festivals, and live entertainment events.', 'events_count' => '40+',  'sort_order' => 6],
        ];

        foreach ($eventTypes as $type) {
            EventType::updateOrCreate(['slug' => $type['slug']], $type);
        }

        // ── Packages ──
        $packages = [
            [
                'name'               => 'Silver',
                'slug'               => 'silver',
                'description'        => 'Perfect for intimate gatherings and small celebrations.',
                'price'              => 85000,
                'max_guests'         => 50,
                'duration_hours'     => 6,
                'venue_type'         => 'Indoor',
                'deposit_percentage' => 30,
                'is_active'          => true,
                'is_featured'        => false,
                'sort_order'         => 1,
                'features' => [
                    'Event Planning & Coordination',
                    'Basic Décor & Floral Arrangement',
                    'Sound System & Microphone',
                    'Event MC',
                    'Photography (4 Hours)',
                    'Catering Not Included',
                    'Venue Not Included',
                ],
            ],
            [
                'name'               => 'Gold',
                'slug'               => 'gold',
                'description'        => 'Our most popular package for medium-sized events.',
                'price'              => 185000,
                'max_guests'         => 150,
                'duration_hours'     => 8,
                'venue_type'         => 'Indoor/Outdoor',
                'deposit_percentage' => 30,
                'is_active'          => true,
                'is_featured'        => true,
                'sort_order'         => 2,
                'features' => [
                    'Full Event Planning & Coordination',
                    'Premium Décor & Floral Arrangements',
                    'Professional Sound & Lighting',
                    'Event MC & Entertainment',
                    'Photography & Videography (Full Day)',
                    'Catering for 150 Guests',
                    'Venue Sourcing Assistance',
                ],
            ],
            [
                'name'               => 'Platinum',
                'slug'               => 'platinum',
                'description'        => 'The ultimate luxury experience for grand celebrations.',
                'price'              => 350000,
                'max_guests'         => 500,
                'duration_hours'     => 12,
                'venue_type'         => 'Any Venue',
                'deposit_percentage' => 30,
                'is_active'          => true,
                'is_featured'        => false,
                'sort_order'         => 3,
                'features' => [
                    'Dedicated Event Director',
                    'Luxury Décor & Custom Floral Design',
                    'Premium AV & Lighting Production',
                    'Celebrity MC Option',
                    'Full Photography & Cinematic Videography',
                    'Catering & Bar for 500 Guests',
                    'Venue Booking & Management',
                ],
            ],
        ];

        foreach ($packages as $packageData) {
            $features = $packageData['features'];
            unset($packageData['features']);

            $package = Package::updateOrCreate(['slug' => $packageData['slug']], $packageData);

            // Clear old features and re-seed
            $package->features()->delete();
            foreach ($features as $i => $feature) {
                PackageFeature::create([
                    'package_id'  => $package->id,
                    'feature'     => $feature,
                    'is_included' => true,
                    'sort_order'  => $i,
                ]);
            }
        }
    }
}