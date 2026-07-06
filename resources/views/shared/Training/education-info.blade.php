 <div class="tab-pane fade {{ session('education_tab') ? 'show active' : '' }}" id="education" role="tabpanel" aria-labelledby="education-tab">
     <div class="card rounded-0 shadow-none mb-4">
         <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="card-title mb-0">शैक्षिक विवरण</h5>
             <button type="button" id="add-education-form" class="btn btn-sm btn-success" data-bs-toggle="modal"
                 data-bs-target="#EducationModal"><i class="fa fa-plus"></i></button>
         </div>
         <div class="card-body">
             <!-- Table to list education data -->
            @include('admin.TrainingApplication.Education.table')
         </div>
     </div>
     <!-- EducationModal -->
     <div class="modal fade" id="EducationModal" tabindex="-1" role="dialog" aria-labelledby="EducationModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" style="max-width: 80vw;" role="Kagzat">
             <div class="modal-content">
                 <div class="modal-header">
                     <div class="w-100 d-flex justify-content-between align-items-center">
                         <h5 id="EducationModalLabel">शैक्षिक विवरण</h5>
                         <button type="button" class="btn btn-sm btn-danger text-end" data-bs-dismiss="modal"
                             aria-label="Close">
                             <i class="fa fa-times"></i>
                         </button>
                     </div>
                 </div>
                 <div class="modal-body">
                     <form method="post"
                         action="{{ route('training-application.education.store', ['training' => $application->training_id, 'application' => $application->id]) }}"
                         enctype="multipart/form-data">
                         @csrf

                         <div class="row g-3">
                             <div class="col-sm-12 col-md-4">
                                 <label for="education_level_id" class="form-label">शिक्षा स्तर <span
                                         class="text-danger">*</span></label>
                                 <select class="form-control {{ $errors->has('education_level') ? 'is-invalid' : '' }}"
                                     id="education_level" name="education_level_id">
                                     <option value="">--कृपया छान्नुहोस्--</option>
                                     @foreach (\App\Models\EducationLevel::select('id', 'name_np')->get() as $data)
                                         <option value="{{ $data->id }}"
                                             {{ old('education_level_id' ?? '') == $data->id ? 'selected' : '' }}>
                                             {{ $data->name_np }}</option>
                                     @endforeach
                                 </select>
                                 @error('education_level_id')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-sm-12 col-md-4">
                                 <label for="institution_name" class="form-label">शैक्षिक संस्थाको नाम
                                 </label>
                                 <input type="text"
                                     class="form-control {{ $errors->has('institution_name') ? 'is-invalid' : '' }}"
                                     id="institution_name" name="institution_name"
                                     value="{{ old('institution_name' ?? '') }}">
                                 @error('institution_name')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-4 col-sm-12">
                                 <label for="field_of_study" class="form-label">पढाइको विषय</label>
                                 <input type="text"
                                     class="form-control {{ $errors->has('field_of_study') ? 'is-invalid' : '' }}"
                                     id="field_of_study" name="field_of_study"
                                     value="{{ old('field_of_study' ?? '') }}">
                                 @error('field_of_study')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="col-md-4 col-sm-12">
                                 <label for="passed_year" class="form-label">उत्तीर्ण वर्ष</label>
                                 <input type="text" class="form-control" name="passed_year" id="passed_year"
                                     value="{{ old('passed_year' ?? '') }}">
                                 @error('passed_year')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="col-md-4 col-sm-12">
                                 <label for="result_type" class="form-label">शैक्षिक मूल्याङ्कन</label>
                                 <select class="form-control {{ $errors->has('result_type') ? 'is-invalid' : '' }}"
                                     id="result_type" name="result_type">
                                     <option value="">--कृपया छान्नुहोस्--</option>
                                     <option value="grade"
                                         {{ old('result_type' ?? '') == 'grade' ? 'selected' : '' }}>
                                         Grade</option>
                                     <option value="percentage"
                                         {{ old('result_type' ?? '') == 'percentage' ? 'selected' : '' }}>
                                         Percentage
                                     </option>
                                 </select>

                                 @error('result_type')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-4 col-sm-12">
                                 <label for="result_score" class="form-label">GPA / Percentage</label>
                                 <input type="text"
                                     class="form-control {{ $errors->has('result_score') ? 'is-invalid' : '' }}"
                                     id="result_score" name="result_score"
                                     value="{{ old('result_score' ?? '') }}">
                                 @error('result_score')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>



                             <div class="col-md-4 col-sm-12">
                                 <label for="marksheet" class="form-label">शैक्षिक परिणाम पत्र</label>
                                 <input type="file"
                                     class="form-control {{ $errors->has('marksheet') ? 'is-invalid' : '' }}"
                                     id="marksheet" name="marksheet" accept=".jpg,.png,image/*,.pdf">
                                 
                                 @error('marksheet')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="col-md-4 col-sm-12">
                                 <label for="character_certificate" class="form-label">चरित्र
                                     प्रमाणपत्र</label>
                                 <input type="file"
                                     class="form-control {{ $errors->has('character_certificate') ? 'is-invalid' : '' }}"
                                     id="character_certificate" name="character_certificate" accept=".jpg,.png,image/*,.pdf">
                                 
                                 @error('character_certificate')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>

                             <div class="col-md-4 col-sm-12">
                                 <label for="equivalency_certificate" class="form-label">समकक्षता
                                     प्रमाणपत्</label>
                                 <input type="file"
                                     class="form-control {{ $errors->has('equivalency_certificate') ? 'is-invalid' : '' }}"
                                     id="equivalency_certificate" name="equivalency_certificate" accept=".jpg,.png,image/*,.pdf">
    
                                 @error('equivalency_certificate')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                         </div>
                         <div class="mt-3">
                             <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>सुरक्षित
                                 गर्नुहोस्</button>
                             <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                                     class="fas fa-arrow-left me-2"></i>बन्द गर्नुहोस्</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
