<?php

namespace Orm\Zed\ProductQuantity\Persistence\Map;

use Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity;
use Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery;
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
 * This class defines the structure of the 'spy_product_quantity' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductQuantityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductQuantity.Persistence.Map.SpyProductQuantityTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_quantity';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductQuantity';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductQuantity\\Persistence\\SpyProductQuantity';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductQuantity.Persistence.SpyProductQuantity';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_product_quantity field
     */
    public const COL_ID_PRODUCT_QUANTITY = 'spy_product_quantity.id_product_quantity';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_quantity.fk_product';

    /**
     * the column name for the quantity_interval field
     */
    public const COL_QUANTITY_INTERVAL = 'spy_product_quantity.quantity_interval';

    /**
     * the column name for the quantity_max field
     */
    public const COL_QUANTITY_MAX = 'spy_product_quantity.quantity_max';

    /**
     * the column name for the quantity_min field
     */
    public const COL_QUANTITY_MIN = 'spy_product_quantity.quantity_min';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_quantity.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_quantity.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductQuantity', 'FkProduct', 'QuantityInterval', 'QuantityMax', 'QuantityMin', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductQuantity', 'fkProduct', 'quantityInterval', 'quantityMax', 'quantityMin', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductQuantityTableMap::COL_ID_PRODUCT_QUANTITY, SpyProductQuantityTableMap::COL_FK_PRODUCT, SpyProductQuantityTableMap::COL_QUANTITY_INTERVAL, SpyProductQuantityTableMap::COL_QUANTITY_MAX, SpyProductQuantityTableMap::COL_QUANTITY_MIN, SpyProductQuantityTableMap::COL_CREATED_AT, SpyProductQuantityTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_quantity', 'fk_product', 'quantity_interval', 'quantity_max', 'quantity_min', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdProductQuantity' => 0, 'FkProduct' => 1, 'QuantityInterval' => 2, 'QuantityMax' => 3, 'QuantityMin' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idProductQuantity' => 0, 'fkProduct' => 1, 'quantityInterval' => 2, 'quantityMax' => 3, 'quantityMin' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyProductQuantityTableMap::COL_ID_PRODUCT_QUANTITY => 0, SpyProductQuantityTableMap::COL_FK_PRODUCT => 1, SpyProductQuantityTableMap::COL_QUANTITY_INTERVAL => 2, SpyProductQuantityTableMap::COL_QUANTITY_MAX => 3, SpyProductQuantityTableMap::COL_QUANTITY_MIN => 4, SpyProductQuantityTableMap::COL_CREATED_AT => 5, SpyProductQuantityTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_product_quantity' => 0, 'fk_product' => 1, 'quantity_interval' => 2, 'quantity_max' => 3, 'quantity_min' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductQuantity' => 'ID_PRODUCT_QUANTITY',
        'SpyProductQuantity.IdProductQuantity' => 'ID_PRODUCT_QUANTITY',
        'idProductQuantity' => 'ID_PRODUCT_QUANTITY',
        'spyProductQuantity.idProductQuantity' => 'ID_PRODUCT_QUANTITY',
        'SpyProductQuantityTableMap::COL_ID_PRODUCT_QUANTITY' => 'ID_PRODUCT_QUANTITY',
        'COL_ID_PRODUCT_QUANTITY' => 'ID_PRODUCT_QUANTITY',
        'id_product_quantity' => 'ID_PRODUCT_QUANTITY',
        'spy_product_quantity.id_product_quantity' => 'ID_PRODUCT_QUANTITY',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductQuantity.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductQuantity.fkProduct' => 'FK_PRODUCT',
        'SpyProductQuantityTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_quantity.fk_product' => 'FK_PRODUCT',
        'QuantityInterval' => 'QUANTITY_INTERVAL',
        'SpyProductQuantity.QuantityInterval' => 'QUANTITY_INTERVAL',
        'quantityInterval' => 'QUANTITY_INTERVAL',
        'spyProductQuantity.quantityInterval' => 'QUANTITY_INTERVAL',
        'SpyProductQuantityTableMap::COL_QUANTITY_INTERVAL' => 'QUANTITY_INTERVAL',
        'COL_QUANTITY_INTERVAL' => 'QUANTITY_INTERVAL',
        'quantity_interval' => 'QUANTITY_INTERVAL',
        'spy_product_quantity.quantity_interval' => 'QUANTITY_INTERVAL',
        'QuantityMax' => 'QUANTITY_MAX',
        'SpyProductQuantity.QuantityMax' => 'QUANTITY_MAX',
        'quantityMax' => 'QUANTITY_MAX',
        'spyProductQuantity.quantityMax' => 'QUANTITY_MAX',
        'SpyProductQuantityTableMap::COL_QUANTITY_MAX' => 'QUANTITY_MAX',
        'COL_QUANTITY_MAX' => 'QUANTITY_MAX',
        'quantity_max' => 'QUANTITY_MAX',
        'spy_product_quantity.quantity_max' => 'QUANTITY_MAX',
        'QuantityMin' => 'QUANTITY_MIN',
        'SpyProductQuantity.QuantityMin' => 'QUANTITY_MIN',
        'quantityMin' => 'QUANTITY_MIN',
        'spyProductQuantity.quantityMin' => 'QUANTITY_MIN',
        'SpyProductQuantityTableMap::COL_QUANTITY_MIN' => 'QUANTITY_MIN',
        'COL_QUANTITY_MIN' => 'QUANTITY_MIN',
        'quantity_min' => 'QUANTITY_MIN',
        'spy_product_quantity.quantity_min' => 'QUANTITY_MIN',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductQuantity.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductQuantity.createdAt' => 'CREATED_AT',
        'SpyProductQuantityTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_quantity.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductQuantity.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductQuantity.updatedAt' => 'UPDATED_AT',
        'SpyProductQuantityTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_quantity.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_quantity');
        $this->setPhpName('SpyProductQuantity');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductQuantity\\Persistence\\SpyProductQuantity');
        $this->setPackage('src.Orm.Zed.ProductQuantity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_quantity_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_quantity', 'IdProductQuantity', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addColumn('quantity_interval', 'QuantityInterval', 'INTEGER', true, null, null);
        $this->addColumn('quantity_max', 'QuantityMax', 'INTEGER', false, null, null);
        $this->addColumn('quantity_min', 'QuantityMin', 'INTEGER', true, null, null);
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
        $this->addRelation('Product', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
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
            'event' => ['spy_product_quantity_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductQuantity', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductQuantityTableMap::CLASS_DEFAULT : SpyProductQuantityTableMap::OM_CLASS;
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
     * @return array (SpyProductQuantity object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductQuantityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductQuantityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductQuantityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductQuantityTableMap::OM_CLASS;
            /** @var SpyProductQuantity $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductQuantityTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductQuantityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductQuantityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductQuantity $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductQuantityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_ID_PRODUCT_QUANTITY);
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_QUANTITY_INTERVAL);
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_QUANTITY_MAX);
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_QUANTITY_MIN);
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductQuantityTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_quantity');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.quantity_interval');
            $criteria->addSelectColumn($alias . '.quantity_max');
            $criteria->addSelectColumn($alias . '.quantity_min');
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
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_ID_PRODUCT_QUANTITY);
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_QUANTITY_INTERVAL);
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_QUANTITY_MAX);
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_QUANTITY_MIN);
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductQuantityTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_quantity');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.quantity_interval');
            $criteria->removeSelectColumn($alias . '.quantity_max');
            $criteria->removeSelectColumn($alias . '.quantity_min');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductQuantityTableMap::DATABASE_NAME)->getTable(SpyProductQuantityTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductQuantity or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductQuantity object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductQuantityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductQuantityTableMap::DATABASE_NAME);
            $criteria->add(SpyProductQuantityTableMap::COL_ID_PRODUCT_QUANTITY, (array) $values, Criteria::IN);
        }

        $query = SpyProductQuantityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductQuantityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductQuantityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_quantity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductQuantityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductQuantity or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductQuantity object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductQuantityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductQuantity object
        }


        // Set the correct dbName
        $query = SpyProductQuantityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
