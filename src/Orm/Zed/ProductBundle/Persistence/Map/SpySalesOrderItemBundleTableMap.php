<?php

namespace Orm\Zed\ProductBundle\Persistence\Map;

use Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle;
use Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundleQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_bundle' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemBundleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductBundle.Persistence.Map.SpySalesOrderItemBundleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_bundle';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemBundle';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductBundle\\Persistence\\SpySalesOrderItemBundle';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductBundle.Persistence.SpySalesOrderItemBundle';

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
     * the column name for the id_sales_order_item_bundle field
     */
    public const COL_ID_SALES_ORDER_ITEM_BUNDLE = 'spy_sales_order_item_bundle.id_sales_order_item_bundle';

    /**
     * the column name for the cart_note field
     */
    public const COL_CART_NOTE = 'spy_sales_order_item_bundle.cart_note';

    /**
     * the column name for the gross_price field
     */
    public const COL_GROSS_PRICE = 'spy_sales_order_item_bundle.gross_price';

    /**
     * the column name for the image field
     */
    public const COL_IMAGE = 'spy_sales_order_item_bundle.image';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_order_item_bundle.name';

    /**
     * the column name for the net_price field
     */
    public const COL_NET_PRICE = 'spy_sales_order_item_bundle.net_price';

    /**
     * the column name for the price field
     */
    public const COL_PRICE = 'spy_sales_order_item_bundle.price';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_sales_order_item_bundle.sku';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_item_bundle.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_item_bundle.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemBundle', 'CartNote', 'GrossPrice', 'Image', 'Name', 'NetPrice', 'Price', 'Sku', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemBundle', 'cartNote', 'grossPrice', 'image', 'name', 'netPrice', 'price', 'sku', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE, SpySalesOrderItemBundleTableMap::COL_CART_NOTE, SpySalesOrderItemBundleTableMap::COL_GROSS_PRICE, SpySalesOrderItemBundleTableMap::COL_IMAGE, SpySalesOrderItemBundleTableMap::COL_NAME, SpySalesOrderItemBundleTableMap::COL_NET_PRICE, SpySalesOrderItemBundleTableMap::COL_PRICE, SpySalesOrderItemBundleTableMap::COL_SKU, SpySalesOrderItemBundleTableMap::COL_CREATED_AT, SpySalesOrderItemBundleTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_bundle', 'cart_note', 'gross_price', 'image', 'name', 'net_price', 'price', 'sku', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemBundle' => 0, 'CartNote' => 1, 'GrossPrice' => 2, 'Image' => 3, 'Name' => 4, 'NetPrice' => 5, 'Price' => 6, 'Sku' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemBundle' => 0, 'cartNote' => 1, 'grossPrice' => 2, 'image' => 3, 'name' => 4, 'netPrice' => 5, 'price' => 6, 'sku' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE => 0, SpySalesOrderItemBundleTableMap::COL_CART_NOTE => 1, SpySalesOrderItemBundleTableMap::COL_GROSS_PRICE => 2, SpySalesOrderItemBundleTableMap::COL_IMAGE => 3, SpySalesOrderItemBundleTableMap::COL_NAME => 4, SpySalesOrderItemBundleTableMap::COL_NET_PRICE => 5, SpySalesOrderItemBundleTableMap::COL_PRICE => 6, SpySalesOrderItemBundleTableMap::COL_SKU => 7, SpySalesOrderItemBundleTableMap::COL_CREATED_AT => 8, SpySalesOrderItemBundleTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_bundle' => 0, 'cart_note' => 1, 'gross_price' => 2, 'image' => 3, 'name' => 4, 'net_price' => 5, 'price' => 6, 'sku' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderItemBundle' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'SpySalesOrderItemBundle.IdSalesOrderItemBundle' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'idSalesOrderItemBundle' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'spySalesOrderItemBundle.idSalesOrderItemBundle' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'COL_ID_SALES_ORDER_ITEM_BUNDLE' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'id_sales_order_item_bundle' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'spy_sales_order_item_bundle.id_sales_order_item_bundle' => 'ID_SALES_ORDER_ITEM_BUNDLE',
        'CartNote' => 'CART_NOTE',
        'SpySalesOrderItemBundle.CartNote' => 'CART_NOTE',
        'cartNote' => 'CART_NOTE',
        'spySalesOrderItemBundle.cartNote' => 'CART_NOTE',
        'SpySalesOrderItemBundleTableMap::COL_CART_NOTE' => 'CART_NOTE',
        'COL_CART_NOTE' => 'CART_NOTE',
        'cart_note' => 'CART_NOTE',
        'spy_sales_order_item_bundle.cart_note' => 'CART_NOTE',
        'GrossPrice' => 'GROSS_PRICE',
        'SpySalesOrderItemBundle.GrossPrice' => 'GROSS_PRICE',
        'grossPrice' => 'GROSS_PRICE',
        'spySalesOrderItemBundle.grossPrice' => 'GROSS_PRICE',
        'SpySalesOrderItemBundleTableMap::COL_GROSS_PRICE' => 'GROSS_PRICE',
        'COL_GROSS_PRICE' => 'GROSS_PRICE',
        'gross_price' => 'GROSS_PRICE',
        'spy_sales_order_item_bundle.gross_price' => 'GROSS_PRICE',
        'Image' => 'IMAGE',
        'SpySalesOrderItemBundle.Image' => 'IMAGE',
        'image' => 'IMAGE',
        'spySalesOrderItemBundle.image' => 'IMAGE',
        'SpySalesOrderItemBundleTableMap::COL_IMAGE' => 'IMAGE',
        'COL_IMAGE' => 'IMAGE',
        'spy_sales_order_item_bundle.image' => 'IMAGE',
        'Name' => 'NAME',
        'SpySalesOrderItemBundle.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesOrderItemBundle.name' => 'NAME',
        'SpySalesOrderItemBundleTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_order_item_bundle.name' => 'NAME',
        'NetPrice' => 'NET_PRICE',
        'SpySalesOrderItemBundle.NetPrice' => 'NET_PRICE',
        'netPrice' => 'NET_PRICE',
        'spySalesOrderItemBundle.netPrice' => 'NET_PRICE',
        'SpySalesOrderItemBundleTableMap::COL_NET_PRICE' => 'NET_PRICE',
        'COL_NET_PRICE' => 'NET_PRICE',
        'net_price' => 'NET_PRICE',
        'spy_sales_order_item_bundle.net_price' => 'NET_PRICE',
        'Price' => 'PRICE',
        'SpySalesOrderItemBundle.Price' => 'PRICE',
        'price' => 'PRICE',
        'spySalesOrderItemBundle.price' => 'PRICE',
        'SpySalesOrderItemBundleTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'spy_sales_order_item_bundle.price' => 'PRICE',
        'Sku' => 'SKU',
        'SpySalesOrderItemBundle.Sku' => 'SKU',
        'sku' => 'SKU',
        'spySalesOrderItemBundle.sku' => 'SKU',
        'SpySalesOrderItemBundleTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_sales_order_item_bundle.sku' => 'SKU',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderItemBundle.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderItemBundle.createdAt' => 'CREATED_AT',
        'SpySalesOrderItemBundleTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_item_bundle.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemBundle.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderItemBundle.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemBundleTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_item_bundle.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_item_bundle');
        $this->setPhpName('SpySalesOrderItemBundle');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductBundle\\Persistence\\SpySalesOrderItemBundle');
        $this->setPackage('src.Orm.Zed.ProductBundle.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_item_bundle_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_item_bundle', 'IdSalesOrderItemBundle', 'INTEGER', true, null, null);
        $this->addColumn('cart_note', 'CartNote', 'VARCHAR', false, 255, null);
        $this->addColumn('gross_price', 'GrossPrice', 'INTEGER', true, null, null);
        $this->addColumn('image', 'Image', 'LONGVARCHAR', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('net_price', 'NetPrice', 'INTEGER', false, null, 0);
        $this->addColumn('price', 'Price', 'INTEGER', false, null, 0);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_order_item_bundle',
    1 => ':id_sales_order_item_bundle',
  ),
), null, null, 'SalesOrderItems', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderItemBundle', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderItemBundleTableMap::CLASS_DEFAULT : SpySalesOrderItemBundleTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemBundle object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemBundleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemBundleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemBundleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemBundleTableMap::OM_CLASS;
            /** @var SpySalesOrderItemBundle $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemBundleTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemBundleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemBundleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemBundle $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemBundleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_CART_NOTE);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_GROSS_PRICE);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_IMAGE);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_NET_PRICE);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_PRICE);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_SKU);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemBundleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_item_bundle');
            $criteria->addSelectColumn($alias . '.cart_note');
            $criteria->addSelectColumn($alias . '.gross_price');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.net_price');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.sku');
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
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_CART_NOTE);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_GROSS_PRICE);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_IMAGE);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_NET_PRICE);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_PRICE);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemBundleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_item_bundle');
            $criteria->removeSelectColumn($alias . '.cart_note');
            $criteria->removeSelectColumn($alias . '.gross_price');
            $criteria->removeSelectColumn($alias . '.image');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.net_price');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.sku');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemBundleTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemBundleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemBundle or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemBundle object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemBundleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductBundle\Persistence\SpySalesOrderItemBundle) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemBundleTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderItemBundleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemBundleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemBundleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_bundle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemBundleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemBundle or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemBundle object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemBundleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemBundle object
        }

        if ($criteria->containsKey(SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE) && $criteria->keyContainsValue(SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderItemBundleTableMap::COL_ID_SALES_ORDER_ITEM_BUNDLE.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderItemBundleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
