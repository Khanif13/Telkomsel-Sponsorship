<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalReviewController extends Controller
{
    // Menampilkan semua proposal yang masuk ke sistem
    public function index()
    {
        // Eager load 'user' untuk mencegah N+1 Query problem
        $proposals = Proposal::with('user')->latest()->paginate(15);

        return view('admin.proposals.index', compact('proposals'));
    }

    // Menampilkan detail spesifik proposal untuk direview
    public function show(Proposal $proposal)
    {
        // Load data user yang submit
        $proposal->load('user');

        return view('admin.proposals.show', compact('proposal'));
    }

    // Memproses perubahan status (Approve/Reject/Under Review)
    public function updateStatus(Request $request, Proposal $proposal)
    {
        $validated = $request->validate([
            // ADDED need_revision to the allowed list below:
            'status' => 'required|in:pending,under_review,approved,rejected,need_revision',
            'admin_note' => 'nullable|string',
        ]);

        $proposal->update([
            'status' => $validated['status'],
            'admin_note' => $validated['admin_note'],
        ]);

        return back()->with('success', 'Proposal status and feedback updated to '.strtoupper($validated['status']).'.');
    }
}
