import {IMaskComponent} from 'vue-imask';

const VueComponents = {
    ImaskInput: IMaskComponent,
    BaseVueTable: {
        template: '#templateTable',
        components: {
            VuePagination: {
                template: '#templatePagination',
                props: {
                    page: Number,
                    pages: Number,
                    displayedPages: Array,
                    pageInfo: Object,
                },
                methods: {
                    next() {
                        this.$emit('next');
                    },
                    previous() {
                        this.$emit('previous');
                    },
                    setPage(page) {
                        this.$emit('set-page', page);
                    },
                },
            },
        },
        props: {
            config: Object,
            identifier: [Number, String],
            isLoading: {
                type: Boolean,
                default: false,
            },
            noMargins: {
                type: Boolean,
                default: false,
            },
            layout: {
                type: String,
                default: 'standard',
            },
            wordBreak: {
                type: Boolean,
                default: true,
            },
        },
        computed: {
            displayedPages() {
                let range = [];
                let pages = [];
                let length;

                for (let i = 1; i <= this.pages; i++) {
                    if (i <= 2 || (i <= this.pages && i >= this.pages - 2) || (i >= this.page - 3 && i < this.page + 4)) {
                        range.push(i);
                    }
                }

                range.forEach((index) => {
                    if (length) {
                        if (index - length === 2) {
                            pages.push(length + 1);
                        } else if (index - length !== 1) {
                            pages.push(Enumerations.elipsis);
                        }
                    }
                    pages.push(index);
                    length = index;
                });

                return pages;
            },
            isFiltered() {
                return this.records.length > this.filteredRecords.length;
            },
            isStandard() {
                return this.layout === 'standard';
            },
            isPanel() {
                return this.layout === 'panel';
            },
            selectAll: {
                get() {
                    return this.records.length === this.selectedRecords.length;
                },
                set(checked) {
                    this.selectedRecords = checked
                        ? this.filteredRecords
                        : this.isFiltered
                            ? Functions.arrayDiff(this.selectedRecords, this.filteredRecords)
                            : [];
                },
            },
            selectAllIndeterminate() {
                return this.selectedRecords.length > 0 && !this.selectAll;
            }
        },
        methods: {
            next() {
                if (this.page + 1 > this.pages) {
                    return;
                }
                this.setPage(this.page + 1);
            },
            previous() {
                if (this.page === 1) {
                    return;
                }
                this.setPage(this.page - 1);
            },
            setPage(page) {
                if (Functions.isString(page) || page === this.page) {
                    return;
                }
                this.page = page;
            },
        },
    },
};

export default VueComponents;
