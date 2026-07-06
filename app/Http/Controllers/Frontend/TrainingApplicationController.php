<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingApplicationRequest;
use App\Models\Training;
use App\Models\TrainingApplication;
use App\Services\TrainingApplicationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TrainingApplicationController extends Controller
{
    protected $trainingApplicationService;

    public function __construct(TrainingApplicationService $trainingApplicationService)
    {
        $this->trainingApplicationService = $trainingApplicationService;
    }
    public function index($training)
    {
        $training = Training::select('id', 'status', 'name_np','start_miti_bs', 'user_id')->find($training);
        return view('admin.TrainingApplication.form', compact('training'));
    }

    public function alreadyApplied()
    {
        return view('shared.messages.already-applied');
    }

    public function viewCertificate($training)
    {
        $training = Training::select('id', 'start_miti_bs', 'end_miti_bs', 'institution_name_np', 'institution_name_eng', 'name_np', 'name_eng', 'start_miti_ad', 'end_miti_ad', 'department_id')->find($training);
        
        // Get the current user's certification for this training
        $certification = \App\Models\TrainingCertification::where('training_id', $training->id)
            ->whereHas('trainingApplication', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->where('status', '1')
            ->with(['trainingApplication', 'certificate'])
            ->first();

        if (!$certification) {
            return back()->with('error', 'प्रमाणपत्र उपलब्ध छैन।');
        }

        return view('admin.Trainings.Certifications.show', compact('training', 'certification'));
    }
}
