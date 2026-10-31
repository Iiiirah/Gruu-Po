<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements'; // O ang pangalan ng table sa database ninyo

    protected $fillable = [
        'title',
        'type', // <--- Siguraduhing narito para hindi ma-block
        'content',
        'image', // <--- Siguraduhing narito para hindi ma-block
        'status',
    ];
}