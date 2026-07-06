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
                <h5 class="mb-0">उपस्थिती खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.attendance.participant') }}">
                <div class="row g-2">
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="application_no" class="form-control" placeholder="आवेदन नं."
                            value="{{ request('application_no') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input type="date" name="start_date" class="form-control" placeholder="सुरु मिति"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input type="date" name="end_date" class="form-control" placeholder="अन्त्य मिति"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <a href="{{ route('admin.reports.attendance.participant') }}" class="btn btn-secondary w-100">रिसेट</a>
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

            <h2 class="fw-bold mt-4">सहभागी उपस्थिती प्रतिवेदन</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="participantAttendanceTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>तालिम</th>
                            <th>आवेदक</th>
                            <th>उपस्थिती मिति</th>
                            <th>स्थिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $index => $attendance)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $attendance['training']->name_np ?? '-' }}</td>
                            <td>{{ $attendance['trainingApplication']->fullname_np ?? '-' }}</td>
                            <td>{{ $attendance['attendance_date'] ?? '-' }}</td>
                            <td>
                                @if($attendance['status'] == 'present')
                                    <span class="badge bg-success">उपस्थित</span>
                                @else
                                    <span class="badge bg-danger">अनुपस्थित</span>
                                @endif
                            </td>
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
            $('#participantAttendanceTable').DataTable({
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
@endsection
