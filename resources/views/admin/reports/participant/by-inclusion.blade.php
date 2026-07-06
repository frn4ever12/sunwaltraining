@extends('admin.includes.main')

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
                <h5 class="mb-0">मिति छान्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.participant.by-inclusion') }}">
                <div class="row g-2">
                    <div class="form-group col-md-6 col-12">
                        <input type="text" name="start_miti_bs" placeholder="सुरु मिति (YYYY-MM-DD)"
                            class="form-control nepali-datepicker" value="{{ request('start_miti_bs') }}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <input type="text" name="end_miti_bs" placeholder="अन्त्य मिति (YYYY-MM-DD)"
                            class="form-control nepali-datepicker" value="{{ request('end_miti_bs') }}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <a href="{{ route('admin.reports.participant.by-inclusion') }}" class="btn btn-secondary w-100">रिसेट</a>
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

            <h2 class="fw-bold mt-4">समावेशीकरण अनुसार सहभागी प्रतिवेदन</h2>
            <div class="row">
                <div class="col-md-2 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h3>{{ $inclusionStats['dalit'] ?? 0 }}</h3>
                            <p class="mb-0">दलित</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h3>{{ $inclusionStats['janajati'] ?? 0 }}</h3>
                            <p class="mb-0">जनजाति</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h3>{{ $inclusionStats['madhesi'] ?? 0 }}</h3>
                            <p class="mb-0">मधेसी</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h3>{{ $inclusionStats['brahmin'] ?? 0 }}</h3>
                            <p class="mb-0">ब्राह्मण</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body text-center">
                            <h3>{{ $inclusionStats['other'] ?? 0 }}</h3>
                            <p class="mb-0">अन्य</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <h3>{{ array_sum($inclusionStats) }}</h3>
                            <p class="mb-0">कुल</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#filterToggle').click(function() {
                $('#filterForm').collapse('toggle');
            });
        });
    </script>
    <script src="{{ asset('Backend/assets/js/print.js') }}"></script>
@endsection
