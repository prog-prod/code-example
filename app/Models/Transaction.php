<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\DTO\Monobank\MonoStatementItemDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    
    public $fillable = [
        'amount',
        'details',
        'account_id',
        'account_type',
        'payment_id',
        'currency_name',
        'comment',
    ];

    public $casts = [
        'amount' => MoneyCast::class,
        'details' => 'json'
    ];

    public function getDetailsObjectAttribute(): ?MonoStatementItemDTO
    {
        return $this->details ? new MonoStatementItemDTO($this->details) : null;
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
