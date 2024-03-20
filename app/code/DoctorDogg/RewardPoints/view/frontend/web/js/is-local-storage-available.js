
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        isLocalStorageAvailable: function() {
            var key = '_storageSupported';
            try {
                const localStorage = window.localStorage;
                localStorage.setItem(key, 'true');
                if (localStorage.getItem(key) === 'true') {
                    localStorage.removeItem(key);
                    return true;
                }
                return false;
            } catch (e) {
                return false;
            }
        }
    };
});
