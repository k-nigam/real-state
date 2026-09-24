@extends('layouts.app')

@section('title', 'My Listings - Real Estate')

@section('content')

<div class="auth-container">

    <h1>My Listings</h1>

    <p>
        Properties submitted by you.
    </p>

    <div style="margin: 20px 0;">
        <a href="{{ route('account.properties.create') }}">
            Submit New Property
        </a>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($properties as $property)

        <div style="
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
        ">

            @if ($property->images->isNotEmpty())

            <div
                class="property-slider"
                data-property-slider
                style="
                    position: relative;
                    max-width: 500px;
                    margin-bottom: 20px;
                "
            >

                @foreach ($property->images as $index => $image)

                    <img
                        src="{{ asset('storage/' . $image->path) }}"
                        alt="{{ $property->title }}"
                        loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                        data-slide
                        style="
                            width: 100%;
                            height: 300px;
                            object-fit: cover;
                            border-radius: 8px;
                            display: {{ $index === 0 ? 'block' : 'none' }};
                        "
                    >

                @endforeach

                @if ($property->images->count() > 1)

                    <button
                        type="button"
                        data-prev
                        style="
                            position: absolute;
                            left: 10px;
                            top: 50%;
                            transform: translateY(-50%);
                            padding: 10px 15px;
                            border: none;
                            border-radius: 50%;
                            cursor: pointer;
                        "
                    >
                        ←
                    </button>

                    <button
                        type="button"
                        data-next
                        style="
                            position: absolute;
                            right: 10px;
                            top: 50%;
                            transform: translateY(-50%);
                            padding: 10px 15px;
                            border: none;
                            border-radius: 50%;
                            cursor: pointer;
                        "
                    >
                        →
                    </button>

                    <div
                        data-counter
                        style="
                            position: absolute;
                            bottom: 10px;
                            right: 10px;
                            padding: 5px 10px;
                            background: rgba(0,0,0,0.6);
                            color: white;
                            border-radius: 4px;
                        "
                    >
                        1 / {{ $property->images->count() }}
                    </div>

                @endif

            </div>

            @endif
            <h2>{{ $property->title }}</h2>

            <p>
                <strong>Property Type:</strong>
                {{ $property->propertyType->name }}
            </p>

            <p>
                <strong>Purpose:</strong>
                {{ ucfirst($property->purpose) }}
            </p>

            <p>
                <strong>Price:</strong>
                ₹{{ number_format((float) $property->price, 2) }}
            </p>

            <p>
                <strong>Location:</strong>
                {{ $property->locality }},
                {{ $property->city }},
                {{ $property->state }}
            </p>

            <p>
                <strong>Submitted As:</strong>
                {{ ucfirst($property->submitted_as) }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ ucfirst(str_replace('_', ' ', $property->status)) }}
            </p>

            <p>
                <strong>Amenities:</strong>
    
                @forelse ($property->amenities as $amenity)
                    {{ $amenity->name }}@if (!$loop->last), @endif
                @empty
                    None selected
                @endforelse
            </p>

            <p>
                <strong>Submitted:</strong>
                {{ $property->created_at->format('d M Y, h:i A') }}
            </p>

        </div>

    @empty

        <p>
            You have not submitted any properties yet.
        </p>

    @endforelse

    {{ $properties->links() }}

</div>

@endsection

@push('scripts')
<script>
document.querySelectorAll('[data-property-slider]').forEach(function (slider) {

    const slides = slider.querySelectorAll('[data-slide]');
    const previousButton = slider.querySelector('[data-prev]');
    const nextButton = slider.querySelector('[data-next]');
    const counter = slider.querySelector('[data-counter]');

    let currentIndex = 0;

    function showSlide(index) {

        if (index < 0) {
            index = slides.length - 1;
        }

        if (index >= slides.length) {
            index = 0;
        }

        slides.forEach(function (slide, slideIndex) {
            slide.style.display =
                slideIndex === index ? 'block' : 'none';
        });

        currentIndex = index;

        if (counter) {
            counter.textContent =
                (currentIndex + 1) + ' / ' + slides.length;
        }
    }

    if (previousButton) {
        previousButton.addEventListener('click', function () {
            showSlide(currentIndex - 1);
        });
    }

    if (nextButton) {
        nextButton.addEventListener('click', function () {
            showSlide(currentIndex + 1);
        });
    }

});
</script>
@endpush