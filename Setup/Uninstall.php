<?php
namespace ParamountVentures\DeliverLater\Setup;

use ParamountVentures\DeliverLater\Model\Data\DeliverLater;
use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->dropColumn(
            $setup->getTable('quote'),
            DeliverLater::COMMENT_FIELD_NAME
        );

        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order'),
            DeliverLater::COMMENT_FIELD_NAME
        );

        $setup->getConnection()->dropColumn(
            $setup->getTable('sales_order_grid'),
            DeliverLater::COMMENT_FIELD_NAME
        );

        $setup->endSetup();
    }
}
