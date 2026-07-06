@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">स्वीकृत आवेदन</h3>
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
                <a href="#">स्वीकृत आवेदन</a>
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
                <h5 class="mb-0">आवेदन खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.application.approved') }}">
                <div class="row g-2">
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="fullname_np" class="form-control" placeholder="आवेदकको नाम"
                            value="{{ request('fullname_np') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="application_no" class="form-control" placeholder="आवेदन नं."
                            value="{{ request('application_no') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="start_miti_bs" placeholder="सुरु मिति (YYYY-MM-DD)"
                            class="form-control nepali-datepicker" value="{{ request('start_miti_bs') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="end_miti_bs" placeholder="अन्त्य मिति (YYYY-MM-DD)"
                            class="form-control nepali-datepicker" value="{{ request('end_miti_bs') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <a href="{{ route('admin.reports.application.approved') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="approvedApplicationsTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>आवेदन नं.</th>
                            <th>नाम (नेपाली)</th>
                            <th>नाम (English)</th>
                            <th>इमेल</th>
                            <th>सम्पर्क नं.</th>
                            <th>तालिम</th>
                            <th>पेश गरेको मिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $index => $application)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $application->application_no ?? '-' }}</td>
                            <td>{{ $application->fullname_np ?? '-' }}</td>
                            <td>{{ $application->fullname_eng ?? '-' }}</td>
                            <td>{{ $application->email ?? '-' }}</td>
                            <td>{{ $application->contact_no ?? '-' }}</td>
                            <td>{{ $application->training->name_np ?? '-' }}</td>
                            <td>{{ $application->submitted_at ? \Carbon\Carbon::parse($application->submitted_at)->format('Y-m-d') : '-' }}</td>
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
            $('#approvedApplicationsTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ne.json"
                },
                order: [[7, 'desc']]
            });

            $('#filterToggle').click(function() {
                $('#filterForm').collapse('toggle');
            });
        });
    </script>
@endsection
