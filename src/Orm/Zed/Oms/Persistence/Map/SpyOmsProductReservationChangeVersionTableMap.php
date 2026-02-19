<?php

namespace Orm\Zed\Oms\Persistence\Map;

use Orm\Zed\Oms\Persistence\SpyOmsProductReservationChangeVersion;
use Orm\Zed\Oms\Persistence\SpyOmsProductReservationChangeVersionQuery;
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
 * This class defines the structure of the 'spy_oms_product_reservation_change_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOmsProductReservationChangeVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oms.Persistence.Map.SpyOmsProductReservationChangeVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oms_product_reservation_change_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOmsProductReservationChangeVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsProductReservationChangeVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oms.Persistence.SpyOmsProductReservationChangeVersion';

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
     * the column name for the id_oms_product_reservation_id field
     */
    public const COL_ID_OMS_PRODUCT_RESERVATION_ID = 'spy_oms_product_reservation_change_version.id_oms_product_reservation_id';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'spy_oms_product_reservation_change_version.version';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oms_product_reservation_change_version.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_oms_product_reservation_change_version.updated_at';

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
        self::TYPE_PHPNAME       => ['IdOmsProductReservationId', 'Version', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idOmsProductReservationId', 'version', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyOmsProductReservationChangeVersionTableMap::COL_ID_OMS_PRODUCT_RESERVATION_ID, SpyOmsProductReservationChangeVersionTableMap::COL_VERSION, SpyOmsProductReservationChangeVersionTableMap::COL_CREATED_AT, SpyOmsProductReservationChangeVersionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_reservation_id', 'version', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdOmsProductReservationId' => 0, 'Version' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, ],
        self::TYPE_CAMELNAME     => ['idOmsProductReservationId' => 0, 'version' => 1, 'createdAt' => 2, 'updatedAt' => 3, ],
        self::TYPE_COLNAME       => [SpyOmsProductReservationChangeVersionTableMap::COL_ID_OMS_PRODUCT_RESERVATION_ID => 0, SpyOmsProductReservationChangeVersionTableMap::COL_VERSION => 1, SpyOmsProductReservationChangeVersionTableMap::COL_CREATED_AT => 2, SpyOmsProductReservationChangeVersionTableMap::COL_UPDATED_AT => 3, ],
        self::TYPE_FIELDNAME     => ['id_oms_product_reservation_id' => 0, 'version' => 1, 'created_at' => 2, 'updated_at' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOmsProductReservationId' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'SpyOmsProductReservationChangeVersion.IdOmsProductReservationId' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'idOmsProductReservationId' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'spyOmsProductReservationChangeVersion.idOmsProductReservationId' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'SpyOmsProductReservationChangeVersionTableMap::COL_ID_OMS_PRODUCT_RESERVATION_ID' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'COL_ID_OMS_PRODUCT_RESERVATION_ID' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'id_oms_product_reservation_id' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'spy_oms_product_reservation_change_version.id_oms_product_reservation_id' => 'ID_OMS_PRODUCT_RESERVATION_ID',
        'Version' => 'VERSION',
        'SpyOmsProductReservationChangeVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'spyOmsProductReservationChangeVersion.version' => 'VERSION',
        'SpyOmsProductReservationChangeVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'spy_oms_product_reservation_change_version.version' => 'VERSION',
        'CreatedAt' => 'CREATED_AT',
        'SpyOmsProductReservationChangeVersion.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOmsProductReservationChangeVersion.createdAt' => 'CREATED_AT',
        'SpyOmsProductReservationChangeVersionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oms_product_reservation_change_version.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyOmsProductReservationChangeVersion.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyOmsProductReservationChangeVersion.updatedAt' => 'UPDATED_AT',
        'SpyOmsProductReservationChangeVersionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_oms_product_reservation_change_version.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_oms_product_reservation_change_version');
        $this->setPhpName('SpyOmsProductReservationChangeVersion');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oms\\Persistence\\SpyOmsProductReservationChangeVersion');
        $this->setPackage('src.Orm.Zed.Oms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oms_product_reservation_change_version_pk_seq');
        // columns
        $this->addColumn('id_oms_product_reservation_id', 'IdOmsProductReservationId', 'INTEGER', true, null, null);
        $this->addPrimaryKey('version', 'Version', 'BIGINT', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Version', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOmsProductReservationChangeVersionTableMap::CLASS_DEFAULT : SpyOmsProductReservationChangeVersionTableMap::OM_CLASS;
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
     * @return array (SpyOmsProductReservationChangeVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOmsProductReservationChangeVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOmsProductReservationChangeVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOmsProductReservationChangeVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOmsProductReservationChangeVersionTableMap::OM_CLASS;
            /** @var SpyOmsProductReservationChangeVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOmsProductReservationChangeVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOmsProductReservationChangeVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOmsProductReservationChangeVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOmsProductReservationChangeVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOmsProductReservationChangeVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_ID_OMS_PRODUCT_RESERVATION_ID);
            $criteria->addSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_oms_product_reservation_id');
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
            $criteria->removeSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_ID_OMS_PRODUCT_RESERVATION_ID);
            $criteria->removeSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyOmsProductReservationChangeVersionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oms_product_reservation_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOmsProductReservationChangeVersionTableMap::DATABASE_NAME)->getTable(SpyOmsProductReservationChangeVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOmsProductReservationChangeVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOmsProductReservationChangeVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductReservationChangeVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oms\Persistence\SpyOmsProductReservationChangeVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOmsProductReservationChangeVersionTableMap::DATABASE_NAME);
            $criteria->add(SpyOmsProductReservationChangeVersionTableMap::COL_VERSION, (array) $values, Criteria::IN);
        }

        $query = SpyOmsProductReservationChangeVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOmsProductReservationChangeVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOmsProductReservationChangeVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oms_product_reservation_change_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOmsProductReservationChangeVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOmsProductReservationChangeVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOmsProductReservationChangeVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsProductReservationChangeVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOmsProductReservationChangeVersion object
        }

        if ($criteria->containsKey(SpyOmsProductReservationChangeVersionTableMap::COL_VERSION) && $criteria->keyContainsValue(SpyOmsProductReservationChangeVersionTableMap::COL_VERSION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOmsProductReservationChangeVersionTableMap::COL_VERSION.')');
        }


        // Set the correct dbName
        $query = SpyOmsProductReservationChangeVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
