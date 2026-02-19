<?php

namespace Orm\Zed\ProductOffer\Persistence\Map;

use Orm\Zed\PriceProductOffer\Persistence\Map\SpyPriceProductOfferTableMap;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'spy_product_offer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductOfferTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductOffer.Persistence.Map.SpyProductOfferTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_offer';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductOffer';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductOffer.Persistence.SpyProductOffer';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_product_offer field
     */
    public const COL_ID_PRODUCT_OFFER = 'spy_product_offer.id_product_offer';

    /**
     * the column name for the approval_status field
     */
    public const COL_APPROVAL_STATUS = 'spy_product_offer.approval_status';

    /**
     * the column name for the concrete_sku field
     */
    public const COL_CONCRETE_SKU = 'spy_product_offer.concrete_sku';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_product_offer.is_active';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_product_offer.merchant_reference';

    /**
     * the column name for the merchant_sku field
     */
    public const COL_MERCHANT_SKU = 'spy_product_offer.merchant_sku';

    /**
     * the column name for the product_offer_reference field
     */
    public const COL_PRODUCT_OFFER_REFERENCE = 'spy_product_offer.product_offer_reference';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_offer.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_offer.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdProductOffer', 'ApprovalStatus', 'ConcreteSku', 'IsActive', 'MerchantReference', 'MerchantSku', 'ProductOfferReference', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductOffer', 'approvalStatus', 'concreteSku', 'isActive', 'merchantReference', 'merchantSku', 'productOfferReference', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, SpyProductOfferTableMap::COL_APPROVAL_STATUS, SpyProductOfferTableMap::COL_CONCRETE_SKU, SpyProductOfferTableMap::COL_IS_ACTIVE, SpyProductOfferTableMap::COL_MERCHANT_REFERENCE, SpyProductOfferTableMap::COL_MERCHANT_SKU, SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE, SpyProductOfferTableMap::COL_CREATED_AT, SpyProductOfferTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_offer', 'approval_status', 'concrete_sku', 'is_active', 'merchant_reference', 'merchant_sku', 'product_offer_reference', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdProductOffer' => 0, 'ApprovalStatus' => 1, 'ConcreteSku' => 2, 'IsActive' => 3, 'MerchantReference' => 4, 'MerchantSku' => 5, 'ProductOfferReference' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idProductOffer' => 0, 'approvalStatus' => 1, 'concreteSku' => 2, 'isActive' => 3, 'merchantReference' => 4, 'merchantSku' => 5, 'productOfferReference' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER => 0, SpyProductOfferTableMap::COL_APPROVAL_STATUS => 1, SpyProductOfferTableMap::COL_CONCRETE_SKU => 2, SpyProductOfferTableMap::COL_IS_ACTIVE => 3, SpyProductOfferTableMap::COL_MERCHANT_REFERENCE => 4, SpyProductOfferTableMap::COL_MERCHANT_SKU => 5, SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE => 6, SpyProductOfferTableMap::COL_CREATED_AT => 7, SpyProductOfferTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_product_offer' => 0, 'approval_status' => 1, 'concrete_sku' => 2, 'is_active' => 3, 'merchant_reference' => 4, 'merchant_sku' => 5, 'product_offer_reference' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductOffer' => 'ID_PRODUCT_OFFER',
        'SpyProductOffer.IdProductOffer' => 'ID_PRODUCT_OFFER',
        'idProductOffer' => 'ID_PRODUCT_OFFER',
        'spyProductOffer.idProductOffer' => 'ID_PRODUCT_OFFER',
        'SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER' => 'ID_PRODUCT_OFFER',
        'COL_ID_PRODUCT_OFFER' => 'ID_PRODUCT_OFFER',
        'id_product_offer' => 'ID_PRODUCT_OFFER',
        'spy_product_offer.id_product_offer' => 'ID_PRODUCT_OFFER',
        'ApprovalStatus' => 'APPROVAL_STATUS',
        'SpyProductOffer.ApprovalStatus' => 'APPROVAL_STATUS',
        'approvalStatus' => 'APPROVAL_STATUS',
        'spyProductOffer.approvalStatus' => 'APPROVAL_STATUS',
        'SpyProductOfferTableMap::COL_APPROVAL_STATUS' => 'APPROVAL_STATUS',
        'COL_APPROVAL_STATUS' => 'APPROVAL_STATUS',
        'approval_status' => 'APPROVAL_STATUS',
        'spy_product_offer.approval_status' => 'APPROVAL_STATUS',
        'ConcreteSku' => 'CONCRETE_SKU',
        'SpyProductOffer.ConcreteSku' => 'CONCRETE_SKU',
        'concreteSku' => 'CONCRETE_SKU',
        'spyProductOffer.concreteSku' => 'CONCRETE_SKU',
        'SpyProductOfferTableMap::COL_CONCRETE_SKU' => 'CONCRETE_SKU',
        'COL_CONCRETE_SKU' => 'CONCRETE_SKU',
        'concrete_sku' => 'CONCRETE_SKU',
        'spy_product_offer.concrete_sku' => 'CONCRETE_SKU',
        'IsActive' => 'IS_ACTIVE',
        'SpyProductOffer.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyProductOffer.isActive' => 'IS_ACTIVE',
        'SpyProductOfferTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_product_offer.is_active' => 'IS_ACTIVE',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpyProductOffer.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spyProductOffer.merchantReference' => 'MERCHANT_REFERENCE',
        'SpyProductOfferTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_product_offer.merchant_reference' => 'MERCHANT_REFERENCE',
        'MerchantSku' => 'MERCHANT_SKU',
        'SpyProductOffer.MerchantSku' => 'MERCHANT_SKU',
        'merchantSku' => 'MERCHANT_SKU',
        'spyProductOffer.merchantSku' => 'MERCHANT_SKU',
        'SpyProductOfferTableMap::COL_MERCHANT_SKU' => 'MERCHANT_SKU',
        'COL_MERCHANT_SKU' => 'MERCHANT_SKU',
        'merchant_sku' => 'MERCHANT_SKU',
        'spy_product_offer.merchant_sku' => 'MERCHANT_SKU',
        'ProductOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'SpyProductOffer.ProductOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'productOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'spyProductOffer.productOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE' => 'PRODUCT_OFFER_REFERENCE',
        'COL_PRODUCT_OFFER_REFERENCE' => 'PRODUCT_OFFER_REFERENCE',
        'product_offer_reference' => 'PRODUCT_OFFER_REFERENCE',
        'spy_product_offer.product_offer_reference' => 'PRODUCT_OFFER_REFERENCE',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductOffer.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductOffer.createdAt' => 'CREATED_AT',
        'SpyProductOfferTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_offer.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductOffer.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductOffer.updatedAt' => 'UPDATED_AT',
        'SpyProductOfferTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_offer.updated_at' => 'UPDATED_AT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('spy_product_offer');
        $this->setPhpName('SpyProductOffer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer');
        $this->setPackage('src.Orm.Zed.ProductOffer.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_offer_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_offer', 'IdProductOffer', 'INTEGER', true, null, null);
        $this->addColumn('approval_status', 'ApprovalStatus', 'VARCHAR', true, 64, null);
        $this->addColumn('concrete_sku', 'ConcreteSku', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, true);
        $this->addForeignKey('merchant_reference', 'MerchantReference', 'VARCHAR', 'spy_merchant', 'merchant_reference', false, 255, null);
        $this->addColumn('merchant_sku', 'MerchantSku', 'VARCHAR', false, 255, null);
        $this->addColumn('product_offer_reference', 'ProductOfferReference', 'VARCHAR', true, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Merchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
  ),
), null, null, null, false);
        $this->addRelation('SpyPriceProductOffer', '\\Orm\\Zed\\PriceProductOffer\\Persistence\\SpyPriceProductOffer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), 'CASCADE', null, 'SpyPriceProductOffers', false);
        $this->addRelation('SpyProductOfferStore', '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOfferStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), null, null, 'SpyProductOfferStores', false);
        $this->addRelation('ProductOfferService', '\\Orm\\Zed\\ProductOfferServicePoint\\Persistence\\SpyProductOfferService', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), null, null, 'ProductOfferServices', false);
        $this->addRelation('ProductOfferShipmentType', '\\Orm\\Zed\\ProductOfferShipmentType\\Persistence\\SpyProductOfferShipmentType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), null, null, 'ProductOfferShipmentTypes', false);
        $this->addRelation('ProductOfferStock', '\\Orm\\Zed\\ProductOfferStock\\Persistence\\SpyProductOfferStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), null, null, 'ProductOfferStocks', false);
        $this->addRelation('SpyProductOfferValidity', '\\Orm\\Zed\\ProductOfferValidity\\Persistence\\SpyProductOfferValidity', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), null, null, 'SpyProductOfferValidities', false);
        $this->addRelation('SpyStore', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_MANY, array(), null, null, 'SpyStores');
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_product_offer_all' => ['column' => '*'], 'spy_product_offer_product_offer_reference' => ['column' => 'product_offer_reference', 'keep-additional' => 'true'], 'spy_product_offer_concrete_sku' => ['column' => 'concrete_sku', 'keep-additional' => 'true']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_product_offer     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyPriceProductOfferTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdProductOffer', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? SpyProductOfferTableMap::CLASS_DEFAULT : SpyProductOfferTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (SpyProductOffer object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductOfferTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductOfferTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductOfferTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductOfferTableMap::OM_CLASS;
            /** @var SpyProductOffer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductOfferTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SpyProductOfferTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductOfferTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductOffer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductOfferTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_APPROVAL_STATUS);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_CONCRETE_SKU);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_MERCHANT_SKU);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductOfferTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_offer');
            $criteria->addSelectColumn($alias . '.approval_status');
            $criteria->addSelectColumn($alias . '.concrete_sku');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.merchant_sku');
            $criteria->addSelectColumn($alias . '.product_offer_reference');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_APPROVAL_STATUS);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_CONCRETE_SKU);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_MERCHANT_SKU);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductOfferTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_offer');
            $criteria->removeSelectColumn($alias . '.approval_status');
            $criteria->removeSelectColumn($alias . '.concrete_sku');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.merchant_sku');
            $criteria->removeSelectColumn($alias . '.product_offer_reference');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductOfferTableMap::DATABASE_NAME)->getTable(SpyProductOfferTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductOffer or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductOffer object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductOffer\Persistence\SpyProductOffer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductOfferTableMap::DATABASE_NAME);
            $criteria->add(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, (array) $values, Criteria::IN);
        }

        $query = SpyProductOfferQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductOfferTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductOfferTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_offer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductOfferQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductOffer or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductOffer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductOffer object
        }

        if ($criteria->containsKey(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER) && $criteria->keyContainsValue(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER.')');
        }


        // Set the correct dbName
        $query = SpyProductOfferQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
