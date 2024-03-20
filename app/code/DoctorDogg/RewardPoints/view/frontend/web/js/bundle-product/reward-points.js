/**
 * Let's try to search for items by id with product id (price-including-tax-34 or price-excluding-tax-34).
 */
define([
    'jquery',
    'underscore',
    'uiComponent',
    'mage/translate',
    'DoctorDogg_RewardPoints/js/base/reward-points-span'
], function (
    $,
    _,
    uiComponent,
    mageTranslate,
    baseRewardPointsSpan
) {
    'use strict';

    return uiComponent.extend({
        defaults: {},

        initialize: function (config, currentElement) {
            console.log(config);
            this._super();

            if(!_.isObject(config)
                || !_.isObject(config.simpleProductsConfig)
            ) {
                return;
            }

            for (const [productId, productOptions] of Object.entries(config.simpleProductsConfig)) {
                if(!_.isObject(productOptions)
                    || !productOptions.rewardPoints
                ) {
                    continue;
                }

                let isFoundCurrentProduct = false;
                let rewardPointsSpan = baseRewardPointsSpan.create(parseFloat(productOptions.rewardPoints));
                $(rewardPointsSpan).addClass('doctordogg-reward-block');

                $('#price-excluding-tax-' + productId).each(function(i, element){
                    if($(element).parent()
                        && $(element).parent().parent()
                        && $(element).parent().parent().parent()
                        && $(element).parent().parent().parent().find(' > .product-name')
                        && $(element).parent().parent().parent().find(' > .product-name')[0]
                    ) {
                        const productNameElement = $(element).parent().parent().parent().find(' > .product-name')[0];
                        productNameElement.after(rewardPointsSpan);
                        isFoundCurrentProduct = true;
                    }
                });

                /**
                 * Perhaps the page does not display prices in the format included/excluded taxes.
                 * Let's try to find products by name. A crooked decision, but I have no other for you.
                 * A miracle solution from Dzmitry Morozov.
                 */
                if(!isFoundCurrentProduct && productOptions.productName) {
                    $('span.product-name').each(function(i, productNameElement){

                        if(productNameElement.innerHTML.includes(productOptions.productName)) {
                            /**
                             * Yes, yes, yes, if you add two products with a similar name,
                             * then a collision will happen. But I warned you that I don't have
                             * a better solution for you.
                             */

                            productNameElement.after(rewardPointsSpan);
                        }
                    });
                }
            }

            return this;
        },
    });
});
