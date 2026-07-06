 <div class="tab-pane fade {{ session('experience_tab') ? 'show active' : '' }}" id="experience" role="tabpanel"
     aria-labelledby="experience-tab">
     <div class="card rounded-0 shadow-none mb-4">
         <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="card-title mb-0">अनुभव विवरण</h5>
             <button type="button" id="add-experience-form" class="btn btn-sm btn-success" data-bs-toggle="modal"
                 data-bs-target="#ExperienceModal"><i class="fa fa-plus"></i></button>
         </div>
         <div class="card-body">
             <!-- Table to list experience data -->
             @include('admin.TrainingApplication.Experience.table')
         </div>
     </div>
     <!-- ExperienceModal -->
     <div class="modal fade" id="ExperienceModal" tabindex="-1" role="dialog" aria-labelledby="ExperienceModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" style="max-width: 80vw;" role="Kagzat">
             <div class="modal-content">
                 <div class="modal-header">
                     <div class="w-100 d-flex justify-content-between align-items-center">
                         <h5 id="ExperienceModalLabel">अनुभव विवरण</h5>
                         <button type="button" class="btn btn-sm btn-danger text-end" data-bs-dismiss="modal"
                             aria-label="Close">
                             <i class="fa fa-times"></i>
                         </button>
                     </div>
                 </div>
                 <div class="modal-body">
                     <form method="post"
                         action="{{ route('training-application.experience.store', ['training' => $application->training_id, 'application' => $application->id]) }}"
                         enctype="multipart/form-data">
                         @csrf

                         <div class="row g-3">
                             <div class="col-sm-12 col-md-8">
                                 <label for="sanstha_name" class="form-label">संस्थाको नाम </label>
                                 <input type="text"
                                     class="form-control {{ $errors->has('sanstha_name') ? 'is-invalid' : '' }}"
                                     id="sanstha_name" name="sanstha_name" value="{{ old('sanstha_name' ?? '') }}">
                                 @error('sanstha_name')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-4 col-sm-12">
                                 <label for="category" class="form-label">क्याटेगोरी</label>

                                 <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                     id="category" name="category_id">
                                     <option value="">--कृपया छान्नुहोस्--</option>
                                     @foreach (\App\Models\Category::select('id', 'name_np')->get() as $data)
                                         <option value="{{ $data->id }}"
                                             {{ old('category_id' ?? '') == $data->id ? 'selected' : '' }}>
                                             {{ $data->name_np }}</option>
                                     @endforeach
                                 </select>

                                 @error('category_id')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-3 col-sm-12">
                                 <label for="start_miti_bs" class="form-label">सुरु मिति (बि.सं.)</label>
                                 <input type="text"
                                     class="form-control datepicker {{ $errors->has('start_miti_bs') ? 'is-invalid' : '' }}"
                                     id="start_miti_bs" name="start_miti_bs" value="{{ old('start_miti_bs' ?? '') }}"
                                     placeholder="YYYY-MM-DD">
                                 @error('start_miti_bs')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-3 col-sm-12">
                                 <label for="start_miti_ad" class="form-label">सुरु मिति (ई.सं.)</label>
                                 <input type="text"
                                     class="form-control english-datepicker {{ $errors->has('start_miti_ad') ? 'is-invalid' : '' }}"
                                     id="start_miti_ad" name="start_miti_ad" value="{{ old('start_miti_ad' ?? '') }}"
                                     placeholder="YYYY-MM-DD" readonly>
                                 @error('start_miti_ad')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-3 col-sm-12">
                                 <label for="end_miti_bs" class="form-label">समाप्ति मिति (बि.सं.)</label>
                                 <input type="text"
                                     class="form-control datepicker {{ $errors->has('end_miti_bs') ? 'is-invalid' : '' }}"
                                     id="end_miti_bs" name="end_miti_bs" value="{{ old('end_miti_bs' ?? '') }}"
                                     placeholder="YYYY-MM-DD">
                                 @error('end_miti_bs')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-3 col-sm-12">
                                 <label for="end_miti_ad" class="form-label">समाप्ति मिति (ई.सं.)</label>
                                 <input type="text"
                                     class="form-control english-datepicker {{ $errors->has('end_miti_ad') ? 'is-invalid' : '' }}"
                                     id="end_miti_ad" name="end_miti_ad" value="{{ old('end_miti_ad' ?? '') }}"
                                     placeholder="YYYY-MM-DD" readonly>
                                 @error('end_miti_ad')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-4 col-sm-12">
                                 <label for="document" class="form-label">अनुभव दस्तावेज</label>
                                 <input type="file"
                                     class="form-control {{ $errors->has('document') ? 'is-invalid' : '' }}"
                                     id="expDocument" name="document" accept=".jpg,.png,image/*,.pdf">

                                 @error('document')
                                     <div class="invalid-feedback">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-12">
                                 <strong class="text-danger">नोट: फाइल JPG/PNG/PDF ढाँचामा हुनुपर्छ र अधिकतम आकार ३००KB
                                     हुनुपर्छ।</strong>
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
