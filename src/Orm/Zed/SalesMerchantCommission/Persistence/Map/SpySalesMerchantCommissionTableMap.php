<?php

namespace Orm\Zed\SalesMerchantCommission\Persistence\Map;

use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission;
use Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommissionQuery;
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
 * This class defines the structure of the 'spy_sales_merchant_commission' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesMerchantCommissionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesMerchantCommission.Persistence.Map.SpySalesMerchantCommissionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_merchant_commission';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesMerchantCommission';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesMerchantCommission\\Persistence\\SpySalesMerchantCommission';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesMerchantCommission.Persistence.SpySalesMerchantCommission';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_sales_merchant_commission field
     */
    public const COL_ID_SALES_MERCHANT_COMMISSION = 'spy_sales_merchant_commission.id_sales_merchant_commission';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_sales_merchant_commission.uuid';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_merchant_commission.fk_sales_order';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_merchant_commission.fk_sales_order_item';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_merchant_commission.name';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'spy_sales_merchant_commission.amount';

    /**
     * the column name for the refunded_amount field
     */
    public const COL_REFUNDED_AMOUNT = 'spy_sales_merchant_commission.refunded_amount';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_merchant_commission.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_merchant_commission.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesMerchantCommission', 'Uuid', 'FkSalesOrder', 'FkSalesOrderItem', 'Name', 'Amount', 'RefundedAmount', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesMerchantCommission', 'uuid', 'fkSalesOrder', 'fkSalesOrderItem', 'name', 'amount', 'refundedAmount', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION, SpySalesMerchantCommissionTableMap::COL_UUID, SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER, SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesMerchantCommissionTableMap::COL_NAME, SpySalesMerchantCommissionTableMap::COL_AMOUNT, SpySalesMerchantCommissionTableMap::COL_REFUNDED_AMOUNT, SpySalesMerchantCommissionTableMap::COL_CREATED_AT, SpySalesMerchantCommissionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_merchant_commission', 'uuid', 'fk_sales_order', 'fk_sales_order_item', 'name', 'amount', 'refunded_amount', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['IdSalesMerchantCommission' => 0, 'Uuid' => 1, 'FkSalesOrder' => 2, 'FkSalesOrderItem' => 3, 'Name' => 4, 'Amount' => 5, 'RefundedAmount' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idSalesMerchantCommission' => 0, 'uuid' => 1, 'fkSalesOrder' => 2, 'fkSalesOrderItem' => 3, 'name' => 4, 'amount' => 5, 'refundedAmount' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION => 0, SpySalesMerchantCommissionTableMap::COL_UUID => 1, SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER => 2, SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER_ITEM => 3, SpySalesMerchantCommissionTableMap::COL_NAME => 4, SpySalesMerchantCommissionTableMap::COL_AMOUNT => 5, SpySalesMerchantCommissionTableMap::COL_REFUNDED_AMOUNT => 6, SpySalesMerchantCommissionTableMap::COL_CREATED_AT => 7, SpySalesMerchantCommissionTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_sales_merchant_commission' => 0, 'uuid' => 1, 'fk_sales_order' => 2, 'fk_sales_order_item' => 3, 'name' => 4, 'amount' => 5, 'refunded_amount' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesMerchantCommission' => 'ID_SALES_MERCHANT_COMMISSION',
        'SpySalesMerchantCommission.IdSalesMerchantCommission' => 'ID_SALES_MERCHANT_COMMISSION',
        'idSalesMerchantCommission' => 'ID_SALES_MERCHANT_COMMISSION',
        'spySalesMerchantCommission.idSalesMerchantCommission' => 'ID_SALES_MERCHANT_COMMISSION',
        'SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION' => 'ID_SALES_MERCHANT_COMMISSION',
        'COL_ID_SALES_MERCHANT_COMMISSION' => 'ID_SALES_MERCHANT_COMMISSION',
        'id_sales_merchant_commission' => 'ID_SALES_MERCHANT_COMMISSION',
        'spy_sales_merchant_commission.id_sales_merchant_commission' => 'ID_SALES_MERCHANT_COMMISSION',
        'Uuid' => 'UUID',
        'SpySalesMerchantCommission.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spySalesMerchantCommission.uuid' => 'UUID',
        'SpySalesMerchantCommissionTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_sales_merchant_commission.uuid' => 'UUID',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesMerchantCommission.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesMerchantCommission.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_merchant_commission.fk_sales_order' => 'FK_SALES_ORDER',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesMerchantCommission.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesMerchantCommission.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_merchant_commission.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'Name' => 'NAME',
        'SpySalesMerchantCommission.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesMerchantCommission.name' => 'NAME',
        'SpySalesMerchantCommissionTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_merchant_commission.name' => 'NAME',
        'Amount' => 'AMOUNT',
        'SpySalesMerchantCommission.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'spySalesMerchantCommission.amount' => 'AMOUNT',
        'SpySalesMerchantCommissionTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'spy_sales_merchant_commission.amount' => 'AMOUNT',
        'RefundedAmount' => 'REFUNDED_AMOUNT',
        'SpySalesMerchantCommission.RefundedAmount' => 'REFUNDED_AMOUNT',
        'refundedAmount' => 'REFUNDED_AMOUNT',
        'spySalesMerchantCommission.refundedAmount' => 'REFUNDED_AMOUNT',
        'SpySalesMerchantCommissionTableMap::COL_REFUNDED_AMOUNT' => 'REFUNDED_AMOUNT',
        'COL_REFUNDED_AMOUNT' => 'REFUNDED_AMOUNT',
        'refunded_amount' => 'REFUNDED_AMOUNT',
        'spy_sales_merchant_commission.refunded_amount' => 'REFUNDED_AMOUNT',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesMerchantCommission.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesMerchantCommission.createdAt' => 'CREATED_AT',
        'SpySalesMerchantCommissionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_merchant_commission.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesMerchantCommission.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesMerchantCommission.updatedAt' => 'UPDATED_AT',
        'SpySalesMerchantCommissionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_merchant_commission.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_merchant_commission');
        $this->setPhpName('SpySalesMerchantCommission');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesMerchantCommission\\Persistence\\SpySalesMerchantCommission');
        $this->setPackage('src.Orm.Zed.SalesMerchantCommission.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_merchant_commission_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_merchant_commission', 'IdSalesMerchantCommission', 'INTEGER', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('amount', 'Amount', 'INTEGER', false, null, 0);
        $this->addColumn('refunded_amount', 'RefundedAmount', 'INTEGER', false, null, 0);
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
        $this->addRelation('SpySalesOrder', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_sales_merchant_commission'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesMerchantCommission', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesMerchantCommissionTableMap::CLASS_DEFAULT : SpySalesMerchantCommissionTableMap::OM_CLASS;
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
     * @return array (SpySalesMerchantCommission object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesMerchantCommissionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesMerchantCommissionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesMerchantCommissionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesMerchantCommissionTableMap::OM_CLASS;
            /** @var SpySalesMerchantCommission $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesMerchantCommissionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesMerchantCommissionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesMerchantCommissionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesMerchantCommission $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesMerchantCommissionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_UUID);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_REFUNDED_AMOUNT);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesMerchantCommissionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_merchant_commission');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.refunded_amount');
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
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_REFUNDED_AMOUNT);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesMerchantCommissionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_merchant_commission');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.refunded_amount');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesMerchantCommissionTableMap::DATABASE_NAME)->getTable(SpySalesMerchantCommissionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesMerchantCommission or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesMerchantCommission object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesMerchantCommissionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesMerchantCommission\Persistence\SpySalesMerchantCommission) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesMerchantCommissionTableMap::DATABASE_NAME);
            $criteria->add(SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION, (array) $values, Criteria::IN);
        }

        $query = SpySalesMerchantCommissionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesMerchantCommissionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesMerchantCommissionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_merchant_commission table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesMerchantCommissionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesMerchantCommission or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesMerchantCommission object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesMerchantCommissionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesMerchantCommission object
        }

        if ($criteria->containsKey(SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION) && $criteria->keyContainsValue(SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesMerchantCommissionTableMap::COL_ID_SALES_MERCHANT_COMMISSION.')');
        }


        // Set the correct dbName
        $query = SpySalesMerchantCommissionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
