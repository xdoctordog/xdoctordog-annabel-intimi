
define([
    'jquery',
    'underscore',
    'uiComponent',
    'mage/translate',
    'DoctorDogg_RewardPoints/js/base/reward-points-span',
    'DoctorDogg_RewardPoints/js/grouped-product/validator/product-title-by-simple-product-id'
], function (
    $,
    _,
    uiComponent,
    mageTranslate,
    baseRewardPointsSpan,
    productTitleBySimpleProductId
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

            for (const [groupProductId, options] of Object.entries(config.simpleProductsConfig)) {
                if(_.isObject(options)) {
                    for (const [simpleProductId, pointsNumber] of Object.entries(options)) {
                        let rewardPointsSpan = baseRewardPointsSpan.create(parseFloat(pointsNumber));

                        let productTitleElement = productTitleBySimpleProductId.get(simpleProductId);
                        if(productTitleElement) {
                            $(rewardPointsSpan).addClass('block');
                            productTitleElement.after(rewardPointsSpan);
                        }
                    };
                }
            };

            return this;
        },
    });
});
