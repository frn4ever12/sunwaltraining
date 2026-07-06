@extends('admin.includes.main')

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">वडा अनुसार सहभागी</h3>
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
                <a href="#">वडा अनुसार सहभागी</a>
            </li>
        </ul>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('reports.participant.by-ward') }}">
                <div class="row g-2">
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="fullname_np" class="form-control" placeholder="नाम"
                            value="{{ request('fullname_np') }}">
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
                        <a href="{{ route('reports.participant.by-ward') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>वडा नं.</th>
                            <th>सहभागी संख्या</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($byWard as $ward => $participants)
                        <tr>
                            <td>{{ $ward }}</td>
                            <td>{{ $participants->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
