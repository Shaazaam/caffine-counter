VueMixins.errors = {
    components: {
        ErrorSpan: {
            template: '<span :field="field" :class="classes"><strong>%{error}%</strong></span>',
            props: {
                field: String,
                errors: {
                    type: Object,
                    default: Factory.newErrors,
                },
            },
            computed: {
                classes() {
                    return {
                        'help-block': true,
                        'hidden': Functions.isNull(this.error),
                    };
                },
                error() {
                    return Functions.isNotUndefined(this.errors[this.field]) ? this.errors[this.field][0] : null;
                },
            },
        },
    },
    props: {
        errors: {
            type: Object,
            default: Factory.newErrors,
        },
    },
    computed: {
        hasErrors() {
            return !Functions.isObjectEmpty(this.errors);
        },
    },
    methods: {
        parseErrors(errors) {
            return Object.entries(errors)
                .reduce((acc, error) => Functions.extend(true, {}, acc, error[0].split('.')
                    .reduceRight((res, err) => ({[err]: res}), error[1])), 
                    Factory.newErrors()
                );
        },
        getErrors(...args) {
            return args.reduce((acc, e) => acc[e] || Factory.newErrors(), this.errors);
        },
        getErrorClass(key) {
            return this.errorClass(this.errors, key);
        },
        errorClass(errors, key) {
            if ( Functions.isObject(key) ) {
                key = Object.keys(key);
            }
            if ( ! Array.isArray(key)) {
                key = [key];
            }
            return {
                'has-error': key.some((k) => errors[k] && Functions.isNotEmpty(errors[k]))
            };
        },
    },
};