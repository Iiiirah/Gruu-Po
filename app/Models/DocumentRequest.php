<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $table = 'document_request';

    protected $guarded = [];

    // Define the valid statuses expected by DocumentRequestStatusService
    public const STATUSES = [
        'pending',
        'processing',
        'approved',
        'rejected',
        'completed',
    ];
}