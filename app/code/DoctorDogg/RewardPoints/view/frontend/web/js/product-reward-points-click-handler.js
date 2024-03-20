
define([
    'jquery',
    'underscore',
    'DoctorDogg_RewardPoints/js/product-reward-points-click-handler/validator/input-validator',
    'DoctorDogg_RewardPoints/js/product-reward-points-click-handler/validator/price-box-validator',
    'DoctorDogg_RewardPoints/js/is-local-storage-available',
    'DoctorDogg_RewardPoints/js/product-reward-points-click-handler/validator/input-validator-product-page',
    'DoctorDogg_RewardPoints/js/product-reward-points-click-handler/validator/price-box-product-page-validator'
], function (
    $,
    _,
    inputValidator,
    priceBoxValidator,
    isLocalStorageAvailable,
    inputValidatorProductPage,
    priceBoxProductPageValidator
) {
    'use strict';

    return {
        chosenProductAttributes: {},
        eventClickProductAttribute: 'doctordogg_rewardpoints_click_product_attribute',
        storageKey: 'doctordogg-rewardpoints-chosen-product-attributes',

        prepareClickedOption: function(chosenProductAttributes, validatedAttr) {
            if(!chosenProductAttributes) {
                chosenProductAttributes = {};
            }
            if(!chosenProductAttributes[validatedAttr.configurableProductId]) {
                chosenProductAttributes[validatedAttr.configurableProductId] = {};
            }
            if(validatedAttr.optionSelected) {
                chosenProductAttributes[validatedAttr.configurableProductId][validatedAttr.attributeId] = validatedAttr.optionSelected;
            } else {
                delete chosenProductAttributes[validatedAttr.configurableProductId][validatedAttr.attributeId];
            }

            return chosenProductAttributes;
        },

        processClick: function(swatchRendererObject) {
            /**
             * We will get data about which product the click occurred for,
             * on which attribute and which option was selected.
             */
            let validatedAttr = inputValidator.validate(swatchRendererObject);
            if(!validatedAttr) {
                /**
                 * Since Magento does not offer options to determine which page the js is working on
                 * and does not even use different scripts, so you have to write code
                 * that will work on the category page and also on the product page.
                 */

                /**
                 * Perhaps we are already on the product page.
                 */
                validatedAttr = inputValidatorProductPage.validate(swatchRendererObject);

                if(!validatedAttr) {
                    /**
                     * No. I don't think we're on a product page.
                     */
                    return;
                }
            }

            let chosenProductAttributes = this.chosenProductAttributes;
            let isStorageAvailable = isLocalStorageAvailable.isLocalStorageAvailable();

            /**
             * If local storage is available then we can use its value instead of what is in memory in a variable.
             */
            let localStorage = null;
            if(isStorageAvailable) {
                localStorage = window.localStorage;
                chosenProductAttributes = JSON.parse(localStorage.getItem(this.storageKey));
            }

            chosenProductAttributes = this.prepareClickedOption(chosenProductAttributes, validatedAttr);

            if(isStorageAvailable) {
                localStorage.setItem(this.storageKey, JSON.stringify(chosenProductAttributes));
            }

            let priceBox = priceBoxValidator.validate(swatchRendererObject);

            if (!priceBox) {
                /**
                 * Perhaps we are already on the product page.
                 */
                priceBox = priceBoxProductPageValidator.validate(swatchRendererObject);
            }

            if(priceBox) {
                let event = new Event(this.eventClickProductAttribute);
                event.chosenProductAttributes = chosenProductAttributes;
                event.validatedAttr = validatedAttr;
                priceBox.dispatchEvent(event);
            }
        }
    };
});
