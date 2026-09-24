<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            'Lift',
            'Parking',
            'Power Backup',
            'Security',
            'Gym',
            'Swimming Pool',
            'Balcony',
            'Garden',
            'CCTV',
            'Internet',
            'Water Supply',
        ];

        foreach ($amenities as $name) {
            Amenity::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => null,
                    'is_active' => true,
                    'sort_order' => 0,
                ]
            );
        }
    }
}
