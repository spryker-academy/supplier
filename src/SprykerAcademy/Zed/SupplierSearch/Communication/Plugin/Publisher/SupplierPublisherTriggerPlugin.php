<?php

declare(strict_types=1);

namespace SprykerAcademy\Zed\SupplierSearch\Communication\Plugin\Publisher;

use Generated\Shared\Transfer\SupplierTransfer;
use Orm\Zed\Supplier\Persistence\Map\PyzSupplierTableMap;
use Orm\Zed\Supplier\Persistence\PyzSupplierQuery;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherTriggerPluginInterface;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;

/**
 * @method \SprykerAcademy\Zed\SupplierSearch\Business\SupplierSearchFacadeInterface getFacade()
 */
class SupplierPublisherTriggerPlugin extends AbstractPlugin implements PublisherTriggerPluginInterface
{
    /**
     * @var string
     */
    protected const string COL_ID_SUPPLIER = PyzSupplierTableMap::COL_ID_SUPPLIER;

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $offset
     * @param int $limit
     *
     * @return array<\Generated\Shared\Transfer\SupplierTransfer>
     */
    public function getData(int $offset, int $limit): array
    {
        // TODO-1: Query suppliers from the database with pagination.
        // Hint-1: Use PyzSupplierQuery::create()->offset($offset)->limit($limit)->find()
        // Hint-2: Convert each Propel entity to a SupplierTransfer using fromArray($entity->toArray(), true)
        // Hint-3: Return an array of SupplierTransfer objects, NOT Propel entities

        return [];
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getResourceName(): string
    {
        // TODO-2: Return the resource name used for the publish:trigger-events command.
        // Hint-1: This should return 'supplier' so you can run: publish:trigger-events -r supplier

        return '';
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getEventName(): string
    {
        // TODO-3: Return the event name for supplier publishing.
        // Hint-1: Use the constant from SupplierSearchConfig::SUPPLIER_PUBLISH

        return '';
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        // TODO-4: Return the full Propel column name for the ID field.
        // Hint-1: Use the constant COL_ID_SUPPLIER (already defined above)
        // Hint-2: This returns 'pyz_supplier.id_supplier' which the publisher uses to extract IDs

        return null;
    }
}
