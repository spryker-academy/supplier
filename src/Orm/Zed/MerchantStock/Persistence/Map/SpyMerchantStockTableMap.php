<?php

namespace Orm\Zed\MerchantStock\Persistence\Map;

use Orm\Zed\MerchantStock\Persistence\SpyMerchantStock;
use Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery;
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
 * This class defines the structure of the 'spy_merchant_stock' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantStockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantStock.Persistence.Map.SpyMerchantStockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_stock';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantStock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantStock\\Persistence\\SpyMerchantStock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantStock.Persistence.SpyMerchantStock';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_merchant_stock field
     */
    public const COL_ID_MERCHANT_STOCK = 'spy_merchant_stock.id_merchant_stock';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'spy_merchant_stock.is_default';

    /**
     * the column name for the fk_stock field
     */
    public const COL_FK_STOCK = 'spy_merchant_stock.fk_stock';

    /**
     * the column name for the fk_merchant field
     */
    public const COL_FK_MERCHANT = 'spy_merchant_stock.fk_merchant';

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
        self::TYPE_PHPNAME       => ['IdMerchantStock', 'IsDefault', 'FkStock', 'FkMerchant', ],
        self::TYPE_CAMELNAME     => ['idMerchantStock', 'isDefault', 'fkStock', 'fkMerchant', ],
        self::TYPE_COLNAME       => [SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK, SpyMerchantStockTableMap::COL_IS_DEFAULT, SpyMerchantStockTableMap::COL_FK_STOCK, SpyMerchantStockTableMap::COL_FK_MERCHANT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_stock', 'is_default', 'fk_stock', 'fk_merchant', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantStock' => 0, 'IsDefault' => 1, 'FkStock' => 2, 'FkMerchant' => 3, ],
        self::TYPE_CAMELNAME     => ['idMerchantStock' => 0, 'isDefault' => 1, 'fkStock' => 2, 'fkMerchant' => 3, ],
        self::TYPE_COLNAME       => [SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK => 0, SpyMerchantStockTableMap::COL_IS_DEFAULT => 1, SpyMerchantStockTableMap::COL_FK_STOCK => 2, SpyMerchantStockTableMap::COL_FK_MERCHANT => 3, ],
        self::TYPE_FIELDNAME     => ['id_merchant_stock' => 0, 'is_default' => 1, 'fk_stock' => 2, 'fk_merchant' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantStock' => 'ID_MERCHANT_STOCK',
        'SpyMerchantStock.IdMerchantStock' => 'ID_MERCHANT_STOCK',
        'idMerchantStock' => 'ID_MERCHANT_STOCK',
        'spyMerchantStock.idMerchantStock' => 'ID_MERCHANT_STOCK',
        'SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK' => 'ID_MERCHANT_STOCK',
        'COL_ID_MERCHANT_STOCK' => 'ID_MERCHANT_STOCK',
        'id_merchant_stock' => 'ID_MERCHANT_STOCK',
        'spy_merchant_stock.id_merchant_stock' => 'ID_MERCHANT_STOCK',
        'IsDefault' => 'IS_DEFAULT',
        'SpyMerchantStock.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'spyMerchantStock.isDefault' => 'IS_DEFAULT',
        'SpyMerchantStockTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'spy_merchant_stock.is_default' => 'IS_DEFAULT',
        'FkStock' => 'FK_STOCK',
        'SpyMerchantStock.FkStock' => 'FK_STOCK',
        'fkStock' => 'FK_STOCK',
        'spyMerchantStock.fkStock' => 'FK_STOCK',
        'SpyMerchantStockTableMap::COL_FK_STOCK' => 'FK_STOCK',
        'COL_FK_STOCK' => 'FK_STOCK',
        'fk_stock' => 'FK_STOCK',
        'spy_merchant_stock.fk_stock' => 'FK_STOCK',
        'FkMerchant' => 'FK_MERCHANT',
        'SpyMerchantStock.FkMerchant' => 'FK_MERCHANT',
        'fkMerchant' => 'FK_MERCHANT',
        'spyMerchantStock.fkMerchant' => 'FK_MERCHANT',
        'SpyMerchantStockTableMap::COL_FK_MERCHANT' => 'FK_MERCHANT',
        'COL_FK_MERCHANT' => 'FK_MERCHANT',
        'fk_merchant' => 'FK_MERCHANT',
        'spy_merchant_stock.fk_merchant' => 'FK_MERCHANT',
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
        $this->setName('spy_merchant_stock');
        $this->setPhpName('SpyMerchantStock');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantStock\\Persistence\\SpyMerchantStock');
        $this->setPackage('src.Orm.Zed.MerchantStock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_stock_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_stock', 'IdMerchantStock', 'INTEGER', true, null, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', true, 1, false);
        $this->addForeignKey('fk_stock', 'FkStock', 'INTEGER', 'spy_stock', 'id_stock', true, null, null);
        $this->addForeignKey('fk_merchant', 'FkMerchant', 'INTEGER', 'spy_merchant', 'id_merchant', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyStock', '\\Orm\\Zed\\Stock\\Persistence\\SpyStock', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantStock', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantStockTableMap::CLASS_DEFAULT : SpyMerchantStockTableMap::OM_CLASS;
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
     * @return array (SpyMerchantStock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantStockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantStockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantStockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantStockTableMap::OM_CLASS;
            /** @var SpyMerchantStock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantStockTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantStockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantStockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantStock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantStockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK);
            $criteria->addSelectColumn(SpyMerchantStockTableMap::COL_IS_DEFAULT);
            $criteria->addSelectColumn(SpyMerchantStockTableMap::COL_FK_STOCK);
            $criteria->addSelectColumn(SpyMerchantStockTableMap::COL_FK_MERCHANT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_stock');
            $criteria->addSelectColumn($alias . '.is_default');
            $criteria->addSelectColumn($alias . '.fk_stock');
            $criteria->addSelectColumn($alias . '.fk_merchant');
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
            $criteria->removeSelectColumn(SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK);
            $criteria->removeSelectColumn(SpyMerchantStockTableMap::COL_IS_DEFAULT);
            $criteria->removeSelectColumn(SpyMerchantStockTableMap::COL_FK_STOCK);
            $criteria->removeSelectColumn(SpyMerchantStockTableMap::COL_FK_MERCHANT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_stock');
            $criteria->removeSelectColumn($alias . '.is_default');
            $criteria->removeSelectColumn($alias . '.fk_stock');
            $criteria->removeSelectColumn($alias . '.fk_merchant');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantStockTableMap::DATABASE_NAME)->getTable(SpyMerchantStockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantStock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantStock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantStockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantStock\Persistence\SpyMerchantStock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantStockTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantStockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantStockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantStockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_stock table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantStockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantStock or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantStock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantStockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantStock object
        }

        if ($criteria->containsKey(SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK) && $criteria->keyContainsValue(SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantStockTableMap::COL_ID_MERCHANT_STOCK.')');
        }


        // Set the correct dbName
        $query = SpyMerchantStockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
