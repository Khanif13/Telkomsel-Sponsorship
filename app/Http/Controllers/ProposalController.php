<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = auth()->user()->proposals()->latest();

        // 1. Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('event_name', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%");
            });
        }

        // 2. Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Dynamic Pagination (Default to 10)
        $perPage = $request->input('per_page', 10);

        $proposals = $query->paginate($perPage)->withQueryString();

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

            // Summary
            'description' => 'required|string|min:50',
            'proposal_file' => 'required|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('proposal_file')) {
            $filePath = $request->file('proposal_file')->store('proposals', 'public');
            $validated['proposal_file'] = $filePath;
        }

        $request->user()->proposals()->create($validated);

        return redirect()->route('proposals.index')->with('success', 'Enterprise Sponsorship Proposal submitted successfully.');
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
        // Security Check: Only the owner can edit
        if ($proposal->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // UPDATED: Lockdown Rule - Allow editing if status is 'pending' OR 'need_revision'
        if (! in_array($proposal->status, ['pending', 'need_revision'])) {
            return redirect()->route('proposals.index')->with('error', 'You cannot edit a proposal that is already under review or approved.');
        }

        // Properly separate the data decoding logic here
        $packages = is_string($proposal->packages) ? json_decode($proposal->packages, true) : $proposal->packages;

        if (! is_array($packages) || empty($packages)) {
            $packages = [['name' => '', 'price' => '', 'benefits' => '', 'exposure' => '', 'slots' => '']];
        }

        return view('proposals.edit', compact('proposal', 'packages'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        // Security & Lockdown Checks
        if ($proposal->user_id !== auth()->id() || ! in_array($proposal->status, ['pending', 'need_revision'])) {
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
            'proposal_file' => 'nullable|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('proposal_file')) {
            // Delete old file to save space
            if ($proposal->proposal_file) {
                Storage::disk('public')->delete($proposal->proposal_file);
            }
            $filePath = $request->file('proposal_file')->store('proposals', 'public');
            $validated['proposal_file'] = $filePath;
        }

        // RESET STATUS TO PENDING: Moves the proposal back into the admin queue
        $validated['status'] = 'pending';

        $proposal->update($validated);

        return redirect()->route('proposals.index')->with('success', 'Proposal updated and resubmitted for review.');
    }

    public function destroy(Proposal $proposal)
    {
        // UPDATED Security & Lockdown Checks: Only delete if pending or needs revision
        if ($proposal->user_id !== auth()->id() || ! in_array($proposal->status, ['pending', 'need_revision'])) {
            return back()->with('error', 'Cannot withdraw a proposal that is already under review.');
        }

        if ($proposal->proposal_file) {
            Storage::disk('public')->delete($proposal->proposal_file);
        }

        $proposal->delete();

        return redirect()->route('proposals.index')->with('success', 'Proposal has been permanently withdrawn.');
    }
}
