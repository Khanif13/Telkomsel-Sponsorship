@props(['status'])

@php
    $badges = [
        'pending' => ['bg' => 'bg-warning text-dark', 'text' => 'Pending', 'icon' => ''],
        'under_review' => ['bg' => 'bg-info', 'text' => 'Under Review', 'icon' => ''],
        'need_revision' => [
            'bg' => 'bg-dark text-white',
            'text' => 'Needs Revision',
            'icon' => 'bi-exclamation-circle me-1',
        ],
        'approved' => ['bg' => 'bg-success', 'text' => 'Approved', 'icon' => ''],
        'rejected' => ['bg' => 'bg-danger', 'text' => 'Rejected', 'icon' => ''],
    ];
    $current = $badges[$status] ?? ['bg' => 'bg-secondary', 'text' => ucfirst($status), 'icon' => ''];
@endphp

<span {{ $attributes->merge(['class' => 'badge px-3 py-2 rounded-pill shadow-sm ' . $current['bg']]) }}>
    @if ($current['icon'])
        <i class="bi {{ $current['icon'] }}"></i>
    @endif
    {{ $current['text'] }}
</span>
