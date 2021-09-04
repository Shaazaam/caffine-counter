const Functions = {
    // Comparison Functions, Equality
    equality: {
        loose: (a, b) => a == b,
        strict: (a, b) => a === b,
    },
    containsAll: (a, b) => b.every((item) => a.includes(item)),
    sameMembers: (a, b) => Functions.containsAll(a, b) && Functions.containsAll(b, a),
    isEquivalent: (a, b) => {
        let x = Functions.isArray(a) ? a : Object.keys(a);
        let y = Functions.isArray(b) ? b : Object.keys(b);

        if (!Functions.equality.strict(x.length, y.length)) {
            return false;
        }

        return x.every((prop) => {
            if ((Functions.isNotNull(a[prop]) && Functions.isObject(a[prop])) && (Functions.isNotNull(b[prop]) && Functions.isObject(b[prop]))) {
                return Functions.isEquivalent(a[prop], b[prop]);
            }
            return Functions.equality.strict(a[prop], b[prop]);
        });
    },
    isNotEquivalent: (a, b) => !Functions.isEquivalent(a, b),

    // Comparison Functions, Type Checking
    isType: (x, type) => Functions.equality.strict(typeof x, type),
    isNumber: (x) => Functions.isType(x, 'number'),
    isNotNumber: (x) => !Functions.isNumber(x),
    isString: (x) => Functions.isType(x, 'string'),
    isBoolean: (x) => Functions.isType(x, 'boolean'),
    isSymbol: (x) => Functions.isType(x, 'symbol'),
    isUndefined: (x) => Functions.isType(x, 'undefined'),
    isNotUndefined: (x) => !Functions.isUndefined(x),
    isObject: (x) => Functions.isType(x, 'object'),
    isFunction: (x) => Functions.isType(x, 'function'),
    isArray: (x) => Array.isArray(x),
    isEmpty: (x) => Functions.isNotNumber(x) && (!x || Functions.equality.strict(x.length, 0)),
    isNotEmpty: (x) => !Functions.isEmpty(x),
    isObjectEmpty: (x) => Functions.equality.strict(Object.entries(x).length, 0),
    isNotObjectEmpty: (x) => !Functions.isObjectEmpty(x),
    isNull: (x) => Functions.equality.strict(x, null),
    isNotNull: (x) => !Functions.isNull(x),
    isNaN: (x = Number(x)) => x !== x,
    isNotNaN: (x) => !Functions.isNaN(x),

    isPhoneNumber: (string) => Functions.isNotNull(string.match(/^(\d{1}[\.\-\s]|)(\(\d{3}\)|\d{3})([\.\-\s]|)\d{3}[\.\-\s]\d{4}$/g)),
    isDate: (string) => Functions.isNotNaN(Date.parse(string)) && Functions.isNotNull(string.match(/^\d{2,4}([-/])\d{2}\1\d{2,4}(\s\d{2}(:)\d{2}(\3)?([ap]m|\d{2}))?$/g)),
    isEmail: (string) => Functions.isNotNull(
        string.match(/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/g)
    ),

    // Array Functions
    /** Return a new array that contains only the elements in a1 that are not in a2 */
    arrayDiff: (a1, a2) => a1.filter((n) => !a2.includes(n)),
    arrayClone: (items) => items.map(item => Functions.isArray(item) 
        ? Functions.arrayClone(item) 
        : Functions.isObject(item)
            ? Functions.extend(true, {}, item)
            : item,
    ),
    findById: (id, item) => Functions.equality.loose(id, item.id),
    findKeyByValue: (item, value) => Object.keys(item).find((key) => Functions.equality.loose(value, item[key])),
    updateByIndex: (array, index, value) => {
        const ret = array.slice(0);
        ret[index] = Object.assign(ret[index], value);
        return ret;
    },
    removeByIndex: (array, index) => array.filter((_, i) => i != index),
    removeById: (array, id) => array.filter((item) => item.id != id),
    removeByValue: (array, value) => array.filter((item) => item !== value),
    indexArray: (array, item, comparison) => {
        let index = array.findIndex((value) => comparison(value, item)) + 1;
        return array[index === array.length ? 0 : index];
    },
    groupBy: (array, criteria) => {
        return array.reduce((object, item) => {
            const key = Functions.isFunction(criteria) ? criteria(item) : item[criteria];
            if (Functions.isUndefined(object[key])) {
                object[key] = [];
            }

            object[key] = object[key].concat(item);
            return object;
        }, {});
    },
    sortString: (a, b) => (a.toUpperCase() > b.toUpperCase() ? 1 : a.toUpperCase() < b.toUpperCase() ? -1 : 0),
    sortDate: (a, b) => a.diff(b),
    sortNumber: (a, b) => a - b,
    sortDates: (a, b) => Functions.isNull(b) - Functions.isNull(a) || Functions.sortDate(moment(a), moment(b)),
    sortStringsWithNulls: (a, b) => Functions.isNull(a) - Functions.isNull(b) || +(a > b) || -(a < b),
    //this will coerce, but expects: [number|string-like-number, ...number|string-like-number]
    sum: (array) => array.reduce((sum, item) => sum + Number(item), 0),

    // Object Functions
    intersect: (initial, compare) => {
        const [initialKeys, compareKeys] = [Object.keys(initial), Object.keys(compare)];
        const [first, next] = initialKeys.length > compareKeys.length ? [compareKeys, initial] : [initialKeys, compare];
        return first.filter((key) => key in next);
    },
    // "Simple" refers to non-nested properties
    invertSimpleObject: (object) => {
        let ret = {};
        for (let property in object) {
            ret[object[property]] = property;
        }
        return ret;
    },
    diffSimpleEquivalentObjects: (left, right) => Object.keys(left).filter((key) => left[key] !== right[key]),
    merge: (deep, object, extended) => {
        for (var propery in object) {
            extended[propery] = deep && Functions.isObject(object[propery]) && Functions.isNotNull(object[propery]) && !Functions.isArray(object[propery])
                ? Functions.extend(true, extended[propery], object[propery])
                : object[propery];
        }

        return extended;
    },
    extend: (...parameters) => {
        let extended = {};
        let deep = false;
        let i = 0;

        if (Functions.isBoolean(parameters[0])) {
            deep = parameters[0];
            i++;
        }

        for (i; i < parameters.length; i++) {
            extended = Functions.merge(deep, parameters[i], extended);
        }

        return extended;
    },
    findObjectPropertyByArrayValue: (object, value) => {
        let found = undefined;
        for (let property in object) {
            if (Functions.isArray(object[property]) && object[property].includes(value)) {
                return property;
            }
        }
        return found;
    },
    
    // Utilities
    characterRange: (start, end) => [...Array(end.charCodeAt(0) - start.charCodeAt(0) + 1).keys()].map((i) => String.fromCharCode(start.charCodeAt(0) + i)),
    numericRange: (start, end, step = 1) => [...Array(Math.ceil((end - start + 1) / step)).keys()].map((i) => (i + 1) * step),

    // These should either not exist or not be under Functions
    convertToDollars: (c) => c / 100,
    convertToCents: (d) => d * 100,
    
    serialize: (x) => JSON.stringify(x),
    unserialize: (x) => Functions.isNotEmpty(x) ? JSON.parse(x) : [],
    pluralize: (val, word, plural = word + 's') => {
        const _pluralize = (num, word, plural = word + 's') =>
            [1, -1].includes(Number(num)) ? word : plural;
        if (typeof val === 'object') return (num, word) => _pluralize(num, word, val[word]);
        return _pluralize(val, word, plural);
    },
    dateTimeStringFromServerToObject: (value) => moment.utc(value, Dates.sql.dateTime).local(),
};
