<?php
namespace ParamountVentures\DeliverLater\Api;

/**
 * Interface for saving the checkout comment to the quote for orders of logged in users
 * @api
 */
interface DeliverLaterManagementInterface
{
    /**
     * @param int $cartId
     * @param \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
     * @return string
     */
    public function saveDeliverLater(
        $cartId,
        \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
    );
}
