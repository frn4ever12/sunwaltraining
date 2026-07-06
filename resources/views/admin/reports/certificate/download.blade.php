@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">प्रमाणपत्र डाउनलोड विवरण</h3>
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
                <a href="#">प्रमाणपत्र डाउनलोड विवरण</a>
            </li>
        </ul>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">प्रमाणपत्र खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('reports.certificate.download') }}">
                <div class="row g-2">
                    <div class="form-group col-md-4 col-12">
                        <input type="date" name="start_date" class="form-control" placeholder="सुरु मिति"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <input type="date" name="end_date" class="form-control" placeholder="अन्त्य मिति"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <select name="training_id" class="form-control">
                            <option value="">सबै तालिम</option>
                            @foreach($trainings as $training)
                                <option value="{{ $training->id }}" {{ request('training_id') == $training->id ? 'selected' : '' }}>
                                    {{ $training->name_np }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <a href="{{ route('reports.certificate.download') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="downloadTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>तालिम</th>
                            <th>आवेदक</th>
                            <th>प्रमाणपत्र</th>
                            <th>जारी मिति</th>
                            <th>स्थिति</th>
                            <th>कार्य</th>
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
                            <td>
                                <a href="#" class="btn btn-sm btn-primary">डाउनलोड</a>
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
    @include('admin.includes.datatables-js')
    <script>
        $(document).ready(function() {
            $('#downloadTable').DataTable({
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
