<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentRequest extends Model
{
    public const STATUSES = ['pending', 'approved', 'rejected', 'released'];

    protected $table = 'document_request';

    protected $fillable = [
        'reference_number',
        'resident_id',
        'document_type',
        'assigned_to',
        'decided_by',
        'status',
        'purpose',
        'description_remarks',
        'created_at',
        'released_at',
        'updated_at',
        'requested_at',
        'decided_at',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'immutable_datetime',
            'released_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
            'requested_at' => 'immutable_datetime',
            'decided_at' => 'immutable_datetime',
        ];
    }

    public function statusHistory(): HasMany
    {
        return $this->hasMany(RequestStatusHistory::class, 'request_id')->orderBy('changed_at');
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resident_id');
    }
}
