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


require(["jquery"], function($) {
    jQuery(document).ready(function(){
        console.log('xxxxxxxxxxxxxxxxxxxxx');
        //jQuery('body').on('click', '.table-checkout-shipping-method input[type="radio"]', function(){
           // var code = 'your_custom_shipping_method_code';
            // you can check your custom shipping method code using inspect element
            // you can see the code in the value of input type radio

            //if(jQuery(this).val() == code){
            //    jQuery('.custom-shipping-method-message').show();
            //} else {
            //    jQuery('.custom-shipping-method-message').hide();
            //}
        //});
    });
});