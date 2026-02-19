<?php

namespace Orm\Zed\ProductAlternativeStorage\Persistence\Map;

use Orm\Zed\ProductAlternativeStorage\Persistence\SpyProductReplacementForStorage;
use Orm\Zed\ProductAlternativeStorage\Persistence\SpyProductReplacementForStorageQuery;
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
 * This class defines the structure of the 'spy_product_replacement_for_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductReplacementForStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductAlternativeStorage.Persistence.Map.SpyProductReplacementForStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_replacement_for_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductReplacementForStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductAlternativeStorage\\Persistence\\SpyProductReplacementForStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductAlternativeStorage.Persistence.SpyProductReplacementForStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_product_replacement_for_storage field
     */
    public const COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE = 'spy_product_replacement_for_storage.id_product_replacement_for_storage';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_product_replacement_for_storage.data';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_product_replacement_for_storage.sku';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_product_replacement_for_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_replacement_for_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_replacement_for_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_replacement_for_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductReplacementForStorage', 'Data', 'Sku', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductReplacementForStorage', 'data', 'sku', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE, SpyProductReplacementForStorageTableMap::COL_DATA, SpyProductReplacementForStorageTableMap::COL_SKU, SpyProductReplacementForStorageTableMap::COL_ALIAS_KEYS, SpyProductReplacementForStorageTableMap::COL_KEY, SpyProductReplacementForStorageTableMap::COL_CREATED_AT, SpyProductReplacementForStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_replacement_for_storage', 'data', 'sku', 'alias_keys', 'key', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdProductReplacementForStorage' => 0, 'Data' => 1, 'Sku' => 2, 'AliasKeys' => 3, 'Key' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idProductReplacementForStorage' => 0, 'data' => 1, 'sku' => 2, 'aliasKeys' => 3, 'key' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE => 0, SpyProductReplacementForStorageTableMap::COL_DATA => 1, SpyProductReplacementForStorageTableMap::COL_SKU => 2, SpyProductReplacementForStorageTableMap::COL_ALIAS_KEYS => 3, SpyProductReplacementForStorageTableMap::COL_KEY => 4, SpyProductReplacementForStorageTableMap::COL_CREATED_AT => 5, SpyProductReplacementForStorageTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_product_replacement_for_storage' => 0, 'data' => 1, 'sku' => 2, 'alias_keys' => 3, 'key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductReplacementForStorage' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'SpyProductReplacementForStorage.IdProductReplacementForStorage' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'idProductReplacementForStorage' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'spyProductReplacementForStorage.idProductReplacementForStorage' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'id_product_replacement_for_storage' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'spy_product_replacement_for_storage.id_product_replacement_for_storage' => 'ID_PRODUCT_REPLACEMENT_FOR_STORAGE',
        'Data' => 'DATA',
        'SpyProductReplacementForStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyProductReplacementForStorage.data' => 'DATA',
        'SpyProductReplacementForStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_product_replacement_for_storage.data' => 'DATA',
        'Sku' => 'SKU',
        'SpyProductReplacementForStorage.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyProductReplacementForStorage.sku' => 'SKU',
        'SpyProductReplacementForStorageTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_product_replacement_for_storage.sku' => 'SKU',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyProductReplacementForStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyProductReplacementForStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyProductReplacementForStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_product_replacement_for_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyProductReplacementForStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductReplacementForStorage.key' => 'KEY',
        'SpyProductReplacementForStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_replacement_for_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductReplacementForStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductReplacementForStorage.createdAt' => 'CREATED_AT',
        'SpyProductReplacementForStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_replacement_for_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductReplacementForStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductReplacementForStorage.updatedAt' => 'UPDATED_AT',
        'SpyProductReplacementForStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_replacement_for_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_replacement_for_storage');
        $this->setPhpName('SpyProductReplacementForStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductAlternativeStorage\\Persistence\\SpyProductReplacementForStorage');
        $this->setPackage('src.Orm.Zed.ProductAlternativeStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_replacement_for_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_replacement_for_storage', 'IdProductReplacementForStorage', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'product_replacement_for'], 'queue_group' => ['value' => 'sync.storage.product'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'sku']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductReplacementForStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductReplacementForStorageTableMap::CLASS_DEFAULT : SpyProductReplacementForStorageTableMap::OM_CLASS;
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
     * @return array (SpyProductReplacementForStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductReplacementForStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductReplacementForStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductReplacementForStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductReplacementForStorageTableMap::OM_CLASS;
            /** @var SpyProductReplacementForStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductReplacementForStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductReplacementForStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductReplacementForStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductReplacementForStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductReplacementForStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE);
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_SKU);
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductReplacementForStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_replacement_for_storage');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.sku');
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
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE);
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductReplacementForStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_replacement_for_storage');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.sku');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductReplacementForStorageTableMap::DATABASE_NAME)->getTable(SpyProductReplacementForStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductReplacementForStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductReplacementForStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductReplacementForStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductAlternativeStorage\Persistence\SpyProductReplacementForStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductReplacementForStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyProductReplacementForStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductReplacementForStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductReplacementForStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_replacement_for_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductReplacementForStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductReplacementForStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductReplacementForStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductReplacementForStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductReplacementForStorage object
        }

        if ($criteria->containsKey(SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE) && $criteria->keyContainsValue(SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductReplacementForStorageTableMap::COL_ID_PRODUCT_REPLACEMENT_FOR_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyProductReplacementForStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
