<?php

namespace Orm\Zed\PublishAndSynchronizeHealthCheck\Persistence\Map;

use Orm\Zed\PublishAndSynchronizeHealthCheck\Persistence\SpyPublishAndSynchronizeHealthCheck;
use Orm\Zed\PublishAndSynchronizeHealthCheck\Persistence\SpyPublishAndSynchronizeHealthCheckQuery;
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
 * This class defines the structure of the 'spy_publish_and_synchronize_health_check' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPublishAndSynchronizeHealthCheckTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PublishAndSynchronizeHealthCheck.Persistence.Map.SpyPublishAndSynchronizeHealthCheckTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_publish_and_synchronize_health_check';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPublishAndSynchronizeHealthCheck';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PublishAndSynchronizeHealthCheck\\Persistence\\SpyPublishAndSynchronizeHealthCheck';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PublishAndSynchronizeHealthCheck.Persistence.SpyPublishAndSynchronizeHealthCheck';

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
     * the column name for the id_publish_and_synchronize_health_check field
     */
    public const COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK = 'spy_publish_and_synchronize_health_check.id_publish_and_synchronize_health_check';

    /**
     * the column name for the health_check_key field
     */
    public const COL_HEALTH_CHECK_KEY = 'spy_publish_and_synchronize_health_check.health_check_key';

    /**
     * the column name for the health_check_data field
     */
    public const COL_HEALTH_CHECK_DATA = 'spy_publish_and_synchronize_health_check.health_check_data';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_publish_and_synchronize_health_check.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_publish_and_synchronize_health_check.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPublishAndSynchronizeHealthCheck', 'HealthCheckKey', 'HealthCheckData', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPublishAndSynchronizeHealthCheck', 'healthCheckKey', 'healthCheckData', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK, SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_KEY, SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_DATA, SpyPublishAndSynchronizeHealthCheckTableMap::COL_CREATED_AT, SpyPublishAndSynchronizeHealthCheckTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_publish_and_synchronize_health_check', 'health_check_key', 'health_check_data', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPublishAndSynchronizeHealthCheck' => 0, 'HealthCheckKey' => 1, 'HealthCheckData' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idPublishAndSynchronizeHealthCheck' => 0, 'healthCheckKey' => 1, 'healthCheckData' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK => 0, SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_KEY => 1, SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_DATA => 2, SpyPublishAndSynchronizeHealthCheckTableMap::COL_CREATED_AT => 3, SpyPublishAndSynchronizeHealthCheckTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_publish_and_synchronize_health_check' => 0, 'health_check_key' => 1, 'health_check_data' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPublishAndSynchronizeHealthCheck' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'SpyPublishAndSynchronizeHealthCheck.IdPublishAndSynchronizeHealthCheck' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'idPublishAndSynchronizeHealthCheck' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'spyPublishAndSynchronizeHealthCheck.idPublishAndSynchronizeHealthCheck' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'id_publish_and_synchronize_health_check' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'spy_publish_and_synchronize_health_check.id_publish_and_synchronize_health_check' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'HealthCheckKey' => 'HEALTH_CHECK_KEY',
        'SpyPublishAndSynchronizeHealthCheck.HealthCheckKey' => 'HEALTH_CHECK_KEY',
        'healthCheckKey' => 'HEALTH_CHECK_KEY',
        'spyPublishAndSynchronizeHealthCheck.healthCheckKey' => 'HEALTH_CHECK_KEY',
        'SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_KEY' => 'HEALTH_CHECK_KEY',
        'COL_HEALTH_CHECK_KEY' => 'HEALTH_CHECK_KEY',
        'health_check_key' => 'HEALTH_CHECK_KEY',
        'spy_publish_and_synchronize_health_check.health_check_key' => 'HEALTH_CHECK_KEY',
        'HealthCheckData' => 'HEALTH_CHECK_DATA',
        'SpyPublishAndSynchronizeHealthCheck.HealthCheckData' => 'HEALTH_CHECK_DATA',
        'healthCheckData' => 'HEALTH_CHECK_DATA',
        'spyPublishAndSynchronizeHealthCheck.healthCheckData' => 'HEALTH_CHECK_DATA',
        'SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_DATA' => 'HEALTH_CHECK_DATA',
        'COL_HEALTH_CHECK_DATA' => 'HEALTH_CHECK_DATA',
        'health_check_data' => 'HEALTH_CHECK_DATA',
        'spy_publish_and_synchronize_health_check.health_check_data' => 'HEALTH_CHECK_DATA',
        'CreatedAt' => 'CREATED_AT',
        'SpyPublishAndSynchronizeHealthCheck.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPublishAndSynchronizeHealthCheck.createdAt' => 'CREATED_AT',
        'SpyPublishAndSynchronizeHealthCheckTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_publish_and_synchronize_health_check.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPublishAndSynchronizeHealthCheck.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPublishAndSynchronizeHealthCheck.updatedAt' => 'UPDATED_AT',
        'SpyPublishAndSynchronizeHealthCheckTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_publish_and_synchronize_health_check.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_publish_and_synchronize_health_check');
        $this->setPhpName('SpyPublishAndSynchronizeHealthCheck');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PublishAndSynchronizeHealthCheck\\Persistence\\SpyPublishAndSynchronizeHealthCheck');
        $this->setPackage('src.Orm.Zed.PublishAndSynchronizeHealthCheck.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_publish_and_synchronize_health_check_pk_seq');
        // columns
        $this->addPrimaryKey('id_publish_and_synchronize_health_check', 'IdPublishAndSynchronizeHealthCheck', 'INTEGER', true, null, null);
        $this->addColumn('health_check_key', 'HealthCheckKey', 'VARCHAR', true, 255, null);
        $this->addColumn('health_check_data', 'HealthCheckData', 'VARCHAR', true, 255, null);
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
            'event' => ['spy_publish_and_synchronize_health_check_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPublishAndSynchronizeHealthCheck', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPublishAndSynchronizeHealthCheckTableMap::CLASS_DEFAULT : SpyPublishAndSynchronizeHealthCheckTableMap::OM_CLASS;
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
     * @return array (SpyPublishAndSynchronizeHealthCheck object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPublishAndSynchronizeHealthCheckTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPublishAndSynchronizeHealthCheckTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPublishAndSynchronizeHealthCheckTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPublishAndSynchronizeHealthCheckTableMap::OM_CLASS;
            /** @var SpyPublishAndSynchronizeHealthCheck $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPublishAndSynchronizeHealthCheckTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPublishAndSynchronizeHealthCheckTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPublishAndSynchronizeHealthCheckTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPublishAndSynchronizeHealthCheck $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPublishAndSynchronizeHealthCheckTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_KEY);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_DATA);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_publish_and_synchronize_health_check');
            $criteria->addSelectColumn($alias . '.health_check_key');
            $criteria->addSelectColumn($alias . '.health_check_data');
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
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_KEY);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_HEALTH_CHECK_DATA);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_publish_and_synchronize_health_check');
            $criteria->removeSelectColumn($alias . '.health_check_key');
            $criteria->removeSelectColumn($alias . '.health_check_data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPublishAndSynchronizeHealthCheckTableMap::DATABASE_NAME)->getTable(SpyPublishAndSynchronizeHealthCheckTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPublishAndSynchronizeHealthCheck or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPublishAndSynchronizeHealthCheck object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPublishAndSynchronizeHealthCheckTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PublishAndSynchronizeHealthCheck\Persistence\SpyPublishAndSynchronizeHealthCheck) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPublishAndSynchronizeHealthCheckTableMap::DATABASE_NAME);
            $criteria->add(SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK, (array) $values, Criteria::IN);
        }

        $query = SpyPublishAndSynchronizeHealthCheckQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPublishAndSynchronizeHealthCheckTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPublishAndSynchronizeHealthCheckTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_publish_and_synchronize_health_check table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPublishAndSynchronizeHealthCheckQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPublishAndSynchronizeHealthCheck or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPublishAndSynchronizeHealthCheck object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPublishAndSynchronizeHealthCheckTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPublishAndSynchronizeHealthCheck object
        }

        if ($criteria->containsKey(SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK) && $criteria->keyContainsValue(SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPublishAndSynchronizeHealthCheckTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK.')');
        }


        // Set the correct dbName
        $query = SpyPublishAndSynchronizeHealthCheckQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
