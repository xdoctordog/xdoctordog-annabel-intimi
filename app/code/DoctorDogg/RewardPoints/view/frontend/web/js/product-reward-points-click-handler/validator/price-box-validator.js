
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        validate: function(attr) {
            if (!attr[0]
                || !$(attr[0]).parent()
                || !$(attr[0]).parent().parent()
                || !$(attr[0]).parent().parent().parent()
                || !$(attr[0]).parent().parent().parent()[0]
                || !$($(attr).parent().parent().parent().parent()[0])
                || !$($(attr).parent().parent().parent().parent()[0]).find('[data-role=priceBox]')
                || !$($(attr).parent().parent().parent().parent()[0]).find('[data-role=priceBox]')[0]
            ) {
                return null;
            }
            const priceBox = $($(attr).parent().parent().parent().parent()[0]).find('[data-role="priceBox"]')[0];

            return priceBox;
        }
    };
});
