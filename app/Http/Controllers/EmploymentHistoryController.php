<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploymentHistory;
use App\Models\UserEmployment;

class EmploymentHistoryController extends Controller
{
    public function endEmployment(Request $request)
    {
        try {
            EmploymentHistory::create([
                'user_id' => auth()->user()->id,
                'job_title' => $request->input('job_title'),
                'company' => $request->input('company'),
                'industry' => $request->input('industry'),
                'date_of_employment' => $request->input('date_of_employment'),
                'salary' => $request->input('salary'),
                'location' => $request->input('location'),
            ]);

            $userEmployment = UserEmployment::where('user_id', auth()->user()->id)->first();
            if ($userEmployment) {
                $userEmployment->delete();
            }

            return response()->json(['message' => 'Employment ended successfully.']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error ending employment: ' . $e->getMessage()], 500);
            }
    }

    public function index() {
        return view('components.employment-history');
    }
}

