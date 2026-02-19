<?php

namespace Orm\Zed\ProductOfferStorage\Persistence\Map;

use Orm\Zed\ProductOfferStorage\Persistence\SpyProductConcreteProductOffersStorage;
use Orm\Zed\ProductOfferStorage\Persistence\SpyProductConcreteProductOffersStorageQuery;
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
 * This class defines the structure of the 'spy_product_concrete_product_offers_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductConcreteProductOffersStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductOfferStorage.Persistence.Map.SpyProductConcreteProductOffersStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_concrete_product_offers_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductConcreteProductOffersStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductOfferStorage\\Persistence\\SpyProductConcreteProductOffersStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductOfferStorage.Persistence.SpyProductConcreteProductOffersStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_product_concrete_product_offers_storage field
     */
    public const COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE = 'spy_product_concrete_product_offers_storage.id_product_concrete_product_offers_storage';

    /**
     * the column name for the concrete_sku field
     */
    public const COL_CONCRETE_SKU = 'spy_product_concrete_product_offers_storage.concrete_sku';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_product_concrete_product_offers_storage.data';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_product_concrete_product_offers_storage.store';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_product_concrete_product_offers_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_concrete_product_offers_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_concrete_product_offers_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_concrete_product_offers_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductConcreteProductOffersStorage', 'ConcreteSku', 'Data', 'Store', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductConcreteProductOffersStorage', 'concreteSku', 'data', 'store', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE, SpyProductConcreteProductOffersStorageTableMap::COL_CONCRETE_SKU, SpyProductConcreteProductOffersStorageTableMap::COL_DATA, SpyProductConcreteProductOffersStorageTableMap::COL_STORE, SpyProductConcreteProductOffersStorageTableMap::COL_ALIAS_KEYS, SpyProductConcreteProductOffersStorageTableMap::COL_KEY, SpyProductConcreteProductOffersStorageTableMap::COL_CREATED_AT, SpyProductConcreteProductOffersStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_concrete_product_offers_storage', 'concrete_sku', 'data', 'store', 'alias_keys', 'key', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdProductConcreteProductOffersStorage' => 0, 'ConcreteSku' => 1, 'Data' => 2, 'Store' => 3, 'AliasKeys' => 4, 'Key' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idProductConcreteProductOffersStorage' => 0, 'concreteSku' => 1, 'data' => 2, 'store' => 3, 'aliasKeys' => 4, 'key' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE => 0, SpyProductConcreteProductOffersStorageTableMap::COL_CONCRETE_SKU => 1, SpyProductConcreteProductOffersStorageTableMap::COL_DATA => 2, SpyProductConcreteProductOffersStorageTableMap::COL_STORE => 3, SpyProductConcreteProductOffersStorageTableMap::COL_ALIAS_KEYS => 4, SpyProductConcreteProductOffersStorageTableMap::COL_KEY => 5, SpyProductConcreteProductOffersStorageTableMap::COL_CREATED_AT => 6, SpyProductConcreteProductOffersStorageTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_product_concrete_product_offers_storage' => 0, 'concrete_sku' => 1, 'data' => 2, 'store' => 3, 'alias_keys' => 4, 'key' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductConcreteProductOffersStorage' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'SpyProductConcreteProductOffersStorage.IdProductConcreteProductOffersStorage' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'idProductConcreteProductOffersStorage' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'spyProductConcreteProductOffersStorage.idProductConcreteProductOffersStorage' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'id_product_concrete_product_offers_storage' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'spy_product_concrete_product_offers_storage.id_product_concrete_product_offers_storage' => 'ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE',
        'ConcreteSku' => 'CONCRETE_SKU',
        'SpyProductConcreteProductOffersStorage.ConcreteSku' => 'CONCRETE_SKU',
        'concreteSku' => 'CONCRETE_SKU',
        'spyProductConcreteProductOffersStorage.concreteSku' => 'CONCRETE_SKU',
        'SpyProductConcreteProductOffersStorageTableMap::COL_CONCRETE_SKU' => 'CONCRETE_SKU',
        'COL_CONCRETE_SKU' => 'CONCRETE_SKU',
        'concrete_sku' => 'CONCRETE_SKU',
        'spy_product_concrete_product_offers_storage.concrete_sku' => 'CONCRETE_SKU',
        'Data' => 'DATA',
        'SpyProductConcreteProductOffersStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyProductConcreteProductOffersStorage.data' => 'DATA',
        'SpyProductConcreteProductOffersStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_product_concrete_product_offers_storage.data' => 'DATA',
        'Store' => 'STORE',
        'SpyProductConcreteProductOffersStorage.Store' => 'STORE',
        'store' => 'STORE',
        'spyProductConcreteProductOffersStorage.store' => 'STORE',
        'SpyProductConcreteProductOffersStorageTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_product_concrete_product_offers_storage.store' => 'STORE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyProductConcreteProductOffersStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyProductConcreteProductOffersStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyProductConcreteProductOffersStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_product_concrete_product_offers_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyProductConcreteProductOffersStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductConcreteProductOffersStorage.key' => 'KEY',
        'SpyProductConcreteProductOffersStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_concrete_product_offers_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductConcreteProductOffersStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductConcreteProductOffersStorage.createdAt' => 'CREATED_AT',
        'SpyProductConcreteProductOffersStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_concrete_product_offers_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductConcreteProductOffersStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductConcreteProductOffersStorage.updatedAt' => 'UPDATED_AT',
        'SpyProductConcreteProductOffersStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_concrete_product_offers_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_concrete_product_offers_storage');
        $this->setPhpName('SpyProductConcreteProductOffersStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductOfferStorage\\Persistence\\SpyProductConcreteProductOffersStorage');
        $this->setPackage('src.Orm.Zed.ProductOfferStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_concrete_product_offers_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_concrete_product_offers_storage', 'IdProductConcreteProductOffersStorage', 'INTEGER', true, null, null);
        $this->addColumn('concrete_sku', 'ConcreteSku', 'VARCHAR', true, 255, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('store', 'Store', 'VARCHAR', true, 128, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'product_concrete_product_offers'], 'queue_group' => ['value' => 'sync.storage.product_offer'], 'queue_pool' => NULL, 'key_suffix_column' => ['value' => 'concrete_sku'], 'store' => ['required' => 'true']],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductConcreteProductOffersStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductConcreteProductOffersStorageTableMap::CLASS_DEFAULT : SpyProductConcreteProductOffersStorageTableMap::OM_CLASS;
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
     * @return array (SpyProductConcreteProductOffersStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductConcreteProductOffersStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductConcreteProductOffersStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductConcreteProductOffersStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductConcreteProductOffersStorageTableMap::OM_CLASS;
            /** @var SpyProductConcreteProductOffersStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductConcreteProductOffersStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductConcreteProductOffersStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductConcreteProductOffersStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductConcreteProductOffersStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductConcreteProductOffersStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_CONCRETE_SKU);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_concrete_product_offers_storage');
            $criteria->addSelectColumn($alias . '.concrete_sku');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.store');
            $criteria->addSelectColumn($alias . '.alias_keys');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_CONCRETE_SKU);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductConcreteProductOffersStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_concrete_product_offers_storage');
            $criteria->removeSelectColumn($alias . '.concrete_sku');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.store');
            $criteria->removeSelectColumn($alias . '.alias_keys');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductConcreteProductOffersStorageTableMap::DATABASE_NAME)->getTable(SpyProductConcreteProductOffersStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductConcreteProductOffersStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductConcreteProductOffersStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductConcreteProductOffersStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductOfferStorage\Persistence\SpyProductConcreteProductOffersStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductConcreteProductOffersStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyProductConcreteProductOffersStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductConcreteProductOffersStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductConcreteProductOffersStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_concrete_product_offers_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductConcreteProductOffersStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductConcreteProductOffersStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductConcreteProductOffersStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductConcreteProductOffersStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductConcreteProductOffersStorage object
        }

        if ($criteria->containsKey(SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE) && $criteria->keyContainsValue(SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductConcreteProductOffersStorageTableMap::COL_ID_PRODUCT_CONCRETE_PRODUCT_OFFERS_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyProductConcreteProductOffersStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
