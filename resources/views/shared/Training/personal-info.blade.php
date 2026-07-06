<!-- Personal Details Tab -->
<div class="tab-pane fade {{ session('education_tab') || session('experience_tab') || session('anye_tab') ? '' : 'show active' }}"
    id="personal" role="tabpanel" aria-labelledby="personal-tab">
    <h4 class="mb-3 fw-bold">व्यक्तिगत विवरण {{ session('education_tab') }}</h4>
    <form
        action="{{ isset($application->id) ? route('admin.application.update', ['training' => $application->training_id, 'application' => $application->id]) : route('admin.application.store', $training->id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($application->id))
            @method('PUT')
        @endif
        <div class="row g-3 mb-4">
            <div class="col-md-4 col-sm-12">
                <label for="fullname_np" class="form-label">पूरा नाम (नेपाली) <span class="text-danger">*</span></label>
                <input type="text" class="form-control {{ $errors->has('fullname_np') ? 'is-invalid' : '' }}"
                    id="fullname_np" name="fullname_np"
                    value="{{ old('fullname_np', $application->fullname_np ?? (Auth::user()->name_np ?? '')) }}"
                    required>
                @error('fullname_np')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="fullname_eng" class="form-label">पूरा नाम (अंग्रेजी) <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control {{ $errors->has('fullname_eng') ? 'is-invalid' : '' }}"
                    id="fullname_eng" name="fullname_eng"
                    value="{{ old('fullname_eng', $application->fullname_eng ?? (Auth::user()->name ?? '')) }}"
                    required>
                @error('fullname_eng')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="grandfather_name" class="form-label">हजुरबुबाको नाम</label>
                <input type="text" class="form-control {{ $errors->has('grandfather_name') ? 'is-invalid' : '' }}"
                    id="grandfather_name" name="grandfather_name"
                    value="{{ old('grandfather_name', $application->grandfather_name ?? '') }}">
                @error('grandfather_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="father_name" class="form-label">बुबाको नाम </label>
                <input type="text" class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}"
                    id="father_name" name="father_name"
                    value="{{ old('father_name', $application->father_name ?? '') }}">
                @error('father_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="mother_name" class="form-label">आमाको नाम </label>
                <input type="text" class="form-control {{ $errors->has('mother_name') ? 'is-invalid' : '' }}"
                    id="mother_name" name="mother_name"
                    value="{{ old('mother_name', $application->mother_name ?? '') }}">
                @error('mother_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 col-sm-12">
                <label for="dob_bs" class="form-label">जन्म मिति (बि.सं.)<span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker {{ $errors->has('dob_bs') ? 'is-invalid' : '' }}"
                    id="dob_bs" name="dob_bs" placeholder="YYYY-MM-DD" required
                    value="{{ old('dob_bs', $application->dob_bs ?? (auth()->user()->dob_bs ?? '')) }}">
                @error('dob_bs')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2 col-sm-12">
                <label for="dob_ad" class="form-label">जन्म मिति (ई.सं.)</label>
                <input type="text"
                    class="form-control english-datepicker {{ $errors->has('dob_ad') ? 'is-invalid' : '' }}"
                    id="dob_ad" name="dob_ad" placeholder="YYYY-MM-DD"
                    value="{{ old('dob_ad', $application->dob_ad ?? (auth()->user()->dob_ad ?? '')) }}" readonly>
                @error('dob_ad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="gender" class="form-label">लिङ्ग <span class="text-danger">*</span></label>
                <select class="form-select select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender"
                    name="gender" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    <option value="male"
                        {{ old('gender', $application->gender ?? (Auth::user()->gender ?? '')) == 'male' ? 'selected' : '' }}>
                        पुरुष </option>
                    <option value="female"
                        {{ old('gender', $application->gender ?? (Auth::user()->gender ?? '')) == 'female' ? 'selected' : '' }}>
                        महिला </option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>अन्य</option>

                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="citizenship_no" class="form-label">नागरिकता नं<span class="text-danger">*</span></label>
                <input type="text" class="form-control {{ $errors->has('citizenship_no') ? 'is-invalid' : '' }}"
                    id="citizenship_no" name="citizenship_no" placeholder="नागरिकता नं"
                    value="{{ old('citizenship_no', $application->citizenship_no ?? '') }}" required>
                @error('citizenship_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="citizenship_district_id" class="form-label">नागरिकता जारी जिल्ला <span
                        class="text-danger">*</span></label>
                <select
                    class="form-select select2 custom-scroll-select {{ $errors->has('citizenship_district_id') ? 'is-invalid' : '' }}"
                    id="citizenship_district_id" name="citizenship_district_id" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\District::select('id', 'name','name_eng')->get() as $data)
                        <option value="{{ $data->id }}"
                            {{ old('citizenship_district_id', $application->citizenship_district_id ?? '') == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}-{{ $data->name_eng }} </option>
                    @endforeach
                </select>
                @error('citizenship_district_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="photo" class="form-label">फोटो</label>
                <input type="file" class="form-control {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                    id="photo" name="photo" accept="image/*">
                @if (isset($application->photo))
                    <a target="_blank"
                        href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(2), $application->photo) }}"
                        class="btn btn-sm btn-primary my-1"><i class="fa fa-eye me-2"></i>पूर्वलोकन गर्नुहोस्</a>
                @endif
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="nagrita_copy_front" class="form-label">नागरिकता अगाडि</label>
                <input type="file"
                    class="form-control {{ $errors->has('nagrita_copy_front') ? 'is-invalid' : '' }}"
                    id="nagrita_copy_front" name="nagrita_copy_front" accept=".jpg,.png,image/*,.pdf">
                @if (isset($application->nagrita_copy_front))
                    <a target="_blank"
                        href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(2), $application->nagrita_copy_front) }}"
                        class="btn btn-sm btn-primary my-1">
                        <i class="fa fa-eye me-2"></i>पूर्वलोकन गर्नुहोस्
                    </a>
                @endif
                @error('nagrita_copy_front')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 col-sm-12">
                <label for="nagrita_copy_back" class="form-label">नागरिकता पछाडि</label>
                <input type="file"
                    class="form-control {{ $errors->has('nagrita_copy_back') ? 'is-invalid' : '' }}"
                    id="nagrita_copy_back" name="nagrita_copy_back" accept=".jpg,.png,image/*,.pdf">
                @if (isset($application->nagrita_copy_back))
                    <a target="_blank"
                        href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(2), $application->nagrita_copy_back) }}"
                        class="btn btn-sm btn-primary my-1">
                        <i class="fa fa-eye me-2"></i>पूर्वलोकन गर्नुहोस्
                    </a>
                @endif
                @error('nagrita_copy_back')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <strong class="text-danger">नोट: फाइल JPG/PNG/PDF ढाँचामा हुनुपर्छ र अधिकतम आकार ३००KB
                    हुनुपर्छ।</strong>
            </div>
        </div>

        <h4 class="mb-4 fw-bold">सम्पर्क विवरण</h4>
        <div class="row g-3  mb-4">
            <div class="col-sm-12 col-md-4 ">
                <label>इमेल<span style="color:red;">*</span></label>
                <input class="form-control @error('email') is-invalid @enderror" placeholder="इमेल" type="text"
                    name="email" id="email"
                    value="{{ old('email', $application->email ?? (Auth::user()->email ?? '')) }}" required />
                @error('email')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4 ">
                <label>सम्पर्क नं <span style="color:red;">*</span></label>
                <input class="form-control @error('contact_no') is-invalid @enderror" placeholder="सम्पर्क  नं "
                    type="text" name="contact_no" id="contact_no"
                    value="{{ old('contact_no', $application->contact_no ?? (Auth::user()->contact_no ?? '')) }}"
                    required />
                @error('contact_no')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4 ">
                <label>मोबाइल नं </label>
                <input class="form-control @error('mobile_no') is-invalid @enderror" placeholder="मोबाइल नं  "
                    type="text" name="mobile_no" id="mobile_no"
                    value="{{ old('mobile_no', $application->mobile_no ?? (Auth::user()->contact_no ?? '')) }}" />
                @error('mobile_no')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <h4 class="mb-4 fw-bold">ठेगाना विवरण</h4>

        <div class="row g-3  mb-4">
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <label>स्थायी ठेगाना:</label>
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>प्रदेश: <span style="color:red;">*</span></label>
                <select name="sthyayi_province_id"
                    class="form-control @error('sthyayi_province_id') is-invalid @enderror select2"
                    id="sthyayiProvince" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\Province::get() as $province)
                        <option value="{{ $province->id }}"
                            {{ old('sthyayi_province_id', $application->theganaDetail->sthyayi_province_id ?? '') == $province->id ? 'selected' : '' }}>
                            {{ $province->name }}</option>
                    @endforeach
                </select>
                @error('sthyayi_province_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>जिल्ला: <span style="color:red;">*</span></label>
                <select name="sthyayi_district_id"
                    class="form-control @error('sthyayi_district_id') is-invalid @enderror select2"
                    id="sthyayiDistrict" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\District::get() as $district)
                        <option value="{{ $district->id }}"
                            {{ old('sthyayi_district_id', $application->theganaDetail->sthyayi_district_id ?? '') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
                @error('sthyayi_district_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-4 col-md-4 ">
                <label>स्थानिय तह: <span style="color:red;">*</span></label>
                <select name="sthyayi_sthaniya_taha_id"
                    class="form-control @error('sthyayi_sthaniya_taha_id') is-invalid @enderror select2"
                    id="sthyayiArea" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\SthaniyaTaha::get() as $area)
                        <option value="{{ $area->id }}"
                            {{ old('sthyayi_sthaniya_taha_id', $application->theganaDetail->sthyayi_sthaniya_taha_id ?? '') == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                    @endforeach
                </select>
                @error('sthyayi_sthaniya_taha_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>वडा नम्बर <span style="color:red;">*</span></label>
                <select name="sthyayi_ward_id"
                    class="form-control @error('sthyayi_ward_id') is-invalid @enderror select2" id="sthyayiWard"
                    required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\Ward::get() as $data)
                        <option value="{{ $data->id }}"
                            {{ old('sthyayi_ward_id', $application->theganaDetail->sthyayi_ward_id ?? '') == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
                @error('sthyayi_ward_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>गाउँ/टोल <span style="color:red;">*</span></label>
                <input class="form-control @error('sthyayi_tole_name') is-invalid @enderror" placeholder="गाउँ/टोल "
                    type="text" name="sthyayi_tole_name" id="sthyayiTole"
                    value="{{ old('sthyayi_tole_name', $application->theganaDetail->sthyayi_tole_name ?? '') }}"
                    required />
                @error('sthyayi_tole_name')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12  ">
                <label>अस्थायी ठेगाना:</label>
                <div class="checkbox" style="display: inline-flex;margin-left: 1rem;">
                    <label style="color: rgb(192, 36, 36);"><input type="checkbox" id="copyAddressCheckbox">
                        स्थायी
                        ठेगाना अनुकरण गर्ने</label>
                </div>
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>प्रदेश: <span style="color:red;">*</span></label>
                <select name="asthyayi_province_id"
                    class="form-control @error('asthyayi_province_id') is-invalid @enderror select2"
                    id="asthyayiProvince" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\Province::get() as $province)
                        <option value="{{ $province->id }}"
                            {{ old('asthyayi_province_id', $application->theganaDetail->asthyayi_province_id ?? '') == $province->id ? 'selected' : '' }}>
                            {{ $province->name }}
                        </option>
                    @endforeach
                </select>
                @error('asthyayi_province_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>जिल्ला: <span style="color:red;">*</span></label>
                <select name="asthyayi_district_id"
                    class="form-control @error('asthyayi_district_id') is-invalid @enderror select2"
                    id="asthyayiDistrict" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\District::get() as $district)
                        <option value="{{ $district->id }}"
                            {{ old('asthyayi_district_id', $application->theganaDetail->asthyayi_district_id ?? '') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
                @error('asthyayi_district_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-4 col-md-4 ">
                <label>स्थानिय तह: <span style="color:red;">*</span></label>
                <select name="asthyayi_sthaniya_taha_id"
                    class="form-control @error('asthyayi_sthaniya_taha_id') is-invalid @enderror select2"
                    id="asthyayiArea" required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\SthaniyaTaha::get() as $area)
                        <option value="{{ $area->id }}"
                            {{ old('asthyayi_sthaniya_taha_id', $application->theganaDetail->asthyayi_sthaniya_taha_id ?? '') == $area->id ? 'selected' : '' }}>
                            {{ $area->name }}
                        </option>
                    @endforeach
                </select>
                @error('asthyayi_sthaniya_taha_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>वडा नम्बर <span style="color:red;">*</span></label>
                <select name="asthyayi_ward_id"
                    class="form-control @error('asthyayi_ward_id') is-invalid @enderror select2" id="asthyayiWard"
                    required>
                    <option value="">--कृपया छान्नुहोस्--</option>
                    @foreach (\App\Models\Ward::get() as $data)
                        <option value="{{ $data->id }}"
                            {{ old('asthyayi_ward_id', $application->theganaDetail->asthyayi_ward_id ?? '') == $data->id ? 'selected' : '' }}>
                            {{ $data->name }}
                        </option>
                    @endforeach
                </select>
                @error('asthyayi_ward_id')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-2 col-md-2 ">
                <label>गाउँ/टोल <span style="color:red;">*</span></label>
                <input class="form-control @error('asthyayi_tole_name') is-invalid @enderror" placeholder="गाउँ/टोल "
                    type="text" name="asthyayi_tole_name" id="asthyayiTole"
                    value="{{ old('asthyayi_tole_name', $application->theganaDetail->asthyayi_tole_name ?? '') }}"
                    required />
                @error('asthyayi_tole_name')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-sm-4 col-md-4 ">
                <label class="form-label">बसाइँ सराइ प्रमाणपत्र</label>
                <input class="form-control @error('migration_certificate') is-invalid @enderror" type="file"
                    name="migration_certificate" id="migration_certificate" />
                @if (isset($application->theganaDetail->migration_certificate))
                    <a target="_blank"
                        href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(2), $application->theganaDetail->migration_certificate) }}"
                        class="btn btn-sm btn-primary my-1"><i class="fa fa-eye me-2"></i>पूर्वलोकन गर्नुहोस्</a>
                @endif
                @error('migration_certificate')
                    <div class="text-danger  mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 ">
                @if (isset($application->id))
                <input type="text" id="todayMiti" name="application_miti_bs" placeholder="YYYY-MM-DD"
                value="" hidden readonly>
                @endif
                <span class="text-danger">नोट: यदि अन्य कुनै स्थानबाट बसाइँसराइ गरेर आएको हो भने, कृपया सो जानकारी
                    स्पष्ट
                    गराउन सम्बन्धित कागजातहरू पनि राख्नुहोस्।</span>
            </div>
        </div>
        <div>
            <strong class="text-danger">नोट: फाइल JPG/PNG/PDF ढाँचामा हुनुपर्छ र अधिकतम आकार ३००KB हुनुपर्छ।</strong>
        </div>

        <div class="text-end mt-4">
            <button class="btn btn-primary next-tab" type="submit"> <i class="fa fa-save me-2"></i>
                सुरक्षित गर्नुहोस् र अगाडि बढ्नुहोस्</button>
        </div>

    </form>

</div>

