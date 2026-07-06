<?php

namespace App\Http\Middleware;

use App\Models\Training;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTrainingIsUpcoming
{
  
    public function handle(Request $request, Closure $next): Response
    {
        $trainingId = $request->route('training'); 
        $training = Training::select('status')->findOrFail($trainingId);
    
        if ($training->status !== 'upcoming') {
            abort(403, 'You can only apply to upcoming trainings.');
        }
    
        return $next($request);
    }
}