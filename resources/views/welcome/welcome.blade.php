@extends('frontend.includes.main')
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.1.0/ol.css">
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.1.0/dist/ol.js"></script>
@endsection
@section('content')
    <div class="container">
        @include('welcome.partials.hero')
        @include('welcome.partials.trainings')

        <div class="row g-3 my-3">
            @include('welcome.partials.event-calendar')
            @include('welcome.partials.ward-map')
            @include('welcome.partials.ward-table')
        </div>
        
    </div>
@endsection
@section('scripts')
    <script>
        window.wardGenderData = {};

        @foreach ($wards as $ward)
            window.wardGenderData["{{ $ward->id }}"] = {
                male_count: {{ $ward->male_count }},
                female_count: {{ $ward->female_count }},
                total_count: {{ $ward->total_count }}
            };
        @endforeach
    </script>
    <script src="{{ asset('dist/map/map.js') }}"></script>
    <script>
        initiateMap('{{ asset('dist/map/map.geojson') }}')
    </script>
@endsection
