<?php

/**
 * Copyright © Icreative Technologies. All rights reserved.
 *
 * @author : Icreative Technologies
 * @package : Ict_Orderdelete
 * @copyright : Copyright © Icreative Technologies (https://www.icreativetechnologies.com/)
 */

namespace Ict\Orderdelete\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const INVOICE_TABLE = 'sales_invoice_grid';
    public const SHIPMENT_TABLE = 'sales_shipment_grid';
    public const CREDITMEMO_TABLE = 'sales_creditmemo_grid';
    public const INVENTORY_TABLE = 'inventory_reservation';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Sales\Model\ResourceModel\OrderFactory
     */
    protected $orderResourceFactory;

    /**
     * @var \Magento\InventoryReservationCli\Model\ResourceModel\GetReservationsListFactory
     */
    protected $collection;

    /**
     * @param \Magento\Framework\App\ResourceConnection
     */
    protected $connection;

    /**
     * @param Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param Magento\Sales\Model\ResourceModel\OrderFactory $orderResourceFactory
     * @param Magento\InventoryReservationCli\Model\ResourceModel\GetReservationsListFactory $collection
     * @param Magento\Framework\App\ResourceConnection $connection
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Sales\Model\ResourceModel\OrderFactory $orderResourceFactory,
        \Magento\InventoryReservationCli\Model\ResourceModel\GetReservationsListFactory $collection,
        \Magento\Framework\App\ResourceConnection $connection
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->orderResourceFactory = $orderResourceFactory;
        $this->collection = $collection;
        $this->connection = $connection;
    }

    /**
     * Get config Value
     *
     * @return mix
     */
    public function getConfig($configPath)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Delete record from database table
     */
    public function deleteRecord($orderId)
    {
        $resource = $this->orderResourceFactory->create();
        $connection = $resource->getConnection();

        /** delete invoice grid record via resource model */
        $connection->delete(
            $resource->getTable(self::INVOICE_TABLE),
            $connection->quoteInto('order_id = ?', $orderId)
        );

        /** delete shipment grid record via resource model */
        $connection->delete(
            $resource->getTable(self::SHIPMENT_TABLE),
            $connection->quoteInto('order_id = ?', $orderId)
        );

        /** delete creditmemo grid record via resource model */
        $connection->delete(
            $resource->getTable(self::CREDITMEMO_TABLE),
            $connection->quoteInto('order_id = ?', $orderId)
        );
    }

    /**
     * Delete record from database table
     */
    public function deleteReservationInventory($id, $incrementId)
    {
        $collection = $this->collection->create()->execute();
        $adapter = $this->connection->getConnection();
        $table = $this->connection->getTableName(self::INVENTORY_TABLE);
        foreach ($collection as $value) {
            $metaData = json_decode($value['metadata'], 1);
            $adapter->delete(
                $table,
                $adapter->quoteInto(
                    'metadata LIKE ?',
                    '%"object_increment_id":"' . $incrementId . '"%'
                )
            );
            $adapter->delete(
                $table,
                $adapter->quoteInto(
                    'metadata LIKE ?',
                    '%"object_id":"' . $id . '"%'
                )
            );
        }
    }
}
