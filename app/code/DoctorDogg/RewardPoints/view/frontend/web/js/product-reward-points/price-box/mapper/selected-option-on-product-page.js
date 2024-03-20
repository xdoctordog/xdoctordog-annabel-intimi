
define([
    'jquery',
    'underscore'
], function ($, _) {
    'use strict';
    return {
        get: function(configurableProductId, attributeId, selectedOption) {
            if(
                !$('div.swatch-attribute[data-attribute-id="' + attributeId + '"]')
                || !$('div.swatch-attribute[data-attribute-id="' + attributeId + '"]')[0]
                || !$($('div.swatch-attribute[data-attribute-id="' + attributeId + '"]')[0]).find('.swatch-option[data-option-id="' + selectedOption + '"]')
                || !$($('div.swatch-attribute[data-attribute-id="' + attributeId + '"]')[0]).find('.swatch-option[data-option-id="' + selectedOption + '"]')[0]
            ) {
                return undefined;
            }
            const option = $($('div.swatch-attribute[data-attribute-id="' + attributeId + '"]')[0]).find('.swatch-option[data-option-id="' + selectedOption + '"]')[0];
            return option;
        }
    };
});
