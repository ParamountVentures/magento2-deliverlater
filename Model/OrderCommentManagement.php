<?php
namespace ParamountVentures\DeliverLater\Model;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\ValidatorException;

class DeliverLaterManagement implements \ParamountVentures\DeliverLater\Api\DeliverLaterManagementInterface
{
    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     *
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository Quote repository.
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int $cartId
     * @param \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
     * @return null|string
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveDeliverLater(
        $cartId,
        \ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface $deliverLater
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $comment = $deliverLater->getComment();

        $this->validateComment($comment);

        try {
            $quote->setData(DeliverLater::COMMENT_FIELD_NAME, strip_tags($comment));
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order comment could not be saved'));
        }

        return $comment;
    }

    /**
     * @param string $comment
     * @throws ValidatorException
     */
    protected function validateComment($comment)
    {
        $maxLength = $this->scopeConfig->getValue(DeliverLaterConfigProvider::CONFIG_MAX_LENGTH);
        if ($maxLength && (mb_strlen($comment) > $maxLength)) {
            throw new ValidatorException(__('Comment is too long'));
        }
    }
}
