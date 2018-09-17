<?php
namespace ParamountVentures\DeliverLater\Plugin\Block\Adminhtml;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;

class SalesOrderViewInfo
{
    /**
     * @param \Magento\Sales\Block\Adminhtml\Order\View\Info $subject
     * @param string $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterToHtml(
        \Magento\Sales\Block\Adminhtml\Order\View\Info $subject,
        $result
    ) {
        $commentBlock = $subject->getLayout()->getBlock('order_comments');
        if ($commentBlock !== false && $subject->getNameInLayout() == 'order_info') {
            $commentBlock->setDeliverLater($subject->getOrder()->getData(DeliverLater::COMMENT_FIELD_NAME));
            $result = $result . $commentBlock->toHtml();
        }
        
        return $result;
    }
}
