@extends('admin.includes.main')
@section('head')
    <style>
        .nav-tabs .nav-link {
            color: #fff;
            text-align: left;
            font-weight: bold;
        }

        .tab-number {
            color: #ffffff;
            margin-right: 0.5rem;
            font-weight: bold;
        }


        .nav-tabs .nav-link.active .tab-number {
            color: rgb(255, 0, 0);
        }

        .review-item {
            margin-bottom: 0.5rem;
        }

        .review-label {
            font-weight: bold;
        }

        /* Make validation message stand out */
        .invalid-feedback {
            display: block;
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .nav-tabs {
            background-color: red;
        }

        .nav-tabs .nav-item .nav-link {
            color: #fff;
            border-radius: 0;
        }

        .nav-tabs .nav-item .nav-link.active {
            color: red;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap4-theme/1.5.2/select2-bootstrap4.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dist/css/select2.css') }}">
@endsection
@section('content')
    <div class="container py-4">
        <div class="card mb-3">
            <div class="card-header bg-white pt-3">
                <h3 class="fw-bold">तालिम आवेदन फारम
                    <small class="ps-3 text-danger fs-6"><i>नोट: * लगाइएका फिल्डहरू अनिवार्य रूपमा भर्नुहोस्।</i></small>
                </h3>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <a class="d-block fs-5 talim-btn d-flex bg-white align-items-center" href="#">
                        <div class="talim-date text-center py-2 px-4  me-3 fw-bold">
                            <small>{{ \App\Helpers\NumberHelper::toNepaliNumber(\Carbon\Carbon::parse($training->start_miti_bs)->format('d')) }}</small><br>
                            <small>{{ \App\Helpers\NumberHelper::toNepaliMonth(\Carbon\Carbon::parse($training->start_miti_bs)->format('m')) }}</small>
                        </div>
                        <span class="text-primary fw-bold">
                            {{ $training->name_np ?? '' }}
                            <br>
                            <small class="text-secondary" style="font-size: 0.90rem;"><i class="fas fa-user me-1"></i>
                                {{ $training->user->name_np ?? ($training->user->name ?? '') }}</small>

                        </span>
                    </a>

                </div>
                <div>
                    <a href="{{ route('training.show', $training->id) }}" class="w-100 btn detail-btn"><i
                            class="fa fa-eye me-2"></i> विवरण हेर्नुहोस्</a>
                </div>
            </div>
        </div>
        <div class="card p-0">
            <div class="card-header">
                <small class="card-title text-danger" style="font-size: 1rem;">नोट: कृपया व्यक्तिगत विवरण र शैक्षिक विवरण
                    अनिवार्य रूपमा वर्णन गर्नुहोस्।</small>
            </div>
            <div class="card-body p-0">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="formTabs" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button
                            class="nav-link w-100 {{ session('education_tab') || session('experience_tab') || session('anye_tab') ? '' : 'active' }}"
                            id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab"
                            aria-controls="personal">
                            <span class="tab-number">१</span> व्यक्तिगत विवरण
                        </button>
                    </li>
                    <li class="nav-item flex-fill " role="presentation">
                        <button class="nav-link w-100 {{ session('education_tab') ? 'active' : '' }}" id="education-tab"
                            data-bs-toggle="tab" data-bs-target="#education" type="button" role="tab"
                            aria-controls="education">
                            <span class="tab-number">२</span> शैक्षिक विवरण
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 {{ session('experience_tab') ? 'active' : '' }}" id="experience-tab"
                            data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab"
                            aria-controls="experience">
                            <span class="tab-number">३</span> अनुभव विवरण
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 {{ session('anye_tab') ? 'active' : '' }}" id="anye-tab"
                            data-bs-toggle="tab" data-bs-target="#anyeBibaran" type="button" role="tab"
                            aria-controls="anye">
                            <span class="tab-number">४</span> अन्य विवरण
                        </button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                            type="button" role="tab" aria-controls="review">
                            <span class="tab-number">५</span> फारमको पुनरावलोकन
                        </button>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content p-4 border border-top-0 rounded-bottom" id="formTabContent">

                    @include('shared.Training.personal-info')
                    @if (isset($application->id))
                        @include('shared.Training.education-info')
                        @include('shared.Training.experience-info')
                        @include('shared.Training.anye-bibaran-info')
                        @include('shared.Training.review-form')
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection


@section('scripts')
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme: "bootstrap4",
                width: "100%",
                placeholder: "--कृपया छान्नुहोस्--",
            });

            // Address copy functionality
            $('#copyAddressCheckbox').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#asthyayiTole').val($('#sthyayiTole').val());
                    $('#asthyayiWard').val($('#sthyayiWard').val()).trigger('change');
                    $('#asthyayiProvince').val($('#sthyayiProvince').val()).trigger('change');
                    setTimeout(function() {
                        $('#asthyayiDistrict').val($('#sthyayiDistrict').val()).trigger('change');
                    }, 700);
                    setTimeout(function() {
                        $('#asthyayiArea').val($('#sthyayiArea').val()).trigger('change');
                    }, 1200);
                } else {
                    $('#asthyayiDistrict').val('');
                    $('#asthyayiTole').val('');
                    $('#asthyayiArea').val('');
                    $('#asthyayiProvince').val('');
                    $('#asthyayiWard').val('');
                }
            });
            $('#sthyayiProvince, #asthyayiProvince').change(function() {
                var provinceId = $(this).val();
                var targetDistrict = $(this).attr('id') === 'sthyayiProvince' ? '#sthyayiDistrict' :
                    '#asthyayiDistrict';

                if (provinceId) {
                    $.ajax({
                        url: '/districts/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $(targetDistrict).empty().append(
                                '<option value="">--कृपया छान्नुहोस्--</option>');
                            $.each(data, function(key, value) {
                                $(targetDistrict).append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });

            $('#sthyayiDistrict, #asthyayiDistrict').change(function() {
                var districtId = $(this).val();
                var targetArea = $(this).attr('id') === 'sthyayiDistrict' ? '#sthyayiArea' :
                    '#asthyayiArea';

                if (districtId) {
                    $.ajax({
                        url: '/municipalities/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $(targetArea).empty().append(
                                '<option value="">--कृपया छान्नुहोस्--</option>');
                            $.each(data, function(key, value) {
                                $(targetArea).append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#todayMiti").val(getTodayDate());
            document.querySelectorAll(".datepicker").forEach(function(modalInput) {
                var modal = modalInput.closest('.modal');
                if (modal) {
                    var modalId = modal.id;
                    $(modalInput).nepaliDatePicker({
                        container: '#' + modalId,
                        ndpYear: true,
                        ndpMonth: true,
                        onChange: function() {
                            var bsDate = modalInput.value;
                            var nextInput = modalInput.closest('.col-md-3')?.nextElementSibling
                                ?.querySelector('.english-datepicker');
                            if (!nextInput) {
                                nextInput = modalInput.closest('.col-sm-12')?.querySelector(
                                    '.english-datepicker');
                            }
                            if (nextInput) {
                                nextInput.value = NepaliFunctions.BS2AD(bsDate);
                            }
                        }
                    });
                }
            });
        });
    </script>
    @include('admin.includes.sweet-alert-script')
@endsection
