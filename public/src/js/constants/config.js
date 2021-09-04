const Config = {
    table: {
        counter: Table.build(Table.server, {
            columns: Columns.counter,
            filters: {
                sort: {
                    field: 'created_at',
                    direction: Enumerations.sortDirections.DESC,
                },
                fields: {
                    status: {
                        table: 'bills',
                        value: '',
                    },
                },
            },
        }),
    },
};
