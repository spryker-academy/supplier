<?php

namespace Orm\Zed\SalesServicePoint\Persistence\Map;

use Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint;
use Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePointQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_service_point' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemServicePointTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesServicePoint.Persistence.Map.SpySalesOrderItemServicePointTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_service_point';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemServicePoint';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesServicePoint\\Persistence\\SpySalesOrderItemServicePoint';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesServicePoint.Persistence.SpySalesOrderItemServicePoint';

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
     * the column name for the id_sales_order_item_service_point field
     */
    public const COL_ID_SALES_ORDER_ITEM_SERVICE_POINT = 'spy_sales_order_item_service_point.id_sales_order_item_service_point';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_item_service_point.fk_sales_order_item';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_order_item_service_point.name';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_sales_order_item_service_point.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_item_service_point.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_item_service_point.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemServicePoint', 'FkSalesOrderItem', 'Name', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemServicePoint', 'fkSalesOrderItem', 'name', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT, SpySalesOrderItemServicePointTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderItemServicePointTableMap::COL_NAME, SpySalesOrderItemServicePointTableMap::COL_KEY, SpySalesOrderItemServicePointTableMap::COL_CREATED_AT, SpySalesOrderItemServicePointTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_service_point', 'fk_sales_order_item', 'name', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemServicePoint' => 0, 'FkSalesOrderItem' => 1, 'Name' => 2, 'Key' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemServicePoint' => 0, 'fkSalesOrderItem' => 1, 'name' => 2, 'key' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT => 0, SpySalesOrderItemServicePointTableMap::COL_FK_SALES_ORDER_ITEM => 1, SpySalesOrderItemServicePointTableMap::COL_NAME => 2, SpySalesOrderItemServicePointTableMap::COL_KEY => 3, SpySalesOrderItemServicePointTableMap::COL_CREATED_AT => 4, SpySalesOrderItemServicePointTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_service_point' => 0, 'fk_sales_order_item' => 1, 'name' => 2, 'key' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderItemServicePoint' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'SpySalesOrderItemServicePoint.IdSalesOrderItemServicePoint' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'idSalesOrderItemServicePoint' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'spySalesOrderItemServicePoint.idSalesOrderItemServicePoint' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'COL_ID_SALES_ORDER_ITEM_SERVICE_POINT' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'id_sales_order_item_service_point' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'spy_sales_order_item_service_point.id_sales_order_item_service_point' => 'ID_SALES_ORDER_ITEM_SERVICE_POINT',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemServicePoint.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderItemServicePoint.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemServicePointTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_item_service_point.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'Name' => 'NAME',
        'SpySalesOrderItemServicePoint.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesOrderItemServicePoint.name' => 'NAME',
        'SpySalesOrderItemServicePointTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_order_item_service_point.name' => 'NAME',
        'Key' => 'KEY',
        'SpySalesOrderItemServicePoint.Key' => 'KEY',
        'key' => 'KEY',
        'spySalesOrderItemServicePoint.key' => 'KEY',
        'SpySalesOrderItemServicePointTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_sales_order_item_service_point.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderItemServicePoint.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderItemServicePoint.createdAt' => 'CREATED_AT',
        'SpySalesOrderItemServicePointTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_item_service_point.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemServicePoint.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderItemServicePoint.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemServicePointTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_item_service_point.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_item_service_point');
        $this->setPhpName('SpySalesOrderItemServicePoint');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\SalesServicePoint\\Persistence\\SpySalesOrderItemServicePoint');
        $this->setPackage('src.Orm.Zed.SalesServicePoint.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_item_service_point_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_item_service_point', 'IdSalesOrderItemServicePoint', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderItemServicePoint', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderItemServicePointTableMap::CLASS_DEFAULT : SpySalesOrderItemServicePointTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemServicePoint object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemServicePointTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemServicePointTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemServicePointTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemServicePointTableMap::OM_CLASS;
            /** @var SpySalesOrderItemServicePoint $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemServicePointTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemServicePointTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemServicePointTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemServicePoint $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemServicePointTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT);
            $criteria->addSelectColumn(SpySalesOrderItemServicePointTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderItemServicePointTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesOrderItemServicePointTableMap::COL_KEY);
            $criteria->addSelectColumn(SpySalesOrderItemServicePointTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemServicePointTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_item_service_point');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT);
            $criteria->removeSelectColumn(SpySalesOrderItemServicePointTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderItemServicePointTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesOrderItemServicePointTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpySalesOrderItemServicePointTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemServicePointTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_item_service_point');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemServicePointTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemServicePointTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemServicePoint or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemServicePoint object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemServicePointTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesServicePoint\Persistence\SpySalesOrderItemServicePoint) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemServicePointTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderItemServicePointQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemServicePointTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemServicePointTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_service_point table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemServicePointQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemServicePoint or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemServicePoint object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemServicePointTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemServicePoint object
        }

        if ($criteria->containsKey(SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT) && $criteria->keyContainsValue(SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderItemServicePointTableMap::COL_ID_SALES_ORDER_ITEM_SERVICE_POINT.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderItemServicePointQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
