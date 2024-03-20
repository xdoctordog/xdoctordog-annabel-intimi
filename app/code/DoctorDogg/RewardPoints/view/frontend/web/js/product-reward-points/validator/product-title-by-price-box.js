
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        get: function(priceBox) {
            if (!priceBox
                || !$(priceBox).parent()
                || !$(priceBox).parent()[0]
                || !$($(priceBox).parent()[0]).find('strong.product-item-name')
                || !$($(priceBox).parent()[0]).find('strong.product-item-name')[0]
            ) {
                return null;
            }
            const productTitleElement = $($(priceBox).parent()[0]).find('strong.product-item-name')[0];

            return productTitleElement;
        }
    };
});
