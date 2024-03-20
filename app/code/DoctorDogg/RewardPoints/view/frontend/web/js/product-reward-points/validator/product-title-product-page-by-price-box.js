
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        get: function(priceBox) {
            let parent = undefined;
            for(let i = 0; i <= 2; i++) {
                parent = (parent) ? $(parent).parent()[0] : (_.isObject(priceBox)) ? priceBox : undefined;
                if(!_.isObject(parent) || !$(parent).parent() || !$(parent).parent()[0]) {
                    return null;
                }
            }

            if ( !$(parent).find('.page-title-wrapper.product')
                || !$(parent).find('.page-title-wrapper.product')[0]
            ) {
                return null;
            }
            const productTitleElement = $(parent).find('.page-title-wrapper.product')[0];

            return productTitleElement;
        }
    };
});
