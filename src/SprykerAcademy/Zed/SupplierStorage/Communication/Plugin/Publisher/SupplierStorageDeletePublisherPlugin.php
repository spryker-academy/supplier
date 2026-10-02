<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierStorage\Communication\Plugin\Publisher;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;
use SprykerAcademy\Shared\SupplierStorage\SupplierStorageConfig;

/**
 * Removes a deleted supplier from Redis: deletes its pyz_supplier_storage row, and the synchronization
 * behavior of that table sends the delete to the sync queue.
 *
 * @method \SprykerAcademy\Zed\SupplierStorage\Business\SupplierStorageFacadeInterface getFacade()
 */
class SupplierStorageDeletePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     */
    #[\Override]
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()->deleteCollectionBySupplierEvents($eventEntityTransfers);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array<string>
     */
    #[\Override]
    public function getSubscribedEvents(): array
    {
        return [
            SupplierStorageConfig::ENTITY_PYZ_SUPPLIER_DELETE,
        ];
    }
}
