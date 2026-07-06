@extends('admin.includes.main')

@section('head')
    @include('admin.includes.datatables-css')
    <style>
        input[type="time"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }

        input[type="time"] {
            background-color: transparent;
            border: 0;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">तालीमको सूची</h3>
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
                <a href="#">तालीम</a>
            </li>
        </ul>
    </div>
    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">तालीम खोज्नुहोस्</h5>
                <button class="btn btn-link p-0" id="filterToggle">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div id="filterForm" class="collapse card-body">
            <form method="GET" id="filterData" action="{{ route('admin.training.index') }}">
                <div class="row g-2">
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="name_np" class="form-control" placeholder="तालीमको नाम"
                            value="{{ request('name_np') }}" >
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <select name="category" class="form-control" >
                            <option value="">क्याटेगोरी छान्नुहोस्</option>
                            @foreach (\App\Models\Category::select('id','name_np')->get() as $data)
                                <option value="{{ $data->id }}"
                                    {{ request('category') == $data->id ? 'selected' : '' }}>
                                    {{ $data->name_np }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text"  name="entry_date" class="form-control nepali-datepicker" placeholder="मिति देखि"
                            value="{{ request('entry_date') }}" >
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" id="nepali-date-picker" name="end_date" class="form-control nepali-datepicker"
                            placeholder="मिति सम्म" value="{{ request('end_date') }}" >
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                        खोज्नुहोस्
                    </button>
                     <a href="{{ route('admin.training.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo"></i>
                        रिसेट
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @can('manage_training')
                    <div class="card-header">
                        <a href="{{ route('admin.training.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i>&nbsp; नयाँ थप्नुहोस्
                        </a>
                    </div>
                @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>क्र.सं.</th>
                                    <th>तालीम नाम</th>
                                    <th>कोटा</th>
                                    <th>तालिम सुरु हुने मिति</th>
                                    <th>तालिम सुरु हुने समय</th>
                                    @hasanyrole('super-admin|admin|trainer')
                                        <th>स्थिती</th>
                                    @endhasanyrole
                                    <th>क्रियाकलाप</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ \App\Helpers\NumberHelper::toNepaliNumber($loop->iteration) }}</td>
                                        <td>{{ $data->name_np ?? '' }}</td>
                                        <td>{{ $data->available_seats ?? '' }}</td>
                                        <td>{{ $data->start_miti_bs ?? '' }}</td>
                                        <td><input type="time" value="{{ $data->start_samaya ?? '' }}"></td>
                                        @hasanyrole('super-admin|admin|trainer')
                                            <td>
                                                <button
                                                    class="btn btn-sm {{ $data->status == 'active' ? 'btn-success' : '' }} {{ $data->status == 'completed' ? 'btn-primary' : '' }} {{ $data->status == 'dismissed' ? 'btn-danger' : '' }} {{ $data->status == 'upcoming' ? 'btn-upcoming' : '' }}">
                                                    {{ __('messages.'.$data->status) }}
                                                </button>
                                            </td>
                                        @endhasanyrole
                                        <td>
                                            @can('manage_training')
                                                <a href="{{ route('admin.training.show', $data->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.training.edit', $data->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm deleteBtn"
                                                    data-route="{{ route('admin.training.destroy', $data->id) }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endcan
                                            @role('trainee')
                                                @can('apply_training')
                                                   @php
                                                        $applicationCount = \App\Models\TrainingApplication::where('training_id', $data->id)->count();
                                                    @endphp

                                                    @if (!auth()->user()->hasAppliedToTraining($data->id) && $applicationCount < $data->available_seats)
                                                        <a href="{{ route('admin.application.create', $data->id) }}" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-reply me-2"></i> आवेदन दिनुहोस्
                                                        </a>
                                                    @elseif (auth()->user()->hasAppliedToTraining($data->id))
                                                        <button type="button" class="btn btn-sm btn-warning">आवेदन दिइसक्नुभएको छ।</button>
                                                    @elseif ($applicationCount >= $data->available_seats)
                                                        <button type="button" class="btn btn-sm btn-danger">सीट सकिएको छ</button>
                                                    @endif
                                                @endcan
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shared.Training.broadcast-modal')
@endsection

@section('scripts')
    @include('admin.includes.datatables-scripts')
    @include('admin.includes.sweet-alert-script')
    <script>
        $(document).ready(function() {
            $('#filterToggle').on('click', function() {
                $('#filterForm').slideToggle(300);
                $(this).find('i').toggleClass('fa-plus fa-minus');
            });
        });
    </script>
@endsection
