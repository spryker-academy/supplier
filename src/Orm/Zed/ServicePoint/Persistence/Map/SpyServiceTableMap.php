<?php

namespace Orm\Zed\ServicePoint\Persistence\Map;

use Orm\Zed\ServicePoint\Persistence\SpyService;
use Orm\Zed\ServicePoint\Persistence\SpyServiceQuery;
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
 * This class defines the structure of the 'spy_service' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyServiceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ServicePoint.Persistence.Map.SpyServiceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_service';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyService';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyService';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ServicePoint.Persistence.SpyService';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_service field
     */
    public const COL_ID_SERVICE = 'spy_service.id_service';

    /**
     * the column name for the fk_service_point field
     */
    public const COL_FK_SERVICE_POINT = 'spy_service.fk_service_point';

    /**
     * the column name for the fk_service_type field
     */
    public const COL_FK_SERVICE_TYPE = 'spy_service.fk_service_type';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_service.is_active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_service.key';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_service.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_service.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_service.updated_at';

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
        self::TYPE_PHPNAME       => ['IdService', 'FkServicePoint', 'FkServiceType', 'IsActive', 'Key', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idService', 'fkServicePoint', 'fkServiceType', 'isActive', 'key', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyServiceTableMap::COL_ID_SERVICE, SpyServiceTableMap::COL_FK_SERVICE_POINT, SpyServiceTableMap::COL_FK_SERVICE_TYPE, SpyServiceTableMap::COL_IS_ACTIVE, SpyServiceTableMap::COL_KEY, SpyServiceTableMap::COL_UUID, SpyServiceTableMap::COL_CREATED_AT, SpyServiceTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_service', 'fk_service_point', 'fk_service_type', 'is_active', 'key', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdService' => 0, 'FkServicePoint' => 1, 'FkServiceType' => 2, 'IsActive' => 3, 'Key' => 4, 'Uuid' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idService' => 0, 'fkServicePoint' => 1, 'fkServiceType' => 2, 'isActive' => 3, 'key' => 4, 'uuid' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyServiceTableMap::COL_ID_SERVICE => 0, SpyServiceTableMap::COL_FK_SERVICE_POINT => 1, SpyServiceTableMap::COL_FK_SERVICE_TYPE => 2, SpyServiceTableMap::COL_IS_ACTIVE => 3, SpyServiceTableMap::COL_KEY => 4, SpyServiceTableMap::COL_UUID => 5, SpyServiceTableMap::COL_CREATED_AT => 6, SpyServiceTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_service' => 0, 'fk_service_point' => 1, 'fk_service_type' => 2, 'is_active' => 3, 'key' => 4, 'uuid' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdService' => 'ID_SERVICE',
        'SpyService.IdService' => 'ID_SERVICE',
        'idService' => 'ID_SERVICE',
        'spyService.idService' => 'ID_SERVICE',
        'SpyServiceTableMap::COL_ID_SERVICE' => 'ID_SERVICE',
        'COL_ID_SERVICE' => 'ID_SERVICE',
        'id_service' => 'ID_SERVICE',
        'spy_service.id_service' => 'ID_SERVICE',
        'FkServicePoint' => 'FK_SERVICE_POINT',
        'SpyService.FkServicePoint' => 'FK_SERVICE_POINT',
        'fkServicePoint' => 'FK_SERVICE_POINT',
        'spyService.fkServicePoint' => 'FK_SERVICE_POINT',
        'SpyServiceTableMap::COL_FK_SERVICE_POINT' => 'FK_SERVICE_POINT',
        'COL_FK_SERVICE_POINT' => 'FK_SERVICE_POINT',
        'fk_service_point' => 'FK_SERVICE_POINT',
        'spy_service.fk_service_point' => 'FK_SERVICE_POINT',
        'FkServiceType' => 'FK_SERVICE_TYPE',
        'SpyService.FkServiceType' => 'FK_SERVICE_TYPE',
        'fkServiceType' => 'FK_SERVICE_TYPE',
        'spyService.fkServiceType' => 'FK_SERVICE_TYPE',
        'SpyServiceTableMap::COL_FK_SERVICE_TYPE' => 'FK_SERVICE_TYPE',
        'COL_FK_SERVICE_TYPE' => 'FK_SERVICE_TYPE',
        'fk_service_type' => 'FK_SERVICE_TYPE',
        'spy_service.fk_service_type' => 'FK_SERVICE_TYPE',
        'IsActive' => 'IS_ACTIVE',
        'SpyService.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyService.isActive' => 'IS_ACTIVE',
        'SpyServiceTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_service.is_active' => 'IS_ACTIVE',
        'Key' => 'KEY',
        'SpyService.Key' => 'KEY',
        'key' => 'KEY',
        'spyService.key' => 'KEY',
        'SpyServiceTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_service.key' => 'KEY',
        'Uuid' => 'UUID',
        'SpyService.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyService.uuid' => 'UUID',
        'SpyServiceTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_service.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyService.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyService.createdAt' => 'CREATED_AT',
        'SpyServiceTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_service.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyService.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyService.updatedAt' => 'UPDATED_AT',
        'SpyServiceTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_service.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_service');
        $this->setPhpName('SpyService');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ServicePoint\\Persistence\\SpyService');
        $this->setPackage('src.Orm.Zed.ServicePoint.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_service_pk_seq');
        // columns
        $this->addPrimaryKey('id_service', 'IdService', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_service_point', 'FkServicePoint', 'INTEGER', 'spy_service_point', 'id_service_point', true, null, null);
        $this->addForeignKey('fk_service_type', 'FkServiceType', 'INTEGER', 'spy_service_type', 'id_service_type', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
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
        $this->addRelation('ServicePoint', '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServicePoint', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_service_point',
    1 => ':id_service_point',
  ),
), null, null, null, false);
        $this->addRelation('ServiceType', '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServiceType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_service_type',
    1 => ':id_service_type',
  ),
), null, null, null, false);
        $this->addRelation('ProductOfferService', '\\Orm\\Zed\\ProductOfferServicePoint\\Persistence\\SpyProductOfferService', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_service',
    1 => ':id_service',
  ),
), null, null, 'ProductOfferServices', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_service'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_service_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyServiceTableMap::CLASS_DEFAULT : SpyServiceTableMap::OM_CLASS;
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
     * @return array (SpyService object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyServiceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyServiceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyServiceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyServiceTableMap::OM_CLASS;
            /** @var SpyService $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyServiceTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyServiceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyServiceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyService $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyServiceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyServiceTableMap::COL_ID_SERVICE);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_FK_SERVICE_POINT);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_FK_SERVICE_TYPE);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyServiceTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_service');
            $criteria->addSelectColumn($alias . '.fk_service_point');
            $criteria->addSelectColumn($alias . '.fk_service_type');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_ID_SERVICE);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_FK_SERVICE_POINT);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_FK_SERVICE_TYPE);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyServiceTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_service');
            $criteria->removeSelectColumn($alias . '.fk_service_point');
            $criteria->removeSelectColumn($alias . '.fk_service_type');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyServiceTableMap::DATABASE_NAME)->getTable(SpyServiceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyService or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyService object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyServiceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ServicePoint\Persistence\SpyService) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyServiceTableMap::DATABASE_NAME);
            $criteria->add(SpyServiceTableMap::COL_ID_SERVICE, (array) $values, Criteria::IN);
        }

        $query = SpyServiceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyServiceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyServiceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_service table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyServiceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyService or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyService object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyServiceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyService object
        }

        if ($criteria->containsKey(SpyServiceTableMap::COL_ID_SERVICE) && $criteria->keyContainsValue(SpyServiceTableMap::COL_ID_SERVICE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyServiceTableMap::COL_ID_SERVICE.')');
        }


        // Set the correct dbName
        $query = SpyServiceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
