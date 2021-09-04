Serializers.paginatedTable = {
    serialize: (paginatedTable) => ({
        columns: Serializers.paginatedTable.columns(paginatedTable),
        perPage: paginatedTable.filters.perPage,
        page: paginatedTable.filters.page,
        sortField: paginatedTable.filters.sort.field,
        sortDirection: paginatedTable.filters.sort.direction,
        filters: Serializers.paginatedTable.filters(paginatedTable),
    }),
    deserialize: (paginatedTable) => ({
        total: paginatedTable.total,
        pages: paginatedTable.last_page,
        start: paginatedTable.from,
        end: paginatedTable.to,
        page: paginatedTable.current_page,
    }),
    columns: (paginatedTable) => Functions.isNotNull(paginatedTable.filters.search) && Functions.isNotEmpty(paginatedTable.filters.search.trim())
        ? paginatedTable.columns.reduce((accumulator, current) => Functions.extend({}, accumulator, {[current]: paginatedTable.filters.search.trim()}), {})
        : {},
    filters: (paginatedTable) => Object.keys(paginatedTable.filters.fields).reduce((accumulator, current) => {
        //We kinda screwed up the definition of "isNotEmpty", really should be string only
        //Otherwise cases like this happen, were we want null values, but not empty strings
        if (Functions.isNull(paginatedTable.filters.fields[current].value) || Functions.isNotEmpty(paginatedTable.filters.fields[current].value)) {
            accumulator = Functions.extend({}, accumulator, {
                //Do this for now, but filters -should- be moved to always using a column property
                //This outlines the difference between frontend filter and SQL filtering
                [Functions.isNotUndefined(paginatedTable.filters.fields[current].column)
                    ? paginatedTable.filters.fields[current].table + '.' + paginatedTable.filters.fields[current].column
                    : paginatedTable.filters.fields[current].table + '.' + current
                ]: paginatedTable.filters.fields[current].value,
            });
        }
        return accumulator;
    }, {}),
};
