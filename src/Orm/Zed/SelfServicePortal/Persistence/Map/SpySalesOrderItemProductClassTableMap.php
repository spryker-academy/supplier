<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClassQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_product_class' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemProductClassTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpySalesOrderItemProductClassTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_product_class';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemProductClass';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySalesOrderItemProductClass';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpySalesOrderItemProductClass';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 2;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 2;

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_item_product_class.fk_sales_order_item';

    /**
     * the column name for the fk_sales_product_class field
     */
    public const COL_FK_SALES_PRODUCT_CLASS = 'spy_sales_order_item_product_class.fk_sales_product_class';

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
        self::TYPE_PHPNAME       => ['FkSalesOrderItem', 'FkSalesProductClass', ],
        self::TYPE_CAMELNAME     => ['fkSalesOrderItem', 'fkSalesProductClass', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemProductClassTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderItemProductClassTableMap::COL_FK_SALES_PRODUCT_CLASS, ],
        self::TYPE_FIELDNAME     => ['fk_sales_order_item', 'fk_sales_product_class', ],
        self::TYPE_NUM           => [0, 1, ]
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
        self::TYPE_PHPNAME       => ['FkSalesOrderItem' => 0, 'FkSalesProductClass' => 1, ],
        self::TYPE_CAMELNAME     => ['fkSalesOrderItem' => 0, 'fkSalesProductClass' => 1, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemProductClassTableMap::COL_FK_SALES_ORDER_ITEM => 0, SpySalesOrderItemProductClassTableMap::COL_FK_SALES_PRODUCT_CLASS => 1, ],
        self::TYPE_FIELDNAME     => ['fk_sales_order_item' => 0, 'fk_sales_product_class' => 1, ],
        self::TYPE_NUM           => [0, 1, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemProductClass.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderItemProductClass.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemProductClassTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_item_product_class.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'FkSalesProductClass' => 'FK_SALES_PRODUCT_CLASS',
        'SpySalesOrderItemProductClass.FkSalesProductClass' => 'FK_SALES_PRODUCT_CLASS',
        'fkSalesProductClass' => 'FK_SALES_PRODUCT_CLASS',
        'spySalesOrderItemProductClass.fkSalesProductClass' => 'FK_SALES_PRODUCT_CLASS',
        'SpySalesOrderItemProductClassTableMap::COL_FK_SALES_PRODUCT_CLASS' => 'FK_SALES_PRODUCT_CLASS',
        'COL_FK_SALES_PRODUCT_CLASS' => 'FK_SALES_PRODUCT_CLASS',
        'fk_sales_product_class' => 'FK_SALES_PRODUCT_CLASS',
        'spy_sales_order_item_product_class.fk_sales_product_class' => 'FK_SALES_PRODUCT_CLASS',
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
        $this->setName('spy_sales_order_item_product_class');
        $this->setPhpName('SpySalesOrderItemProductClass');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySalesOrderItemProductClass');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER' , 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addForeignPrimaryKey('fk_sales_product_class', 'FkSalesProductClass', 'INTEGER' , 'spy_sales_product_class', 'id_sales_product_class', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpySalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesProductClass', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySalesProductClass', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_product_class',
    1 => ':id_sales_product_class',
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
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass $obj A \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(SpySalesOrderItemProductClass $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getFkSalesOrderItem() || is_scalar($obj->getFkSalesOrderItem()) || is_callable([$obj->getFkSalesOrderItem(), '__toString']) ? (string) $obj->getFkSalesOrderItem() : $obj->getFkSalesOrderItem()), (null === $obj->getFkSalesProductClass() || is_scalar($obj->getFkSalesProductClass()) || is_callable([$obj->getFkSalesProductClass(), '__toString']) ? (string) $obj->getFkSalesProductClass() : $obj->getFkSalesProductClass())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass) {
                $key = serialize([(null === $value->getFkSalesOrderItem() || is_scalar($value->getFkSalesOrderItem()) || is_callable([$value->getFkSalesOrderItem(), '__toString']) ? (string) $value->getFkSalesOrderItem() : $value->getFkSalesOrderItem()), (null === $value->getFkSalesProductClass() || is_scalar($value->getFkSalesProductClass()) || is_callable([$value->getFkSalesProductClass(), '__toString']) ? (string) $value->getFkSalesProductClass() : $value->getFkSalesProductClass())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('FkSalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('FkSalesProductClass', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? SpySalesOrderItemProductClassTableMap::CLASS_DEFAULT : SpySalesOrderItemProductClassTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemProductClass object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemProductClassTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemProductClassTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemProductClassTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemProductClassTableMap::OM_CLASS;
            /** @var SpySalesOrderItemProductClass $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemProductClassTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemProductClassTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemProductClassTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemProductClass $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemProductClassTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemProductClassTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderItemProductClassTableMap::COL_FK_SALES_PRODUCT_CLASS);
        } else {
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.fk_sales_product_class');
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
            $criteria->removeSelectColumn(SpySalesOrderItemProductClassTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderItemProductClassTableMap::COL_FK_SALES_PRODUCT_CLASS);
        } else {
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.fk_sales_product_class');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemProductClassTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemProductClassTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemProductClass or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemProductClass object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemProductClassTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemProductClass) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemProductClassTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SpySalesOrderItemProductClassTableMap::COL_FK_SALES_ORDER_ITEM, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SpySalesOrderItemProductClassTableMap::COL_FK_SALES_PRODUCT_CLASS, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = SpySalesOrderItemProductClassQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemProductClassTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemProductClassTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_product_class table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemProductClassQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemProductClass or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemProductClass object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemProductClassTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemProductClass object
        }


        // Set the correct dbName
        $query = SpySalesOrderItemProductClassQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
