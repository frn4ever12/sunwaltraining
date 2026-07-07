@extends('frontend.includes.main-new')

@section('content')
    <!-- Hero Section -->
    @include('welcome.partials.hero-new')

    <!-- Statistics Section -->
    @include('welcome.partials.stats-new')

    <!-- Training Section -->
    @include('welcome.partials.trainings-new')

    <!-- Categories Section -->
    @include('welcome.partials.categories')

    <!-- Success Stories Section -->
    @include('welcome.partials.success-stories')

    <!-- Partners Section -->
    @include('welcome.partners.partners')

    <!-- Photo Gallery Section -->
    @include('welcome.partials.photo-gallery')

    <!-- Video Gallery Section -->
    @include('welcome.partials.video-gallery')

    <!-- Downloads Section -->
    @include('welcome.partials.downloads')

    <!-- Contact Section -->
    @include('welcome.partials.contact')

    <!-- Existing Ward Map and Table -->
    <div class="row g-3 my-3">
        @include('welcome.partials.ward-map')
        @include('welcome.partials.ward-table')
    </div>
@endsection

@section('scripts')
    <script>
        window.wardGenderData = {};

        @foreach ( as )
            window.wardGenderData["{{ ->id }}"] = {
                male_count: {{ ->male_count }},
                female_count: {{ ->female_count }},
                total_count: {{ ->total_count }}
            };
        @endforeach
    </script>
    <script src="{{ asset('dist/map/map.js') }}"></script>
    <script>
        initiateMap('{{ asset('dist/map/map.geojson') }}')
    </script>
@endsection
