VueInstances.counter = {
    mixins: [
        VueMixins.fetch,
        VueMixins.errors,
    ],
    components: {
        Drink: {
            template: '#templateDrink',
            mixins: [
                VueMixins.numberInput,
                VueMixins.errors,
            ],
            props: {
                value: Object,
                index: Number,
                errors: Object,
                drinks: Array,
            },
            computed: {
                drinkId: {
                    get() {
                        return this.drink.id;
                    },
                    set(x) {
                        this.drink = this.drinks.find((drink) => drink.id == x);
                    },
                },
                drink: {
                    get() {
                        return this.value;
                    },
                    set(x) {
                        this.$emit('input', x);
                    },
                },
            },
            methods: {
                remove() {
                    this.$emit('remove-drink', this.index);
                },
            },
        },
    },
    data() {
        return {
            selectedDrinks: [],
            total: 0,
            amountLess: 0,
        };
    },
    computed: {
        canAddAnother() {
            return Functions.isEmpty(this.selectedDrinks.some((drink) => Functions.isNull(drink.id)));
        },
        isSafe() {
            return this.safeLimit > this.total;
        },
        isOverSafeLimit() {
            return this.lethalLimit > this.total > this.safeLimit;
        },
        isDead() {
            return this.total > this.lethalLimit;
        },
        isValid() {
            return Functions.isNotEmpty(this.selectedDrinks.every((drink) => Functions.isNotNull(drink.id)));
        },
    },
    methods: {
        addDrink() {
            this.selectedDrinks = this.selectedDrinks.concat([
                Factory.newModel(Factory.newDrink())
            ]);
        },
        removeDrink(index) {
            this.selectedDrinks = Functions.removeByIndex(this.selectedDrinks, index);
        },
        clear() {
            this.selectedDrinks = [];
            this.total = 0;
            this.amountLess = 0;
        },
        submit() {
            this.errors = {};
            Store.setIsSaving(true);
            // Would love for this to be GET since we're not actually changing system data
            this.post(JSON.stringify({payload: this.selectedDrinks}), Factory.newRoute(Routes.counter.calculate))
                .then((response) => {
                    if (response.errors) {
                        this.errors = this.parseErrors(response.errors);
                    } else {
                        this.total = response.total;
                        this.amountLess = response.amountLess;
                    }
                })
            ;
        },
    },
};
