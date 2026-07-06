@extends('frontend.includes.main')
@section('head')
    <style>
        iframe {
            border: 0;
            width: 100%;
            height: 50vh;
        }

        input[type="time"] {
            border: none;
            outline: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;

            background: transparent;
            font-size: 16px;
            color: #333;
            padding: 0px 5px;
        }

        input[type="time"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
    </style>
@endsection
@section('content')
    <div aria-label="breadcrumb" style="border-bottom: 1px solid rgb(237, 237, 237);">
        <div class="container mb-0">
            <ol class="breadcrumb  p-2 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-main"><i
                            class="bi bi-house-door me-2"></i>गृह पृष्ठ</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('training.index') }}" class="text-main">तालिमहरू</a></li>
                <li class="breadcrumb-item active">{{ $training->name_np }}</li>
            </ol>
        </div>
    </div>
    <div class="container py-4 mb-2">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
            <div class="w-75 d-flex align-items-center gap-4">
                <div class="card p-2">
                    <img src="{{ asset('dist/img/training.png') }}" alt="Training" width="56" />
                </div>
                <div>
                    <h4 class="mb-1 fw-bold text-main">{{ $training->name_np }}</h4>
                    @if (isset($training->trainer_name_np))
                        <small class="text-muted fw-bold"><i class="fa fa-user"></i>
                            {{ $training->trainer_name_np ?? '' }}</small>
                    @endif
                </div>
            </div>

            <div class="w-25 d-flex gap-2 ">
                @if (auth()->check() && auth()->user()->hasAppliedToTraining($training->id))
                    <a href="{{ route('admin.application.index') }}" class="w-50 btn btn-sm btn-warning fs-6"
                        style="line-height: 1.8;">आवेदन दिइसक्नुभएको छ।</a>
                @else
                    @if ($training->status === 'upcoming' && $training->training_applications_count < $training->available_seats)
                        <a href="{{ route('training-application.index', $training->id) }}" class="w-50 btn btn-sm btn-main" onclick="return confirm('के तपाईंले आवेदन दिन खोज्नु भएको हो?')"
                            style="padding:6px 0;">
                            <i class="fa fa-reply me-2"></i> आवेदन दिनुहोस्
                        </a>
                    @else
                        <div class="w-50 btn btn-sm btn-secondary disabled" style="padding:6px 0;">
                            <i class="fa fa-times me-2"></i> सिट भरिएको छ
                        </div>
                    @endif
                @endif
                <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-arrow-left me-2"></i>
                    फर्किनुहोस् </a>
            </div>
        </div>

        @include('shared.Training.show')
    </div>
@endsection
