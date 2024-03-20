
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        validate: function(attr) {
            if (!attr
                || !$(attr).parent()
                || !$(attr).parent()[0]
                || !$($(attr).parent()[0]).find('[data-role="priceBox"]')
                || !$($(attr).parent()[0]).find('[data-role="priceBox"]')[0]
            ) {
                return null;
            }
            const priceBoxes = $($(attr).parent()[0]).find('[data-role="priceBox"]');

            return priceBoxes;
        }
    };
});
