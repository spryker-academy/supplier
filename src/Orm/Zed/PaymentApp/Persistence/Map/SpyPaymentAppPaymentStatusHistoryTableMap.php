<?php

namespace Orm\Zed\PaymentApp\Persistence\Map;

use Orm\Zed\PaymentApp\Persistence\SpyPaymentAppPaymentStatusHistory;
use Orm\Zed\PaymentApp\Persistence\SpyPaymentAppPaymentStatusHistoryQuery;
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
 * This class defines the structure of the 'spy_payment_app_payment_status_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPaymentAppPaymentStatusHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PaymentApp.Persistence.Map.SpyPaymentAppPaymentStatusHistoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_payment_app_payment_status_history';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPaymentAppPaymentStatusHistory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PaymentApp\\Persistence\\SpyPaymentAppPaymentStatusHistory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PaymentApp.Persistence.SpyPaymentAppPaymentStatusHistory';

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
     * the column name for the id_payment_app_payment_status_history field
     */
    public const COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY = 'spy_payment_app_payment_status_history.id_payment_app_payment_status_history';

    /**
     * the column name for the order_reference field
     */
    public const COL_ORDER_REFERENCE = 'spy_payment_app_payment_status_history.order_reference';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_payment_app_payment_status_history.status';

    /**
     * the column name for the context field
     */
    public const COL_CONTEXT = 'spy_payment_app_payment_status_history.context';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_payment_app_payment_status_history.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_payment_app_payment_status_history.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPaymentAppPaymentStatusHistory', 'OrderReference', 'Status', 'Context', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPaymentAppPaymentStatusHistory', 'orderReference', 'status', 'context', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY, SpyPaymentAppPaymentStatusHistoryTableMap::COL_ORDER_REFERENCE, SpyPaymentAppPaymentStatusHistoryTableMap::COL_STATUS, SpyPaymentAppPaymentStatusHistoryTableMap::COL_CONTEXT, SpyPaymentAppPaymentStatusHistoryTableMap::COL_CREATED_AT, SpyPaymentAppPaymentStatusHistoryTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_payment_app_payment_status_history', 'order_reference', 'status', 'context', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPaymentAppPaymentStatusHistory' => 0, 'OrderReference' => 1, 'Status' => 2, 'Context' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idPaymentAppPaymentStatusHistory' => 0, 'orderReference' => 1, 'status' => 2, 'context' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY => 0, SpyPaymentAppPaymentStatusHistoryTableMap::COL_ORDER_REFERENCE => 1, SpyPaymentAppPaymentStatusHistoryTableMap::COL_STATUS => 2, SpyPaymentAppPaymentStatusHistoryTableMap::COL_CONTEXT => 3, SpyPaymentAppPaymentStatusHistoryTableMap::COL_CREATED_AT => 4, SpyPaymentAppPaymentStatusHistoryTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_payment_app_payment_status_history' => 0, 'order_reference' => 1, 'status' => 2, 'context' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPaymentAppPaymentStatusHistory' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'SpyPaymentAppPaymentStatusHistory.IdPaymentAppPaymentStatusHistory' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'idPaymentAppPaymentStatusHistory' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'spyPaymentAppPaymentStatusHistory.idPaymentAppPaymentStatusHistory' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'id_payment_app_payment_status_history' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'spy_payment_app_payment_status_history.id_payment_app_payment_status_history' => 'ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY',
        'OrderReference' => 'ORDER_REFERENCE',
        'SpyPaymentAppPaymentStatusHistory.OrderReference' => 'ORDER_REFERENCE',
        'orderReference' => 'ORDER_REFERENCE',
        'spyPaymentAppPaymentStatusHistory.orderReference' => 'ORDER_REFERENCE',
        'SpyPaymentAppPaymentStatusHistoryTableMap::COL_ORDER_REFERENCE' => 'ORDER_REFERENCE',
        'COL_ORDER_REFERENCE' => 'ORDER_REFERENCE',
        'order_reference' => 'ORDER_REFERENCE',
        'spy_payment_app_payment_status_history.order_reference' => 'ORDER_REFERENCE',
        'Status' => 'STATUS',
        'SpyPaymentAppPaymentStatusHistory.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyPaymentAppPaymentStatusHistory.status' => 'STATUS',
        'SpyPaymentAppPaymentStatusHistoryTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_payment_app_payment_status_history.status' => 'STATUS',
        'Context' => 'CONTEXT',
        'SpyPaymentAppPaymentStatusHistory.Context' => 'CONTEXT',
        'context' => 'CONTEXT',
        'spyPaymentAppPaymentStatusHistory.context' => 'CONTEXT',
        'SpyPaymentAppPaymentStatusHistoryTableMap::COL_CONTEXT' => 'CONTEXT',
        'COL_CONTEXT' => 'CONTEXT',
        'spy_payment_app_payment_status_history.context' => 'CONTEXT',
        'CreatedAt' => 'CREATED_AT',
        'SpyPaymentAppPaymentStatusHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPaymentAppPaymentStatusHistory.createdAt' => 'CREATED_AT',
        'SpyPaymentAppPaymentStatusHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_payment_app_payment_status_history.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPaymentAppPaymentStatusHistory.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPaymentAppPaymentStatusHistory.updatedAt' => 'UPDATED_AT',
        'SpyPaymentAppPaymentStatusHistoryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_payment_app_payment_status_history.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_payment_app_payment_status_history');
        $this->setPhpName('SpyPaymentAppPaymentStatusHistory');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\PaymentApp\\Persistence\\SpyPaymentAppPaymentStatusHistory');
        $this->setPackage('src.Orm.Zed.PaymentApp.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_payment_app_payment_status_history_pk_seq');
        // columns
        $this->addPrimaryKey('id_payment_app_payment_status_history', 'IdPaymentAppPaymentStatusHistory', 'INTEGER', true, null, null);
        $this->addColumn('order_reference', 'OrderReference', 'VARCHAR', true, 64, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 64, null);
        $this->addColumn('context', 'Context', 'LONGVARCHAR', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPaymentAppPaymentStatusHistory', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPaymentAppPaymentStatusHistoryTableMap::CLASS_DEFAULT : SpyPaymentAppPaymentStatusHistoryTableMap::OM_CLASS;
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
     * @return array (SpyPaymentAppPaymentStatusHistory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPaymentAppPaymentStatusHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPaymentAppPaymentStatusHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPaymentAppPaymentStatusHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPaymentAppPaymentStatusHistoryTableMap::OM_CLASS;
            /** @var SpyPaymentAppPaymentStatusHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPaymentAppPaymentStatusHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPaymentAppPaymentStatusHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPaymentAppPaymentStatusHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPaymentAppPaymentStatusHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPaymentAppPaymentStatusHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY);
            $criteria->addSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ORDER_REFERENCE);
            $criteria->addSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_CONTEXT);
            $criteria->addSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_payment_app_payment_status_history');
            $criteria->addSelectColumn($alias . '.order_reference');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.context');
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
            $criteria->removeSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY);
            $criteria->removeSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ORDER_REFERENCE);
            $criteria->removeSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_CONTEXT);
            $criteria->removeSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPaymentAppPaymentStatusHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_payment_app_payment_status_history');
            $criteria->removeSelectColumn($alias . '.order_reference');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.context');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPaymentAppPaymentStatusHistoryTableMap::DATABASE_NAME)->getTable(SpyPaymentAppPaymentStatusHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPaymentAppPaymentStatusHistory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPaymentAppPaymentStatusHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentAppPaymentStatusHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PaymentApp\Persistence\SpyPaymentAppPaymentStatusHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPaymentAppPaymentStatusHistoryTableMap::DATABASE_NAME);
            $criteria->add(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY, (array) $values, Criteria::IN);
        }

        $query = SpyPaymentAppPaymentStatusHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPaymentAppPaymentStatusHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPaymentAppPaymentStatusHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_payment_app_payment_status_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPaymentAppPaymentStatusHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPaymentAppPaymentStatusHistory or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPaymentAppPaymentStatusHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPaymentAppPaymentStatusHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPaymentAppPaymentStatusHistory object
        }

        if ($criteria->containsKey(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY) && $criteria->keyContainsValue(SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPaymentAppPaymentStatusHistoryTableMap::COL_ID_PAYMENT_APP_PAYMENT_STATUS_HISTORY.')');
        }


        // Set the correct dbName
        $query = SpyPaymentAppPaymentStatusHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
