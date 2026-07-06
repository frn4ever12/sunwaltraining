@extends('frontend.includes.main')
@section('head')
<style>
    main{
        background-color: rgb(246, 246, 246);
    }
    footer{
        margin-top:0 !important;
    }
</style>
@endsection
@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card my-3">
                    <div class="card-header bg-white pt-2">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <div>
                                <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" height="44px" width="44px" alt="gov-logo">
                            </div>
                            <h4 class="text-center pt-2"><b>तालिम व्यवस्थापन प्रणाली  </b></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary fs-6 "> प्रयोगकर्ता ईमेल</label>
                                <div class="form-group">
                                    <input class="form-control" id="login-username" name="email" type="text"
                                        placeholder="ईमेल" >
                                </div>
                                @error('email')
                                    <span style= "display:block; color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary fs-6 ">पासवर्ड</label>
                                <div class=" form-group">
                                    <input class="form-control" id="login-password" name="password" type="password"
                                        placeholder="पासवर्ड" >
                                </div>
                                @error('password')
                                    <span style= "display:block; color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" data-usertype=""
                                    class="rounded btn  btn-main px-5 py-2" id="login-btn"><i class="fa fa-user me-2" style="font-size: 0.8rem;"></i> लग इन</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer pt-3 bg-white">
                        <div class="text-center">
                            <p>खाता छैन? <a href="{{ route('register') }}" class="text-primary">अहिले दर्ता गर्नुहोस्।</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if(session('registered_email'))
<div class="modal fade" id="registrationSuccessModal" tabindex="-1" aria-labelledby="registrationSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header">
                <h5 class="modal-title">आवेदक दर्ता</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-success text-center">
                तपाईंको प्रोफाइल सफलतापूर्वक सिर्जना गरिएको छ।<br>
                कृपया आफ्नो इमेल: <strong>{{ session('registered_email') }}</strong><br>
                र दर्ता गर्दा प्रदान गरिएको पासवर्ड प्रयोग गरेर लगइन गर्नुहोस्।
            </div>
        </div>
    </div>
</div>
@endif

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = new bootstrap.Modal(document.getElementById('registrationSuccessModal'));
        modal.show();
    });
</script>

