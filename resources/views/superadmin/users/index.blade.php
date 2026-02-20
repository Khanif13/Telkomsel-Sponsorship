@extends('layouts.dashboard')

@section('page_title', 'User Management')

@section('content')
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 fs-7 fw-bold text-uppercase text-muted">User</th>
                        <th class="py-3 fs-7 fw-bold text-uppercase text-muted">Current Role</th>
                        <th class="py-3 fs-7 fw-bold text-uppercase text-muted">Change Authority</th>
                        <th class="pe-4 py-3 text-end fs-7 fw-bold text-uppercase text-muted">Joined</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                                <div class="text-muted small">{{ $user->email }}</div>
                            </td>
                            <td>
                                @if ($user->role === 'super_admin')
                                    <span class="badge rounded-pill bg-dark px-3 py-2">Super Admin</span>
                                @elseif($user->role === 'admin')
                                    <span class="badge rounded-pill bg-primary px-3 py-2">Admin</span>
                                @else
                                    <span class="badge rounded-pill bg-light text-dark border px-3 py-2">User</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('superadmin.users.update-role', $user->id) }}" method="POST"
                                    class="d-flex gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" class="form-select form-select-sm rounded-pill w-auto">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>
                                            Super Admin</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-circle">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="pe-4 text-end text-muted">{{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
