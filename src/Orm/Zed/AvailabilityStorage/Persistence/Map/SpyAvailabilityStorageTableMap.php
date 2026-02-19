<?php

namespace Orm\Zed\AvailabilityStorage\Persistence\Map;

use Orm\Zed\AvailabilityStorage\Persistence\SpyAvailabilityStorage;
use Orm\Zed\AvailabilityStorage\Persistence\SpyAvailabilityStorageQuery;
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
 * This class defines the structure of the 'spy_availability_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAvailabilityStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.AvailabilityStorage.Persistence.Map.SpyAvailabilityStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_availability_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAvailabilityStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\AvailabilityStorage\\Persistence\\SpyAvailabilityStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.AvailabilityStorage.Persistence.SpyAvailabilityStorage';

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
     * the column name for the id_availability_storage field
     */
    public const COL_ID_AVAILABILITY_STORAGE = 'spy_availability_storage.id_availability_storage';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_availability_storage.fk_product_abstract';

    /**
     * the column name for the fk_availability_abstract field
     */
    public const COL_FK_AVAILABILITY_ABSTRACT = 'spy_availability_storage.fk_availability_abstract';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_availability_storage.data';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_availability_storage.store';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_availability_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_availability_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_availability_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_availability_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdAvailabilityStorage', 'FkProductAbstract', 'FkAvailabilityAbstract', 'Data', 'Store', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idAvailabilityStorage', 'fkProductAbstract', 'fkAvailabilityAbstract', 'data', 'store', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE, SpyAvailabilityStorageTableMap::COL_FK_PRODUCT_ABSTRACT, SpyAvailabilityStorageTableMap::COL_FK_AVAILABILITY_ABSTRACT, SpyAvailabilityStorageTableMap::COL_DATA, SpyAvailabilityStorageTableMap::COL_STORE, SpyAvailabilityStorageTableMap::COL_ALIAS_KEYS, SpyAvailabilityStorageTableMap::COL_KEY, SpyAvailabilityStorageTableMap::COL_CREATED_AT, SpyAvailabilityStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_availability_storage', 'fk_product_abstract', 'fk_availability_abstract', 'data', 'store', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdAvailabilityStorage' => 0, 'FkProductAbstract' => 1, 'FkAvailabilityAbstract' => 2, 'Data' => 3, 'Store' => 4, 'AliasKeys' => 5, 'Key' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idAvailabilityStorage' => 0, 'fkProductAbstract' => 1, 'fkAvailabilityAbstract' => 2, 'data' => 3, 'store' => 4, 'aliasKeys' => 5, 'key' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE => 0, SpyAvailabilityStorageTableMap::COL_FK_PRODUCT_ABSTRACT => 1, SpyAvailabilityStorageTableMap::COL_FK_AVAILABILITY_ABSTRACT => 2, SpyAvailabilityStorageTableMap::COL_DATA => 3, SpyAvailabilityStorageTableMap::COL_STORE => 4, SpyAvailabilityStorageTableMap::COL_ALIAS_KEYS => 5, SpyAvailabilityStorageTableMap::COL_KEY => 6, SpyAvailabilityStorageTableMap::COL_CREATED_AT => 7, SpyAvailabilityStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_availability_storage' => 0, 'fk_product_abstract' => 1, 'fk_availability_abstract' => 2, 'data' => 3, 'store' => 4, 'alias_keys' => 5, 'key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAvailabilityStorage' => 'ID_AVAILABILITY_STORAGE',
        'SpyAvailabilityStorage.IdAvailabilityStorage' => 'ID_AVAILABILITY_STORAGE',
        'idAvailabilityStorage' => 'ID_AVAILABILITY_STORAGE',
        'spyAvailabilityStorage.idAvailabilityStorage' => 'ID_AVAILABILITY_STORAGE',
        'SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE' => 'ID_AVAILABILITY_STORAGE',
        'COL_ID_AVAILABILITY_STORAGE' => 'ID_AVAILABILITY_STORAGE',
        'id_availability_storage' => 'ID_AVAILABILITY_STORAGE',
        'spy_availability_storage.id_availability_storage' => 'ID_AVAILABILITY_STORAGE',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyAvailabilityStorage.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyAvailabilityStorage.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyAvailabilityStorageTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_availability_storage.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'SpyAvailabilityStorage.FkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'fkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'spyAvailabilityStorage.fkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'SpyAvailabilityStorageTableMap::COL_FK_AVAILABILITY_ABSTRACT' => 'FK_AVAILABILITY_ABSTRACT',
        'COL_FK_AVAILABILITY_ABSTRACT' => 'FK_AVAILABILITY_ABSTRACT',
        'fk_availability_abstract' => 'FK_AVAILABILITY_ABSTRACT',
        'spy_availability_storage.fk_availability_abstract' => 'FK_AVAILABILITY_ABSTRACT',
        'Data' => 'DATA',
        'SpyAvailabilityStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyAvailabilityStorage.data' => 'DATA',
        'SpyAvailabilityStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_availability_storage.data' => 'DATA',
        'Store' => 'STORE',
        'SpyAvailabilityStorage.Store' => 'STORE',
        'store' => 'STORE',
        'spyAvailabilityStorage.store' => 'STORE',
        'SpyAvailabilityStorageTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_availability_storage.store' => 'STORE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyAvailabilityStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyAvailabilityStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyAvailabilityStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_availability_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyAvailabilityStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyAvailabilityStorage.key' => 'KEY',
        'SpyAvailabilityStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_availability_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyAvailabilityStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyAvailabilityStorage.createdAt' => 'CREATED_AT',
        'SpyAvailabilityStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_availability_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyAvailabilityStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyAvailabilityStorage.updatedAt' => 'UPDATED_AT',
        'SpyAvailabilityStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_availability_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_availability_storage');
        $this->setPhpName('SpyAvailabilityStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\AvailabilityStorage\\Persistence\\SpyAvailabilityStorage');
        $this->setPackage('src.Orm.Zed.AvailabilityStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_availability_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_availability_storage', 'IdAvailabilityStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_product_abstract', 'FkProductAbstract', 'INTEGER', true, null, null);
        $this->addColumn('fk_availability_abstract', 'FkAvailabilityAbstract', 'INTEGER', true, null, null);
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
            'synchronization' => ['resource' => ['value' => 'availability'], 'queue_group' => ['value' => 'sync.storage.availability'], 'queue_pool' => NULL, 'store' => ['required' => 'false'], 'key_suffix_column' => ['value' => 'fk_product_abstract']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAvailabilityStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAvailabilityStorageTableMap::CLASS_DEFAULT : SpyAvailabilityStorageTableMap::OM_CLASS;
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
     * @return array (SpyAvailabilityStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAvailabilityStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAvailabilityStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAvailabilityStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAvailabilityStorageTableMap::OM_CLASS;
            /** @var SpyAvailabilityStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAvailabilityStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAvailabilityStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAvailabilityStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAvailabilityStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAvailabilityStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_FK_AVAILABILITY_ABSTRACT);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyAvailabilityStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_availability_storage');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_availability_abstract');
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
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_FK_AVAILABILITY_ABSTRACT);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyAvailabilityStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_availability_storage');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_availability_abstract');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAvailabilityStorageTableMap::DATABASE_NAME)->getTable(SpyAvailabilityStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAvailabilityStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAvailabilityStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAvailabilityStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\AvailabilityStorage\Persistence\SpyAvailabilityStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAvailabilityStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyAvailabilityStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAvailabilityStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAvailabilityStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_availability_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAvailabilityStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAvailabilityStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAvailabilityStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAvailabilityStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAvailabilityStorage object
        }

        if ($criteria->containsKey(SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE) && $criteria->keyContainsValue(SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAvailabilityStorageTableMap::COL_ID_AVAILABILITY_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyAvailabilityStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
