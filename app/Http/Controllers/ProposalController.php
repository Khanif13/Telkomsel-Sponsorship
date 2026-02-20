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

    public function edit(Proposal $proposal)
    {
        // Security & Lockdown Checks
        if ($proposal->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($proposal->status !== 'pending') {
            return redirect()->route('proposals.index')->with('error', 'You cannot edit a proposal that is already under review.');
        }

        // Properly separate the data decoding logic here
        $packages = is_string($proposal->packages) ? json_decode($proposal->packages, true) : $proposal->packages;

        if (! is_array($packages) || empty($packages)) {
            $packages = [['name' => '', 'price' => '', 'benefits' => '', 'exposure' => '', 'slots' => '']];
        }

        // Pass the clean data to the view
        return view('proposals.edit', compact('proposal', 'packages'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        // Security & Lockdown Checks
        if ($proposal->user_id !== auth()->id() || $proposal->status !== 'pending') {
            abort(403);
        }

        $validated = $request->validate([
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
            'request_type' => 'required|string',
            'support_description' => 'nullable|required_unless:request_type,Fresh Money Funding|string',
            'packages' => 'exclude_unless:request_type,Fresh Money Funding|required|array|min:1',
            'packages.*.name' => 'required_with:packages|string|max:255',
            'packages.*.price' => 'nullable|numeric|min:0',
            'packages.*.benefits' => 'required_with:packages|string',
            'packages.*.exposure' => 'required_with:packages|string',
            'packages.*.slots' => 'required_with:packages|string',
            'description' => 'required|string|min:50',
            // File is optional on update. If empty, we keep the old one.
            'proposal_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('proposal_file')) {
            // Optionally delete the old file here if you want to save storage space
            // Storage::disk('public')->delete($proposal->proposal_file);

            $filePath = $request->file('proposal_file')->store('proposals', 'public');
            $validated['proposal_file'] = $filePath;
        }

        $proposal->update($validated);

        return redirect()->route('proposals.index')->with('success', 'Proposal updated successfully.');
    }

    public function destroy(Proposal $proposal)
    {
        // Security & Lockdown Checks
        if ($proposal->user_id !== auth()->id() || $proposal->status !== 'pending') {
            return back()->with('error', 'Cannot delete a proposal that is under review.');
        }

        // Delete the associated PDF file from storage
        if ($proposal->proposal_file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($proposal->proposal_file);
        }

        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Proposal has been permanently deleted.');
    }
}
