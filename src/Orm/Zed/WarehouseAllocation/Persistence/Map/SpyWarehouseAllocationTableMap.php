<?php

namespace Orm\Zed\WarehouseAllocation\Persistence\Map;

use Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocation;
use Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocationQuery;
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
 * This class defines the structure of the 'spy_warehouse_allocation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyWarehouseAllocationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.WarehouseAllocation.Persistence.Map.SpyWarehouseAllocationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_warehouse_allocation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyWarehouseAllocation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\WarehouseAllocation\\Persistence\\SpyWarehouseAllocation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.WarehouseAllocation.Persistence.SpyWarehouseAllocation';

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
     * the column name for the id_warehouse_allocation field
     */
    public const COL_ID_WAREHOUSE_ALLOCATION = 'spy_warehouse_allocation.id_warehouse_allocation';

    /**
     * the column name for the fk_warehouse field
     */
    public const COL_FK_WAREHOUSE = 'spy_warehouse_allocation.fk_warehouse';

    /**
     * the column name for the sales_order_item_uuid field
     */
    public const COL_SALES_ORDER_ITEM_UUID = 'spy_warehouse_allocation.sales_order_item_uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_warehouse_allocation.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_warehouse_allocation.updated_at';

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
        self::TYPE_PHPNAME       => ['IdWarehouseAllocation', 'FkWarehouse', 'SalesOrderItemUuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idWarehouseAllocation', 'fkWarehouse', 'salesOrderItemUuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyWarehouseAllocationTableMap::COL_ID_WAREHOUSE_ALLOCATION, SpyWarehouseAllocationTableMap::COL_FK_WAREHOUSE, SpyWarehouseAllocationTableMap::COL_SALES_ORDER_ITEM_UUID, SpyWarehouseAllocationTableMap::COL_CREATED_AT, SpyWarehouseAllocationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_warehouse_allocation', 'fk_warehouse', 'sales_order_item_uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdWarehouseAllocation' => 0, 'FkWarehouse' => 1, 'SalesOrderItemUuid' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idWarehouseAllocation' => 0, 'fkWarehouse' => 1, 'salesOrderItemUuid' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyWarehouseAllocationTableMap::COL_ID_WAREHOUSE_ALLOCATION => 0, SpyWarehouseAllocationTableMap::COL_FK_WAREHOUSE => 1, SpyWarehouseAllocationTableMap::COL_SALES_ORDER_ITEM_UUID => 2, SpyWarehouseAllocationTableMap::COL_CREATED_AT => 3, SpyWarehouseAllocationTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_warehouse_allocation' => 0, 'fk_warehouse' => 1, 'sales_order_item_uuid' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdWarehouseAllocation' => 'ID_WAREHOUSE_ALLOCATION',
        'SpyWarehouseAllocation.IdWarehouseAllocation' => 'ID_WAREHOUSE_ALLOCATION',
        'idWarehouseAllocation' => 'ID_WAREHOUSE_ALLOCATION',
        'spyWarehouseAllocation.idWarehouseAllocation' => 'ID_WAREHOUSE_ALLOCATION',
        'SpyWarehouseAllocationTableMap::COL_ID_WAREHOUSE_ALLOCATION' => 'ID_WAREHOUSE_ALLOCATION',
        'COL_ID_WAREHOUSE_ALLOCATION' => 'ID_WAREHOUSE_ALLOCATION',
        'id_warehouse_allocation' => 'ID_WAREHOUSE_ALLOCATION',
        'spy_warehouse_allocation.id_warehouse_allocation' => 'ID_WAREHOUSE_ALLOCATION',
        'FkWarehouse' => 'FK_WAREHOUSE',
        'SpyWarehouseAllocation.FkWarehouse' => 'FK_WAREHOUSE',
        'fkWarehouse' => 'FK_WAREHOUSE',
        'spyWarehouseAllocation.fkWarehouse' => 'FK_WAREHOUSE',
        'SpyWarehouseAllocationTableMap::COL_FK_WAREHOUSE' => 'FK_WAREHOUSE',
        'COL_FK_WAREHOUSE' => 'FK_WAREHOUSE',
        'fk_warehouse' => 'FK_WAREHOUSE',
        'spy_warehouse_allocation.fk_warehouse' => 'FK_WAREHOUSE',
        'SalesOrderItemUuid' => 'SALES_ORDER_ITEM_UUID',
        'SpyWarehouseAllocation.SalesOrderItemUuid' => 'SALES_ORDER_ITEM_UUID',
        'salesOrderItemUuid' => 'SALES_ORDER_ITEM_UUID',
        'spyWarehouseAllocation.salesOrderItemUuid' => 'SALES_ORDER_ITEM_UUID',
        'SpyWarehouseAllocationTableMap::COL_SALES_ORDER_ITEM_UUID' => 'SALES_ORDER_ITEM_UUID',
        'COL_SALES_ORDER_ITEM_UUID' => 'SALES_ORDER_ITEM_UUID',
        'sales_order_item_uuid' => 'SALES_ORDER_ITEM_UUID',
        'spy_warehouse_allocation.sales_order_item_uuid' => 'SALES_ORDER_ITEM_UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyWarehouseAllocation.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyWarehouseAllocation.createdAt' => 'CREATED_AT',
        'SpyWarehouseAllocationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_warehouse_allocation.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyWarehouseAllocation.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyWarehouseAllocation.updatedAt' => 'UPDATED_AT',
        'SpyWarehouseAllocationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_warehouse_allocation.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_warehouse_allocation');
        $this->setPhpName('SpyWarehouseAllocation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\WarehouseAllocation\\Persistence\\SpyWarehouseAllocation');
        $this->setPackage('src.Orm.Zed.WarehouseAllocation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_warehouse_allocation_pk_seq');
        // columns
        $this->addPrimaryKey('id_warehouse_allocation', 'IdWarehouseAllocation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_warehouse', 'FkWarehouse', 'INTEGER', 'spy_stock', 'id_stock', true, null, null);
        $this->addColumn('sales_order_item_uuid', 'SalesOrderItemUuid', 'VARCHAR', true, 36, null);
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
        $this->addRelation('Warehouse', '\\Orm\\Zed\\Stock\\Persistence\\SpyStock', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_warehouse',
    1 => ':id_stock',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdWarehouseAllocation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyWarehouseAllocationTableMap::CLASS_DEFAULT : SpyWarehouseAllocationTableMap::OM_CLASS;
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
     * @return array (SpyWarehouseAllocation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyWarehouseAllocationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyWarehouseAllocationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyWarehouseAllocationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyWarehouseAllocationTableMap::OM_CLASS;
            /** @var SpyWarehouseAllocation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyWarehouseAllocationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyWarehouseAllocationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyWarehouseAllocationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyWarehouseAllocation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyWarehouseAllocationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyWarehouseAllocationTableMap::COL_ID_WAREHOUSE_ALLOCATION);
            $criteria->addSelectColumn(SpyWarehouseAllocationTableMap::COL_FK_WAREHOUSE);
            $criteria->addSelectColumn(SpyWarehouseAllocationTableMap::COL_SALES_ORDER_ITEM_UUID);
            $criteria->addSelectColumn(SpyWarehouseAllocationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyWarehouseAllocationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_warehouse_allocation');
            $criteria->addSelectColumn($alias . '.fk_warehouse');
            $criteria->addSelectColumn($alias . '.sales_order_item_uuid');
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
            $criteria->removeSelectColumn(SpyWarehouseAllocationTableMap::COL_ID_WAREHOUSE_ALLOCATION);
            $criteria->removeSelectColumn(SpyWarehouseAllocationTableMap::COL_FK_WAREHOUSE);
            $criteria->removeSelectColumn(SpyWarehouseAllocationTableMap::COL_SALES_ORDER_ITEM_UUID);
            $criteria->removeSelectColumn(SpyWarehouseAllocationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyWarehouseAllocationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_warehouse_allocation');
            $criteria->removeSelectColumn($alias . '.fk_warehouse');
            $criteria->removeSelectColumn($alias . '.sales_order_item_uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyWarehouseAllocationTableMap::DATABASE_NAME)->getTable(SpyWarehouseAllocationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyWarehouseAllocation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyWarehouseAllocation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyWarehouseAllocationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\WarehouseAllocation\Persistence\SpyWarehouseAllocation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyWarehouseAllocationTableMap::DATABASE_NAME);
            $criteria->add(SpyWarehouseAllocationTableMap::COL_ID_WAREHOUSE_ALLOCATION, (array) $values, Criteria::IN);
        }

        $query = SpyWarehouseAllocationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyWarehouseAllocationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyWarehouseAllocationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_warehouse_allocation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyWarehouseAllocationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyWarehouseAllocation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyWarehouseAllocation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyWarehouseAllocationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyWarehouseAllocation object
        }


        // Set the correct dbName
        $query = SpyWarehouseAllocationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
