<?php

namespace Orm\Zed\MultiFactorAuth\Persistence\Map;

use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodesQuery;
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
 * This class defines the structure of the 'spy_customer_multi_factor_auth_codes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCustomerMultiFactorAuthCodesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MultiFactorAuth.Persistence.Map.SpyCustomerMultiFactorAuthCodesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_customer_multi_factor_auth_codes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCustomerMultiFactorAuthCodes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuthCodes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MultiFactorAuth.Persistence.SpyCustomerMultiFactorAuthCodes';

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
     * the column name for the id_customer_multi_factor_auth_code field
     */
    public const COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE = 'spy_customer_multi_factor_auth_codes.id_customer_multi_factor_auth_code';

    /**
     * the column name for the fk_customer_multi_factor_auth field
     */
    public const COL_FK_CUSTOMER_MULTI_FACTOR_AUTH = 'spy_customer_multi_factor_auth_codes.fk_customer_multi_factor_auth';

    /**
     * the column name for the code field
     */
    public const COL_CODE = 'spy_customer_multi_factor_auth_codes.code';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_customer_multi_factor_auth_codes.status';

    /**
     * the column name for the expiration_date field
     */
    public const COL_EXPIRATION_DATE = 'spy_customer_multi_factor_auth_codes.expiration_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_customer_multi_factor_auth_codes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_customer_multi_factor_auth_codes.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCustomerMultiFactorAuthCode', 'FkCustomerMultiFactorAuth', 'Code', 'Status', 'ExpirationDate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCustomerMultiFactorAuthCode', 'fkCustomerMultiFactorAuth', 'code', 'status', 'expirationDate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE, SpyCustomerMultiFactorAuthCodesTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH, SpyCustomerMultiFactorAuthCodesTableMap::COL_CODE, SpyCustomerMultiFactorAuthCodesTableMap::COL_STATUS, SpyCustomerMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE, SpyCustomerMultiFactorAuthCodesTableMap::COL_CREATED_AT, SpyCustomerMultiFactorAuthCodesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_customer_multi_factor_auth_code', 'fk_customer_multi_factor_auth', 'code', 'status', 'expiration_date', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCustomerMultiFactorAuthCode' => 0, 'FkCustomerMultiFactorAuth' => 1, 'Code' => 2, 'Status' => 3, 'ExpirationDate' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idCustomerMultiFactorAuthCode' => 0, 'fkCustomerMultiFactorAuth' => 1, 'code' => 2, 'status' => 3, 'expirationDate' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE => 0, SpyCustomerMultiFactorAuthCodesTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH => 1, SpyCustomerMultiFactorAuthCodesTableMap::COL_CODE => 2, SpyCustomerMultiFactorAuthCodesTableMap::COL_STATUS => 3, SpyCustomerMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE => 4, SpyCustomerMultiFactorAuthCodesTableMap::COL_CREATED_AT => 5, SpyCustomerMultiFactorAuthCodesTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_customer_multi_factor_auth_code' => 0, 'fk_customer_multi_factor_auth' => 1, 'code' => 2, 'status' => 3, 'expiration_date' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCustomerMultiFactorAuthCode' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'SpyCustomerMultiFactorAuthCodes.IdCustomerMultiFactorAuthCode' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'idCustomerMultiFactorAuthCode' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'spyCustomerMultiFactorAuthCodes.idCustomerMultiFactorAuthCode' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'id_customer_multi_factor_auth_code' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'spy_customer_multi_factor_auth_codes.id_customer_multi_factor_auth_code' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE',
        'FkCustomerMultiFactorAuth' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'SpyCustomerMultiFactorAuthCodes.FkCustomerMultiFactorAuth' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'fkCustomerMultiFactorAuth' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'spyCustomerMultiFactorAuthCodes.fkCustomerMultiFactorAuth' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'COL_FK_CUSTOMER_MULTI_FACTOR_AUTH' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'fk_customer_multi_factor_auth' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'spy_customer_multi_factor_auth_codes.fk_customer_multi_factor_auth' => 'FK_CUSTOMER_MULTI_FACTOR_AUTH',
        'Code' => 'CODE',
        'SpyCustomerMultiFactorAuthCodes.Code' => 'CODE',
        'code' => 'CODE',
        'spyCustomerMultiFactorAuthCodes.code' => 'CODE',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'spy_customer_multi_factor_auth_codes.code' => 'CODE',
        'Status' => 'STATUS',
        'SpyCustomerMultiFactorAuthCodes.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyCustomerMultiFactorAuthCodes.status' => 'STATUS',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_customer_multi_factor_auth_codes.status' => 'STATUS',
        'ExpirationDate' => 'EXPIRATION_DATE',
        'SpyCustomerMultiFactorAuthCodes.ExpirationDate' => 'EXPIRATION_DATE',
        'expirationDate' => 'EXPIRATION_DATE',
        'spyCustomerMultiFactorAuthCodes.expirationDate' => 'EXPIRATION_DATE',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE' => 'EXPIRATION_DATE',
        'COL_EXPIRATION_DATE' => 'EXPIRATION_DATE',
        'expiration_date' => 'EXPIRATION_DATE',
        'spy_customer_multi_factor_auth_codes.expiration_date' => 'EXPIRATION_DATE',
        'CreatedAt' => 'CREATED_AT',
        'SpyCustomerMultiFactorAuthCodes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCustomerMultiFactorAuthCodes.createdAt' => 'CREATED_AT',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_customer_multi_factor_auth_codes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCustomerMultiFactorAuthCodes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCustomerMultiFactorAuthCodes.updatedAt' => 'UPDATED_AT',
        'SpyCustomerMultiFactorAuthCodesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_customer_multi_factor_auth_codes.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_customer_multi_factor_auth_codes');
        $this->setPhpName('SpyCustomerMultiFactorAuthCodes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuthCodes');
        $this->setPackage('src.Orm.Zed.MultiFactorAuth.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_customer_multi_factor_auth_code_pk_seq');
        // columns
        $this->addPrimaryKey('id_customer_multi_factor_auth_code', 'IdCustomerMultiFactorAuthCode', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_customer_multi_factor_auth', 'FkCustomerMultiFactorAuth', 'INTEGER', 'spy_customer_multi_factor_auth', 'id_customer_multi_factor_auth', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 50, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, 0);
        $this->addColumn('expiration_date', 'ExpirationDate', 'DATETIME', true, null, null);
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
        $this->addRelation('SpyCustomerMultiFactorAuth', '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuth', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_customer_multi_factor_auth',
    1 => ':id_customer_multi_factor_auth',
  ),
), null, null, null, false);
        $this->addRelation('SpyCustomerMultiFactorAuthCodesAttempts', '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuthCodesAttempts', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_customer_multi_factor_auth_code',
    1 => ':id_customer_multi_factor_auth_code',
  ),
), null, null, 'SpyCustomerMultiFactorAuthCodesAttemptss', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCustomerMultiFactorAuthCode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCustomerMultiFactorAuthCodesTableMap::CLASS_DEFAULT : SpyCustomerMultiFactorAuthCodesTableMap::OM_CLASS;
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
     * @return array (SpyCustomerMultiFactorAuthCodes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCustomerMultiFactorAuthCodesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCustomerMultiFactorAuthCodesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCustomerMultiFactorAuthCodesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCustomerMultiFactorAuthCodesTableMap::OM_CLASS;
            /** @var SpyCustomerMultiFactorAuthCodes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCustomerMultiFactorAuthCodesTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCustomerMultiFactorAuthCodesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCustomerMultiFactorAuthCodesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCustomerMultiFactorAuthCodes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCustomerMultiFactorAuthCodesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_CODE);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_customer_multi_factor_auth_code');
            $criteria->addSelectColumn($alias . '.fk_customer_multi_factor_auth');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.expiration_date');
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
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_FK_CUSTOMER_MULTI_FACTOR_AUTH);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_CODE);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_EXPIRATION_DATE);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthCodesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_customer_multi_factor_auth_code');
            $criteria->removeSelectColumn($alias . '.fk_customer_multi_factor_auth');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.expiration_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCustomerMultiFactorAuthCodesTableMap::DATABASE_NAME)->getTable(SpyCustomerMultiFactorAuthCodesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCustomerMultiFactorAuthCodes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCustomerMultiFactorAuthCodes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerMultiFactorAuthCodesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthCodes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCustomerMultiFactorAuthCodesTableMap::DATABASE_NAME);
            $criteria->add(SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE, (array) $values, Criteria::IN);
        }

        $query = SpyCustomerMultiFactorAuthCodesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCustomerMultiFactorAuthCodesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCustomerMultiFactorAuthCodesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_customer_multi_factor_auth_codes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCustomerMultiFactorAuthCodesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCustomerMultiFactorAuthCodes or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCustomerMultiFactorAuthCodes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerMultiFactorAuthCodesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCustomerMultiFactorAuthCodes object
        }

        if ($criteria->containsKey(SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE) && $criteria->keyContainsValue(SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCustomerMultiFactorAuthCodesTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH_CODE.')');
        }


        // Set the correct dbName
        $query = SpyCustomerMultiFactorAuthCodesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
