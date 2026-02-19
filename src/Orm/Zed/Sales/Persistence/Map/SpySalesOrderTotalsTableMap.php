<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesOrderTotals;
use Orm\Zed\Sales\Persistence\SpySalesOrderTotalsQuery;
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
 * This class defines the structure of the 'spy_sales_order_totals' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderTotalsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesOrderTotalsTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_totals';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderTotals';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderTotals';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesOrderTotals';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the id_sales_order_totals field
     */
    public const COL_ID_SALES_ORDER_TOTALS = 'spy_sales_order_totals.id_sales_order_totals';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_order_totals.fk_sales_order';

    /**
     * the column name for the canceled_total field
     */
    public const COL_CANCELED_TOTAL = 'spy_sales_order_totals.canceled_total';

    /**
     * the column name for the discount_total field
     */
    public const COL_DISCOUNT_TOTAL = 'spy_sales_order_totals.discount_total';

    /**
     * the column name for the grand_total field
     */
    public const COL_GRAND_TOTAL = 'spy_sales_order_totals.grand_total';

    /**
     * the column name for the merchant_commission_refunded_total field
     */
    public const COL_MERCHANT_COMMISSION_REFUNDED_TOTAL = 'spy_sales_order_totals.merchant_commission_refunded_total';

    /**
     * the column name for the merchant_commission_total field
     */
    public const COL_MERCHANT_COMMISSION_TOTAL = 'spy_sales_order_totals.merchant_commission_total';

    /**
     * the column name for the order_expense_total field
     */
    public const COL_ORDER_EXPENSE_TOTAL = 'spy_sales_order_totals.order_expense_total';

    /**
     * the column name for the refund_total field
     */
    public const COL_REFUND_TOTAL = 'spy_sales_order_totals.refund_total';

    /**
     * the column name for the subtotal field
     */
    public const COL_SUBTOTAL = 'spy_sales_order_totals.subtotal';

    /**
     * the column name for the tax_total field
     */
    public const COL_TAX_TOTAL = 'spy_sales_order_totals.tax_total';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_totals.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_totals.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderTotals', 'FkSalesOrder', 'CanceledTotal', 'DiscountTotal', 'GrandTotal', 'MerchantCommissionRefundedTotal', 'MerchantCommissionTotal', 'OrderExpenseTotal', 'RefundTotal', 'Subtotal', 'TaxTotal', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderTotals', 'fkSalesOrder', 'canceledTotal', 'discountTotal', 'grandTotal', 'merchantCommissionRefundedTotal', 'merchantCommissionTotal', 'orderExpenseTotal', 'refundTotal', 'subtotal', 'taxTotal', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS, SpySalesOrderTotalsTableMap::COL_FK_SALES_ORDER, SpySalesOrderTotalsTableMap::COL_CANCELED_TOTAL, SpySalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL, SpySalesOrderTotalsTableMap::COL_GRAND_TOTAL, SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL, SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL, SpySalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL, SpySalesOrderTotalsTableMap::COL_REFUND_TOTAL, SpySalesOrderTotalsTableMap::COL_SUBTOTAL, SpySalesOrderTotalsTableMap::COL_TAX_TOTAL, SpySalesOrderTotalsTableMap::COL_CREATED_AT, SpySalesOrderTotalsTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_totals', 'fk_sales_order', 'canceled_total', 'discount_total', 'grand_total', 'merchant_commission_refunded_total', 'merchant_commission_total', 'order_expense_total', 'refund_total', 'subtotal', 'tax_total', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['IdSalesOrderTotals' => 0, 'FkSalesOrder' => 1, 'CanceledTotal' => 2, 'DiscountTotal' => 3, 'GrandTotal' => 4, 'MerchantCommissionRefundedTotal' => 5, 'MerchantCommissionTotal' => 6, 'OrderExpenseTotal' => 7, 'RefundTotal' => 8, 'Subtotal' => 9, 'TaxTotal' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderTotals' => 0, 'fkSalesOrder' => 1, 'canceledTotal' => 2, 'discountTotal' => 3, 'grandTotal' => 4, 'merchantCommissionRefundedTotal' => 5, 'merchantCommissionTotal' => 6, 'orderExpenseTotal' => 7, 'refundTotal' => 8, 'subtotal' => 9, 'taxTotal' => 10, 'createdAt' => 11, 'updatedAt' => 12, ],
        self::TYPE_COLNAME       => [SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS => 0, SpySalesOrderTotalsTableMap::COL_FK_SALES_ORDER => 1, SpySalesOrderTotalsTableMap::COL_CANCELED_TOTAL => 2, SpySalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL => 3, SpySalesOrderTotalsTableMap::COL_GRAND_TOTAL => 4, SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL => 5, SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL => 6, SpySalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL => 7, SpySalesOrderTotalsTableMap::COL_REFUND_TOTAL => 8, SpySalesOrderTotalsTableMap::COL_SUBTOTAL => 9, SpySalesOrderTotalsTableMap::COL_TAX_TOTAL => 10, SpySalesOrderTotalsTableMap::COL_CREATED_AT => 11, SpySalesOrderTotalsTableMap::COL_UPDATED_AT => 12, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_totals' => 0, 'fk_sales_order' => 1, 'canceled_total' => 2, 'discount_total' => 3, 'grand_total' => 4, 'merchant_commission_refunded_total' => 5, 'merchant_commission_total' => 6, 'order_expense_total' => 7, 'refund_total' => 8, 'subtotal' => 9, 'tax_total' => 10, 'created_at' => 11, 'updated_at' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderTotals' => 'ID_SALES_ORDER_TOTALS',
        'SpySalesOrderTotals.IdSalesOrderTotals' => 'ID_SALES_ORDER_TOTALS',
        'idSalesOrderTotals' => 'ID_SALES_ORDER_TOTALS',
        'spySalesOrderTotals.idSalesOrderTotals' => 'ID_SALES_ORDER_TOTALS',
        'SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS' => 'ID_SALES_ORDER_TOTALS',
        'COL_ID_SALES_ORDER_TOTALS' => 'ID_SALES_ORDER_TOTALS',
        'id_sales_order_totals' => 'ID_SALES_ORDER_TOTALS',
        'spy_sales_order_totals.id_sales_order_totals' => 'ID_SALES_ORDER_TOTALS',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesOrderTotals.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesOrderTotals.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesOrderTotalsTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_order_totals.fk_sales_order' => 'FK_SALES_ORDER',
        'CanceledTotal' => 'CANCELED_TOTAL',
        'SpySalesOrderTotals.CanceledTotal' => 'CANCELED_TOTAL',
        'canceledTotal' => 'CANCELED_TOTAL',
        'spySalesOrderTotals.canceledTotal' => 'CANCELED_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_CANCELED_TOTAL' => 'CANCELED_TOTAL',
        'COL_CANCELED_TOTAL' => 'CANCELED_TOTAL',
        'canceled_total' => 'CANCELED_TOTAL',
        'spy_sales_order_totals.canceled_total' => 'CANCELED_TOTAL',
        'DiscountTotal' => 'DISCOUNT_TOTAL',
        'SpySalesOrderTotals.DiscountTotal' => 'DISCOUNT_TOTAL',
        'discountTotal' => 'DISCOUNT_TOTAL',
        'spySalesOrderTotals.discountTotal' => 'DISCOUNT_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL' => 'DISCOUNT_TOTAL',
        'COL_DISCOUNT_TOTAL' => 'DISCOUNT_TOTAL',
        'discount_total' => 'DISCOUNT_TOTAL',
        'spy_sales_order_totals.discount_total' => 'DISCOUNT_TOTAL',
        'GrandTotal' => 'GRAND_TOTAL',
        'SpySalesOrderTotals.GrandTotal' => 'GRAND_TOTAL',
        'grandTotal' => 'GRAND_TOTAL',
        'spySalesOrderTotals.grandTotal' => 'GRAND_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_GRAND_TOTAL' => 'GRAND_TOTAL',
        'COL_GRAND_TOTAL' => 'GRAND_TOTAL',
        'grand_total' => 'GRAND_TOTAL',
        'spy_sales_order_totals.grand_total' => 'GRAND_TOTAL',
        'MerchantCommissionRefundedTotal' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'SpySalesOrderTotals.MerchantCommissionRefundedTotal' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'merchantCommissionRefundedTotal' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'spySalesOrderTotals.merchantCommissionRefundedTotal' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'COL_MERCHANT_COMMISSION_REFUNDED_TOTAL' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'merchant_commission_refunded_total' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'spy_sales_order_totals.merchant_commission_refunded_total' => 'MERCHANT_COMMISSION_REFUNDED_TOTAL',
        'MerchantCommissionTotal' => 'MERCHANT_COMMISSION_TOTAL',
        'SpySalesOrderTotals.MerchantCommissionTotal' => 'MERCHANT_COMMISSION_TOTAL',
        'merchantCommissionTotal' => 'MERCHANT_COMMISSION_TOTAL',
        'spySalesOrderTotals.merchantCommissionTotal' => 'MERCHANT_COMMISSION_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL' => 'MERCHANT_COMMISSION_TOTAL',
        'COL_MERCHANT_COMMISSION_TOTAL' => 'MERCHANT_COMMISSION_TOTAL',
        'merchant_commission_total' => 'MERCHANT_COMMISSION_TOTAL',
        'spy_sales_order_totals.merchant_commission_total' => 'MERCHANT_COMMISSION_TOTAL',
        'OrderExpenseTotal' => 'ORDER_EXPENSE_TOTAL',
        'SpySalesOrderTotals.OrderExpenseTotal' => 'ORDER_EXPENSE_TOTAL',
        'orderExpenseTotal' => 'ORDER_EXPENSE_TOTAL',
        'spySalesOrderTotals.orderExpenseTotal' => 'ORDER_EXPENSE_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL' => 'ORDER_EXPENSE_TOTAL',
        'COL_ORDER_EXPENSE_TOTAL' => 'ORDER_EXPENSE_TOTAL',
        'order_expense_total' => 'ORDER_EXPENSE_TOTAL',
        'spy_sales_order_totals.order_expense_total' => 'ORDER_EXPENSE_TOTAL',
        'RefundTotal' => 'REFUND_TOTAL',
        'SpySalesOrderTotals.RefundTotal' => 'REFUND_TOTAL',
        'refundTotal' => 'REFUND_TOTAL',
        'spySalesOrderTotals.refundTotal' => 'REFUND_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_REFUND_TOTAL' => 'REFUND_TOTAL',
        'COL_REFUND_TOTAL' => 'REFUND_TOTAL',
        'refund_total' => 'REFUND_TOTAL',
        'spy_sales_order_totals.refund_total' => 'REFUND_TOTAL',
        'Subtotal' => 'SUBTOTAL',
        'SpySalesOrderTotals.Subtotal' => 'SUBTOTAL',
        'subtotal' => 'SUBTOTAL',
        'spySalesOrderTotals.subtotal' => 'SUBTOTAL',
        'SpySalesOrderTotalsTableMap::COL_SUBTOTAL' => 'SUBTOTAL',
        'COL_SUBTOTAL' => 'SUBTOTAL',
        'spy_sales_order_totals.subtotal' => 'SUBTOTAL',
        'TaxTotal' => 'TAX_TOTAL',
        'SpySalesOrderTotals.TaxTotal' => 'TAX_TOTAL',
        'taxTotal' => 'TAX_TOTAL',
        'spySalesOrderTotals.taxTotal' => 'TAX_TOTAL',
        'SpySalesOrderTotalsTableMap::COL_TAX_TOTAL' => 'TAX_TOTAL',
        'COL_TAX_TOTAL' => 'TAX_TOTAL',
        'tax_total' => 'TAX_TOTAL',
        'spy_sales_order_totals.tax_total' => 'TAX_TOTAL',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderTotals.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderTotals.createdAt' => 'CREATED_AT',
        'SpySalesOrderTotalsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_totals.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderTotals.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderTotals.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderTotalsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_totals.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_totals');
        $this->setPhpName('SpySalesOrderTotals');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderTotals');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_totals_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_totals', 'IdSalesOrderTotals', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, 0);
        $this->addColumn('canceled_total', 'CanceledTotal', 'INTEGER', false, null, 0);
        $this->addColumn('discount_total', 'DiscountTotal', 'INTEGER', false, null, 0);
        $this->addColumn('grand_total', 'GrandTotal', 'INTEGER', false, null, 0);
        $this->addColumn('merchant_commission_refunded_total', 'MerchantCommissionRefundedTotal', 'INTEGER', false, null, null);
        $this->addColumn('merchant_commission_total', 'MerchantCommissionTotal', 'INTEGER', false, null, null);
        $this->addColumn('order_expense_total', 'OrderExpenseTotal', 'INTEGER', false, null, 0);
        $this->addColumn('refund_total', 'RefundTotal', 'INTEGER', false, null, 0);
        $this->addColumn('subtotal', 'Subtotal', 'INTEGER', false, null, 0);
        $this->addColumn('tax_total', 'TaxTotal', 'INTEGER', false, null, 0);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderTotals', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderTotalsTableMap::CLASS_DEFAULT : SpySalesOrderTotalsTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderTotals object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderTotalsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderTotalsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderTotalsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderTotalsTableMap::OM_CLASS;
            /** @var SpySalesOrderTotals $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderTotalsTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderTotalsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderTotalsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderTotals $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderTotalsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_CANCELED_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_GRAND_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_REFUND_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_SUBTOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_TAX_TOTAL);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderTotalsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_totals');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.canceled_total');
            $criteria->addSelectColumn($alias . '.discount_total');
            $criteria->addSelectColumn($alias . '.grand_total');
            $criteria->addSelectColumn($alias . '.merchant_commission_refunded_total');
            $criteria->addSelectColumn($alias . '.merchant_commission_total');
            $criteria->addSelectColumn($alias . '.order_expense_total');
            $criteria->addSelectColumn($alias . '.refund_total');
            $criteria->addSelectColumn($alias . '.subtotal');
            $criteria->addSelectColumn($alias . '.tax_total');
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
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_CANCELED_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_DISCOUNT_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_GRAND_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_REFUNDED_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_MERCHANT_COMMISSION_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_ORDER_EXPENSE_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_REFUND_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_SUBTOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_TAX_TOTAL);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderTotalsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_totals');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.canceled_total');
            $criteria->removeSelectColumn($alias . '.discount_total');
            $criteria->removeSelectColumn($alias . '.grand_total');
            $criteria->removeSelectColumn($alias . '.merchant_commission_refunded_total');
            $criteria->removeSelectColumn($alias . '.merchant_commission_total');
            $criteria->removeSelectColumn($alias . '.order_expense_total');
            $criteria->removeSelectColumn($alias . '.refund_total');
            $criteria->removeSelectColumn($alias . '.subtotal');
            $criteria->removeSelectColumn($alias . '.tax_total');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderTotalsTableMap::DATABASE_NAME)->getTable(SpySalesOrderTotalsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderTotals or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderTotals object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderTotalsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderTotals) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderTotalsTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderTotalsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderTotalsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderTotalsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_totals table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderTotalsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderTotals or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderTotals object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderTotalsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderTotals object
        }

        if ($criteria->containsKey(SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS) && $criteria->keyContainsValue(SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderTotalsTableMap::COL_ID_SALES_ORDER_TOTALS.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderTotalsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
