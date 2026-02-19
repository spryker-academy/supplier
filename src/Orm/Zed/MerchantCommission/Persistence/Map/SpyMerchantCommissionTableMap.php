<?php

namespace Orm\Zed\MerchantCommission\Persistence\Map;

use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery;
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
 * This class defines the structure of the 'spy_merchant_commission' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantCommissionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantCommission.Persistence.Map.SpyMerchantCommissionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_commission';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantCommission';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommission';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantCommission.Persistence.SpyMerchantCommission';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id_merchant_commission field
     */
    public const COL_ID_MERCHANT_COMMISSION = 'spy_merchant_commission.id_merchant_commission';

    /**
     * the column name for the fk_merchant_commission_group field
     */
    public const COL_FK_MERCHANT_COMMISSION_GROUP = 'spy_merchant_commission.fk_merchant_commission_group';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_merchant_commission.uuid';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_merchant_commission.name';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_merchant_commission.description';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_merchant_commission.key';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'spy_merchant_commission.amount';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_merchant_commission.is_active';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_merchant_commission.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_merchant_commission.valid_to';

    /**
     * the column name for the priority field
     */
    public const COL_PRIORITY = 'spy_merchant_commission.priority';

    /**
     * the column name for the item_condition field
     */
    public const COL_ITEM_CONDITION = 'spy_merchant_commission.item_condition';

    /**
     * the column name for the order_condition field
     */
    public const COL_ORDER_CONDITION = 'spy_merchant_commission.order_condition';

    /**
     * the column name for the calculator_type_plugin field
     */
    public const COL_CALCULATOR_TYPE_PLUGIN = 'spy_merchant_commission.calculator_type_plugin';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_commission.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_commission.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchantCommission', 'FkMerchantCommissionGroup', 'Uuid', 'Name', 'Description', 'Key', 'Amount', 'IsActive', 'ValidFrom', 'ValidTo', 'Priority', 'ItemCondition', 'OrderCondition', 'CalculatorTypePlugin', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantCommission', 'fkMerchantCommissionGroup', 'uuid', 'name', 'description', 'key', 'amount', 'isActive', 'validFrom', 'validTo', 'priority', 'itemCondition', 'orderCondition', 'calculatorTypePlugin', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, SpyMerchantCommissionTableMap::COL_UUID, SpyMerchantCommissionTableMap::COL_NAME, SpyMerchantCommissionTableMap::COL_DESCRIPTION, SpyMerchantCommissionTableMap::COL_KEY, SpyMerchantCommissionTableMap::COL_AMOUNT, SpyMerchantCommissionTableMap::COL_IS_ACTIVE, SpyMerchantCommissionTableMap::COL_VALID_FROM, SpyMerchantCommissionTableMap::COL_VALID_TO, SpyMerchantCommissionTableMap::COL_PRIORITY, SpyMerchantCommissionTableMap::COL_ITEM_CONDITION, SpyMerchantCommissionTableMap::COL_ORDER_CONDITION, SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN, SpyMerchantCommissionTableMap::COL_CREATED_AT, SpyMerchantCommissionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_commission', 'fk_merchant_commission_group', 'uuid', 'name', 'description', 'key', 'amount', 'is_active', 'valid_from', 'valid_to', 'priority', 'item_condition', 'order_condition', 'calculator_type_plugin', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantCommission' => 0, 'FkMerchantCommissionGroup' => 1, 'Uuid' => 2, 'Name' => 3, 'Description' => 4, 'Key' => 5, 'Amount' => 6, 'IsActive' => 7, 'ValidFrom' => 8, 'ValidTo' => 9, 'Priority' => 10, 'ItemCondition' => 11, 'OrderCondition' => 12, 'CalculatorTypePlugin' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ],
        self::TYPE_CAMELNAME     => ['idMerchantCommission' => 0, 'fkMerchantCommissionGroup' => 1, 'uuid' => 2, 'name' => 3, 'description' => 4, 'key' => 5, 'amount' => 6, 'isActive' => 7, 'validFrom' => 8, 'validTo' => 9, 'priority' => 10, 'itemCondition' => 11, 'orderCondition' => 12, 'calculatorTypePlugin' => 13, 'createdAt' => 14, 'updatedAt' => 15, ],
        self::TYPE_COLNAME       => [SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION => 0, SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP => 1, SpyMerchantCommissionTableMap::COL_UUID => 2, SpyMerchantCommissionTableMap::COL_NAME => 3, SpyMerchantCommissionTableMap::COL_DESCRIPTION => 4, SpyMerchantCommissionTableMap::COL_KEY => 5, SpyMerchantCommissionTableMap::COL_AMOUNT => 6, SpyMerchantCommissionTableMap::COL_IS_ACTIVE => 7, SpyMerchantCommissionTableMap::COL_VALID_FROM => 8, SpyMerchantCommissionTableMap::COL_VALID_TO => 9, SpyMerchantCommissionTableMap::COL_PRIORITY => 10, SpyMerchantCommissionTableMap::COL_ITEM_CONDITION => 11, SpyMerchantCommissionTableMap::COL_ORDER_CONDITION => 12, SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN => 13, SpyMerchantCommissionTableMap::COL_CREATED_AT => 14, SpyMerchantCommissionTableMap::COL_UPDATED_AT => 15, ],
        self::TYPE_FIELDNAME     => ['id_merchant_commission' => 0, 'fk_merchant_commission_group' => 1, 'uuid' => 2, 'name' => 3, 'description' => 4, 'key' => 5, 'amount' => 6, 'is_active' => 7, 'valid_from' => 8, 'valid_to' => 9, 'priority' => 10, 'item_condition' => 11, 'order_condition' => 12, 'calculator_type_plugin' => 13, 'created_at' => 14, 'updated_at' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantCommission' => 'ID_MERCHANT_COMMISSION',
        'SpyMerchantCommission.IdMerchantCommission' => 'ID_MERCHANT_COMMISSION',
        'idMerchantCommission' => 'ID_MERCHANT_COMMISSION',
        'spyMerchantCommission.idMerchantCommission' => 'ID_MERCHANT_COMMISSION',
        'SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION' => 'ID_MERCHANT_COMMISSION',
        'COL_ID_MERCHANT_COMMISSION' => 'ID_MERCHANT_COMMISSION',
        'id_merchant_commission' => 'ID_MERCHANT_COMMISSION',
        'spy_merchant_commission.id_merchant_commission' => 'ID_MERCHANT_COMMISSION',
        'FkMerchantCommissionGroup' => 'FK_MERCHANT_COMMISSION_GROUP',
        'SpyMerchantCommission.FkMerchantCommissionGroup' => 'FK_MERCHANT_COMMISSION_GROUP',
        'fkMerchantCommissionGroup' => 'FK_MERCHANT_COMMISSION_GROUP',
        'spyMerchantCommission.fkMerchantCommissionGroup' => 'FK_MERCHANT_COMMISSION_GROUP',
        'SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP' => 'FK_MERCHANT_COMMISSION_GROUP',
        'COL_FK_MERCHANT_COMMISSION_GROUP' => 'FK_MERCHANT_COMMISSION_GROUP',
        'fk_merchant_commission_group' => 'FK_MERCHANT_COMMISSION_GROUP',
        'spy_merchant_commission.fk_merchant_commission_group' => 'FK_MERCHANT_COMMISSION_GROUP',
        'Uuid' => 'UUID',
        'SpyMerchantCommission.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyMerchantCommission.uuid' => 'UUID',
        'SpyMerchantCommissionTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_merchant_commission.uuid' => 'UUID',
        'Name' => 'NAME',
        'SpyMerchantCommission.Name' => 'NAME',
        'name' => 'NAME',
        'spyMerchantCommission.name' => 'NAME',
        'SpyMerchantCommissionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_merchant_commission.name' => 'NAME',
        'Description' => 'DESCRIPTION',
        'SpyMerchantCommission.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyMerchantCommission.description' => 'DESCRIPTION',
        'SpyMerchantCommissionTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_merchant_commission.description' => 'DESCRIPTION',
        'Key' => 'KEY',
        'SpyMerchantCommission.Key' => 'KEY',
        'key' => 'KEY',
        'spyMerchantCommission.key' => 'KEY',
        'SpyMerchantCommissionTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_merchant_commission.key' => 'KEY',
        'Amount' => 'AMOUNT',
        'SpyMerchantCommission.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'spyMerchantCommission.amount' => 'AMOUNT',
        'SpyMerchantCommissionTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'spy_merchant_commission.amount' => 'AMOUNT',
        'IsActive' => 'IS_ACTIVE',
        'SpyMerchantCommission.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyMerchantCommission.isActive' => 'IS_ACTIVE',
        'SpyMerchantCommissionTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_merchant_commission.is_active' => 'IS_ACTIVE',
        'ValidFrom' => 'VALID_FROM',
        'SpyMerchantCommission.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyMerchantCommission.validFrom' => 'VALID_FROM',
        'SpyMerchantCommissionTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_merchant_commission.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyMerchantCommission.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyMerchantCommission.validTo' => 'VALID_TO',
        'SpyMerchantCommissionTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_merchant_commission.valid_to' => 'VALID_TO',
        'Priority' => 'PRIORITY',
        'SpyMerchantCommission.Priority' => 'PRIORITY',
        'priority' => 'PRIORITY',
        'spyMerchantCommission.priority' => 'PRIORITY',
        'SpyMerchantCommissionTableMap::COL_PRIORITY' => 'PRIORITY',
        'COL_PRIORITY' => 'PRIORITY',
        'spy_merchant_commission.priority' => 'PRIORITY',
        'ItemCondition' => 'ITEM_CONDITION',
        'SpyMerchantCommission.ItemCondition' => 'ITEM_CONDITION',
        'itemCondition' => 'ITEM_CONDITION',
        'spyMerchantCommission.itemCondition' => 'ITEM_CONDITION',
        'SpyMerchantCommissionTableMap::COL_ITEM_CONDITION' => 'ITEM_CONDITION',
        'COL_ITEM_CONDITION' => 'ITEM_CONDITION',
        'item_condition' => 'ITEM_CONDITION',
        'spy_merchant_commission.item_condition' => 'ITEM_CONDITION',
        'OrderCondition' => 'ORDER_CONDITION',
        'SpyMerchantCommission.OrderCondition' => 'ORDER_CONDITION',
        'orderCondition' => 'ORDER_CONDITION',
        'spyMerchantCommission.orderCondition' => 'ORDER_CONDITION',
        'SpyMerchantCommissionTableMap::COL_ORDER_CONDITION' => 'ORDER_CONDITION',
        'COL_ORDER_CONDITION' => 'ORDER_CONDITION',
        'order_condition' => 'ORDER_CONDITION',
        'spy_merchant_commission.order_condition' => 'ORDER_CONDITION',
        'CalculatorTypePlugin' => 'CALCULATOR_TYPE_PLUGIN',
        'SpyMerchantCommission.CalculatorTypePlugin' => 'CALCULATOR_TYPE_PLUGIN',
        'calculatorTypePlugin' => 'CALCULATOR_TYPE_PLUGIN',
        'spyMerchantCommission.calculatorTypePlugin' => 'CALCULATOR_TYPE_PLUGIN',
        'SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN' => 'CALCULATOR_TYPE_PLUGIN',
        'COL_CALCULATOR_TYPE_PLUGIN' => 'CALCULATOR_TYPE_PLUGIN',
        'calculator_type_plugin' => 'CALCULATOR_TYPE_PLUGIN',
        'spy_merchant_commission.calculator_type_plugin' => 'CALCULATOR_TYPE_PLUGIN',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantCommission.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantCommission.createdAt' => 'CREATED_AT',
        'SpyMerchantCommissionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_commission.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantCommission.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantCommission.updatedAt' => 'UPDATED_AT',
        'SpyMerchantCommissionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_commission.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant_commission');
        $this->setPhpName('SpyMerchantCommission');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommission');
        $this->setPackage('src.Orm.Zed.MerchantCommission.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_commission_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_commission', 'IdMerchantCommission', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_merchant_commission_group', 'FkMerchantCommissionGroup', 'INTEGER', 'spy_merchant_commission_group', 'id_merchant_commission_group', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 1024, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, null);
        $this->addColumn('valid_from', 'ValidFrom', 'TIMESTAMP', false, null, null);
        $this->addColumn('valid_to', 'ValidTo', 'TIMESTAMP', false, null, null);
        $this->addColumn('priority', 'Priority', 'INTEGER', true, null, 9999);
        $this->addColumn('item_condition', 'ItemCondition', 'LONGVARCHAR', false, null, null);
        $this->addColumn('order_condition', 'OrderCondition', 'LONGVARCHAR', false, null, null);
        $this->addColumn('calculator_type_plugin', 'CalculatorTypePlugin', 'VARCHAR', true, 255, null);
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
        $this->addRelation('MerchantCommissionGroup', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_commission_group',
    1 => ':id_merchant_commission_group',
  ),
), null, null, null, false);
        $this->addRelation('MerchantCommissionAmount', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionAmount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_commission',
    1 => ':id_merchant_commission',
  ),
), null, null, 'MerchantCommissionAmounts', false);
        $this->addRelation('MerchantCommissionStore', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_commission',
    1 => ':id_merchant_commission',
  ),
), null, null, 'MerchantCommissionStores', false);
        $this->addRelation('MerchantCommissionMerchant', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionMerchant', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_commission',
    1 => ':id_merchant_commission',
  ),
), null, null, 'MerchantCommissionMerchants', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_merchant_commission'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantCommissionTableMap::CLASS_DEFAULT : SpyMerchantCommissionTableMap::OM_CLASS;
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
     * @return array (SpyMerchantCommission object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantCommissionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantCommissionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantCommissionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantCommissionTableMap::OM_CLASS;
            /** @var SpyMerchantCommission $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantCommissionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantCommissionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantCommissionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantCommission $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantCommissionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_VALID_TO);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_PRIORITY);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_ITEM_CONDITION);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_ORDER_CONDITION);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantCommissionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_commission');
            $criteria->addSelectColumn($alias . '.fk_merchant_commission_group');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.valid_from');
            $criteria->addSelectColumn($alias . '.valid_to');
            $criteria->addSelectColumn($alias . '.priority');
            $criteria->addSelectColumn($alias . '.item_condition');
            $criteria->addSelectColumn($alias . '.order_condition');
            $criteria->addSelectColumn($alias . '.calculator_type_plugin');
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
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_VALID_TO);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_PRIORITY);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_ITEM_CONDITION);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_ORDER_CONDITION);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantCommissionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_commission');
            $criteria->removeSelectColumn($alias . '.fk_merchant_commission_group');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.valid_from');
            $criteria->removeSelectColumn($alias . '.valid_to');
            $criteria->removeSelectColumn($alias . '.priority');
            $criteria->removeSelectColumn($alias . '.item_condition');
            $criteria->removeSelectColumn($alias . '.order_condition');
            $criteria->removeSelectColumn($alias . '.calculator_type_plugin');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantCommissionTableMap::DATABASE_NAME)->getTable(SpyMerchantCommissionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantCommission or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantCommission object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantCommissionTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantCommissionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantCommissionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantCommissionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_commission table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantCommissionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantCommission or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantCommission object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantCommission object
        }

        if ($criteria->containsKey(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION) && $criteria->keyContainsValue(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION.')');
        }


        // Set the correct dbName
        $query = SpyMerchantCommissionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
