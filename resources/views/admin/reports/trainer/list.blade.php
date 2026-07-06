@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">प्रशिक्षक सूची</h3>
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
                <a href="#">प्रशिक्षक सूची</a>
            </li>
        </ul>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">प्रशिक्षक खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.reports.trainer.list') }}">
                <div class="row g-2">
                    <div class="form-group col-md-6 col-12">
                        <input type="text" name="name" class="form-control" placeholder="नाम"
                            value="{{ request('name') }}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <input type="text" name="email" class="form-control" placeholder="इमेल"
                            value="{{ request('email') }}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <button type="submit" class="btn btn-primary w-100">खोज्नुहोस्</button>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <a href="{{ route('admin.reports.trainer.list') }}" class="btn btn-secondary w-100">रिसेट</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="trainerListTable">
                    <thead>
                        <tr>
                            <th>क्र.सं.</th>
                            <th>नाम</th>
                            <th>इमेल</th>
                            <th>सम्पर्क नं.</th>
                            <th>दर्ता मिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainers as $index => $trainer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $trainer->name ?? '-' }}</td>
                            <td>{{ $trainer->email ?? '-' }}</td>
                            <td>{{ $trainer->contact_no ?? '-' }}</td>
                            <td>{{ $trainer->created_at ? \Carbon\Carbon::parse($trainer->created_at)->format('Y-m-d') : '-' }}</td>
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
            $('#trainerListTable').DataTable({
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
