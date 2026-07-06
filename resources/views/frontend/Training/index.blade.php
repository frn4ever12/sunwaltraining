@extends('frontend.includes.main')

@section('content')
    <div aria-label="breadcrumb" style="border-bottom: 1px solid rgb(237, 237, 237);">
        <div class="container mb-0">
            <ol class="breadcrumb  p-2 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-main"><i
                            class="bi bi-house-door me-2"></i>गृह पृष्ठ</a>
                </li>
                <li class="breadcrumb-item active">तालिमहरू</li>
            </ol>
        </div>
    </div>
    <div class="container py-4">
        <div class="card border-0 mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class=" fw-bold">तालिम खोज्नुहोस्</h5>
                </div>
                <form method="GET" action="{{ route('training.index') }}">
                    <div class="row g-2">
                        <div class="col-md-4 col-sm-6">
                            <input type="text" name="training_name" class="form-control" placeholder="तालिम"
                                value="{{ request('training_name') }}">
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <select class="form-control" name="category" id="">
                                <option value="">क्याटेगोरी छान्नुहोस्</option>
                                @foreach (\App\Models\Category::select('id', 'name_np')->get() as $data)
                                    <option value="{{ $data->id }}" {{ request('category')==$data->id?'selected':'' }}>{{ $data->name_np }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <input type="text" name="entry_date" class="form-control nepali-datepicker"
                                placeholder="मिति देखि" value="{{ request('entry_date') }}">
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <input type="text" id="nepali-datepicker" name="end_date"
                                class="form-control nepali-datepicker" placeholder="मिति सम्म"
                                value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <button class="btn btn-main w-100"><i class="fa fa-search me-2"></i>खोज्नुहोस्</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="fw-bold">तालिमहरू</h5>
                </div>

                <div class="row g-4">
                    @foreach ($trainings as $training)
                        <div class="col-md-4 col-sm-12">
                            <div class="card h-100 ">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <a class="d-block talim-btn bg-white d-flex align-items-center"
                                            href="{{ route('training.show', $training->id) }}">
                                            <div class="talim-date text-center py-2 px-3 rounded  me-3 fw-bold ">
                                           <small>{{ \App\Helpers\NumberHelper::toNepaliNumber(\Carbon\Carbon::parse($training->start_miti_bs)->format('d')) }}</small><br>
                                        <small>{{ \App\Helpers\NumberHelper::toNepaliMonth(\Carbon\Carbon::parse($training->start_miti_bs)->format('m')) }}</small>
                                            </div>
                                            <div class="text-main fw-bold">
                                                <h6 class="fw-bold pt-3">{{ $training->name_np ?? '' }}</h6>
                                                @if (isset($training->trainer_name_np))
                                                    <small class="text-secondary" style="font-size: 0.75rem;"><i
                                                            class="fas fa-user me-1"></i>
                                                        {{ $training->trainer_name_np ?? ($training->trainer_name_eng ?? '') }}</small>
                                                @endif
                                            </div>
                                            <div class="position-absolute top-0 end-0 "><button
                                                    style="font-size: 0.80rem;padding:3px 6px;"
                                                    class="btn fw-bold btn-sm 
                                                @if ($training->status == 'active') btn-success 
                                                @elseif($training->status == 'completed') 
                                                    btn-secondary 
                                                @elseif($training->status == 'upcoming') 
                                                    btn-upcoming 
                                                @elseif($training->status == 'dismissed') 
                                                    btn-danger 
                                                @else 
                                                    btn-primary @endif">
                                                    {{ __('messages.' . $training->status) }}
                                                </button>
                                            </div>
                                        </a>
                                    </div>
                                    <div class=" d-flex justify-content-between gap-2">
                                        <a href="{{ route('training.show', $training->id) }}"
                                            class="w-100 btn btn-sm detail-btn" style="padding:6px 0;"><i
                                                class="fa fa-eye me-2"></i> विवरण हेर्नुहोस्</a>
                                        @if (auth()->check() && auth()->user()->hasAppliedToTraining($training->id))
                                            <a href="{{ route('admin.application.index') }}"
                                                class="d-block w-100 btn btn-sm btn-warning" style="line-height: 1.8;">आवेदन
                                                दिइसक्नुभएको छ।</a>
                                        @else
                                        @if ($training->status === 'upcoming' && $training->training_applications_count < $training->available_seats)
                                        <a href="{{ route('training-application.index', $training->id) }}"
                                            class="w-100 btn btn-sm btn-main" style="padding:6px 0;">
                                            <i class="fa fa-reply me-2"></i> आवेदन दिनुहोस्
                                        </a>
                                    @else
                                        <div class="w-100 btn btn-sm btn-secondary disabled" style="padding:6px 0;">
                                            <i class="fa fa-times me-2"></i> सिट भरिएको छ
                                        </div>
                                    @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $trainings->withQueryString()->links() }}
    </div>
@endsection
@section('scripts')
    <script>
        var dateElements = document.querySelectorAll(".nepali-datepicker");
        dateElements.forEach(function(dateElement) {
            dateElement.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });
        });
    </script>
@endsection
