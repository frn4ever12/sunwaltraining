@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">आवेदन सूची</h3>
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
                <a href="#">आवेदन विवरण</a>
            </li>
        </ul>
    </div>

    <div class="card mb-4">
        <div class="card-header ">
            <div class="row g-3 align-items-center">
                <div class="col-md-2 col-sm-12">
                    @if ($application->photo)
                        <img src="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(2), $application->photo) }}"
                            alt="Training Photo" class="img-fluid mb-3"
                            style="height: 120px;width: 120px; object-fit: cover;">
                    @else
                        <p>फोटो उपलब्ध छैन।</p>
                    @endif

                </div>
                <div class="col-md-8 col-sm-12">
                    <h6 class="fw-bold">तालीमको नाम: <span class="ps-3">{{ $application->training->name_np ?? '' }}</span>
                    </h6>
                    <h6 class="fw-bold">आवेदनको स्थिति: <span
                            class="ps-3
{{ $application->status == 'approved' ? 'text-success' : ($application->status == 'declined' ? 'text-danger' : 'text-warning') }}">
                            @if ($application->status == 'approved')
                                {{ 'स्वीकृत' }} <!-- Approved -->
                            @elseif($application->status == 'declined')
                                {{ 'निष्क्रिय' }} <!-- Declined -->
                            @else
                                {{ 'प्रोसेसिङ' }} <!-- Processing -->
                            @endif
                        </span></h6>
                    <h6 class="fw-bold">कैफियत: <span class="text-primary">{{ $application->remarks ?? '' }}</span></h6>
                </div>
                @can('manage_training')
                    @if ($application->status != 'approved')
                        <div class="col-md-2 col-sm-12">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#StatusModal">
                                <i class="fa fa-plus"></i>&nbsp; थप कार्य
                            </button>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card shadow-none border rounded-0 mb-4">
                <div class="card-header pt-3 bg-white ">
                    <h5 class="fw-bold">आवेदकको विवरण</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th>नाम (नेपाली) </th>
                                <td>{{ $application->fullname_np }} / {{ $application->fullname_eng }}</td>
                                <th>नाम (अंग्रेजी) </th>
                                <td>{{ $application->fullname_eng }}</td>
                            </tr>
                            <tr>
                                <th>हजुरबुबाको नाम </th>
                                <td>{{ $application->grandfather_name }} </td>
                                <th>बुबाको नाम </th>
                                <td>{{ $application->father_name }} </td>
                            </tr>
                            <tr>
                                <th>आमाको नाम </th>
                                <td>{{ $application->mother_name }} </td>
                                <th>ठेगाना </th>
                                <td>
                                    {{ $application->theganaDetail->asthyayi_tole_name ?? '' }}-
                                    {{ $application->theganaDetail->asthyayi_ward_id ?? '' }},
                                    {{ $application->theganaDetail->asthyayiDistrict->name ?? '' }},
                                    {{ $application->theganaDetail->asthyayiProvince->name ?? '' }}
                                </td>
                            </tr>


                            <tr>
                                <th>ईमेल </th>
                                <td>{{ $application->email }}</td>
                                <th>सम्पर्क नं </th>
                                <td>{{ $application->mobile_no }} / {{ $application->contact_no }}</td>
                            </tr>



                            <tr>
                                <th>जन्म मिति (बि.सं.) </th>
                                <td>{{ $application->dob_bs }} </td>
                                <th>जन्म मिति (ई.सं.) </th>
                                <td>{{ $application->dob_ad }} </td>
                            </tr>

                            <tr>
                                <th>शिक्षा स्तर</th>
                                <td>{{ $application->educationDetail->educationLevel->name_np ?? 'N/A' }}</td>
                                <th>नागरिकता नं</th>
                                <td>{{ $application->citizenship_no ?? 'N/A' }}</td>
                            </tr>

                            <tr>
                                <th>नागरिता फोटो (अगाडि)</th>
                                <td>
                                    @if ($application->nagrita_copy_front)
                                        <a href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(1), $application->nagrita_copy_front) }}"
                                            target="_blank"
                                            class="d-inline-flex align-items-center mb-2 text-decoration-none">
                                            <i class="fas fa-sticky-note me-2"></i> अगाडिको फोटो हेर्नुहोस्
                                        </a><br>
                                    @else
                                        <p>अगाडिको फोटो छैन।</p>
                                    @endif
                                </td>

                                <th>नागरिता फोटो (पछाडि)</th>
                                <td>
                                    @if ($application->nagrita_copy_back)
                                        <a href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(1), $application->nagrita_copy_back) }}"
                                            target="_blank"
                                            class="d-inline-flex align-items-center mb-2 text-decoration-none">
                                            <i class="fas fa-sticky-note me-2"></i> पछाडिको फोटो हेर्नुहोस्
                                        </a>
                                    @else
                                        <p>पछाडिको फोटो छैन।</p>
                                    @endif
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-none border rounded-0 mb-4">
                <div class="card-header">
                    <h5 class="fw-bold">शैक्षिक विवरण र प्रमाणपत्रहरू</h5>
                </div>

                <div class="card-body">
                    @if ($application->educationDetails)
                        @include('admin.TrainingApplication.Education.table')
                    @else
                        <h6>डेटा उपलब्ध छैन</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-none border rounded-0 mb-4">
                <div class="card-header">
                    <h5 class="fw-bold">अनुभव विवरण</h5>
                </div>

                <div class="card-body">
                    @include('admin.TrainingApplication.Experience.table')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-none border rounded-0 mb-4">
                <div class="card-header">
                    <h5 class="fw-bold">अन्य विवरणहरु</h5>
                </div>

                <div class="card-body">
                    @include('admin.TrainingApplication.AnyeBibaran.table')
                </div>
            </div>
        </div>
    </div>

    @include('admin.TrainingApplication.model')
@endsection

@section('scripts')
    @include('admin.includes.sweet-alert-script')
@endsection
