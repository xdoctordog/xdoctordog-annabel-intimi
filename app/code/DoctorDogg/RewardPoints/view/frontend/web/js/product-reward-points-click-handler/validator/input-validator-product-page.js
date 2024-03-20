
define([
    'jquery'
], function ($) {
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

            if ( !$(parent).find('.price-box.price-final_price')
                || !$(parent).find('.price-box.price-final_price')[0]
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

            const priceBox = $(parent).find('.price-box.price-final_price')[0];
            const configurableProductId = parseInt($(priceBox).attr('data-product-id'), 10);

            const response = {
                configurableProductId: configurableProductId,
                attributeId: attributeId,
                optionSelected: optionSelected
            };

            return response;
        }
    };
});
