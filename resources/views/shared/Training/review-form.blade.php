 <!-- Review Tab -->
 <div class="tab-pane fade {{ $errors->has('agree_terms') ? 'show active' : '' }}" id="review" role="tabpanel"
     aria-labelledby="review-tab">
     <div class="d-flex justify-content-between mb-4 no-print">
         <h4>तपाईंको जानकारी पुनरावलोकन गर्नुहोस्</h4>
         <button type="button" onclick="printActiveTab()" class="btn btn-sm btn-primary"><i
                 class="fa fa-print"></i>&nbsp;&nbsp;मुद्रण</button>
     </div>

     <div class="card mb-3">
         <div class="card-body">
             <div class="row g-3">
                 <div class="col-lg-3 col-md-3 col-sm-12">
                     @if (isset($application->photo))
                         <img src="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(2), $application->photo) }}"
                             class="border" style="height:150px; width: 150px;" alt="">
                     @endif
                 </div>
                 <div class="col-lg-9 col-md-9 col-sm-12">
                     <div class="row g-2">
                         <div class="col-sm-12 col-md-12">
                             <h4> {{ $application->fullname_np ?? '' }}</h4>
                         </div>
                         <div class="col-sm-12 col-md-12">
                             <h6><strong>आवेदन नं.:</strong>
                                 {{ \App\Helpers\NumberHelper::toNepaliNumber($application->application_no) ?? '' }}
                             </h6>
                         </div>
                         <div class="col-sm-12 col-md-8">
                             <h6><strong>ईमेल:</strong> {{ $application->email ?? '' }}</h6>
                         </div>
                         <div class="col-sm-12 col-md-4">
                             <h6><strong>सम्पर्क नं:</strong>
                                 {{ $application->contact_no ?? ($application->phone_no ?? '') }}
                             </h6>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="card mb-3">
         <div class="card-header bg-white pt-3">
             <h5 class="fw-bold">व्यक्तिगत विवरण</h5>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered mb-0">
                     <tbody>
                         <tr>
                             <th>नाम (नेपाली) </th>
                             <td>{{ $application->fullname_np }} / {{ $application->fullname_eng }}</td>
                             <th>नाम (अंग्रेजी) </th>
                             <td>{{ $application->fullname_eng }}</td>
                         </tr>
                         <tr>
                             <th>हजुरबुबाको नाम </th>
                             <td>{{ $application->grandfather_name }} </td>
                             <th>बुबाको नाम </th>
                             <td>{{ $application->father_name }} </td>
                         </tr>
                         <tr>
                             <th>आमाको नाम </th>
                             <td>{{ $application->mother_name }} </td>
                             <th>ठेगाना </th>
                             <td>
                                 {{ $application->theganaDetail->asthyayi_tole_name ?? '' }}-
                                 {{ $application->theganaDetail->asthyayi_ward_id ?? '' }},
                                 {{ $application->theganaDetail->asthyayiDistrict->name ?? '' }},
                                 {{ $application->theganaDetail->asthyayiProvince->name ?? '' }}
                             </td>
                         </tr>


                         <tr>
                             <th>ईमेल </th>
                             <td>{{ $application->email }}</td>
                             <th>सम्पर्क नं </th>
                             <td>{{ $application->mobile_no }} / {{ $application->contact_no }}</td>
                         </tr>



                         <tr>
                             <th>जन्म मिति (बि.सं.) </th>
                             <td>{{ $application->dob_bs }} </td>
                             <th>जन्म मिति (ई.सं.) </th>
                             <td>{{ $application->dob_ad }} </td>
                         </tr>

                         <tr>
                             <th>शिक्षा स्तर</th>
                             <td>{{ $application->educationDetail->educationLevel->name_np ?? 'N/A' }}</td>
                             <th>नागरिकता नं</th>
                             <td>{{ $application->citizenship_no ?? 'N/A' }}</td>
                         </tr>

                         <tr class="no-print">
                             <th>नागरिता फोटो (अगाडि)</th>
                             <td>
                                 @if ($application->nagrita_copy_front)
                                     <a href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(1), $application->nagrita_copy_front) }}"
                                         target="_blank"
                                         class="d-inline-flex align-items-center mb-2 text-decoration-none">
                                         <i class="fas fa-sticky-note me-2"></i> अगाडिको फोटो हेर्नुहोस्
                                     </a><br>
                                 @else
                                     <p>अगाडिको फोटो छैन।</p>
                                 @endif
                             </td>

                             <th>नागरिता फोटो (पछाडि)</th>
                             <td>
                                 @if ($application->nagrita_copy_back)
                                     <a href="{{ URL::temporarySignedRoute('application-file.show', now()->addMinutes(1), $application->nagrita_copy_back) }}"
                                         target="_blank"
                                         class="d-inline-flex align-items-center mb-2 text-decoration-none">
                                         <i class="fas fa-sticky-note me-2"></i> पछाडिको फोटो हेर्नुहोस्
                                     </a>
                                 @else
                                     <p>पछाडिको फोटो छैन।</p>
                                 @endif
                             </td>

                         </tr>

                     </tbody>
                 </table>
             </div>
         </div>
     </div>

     <div class="card mb-4">
         <div class="card-header bg-white pt-3">
             <h5 class="fw-bold">शैक्षिक विवरण</h5>
         </div>
         <div class="card-body" id="review-education">
             @include('admin.TrainingApplication.Education.table')
         </div>
     </div>



     <div class="card mb-4">
         <div class="card-header bg-white pt-3">
             <h5 class="fw-bold">अनुभव विवरण</h5>
         </div>
         <div class="card-body">
             <div class="row review-data" id="review-experience">
                 @include('admin.TrainingApplication.Experience.table')
             </div>
         </div>
     </div>

     <div class="card mb-4 page-break-before">
         <div class="card-header bg-white pt-3">
             <h5 class="fw-bold">अन्य विवरण</h5>
         </div>
         <div class="card-body">
             <div class="row review-data" id="review-anye">
                 @include('admin.TrainingApplication.AnyeBibaran.table')
             </div>
         </div>
     </div>
    <div class="card mb-4 no-print">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.application.finalize', [$training->id, $application->id]) }}">
                @csrf
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                    <label class="form-check-label" for="agree_terms">
                        मैले सर्त र अवस्था स्वीकार गरेको छु र सबै जानकारी सही रहेको पुष्टि गर्दछु।
                    </label>
                </div>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fa fa-paper-plane me-2"></i> आवेदन पेश गर्नुहोस्
                </button>
            </form>
        </div>
    </div>
 </div>
 <script src="{{ asset('Backend/assets/js/print.js') }}"></script>
