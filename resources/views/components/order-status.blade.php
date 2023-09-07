@switch($status->value)
    @case(\App\Enums\OrderStatusEnum::PENDING->value)
        <span class="badge badge-warning">{{ $status->getLabel()}}</span>
        @break
    @case(\App\Enums\OrderStatusEnum::PENDING_PAYMENT->value)
        <span class="badge badge-warning">{{ $status->getLabel()}}</span>
        @break
    @case(\App\Enums\OrderStatusEnum::PROCESSING->value)
        <span class="badge badge-info">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\OrderStatusEnum::SHIPPED->value)
        <span class="badge badge-primary">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\OrderStatusEnum::DELIVERED->value)
        <span class="badge badge-success">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\OrderStatusEnum::DONE->value)
        <span class="badge badge-success">{{ $status->getLabel() }}</span>
        @break
    @case(\App\Enums\OrderStatusEnum::CANCELED->value)
        <span class="badge badge-danger">{{ $status->getLabel() }}</span>
        @break
@endswitch
