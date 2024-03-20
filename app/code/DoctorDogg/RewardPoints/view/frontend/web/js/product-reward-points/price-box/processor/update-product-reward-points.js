
define([
    'jquery',
    'underscore',
    'DoctorDogg_RewardPoints/js/product-reward-points/validator/product-title-by-price-box',
    'DoctorDogg_RewardPoints/js/product-reward-points/validator/product-title-product-page-by-price-box',
    'DoctorDogg_RewardPoints/js/product-reward-points/validator/award-points-by-price-box',
    'DoctorDogg_RewardPoints/js/product-reward-points/price-box/mapper/points-by-price-box',
    'DoctorDogg_RewardPoints/js/product-reward-points/validator/award-points-product-page-by-price-box',
    'DoctorDogg_RewardPoints/js/base/reward-points-span'
], function (
    $,
    _,
    productTitleByPriceBox,
    productTitleProductPageByPriceBox,
    awardPointsByPriceBox,
    pointsByPriceBox,
    awardPointsProductPageByPriceBox,
    baseRewardPointsSpan
) {
    'use strict';
    return {
        _event: null,

        process: function (_event, config, priceBox) {
            this._event = _event;
            const productId = _event.validatedAttr.configurableProductId;
            const allAttributeKeys = (
                config && _.isObject(config)
                && config.attributeConfig
                && _.isObject(config.attributeConfig)
                && _.isObject(config.attributeConfig[productId])
            ) ? Object.keys(config.attributeConfig[productId]) : undefined;

            /**
             * Chosen product attributes without values only keys.
             *
             * ['93', '144']
             * @type {string[]}
             */
            let chosenProductAttributeKeys = null;
            if(_.isObject(_event) && _event.chosenProductAttributes && _.isObject(_event.chosenProductAttributes[productId])) {
                chosenProductAttributeKeys = Object.keys(_event.chosenProductAttributes[productId]);
            }

            /**
             * This variable means whether all attributes of the product are selected.
             * This is necessary in order to unambiguously determine which simple product is selected
             * and we can see how many reward points are awarded to the buyer after purchasing it.
             *
             * @type {boolean}
             */
            let isProductCompleted = true;
            if(_.isObject(allAttributeKeys)) {
                allAttributeKeys.forEach(function (index, value){
                    if(!_.isObject(chosenProductAttributeKeys) || !chosenProductAttributeKeys[value]) {
                        isProductCompleted = false;
                    }
                });
            }
            if(isProductCompleted) {
                this.addUpdateRewardPointsBanner(priceBox, config);
            } else {
                if(_.isObject(config) && config.rewardPointsConfig) {
                    this.removeRewardPointsBanner(priceBox);
                }
            }
        },

        addUpdateRewardPointsBanner: function (priceBox, config) {
            const rewardPointsConfig = (_.isObject(config) && config.rewardPointsConfig) ? config.rewardPointsConfig : null;
            let pointsNumber;
            try {
                if(_.isObject(this._event) && _.isObject(this._event.chosenProductAttributes)) {
                    pointsNumber =
                        pointsByPriceBox.getPointsNumber(
                            priceBox,
                            config,
                            this._event.chosenProductAttributes
                        );
                }
            } catch (e) {
                pointsNumber = null;
            }
            if (pointsNumber === null) {
                pointsNumber = '';
            } else {
                pointsNumber = parseFloat(pointsNumber);
            }

            const pointsHtmlElement = this.removeRewardPointsBanner(priceBox, rewardPointsConfig);

             if(pointsHtmlElement) {
                const earnPointsNumber = document.createTextNode($.mage.__(pointsNumber));
                pointsHtmlElement.append(earnPointsNumber);
            } else {
                 if (pointsNumber !== '') {
                    /**
                     * The case when our element for displaying bonus points
                     * on the product card is missing and needs to be added.
                     */
                    let rewardPointsSpan = baseRewardPointsSpan.create(pointsNumber);

                    let productTitleElement = productTitleByPriceBox.get(priceBox);
                    if(!productTitleElement) {
                        /**
                        * Yeap, we are checking if we are on the product page.
                        */
                        productTitleElement = productTitleProductPageByPriceBox.get(priceBox);

                        if(productTitleElement) {
                            $(rewardPointsSpan).addClass('product-page');
                            productTitleElement.after(rewardPointsSpan);
                        }
                    } else {
                        productTitleElement.after(rewardPointsSpan);
                    }
                 }
            }
        },

        removeRewardPointsBanner: function (priceBox) {
            let pointsElement = awardPointsByPriceBox.get(priceBox);
            if(!pointsElement) {
                pointsElement = awardPointsProductPageByPriceBox.get(priceBox);
            }

            if(pointsElement) {
                /**
                 * Delete all text child nodes in case there are any.
                 */
                while (pointsElement.firstChild) {
                    pointsElement.firstChild.remove()
                }
            }

            return pointsElement;
        }
    };
});
