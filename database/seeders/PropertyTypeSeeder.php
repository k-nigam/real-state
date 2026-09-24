<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $propertyTypes = [
            'Flat',
            'House',
            'Villa',
            'Plot',
            'Commercial',
            'Office',
            'Shop',
            'Warehouse',
        ];

        foreach ($propertyTypes as $name) {
            PropertyType::updateOrCreate(
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
