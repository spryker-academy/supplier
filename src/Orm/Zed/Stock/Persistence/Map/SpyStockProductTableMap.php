<?php

namespace Orm\Zed\Stock\Persistence\Map;

use Orm\Zed\Stock\Persistence\SpyStockProduct;
use Orm\Zed\Stock\Persistence\SpyStockProductQuery;
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
 * This class defines the structure of the 'spy_stock_product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStockProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Stock.Persistence.Map.SpyStockProductTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_stock_product';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStockProduct';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Stock\\Persistence\\SpyStockProduct';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Stock.Persistence.SpyStockProduct';

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
     * the column name for the id_stock_product field
     */
    public const COL_ID_STOCK_PRODUCT = 'spy_stock_product.id_stock_product';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_stock_product.fk_product';

    /**
     * the column name for the fk_stock field
     */
    public const COL_FK_STOCK = 'spy_stock_product.fk_stock';

    /**
     * the column name for the is_never_out_of_stock field
     */
    public const COL_IS_NEVER_OUT_OF_STOCK = 'spy_stock_product.is_never_out_of_stock';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'spy_stock_product.quantity';

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
        self::TYPE_PHPNAME       => ['IdStockProduct', 'FkProduct', 'FkStock', 'IsNeverOutOfStock', 'Quantity', ],
        self::TYPE_CAMELNAME     => ['idStockProduct', 'fkProduct', 'fkStock', 'isNeverOutOfStock', 'quantity', ],
        self::TYPE_COLNAME       => [SpyStockProductTableMap::COL_ID_STOCK_PRODUCT, SpyStockProductTableMap::COL_FK_PRODUCT, SpyStockProductTableMap::COL_FK_STOCK, SpyStockProductTableMap::COL_IS_NEVER_OUT_OF_STOCK, SpyStockProductTableMap::COL_QUANTITY, ],
        self::TYPE_FIELDNAME     => ['id_stock_product', 'fk_product', 'fk_stock', 'is_never_out_of_stock', 'quantity', ],
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
        self::TYPE_PHPNAME       => ['IdStockProduct' => 0, 'FkProduct' => 1, 'FkStock' => 2, 'IsNeverOutOfStock' => 3, 'Quantity' => 4, ],
        self::TYPE_CAMELNAME     => ['idStockProduct' => 0, 'fkProduct' => 1, 'fkStock' => 2, 'isNeverOutOfStock' => 3, 'quantity' => 4, ],
        self::TYPE_COLNAME       => [SpyStockProductTableMap::COL_ID_STOCK_PRODUCT => 0, SpyStockProductTableMap::COL_FK_PRODUCT => 1, SpyStockProductTableMap::COL_FK_STOCK => 2, SpyStockProductTableMap::COL_IS_NEVER_OUT_OF_STOCK => 3, SpyStockProductTableMap::COL_QUANTITY => 4, ],
        self::TYPE_FIELDNAME     => ['id_stock_product' => 0, 'fk_product' => 1, 'fk_stock' => 2, 'is_never_out_of_stock' => 3, 'quantity' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdStockProduct' => 'ID_STOCK_PRODUCT',
        'SpyStockProduct.IdStockProduct' => 'ID_STOCK_PRODUCT',
        'idStockProduct' => 'ID_STOCK_PRODUCT',
        'spyStockProduct.idStockProduct' => 'ID_STOCK_PRODUCT',
        'SpyStockProductTableMap::COL_ID_STOCK_PRODUCT' => 'ID_STOCK_PRODUCT',
        'COL_ID_STOCK_PRODUCT' => 'ID_STOCK_PRODUCT',
        'id_stock_product' => 'ID_STOCK_PRODUCT',
        'spy_stock_product.id_stock_product' => 'ID_STOCK_PRODUCT',
        'FkProduct' => 'FK_PRODUCT',
        'SpyStockProduct.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyStockProduct.fkProduct' => 'FK_PRODUCT',
        'SpyStockProductTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_stock_product.fk_product' => 'FK_PRODUCT',
        'FkStock' => 'FK_STOCK',
        'SpyStockProduct.FkStock' => 'FK_STOCK',
        'fkStock' => 'FK_STOCK',
        'spyStockProduct.fkStock' => 'FK_STOCK',
        'SpyStockProductTableMap::COL_FK_STOCK' => 'FK_STOCK',
        'COL_FK_STOCK' => 'FK_STOCK',
        'fk_stock' => 'FK_STOCK',
        'spy_stock_product.fk_stock' => 'FK_STOCK',
        'IsNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'SpyStockProduct.IsNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'isNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'spyStockProduct.isNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'SpyStockProductTableMap::COL_IS_NEVER_OUT_OF_STOCK' => 'IS_NEVER_OUT_OF_STOCK',
        'COL_IS_NEVER_OUT_OF_STOCK' => 'IS_NEVER_OUT_OF_STOCK',
        'is_never_out_of_stock' => 'IS_NEVER_OUT_OF_STOCK',
        'spy_stock_product.is_never_out_of_stock' => 'IS_NEVER_OUT_OF_STOCK',
        'Quantity' => 'QUANTITY',
        'SpyStockProduct.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'spyStockProduct.quantity' => 'QUANTITY',
        'SpyStockProductTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'spy_stock_product.quantity' => 'QUANTITY',
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
        $this->setName('spy_stock_product');
        $this->setPhpName('SpyStockProduct');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Stock\\Persistence\\SpyStockProduct');
        $this->setPackage('src.Orm.Zed.Stock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_stock_product_pk_seq');
        // columns
        $this->addPrimaryKey('id_stock_product', 'IdStockProduct', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addForeignKey('fk_stock', 'FkStock', 'INTEGER', 'spy_stock', 'id_stock', true, null, null);
        $this->addColumn('is_never_out_of_stock', 'IsNeverOutOfStock', 'BOOLEAN', false, 1, false);
        $this->addColumn('quantity', 'Quantity', 'DECIMAL', false, 20, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('Stock', '\\Orm\\Zed\\Stock\\Persistence\\SpyStock', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_stock',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdStockProduct', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStockProductTableMap::CLASS_DEFAULT : SpyStockProductTableMap::OM_CLASS;
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
     * @return array (SpyStockProduct object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStockProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStockProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStockProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStockProductTableMap::OM_CLASS;
            /** @var SpyStockProduct $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStockProductTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStockProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStockProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStockProduct $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStockProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStockProductTableMap::COL_ID_STOCK_PRODUCT);
            $criteria->addSelectColumn(SpyStockProductTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyStockProductTableMap::COL_FK_STOCK);
            $criteria->addSelectColumn(SpyStockProductTableMap::COL_IS_NEVER_OUT_OF_STOCK);
            $criteria->addSelectColumn(SpyStockProductTableMap::COL_QUANTITY);
        } else {
            $criteria->addSelectColumn($alias . '.id_stock_product');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_stock');
            $criteria->addSelectColumn($alias . '.is_never_out_of_stock');
            $criteria->addSelectColumn($alias . '.quantity');
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
            $criteria->removeSelectColumn(SpyStockProductTableMap::COL_ID_STOCK_PRODUCT);
            $criteria->removeSelectColumn(SpyStockProductTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyStockProductTableMap::COL_FK_STOCK);
            $criteria->removeSelectColumn(SpyStockProductTableMap::COL_IS_NEVER_OUT_OF_STOCK);
            $criteria->removeSelectColumn(SpyStockProductTableMap::COL_QUANTITY);
        } else {
            $criteria->removeSelectColumn($alias . '.id_stock_product');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_stock');
            $criteria->removeSelectColumn($alias . '.is_never_out_of_stock');
            $criteria->removeSelectColumn($alias . '.quantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStockProductTableMap::DATABASE_NAME)->getTable(SpyStockProductTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStockProduct or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStockProduct object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Stock\Persistence\SpyStockProduct) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStockProductTableMap::DATABASE_NAME);
            $criteria->add(SpyStockProductTableMap::COL_ID_STOCK_PRODUCT, (array) $values, Criteria::IN);
        }

        $query = SpyStockProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStockProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStockProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_stock_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStockProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStockProduct or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStockProduct object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStockProduct object
        }

        if ($criteria->containsKey(SpyStockProductTableMap::COL_ID_STOCK_PRODUCT) && $criteria->keyContainsValue(SpyStockProductTableMap::COL_ID_STOCK_PRODUCT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStockProductTableMap::COL_ID_STOCK_PRODUCT.')');
        }


        // Set the correct dbName
        $query = SpyStockProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
