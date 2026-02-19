<?php

namespace Orm\Zed\PriceProduct\Persistence\Map;

use Orm\Zed\PriceProduct\Persistence\SpyPriceProduct;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery;
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
 * This class defines the structure of the 'spy_price_product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProduct.Persistence.Map.SpyPriceProductTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProduct';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProduct';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProduct.Persistence.SpyPriceProduct';

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
     * the column name for the id_price_product field
     */
    public const COL_ID_PRICE_PRODUCT = 'spy_price_product.id_price_product';

    /**
     * the column name for the fk_price_type field
     */
    public const COL_FK_PRICE_TYPE = 'spy_price_product.fk_price_type';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_price_product.fk_product';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_price_product.fk_product_abstract';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'spy_price_product.price';

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
        self::TYPE_PHPNAME       => ['IdPriceProduct', 'FkPriceType', 'FkProduct', 'FkProductAbstract', 'Price', ],
        self::TYPE_CAMELNAME     => ['idPriceProduct', 'fkPriceType', 'fkProduct', 'fkProductAbstract', 'price', ],
        self::TYPE_COLNAME       => [SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT, SpyPriceProductTableMap::COL_FK_PRICE_TYPE, SpyPriceProductTableMap::COL_FK_PRODUCT, SpyPriceProductTableMap::COL_FK_PRODUCT_ABSTRACT, SpyPriceProductTableMap::COL_PRICE, ],
        self::TYPE_FIELDNAME     => ['id_price_product', 'fk_price_type', 'fk_product', 'fk_product_abstract', 'price', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProduct' => 0, 'FkPriceType' => 1, 'FkProduct' => 2, 'FkProductAbstract' => 3, 'Price' => 4, ],
        self::TYPE_CAMELNAME     => ['idPriceProduct' => 0, 'fkPriceType' => 1, 'fkProduct' => 2, 'fkProductAbstract' => 3, 'price' => 4, ],
        self::TYPE_COLNAME       => [SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT => 0, SpyPriceProductTableMap::COL_FK_PRICE_TYPE => 1, SpyPriceProductTableMap::COL_FK_PRODUCT => 2, SpyPriceProductTableMap::COL_FK_PRODUCT_ABSTRACT => 3, SpyPriceProductTableMap::COL_PRICE => 4, ],
        self::TYPE_FIELDNAME     => ['id_price_product' => 0, 'fk_price_type' => 1, 'fk_product' => 2, 'fk_product_abstract' => 3, 'price' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProduct' => 'ID_PRICE_PRODUCT',
        'SpyPriceProduct.IdPriceProduct' => 'ID_PRICE_PRODUCT',
        'idPriceProduct' => 'ID_PRICE_PRODUCT',
        'spyPriceProduct.idPriceProduct' => 'ID_PRICE_PRODUCT',
        'SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT' => 'ID_PRICE_PRODUCT',
        'COL_ID_PRICE_PRODUCT' => 'ID_PRICE_PRODUCT',
        'id_price_product' => 'ID_PRICE_PRODUCT',
        'spy_price_product.id_price_product' => 'ID_PRICE_PRODUCT',
        'FkPriceType' => 'FK_PRICE_TYPE',
        'SpyPriceProduct.FkPriceType' => 'FK_PRICE_TYPE',
        'fkPriceType' => 'FK_PRICE_TYPE',
        'spyPriceProduct.fkPriceType' => 'FK_PRICE_TYPE',
        'SpyPriceProductTableMap::COL_FK_PRICE_TYPE' => 'FK_PRICE_TYPE',
        'COL_FK_PRICE_TYPE' => 'FK_PRICE_TYPE',
        'fk_price_type' => 'FK_PRICE_TYPE',
        'spy_price_product.fk_price_type' => 'FK_PRICE_TYPE',
        'FkProduct' => 'FK_PRODUCT',
        'SpyPriceProduct.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyPriceProduct.fkProduct' => 'FK_PRODUCT',
        'SpyPriceProductTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_price_product.fk_product' => 'FK_PRODUCT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProduct.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyPriceProduct.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_price_product.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'Price' => 'PRICE',
        'SpyPriceProduct.Price' => 'PRICE',
        'price' => 'PRICE',
        'spyPriceProduct.price' => 'PRICE',
        'SpyPriceProductTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'spy_price_product.price' => 'PRICE',
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
        $this->setName('spy_price_product');
        $this->setPhpName('SpyPriceProduct');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProduct');
        $this->setPackage('src.Orm.Zed.PriceProduct.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product', 'IdPriceProduct', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_price_type', 'FkPriceType', 'INTEGER', 'spy_price_type', 'id_price_type', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', false, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', false, null, null);
        $this->addColumn('price', 'Price', 'INTEGER', false, null, 0);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Product', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('PriceType', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_type',
    1 => ':id_price_type',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, null, false);
        $this->addRelation('PriceProductStore', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_product',
    1 => ':id_price_product',
  ),
), null, null, 'PriceProductStores', false);
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
            'event' => ['spy_price_product_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProduct', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductTableMap::CLASS_DEFAULT : SpyPriceProductTableMap::OM_CLASS;
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
     * @return array (SpyPriceProduct object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductTableMap::OM_CLASS;
            /** @var SpyPriceProduct $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProduct $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductTableMap::COL_FK_PRICE_TYPE);
            $criteria->addSelectColumn(SpyPriceProductTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyPriceProductTableMap::COL_PRICE);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product');
            $criteria->addSelectColumn($alias . '.fk_price_type');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.price');
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
            $criteria->removeSelectColumn(SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductTableMap::COL_FK_PRICE_TYPE);
            $criteria->removeSelectColumn(SpyPriceProductTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyPriceProductTableMap::COL_PRICE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product');
            $criteria->removeSelectColumn($alias . '.fk_price_type');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.price');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductTableMap::DATABASE_NAME)->getTable(SpyPriceProductTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProduct or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProduct object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProduct\Persistence\SpyPriceProduct) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProduct or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProduct object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProduct object
        }

        if ($criteria->containsKey(SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT) && $criteria->keyContainsValue(SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductTableMap::COL_ID_PRICE_PRODUCT.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
