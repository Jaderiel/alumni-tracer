<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserEmployment;

class AnalyticsController extends Controller
{
    public function index() {
        return view("auth.analytics");
    }

    public function getUserAnalytics()
    {
        // Retrieve user counts for each course, excluding users with user_type 'Admin'
        $courseCounts = User::select('course', DB::raw('COUNT(*) as user_count'))
                            ->where('user_type', '!=', 'Admin')
                            ->groupBy('course')
                            ->get();

        // Retrieve the total alumni count
        $totalAlumniCount = User::where('user_type', '!=', 'Admin')->count();

        // Add the total alumni count to the course counts data
        $labels = $courseCounts->pluck('course')->push('Total Alumni');
        $counts = $courseCounts->pluck('user_count')->push($totalAlumniCount);

        return response()->json(['labels' => $labels, 'counts' => $counts]);
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

    return response()->json(['employedCount' => $employedCount, 'unemployedCount' => $unemployedCount]);
}

}
