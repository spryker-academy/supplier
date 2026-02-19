<?php

namespace Orm\Zed\ShipmentType\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\Map\SpyProductShipmentTypeTableMap;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentType;
use Orm\Zed\ShipmentType\Persistence\SpyShipmentTypeQuery;
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
 * This class defines the structure of the 'spy_shipment_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShipmentTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShipmentType.Persistence.Map.SpyShipmentTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shipment_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShipmentType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShipmentType.Persistence.SpyShipmentType';

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
     * the column name for the id_shipment_type field
     */
    public const COL_ID_SHIPMENT_TYPE = 'spy_shipment_type.id_shipment_type';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_shipment_type.is_active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_shipment_type.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_shipment_type.name';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_shipment_type.uuid';

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
        self::TYPE_PHPNAME       => ['IdShipmentType', 'IsActive', 'Key', 'Name', 'Uuid', ],
        self::TYPE_CAMELNAME     => ['idShipmentType', 'isActive', 'key', 'name', 'uuid', ],
        self::TYPE_COLNAME       => [SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, SpyShipmentTypeTableMap::COL_IS_ACTIVE, SpyShipmentTypeTableMap::COL_KEY, SpyShipmentTypeTableMap::COL_NAME, SpyShipmentTypeTableMap::COL_UUID, ],
        self::TYPE_FIELDNAME     => ['id_shipment_type', 'is_active', 'key', 'name', 'uuid', ],
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
        self::TYPE_PHPNAME       => ['IdShipmentType' => 0, 'IsActive' => 1, 'Key' => 2, 'Name' => 3, 'Uuid' => 4, ],
        self::TYPE_CAMELNAME     => ['idShipmentType' => 0, 'isActive' => 1, 'key' => 2, 'name' => 3, 'uuid' => 4, ],
        self::TYPE_COLNAME       => [SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE => 0, SpyShipmentTypeTableMap::COL_IS_ACTIVE => 1, SpyShipmentTypeTableMap::COL_KEY => 2, SpyShipmentTypeTableMap::COL_NAME => 3, SpyShipmentTypeTableMap::COL_UUID => 4, ],
        self::TYPE_FIELDNAME     => ['id_shipment_type' => 0, 'is_active' => 1, 'key' => 2, 'name' => 3, 'uuid' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShipmentType' => 'ID_SHIPMENT_TYPE',
        'SpyShipmentType.IdShipmentType' => 'ID_SHIPMENT_TYPE',
        'idShipmentType' => 'ID_SHIPMENT_TYPE',
        'spyShipmentType.idShipmentType' => 'ID_SHIPMENT_TYPE',
        'SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE' => 'ID_SHIPMENT_TYPE',
        'COL_ID_SHIPMENT_TYPE' => 'ID_SHIPMENT_TYPE',
        'id_shipment_type' => 'ID_SHIPMENT_TYPE',
        'spy_shipment_type.id_shipment_type' => 'ID_SHIPMENT_TYPE',
        'IsActive' => 'IS_ACTIVE',
        'SpyShipmentType.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyShipmentType.isActive' => 'IS_ACTIVE',
        'SpyShipmentTypeTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_shipment_type.is_active' => 'IS_ACTIVE',
        'Key' => 'KEY',
        'SpyShipmentType.Key' => 'KEY',
        'key' => 'KEY',
        'spyShipmentType.key' => 'KEY',
        'SpyShipmentTypeTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_shipment_type.key' => 'KEY',
        'Name' => 'NAME',
        'SpyShipmentType.Name' => 'NAME',
        'name' => 'NAME',
        'spyShipmentType.name' => 'NAME',
        'SpyShipmentTypeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_shipment_type.name' => 'NAME',
        'Uuid' => 'UUID',
        'SpyShipmentType.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyShipmentType.uuid' => 'UUID',
        'SpyShipmentTypeTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_shipment_type.uuid' => 'UUID',
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
        $this->setName('spy_shipment_type');
        $this->setPhpName('SpyShipmentType');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentType');
        $this->setPackage('src.Orm.Zed.ShipmentType.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shipment_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_shipment_type', 'IdShipmentType', 'INTEGER', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ProductOfferShipmentType', '\\Orm\\Zed\\ProductOfferShipmentType\\Persistence\\SpyProductOfferShipmentType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shipment_type',
    1 => ':id_shipment_type',
  ),
), null, null, 'ProductOfferShipmentTypes', false);
        $this->addRelation('SpyProductShipmentType', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyProductShipmentType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shipment_type',
    1 => ':id_shipment_type',
  ),
), 'CASCADE', null, 'SpyProductShipmentTypes', false);
        $this->addRelation('ShipmentMethod', '\\Orm\\Zed\\Shipment\\Persistence\\SpyShipmentMethod', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shipment_type',
    1 => ':id_shipment_type',
  ),
), null, null, 'ShipmentMethods', false);
        $this->addRelation('ShipmentTypeStore', '\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentTypeStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shipment_type',
    1 => ':id_shipment_type',
  ),
), null, null, 'ShipmentTypeStores', false);
        $this->addRelation('SpyShipmentTypeServiceType', '\\Orm\\Zed\\ShipmentTypeServicePoint\\Persistence\\SpyShipmentTypeServiceType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shipment_type',
    1 => ':id_shipment_type',
  ),
), null, null, 'SpyShipmentTypeServiceTypes', false);
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_MANY, array(), null, null, 'SpyProducts');
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_shipment_type'],
            'event' => ['spy_shipment_type_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_shipment_type     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyProductShipmentTypeTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShipmentType', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShipmentTypeTableMap::CLASS_DEFAULT : SpyShipmentTypeTableMap::OM_CLASS;
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
     * @return array (SpyShipmentType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShipmentTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShipmentTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShipmentTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShipmentTypeTableMap::OM_CLASS;
            /** @var SpyShipmentType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShipmentTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShipmentTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShipmentTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShipmentType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShipmentTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE);
            $criteria->addSelectColumn(SpyShipmentTypeTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyShipmentTypeTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyShipmentTypeTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyShipmentTypeTableMap::COL_UUID);
        } else {
            $criteria->addSelectColumn($alias . '.id_shipment_type');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE);
            $criteria->removeSelectColumn(SpyShipmentTypeTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyShipmentTypeTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyShipmentTypeTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyShipmentTypeTableMap::COL_UUID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shipment_type');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShipmentTypeTableMap::DATABASE_NAME)->getTable(SpyShipmentTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShipmentType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShipmentType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShipmentType\Persistence\SpyShipmentType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShipmentTypeTableMap::DATABASE_NAME);
            $criteria->add(SpyShipmentTypeTableMap::COL_ID_SHIPMENT_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpyShipmentTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShipmentTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShipmentTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shipment_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShipmentTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShipmentType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShipmentType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShipmentTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShipmentType object
        }


        // Set the correct dbName
        $query = SpyShipmentTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
