import VueComponents from '../constants/components';

VueMixins.table = {
    data() {
        return {
            filteredRecords: [],
        };
    },
    components: {
        VueTable: Functions.extend(true, {}, VueComponents.BaseVueTable, {
            props: {
                config: Object,
            },
            created() {
                this.$emit('get-records');
            },
            computed: {
                columns() {
                    return this.config.columns;
                },
                records() {
                    return this.config.records;
                },
                filters() {
                    return this.config.filters;
                },
                rows() {
                    return this.config.rows;
                },
                data() {
                    return this.config.data;
                },
                pages() {
                    return this.config.filters.pages;
                },
                perPage: {
                    get() {
                        return this.config.filters.perPage;
                    },
                    set(x) {
                        this.config.filters.perPage = x;
                        this.$emit('get-records');
                    },
                },
                page: {
                    get() {
                        return this.config.filters.page;
                    },
                    set(x) {
                        this.config.filters.page = x;
                        this.$emit('get-records');
                    },
                },
                shownRecords() {
                    return this.config.records;
                },
                pageInfo() {
                    return {
                        start: this.config.filters.start,
                        end: this.config.filters.end,
                        total: this.config.filters.total,
                    };
                },
            },
            methods: {
                isFieldSorted(field) {
                    return Functions.equality.strict(this.filters.sort.field, field);
                },
                isSortedAsc(field) {
                    return this.isFieldSorted(field) && Functions.equality.strict(this.filters.sort.direction, Enumerations.sortDirections.ASC);
                },
                isSortedDesc(field) {
                    return this.isFieldSorted(field) && Functions.equality.strict(this.filters.sort.direction, Enumerations.sortDirections.DESC);
                },
                setSortFilter(field) {
                    if (!this.isFieldSorted(field)) {
                        this.filters.sort = Functions.extend({}, this.filters.sort, {
                            field: field,
                            direction: Enumerations.sortDirections.ASC,
                        });
                    } else {
                        this.filters.sort = Functions.extend({}, this.filters.sort, {
                            field: field,
                            direction: this.isSortedAsc(field)
                                ? Enumerations.sortDirections.DESC
                                : Enumerations.sortDirections.ASC,
                        });
                    }

                    this.$emit('get-records');
                },
            },
        }),
    },
    methods: {
        setFilteredRecords(records) {
            this.filteredRecords = records;
        },
        getRecords() {
            // This is here beacuse some filters may rely on this method existing
            // In memory tables never use this method
        },
    },
};