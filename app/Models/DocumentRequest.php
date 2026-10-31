<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    // Tiyaking nakaturo ito sa tamang table na ginagamit din ng resident
    protected $table = 'document_requests';

    protected $fillable = [
        'user_id',
        'resident_name',
        'document_type',
        'purpose',
        'status',
    ];

    // Relationship para makuha ang pangalan ng resident (e.g. Maria Juana, Juan Dela Cruz)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}