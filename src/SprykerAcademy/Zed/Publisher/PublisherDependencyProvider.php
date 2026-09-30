<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\Publisher;

use Pyz\Zed\Publisher\PublisherDependencyProvider as PyzPublisherDependencyProvider;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
use SprykerAcademy\Shared\SupplierStorage\SupplierStorageConfig;
use SprykerAcademy\Zed\SupplierSearch\Communication\Plugin\Publisher\SupplierPublisherTriggerPlugin;
use SprykerAcademy\Zed\SupplierSearch\Communication\Plugin\Publisher\SupplierSearchWritePublisherPlugin;
use SprykerAcademy\Zed\SupplierStorage\Communication\Plugin\Publisher\SupplierStoragePublisherTriggerPlugin;
use SprykerAcademy\Zed\SupplierStorage\Communication\Plugin\Publisher\SupplierStorageWritePublisherPlugin;

class PublisherDependencyProvider extends PyzPublisherDependencyProvider
{
    /**
     * @return array<string, array<\Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface>>
     */
    protected function getPublisherPlugins(): array
    {
        return array_merge(
            parent::getPublisherPlugins(),
            $this->getSupplierPublisherPlugins(),
        );
    }

    /**
     * @return array<string, array<\Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface>>
     */
    /**
     * Lets `console publish:trigger-events -r supplier` republish every supplier to search and to storage,
     * for example after the search index or the storage was cleared.
     *
     * @return array<\Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherTriggerPluginInterface>
     */
    protected function getPublisherTriggerPlugins(): array
    {
        return array_merge(
            parent::getPublisherTriggerPlugins(),
            [
                new SupplierPublisherTriggerPlugin(),
                new SupplierStoragePublisherTriggerPlugin(),
            ],
        );
    }

    protected function getSupplierPublisherPlugins(): array
    {
        // TODO: Register the supplier publisher plugins, each under its publish queue
        // Hint: Map SupplierSearchConfig::SUPPLIER_PUBLISH_SEARCH_QUEUE => [new SupplierSearchWritePublisherPlugin()]
        // Hint: Map SupplierStorageConfig::SUPPLIER_PUBLISH_STORAGE_QUEUE => [new SupplierStorageWritePublisherPlugin()]
        return [
        ];
    }
}
