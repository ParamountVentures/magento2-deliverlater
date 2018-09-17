<?php
namespace ParamountVentures\DeliverLater\Api\Data;

interface DeliverLaterInterface
{
    /**
     * @return string|null
     */
    public function getComment();

    /**
     * @param string $comment
     * @return null
     */
    public function setComment($comment);
}
