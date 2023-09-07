<template>
    <div
        class="nice-select" :class="{disabled}" tabindex="0">
        <template v-if="!model">
            <input type="text" :disabled="disabled" class="placeholder-input" :placeholder="placeholder" readonly>
        </template>
        <slot name="selectedOption" :option="model">
            <div class="selectedOption" :class="{ noOverflowHidden: !textOverflow }">{{ selectedOption }}</div>
        </slot>
        <ul class="list">
            <template v-for="(c, key) in options" :key="key">
                <li :data-value="c" class="option" @click="changeOption(c)">
                    <slot name="option" :option="c">
                        {{ c[label] || c[value] || c }}
                    </slot>
                </li>
            </template>
        </ul>
    </div>
</template>

<script>


export default {
    name: 'Dropdown',
    props: {
        options: Array,
        textOverflow: {
            type: Boolean,
            default: true,
        },
        placeholder: {
            type: String,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        label: {
            default: 'label',
            type: String,
        },
        value: {
            default: 'value',
            type: String,
        },
        modelValue: Object | String | Number,
    },
    emits: ['update:modelValue', 'change'],
    computed: {
        model: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
        selectedOption() {
            return this.isOptionsArrayOfObjects && this.model ? this.model[this.label] : null;
        },
        isOptionsArrayOfObjects() {
            return this.options.length > 0 ? typeof this.options[0] === 'object' : false;
        },
    },
    mounted() {
        if (typeof window !== 'undefined') {
            import('jquery-nice-select/js/jquery.nice-select.js').then(() => {
                $('select').niceSelect();
            });
        }
    },
    methods: {
        changeOption(option) {
            this.model = option;
            this.$emit('change', option);
        },
    },
};
</script>

<style lang="scss" scoped>
.noOverflowHidden {
    overflow: unset;
}

.placeholder-input {
    border: none;
    max-width: 100%;
    width: 100%;
}
</style>
