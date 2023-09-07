<?php

namespace App\Models;

use App\Models\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    use HasFactory, TranslatableTrait;

    protected $casts = [
        'params' => 'json',
        'paramsObject' => 'object'
    ];
    protected $fillable = [
        'key',
        'params'
    ];

    public function getParamsObjectAttribute()
    {
        return json_decode($this->params);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
