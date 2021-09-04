const Dates = {
    verify: (string, format = Dates.dateAndDateTimeFormats()) => {
        return Functions.isDate(string) ? moment(string, format) : null;
    },
    readable: {
        date: 'MM/DD/YYYY',
        dateTwoYear: 'MM/DD/YY',
        dateTime: 'MM/DD/YYYY h:mma',
        time: 'h:mma',
        dateTimeFull: 'LT on dddd, LL'
    },
    sql: {
        date: 'YYYY-MM-DD',
        dateTime: 'YYYY-MM-DD HH:mm:ss',
    },
    input: 'MM-YYYY',
    base12: 'h:mm A',
    iso8601: 'HH:mm',
    abbreviatedDayOfWeek: 'ddd',
    dateAndDateTimeFormats: () => ([Dates.readable.date, Dates.readable.dateTime, Dates.sql.date, Dates.sql.dateTime]),
    getStartAndEndOf: (date, scale) => ([
        moment(date, Dates.dateAndDateTimeFormats()).startOf(scale),
        moment(date, Dates.dateAndDateTimeFormats()).endOf(scale),
    ]),
};
