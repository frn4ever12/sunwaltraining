@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">सहभागी उपस्थिती</h3>
        <ul class="mb-3 breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">प्रतिवेदन</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">सहभागी उपस्थिती</a>
            </li>
        </ul>
    </div>

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
        <div class="card-body">
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
                            <td>{{ $attendance->training->name_np ?? '-' }}</td>
                            <td>{{ $attendance->trainingApplication->fullname_np ?? '-' }}</td>
                            <td>{{ $attendance->attendance_date ?? '-' }}</td>
                            <td>
                                @if($attendance->status == 'present')
                                    <span class="badge bg-success">उपस्थित</span>
                                @elseif($attendance->status == 'absent')
                                    <span class="badge bg-danger">अनुपस्थित</span>
                                @else
                                    <span class="badge bg-secondary">{{ $attendance->status ?? '-' }}</span>
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
