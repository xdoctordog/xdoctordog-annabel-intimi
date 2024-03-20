
define([
    'jquery',
    'jquery-ui-modules/widget',
    'DoctorDogg_RewardPoints/js/product-reward-points-click-handler',
    'DoctorDogg_RewardPoints/js/product-reward-points-clicker'
], function ($, widget, clickHandler, clicker) {
    'use strict';

    return function (SwatchRenderer) {
        $.widget('mage.SwatchRenderer', SwatchRenderer, {
            /**
             * Wrapper for the click handler.
             * The place where we can connect to.
             *
             * @param $this
             * @param widget
             * @private
             */
            _OnClick: function ($this, widget) {
                this._super($this, widget);
                clickHandler.processClick($this);
            },
            _init: function () {
                this._super();
                /**
                 * Hack for category view page.
                 */
                const productData = this._determineProductData();
                if(productData.productId) {
                    clicker.init(productData.productId);
                }
            }
        });

        return $.mage.SwatchRenderer;
    };
});
