@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">आवेदकहरूको सूची</h3>
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
                <a href="#">आवेदकहरु</a>
            </li>
        </ul>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <h5 class="mb-0">आवेदकहरूको विवरण</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="applicantsTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>आवेदन नं.</th>
                            <th>नाम (नेपाली)</th>
                            <th>नाम (English)</th>
                            <th>इमेल</th>
                            <th>सम्पर्क नं.</th>
                            <th>तालीम</th>
                            <th>स्थिति</th>
                            <th>पेश गरेको मिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applicants as $index => $applicant)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $applicant->application_no ?? '-' }}</td>
                            <td>{{ $applicant->fullname_np ?? '-' }}</td>
                            <td>{{ $applicant->fullname_eng ?? '-' }}</td>
                            <td>{{ $applicant->email ?? '-' }}</td>
                            <td>{{ $applicant->contact_no ?? '-' }}</td>
                            <td>{{ $applicant->training->name_np ?? '-' }}</td>
                            <td>
                                @if($applicant->status == 'submitted')
                                    <span class="badge bg-success">पेश गरिएको</span>
                                @elseif($applicant->status == 'draft')
                                    <span class="badge bg-warning">ड्राफ्ट</span>
                                @else
                                    <span class="badge bg-secondary">{{ $applicant->status ?? '-' }}</span>
                                @endif
                            </td>
                            <td>{{ $applicant->submitted_at ? \Carbon\Carbon::parse($applicant->submitted_at)->format('Y-m-d') : '-' }}</td>
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
            $('#applicantsTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/ne.json"
                },
                order: [[8, 'desc']]
            });
        });
    </script>
@endsection
