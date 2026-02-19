<?php

namespace Orm\Zed\PriceProductStorage\Persistence\Map;

use Orm\Zed\PriceProductStorage\Persistence\SpyPriceProductConcreteStorage;
use Orm\Zed\PriceProductStorage\Persistence\SpyPriceProductConcreteStorageQuery;
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
 * This class defines the structure of the 'spy_price_product_concrete_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductConcreteStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductStorage.Persistence.Map.SpyPriceProductConcreteStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_concrete_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductConcreteStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductStorage\\Persistence\\SpyPriceProductConcreteStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductStorage.Persistence.SpyPriceProductConcreteStorage';

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
     * the column name for the id_price_product_concrete_storage field
     */
    public const COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE = 'spy_price_product_concrete_storage.id_price_product_concrete_storage';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_price_product_concrete_storage.fk_product';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_price_product_concrete_storage.data';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_price_product_concrete_storage.store';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_price_product_concrete_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_price_product_concrete_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_price_product_concrete_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_price_product_concrete_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPriceProductConcreteStorage', 'FkProduct', 'Data', 'Store', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPriceProductConcreteStorage', 'fkProduct', 'data', 'store', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE, SpyPriceProductConcreteStorageTableMap::COL_FK_PRODUCT, SpyPriceProductConcreteStorageTableMap::COL_DATA, SpyPriceProductConcreteStorageTableMap::COL_STORE, SpyPriceProductConcreteStorageTableMap::COL_ALIAS_KEYS, SpyPriceProductConcreteStorageTableMap::COL_KEY, SpyPriceProductConcreteStorageTableMap::COL_CREATED_AT, SpyPriceProductConcreteStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_price_product_concrete_storage', 'fk_product', 'data', 'store', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductConcreteStorage' => 0, 'FkProduct' => 1, 'Data' => 2, 'Store' => 3, 'AliasKeys' => 4, 'Key' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idPriceProductConcreteStorage' => 0, 'fkProduct' => 1, 'data' => 2, 'store' => 3, 'aliasKeys' => 4, 'key' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE => 0, SpyPriceProductConcreteStorageTableMap::COL_FK_PRODUCT => 1, SpyPriceProductConcreteStorageTableMap::COL_DATA => 2, SpyPriceProductConcreteStorageTableMap::COL_STORE => 3, SpyPriceProductConcreteStorageTableMap::COL_ALIAS_KEYS => 4, SpyPriceProductConcreteStorageTableMap::COL_KEY => 5, SpyPriceProductConcreteStorageTableMap::COL_CREATED_AT => 6, SpyPriceProductConcreteStorageTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_price_product_concrete_storage' => 0, 'fk_product' => 1, 'data' => 2, 'store' => 3, 'alias_keys' => 4, 'key' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductConcreteStorage' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'SpyPriceProductConcreteStorage.IdPriceProductConcreteStorage' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'idPriceProductConcreteStorage' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'spyPriceProductConcreteStorage.idPriceProductConcreteStorage' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'id_price_product_concrete_storage' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'spy_price_product_concrete_storage.id_price_product_concrete_storage' => 'ID_PRICE_PRODUCT_CONCRETE_STORAGE',
        'FkProduct' => 'FK_PRODUCT',
        'SpyPriceProductConcreteStorage.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyPriceProductConcreteStorage.fkProduct' => 'FK_PRODUCT',
        'SpyPriceProductConcreteStorageTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_price_product_concrete_storage.fk_product' => 'FK_PRODUCT',
        'Data' => 'DATA',
        'SpyPriceProductConcreteStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyPriceProductConcreteStorage.data' => 'DATA',
        'SpyPriceProductConcreteStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_price_product_concrete_storage.data' => 'DATA',
        'Store' => 'STORE',
        'SpyPriceProductConcreteStorage.Store' => 'STORE',
        'store' => 'STORE',
        'spyPriceProductConcreteStorage.store' => 'STORE',
        'SpyPriceProductConcreteStorageTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_price_product_concrete_storage.store' => 'STORE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyPriceProductConcreteStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyPriceProductConcreteStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyPriceProductConcreteStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_price_product_concrete_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyPriceProductConcreteStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyPriceProductConcreteStorage.key' => 'KEY',
        'SpyPriceProductConcreteStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_price_product_concrete_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyPriceProductConcreteStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPriceProductConcreteStorage.createdAt' => 'CREATED_AT',
        'SpyPriceProductConcreteStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_price_product_concrete_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPriceProductConcreteStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPriceProductConcreteStorage.updatedAt' => 'UPDATED_AT',
        'SpyPriceProductConcreteStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_price_product_concrete_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_price_product_concrete_storage');
        $this->setPhpName('SpyPriceProductConcreteStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\PriceProductStorage\\Persistence\\SpyPriceProductConcreteStorage');
        $this->setPackage('src.Orm.Zed.PriceProductStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_concrete_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_concrete_storage', 'IdPriceProductConcreteStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_product', 'FkProduct', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('store', 'Store', 'VARCHAR', false, 128, null);
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
            'synchronization' => ['resource' => ['value' => 'price_product_concrete'], 'queue_group' => ['value' => 'sync.storage.price'], 'queue_pool' => NULL, 'store' => ['required' => 'false'], 'key_suffix_column' => ['value' => 'fk_product']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductConcreteStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductConcreteStorageTableMap::CLASS_DEFAULT : SpyPriceProductConcreteStorageTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductConcreteStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductConcreteStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductConcreteStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductConcreteStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductConcreteStorageTableMap::OM_CLASS;
            /** @var SpyPriceProductConcreteStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductConcreteStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductConcreteStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductConcreteStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductConcreteStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductConcreteStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_concrete_storage');
            $criteria->addSelectColumn($alias . '.fk_product');
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
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPriceProductConcreteStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_concrete_storage');
            $criteria->removeSelectColumn($alias . '.fk_product');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductConcreteStorageTableMap::DATABASE_NAME)->getTable(SpyPriceProductConcreteStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductConcreteStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductConcreteStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductConcreteStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductStorage\Persistence\SpyPriceProductConcreteStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductConcreteStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductConcreteStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductConcreteStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductConcreteStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_concrete_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductConcreteStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductConcreteStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductConcreteStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductConcreteStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductConcreteStorage object
        }

        if ($criteria->containsKey(SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE) && $criteria->keyContainsValue(SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductConcreteStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductConcreteStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
