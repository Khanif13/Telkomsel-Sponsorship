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
            // Event & Contact
            'event_name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'event_date' => 'required|date|after:today',
            'event_category' => 'required|string',
            'event_scale' => 'required|string',
            'expected_participants' => 'required|integer|min:1',
            'target_audience' => 'required|string',

            // Request Type
            'request_type' => 'required|string',
            'support_description' => 'nullable|required_unless:request_type,Fresh Money Funding|string',

            // Packages
            'packages' => 'exclude_unless:request_type,Fresh Money Funding|required|array|min:1',
            'packages.*.name' => 'required_with:packages|string|max:255',
            'packages.*.price' => 'nullable|numeric|min:0',
            'packages.*.benefits' => 'required_with:packages|string',
            'packages.*.exposure' => 'required_with:packages|string',
            'packages.*.slots' => 'required_with:packages|string',

            // Summary (Reduced to 50 chars)
            'description' => 'required|string|min:50',
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
        if ($proposal->user_id !== auth()->id()) {
            abort(403);
        }

        return view('proposals.show', compact('proposal'));
    }
}
