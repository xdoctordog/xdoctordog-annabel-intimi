
define([
    'jquery',
    'underscore'
], function ($, _) {
    'use strict';

    return {
        validate: function(currentElement) {

            let parent = undefined;
            for(let i = 0; i <= 5; i++) {
                parent = (parent) ? $(parent).parent()[0] : (_.isObject(currentElement)) ? currentElement : undefined;
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

            return [priceBox];
        }
    };
});
