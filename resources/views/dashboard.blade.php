@extends('admin.includes.main')
@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.1.0/ol.css">
    <script src="https://cdn.jsdelivr.net/npm/ol@v10.1.0/dist/ol.js"></script>
@endsection
@section('content')
    <section>
        <div class="row g-3">
            @unlessrole('trainee')
                <div class="col-12">
                    <h5 class="fw-bold">तालिमहरूको विवरण</h5>
                </div>
                <!-- कुल तालिम -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #f85008, #f42f2f); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-users fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">{{ \App\Models\Training::count() ?? 0 }}</h3>
                            <p class="mb-1 fs-5 fw-bold">कुल तालिम</p>

                        </div>
                    </div>
                </div>

                <!-- कुल आवेदन -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #fad70b, #fdc305); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-file-alt fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">{{ \App\Models\TrainingApplication::count() ?? 0 }}</h3>
                            <p class="mb-1 fs-5 fw-bold">कुल आवेदन</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #059e7a, #28cba7); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-file-alt fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">{{ \App\Models\TrainingApplication::where('status','approved')->count() ?? 0 }}</h3>
                            <p class="mb-1 fs-5 fw-bold">स्वीकृत आवेदन</p>

                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #06b865, rgb(6, 195, 154)); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-clock fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">
                                {{ \App\Models\Training::where('status', 'upcoming')->count() ?? 0 }}
                            </h3>
                            <p class="mb-1 fs-5 fw-bold">आगामी आउन लागेको तालिम</p>

                        </div>
                    </div>
                </div>
<!-- सम्पन्न तालिम -->
<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card stats-card flex-row align-items-center text-white border-0"
        style="background: linear-gradient(135deg, #2569f1, #0e4ecf); min-height: 140px;">
        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
            <i class="fa fa-check-circle fa-3x background-icon"></i>
        </div>
        <div class="flex-grow-1 py-3 px-4">
            <h3 class="fw-bold mb-1 npNum">
                {{ \App\Models\Training::where('status', 'completed')->count() ?? 0 }}
            </h3>
            <p class="mb-1 fs-5 fw-bold">सम्पन्न तालिम</p>

        </div>
    </div>
