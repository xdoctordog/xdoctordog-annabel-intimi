
define([
    'jquery',
    'underscore',
    'uiComponent',
    'mage/translate',
    'DoctorDogg_RewardPoints/js/product-reward-points/validator/price-boxes-validator',
    'DoctorDogg_RewardPoints/js/product-reward-points/price-box/processor/update-product-reward-points',
    'DoctorDogg_RewardPoints/js/product-reward-points/validator/price-boxes-product-page-validator'
], function (
    $,
    _,
    uiComponent,
    mageTranslate,
    priceBoxesValidator,
    updateProductRewardPoints,
    priceBoxesProductPageValidator
) {
    'use strict';

    return uiComponent.extend({
        defaults: {},
        eventClickProductAttribute: 'doctordogg_rewardpoints_click_product_attribute',

        initialize: function (config, currentElement) {
            console.log(config);
            this._super();

            let priceBoxes = priceBoxesValidator.validate(currentElement);
            if(!priceBoxes) {
                priceBoxes = priceBoxesProductPageValidator.validate(currentElement);
            }

            const processors = [
                updateProductRewardPoints
            ];

            $(priceBoxes).each(function(index, priceBox){
                priceBox.addEventListener(this.eventClickProductAttribute, (event) => {
                    processors.forEach(function(processor, i){
                        console.log(config);
                        processor.process(event, config, priceBox);
                    })
                })
            }.bind(this));

            return this;
        },
    });
});
