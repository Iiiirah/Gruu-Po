<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Idagdag ang mga ito para payagan ang mass assignment
    protected $fillable = [
        'key',
        'value',
    ];
}