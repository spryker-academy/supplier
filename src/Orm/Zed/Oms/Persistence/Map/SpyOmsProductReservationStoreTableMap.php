<?php

namespace Orm\Zed\Oms\Persistence\Map;

use Orm\Zed\Oms\Persistence\SpyOmsProductReservationStore;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservationStoreQuery;
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
 * This class defines the structure of the 'spy_oms_product_reservation_store' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOmsProductReservationStoreTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oms.Persistence.Map.SpyOmsProductReservationStoreTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oms_product_reservation_store';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOmsProductReservationStore';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsProductReservationStore';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oms.Persistence.SpyOmsProductReservationStore';

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
     * the column name for the id_oms_product_reservation_store field
     */
    public const COL_ID_OMS_PRODUCT_RESERVATION_STORE = 'spy_oms_product_reservation_store.id_oms_product_reservation_store';

    /**
     * the column name for the reservation_quantity field
     */
    public const COL_RESERVATION_QUANTITY = 'spy_oms_product_reservation_store.reservation_quantity';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_oms_product_reservation_store.sku';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_oms_product_reservation_store.store';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'spy_oms_product_reservation_store.version';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oms_product_reservation_store.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_oms_product_reservation_store.updated_at';

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
        self::TYPE_PHPNAME       => ['IdOmsProductReservationStore', 'ReservationQuantity', 'Sku', 'Store', 'Version', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idOmsProductReservationStore', 'reservationQuantity', 'sku', 'store', 'version', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE, SpyOmsProductReservationStoreTableMap::COL_RESERVATION_QUANTITY, SpyOmsProductReservationStoreTableMap::COL_SKU, SpyOmsProductReservationStoreTableMap::COL_STORE, SpyOmsProductReservationStoreTableMap::COL_VERSION, SpyOmsProductReservationStoreTableMap::COL_CREATED_AT, SpyOmsProductReservationStoreTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_reservation_store', 'reservation_quantity', 'sku', 'store', 'version', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdOmsProductReservationStore' => 0, 'ReservationQuantity' => 1, 'Sku' => 2, 'Store' => 3, 'Version' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idOmsProductReservationStore' => 0, 'reservationQuantity' => 1, 'sku' => 2, 'store' => 3, 'version' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE => 0, SpyOmsProductReservationStoreTableMap::COL_RESERVATION_QUANTITY => 1, SpyOmsProductReservationStoreTableMap::COL_SKU => 2, SpyOmsProductReservationStoreTableMap::COL_STORE => 3, SpyOmsProductReservationStoreTableMap::COL_VERSION => 4, SpyOmsProductReservationStoreTableMap::COL_CREATED_AT => 5, SpyOmsProductReservationStoreTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_reservation_store' => 0, 'reservation_quantity' => 1, 'sku' => 2, 'store' => 3, 'version' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOmsProductReservationStore' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'SpyOmsProductReservationStore.IdOmsProductReservationStore' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'idOmsProductReservationStore' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'spyOmsProductReservationStore.idOmsProductReservationStore' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'COL_ID_OMS_PRODUCT_RESERVATION_STORE' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'id_oms_product_reservation_store' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'spy_oms_product_reservation_store.id_oms_product_reservation_store' => 'ID_OMS_PRODUCT_RESERVATION_STORE',
        'ReservationQuantity' => 'RESERVATION_QUANTITY',
        'SpyOmsProductReservationStore.ReservationQuantity' => 'RESERVATION_QUANTITY',
        'reservationQuantity' => 'RESERVATION_QUANTITY',
        'spyOmsProductReservationStore.reservationQuantity' => 'RESERVATION_QUANTITY',
        'SpyOmsProductReservationStoreTableMap::COL_RESERVATION_QUANTITY' => 'RESERVATION_QUANTITY',
        'COL_RESERVATION_QUANTITY' => 'RESERVATION_QUANTITY',
        'reservation_quantity' => 'RESERVATION_QUANTITY',
        'spy_oms_product_reservation_store.reservation_quantity' => 'RESERVATION_QUANTITY',
        'Sku' => 'SKU',
        'SpyOmsProductReservationStore.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyOmsProductReservationStore.sku' => 'SKU',
        'SpyOmsProductReservationStoreTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_oms_product_reservation_store.sku' => 'SKU',
        'Store' => 'STORE',
        'SpyOmsProductReservationStore.Store' => 'STORE',
        'store' => 'STORE',
        'spyOmsProductReservationStore.store' => 'STORE',
        'SpyOmsProductReservationStoreTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_oms_product_reservation_store.store' => 'STORE',
        'Version' => 'VERSION',
        'SpyOmsProductReservationStore.Version' => 'VERSION',
        'version' => 'VERSION',
        'spyOmsProductReservationStore.version' => 'VERSION',
        'SpyOmsProductReservationStoreTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'spy_oms_product_reservation_store.version' => 'VERSION',
        'CreatedAt' => 'CREATED_AT',
        'SpyOmsProductReservationStore.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOmsProductReservationStore.createdAt' => 'CREATED_AT',
        'SpyOmsProductReservationStoreTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oms_product_reservation_store.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyOmsProductReservationStore.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyOmsProductReservationStore.updatedAt' => 'UPDATED_AT',
        'SpyOmsProductReservationStoreTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_oms_product_reservation_store.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_oms_product_reservation_store');
        $this->setPhpName('SpyOmsProductReservationStore');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oms\\Persistence\\SpyOmsProductReservationStore');
        $this->setPackage('src.Orm.Zed.Oms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oms_product_reservation_store_pk_seq');
        // columns
        $this->addPrimaryKey('id_oms_product_reservation_store', 'IdOmsProductReservationStore', 'INTEGER', true, null, null);
        $this->addColumn('reservation_quantity', 'ReservationQuantity', 'DECIMAL', true, 20, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
        $this->addColumn('store', 'Store', 'VARCHAR', true, 255, null);
        $this->addColumn('version', 'Version', 'BIGINT', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOmsProductReservationStore', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOmsProductReservationStoreTableMap::CLASS_DEFAULT : SpyOmsProductReservationStoreTableMap::OM_CLASS;
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
     * @return array (SpyOmsProductReservationStore object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOmsProductReservationStoreTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOmsProductReservationStoreTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOmsProductReservationStoreTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOmsProductReservationStoreTableMap::OM_CLASS;
            /** @var SpyOmsProductReservationStore $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOmsProductReservationStoreTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOmsProductReservationStoreTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOmsProductReservationStoreTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOmsProductReservationStore $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOmsProductReservationStoreTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE);
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_RESERVATION_QUANTITY);
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_SKU);
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_STORE);
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_VERSION);
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyOmsProductReservationStoreTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_oms_product_reservation_store');
            $criteria->addSelectColumn($alias . '.reservation_quantity');
            $criteria->addSelectColumn($alias . '.sku');
            $criteria->addSelectColumn($alias . '.store');
            $criteria->addSelectColumn($alias . '.version');
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
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE);
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_RESERVATION_QUANTITY);
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_VERSION);
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyOmsProductReservationStoreTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oms_product_reservation_store');
            $criteria->removeSelectColumn($alias . '.reservation_quantity');
            $criteria->removeSelectColumn($alias . '.sku');
            $criteria->removeSelectColumn($alias . '.store');
            $criteria->removeSelectColumn($alias . '.version');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOmsProductReservationStoreTableMap::DATABASE_NAME)->getTable(SpyOmsProductReservationStoreTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOmsProductReservationStore or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOmsProductReservationStore object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductReservationStoreTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oms\Persistence\SpyOmsProductReservationStore) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOmsProductReservationStoreTableMap::DATABASE_NAME);
            $criteria->add(SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE, (array) $values, Criteria::IN);
        }

        $query = SpyOmsProductReservationStoreQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOmsProductReservationStoreTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOmsProductReservationStoreTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oms_product_reservation_store table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOmsProductReservationStoreQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOmsProductReservationStore or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOmsProductReservationStore object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductReservationStoreTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOmsProductReservationStore object
        }

        if ($criteria->containsKey(SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE) && $criteria->keyContainsValue(SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOmsProductReservationStoreTableMap::COL_ID_OMS_PRODUCT_RESERVATION_STORE.')');
        }


        // Set the correct dbName
        $query = SpyOmsProductReservationStoreQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
