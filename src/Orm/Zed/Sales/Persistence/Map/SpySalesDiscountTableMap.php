<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesDiscount;
use Orm\Zed\Sales\Persistence\SpySalesDiscountQuery;
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
 * This class defines the structure of the 'spy_sales_discount' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesDiscountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesDiscountTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_discount';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesDiscount';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscount';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesDiscount';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id_sales_discount field
     */
    public const COL_ID_SALES_DISCOUNT = 'spy_sales_discount.id_sales_discount';

    /**
     * the column name for the fk_sales_expense field
     */
    public const COL_FK_SALES_EXPENSE = 'spy_sales_discount.fk_sales_expense';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_discount.fk_sales_order';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_discount.fk_sales_order_item';

    /**
     * the column name for the fk_sales_order_item_option field
     */
    public const COL_FK_SALES_ORDER_ITEM_OPTION = 'spy_sales_discount.fk_sales_order_item_option';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'spy_sales_discount.amount';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_sales_discount.description';

    /**
     * the column name for the display_name field
     */
    public const COL_DISPLAY_NAME = 'spy_sales_discount.display_name';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_discount.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_discount.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_discount.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesDiscount', 'FkSalesExpense', 'FkSalesOrder', 'FkSalesOrderItem', 'FkSalesOrderItemOption', 'Amount', 'Description', 'DisplayName', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesDiscount', 'fkSalesExpense', 'fkSalesOrder', 'fkSalesOrderItem', 'fkSalesOrderItemOption', 'amount', 'description', 'displayName', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT, SpySalesDiscountTableMap::COL_FK_SALES_EXPENSE, SpySalesDiscountTableMap::COL_FK_SALES_ORDER, SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM_OPTION, SpySalesDiscountTableMap::COL_AMOUNT, SpySalesDiscountTableMap::COL_DESCRIPTION, SpySalesDiscountTableMap::COL_DISPLAY_NAME, SpySalesDiscountTableMap::COL_NAME, SpySalesDiscountTableMap::COL_CREATED_AT, SpySalesDiscountTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_discount', 'fk_sales_expense', 'fk_sales_order', 'fk_sales_order_item', 'fk_sales_order_item_option', 'amount', 'description', 'display_name', 'name', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['IdSalesDiscount' => 0, 'FkSalesExpense' => 1, 'FkSalesOrder' => 2, 'FkSalesOrderItem' => 3, 'FkSalesOrderItemOption' => 4, 'Amount' => 5, 'Description' => 6, 'DisplayName' => 7, 'Name' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idSalesDiscount' => 0, 'fkSalesExpense' => 1, 'fkSalesOrder' => 2, 'fkSalesOrderItem' => 3, 'fkSalesOrderItemOption' => 4, 'amount' => 5, 'description' => 6, 'displayName' => 7, 'name' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT => 0, SpySalesDiscountTableMap::COL_FK_SALES_EXPENSE => 1, SpySalesDiscountTableMap::COL_FK_SALES_ORDER => 2, SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM => 3, SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM_OPTION => 4, SpySalesDiscountTableMap::COL_AMOUNT => 5, SpySalesDiscountTableMap::COL_DESCRIPTION => 6, SpySalesDiscountTableMap::COL_DISPLAY_NAME => 7, SpySalesDiscountTableMap::COL_NAME => 8, SpySalesDiscountTableMap::COL_CREATED_AT => 9, SpySalesDiscountTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_sales_discount' => 0, 'fk_sales_expense' => 1, 'fk_sales_order' => 2, 'fk_sales_order_item' => 3, 'fk_sales_order_item_option' => 4, 'amount' => 5, 'description' => 6, 'display_name' => 7, 'name' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesDiscount' => 'ID_SALES_DISCOUNT',
        'SpySalesDiscount.IdSalesDiscount' => 'ID_SALES_DISCOUNT',
        'idSalesDiscount' => 'ID_SALES_DISCOUNT',
        'spySalesDiscount.idSalesDiscount' => 'ID_SALES_DISCOUNT',
        'SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT' => 'ID_SALES_DISCOUNT',
        'COL_ID_SALES_DISCOUNT' => 'ID_SALES_DISCOUNT',
        'id_sales_discount' => 'ID_SALES_DISCOUNT',
        'spy_sales_discount.id_sales_discount' => 'ID_SALES_DISCOUNT',
        'FkSalesExpense' => 'FK_SALES_EXPENSE',
        'SpySalesDiscount.FkSalesExpense' => 'FK_SALES_EXPENSE',
        'fkSalesExpense' => 'FK_SALES_EXPENSE',
        'spySalesDiscount.fkSalesExpense' => 'FK_SALES_EXPENSE',
        'SpySalesDiscountTableMap::COL_FK_SALES_EXPENSE' => 'FK_SALES_EXPENSE',
        'COL_FK_SALES_EXPENSE' => 'FK_SALES_EXPENSE',
        'fk_sales_expense' => 'FK_SALES_EXPENSE',
        'spy_sales_discount.fk_sales_expense' => 'FK_SALES_EXPENSE',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesDiscount.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesDiscount.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesDiscountTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_discount.fk_sales_order' => 'FK_SALES_ORDER',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesDiscount.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesDiscount.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_discount.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'FkSalesOrderItemOption' => 'FK_SALES_ORDER_ITEM_OPTION',
        'SpySalesDiscount.FkSalesOrderItemOption' => 'FK_SALES_ORDER_ITEM_OPTION',
        'fkSalesOrderItemOption' => 'FK_SALES_ORDER_ITEM_OPTION',
        'spySalesDiscount.fkSalesOrderItemOption' => 'FK_SALES_ORDER_ITEM_OPTION',
        'SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM_OPTION' => 'FK_SALES_ORDER_ITEM_OPTION',
        'COL_FK_SALES_ORDER_ITEM_OPTION' => 'FK_SALES_ORDER_ITEM_OPTION',
        'fk_sales_order_item_option' => 'FK_SALES_ORDER_ITEM_OPTION',
        'spy_sales_discount.fk_sales_order_item_option' => 'FK_SALES_ORDER_ITEM_OPTION',
        'Amount' => 'AMOUNT',
        'SpySalesDiscount.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'spySalesDiscount.amount' => 'AMOUNT',
        'SpySalesDiscountTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'spy_sales_discount.amount' => 'AMOUNT',
        'Description' => 'DESCRIPTION',
        'SpySalesDiscount.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spySalesDiscount.description' => 'DESCRIPTION',
        'SpySalesDiscountTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_sales_discount.description' => 'DESCRIPTION',
        'DisplayName' => 'DISPLAY_NAME',
        'SpySalesDiscount.DisplayName' => 'DISPLAY_NAME',
        'displayName' => 'DISPLAY_NAME',
        'spySalesDiscount.displayName' => 'DISPLAY_NAME',
        'SpySalesDiscountTableMap::COL_DISPLAY_NAME' => 'DISPLAY_NAME',
        'COL_DISPLAY_NAME' => 'DISPLAY_NAME',
        'display_name' => 'DISPLAY_NAME',
        'spy_sales_discount.display_name' => 'DISPLAY_NAME',
        'Name' => 'NAME',
        'SpySalesDiscount.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesDiscount.name' => 'NAME',
        'SpySalesDiscountTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_discount.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesDiscount.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesDiscount.createdAt' => 'CREATED_AT',
        'SpySalesDiscountTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_discount.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesDiscount.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesDiscount.updatedAt' => 'UPDATED_AT',
        'SpySalesDiscountTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_discount.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_discount');
        $this->setPhpName('SpySalesDiscount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscount');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_discount_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_discount', 'IdSalesDiscount', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_expense', 'FkSalesExpense', 'INTEGER', 'spy_sales_expense', 'id_sales_expense', false, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', false, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', false, null, null);
        $this->addForeignKey('fk_sales_order_item_option', 'FkSalesOrderItemOption', 'INTEGER', 'spy_sales_order_item_option', 'id_sales_order_item_option', false, null, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 1024, null);
        $this->addColumn('display_name', 'DisplayName', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('OrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
  ),
), null, null, null, false);
        $this->addRelation('Expense', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesExpense', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_expense',
    1 => ':id_sales_expense',
  ),
), null, null, null, false);
        $this->addRelation('Option', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItemOption', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item_option',
    1 => ':id_sales_order_item_option',
  ),
), null, null, null, false);
        $this->addRelation('DiscountCode', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscountCode', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_discount',
    1 => ':id_sales_discount',
  ),
), null, null, 'DiscountCodes', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesDiscount', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesDiscountTableMap::CLASS_DEFAULT : SpySalesDiscountTableMap::OM_CLASS;
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
     * @return array (SpySalesDiscount object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesDiscountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesDiscountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesDiscountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesDiscountTableMap::OM_CLASS;
            /** @var SpySalesDiscount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesDiscountTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesDiscountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesDiscountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesDiscount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesDiscountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_EXPENSE);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM_OPTION);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_DISPLAY_NAME);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesDiscountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_discount');
            $criteria->addSelectColumn($alias . '.fk_sales_expense');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item_option');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.display_name');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_EXPENSE);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_FK_SALES_ORDER_ITEM_OPTION);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_DISPLAY_NAME);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesDiscountTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_discount');
            $criteria->removeSelectColumn($alias . '.fk_sales_expense');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item_option');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.display_name');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesDiscountTableMap::DATABASE_NAME)->getTable(SpySalesDiscountTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesDiscount or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesDiscount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesDiscountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesDiscount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesDiscountTableMap::DATABASE_NAME);
            $criteria->add(SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT, (array) $values, Criteria::IN);
        }

        $query = SpySalesDiscountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesDiscountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesDiscountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_discount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesDiscountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesDiscount or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesDiscount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesDiscountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesDiscount object
        }

        if ($criteria->containsKey(SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT) && $criteria->keyContainsValue(SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesDiscountTableMap::COL_ID_SALES_DISCOUNT.')');
        }


        // Set the correct dbName
        $query = SpySalesDiscountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
