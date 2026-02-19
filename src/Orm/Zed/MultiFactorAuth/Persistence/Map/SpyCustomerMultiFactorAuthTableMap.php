<?php

namespace Orm\Zed\MultiFactorAuth\Persistence\Map;

use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuth;
use Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuthQuery;
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
 * This class defines the structure of the 'spy_customer_multi_factor_auth' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCustomerMultiFactorAuthTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MultiFactorAuth.Persistence.Map.SpyCustomerMultiFactorAuthTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_customer_multi_factor_auth';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCustomerMultiFactorAuth';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuth';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MultiFactorAuth.Persistence.SpyCustomerMultiFactorAuth';

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
     * the column name for the id_customer_multi_factor_auth field
     */
    public const COL_ID_CUSTOMER_MULTI_FACTOR_AUTH = 'spy_customer_multi_factor_auth.id_customer_multi_factor_auth';

    /**
     * the column name for the fk_customer field
     */
    public const COL_FK_CUSTOMER = 'spy_customer_multi_factor_auth.fk_customer';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_customer_multi_factor_auth.type';

    /**
     * the column name for the configuration field
     */
    public const COL_CONFIGURATION = 'spy_customer_multi_factor_auth.configuration';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_customer_multi_factor_auth.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_customer_multi_factor_auth.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_customer_multi_factor_auth.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCustomerMultiFactorAuth', 'FkCustomer', 'Type', 'Configuration', 'Status', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCustomerMultiFactorAuth', 'fkCustomer', 'type', 'configuration', 'status', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH, SpyCustomerMultiFactorAuthTableMap::COL_FK_CUSTOMER, SpyCustomerMultiFactorAuthTableMap::COL_TYPE, SpyCustomerMultiFactorAuthTableMap::COL_CONFIGURATION, SpyCustomerMultiFactorAuthTableMap::COL_STATUS, SpyCustomerMultiFactorAuthTableMap::COL_CREATED_AT, SpyCustomerMultiFactorAuthTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_customer_multi_factor_auth', 'fk_customer', 'type', 'configuration', 'status', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCustomerMultiFactorAuth' => 0, 'FkCustomer' => 1, 'Type' => 2, 'Configuration' => 3, 'Status' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idCustomerMultiFactorAuth' => 0, 'fkCustomer' => 1, 'type' => 2, 'configuration' => 3, 'status' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH => 0, SpyCustomerMultiFactorAuthTableMap::COL_FK_CUSTOMER => 1, SpyCustomerMultiFactorAuthTableMap::COL_TYPE => 2, SpyCustomerMultiFactorAuthTableMap::COL_CONFIGURATION => 3, SpyCustomerMultiFactorAuthTableMap::COL_STATUS => 4, SpyCustomerMultiFactorAuthTableMap::COL_CREATED_AT => 5, SpyCustomerMultiFactorAuthTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_customer_multi_factor_auth' => 0, 'fk_customer' => 1, 'type' => 2, 'configuration' => 3, 'status' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCustomerMultiFactorAuth' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'SpyCustomerMultiFactorAuth.IdCustomerMultiFactorAuth' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'idCustomerMultiFactorAuth' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'spyCustomerMultiFactorAuth.idCustomerMultiFactorAuth' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'COL_ID_CUSTOMER_MULTI_FACTOR_AUTH' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'id_customer_multi_factor_auth' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'spy_customer_multi_factor_auth.id_customer_multi_factor_auth' => 'ID_CUSTOMER_MULTI_FACTOR_AUTH',
        'FkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerMultiFactorAuth.FkCustomer' => 'FK_CUSTOMER',
        'fkCustomer' => 'FK_CUSTOMER',
        'spyCustomerMultiFactorAuth.fkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerMultiFactorAuthTableMap::COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'fk_customer' => 'FK_CUSTOMER',
        'spy_customer_multi_factor_auth.fk_customer' => 'FK_CUSTOMER',
        'Type' => 'TYPE',
        'SpyCustomerMultiFactorAuth.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyCustomerMultiFactorAuth.type' => 'TYPE',
        'SpyCustomerMultiFactorAuthTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_customer_multi_factor_auth.type' => 'TYPE',
        'Configuration' => 'CONFIGURATION',
        'SpyCustomerMultiFactorAuth.Configuration' => 'CONFIGURATION',
        'configuration' => 'CONFIGURATION',
        'spyCustomerMultiFactorAuth.configuration' => 'CONFIGURATION',
        'SpyCustomerMultiFactorAuthTableMap::COL_CONFIGURATION' => 'CONFIGURATION',
        'COL_CONFIGURATION' => 'CONFIGURATION',
        'spy_customer_multi_factor_auth.configuration' => 'CONFIGURATION',
        'Status' => 'STATUS',
        'SpyCustomerMultiFactorAuth.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyCustomerMultiFactorAuth.status' => 'STATUS',
        'SpyCustomerMultiFactorAuthTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_customer_multi_factor_auth.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'SpyCustomerMultiFactorAuth.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCustomerMultiFactorAuth.createdAt' => 'CREATED_AT',
        'SpyCustomerMultiFactorAuthTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_customer_multi_factor_auth.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCustomerMultiFactorAuth.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCustomerMultiFactorAuth.updatedAt' => 'UPDATED_AT',
        'SpyCustomerMultiFactorAuthTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_customer_multi_factor_auth.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_customer_multi_factor_auth');
        $this->setPhpName('SpyCustomerMultiFactorAuth');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuth');
        $this->setPackage('src.Orm.Zed.MultiFactorAuth.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_customer_multi_factor_auth_pk_seq');
        // columns
        $this->addPrimaryKey('id_customer_multi_factor_auth', 'IdCustomerMultiFactorAuth', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_customer', 'FkCustomer', 'INTEGER', 'spy_customer', 'id_customer', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 50, null);
        $this->addColumn('configuration', 'Configuration', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, 0);
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
        $this->addRelation('SpyCustomer', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_customer',
    1 => ':id_customer',
  ),
), null, null, null, false);
        $this->addRelation('SpyCustomerMultiFactorAuthCodes', '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyCustomerMultiFactorAuthCodes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_customer_multi_factor_auth',
    1 => ':id_customer_multi_factor_auth',
  ),
), null, null, 'SpyCustomerMultiFactorAuthCodess', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCustomerMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCustomerMultiFactorAuthTableMap::CLASS_DEFAULT : SpyCustomerMultiFactorAuthTableMap::OM_CLASS;
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
     * @return array (SpyCustomerMultiFactorAuth object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCustomerMultiFactorAuthTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCustomerMultiFactorAuthTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCustomerMultiFactorAuthTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCustomerMultiFactorAuthTableMap::OM_CLASS;
            /** @var SpyCustomerMultiFactorAuth $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCustomerMultiFactorAuthTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCustomerMultiFactorAuthTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCustomerMultiFactorAuthTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCustomerMultiFactorAuth $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCustomerMultiFactorAuthTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_FK_CUSTOMER);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_CONFIGURATION);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_customer_multi_factor_auth');
            $criteria->addSelectColumn($alias . '.fk_customer');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.configuration');
            $criteria->addSelectColumn($alias . '.status');
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
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_FK_CUSTOMER);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_CONFIGURATION);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCustomerMultiFactorAuthTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_customer_multi_factor_auth');
            $criteria->removeSelectColumn($alias . '.fk_customer');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.configuration');
            $criteria->removeSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCustomerMultiFactorAuthTableMap::DATABASE_NAME)->getTable(SpyCustomerMultiFactorAuthTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCustomerMultiFactorAuth or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCustomerMultiFactorAuth object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerMultiFactorAuthTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MultiFactorAuth\Persistence\SpyCustomerMultiFactorAuth) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCustomerMultiFactorAuthTableMap::DATABASE_NAME);
            $criteria->add(SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH, (array) $values, Criteria::IN);
        }

        $query = SpyCustomerMultiFactorAuthQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCustomerMultiFactorAuthTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCustomerMultiFactorAuthTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_customer_multi_factor_auth table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCustomerMultiFactorAuthQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCustomerMultiFactorAuth or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCustomerMultiFactorAuth object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerMultiFactorAuthTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCustomerMultiFactorAuth object
        }

        if ($criteria->containsKey(SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH) && $criteria->keyContainsValue(SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCustomerMultiFactorAuthTableMap::COL_ID_CUSTOMER_MULTI_FACTOR_AUTH.')');
        }


        // Set the correct dbName
        $query = SpyCustomerMultiFactorAuthQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
