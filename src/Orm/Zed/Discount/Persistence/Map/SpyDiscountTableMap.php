<?php

namespace Orm\Zed\Discount\Persistence\Map;

use Orm\Zed\CustomerDiscountConnector\Persistence\Map\SpyCustomerDiscountTableMap;
use Orm\Zed\Discount\Persistence\SpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountQuery;
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
 * This class defines the structure of the 'spy_discount' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDiscountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Discount.Persistence.Map.SpyDiscountTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_discount';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDiscount';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscount';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Discount.Persistence.SpyDiscount';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the id_discount field
     */
    public const COL_ID_DISCOUNT = 'spy_discount.id_discount';

    /**
     * the column name for the fk_discount_voucher_pool field
     */
    public const COL_FK_DISCOUNT_VOUCHER_POOL = 'spy_discount.fk_discount_voucher_pool';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_discount.fk_store';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'spy_discount.amount';

    /**
     * the column name for the calculator_plugin field
     */
    public const COL_CALCULATOR_PLUGIN = 'spy_discount.calculator_plugin';

    /**
     * the column name for the collector_query_string field
     */
    public const COL_COLLECTOR_QUERY_STRING = 'spy_discount.collector_query_string';

    /**
     * the column name for the decision_rule_query_string field
     */
    public const COL_DECISION_RULE_QUERY_STRING = 'spy_discount.decision_rule_query_string';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_discount.description';

    /**
     * the column name for the discount_key field
     */
    public const COL_DISCOUNT_KEY = 'spy_discount.discount_key';

    /**
     * the column name for the discount_type field
     */
    public const COL_DISCOUNT_TYPE = 'spy_discount.discount_type';

    /**
     * the column name for the display_name field
     */
    public const COL_DISPLAY_NAME = 'spy_discount.display_name';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_discount.is_active';

    /**
     * the column name for the is_exclusive field
     */
    public const COL_IS_EXCLUSIVE = 'spy_discount.is_exclusive';

    /**
     * the column name for the minimum_item_amount field
     */
    public const COL_MINIMUM_ITEM_AMOUNT = 'spy_discount.minimum_item_amount';

    /**
     * the column name for the priority field
     */
    public const COL_PRIORITY = 'spy_discount.priority';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_discount.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_discount.valid_to';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_discount.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_discount.updated_at';

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
        self::TYPE_PHPNAME       => ['IdDiscount', 'FkDiscountVoucherPool', 'FkStore', 'Amount', 'CalculatorPlugin', 'CollectorQueryString', 'DecisionRuleQueryString', 'Description', 'DiscountKey', 'DiscountType', 'DisplayName', 'IsActive', 'IsExclusive', 'MinimumItemAmount', 'Priority', 'ValidFrom', 'ValidTo', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idDiscount', 'fkDiscountVoucherPool', 'fkStore', 'amount', 'calculatorPlugin', 'collectorQueryString', 'decisionRuleQueryString', 'description', 'discountKey', 'discountType', 'displayName', 'isActive', 'isExclusive', 'minimumItemAmount', 'priority', 'validFrom', 'validTo', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyDiscountTableMap::COL_ID_DISCOUNT, SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, SpyDiscountTableMap::COL_FK_STORE, SpyDiscountTableMap::COL_AMOUNT, SpyDiscountTableMap::COL_CALCULATOR_PLUGIN, SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING, SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING, SpyDiscountTableMap::COL_DESCRIPTION, SpyDiscountTableMap::COL_DISCOUNT_KEY, SpyDiscountTableMap::COL_DISCOUNT_TYPE, SpyDiscountTableMap::COL_DISPLAY_NAME, SpyDiscountTableMap::COL_IS_ACTIVE, SpyDiscountTableMap::COL_IS_EXCLUSIVE, SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT, SpyDiscountTableMap::COL_PRIORITY, SpyDiscountTableMap::COL_VALID_FROM, SpyDiscountTableMap::COL_VALID_TO, SpyDiscountTableMap::COL_CREATED_AT, SpyDiscountTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_discount', 'fk_discount_voucher_pool', 'fk_store', 'amount', 'calculator_plugin', 'collector_query_string', 'decision_rule_query_string', 'description', 'discount_key', 'discount_type', 'display_name', 'is_active', 'is_exclusive', 'minimum_item_amount', 'priority', 'valid_from', 'valid_to', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
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
        self::TYPE_PHPNAME       => ['IdDiscount' => 0, 'FkDiscountVoucherPool' => 1, 'FkStore' => 2, 'Amount' => 3, 'CalculatorPlugin' => 4, 'CollectorQueryString' => 5, 'DecisionRuleQueryString' => 6, 'Description' => 7, 'DiscountKey' => 8, 'DiscountType' => 9, 'DisplayName' => 10, 'IsActive' => 11, 'IsExclusive' => 12, 'MinimumItemAmount' => 13, 'Priority' => 14, 'ValidFrom' => 15, 'ValidTo' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, ],
        self::TYPE_CAMELNAME     => ['idDiscount' => 0, 'fkDiscountVoucherPool' => 1, 'fkStore' => 2, 'amount' => 3, 'calculatorPlugin' => 4, 'collectorQueryString' => 5, 'decisionRuleQueryString' => 6, 'description' => 7, 'discountKey' => 8, 'discountType' => 9, 'displayName' => 10, 'isActive' => 11, 'isExclusive' => 12, 'minimumItemAmount' => 13, 'priority' => 14, 'validFrom' => 15, 'validTo' => 16, 'createdAt' => 17, 'updatedAt' => 18, ],
        self::TYPE_COLNAME       => [SpyDiscountTableMap::COL_ID_DISCOUNT => 0, SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL => 1, SpyDiscountTableMap::COL_FK_STORE => 2, SpyDiscountTableMap::COL_AMOUNT => 3, SpyDiscountTableMap::COL_CALCULATOR_PLUGIN => 4, SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING => 5, SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING => 6, SpyDiscountTableMap::COL_DESCRIPTION => 7, SpyDiscountTableMap::COL_DISCOUNT_KEY => 8, SpyDiscountTableMap::COL_DISCOUNT_TYPE => 9, SpyDiscountTableMap::COL_DISPLAY_NAME => 10, SpyDiscountTableMap::COL_IS_ACTIVE => 11, SpyDiscountTableMap::COL_IS_EXCLUSIVE => 12, SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT => 13, SpyDiscountTableMap::COL_PRIORITY => 14, SpyDiscountTableMap::COL_VALID_FROM => 15, SpyDiscountTableMap::COL_VALID_TO => 16, SpyDiscountTableMap::COL_CREATED_AT => 17, SpyDiscountTableMap::COL_UPDATED_AT => 18, ],
        self::TYPE_FIELDNAME     => ['id_discount' => 0, 'fk_discount_voucher_pool' => 1, 'fk_store' => 2, 'amount' => 3, 'calculator_plugin' => 4, 'collector_query_string' => 5, 'decision_rule_query_string' => 6, 'description' => 7, 'discount_key' => 8, 'discount_type' => 9, 'display_name' => 10, 'is_active' => 11, 'is_exclusive' => 12, 'minimum_item_amount' => 13, 'priority' => 14, 'valid_from' => 15, 'valid_to' => 16, 'created_at' => 17, 'updated_at' => 18, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDiscount' => 'ID_DISCOUNT',
        'SpyDiscount.IdDiscount' => 'ID_DISCOUNT',
        'idDiscount' => 'ID_DISCOUNT',
        'spyDiscount.idDiscount' => 'ID_DISCOUNT',
        'SpyDiscountTableMap::COL_ID_DISCOUNT' => 'ID_DISCOUNT',
        'COL_ID_DISCOUNT' => 'ID_DISCOUNT',
        'id_discount' => 'ID_DISCOUNT',
        'spy_discount.id_discount' => 'ID_DISCOUNT',
        'FkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'SpyDiscount.FkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'fkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'spyDiscount.fkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL' => 'FK_DISCOUNT_VOUCHER_POOL',
        'COL_FK_DISCOUNT_VOUCHER_POOL' => 'FK_DISCOUNT_VOUCHER_POOL',
        'fk_discount_voucher_pool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'spy_discount.fk_discount_voucher_pool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'FkStore' => 'FK_STORE',
        'SpyDiscount.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyDiscount.fkStore' => 'FK_STORE',
        'SpyDiscountTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_discount.fk_store' => 'FK_STORE',
        'Amount' => 'AMOUNT',
        'SpyDiscount.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'spyDiscount.amount' => 'AMOUNT',
        'SpyDiscountTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'spy_discount.amount' => 'AMOUNT',
        'CalculatorPlugin' => 'CALCULATOR_PLUGIN',
        'SpyDiscount.CalculatorPlugin' => 'CALCULATOR_PLUGIN',
        'calculatorPlugin' => 'CALCULATOR_PLUGIN',
        'spyDiscount.calculatorPlugin' => 'CALCULATOR_PLUGIN',
        'SpyDiscountTableMap::COL_CALCULATOR_PLUGIN' => 'CALCULATOR_PLUGIN',
        'COL_CALCULATOR_PLUGIN' => 'CALCULATOR_PLUGIN',
        'calculator_plugin' => 'CALCULATOR_PLUGIN',
        'spy_discount.calculator_plugin' => 'CALCULATOR_PLUGIN',
        'CollectorQueryString' => 'COLLECTOR_QUERY_STRING',
        'SpyDiscount.CollectorQueryString' => 'COLLECTOR_QUERY_STRING',
        'collectorQueryString' => 'COLLECTOR_QUERY_STRING',
        'spyDiscount.collectorQueryString' => 'COLLECTOR_QUERY_STRING',
        'SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING' => 'COLLECTOR_QUERY_STRING',
        'COL_COLLECTOR_QUERY_STRING' => 'COLLECTOR_QUERY_STRING',
        'collector_query_string' => 'COLLECTOR_QUERY_STRING',
        'spy_discount.collector_query_string' => 'COLLECTOR_QUERY_STRING',
        'DecisionRuleQueryString' => 'DECISION_RULE_QUERY_STRING',
        'SpyDiscount.DecisionRuleQueryString' => 'DECISION_RULE_QUERY_STRING',
        'decisionRuleQueryString' => 'DECISION_RULE_QUERY_STRING',
        'spyDiscount.decisionRuleQueryString' => 'DECISION_RULE_QUERY_STRING',
        'SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING' => 'DECISION_RULE_QUERY_STRING',
        'COL_DECISION_RULE_QUERY_STRING' => 'DECISION_RULE_QUERY_STRING',
        'decision_rule_query_string' => 'DECISION_RULE_QUERY_STRING',
        'spy_discount.decision_rule_query_string' => 'DECISION_RULE_QUERY_STRING',
        'Description' => 'DESCRIPTION',
        'SpyDiscount.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyDiscount.description' => 'DESCRIPTION',
        'SpyDiscountTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_discount.description' => 'DESCRIPTION',
        'DiscountKey' => 'DISCOUNT_KEY',
        'SpyDiscount.DiscountKey' => 'DISCOUNT_KEY',
        'discountKey' => 'DISCOUNT_KEY',
        'spyDiscount.discountKey' => 'DISCOUNT_KEY',
        'SpyDiscountTableMap::COL_DISCOUNT_KEY' => 'DISCOUNT_KEY',
        'COL_DISCOUNT_KEY' => 'DISCOUNT_KEY',
        'discount_key' => 'DISCOUNT_KEY',
        'spy_discount.discount_key' => 'DISCOUNT_KEY',
        'DiscountType' => 'DISCOUNT_TYPE',
        'SpyDiscount.DiscountType' => 'DISCOUNT_TYPE',
        'discountType' => 'DISCOUNT_TYPE',
        'spyDiscount.discountType' => 'DISCOUNT_TYPE',
        'SpyDiscountTableMap::COL_DISCOUNT_TYPE' => 'DISCOUNT_TYPE',
        'COL_DISCOUNT_TYPE' => 'DISCOUNT_TYPE',
        'discount_type' => 'DISCOUNT_TYPE',
        'spy_discount.discount_type' => 'DISCOUNT_TYPE',
        'DisplayName' => 'DISPLAY_NAME',
        'SpyDiscount.DisplayName' => 'DISPLAY_NAME',
        'displayName' => 'DISPLAY_NAME',
        'spyDiscount.displayName' => 'DISPLAY_NAME',
        'SpyDiscountTableMap::COL_DISPLAY_NAME' => 'DISPLAY_NAME',
        'COL_DISPLAY_NAME' => 'DISPLAY_NAME',
        'display_name' => 'DISPLAY_NAME',
        'spy_discount.display_name' => 'DISPLAY_NAME',
        'IsActive' => 'IS_ACTIVE',
        'SpyDiscount.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyDiscount.isActive' => 'IS_ACTIVE',
        'SpyDiscountTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_discount.is_active' => 'IS_ACTIVE',
        'IsExclusive' => 'IS_EXCLUSIVE',
        'SpyDiscount.IsExclusive' => 'IS_EXCLUSIVE',
        'isExclusive' => 'IS_EXCLUSIVE',
        'spyDiscount.isExclusive' => 'IS_EXCLUSIVE',
        'SpyDiscountTableMap::COL_IS_EXCLUSIVE' => 'IS_EXCLUSIVE',
        'COL_IS_EXCLUSIVE' => 'IS_EXCLUSIVE',
        'is_exclusive' => 'IS_EXCLUSIVE',
        'spy_discount.is_exclusive' => 'IS_EXCLUSIVE',
        'MinimumItemAmount' => 'MINIMUM_ITEM_AMOUNT',
        'SpyDiscount.MinimumItemAmount' => 'MINIMUM_ITEM_AMOUNT',
        'minimumItemAmount' => 'MINIMUM_ITEM_AMOUNT',
        'spyDiscount.minimumItemAmount' => 'MINIMUM_ITEM_AMOUNT',
        'SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT' => 'MINIMUM_ITEM_AMOUNT',
        'COL_MINIMUM_ITEM_AMOUNT' => 'MINIMUM_ITEM_AMOUNT',
        'minimum_item_amount' => 'MINIMUM_ITEM_AMOUNT',
        'spy_discount.minimum_item_amount' => 'MINIMUM_ITEM_AMOUNT',
        'Priority' => 'PRIORITY',
        'SpyDiscount.Priority' => 'PRIORITY',
        'priority' => 'PRIORITY',
        'spyDiscount.priority' => 'PRIORITY',
        'SpyDiscountTableMap::COL_PRIORITY' => 'PRIORITY',
        'COL_PRIORITY' => 'PRIORITY',
        'spy_discount.priority' => 'PRIORITY',
        'ValidFrom' => 'VALID_FROM',
        'SpyDiscount.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyDiscount.validFrom' => 'VALID_FROM',
        'SpyDiscountTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_discount.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyDiscount.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyDiscount.validTo' => 'VALID_TO',
        'SpyDiscountTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_discount.valid_to' => 'VALID_TO',
        'CreatedAt' => 'CREATED_AT',
        'SpyDiscount.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyDiscount.createdAt' => 'CREATED_AT',
        'SpyDiscountTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_discount.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyDiscount.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyDiscount.updatedAt' => 'UPDATED_AT',
        'SpyDiscountTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_discount.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_discount');
        $this->setPhpName('SpyDiscount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Discount\\Persistence\\SpyDiscount');
        $this->setPackage('src.Orm.Zed.Discount.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_discount_pk_seq');
        // columns
        $this->addPrimaryKey('id_discount', 'IdDiscount', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_discount_voucher_pool', 'FkDiscountVoucherPool', 'INTEGER', 'spy_discount_voucher_pool', 'id_discount_voucher_pool', false, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', true, null, null);
        $this->addColumn('calculator_plugin', 'CalculatorPlugin', 'VARCHAR', false, 255, null);
        $this->addColumn('collector_query_string', 'CollectorQueryString', 'LONGVARCHAR', false, null, null);
        $this->addColumn('decision_rule_query_string', 'DecisionRuleQueryString', 'LONGVARCHAR', false, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 1024, null);
        $this->addColumn('discount_key', 'DiscountKey', 'VARCHAR', false, 32, null);
        $this->addColumn('discount_type', 'DiscountType', 'VARCHAR', false, 255, null);
        $this->addColumn('display_name', 'DisplayName', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_exclusive', 'IsExclusive', 'BOOLEAN', false, 1, false);
        $this->addColumn('minimum_item_amount', 'MinimumItemAmount', 'INTEGER', true, null, 1);
        $this->addColumn('priority', 'Priority', 'INTEGER', false, null, 9999);
        $this->addColumn('valid_from', 'ValidFrom', 'TIMESTAMP', false, null, null);
        $this->addColumn('valid_to', 'ValidTo', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('VoucherPool', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucherPool', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_discount_voucher_pool',
    1 => ':id_discount_voucher_pool',
  ),
), null, null, null, false);
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
  ),
), null, null, null, false);
        $this->addRelation('SpyCustomerDiscount', '\\Orm\\Zed\\CustomerDiscountConnector\\Persistence\\SpyCustomerDiscount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_discount',
    1 => ':id_discount',
  ),
), 'CASCADE', null, 'SpyCustomerDiscounts', false);
        $this->addRelation('SpyDiscountStore', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_discount',
    1 => ':id_discount',
  ),
), null, null, 'SpyDiscountStores', false);
        $this->addRelation('DiscountAmount', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountAmount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_discount',
    1 => ':id_discount',
  ),
), null, null, 'DiscountAmounts', false);
        $this->addRelation('DiscountPromotion', '\\Orm\\Zed\\DiscountPromotion\\Persistence\\SpyDiscountPromotion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_discount',
    1 => ':id_discount',
  ),
), null, null, 'DiscountPromotions', false);
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
     * Method to invalidate the instance pool of all tables related to spy_discount     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCustomerDiscountTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDiscount', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDiscountTableMap::CLASS_DEFAULT : SpyDiscountTableMap::OM_CLASS;
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
     * @return array (SpyDiscount object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDiscountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDiscountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDiscountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDiscountTableMap::OM_CLASS;
            /** @var SpyDiscount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDiscountTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDiscountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDiscountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDiscount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDiscountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_ID_DISCOUNT);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_CALCULATOR_PLUGIN);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_DISCOUNT_KEY);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_DISCOUNT_TYPE);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_DISPLAY_NAME);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_IS_EXCLUSIVE);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_PRIORITY);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_VALID_TO);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyDiscountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_discount');
            $criteria->addSelectColumn($alias . '.fk_discount_voucher_pool');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.calculator_plugin');
            $criteria->addSelectColumn($alias . '.collector_query_string');
            $criteria->addSelectColumn($alias . '.decision_rule_query_string');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.discount_key');
            $criteria->addSelectColumn($alias . '.discount_type');
            $criteria->addSelectColumn($alias . '.display_name');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_exclusive');
            $criteria->addSelectColumn($alias . '.minimum_item_amount');
            $criteria->addSelectColumn($alias . '.priority');
            $criteria->addSelectColumn($alias . '.valid_from');
            $criteria->addSelectColumn($alias . '.valid_to');
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
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_ID_DISCOUNT);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_CALCULATOR_PLUGIN);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_DISCOUNT_KEY);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_DISCOUNT_TYPE);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_DISPLAY_NAME);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_IS_EXCLUSIVE);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_PRIORITY);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_VALID_TO);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyDiscountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_discount');
            $criteria->removeSelectColumn($alias . '.fk_discount_voucher_pool');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.calculator_plugin');
            $criteria->removeSelectColumn($alias . '.collector_query_string');
            $criteria->removeSelectColumn($alias . '.decision_rule_query_string');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.discount_key');
            $criteria->removeSelectColumn($alias . '.discount_type');
            $criteria->removeSelectColumn($alias . '.display_name');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_exclusive');
            $criteria->removeSelectColumn($alias . '.minimum_item_amount');
            $criteria->removeSelectColumn($alias . '.priority');
            $criteria->removeSelectColumn($alias . '.valid_from');
            $criteria->removeSelectColumn($alias . '.valid_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDiscountTableMap::DATABASE_NAME)->getTable(SpyDiscountTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDiscount or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDiscount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Discount\Persistence\SpyDiscount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDiscountTableMap::DATABASE_NAME);
            $criteria->add(SpyDiscountTableMap::COL_ID_DISCOUNT, (array) $values, Criteria::IN);
        }

        $query = SpyDiscountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDiscountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDiscountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_discount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDiscountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDiscount or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDiscount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDiscount object
        }

        if ($criteria->containsKey(SpyDiscountTableMap::COL_ID_DISCOUNT) && $criteria->keyContainsValue(SpyDiscountTableMap::COL_ID_DISCOUNT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDiscountTableMap::COL_ID_DISCOUNT.')');
        }


        // Set the correct dbName
        $query = SpyDiscountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
