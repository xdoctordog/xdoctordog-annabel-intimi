
define([
    'jquery',
    'underscore'
], function ($, _) {
    'use strict';
    return {
        get: function(configurableProductId, attributeId, selectedOption) {
            if(
                !$('.swatch-opt-' + configurableProductId)
                || !$('.swatch-opt-' + configurableProductId)[0]
            ) {
                return undefined;
            }
            const swatchOption = $('.swatch-opt-' + configurableProductId)[0];
            if(!$(swatchOption).find(' > [data-attribute-id="' + attributeId + '"]')
                || !$(swatchOption).find(' > [data-attribute-id="' + attributeId + '"]')[0]
            ) {
                return undefined;
            }
            const divAttribute = $(swatchOption).find(' > [data-attribute-id="' + attributeId + '"]')[0];
            if(!$(divAttribute).find('[data-option-id="' + selectedOption + '"]')
                || !$(divAttribute).find('[data-option-id="' + selectedOption + '"]')[0]
            ) {
                return undefined;
            }
            const option = $(divAttribute).find('[data-option-id="' + selectedOption + '"]')[0];
            return option;
         }
    };
});
