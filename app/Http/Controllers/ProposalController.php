<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = auth()->user()->proposals()->latest()->paginate(10);

        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        return view('proposals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after:today',
            'event_category' => 'required|string',
            'event_scale' => 'required|string',
            'expected_participants' => 'required|integer|min:1',
            'target_audience' => 'required|string',

            'request_type' => 'required|string',
            'requested_amount' => 'nullable|required_if:request_type,Fresh Money Funding|numeric|min:0',
            'funding_breakdown' => 'nullable|required_if:request_type,Fresh Money Funding|string',
            'support_description' => 'nullable|string',

            // Packages are completely ignored UNLESS it is Fresh Money Funding
            'packages' => 'exclude_unless:request_type,Fresh Money Funding|required|array|min:1',
            'packages.*.name' => 'required_with:packages|string|max:255',
            'packages.*.price' => 'nullable|numeric|min:0',
            'packages.*.benefits' => 'required_with:packages|string',
            'packages.*.exposure' => 'required_with:packages|string',
            'packages.*.slots' => 'required_with:packages|string',

            'description' => 'required|string|min:100',
            'proposal_file' => 'required|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('proposal_file')) {
            $filePath = $request->file('proposal_file')->store('proposals', 'public');
            $validated['proposal_file'] = $filePath;
        }

        $request->user()->proposals()->create($validated);

        return redirect()->route('proposals.index')->with('success', 'Enterprise Sponsorship Proposal submitted successfully and is under review.');
    }

    public function show(Proposal $proposal)
    {
        // Ensure users can only view their own proposals (Admins will bypass this in their own controller later)
        if ($proposal->user_id !== auth()->id()) {
            abort(403);
        }

        return view('proposals.show', compact('proposal'));
    }
}
