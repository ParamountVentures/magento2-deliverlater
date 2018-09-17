<?php
namespace ParamountVentures\DeliverLater\Test\Unit\Model;

use Magento\Quote\Test\Unit\Model\GuestCart\GuestCartTestHelper;

class GuestDeliverLaterManagementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ParamountVentures\DeliverLater\Model\GuestDeliverLaterManagement
     */
    protected $testObject;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $quoteIdMaskFactoryMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $quoteIdMaskMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $deliverLaterManagementMock;

    /**
     * @var string
     */
    protected $maskedCartId;

    /**
     * @var int
     */
    protected $cartId;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $quoteRepositoryMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $quoteMock;
    
    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        
        $this->quoteRepositoryMock = $this->getMock('\Magento\Quote\Api\CartRepositoryInterface');

        $this->quoteMock = $this->getMock(
            '\Magento\Quote\Model\Quote',
            [
                'getItemsCount',
                'save',
                '__wakeup'
            ],
            [],
            '',
            false
        );
        
        $this->deliverLaterManagementMock = $this->getMock(
            'ParamountVentures\DeliverLater\Model\DeliverLaterManagement',
            [],
            [],
            '',
            false
        );

        $this->maskedCartId = 'f216207248d65c789b17be8545e0aa73';
        $this->cartId = 123;

        $guestCartTestHelper = new GuestCartTestHelper($this);
        list($this->quoteIdMaskFactoryMock, $this->quoteIdMaskMock) = $guestCartTestHelper->mockQuoteIdMask(
            $this->maskedCartId,
            $this->cartId
        );

        $this->testObject = $objectManager->getObject(
            'ParamountVentures\DeliverLater\Model\GuestDeliverLaterManagement',
            [
                'deliverLaterManagement' => $this->deliverLaterManagementMock,
                'quoteIdMaskFactory' => $this->quoteIdMaskFactoryMock
            ]
        );
    }

    public function testSaveComment()
    {
        $comment = 'test comment';

        $deliverLaterMock = $this->getMockBuilder('\ParamountVentures\DeliverLater\Model\Data\DeliverLater')
            ->disableOriginalConstructor()
            ->getMock();
        
        $this->deliverLaterManagementMock->expects($this->once())
            ->method('saveDeliverLater')
            ->with($this->cartId, $deliverLaterMock)
            ->willReturn($comment);
        $result = $this->testObject->saveDeliverLater($this->maskedCartId, $deliverLaterMock);
        $this->assertEquals($comment, $result);
    }
}
