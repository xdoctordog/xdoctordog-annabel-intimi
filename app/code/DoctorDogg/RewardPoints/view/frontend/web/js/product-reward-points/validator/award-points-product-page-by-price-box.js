
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

            if ( !$(parent).find('.doctordogg-reward-points > .product-span > .points')
                || !$(parent).find('.doctordogg-reward-points > .product-span > .points')[0]
            ) {
                return null;
            }

            const awardPointsElement = $(parent).find('.doctordogg-reward-points > .product-span > .points')[0];

            return awardPointsElement;
        }
    };
});
