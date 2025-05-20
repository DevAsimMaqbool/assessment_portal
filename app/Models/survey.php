<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class survey extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'description',
        'created_by',
        'updated_by'
    ];
}
