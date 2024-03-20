
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        create: function(pointsNumber) {
            let rewardPointsSpan = document.createElement('span');
            rewardPointsSpan.className = 'doctordogg-reward-points';
            let coinsSmallDiv = document.createElement('div');
            coinsSmallDiv.className = 'coins-small';
            let productSpanDiv = document.createElement('span');
            productSpanDiv.className = 'product-span';

            const earnPointsTextBefore = document.createTextNode($.mage.__('Earn') + ' ');
            const earnPointsNumber = document.createTextNode($.mage.__(pointsNumber));
            const earnPointsTextAfter = document.createTextNode(' ' + $.mage.__('points buying this'));
            productSpanDiv.appendChild(earnPointsTextBefore);

            let pointsSpan = document.createElement('span');
            pointsSpan.className = 'points';
            pointsSpan.appendChild(earnPointsNumber);

            productSpanDiv.appendChild(pointsSpan);
            productSpanDiv.appendChild(earnPointsTextAfter);

            rewardPointsSpan.appendChild(coinsSmallDiv);
            rewardPointsSpan.appendChild(productSpanDiv);

            return rewardPointsSpan;
        }
    };
});
