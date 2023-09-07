<template>
    <vue-countdown
        v-if="counting"
        v-slot="{ days, hours, minutes, seconds }"
        :time="timeLeft"
        @end="onCountdownEnd">
        <div
            class="smstimer">
            <div class="smstimer__body">
                <div v-if="days > 0" class="smstimer-cell">
                    <div class="smstimer-cell__value">{{ days }}</div>
                    <div class="smstimer-cell__unit">{{ __('timer.days') }}</div>
                </div>
                <div v-if="hours > 0" class="smstimer-cell">
                    <div class="smstimer-cell__value">{{ hours }}</div>
                    <div class="smstimer-cell__unit">{{ __('timer.hours') }}</div>
                </div>
                <div class="smstimer-cell">
                    <div class="smstimer-cell__value"> {{ minutes }}</div>
                    <div class="smstimer-cell__unit">{{ __('timer.minutes') }}</div>
                </div>
                <div class="smstimer-cell">
                    <div class="smstimer-cell__value"> {{ seconds }}</div>
                    <div class="smstimer-cell__unit">{{ __('timer.seconds') }}</div>
                </div>
            </div>
        </div>
    </vue-countdown>

</template>

<script>
import VueCountdown from '@chenfengyuan/vue-countdown';

export default {
    name: 'PhoneSendSmsTimer',
    components: {
        VueCountdown,
    },
    props: {
        modelValue: {
            type: Boolean,
            required: true,
        },
        secondsTime: {
            default: 0,
            type: Number,
        },
        minutesTime: {
            default: 0,
            type: Number,
        },
        hoursTime: {
            default: 0,
            type: Number,
        },
        daysTime: {
            default: 0,
            type: Number,
        },
        monthsTime: {
            default: 0,
            type: Number,
        },
        yearsTime: {
            default: 0,
            type: Number,
        },
    },
    emits: ['update:modelValue'],
    computed: {
        counting: {
            get() {
                return this.modelValue;
            },
            set(val) {
                this.$emit('update:modelValue', val);
            },
        },
        timeLeft() {
            const millisecondsInASecond = 1000;
            const secondsInAMinute = 60;
            const minutesInAnHour = 60;
            const hoursInADay = 24;
            const daysInAMonth = 30; // This is an approximation
            const monthsInAYear = 12;

            return (
                (this.secondsTime * millisecondsInASecond) +
                (this.minutesTime * secondsInAMinute * millisecondsInASecond) +
                (this.hoursTime * minutesInAnHour * secondsInAMinute * millisecondsInASecond) +
                (this.daysTime * hoursInADay * minutesInAnHour * secondsInAMinute * millisecondsInASecond) +
                (this.monthsTime * daysInAMonth * hoursInADay * minutesInAnHour * secondsInAMinute * millisecondsInASecond) +
                (this.yearsTime * monthsInAYear * daysInAMonth * hoursInADay * minutesInAnHour * secondsInAMinute * millisecondsInASecond)
            );
        },
    },
    methods: {
        startCountdown: () => {
            this.counting = true;
        },
        onCountdownEnd() {
            this.counting = false;
        },
    },
};
</script>

<style lang="scss" scoped>
.smstimer {
    font-size: 11px;

    &__body {
        display: flex;
    }

    &-cell {
        margin: 0 3px;
        display: flex;

        &__value {
            margin-right: 2px;
        }
    }
}
</style>
