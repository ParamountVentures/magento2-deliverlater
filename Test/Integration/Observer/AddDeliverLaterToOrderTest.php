<?php
namespace ParamountVentures\DeliverLater\Test\Integration\Observer;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;
use Magento\TestFramework\Helper\Bootstrap;

/**
 * Class AddDeliverLaterToOrderTest
 * @package ParamountVentures\DeliverLater\Test\Integration\Observer
 *
 * tests if the comment gets passed from the quote to the order during order creation.
 * @magentoDbIsolation enabled
 */
class AddDeliverLaterToOrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Create order with product that has child items
     *
     * @magentoDataFixture Magento/Sales/_files/quote_with_bundle.php
     * @return void
     */
    public function testExecute()
    {
        $comment = 'test comment';

        $objectManager = Bootstrap::getObjectManager();

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $objectManager->create('\Magento\Quote\Model\Quote');
        $quote->load('test01', 'reserved_order_id');

        $quote->setData(DeliverLater::COMMENT_FIELD_NAME, $comment);
        $quote->save();
        
        /** @var \Magento\Quote\Api\CartManagementInterface $model */
        $model = $objectManager->create('\Magento\Quote\Api\CartManagementInterface');
        /** @var \Magento\Sales\Model\Order $order */
        $order = $model->submit($quote);
        
        self::assertEquals($comment, $order->getData(DeliverLater::COMMENT_FIELD_NAME));
    }
}
