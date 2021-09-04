const MetaContent = {
    getTagContentByName: (name) => {
        let tag = document.querySelector('meta[name="' + name + '"]');
        return Functions.isNull(tag) ? tag : tag.getAttribute('content');
    },
    xCSRFToken: () => MetaContent.getTagContentByName('csrf-token'),
    user: () => {
        let user = MetaContent.getTagContentByName('user');
        //can't use Factory here, also solves errors from being thrown in login, since User exists and is trying to deserialize a user object
        return Functions.isNotNull(user) ? JSON.parse(user) : {
            id: null,
        };
    },
};
