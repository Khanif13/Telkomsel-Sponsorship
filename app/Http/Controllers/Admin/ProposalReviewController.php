<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalReviewController extends Controller
{
    // Display all proposals across the system
    public function index()
    {
        // 'with('user')' prevents the N+1 query problem, making the app much faster
        $proposals = Proposal::with('user')->latest()->paginate(15);

        return view('admin.proposals.index', compact('proposals'));
    }

    // Process the status change (Approve/Reject)
    public function updateStatus(Request $request, Proposal $proposal)
    {
        // Validate that the admin submitted a valid status
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
        ]);

        // Update the database
        $proposal->update(['status' => $validated['status']]);

        // Return to the dashboard with a success message
        return back()->with('success', 'Proposal status updated to '.ucfirst($validated['status']));
    }
}
