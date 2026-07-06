<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingApplicationRequest;
use App\Models\Training;
use App\Models\TrainingApplication;
use App\Services\SmsService;
use App\Services\TrainingApplicationService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TrainingApplicationController extends Controller
{
    use AuthorizesRequests;
    protected $trainingApplicationService;
    protected $smsService;

    public function __construct(TrainingApplicationService $trainingApplicationService, SmsService $smsService)
    {
        $this->trainingApplicationService = $trainingApplicationService;
        $this->smsService = $smsService;
    }

    public function index()
    {
        $datas = $this->trainingApplicationService->getAll();
        return view('admin.TrainingApplication.index', compact('datas'));
    }
    public function myApplications()
    {
        $datas = Auth::user()->trainingApplications()->get();
        return view('admin.TrainingApplication.index', compact('datas'));
    }

    public function create($training)
    {
        $training = Training::select('id', 'status', 'name_np', 'user_id')->find($training);
        return view('admin.TrainingApplication.form', compact('training'));
    }

    public function store(TrainingApplicationRequest $request, $id)
    {
        $validatedData = $request->validated();
        try {
            $validatedData['training_id'] = $id;
            $result = $this->trainingApplicationService->store($validatedData);
            return to_route('admin.application.edit', [$id, $result->id])->with(['success' => 'सफलता! हजुरको व्यक्तिगत विवरण सफलतापूर्वक सुरक्षित भयो ।', 'education_tab' => true]);
        } catch (\Exception $e) {
            \Log::error('TrainingApplication Store Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'समस्या आयो: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($training, TrainingApplication $application)
    {
        try {
            $this->authorize('update', $application);
            $training = Training::find($training);
            return view('admin.TrainingApplication.form', compact('training', 'application'));
        } catch (\Exception $e) {
            return back()->with('error', 'समस्या आयो, डेटा मिलेन।');
        }
    }

    public function show(Training $training, TrainingApplication $application)
    {
        try {
            $this->authorize('view', $application);
            return view('admin.TrainingApplication.show', compact('training', 'application'));
        } catch (\Exception $e) {
            \Log::error('TrainingApplication Show Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'समस्या आयो: ' . $e->getMessage());
        }
    }


    public function update(TrainingApplicationRequest $request, $training, $application)
    {
        try {
            $applicationId = $this->trainingApplicationService->find($application);
            $this->authorize('update', $applicationId);
            $result = $this->trainingApplicationService->update($request->validated(), $application);
            return redirect()
                ->route('admin.application.edit', [$training, $application])->with(['success' => 'सफलता! डेटा सफलतापूर्वक सुरक्षित भयो ।', 'education_tab' => true]);
        } catch (\Exception $e) {
            \Log::error('TrainingApplication Update Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'समस्या आयो: ' . $e->getMessage())->withInput();
        }
    }

    public function finalize(Request $request, $training, $application)
    {
        $request->validate([
            'agree_terms' => 'required|accepted'
        ], [
            'agree_terms.required' => 'कृपया सर्त र अवस्था स्वीकार गर्नुहोस्।',
            'agree_terms.accepted' => 'कृपया सर्त र अवस्था स्वीकार गर्नुहोस्।'
        ]);

        try {
            $applicationId = $this->trainingApplicationService->find($application);
            $this->authorize('update', $applicationId);
            
            // Update application status to submitted
            $applicationId->status = 'submitted';
            $applicationId->submitted_at = now();
            $applicationId->save();

            // Send notification to superadmin
            try {
                $superadmins = \App\Models\User::role('super-admin')->get();
                foreach ($superadmins as $superadmin) {
                    \App\Models\Notification::create([
                        'user_id' => $superadmin->id,
                        'type' => 'application_submitted',
                        'title' => 'नयाँ आवेदन प्राप्त',
                        'message' => $applicationId->fullname_np . ' ले आवेदन पेश गरेका छन्।',
                        'link' => route('admin.application.show', [$training, $application]),
                        'is_read' => false
                    ]);
                }
            } catch (\Exception $notificationError) {
                \Log::error('Notification Error: ' . $notificationError->getMessage());
                // Continue even if notification fails
            }

            return redirect()
                ->route('admin.application.show', [$training, $application])->with('success', 'सफलता! आवेदन सफलतापूर्वक पेश भयो ।');
        } catch (\Exception $e) {
            \Log::error('TrainingApplication Finalize Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'समस्या आयो: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, TrainingApplication $training)
    {
        $data = $request->validate([
            'status' => 'required',
            'remarks' => 'nullable'
        ]);
        try {
            $training->status = $request->status;
            $training->remarks = $request->remarks;
            if ($request->remarks && ($number = $training->mobile_no ?? $training->contact_no)) {
                $this->smsService->sendSMS($number, $request->remarks);
            }
            $training->save();
        } catch (\Exception $e) {
            return back()->with('error', 'समस्या आयो।');
        }
        return redirect()->route('admin.application.index')->with('success', 'स्थिति सफलतापूर्वक परिवर्तन भयो।');
    }

    public function destroy($id)
    {
        try {
            $result = $this->trainingApplicationService->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Data deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Failed to delete Data: '
            ], 404);
        }
    }
}
