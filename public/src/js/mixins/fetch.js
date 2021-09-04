VueMixins.fetch = {
    methods: {
        // NOTE: this has to be an arrow function for Reasons.
        fetch(url, settings) {
            return fetch(url, Functions.merge(true, {
                headers: {
                    'X-CSRF-TOKEN': MetaContent.xCSRFToken(),
                    'Content-Type': 'application/json',     
                    'Accept': 'application/json, text-plain, */*',
                },
                credentials: 'same-origin',
            }, settings));
        },
        get(data, url) {
            return this.fetch(url, {method: 'GET'})
                .then((response) => {
                    this.done('Success.');
                    return response.json();
                })
                .then(this.always)
                .catch(this.fail)
            ;
        },
        post(data, url) {
            return this.fetch(url, {body: data, method: 'POST'})
                .then((response) => {
                    this.done('Success.');
                    return response.json();
                })
                .then(this.always)
                .catch(this.fail)
            ;
        },
        isValidationError(response) {
            return Functions.isObject(response)
                && response.hasOwnProperty('status')
                && response.status === 422;
        },
        done(message) {
            Store.clearError();
            Store.setMessage(message);
        },
        fail(response) {
            //premature abortion results in no responseJSON
            if (Functions.isNotUndefined(response.responseJSON)) {
                if (Functions.isNotUndefined(response.responseJSON.errors)) {
                    Store.setError(this.parseErrors(response.responseJSON.errors));
                    Store.setMessage(response.responseJSON.message || 'Invalid data. See below for further details.');
                } else {
                    Store.setError(this.parseErrors(response.responseJSON.errors));
                    Store.setMessage('Unexpected error! Your changes may not have been saved.');
                }
            }
        },
        always(response) {
            Store.clearIsSaving();
            Store.clearIsLoading();
            this.displayMessage();
            return response;
        },
    },
};
