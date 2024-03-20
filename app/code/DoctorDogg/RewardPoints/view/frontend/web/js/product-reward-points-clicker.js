
define([
    'jquery',
    'underscore',
    'DoctorDogg_RewardPoints/js/product-reward-points/price-box/processor/click-product-options'
], function ($, _, clickProductOptions) {
    'use strict';

    return {
        init: function(productId) {
            try{
                clickProductOptions.process(productId);
            } catch (e) {}
        }
    };
});
