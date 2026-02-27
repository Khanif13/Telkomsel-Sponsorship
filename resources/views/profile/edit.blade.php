@extends('layouts.dashboard')
@section('page_title', 'Account Settings')

@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-md-8">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-person-gear text-danger me-2"></i> Profile
                        Information</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted fs-7">Full Name / Organization</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted fs-7">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">@</span>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}" required>
                            </div>
                            <div class="form-text fs-7">You can use this to login instead of your email.</div>
                            @error('username')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted fs-7">Email Address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted fs-7">Telkomsel Number</label>
                                <input type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number', $user->phone_number) }}" required>
                                @error('phone_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger rounded-pill fw-bold px-5 shadow-sm">Save
                                Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            @if (session('success_password'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4"
                    role="alert">
                    <i class="bi bi-shield-check me-2"></i> {{ session('success_password') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-shield-lock text-danger me-2"></i> Update Password
                    </h5>
                    <p class="text-muted fs-7 mt-2 mb-0">Ensure your account is using a long, random password to stay
                        secure.</p>
                </div>
                <div class="card-body p-4 pt-0">
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-muted fs-7">Current Password</label>
                            <div class="position-relative d-flex align-items-center">
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror" required
                                    placeholder="Enter current password">
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback d-block fs-7">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted fs-7">New Password</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required
                                        placeholder="Min. 8 characters">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block fs-7">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted fs-7">Confirm New Password</label>
                                <div class="position-relative d-flex align-items-center">
                                    <input type="password" name="password_confirmation" class="form-control" required
                                        placeholder="Repeat new password">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark rounded-pill fw-bold px-5 shadow-sm">Change
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
