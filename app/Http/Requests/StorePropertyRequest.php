<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'submitted_as' => [
                'required',
                Rule::in([
                    'owner',
                    'agent',
                    'builder',
                    'other',
                ]),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'purpose' => [
                'required',
                Rule::in([
                    'sale',
                    'rent',
                ]),
            ],

            'property_type_id' => [
                'required',
                'integer',
                'exists:property_types,id',
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'security_deposit' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'maintenance_charge' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'bedrooms' => [
                'nullable',
                'integer',
                'min:0',
                'max:255',
            ],

            'bathrooms' => [
                'nullable',
                'integer',
                'min:0',
                'max:255',
            ],

            'built_up_area' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'carpet_area' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'floor' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'total_floors' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'furnishing' => [
                'nullable',
                'string',
                'max:50',
            ],

            'property_age' => [
                'nullable',
                'integer',
                'min:0',
                'max:200',
            ],

            'parking' => [
                'nullable',
                'boolean',
            ],

            'balcony' => [
                'nullable',
                'boolean',
            ],

            'family_type' => [
                'nullable',
                Rule::in([
                    'family',
                    'bachelor',
                    'any',
                ]),
            ],

            'maximum_persons' => [
                'nullable',
                'integer',
                'min:1',
                'max:255',
            ],

            'water_available' => [
                'nullable',
                'boolean',
            ],

            'electricity_available' => [
                'nullable',
                'boolean',
            ],

            'state' => [
                'required',
                'string',
                'max:100',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'locality' => [
                'nullable',
                'string',
                'max:150',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'pincode' => [
                'nullable',
                'string',
                'max:10',
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],
            
            'amenities' => [
                'nullable',
                'array',
            ],

            'amenities.*' => [
                'integer',
                'exists:amenities,id',
            ],
            
            'images' => [
                'nullable',
                'array',
                'max:10',
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ];
    }
}
