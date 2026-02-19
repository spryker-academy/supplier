<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesShipment;
use Orm\Zed\Sales\Persistence\SpySalesShipmentQuery;
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
 * This class defines the structure of the 'spy_sales_shipment' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesShipmentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesShipmentTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_shipment';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesShipment';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesShipment';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesShipment';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id_sales_shipment field
     */
    public const COL_ID_SALES_SHIPMENT = 'spy_sales_shipment.id_sales_shipment';

    /**
     * the column name for the fk_sales_expense field
     */
    public const COL_FK_SALES_EXPENSE = 'spy_sales_shipment.fk_sales_expense';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_shipment.fk_sales_order';

    /**
     * the column name for the fk_sales_order_address field
     */
    public const COL_FK_SALES_ORDER_ADDRESS = 'spy_sales_shipment.fk_sales_order_address';

    /**
     * the column name for the fk_sales_shipment_type field
     */
    public const COL_FK_SALES_SHIPMENT_TYPE = 'spy_sales_shipment.fk_sales_shipment_type';

    /**
     * the column name for the carrier_name field
     */
    public const COL_CARRIER_NAME = 'spy_sales_shipment.carrier_name';

    /**
     * the column name for the delivery_time field
     */
    public const COL_DELIVERY_TIME = 'spy_sales_shipment.delivery_time';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_sales_shipment.merchant_reference';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_shipment.name';

    /**
     * the column name for the requested_delivery_date field
     */
    public const COL_REQUESTED_DELIVERY_DATE = 'spy_sales_shipment.requested_delivery_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_shipment.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_shipment.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesShipment', 'FkSalesExpense', 'FkSalesOrder', 'FkSalesOrderAddress', 'FkSalesShipmentType', 'CarrierName', 'DeliveryTime', 'MerchantReference', 'Name', 'RequestedDeliveryDate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesShipment', 'fkSalesExpense', 'fkSalesOrder', 'fkSalesOrderAddress', 'fkSalesShipmentType', 'carrierName', 'deliveryTime', 'merchantReference', 'name', 'requestedDeliveryDate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT, SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE, SpySalesShipmentTableMap::COL_FK_SALES_ORDER, SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS, SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE, SpySalesShipmentTableMap::COL_CARRIER_NAME, SpySalesShipmentTableMap::COL_DELIVERY_TIME, SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE, SpySalesShipmentTableMap::COL_NAME, SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE, SpySalesShipmentTableMap::COL_CREATED_AT, SpySalesShipmentTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_shipment', 'fk_sales_expense', 'fk_sales_order', 'fk_sales_order_address', 'fk_sales_shipment_type', 'carrier_name', 'delivery_time', 'merchant_reference', 'name', 'requested_delivery_date', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['IdSalesShipment' => 0, 'FkSalesExpense' => 1, 'FkSalesOrder' => 2, 'FkSalesOrderAddress' => 3, 'FkSalesShipmentType' => 4, 'CarrierName' => 5, 'DeliveryTime' => 6, 'MerchantReference' => 7, 'Name' => 8, 'RequestedDeliveryDate' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ],
        self::TYPE_CAMELNAME     => ['idSalesShipment' => 0, 'fkSalesExpense' => 1, 'fkSalesOrder' => 2, 'fkSalesOrderAddress' => 3, 'fkSalesShipmentType' => 4, 'carrierName' => 5, 'deliveryTime' => 6, 'merchantReference' => 7, 'name' => 8, 'requestedDeliveryDate' => 9, 'createdAt' => 10, 'updatedAt' => 11, ],
        self::TYPE_COLNAME       => [SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT => 0, SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE => 1, SpySalesShipmentTableMap::COL_FK_SALES_ORDER => 2, SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS => 3, SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE => 4, SpySalesShipmentTableMap::COL_CARRIER_NAME => 5, SpySalesShipmentTableMap::COL_DELIVERY_TIME => 6, SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE => 7, SpySalesShipmentTableMap::COL_NAME => 8, SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE => 9, SpySalesShipmentTableMap::COL_CREATED_AT => 10, SpySalesShipmentTableMap::COL_UPDATED_AT => 11, ],
        self::TYPE_FIELDNAME     => ['id_sales_shipment' => 0, 'fk_sales_expense' => 1, 'fk_sales_order' => 2, 'fk_sales_order_address' => 3, 'fk_sales_shipment_type' => 4, 'carrier_name' => 5, 'delivery_time' => 6, 'merchant_reference' => 7, 'name' => 8, 'requested_delivery_date' => 9, 'created_at' => 10, 'updated_at' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesShipment' => 'ID_SALES_SHIPMENT',
        'SpySalesShipment.IdSalesShipment' => 'ID_SALES_SHIPMENT',
        'idSalesShipment' => 'ID_SALES_SHIPMENT',
        'spySalesShipment.idSalesShipment' => 'ID_SALES_SHIPMENT',
        'SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT' => 'ID_SALES_SHIPMENT',
        'COL_ID_SALES_SHIPMENT' => 'ID_SALES_SHIPMENT',
        'id_sales_shipment' => 'ID_SALES_SHIPMENT',
        'spy_sales_shipment.id_sales_shipment' => 'ID_SALES_SHIPMENT',
        'FkSalesExpense' => 'FK_SALES_EXPENSE',
        'SpySalesShipment.FkSalesExpense' => 'FK_SALES_EXPENSE',
        'fkSalesExpense' => 'FK_SALES_EXPENSE',
        'spySalesShipment.fkSalesExpense' => 'FK_SALES_EXPENSE',
        'SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE' => 'FK_SALES_EXPENSE',
        'COL_FK_SALES_EXPENSE' => 'FK_SALES_EXPENSE',
        'fk_sales_expense' => 'FK_SALES_EXPENSE',
        'spy_sales_shipment.fk_sales_expense' => 'FK_SALES_EXPENSE',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesShipment.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesShipment.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesShipmentTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_shipment.fk_sales_order' => 'FK_SALES_ORDER',
        'FkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'SpySalesShipment.FkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'fkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'spySalesShipment.fkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS' => 'FK_SALES_ORDER_ADDRESS',
        'COL_FK_SALES_ORDER_ADDRESS' => 'FK_SALES_ORDER_ADDRESS',
        'fk_sales_order_address' => 'FK_SALES_ORDER_ADDRESS',
        'spy_sales_shipment.fk_sales_order_address' => 'FK_SALES_ORDER_ADDRESS',
        'FkSalesShipmentType' => 'FK_SALES_SHIPMENT_TYPE',
        'SpySalesShipment.FkSalesShipmentType' => 'FK_SALES_SHIPMENT_TYPE',
        'fkSalesShipmentType' => 'FK_SALES_SHIPMENT_TYPE',
        'spySalesShipment.fkSalesShipmentType' => 'FK_SALES_SHIPMENT_TYPE',
        'SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE' => 'FK_SALES_SHIPMENT_TYPE',
        'COL_FK_SALES_SHIPMENT_TYPE' => 'FK_SALES_SHIPMENT_TYPE',
        'fk_sales_shipment_type' => 'FK_SALES_SHIPMENT_TYPE',
        'spy_sales_shipment.fk_sales_shipment_type' => 'FK_SALES_SHIPMENT_TYPE',
        'CarrierName' => 'CARRIER_NAME',
        'SpySalesShipment.CarrierName' => 'CARRIER_NAME',
        'carrierName' => 'CARRIER_NAME',
        'spySalesShipment.carrierName' => 'CARRIER_NAME',
        'SpySalesShipmentTableMap::COL_CARRIER_NAME' => 'CARRIER_NAME',
        'COL_CARRIER_NAME' => 'CARRIER_NAME',
        'carrier_name' => 'CARRIER_NAME',
        'spy_sales_shipment.carrier_name' => 'CARRIER_NAME',
        'DeliveryTime' => 'DELIVERY_TIME',
        'SpySalesShipment.DeliveryTime' => 'DELIVERY_TIME',
        'deliveryTime' => 'DELIVERY_TIME',
        'spySalesShipment.deliveryTime' => 'DELIVERY_TIME',
        'SpySalesShipmentTableMap::COL_DELIVERY_TIME' => 'DELIVERY_TIME',
        'COL_DELIVERY_TIME' => 'DELIVERY_TIME',
        'delivery_time' => 'DELIVERY_TIME',
        'spy_sales_shipment.delivery_time' => 'DELIVERY_TIME',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpySalesShipment.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spySalesShipment.merchantReference' => 'MERCHANT_REFERENCE',
        'SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_sales_shipment.merchant_reference' => 'MERCHANT_REFERENCE',
        'Name' => 'NAME',
        'SpySalesShipment.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesShipment.name' => 'NAME',
        'SpySalesShipmentTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_shipment.name' => 'NAME',
        'RequestedDeliveryDate' => 'REQUESTED_DELIVERY_DATE',
        'SpySalesShipment.RequestedDeliveryDate' => 'REQUESTED_DELIVERY_DATE',
        'requestedDeliveryDate' => 'REQUESTED_DELIVERY_DATE',
        'spySalesShipment.requestedDeliveryDate' => 'REQUESTED_DELIVERY_DATE',
        'SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE' => 'REQUESTED_DELIVERY_DATE',
        'COL_REQUESTED_DELIVERY_DATE' => 'REQUESTED_DELIVERY_DATE',
        'requested_delivery_date' => 'REQUESTED_DELIVERY_DATE',
        'spy_sales_shipment.requested_delivery_date' => 'REQUESTED_DELIVERY_DATE',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesShipment.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesShipment.createdAt' => 'CREATED_AT',
        'SpySalesShipmentTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_shipment.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesShipment.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesShipment.updatedAt' => 'UPDATED_AT',
        'SpySalesShipmentTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_shipment.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_shipment');
        $this->setPhpName('SpySalesShipment');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesShipment');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_shipment_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_shipment', 'IdSalesShipment', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_expense', 'FkSalesExpense', 'INTEGER', 'spy_sales_expense', 'id_sales_expense', false, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addForeignKey('fk_sales_order_address', 'FkSalesOrderAddress', 'INTEGER', 'spy_sales_order_address', 'id_sales_order_address', false, null, null);
        $this->addForeignKey('fk_sales_shipment_type', 'FkSalesShipmentType', 'INTEGER', 'spy_sales_shipment_type', 'id_sales_shipment_type', false, null, null);
        $this->addColumn('carrier_name', 'CarrierName', 'VARCHAR', false, 255, null);
        $this->addColumn('delivery_time', 'DeliveryTime', 'VARCHAR', false, 255, null);
        $this->addColumn('merchant_reference', 'MerchantReference', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('requested_delivery_date', 'RequestedDeliveryDate', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SalesShipmentType', '\\Orm\\Zed\\SalesShipmentType\\Persistence\\SpySalesShipmentType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_shipment_type',
    1 => ':id_sales_shipment_type',
  ),
), null, null, null, false);
        $this->addRelation('Order', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('Expense', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesExpense', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_expense',
    1 => ':id_sales_expense',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesOrderAddress', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddress', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_address',
    1 => ':id_sales_order_address',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_shipment',
    1 => ':id_sales_shipment',
  ),
), null, null, 'SpySalesOrderItems', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesShipment', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesShipmentTableMap::CLASS_DEFAULT : SpySalesShipmentTableMap::OM_CLASS;
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
     * @return array (SpySalesShipment object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesShipmentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesShipmentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesShipmentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesShipmentTableMap::OM_CLASS;
            /** @var SpySalesShipment $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesShipmentTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesShipmentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesShipmentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesShipment $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesShipmentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_CARRIER_NAME);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_DELIVERY_TIME);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesShipmentTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_shipment');
            $criteria->addSelectColumn($alias . '.fk_sales_expense');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.fk_sales_order_address');
            $criteria->addSelectColumn($alias . '.fk_sales_shipment_type');
            $criteria->addSelectColumn($alias . '.carrier_name');
            $criteria->addSelectColumn($alias . '.delivery_time');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.requested_delivery_date');
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
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_EXPENSE);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_ORDER_ADDRESS);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_FK_SALES_SHIPMENT_TYPE);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_CARRIER_NAME);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_DELIVERY_TIME);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_REQUESTED_DELIVERY_DATE);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesShipmentTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_shipment');
            $criteria->removeSelectColumn($alias . '.fk_sales_expense');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_address');
            $criteria->removeSelectColumn($alias . '.fk_sales_shipment_type');
            $criteria->removeSelectColumn($alias . '.carrier_name');
            $criteria->removeSelectColumn($alias . '.delivery_time');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.requested_delivery_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesShipmentTableMap::DATABASE_NAME)->getTable(SpySalesShipmentTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesShipment or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesShipment object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesShipmentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesShipment) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesShipmentTableMap::DATABASE_NAME);
            $criteria->add(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT, (array) $values, Criteria::IN);
        }

        $query = SpySalesShipmentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesShipmentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesShipmentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_shipment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesShipmentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesShipment or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesShipment object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesShipmentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesShipment object
        }

        if ($criteria->containsKey(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT) && $criteria->keyContainsValue(SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesShipmentTableMap::COL_ID_SALES_SHIPMENT.')');
        }


        // Set the correct dbName
        $query = SpySalesShipmentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
