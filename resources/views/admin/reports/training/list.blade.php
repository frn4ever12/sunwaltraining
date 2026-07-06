@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <section class="mb-3">
        <div class="d-flex justify-content-end align-items-center">
            <button class="btn btn-primary" type="button" onclick="printReport()"><i
                    class="fa fa-print"></i>&nbsp;&nbsp;मुद्रण</button>
        </div>
    </section>

    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">तालिम खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.training.list') }}">
                <div class="row g-2">
                    <div class="form-group col-md-3 col-12">
                        <input type="text" name="name_np" class="form-control" placeholder="तालिमको नाम"
                            value="{{ request('name_np') }}">
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <select name="category" class="form-control">
                            <option value="">सबै कोटी</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_np }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <select name="status" class="form-control">
                            <option value="">सबै स्थिति</option>
                            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>आगामी</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>चलिरहेको</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>सम्पन्न</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <input type="text" name="start_miti_bs" placeholder="सुरु मिति (YYYY-MM-DD)"
                            class="form-control nepali-datepicker" value="{{ request('start_miti_bs') }}">
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <input type="text" name="end_miti_bs" placeholder="अन्त्य मिति (YYYY-MM-DD)"
                            class="form-control nepali-datepicker" value="{{ request('end_miti_bs') }}">
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <a href="{{ route('admin.reports.training.list') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>

    <div class="card shadow-sm my-4" id="printSection">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-2">
                    <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" class="img-fluid"
                        style="max-height: 90px;">
                </div>
                <div class="col-8 text-center text-danger">
                    <h2 class="fw-bold"><b>{{ get_detail()->palika_name ?? '' }}</b></h2>
                    <h3 class="fw-bold"><b>{{ get_detail()->palika_karyalaya ?? '' }}</b></h3>
                    <h5 class="fw-bold npNum"><b>{{ get_detail()->address ?? '' }},
                            {{ get_detail()->district->name ?? '' }}</b></h5>
                    <p class="fw-bold mb-0"><b>{{ get_detail()->province->name ?? '' }}, नेपाल</b></p>
                </div>
                <div class="col-2 text-end">
                    @if (isset(get_detail()->logo))
                        <img src="{{ route('file.show', urlencode('/' . get_detail()->logo)) }}" class="img-fluid"
                            style="max-height: 90px;">
                    @endif
                </div>
            </div>

            <h2 class="fw-bold mt-4">तालिम सूची प्रतिवेदन</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="trainingTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>तालिमको नाम (नेपाली)</th>
                            <th>तालिमको नाम (English)</th>
                            <th>सुरु मिति</th>
                            <th>अन्त्य मिति</th>
                            <th>समय</th>
                            <th>स्थिति</th>
                            <th>उपलब्ध सीट</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainings as $index => $training)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $training->name_np ?? '-' }}</td>
                            <td>{{ $training->name_eng ?? '-' }}</td>
                            <td>{{ $training->start_miti_bs ?? '-' }}</td>
                            <td>{{ $training->end_miti_bs ?? '-' }}</td>
                            <td>{{ $training->start_samaya ?? '-' }} - {{ $training->end_samaya ?? '-' }}</td>
                            <td>
                                @if($training->status == 'upcoming')
                                    <span class="badge bg-info">आगामी</span>
                                @elseif($training->status == 'ongoing')
                                    <span class="badge bg-success">चलिरहेको</span>
                                @elseif($training->status == 'completed')
                                    <span class="badge bg-secondary">सम्पन्न</span>
                                @else
                                    <span class="badge bg-warning">{{ $training->status ?? '-' }}</span>
                                @endif
                            </td>
                            <td>{{ $training->available_seats ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.includes.datatables-scripts')
    <script>
        $(document).ready(function() {
            $('#trainingTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ne.json"
                },
                order: [[3, 'desc']]
            });

            $('#filterToggle').click(function() {
                $('#filterForm').collapse('toggle');
            });
        });
    </script>
    <script src="{{ asset('Backend/assets/js/print.js') }}"></script>
@endsection
