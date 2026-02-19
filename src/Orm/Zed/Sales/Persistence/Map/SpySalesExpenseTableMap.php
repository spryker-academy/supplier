<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesExpense;
use Orm\Zed\Sales\Persistence\SpySalesExpenseQuery;
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
 * This class defines the structure of the 'spy_sales_expense' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesExpenseTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesExpenseTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_expense';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesExpense';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesExpense';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesExpense';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the id_sales_expense field
     */
    public const COL_ID_SALES_EXPENSE = 'spy_sales_expense.id_sales_expense';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_expense.fk_sales_order';

    /**
     * the column name for the canceled_amount field
     */
    public const COL_CANCELED_AMOUNT = 'spy_sales_expense.canceled_amount';

    /**
     * the column name for the discount_amount_aggregation field
     */
    public const COL_DISCOUNT_AMOUNT_AGGREGATION = 'spy_sales_expense.discount_amount_aggregation';

    /**
     * the column name for the gross_price field
     */
    public const COL_GROSS_PRICE = 'spy_sales_expense.gross_price';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_sales_expense.merchant_reference';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_expense.name';

    /**
     * the column name for the net_price field
     */
    public const COL_NET_PRICE = 'spy_sales_expense.net_price';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'spy_sales_expense.price';

    /**
     * the column name for the price_to_pay_aggregation field
     */
    public const COL_PRICE_TO_PAY_AGGREGATION = 'spy_sales_expense.price_to_pay_aggregation';

    /**
     * the column name for the refundable_amount field
     */
    public const COL_REFUNDABLE_AMOUNT = 'spy_sales_expense.refundable_amount';

    /**
     * the column name for the tax_amount field
     */
    public const COL_TAX_AMOUNT = 'spy_sales_expense.tax_amount';

    /**
     * the column name for the tax_amount_after_cancellation field
     */
    public const COL_TAX_AMOUNT_AFTER_CANCELLATION = 'spy_sales_expense.tax_amount_after_cancellation';

    /**
     * the column name for the tax_rate field
     */
    public const COL_TAX_RATE = 'spy_sales_expense.tax_rate';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_sales_expense.type';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_sales_expense.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_expense.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_expense.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesExpense', 'FkSalesOrder', 'CanceledAmount', 'DiscountAmountAggregation', 'GrossPrice', 'MerchantReference', 'Name', 'NetPrice', 'Price', 'PriceToPayAggregation', 'RefundableAmount', 'TaxAmount', 'TaxAmountAfterCancellation', 'TaxRate', 'Type', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesExpense', 'fkSalesOrder', 'canceledAmount', 'discountAmountAggregation', 'grossPrice', 'merchantReference', 'name', 'netPrice', 'price', 'priceToPayAggregation', 'refundableAmount', 'taxAmount', 'taxAmountAfterCancellation', 'taxRate', 'type', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, SpySalesExpenseTableMap::COL_FK_SALES_ORDER, SpySalesExpenseTableMap::COL_CANCELED_AMOUNT, SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, SpySalesExpenseTableMap::COL_GROSS_PRICE, SpySalesExpenseTableMap::COL_MERCHANT_REFERENCE, SpySalesExpenseTableMap::COL_NAME, SpySalesExpenseTableMap::COL_NET_PRICE, SpySalesExpenseTableMap::COL_PRICE, SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION, SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT, SpySalesExpenseTableMap::COL_TAX_AMOUNT, SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION, SpySalesExpenseTableMap::COL_TAX_RATE, SpySalesExpenseTableMap::COL_TYPE, SpySalesExpenseTableMap::COL_UUID, SpySalesExpenseTableMap::COL_CREATED_AT, SpySalesExpenseTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_expense', 'fk_sales_order', 'canceled_amount', 'discount_amount_aggregation', 'gross_price', 'merchant_reference', 'name', 'net_price', 'price', 'price_to_pay_aggregation', 'refundable_amount', 'tax_amount', 'tax_amount_after_cancellation', 'tax_rate', 'type', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
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
        self::TYPE_PHPNAME       => ['IdSalesExpense' => 0, 'FkSalesOrder' => 1, 'CanceledAmount' => 2, 'DiscountAmountAggregation' => 3, 'GrossPrice' => 4, 'MerchantReference' => 5, 'Name' => 6, 'NetPrice' => 7, 'Price' => 8, 'PriceToPayAggregation' => 9, 'RefundableAmount' => 10, 'TaxAmount' => 11, 'TaxAmountAfterCancellation' => 12, 'TaxRate' => 13, 'Type' => 14, 'Uuid' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ],
        self::TYPE_CAMELNAME     => ['idSalesExpense' => 0, 'fkSalesOrder' => 1, 'canceledAmount' => 2, 'discountAmountAggregation' => 3, 'grossPrice' => 4, 'merchantReference' => 5, 'name' => 6, 'netPrice' => 7, 'price' => 8, 'priceToPayAggregation' => 9, 'refundableAmount' => 10, 'taxAmount' => 11, 'taxAmountAfterCancellation' => 12, 'taxRate' => 13, 'type' => 14, 'uuid' => 15, 'createdAt' => 16, 'updatedAt' => 17, ],
        self::TYPE_COLNAME       => [SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE => 0, SpySalesExpenseTableMap::COL_FK_SALES_ORDER => 1, SpySalesExpenseTableMap::COL_CANCELED_AMOUNT => 2, SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION => 3, SpySalesExpenseTableMap::COL_GROSS_PRICE => 4, SpySalesExpenseTableMap::COL_MERCHANT_REFERENCE => 5, SpySalesExpenseTableMap::COL_NAME => 6, SpySalesExpenseTableMap::COL_NET_PRICE => 7, SpySalesExpenseTableMap::COL_PRICE => 8, SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION => 9, SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT => 10, SpySalesExpenseTableMap::COL_TAX_AMOUNT => 11, SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION => 12, SpySalesExpenseTableMap::COL_TAX_RATE => 13, SpySalesExpenseTableMap::COL_TYPE => 14, SpySalesExpenseTableMap::COL_UUID => 15, SpySalesExpenseTableMap::COL_CREATED_AT => 16, SpySalesExpenseTableMap::COL_UPDATED_AT => 17, ],
        self::TYPE_FIELDNAME     => ['id_sales_expense' => 0, 'fk_sales_order' => 1, 'canceled_amount' => 2, 'discount_amount_aggregation' => 3, 'gross_price' => 4, 'merchant_reference' => 5, 'name' => 6, 'net_price' => 7, 'price' => 8, 'price_to_pay_aggregation' => 9, 'refundable_amount' => 10, 'tax_amount' => 11, 'tax_amount_after_cancellation' => 12, 'tax_rate' => 13, 'type' => 14, 'uuid' => 15, 'created_at' => 16, 'updated_at' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesExpense' => 'ID_SALES_EXPENSE',
        'SpySalesExpense.IdSalesExpense' => 'ID_SALES_EXPENSE',
        'idSalesExpense' => 'ID_SALES_EXPENSE',
        'spySalesExpense.idSalesExpense' => 'ID_SALES_EXPENSE',
        'SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE' => 'ID_SALES_EXPENSE',
        'COL_ID_SALES_EXPENSE' => 'ID_SALES_EXPENSE',
        'id_sales_expense' => 'ID_SALES_EXPENSE',
        'spy_sales_expense.id_sales_expense' => 'ID_SALES_EXPENSE',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesExpense.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesExpense.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesExpenseTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_expense.fk_sales_order' => 'FK_SALES_ORDER',
        'CanceledAmount' => 'CANCELED_AMOUNT',
        'SpySalesExpense.CanceledAmount' => 'CANCELED_AMOUNT',
        'canceledAmount' => 'CANCELED_AMOUNT',
        'spySalesExpense.canceledAmount' => 'CANCELED_AMOUNT',
        'SpySalesExpenseTableMap::COL_CANCELED_AMOUNT' => 'CANCELED_AMOUNT',
        'COL_CANCELED_AMOUNT' => 'CANCELED_AMOUNT',
        'canceled_amount' => 'CANCELED_AMOUNT',
        'spy_sales_expense.canceled_amount' => 'CANCELED_AMOUNT',
        'DiscountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'SpySalesExpense.DiscountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'discountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'spySalesExpense.discountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'COL_DISCOUNT_AMOUNT_AGGREGATION' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'discount_amount_aggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'spy_sales_expense.discount_amount_aggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'GrossPrice' => 'GROSS_PRICE',
        'SpySalesExpense.GrossPrice' => 'GROSS_PRICE',
        'grossPrice' => 'GROSS_PRICE',
        'spySalesExpense.grossPrice' => 'GROSS_PRICE',
        'SpySalesExpenseTableMap::COL_GROSS_PRICE' => 'GROSS_PRICE',
        'COL_GROSS_PRICE' => 'GROSS_PRICE',
        'gross_price' => 'GROSS_PRICE',
        'spy_sales_expense.gross_price' => 'GROSS_PRICE',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpySalesExpense.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spySalesExpense.merchantReference' => 'MERCHANT_REFERENCE',
        'SpySalesExpenseTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_sales_expense.merchant_reference' => 'MERCHANT_REFERENCE',
        'Name' => 'NAME',
        'SpySalesExpense.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesExpense.name' => 'NAME',
        'SpySalesExpenseTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_expense.name' => 'NAME',
        'NetPrice' => 'NET_PRICE',
        'SpySalesExpense.NetPrice' => 'NET_PRICE',
        'netPrice' => 'NET_PRICE',
        'spySalesExpense.netPrice' => 'NET_PRICE',
        'SpySalesExpenseTableMap::COL_NET_PRICE' => 'NET_PRICE',
        'COL_NET_PRICE' => 'NET_PRICE',
        'net_price' => 'NET_PRICE',
        'spy_sales_expense.net_price' => 'NET_PRICE',
        'Price' => 'PRICE',
        'SpySalesExpense.Price' => 'PRICE',
        'price' => 'PRICE',
        'spySalesExpense.price' => 'PRICE',
        'SpySalesExpenseTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'spy_sales_expense.price' => 'PRICE',
        'PriceToPayAggregation' => 'PRICE_TO_PAY_AGGREGATION',
        'SpySalesExpense.PriceToPayAggregation' => 'PRICE_TO_PAY_AGGREGATION',
        'priceToPayAggregation' => 'PRICE_TO_PAY_AGGREGATION',
        'spySalesExpense.priceToPayAggregation' => 'PRICE_TO_PAY_AGGREGATION',
        'SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION' => 'PRICE_TO_PAY_AGGREGATION',
        'COL_PRICE_TO_PAY_AGGREGATION' => 'PRICE_TO_PAY_AGGREGATION',
        'price_to_pay_aggregation' => 'PRICE_TO_PAY_AGGREGATION',
        'spy_sales_expense.price_to_pay_aggregation' => 'PRICE_TO_PAY_AGGREGATION',
        'RefundableAmount' => 'REFUNDABLE_AMOUNT',
        'SpySalesExpense.RefundableAmount' => 'REFUNDABLE_AMOUNT',
        'refundableAmount' => 'REFUNDABLE_AMOUNT',
        'spySalesExpense.refundableAmount' => 'REFUNDABLE_AMOUNT',
        'SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT' => 'REFUNDABLE_AMOUNT',
        'COL_REFUNDABLE_AMOUNT' => 'REFUNDABLE_AMOUNT',
        'refundable_amount' => 'REFUNDABLE_AMOUNT',
        'spy_sales_expense.refundable_amount' => 'REFUNDABLE_AMOUNT',
        'TaxAmount' => 'TAX_AMOUNT',
        'SpySalesExpense.TaxAmount' => 'TAX_AMOUNT',
        'taxAmount' => 'TAX_AMOUNT',
        'spySalesExpense.taxAmount' => 'TAX_AMOUNT',
        'SpySalesExpenseTableMap::COL_TAX_AMOUNT' => 'TAX_AMOUNT',
        'COL_TAX_AMOUNT' => 'TAX_AMOUNT',
        'tax_amount' => 'TAX_AMOUNT',
        'spy_sales_expense.tax_amount' => 'TAX_AMOUNT',
        'TaxAmountAfterCancellation' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'SpySalesExpense.TaxAmountAfterCancellation' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'taxAmountAfterCancellation' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'spySalesExpense.taxAmountAfterCancellation' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'COL_TAX_AMOUNT_AFTER_CANCELLATION' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'tax_amount_after_cancellation' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'spy_sales_expense.tax_amount_after_cancellation' => 'TAX_AMOUNT_AFTER_CANCELLATION',
        'TaxRate' => 'TAX_RATE',
        'SpySalesExpense.TaxRate' => 'TAX_RATE',
        'taxRate' => 'TAX_RATE',
        'spySalesExpense.taxRate' => 'TAX_RATE',
        'SpySalesExpenseTableMap::COL_TAX_RATE' => 'TAX_RATE',
        'COL_TAX_RATE' => 'TAX_RATE',
        'tax_rate' => 'TAX_RATE',
        'spy_sales_expense.tax_rate' => 'TAX_RATE',
        'Type' => 'TYPE',
        'SpySalesExpense.Type' => 'TYPE',
        'type' => 'TYPE',
        'spySalesExpense.type' => 'TYPE',
        'SpySalesExpenseTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_sales_expense.type' => 'TYPE',
        'Uuid' => 'UUID',
        'SpySalesExpense.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spySalesExpense.uuid' => 'UUID',
        'SpySalesExpenseTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_sales_expense.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesExpense.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesExpense.createdAt' => 'CREATED_AT',
        'SpySalesExpenseTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_expense.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesExpense.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesExpense.updatedAt' => 'UPDATED_AT',
        'SpySalesExpenseTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_expense.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_expense');
        $this->setPhpName('SpySalesExpense');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesExpense');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_expense_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_expense', 'IdSalesExpense', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', false, null, null);
        $this->addColumn('canceled_amount', 'CanceledAmount', 'INTEGER', false, null, 0);
        $this->addColumn('discount_amount_aggregation', 'DiscountAmountAggregation', 'INTEGER', false, null, 0);
        $this->addColumn('gross_price', 'GrossPrice', 'INTEGER', true, null, null);
        $this->addColumn('merchant_reference', 'MerchantReference', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('net_price', 'NetPrice', 'INTEGER', false, null, 0);
        $this->addColumn('price', 'Price', 'INTEGER', false, null, 0);
        $this->addColumn('price_to_pay_aggregation', 'PriceToPayAggregation', 'INTEGER', false, null, 0);
        $this->addColumn('refundable_amount', 'RefundableAmount', 'INTEGER', false, null, 0);
        $this->addColumn('tax_amount', 'TaxAmount', 'INTEGER', false, null, 0);
        $this->addColumn('tax_amount_after_cancellation', 'TaxAmountAfterCancellation', 'INTEGER', false, null, 0);
        $this->addColumn('tax_rate', 'TaxRate', 'DECIMAL', false, 8, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 150, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
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
        $this->addRelation('Order', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('Discount', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_expense',
    1 => ':id_sales_expense',
  ),
), null, null, 'Discounts', false);
        $this->addRelation('SpySalesShipment', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesShipment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_expense',
    1 => ':id_sales_expense',
  ),
), null, null, 'SpySalesShipments', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_sales_expense.fk_sales_order'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesExpense', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesExpenseTableMap::CLASS_DEFAULT : SpySalesExpenseTableMap::OM_CLASS;
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
     * @return array (SpySalesExpense object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesExpenseTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesExpenseTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesExpenseTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesExpenseTableMap::OM_CLASS;
            /** @var SpySalesExpense $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesExpenseTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesExpenseTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesExpenseTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesExpense $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesExpenseTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_CANCELED_AMOUNT);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_GROSS_PRICE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_NET_PRICE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_PRICE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_TAX_AMOUNT);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_TAX_RATE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_UUID);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesExpenseTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_expense');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.canceled_amount');
            $criteria->addSelectColumn($alias . '.discount_amount_aggregation');
            $criteria->addSelectColumn($alias . '.gross_price');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.net_price');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.price_to_pay_aggregation');
            $criteria->addSelectColumn($alias . '.refundable_amount');
            $criteria->addSelectColumn($alias . '.tax_amount');
            $criteria->addSelectColumn($alias . '.tax_amount_after_cancellation');
            $criteria->addSelectColumn($alias . '.tax_rate');
            $criteria->addSelectColumn($alias . '.type');
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
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_CANCELED_AMOUNT);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_GROSS_PRICE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_NET_PRICE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_PRICE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_PRICE_TO_PAY_AGGREGATION);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_REFUNDABLE_AMOUNT);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_TAX_AMOUNT);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_TAX_AMOUNT_AFTER_CANCELLATION);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_TAX_RATE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesExpenseTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_expense');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.canceled_amount');
            $criteria->removeSelectColumn($alias . '.discount_amount_aggregation');
            $criteria->removeSelectColumn($alias . '.gross_price');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.net_price');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.price_to_pay_aggregation');
            $criteria->removeSelectColumn($alias . '.refundable_amount');
            $criteria->removeSelectColumn($alias . '.tax_amount');
            $criteria->removeSelectColumn($alias . '.tax_amount_after_cancellation');
            $criteria->removeSelectColumn($alias . '.tax_rate');
            $criteria->removeSelectColumn($alias . '.type');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesExpenseTableMap::DATABASE_NAME)->getTable(SpySalesExpenseTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesExpense or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesExpense object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesExpenseTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesExpense) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesExpenseTableMap::DATABASE_NAME);
            $criteria->add(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE, (array) $values, Criteria::IN);
        }

        $query = SpySalesExpenseQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesExpenseTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesExpenseTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_expense table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesExpenseQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesExpense or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesExpense object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesExpenseTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesExpense object
        }

        if ($criteria->containsKey(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE) && $criteria->keyContainsValue(SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesExpenseTableMap::COL_ID_SALES_EXPENSE.')');
        }


        // Set the correct dbName
        $query = SpySalesExpenseQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
