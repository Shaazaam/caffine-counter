const Storage = {
    set: (key, value) => window.localStorage.setItem(key, JSON.stringify(value)),
    get: (key) => JSON.parse(window.localStorage.getItem(key)),
    remove: (key) => window.localStorage.removeItem(key),
    isAvailable: () => {
        try {
            Storage.set('__test__', '__test__');
            Storage.remove('__test__');
            return true;
        } catch (e) {
            return e instanceof DOMException && Functions.isNotEmpty(window.localStorage) && (
                // everything except Firefox
                e.code === 22 ||
                // Firefox
                e.code === 1014 ||
                // test name field too, because code might not be present
                // everything except Firefox
                e.name === 'QuotaExceededError' ||
                // Firefox
                e.name === 'NS_ERROR_DOM_QUOTA_REACHED'
            );
        }
    },
};
