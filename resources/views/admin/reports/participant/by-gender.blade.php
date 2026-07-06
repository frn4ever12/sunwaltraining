@extends('admin.includes.main')

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">लिङ्ग अनुसार सहभागी</h3>
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
                <a href="#">लिङ्ग अनुसार सहभागी</a>
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
                <h5 class="mb-0">मिति छान्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.participant.by-gender') }}">
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
                        <a href="{{ route('admin.reports.participant.by-gender') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h3>{{ $genderStats['male'] ?? 0 }}</h3>
                            <p class="mb-0">पुरुष</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h3>{{ $genderStats['female'] ?? 0 }}</h3>
                            <p class="mb-0">महिला</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h3>{{ $genderStats['other'] ?? 0 }}</h3>
                            <p class="mb-0">अन्य</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h3>{{ $genderStats['total'] ?? 0 }}</h3>
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
@endsection
