<?php

namespace Orm\Zed\Stock\Persistence\Map;

use Orm\Zed\MerchantStock\Persistence\Map\SpyMerchantStockTableMap;
use Orm\Zed\Stock\Persistence\SpyStock;
use Orm\Zed\Stock\Persistence\SpyStockQuery;
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
 * This class defines the structure of the 'spy_stock' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Stock.Persistence.Map.SpyStockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_stock';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Stock\\Persistence\\SpyStock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Stock.Persistence.SpyStock';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_stock field
     */
    public const COL_ID_STOCK = 'spy_stock.id_stock';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_stock.is_active';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_stock.name';

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
        self::TYPE_PHPNAME       => ['IdStock', 'IsActive', 'Name', ],
        self::TYPE_CAMELNAME     => ['idStock', 'isActive', 'name', ],
        self::TYPE_COLNAME       => [SpyStockTableMap::COL_ID_STOCK, SpyStockTableMap::COL_IS_ACTIVE, SpyStockTableMap::COL_NAME, ],
        self::TYPE_FIELDNAME     => ['id_stock', 'is_active', 'name', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['IdStock' => 0, 'IsActive' => 1, 'Name' => 2, ],
        self::TYPE_CAMELNAME     => ['idStock' => 0, 'isActive' => 1, 'name' => 2, ],
        self::TYPE_COLNAME       => [SpyStockTableMap::COL_ID_STOCK => 0, SpyStockTableMap::COL_IS_ACTIVE => 1, SpyStockTableMap::COL_NAME => 2, ],
        self::TYPE_FIELDNAME     => ['id_stock' => 0, 'is_active' => 1, 'name' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdStock' => 'ID_STOCK',
        'SpyStock.IdStock' => 'ID_STOCK',
        'idStock' => 'ID_STOCK',
        'spyStock.idStock' => 'ID_STOCK',
        'SpyStockTableMap::COL_ID_STOCK' => 'ID_STOCK',
        'COL_ID_STOCK' => 'ID_STOCK',
        'id_stock' => 'ID_STOCK',
        'spy_stock.id_stock' => 'ID_STOCK',
        'IsActive' => 'IS_ACTIVE',
        'SpyStock.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyStock.isActive' => 'IS_ACTIVE',
        'SpyStockTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_stock.is_active' => 'IS_ACTIVE',
        'Name' => 'NAME',
        'SpyStock.Name' => 'NAME',
        'name' => 'NAME',
        'spyStock.name' => 'NAME',
        'SpyStockTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_stock.name' => 'NAME',
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
        $this->setName('spy_stock');
        $this->setPhpName('SpyStock');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Stock\\Persistence\\SpyStock');
        $this->setPackage('src.Orm.Zed.Stock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_stock_pk_seq');
        // columns
        $this->addPrimaryKey('id_stock', 'IdStock', 'INTEGER', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, true);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyMerchantStock', '\\Orm\\Zed\\MerchantStock\\Persistence\\SpyMerchantStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), 'CASCADE', null, 'SpyMerchantStocks', false);
        $this->addRelation('ProductOfferStock', '\\Orm\\Zed\\ProductOfferStock\\Persistence\\SpyProductOfferStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), null, null, 'ProductOfferStocks', false);
        $this->addRelation('StockProduct', '\\Orm\\Zed\\Stock\\Persistence\\SpyStockProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), null, null, 'StockProducts', false);
        $this->addRelation('StockStore', '\\Orm\\Zed\\Stock\\Persistence\\SpyStockStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), null, null, 'StockStores', false);
        $this->addRelation('StockAddress', '\\Orm\\Zed\\StockAddress\\Persistence\\SpyStockAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), null, null, 'StockAddresses', false);
        $this->addRelation('WarehouseAllocation', '\\Orm\\Zed\\WarehouseAllocation\\Persistence\\SpyWarehouseAllocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_warehouse',
    1 => ':id_stock',
  ),
), null, null, 'WarehouseAllocations', false);
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
            'event' => ['spy_stock_is_active' => ['column' => 'is_active']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_stock     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantStockTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdStock', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStockTableMap::CLASS_DEFAULT : SpyStockTableMap::OM_CLASS;
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
     * @return array (SpyStock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStockTableMap::OM_CLASS;
            /** @var SpyStock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStockTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStockTableMap::COL_ID_STOCK);
            $criteria->addSelectColumn(SpyStockTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyStockTableMap::COL_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_stock');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyStockTableMap::COL_ID_STOCK);
            $criteria->removeSelectColumn(SpyStockTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyStockTableMap::COL_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_stock');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStockTableMap::DATABASE_NAME)->getTable(SpyStockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Stock\Persistence\SpyStock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStockTableMap::DATABASE_NAME);
            $criteria->add(SpyStockTableMap::COL_ID_STOCK, (array) $values, Criteria::IN);
        }

        $query = SpyStockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_stock table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStock or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStock object
        }

        if ($criteria->containsKey(SpyStockTableMap::COL_ID_STOCK) && $criteria->keyContainsValue(SpyStockTableMap::COL_ID_STOCK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStockTableMap::COL_ID_STOCK.')');
        }


        // Set the correct dbName
        $query = SpyStockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
