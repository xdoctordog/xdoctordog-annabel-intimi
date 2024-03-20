
define([
    'jquery',
    'underscore'
], function ($, _) {
    'use strict';

    return {
        validate: function(attr) {
            let parent = undefined;
            for(let i = 0; i <= 8; i++) {
                parent = (parent) ? $(parent).parent()[0] : (_.isObject(attr) && attr[0]) ? attr[0] : undefined;
                if(!_.isObject(parent) || !$(parent).parent() || !$(parent).parent()[0]) {
                    return null;
                }
            }

            if ( !$(parent).find('[data-role=priceBox]')
                || !$(parent).find('[data-role=priceBox]')[0]
            ) {
                return null;
            }

            const priceBox = $(parent).find('[data-role=priceBox]')[0];

            return priceBox;
        }
    };
});
