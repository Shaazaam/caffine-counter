const Factory = {
    // Maybe shift away from 'new', should be implied
    newTable: (config, params) => Functions.extend(true, {}, config, params),
    newVueInstance: (instance, params) => new (Vue.extend(instance))(params),
    //Many routes have a base prop, at this point could we include it here and remove the base portion from all Route values?
    newRoute: (endpoint, params = []) => {
        let route ='/' + endpoint;

        //Some routes have Numbers as the first parameter
        //If the first paramenter is just appending a query string, don't add the '/'
        if (Functions.isNotEmpty(params) && (!Functions.isString(params[0]) || !params[0].startsWith('?'))) {
            route = route + '/';
        }

        route = route + params.join('/');

        return route;
    },
    newModel: (model, params) => Functions.extend(true, {}, model, params),

    //Models and such
    /*
        Note: Casing represents the following:
        Snake: Maps to a database column and/or server model property
        Camel: Only used for serialization or data parsing
    */
    newDrink: () => ({
        id: null,
        name: '',
        description: '',
        serving_size: 0,
        caffeine_content: 0,
    }),
    newErrors: () => ({}),
};
