<?php

namespace Orm\Zed\Shipment\Persistence\Map;

use Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice;
use Orm\Zed\Shipment\Persistence\SpyShipmentMethodPriceQuery;
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
 * This class defines the structure of the 'spy_shipment_method_price' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShipmentMethodPriceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Shipment.Persistence.Map.SpyShipmentMethodPriceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shipment_method_price';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShipmentMethodPrice';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Shipment\\Persistence\\SpyShipmentMethodPrice';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Shipment.Persistence.SpyShipmentMethodPrice';

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
     * the column name for the id_shipment_method_price field
     */
    public const COL_ID_SHIPMENT_METHOD_PRICE = 'spy_shipment_method_price.id_shipment_method_price';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_shipment_method_price.fk_currency';

    /**
     * the column name for the fk_shipment_method field
     */
    public const COL_FK_SHIPMENT_METHOD = 'spy_shipment_method_price.fk_shipment_method';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_shipment_method_price.fk_store';

    /**
     * the column name for the default_gross_price field
     */
    public const COL_DEFAULT_GROSS_PRICE = 'spy_shipment_method_price.default_gross_price';

    /**
     * the column name for the default_net_price field
     */
    public const COL_DEFAULT_NET_PRICE = 'spy_shipment_method_price.default_net_price';

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
        self::TYPE_PHPNAME       => ['IdShipmentMethodPrice', 'FkCurrency', 'FkShipmentMethod', 'FkStore', 'DefaultGrossPrice', 'DefaultNetPrice', ],
        self::TYPE_CAMELNAME     => ['idShipmentMethodPrice', 'fkCurrency', 'fkShipmentMethod', 'fkStore', 'defaultGrossPrice', 'defaultNetPrice', ],
        self::TYPE_COLNAME       => [SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE, SpyShipmentMethodPriceTableMap::COL_FK_CURRENCY, SpyShipmentMethodPriceTableMap::COL_FK_SHIPMENT_METHOD, SpyShipmentMethodPriceTableMap::COL_FK_STORE, SpyShipmentMethodPriceTableMap::COL_DEFAULT_GROSS_PRICE, SpyShipmentMethodPriceTableMap::COL_DEFAULT_NET_PRICE, ],
        self::TYPE_FIELDNAME     => ['id_shipment_method_price', 'fk_currency', 'fk_shipment_method', 'fk_store', 'default_gross_price', 'default_net_price', ],
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
        self::TYPE_PHPNAME       => ['IdShipmentMethodPrice' => 0, 'FkCurrency' => 1, 'FkShipmentMethod' => 2, 'FkStore' => 3, 'DefaultGrossPrice' => 4, 'DefaultNetPrice' => 5, ],
        self::TYPE_CAMELNAME     => ['idShipmentMethodPrice' => 0, 'fkCurrency' => 1, 'fkShipmentMethod' => 2, 'fkStore' => 3, 'defaultGrossPrice' => 4, 'defaultNetPrice' => 5, ],
        self::TYPE_COLNAME       => [SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE => 0, SpyShipmentMethodPriceTableMap::COL_FK_CURRENCY => 1, SpyShipmentMethodPriceTableMap::COL_FK_SHIPMENT_METHOD => 2, SpyShipmentMethodPriceTableMap::COL_FK_STORE => 3, SpyShipmentMethodPriceTableMap::COL_DEFAULT_GROSS_PRICE => 4, SpyShipmentMethodPriceTableMap::COL_DEFAULT_NET_PRICE => 5, ],
        self::TYPE_FIELDNAME     => ['id_shipment_method_price' => 0, 'fk_currency' => 1, 'fk_shipment_method' => 2, 'fk_store' => 3, 'default_gross_price' => 4, 'default_net_price' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShipmentMethodPrice' => 'ID_SHIPMENT_METHOD_PRICE',
        'SpyShipmentMethodPrice.IdShipmentMethodPrice' => 'ID_SHIPMENT_METHOD_PRICE',
        'idShipmentMethodPrice' => 'ID_SHIPMENT_METHOD_PRICE',
        'spyShipmentMethodPrice.idShipmentMethodPrice' => 'ID_SHIPMENT_METHOD_PRICE',
        'SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE' => 'ID_SHIPMENT_METHOD_PRICE',
        'COL_ID_SHIPMENT_METHOD_PRICE' => 'ID_SHIPMENT_METHOD_PRICE',
        'id_shipment_method_price' => 'ID_SHIPMENT_METHOD_PRICE',
        'spy_shipment_method_price.id_shipment_method_price' => 'ID_SHIPMENT_METHOD_PRICE',
        'FkCurrency' => 'FK_CURRENCY',
        'SpyShipmentMethodPrice.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spyShipmentMethodPrice.fkCurrency' => 'FK_CURRENCY',
        'SpyShipmentMethodPriceTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_shipment_method_price.fk_currency' => 'FK_CURRENCY',
        'FkShipmentMethod' => 'FK_SHIPMENT_METHOD',
        'SpyShipmentMethodPrice.FkShipmentMethod' => 'FK_SHIPMENT_METHOD',
        'fkShipmentMethod' => 'FK_SHIPMENT_METHOD',
        'spyShipmentMethodPrice.fkShipmentMethod' => 'FK_SHIPMENT_METHOD',
        'SpyShipmentMethodPriceTableMap::COL_FK_SHIPMENT_METHOD' => 'FK_SHIPMENT_METHOD',
        'COL_FK_SHIPMENT_METHOD' => 'FK_SHIPMENT_METHOD',
        'fk_shipment_method' => 'FK_SHIPMENT_METHOD',
        'spy_shipment_method_price.fk_shipment_method' => 'FK_SHIPMENT_METHOD',
        'FkStore' => 'FK_STORE',
        'SpyShipmentMethodPrice.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyShipmentMethodPrice.fkStore' => 'FK_STORE',
        'SpyShipmentMethodPriceTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_shipment_method_price.fk_store' => 'FK_STORE',
        'DefaultGrossPrice' => 'DEFAULT_GROSS_PRICE',
        'SpyShipmentMethodPrice.DefaultGrossPrice' => 'DEFAULT_GROSS_PRICE',
        'defaultGrossPrice' => 'DEFAULT_GROSS_PRICE',
        'spyShipmentMethodPrice.defaultGrossPrice' => 'DEFAULT_GROSS_PRICE',
        'SpyShipmentMethodPriceTableMap::COL_DEFAULT_GROSS_PRICE' => 'DEFAULT_GROSS_PRICE',
        'COL_DEFAULT_GROSS_PRICE' => 'DEFAULT_GROSS_PRICE',
        'default_gross_price' => 'DEFAULT_GROSS_PRICE',
        'spy_shipment_method_price.default_gross_price' => 'DEFAULT_GROSS_PRICE',
        'DefaultNetPrice' => 'DEFAULT_NET_PRICE',
        'SpyShipmentMethodPrice.DefaultNetPrice' => 'DEFAULT_NET_PRICE',
        'defaultNetPrice' => 'DEFAULT_NET_PRICE',
        'spyShipmentMethodPrice.defaultNetPrice' => 'DEFAULT_NET_PRICE',
        'SpyShipmentMethodPriceTableMap::COL_DEFAULT_NET_PRICE' => 'DEFAULT_NET_PRICE',
        'COL_DEFAULT_NET_PRICE' => 'DEFAULT_NET_PRICE',
        'default_net_price' => 'DEFAULT_NET_PRICE',
        'spy_shipment_method_price.default_net_price' => 'DEFAULT_NET_PRICE',
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
        $this->setName('spy_shipment_method_price');
        $this->setPhpName('SpyShipmentMethodPrice');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Shipment\\Persistence\\SpyShipmentMethodPrice');
        $this->setPackage('src.Orm.Zed.Shipment.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shipment_method_price_pk_seq');
        // columns
        $this->addPrimaryKey('id_shipment_method_price', 'IdShipmentMethodPrice', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
        $this->addForeignKey('fk_shipment_method', 'FkShipmentMethod', 'INTEGER', 'spy_shipment_method', 'id_shipment_method', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('default_gross_price', 'DefaultGrossPrice', 'INTEGER', false, null, null);
        $this->addColumn('default_net_price', 'DefaultNetPrice', 'INTEGER', false, null, null);
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
        $this->addRelation('ShipmentMethod', '\\Orm\\Zed\\Shipment\\Persistence\\SpyShipmentMethod', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shipment_method',
    1 => ':id_shipment_method',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShipmentMethodPrice', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShipmentMethodPriceTableMap::CLASS_DEFAULT : SpyShipmentMethodPriceTableMap::OM_CLASS;
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
     * @return array (SpyShipmentMethodPrice object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShipmentMethodPriceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShipmentMethodPriceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShipmentMethodPriceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShipmentMethodPriceTableMap::OM_CLASS;
            /** @var SpyShipmentMethodPrice $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShipmentMethodPriceTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShipmentMethodPriceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShipmentMethodPriceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShipmentMethodPrice $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShipmentMethodPriceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE);
            $criteria->addSelectColumn(SpyShipmentMethodPriceTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpyShipmentMethodPriceTableMap::COL_FK_SHIPMENT_METHOD);
            $criteria->addSelectColumn(SpyShipmentMethodPriceTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyShipmentMethodPriceTableMap::COL_DEFAULT_GROSS_PRICE);
            $criteria->addSelectColumn(SpyShipmentMethodPriceTableMap::COL_DEFAULT_NET_PRICE);
        } else {
            $criteria->addSelectColumn($alias . '.id_shipment_method_price');
            $criteria->addSelectColumn($alias . '.fk_currency');
            $criteria->addSelectColumn($alias . '.fk_shipment_method');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.default_gross_price');
            $criteria->addSelectColumn($alias . '.default_net_price');
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
            $criteria->removeSelectColumn(SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE);
            $criteria->removeSelectColumn(SpyShipmentMethodPriceTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpyShipmentMethodPriceTableMap::COL_FK_SHIPMENT_METHOD);
            $criteria->removeSelectColumn(SpyShipmentMethodPriceTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyShipmentMethodPriceTableMap::COL_DEFAULT_GROSS_PRICE);
            $criteria->removeSelectColumn(SpyShipmentMethodPriceTableMap::COL_DEFAULT_NET_PRICE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shipment_method_price');
            $criteria->removeSelectColumn($alias . '.fk_currency');
            $criteria->removeSelectColumn($alias . '.fk_shipment_method');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.default_gross_price');
            $criteria->removeSelectColumn($alias . '.default_net_price');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShipmentMethodPriceTableMap::DATABASE_NAME)->getTable(SpyShipmentMethodPriceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShipmentMethodPrice or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShipmentMethodPrice object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentMethodPriceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Shipment\Persistence\SpyShipmentMethodPrice) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShipmentMethodPriceTableMap::DATABASE_NAME);
            $criteria->add(SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE, (array) $values, Criteria::IN);
        }

        $query = SpyShipmentMethodPriceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShipmentMethodPriceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShipmentMethodPriceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shipment_method_price table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShipmentMethodPriceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShipmentMethodPrice or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShipmentMethodPrice object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentMethodPriceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShipmentMethodPrice object
        }

        if ($criteria->containsKey(SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE) && $criteria->keyContainsValue(SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShipmentMethodPriceTableMap::COL_ID_SHIPMENT_METHOD_PRICE.')');
        }


        // Set the correct dbName
        $query = SpyShipmentMethodPriceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
