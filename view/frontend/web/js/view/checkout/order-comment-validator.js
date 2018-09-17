define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'ParamountVentures_DeliverLater/js/model/checkout/order-comment-validator'
    ],
    function (Component, additionalValidators, commentValidator) {
        'use strict';

        additionalValidators.registerValidator(commentValidator);

        return Component.extend({});
    }
);


define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote'
    ],
    function ($, quote) {
        console.log("ok11111111");
        $('#banktransfer').on('click', function(e) {
            console.log("ok");
        });
    }
);