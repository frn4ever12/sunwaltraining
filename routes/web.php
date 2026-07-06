<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TaAnyeBibaranDetailController;
use App\Http\Controllers\Admin\TaEducationDetailController;
use App\Http\Controllers\Admin\TaExperienceDetailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\TrainingController;
use App\Http\Controllers\Frontend\PrakashanController;
use App\Http\Controllers\Frontend\TrainingApplicationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/districts/{province}', [LocationController::class, 'getDistricts']);
Route::get('/municipalities/{district}', [LocationController::class, 'getSthaniyaTaha']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::middleware(['training_status'])->group(function () {
        Route::get('training-{training}-application', [TrainingApplicationController::class, 'index'])->name('training-application.index')->middleware('already_applied');
        Route::post('/training-{training}-application', [TrainingApplicationController::class, 'store'])->name('training-application.store')->middleware('already_applied');
        Route::get('/training-{training}/already-applied', [TrainingApplicationController::class, 'alreadyApplied'])->name('training-application.already-applied')  ;

        Route::get('/training-{training}/application-{application}/edit', [TrainingApplicationController::class, 'edit'])
            ->name('training-application.edit')->middleware('already_applied');

        Route::put('/training-{training}/application-{application}', [TrainingApplicationController::class, 'update'])
            ->name('training-application.update')->middleware('already_applied');

        Route::post('training-{training}-application-{application}/education', [TaEducationDetailController::class, 'store'])->name('training-application.education.store')->middleware('already_applied');
        Route::get('training-{training}-application-{application}/education/{detail}/edit', [TaEducationDetailController::class, 'edit'])->name('training-application.education.edit')->middleware('already_applied');
        Route::put('training-{training}-application-{application}/education/{detail}/update', [TaEducationDetailController::class, 'update'])->name('training-application.education.update')->middleware('already_applied');
        Route::delete('training-{training}-application-{application}/education/{detail}/destroy', [TaEducationDetailController::class, 'destroy'])->name('training-application.education.destroy')->middleware('already_applied');
      
        Route::post('training-{training}-application-{application}/experience', [TaExperienceDetailController::class, 'store'])->name('training-application.experience.store')->middleware('already_applied');
        Route::get('training-{training}-application-{application}/experience/{detail}/edit', [TaExperienceDetailController::class, 'edit'])->name('training-application.experience.edit')->middleware('already_applied');
        Route::put('training-{training}-application-{application}/experience/{detail}/update', [TaExperienceDetailController::class, 'update'])->name('training-application.experience.update')->middleware('already_applied');
        Route::delete('training-{training}-application-{application}/experience-{detail}/destroy', [TaExperienceDetailController::class, 'destroy'])->name('training-application.experience.destroy')->middleware('already_applied');
      
        Route::post('training-{training}-application-{application}/anye-bibaran', [TaAnyeBibaranDetailController::class, 'store'])->name('training-application.anye-bibaran.store')->middleware('already_applied');
        Route::get('training-{training}-application-{application}/anye-bibaran/{detail}/edit', [TaAnyeBibaranDetailController::class, 'edit'])->name('training-application.anye-bibaran.edit')->middleware('already_applied');
        Route::put('training-{training}-application-{application}/anye-bibaran/{detail}/update', [TaAnyeBibaranDetailController::class, 'update'])->name('training-application.anye-bibaran.update')->middleware('already_applied');
        Route::delete('training-{training}-application-{application}/anye-bibaran-{detail}/destroy', [TaAnyeBibaranDetailController::class, 'destroy'])->name('training-application.anye-bibaran.destroy')->middleware('already_applied');
    
    });
    Route::get('file{filePath}', [FileController::class, 'servePrivateFile'])->name('file.show')->where('filePath', '.*')->middleware('can:view_private_file');

    Route::get('application/file-{filePath}', [FileController::class, 'servePrivateFile'])
        ->name('application-file.show')
        ->where('filePath', '.*')
        ->middleware(['signed', 'my_file']);

    // Trainee certificate view route
    Route::get('training-{training}/my-certificate', [TrainingApplicationController::class, 'viewCertificate'])
        ->name('training-application.view-certificate');

    // Notification routes
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/training', [TrainingController::class, 'index'])->name('training.index');
Route::get('/training/{id}', [TrainingController::class, 'show'])->name('training.show');
Route::get('/samachar', [PrakashanController::class, 'samachar'])->name('samachar.index');
Route::get('/notice', [PrakashanController::class, 'notice'])->name('notice.index');
Route::get('/karyabidhi', [PrakashanController::class, 'karyabidhi'])->name('karyabidhi.index');
Route::get('/scheme', [PrakashanController::class, 'scheme'])->name('scheme.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

Route::get('/about', [AboutUsController::class, 'index'])->name('about.index');
Route::get('/about/{id}', [AboutUsController::class, 'show'])->name('about-us');

Route::resource('gallery', GalleryController::class)->only('index', 'show');


require __DIR__ . '/auth.php';
