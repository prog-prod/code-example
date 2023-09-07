<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\DTO\Monobank\MonoAccountDTO;
use App\DTO\Monobank\MonoStatementItemDTO;
use App\DTO\Monobank\MonoStatementResponseDTO;
use App\Enums\CurrencyEnum;
use App\Enums\PaymentStatusEnum;
use App\Facades\CurrencyFacade;
use App\Facades\MonobankServiceFacade;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Money\Exception\MoneyMismatchException;
use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property MonoStatementResponseDTO $detailsObject
 * @property array $details
 * @property PaymentStatusEnum|mixed $status
 * @property ?PaymentMethod $paymentMethod
 */
class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'payment_method_id',
        'status',
        'order_id',
        'currency_name',
        'amount',
    ];

    protected $with = [
        'transactions'
    ];

    protected $casts = [
        'amount' => MoneyCast::class,
    ];

    public function __construct(array $attributes = [],)
    {
        parent::__construct($attributes);
    }

    /**
     * @throws RoundingNecessaryException
     * @throws MoneyMismatchException
     * @throws MathException
     * @throws UnknownCurrencyException
     * @throws NumberFormatException
     */
    public function getOverpaidAmountAttribute(): ?Money
    {
        $paidAmount = $this->paidAmount;
        if ($paidAmount && $paidAmount->getAmount()->toInt() > 0) {
            return $paidAmount->minus($this->amount);
        }

        return null;
    }

    public function getPaidExtraAmountAttribute(): ?Money
    {
        $paidAmount = $this->paidAmount;
        if ($paidAmount) {
            return $this->amount->minus($paidAmount);
        }

        return null;
    }

    /**
     * @throws RoundingNecessaryException
     * @throws MoneyMismatchException
     * @throws MathException
     * @throws UnknownCurrencyException
     * @throws NumberFormatException
     */
    public function getPaidAmountAttribute(): ?Money
    {
        $result = CurrencyFacade::moneyDecorator(0, CurrencyEnum::from($this->currency_name)->value);
        if ($this->transactions->count() > 0) {
            return $this->transactions->reduce(function (Money $carry, Transaction $transaction) {
                return $carry->plus($transaction->amount);
            }, $result);
        }
        return $result;
    }

    public function getStatementItemAttribute(): ?MonoStatementItemDTO
    {
        return $this->details ? $this->detailsObject->statementItem : null;
    }

    public function getMonoAccountAttribute(): ?MonoAccountDTO
    {
        return $this->details ? MonobankServiceFacade::findAccount($this->detailsObject->account) : null;
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function isSuccess(): bool
    {
        return in_array($this->status, [
            PaymentStatusEnum::SUCCESS->value,
            PaymentStatusEnum::OVERPAID->value
        ]);
    }

    public function isAvailableForPay(): bool
    {
        return in_array(
            $this->status,
            [
                PaymentStatusEnum::FAILED->value,
                PaymentStatusEnum::PENDING->value,
                PaymentStatusEnum::PARTIALLY_PAID->value
            ]
        );
    }

    public function canAdminConfirmPayment(): bool
    {
        return in_array($this->status, [
            PaymentStatusEnum::PENDING->value,
            PaymentStatusEnum::FAILED->value,
            PaymentStatusEnum::PARTIALLY_PAID->value
        ]);
    }
}
