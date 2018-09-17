<?php
namespace ParamountVentures\DeliverLater\Observer;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;

class AddDeliverLaterToOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * transfer the order comment from the quote object to the order object during the
     * sales_model_service_quote_submit_before event
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var $order \Magento\Sales\Model\Order */
        $order = $observer->getEvent()->getOrder();
        
        /** @var $quote \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        $order->setData(DeliverLater::COMMENT_FIELD_NAME, $quote->getData(DeliverLater::COMMENT_FIELD_NAME));
    }
}
