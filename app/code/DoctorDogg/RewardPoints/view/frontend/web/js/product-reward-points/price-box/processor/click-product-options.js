
define([
    'jquery',
    'underscore',
    'DoctorDogg_RewardPoints/js/product-reward-points/price-box/mapper/selected-option-by-configurable-product',
    'DoctorDogg_RewardPoints/js/is-local-storage-available',
    'DoctorDogg_RewardPoints/js/product-reward-points/price-box/mapper/selected-option-on-product-page'
], function ($, _, selectedOptionGetter, isLocalStorageAvailable, productPageSelectedOptionGetter) {
    'use strict';
    return {
        process: function (productId) {
            const storageKey = 'doctordogg-rewardpoints-chosen-product-attributes';
            let chosenProductAttributes = {};
            if(isLocalStorageAvailable.isLocalStorageAvailable()) {
                const localStorage = window.localStorage;
                chosenProductAttributes = JSON.parse(localStorage.getItem(storageKey));
            }

            /**
             * Here we have a list of all products and their attributes that the user has clicked on.
             */
            if(!_.isObject(chosenProductAttributes) || !chosenProductAttributes || !chosenProductAttributes[productId]) {
                throw new Error('Some error');
            }
            const attributeIdSelectedOption = chosenProductAttributes[productId];
            if(!_.isObject(attributeIdSelectedOption)) {
                throw new Error('Some error');
            }
            const configurableProductId = productId;
            for (const [attributeId, selectedOption] of Object.entries(attributeIdSelectedOption)) {
                let option = selectedOptionGetter.get(configurableProductId, attributeId, selectedOption);

                if(!option) {
                    /**
                     * Let's try to find the attributes as if we were on a product page.
                     */
                    option = productPageSelectedOptionGetter.get(configurableProductId, attributeId, selectedOption);
                    if(!option) {
                        continue;
                    }
                }
               $(option).trigger('click');
            }
        },
    };
});
