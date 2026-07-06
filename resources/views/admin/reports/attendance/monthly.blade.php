@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">मासिक उपस्थिती</h3>
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
                <a href="#">मासिक उपस्थिती</a>
            </li>
        </ul>
    </div>

    <div class="card mb-4">
        <div class="card-body text-center">
            <h5 class="fw-bold">सुनवल नगरपालिका</h5>
            <h6 class="fw-bold">कार्यपालिकाको कार्यालय</h6>
            <p class="mb-0">सुनवल बजार, नवलपरासी (बर्दघाट सुस्ता पश्चिम), लुम्बिनी प्रदेश, नेपाल</p>
            <p class="mb-0">नवलपरासी (बर्दघाट सुस्ता पश्चिम), लुम्बिऴी, नेपाल</p>
        </div>
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
            <form method="GET" id="filterData" action="{{ route('admin.reports.attendance.monthly') }}">
                <div class="row g-2">
                    <div class="form-group col-md-3 col-12">
                        <select name="month" class="form-control">
                            <option value="">महिना छान्नुहोस्</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <input type="number" name="year" class="form-control" placeholder="वर्ष"
                            value="{{ request('year') }}">
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <select name="training_id" class="form-control">
                            <option value="">सबै तालिम</option>
                            @foreach($trainings as $training)
                                <option value="{{ $training->id }}" {{ request('training_id') == $training->id ? 'selected' : '' }}>
                                    {{ $training->name_np }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <a href="{{ route('admin.reports.attendance.monthly') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="monthlyAttendanceTable">
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
            $('#monthlyAttendanceTable').DataTable({
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
