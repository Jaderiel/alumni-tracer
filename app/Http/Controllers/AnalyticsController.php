<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserEmployment;
use App\Helpers\Chart;


class AnalyticsController extends Controller
{
    public function index() {
        return view("auth.analytics");
    }

    public function pdfPreview() {
        $userAnalytics = $this->getUserAnalytics();
        $employmentAnalytics = $this->getUserEmploymentAnalytics();
        $alignedUsersAnalytics = $this->alignUsersToCourse();
        $businessAnalytics = $this->isOwnedBusiness();
        $salaryRange = $this->getSalaryRange();
    
        // Pass data to the Blade view
        $data = [
            'userAnalytics' => $userAnalytics,
            'employmentAnalytics' => $employmentAnalytics,
            'alignedUsersAnalytics' => $alignedUsersAnalytics,
            'businessAnalytics' => $businessAnalytics,
            'salaryRange' => $salaryRange,
        ];

        return view("components.generate-pdf", $data)->render();
    }

    public function PDFgeneration()
    {
        // Retrieve data for the PDF report
        $userAnalytics = $this->getUserAnalytics();
        $employmentAnalytics = $this->getUserEmploymentAnalytics();
        $alignedUsersAnalytics = $this->alignUsersToCourse();
        $businessAnalytics = $this->isOwnedBusiness();
        $salaryRange = $this->getSalaryRange();
        
    
        // Pass data to the Blade view
        $data = [
            'userAnalytics' => $userAnalytics,
            'employmentAnalytics' => $employmentAnalytics,
            'alignedUsersAnalytics' => $alignedUsersAnalytics,
            'businessAnalytics' => $businessAnalytics,
            'salaryRange' => $salaryRange,
        ];

        $html = view('components.generate-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'portrait');
    

        $pdf->render();

        return $pdf->stream('analytics_report.pdf');
    }

    

    public function getUserAnalytics()
    {
        // Retrieve user counts for each course, excluding users with user_type 'Admin'
        $courseCounts = User::select('course', DB::raw('COUNT(*) as user_count'))
                            ->where('user_type', '=', 'Alumni')
                            ->groupBy('course')
                            ->get();

        // Retrieve the total alumni count
        $totalAlumniCount = User::where('user_type', '=', 'Alumni')->count();

        // Add the total alumni count to the course counts data
        $labels = $courseCounts->pluck('course')->push('Total Alumni');
        $counts = $courseCounts->pluck('user_count')->push($totalAlumniCount);

        return ['labels' => $labels, 'counts' => $counts];
    }

    public function getUserEmploymentAnalytics()
{
    // Retrieve count of employed and unemployed users, excluding users with user_type 'Admin'
    $employmentCounts = UserEmployment::join('users', 'user_employment.user_id', '=', 'users.id')
                                    ->where('user_employment.is_employed', true)
                                    ->where('users.user_type', '!=', 'Admin')
                                    ->groupBy('users.id')
                                    ->selectRaw('count(*) as count')
                                    ->get();

    $employedCount = $employmentCounts->sum('count');

    $unemploymentCounts = UserEmployment::join('users', 'user_employment.user_id', '=', 'users.id')
                                    ->where('user_employment.is_employed', false)
                                    ->where('users.user_type', '!=', 'Admin')
                                    ->groupBy('users.id')
                                    ->selectRaw('count(*) as count')
                                    ->get();

    $unemployedCount = $unemploymentCounts->sum('count');

    return ['employedCount' => $employedCount, 'unemployedCount' => $unemployedCount];
}

    public function alignUsersToCourse() {
        // Retrieve count of employed and unemployed users, excluding users with user_type 'Admin'
    $alignedUsersCounts = UserEmployment::join('users', 'user_employment.user_id', '=', 'users.id')
                                    ->where('user_employment.is_aligned_to_course', true)
                                    ->where('users.user_type', '!=', 'Admin')
                                    ->groupBy('users.id')
                                    ->selectRaw('count(*) as count')
                                    ->get();

    $alignedUsersCount = $alignedUsersCounts->sum('count');

    $unalignedUsersCounts = UserEmployment::join('users', 'user_employment.user_id', '=', 'users.id')
                                    ->where('user_employment.is_aligned_to_course', false)
                                    ->where('users.user_type', '!=', 'Admin')
                                    ->groupBy('users.id')
                                    ->selectRaw('count(*) as count')
                                    ->get();

    $unalignedUsersCount = $unalignedUsersCounts->sum('count');

    return ['alignedUsersCount' => $alignedUsersCount, 'unalignedUsersCount' => $unalignedUsersCount];
    }

    public function isOwnedBusiness() {
        $ownedBusinessCounts = UserEmployment::join('users', 'user_employment.user_id', '=', 'users.id')
                                    ->where('user_employment.is_owned_business', true)
                                    ->where('users.user_type', '=', 'Alumni')
                                    ->groupBy('users.id')
                                    ->selectRaw('count(*) as count')
                                    ->get();

        $ownedBusinessCount = $ownedBusinessCounts->sum('count');

        $doNotOwnedBusinessCounts = UserEmployment::join('users', 'user_employment.user_id', '=', 'users.id')
                                    ->where('user_employment.is_owned_business', false)
                                    ->where('users.user_type', '=', 'Alumni')
                                    ->groupBy('users.id')
                                    ->selectRaw('count(*) as count')
                                    ->get();

        $doNotOwnedBusinessCount = $doNotOwnedBusinessCounts->sum('count');

        return ['ownedBusinessCount' => $ownedBusinessCount, 'doNotOwnedBusinessCount' => $doNotOwnedBusinessCount];
    }

    public function getSalaryRange(){
        // Retrieve counts of users with similar annual salaries and user_type = Alumni
        $salaryCounts = DB::table('user_employment')
                        ->join('users', 'user_employment.user_id', '=', 'users.id')
                        ->select('user_employment.annual_salary', DB::raw('COUNT(*) as user_count'))
                        ->where('users.user_type', '=', 'Alumni')
                        ->groupBy('user_employment.annual_salary')
                        ->get();
    
        return ['salaryCounts' => $salaryCounts];
    }

    public function getLocation() {
        $userLocations = DB::table('user_employment')
                            ->join('users', 'user_employment.user_id', '=', 'users.id')
                            ->where('users.user_type', 'Alumni')
                            ->pluck('user_employment.company_address');
        
        return response()->json($userLocations);
    }

    public function getAllUsers() {
        $alumniCount = DB::table('users')
                        ->where('user_type', 'Alumni')
                        ->count();
        
        return response()->json(['alumniCount' => $alumniCount]);
    }

    public function getAllDegrees() {
        $userDegrees = DB::table('degree_status')
                        ->join('users', 'degree_status.user_id', '=', 'users.id')
                        ->where('users.user_type', 'Alumni')
                        ->pluck('degree_status.degree');
        
        return response()->json($userDegrees);
    }

}
