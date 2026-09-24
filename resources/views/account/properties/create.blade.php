@extends('layouts.app')

@section('title', 'Submit Property - Real Estate')

@section('content')

<div class="auth-container">

    <h1>Submit Your Property</h1>

    <p>Provide your property details below.</p>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('account.properties.store') }}" enctype="multipart/form-data" >
        @csrf

        <div class="form-group">
            <label for="submitted_as">You are submitting as</label>

            <select id="submitted_as" name="submitted_as" required>
                <option value="">Select</option>
                <option value="owner" @selected(old('submitted_as') === 'owner')>
                    Owner
                </option>
                <option value="agent" @selected(old('submitted_as') === 'agent')>
                    Agent / Broker
                </option>
                <option value="builder" @selected(old('submitted_as') === 'builder')>
                    Builder / Developer
                </option>
                <option value="other" @selected(old('submitted_as') === 'other')>
                    Other
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Property Title</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea
                id="description"
                name="description"
                rows="5"
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose</label>

            <select id="purpose" name="purpose" required>
                <option value="">Select</option>
                <option value="sale" @selected(old('purpose') === 'sale')>
                    Sale
                </option>
                <option value="rent" @selected(old('purpose') === 'rent')>
                    Rent
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="property_type_id">Property Type</label>

            <select id="property_type_id" name="property_type_id" required>
                <option value="">Select Property Type</option>

                @foreach ($propertyTypes as $propertyType)
                    <option
                        value="{{ $propertyType->id }}"
                        @selected(old('property_type_id') == $propertyType->id)
                    >
                        {{ $propertyType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price</label>

            <input
                type="number"
                step="0.01"
                min="0"
                id="price"
                name="price"
                value="{{ old('price') }}"
            >
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms / BHK</label>

            <input
                type="number"
                min="0"
                id="bedrooms"
                name="bedrooms"
                value="{{ old('bedrooms') }}"
            >
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathrooms</label>

            <input
                type="number"
                min="0"
                id="bathrooms"
                name="bathrooms"
                value="{{ old('bathrooms') }}"
            >
        </div>

        <div class="form-group">
            <label for="built_up_area">Built-up Area</label>

            <input
                type="number"
                step="0.01"
                min="0"
                id="built_up_area"
                name="built_up_area"
                value="{{ old('built_up_area') }}"
            >
        </div>

        <div class="form-group">
            <label for="carpet_area">Carpet Area</label>

            <input
                type="number"
                step="0.01"
                min="0"
                id="carpet_area"
                name="carpet_area"
                value="{{ old('carpet_area') }}"
            >
        </div>

        <div class="form-group">
            <label for="floor">Floor</label>

            <input
                type="number"
                min="0"
                id="floor"
                name="floor"
                value="{{ old('floor') }}"
            >
        </div>

        <div class="form-group">
            <label for="total_floors">Total Floors</label>

            <input
                type="number"
                min="0"
                id="total_floors"
                name="total_floors"
                value="{{ old('total_floors') }}"
            >
        </div>

        <div class="form-group">
            <label for="furnishing">Furnishing</label>

            <select id="furnishing" name="furnishing">
                <option value="">Select</option>
                <option value="unfurnished">Unfurnished</option>
                <option value="semi-furnished">Semi Furnished</option>
                <option value="fully-furnished">Fully Furnished</option>
            </select>
        </div>

        <div class="form-group">
            <label>
                <input
                    type="checkbox"
                    name="parking"
                    value="1"
                    style="width:auto"
                    @checked(old('parking'))
                >
                Parking Available
            </label>
        </div>

        <div class="form-group">
            <label>
                <input
                    type="checkbox"
                    name="balcony"
                    value="1"
                    style="width:auto"
                    @checked(old('balcony'))
                >
                Balcony Available
            </label>
        </div>

        <div class="form-group">
            <label for="family_type">Suitable For</label>

            <select id="family_type" name="family_type">
                <option value="">Select</option>
                <option value="family">Family</option>
                <option value="bachelor">Bachelor</option>
                <option value="any">Any</option>
            </select>
        </div>

        <div class="form-group">
            <label for="maximum_persons">Maximum Persons</label>

            <input
                type="number"
                min="1"
                id="maximum_persons"
                name="maximum_persons"
                value="{{ old('maximum_persons') }}"
            >
        </div>

        <div class="form-group">
            <label>
                <input
                    type="checkbox"
                    name="water_available"
                    value="1"
                    style="width:auto"
                    @checked(old('water_available'))
                >
                Water Available
            </label>
        </div>

        <div class="form-group">
            <label>
                <input
                    type="checkbox"
                    name="electricity_available"
                    value="1"
                    style="width:auto"
                    @checked(old('electricity_available'))
                >
                Electricity Available
            </label>
        </div>

        <h3>Amenities</h3>

        <div class="form-group">

            @foreach ($amenities as $amenity)

                <label style="display:block; margin-bottom:8px;">

                    <input
                        type="checkbox"
                        name="amenities[]"
                        value="{{ $amenity->id }}"
                        style="width:auto"
                        @checked(in_array(
                            $amenity->id,
                            old('amenities', [])
                        ))
                    >

                    {{ $amenity->name }}

                </label>

            @endforeach

        </div>

        <h3>Property Images</h3>

        <div class="form-group">

            <label for="images">
                Upload Property Images
            </label>

            <input
                type="file"
                id="images"
                name="images[]"
                accept=".jpg,.jpeg,.png,.webp"
                multiple
            >

            <small>
                You can upload up to 10 images. Maximum 5 MB per image.
            </small>

        </div>

        <h3>Location</h3>

        <div class="form-group">
            <label for="state">State</label>

            <input
                type="text"
                id="state"
                name="state"
                value="{{ old('state') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="city">City</label>

            <input
                type="text"
                id="city"
                name="city"
                value="{{ old('city') }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="locality">Locality</label>

            <input
                type="text"
                id="locality"
                name="locality"
                value="{{ old('locality') }}"
            >
        </div>

        <div class="form-group">
            <label for="address">Address</label>

            <textarea
                id="address"
                name="address"
                rows="3"
            >{{ old('address') }}</textarea>
        </div>

        <div class="form-group">
            <label for="pincode">Pincode</label>

            <input
                type="text"
                id="pincode"
                name="pincode"
                value="{{ old('pincode') }}"
            >
        </div>

        <button type="submit">
            Submit Property
        </button>
    </form>

</div>

@endsection
