<?php

namespace Orm\Zed\OauthClient\Persistence\Map;

use Orm\Zed\OauthClient\Persistence\SpyOauthClientAccessTokenCache;
use Orm\Zed\OauthClient\Persistence\SpyOauthClientAccessTokenCacheQuery;
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
 * This class defines the structure of the 'spy_oauth_client_access_token_cache' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOauthClientAccessTokenCacheTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.OauthClient.Persistence.Map.SpyOauthClientAccessTokenCacheTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oauth_client_access_token_cache';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOauthClientAccessTokenCache';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\OauthClient\\Persistence\\SpyOauthClientAccessTokenCache';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.OauthClient.Persistence.SpyOauthClientAccessTokenCache';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_spy_oauth_client_access_token_cache field
     */
    public const COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE = 'spy_oauth_client_access_token_cache.id_spy_oauth_client_access_token_cache';

    /**
     * the column name for the cache_key field
     */
    public const COL_CACHE_KEY = 'spy_oauth_client_access_token_cache.cache_key';

    /**
     * the column name for the access_token field
     */
    public const COL_ACCESS_TOKEN = 'spy_oauth_client_access_token_cache.access_token';

    /**
     * the column name for the expires_at field
     */
    public const COL_EXPIRES_AT = 'spy_oauth_client_access_token_cache.expires_at';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oauth_client_access_token_cache.created_at';

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
        self::TYPE_PHPNAME       => ['IdSpyOauthClientAccessTokenCache', 'CacheKey', 'AccessToken', 'ExpiresAt', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['idSpyOauthClientAccessTokenCache', 'cacheKey', 'accessToken', 'expiresAt', 'createdAt', ],
        self::TYPE_COLNAME       => [SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, SpyOauthClientAccessTokenCacheTableMap::COL_CACHE_KEY, SpyOauthClientAccessTokenCacheTableMap::COL_ACCESS_TOKEN, SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT, SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_spy_oauth_client_access_token_cache', 'cache_key', 'access_token', 'expires_at', 'created_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['IdSpyOauthClientAccessTokenCache' => 0, 'CacheKey' => 1, 'AccessToken' => 2, 'ExpiresAt' => 3, 'CreatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idSpyOauthClientAccessTokenCache' => 0, 'cacheKey' => 1, 'accessToken' => 2, 'expiresAt' => 3, 'createdAt' => 4, ],
        self::TYPE_COLNAME       => [SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE => 0, SpyOauthClientAccessTokenCacheTableMap::COL_CACHE_KEY => 1, SpyOauthClientAccessTokenCacheTableMap::COL_ACCESS_TOKEN => 2, SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT => 3, SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_spy_oauth_client_access_token_cache' => 0, 'cache_key' => 1, 'access_token' => 2, 'expires_at' => 3, 'created_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSpyOauthClientAccessTokenCache' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'SpyOauthClientAccessTokenCache.IdSpyOauthClientAccessTokenCache' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'idSpyOauthClientAccessTokenCache' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'spyOauthClientAccessTokenCache.idSpyOauthClientAccessTokenCache' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'id_spy_oauth_client_access_token_cache' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'spy_oauth_client_access_token_cache.id_spy_oauth_client_access_token_cache' => 'ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE',
        'CacheKey' => 'CACHE_KEY',
        'SpyOauthClientAccessTokenCache.CacheKey' => 'CACHE_KEY',
        'cacheKey' => 'CACHE_KEY',
        'spyOauthClientAccessTokenCache.cacheKey' => 'CACHE_KEY',
        'SpyOauthClientAccessTokenCacheTableMap::COL_CACHE_KEY' => 'CACHE_KEY',
        'COL_CACHE_KEY' => 'CACHE_KEY',
        'cache_key' => 'CACHE_KEY',
        'spy_oauth_client_access_token_cache.cache_key' => 'CACHE_KEY',
        'AccessToken' => 'ACCESS_TOKEN',
        'SpyOauthClientAccessTokenCache.AccessToken' => 'ACCESS_TOKEN',
        'accessToken' => 'ACCESS_TOKEN',
        'spyOauthClientAccessTokenCache.accessToken' => 'ACCESS_TOKEN',
        'SpyOauthClientAccessTokenCacheTableMap::COL_ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'COL_ACCESS_TOKEN' => 'ACCESS_TOKEN',
        'access_token' => 'ACCESS_TOKEN',
        'spy_oauth_client_access_token_cache.access_token' => 'ACCESS_TOKEN',
        'ExpiresAt' => 'EXPIRES_AT',
        'SpyOauthClientAccessTokenCache.ExpiresAt' => 'EXPIRES_AT',
        'expiresAt' => 'EXPIRES_AT',
        'spyOauthClientAccessTokenCache.expiresAt' => 'EXPIRES_AT',
        'SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT' => 'EXPIRES_AT',
        'COL_EXPIRES_AT' => 'EXPIRES_AT',
        'expires_at' => 'EXPIRES_AT',
        'spy_oauth_client_access_token_cache.expires_at' => 'EXPIRES_AT',
        'CreatedAt' => 'CREATED_AT',
        'SpyOauthClientAccessTokenCache.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOauthClientAccessTokenCache.createdAt' => 'CREATED_AT',
        'SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oauth_client_access_token_cache.created_at' => 'CREATED_AT',
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
        $this->setName('spy_oauth_client_access_token_cache');
        $this->setPhpName('SpyOauthClientAccessTokenCache');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\OauthClient\\Persistence\\SpyOauthClientAccessTokenCache');
        $this->setPackage('src.Orm.Zed.OauthClient.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oauth_client_access_token_cache_pk_seq');
        // columns
        $this->addPrimaryKey('id_spy_oauth_client_access_token_cache', 'IdSpyOauthClientAccessTokenCache', 'INTEGER', true, null, null);
        $this->addColumn('cache_key', 'CacheKey', 'VARCHAR', true, 50, null);
        $this->addColumn('access_token', 'AccessToken', 'LONGVARCHAR', true, null, null);
        $this->addColumn('expires_at', 'ExpiresAt', 'TIMESTAMP', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
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
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'true', 'is_timestamp' => 'true'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSpyOauthClientAccessTokenCache', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOauthClientAccessTokenCacheTableMap::CLASS_DEFAULT : SpyOauthClientAccessTokenCacheTableMap::OM_CLASS;
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
     * @return array (SpyOauthClientAccessTokenCache object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOauthClientAccessTokenCacheTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOauthClientAccessTokenCacheTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOauthClientAccessTokenCacheTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOauthClientAccessTokenCacheTableMap::OM_CLASS;
            /** @var SpyOauthClientAccessTokenCache $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOauthClientAccessTokenCacheTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOauthClientAccessTokenCacheTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOauthClientAccessTokenCacheTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOauthClientAccessTokenCache $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOauthClientAccessTokenCacheTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE);
            $criteria->addSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_CACHE_KEY);
            $criteria->addSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_ACCESS_TOKEN);
            $criteria->addSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT);
            $criteria->addSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_spy_oauth_client_access_token_cache');
            $criteria->addSelectColumn($alias . '.cache_key');
            $criteria->addSelectColumn($alias . '.access_token');
            $criteria->addSelectColumn($alias . '.expires_at');
            $criteria->addSelectColumn($alias . '.created_at');
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
            $criteria->removeSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE);
            $criteria->removeSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_CACHE_KEY);
            $criteria->removeSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_ACCESS_TOKEN);
            $criteria->removeSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_EXPIRES_AT);
            $criteria->removeSelectColumn(SpyOauthClientAccessTokenCacheTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_spy_oauth_client_access_token_cache');
            $criteria->removeSelectColumn($alias . '.cache_key');
            $criteria->removeSelectColumn($alias . '.access_token');
            $criteria->removeSelectColumn($alias . '.expires_at');
            $criteria->removeSelectColumn($alias . '.created_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME)->getTable(SpyOauthClientAccessTokenCacheTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOauthClientAccessTokenCache or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOauthClientAccessTokenCache object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\OauthClient\Persistence\SpyOauthClientAccessTokenCache) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME);
            $criteria->add(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE, (array) $values, Criteria::IN);
        }

        $query = SpyOauthClientAccessTokenCacheQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOauthClientAccessTokenCacheTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOauthClientAccessTokenCacheTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oauth_client_access_token_cache table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOauthClientAccessTokenCacheQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOauthClientAccessTokenCache or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOauthClientAccessTokenCache object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientAccessTokenCacheTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOauthClientAccessTokenCache object
        }

        if ($criteria->containsKey(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE) && $criteria->keyContainsValue(SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOauthClientAccessTokenCacheTableMap::COL_ID_SPY_OAUTH_CLIENT_ACCESS_TOKEN_CACHE.')');
        }


        // Set the correct dbName
        $query = SpyOauthClientAccessTokenCacheQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
