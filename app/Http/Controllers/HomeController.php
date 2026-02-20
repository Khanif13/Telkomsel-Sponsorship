<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // 1. ADMIN & SUPER ADMIN LOGIC
        if ($user->role === 'admin' || $user->role === 'super_admin') {
            $metrics = [
                'total' => Proposal::count(),
                'pending' => Proposal::where('status', 'pending')->count(),
                'under_review' => Proposal::where('status', 'under_review')->count(),
                'need_revision' => Proposal::where('status', 'need_revision')->count(), // New
                'approved' => Proposal::where('status', 'approved')->count(),
                'rejected' => Proposal::where('status', 'rejected')->count(), // Added explicitly
            ];

            $recent_proposals = Proposal::with('user')->latest()->take(5)->get();

            return view('home', compact('metrics', 'recent_proposals'));
        }

        // 2. APPLICANT (USER) LOGIC
        $metrics = [
            'total' => $user->proposals()->count(),
            'pending' => $user->proposals()->where('status', 'pending')->count(),
            'under_review' => $user->proposals()->where('status', 'under_review')->count(),
            'need_revision' => $user->proposals()->where('status', 'need_revision')->count(), // New
            'approved' => $user->proposals()->where('status', 'approved')->count(),
            'rejected' => $user->proposals()->where('status', 'rejected')->count(),
        ];

        $recent_proposals = $user->proposals()->latest()->take(5)->get();

        return view('home', compact('metrics', 'recent_proposals'));
    }
}
