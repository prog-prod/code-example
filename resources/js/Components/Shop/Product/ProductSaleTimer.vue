<template>
    <vue-countdown
        v-slot="{ days, hours, minutes, seconds }"
        :time="endSaleHours * endSaleDays * endSaleMonths * endSaleYear * 1000"
        @end="onCountdownEnd">
        <div
            v-if="counting"
            id="sale-timer" class="syotimer" :class="{'dark': dark, 'large': large}">
            <div class="syotimer__head"></div>
            <div class="syotimer__body">
                <div class="syotimer-cell syotimer-cell_type_day">
                    <div class="syotimer-cell__value">{{ days }}</div>
                    <div class="syotimer-cell__unit">{{ __('timer.days') }}</div>
                </div>
                <div class="syotimer-cell syotimer-cell_type_hour">
                    <div class="syotimer-cell__value">{{ hours }}</div>
                    <div class="syotimer-cell__unit">{{ __('timer.hours') }}</div>
                </div>
                <div class="syotimer-cell syotimer-cell_type_minute">
                    <div class="syotimer-cell__value"> {{ minutes }}</div>
                    <div class="syotimer-cell__unit">{{ __('timer.minutes') }}</div>
                </div>
                <div class="syotimer-cell syotimer-cell_type_second">
                    <div class="syotimer-cell__value"> {{ seconds }}</div>
                    <div class="syotimer-cell__unit">{{ __('timer.seconds') }}</div>
                </div>
            </div>
            <div class="syotimer__footer"></div>
        </div>
        <div v-else class="countdown-end">
            {{ __('timer.countdown_finished') }}
        </div>
    </vue-countdown>
</template>

<script>
import sale from '@/Mixins/sale';
import VueCountdown from '@chenfengyuan/vue-countdown';

export default {
    name: 'ProductSaleTimer',
    components: {
        VueCountdown,
    },
    mixins: [sale],
    props: {
        dark: {
            type: Boolean,
            default: false,
        },
        large: {
            type: Boolean,
            default: false,
        },
        product: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        counting: true,
    }),
    methods: {
        startCountdown: () => {
            this.counting = true;
        },
        onCountdownEnd: () => {
            this.counting = false;
        },
    },
};
</script>

<style scoped>
.countdown-end {
    color: #888;
    padding: 30px 0;
    font-size: 14px;
}
</style>
