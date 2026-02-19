<?php

namespace Orm\Zed\OmsProductOfferReservation\Persistence\Map;

use Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation;
use Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservationQuery;
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
 * This class defines the structure of the 'spy_oms_product_offer_reservation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOmsProductOfferReservationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.OmsProductOfferReservation.Persistence.Map.SpyOmsProductOfferReservationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oms_product_offer_reservation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOmsProductOfferReservation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\OmsProductOfferReservation\\Persistence\\SpyOmsProductOfferReservation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.OmsProductOfferReservation.Persistence.SpyOmsProductOfferReservation';

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
     * the column name for the id_oms_product_offer_reservation field
     */
    public const COL_ID_OMS_PRODUCT_OFFER_RESERVATION = 'spy_oms_product_offer_reservation.id_oms_product_offer_reservation';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_oms_product_offer_reservation.fk_store';

    /**
     * the column name for the product_offer_reference field
     */
    public const COL_PRODUCT_OFFER_REFERENCE = 'spy_oms_product_offer_reservation.product_offer_reference';

    /**
     * the column name for the reservation_quantity field
     */
    public const COL_RESERVATION_QUANTITY = 'spy_oms_product_offer_reservation.reservation_quantity';

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
        self::TYPE_PHPNAME       => ['IdOmsProductOfferReservation', 'FkStore', 'ProductOfferReference', 'ReservationQuantity', ],
        self::TYPE_CAMELNAME     => ['idOmsProductOfferReservation', 'fkStore', 'productOfferReference', 'reservationQuantity', ],
        self::TYPE_COLNAME       => [SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION, SpyOmsProductOfferReservationTableMap::COL_FK_STORE, SpyOmsProductOfferReservationTableMap::COL_PRODUCT_OFFER_REFERENCE, SpyOmsProductOfferReservationTableMap::COL_RESERVATION_QUANTITY, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_offer_reservation', 'fk_store', 'product_offer_reference', 'reservation_quantity', ],
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
        self::TYPE_PHPNAME       => ['IdOmsProductOfferReservation' => 0, 'FkStore' => 1, 'ProductOfferReference' => 2, 'ReservationQuantity' => 3, ],
        self::TYPE_CAMELNAME     => ['idOmsProductOfferReservation' => 0, 'fkStore' => 1, 'productOfferReference' => 2, 'reservationQuantity' => 3, ],
        self::TYPE_COLNAME       => [SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION => 0, SpyOmsProductOfferReservationTableMap::COL_FK_STORE => 1, SpyOmsProductOfferReservationTableMap::COL_PRODUCT_OFFER_REFERENCE => 2, SpyOmsProductOfferReservationTableMap::COL_RESERVATION_QUANTITY => 3, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_offer_reservation' => 0, 'fk_store' => 1, 'product_offer_reference' => 2, 'reservation_quantity' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOmsProductOfferReservation' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'SpyOmsProductOfferReservation.IdOmsProductOfferReservation' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'idOmsProductOfferReservation' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'spyOmsProductOfferReservation.idOmsProductOfferReservation' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'COL_ID_OMS_PRODUCT_OFFER_RESERVATION' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'id_oms_product_offer_reservation' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'spy_oms_product_offer_reservation.id_oms_product_offer_reservation' => 'ID_OMS_PRODUCT_OFFER_RESERVATION',
        'FkStore' => 'FK_STORE',
        'SpyOmsProductOfferReservation.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyOmsProductOfferReservation.fkStore' => 'FK_STORE',
        'SpyOmsProductOfferReservationTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_oms_product_offer_reservation.fk_store' => 'FK_STORE',
        'ProductOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'SpyOmsProductOfferReservation.ProductOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'productOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'spyOmsProductOfferReservation.productOfferReference' => 'PRODUCT_OFFER_REFERENCE',
        'SpyOmsProductOfferReservationTableMap::COL_PRODUCT_OFFER_REFERENCE' => 'PRODUCT_OFFER_REFERENCE',
        'COL_PRODUCT_OFFER_REFERENCE' => 'PRODUCT_OFFER_REFERENCE',
        'product_offer_reference' => 'PRODUCT_OFFER_REFERENCE',
        'spy_oms_product_offer_reservation.product_offer_reference' => 'PRODUCT_OFFER_REFERENCE',
        'ReservationQuantity' => 'RESERVATION_QUANTITY',
        'SpyOmsProductOfferReservation.ReservationQuantity' => 'RESERVATION_QUANTITY',
        'reservationQuantity' => 'RESERVATION_QUANTITY',
        'spyOmsProductOfferReservation.reservationQuantity' => 'RESERVATION_QUANTITY',
        'SpyOmsProductOfferReservationTableMap::COL_RESERVATION_QUANTITY' => 'RESERVATION_QUANTITY',
        'COL_RESERVATION_QUANTITY' => 'RESERVATION_QUANTITY',
        'reservation_quantity' => 'RESERVATION_QUANTITY',
        'spy_oms_product_offer_reservation.reservation_quantity' => 'RESERVATION_QUANTITY',
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
        $this->setName('spy_oms_product_offer_reservation');
        $this->setPhpName('SpyOmsProductOfferReservation');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\OmsProductOfferReservation\\Persistence\\SpyOmsProductOfferReservation');
        $this->setPackage('src.Orm.Zed.OmsProductOfferReservation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oms_product_offer_reservation_pk_seq');
        // columns
        $this->addPrimaryKey('id_oms_product_offer_reservation', 'IdOmsProductOfferReservation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('product_offer_reference', 'ProductOfferReference', 'VARCHAR', true, 255, null);
        $this->addColumn('reservation_quantity', 'ReservationQuantity', 'DECIMAL', true, 20, 0);
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
            'event' => ['spy_oms_product_offer_reservation_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOmsProductOfferReservation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOmsProductOfferReservationTableMap::CLASS_DEFAULT : SpyOmsProductOfferReservationTableMap::OM_CLASS;
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
     * @return array (SpyOmsProductOfferReservation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOmsProductOfferReservationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOmsProductOfferReservationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOmsProductOfferReservationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOmsProductOfferReservationTableMap::OM_CLASS;
            /** @var SpyOmsProductOfferReservation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOmsProductOfferReservationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOmsProductOfferReservationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOmsProductOfferReservationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOmsProductOfferReservation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOmsProductOfferReservationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION);
            $criteria->addSelectColumn(SpyOmsProductOfferReservationTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyOmsProductOfferReservationTableMap::COL_PRODUCT_OFFER_REFERENCE);
            $criteria->addSelectColumn(SpyOmsProductOfferReservationTableMap::COL_RESERVATION_QUANTITY);
        } else {
            $criteria->addSelectColumn($alias . '.id_oms_product_offer_reservation');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.product_offer_reference');
            $criteria->addSelectColumn($alias . '.reservation_quantity');
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
            $criteria->removeSelectColumn(SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION);
            $criteria->removeSelectColumn(SpyOmsProductOfferReservationTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyOmsProductOfferReservationTableMap::COL_PRODUCT_OFFER_REFERENCE);
            $criteria->removeSelectColumn(SpyOmsProductOfferReservationTableMap::COL_RESERVATION_QUANTITY);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oms_product_offer_reservation');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.product_offer_reference');
            $criteria->removeSelectColumn($alias . '.reservation_quantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOmsProductOfferReservationTableMap::DATABASE_NAME)->getTable(SpyOmsProductOfferReservationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOmsProductOfferReservation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOmsProductOfferReservation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductOfferReservationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\OmsProductOfferReservation\Persistence\SpyOmsProductOfferReservation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOmsProductOfferReservationTableMap::DATABASE_NAME);
            $criteria->add(SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION, (array) $values, Criteria::IN);
        }

        $query = SpyOmsProductOfferReservationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOmsProductOfferReservationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOmsProductOfferReservationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oms_product_offer_reservation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOmsProductOfferReservationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOmsProductOfferReservation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOmsProductOfferReservation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductOfferReservationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOmsProductOfferReservation object
        }

        if ($criteria->containsKey(SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION) && $criteria->keyContainsValue(SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOmsProductOfferReservationTableMap::COL_ID_OMS_PRODUCT_OFFER_RESERVATION.')');
        }


        // Set the correct dbName
        $query = SpyOmsProductOfferReservationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
