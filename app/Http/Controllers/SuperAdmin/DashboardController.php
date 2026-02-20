<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Setting;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Gather big-picture metrics for the Command Center
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_proposals' => Proposal::count(),
            'pending_reviews' => Proposal::where('status', 'pending')->count(),
            'active_cms' => Setting::count(),
        ];

        // Only fetch the 5 absolute newest users for a "Recent Activity" list
        $recent_users = User::latest()->take(5)->get();

        return view('superadmin.dashboard', compact('stats', 'recent_users'));
    }
}
