@extends('layouts.dashboard')
@section('page_title', 'Proposal Details')
@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('proposals.index') }}"
                    class="btn btn-outline-secondary rounded-pill fw-semibold shadow-sm"><i class="bi bi-arrow-left me-1"></i>
                    Back</a>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted fw-bold">Status:</span>
                    <x-status-badge :status="$proposal->status" class="fs-6" />
                </div>
            </div>

            @if ($proposal->admin_note)
                <div
                    class="alert alert-{{ $proposal->status === 'rejected' ? 'danger' : ($proposal->status === 'need_revision' ? 'warning' : 'info') }} rounded-4 shadow-sm mb-4 border-0 p-4">
                    <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-chat-left-text-fill me-2"></i> Note from Admin</h5>
                    <p class="mb-0 text-dark">{{ $proposal->admin_note }}</p>
                </div>
            @endif

            <x-proposal-details :proposal="$proposal" :is-admin="false" />

            <div class="d-flex justify-content-end align-items-center gap-3 mb-5">
                @if (Auth::id() === $proposal->user_id && in_array($proposal->status, ['pending', 'need_revision']))
                    <form action="{{ route('proposals.destroy', $proposal->id) }}" method="POST" class="m-0">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-lg rounded-pill px-4 fw-bold shadow-sm"
                            onclick="return confirm('Withdraw proposal? This cannot be undone.')"><i
                                class="bi bi-trash3 me-2"></i> Withdraw</button>
                    </form>
                    <a href="{{ route('proposals.edit', $proposal->id) }}"
                        class="btn btn-warning btn-lg rounded-pill px-4 fw-bold text-dark shadow-sm"><i
                            class="bi bi-pencil-square me-2"></i> Edit Proposal</a>
                @endif
                @if ($proposal->proposal_link)
                    <a href="{{ $proposal->proposal_link }}" target="_blank"
                        class="btn btn-primary btn-lg px-5 rounded-pill fw-bold shadow-lg"><i
                            class="bi bi-link-45deg me-2 fs-5"></i> Open Link</a>
                @elseif($proposal->proposal_file)
                    <a href="{{ Storage::url($proposal->proposal_file) }}" target="_blank"
                        class="btn btn-dark btn-lg px-5 rounded-pill fw-bold shadow-lg"><i
                            class="bi bi-file-earmark-pdf-fill me-2"></i> Download PDF</a>
                @endif
            </div>
        </div>
    </div>
@endsection
