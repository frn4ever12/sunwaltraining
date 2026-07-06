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
}
