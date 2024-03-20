
define([
    'jquery',
    'underscore'
], function ($, _) {
    'use strict';
    return {
        getPointsNumber: function (priceBox, config, chosenProductAttributes) {
            const rewardPointsConfig = config.rewardPointsConfig;
            const attributeConfig = config.attributeConfig;

            let rewardPointsValue = null;
            if(!_.isObject(rewardPointsConfig)) {
                throw new Error('Some error');
            }
            let configurableProductId = $(priceBox).attr('data-product-id');
            if(!_.isObject(attributeConfig)
                || !_.isObject(attributeConfig[configurableProductId])
                || !attributeConfig[configurableProductId]
            ) {
                throw new Error('Some error');
            }

            let productsIntersection = undefined;

            for (const [attributeId, attribute] of Object.entries(attributeConfig[configurableProductId])) {
                if(!chosenProductAttributes[configurableProductId][attributeId]) {
                    throw new Error('Attribute is not set');
                }
                let selectedOption = chosenProductAttributes[configurableProductId][attributeId];
                let products = this.getProductsBySelectedOption(selectedOption, attribute);
                if(productsIntersection === undefined) {
                    productsIntersection = products;
                } else {
                    productsIntersection = _.intersection(productsIntersection, products);
                }
            }
            if(productsIntersection.length === 1 && (productsIntersection[0])) {
                let chosenSimpleProductId = productsIntersection[0];
                if(
                    rewardPointsConfig[configurableProductId]
                    && rewardPointsConfig[configurableProductId][chosenSimpleProductId]
                ) {
                    rewardPointsValue = rewardPointsConfig[configurableProductId][chosenSimpleProductId];
                }
            } else {
                throw new Error('Product is chosen correctly');
            }
            return rewardPointsValue;
        },

        getProductsBySelectedOption: function(selectedOption, attribute) {
            let products = null;
            if(!_.isArray(attribute.options)) {
                throw new Error('Some error');
            }
            attribute.options.forEach(function(option, index){
                let id = parseInt(option.id, 10);
                if(id === selectedOption) {
                    products = option.products;
                }
            });
            return products;
        }
    };
});
