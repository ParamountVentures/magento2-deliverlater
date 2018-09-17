<?php
namespace ParamountVentures\DeliverLater\Test\Integration\Model;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;
use Magento\TestFramework\Helper\Bootstrap;

/**
 * Class DeliverLaterManagementTest
 * @package ParamountVentures\DeliverLater\Test\Integration\Model
 *
 * @magentoDbIsolation enabled
 */
class DeliverLaterManagementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @magentoDataFixture Magento/Sales/_files/quote_with_bundle.php
     * @return void
     */
    public function testSaveDeliverLater()
    {
        $objectManager = Bootstrap::getObjectManager();

        $comment = 'test comment';

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $objectManager->create('\Magento\Quote\Model\Quote');
        $quote->load('test01', 'reserved_order_id');
        
        $model = $objectManager->create('\ParamountVentures\DeliverLater\Api\DeliverLaterManagementInterface');
        $data = $objectManager->create('\ParamountVentures\DeliverLater\Api\Data\DeliverLaterInterface');

        $data->setComment($comment);
        
        $model->saveDeliverLater($quote->getId(), $data);

        $quote->load('test01', 'reserved_order_id');

        self::assertEquals($comment, $quote->getData(DeliverLater::COMMENT_FIELD_NAME));
    }
}
