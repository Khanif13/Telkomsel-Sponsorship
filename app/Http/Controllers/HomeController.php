<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * Ensure only authenticated users can access the dashboard.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. ADMIN DASHBOARD LOGIC
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            $metrics = [
                'total' => Proposal::count(),
                'pending' => Proposal::where('status', 'pending')->count(),
                'under_review' => Proposal::where('status', 'under_review')->count(),
                'approved' => Proposal::where('status', 'approved')->count(),
            ];

            // Fetch the 5 most recently submitted proposals across the whole system
            $recent_proposals = Proposal::with('user')->latest()->take(5)->get();

            return view('home', compact('metrics', 'recent_proposals'));
        }

        // 2. APPLICANT (USER) DASHBOARD LOGIC
        $metrics = [
            'total' => $user->proposals()->count(),
            'pending' => $user->proposals()->whereIn('status', ['pending', 'under_review'])->count(),
            'approved' => $user->proposals()->where('status', 'approved')->count(),
            'rejected' => $user->proposals()->where('status', 'rejected')->count(),
        ];

        // Fetch the user's 5 most recent submissions
        $recent_proposals = $user->proposals()->latest()->take(5)->get();

        return view('home', compact('metrics', 'recent_proposals'));
    }
}
