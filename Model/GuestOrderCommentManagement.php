<?php
namespace ParamountVentures\DeliverLater\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestDeliverLaterManagement implements \ParamountVentures\DeliverLater\Api\GuestDeliverLaterManagementInterface
{

    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var \ParamountVentures\DeliverLater\Api\DeliverLaterManagementInterface
     */
    protected $deliverLaterManagement;
    
    /**
     * GuestDeliverLaterManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \ParamountVentures\DeliverLater\Api\DeliverLaterManagementInterface $deliverLaterManagement
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        \ParamountVentures\DeliverLater\Api\DeliverLaterManagementInterface $deliverLaterManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->deliverLaterManagement = $deliverLaterManagement;
    }

    /**
     * {@inheritDoc}
     */
    public function saveDeliverLater(
        $cartId,
        \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->deliverLaterManagement->saveDeliverLater($quoteIdMask->getQuoteId(), $deliverLater);
    }
}
