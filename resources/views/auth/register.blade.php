@extends('frontend.includes.main')
@section('head')
    <style>
        main {
            background-color: rgb(246, 246, 246);
        }

        footer {
            margin-top: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card my-3">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <div>
                                <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" height="44px" width="44px"
                                    alt="gov-logo">
                            </div>
                            <h4 class="text-center pt-2"><b>तालिम व्यवस्थापन प्रणाली </b></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-center text-muted mb-4">जारी राख्न दर्ता गर्नुहोस् !</p>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row">
                               

                                <div class="col-md-4 mb-3">
                                    <label class="form-label">नाम (नेपाली) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_np" value="{{ old('name_np') }}"
                                        class="form-control @error('name_np') is-invalid @enderror" placeholder="नाम" required>
                                    @error('name_np')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">नाम (अंग्रेजी) <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">लिङ्ग <span class="text-danger">*</span></label>
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                        <option value="">-- छनौट गर्नुहोस् --</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>पुरुष
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>महिला
                                        </option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>अन्य</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">सम्पर्क नम्बर <span class="text-danger">*</span></label>
                                    <input type="text" name="contact_no" value="{{ old('contact_no') }}"
                                        class="form-control @error('contact_no') is-invalid @enderror"
                                        placeholder="Phone number" required maxlength="10">
                                    @error('contact_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ईमेल <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email address" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">जन्म मिति (वि.सं.)</label>
                                    <input type="text" name="dob_bs" value="{{ old('dob_bs') }}"  placeholder="YYYY-MM-DD"
                                        class="form-control @error('dob_bs') is-invalid @enderror" id="dobBS">
                                    @error('dob_bs')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">जन्म मिति (ई.सं.)</label>
                                    <input type="text" name="dob_ad" value="{{ old('dob_ad') }}" placeholder="YYYY-MM-DD"
                                        class="form-control nepali-datepicker @error('dob_ad') is-invalid @enderror" id="dobAD" readonly>
                                    @error('dob_ad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">पासवर्ड <span class="text-danger">*</span></label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">पासवर्ड पुनः पुष्टि <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <button type="submit" class="btn btn-main px-5 py-2"><i class="fa fa-user-plus me-2" style="font-size: 0.8rem;"></i> रजिस्टर गर्नुहोस्</button>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <a href="#" class="d-block text-muted">पासवर्ड बिर्सनुभयो?</a>
                                    <p class="mt-2">पहिले नै खाता छ? <a href="{{ route('login') }}">लगइन गर्नुहोस्</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        var date = document.getElementById("dobBS");
        date.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
            onChange: function() {
                $('#dobAD').val(NepaliFunctions.BS2AD(date.value));
            }
        });
    </script>
@endsection
