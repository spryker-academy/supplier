<?php

namespace Orm\Zed\Oauth\Persistence\Map;

use Orm\Zed\Oauth\Persistence\SpyOauthClient;
use Orm\Zed\Oauth\Persistence\SpyOauthClientQuery;
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
 * This class defines the structure of the 'spy_oauth_client' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOauthClientTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oauth.Persistence.Map.SpyOauthClientTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oauth_client';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOauthClient';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthClient';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oauth.Persistence.SpyOauthClient';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_oauth_client field
     */
    public const COL_ID_OAUTH_CLIENT = 'spy_oauth_client.id_oauth_client';

    /**
     * the column name for the identifier field
     */
    public const COL_IDENTIFIER = 'spy_oauth_client.identifier';

    /**
     * the column name for the is_confidential field
     */
    public const COL_IS_CONFIDENTIAL = 'spy_oauth_client.is_confidential';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_oauth_client.name';

    /**
     * the column name for the redirect_uri field
     */
    public const COL_REDIRECT_URI = 'spy_oauth_client.redirect_uri';

    /**
     * the column name for the secret field
     */
    public const COL_SECRET = 'spy_oauth_client.secret';

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
        self::TYPE_PHPNAME       => ['IdOauthClient', 'Identifier', 'IsConfidential', 'Name', 'RedirectUri', 'Secret', ],
        self::TYPE_CAMELNAME     => ['idOauthClient', 'identifier', 'isConfidential', 'name', 'redirectUri', 'secret', ],
        self::TYPE_COLNAME       => [SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, SpyOauthClientTableMap::COL_IDENTIFIER, SpyOauthClientTableMap::COL_IS_CONFIDENTIAL, SpyOauthClientTableMap::COL_NAME, SpyOauthClientTableMap::COL_REDIRECT_URI, SpyOauthClientTableMap::COL_SECRET, ],
        self::TYPE_FIELDNAME     => ['id_oauth_client', 'identifier', 'is_confidential', 'name', 'redirect_uri', 'secret', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdOauthClient' => 0, 'Identifier' => 1, 'IsConfidential' => 2, 'Name' => 3, 'RedirectUri' => 4, 'Secret' => 5, ],
        self::TYPE_CAMELNAME     => ['idOauthClient' => 0, 'identifier' => 1, 'isConfidential' => 2, 'name' => 3, 'redirectUri' => 4, 'secret' => 5, ],
        self::TYPE_COLNAME       => [SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT => 0, SpyOauthClientTableMap::COL_IDENTIFIER => 1, SpyOauthClientTableMap::COL_IS_CONFIDENTIAL => 2, SpyOauthClientTableMap::COL_NAME => 3, SpyOauthClientTableMap::COL_REDIRECT_URI => 4, SpyOauthClientTableMap::COL_SECRET => 5, ],
        self::TYPE_FIELDNAME     => ['id_oauth_client' => 0, 'identifier' => 1, 'is_confidential' => 2, 'name' => 3, 'redirect_uri' => 4, 'secret' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOauthClient' => 'ID_OAUTH_CLIENT',
        'SpyOauthClient.IdOauthClient' => 'ID_OAUTH_CLIENT',
        'idOauthClient' => 'ID_OAUTH_CLIENT',
        'spyOauthClient.idOauthClient' => 'ID_OAUTH_CLIENT',
        'SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT' => 'ID_OAUTH_CLIENT',
        'COL_ID_OAUTH_CLIENT' => 'ID_OAUTH_CLIENT',
        'id_oauth_client' => 'ID_OAUTH_CLIENT',
        'spy_oauth_client.id_oauth_client' => 'ID_OAUTH_CLIENT',
        'Identifier' => 'IDENTIFIER',
        'SpyOauthClient.Identifier' => 'IDENTIFIER',
        'identifier' => 'IDENTIFIER',
        'spyOauthClient.identifier' => 'IDENTIFIER',
        'SpyOauthClientTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'spy_oauth_client.identifier' => 'IDENTIFIER',
        'IsConfidential' => 'IS_CONFIDENTIAL',
        'SpyOauthClient.IsConfidential' => 'IS_CONFIDENTIAL',
        'isConfidential' => 'IS_CONFIDENTIAL',
        'spyOauthClient.isConfidential' => 'IS_CONFIDENTIAL',
        'SpyOauthClientTableMap::COL_IS_CONFIDENTIAL' => 'IS_CONFIDENTIAL',
        'COL_IS_CONFIDENTIAL' => 'IS_CONFIDENTIAL',
        'is_confidential' => 'IS_CONFIDENTIAL',
        'spy_oauth_client.is_confidential' => 'IS_CONFIDENTIAL',
        'Name' => 'NAME',
        'SpyOauthClient.Name' => 'NAME',
        'name' => 'NAME',
        'spyOauthClient.name' => 'NAME',
        'SpyOauthClientTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_oauth_client.name' => 'NAME',
        'RedirectUri' => 'REDIRECT_URI',
        'SpyOauthClient.RedirectUri' => 'REDIRECT_URI',
        'redirectUri' => 'REDIRECT_URI',
        'spyOauthClient.redirectUri' => 'REDIRECT_URI',
        'SpyOauthClientTableMap::COL_REDIRECT_URI' => 'REDIRECT_URI',
        'COL_REDIRECT_URI' => 'REDIRECT_URI',
        'redirect_uri' => 'REDIRECT_URI',
        'spy_oauth_client.redirect_uri' => 'REDIRECT_URI',
        'Secret' => 'SECRET',
        'SpyOauthClient.Secret' => 'SECRET',
        'secret' => 'SECRET',
        'spyOauthClient.secret' => 'SECRET',
        'SpyOauthClientTableMap::COL_SECRET' => 'SECRET',
        'COL_SECRET' => 'SECRET',
        'spy_oauth_client.secret' => 'SECRET',
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
        $this->setName('spy_oauth_client');
        $this->setPhpName('SpyOauthClient');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthClient');
        $this->setPackage('src.Orm.Zed.Oauth.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oauth_client_pk_seq');
        // columns
        $this->addPrimaryKey('id_oauth_client', 'IdOauthClient', 'INTEGER', true, null, null);
        $this->addColumn('identifier', 'Identifier', 'VARCHAR', true, 1024, null);
        $this->addColumn('is_confidential', 'IsConfidential', 'BOOLEAN', false, 1, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 1024, null);
        $this->addColumn('redirect_uri', 'RedirectUri', 'VARCHAR', false, 1024, null);
        $this->addColumn('secret', 'Secret', 'VARCHAR', false, 1024, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('OauthAccessToken', '\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthAccessToken', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_oauth_client',
    1 => ':identifier',
  ),
), null, null, 'OauthAccessTokens', false);
        $this->addRelation('SpyOauthRefreshToken', '\\Orm\\Zed\\OauthRevoke\\Persistence\\SpyOauthRefreshToken', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_oauth_client',
    1 => ':identifier',
  ),
), null, null, 'SpyOauthRefreshTokens', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOauthClient', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOauthClientTableMap::CLASS_DEFAULT : SpyOauthClientTableMap::OM_CLASS;
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
     * @return array (SpyOauthClient object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOauthClientTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOauthClientTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOauthClientTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOauthClientTableMap::OM_CLASS;
            /** @var SpyOauthClient $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOauthClientTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOauthClientTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOauthClientTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOauthClient $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOauthClientTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT);
            $criteria->addSelectColumn(SpyOauthClientTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(SpyOauthClientTableMap::COL_IS_CONFIDENTIAL);
            $criteria->addSelectColumn(SpyOauthClientTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyOauthClientTableMap::COL_REDIRECT_URI);
            $criteria->addSelectColumn(SpyOauthClientTableMap::COL_SECRET);
        } else {
            $criteria->addSelectColumn($alias . '.id_oauth_client');
            $criteria->addSelectColumn($alias . '.identifier');
            $criteria->addSelectColumn($alias . '.is_confidential');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.redirect_uri');
            $criteria->addSelectColumn($alias . '.secret');
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
            $criteria->removeSelectColumn(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT);
            $criteria->removeSelectColumn(SpyOauthClientTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(SpyOauthClientTableMap::COL_IS_CONFIDENTIAL);
            $criteria->removeSelectColumn(SpyOauthClientTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyOauthClientTableMap::COL_REDIRECT_URI);
            $criteria->removeSelectColumn(SpyOauthClientTableMap::COL_SECRET);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oauth_client');
            $criteria->removeSelectColumn($alias . '.identifier');
            $criteria->removeSelectColumn($alias . '.is_confidential');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.redirect_uri');
            $criteria->removeSelectColumn($alias . '.secret');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOauthClientTableMap::DATABASE_NAME)->getTable(SpyOauthClientTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOauthClient or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOauthClient object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oauth\Persistence\SpyOauthClient) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOauthClientTableMap::DATABASE_NAME);
            $criteria->add(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT, (array) $values, Criteria::IN);
        }

        $query = SpyOauthClientQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOauthClientTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOauthClientTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oauth_client table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOauthClientQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOauthClient or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOauthClient object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthClientTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOauthClient object
        }

        if ($criteria->containsKey(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT) && $criteria->keyContainsValue(SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOauthClientTableMap::COL_ID_OAUTH_CLIENT.')');
        }


        // Set the correct dbName
        $query = SpyOauthClientQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
