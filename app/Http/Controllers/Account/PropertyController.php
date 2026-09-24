<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Amenity;
use App\Models\PropertyImage;
use Illuminate\Http\UploadedFile;

class PropertyController extends Controller
{
    public function index(): View
    {
        $properties = Property::query()
            ->where('user_id', Auth::id())
            ->with([
                'propertyType',
                'amenities',
                'images',
            ])
            ->latest()
            ->paginate(10);

        return view('account.properties.index', [
            'properties' => $properties,
        ]);
    }

    public function store(StorePropertyRequest $request): RedirectResponse
    {
        $data = $request->validated();
    
        $amenityIds = $data['amenities'] ?? [];
        $images = $data['images'] ?? [];
    
        unset($data['amenities'], $data['images']);
    
        $data['user_id'] = Auth::id();
        $data['slug'] = $this->generateUniqueSlug($data['title']);
        $data['status'] = 'submitted';
    
        $property = Property::create($data);
    
        if (!empty($amenityIds)) {
            $property->amenities()->attach($amenityIds);
        }
    
        foreach ($images as $index => $image) {
            $path = $image->store('properties', 'public');
    
            $property->images()->create([
                'path' => $path,
                'original_name' => $image->getClientOriginalName(),
                'mime_type' => $image->getMimeType(),
                'size' => $image->getSize(),
                'is_primary' => $index === 0,
                'sort_order' => $index,
            ]);
        }
    
        return redirect()
            ->route('account.properties.index')
            ->with('success', 'Your property has been submitted successfully.');
    }

    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (Property::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function create(): View
    {
        $propertyTypes = PropertyType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $amenities = Amenity::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('account.properties.create', [
            'propertyTypes' => $propertyTypes,
            'amenities' => $amenities,
        ]);
    }
}
