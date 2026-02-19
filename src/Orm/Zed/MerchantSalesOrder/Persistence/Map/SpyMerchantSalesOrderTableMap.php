<?php

namespace Orm\Zed\MerchantSalesOrder\Persistence\Map;

use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder;
use Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrderQuery;
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
 * This class defines the structure of the 'spy_merchant_sales_order' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantSalesOrderTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantSalesOrder.Persistence.Map.SpyMerchantSalesOrderTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_sales_order';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantSalesOrder';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrder';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantSalesOrder.Persistence.SpyMerchantSalesOrder';

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
     * the column name for the id_merchant_sales_order field
     */
    public const COL_ID_MERCHANT_SALES_ORDER = 'spy_merchant_sales_order.id_merchant_sales_order';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_merchant_sales_order.fk_sales_order';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_merchant_sales_order.merchant_reference';

    /**
     * the column name for the merchant_sales_order_reference field
     */
    public const COL_MERCHANT_SALES_ORDER_REFERENCE = 'spy_merchant_sales_order.merchant_sales_order_reference';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_sales_order.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_sales_order.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchantSalesOrder', 'FkSalesOrder', 'MerchantReference', 'MerchantSalesOrderReference', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantSalesOrder', 'fkSalesOrder', 'merchantReference', 'merchantSalesOrderReference', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER, SpyMerchantSalesOrderTableMap::COL_FK_SALES_ORDER, SpyMerchantSalesOrderTableMap::COL_MERCHANT_REFERENCE, SpyMerchantSalesOrderTableMap::COL_MERCHANT_SALES_ORDER_REFERENCE, SpyMerchantSalesOrderTableMap::COL_CREATED_AT, SpyMerchantSalesOrderTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_sales_order', 'fk_sales_order', 'merchant_reference', 'merchant_sales_order_reference', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantSalesOrder' => 0, 'FkSalesOrder' => 1, 'MerchantReference' => 2, 'MerchantSalesOrderReference' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idMerchantSalesOrder' => 0, 'fkSalesOrder' => 1, 'merchantReference' => 2, 'merchantSalesOrderReference' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER => 0, SpyMerchantSalesOrderTableMap::COL_FK_SALES_ORDER => 1, SpyMerchantSalesOrderTableMap::COL_MERCHANT_REFERENCE => 2, SpyMerchantSalesOrderTableMap::COL_MERCHANT_SALES_ORDER_REFERENCE => 3, SpyMerchantSalesOrderTableMap::COL_CREATED_AT => 4, SpyMerchantSalesOrderTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_merchant_sales_order' => 0, 'fk_sales_order' => 1, 'merchant_reference' => 2, 'merchant_sales_order_reference' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantSalesOrder' => 'ID_MERCHANT_SALES_ORDER',
        'SpyMerchantSalesOrder.IdMerchantSalesOrder' => 'ID_MERCHANT_SALES_ORDER',
        'idMerchantSalesOrder' => 'ID_MERCHANT_SALES_ORDER',
        'spyMerchantSalesOrder.idMerchantSalesOrder' => 'ID_MERCHANT_SALES_ORDER',
        'SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER' => 'ID_MERCHANT_SALES_ORDER',
        'COL_ID_MERCHANT_SALES_ORDER' => 'ID_MERCHANT_SALES_ORDER',
        'id_merchant_sales_order' => 'ID_MERCHANT_SALES_ORDER',
        'spy_merchant_sales_order.id_merchant_sales_order' => 'ID_MERCHANT_SALES_ORDER',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpyMerchantSalesOrder.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spyMerchantSalesOrder.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpyMerchantSalesOrderTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_merchant_sales_order.fk_sales_order' => 'FK_SALES_ORDER',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpyMerchantSalesOrder.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spyMerchantSalesOrder.merchantReference' => 'MERCHANT_REFERENCE',
        'SpyMerchantSalesOrderTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_merchant_sales_order.merchant_reference' => 'MERCHANT_REFERENCE',
        'MerchantSalesOrderReference' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'SpyMerchantSalesOrder.MerchantSalesOrderReference' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'merchantSalesOrderReference' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'spyMerchantSalesOrder.merchantSalesOrderReference' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'SpyMerchantSalesOrderTableMap::COL_MERCHANT_SALES_ORDER_REFERENCE' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'COL_MERCHANT_SALES_ORDER_REFERENCE' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'merchant_sales_order_reference' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'spy_merchant_sales_order.merchant_sales_order_reference' => 'MERCHANT_SALES_ORDER_REFERENCE',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantSalesOrder.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantSalesOrder.createdAt' => 'CREATED_AT',
        'SpyMerchantSalesOrderTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_sales_order.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantSalesOrder.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantSalesOrder.updatedAt' => 'UPDATED_AT',
        'SpyMerchantSalesOrderTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_sales_order.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant_sales_order');
        $this->setPhpName('SpyMerchantSalesOrder');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrder');
        $this->setPackage('src.Orm.Zed.MerchantSalesOrder.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_sales_order_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_sales_order', 'IdMerchantSalesOrder', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addColumn('merchant_reference', 'MerchantReference', 'VARCHAR', true, 255, null);
        $this->addColumn('merchant_sales_order_reference', 'MerchantSalesOrderReference', 'VARCHAR', true, 255, null);
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
        $this->addRelation('Order', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('MerchantSalesOrderItem', '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrderItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_sales_order',
    1 => ':id_merchant_sales_order',
  ),
), null, null, 'MerchantSalesOrderItems', false);
        $this->addRelation('MerchantSalesOrderTotal', '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrderTotals', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_sales_order',
    1 => ':id_merchant_sales_order',
  ),
), null, null, 'MerchantSalesOrderTotals', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantSalesOrder', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantSalesOrderTableMap::CLASS_DEFAULT : SpyMerchantSalesOrderTableMap::OM_CLASS;
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
     * @return array (SpyMerchantSalesOrder object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantSalesOrderTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantSalesOrderTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantSalesOrderTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantSalesOrderTableMap::OM_CLASS;
            /** @var SpyMerchantSalesOrder $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantSalesOrderTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantSalesOrderTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantSalesOrderTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantSalesOrder $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantSalesOrderTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER);
            $criteria->addSelectColumn(SpyMerchantSalesOrderTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpyMerchantSalesOrderTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpyMerchantSalesOrderTableMap::COL_MERCHANT_SALES_ORDER_REFERENCE);
            $criteria->addSelectColumn(SpyMerchantSalesOrderTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantSalesOrderTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_sales_order');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.merchant_sales_order_reference');
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
            $criteria->removeSelectColumn(SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER);
            $criteria->removeSelectColumn(SpyMerchantSalesOrderTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpyMerchantSalesOrderTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpyMerchantSalesOrderTableMap::COL_MERCHANT_SALES_ORDER_REFERENCE);
            $criteria->removeSelectColumn(SpyMerchantSalesOrderTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantSalesOrderTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_sales_order');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.merchant_sales_order_reference');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantSalesOrderTableMap::DATABASE_NAME)->getTable(SpyMerchantSalesOrderTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantSalesOrder or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantSalesOrder object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSalesOrderTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantSalesOrder\Persistence\SpyMerchantSalesOrder) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantSalesOrderTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantSalesOrderQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantSalesOrderTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantSalesOrderTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_sales_order table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantSalesOrderQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantSalesOrder or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantSalesOrder object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSalesOrderTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantSalesOrder object
        }

        if ($criteria->containsKey(SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER) && $criteria->keyContainsValue(SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantSalesOrderTableMap::COL_ID_MERCHANT_SALES_ORDER.')');
        }


        // Set the correct dbName
        $query = SpyMerchantSalesOrderQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
