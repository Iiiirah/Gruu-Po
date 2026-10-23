<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LogicException;

class RequestStatusHistory extends Model
{
    protected $table = 'request_status_history';

    public $timestamps = false;

    protected $fillable = [
        'request_id',
        'changed_by',
        'old_status',
        'new_status',
        'remarks',
        'changed_at',
    ];

    protected function casts(): array
    {
        return [
            'changed_at' => 'immutable_datetime',
        ];
    }

    protected static function booted(): void
    {
        static::updating(function (): never {
            throw new LogicException('Request status history records are immutable.');
        });

        static::deleting(function (): never {
            throw new LogicException('Request status history records cannot be deleted.');
        });
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(DocumentRequest::class, 'request_id');
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
