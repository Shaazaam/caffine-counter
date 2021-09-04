VueMixins.global = {
    components: {
        VueLink: {
            template: '#templateLink',
            props: {
                base: String,
                endpoint: {
                    type: String,
                    required: true,
                },
                params: {
                    type: Array,
                    default: () => ([]),
                },
            },
        },
    },
    data() {
        return {
            Dates: Dates,
            Enumerations: Enumerations,
            Factory: Factory,
            Formatters: Formatters,
            Functions: Functions,
            MetaContent: MetaContent,
            Routes: Routes,
            Store: Store,
            User: User,

            sharedState: Store.state,
        };
    },
    methods: {
        displayMessage() {
            window.scroll({top: 0, left: 0, behavior: 'smooth'});
            window.setTimeout(() => Store.clearMessage(), 5000);
        },
    },
    delimiters: ['%{', '}%'],
};
