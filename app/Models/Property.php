<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'submitted_as',
        'title',
        'slug',
        'description',
        'purpose',
        'property_type_id',
        'price',
        'security_deposit',
        'maintenance_charge',
        'bedrooms',
        'bathrooms',
        'built_up_area',
        'carpet_area',
        'floor',
        'total_floors',
        'furnishing',
        'property_age',
        'parking',
        'balcony',
        'family_type',
        'maximum_persons',
        'water_available',
        'electricity_available',
        'state',
        'city',
        'locality',
        'address',
        'pincode',
        'latitude',
        'longitude',
        'status',
        'rejection_reason',
        'published_at',
        'booked_at',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'security_deposit' => 'decimal:2',
            'maintenance_charge' => 'decimal:2',
            'built_up_area' => 'decimal:2',
            'carpet_area' => 'decimal:2',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'parking' => 'boolean',
            'balcony' => 'boolean',
            'water_available' => 'boolean',
            'electricity_available' => 'boolean',
            'published_at' => 'datetime',
            'booked_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function amenities(): BelongsToMany
    {
       return $this->belongsToMany(Amenity::class, 'property_amenities');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }
}
