<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneCodesLog extends Model
{
    protected $fillable = [
        'phone',
        'ip',
        'location',
        'code'
    ];
}
