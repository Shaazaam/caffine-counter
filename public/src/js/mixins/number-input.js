import VueComponents from '../constants/components';

VueMixins.numberInput = {
    components: {
        NumberInput: {
            template: '#templateNumberInput',
            components: {
                imaskInput: VueComponents.ImaskInput,
            },
            props: {
                value: {
                    type: Number,
                    required: true,
                },
                integers: Number,
                precision: {
                    type: Number,
                    default: 2,
                },
                minimumValue: {
                    type: Number,
                    default: 0,
                },
                signed: {
                    type: Boolean,
                    default: true,
                },
            },
            computed: {
                input: {
                    get() {
                        return this.value;
                    },
                    set(x) {
                        this.$emit('input', x);
                    },
                },
                min() {
                    return this.signed ? Number(''.padStart(this.integers, '9')) * -1 : this.minimumValue;
                },
                max() {
                    return Number(''.padStart(this.integers, '9'));
                },
            },
            methods: {
                prepare(value) {
                    return value.toString();
                },
            },
        },
    },
};