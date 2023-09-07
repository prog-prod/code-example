<?php

namespace App\Models;

use App\Enums\PaymentMethodsEnum;
use App\Enums\RequisitesFieldsEnum;
use App\Enums\SmsTemplateVariables;
use App\Facades\HelperServiceFacade;
use App\Models\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, TranslatableTrait, SoftDeletes;

    protected $fillable = [
        'key',
        'requisites',
        'active'
    ];

    protected $casts = [
        'requisites' => 'json'
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function smsTemplate(): BelongsTo
    {
        return $this->belongsTo(SmsTemplate::class);
    }

    public function isCash()
    {
        return $this->key === PaymentMethodsEnum::CASH->value;
    }

    public function getSMSTemplate(?Order $order = null)
    {
        $work_phone = config('app.work_phones.0');
        if (!$this->smsTemplate) {
            return '';
        }
        $template = $this->smsTemplate->template;
        $is_translited_template = HelperServiceFacade::isTranslited($template);

        foreach (RequisitesFieldsEnum::cases() as $field) {
            if (isset($this->requisites[$field->value])) {
                $value = $is_translited_template
                    ? HelperServiceFacade::translit($this->requisites[$field->value])
                    : $this->requisites[$field->value];

                $template = str_replace("{" . $field->value . "}", $value, $template);
            }
        }

        if (!is_null($order)) {
            foreach (SmsTemplateVariables::cases() as $field) {
                if ($field->value === SmsTemplateVariables::WORK_PHONE->value) {
                    $template = str_replace("{" . $field->value . "}", $work_phone, $template);
                } else {
                    if (isset($order->{$field->getOrderField()})) {
                        $value = $is_translited_template
                            ? HelperServiceFacade::translit($order->{$field->getOrderField()})
                            : $order->{$field->getOrderField()};

                        $template = str_replace(
                            "{" . $field->value . "}",
                            $value,
                            $template
                        );
                    }
                }
            }
        }

        return $template;
    }
}
