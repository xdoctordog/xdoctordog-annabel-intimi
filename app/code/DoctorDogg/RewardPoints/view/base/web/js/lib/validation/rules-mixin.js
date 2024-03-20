define([
    'jquery',
], function ($) {
    'use strict';

    return function (validator) {
        /**
         * For some reason, I could not add validation of float numbers.
         * It is necessary to understand why this code does not want to work.
         */
        // validator.addRule(
        //     'validate-float-numbers',
        //     function (value, params, additionalParams) {
        //         return $.mage.isEmptyNoTrim(value) || (!isNaN(parseFloat(value)) && isFinite(value));
        //     },
        //     $.mage.__("Please enter a valid int or float number.")
        // );

        return validator;
    };
});
