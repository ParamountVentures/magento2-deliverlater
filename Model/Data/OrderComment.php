<?php
namespace ParamountVentures\DeliverLater\Model\Data;

use ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class DeliverLater extends AbstractSimpleObject implements DeliverLaterInterface
{
    const COMMENT_FIELD_NAME = 'paramountventures_order_comment';
    
    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(static::COMMENT_FIELD_NAME);
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(static::COMMENT_FIELD_NAME, $comment);
    }
}
