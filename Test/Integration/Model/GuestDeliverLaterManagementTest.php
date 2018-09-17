<?php
namespace ParamountVentures\DeliverLater\Test\Integration\Model;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;
use Magento\TestFramework\Helper\Bootstrap;

/**
 * Class GuestDeliverLaterManagementTest
 * @package ParamountVentures\DeliverLater\Test\Integration\Model
 *
 * @magentoDbIsolation enabled
 */
class GuestDeliverLaterManagementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @magentoDataFixture Magento/Sales/_files/quote_with_bundle.php
     * @return void
     */
    public function testGuestSaveDeliverLater()
    {
        $objectManager = Bootstrap::getObjectManager();

        $comment = 'test comment guest';

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $objectManager->create('\Magento\Quote\Model\Quote');
        $quote->load('test01', 'reserved_order_id');

        /** @var \Magento\Quote\Model\QuoteIdMask $quoteMask */
        $quoteMask = $objectManager->create('\Magento\Quote\Model\QuoteIdMask');
        $quoteMask->load($quote->getId(), 'quote_id');
        
        $model = $objectManager->create('\ParamountVentures\DeliverLater\Api\GuestDeliverLaterManagementInterface');

        $data = $objectManager->create('\ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface');

        $data->setComment($comment);

        $model->saveDeliverLater($quoteMask->getMaskedId(), $data);

        $quote->load('test01', 'reserved_order_id');

        self::assertEquals($comment, $quote->getData(DeliverLater::COMMENT_FIELD_NAME));
    }
}
