
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        get: function(productId) {

            if(
                !$('.price-box.price-final_price[data-product-id="' + productId + '"]')
                || !$('.price-box.price-final_price[data-product-id="' + productId + '"]')[0]
            ) {
                return undefined;
            }

            let priceBox = $('.price-box.price-final_price[data-product-id="' + productId + '"]')[0];
            if(
                !$(priceBox).parent()
                || !$(priceBox).parent()[0]
                || !$($(priceBox).parent()[0]).find('strong.product-item-name')
                || !$($(priceBox).parent()[0]).find('strong.product-item-name')[0]
            ) {
                return undefined;
            }
            const productItemNameHtmlElement = $($(priceBox).parent()[0]).find('strong.product-item-name')[0];

            return productItemNameHtmlElement;
        }
    };
});
