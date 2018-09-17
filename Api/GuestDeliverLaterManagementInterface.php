<?php
namespace ParamountVentures\DeliverLater\Api;

/**
 * Interface for saving the checkout comment to the quote for guest orders
 */
interface GuestDeliverLaterManagementInterface
{
    /**
     * @param string $cartId
     * @param \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function saveDeliverLater(
        $cartId,
        \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
    );
}
