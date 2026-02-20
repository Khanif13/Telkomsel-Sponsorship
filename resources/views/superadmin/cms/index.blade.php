@extends('layouts.dashboard')

@section('page_title', 'Landing Page CMS')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white p-4 border-bottom">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-pencil-square text-danger me-2"></i> Edit Content</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('superadmin.cms.update') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            @foreach ($settings as $setting)
                                <div class="col-12">
                                    <label
                                        class="form-label fw-bold text-muted text-uppercase fs-7">{{ str_replace('_', ' ', $setting->key) }}</label>
                                    @if (strlen($setting->value) > 100)
                                        <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="3">{{ $setting->value }}</textarea>
                                    @else
                                        <input type="text" name="settings[{{ $setting->key }}]" class="form-control"
                                            value="{{ $setting->value }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger rounded-pill fw-bold px-5 shadow-sm">
                                Save Changes <i class="bi bi-save ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
