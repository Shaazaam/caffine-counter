const VueInstances = {
    //https://jsfiddle.net/Linusborg/3p4kpz1t/
    //https://forum.vuejs.org/t/generating-computed-properties-on-the-fly/14833/5
    mapPropertiesToComputations: (properties = [], {binding, event} = {}) => {
        return properties.reduce((object, property) => {
            object[property] = {
                get() {
                    return Functions.isNotObjectEmpty(binding) ? this[binding][property] : this[property];
                },
                set(value) {
                    Functions.isNotEmpty(event)
                        ? this.$emit(event, {property, value})
                        : this.$emit(property, value);
                },
            };
            return object;
        }, {});
    }
};
