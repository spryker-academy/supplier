<?php

namespace Orm\Zed\SalesPaymentMerchant\Persistence\Map;

use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery;
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
 * This class defines the structure of the 'spy_sales_payment_merchant_payout' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesPaymentMerchantPayoutTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesPaymentMerchant.Persistence.Map.SpySalesPaymentMerchantPayoutTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_payment_merchant_payout';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesPaymentMerchantPayout';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesPaymentMerchant\\Persistence\\SpySalesPaymentMerchantPayout';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesPaymentMerchant.Persistence.SpySalesPaymentMerchantPayout';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_sales_payment_merchant_payout field
     */
    public const COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT = 'spy_sales_payment_merchant_payout.id_sales_payment_merchant_payout';

    /**
     * the column name for the transfer_id field
     */
    public const COL_TRANSFER_ID = 'spy_sales_payment_merchant_payout.transfer_id';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_sales_payment_merchant_payout.merchant_reference';

    /**
     * the column name for the order_reference field
     */
    public const COL_ORDER_REFERENCE = 'spy_sales_payment_merchant_payout.order_reference';

    /**
     * the column name for the item_references field
     */
    public const COL_ITEM_REFERENCES = 'spy_sales_payment_merchant_payout.item_references';

    /**
     * the column name for the amount field
     */
    public const COL_AMOUNT = 'spy_sales_payment_merchant_payout.amount';

    /**
     * the column name for the is_successful field
     */
    public const COL_IS_SUCCESSFUL = 'spy_sales_payment_merchant_payout.is_successful';

    /**
     * the column name for the failure_message field
     */
    public const COL_FAILURE_MESSAGE = 'spy_sales_payment_merchant_payout.failure_message';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_payment_merchant_payout.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_payment_merchant_payout.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesPaymentMerchantPayout', 'TransferId', 'MerchantReference', 'OrderReference', 'ItemReferences', 'Amount', 'IsSuccessful', 'FailureMessage', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesPaymentMerchantPayout', 'transferId', 'merchantReference', 'orderReference', 'itemReferences', 'amount', 'isSuccessful', 'failureMessage', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, SpySalesPaymentMerchantPayoutTableMap::COL_TRANSFER_ID, SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE, SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE, SpySalesPaymentMerchantPayoutTableMap::COL_ITEM_REFERENCES, SpySalesPaymentMerchantPayoutTableMap::COL_AMOUNT, SpySalesPaymentMerchantPayoutTableMap::COL_IS_SUCCESSFUL, SpySalesPaymentMerchantPayoutTableMap::COL_FAILURE_MESSAGE, SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT, SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_payment_merchant_payout', 'transfer_id', 'merchant_reference', 'order_reference', 'item_references', 'amount', 'is_successful', 'failure_message', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdSalesPaymentMerchantPayout' => 0, 'TransferId' => 1, 'MerchantReference' => 2, 'OrderReference' => 3, 'ItemReferences' => 4, 'Amount' => 5, 'IsSuccessful' => 6, 'FailureMessage' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idSalesPaymentMerchantPayout' => 0, 'transferId' => 1, 'merchantReference' => 2, 'orderReference' => 3, 'itemReferences' => 4, 'amount' => 5, 'isSuccessful' => 6, 'failureMessage' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT => 0, SpySalesPaymentMerchantPayoutTableMap::COL_TRANSFER_ID => 1, SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE => 2, SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE => 3, SpySalesPaymentMerchantPayoutTableMap::COL_ITEM_REFERENCES => 4, SpySalesPaymentMerchantPayoutTableMap::COL_AMOUNT => 5, SpySalesPaymentMerchantPayoutTableMap::COL_IS_SUCCESSFUL => 6, SpySalesPaymentMerchantPayoutTableMap::COL_FAILURE_MESSAGE => 7, SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT => 8, SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_sales_payment_merchant_payout' => 0, 'transfer_id' => 1, 'merchant_reference' => 2, 'order_reference' => 3, 'item_references' => 4, 'amount' => 5, 'is_successful' => 6, 'failure_message' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesPaymentMerchantPayout' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'SpySalesPaymentMerchantPayout.IdSalesPaymentMerchantPayout' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'idSalesPaymentMerchantPayout' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'spySalesPaymentMerchantPayout.idSalesPaymentMerchantPayout' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'id_sales_payment_merchant_payout' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'spy_sales_payment_merchant_payout.id_sales_payment_merchant_payout' => 'ID_SALES_PAYMENT_MERCHANT_PAYOUT',
        'TransferId' => 'TRANSFER_ID',
        'SpySalesPaymentMerchantPayout.TransferId' => 'TRANSFER_ID',
        'transferId' => 'TRANSFER_ID',
        'spySalesPaymentMerchantPayout.transferId' => 'TRANSFER_ID',
        'SpySalesPaymentMerchantPayoutTableMap::COL_TRANSFER_ID' => 'TRANSFER_ID',
        'COL_TRANSFER_ID' => 'TRANSFER_ID',
        'transfer_id' => 'TRANSFER_ID',
        'spy_sales_payment_merchant_payout.transfer_id' => 'TRANSFER_ID',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpySalesPaymentMerchantPayout.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spySalesPaymentMerchantPayout.merchantReference' => 'MERCHANT_REFERENCE',
        'SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_sales_payment_merchant_payout.merchant_reference' => 'MERCHANT_REFERENCE',
        'OrderReference' => 'ORDER_REFERENCE',
        'SpySalesPaymentMerchantPayout.OrderReference' => 'ORDER_REFERENCE',
        'orderReference' => 'ORDER_REFERENCE',
        'spySalesPaymentMerchantPayout.orderReference' => 'ORDER_REFERENCE',
        'SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE' => 'ORDER_REFERENCE',
        'COL_ORDER_REFERENCE' => 'ORDER_REFERENCE',
        'order_reference' => 'ORDER_REFERENCE',
        'spy_sales_payment_merchant_payout.order_reference' => 'ORDER_REFERENCE',
        'ItemReferences' => 'ITEM_REFERENCES',
        'SpySalesPaymentMerchantPayout.ItemReferences' => 'ITEM_REFERENCES',
        'itemReferences' => 'ITEM_REFERENCES',
        'spySalesPaymentMerchantPayout.itemReferences' => 'ITEM_REFERENCES',
        'SpySalesPaymentMerchantPayoutTableMap::COL_ITEM_REFERENCES' => 'ITEM_REFERENCES',
        'COL_ITEM_REFERENCES' => 'ITEM_REFERENCES',
        'item_references' => 'ITEM_REFERENCES',
        'spy_sales_payment_merchant_payout.item_references' => 'ITEM_REFERENCES',
        'Amount' => 'AMOUNT',
        'SpySalesPaymentMerchantPayout.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'spySalesPaymentMerchantPayout.amount' => 'AMOUNT',
        'SpySalesPaymentMerchantPayoutTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'spy_sales_payment_merchant_payout.amount' => 'AMOUNT',
        'IsSuccessful' => 'IS_SUCCESSFUL',
        'SpySalesPaymentMerchantPayout.IsSuccessful' => 'IS_SUCCESSFUL',
        'isSuccessful' => 'IS_SUCCESSFUL',
        'spySalesPaymentMerchantPayout.isSuccessful' => 'IS_SUCCESSFUL',
        'SpySalesPaymentMerchantPayoutTableMap::COL_IS_SUCCESSFUL' => 'IS_SUCCESSFUL',
        'COL_IS_SUCCESSFUL' => 'IS_SUCCESSFUL',
        'is_successful' => 'IS_SUCCESSFUL',
        'spy_sales_payment_merchant_payout.is_successful' => 'IS_SUCCESSFUL',
        'FailureMessage' => 'FAILURE_MESSAGE',
        'SpySalesPaymentMerchantPayout.FailureMessage' => 'FAILURE_MESSAGE',
        'failureMessage' => 'FAILURE_MESSAGE',
        'spySalesPaymentMerchantPayout.failureMessage' => 'FAILURE_MESSAGE',
        'SpySalesPaymentMerchantPayoutTableMap::COL_FAILURE_MESSAGE' => 'FAILURE_MESSAGE',
        'COL_FAILURE_MESSAGE' => 'FAILURE_MESSAGE',
        'failure_message' => 'FAILURE_MESSAGE',
        'spy_sales_payment_merchant_payout.failure_message' => 'FAILURE_MESSAGE',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesPaymentMerchantPayout.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesPaymentMerchantPayout.createdAt' => 'CREATED_AT',
        'SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_payment_merchant_payout.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesPaymentMerchantPayout.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesPaymentMerchantPayout.updatedAt' => 'UPDATED_AT',
        'SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_payment_merchant_payout.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_payment_merchant_payout');
        $this->setPhpName('SpySalesPaymentMerchantPayout');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesPaymentMerchant\\Persistence\\SpySalesPaymentMerchantPayout');
        $this->setPackage('src.Orm.Zed.SalesPaymentMerchant.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_payment_merchant_payout_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_payment_merchant_payout', 'IdSalesPaymentMerchantPayout', 'INTEGER', true, null, null);
        $this->addColumn('transfer_id', 'TransferId', 'VARCHAR', false, 128, null);
        $this->addForeignKey('merchant_reference', 'MerchantReference', 'VARCHAR', 'spy_merchant', 'merchant_reference', false, 36, null);
        $this->addForeignKey('order_reference', 'OrderReference', 'VARCHAR', 'spy_sales_order', 'order_reference', true, 36, null);
        $this->addColumn('item_references', 'ItemReferences', 'LONGVARCHAR', true, null, null);
        $this->addColumn('amount', 'Amount', 'VARCHAR', false, 128, null);
        $this->addColumn('is_successful', 'IsSuccessful', 'BOOLEAN', true, 1, null);
        $this->addColumn('failure_message', 'FailureMessage', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('SpyMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesOrder', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':order_reference',
    1 => ':order_reference',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesPaymentMerchantPayout', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesPaymentMerchantPayoutTableMap::CLASS_DEFAULT : SpySalesPaymentMerchantPayoutTableMap::OM_CLASS;
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
     * @return array (SpySalesPaymentMerchantPayout object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesPaymentMerchantPayoutTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesPaymentMerchantPayoutTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesPaymentMerchantPayoutTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesPaymentMerchantPayoutTableMap::OM_CLASS;
            /** @var SpySalesPaymentMerchantPayout $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesPaymentMerchantPayoutTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesPaymentMerchantPayoutTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesPaymentMerchantPayoutTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesPaymentMerchantPayout $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesPaymentMerchantPayoutTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_TRANSFER_ID);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_ITEM_REFERENCES);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_IS_SUCCESSFUL);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_FAILURE_MESSAGE);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_payment_merchant_payout');
            $criteria->addSelectColumn($alias . '.transfer_id');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.order_reference');
            $criteria->addSelectColumn($alias . '.item_references');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.is_successful');
            $criteria->addSelectColumn($alias . '.failure_message');
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
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_TRANSFER_ID);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_ORDER_REFERENCE);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_ITEM_REFERENCES);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_IS_SUCCESSFUL);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_FAILURE_MESSAGE);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesPaymentMerchantPayoutTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_payment_merchant_payout');
            $criteria->removeSelectColumn($alias . '.transfer_id');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.order_reference');
            $criteria->removeSelectColumn($alias . '.item_references');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.is_successful');
            $criteria->removeSelectColumn($alias . '.failure_message');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME)->getTable(SpySalesPaymentMerchantPayoutTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesPaymentMerchantPayout or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesPaymentMerchantPayout object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME);
            $criteria->add(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT, (array) $values, Criteria::IN);
        }

        $query = SpySalesPaymentMerchantPayoutQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesPaymentMerchantPayoutTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesPaymentMerchantPayoutTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_payment_merchant_payout table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesPaymentMerchantPayoutQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesPaymentMerchantPayout or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesPaymentMerchantPayout object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMerchantPayoutTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesPaymentMerchantPayout object
        }

        if ($criteria->containsKey(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT) && $criteria->keyContainsValue(SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesPaymentMerchantPayoutTableMap::COL_ID_SALES_PAYMENT_MERCHANT_PAYOUT.')');
        }


        // Set the correct dbName
        $query = SpySalesPaymentMerchantPayoutQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
