<?php

namespace Orm\Zed\ProductDiscontinuedStorage\Persistence\Map;

use Orm\Zed\ProductDiscontinuedStorage\Persistence\SpyProductDiscontinuedStorage;
use Orm\Zed\ProductDiscontinuedStorage\Persistence\SpyProductDiscontinuedStorageQuery;
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
 * This class defines the structure of the 'spy_product_discontinued_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductDiscontinuedStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductDiscontinuedStorage.Persistence.Map.SpyProductDiscontinuedStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_discontinued_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductDiscontinuedStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductDiscontinuedStorage\\Persistence\\SpyProductDiscontinuedStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductDiscontinuedStorage.Persistence.SpyProductDiscontinuedStorage';

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
     * the column name for the id_product_discontinued_storage field
     */
    public const COL_ID_PRODUCT_DISCONTINUED_STORAGE = 'spy_product_discontinued_storage.id_product_discontinued_storage';

    /**
     * the column name for the fk_product_discontinued field
     */
    public const COL_FK_PRODUCT_DISCONTINUED = 'spy_product_discontinued_storage.fk_product_discontinued';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_product_discontinued_storage.data';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_discontinued_storage.key';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_product_discontinued_storage.locale';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_product_discontinued_storage.sku';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_product_discontinued_storage.alias_keys';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_discontinued_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_discontinued_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductDiscontinuedStorage', 'FkProductDiscontinued', 'Data', 'Key', 'Locale', 'Sku', 'AliasKeys', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductDiscontinuedStorage', 'fkProductDiscontinued', 'data', 'key', 'locale', 'sku', 'aliasKeys', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE, SpyProductDiscontinuedStorageTableMap::COL_FK_PRODUCT_DISCONTINUED, SpyProductDiscontinuedStorageTableMap::COL_DATA, SpyProductDiscontinuedStorageTableMap::COL_KEY, SpyProductDiscontinuedStorageTableMap::COL_LOCALE, SpyProductDiscontinuedStorageTableMap::COL_SKU, SpyProductDiscontinuedStorageTableMap::COL_ALIAS_KEYS, SpyProductDiscontinuedStorageTableMap::COL_CREATED_AT, SpyProductDiscontinuedStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_discontinued_storage', 'fk_product_discontinued', 'data', 'key', 'locale', 'sku', 'alias_keys', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductDiscontinuedStorage' => 0, 'FkProductDiscontinued' => 1, 'Data' => 2, 'Key' => 3, 'Locale' => 4, 'Sku' => 5, 'AliasKeys' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idProductDiscontinuedStorage' => 0, 'fkProductDiscontinued' => 1, 'data' => 2, 'key' => 3, 'locale' => 4, 'sku' => 5, 'aliasKeys' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE => 0, SpyProductDiscontinuedStorageTableMap::COL_FK_PRODUCT_DISCONTINUED => 1, SpyProductDiscontinuedStorageTableMap::COL_DATA => 2, SpyProductDiscontinuedStorageTableMap::COL_KEY => 3, SpyProductDiscontinuedStorageTableMap::COL_LOCALE => 4, SpyProductDiscontinuedStorageTableMap::COL_SKU => 5, SpyProductDiscontinuedStorageTableMap::COL_ALIAS_KEYS => 6, SpyProductDiscontinuedStorageTableMap::COL_CREATED_AT => 7, SpyProductDiscontinuedStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_product_discontinued_storage' => 0, 'fk_product_discontinued' => 1, 'data' => 2, 'key' => 3, 'locale' => 4, 'sku' => 5, 'alias_keys' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductDiscontinuedStorage' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'SpyProductDiscontinuedStorage.IdProductDiscontinuedStorage' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'idProductDiscontinuedStorage' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'spyProductDiscontinuedStorage.idProductDiscontinuedStorage' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'COL_ID_PRODUCT_DISCONTINUED_STORAGE' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'id_product_discontinued_storage' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'spy_product_discontinued_storage.id_product_discontinued_storage' => 'ID_PRODUCT_DISCONTINUED_STORAGE',
        'FkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'SpyProductDiscontinuedStorage.FkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'fkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'spyProductDiscontinuedStorage.fkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'SpyProductDiscontinuedStorageTableMap::COL_FK_PRODUCT_DISCONTINUED' => 'FK_PRODUCT_DISCONTINUED',
        'COL_FK_PRODUCT_DISCONTINUED' => 'FK_PRODUCT_DISCONTINUED',
        'fk_product_discontinued' => 'FK_PRODUCT_DISCONTINUED',
        'spy_product_discontinued_storage.fk_product_discontinued' => 'FK_PRODUCT_DISCONTINUED',
        'Data' => 'DATA',
        'SpyProductDiscontinuedStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyProductDiscontinuedStorage.data' => 'DATA',
        'SpyProductDiscontinuedStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_product_discontinued_storage.data' => 'DATA',
        'Key' => 'KEY',
        'SpyProductDiscontinuedStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductDiscontinuedStorage.key' => 'KEY',
        'SpyProductDiscontinuedStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_discontinued_storage.key' => 'KEY',
        'Locale' => 'LOCALE',
        'SpyProductDiscontinuedStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyProductDiscontinuedStorage.locale' => 'LOCALE',
        'SpyProductDiscontinuedStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_product_discontinued_storage.locale' => 'LOCALE',
        'Sku' => 'SKU',
        'SpyProductDiscontinuedStorage.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyProductDiscontinuedStorage.sku' => 'SKU',
        'SpyProductDiscontinuedStorageTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_product_discontinued_storage.sku' => 'SKU',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyProductDiscontinuedStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyProductDiscontinuedStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyProductDiscontinuedStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_product_discontinued_storage.alias_keys' => 'ALIAS_KEYS',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductDiscontinuedStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductDiscontinuedStorage.createdAt' => 'CREATED_AT',
        'SpyProductDiscontinuedStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_discontinued_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductDiscontinuedStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductDiscontinuedStorage.updatedAt' => 'UPDATED_AT',
        'SpyProductDiscontinuedStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_discontinued_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_discontinued_storage');
        $this->setPhpName('SpyProductDiscontinuedStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductDiscontinuedStorage\\Persistence\\SpyProductDiscontinuedStorage');
        $this->setPackage('src.Orm.Zed.ProductDiscontinuedStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_discontinued_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_discontinued_storage', 'IdProductDiscontinuedStorage', 'INTEGER', true, null, null);
        $this->addColumn('fk_product_discontinued', 'FkProductDiscontinued', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('locale', 'Locale', 'VARCHAR', true, 5, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'product_discontinued'], 'queue_group' => ['value' => 'sync.storage.product'], 'queue_pool' => ['value' => 'synchronizationPool'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'sku']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductDiscontinuedStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductDiscontinuedStorageTableMap::CLASS_DEFAULT : SpyProductDiscontinuedStorageTableMap::OM_CLASS;
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
     * @return array (SpyProductDiscontinuedStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductDiscontinuedStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductDiscontinuedStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductDiscontinuedStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductDiscontinuedStorageTableMap::OM_CLASS;
            /** @var SpyProductDiscontinuedStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductDiscontinuedStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductDiscontinuedStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductDiscontinuedStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductDiscontinuedStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductDiscontinuedStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_FK_PRODUCT_DISCONTINUED);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_SKU);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_discontinued_storage');
            $criteria->addSelectColumn($alias . '.fk_product_discontinued');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.locale');
            $criteria->addSelectColumn($alias . '.sku');
            $criteria->addSelectColumn($alias . '.alias_keys');
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
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_FK_PRODUCT_DISCONTINUED);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductDiscontinuedStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_discontinued_storage');
            $criteria->removeSelectColumn($alias . '.fk_product_discontinued');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.locale');
            $criteria->removeSelectColumn($alias . '.sku');
            $criteria->removeSelectColumn($alias . '.alias_keys');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductDiscontinuedStorageTableMap::DATABASE_NAME)->getTable(SpyProductDiscontinuedStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductDiscontinuedStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductDiscontinuedStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductDiscontinuedStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductDiscontinuedStorage\Persistence\SpyProductDiscontinuedStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductDiscontinuedStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyProductDiscontinuedStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductDiscontinuedStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductDiscontinuedStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_discontinued_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductDiscontinuedStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductDiscontinuedStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductDiscontinuedStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductDiscontinuedStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductDiscontinuedStorage object
        }

        if ($criteria->containsKey(SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE) && $criteria->keyContainsValue(SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductDiscontinuedStorageTableMap::COL_ID_PRODUCT_DISCONTINUED_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyProductDiscontinuedStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
