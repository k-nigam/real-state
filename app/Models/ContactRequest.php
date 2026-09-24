<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactRequest extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'requester_type',
        'purpose',
        'property_type_id',
        'bedrooms',
        'preferred_location',
        'budget_min',
        'budget_max',
        'number_of_people',
        'family_type',
        'preferred_floor',
        'water_required',
        'electricity_required',
        'additional_requirements',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
            'water_required' => 'boolean',
            'electricity_required' => 'boolean',
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
}
