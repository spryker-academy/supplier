<?php

namespace Orm\Zed\Oms\Persistence\Map;

use Orm\Zed\Oms\Persistence\SpyOmsProductReservation;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservationQuery;
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
 * This class defines the structure of the 'spy_oms_product_reservation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOmsProductReservationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oms.Persistence.Map.SpyOmsProductReservationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oms_product_reservation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOmsProductReservation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsProductReservation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oms.Persistence.SpyOmsProductReservation';

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
     * the column name for the id_oms_product_reservation field
     */
    public const COL_ID_OMS_PRODUCT_RESERVATION = 'spy_oms_product_reservation.id_oms_product_reservation';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_oms_product_reservation.fk_store';

    /**
     * the column name for the reservation_quantity field
     */
    public const COL_RESERVATION_QUANTITY = 'spy_oms_product_reservation.reservation_quantity';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_oms_product_reservation.sku';

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
        self::TYPE_PHPNAME       => ['IdOmsProductReservation', 'FkStore', 'ReservationQuantity', 'Sku', ],
        self::TYPE_CAMELNAME     => ['idOmsProductReservation', 'fkStore', 'reservationQuantity', 'sku', ],
        self::TYPE_COLNAME       => [SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION, SpyOmsProductReservationTableMap::COL_FK_STORE, SpyOmsProductReservationTableMap::COL_RESERVATION_QUANTITY, SpyOmsProductReservationTableMap::COL_SKU, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_reservation', 'fk_store', 'reservation_quantity', 'sku', ],
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
        self::TYPE_PHPNAME       => ['IdOmsProductReservation' => 0, 'FkStore' => 1, 'ReservationQuantity' => 2, 'Sku' => 3, ],
        self::TYPE_CAMELNAME     => ['idOmsProductReservation' => 0, 'fkStore' => 1, 'reservationQuantity' => 2, 'sku' => 3, ],
        self::TYPE_COLNAME       => [SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION => 0, SpyOmsProductReservationTableMap::COL_FK_STORE => 1, SpyOmsProductReservationTableMap::COL_RESERVATION_QUANTITY => 2, SpyOmsProductReservationTableMap::COL_SKU => 3, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_reservation' => 0, 'fk_store' => 1, 'reservation_quantity' => 2, 'sku' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOmsProductReservation' => 'ID_OMS_PRODUCT_RESERVATION',
        'SpyOmsProductReservation.IdOmsProductReservation' => 'ID_OMS_PRODUCT_RESERVATION',
        'idOmsProductReservation' => 'ID_OMS_PRODUCT_RESERVATION',
        'spyOmsProductReservation.idOmsProductReservation' => 'ID_OMS_PRODUCT_RESERVATION',
        'SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION' => 'ID_OMS_PRODUCT_RESERVATION',
        'COL_ID_OMS_PRODUCT_RESERVATION' => 'ID_OMS_PRODUCT_RESERVATION',
        'id_oms_product_reservation' => 'ID_OMS_PRODUCT_RESERVATION',
        'spy_oms_product_reservation.id_oms_product_reservation' => 'ID_OMS_PRODUCT_RESERVATION',
        'FkStore' => 'FK_STORE',
        'SpyOmsProductReservation.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyOmsProductReservation.fkStore' => 'FK_STORE',
        'SpyOmsProductReservationTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_oms_product_reservation.fk_store' => 'FK_STORE',
        'ReservationQuantity' => 'RESERVATION_QUANTITY',
        'SpyOmsProductReservation.ReservationQuantity' => 'RESERVATION_QUANTITY',
        'reservationQuantity' => 'RESERVATION_QUANTITY',
        'spyOmsProductReservation.reservationQuantity' => 'RESERVATION_QUANTITY',
        'SpyOmsProductReservationTableMap::COL_RESERVATION_QUANTITY' => 'RESERVATION_QUANTITY',
        'COL_RESERVATION_QUANTITY' => 'RESERVATION_QUANTITY',
        'reservation_quantity' => 'RESERVATION_QUANTITY',
        'spy_oms_product_reservation.reservation_quantity' => 'RESERVATION_QUANTITY',
        'Sku' => 'SKU',
        'SpyOmsProductReservation.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyOmsProductReservation.sku' => 'SKU',
        'SpyOmsProductReservationTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_oms_product_reservation.sku' => 'SKU',
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
        $this->setName('spy_oms_product_reservation');
        $this->setPhpName('SpyOmsProductReservation');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oms\\Persistence\\SpyOmsProductReservation');
        $this->setPackage('src.Orm.Zed.Oms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oms_product_reservation_pk_seq');
        // columns
        $this->addPrimaryKey('id_oms_product_reservation', 'IdOmsProductReservation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('reservation_quantity', 'ReservationQuantity', 'DECIMAL', true, 20, 0);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
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
            'event' => ['spy_oms_product_reservation_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOmsProductReservation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOmsProductReservationTableMap::CLASS_DEFAULT : SpyOmsProductReservationTableMap::OM_CLASS;
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
     * @return array (SpyOmsProductReservation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOmsProductReservationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOmsProductReservationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOmsProductReservationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOmsProductReservationTableMap::OM_CLASS;
            /** @var SpyOmsProductReservation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOmsProductReservationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOmsProductReservationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOmsProductReservationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOmsProductReservation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOmsProductReservationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION);
            $criteria->addSelectColumn(SpyOmsProductReservationTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyOmsProductReservationTableMap::COL_RESERVATION_QUANTITY);
            $criteria->addSelectColumn(SpyOmsProductReservationTableMap::COL_SKU);
        } else {
            $criteria->addSelectColumn($alias . '.id_oms_product_reservation');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.reservation_quantity');
            $criteria->addSelectColumn($alias . '.sku');
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
            $criteria->removeSelectColumn(SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION);
            $criteria->removeSelectColumn(SpyOmsProductReservationTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyOmsProductReservationTableMap::COL_RESERVATION_QUANTITY);
            $criteria->removeSelectColumn(SpyOmsProductReservationTableMap::COL_SKU);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oms_product_reservation');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.reservation_quantity');
            $criteria->removeSelectColumn($alias . '.sku');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOmsProductReservationTableMap::DATABASE_NAME)->getTable(SpyOmsProductReservationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOmsProductReservation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOmsProductReservation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductReservationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oms\Persistence\SpyOmsProductReservation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOmsProductReservationTableMap::DATABASE_NAME);
            $criteria->add(SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION, (array) $values, Criteria::IN);
        }

        $query = SpyOmsProductReservationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOmsProductReservationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOmsProductReservationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oms_product_reservation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOmsProductReservationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOmsProductReservation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOmsProductReservation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductReservationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOmsProductReservation object
        }

        if ($criteria->containsKey(SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION) && $criteria->keyContainsValue(SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOmsProductReservationTableMap::COL_ID_OMS_PRODUCT_RESERVATION.')');
        }


        // Set the correct dbName
        $query = SpyOmsProductReservationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
