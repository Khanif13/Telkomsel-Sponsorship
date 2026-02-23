@extends('layouts.dashboard')

@section('page_title', 'Submit Sponsorship Proposal')

@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-lg-10">

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm rounded-3 mb-4">
                    <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Please correct the
                        following errors:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data" id="proposalForm">
                @csrf

                @include('proposals.partials.form.event-contact')

                @include('proposals.partials.form.request-details')

                @include('proposals.partials.form.document-upload')

                <div class="d-flex justify-content-end align-items-center mt-3 mb-5">
                    <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill fw-bold shadow-sm">
                        Submit Proposal <i class="bi bi-send-fill ms-2"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
