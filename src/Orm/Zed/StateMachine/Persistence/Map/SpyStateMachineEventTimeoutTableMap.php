<?php

namespace Orm\Zed\StateMachine\Persistence\Map;

use Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeoutQuery;
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
 * This class defines the structure of the 'spy_state_machine_event_timeout' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStateMachineEventTimeoutTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.StateMachine.Persistence.Map.SpyStateMachineEventTimeoutTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_state_machine_event_timeout';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStateMachineEventTimeout';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineEventTimeout';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.StateMachine.Persistence.SpyStateMachineEventTimeout';

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
     * the column name for the id_state_machine_event_timeout field
     */
    public const COL_ID_STATE_MACHINE_EVENT_TIMEOUT = 'spy_state_machine_event_timeout.id_state_machine_event_timeout';

    /**
     * the column name for the fk_state_machine_item_state field
     */
    public const COL_FK_STATE_MACHINE_ITEM_STATE = 'spy_state_machine_event_timeout.fk_state_machine_item_state';

    /**
     * the column name for the fk_state_machine_process field
     */
    public const COL_FK_STATE_MACHINE_PROCESS = 'spy_state_machine_event_timeout.fk_state_machine_process';

    /**
     * the column name for the event field
     */
    public const COL_EVENT = 'spy_state_machine_event_timeout.event';

    /**
     * the column name for the identifier field
     */
    public const COL_IDENTIFIER = 'spy_state_machine_event_timeout.identifier';

    /**
     * the column name for the timeout field
     */
    public const COL_TIMEOUT = 'spy_state_machine_event_timeout.timeout';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_state_machine_event_timeout.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_state_machine_event_timeout.updated_at';

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
        self::TYPE_PHPNAME       => ['IdStateMachineEventTimeout', 'FkStateMachineItemState', 'FkStateMachineProcess', 'Event', 'Identifier', 'Timeout', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idStateMachineEventTimeout', 'fkStateMachineItemState', 'fkStateMachineProcess', 'event', 'identifier', 'timeout', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS, SpyStateMachineEventTimeoutTableMap::COL_EVENT, SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER, SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT, SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT, SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_state_machine_event_timeout', 'fk_state_machine_item_state', 'fk_state_machine_process', 'event', 'identifier', 'timeout', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdStateMachineEventTimeout' => 0, 'FkStateMachineItemState' => 1, 'FkStateMachineProcess' => 2, 'Event' => 3, 'Identifier' => 4, 'Timeout' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idStateMachineEventTimeout' => 0, 'fkStateMachineItemState' => 1, 'fkStateMachineProcess' => 2, 'event' => 3, 'identifier' => 4, 'timeout' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT => 0, SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE => 1, SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS => 2, SpyStateMachineEventTimeoutTableMap::COL_EVENT => 3, SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER => 4, SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT => 5, SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT => 6, SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_state_machine_event_timeout' => 0, 'fk_state_machine_item_state' => 1, 'fk_state_machine_process' => 2, 'event' => 3, 'identifier' => 4, 'timeout' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdStateMachineEventTimeout' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'SpyStateMachineEventTimeout.IdStateMachineEventTimeout' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'idStateMachineEventTimeout' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'spyStateMachineEventTimeout.idStateMachineEventTimeout' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'COL_ID_STATE_MACHINE_EVENT_TIMEOUT' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'id_state_machine_event_timeout' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'spy_state_machine_event_timeout.id_state_machine_event_timeout' => 'ID_STATE_MACHINE_EVENT_TIMEOUT',
        'FkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'SpyStateMachineEventTimeout.FkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'fkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'spyStateMachineEventTimeout.fkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE' => 'FK_STATE_MACHINE_ITEM_STATE',
        'COL_FK_STATE_MACHINE_ITEM_STATE' => 'FK_STATE_MACHINE_ITEM_STATE',
        'fk_state_machine_item_state' => 'FK_STATE_MACHINE_ITEM_STATE',
        'spy_state_machine_event_timeout.fk_state_machine_item_state' => 'FK_STATE_MACHINE_ITEM_STATE',
        'FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyStateMachineEventTimeout.FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'spyStateMachineEventTimeout.fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'spy_state_machine_event_timeout.fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'Event' => 'EVENT',
        'SpyStateMachineEventTimeout.Event' => 'EVENT',
        'event' => 'EVENT',
        'spyStateMachineEventTimeout.event' => 'EVENT',
        'SpyStateMachineEventTimeoutTableMap::COL_EVENT' => 'EVENT',
        'COL_EVENT' => 'EVENT',
        'spy_state_machine_event_timeout.event' => 'EVENT',
        'Identifier' => 'IDENTIFIER',
        'SpyStateMachineEventTimeout.Identifier' => 'IDENTIFIER',
        'identifier' => 'IDENTIFIER',
        'spyStateMachineEventTimeout.identifier' => 'IDENTIFIER',
        'SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'spy_state_machine_event_timeout.identifier' => 'IDENTIFIER',
        'Timeout' => 'TIMEOUT',
        'SpyStateMachineEventTimeout.Timeout' => 'TIMEOUT',
        'timeout' => 'TIMEOUT',
        'spyStateMachineEventTimeout.timeout' => 'TIMEOUT',
        'SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT' => 'TIMEOUT',
        'COL_TIMEOUT' => 'TIMEOUT',
        'spy_state_machine_event_timeout.timeout' => 'TIMEOUT',
        'CreatedAt' => 'CREATED_AT',
        'SpyStateMachineEventTimeout.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyStateMachineEventTimeout.createdAt' => 'CREATED_AT',
        'SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_state_machine_event_timeout.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyStateMachineEventTimeout.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyStateMachineEventTimeout.updatedAt' => 'UPDATED_AT',
        'SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_state_machine_event_timeout.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_state_machine_event_timeout');
        $this->setPhpName('SpyStateMachineEventTimeout');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineEventTimeout');
        $this->setPackage('src.Orm.Zed.StateMachine.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_state_machine_event_timeout_pk_seq');
        // columns
        $this->addPrimaryKey('id_state_machine_event_timeout', 'IdStateMachineEventTimeout', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_state_machine_item_state', 'FkStateMachineItemState', 'INTEGER', 'spy_state_machine_item_state', 'id_state_machine_item_state', true, null, null);
        $this->addForeignKey('fk_state_machine_process', 'FkStateMachineProcess', 'INTEGER', 'spy_state_machine_process', 'id_state_machine_process', true, null, null);
        $this->addColumn('event', 'Event', 'VARCHAR', true, 255, null);
        $this->addColumn('identifier', 'Identifier', 'INTEGER', true, null, null);
        $this->addColumn('timeout', 'Timeout', 'TIMESTAMP', true, null, null);
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
        $this->addRelation('State', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineItemState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, null, false);
        $this->addRelation('Process', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineProcess', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_state_machine_process',
    1 => ':id_state_machine_process',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdStateMachineEventTimeout', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStateMachineEventTimeoutTableMap::CLASS_DEFAULT : SpyStateMachineEventTimeoutTableMap::OM_CLASS;
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
     * @return array (SpyStateMachineEventTimeout object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStateMachineEventTimeoutTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStateMachineEventTimeoutTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStateMachineEventTimeoutTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStateMachineEventTimeoutTableMap::OM_CLASS;
            /** @var SpyStateMachineEventTimeout $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStateMachineEventTimeoutTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStateMachineEventTimeoutTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStateMachineEventTimeoutTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStateMachineEventTimeout $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStateMachineEventTimeoutTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_EVENT);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_state_machine_event_timeout');
            $criteria->addSelectColumn($alias . '.fk_state_machine_item_state');
            $criteria->addSelectColumn($alias . '.fk_state_machine_process');
            $criteria->addSelectColumn($alias . '.event');
            $criteria->addSelectColumn($alias . '.identifier');
            $criteria->addSelectColumn($alias . '.timeout');
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
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_ITEM_STATE);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_EVENT);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_TIMEOUT);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyStateMachineEventTimeoutTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_state_machine_event_timeout');
            $criteria->removeSelectColumn($alias . '.fk_state_machine_item_state');
            $criteria->removeSelectColumn($alias . '.fk_state_machine_process');
            $criteria->removeSelectColumn($alias . '.event');
            $criteria->removeSelectColumn($alias . '.identifier');
            $criteria->removeSelectColumn($alias . '.timeout');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME)->getTable(SpyStateMachineEventTimeoutTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStateMachineEventTimeout or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStateMachineEventTimeout object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineEventTimeout) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME);
            $criteria->add(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT, (array) $values, Criteria::IN);
        }

        $query = SpyStateMachineEventTimeoutQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStateMachineEventTimeoutTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStateMachineEventTimeoutTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_state_machine_event_timeout table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStateMachineEventTimeoutQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStateMachineEventTimeout or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStateMachineEventTimeout object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineEventTimeoutTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStateMachineEventTimeout object
        }

        if ($criteria->containsKey(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT) && $criteria->keyContainsValue(SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStateMachineEventTimeoutTableMap::COL_ID_STATE_MACHINE_EVENT_TIMEOUT.')');
        }


        // Set the correct dbName
        $query = SpyStateMachineEventTimeoutQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
