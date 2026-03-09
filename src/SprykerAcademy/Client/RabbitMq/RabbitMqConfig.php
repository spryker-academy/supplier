<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\RabbitMq;

use Pyz\Client\RabbitMq\RabbitMqConfig as PyzRabbitMqConfig;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
use SprykerAcademy\Shared\SupplierStorage\SupplierStorageConfig;

class RabbitMqConfig extends PyzRabbitMqConfig
{
    /**
     * @return array<mixed>
     */
    protected function getPublishQueueConfiguration(): array
    {
        return array_merge(parent::getPublishQueueConfiguration(), [
            // TODO: Register supplier publish queues
            // Hint: Add SupplierSearchConfig::SUPPLIER_PUBLISH_SEARCH_QUEUE
            // Hint: Add SupplierStorageConfig::SUPPLIER_PUBLISH_STORAGE_QUEUE
        ]);
    }

    /**
     * @return array<mixed>
     */
    protected function getSynchronizationQueueConfiguration(): array
    {
        return array_merge(parent::getSynchronizationQueueConfiguration(), [
            // TODO: Register supplier sync queues
            // Hint: Add SupplierSearchConfig::SUPPLIER_SYNC_SEARCH_QUEUE
            // Hint: Add SupplierStorageConfig::SUPPLIER_SYNC_STORAGE_QUEUE
        ]);
    }
}
