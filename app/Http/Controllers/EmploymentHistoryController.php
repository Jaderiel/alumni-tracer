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

        $user = auth()->user();
        $employmentHistories = EmploymentHistory::where('user_id', $user->id)->get();

        return view('components.employment-history', compact('employmentHistories'));
    }

    public function destroy($id)
    {
        $employmentHistory = EmploymentHistory::findOrFail($id);

        // Check if the authenticated user owns this employment history record
        if ($employmentHistory->user_id == auth()->user()->id) {
            $employmentHistory->delete();
            return response()->json(['message' => 'Employment history deleted successfully.']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function addPastEmployment() {
        return view('components.add-past-employment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'date_of_employment' => 'required|date',
            'salary' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $employmentHistory = new EmploymentHistory();
        $employmentHistory->user_id = auth()->user()->id;
        $employmentHistory->job_title = $request->job_title;
        $employmentHistory->company = $request->company;
        $employmentHistory->industry = $request->industry;
        $employmentHistory->date_of_employment = $request->date_of_employment;
        $employmentHistory->salary = $request->salary;
        $employmentHistory->location = $request->location;
        $employmentHistory->save();

        return response()->json(['message' => 'Employment history added successfully.']);
    }
}

