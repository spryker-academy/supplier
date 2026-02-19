<?php

namespace Orm\Zed\StateMachine\Persistence\Map;

use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery;
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
 * This class defines the structure of the 'spy_state_machine_item_state' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStateMachineItemStateTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.StateMachine.Persistence.Map.SpyStateMachineItemStateTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_state_machine_item_state';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStateMachineItemState';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineItemState';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.StateMachine.Persistence.SpyStateMachineItemState';

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
     * the column name for the id_state_machine_item_state field
     */
    public const COL_ID_STATE_MACHINE_ITEM_STATE = 'spy_state_machine_item_state.id_state_machine_item_state';

    /**
     * the column name for the fk_state_machine_process field
     */
    public const COL_FK_STATE_MACHINE_PROCESS = 'spy_state_machine_item_state.fk_state_machine_process';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_state_machine_item_state.description';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_state_machine_item_state.name';

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
        self::TYPE_PHPNAME       => ['IdStateMachineItemState', 'FkStateMachineProcess', 'Description', 'Name', ],
        self::TYPE_CAMELNAME     => ['idStateMachineItemState', 'fkStateMachineProcess', 'description', 'name', ],
        self::TYPE_COLNAME       => [SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE, SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS, SpyStateMachineItemStateTableMap::COL_DESCRIPTION, SpyStateMachineItemStateTableMap::COL_NAME, ],
        self::TYPE_FIELDNAME     => ['id_state_machine_item_state', 'fk_state_machine_process', 'description', 'name', ],
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
        self::TYPE_PHPNAME       => ['IdStateMachineItemState' => 0, 'FkStateMachineProcess' => 1, 'Description' => 2, 'Name' => 3, ],
        self::TYPE_CAMELNAME     => ['idStateMachineItemState' => 0, 'fkStateMachineProcess' => 1, 'description' => 2, 'name' => 3, ],
        self::TYPE_COLNAME       => [SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE => 0, SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS => 1, SpyStateMachineItemStateTableMap::COL_DESCRIPTION => 2, SpyStateMachineItemStateTableMap::COL_NAME => 3, ],
        self::TYPE_FIELDNAME     => ['id_state_machine_item_state' => 0, 'fk_state_machine_process' => 1, 'description' => 2, 'name' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdStateMachineItemState' => 'ID_STATE_MACHINE_ITEM_STATE',
        'SpyStateMachineItemState.IdStateMachineItemState' => 'ID_STATE_MACHINE_ITEM_STATE',
        'idStateMachineItemState' => 'ID_STATE_MACHINE_ITEM_STATE',
        'spyStateMachineItemState.idStateMachineItemState' => 'ID_STATE_MACHINE_ITEM_STATE',
        'SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE' => 'ID_STATE_MACHINE_ITEM_STATE',
        'COL_ID_STATE_MACHINE_ITEM_STATE' => 'ID_STATE_MACHINE_ITEM_STATE',
        'id_state_machine_item_state' => 'ID_STATE_MACHINE_ITEM_STATE',
        'spy_state_machine_item_state.id_state_machine_item_state' => 'ID_STATE_MACHINE_ITEM_STATE',
        'FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyStateMachineItemState.FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'spyStateMachineItemState.fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'spy_state_machine_item_state.fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'Description' => 'DESCRIPTION',
        'SpyStateMachineItemState.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyStateMachineItemState.description' => 'DESCRIPTION',
        'SpyStateMachineItemStateTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_state_machine_item_state.description' => 'DESCRIPTION',
        'Name' => 'NAME',
        'SpyStateMachineItemState.Name' => 'NAME',
        'name' => 'NAME',
        'spyStateMachineItemState.name' => 'NAME',
        'SpyStateMachineItemStateTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_state_machine_item_state.name' => 'NAME',
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
        $this->setName('spy_state_machine_item_state');
        $this->setPhpName('SpyStateMachineItemState');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineItemState');
        $this->setPackage('src.Orm.Zed.StateMachine.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_state_machine_item_state_pk_seq');
        // columns
        $this->addPrimaryKey('id_state_machine_item_state', 'IdStateMachineItemState', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_state_machine_process', 'FkStateMachineProcess', 'INTEGER', 'spy_state_machine_process', 'id_state_machine_process', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Process', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineProcess', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_state_machine_process',
    1 => ':id_state_machine_process',
  ),
), null, null, null, false);
        $this->addRelation('StateMachineItemState', '\\Orm\\Zed\\ExampleStateMachine\\Persistence\\PyzExampleStateMachineItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, 'StateMachineItemStates', false);
        $this->addRelation('SpyMerchantSalesOrderItem', '\\Orm\\Zed\\MerchantSalesOrder\\Persistence\\SpyMerchantSalesOrderItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, 'SpyMerchantSalesOrderItems', false);
        $this->addRelation('SpySspInquiry', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquiry', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, 'SpySspInquiries', false);
        $this->addRelation('StateHistory', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineItemStateHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, 'StateHistories', false);
        $this->addRelation('EventTimeout', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineEventTimeout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, 'EventTimeouts', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdStateMachineItemState', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStateMachineItemStateTableMap::CLASS_DEFAULT : SpyStateMachineItemStateTableMap::OM_CLASS;
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
     * @return array (SpyStateMachineItemState object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStateMachineItemStateTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStateMachineItemStateTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStateMachineItemStateTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStateMachineItemStateTableMap::OM_CLASS;
            /** @var SpyStateMachineItemState $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStateMachineItemStateTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStateMachineItemStateTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStateMachineItemStateTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStateMachineItemState $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStateMachineItemStateTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE);
            $criteria->addSelectColumn(SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->addSelectColumn(SpyStateMachineItemStateTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyStateMachineItemStateTableMap::COL_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_state_machine_item_state');
            $criteria->addSelectColumn($alias . '.fk_state_machine_process');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE);
            $criteria->removeSelectColumn(SpyStateMachineItemStateTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->removeSelectColumn(SpyStateMachineItemStateTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyStateMachineItemStateTableMap::COL_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_state_machine_item_state');
            $criteria->removeSelectColumn($alias . '.fk_state_machine_process');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStateMachineItemStateTableMap::DATABASE_NAME)->getTable(SpyStateMachineItemStateTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStateMachineItemState or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStateMachineItemState object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineItemStateTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStateMachineItemStateTableMap::DATABASE_NAME);
            $criteria->add(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE, (array) $values, Criteria::IN);
        }

        $query = SpyStateMachineItemStateQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStateMachineItemStateTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStateMachineItemStateTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_state_machine_item_state table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStateMachineItemStateQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStateMachineItemState or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStateMachineItemState object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineItemStateTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStateMachineItemState object
        }

        if ($criteria->containsKey(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE) && $criteria->keyContainsValue(SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStateMachineItemStateTableMap::COL_ID_STATE_MACHINE_ITEM_STATE.')');
        }


        // Set the correct dbName
        $query = SpyStateMachineItemStateQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
