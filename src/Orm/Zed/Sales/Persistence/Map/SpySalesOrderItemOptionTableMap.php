<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesOrderItemOption;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemOptionQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_option' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemOptionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesOrderItemOptionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_option';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemOption';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItemOption';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesOrderItemOption';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id_sales_order_item_option field
     */
    public const COL_ID_SALES_ORDER_ITEM_OPTION = 'spy_sales_order_item_option.id_sales_order_item_option';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_item_option.fk_sales_order_item';

    /**
     * the column name for the canceled_amount field
     */
    public const COL_CANCELED_AMOUNT = 'spy_sales_order_item_option.canceled_amount';

    /**
     * the column name for the discount_amount_aggregation field
     */
    public const COL_DISCOUNT_AMOUNT_AGGREGATION = 'spy_sales_order_item_option.discount_amount_aggregation';

    /**
     * the column name for the gross_price field
     */
    public const COL_GROSS_PRICE = 'spy_sales_order_item_option.gross_price';

    /**
     * the column name for the group_name field
     */
    public const COL_GROUP_NAME = 'spy_sales_order_item_option.group_name';

    /**
     * the column name for the net_price field
     */
    public const COL_NET_PRICE = 'spy_sales_order_item_option.net_price';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'spy_sales_order_item_option.price';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_sales_order_item_option.sku';

    /**
     * the column name for the tax_amount field
     */
    public const COL_TAX_AMOUNT = 'spy_sales_order_item_option.tax_amount';

    /**
     * the column name for the tax_rate field
     */
    public const COL_TAX_RATE = 'spy_sales_order_item_option.tax_rate';

    /**
     * the column name for the value field
     */
    public const COL_VALUE = 'spy_sales_order_item_option.value';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_item_option.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_item_option.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemOption', 'FkSalesOrderItem', 'CanceledAmount', 'DiscountAmountAggregation', 'GrossPrice', 'GroupName', 'NetPrice', 'Price', 'Sku', 'TaxAmount', 'TaxRate', 'Value', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemOption', 'fkSalesOrderItem', 'canceledAmount', 'discountAmountAggregation', 'grossPrice', 'groupName', 'netPrice', 'price', 'sku', 'taxAmount', 'taxRate', 'value', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION, SpySalesOrderItemOptionTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderItemOptionTableMap::COL_CANCELED_AMOUNT, SpySalesOrderItemOptionTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION, SpySalesOrderItemOptionTableMap::COL_GROSS_PRICE, SpySalesOrderItemOptionTableMap::COL_GROUP_NAME, SpySalesOrderItemOptionTableMap::COL_NET_PRICE, SpySalesOrderItemOptionTableMap::COL_PRICE, SpySalesOrderItemOptionTableMap::COL_SKU, SpySalesOrderItemOptionTableMap::COL_TAX_AMOUNT, SpySalesOrderItemOptionTableMap::COL_TAX_RATE, SpySalesOrderItemOptionTableMap::COL_VALUE, SpySalesOrderItemOptionTableMap::COL_CREATED_AT, SpySalesOrderItemOptionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_option', 'fk_sales_order_item', 'canceled_amount', 'discount_amount_aggregation', 'gross_price', 'group_name', 'net_price', 'price', 'sku', 'tax_amount', 'tax_rate', 'value', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemOption' => 0, 'FkSalesOrderItem' => 1, 'CanceledAmount' => 2, 'DiscountAmountAggregation' => 3, 'GrossPrice' => 4, 'GroupName' => 5, 'NetPrice' => 6, 'Price' => 7, 'Sku' => 8, 'TaxAmount' => 9, 'TaxRate' => 10, 'Value' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemOption' => 0, 'fkSalesOrderItem' => 1, 'canceledAmount' => 2, 'discountAmountAggregation' => 3, 'grossPrice' => 4, 'groupName' => 5, 'netPrice' => 6, 'price' => 7, 'sku' => 8, 'taxAmount' => 9, 'taxRate' => 10, 'value' => 11, 'createdAt' => 12, 'updatedAt' => 13, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION => 0, SpySalesOrderItemOptionTableMap::COL_FK_SALES_ORDER_ITEM => 1, SpySalesOrderItemOptionTableMap::COL_CANCELED_AMOUNT => 2, SpySalesOrderItemOptionTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION => 3, SpySalesOrderItemOptionTableMap::COL_GROSS_PRICE => 4, SpySalesOrderItemOptionTableMap::COL_GROUP_NAME => 5, SpySalesOrderItemOptionTableMap::COL_NET_PRICE => 6, SpySalesOrderItemOptionTableMap::COL_PRICE => 7, SpySalesOrderItemOptionTableMap::COL_SKU => 8, SpySalesOrderItemOptionTableMap::COL_TAX_AMOUNT => 9, SpySalesOrderItemOptionTableMap::COL_TAX_RATE => 10, SpySalesOrderItemOptionTableMap::COL_VALUE => 11, SpySalesOrderItemOptionTableMap::COL_CREATED_AT => 12, SpySalesOrderItemOptionTableMap::COL_UPDATED_AT => 13, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_option' => 0, 'fk_sales_order_item' => 1, 'canceled_amount' => 2, 'discount_amount_aggregation' => 3, 'gross_price' => 4, 'group_name' => 5, 'net_price' => 6, 'price' => 7, 'sku' => 8, 'tax_amount' => 9, 'tax_rate' => 10, 'value' => 11, 'created_at' => 12, 'updated_at' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderItemOption' => 'ID_SALES_ORDER_ITEM_OPTION',
        'SpySalesOrderItemOption.IdSalesOrderItemOption' => 'ID_SALES_ORDER_ITEM_OPTION',
        'idSalesOrderItemOption' => 'ID_SALES_ORDER_ITEM_OPTION',
        'spySalesOrderItemOption.idSalesOrderItemOption' => 'ID_SALES_ORDER_ITEM_OPTION',
        'SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION' => 'ID_SALES_ORDER_ITEM_OPTION',
        'COL_ID_SALES_ORDER_ITEM_OPTION' => 'ID_SALES_ORDER_ITEM_OPTION',
        'id_sales_order_item_option' => 'ID_SALES_ORDER_ITEM_OPTION',
        'spy_sales_order_item_option.id_sales_order_item_option' => 'ID_SALES_ORDER_ITEM_OPTION',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemOption.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderItemOption.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemOptionTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_item_option.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'CanceledAmount' => 'CANCELED_AMOUNT',
        'SpySalesOrderItemOption.CanceledAmount' => 'CANCELED_AMOUNT',
        'canceledAmount' => 'CANCELED_AMOUNT',
        'spySalesOrderItemOption.canceledAmount' => 'CANCELED_AMOUNT',
        'SpySalesOrderItemOptionTableMap::COL_CANCELED_AMOUNT' => 'CANCELED_AMOUNT',
        'COL_CANCELED_AMOUNT' => 'CANCELED_AMOUNT',
        'canceled_amount' => 'CANCELED_AMOUNT',
        'spy_sales_order_item_option.canceled_amount' => 'CANCELED_AMOUNT',
        'DiscountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'SpySalesOrderItemOption.DiscountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'discountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'spySalesOrderItemOption.discountAmountAggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'SpySalesOrderItemOptionTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'COL_DISCOUNT_AMOUNT_AGGREGATION' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'discount_amount_aggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'spy_sales_order_item_option.discount_amount_aggregation' => 'DISCOUNT_AMOUNT_AGGREGATION',
        'GrossPrice' => 'GROSS_PRICE',
        'SpySalesOrderItemOption.GrossPrice' => 'GROSS_PRICE',
        'grossPrice' => 'GROSS_PRICE',
        'spySalesOrderItemOption.grossPrice' => 'GROSS_PRICE',
        'SpySalesOrderItemOptionTableMap::COL_GROSS_PRICE' => 'GROSS_PRICE',
        'COL_GROSS_PRICE' => 'GROSS_PRICE',
        'gross_price' => 'GROSS_PRICE',
        'spy_sales_order_item_option.gross_price' => 'GROSS_PRICE',
        'GroupName' => 'GROUP_NAME',
        'SpySalesOrderItemOption.GroupName' => 'GROUP_NAME',
        'groupName' => 'GROUP_NAME',
        'spySalesOrderItemOption.groupName' => 'GROUP_NAME',
        'SpySalesOrderItemOptionTableMap::COL_GROUP_NAME' => 'GROUP_NAME',
        'COL_GROUP_NAME' => 'GROUP_NAME',
        'group_name' => 'GROUP_NAME',
        'spy_sales_order_item_option.group_name' => 'GROUP_NAME',
        'NetPrice' => 'NET_PRICE',
        'SpySalesOrderItemOption.NetPrice' => 'NET_PRICE',
        'netPrice' => 'NET_PRICE',
        'spySalesOrderItemOption.netPrice' => 'NET_PRICE',
        'SpySalesOrderItemOptionTableMap::COL_NET_PRICE' => 'NET_PRICE',
        'COL_NET_PRICE' => 'NET_PRICE',
        'net_price' => 'NET_PRICE',
        'spy_sales_order_item_option.net_price' => 'NET_PRICE',
        'Price' => 'PRICE',
        'SpySalesOrderItemOption.Price' => 'PRICE',
        'price' => 'PRICE',
        'spySalesOrderItemOption.price' => 'PRICE',
        'SpySalesOrderItemOptionTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'spy_sales_order_item_option.price' => 'PRICE',
        'Sku' => 'SKU',
        'SpySalesOrderItemOption.Sku' => 'SKU',
        'sku' => 'SKU',
        'spySalesOrderItemOption.sku' => 'SKU',
        'SpySalesOrderItemOptionTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_sales_order_item_option.sku' => 'SKU',
        'TaxAmount' => 'TAX_AMOUNT',
        'SpySalesOrderItemOption.TaxAmount' => 'TAX_AMOUNT',
        'taxAmount' => 'TAX_AMOUNT',
        'spySalesOrderItemOption.taxAmount' => 'TAX_AMOUNT',
        'SpySalesOrderItemOptionTableMap::COL_TAX_AMOUNT' => 'TAX_AMOUNT',
        'COL_TAX_AMOUNT' => 'TAX_AMOUNT',
        'tax_amount' => 'TAX_AMOUNT',
        'spy_sales_order_item_option.tax_amount' => 'TAX_AMOUNT',
        'TaxRate' => 'TAX_RATE',
        'SpySalesOrderItemOption.TaxRate' => 'TAX_RATE',
        'taxRate' => 'TAX_RATE',
        'spySalesOrderItemOption.taxRate' => 'TAX_RATE',
        'SpySalesOrderItemOptionTableMap::COL_TAX_RATE' => 'TAX_RATE',
        'COL_TAX_RATE' => 'TAX_RATE',
        'tax_rate' => 'TAX_RATE',
        'spy_sales_order_item_option.tax_rate' => 'TAX_RATE',
        'Value' => 'VALUE',
        'SpySalesOrderItemOption.Value' => 'VALUE',
        'value' => 'VALUE',
        'spySalesOrderItemOption.value' => 'VALUE',
        'SpySalesOrderItemOptionTableMap::COL_VALUE' => 'VALUE',
        'COL_VALUE' => 'VALUE',
        'spy_sales_order_item_option.value' => 'VALUE',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderItemOption.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderItemOption.createdAt' => 'CREATED_AT',
        'SpySalesOrderItemOptionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_item_option.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemOption.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderItemOption.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemOptionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_item_option.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_item_option');
        $this->setPhpName('SpySalesOrderItemOption');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItemOption');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_item_option_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_item_option', 'IdSalesOrderItemOption', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('canceled_amount', 'CanceledAmount', 'INTEGER', false, null, 0);
        $this->addColumn('discount_amount_aggregation', 'DiscountAmountAggregation', 'INTEGER', false, null, 0);
        $this->addColumn('gross_price', 'GrossPrice', 'INTEGER', true, null, 0);
        $this->addColumn('group_name', 'GroupName', 'VARCHAR', true, 255, null);
        $this->addColumn('net_price', 'NetPrice', 'INTEGER', false, null, 0);
        $this->addColumn('price', 'Price', 'INTEGER', false, null, 0);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
        $this->addColumn('tax_amount', 'TaxAmount', 'INTEGER', false, null, 0);
        $this->addColumn('tax_rate', 'TaxRate', 'DECIMAL', true, 8, null);
        $this->addColumn('value', 'Value', 'VARCHAR', true, 255, null);
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
        $this->addRelation('OrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
  ),
), null, null, null, false);
        $this->addRelation('Discount', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_order_item_option',
    1 => ':id_sales_order_item_option',
  ),
), null, null, 'Discounts', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderItemOption', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderItemOptionTableMap::CLASS_DEFAULT : SpySalesOrderItemOptionTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemOption object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemOptionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemOptionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemOptionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemOptionTableMap::OM_CLASS;
            /** @var SpySalesOrderItemOption $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemOptionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemOptionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemOptionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemOption $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemOptionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_CANCELED_AMOUNT);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_GROSS_PRICE);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_GROUP_NAME);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_NET_PRICE);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_PRICE);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_SKU);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_TAX_AMOUNT);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_TAX_RATE);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_VALUE);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemOptionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_item_option');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.canceled_amount');
            $criteria->addSelectColumn($alias . '.discount_amount_aggregation');
            $criteria->addSelectColumn($alias . '.gross_price');
            $criteria->addSelectColumn($alias . '.group_name');
            $criteria->addSelectColumn($alias . '.net_price');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.sku');
            $criteria->addSelectColumn($alias . '.tax_amount');
            $criteria->addSelectColumn($alias . '.tax_rate');
            $criteria->addSelectColumn($alias . '.value');
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
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_CANCELED_AMOUNT);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_DISCOUNT_AMOUNT_AGGREGATION);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_GROSS_PRICE);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_GROUP_NAME);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_NET_PRICE);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_PRICE);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_TAX_AMOUNT);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_TAX_RATE);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_VALUE);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemOptionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_item_option');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.canceled_amount');
            $criteria->removeSelectColumn($alias . '.discount_amount_aggregation');
            $criteria->removeSelectColumn($alias . '.gross_price');
            $criteria->removeSelectColumn($alias . '.group_name');
            $criteria->removeSelectColumn($alias . '.net_price');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.sku');
            $criteria->removeSelectColumn($alias . '.tax_amount');
            $criteria->removeSelectColumn($alias . '.tax_rate');
            $criteria->removeSelectColumn($alias . '.value');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemOptionTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemOptionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemOption or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemOption object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemOptionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemOptionTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderItemOptionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemOptionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemOptionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_option table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemOptionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemOption or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemOption object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemOptionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemOption object
        }

        if ($criteria->containsKey(SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION) && $criteria->keyContainsValue(SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderItemOptionTableMap::COL_ID_SALES_ORDER_ITEM_OPTION.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderItemOptionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
