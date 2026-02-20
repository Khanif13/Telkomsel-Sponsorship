<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_name',
        'organizer',
        'contact_name',
        'contact_email',
        'contact_phone',
        'event_category',
        'event_scale',
        'event_date',
        'location',
        'expected_participants',
        'target_audience',
        'description',
        'request_type',
        'support_description',
        'packages',
        'proposal_file',
        'status',
        'admin_note',
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
