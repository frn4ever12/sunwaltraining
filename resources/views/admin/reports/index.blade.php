@extends('admin.includes.main')

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">प्रतिवेदन (Reports)</h3>
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
        </ul>
    </div>

    <div class="row">
        <!-- Training Reports -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>तालिम प्रतिवेदन</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('reports.training.list') }}">तालिम सूची</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.training.progress') }}">तालिम प्रगति</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.training.completed') }}">सम्पन्न तालिम</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.training.summary') }}">तालिम सारांश</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Application Reports -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>आवेदन प्रतिवेदन</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('reports.application.received') }}">प्राप्त आवेदन</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.application.approved') }}">स्वीकृत आवेदन</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.application.rejected') }}">अस्वीकृत आवेदन</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.application.pending') }}">प्रतीक्षामा रहेका आवेदन</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Participant Reports -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>सहभागी प्रतिवेदन</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('reports.participant.list') }}">सहभागी सूची</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.participant.by-training') }}">तालिम अनुसार</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.participant.by-ward') }}">वडा अनुसार</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.participant.by-gender') }}">लिङ्ग अनुसार</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.participant.by-age') }}">उमेर समूह अनुसार</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.participant.by-inclusion') }}">समावेशीकरण अनुसार</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Attendance Reports -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>उपस्थिती प्रतिवेदन</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('reports.attendance.daily') }}">दैनिक उपस्थिती</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.attendance.monthly') }}">मासिक उपस्थिती</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.attendance.participant') }}">सहभागी उपस्थिती</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.attendance.absent') }}">अनुपस्थित सूची</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Trainer Reports -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i>प्रशिक्षक प्रतिवेदन</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('reports.trainer.list') }}">प्रशिक्षक सूची</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.trainer.by-training') }}">तालिम अनुसार प्रशिक्षक</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.trainer.payment') }}">पारिश्रमिक विवरण</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.trainer.evaluation') }}">मूल्याङ्कन प्रतिवेदन</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Certificate Reports -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0"><i class="fas fa-certificate me-2"></i>प्रमाणपत्र प्रतिवेदन</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{ route('reports.certificate.issued') }}">जारी भएका प्रमाणपत्र</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.certificate.register') }}">प्रमाणपत्र रजिस्टर</a></li>
                        <li class="list-group-item"><a href="{{ route('reports.certificate.download') }}">डाउनलोड विवरण</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
