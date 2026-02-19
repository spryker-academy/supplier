<?php

namespace Orm\Zed\UrlStorage\Persistence\Map;

use Orm\Zed\UrlStorage\Persistence\SpyUrlRedirectStorage;
use Orm\Zed\UrlStorage\Persistence\SpyUrlRedirectStorageQuery;
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
 * This class defines the structure of the 'spy_url_redirect_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyUrlRedirectStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.UrlStorage.Persistence.Map.SpyUrlRedirectStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_url_redirect_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyUrlRedirectStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\UrlStorage\\Persistence\\SpyUrlRedirectStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.UrlStorage.Persistence.SpyUrlRedirectStorage';

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
     * the column name for the id_url_redirect_storage field
     */
    public const COL_ID_URL_REDIRECT_STORAGE = 'spy_url_redirect_storage.id_url_redirect_storage';

    /**
     * the column name for the fk_url_redirect field
     */
    public const COL_FK_URL_REDIRECT = 'spy_url_redirect_storage.fk_url_redirect';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_url_redirect_storage.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_url_redirect_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_url_redirect_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_url_redirect_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_url_redirect_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdUrlRedirectStorage', 'FkUrlRedirect', 'Data', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idUrlRedirectStorage', 'fkUrlRedirect', 'data', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE, SpyUrlRedirectStorageTableMap::COL_FK_URL_REDIRECT, SpyUrlRedirectStorageTableMap::COL_DATA, SpyUrlRedirectStorageTableMap::COL_ALIAS_KEYS, SpyUrlRedirectStorageTableMap::COL_KEY, SpyUrlRedirectStorageTableMap::COL_CREATED_AT, SpyUrlRedirectStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_url_redirect_storage', 'fk_url_redirect', 'data', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdUrlRedirectStorage' => 0, 'FkUrlRedirect' => 1, 'Data' => 2, 'AliasKeys' => 3, 'Key' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idUrlRedirectStorage' => 0, 'fkUrlRedirect' => 1, 'data' => 2, 'aliasKeys' => 3, 'key' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE => 0, SpyUrlRedirectStorageTableMap::COL_FK_URL_REDIRECT => 1, SpyUrlRedirectStorageTableMap::COL_DATA => 2, SpyUrlRedirectStorageTableMap::COL_ALIAS_KEYS => 3, SpyUrlRedirectStorageTableMap::COL_KEY => 4, SpyUrlRedirectStorageTableMap::COL_CREATED_AT => 5, SpyUrlRedirectStorageTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_url_redirect_storage' => 0, 'fk_url_redirect' => 1, 'data' => 2, 'alias_keys' => 3, 'key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdUrlRedirectStorage' => 'ID_URL_REDIRECT_STORAGE',
        'SpyUrlRedirectStorage.IdUrlRedirectStorage' => 'ID_URL_REDIRECT_STORAGE',
        'idUrlRedirectStorage' => 'ID_URL_REDIRECT_STORAGE',
        'spyUrlRedirectStorage.idUrlRedirectStorage' => 'ID_URL_REDIRECT_STORAGE',
        'SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE' => 'ID_URL_REDIRECT_STORAGE',
        'COL_ID_URL_REDIRECT_STORAGE' => 'ID_URL_REDIRECT_STORAGE',
        'id_url_redirect_storage' => 'ID_URL_REDIRECT_STORAGE',
        'spy_url_redirect_storage.id_url_redirect_storage' => 'ID_URL_REDIRECT_STORAGE',
        'FkUrlRedirect' => 'FK_URL_REDIRECT',
        'SpyUrlRedirectStorage.FkUrlRedirect' => 'FK_URL_REDIRECT',
        'fkUrlRedirect' => 'FK_URL_REDIRECT',
        'spyUrlRedirectStorage.fkUrlRedirect' => 'FK_URL_REDIRECT',
        'SpyUrlRedirectStorageTableMap::COL_FK_URL_REDIRECT' => 'FK_URL_REDIRECT',
        'COL_FK_URL_REDIRECT' => 'FK_URL_REDIRECT',
        'fk_url_redirect' => 'FK_URL_REDIRECT',
        'spy_url_redirect_storage.fk_url_redirect' => 'FK_URL_REDIRECT',
        'Data' => 'DATA',
        'SpyUrlRedirectStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyUrlRedirectStorage.data' => 'DATA',
        'SpyUrlRedirectStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_url_redirect_storage.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyUrlRedirectStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyUrlRedirectStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyUrlRedirectStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_url_redirect_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyUrlRedirectStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyUrlRedirectStorage.key' => 'KEY',
        'SpyUrlRedirectStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_url_redirect_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyUrlRedirectStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyUrlRedirectStorage.createdAt' => 'CREATED_AT',
        'SpyUrlRedirectStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_url_redirect_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyUrlRedirectStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyUrlRedirectStorage.updatedAt' => 'UPDATED_AT',
        'SpyUrlRedirectStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_url_redirect_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_url_redirect_storage');
        $this->setPhpName('SpyUrlRedirectStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\UrlStorage\\Persistence\\SpyUrlRedirectStorage');
        $this->setPackage('src.Orm.Zed.UrlStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_url_redirect_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_url_redirect_storage', 'IdUrlRedirectStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_url_redirect', 'FkUrlRedirect', 'INTEGER', true, null, null);
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
            'synchronization' => ['resource' => ['value' => 'redirect'], 'queue_group' => ['value' => 'sync.storage.url'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'fk_url_redirect']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdUrlRedirectStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyUrlRedirectStorageTableMap::CLASS_DEFAULT : SpyUrlRedirectStorageTableMap::OM_CLASS;
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
     * @return array (SpyUrlRedirectStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyUrlRedirectStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyUrlRedirectStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyUrlRedirectStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyUrlRedirectStorageTableMap::OM_CLASS;
            /** @var SpyUrlRedirectStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyUrlRedirectStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyUrlRedirectStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyUrlRedirectStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyUrlRedirectStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyUrlRedirectStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE);
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_FK_URL_REDIRECT);
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyUrlRedirectStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_url_redirect_storage');
            $criteria->addSelectColumn($alias . '.fk_url_redirect');
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
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE);
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_FK_URL_REDIRECT);
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyUrlRedirectStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_url_redirect_storage');
            $criteria->removeSelectColumn($alias . '.fk_url_redirect');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyUrlRedirectStorageTableMap::DATABASE_NAME)->getTable(SpyUrlRedirectStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyUrlRedirectStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyUrlRedirectStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUrlRedirectStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\UrlStorage\Persistence\SpyUrlRedirectStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyUrlRedirectStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyUrlRedirectStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyUrlRedirectStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyUrlRedirectStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_url_redirect_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyUrlRedirectStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyUrlRedirectStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyUrlRedirectStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUrlRedirectStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyUrlRedirectStorage object
        }

        if ($criteria->containsKey(SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE) && $criteria->keyContainsValue(SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyUrlRedirectStorageTableMap::COL_ID_URL_REDIRECT_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyUrlRedirectStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
