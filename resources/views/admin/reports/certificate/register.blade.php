@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">प्रमाणपत्र रजिस्टर</h3>
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
                <a href="#">प्रमाणपत्र रजिस्टर</a>
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
            <form method="GET" id="filterData" action="{{ route('admin.reports.certificate.register') }}">
                <div class="row g-2">
                    <div class="form-group col-md-6 col-12">
                        <input type="date" name="start_date" class="form-control" placeholder="सुरु मिति"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <input type="date" name="end_date" class="form-control" placeholder="अन्त्य मिति"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <a href="{{ route('admin.reports.certificate.register') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="certificateRegisterTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>तालिम</th>
                            <th>आवेदक</th>
                            <th>प्रमाणपत्र</th>
                            <th>जारी मिति</th>
                            <th>स्थिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certifications as $index => $certification)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $certification->training->name_np ?? '-' }}</td>
                            <td>{{ $certification->trainingApplication->fullname_np ?? '-' }}</td>
                            <td>{{ $certification->certificate->name ?? '-' }}</td>
                            <td>{{ $certification->certified_date ?? '-' }}</td>
                            <td>
                                @if($certification->status == '1')
                                    <span class="badge bg-success">जारी भएको</span>
                                @else
                                    <span class="badge bg-secondary">{{ $certification->status ?? '-' }}</span>
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
            $('#certificateRegisterTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ne.json"
                },
                order: [[4, 'desc']]
            });

            $('#filterToggle').click(function() {
                $('#filterForm').collapse('toggle');
            });
        });
    </script>
@endsection
