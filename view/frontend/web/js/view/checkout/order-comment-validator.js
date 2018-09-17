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


require([
    'jquery',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-service',
    'Magento_Checkout/js/model/shipping-rate-registry',
    'Magento_Checkout/js/model/shipping-rate-processor/customer-address',
    'Magento_Checkout/js/model/shipping-rate-processor/new-address',
], function($, quote, shippingService, rateRegistry, customerAddressProcessor, newAddressProcessor) {
    $('#banktransfer').on('click', function(e) {
        var address = quote.shippingAddress();
        console.log(address);

        // reload address information
        address.trigger_reload = new Date().getTime();

        // clearing cached rates to retrieve new ones
        rateRegistry.set(address.getCacheKey(), null);

        console.log(quote.shippingAddress()); // but getting old one 
        var type = quote.shippingAddress().getType();
        if (type) {
            customerAddressProcessor.getRates(address);
        } else {
            newAddressProcessor.getRates(address);
        }
    });
});