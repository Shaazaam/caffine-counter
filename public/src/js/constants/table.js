const Table = {
    base: {
        columns: {
            shown: {},
            search: [],
        },
        filters: {
            search: null,
            perPage: 10,
            sort: {},
            fields: {},
        },
        records: [],
        rows: {},
    },
    server: {
        filters: {
            page: 1,
            start: 1,
            end: 1,
            total: 0,
            pages: 1,
        },
    },
    build: (type, params) => Functions.extend(true, {}, Table.base, type, params),
};
