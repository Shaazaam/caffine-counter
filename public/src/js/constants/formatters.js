const Formatters = {
    // Basic string formatting
    stringOrNoDataState: (string, state = 'N/A') => Functions.isNotEmpty(string) ? string : state,
    truncateString: (string, limit) => {
        if (string.length > limit) {
            return string.substring(0, limit - Enumerations.elipsis.length) + Enumerations.elipsis;
        }
        return string;
    },
    stripSpaces: (string) => string.toLowerCase().replace(/\s{1,}/g, ''),
    toStudlyCase: (string) => string.slice(0, 1).toUpperCase() + string.slice(1),
    toUpperCaseWords: (string) => string.toLowerCase().replace(/\b[a-z]/g, (letter) => letter.toUpperCase()),
    toCamelCase: (string) => string.replace(/(?:^\w|[A-Z]|\b\w)/g, (match, index) => 
        index === 0 ? match.toLowerCase() : match.toUpperCase()
    ).replace(/\s+/g, ''),
    camelCasedToUpperCasedWords: (string) => Formatters.toUpperCaseWords(string.replace(/([A-Z])/g, ' $&')),
    limitString: (string, limit) => {
        let sliced = string.slice(0,limit);
        if (sliced.length < string.length) {
            sliced += '...';
        }
        return sliced
    },

    // Model string formatting
    classToShort: (x) => Formatters.toCamelCase(x.substring(x.lastIndexOf('\\') + 1)),
    shortToClass: (ns) => (x) => `App\\${ns}\\` + Formatters.toStudlyCase(x),
    camelCasedModelToColloquial: (string) => Enumerations.camelCasedToColloquial[string],
    colloquialize: (modelName) => Formatters.camelCasedModelToColloquial(modelName) || Formatters.toUpperCaseWords(modelName),

    // Strings with defined formats
    currency: (integer, decimals = 2) => Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', minimumFractionDigits: decimals, maximumFractionDigits: decimals}).format(integer),
    percentage: (number) => Intl.NumberFormat('en-US', { style: 'percent', minimumFractionDigits: 2, maximumFractionDigits: 2, signDisplay: 'always' }).format(number),
    numberFormat : (number) => new Intl.NumberFormat().format(number),
    phoneToClient: (phoneNumber) => {
        switch (phoneNumber.length) {
            case 10:
                return phoneNumber.replace(/(^\d{3})(\d{3})(\d{4})/g, '($1) $2-$3');
            case 11:
                return phoneNumber.replace(/(^\d{1})(\d{3})(\d{3})(\d{4})/g, '($2) $3-$4');
            default:
                return phoneNumber;
        }
    },
    phoneToServer: (phoneNumber) => phoneNumber.replace(/\D/g, ''),

    // Strings with defined formats; dates
    // Should this all just move to Dates?
    date: (date, from, to) => {
        let m = moment(date, from);
        return m.isValid() ? m.format(to || Dates.readable.date) : null;
    },
    time: (date, from, to) => moment(date, from).format(to || Dates.readable.time),
    dateToServer: (value) => moment(value, Dates.readable.date).format(Dates.sql.date),
    dateFromServer: (value, format = Dates.readable.date) => moment(value, Dates.sql.date).format(format),
    dateTimeToServer: (value) => moment(value, Dates.readable.dateTime).utc().format(Dates.sql.dateTime),
    dateTimeFromServer: (value, format = Dates.readable.dateTime) => moment.utc(value, Dates.sql.dateTime).local().format(format),
    timeFromServer: (value) => moment.utc(value, Dates.sql.dateTime).local().format(Dates.readable.time),
    iso8601ToBase12Hours: (value) => moment(value, Dates.iso8601).format(Dates.base12),

    // Query strings
    encodeArrayAsQueryString: (key, array) => '?' + array.map((v) => encodeURIComponent(key) + '=' + encodeURIComponent(v)).join('&'),
    encodeObjectAsQueryString: (object) => '?' + new URLSearchParams(object).toString(),

    // Object formatting
    serialize: (object, mapping) => Functions.extend({}, object, mapping.serialize(object)),
    deserialize: (object, mapping) => Functions.extend({}, object, mapping.deserialize(object)),

    // Helper functions to work with Enumerations
    getIconForStatus: (status) => Enumerations.iconsByStatus[status] || Enumerations.iconsByStatus.default,
    getSolidIconForStatus: (status) => Enumerations.solidIconsByStatus[status] || Enumerations.solidIconsByStatus.default,
    getStringTerm: (term) => Enumerations.numericTermToString[term] || term + ' ' + Enumerations.numericTermToString.default,
    getBooleanString: (boolean) => Enumerations.booleanToEnglish[boolean] || Enumerations.booleanToEnglish.default,
    getPriorityText: (priority) => Enumerations.priorityToText[priority],
};
