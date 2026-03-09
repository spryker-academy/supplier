<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerAcademy\Shared\SupplierSearch;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class SupplierSearchConfig extends AbstractBundleConfig
{
    /**
     * @api
     */
    public const string SUPPLIER_PUBLISH_SEARCH_QUEUE = 'publish.search.supplier';

    /**
     * @api
     */
    public const string SUPPLIER_SYNC_SEARCH_QUEUE = 'sync.search.supplier';

    /**
     * @api
     */
    public const string ENTITY_PYZ_SUPPLIER_CREATE = 'Entity.pyz_supplier.create';

    /**
     * @api
     */
    public const string ENTITY_PYZ_SUPPLIER_UPDATE = 'Entity.pyz_supplier.update';

    /**
     * @api
     */
    public const string ENTITY_PYZ_SUPPLIER_DELETE = 'Entity.pyz_supplier.delete';

    /**
     * @api
     */
    public const string SUPPLIER_PUBLISH = 'SupplierSearch.supplier.publish';

    /**
     * @api
     */
    public const string SUPPLIER_UNPUBLISH = 'SupplierSearch.supplier.unpublish';

    /**
     * @api
     */
    public const string SUPPLIER_SOURCE_IDENTIFIER = 'supplier';

    /**
     * @api
     */
    public const string SUPPLIER_RESOURCE_TYPE = 'supplier';

    /**
     * @api
     */
    public const string KEY_TYPE = 'type';

    /**
     * @api
     */
    public const string KEY_ID_SUPPLIER = 'id_supplier';

    /**
     * @api
     */
    public const string KEY_NAME = 'name';

    /**
     * @api
     */
    public const string KEY_SEARCH_RESULT_DATA = 'search-result-data';

    /**
     * @api
     */
    public const string KEY_FULL_TEXT = 'full-text';

    /**
     * @api
     */
    public const string KEY_FULL_TEXT_BOOSTED = 'full-text-boosted';

    /**
     * @api
     */
    public const string KEY_SUGGESTION_TERMS = 'suggestion-terms';

    /**
     * @api
     */
    public const string KEY_COMPLETION_TERMS = 'completion-terms';
}
