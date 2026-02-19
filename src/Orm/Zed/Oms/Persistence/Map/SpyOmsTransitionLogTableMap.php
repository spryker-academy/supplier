<?php

namespace Orm\Zed\Oms\Persistence\Map;

use Orm\Zed\Oms\Persistence\SpyOmsTransitionLog;
use Orm\Zed\Oms\Persistence\SpyOmsTransitionLogQuery;
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
 * This class defines the structure of the 'spy_oms_transition_log' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyOmsTransitionLogTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Oms.Persistence.Map.SpyOmsTransitionLogTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_oms_transition_log';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyOmsTransitionLog';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsTransitionLog';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Oms.Persistence.SpyOmsTransitionLog';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 17;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 17;

    /**
     * the column name for the id_oms_transition_log field
     */
    public const COL_ID_OMS_TRANSITION_LOG = 'spy_oms_transition_log.id_oms_transition_log';

    /**
     * the column name for the fk_oms_order_process field
     */
    public const COL_FK_OMS_ORDER_PROCESS = 'spy_oms_transition_log.fk_oms_order_process';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_oms_transition_log.fk_sales_order';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_oms_transition_log.fk_sales_order_item';

    /**
     * the column name for the command field
     */
    public const COL_COMMAND = 'spy_oms_transition_log.command';

    /**
     * the column name for the condition field
     */
    public const COL_CONDITION = 'spy_oms_transition_log.condition';

    /**
     * the column name for the error_message field
     */
    public const COL_ERROR_MESSAGE = 'spy_oms_transition_log.error_message';

    /**
     * the column name for the event field
     */
    public const COL_EVENT = 'spy_oms_transition_log.event';

    /**
     * the column name for the hostname field
     */
    public const COL_HOSTNAME = 'spy_oms_transition_log.hostname';

    /**
     * the column name for the is_error field
     */
    public const COL_IS_ERROR = 'spy_oms_transition_log.is_error';

    /**
     * the column name for the locked field
     */
    public const COL_LOCKED = 'spy_oms_transition_log.locked';

    /**
     * the column name for the params field
     */
    public const COL_PARAMS = 'spy_oms_transition_log.params';

    /**
     * the column name for the path field
     */
    public const COL_PATH = 'spy_oms_transition_log.path';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'spy_oms_transition_log.quantity';

    /**
     * the column name for the source_state field
     */
    public const COL_SOURCE_STATE = 'spy_oms_transition_log.source_state';

    /**
     * the column name for the target_state field
     */
    public const COL_TARGET_STATE = 'spy_oms_transition_log.target_state';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_oms_transition_log.created_at';

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
        self::TYPE_PHPNAME       => ['IdOmsTransitionLog', 'FkOmsOrderProcess', 'FkSalesOrder', 'FkSalesOrderItem', 'Command', 'Condition', 'ErrorMessage', 'Event', 'Hostname', 'IsError', 'Locked', 'Params', 'Path', 'Quantity', 'SourceState', 'TargetState', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['idOmsTransitionLog', 'fkOmsOrderProcess', 'fkSalesOrder', 'fkSalesOrderItem', 'command', 'condition', 'errorMessage', 'event', 'hostname', 'isError', 'locked', 'params', 'path', 'quantity', 'sourceState', 'targetState', 'createdAt', ],
        self::TYPE_COLNAME       => [SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG, SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS, SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER, SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM, SpyOmsTransitionLogTableMap::COL_COMMAND, SpyOmsTransitionLogTableMap::COL_CONDITION, SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE, SpyOmsTransitionLogTableMap::COL_EVENT, SpyOmsTransitionLogTableMap::COL_HOSTNAME, SpyOmsTransitionLogTableMap::COL_IS_ERROR, SpyOmsTransitionLogTableMap::COL_LOCKED, SpyOmsTransitionLogTableMap::COL_PARAMS, SpyOmsTransitionLogTableMap::COL_PATH, SpyOmsTransitionLogTableMap::COL_QUANTITY, SpyOmsTransitionLogTableMap::COL_SOURCE_STATE, SpyOmsTransitionLogTableMap::COL_TARGET_STATE, SpyOmsTransitionLogTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_oms_transition_log', 'fk_oms_order_process', 'fk_sales_order', 'fk_sales_order_item', 'command', 'condition', 'error_message', 'event', 'hostname', 'is_error', 'locked', 'params', 'path', 'quantity', 'source_state', 'target_state', 'created_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
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
        self::TYPE_PHPNAME       => ['IdOmsTransitionLog' => 0, 'FkOmsOrderProcess' => 1, 'FkSalesOrder' => 2, 'FkSalesOrderItem' => 3, 'Command' => 4, 'Condition' => 5, 'ErrorMessage' => 6, 'Event' => 7, 'Hostname' => 8, 'IsError' => 9, 'Locked' => 10, 'Params' => 11, 'Path' => 12, 'Quantity' => 13, 'SourceState' => 14, 'TargetState' => 15, 'CreatedAt' => 16, ],
        self::TYPE_CAMELNAME     => ['idOmsTransitionLog' => 0, 'fkOmsOrderProcess' => 1, 'fkSalesOrder' => 2, 'fkSalesOrderItem' => 3, 'command' => 4, 'condition' => 5, 'errorMessage' => 6, 'event' => 7, 'hostname' => 8, 'isError' => 9, 'locked' => 10, 'params' => 11, 'path' => 12, 'quantity' => 13, 'sourceState' => 14, 'targetState' => 15, 'createdAt' => 16, ],
        self::TYPE_COLNAME       => [SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG => 0, SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS => 1, SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER => 2, SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM => 3, SpyOmsTransitionLogTableMap::COL_COMMAND => 4, SpyOmsTransitionLogTableMap::COL_CONDITION => 5, SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE => 6, SpyOmsTransitionLogTableMap::COL_EVENT => 7, SpyOmsTransitionLogTableMap::COL_HOSTNAME => 8, SpyOmsTransitionLogTableMap::COL_IS_ERROR => 9, SpyOmsTransitionLogTableMap::COL_LOCKED => 10, SpyOmsTransitionLogTableMap::COL_PARAMS => 11, SpyOmsTransitionLogTableMap::COL_PATH => 12, SpyOmsTransitionLogTableMap::COL_QUANTITY => 13, SpyOmsTransitionLogTableMap::COL_SOURCE_STATE => 14, SpyOmsTransitionLogTableMap::COL_TARGET_STATE => 15, SpyOmsTransitionLogTableMap::COL_CREATED_AT => 16, ],
        self::TYPE_FIELDNAME     => ['id_oms_transition_log' => 0, 'fk_oms_order_process' => 1, 'fk_sales_order' => 2, 'fk_sales_order_item' => 3, 'command' => 4, 'condition' => 5, 'error_message' => 6, 'event' => 7, 'hostname' => 8, 'is_error' => 9, 'locked' => 10, 'params' => 11, 'path' => 12, 'quantity' => 13, 'source_state' => 14, 'target_state' => 15, 'created_at' => 16, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdOmsTransitionLog' => 'ID_OMS_TRANSITION_LOG',
        'SpyOmsTransitionLog.IdOmsTransitionLog' => 'ID_OMS_TRANSITION_LOG',
        'idOmsTransitionLog' => 'ID_OMS_TRANSITION_LOG',
        'spyOmsTransitionLog.idOmsTransitionLog' => 'ID_OMS_TRANSITION_LOG',
        'SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG' => 'ID_OMS_TRANSITION_LOG',
        'COL_ID_OMS_TRANSITION_LOG' => 'ID_OMS_TRANSITION_LOG',
        'id_oms_transition_log' => 'ID_OMS_TRANSITION_LOG',
        'spy_oms_transition_log.id_oms_transition_log' => 'ID_OMS_TRANSITION_LOG',
        'FkOmsOrderProcess' => 'FK_OMS_ORDER_PROCESS',
        'SpyOmsTransitionLog.FkOmsOrderProcess' => 'FK_OMS_ORDER_PROCESS',
        'fkOmsOrderProcess' => 'FK_OMS_ORDER_PROCESS',
        'spyOmsTransitionLog.fkOmsOrderProcess' => 'FK_OMS_ORDER_PROCESS',
        'SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS' => 'FK_OMS_ORDER_PROCESS',
        'COL_FK_OMS_ORDER_PROCESS' => 'FK_OMS_ORDER_PROCESS',
        'fk_oms_order_process' => 'FK_OMS_ORDER_PROCESS',
        'spy_oms_transition_log.fk_oms_order_process' => 'FK_OMS_ORDER_PROCESS',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpyOmsTransitionLog.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spyOmsTransitionLog.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_oms_transition_log.fk_sales_order' => 'FK_SALES_ORDER',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpyOmsTransitionLog.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spyOmsTransitionLog.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_oms_transition_log.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'Command' => 'COMMAND',
        'SpyOmsTransitionLog.Command' => 'COMMAND',
        'command' => 'COMMAND',
        'spyOmsTransitionLog.command' => 'COMMAND',
        'SpyOmsTransitionLogTableMap::COL_COMMAND' => 'COMMAND',
        'COL_COMMAND' => 'COMMAND',
        'spy_oms_transition_log.command' => 'COMMAND',
        'Condition' => 'CONDITION',
        'SpyOmsTransitionLog.Condition' => 'CONDITION',
        'condition' => 'CONDITION',
        'spyOmsTransitionLog.condition' => 'CONDITION',
        'SpyOmsTransitionLogTableMap::COL_CONDITION' => 'CONDITION',
        'COL_CONDITION' => 'CONDITION',
        'spy_oms_transition_log.condition' => 'CONDITION',
        'ErrorMessage' => 'ERROR_MESSAGE',
        'SpyOmsTransitionLog.ErrorMessage' => 'ERROR_MESSAGE',
        'errorMessage' => 'ERROR_MESSAGE',
        'spyOmsTransitionLog.errorMessage' => 'ERROR_MESSAGE',
        'SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'COL_ERROR_MESSAGE' => 'ERROR_MESSAGE',
        'error_message' => 'ERROR_MESSAGE',
        'spy_oms_transition_log.error_message' => 'ERROR_MESSAGE',
        'Event' => 'EVENT',
        'SpyOmsTransitionLog.Event' => 'EVENT',
        'event' => 'EVENT',
        'spyOmsTransitionLog.event' => 'EVENT',
        'SpyOmsTransitionLogTableMap::COL_EVENT' => 'EVENT',
        'COL_EVENT' => 'EVENT',
        'spy_oms_transition_log.event' => 'EVENT',
        'Hostname' => 'HOSTNAME',
        'SpyOmsTransitionLog.Hostname' => 'HOSTNAME',
        'hostname' => 'HOSTNAME',
        'spyOmsTransitionLog.hostname' => 'HOSTNAME',
        'SpyOmsTransitionLogTableMap::COL_HOSTNAME' => 'HOSTNAME',
        'COL_HOSTNAME' => 'HOSTNAME',
        'spy_oms_transition_log.hostname' => 'HOSTNAME',
        'IsError' => 'IS_ERROR',
        'SpyOmsTransitionLog.IsError' => 'IS_ERROR',
        'isError' => 'IS_ERROR',
        'spyOmsTransitionLog.isError' => 'IS_ERROR',
        'SpyOmsTransitionLogTableMap::COL_IS_ERROR' => 'IS_ERROR',
        'COL_IS_ERROR' => 'IS_ERROR',
        'is_error' => 'IS_ERROR',
        'spy_oms_transition_log.is_error' => 'IS_ERROR',
        'Locked' => 'LOCKED',
        'SpyOmsTransitionLog.Locked' => 'LOCKED',
        'locked' => 'LOCKED',
        'spyOmsTransitionLog.locked' => 'LOCKED',
        'SpyOmsTransitionLogTableMap::COL_LOCKED' => 'LOCKED',
        'COL_LOCKED' => 'LOCKED',
        'spy_oms_transition_log.locked' => 'LOCKED',
        'Params' => 'PARAMS',
        'SpyOmsTransitionLog.Params' => 'PARAMS',
        'params' => 'PARAMS',
        'spyOmsTransitionLog.params' => 'PARAMS',
        'SpyOmsTransitionLogTableMap::COL_PARAMS' => 'PARAMS',
        'COL_PARAMS' => 'PARAMS',
        'spy_oms_transition_log.params' => 'PARAMS',
        'Path' => 'PATH',
        'SpyOmsTransitionLog.Path' => 'PATH',
        'path' => 'PATH',
        'spyOmsTransitionLog.path' => 'PATH',
        'SpyOmsTransitionLogTableMap::COL_PATH' => 'PATH',
        'COL_PATH' => 'PATH',
        'spy_oms_transition_log.path' => 'PATH',
        'Quantity' => 'QUANTITY',
        'SpyOmsTransitionLog.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'spyOmsTransitionLog.quantity' => 'QUANTITY',
        'SpyOmsTransitionLogTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'spy_oms_transition_log.quantity' => 'QUANTITY',
        'SourceState' => 'SOURCE_STATE',
        'SpyOmsTransitionLog.SourceState' => 'SOURCE_STATE',
        'sourceState' => 'SOURCE_STATE',
        'spyOmsTransitionLog.sourceState' => 'SOURCE_STATE',
        'SpyOmsTransitionLogTableMap::COL_SOURCE_STATE' => 'SOURCE_STATE',
        'COL_SOURCE_STATE' => 'SOURCE_STATE',
        'source_state' => 'SOURCE_STATE',
        'spy_oms_transition_log.source_state' => 'SOURCE_STATE',
        'TargetState' => 'TARGET_STATE',
        'SpyOmsTransitionLog.TargetState' => 'TARGET_STATE',
        'targetState' => 'TARGET_STATE',
        'spyOmsTransitionLog.targetState' => 'TARGET_STATE',
        'SpyOmsTransitionLogTableMap::COL_TARGET_STATE' => 'TARGET_STATE',
        'COL_TARGET_STATE' => 'TARGET_STATE',
        'target_state' => 'TARGET_STATE',
        'spy_oms_transition_log.target_state' => 'TARGET_STATE',
        'CreatedAt' => 'CREATED_AT',
        'SpyOmsTransitionLog.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyOmsTransitionLog.createdAt' => 'CREATED_AT',
        'SpyOmsTransitionLogTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_oms_transition_log.created_at' => 'CREATED_AT',
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
        $this->setName('spy_oms_transition_log');
        $this->setPhpName('SpyOmsTransitionLog');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Oms\\Persistence\\SpyOmsTransitionLog');
        $this->setPackage('src.Orm.Zed.Oms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_oms_transition_log_pk_seq');
        // columns
        $this->addPrimaryKey('id_oms_transition_log', 'IdOmsTransitionLog', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_oms_order_process', 'FkOmsOrderProcess', 'INTEGER', 'spy_oms_order_process', 'id_oms_order_process', false, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('command', 'Command', 'VARCHAR', false, 512, null);
        $this->addColumn('condition', 'Condition', 'VARCHAR', false, 512, null);
        $this->addColumn('error_message', 'ErrorMessage', 'LONGVARCHAR', false, null, null);
        $this->addColumn('event', 'Event', 'VARCHAR', false, 100, null);
        $this->addColumn('hostname', 'Hostname', 'VARCHAR', true, 128, null);
        $this->addColumn('is_error', 'IsError', 'BOOLEAN', false, 1, null);
        $this->addColumn('locked', 'Locked', 'BOOLEAN', false, 1, null);
        $this->addColumn('params', 'Params', 'ARRAY', false, null, null);
        $this->addColumn('path', 'Path', 'VARCHAR', false, 256, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', false, null, null);
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
        $this->addRelation('Order', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('OrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
  ),
), null, null, null, false);
        $this->addRelation('Process', '\\Orm\\Zed\\Oms\\Persistence\\SpyOmsOrderProcess', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_oms_order_process',
    1 => ':id_oms_order_process',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdOmsTransitionLog', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyOmsTransitionLogTableMap::CLASS_DEFAULT : SpyOmsTransitionLogTableMap::OM_CLASS;
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
     * @return array (SpyOmsTransitionLog object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyOmsTransitionLogTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyOmsTransitionLogTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyOmsTransitionLogTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyOmsTransitionLogTableMap::OM_CLASS;
            /** @var SpyOmsTransitionLog $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyOmsTransitionLogTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyOmsTransitionLogTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyOmsTransitionLogTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyOmsTransitionLog $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyOmsTransitionLogTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_COMMAND);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_CONDITION);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_EVENT);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_HOSTNAME);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_IS_ERROR);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_LOCKED);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_PARAMS);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_PATH);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_SOURCE_STATE);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_TARGET_STATE);
            $criteria->addSelectColumn(SpyOmsTransitionLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_oms_transition_log');
            $criteria->addSelectColumn($alias . '.fk_oms_order_process');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.command');
            $criteria->addSelectColumn($alias . '.condition');
            $criteria->addSelectColumn($alias . '.error_message');
            $criteria->addSelectColumn($alias . '.event');
            $criteria->addSelectColumn($alias . '.hostname');
            $criteria->addSelectColumn($alias . '.is_error');
            $criteria->addSelectColumn($alias . '.locked');
            $criteria->addSelectColumn($alias . '.params');
            $criteria->addSelectColumn($alias . '.path');
            $criteria->addSelectColumn($alias . '.quantity');
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
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_FK_OMS_ORDER_PROCESS);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_COMMAND);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_CONDITION);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_ERROR_MESSAGE);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_EVENT);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_HOSTNAME);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_IS_ERROR);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_LOCKED);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_PARAMS);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_PATH);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_QUANTITY);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_SOURCE_STATE);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_TARGET_STATE);
            $criteria->removeSelectColumn(SpyOmsTransitionLogTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_oms_transition_log');
            $criteria->removeSelectColumn($alias . '.fk_oms_order_process');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.command');
            $criteria->removeSelectColumn($alias . '.condition');
            $criteria->removeSelectColumn($alias . '.error_message');
            $criteria->removeSelectColumn($alias . '.event');
            $criteria->removeSelectColumn($alias . '.hostname');
            $criteria->removeSelectColumn($alias . '.is_error');
            $criteria->removeSelectColumn($alias . '.locked');
            $criteria->removeSelectColumn($alias . '.params');
            $criteria->removeSelectColumn($alias . '.path');
            $criteria->removeSelectColumn($alias . '.quantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyOmsTransitionLogTableMap::DATABASE_NAME)->getTable(SpyOmsTransitionLogTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyOmsTransitionLog or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyOmsTransitionLog object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsTransitionLogTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Oms\Persistence\SpyOmsTransitionLog) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyOmsTransitionLogTableMap::DATABASE_NAME);
            $criteria->add(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG, (array) $values, Criteria::IN);
        }

        $query = SpyOmsTransitionLogQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyOmsTransitionLogTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyOmsTransitionLogTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_oms_transition_log table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyOmsTransitionLogQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyOmsTransitionLog or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyOmsTransitionLog object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyOmsTransitionLogTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyOmsTransitionLog object
        }

        if ($criteria->containsKey(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG) && $criteria->keyContainsValue(SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyOmsTransitionLogTableMap::COL_ID_OMS_TRANSITION_LOG.')');
        }


        // Set the correct dbName
        $query = SpyOmsTransitionLogQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
