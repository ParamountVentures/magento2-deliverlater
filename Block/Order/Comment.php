<?php

namespace ParamountVentures\DeliverLater\Block\Order;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Sales\Model\Order;

class Comment extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    public function __construct(
        TemplateContext $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/comment.phtml';
        parent::__construct($context, $data);
    }

    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    public function getDeliverLater(): string
    {
        $shipping_method = $order->getShippingMethod();
        var_dump($shipping_method);
        die();
        
        if ($order->getShippingMethod() != "customshippingrate_deliverlater") return NULL;

        return trim($this->getOrder()->getData(DeliverLater::COMMENT_FIELD_NAME));
    }

    public function hasDeliverLater() : bool
    {
        return strlen($this->getDeliverLater()) > 0;
    }

    public function getDeliverLaterHtml() : string
    {
        return nl2br($this->escapeHtml($this->getDeliverLater()));
    }
}