</div>
                <!-- आगामी तालिम -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #f94144, #f3722c); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-calendar-alt fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">{{ \App\Models\Training::where('status', 'active')->count() ?? 0 }}
                            </h3>
                            <p class="mb-1 fs-5 fw-bold">चलीरहेको तालिम</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card shadow-none">
                        <div class="card-header bg-main text-center ">
                            <h6 class="mb-0 fw-bold">पुरुष/महिला आवेदन संख्या विवरण</h6>
                        </div>

                        <div class="card-body border">
                            <div style="height: 400px;">
                                <canvas id="genderChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @include('welcome.partials.ward-map')
            @endunlessrole
            @role('trainee')
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #f94144, #f3722c); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-file-alt fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">
                                {{ \App\Models\TrainingApplication::where('user_id', Auth::id())->count() ?? 0 }}
                            </h3>
                            <p class="mb-1 fs-5 fw-bold">मेरो कुल आवेदन</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card stats-card flex-row align-items-center text-white border-0"
                        style="background: linear-gradient(135deg, #059e7a, #28cba7); min-height: 140px;">
                        <div class="p-4 d-flex align-items-center justify-content-center" style="flex: 0 0 100px;">
                            <i class="fa fa-certificate fa-3x background-icon"></i>
                        </div>
                        <div class="flex-grow-1 py-3 px-4">
                            <h3 class="fw-bold mb-1 npNum">
                                {{ \App\Models\TrainingCertification::whereHas('trainingApplication', function($q) {
                                    $q->where('user_id', Auth::id());
                                })->where('status', '1')->count() ?? 0 }}
                            </h3>
                            <p class="mb-1 fs-5 fw-bold">मेरो प्रमाणपत्र</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-main text-center">
                            <h6 class="mb-0 fw-bold">मेरो प्रमाणपत्रहरू</h6>
                        </div>
                        <div class="card-body">
                            @if(\App\Models\TrainingCertification::whereHas('trainingApplication', function($q) {
                                $q->where('user_id', Auth::id());
                            })->where('status', '1')->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>तालिमको नाम</th>
                                                <th>प्रमाणित मिति</th>
                                                <th>कार्य</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $certifications = \App\Models\TrainingCertification::whereHas('trainingApplication', function($q) {
                                                    $q->where('user_id', Auth::id());
                                                })->where('status', '1')->with(['training', 'certificate'])->get();
                                            @endphp
                                            @foreach($certifications as $cert)
                                                <tr>
                                                    <td>{{ $cert->training->name_np ?? '' }}</td>
                                                    <td>{{ $cert->certified_date ?? '' }}</td>
                                                    <td>
                                                        @if($cert->certificate)
                                                            <a href="{{ URL::temporarySignedRoute('file.show', now()->addMinutes(5), $cert->certificate->file_path) }}" 
                                                               target="_blank" 
                                                               class="btn btn-sm btn-primary">
                                                                <i class="fa fa-download me-1"></i> डाउनलोड गर्नुहोस्
                                                            </a>
                                                        @else
                                                            <span class="text-muted">प्रमाणपत्र उपलब्ध छैन</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">हाल कुनै प्रमाणपत्र उपलब्ध छैन।</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('genderChart').getContext('2d');

            // Data from Laravel
            const maleCount = {{ $countData['male_count'] }};
            const femaleCount = {{ $countData['female_count'] }};
            const total = maleCount + femaleCount;

            const malePercentage = total > 0 ? Math.round((maleCount / total) * 100) : 0;
            const femalePercentage = total > 0 ? Math.round((femaleCount / total) * 100) : 0;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['पुरुष', 'महिला'],
                    datasets: [{
                        label: 'Gender Distribution',
                        data: [maleCount, femaleCount],
                        backgroundColor: [
                            'rgba(54, 162, 235)',
                            'rgba(255, 99, 132)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    const percentage = total > 0 ? Math.round((value / total) * 100) :
                                    0;
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Create legend
            const legendContainer = document.createElement('div');
            legendContainer.style.display = 'flex';
            legendContainer.style.justifyContent = 'center';
            legendContainer.style.marginTop = '20px';

            const maleLegend = document.createElement('div');
            maleLegend.style.display = 'flex';
            maleLegend.style.alignItems = 'center';
            maleLegend.style.marginRight = '20px';
            maleLegend.innerHTML = `
            <div style="width:15px; height:15px; background-color:rgba(54, 162, 235); margin-right:5px;"></div>
            <span>पुरुष: ${maleCount} (${malePercentage}%)</span>
        `;

            const femaleLegend = document.createElement('div');
            femaleLegend.style.display = 'flex';
            femaleLegend.style.alignItems = 'center';
            femaleLegend.innerHTML = `
            <div style="width:15px; height:15px; background-color:rgba(255, 99, 132); margin-right:5px;"></div>
            <span>महिला: ${femaleCount} (${femalePercentage}%)</span>
        `;

            legendContainer.appendChild(maleLegend);
            legendContainer.appendChild(femaleLegend);

            document.querySelector('.card-body').appendChild(legendContainer);
        });
    </script>
    <script>
        window.wardGenderData = {};
        @foreach ($wards as $ward)
            window.wardGenderData["{{ $ward->id }}"] = {
                male_count: {{ $ward->male_count }},
                female_count: {{ $ward->female_count }},
                total_count: {{ $ward->total_count }}
            };
        @endforeach
    </script>
    <script src="{{ asset('dist/map/map.js') }}"></script>
    <script>
        initiateMap('{{ asset('dist/map/map.geojson') }}')
    </script>
@endsection
