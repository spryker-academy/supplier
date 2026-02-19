<?php

namespace Orm\Zed\ProductOfferStock\Persistence\Map;

use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock;
use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery;
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
 * This class defines the structure of the 'spy_product_offer_stock' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductOfferStockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductOfferStock.Persistence.Map.SpyProductOfferStockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_offer_stock';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductOfferStock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductOfferStock\\Persistence\\SpyProductOfferStock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductOfferStock.Persistence.SpyProductOfferStock';

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
     * the column name for the id_product_offer_stock field
     */
    public const COL_ID_PRODUCT_OFFER_STOCK = 'spy_product_offer_stock.id_product_offer_stock';

    /**
     * the column name for the fk_product_offer field
     */
    public const COL_FK_PRODUCT_OFFER = 'spy_product_offer_stock.fk_product_offer';

    /**
     * the column name for the fk_stock field
     */
    public const COL_FK_STOCK = 'spy_product_offer_stock.fk_stock';

    /**
     * the column name for the is_never_out_of_stock field
     */
    public const COL_IS_NEVER_OUT_OF_STOCK = 'spy_product_offer_stock.is_never_out_of_stock';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'spy_product_offer_stock.quantity';

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
        self::TYPE_PHPNAME       => ['IdProductOfferStock', 'FkProductOffer', 'FkStock', 'IsNeverOutOfStock', 'Quantity', ],
        self::TYPE_CAMELNAME     => ['idProductOfferStock', 'fkProductOffer', 'fkStock', 'isNeverOutOfStock', 'quantity', ],
        self::TYPE_COLNAME       => [SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK, SpyProductOfferStockTableMap::COL_FK_PRODUCT_OFFER, SpyProductOfferStockTableMap::COL_FK_STOCK, SpyProductOfferStockTableMap::COL_IS_NEVER_OUT_OF_STOCK, SpyProductOfferStockTableMap::COL_QUANTITY, ],
        self::TYPE_FIELDNAME     => ['id_product_offer_stock', 'fk_product_offer', 'fk_stock', 'is_never_out_of_stock', 'quantity', ],
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
        self::TYPE_PHPNAME       => ['IdProductOfferStock' => 0, 'FkProductOffer' => 1, 'FkStock' => 2, 'IsNeverOutOfStock' => 3, 'Quantity' => 4, ],
        self::TYPE_CAMELNAME     => ['idProductOfferStock' => 0, 'fkProductOffer' => 1, 'fkStock' => 2, 'isNeverOutOfStock' => 3, 'quantity' => 4, ],
        self::TYPE_COLNAME       => [SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK => 0, SpyProductOfferStockTableMap::COL_FK_PRODUCT_OFFER => 1, SpyProductOfferStockTableMap::COL_FK_STOCK => 2, SpyProductOfferStockTableMap::COL_IS_NEVER_OUT_OF_STOCK => 3, SpyProductOfferStockTableMap::COL_QUANTITY => 4, ],
        self::TYPE_FIELDNAME     => ['id_product_offer_stock' => 0, 'fk_product_offer' => 1, 'fk_stock' => 2, 'is_never_out_of_stock' => 3, 'quantity' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductOfferStock' => 'ID_PRODUCT_OFFER_STOCK',
        'SpyProductOfferStock.IdProductOfferStock' => 'ID_PRODUCT_OFFER_STOCK',
        'idProductOfferStock' => 'ID_PRODUCT_OFFER_STOCK',
        'spyProductOfferStock.idProductOfferStock' => 'ID_PRODUCT_OFFER_STOCK',
        'SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK' => 'ID_PRODUCT_OFFER_STOCK',
        'COL_ID_PRODUCT_OFFER_STOCK' => 'ID_PRODUCT_OFFER_STOCK',
        'id_product_offer_stock' => 'ID_PRODUCT_OFFER_STOCK',
        'spy_product_offer_stock.id_product_offer_stock' => 'ID_PRODUCT_OFFER_STOCK',
        'FkProductOffer' => 'FK_PRODUCT_OFFER',
        'SpyProductOfferStock.FkProductOffer' => 'FK_PRODUCT_OFFER',
        'fkProductOffer' => 'FK_PRODUCT_OFFER',
        'spyProductOfferStock.fkProductOffer' => 'FK_PRODUCT_OFFER',
        'SpyProductOfferStockTableMap::COL_FK_PRODUCT_OFFER' => 'FK_PRODUCT_OFFER',
        'COL_FK_PRODUCT_OFFER' => 'FK_PRODUCT_OFFER',
        'fk_product_offer' => 'FK_PRODUCT_OFFER',
        'spy_product_offer_stock.fk_product_offer' => 'FK_PRODUCT_OFFER',
        'FkStock' => 'FK_STOCK',
        'SpyProductOfferStock.FkStock' => 'FK_STOCK',
        'fkStock' => 'FK_STOCK',
        'spyProductOfferStock.fkStock' => 'FK_STOCK',
        'SpyProductOfferStockTableMap::COL_FK_STOCK' => 'FK_STOCK',
        'COL_FK_STOCK' => 'FK_STOCK',
        'fk_stock' => 'FK_STOCK',
        'spy_product_offer_stock.fk_stock' => 'FK_STOCK',
        'IsNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'SpyProductOfferStock.IsNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'isNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'spyProductOfferStock.isNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'SpyProductOfferStockTableMap::COL_IS_NEVER_OUT_OF_STOCK' => 'IS_NEVER_OUT_OF_STOCK',
        'COL_IS_NEVER_OUT_OF_STOCK' => 'IS_NEVER_OUT_OF_STOCK',
        'is_never_out_of_stock' => 'IS_NEVER_OUT_OF_STOCK',
        'spy_product_offer_stock.is_never_out_of_stock' => 'IS_NEVER_OUT_OF_STOCK',
        'Quantity' => 'QUANTITY',
        'SpyProductOfferStock.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'spyProductOfferStock.quantity' => 'QUANTITY',
        'SpyProductOfferStockTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'spy_product_offer_stock.quantity' => 'QUANTITY',
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
        $this->setName('spy_product_offer_stock');
        $this->setPhpName('SpyProductOfferStock');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductOfferStock\\Persistence\\SpyProductOfferStock');
        $this->setPackage('src.Orm.Zed.ProductOfferStock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_offer_stock_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_offer_stock', 'IdProductOfferStock', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_offer', 'FkProductOffer', 'INTEGER', 'spy_product_offer', 'id_product_offer', true, null, null);
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
        $this->addRelation('SpyProductOffer', '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
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
            'event' => ['spy_product_offer_stock_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductOfferStock', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductOfferStockTableMap::CLASS_DEFAULT : SpyProductOfferStockTableMap::OM_CLASS;
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
     * @return array (SpyProductOfferStock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductOfferStockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductOfferStockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductOfferStockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductOfferStockTableMap::OM_CLASS;
            /** @var SpyProductOfferStock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductOfferStockTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductOfferStockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductOfferStockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductOfferStock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductOfferStockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK);
            $criteria->addSelectColumn(SpyProductOfferStockTableMap::COL_FK_PRODUCT_OFFER);
            $criteria->addSelectColumn(SpyProductOfferStockTableMap::COL_FK_STOCK);
            $criteria->addSelectColumn(SpyProductOfferStockTableMap::COL_IS_NEVER_OUT_OF_STOCK);
            $criteria->addSelectColumn(SpyProductOfferStockTableMap::COL_QUANTITY);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_offer_stock');
            $criteria->addSelectColumn($alias . '.fk_product_offer');
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
            $criteria->removeSelectColumn(SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK);
            $criteria->removeSelectColumn(SpyProductOfferStockTableMap::COL_FK_PRODUCT_OFFER);
            $criteria->removeSelectColumn(SpyProductOfferStockTableMap::COL_FK_STOCK);
            $criteria->removeSelectColumn(SpyProductOfferStockTableMap::COL_IS_NEVER_OUT_OF_STOCK);
            $criteria->removeSelectColumn(SpyProductOfferStockTableMap::COL_QUANTITY);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_offer_stock');
            $criteria->removeSelectColumn($alias . '.fk_product_offer');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductOfferStockTableMap::DATABASE_NAME)->getTable(SpyProductOfferStockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductOfferStock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductOfferStock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferStockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductOfferStockTableMap::DATABASE_NAME);
            $criteria->add(SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK, (array) $values, Criteria::IN);
        }

        $query = SpyProductOfferStockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductOfferStockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductOfferStockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_offer_stock table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductOfferStockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductOfferStock or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductOfferStock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferStockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductOfferStock object
        }

        if ($criteria->containsKey(SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK) && $criteria->keyContainsValue(SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductOfferStockTableMap::COL_ID_PRODUCT_OFFER_STOCK.')');
        }


        // Set the correct dbName
        $query = SpyProductOfferStockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
