<?php

namespace Orm\Zed\ProductCategoryFilterStorage\Persistence\Map;

use Orm\Zed\ProductCategoryFilterStorage\Persistence\SpyProductCategoryFilterStorage;
use Orm\Zed\ProductCategoryFilterStorage\Persistence\SpyProductCategoryFilterStorageQuery;
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
 * This class defines the structure of the 'spy_product_category_filter_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductCategoryFilterStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductCategoryFilterStorage.Persistence.Map.SpyProductCategoryFilterStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_category_filter_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductCategoryFilterStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductCategoryFilterStorage\\Persistence\\SpyProductCategoryFilterStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductCategoryFilterStorage.Persistence.SpyProductCategoryFilterStorage';

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
     * the column name for the id_product_category_filter_storage field
     */
    public const COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE = 'spy_product_category_filter_storage.id_product_category_filter_storage';

    /**
     * the column name for the fk_category field
     */
    public const COL_FK_CATEGORY = 'spy_product_category_filter_storage.fk_category';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_product_category_filter_storage.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_product_category_filter_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_category_filter_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_category_filter_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_category_filter_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductCategoryFilterStorage', 'FkCategory', 'Data', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductCategoryFilterStorage', 'fkCategory', 'data', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE, SpyProductCategoryFilterStorageTableMap::COL_FK_CATEGORY, SpyProductCategoryFilterStorageTableMap::COL_DATA, SpyProductCategoryFilterStorageTableMap::COL_ALIAS_KEYS, SpyProductCategoryFilterStorageTableMap::COL_KEY, SpyProductCategoryFilterStorageTableMap::COL_CREATED_AT, SpyProductCategoryFilterStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_category_filter_storage', 'fk_category', 'data', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductCategoryFilterStorage' => 0, 'FkCategory' => 1, 'Data' => 2, 'AliasKeys' => 3, 'Key' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idProductCategoryFilterStorage' => 0, 'fkCategory' => 1, 'data' => 2, 'aliasKeys' => 3, 'key' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE => 0, SpyProductCategoryFilterStorageTableMap::COL_FK_CATEGORY => 1, SpyProductCategoryFilterStorageTableMap::COL_DATA => 2, SpyProductCategoryFilterStorageTableMap::COL_ALIAS_KEYS => 3, SpyProductCategoryFilterStorageTableMap::COL_KEY => 4, SpyProductCategoryFilterStorageTableMap::COL_CREATED_AT => 5, SpyProductCategoryFilterStorageTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_product_category_filter_storage' => 0, 'fk_category' => 1, 'data' => 2, 'alias_keys' => 3, 'key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductCategoryFilterStorage' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'SpyProductCategoryFilterStorage.IdProductCategoryFilterStorage' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'idProductCategoryFilterStorage' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'spyProductCategoryFilterStorage.idProductCategoryFilterStorage' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'id_product_category_filter_storage' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'spy_product_category_filter_storage.id_product_category_filter_storage' => 'ID_PRODUCT_CATEGORY_FILTER_STORAGE',
        'FkCategory' => 'FK_CATEGORY',
        'SpyProductCategoryFilterStorage.FkCategory' => 'FK_CATEGORY',
        'fkCategory' => 'FK_CATEGORY',
        'spyProductCategoryFilterStorage.fkCategory' => 'FK_CATEGORY',
        'SpyProductCategoryFilterStorageTableMap::COL_FK_CATEGORY' => 'FK_CATEGORY',
        'COL_FK_CATEGORY' => 'FK_CATEGORY',
        'fk_category' => 'FK_CATEGORY',
        'spy_product_category_filter_storage.fk_category' => 'FK_CATEGORY',
        'Data' => 'DATA',
        'SpyProductCategoryFilterStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyProductCategoryFilterStorage.data' => 'DATA',
        'SpyProductCategoryFilterStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_product_category_filter_storage.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyProductCategoryFilterStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyProductCategoryFilterStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyProductCategoryFilterStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_product_category_filter_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyProductCategoryFilterStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductCategoryFilterStorage.key' => 'KEY',
        'SpyProductCategoryFilterStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_category_filter_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductCategoryFilterStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductCategoryFilterStorage.createdAt' => 'CREATED_AT',
        'SpyProductCategoryFilterStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_category_filter_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductCategoryFilterStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductCategoryFilterStorage.updatedAt' => 'UPDATED_AT',
        'SpyProductCategoryFilterStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_category_filter_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_category_filter_storage');
        $this->setPhpName('SpyProductCategoryFilterStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductCategoryFilterStorage\\Persistence\\SpyProductCategoryFilterStorage');
        $this->setPackage('src.Orm.Zed.ProductCategoryFilterStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_category_filter_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_category_filter_storage', 'IdProductCategoryFilterStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_category', 'FkCategory', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
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
            'synchronization' => ['resource' => ['value' => 'product_category_filter'], 'queue_group' => ['value' => 'sync.storage.category'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'fk_category']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdProductCategoryFilterStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductCategoryFilterStorageTableMap::CLASS_DEFAULT : SpyProductCategoryFilterStorageTableMap::OM_CLASS;
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
     * @return array (SpyProductCategoryFilterStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductCategoryFilterStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductCategoryFilterStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductCategoryFilterStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductCategoryFilterStorageTableMap::OM_CLASS;
            /** @var SpyProductCategoryFilterStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductCategoryFilterStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductCategoryFilterStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductCategoryFilterStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductCategoryFilterStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductCategoryFilterStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE);
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_FK_CATEGORY);
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_category_filter_storage');
            $criteria->addSelectColumn($alias . '.fk_category');
            $criteria->addSelectColumn($alias . '.data');
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
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE);
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_FK_CATEGORY);
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductCategoryFilterStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_category_filter_storage');
            $criteria->removeSelectColumn($alias . '.fk_category');
            $criteria->removeSelectColumn($alias . '.data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductCategoryFilterStorageTableMap::DATABASE_NAME)->getTable(SpyProductCategoryFilterStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductCategoryFilterStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductCategoryFilterStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductCategoryFilterStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductCategoryFilterStorage\Persistence\SpyProductCategoryFilterStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductCategoryFilterStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyProductCategoryFilterStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductCategoryFilterStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductCategoryFilterStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_category_filter_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductCategoryFilterStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductCategoryFilterStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductCategoryFilterStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductCategoryFilterStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductCategoryFilterStorage object
        }

        if ($criteria->containsKey(SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE) && $criteria->keyContainsValue(SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductCategoryFilterStorageTableMap::COL_ID_PRODUCT_CATEGORY_FILTER_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyProductCategoryFilterStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
