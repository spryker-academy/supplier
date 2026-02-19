<?php

namespace Orm\Zed\Oms\Persistence\Map;

use Orm\Zed\Oms\Persistence\SpyOmsStateMachineLock;
use Orm\Zed\Oms\Persistence\SpyOmsStateMachineLockQuery;
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
 * This class defines the structure of the 'spy_oms_state_machine_lock' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOmsStateMachineLockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oms.Persistence.Map.SpyOmsStateMachineLockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oms_state_machine_lock';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOmsStateMachineLock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsStateMachineLock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oms.Persistence.SpyOmsStateMachineLock';

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
     * the column name for the id_oms_state_machine_lock field
     */
    public const COL_ID_OMS_STATE_MACHINE_LOCK = 'spy_oms_state_machine_lock.id_oms_state_machine_lock';

    /**
     * the column name for the details field
     */
    public const COL_DETAILS = 'spy_oms_state_machine_lock.details';

    /**
     * the column name for the expires field
     */
    public const COL_EXPIRES = 'spy_oms_state_machine_lock.expires';

    /**
     * the column name for the identifier field
     */
    public const COL_IDENTIFIER = 'spy_oms_state_machine_lock.identifier';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oms_state_machine_lock.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_oms_state_machine_lock.updated_at';

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
        self::TYPE_PHPNAME       => ['IdOmsStateMachineLock', 'Details', 'Expires', 'Identifier', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idOmsStateMachineLock', 'details', 'expires', 'identifier', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK, SpyOmsStateMachineLockTableMap::COL_DETAILS, SpyOmsStateMachineLockTableMap::COL_EXPIRES, SpyOmsStateMachineLockTableMap::COL_IDENTIFIER, SpyOmsStateMachineLockTableMap::COL_CREATED_AT, SpyOmsStateMachineLockTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_oms_state_machine_lock', 'details', 'expires', 'identifier', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdOmsStateMachineLock' => 0, 'Details' => 1, 'Expires' => 2, 'Identifier' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idOmsStateMachineLock' => 0, 'details' => 1, 'expires' => 2, 'identifier' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK => 0, SpyOmsStateMachineLockTableMap::COL_DETAILS => 1, SpyOmsStateMachineLockTableMap::COL_EXPIRES => 2, SpyOmsStateMachineLockTableMap::COL_IDENTIFIER => 3, SpyOmsStateMachineLockTableMap::COL_CREATED_AT => 4, SpyOmsStateMachineLockTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_oms_state_machine_lock' => 0, 'details' => 1, 'expires' => 2, 'identifier' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOmsStateMachineLock' => 'ID_OMS_STATE_MACHINE_LOCK',
        'SpyOmsStateMachineLock.IdOmsStateMachineLock' => 'ID_OMS_STATE_MACHINE_LOCK',
        'idOmsStateMachineLock' => 'ID_OMS_STATE_MACHINE_LOCK',
        'spyOmsStateMachineLock.idOmsStateMachineLock' => 'ID_OMS_STATE_MACHINE_LOCK',
        'SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK' => 'ID_OMS_STATE_MACHINE_LOCK',
        'COL_ID_OMS_STATE_MACHINE_LOCK' => 'ID_OMS_STATE_MACHINE_LOCK',
        'id_oms_state_machine_lock' => 'ID_OMS_STATE_MACHINE_LOCK',
        'spy_oms_state_machine_lock.id_oms_state_machine_lock' => 'ID_OMS_STATE_MACHINE_LOCK',
        'Details' => 'DETAILS',
        'SpyOmsStateMachineLock.Details' => 'DETAILS',
        'details' => 'DETAILS',
        'spyOmsStateMachineLock.details' => 'DETAILS',
        'SpyOmsStateMachineLockTableMap::COL_DETAILS' => 'DETAILS',
        'COL_DETAILS' => 'DETAILS',
        'spy_oms_state_machine_lock.details' => 'DETAILS',
        'Expires' => 'EXPIRES',
        'SpyOmsStateMachineLock.Expires' => 'EXPIRES',
        'expires' => 'EXPIRES',
        'spyOmsStateMachineLock.expires' => 'EXPIRES',
        'SpyOmsStateMachineLockTableMap::COL_EXPIRES' => 'EXPIRES',
        'COL_EXPIRES' => 'EXPIRES',
        'spy_oms_state_machine_lock.expires' => 'EXPIRES',
        'Identifier' => 'IDENTIFIER',
        'SpyOmsStateMachineLock.Identifier' => 'IDENTIFIER',
        'identifier' => 'IDENTIFIER',
        'spyOmsStateMachineLock.identifier' => 'IDENTIFIER',
        'SpyOmsStateMachineLockTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'spy_oms_state_machine_lock.identifier' => 'IDENTIFIER',
        'CreatedAt' => 'CREATED_AT',
        'SpyOmsStateMachineLock.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOmsStateMachineLock.createdAt' => 'CREATED_AT',
        'SpyOmsStateMachineLockTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oms_state_machine_lock.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyOmsStateMachineLock.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyOmsStateMachineLock.updatedAt' => 'UPDATED_AT',
        'SpyOmsStateMachineLockTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_oms_state_machine_lock.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_oms_state_machine_lock');
        $this->setPhpName('SpyOmsStateMachineLock');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oms\\Persistence\\SpyOmsStateMachineLock');
        $this->setPackage('src.Orm.Zed.Oms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oms_state_machine_lock_pk_seq');
        // columns
        $this->addPrimaryKey('id_oms_state_machine_lock', 'IdOmsStateMachineLock', 'BIGINT', true, null, null);
        $this->addColumn('details', 'Details', 'LONGVARCHAR', false, null, null);
        $this->addColumn('expires', 'Expires', 'TIMESTAMP', true, null, null);
        $this->addColumn('identifier', 'Identifier', 'VARCHAR', true, 255, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 0 + $offset
                : self::translateFieldName('IdOmsStateMachineLock', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOmsStateMachineLockTableMap::CLASS_DEFAULT : SpyOmsStateMachineLockTableMap::OM_CLASS;
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
     * @return array (SpyOmsStateMachineLock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOmsStateMachineLockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOmsStateMachineLockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOmsStateMachineLockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOmsStateMachineLockTableMap::OM_CLASS;
            /** @var SpyOmsStateMachineLock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOmsStateMachineLockTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOmsStateMachineLockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOmsStateMachineLockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOmsStateMachineLock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOmsStateMachineLockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK);
            $criteria->addSelectColumn(SpyOmsStateMachineLockTableMap::COL_DETAILS);
            $criteria->addSelectColumn(SpyOmsStateMachineLockTableMap::COL_EXPIRES);
            $criteria->addSelectColumn(SpyOmsStateMachineLockTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(SpyOmsStateMachineLockTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyOmsStateMachineLockTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_oms_state_machine_lock');
            $criteria->addSelectColumn($alias . '.details');
            $criteria->addSelectColumn($alias . '.expires');
            $criteria->addSelectColumn($alias . '.identifier');
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
            $criteria->removeSelectColumn(SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK);
            $criteria->removeSelectColumn(SpyOmsStateMachineLockTableMap::COL_DETAILS);
            $criteria->removeSelectColumn(SpyOmsStateMachineLockTableMap::COL_EXPIRES);
            $criteria->removeSelectColumn(SpyOmsStateMachineLockTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(SpyOmsStateMachineLockTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyOmsStateMachineLockTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oms_state_machine_lock');
            $criteria->removeSelectColumn($alias . '.details');
            $criteria->removeSelectColumn($alias . '.expires');
            $criteria->removeSelectColumn($alias . '.identifier');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOmsStateMachineLockTableMap::DATABASE_NAME)->getTable(SpyOmsStateMachineLockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOmsStateMachineLock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOmsStateMachineLock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsStateMachineLockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oms\Persistence\SpyOmsStateMachineLock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOmsStateMachineLockTableMap::DATABASE_NAME);
            $criteria->add(SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK, (array) $values, Criteria::IN);
        }

        $query = SpyOmsStateMachineLockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOmsStateMachineLockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOmsStateMachineLockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oms_state_machine_lock table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOmsStateMachineLockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOmsStateMachineLock or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOmsStateMachineLock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsStateMachineLockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOmsStateMachineLock object
        }

        if ($criteria->containsKey(SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK) && $criteria->keyContainsValue(SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOmsStateMachineLockTableMap::COL_ID_OMS_STATE_MACHINE_LOCK.')');
        }


        // Set the correct dbName
        $query = SpyOmsStateMachineLockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
