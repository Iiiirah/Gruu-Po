<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentDocumentRequest extends Model
{
    use HasFactory;

    // ITAMA NATIN DITO ANG TUNAY NA TABLE SA PHPCOURT/PHPMYADMIN:
    protected $table = 'document_requests';

    protected $fillable = [
        'reference_no',
        'resident_name',
        'document_type',
        'purpose',
        'status',
    ];
}