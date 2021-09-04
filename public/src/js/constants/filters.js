const Filters = {
    primitive: (property, value, item) => Functions.equality.loose(item[property], value),
    null: (property, value, item) => Functions.equality.strict(Filters.primitive(property, null, item), value),
    dateInMonth: (property, value, item) => Formatters.date(item[property], [Dates.readable.dateTime, Dates.readable.date], Dates.input) === value,
    dateInRange: (property, value, item) => {
        let date = moment(item[property]);
        if (Functions.isUndefined(value[0])) {
            return date.isBefore(value[1]);
        }
        if (Functions.isUndefined(value[1])) {
            return date.isAfter(value[0]);
        }
        return date.isBetween(...value)
    },
    object: (property, value, item) => Functions.containsAll(item[property], value),
    inclusion: (property, values, item) => values.includes(item[property]),
    contains: (property, value, item) => item[property].includes(value),
};
