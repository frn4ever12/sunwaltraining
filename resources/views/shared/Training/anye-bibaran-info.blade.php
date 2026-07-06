 <div class="tab-pane fade {{ session('anye_tab') ? 'show active' : '' }}" id="anyeBibaran" role="tabpanel"
     aria-labelledby="anyeBibaran-tab">
     <div class="card rounded-0 shadow-none mb-4">
         <div class="card-header d-flex justify-content-between align-items-center">
             <h5 class="card-title mb-0">अन्य विवरण</h5>
             <button type="button" id="add-anyeBibaran-form" class="btn btn-sm btn-success" data-bs-toggle="modal"
                 data-bs-target="#AnyeBibaranModal"><i class="fa fa-plus"></i></button>
         </div>
         <div class="card-body">
             <!-- Table to list anyeBibaran data -->
             @include('admin.TrainingApplication.AnyeBibaran.table')
         </div>
     </div>
     <!-- AnyeBibaranModal -->
     <div class="modal fade" id="AnyeBibaranModal" tabindex="-1" role="dialog" aria-labelledby="AnyeBibaranModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" style="max-width: 80vw;" role="Kagzat">
             <div class="modal-content">
                 <div class="modal-header">
                     <div class="w-100 d-flex justify-content-between align-items-center">
                         <h5 id="AnyeBibaranModalLabel">अन्य विवरण</h5>
                         <button type="button" class="btn btn-sm btn-danger text-end" data-bs-dismiss="modal"
                             aria-label="Close">
                             <i class="fa fa-times"></i>
                         </button>
                     </div>
                 </div>
                 <div class="modal-body">
                     <form method="post"
                         action="{{ route('training-application.anye-bibaran.store', ['training' => $application->training_id, 'application' => $application->id]) }}"
                         enctype="multipart/form-data">
                         @csrf

                         <div class="row g-3">
                             <div class="col-sm-12 col-md-4">
                                 <label>चलनी नं.</label>
                                 <input class="form-control @error('chalani_no') is-invalid @enderror"
                                     placeholder="चलनी नं." type="text" name="chalani_no" id="chalani_no"
                                     value="{{ old('chalani_no', '') }}">
                                 @error('chalani_no')
                                     <div class="text-danger  mt-2">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-sm-12 col-md-4">
                                 <label>कागजको नाम </label>
                                 <input class="form-control @error('document_name') is-invalid @enderror"
                                     placeholder="कागजको नाम" type="text" name="document_name" id="document_name"
                                     value="{{ old('document_name', '') }}">
                                 @error('document_name')
                                     <div class="text-danger  mt-2">{{ $message }}</div>
                                 @enderror
                             </div>
                             <div class="col-md-4 col-sm-12">
                                 <label for="anye_document">छुटपुट कागजात</label>
                                 <input type="file"
                                     class="form-control {{ $errors->has('anye_document') ? 'is-invalid' : '' }}"
                                     id="anye_document" name="anye_document" accept=".jpg,.png,image/*,.pdf">

                                 @error('anye_document')
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
