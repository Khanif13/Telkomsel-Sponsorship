<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ADDED: Request $request parameter to catch the filters
    public function index(Request $request)
    {
        $user = Auth::user();

        // Catch the filter values from the URL
        $status = $request->status;
        $perPage = $request->input('per_page', 5); // Default to 5 items on the dashboard

        // 1. ADMIN & SUPER ADMIN LOGIC
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            $metrics = [
                'total' => Proposal::count(),
                'pending' => Proposal::where('status', 'pending')->count(),
                'under_review' => Proposal::where('status', 'under_review')->count(),
                'need_revision' => Proposal::where('status', 'need_revision')->count(),
                'approved' => Proposal::where('status', 'approved')->count(),
                'rejected' => Proposal::where('status', 'rejected')->count(),
            ];

            $query = Proposal::with('user')->latest();

            // Apply Status Filter if selected
            if ($status) {
                $query->where('status', $status);
            }

            // Paginate instead of take(5)
            $recent_proposals = $query->paginate($perPage)->withQueryString();

            return view('home', compact('metrics', 'recent_proposals'));
        }

        // 2. APPLICANT (USER) LOGIC
        $metrics = [
            'total' => $user->proposals()->count(),
            'pending' => $user->proposals()->where('status', 'pending')->count(),
            'under_review' => $user->proposals()->where('status', 'under_review')->count(),
            'need_revision' => $user->proposals()->where('status', 'need_revision')->count(),
            'approved' => $user->proposals()->where('status', 'approved')->count(),
            'rejected' => $user->proposals()->where('status', 'rejected')->count(),
        ];

        $query = $user->proposals()->latest();

        // Apply Status Filter if selected
        if ($status) {
            $query->where('status', $status);
        }

        // Paginate instead of take(5)
        $recent_proposals = $query->paginate($perPage)->withQueryString();

        return view('home', compact('metrics', 'recent_proposals'));
    }
}
