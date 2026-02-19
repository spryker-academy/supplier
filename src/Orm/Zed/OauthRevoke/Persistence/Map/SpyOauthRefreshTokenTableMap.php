<?php

namespace Orm\Zed\OauthRevoke\Persistence\Map;

use Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken;
use Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshTokenQuery;
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
 * This class defines the structure of the 'spy_oauth_refresh_token' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOauthRefreshTokenTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.OauthRevoke.Persistence.Map.SpyOauthRefreshTokenTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oauth_refresh_token';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOauthRefreshToken';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\OauthRevoke\\Persistence\\SpyOauthRefreshToken';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.OauthRevoke.Persistence.SpyOauthRefreshToken';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_oauth_refresh_token field
     */
    public const COL_ID_OAUTH_REFRESH_TOKEN = 'spy_oauth_refresh_token.id_oauth_refresh_token';

    /**
     * the column name for the identifier field
     */
    public const COL_IDENTIFIER = 'spy_oauth_refresh_token.identifier';

    /**
     * the column name for the scopes field
     */
    public const COL_SCOPES = 'spy_oauth_refresh_token.scopes';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_oauth_refresh_token.customer_reference';

    /**
     * the column name for the user_identifier field
     */
    public const COL_USER_IDENTIFIER = 'spy_oauth_refresh_token.user_identifier';

    /**
     * the column name for the fk_oauth_client field
     */
    public const COL_FK_OAUTH_CLIENT = 'spy_oauth_refresh_token.fk_oauth_client';

    /**
     * the column name for the expires_at field
     */
    public const COL_EXPIRES_AT = 'spy_oauth_refresh_token.expires_at';

    /**
     * the column name for the revoked_at field
     */
    public const COL_REVOKED_AT = 'spy_oauth_refresh_token.revoked_at';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oauth_refresh_token.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_oauth_refresh_token.updated_at';

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
        self::TYPE_PHPNAME       => ['IdOauthRefreshToken', 'Identifier', 'Scopes', 'CustomerReference', 'UserIdentifier', 'FkOauthClient', 'ExpiresAt', 'RevokedAt', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idOauthRefreshToken', 'identifier', 'scopes', 'customerReference', 'userIdentifier', 'fkOauthClient', 'expiresAt', 'revokedAt', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN, SpyOauthRefreshTokenTableMap::COL_IDENTIFIER, SpyOauthRefreshTokenTableMap::COL_SCOPES, SpyOauthRefreshTokenTableMap::COL_CUSTOMER_REFERENCE, SpyOauthRefreshTokenTableMap::COL_USER_IDENTIFIER, SpyOauthRefreshTokenTableMap::COL_FK_OAUTH_CLIENT, SpyOauthRefreshTokenTableMap::COL_EXPIRES_AT, SpyOauthRefreshTokenTableMap::COL_REVOKED_AT, SpyOauthRefreshTokenTableMap::COL_CREATED_AT, SpyOauthRefreshTokenTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_oauth_refresh_token', 'identifier', 'scopes', 'customer_reference', 'user_identifier', 'fk_oauth_client', 'expires_at', 'revoked_at', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdOauthRefreshToken' => 0, 'Identifier' => 1, 'Scopes' => 2, 'CustomerReference' => 3, 'UserIdentifier' => 4, 'FkOauthClient' => 5, 'ExpiresAt' => 6, 'RevokedAt' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idOauthRefreshToken' => 0, 'identifier' => 1, 'scopes' => 2, 'customerReference' => 3, 'userIdentifier' => 4, 'fkOauthClient' => 5, 'expiresAt' => 6, 'revokedAt' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN => 0, SpyOauthRefreshTokenTableMap::COL_IDENTIFIER => 1, SpyOauthRefreshTokenTableMap::COL_SCOPES => 2, SpyOauthRefreshTokenTableMap::COL_CUSTOMER_REFERENCE => 3, SpyOauthRefreshTokenTableMap::COL_USER_IDENTIFIER => 4, SpyOauthRefreshTokenTableMap::COL_FK_OAUTH_CLIENT => 5, SpyOauthRefreshTokenTableMap::COL_EXPIRES_AT => 6, SpyOauthRefreshTokenTableMap::COL_REVOKED_AT => 7, SpyOauthRefreshTokenTableMap::COL_CREATED_AT => 8, SpyOauthRefreshTokenTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_oauth_refresh_token' => 0, 'identifier' => 1, 'scopes' => 2, 'customer_reference' => 3, 'user_identifier' => 4, 'fk_oauth_client' => 5, 'expires_at' => 6, 'revoked_at' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOauthRefreshToken' => 'ID_OAUTH_REFRESH_TOKEN',
        'SpyOauthRefreshToken.IdOauthRefreshToken' => 'ID_OAUTH_REFRESH_TOKEN',
        'idOauthRefreshToken' => 'ID_OAUTH_REFRESH_TOKEN',
        'spyOauthRefreshToken.idOauthRefreshToken' => 'ID_OAUTH_REFRESH_TOKEN',
        'SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN' => 'ID_OAUTH_REFRESH_TOKEN',
        'COL_ID_OAUTH_REFRESH_TOKEN' => 'ID_OAUTH_REFRESH_TOKEN',
        'id_oauth_refresh_token' => 'ID_OAUTH_REFRESH_TOKEN',
        'spy_oauth_refresh_token.id_oauth_refresh_token' => 'ID_OAUTH_REFRESH_TOKEN',
        'Identifier' => 'IDENTIFIER',
        'SpyOauthRefreshToken.Identifier' => 'IDENTIFIER',
        'identifier' => 'IDENTIFIER',
        'spyOauthRefreshToken.identifier' => 'IDENTIFIER',
        'SpyOauthRefreshTokenTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'spy_oauth_refresh_token.identifier' => 'IDENTIFIER',
        'Scopes' => 'SCOPES',
        'SpyOauthRefreshToken.Scopes' => 'SCOPES',
        'scopes' => 'SCOPES',
        'spyOauthRefreshToken.scopes' => 'SCOPES',
        'SpyOauthRefreshTokenTableMap::COL_SCOPES' => 'SCOPES',
        'COL_SCOPES' => 'SCOPES',
        'spy_oauth_refresh_token.scopes' => 'SCOPES',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpyOauthRefreshToken.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spyOauthRefreshToken.customerReference' => 'CUSTOMER_REFERENCE',
        'SpyOauthRefreshTokenTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_oauth_refresh_token.customer_reference' => 'CUSTOMER_REFERENCE',
        'UserIdentifier' => 'USER_IDENTIFIER',
        'SpyOauthRefreshToken.UserIdentifier' => 'USER_IDENTIFIER',
        'userIdentifier' => 'USER_IDENTIFIER',
        'spyOauthRefreshToken.userIdentifier' => 'USER_IDENTIFIER',
        'SpyOauthRefreshTokenTableMap::COL_USER_IDENTIFIER' => 'USER_IDENTIFIER',
        'COL_USER_IDENTIFIER' => 'USER_IDENTIFIER',
        'user_identifier' => 'USER_IDENTIFIER',
        'spy_oauth_refresh_token.user_identifier' => 'USER_IDENTIFIER',
        'FkOauthClient' => 'FK_OAUTH_CLIENT',
        'SpyOauthRefreshToken.FkOauthClient' => 'FK_OAUTH_CLIENT',
        'fkOauthClient' => 'FK_OAUTH_CLIENT',
        'spyOauthRefreshToken.fkOauthClient' => 'FK_OAUTH_CLIENT',
        'SpyOauthRefreshTokenTableMap::COL_FK_OAUTH_CLIENT' => 'FK_OAUTH_CLIENT',
        'COL_FK_OAUTH_CLIENT' => 'FK_OAUTH_CLIENT',
        'fk_oauth_client' => 'FK_OAUTH_CLIENT',
        'spy_oauth_refresh_token.fk_oauth_client' => 'FK_OAUTH_CLIENT',
        'ExpiresAt' => 'EXPIRES_AT',
        'SpyOauthRefreshToken.ExpiresAt' => 'EXPIRES_AT',
        'expiresAt' => 'EXPIRES_AT',
        'spyOauthRefreshToken.expiresAt' => 'EXPIRES_AT',
        'SpyOauthRefreshTokenTableMap::COL_EXPIRES_AT' => 'EXPIRES_AT',
        'COL_EXPIRES_AT' => 'EXPIRES_AT',
        'expires_at' => 'EXPIRES_AT',
        'spy_oauth_refresh_token.expires_at' => 'EXPIRES_AT',
        'RevokedAt' => 'REVOKED_AT',
        'SpyOauthRefreshToken.RevokedAt' => 'REVOKED_AT',
        'revokedAt' => 'REVOKED_AT',
        'spyOauthRefreshToken.revokedAt' => 'REVOKED_AT',
        'SpyOauthRefreshTokenTableMap::COL_REVOKED_AT' => 'REVOKED_AT',
        'COL_REVOKED_AT' => 'REVOKED_AT',
        'revoked_at' => 'REVOKED_AT',
        'spy_oauth_refresh_token.revoked_at' => 'REVOKED_AT',
        'CreatedAt' => 'CREATED_AT',
        'SpyOauthRefreshToken.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOauthRefreshToken.createdAt' => 'CREATED_AT',
        'SpyOauthRefreshTokenTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oauth_refresh_token.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyOauthRefreshToken.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyOauthRefreshToken.updatedAt' => 'UPDATED_AT',
        'SpyOauthRefreshTokenTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_oauth_refresh_token.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_oauth_refresh_token');
        $this->setPhpName('SpyOauthRefreshToken');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\OauthRevoke\\Persistence\\SpyOauthRefreshToken');
        $this->setPackage('src.Orm.Zed.OauthRevoke.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oauth_refresh_token_pk_seq');
        // columns
        $this->addPrimaryKey('id_oauth_refresh_token', 'IdOauthRefreshToken', 'BIGINT', true, null, null);
        $this->addColumn('identifier', 'Identifier', 'VARCHAR', true, 128, null);
        $this->addColumn('scopes', 'Scopes', 'VARCHAR', false, 1024, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', false, 255, null);
        $this->addColumn('user_identifier', 'UserIdentifier', 'VARCHAR', true, 1024, null);
        $this->addForeignKey('fk_oauth_client', 'FkOauthClient', 'VARCHAR', 'spy_oauth_client', 'identifier', true, 1024, null);
        $this->addColumn('expires_at', 'ExpiresAt', 'TIMESTAMP', true, null, null);
        $this->addColumn('revoked_at', 'RevokedAt', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('SpyOauthClient', '\\Orm\\Zed\\Oauth\\Persistence\\SpyOauthClient', RelationMap::MANY_TO_ONE, array (
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOauthRefreshToken', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOauthRefreshTokenTableMap::CLASS_DEFAULT : SpyOauthRefreshTokenTableMap::OM_CLASS;
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
     * @return array (SpyOauthRefreshToken object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOauthRefreshTokenTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOauthRefreshTokenTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOauthRefreshTokenTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOauthRefreshTokenTableMap::OM_CLASS;
            /** @var SpyOauthRefreshToken $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOauthRefreshTokenTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOauthRefreshTokenTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOauthRefreshTokenTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOauthRefreshToken $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOauthRefreshTokenTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_SCOPES);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_USER_IDENTIFIER);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_FK_OAUTH_CLIENT);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_EXPIRES_AT);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_REVOKED_AT);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyOauthRefreshTokenTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_oauth_refresh_token');
            $criteria->addSelectColumn($alias . '.identifier');
            $criteria->addSelectColumn($alias . '.scopes');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.user_identifier');
            $criteria->addSelectColumn($alias . '.fk_oauth_client');
            $criteria->addSelectColumn($alias . '.expires_at');
            $criteria->addSelectColumn($alias . '.revoked_at');
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
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_SCOPES);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_USER_IDENTIFIER);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_FK_OAUTH_CLIENT);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_EXPIRES_AT);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_REVOKED_AT);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyOauthRefreshTokenTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oauth_refresh_token');
            $criteria->removeSelectColumn($alias . '.identifier');
            $criteria->removeSelectColumn($alias . '.scopes');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.user_identifier');
            $criteria->removeSelectColumn($alias . '.fk_oauth_client');
            $criteria->removeSelectColumn($alias . '.expires_at');
            $criteria->removeSelectColumn($alias . '.revoked_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOauthRefreshTokenTableMap::DATABASE_NAME)->getTable(SpyOauthRefreshTokenTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOauthRefreshToken or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOauthRefreshToken object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthRefreshTokenTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\OauthRevoke\Persistence\SpyOauthRefreshToken) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOauthRefreshTokenTableMap::DATABASE_NAME);
            $criteria->add(SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN, (array) $values, Criteria::IN);
        }

        $query = SpyOauthRefreshTokenQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOauthRefreshTokenTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOauthRefreshTokenTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oauth_refresh_token table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOauthRefreshTokenQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOauthRefreshToken or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOauthRefreshToken object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOauthRefreshTokenTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOauthRefreshToken object
        }

        if ($criteria->containsKey(SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN) && $criteria->keyContainsValue(SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOauthRefreshTokenTableMap::COL_ID_OAUTH_REFRESH_TOKEN.')');
        }


        // Set the correct dbName
        $query = SpyOauthRefreshTokenQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
