const Store = {
    set: (key, value) => Store.state[key] = value,

    state: {
        message: '',
        error: '',
        isSaving: false,
        isLoading: false,
    },

    setMessage: (value) => Store.set('message', value),
    clearMessage: () => Store.set('message', ''),

    setError: (value) => Store.set('error', value),
    clearError: () => Store.set('error', ''),

    setIsSaving: (value) => Store.set('isSaving', value),
    clearIsSaving: () => Store.set('isSaving', false),

    setIsLoading: (value) => Store.set('isLoading', value),
    clearIsLoading: () => Store.set('isLoading', false),
};
