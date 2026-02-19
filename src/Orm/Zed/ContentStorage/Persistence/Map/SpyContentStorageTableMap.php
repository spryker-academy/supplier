<?php

namespace Orm\Zed\ContentStorage\Persistence\Map;

use Orm\Zed\ContentStorage\Persistence\SpyContentStorage;
use Orm\Zed\ContentStorage\Persistence\SpyContentStorageQuery;
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
 * This class defines the structure of the 'spy_content_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyContentStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ContentStorage.Persistence.Map.SpyContentStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_content_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyContentStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ContentStorage\\Persistence\\SpyContentStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ContentStorage.Persistence.SpyContentStorage';

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
     * the column name for the id_content_storage field
     */
    public const COL_ID_CONTENT_STORAGE = 'spy_content_storage.id_content_storage';

    /**
     * the column name for the fk_content field
     */
    public const COL_FK_CONTENT = 'spy_content_storage.fk_content';

    /**
     * the column name for the content_key field
     */
    public const COL_CONTENT_KEY = 'spy_content_storage.content_key';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_content_storage.data';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_content_storage.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_content_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_content_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_content_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_content_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdContentStorage', 'FkContent', 'ContentKey', 'Data', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idContentStorage', 'fkContent', 'contentKey', 'data', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE, SpyContentStorageTableMap::COL_FK_CONTENT, SpyContentStorageTableMap::COL_CONTENT_KEY, SpyContentStorageTableMap::COL_DATA, SpyContentStorageTableMap::COL_LOCALE, SpyContentStorageTableMap::COL_ALIAS_KEYS, SpyContentStorageTableMap::COL_KEY, SpyContentStorageTableMap::COL_CREATED_AT, SpyContentStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_content_storage', 'fk_content', 'content_key', 'data', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdContentStorage' => 0, 'FkContent' => 1, 'ContentKey' => 2, 'Data' => 3, 'Locale' => 4, 'AliasKeys' => 5, 'Key' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idContentStorage' => 0, 'fkContent' => 1, 'contentKey' => 2, 'data' => 3, 'locale' => 4, 'aliasKeys' => 5, 'key' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE => 0, SpyContentStorageTableMap::COL_FK_CONTENT => 1, SpyContentStorageTableMap::COL_CONTENT_KEY => 2, SpyContentStorageTableMap::COL_DATA => 3, SpyContentStorageTableMap::COL_LOCALE => 4, SpyContentStorageTableMap::COL_ALIAS_KEYS => 5, SpyContentStorageTableMap::COL_KEY => 6, SpyContentStorageTableMap::COL_CREATED_AT => 7, SpyContentStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_content_storage' => 0, 'fk_content' => 1, 'content_key' => 2, 'data' => 3, 'locale' => 4, 'alias_keys' => 5, 'key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdContentStorage' => 'ID_CONTENT_STORAGE',
        'SpyContentStorage.IdContentStorage' => 'ID_CONTENT_STORAGE',
        'idContentStorage' => 'ID_CONTENT_STORAGE',
        'spyContentStorage.idContentStorage' => 'ID_CONTENT_STORAGE',
        'SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE' => 'ID_CONTENT_STORAGE',
        'COL_ID_CONTENT_STORAGE' => 'ID_CONTENT_STORAGE',
        'id_content_storage' => 'ID_CONTENT_STORAGE',
        'spy_content_storage.id_content_storage' => 'ID_CONTENT_STORAGE',
        'FkContent' => 'FK_CONTENT',
        'SpyContentStorage.FkContent' => 'FK_CONTENT',
        'fkContent' => 'FK_CONTENT',
        'spyContentStorage.fkContent' => 'FK_CONTENT',
        'SpyContentStorageTableMap::COL_FK_CONTENT' => 'FK_CONTENT',
        'COL_FK_CONTENT' => 'FK_CONTENT',
        'fk_content' => 'FK_CONTENT',
        'spy_content_storage.fk_content' => 'FK_CONTENT',
        'ContentKey' => 'CONTENT_KEY',
        'SpyContentStorage.ContentKey' => 'CONTENT_KEY',
        'contentKey' => 'CONTENT_KEY',
        'spyContentStorage.contentKey' => 'CONTENT_KEY',
        'SpyContentStorageTableMap::COL_CONTENT_KEY' => 'CONTENT_KEY',
        'COL_CONTENT_KEY' => 'CONTENT_KEY',
        'content_key' => 'CONTENT_KEY',
        'spy_content_storage.content_key' => 'CONTENT_KEY',
        'Data' => 'DATA',
        'SpyContentStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyContentStorage.data' => 'DATA',
        'SpyContentStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_content_storage.data' => 'DATA',
        'Locale' => 'LOCALE',
        'SpyContentStorage.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyContentStorage.locale' => 'LOCALE',
        'SpyContentStorageTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_content_storage.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyContentStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyContentStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyContentStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_content_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyContentStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyContentStorage.key' => 'KEY',
        'SpyContentStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_content_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyContentStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyContentStorage.createdAt' => 'CREATED_AT',
        'SpyContentStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_content_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyContentStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyContentStorage.updatedAt' => 'UPDATED_AT',
        'SpyContentStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_content_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_content_storage');
        $this->setPhpName('SpyContentStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ContentStorage\\Persistence\\SpyContentStorage');
        $this->setPackage('src.Orm.Zed.ContentStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_content_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_content_storage', 'IdContentStorage', 'INTEGER', true, null, null);
        $this->addColumn('fk_content', 'FkContent', 'INTEGER', true, null, null);
        $this->addColumn('content_key', 'ContentKey', 'VARCHAR', true, 255, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('locale', 'Locale', 'VARCHAR', true, 16, null);
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
            'synchronization' => ['resource' => ['value' => 'content'], 'queue_group' => ['value' => 'sync.storage.content'], 'queue_pool' => ['value' => 'synchronizationPool'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'content_key']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdContentStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyContentStorageTableMap::CLASS_DEFAULT : SpyContentStorageTableMap::OM_CLASS;
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
     * @return array (SpyContentStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyContentStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyContentStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyContentStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyContentStorageTableMap::OM_CLASS;
            /** @var SpyContentStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyContentStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyContentStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyContentStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyContentStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyContentStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_FK_CONTENT);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_CONTENT_KEY);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyContentStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_content_storage');
            $criteria->addSelectColumn($alias . '.fk_content');
            $criteria->addSelectColumn($alias . '.content_key');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.locale');
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
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_FK_CONTENT);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_CONTENT_KEY);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyContentStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_content_storage');
            $criteria->removeSelectColumn($alias . '.fk_content');
            $criteria->removeSelectColumn($alias . '.content_key');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.locale');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyContentStorageTableMap::DATABASE_NAME)->getTable(SpyContentStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyContentStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyContentStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyContentStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ContentStorage\Persistence\SpyContentStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyContentStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyContentStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyContentStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyContentStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_content_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyContentStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyContentStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyContentStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyContentStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyContentStorage object
        }

        if ($criteria->containsKey(SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE) && $criteria->keyContainsValue(SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyContentStorageTableMap::COL_ID_CONTENT_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyContentStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
