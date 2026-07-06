@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">सहभागी सूची</h3>
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
                <a href="#">सहभागी सूची</a>
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
                <h5 class="mb-0">सहभागी खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.participant.list') }}">
                <div class="row g-2">
                    <div class="form-group col-md-3 col-12">
                        <input type="text" name="fullname_np" class="form-control" placeholder="नाम"
                            value="{{ request('fullname_np') }}">
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <select name="gender" class="form-control">
                            <option value="">सबै लिङ्ग</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>पुरुष</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>महिला</option>
                            <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>अन्य</option>
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
                        <a href="{{ route('admin.reports.participant.list') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="participantListTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>आवेदन नं.</th>
                            <th>नाम (नेपाली)</th>
                            <th>नाम (English)</th>
                            <th>लिङ्ग</th>
                            <th>इमेल</th>
                            <th>सम्पर्क नं.</th>
                            <th>तालिम</th>
                            <th>जन्म मिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants as $index => $participant)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $participant->application_no ?? '-' }}</td>
                            <td>{{ $participant->fullname_np ?? '-' }}</td>
                            <td>{{ $participant->fullname_eng ?? '-' }}</td>
                            <td>
                                @if($participant->gender == 'male')
                                    <span class="badge bg-info">पुरुष</span>
                                @elseif($participant->gender == 'female')
                                    <span class="badge bg-success">महिला</span>
                                @else
                                    <span class="badge bg-secondary">{{ $participant->gender ?? '-' }}</span>
                                @endif
                            </td>
                            <td>{{ $participant->email ?? '-' }}</td>
                            <td>{{ $participant->contact_no ?? '-' }}</td>
                            <td>{{ $participant->training->name_np ?? '-' }}</td>
                            <td>{{ $participant->dob_bs ?? '-' }}</td>
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
            $('#participantListTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ne.json"
                },
                order: [[0, 'desc']]
            });

            $('#filterToggle').click(function() {
                $('#filterForm').collapse('toggle');
            });
        });
    </script>
@endsection
