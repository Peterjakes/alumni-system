<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AlumniController extends Controller
{
    public function index()
    {
        return view('alumni.dashboard');
    }

    public function directory(Request $request)
    {
        $query = User::where('role', 'alumni');

        // Search by name
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        // Filter by graduation year
        if ($request->filled('graduation_year')) {
            $query->where('graduation_year', $request->get('graduation_year'));
        }

        $alumni = $query->orderBy('first_name')->paginate(12);
        
        // Get unique graduation years for filter dropdown
        $graduationYears = User::where('role', 'alumni')
            ->whereNotNull('graduation_year')
            ->distinct()
            ->orderBy('graduation_year', 'desc')
            ->pluck('graduation_year');

        return view('alumni.directory', compact('alumni', 'graduationYears'));
    }
}
