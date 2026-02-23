@props(['title' => 'Filter Data'])

<div
    class="card-header bg-white p-4 border-bottom d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3">
    <h5 class="fw-bold text-dark mb-0 d-none d-xl-block">{{ $title }}</h5>

    <form action="{{ url()->current() }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center m-0">
        <select name="per_page" class="form-select form-select-sm shadow-sm bg-light" onchange="this.form.submit()"
            style="width: 70px;">
            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
        </select>
        <span class="text-muted fs-7 me-2 fw-semibold">entries</span>

        <div class="input-group input-group-sm shadow-sm" style="width: 220px;">
            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search event..."
                value="{{ request('search') }}">
        </div>

        <select name="status" class="form-select form-select-sm shadow-sm bg-light" onchange="this.form.submit()"
            style="width: auto;">
            <option value="">All Statuses</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under Review
            </option>
            <option value="need_revision" {{ request('status') === 'need_revision' ? 'selected' : '' }}>Needs Revision
            </option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>

        <button type="submit" class="btn btn-sm btn-danger fw-bold shadow-sm px-3">Filter</button>
        @if (request()->has('search') || request()->has('status') || (request()->has('per_page') && request('per_page') != 10))
            <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary fw-bold shadow-sm"
                title="Clear Filters"><i class="bi bi-x-lg"></i></a>
        @endif
    </form>
</div>
