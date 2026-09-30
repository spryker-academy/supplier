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
            SupplierSearchConfig::SUPPLIER_PUBLISH_SEARCH_QUEUE,
            SupplierStorageConfig::SUPPLIER_PUBLISH_STORAGE_QUEUE,
        ]);
    }

    /**
     * @return array<mixed>
     */
    protected function getSynchronizationQueueConfiguration(): array
    {
        return array_merge(parent::getSynchronizationQueueConfiguration(), [
            SupplierSearchConfig::SUPPLIER_SYNC_SEARCH_QUEUE,
            SupplierStorageConfig::SUPPLIER_SYNC_STORAGE_QUEUE,
        ]);
    }
}
