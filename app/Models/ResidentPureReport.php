<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentPureReport extends Model
{
    protected $table = 'resident_pure_incident_reports';

    protected $fillable = [
        'user_id',
        'reference_no',
        'incident_type',
        'zone',
        'incident_date',
        'description',
        'photo',
        'status',
    ];
}