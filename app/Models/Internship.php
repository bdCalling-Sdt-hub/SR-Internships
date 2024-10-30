<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'title',
        'location',
        'allowance',
        'type',
        'description',
        'status',
    ];
}
