<?php

namespace Orm\Zed\CustomerDataChangeRequest\Persistence\Map;

use Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequest;
use Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequestQuery;
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
 * This class defines the structure of the 'spy_customer_data_change_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCustomerDataChangeRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CustomerDataChangeRequest.Persistence.Map.SpyCustomerDataChangeRequestTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_customer_data_change_request';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCustomerDataChangeRequest';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CustomerDataChangeRequest\\Persistence\\SpyCustomerDataChangeRequest';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CustomerDataChangeRequest.Persistence.SpyCustomerDataChangeRequest';

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
     * the column name for the id_customer_data_change_request field
     */
    public const COL_ID_CUSTOMER_DATA_CHANGE_REQUEST = 'spy_customer_data_change_request.id_customer_data_change_request';

    /**
     * the column name for the fk_customer field
     */
    public const COL_FK_CUSTOMER = 'spy_customer_data_change_request.fk_customer';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_customer_data_change_request.data';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_customer_data_change_request.type';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_customer_data_change_request.status';

    /**
     * the column name for the verification_token field
     */
    public const COL_VERIFICATION_TOKEN = 'spy_customer_data_change_request.verification_token';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_customer_data_change_request.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_customer_data_change_request.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCustomerDataChangeRequest', 'FkCustomer', 'Data', 'Type', 'Status', 'VerificationToken', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCustomerDataChangeRequest', 'fkCustomer', 'data', 'type', 'status', 'verificationToken', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST, SpyCustomerDataChangeRequestTableMap::COL_FK_CUSTOMER, SpyCustomerDataChangeRequestTableMap::COL_DATA, SpyCustomerDataChangeRequestTableMap::COL_TYPE, SpyCustomerDataChangeRequestTableMap::COL_STATUS, SpyCustomerDataChangeRequestTableMap::COL_VERIFICATION_TOKEN, SpyCustomerDataChangeRequestTableMap::COL_CREATED_AT, SpyCustomerDataChangeRequestTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_customer_data_change_request', 'fk_customer', 'data', 'type', 'status', 'verification_token', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCustomerDataChangeRequest' => 0, 'FkCustomer' => 1, 'Data' => 2, 'Type' => 3, 'Status' => 4, 'VerificationToken' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idCustomerDataChangeRequest' => 0, 'fkCustomer' => 1, 'data' => 2, 'type' => 3, 'status' => 4, 'verificationToken' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST => 0, SpyCustomerDataChangeRequestTableMap::COL_FK_CUSTOMER => 1, SpyCustomerDataChangeRequestTableMap::COL_DATA => 2, SpyCustomerDataChangeRequestTableMap::COL_TYPE => 3, SpyCustomerDataChangeRequestTableMap::COL_STATUS => 4, SpyCustomerDataChangeRequestTableMap::COL_VERIFICATION_TOKEN => 5, SpyCustomerDataChangeRequestTableMap::COL_CREATED_AT => 6, SpyCustomerDataChangeRequestTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_customer_data_change_request' => 0, 'fk_customer' => 1, 'data' => 2, 'type' => 3, 'status' => 4, 'verification_token' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCustomerDataChangeRequest' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'SpyCustomerDataChangeRequest.IdCustomerDataChangeRequest' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'idCustomerDataChangeRequest' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'spyCustomerDataChangeRequest.idCustomerDataChangeRequest' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'COL_ID_CUSTOMER_DATA_CHANGE_REQUEST' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'id_customer_data_change_request' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'spy_customer_data_change_request.id_customer_data_change_request' => 'ID_CUSTOMER_DATA_CHANGE_REQUEST',
        'FkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerDataChangeRequest.FkCustomer' => 'FK_CUSTOMER',
        'fkCustomer' => 'FK_CUSTOMER',
        'spyCustomerDataChangeRequest.fkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerDataChangeRequestTableMap::COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'fk_customer' => 'FK_CUSTOMER',
        'spy_customer_data_change_request.fk_customer' => 'FK_CUSTOMER',
        'Data' => 'DATA',
        'SpyCustomerDataChangeRequest.Data' => 'DATA',
        'data' => 'DATA',
        'spyCustomerDataChangeRequest.data' => 'DATA',
        'SpyCustomerDataChangeRequestTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_customer_data_change_request.data' => 'DATA',
        'Type' => 'TYPE',
        'SpyCustomerDataChangeRequest.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyCustomerDataChangeRequest.type' => 'TYPE',
        'SpyCustomerDataChangeRequestTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_customer_data_change_request.type' => 'TYPE',
        'Status' => 'STATUS',
        'SpyCustomerDataChangeRequest.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyCustomerDataChangeRequest.status' => 'STATUS',
        'SpyCustomerDataChangeRequestTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_customer_data_change_request.status' => 'STATUS',
        'VerificationToken' => 'VERIFICATION_TOKEN',
        'SpyCustomerDataChangeRequest.VerificationToken' => 'VERIFICATION_TOKEN',
        'verificationToken' => 'VERIFICATION_TOKEN',
        'spyCustomerDataChangeRequest.verificationToken' => 'VERIFICATION_TOKEN',
        'SpyCustomerDataChangeRequestTableMap::COL_VERIFICATION_TOKEN' => 'VERIFICATION_TOKEN',
        'COL_VERIFICATION_TOKEN' => 'VERIFICATION_TOKEN',
        'verification_token' => 'VERIFICATION_TOKEN',
        'spy_customer_data_change_request.verification_token' => 'VERIFICATION_TOKEN',
        'CreatedAt' => 'CREATED_AT',
        'SpyCustomerDataChangeRequest.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCustomerDataChangeRequest.createdAt' => 'CREATED_AT',
        'SpyCustomerDataChangeRequestTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_customer_data_change_request.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCustomerDataChangeRequest.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCustomerDataChangeRequest.updatedAt' => 'UPDATED_AT',
        'SpyCustomerDataChangeRequestTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_customer_data_change_request.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_customer_data_change_request');
        $this->setPhpName('SpyCustomerDataChangeRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CustomerDataChangeRequest\\Persistence\\SpyCustomerDataChangeRequest');
        $this->setPackage('src.Orm.Zed.CustomerDataChangeRequest.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_customer_data_change_request_pk_seq');
        // columns
        $this->addPrimaryKey('id_customer_data_change_request', 'IdCustomerDataChangeRequest', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_customer', 'FkCustomer', 'INTEGER', 'spy_customer', 'id_customer', true, null, null);
        $this->addColumn('data', 'Data', 'VARCHAR', true, 255, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 255, null);
        $this->addColumn('verification_token', 'VerificationToken', 'VARCHAR', true, 150, null);
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
        $this->addRelation('Customer', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_customer',
    1 => ':id_customer',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCustomerDataChangeRequest', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCustomerDataChangeRequestTableMap::CLASS_DEFAULT : SpyCustomerDataChangeRequestTableMap::OM_CLASS;
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
     * @return array (SpyCustomerDataChangeRequest object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCustomerDataChangeRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCustomerDataChangeRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCustomerDataChangeRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCustomerDataChangeRequestTableMap::OM_CLASS;
            /** @var SpyCustomerDataChangeRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCustomerDataChangeRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCustomerDataChangeRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCustomerDataChangeRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCustomerDataChangeRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCustomerDataChangeRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_FK_CUSTOMER);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_VERIFICATION_TOKEN);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_customer_data_change_request');
            $criteria->addSelectColumn($alias . '.fk_customer');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.verification_token');
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
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_FK_CUSTOMER);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_VERIFICATION_TOKEN);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCustomerDataChangeRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_customer_data_change_request');
            $criteria->removeSelectColumn($alias . '.fk_customer');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.verification_token');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCustomerDataChangeRequestTableMap::DATABASE_NAME)->getTable(SpyCustomerDataChangeRequestTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCustomerDataChangeRequest or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCustomerDataChangeRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerDataChangeRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CustomerDataChangeRequest\Persistence\SpyCustomerDataChangeRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCustomerDataChangeRequestTableMap::DATABASE_NAME);
            $criteria->add(SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST, (array) $values, Criteria::IN);
        }

        $query = SpyCustomerDataChangeRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCustomerDataChangeRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCustomerDataChangeRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_customer_data_change_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCustomerDataChangeRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCustomerDataChangeRequest or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCustomerDataChangeRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerDataChangeRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCustomerDataChangeRequest object
        }

        if ($criteria->containsKey(SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST) && $criteria->keyContainsValue(SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCustomerDataChangeRequestTableMap::COL_ID_CUSTOMER_DATA_CHANGE_REQUEST.')');
        }


        // Set the correct dbName
        $query = SpyCustomerDataChangeRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
