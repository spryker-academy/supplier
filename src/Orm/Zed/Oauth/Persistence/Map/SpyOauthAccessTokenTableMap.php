<?php

namespace Orm\Zed\Oauth\Persistence\Map;

use Orm\Zed\Oauth\Persistence\SpyOauthAccessToken;
use Orm\Zed\Oauth\Persistence\SpyOauthAccessTokenQuery;
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
 * This class defines the structure of the 'spy_oauth_access_token' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOauthAccessTokenTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oauth.Persistence.Map.SpyOauthAccessTokenTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oauth_access_token';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOauthAccessToken';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthAccessToken';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oauth.Persistence.SpyOauthAccessToken';

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
     * the column name for the id_oauth_access_token field
     */
    public const COL_ID_OAUTH_ACCESS_TOKEN = 'spy_oauth_access_token.id_oauth_access_token';

    /**
     * the column name for the fk_oauth_client field
     */
    public const COL_FK_OAUTH_CLIENT = 'spy_oauth_access_token.fk_oauth_client';

    /**
     * the column name for the expirity_date field
     */
    public const COL_EXPIRITY_DATE = 'spy_oauth_access_token.expirity_date';

    /**
     * the column name for the identifier field
     */
    public const COL_IDENTIFIER = 'spy_oauth_access_token.identifier';

    /**
     * the column name for the scopes field
     */
    public const COL_SCOPES = 'spy_oauth_access_token.scopes';

    /**
     * the column name for the user_identifier field
     */
    public const COL_USER_IDENTIFIER = 'spy_oauth_access_token.user_identifier';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oauth_access_token.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_oauth_access_token.updated_at';

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
        self::TYPE_PHPNAME       => ['IdOauthAccessToken', 'FkOauthClient', 'ExpirityDate', 'Identifier', 'Scopes', 'UserIdentifier', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idOauthAccessToken', 'fkOauthClient', 'expirityDate', 'identifier', 'scopes', 'userIdentifier', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN, SpyOauthAccessTokenTableMap::COL_FK_OAUTH_CLIENT, SpyOauthAccessTokenTableMap::COL_EXPIRITY_DATE, SpyOauthAccessTokenTableMap::COL_IDENTIFIER, SpyOauthAccessTokenTableMap::COL_SCOPES, SpyOauthAccessTokenTableMap::COL_USER_IDENTIFIER, SpyOauthAccessTokenTableMap::COL_CREATED_AT, SpyOauthAccessTokenTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_oauth_access_token', 'fk_oauth_client', 'expirity_date', 'identifier', 'scopes', 'user_identifier', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdOauthAccessToken' => 0, 'FkOauthClient' => 1, 'ExpirityDate' => 2, 'Identifier' => 3, 'Scopes' => 4, 'UserIdentifier' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idOauthAccessToken' => 0, 'fkOauthClient' => 1, 'expirityDate' => 2, 'identifier' => 3, 'scopes' => 4, 'userIdentifier' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN => 0, SpyOauthAccessTokenTableMap::COL_FK_OAUTH_CLIENT => 1, SpyOauthAccessTokenTableMap::COL_EXPIRITY_DATE => 2, SpyOauthAccessTokenTableMap::COL_IDENTIFIER => 3, SpyOauthAccessTokenTableMap::COL_SCOPES => 4, SpyOauthAccessTokenTableMap::COL_USER_IDENTIFIER => 5, SpyOauthAccessTokenTableMap::COL_CREATED_AT => 6, SpyOauthAccessTokenTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_oauth_access_token' => 0, 'fk_oauth_client' => 1, 'expirity_date' => 2, 'identifier' => 3, 'scopes' => 4, 'user_identifier' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOauthAccessToken' => 'ID_OAUTH_ACCESS_TOKEN',
        'SpyOauthAccessToken.IdOauthAccessToken' => 'ID_OAUTH_ACCESS_TOKEN',
        'idOauthAccessToken' => 'ID_OAUTH_ACCESS_TOKEN',
        'spyOauthAccessToken.idOauthAccessToken' => 'ID_OAUTH_ACCESS_TOKEN',
        'SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN' => 'ID_OAUTH_ACCESS_TOKEN',
        'COL_ID_OAUTH_ACCESS_TOKEN' => 'ID_OAUTH_ACCESS_TOKEN',
        'id_oauth_access_token' => 'ID_OAUTH_ACCESS_TOKEN',
        'spy_oauth_access_token.id_oauth_access_token' => 'ID_OAUTH_ACCESS_TOKEN',
        'FkOauthClient' => 'FK_OAUTH_CLIENT',
        'SpyOauthAccessToken.FkOauthClient' => 'FK_OAUTH_CLIENT',
        'fkOauthClient' => 'FK_OAUTH_CLIENT',
        'spyOauthAccessToken.fkOauthClient' => 'FK_OAUTH_CLIENT',
        'SpyOauthAccessTokenTableMap::COL_FK_OAUTH_CLIENT' => 'FK_OAUTH_CLIENT',
        'COL_FK_OAUTH_CLIENT' => 'FK_OAUTH_CLIENT',
        'fk_oauth_client' => 'FK_OAUTH_CLIENT',
        'spy_oauth_access_token.fk_oauth_client' => 'FK_OAUTH_CLIENT',
        'ExpirityDate' => 'EXPIRITY_DATE',
        'SpyOauthAccessToken.ExpirityDate' => 'EXPIRITY_DATE',
        'expirityDate' => 'EXPIRITY_DATE',
        'spyOauthAccessToken.expirityDate' => 'EXPIRITY_DATE',
        'SpyOauthAccessTokenTableMap::COL_EXPIRITY_DATE' => 'EXPIRITY_DATE',
        'COL_EXPIRITY_DATE' => 'EXPIRITY_DATE',
        'expirity_date' => 'EXPIRITY_DATE',
        'spy_oauth_access_token.expirity_date' => 'EXPIRITY_DATE',
        'Identifier' => 'IDENTIFIER',
        'SpyOauthAccessToken.Identifier' => 'IDENTIFIER',
        'identifier' => 'IDENTIFIER',
        'spyOauthAccessToken.identifier' => 'IDENTIFIER',
        'SpyOauthAccessTokenTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'spy_oauth_access_token.identifier' => 'IDENTIFIER',
        'Scopes' => 'SCOPES',
        'SpyOauthAccessToken.Scopes' => 'SCOPES',
        'scopes' => 'SCOPES',
        'spyOauthAccessToken.scopes' => 'SCOPES',
        'SpyOauthAccessTokenTableMap::COL_SCOPES' => 'SCOPES',
        'COL_SCOPES' => 'SCOPES',
        'spy_oauth_access_token.scopes' => 'SCOPES',
        'UserIdentifier' => 'USER_IDENTIFIER',
        'SpyOauthAccessToken.UserIdentifier' => 'USER_IDENTIFIER',
        'userIdentifier' => 'USER_IDENTIFIER',
        'spyOauthAccessToken.userIdentifier' => 'USER_IDENTIFIER',
        'SpyOauthAccessTokenTableMap::COL_USER_IDENTIFIER' => 'USER_IDENTIFIER',
        'COL_USER_IDENTIFIER' => 'USER_IDENTIFIER',
        'user_identifier' => 'USER_IDENTIFIER',
        'spy_oauth_access_token.user_identifier' => 'USER_IDENTIFIER',
        'CreatedAt' => 'CREATED_AT',
        'SpyOauthAccessToken.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOauthAccessToken.createdAt' => 'CREATED_AT',
        'SpyOauthAccessTokenTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oauth_access_token.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyOauthAccessToken.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyOauthAccessToken.updatedAt' => 'UPDATED_AT',
        'SpyOauthAccessTokenTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_oauth_access_token.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_oauth_access_token');
        $this->setPhpName('SpyOauthAccessToken');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthAccessToken');
        $this->setPackage('src.Orm.Zed.Oauth.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oauth_access_token_pk_seq');
        // columns
        $this->addPrimaryKey('id_oauth_access_token', 'IdOauthAccessToken', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_oauth_client', 'FkOauthClient', 'VARCHAR', 'spy_oauth_client', 'identifier', true, 1024, null);
        $this->addColumn('expirity_date', 'ExpirityDate', 'TIMESTAMP', true, null, null);
        $this->addColumn('identifier', 'Identifier', 'VARCHAR', true, 3024, null);
        $this->addColumn('scopes', 'Scopes', 'VARCHAR', false, 1024, null);
        $this->addColumn('user_identifier', 'UserIdentifier', 'VARCHAR', true, 1024, null);
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
        $this->addRelation('OauthClient', '\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthClient', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_oauth_client',
    1 => ':identifier',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOauthAccessToken', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOauthAccessTokenTableMap::CLASS_DEFAULT : SpyOauthAccessTokenTableMap::OM_CLASS;
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
     * @return array (SpyOauthAccessToken object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOauthAccessTokenTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOauthAccessTokenTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOauthAccessTokenTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOauthAccessTokenTableMap::OM_CLASS;
            /** @var SpyOauthAccessToken $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOauthAccessTokenTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOauthAccessTokenTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOauthAccessTokenTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOauthAccessToken $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOauthAccessTokenTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_FK_OAUTH_CLIENT);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_EXPIRITY_DATE);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_SCOPES);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_USER_IDENTIFIER);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyOauthAccessTokenTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_oauth_access_token');
            $criteria->addSelectColumn($alias . '.fk_oauth_client');
            $criteria->addSelectColumn($alias . '.expirity_date');
            $criteria->addSelectColumn($alias . '.identifier');
            $criteria->addSelectColumn($alias . '.scopes');
            $criteria->addSelectColumn($alias . '.user_identifier');
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
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_FK_OAUTH_CLIENT);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_EXPIRITY_DATE);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_SCOPES);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_USER_IDENTIFIER);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyOauthAccessTokenTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oauth_access_token');
            $criteria->removeSelectColumn($alias . '.fk_oauth_client');
            $criteria->removeSelectColumn($alias . '.expirity_date');
            $criteria->removeSelectColumn($alias . '.identifier');
            $criteria->removeSelectColumn($alias . '.scopes');
            $criteria->removeSelectColumn($alias . '.user_identifier');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOauthAccessTokenTableMap::DATABASE_NAME)->getTable(SpyOauthAccessTokenTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOauthAccessToken or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOauthAccessToken object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthAccessTokenTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oauth\Persistence\SpyOauthAccessToken) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOauthAccessTokenTableMap::DATABASE_NAME);
            $criteria->add(SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN, (array) $values, Criteria::IN);
        }

        $query = SpyOauthAccessTokenQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOauthAccessTokenTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOauthAccessTokenTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oauth_access_token table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOauthAccessTokenQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOauthAccessToken or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOauthAccessToken object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthAccessTokenTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOauthAccessToken object
        }

        if ($criteria->containsKey(SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN) && $criteria->keyContainsValue(SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOauthAccessTokenTableMap::COL_ID_OAUTH_ACCESS_TOKEN.')');
        }


        // Set the correct dbName
        $query = SpyOauthAccessTokenQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
