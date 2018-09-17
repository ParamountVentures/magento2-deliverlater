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

$( document ).ready(function() {
    console.log( "ready!" );

    $( "#banktransfer" ).click(function() {
        alert( "Handler for banktransfer.click() called." );
      });
});

