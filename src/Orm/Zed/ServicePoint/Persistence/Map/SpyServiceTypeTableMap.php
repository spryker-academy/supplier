<?php

namespace Orm\Zed\ServicePoint\Persistence\Map;

use Orm\Zed\ServicePoint\Persistence\SpyServiceType;
use Orm\Zed\ServicePoint\Persistence\SpyServiceTypeQuery;
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
 * This class defines the structure of the 'spy_service_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyServiceTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ServicePoint.Persistence.Map.SpyServiceTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_service_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyServiceType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServiceType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ServicePoint.Persistence.SpyServiceType';

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
     * the column name for the id_service_type field
     */
    public const COL_ID_SERVICE_TYPE = 'spy_service_type.id_service_type';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_service_type.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_service_type.name';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_service_type.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_service_type.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_service_type.updated_at';

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
        self::TYPE_PHPNAME       => ['IdServiceType', 'Key', 'Name', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idServiceType', 'key', 'name', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE, SpyServiceTypeTableMap::COL_KEY, SpyServiceTypeTableMap::COL_NAME, SpyServiceTypeTableMap::COL_UUID, SpyServiceTypeTableMap::COL_CREATED_AT, SpyServiceTypeTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_service_type', 'key', 'name', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdServiceType' => 0, 'Key' => 1, 'Name' => 2, 'Uuid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idServiceType' => 0, 'key' => 1, 'name' => 2, 'uuid' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE => 0, SpyServiceTypeTableMap::COL_KEY => 1, SpyServiceTypeTableMap::COL_NAME => 2, SpyServiceTypeTableMap::COL_UUID => 3, SpyServiceTypeTableMap::COL_CREATED_AT => 4, SpyServiceTypeTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_service_type' => 0, 'key' => 1, 'name' => 2, 'uuid' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdServiceType' => 'ID_SERVICE_TYPE',
        'SpyServiceType.IdServiceType' => 'ID_SERVICE_TYPE',
        'idServiceType' => 'ID_SERVICE_TYPE',
        'spyServiceType.idServiceType' => 'ID_SERVICE_TYPE',
        'SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE' => 'ID_SERVICE_TYPE',
        'COL_ID_SERVICE_TYPE' => 'ID_SERVICE_TYPE',
        'id_service_type' => 'ID_SERVICE_TYPE',
        'spy_service_type.id_service_type' => 'ID_SERVICE_TYPE',
        'Key' => 'KEY',
        'SpyServiceType.Key' => 'KEY',
        'key' => 'KEY',
        'spyServiceType.key' => 'KEY',
        'SpyServiceTypeTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_service_type.key' => 'KEY',
        'Name' => 'NAME',
        'SpyServiceType.Name' => 'NAME',
        'name' => 'NAME',
        'spyServiceType.name' => 'NAME',
        'SpyServiceTypeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_service_type.name' => 'NAME',
        'Uuid' => 'UUID',
        'SpyServiceType.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyServiceType.uuid' => 'UUID',
        'SpyServiceTypeTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_service_type.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyServiceType.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyServiceType.createdAt' => 'CREATED_AT',
        'SpyServiceTypeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_service_type.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyServiceType.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyServiceType.updatedAt' => 'UPDATED_AT',
        'SpyServiceTypeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_service_type.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_service_type');
        $this->setPhpName('SpyServiceType');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServiceType');
        $this->setPackage('src.Orm.Zed.ServicePoint.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_service_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_service_type', 'IdServiceType', 'INTEGER', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
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
        $this->addRelation('Service', '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyService', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_service_type',
    1 => ':id_service_type',
  ),
), null, null, 'Services', false);
        $this->addRelation('SpyShipmentTypeServiceType', '\\Orm\\Zed\\ShipmentTypeServicePoint\\Persistence\\SpyShipmentTypeServiceType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_service_type',
    1 => ':id_service_type',
  ),
), null, null, 'SpyShipmentTypeServiceTypes', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_service_type'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_service_type_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdServiceType', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyServiceTypeTableMap::CLASS_DEFAULT : SpyServiceTypeTableMap::OM_CLASS;
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
     * @return array (SpyServiceType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyServiceTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyServiceTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyServiceTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyServiceTypeTableMap::OM_CLASS;
            /** @var SpyServiceType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyServiceTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyServiceTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyServiceTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyServiceType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyServiceTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE);
            $criteria->addSelectColumn(SpyServiceTypeTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyServiceTypeTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyServiceTypeTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyServiceTypeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyServiceTypeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_service_type');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE);
            $criteria->removeSelectColumn(SpyServiceTypeTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyServiceTypeTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyServiceTypeTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyServiceTypeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyServiceTypeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_service_type');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyServiceTypeTableMap::DATABASE_NAME)->getTable(SpyServiceTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyServiceType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyServiceType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyServiceTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ServicePoint\Persistence\SpyServiceType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyServiceTypeTableMap::DATABASE_NAME);
            $criteria->add(SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpyServiceTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyServiceTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyServiceTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_service_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyServiceTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyServiceType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyServiceType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyServiceTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyServiceType object
        }

        if ($criteria->containsKey(SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE) && $criteria->keyContainsValue(SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyServiceTypeTableMap::COL_ID_SERVICE_TYPE.')');
        }


        // Set the correct dbName
        $query = SpyServiceTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
