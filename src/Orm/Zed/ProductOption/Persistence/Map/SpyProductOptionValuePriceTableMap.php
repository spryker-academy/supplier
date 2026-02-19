<?php

namespace Orm\Zed\ProductOption\Persistence\Map;

use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePriceQuery;
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
 * This class defines the structure of the 'spy_product_option_value_price' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductOptionValuePriceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductOption.Persistence.Map.SpyProductOptionValuePriceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_option_value_price';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductOptionValuePrice';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValuePrice';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductOption.Persistence.SpyProductOptionValuePrice';

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
     * the column name for the id_product_option_value_price field
     */
    public const COL_ID_PRODUCT_OPTION_VALUE_PRICE = 'spy_product_option_value_price.id_product_option_value_price';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_product_option_value_price.fk_currency';

    /**
     * the column name for the fk_product_option_value field
     */
    public const COL_FK_PRODUCT_OPTION_VALUE = 'spy_product_option_value_price.fk_product_option_value';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_product_option_value_price.fk_store';

    /**
     * the column name for the gross_price field
     */
    public const COL_GROSS_PRICE = 'spy_product_option_value_price.gross_price';

    /**
     * the column name for the net_price field
     */
    public const COL_NET_PRICE = 'spy_product_option_value_price.net_price';

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
        self::TYPE_PHPNAME       => ['IdProductOptionValuePrice', 'FkCurrency', 'FkProductOptionValue', 'FkStore', 'GrossPrice', 'NetPrice', ],
        self::TYPE_CAMELNAME     => ['idProductOptionValuePrice', 'fkCurrency', 'fkProductOptionValue', 'fkStore', 'grossPrice', 'netPrice', ],
        self::TYPE_COLNAME       => [SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE, SpyProductOptionValuePriceTableMap::COL_FK_CURRENCY, SpyProductOptionValuePriceTableMap::COL_FK_PRODUCT_OPTION_VALUE, SpyProductOptionValuePriceTableMap::COL_FK_STORE, SpyProductOptionValuePriceTableMap::COL_GROSS_PRICE, SpyProductOptionValuePriceTableMap::COL_NET_PRICE, ],
        self::TYPE_FIELDNAME     => ['id_product_option_value_price', 'fk_currency', 'fk_product_option_value', 'fk_store', 'gross_price', 'net_price', ],
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
        self::TYPE_PHPNAME       => ['IdProductOptionValuePrice' => 0, 'FkCurrency' => 1, 'FkProductOptionValue' => 2, 'FkStore' => 3, 'GrossPrice' => 4, 'NetPrice' => 5, ],
        self::TYPE_CAMELNAME     => ['idProductOptionValuePrice' => 0, 'fkCurrency' => 1, 'fkProductOptionValue' => 2, 'fkStore' => 3, 'grossPrice' => 4, 'netPrice' => 5, ],
        self::TYPE_COLNAME       => [SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE => 0, SpyProductOptionValuePriceTableMap::COL_FK_CURRENCY => 1, SpyProductOptionValuePriceTableMap::COL_FK_PRODUCT_OPTION_VALUE => 2, SpyProductOptionValuePriceTableMap::COL_FK_STORE => 3, SpyProductOptionValuePriceTableMap::COL_GROSS_PRICE => 4, SpyProductOptionValuePriceTableMap::COL_NET_PRICE => 5, ],
        self::TYPE_FIELDNAME     => ['id_product_option_value_price' => 0, 'fk_currency' => 1, 'fk_product_option_value' => 2, 'fk_store' => 3, 'gross_price' => 4, 'net_price' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductOptionValuePrice' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'SpyProductOptionValuePrice.IdProductOptionValuePrice' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'idProductOptionValuePrice' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'spyProductOptionValuePrice.idProductOptionValuePrice' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'COL_ID_PRODUCT_OPTION_VALUE_PRICE' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'id_product_option_value_price' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'spy_product_option_value_price.id_product_option_value_price' => 'ID_PRODUCT_OPTION_VALUE_PRICE',
        'FkCurrency' => 'FK_CURRENCY',
        'SpyProductOptionValuePrice.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spyProductOptionValuePrice.fkCurrency' => 'FK_CURRENCY',
        'SpyProductOptionValuePriceTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_product_option_value_price.fk_currency' => 'FK_CURRENCY',
        'FkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'SpyProductOptionValuePrice.FkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'fkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'spyProductOptionValuePrice.fkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'SpyProductOptionValuePriceTableMap::COL_FK_PRODUCT_OPTION_VALUE' => 'FK_PRODUCT_OPTION_VALUE',
        'COL_FK_PRODUCT_OPTION_VALUE' => 'FK_PRODUCT_OPTION_VALUE',
        'fk_product_option_value' => 'FK_PRODUCT_OPTION_VALUE',
        'spy_product_option_value_price.fk_product_option_value' => 'FK_PRODUCT_OPTION_VALUE',
        'FkStore' => 'FK_STORE',
        'SpyProductOptionValuePrice.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyProductOptionValuePrice.fkStore' => 'FK_STORE',
        'SpyProductOptionValuePriceTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_product_option_value_price.fk_store' => 'FK_STORE',
        'GrossPrice' => 'GROSS_PRICE',
        'SpyProductOptionValuePrice.GrossPrice' => 'GROSS_PRICE',
        'grossPrice' => 'GROSS_PRICE',
        'spyProductOptionValuePrice.grossPrice' => 'GROSS_PRICE',
        'SpyProductOptionValuePriceTableMap::COL_GROSS_PRICE' => 'GROSS_PRICE',
        'COL_GROSS_PRICE' => 'GROSS_PRICE',
        'gross_price' => 'GROSS_PRICE',
        'spy_product_option_value_price.gross_price' => 'GROSS_PRICE',
        'NetPrice' => 'NET_PRICE',
        'SpyProductOptionValuePrice.NetPrice' => 'NET_PRICE',
        'netPrice' => 'NET_PRICE',
        'spyProductOptionValuePrice.netPrice' => 'NET_PRICE',
        'SpyProductOptionValuePriceTableMap::COL_NET_PRICE' => 'NET_PRICE',
        'COL_NET_PRICE' => 'NET_PRICE',
        'net_price' => 'NET_PRICE',
        'spy_product_option_value_price.net_price' => 'NET_PRICE',
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
        $this->setName('spy_product_option_value_price');
        $this->setPhpName('SpyProductOptionValuePrice');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValuePrice');
        $this->setPackage('src.Orm.Zed.ProductOption.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_option_value_price_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_option_value_price', 'IdProductOptionValuePrice', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
        $this->addForeignKey('fk_product_option_value', 'FkProductOptionValue', 'INTEGER', 'spy_product_option_value', 'id_product_option_value', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('gross_price', 'GrossPrice', 'INTEGER', false, null, null);
        $this->addColumn('net_price', 'NetPrice', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Currency', '\\Orm\\Zed\\Currency\\Persistence\\SpyCurrency', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_currency',
    1 => ':id_currency',
  ),
), null, null, null, false);
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
  ),
), null, null, null, false);
        $this->addRelation('ProductOptionValue', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValue', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_option_value',
    1 => ':id_product_option_value',
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
            'event' => ['spy_product_option_value_price_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductOptionValuePrice', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductOptionValuePriceTableMap::CLASS_DEFAULT : SpyProductOptionValuePriceTableMap::OM_CLASS;
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
     * @return array (SpyProductOptionValuePrice object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductOptionValuePriceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductOptionValuePriceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductOptionValuePriceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductOptionValuePriceTableMap::OM_CLASS;
            /** @var SpyProductOptionValuePrice $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductOptionValuePriceTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductOptionValuePriceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductOptionValuePriceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductOptionValuePrice $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductOptionValuePriceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE);
            $criteria->addSelectColumn(SpyProductOptionValuePriceTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpyProductOptionValuePriceTableMap::COL_FK_PRODUCT_OPTION_VALUE);
            $criteria->addSelectColumn(SpyProductOptionValuePriceTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyProductOptionValuePriceTableMap::COL_GROSS_PRICE);
            $criteria->addSelectColumn(SpyProductOptionValuePriceTableMap::COL_NET_PRICE);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_option_value_price');
            $criteria->addSelectColumn($alias . '.fk_currency');
            $criteria->addSelectColumn($alias . '.fk_product_option_value');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.gross_price');
            $criteria->addSelectColumn($alias . '.net_price');
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
            $criteria->removeSelectColumn(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE);
            $criteria->removeSelectColumn(SpyProductOptionValuePriceTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpyProductOptionValuePriceTableMap::COL_FK_PRODUCT_OPTION_VALUE);
            $criteria->removeSelectColumn(SpyProductOptionValuePriceTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyProductOptionValuePriceTableMap::COL_GROSS_PRICE);
            $criteria->removeSelectColumn(SpyProductOptionValuePriceTableMap::COL_NET_PRICE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_option_value_price');
            $criteria->removeSelectColumn($alias . '.fk_currency');
            $criteria->removeSelectColumn($alias . '.fk_product_option_value');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.gross_price');
            $criteria->removeSelectColumn($alias . '.net_price');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductOptionValuePriceTableMap::DATABASE_NAME)->getTable(SpyProductOptionValuePriceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductOptionValuePrice or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductOptionValuePrice object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValuePriceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionValuePrice) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductOptionValuePriceTableMap::DATABASE_NAME);
            $criteria->add(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE, (array) $values, Criteria::IN);
        }

        $query = SpyProductOptionValuePriceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductOptionValuePriceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductOptionValuePriceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_option_value_price table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductOptionValuePriceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductOptionValuePrice or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductOptionValuePrice object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionValuePriceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductOptionValuePrice object
        }

        if ($criteria->containsKey(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE) && $criteria->keyContainsValue(SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductOptionValuePriceTableMap::COL_ID_PRODUCT_OPTION_VALUE_PRICE.')');
        }


        // Set the correct dbName
        $query = SpyProductOptionValuePriceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
