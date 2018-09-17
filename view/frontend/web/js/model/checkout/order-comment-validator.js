define(
    [
        'jquery',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'mage/url',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Ui/js/model/messageList',
        'mage/translate'
    ],
    function ($, customer, quote, urlBuilder, urlFormatter, errorProcessor, messageContainer, __) {
        'use strict';

        return {

            /**
             * Make an ajax PUT request to store the deliver later in the quote.
             *
             * @returns {Boolean}
             */
            validate: function () {
                var isCustomer = customer.isLoggedIn();
                var form = $('.payment-method input[name="payment[method]"]:checked').parents('.payment-method').find('form.deliver-later-form');

                // Compatibility for Rubic_CleanCheckout
                if (!form.length) {
                    form = $('form.deliver-later-form');
                }

                var comment = form.find('.input-text.order-comment').val();
                if (this.hasMaxLength() && comment.length > this.getMaxLength()) {
                    messageContainer.addErrorMessage({ message: __("Comment is too long") });
                    return false;
                }

                var quoteId = quote.getQuoteId();

                var url;
                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-deliver-later', {})
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-deliver-later', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    deliverLater: {
                        comment: comment
                    }
                };

                if (!payload.deliverLater.comment) {
                    return true;
                }

                var result = true;

                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: false
                }).done(
                    function (response) {
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            },
            hasMaxLength: function() {
                return window.checkoutConfig.max_length > 0;
            },
            getMaxLength: function () {
                return window.checkoutConfig.max_length;
            }
        };
    }
);
