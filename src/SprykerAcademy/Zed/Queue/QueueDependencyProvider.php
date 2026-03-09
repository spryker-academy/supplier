<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\Queue;

use Pyz\Zed\Queue\QueueDependencyProvider as PyzQueueDependencyProvider;
use Spryker\Zed\Event\Communication\Plugin\Queue\EventQueueMessageProcessorPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Synchronization\Communication\Plugin\Queue\SynchronizationSearchQueueMessageProcessorPlugin;
use Spryker\Zed\Synchronization\Communication\Plugin\Queue\SynchronizationStorageQueueMessageProcessorPlugin;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
use SprykerAcademy\Shared\SupplierStorage\SupplierStorageConfig;

class QueueDependencyProvider extends PyzQueueDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\Queue\Dependency\Plugin\QueueMessageProcessorPluginInterface>
     */
    protected function getProcessorMessagePlugins(Container $container): array
    {
        return array_merge(parent::getProcessorMessagePlugins($container), [
            // TODO: Register supplier queue processors
            // Hint: Map SupplierSearchConfig::SUPPLIER_PUBLISH_SEARCH_QUEUE => new EventQueueMessageProcessorPlugin()
            // Hint: Map SupplierStorageConfig::SUPPLIER_PUBLISH_STORAGE_QUEUE => new EventQueueMessageProcessorPlugin()
            // Hint: Map SupplierSearchConfig::SUPPLIER_SYNC_SEARCH_QUEUE => new SynchronizationSearchQueueMessageProcessorPlugin()
            // Hint: Map SupplierStorageConfig::SUPPLIER_SYNC_STORAGE_QUEUE => new SynchronizationStorageQueueMessageProcessorPlugin()
        ]);
    }
}
