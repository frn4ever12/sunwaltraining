<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ArthikBarsaController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BroadcastMessageController;
use App\Http\Controllers\Admin\BudgetBibaranController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\EducationLevelController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\KarmachariController;
use App\Http\Controllers\Admin\KaryabidhiController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\PrayogkartaBhumikaController;
use App\Http\Controllers\Admin\PrayogkartaDartaController;
use App\Http\Controllers\Admin\PratibedanController;
use App\Http\Controllers\Admin\PreferenceController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\SamacharController;
use App\Http\Controllers\Admin\SchemeController;
use App\Http\Controllers\Admin\SthaniyaTahaController;
use App\Http\Controllers\Admin\TargetGroupController;
use App\Http\Controllers\Admin\TrainingApplicationController;
use App\Http\Controllers\Admin\TrainingAttendanceController;
use App\Http\Controllers\Admin\TrainingCertificationController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\WardController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','verified'])->group(function () {

    Route::resource('organization', OrganizationController::class)->only(['index', 'update'])->middleware('can:palika_setup');
    Route::resource('banner', BannerController::class)->except('show')->middleware('can:banner');
    Route::resource('arthik-barsa', ArthikBarsaController::class)->except('show')->middleware('can:arthik_barsha');
    Route::resource('province', ProvinceController::class)->except('show')->middleware('can:province');
    Route::resource('district', DistrictController::class)->except('show')->middleware('can:district');
    Route::resource('sthaniya-taha', SthaniyaTahaController::class)->except('show')->middleware('can:sthaniya_taha');
    Route::resource('ward', WardController::class)->except('show')->middleware('can:ward');

    Route::resource('about-us', AboutUsController::class)->except(['show'])->middleware('can:about_us');
    Route::resource('department', DepartmentController::class)->except('show')->middleware('can:department');
    Route::resource('samachar', SamacharController::class)->except('show')->middleware('can:samachar');
    Route::resource('preference', PreferenceController::class)->except('show')->middleware('can:preference');
    Route::resource('target-group', TargetGroupController::class)->except('show')->parameters(['target-group' => 'group'])->middleware('can:target_group');
    Route::resource('broadcast', BroadcastMessageController::class)->except('show')->middleware('can:broadcast');

    Route::resource('karyabidhi', KaryabidhiController::class)->except('show')->middleware('can:karyabidhi');
    Route::resource('scheme', SchemeController::class)->except('show')->middleware('can:scheme');
    Route::resource('notice', NoticeController::class)->except('show')->middleware('can:notice');
    Route::resource('budgetBibaran', BudgetBibaranController::class)->except('show')->parameters(['budgetBibaran' => 'bibaran'])->middleware('can:budget_bibaran');


    Route::resource('karmachari', KarmachariController::class)->except('show')->middleware('can:karmachari');
    Route::resource('prayog-karta-darta', PrayogkartaDartaController::class)->parameters(['prayog-karta-darta' => 'user'])->middleware('can:prayogkarta_darta');
    Route::resource('prayog-karta-bhumika', PrayogkartaBhumikaController::class)
        ->except('show')->parameters(['prayog-karta-bhumika' => 'role'])->names([
            'index' => 'prayog-karta-bhumika.index',
            'create' => 'prayog-karta-bhumika.create',
            'store' => 'prayog-karta-bhumika.store',
            'update' => 'prayog-karta-bhumika.update',
            'destroy' => 'prayog-karta-bhumika.destroy',
        ])->middleware('can:prayogkarta_bhumika');

    Route::resource('training', TrainingController::class)->except(['index'])->middleware(['can:training', 'can:manage_training']);
    Route::get('training', [TrainingController::class, 'index'])->name('training.index')->middleware('can:training');
    Route::get('training/calendar-events', [TrainingController::class, 'calendarEvents'])->name('training.calendar-events');

    Route::get('training-applications', [TrainingApplicationController::class, 'index'])->name('application.index')->middleware('can:apply_training');
    Route::get('training-{training}-application/form', [TrainingApplicationController::class, 'create'])->name('application.create')->middleware(['can:apply_training','training_status','already_applied']);
    Route::post('training-{training}-application', [TrainingApplicationController::class, 'store'])->name('application.store')->middleware(['can:apply_training','training_status','already_applied']);
    Route::get('training-{training}-application-{application}/show', [TrainingApplicationController::class, 'show'])->name('application.show')->middleware('can:apply_training');
    Route::get('training-{training}-application/{application}/edit', [TrainingApplicationController::class, 'edit'])->name('application.edit')->middleware(['can:apply_training','training_status','already_applied']);
    Route::put('training-{training}-application/{application}/update', [TrainingApplicationController::class, 'update'])->name('application.update')->middleware(['can:apply_training','training_status','already_applied']);
    Route::post('training-{training}-application/{application}/finalize', [TrainingApplicationController::class, 'finalize'])->name('application.finalize')->middleware(['can:apply_training','training_status','already_applied']);
    Route::delete('training-application/{application}/destroy', [TrainingApplicationController::class, 'destroy'])->name('application.destroy')->middleware('can:manage_training');
    Route::put('training-application/{training}/update-status', [TrainingApplicationController::class, 'updateStatus'])->name('application.updateStatus')->middleware('can:manage_training');
    Route::resource('training', TrainingController::class)->except(['index'])->middleware(['can:training','can:manage_training']);
    Route::get('training',[TrainingController::class,'index'])->name('training.index')->middleware('can:training');
    
    Route::get('my-training-applications',[TrainingApplicationController::class,'myApplications'])->name('my-training-application.index')->middleware('can:apply_training');
   
    ROute::get('training-{training}/attendance',[TrainingAttendanceController::class,'index'])->name('attendance.index')->middleware('can:manage_training');

    //pratibedan
    Route::get('/pratibedan/prashikshan', [PratibedanController::class, 'prashikshan'])->name('prashikshan.pratibedan')->middleware('can:prashikshan_pratibedan');
    Route::get('/pratibedan/aabedan', [PratibedanController::class, 'aabedan'])->name('aabedan.pratibedan')->middleware('can:aabedan_pratibedan');
   
    Route::resource('contact', ContactController::class);

    Route::get('my-training-applications', [TrainingApplicationController::class, 'myApplications'])->name('my-training-application.index')->middleware('can:apply_training');

    //attandence
    ROute::get('training-{training}/attendance', [TrainingAttendanceController::class, 'index'])->name('attendance.index')->middleware('can:manage_training');
    ROute::post('training-{training}/attendance', [TrainingAttendanceController::class, 'store'])->name('attendance.store')->middleware('can:manage_training');


    //pratibedan
    Route::get('/pratibedan/prashikshan', [PratibedanController::class, 'prashikshan'])->name('prashikshan.pratibedan')->middleware('can:prashikshan_pratibedan');
    Route::get('/pratibedan/aabedan', [PratibedanController::class, 'aabedan'])->name('aabedan.pratibedan')->middleware('can:aabedan_pratibedan');
  
    Route::get('training-{training}/certifications', [TrainingCertificationController::class,'index'])->name('certifications.index')->middleware('can:certificate');
    Route::post('training-{training}/certifications', [TrainingCertificationController::class,'store'])->name('certifications.store')->middleware('can:certificate');
    Route::get('training-{training}/certificates', [TrainingCertificationController::class,'show'])->name('certifications.show')->middleware('can:certificate');

    Route::resource('contact', ContactController::class)->middleware('can:contact_us');
    Route::resource('certificate', CertificateController::class)->middleware('can:certificate');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::get('applicants', [ApplicantController::class, 'index'])->name('applicants.index')->middleware('can:application');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Training Reports
    Route::get('reports/training/list', [ReportController::class, 'trainingList'])->name('reports.training.list');
    Route::get('reports/training/progress', [ReportController::class, 'trainingProgress'])->name('reports.training.progress');
    Route::get('reports/training/completed', [ReportController::class, 'completedTraining'])->name('reports.training.completed');
    Route::get('reports/training/summary', [ReportController::class, 'trainingSummary'])->name('reports.training.summary');
    
    // Application Reports
    Route::get('reports/application/received', [ReportController::class, 'receivedApplications'])->name('reports.application.received');
    Route::get('reports/application/approved', [ReportController::class, 'approvedApplications'])->name('reports.application.approved');
    Route::get('reports/application/rejected', [ReportController::class, 'rejectedApplications'])->name('reports.application.rejected');
    Route::get('reports/application/pending', [ReportController::class, 'pendingApplications'])->name('reports.application.pending');
    
    // Participant Reports
    Route::get('reports/participant/list', [ReportController::class, 'participantList'])->name('reports.participant.list');
    Route::get('reports/participant/by-training', [ReportController::class, 'participantByTraining'])->name('reports.participant.by-training');
    Route::get('reports/participant/by-ward', [ReportController::class, 'participantByWard'])->name('reports.participant.by-ward');
    Route::get('reports/participant/by-gender', [ReportController::class, 'participantByGender'])->name('reports.participant.by-gender');
    Route::get('reports/participant/by-age', [ReportController::class, 'participantByAge'])->name('reports.participant.by-age');
    Route::get('reports/participant/by-inclusion', [ReportController::class, 'participantByInclusion'])->name('reports.participant.by-inclusion');
    
    // Attendance Reports
    Route::get('reports/attendance/daily', [ReportController::class, 'dailyAttendance'])->name('reports.attendance.daily');
    Route::get('reports/attendance/monthly', [ReportController::class, 'monthlyAttendance'])->name('reports.attendance.monthly');
    Route::get('reports/attendance/participant', [ReportController::class, 'participantAttendance'])->name('reports.attendance.participant');
    Route::get('reports/attendance/absent', [ReportController::class, 'absentList'])->name('reports.attendance.absent');
    
    // Trainer Reports
    Route::get('reports/trainer/list', [ReportController::class, 'trainerList'])->name('reports.trainer.list');
    Route::get('reports/trainer/by-training', [ReportController::class, 'trainerByTraining'])->name('reports.trainer.by-training');
    Route::get('reports/trainer/payment', [ReportController::class, 'trainerPayment'])->name('reports.trainer.payment');
    Route::get('reports/trainer/evaluation', [ReportController::class, 'trainerEvaluation'])->name('reports.trainer.evaluation');
    
    // Certificate Reports
    Route::get('reports/certificate/issued', [ReportController::class, 'issuedCertificates'])->name('reports.certificate.issued');
    Route::get('reports/certificate/register', [ReportController::class, 'certificateRegister'])->name('reports.certificate.register');
    Route::get('reports/certificate/download', [ReportController::class, 'certificateDownload'])->name('reports.certificate.download');

    Route::resource('gallery', GalleryController::class)->except('show')->middleware('can:gallery');
    Route::delete('/gallery/{galleryId}/photo/{photoId}', [GalleryController::class, 'deletePhoto'])->name('gallery.deletePhoto')->middleware('can:gallery');

    //category
    Route::resource('category', CategoryController::class)->except('show')->middleware('can:category');
    //education-level
    Route::resource('education-level', EducationLevelController::class)->except('show')->middleware('can:education_level');

});
