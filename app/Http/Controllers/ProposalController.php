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
            // ... (validasi event_name sampai packages sama seperti sebelumnya) ...

            // Summary Opsional
            'description' => 'nullable|string',
            // Wajib isi salah satu: File atau Link
            'proposal_file' => 'required_without:proposal_link|mimes:pdf|max:10240',
            'proposal_link' => 'required_without:proposal_file|nullable|url',
        ]);

        $data = $validated;

        if ($request->hasFile('proposal_file')) {
            $data['proposal_file'] = $request->file('proposal_file')->store('proposals', 'public');
            $data['proposal_link'] = null;
        } elseif ($request->filled('proposal_link')) {
            $data['proposal_file'] = null;
        }

        // Simpan langsung pakai relasi user agar tidak error user_id
        $request->user()->proposals()->create($data);

        return redirect()->route('proposals.index')->with('success', 'Proposal submitted successfully.');
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
        // 1. Authorization Check
        if ($proposal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Validation
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'event_category' => 'required|string',
            'event_scale' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'expected_participants' => 'required|integer|min:1',
            'target_audience' => 'required|string',
            'request_type' => 'required|string',
            'support_description' => 'nullable|string',
            'packages' => 'nullable|array',
            'description' => 'nullable|string', // Optional Executive Summary

            // Allow both to be nullable during update. If user uploads a new one, handle it.
            'proposal_file' => 'nullable|mimes:pdf|max:10240',
            'proposal_link' => 'nullable|url',
        ]);

        $data = $validated;

        // 3. Handle Document Updates
        if ($request->hasFile('proposal_file')) {
            // Delete old file if exists
            if ($proposal->proposal_file) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($proposal->proposal_file);
            }
            $data['proposal_file'] = $request->file('proposal_file')->store('proposals', 'public');
            $data['proposal_link'] = null; // Clear link if new file uploaded
        } elseif ($request->filled('proposal_link')) {
            // Delete old file if exists since they are switching to a link
            if ($proposal->proposal_file) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($proposal->proposal_file);
            }
            $data['proposal_file'] = null; // Clear file path
            $data['proposal_link'] = $request->proposal_link;
        } else {
            // If neither is provided in the request, keep the existing ones
            // Remove them from the $data array so they don't overwrite with null
            unset($data['proposal_file']);
            unset($data['proposal_link']);
        }

        // 4. Handle JSON Packages
        if ($request->request_type === 'Fresh Money Funding' && isset($validated['packages'])) {
            $data['packages'] = json_encode($validated['packages']);
        } else {
            $data['packages'] = null;
        }

        // 5. Update Record
        $proposal->update($data);

        return redirect()->route('proposals.index')->with('success', 'Proposal updated successfully.');
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
