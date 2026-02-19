<?php

namespace Orm\Zed\StateMachine\Persistence\Map;

use Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLogQuery;
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
 * This class defines the structure of the 'spy_state_machine_transition_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStateMachineTransitionLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.StateMachine.Persistence.Map.SpyStateMachineTransitionLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_state_machine_transition_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStateMachineTransitionLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineTransitionLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.StateMachine.Persistence.SpyStateMachineTransitionLog';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id_state_machine_transition_log field
     */
    public const COL_ID_STATE_MACHINE_TRANSITION_LOG = 'spy_state_machine_transition_log.id_state_machine_transition_log';

    /**
     * the column name for the fk_state_machine_process field
     */
    public const COL_FK_STATE_MACHINE_PROCESS = 'spy_state_machine_transition_log.fk_state_machine_process';

    /**
     * the column name for the command field
     */
    public const COL_COMMAND = 'spy_state_machine_transition_log.command';

    /**
     * the column name for the condition field
     */
    public const COL_CONDITION = 'spy_state_machine_transition_log.condition';

    /**
     * the column name for the error_message field
     */
    public const COL_ERROR_MESSAGE = 'spy_state_machine_transition_log.error_message';

    /**
     * the column name for the event field
     */
    public const COL_EVENT = 'spy_state_machine_transition_log.event';

    /**
     * the column name for the hostname field
     */
    public const COL_HOSTNAME = 'spy_state_machine_transition_log.hostname';

    /**
     * the column name for the identifier field
     */
    public const COL_IDENTIFIER = 'spy_state_machine_transition_log.identifier';

    /**
     * the column name for the is_error field
     */
    public const COL_IS_ERROR = 'spy_state_machine_transition_log.is_error';

    /**
     * the column name for the locked field
     */
    public const COL_LOCKED = 'spy_state_machine_transition_log.locked';

    /**
     * the column name for the params field
     */
    public const COL_PARAMS = 'spy_state_machine_transition_log.params';

    /**
     * the column name for the path field
     */
    public const COL_PATH = 'spy_state_machine_transition_log.path';

    /**
     * the column name for the source_state field
     */
    public const COL_SOURCE_STATE = 'spy_state_machine_transition_log.source_state';

    /**
     * the column name for the target_state field
     */
    public const COL_TARGET_STATE = 'spy_state_machine_transition_log.target_state';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_state_machine_transition_log.created_at';

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
        self::TYPE_PHPNAME       => ['IdStateMachineTransitionLog', 'FkStateMachineProcess', 'Command', 'Condition', 'ErrorMessage', 'Event', 'Hostname', 'Identifier', 'IsError', 'Locked', 'Params', 'Path', 'SourceState', 'TargetState', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['idStateMachineTransitionLog', 'fkStateMachineProcess', 'command', 'condition', 'errorMessage', 'event', 'hostname', 'identifier', 'isError', 'locked', 'params', 'path', 'sourceState', 'targetState', 'createdAt', ],
        self::TYPE_COLNAME       => [SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS, SpyStateMachineTransitionLogTableMap::COL_COMMAND, SpyStateMachineTransitionLogTableMap::COL_CONDITION, SpyStateMachineTransitionLogTableMap::COL_ERROR_MESSAGE, SpyStateMachineTransitionLogTableMap::COL_EVENT, SpyStateMachineTransitionLogTableMap::COL_HOSTNAME, SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER, SpyStateMachineTransitionLogTableMap::COL_IS_ERROR, SpyStateMachineTransitionLogTableMap::COL_LOCKED, SpyStateMachineTransitionLogTableMap::COL_PARAMS, SpyStateMachineTransitionLogTableMap::COL_PATH, SpyStateMachineTransitionLogTableMap::COL_SOURCE_STATE, SpyStateMachineTransitionLogTableMap::COL_TARGET_STATE, SpyStateMachineTransitionLogTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_state_machine_transition_log', 'fk_state_machine_process', 'command', 'condition', 'error_message', 'event', 'hostname', 'identifier', 'is_error', 'locked', 'params', 'path', 'source_state', 'target_state', 'created_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
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
        self::TYPE_PHPNAME       => ['IdStateMachineTransitionLog' => 0, 'FkStateMachineProcess' => 1, 'Command' => 2, 'Condition' => 3, 'ErrorMessage' => 4, 'Event' => 5, 'Hostname' => 6, 'Identifier' => 7, 'IsError' => 8, 'Locked' => 9, 'Params' => 10, 'Path' => 11, 'SourceState' => 12, 'TargetState' => 13, 'CreatedAt' => 14, ],
        self::TYPE_CAMELNAME     => ['idStateMachineTransitionLog' => 0, 'fkStateMachineProcess' => 1, 'command' => 2, 'condition' => 3, 'errorMessage' => 4, 'event' => 5, 'hostname' => 6, 'identifier' => 7, 'isError' => 8, 'locked' => 9, 'params' => 10, 'path' => 11, 'sourceState' => 12, 'targetState' => 13, 'createdAt' => 14, ],
        self::TYPE_COLNAME       => [SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG => 0, SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS => 1, SpyStateMachineTransitionLogTableMap::COL_COMMAND => 2, SpyStateMachineTransitionLogTableMap::COL_CONDITION => 3, SpyStateMachineTransitionLogTableMap::COL_ERROR_MESSAGE => 4, SpyStateMachineTransitionLogTableMap::COL_EVENT => 5, SpyStateMachineTransitionLogTableMap::COL_HOSTNAME => 6, SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER => 7, SpyStateMachineTransitionLogTableMap::COL_IS_ERROR => 8, SpyStateMachineTransitionLogTableMap::COL_LOCKED => 9, SpyStateMachineTransitionLogTableMap::COL_PARAMS => 10, SpyStateMachineTransitionLogTableMap::COL_PATH => 11, SpyStateMachineTransitionLogTableMap::COL_SOURCE_STATE => 12, SpyStateMachineTransitionLogTableMap::COL_TARGET_STATE => 13, SpyStateMachineTransitionLogTableMap::COL_CREATED_AT => 14, ],
        self::TYPE_FIELDNAME     => ['id_state_machine_transition_log' => 0, 'fk_state_machine_process' => 1, 'command' => 2, 'condition' => 3, 'error_message' => 4, 'event' => 5, 'hostname' => 6, 'identifier' => 7, 'is_error' => 8, 'locked' => 9, 'params' => 10, 'path' => 11, 'source_state' => 12, 'target_state' => 13, 'created_at' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdStateMachineTransitionLog' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'SpyStateMachineTransitionLog.IdStateMachineTransitionLog' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'idStateMachineTransitionLog' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'spyStateMachineTransitionLog.idStateMachineTransitionLog' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'COL_ID_STATE_MACHINE_TRANSITION_LOG' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'id_state_machine_transition_log' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'spy_state_machine_transition_log.id_state_machine_transition_log' => 'ID_STATE_MACHINE_TRANSITION_LOG',
        'FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyStateMachineTransitionLog.FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'spyStateMachineTransitionLog.fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'spy_state_machine_transition_log.fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'Command' => 'COMMAND',
        'SpyStateMachineTransitionLog.Command' => 'COMMAND',
        'command' => 'COMMAND',
        'spyStateMachineTransitionLog.command' => 'COMMAND',
        'SpyStateMachineTransitionLogTableMap::COL_COMMAND' => 'COMMAND',
        'COL_COMMAND' => 'COMMAND',
        'spy_state_machine_transition_log.command' => 'COMMAND',
        'Condition' => 'CONDITION',
        'SpyStateMachineTransitionLog.Condition' => 'CONDITION',
        'condition' => 'CONDITION',
        'spyStateMachineTransitionLog.condition' => 'CONDITION',
        'SpyStateMachineTransitionLogTableMap::COL_CONDITION' => 'CONDITION',
        'COL_CONDITION' => 'CONDITION',
        'spy_state_machine_transition_log.condition' => 'CONDITION',
        'ErrorMessage' => 'ERROR_MESSAGE',
        'SpyStateMachineTransitionLog.ErrorMessage' => 'ERROR_MESSAGE',
        'errorMessage' => 'ERROR_MESSAGE',
        'spyStateMachineTransitionLog.errorMessage' => 'ERROR_MESSAGE',
        'SpyStateMachineTransitionLogTableMap::COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'error_message' => 'ERROR_MESSAGE',
        'spy_state_machine_transition_log.error_message' => 'ERROR_MESSAGE',
        'Event' => 'EVENT',
        'SpyStateMachineTransitionLog.Event' => 'EVENT',
        'event' => 'EVENT',
        'spyStateMachineTransitionLog.event' => 'EVENT',
        'SpyStateMachineTransitionLogTableMap::COL_EVENT' => 'EVENT',
        'COL_EVENT' => 'EVENT',
        'spy_state_machine_transition_log.event' => 'EVENT',
        'Hostname' => 'HOSTNAME',
        'SpyStateMachineTransitionLog.Hostname' => 'HOSTNAME',
        'hostname' => 'HOSTNAME',
        'spyStateMachineTransitionLog.hostname' => 'HOSTNAME',
        'SpyStateMachineTransitionLogTableMap::COL_HOSTNAME' => 'HOSTNAME',
        'COL_HOSTNAME' => 'HOSTNAME',
        'spy_state_machine_transition_log.hostname' => 'HOSTNAME',
        'Identifier' => 'IDENTIFIER',
        'SpyStateMachineTransitionLog.Identifier' => 'IDENTIFIER',
        'identifier' => 'IDENTIFIER',
        'spyStateMachineTransitionLog.identifier' => 'IDENTIFIER',
        'SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER' => 'IDENTIFIER',
        'COL_IDENTIFIER' => 'IDENTIFIER',
        'spy_state_machine_transition_log.identifier' => 'IDENTIFIER',
        'IsError' => 'IS_ERROR',
        'SpyStateMachineTransitionLog.IsError' => 'IS_ERROR',
        'isError' => 'IS_ERROR',
        'spyStateMachineTransitionLog.isError' => 'IS_ERROR',
        'SpyStateMachineTransitionLogTableMap::COL_IS_ERROR' => 'IS_ERROR',
        'COL_IS_ERROR' => 'IS_ERROR',
        'is_error' => 'IS_ERROR',
        'spy_state_machine_transition_log.is_error' => 'IS_ERROR',
        'Locked' => 'LOCKED',
        'SpyStateMachineTransitionLog.Locked' => 'LOCKED',
        'locked' => 'LOCKED',
        'spyStateMachineTransitionLog.locked' => 'LOCKED',
        'SpyStateMachineTransitionLogTableMap::COL_LOCKED' => 'LOCKED',
        'COL_LOCKED' => 'LOCKED',
        'spy_state_machine_transition_log.locked' => 'LOCKED',
        'Params' => 'PARAMS',
        'SpyStateMachineTransitionLog.Params' => 'PARAMS',
        'params' => 'PARAMS',
        'spyStateMachineTransitionLog.params' => 'PARAMS',
        'SpyStateMachineTransitionLogTableMap::COL_PARAMS' => 'PARAMS',
        'COL_PARAMS' => 'PARAMS',
        'spy_state_machine_transition_log.params' => 'PARAMS',
        'Path' => 'PATH',
        'SpyStateMachineTransitionLog.Path' => 'PATH',
        'path' => 'PATH',
        'spyStateMachineTransitionLog.path' => 'PATH',
        'SpyStateMachineTransitionLogTableMap::COL_PATH' => 'PATH',
        'COL_PATH' => 'PATH',
        'spy_state_machine_transition_log.path' => 'PATH',
        'SourceState' => 'SOURCE_STATE',
        'SpyStateMachineTransitionLog.SourceState' => 'SOURCE_STATE',
        'sourceState' => 'SOURCE_STATE',
        'spyStateMachineTransitionLog.sourceState' => 'SOURCE_STATE',
        'SpyStateMachineTransitionLogTableMap::COL_SOURCE_STATE' => 'SOURCE_STATE',
        'COL_SOURCE_STATE' => 'SOURCE_STATE',
        'source_state' => 'SOURCE_STATE',
        'spy_state_machine_transition_log.source_state' => 'SOURCE_STATE',
        'TargetState' => 'TARGET_STATE',
        'SpyStateMachineTransitionLog.TargetState' => 'TARGET_STATE',
        'targetState' => 'TARGET_STATE',
        'spyStateMachineTransitionLog.targetState' => 'TARGET_STATE',
        'SpyStateMachineTransitionLogTableMap::COL_TARGET_STATE' => 'TARGET_STATE',
        'COL_TARGET_STATE' => 'TARGET_STATE',
        'target_state' => 'TARGET_STATE',
        'spy_state_machine_transition_log.target_state' => 'TARGET_STATE',
        'CreatedAt' => 'CREATED_AT',
        'SpyStateMachineTransitionLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyStateMachineTransitionLog.createdAt' => 'CREATED_AT',
        'SpyStateMachineTransitionLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_state_machine_transition_log.created_at' => 'CREATED_AT',
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
        $this->setName('spy_state_machine_transition_log');
        $this->setPhpName('SpyStateMachineTransitionLog');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineTransitionLog');
        $this->setPackage('src.Orm.Zed.StateMachine.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_state_machine_transition_log_pk_seq');
        // columns
        $this->addPrimaryKey('id_state_machine_transition_log', 'IdStateMachineTransitionLog', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_state_machine_process', 'FkStateMachineProcess', 'INTEGER', 'spy_state_machine_process', 'id_state_machine_process', true, null, null);
        $this->addColumn('command', 'Command', 'VARCHAR', false, 512, null);
        $this->addColumn('condition', 'Condition', 'VARCHAR', false, 512, null);
        $this->addColumn('error_message', 'ErrorMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('event', 'Event', 'VARCHAR', false, 100, null);
        $this->addColumn('hostname', 'Hostname', 'VARCHAR', true, 128, null);
        $this->addColumn('identifier', 'Identifier', 'INTEGER', true, null, null);
        $this->addColumn('is_error', 'IsError', 'BOOLEAN', false, 1, null);
        $this->addColumn('locked', 'Locked', 'BOOLEAN', false, 1, null);
        $this->addColumn('params', 'Params', 'ARRAY', false, null, null);
        $this->addColumn('path', 'Path', 'VARCHAR', false, 256, null);
        $this->addColumn('source_state', 'SourceState', 'VARCHAR', false, 128, null);
        $this->addColumn('target_state', 'TargetState', 'VARCHAR', false, 128, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
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
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'true', 'is_timestamp' => 'true'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdStateMachineTransitionLog', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStateMachineTransitionLogTableMap::CLASS_DEFAULT : SpyStateMachineTransitionLogTableMap::OM_CLASS;
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
     * @return array (SpyStateMachineTransitionLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStateMachineTransitionLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStateMachineTransitionLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStateMachineTransitionLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStateMachineTransitionLogTableMap::OM_CLASS;
            /** @var SpyStateMachineTransitionLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStateMachineTransitionLogTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStateMachineTransitionLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStateMachineTransitionLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStateMachineTransitionLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStateMachineTransitionLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_COMMAND);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_CONDITION);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_ERROR_MESSAGE);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_EVENT);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_HOSTNAME);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_IS_ERROR);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_LOCKED);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_PARAMS);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_PATH);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_SOURCE_STATE);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_TARGET_STATE);
            $criteria->addSelectColumn(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_state_machine_transition_log');
            $criteria->addSelectColumn($alias . '.fk_state_machine_process');
            $criteria->addSelectColumn($alias . '.command');
            $criteria->addSelectColumn($alias . '.condition');
            $criteria->addSelectColumn($alias . '.error_message');
            $criteria->addSelectColumn($alias . '.event');
            $criteria->addSelectColumn($alias . '.hostname');
            $criteria->addSelectColumn($alias . '.identifier');
            $criteria->addSelectColumn($alias . '.is_error');
            $criteria->addSelectColumn($alias . '.locked');
            $criteria->addSelectColumn($alias . '.params');
            $criteria->addSelectColumn($alias . '.path');
            $criteria->addSelectColumn($alias . '.source_state');
            $criteria->addSelectColumn($alias . '.target_state');
            $criteria->addSelectColumn($alias . '.created_at');
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
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_COMMAND);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_CONDITION);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_ERROR_MESSAGE);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_EVENT);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_HOSTNAME);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_IDENTIFIER);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_IS_ERROR);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_LOCKED);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_PARAMS);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_PATH);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_SOURCE_STATE);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_TARGET_STATE);
            $criteria->removeSelectColumn(SpyStateMachineTransitionLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_state_machine_transition_log');
            $criteria->removeSelectColumn($alias . '.fk_state_machine_process');
            $criteria->removeSelectColumn($alias . '.command');
            $criteria->removeSelectColumn($alias . '.condition');
            $criteria->removeSelectColumn($alias . '.error_message');
            $criteria->removeSelectColumn($alias . '.event');
            $criteria->removeSelectColumn($alias . '.hostname');
            $criteria->removeSelectColumn($alias . '.identifier');
            $criteria->removeSelectColumn($alias . '.is_error');
            $criteria->removeSelectColumn($alias . '.locked');
            $criteria->removeSelectColumn($alias . '.params');
            $criteria->removeSelectColumn($alias . '.path');
            $criteria->removeSelectColumn($alias . '.source_state');
            $criteria->removeSelectColumn($alias . '.target_state');
            $criteria->removeSelectColumn($alias . '.created_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStateMachineTransitionLogTableMap::DATABASE_NAME)->getTable(SpyStateMachineTransitionLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStateMachineTransitionLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStateMachineTransitionLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineTransitionLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineTransitionLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStateMachineTransitionLogTableMap::DATABASE_NAME);
            $criteria->add(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG, (array) $values, Criteria::IN);
        }

        $query = SpyStateMachineTransitionLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStateMachineTransitionLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStateMachineTransitionLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_state_machine_transition_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStateMachineTransitionLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStateMachineTransitionLog or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStateMachineTransitionLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStateMachineTransitionLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStateMachineTransitionLog object
        }

        if ($criteria->containsKey(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG) && $criteria->keyContainsValue(SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStateMachineTransitionLogTableMap::COL_ID_STATE_MACHINE_TRANSITION_LOG.')');
        }


        // Set the correct dbName
        $query = SpyStateMachineTransitionLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
