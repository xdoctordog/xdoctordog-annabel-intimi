
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        get: function(priceBox) {
            if (!priceBox
                || !$(priceBox).parent()
                || !$(priceBox).parent()[0]
                || !$($(priceBox).parent()[0]).find('.doctordogg-reward-points > .product-span > .points')
                || !$($(priceBox).parent()[0]).find('.doctordogg-reward-points > .product-span > .points')[0]
            ) {
                return null;
            }
            const awardPointsElement = $($(priceBox).parent()[0]).find('.doctordogg-reward-points > .product-span > .points')[0];

            return awardPointsElement;
        }
    };
});
