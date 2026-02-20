<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'organizer',
        'location',
        'event_date',
        'event_category',
        'event_scale',
        'expected_participants',
        'target_audience',
        'request_type',
        'requested_amount',
        'funding_breakdown',
        'support_description',
        'packages',
        'description',
        'proposal_file',
        'status',
    ];

    protected $casts = [
        'packages' => 'array',
        'event_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
