<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDailyVisitors() {
        // Fetch visitors with status = 1
        $dailyVisitors = Visitor::where('status', 1)->get();

        return response()->json([
            'message' => 'Daily visitors fetched successfully',
            'data' => $dailyVisitors,
        ]);
    }

    public function searchVisitors(Request $request)
    {
        // Get search criteria from the request
        $searchTerm = $request->input('searchTerm');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Query visitors based on search criteria
        $query = Visitor::query()->where('status', 1);

        if ($searchTerm) {
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                    ->orWhere('purpose_of_visit', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($startDate && $endDate) {
            $query->whereBetween('check_in_time', [$startDate, $endDate]);
        }

        $searchResults = $query->get();

        return response()->json([
            'message' => 'Search results fetched successfully',
            'data' => $searchResults,
        ]);
    }
}
