define([
    'jquery',
    'ko',
    // 'Magento_Ui/js/form/element/text'
    'Magento_Ui/js/form/element/abstract',
    '../evol-colorpicker'
], function (jquery, ko, abstractField, evolColorpicker) {
    'use strict';
    return abstractField.extend({
        defaults: {
            value: 10
            // ,imports: {//@todo: it works!
            //     value: '${$.provider}:data.product.name'
            // }
            // ,exports: {//@todo: it works!
            //     value: '${$.provider}:data.product.name'
            // },
            // ,links: {//@todo: it works also!
            //     value: '${$.provider}:data.product.name'
            // }
            // ,"listens": {//@todo: it works!
            //     "${ $.provider }:data.product.name": "productNameChanged"
            // }
        },
        /** @inheritdoc */
        initialize: function () {
            this._super();
            this.addEvolColorpickerBinding();
            return this;
        },

        productNameChanged: function (name) {
            console.log(name);
        },

        addEvolColorpickerBinding: function () {
            ko.bindingHandlers.evolcolorpicker = {
                init: function (element, valueAccessor) {
                    jquery(element).colorpicker({defaultPalette: "web"});
                },
                update: function (element, valueAccessor) {}
            };
        }
    });
});
