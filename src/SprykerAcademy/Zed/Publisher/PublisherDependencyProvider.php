<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\Publisher;

use Pyz\Zed\Publisher\PublisherDependencyProvider as PyzPublisherDependencyProvider;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
use SprykerAcademy\Shared\SupplierStorage\SupplierStorageConfig;
use SprykerAcademy\Zed\SupplierSearch\Communication\Plugin\Publisher\SupplierSearchWritePublisherPlugin;
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
    protected function getSupplierPublisherPlugins(): array
    {
        return [
            SupplierSearchConfig::SUPPLIER_PUBLISH_SEARCH_QUEUE => [
                new SupplierSearchWritePublisherPlugin(),
            ],
            SupplierStorageConfig::SUPPLIER_PUBLISH_STORAGE_QUEUE => [
                new SupplierStorageWritePublisherPlugin(),
            ],
        ];
    }
}
