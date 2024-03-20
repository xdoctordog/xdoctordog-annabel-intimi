
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        validate: function(attr) {
            if (!attr[0]
                || !$(attr[0]).parent()
                || !$(attr[0]).parent().parent()
                || !$(attr[0]).parent().parent()[0]
                || !$(attr[0]).parent().parent().parent()
                || !$(attr[0]).parent().parent().parent()[0]
                || !$(attr[0]).parent().parent().parent().parent()
                || !$(attr[0]).parent().parent().parent().parent()[0]
                || !$($(attr[0]).parent().parent().parent().parent()[0]).find('.price-box.price-final_price')
                || !$($(attr[0]).parent().parent().parent().parent()[0]).find('.price-box.price-final_price')[0]
            ) {
                return null;
            }

            const attrGroup = $(attr[0]).parent().parent()[0];
            const attributeId = parseInt($(attrGroup).attr('data-attribute-id'), 10);
            const optionSelected = parseInt($(attrGroup).attr('data-option-selected'), 10);
            const swatchOption = $(attr[0]).parent().parent().parent()[0];
            if (!swatchOption) {
                return null;
            }

            const priceBox = $($(attr[0]).parent().parent().parent().parent()[0]).find('.price-box.price-final_price')[0];
            const configurableProductId = parseInt($(priceBox).attr('data-product-id'), 10);
            let response = {
                configurableProductId: configurableProductId,
                attributeId: attributeId,
                optionSelected: optionSelected
            };

            return response;
        }
    };
});
