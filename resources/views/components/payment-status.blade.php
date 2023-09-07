@switch($status->value)
    @case(\App\Enums\PaymentStatusEnum::PENDING->value)
        <span class="badge badge-secondary">{{ $status->getLabel()}}</span>
        @break
    @case(\App\Enums\PaymentStatusEnum::SUCCESS->value)
        <span class="badge badge-success">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\PaymentStatusEnum::FAILED->value)
        <span class="badge badge-danger">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\PaymentStatusEnum::CANCELED->value)
        <span class="badge badge-danger">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\PaymentStatusEnum::PARTIALLY_PAID->value)
        <span class="badge badge-warning">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\PaymentStatusEnum::PARTIALLY_PAID->value)
        <span class="badge badge-warning">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\PaymentStatusEnum::OVERPAID->value)
        <span class="badge badge-warning">{{ $status->getLabel() }}</span>
        @break
@endswitch
