<?php

namespace Orm\Zed\ShipmentTypeServicePoint\Persistence\Map;

use Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType;
use Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceTypeQuery;
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
 * This class defines the structure of the 'spy_shipment_type_service_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShipmentTypeServiceTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShipmentTypeServicePoint.Persistence.Map.SpyShipmentTypeServiceTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shipment_type_service_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShipmentTypeServiceType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShipmentTypeServicePoint\\Persistence\\SpyShipmentTypeServiceType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShipmentTypeServicePoint.Persistence.SpyShipmentTypeServiceType';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_shipment_type_service_type field
     */
    public const COL_ID_SHIPMENT_TYPE_SERVICE_TYPE = 'spy_shipment_type_service_type.id_shipment_type_service_type';

    /**
     * the column name for the fk_shipment_type field
     */
    public const COL_FK_SHIPMENT_TYPE = 'spy_shipment_type_service_type.fk_shipment_type';

    /**
     * the column name for the fk_service_type field
     */
    public const COL_FK_SERVICE_TYPE = 'spy_shipment_type_service_type.fk_service_type';

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
        self::TYPE_PHPNAME       => ['IdShipmentTypeServiceType', 'FkShipmentType', 'FkServiceType', ],
        self::TYPE_CAMELNAME     => ['idShipmentTypeServiceType', 'fkShipmentType', 'fkServiceType', ],
        self::TYPE_COLNAME       => [SpyShipmentTypeServiceTypeTableMap::COL_ID_SHIPMENT_TYPE_SERVICE_TYPE, SpyShipmentTypeServiceTypeTableMap::COL_FK_SHIPMENT_TYPE, SpyShipmentTypeServiceTypeTableMap::COL_FK_SERVICE_TYPE, ],
        self::TYPE_FIELDNAME     => ['id_shipment_type_service_type', 'fk_shipment_type', 'fk_service_type', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['IdShipmentTypeServiceType' => 0, 'FkShipmentType' => 1, 'FkServiceType' => 2, ],
        self::TYPE_CAMELNAME     => ['idShipmentTypeServiceType' => 0, 'fkShipmentType' => 1, 'fkServiceType' => 2, ],
        self::TYPE_COLNAME       => [SpyShipmentTypeServiceTypeTableMap::COL_ID_SHIPMENT_TYPE_SERVICE_TYPE => 0, SpyShipmentTypeServiceTypeTableMap::COL_FK_SHIPMENT_TYPE => 1, SpyShipmentTypeServiceTypeTableMap::COL_FK_SERVICE_TYPE => 2, ],
        self::TYPE_FIELDNAME     => ['id_shipment_type_service_type' => 0, 'fk_shipment_type' => 1, 'fk_service_type' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShipmentTypeServiceType' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'SpyShipmentTypeServiceType.IdShipmentTypeServiceType' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'idShipmentTypeServiceType' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'spyShipmentTypeServiceType.idShipmentTypeServiceType' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'SpyShipmentTypeServiceTypeTableMap::COL_ID_SHIPMENT_TYPE_SERVICE_TYPE' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'COL_ID_SHIPMENT_TYPE_SERVICE_TYPE' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'id_shipment_type_service_type' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'spy_shipment_type_service_type.id_shipment_type_service_type' => 'ID_SHIPMENT_TYPE_SERVICE_TYPE',
        'FkShipmentType' => 'FK_SHIPMENT_TYPE',
        'SpyShipmentTypeServiceType.FkShipmentType' => 'FK_SHIPMENT_TYPE',
        'fkShipmentType' => 'FK_SHIPMENT_TYPE',
        'spyShipmentTypeServiceType.fkShipmentType' => 'FK_SHIPMENT_TYPE',
        'SpyShipmentTypeServiceTypeTableMap::COL_FK_SHIPMENT_TYPE' => 'FK_SHIPMENT_TYPE',
        'COL_FK_SHIPMENT_TYPE' => 'FK_SHIPMENT_TYPE',
        'fk_shipment_type' => 'FK_SHIPMENT_TYPE',
        'spy_shipment_type_service_type.fk_shipment_type' => 'FK_SHIPMENT_TYPE',
        'FkServiceType' => 'FK_SERVICE_TYPE',
        'SpyShipmentTypeServiceType.FkServiceType' => 'FK_SERVICE_TYPE',
        'fkServiceType' => 'FK_SERVICE_TYPE',
        'spyShipmentTypeServiceType.fkServiceType' => 'FK_SERVICE_TYPE',
        'SpyShipmentTypeServiceTypeTableMap::COL_FK_SERVICE_TYPE' => 'FK_SERVICE_TYPE',
        'COL_FK_SERVICE_TYPE' => 'FK_SERVICE_TYPE',
        'fk_service_type' => 'FK_SERVICE_TYPE',
        'spy_shipment_type_service_type.fk_service_type' => 'FK_SERVICE_TYPE',
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
        $this->setName('spy_shipment_type_service_type');
        $this->setPhpName('SpyShipmentTypeServiceType');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ShipmentTypeServicePoint\\Persistence\\SpyShipmentTypeServiceType');
        $this->setPackage('src.Orm.Zed.ShipmentTypeServicePoint.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shipment_type_service_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_shipment_type_service_type', 'IdShipmentTypeServiceType', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_shipment_type', 'FkShipmentType', 'INTEGER', 'spy_shipment_type', 'id_shipment_type', true, null, null);
        $this->addForeignKey('fk_service_type', 'FkServiceType', 'INTEGER', 'spy_service_type', 'id_service_type', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyShipmentType', '\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shipment_type',
    1 => ':id_shipment_type',
  ),
), null, null, null, false);
        $this->addRelation('SpyServiceType', '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServiceType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_service_type',
    1 => ':id_service_type',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShipmentTypeServiceType', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShipmentTypeServiceTypeTableMap::CLASS_DEFAULT : SpyShipmentTypeServiceTypeTableMap::OM_CLASS;
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
     * @return array (SpyShipmentTypeServiceType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShipmentTypeServiceTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShipmentTypeServiceTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShipmentTypeServiceTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShipmentTypeServiceTypeTableMap::OM_CLASS;
            /** @var SpyShipmentTypeServiceType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShipmentTypeServiceTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShipmentTypeServiceTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShipmentTypeServiceTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShipmentTypeServiceType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShipmentTypeServiceTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShipmentTypeServiceTypeTableMap::COL_ID_SHIPMENT_TYPE_SERVICE_TYPE);
            $criteria->addSelectColumn(SpyShipmentTypeServiceTypeTableMap::COL_FK_SHIPMENT_TYPE);
            $criteria->addSelectColumn(SpyShipmentTypeServiceTypeTableMap::COL_FK_SERVICE_TYPE);
        } else {
            $criteria->addSelectColumn($alias . '.id_shipment_type_service_type');
            $criteria->addSelectColumn($alias . '.fk_shipment_type');
            $criteria->addSelectColumn($alias . '.fk_service_type');
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
            $criteria->removeSelectColumn(SpyShipmentTypeServiceTypeTableMap::COL_ID_SHIPMENT_TYPE_SERVICE_TYPE);
            $criteria->removeSelectColumn(SpyShipmentTypeServiceTypeTableMap::COL_FK_SHIPMENT_TYPE);
            $criteria->removeSelectColumn(SpyShipmentTypeServiceTypeTableMap::COL_FK_SERVICE_TYPE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shipment_type_service_type');
            $criteria->removeSelectColumn($alias . '.fk_shipment_type');
            $criteria->removeSelectColumn($alias . '.fk_service_type');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShipmentTypeServiceTypeTableMap::DATABASE_NAME)->getTable(SpyShipmentTypeServiceTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShipmentTypeServiceType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShipmentTypeServiceType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeServiceTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShipmentTypeServicePoint\Persistence\SpyShipmentTypeServiceType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShipmentTypeServiceTypeTableMap::DATABASE_NAME);
            $criteria->add(SpyShipmentTypeServiceTypeTableMap::COL_ID_SHIPMENT_TYPE_SERVICE_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpyShipmentTypeServiceTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShipmentTypeServiceTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShipmentTypeServiceTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shipment_type_service_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShipmentTypeServiceTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShipmentTypeServiceType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShipmentTypeServiceType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeServiceTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShipmentTypeServiceType object
        }


        // Set the correct dbName
        $query = SpyShipmentTypeServiceTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
