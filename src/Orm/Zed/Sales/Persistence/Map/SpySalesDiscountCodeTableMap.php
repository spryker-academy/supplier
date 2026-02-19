<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesDiscountCode;
use Orm\Zed\Sales\Persistence\SpySalesDiscountCodeQuery;
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
 * This class defines the structure of the 'spy_sales_discount_code' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesDiscountCodeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesDiscountCodeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_discount_code';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesDiscountCode';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscountCode';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesDiscountCode';

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
     * the column name for the id_sales_discount_code field
     */
    public const COL_ID_SALES_DISCOUNT_CODE = 'spy_sales_discount_code.id_sales_discount_code';

    /**
     * the column name for the fk_sales_discount field
     */
    public const COL_FK_SALES_DISCOUNT = 'spy_sales_discount_code.fk_sales_discount';

    /**
     * the column name for the code field
     */
    public const COL_CODE = 'spy_sales_discount_code.code';

    /**
     * the column name for the codepool_name field
     */
    public const COL_CODEPOOL_NAME = 'spy_sales_discount_code.codepool_name';

    /**
     * the column name for the is_once_per_customer field
     */
    public const COL_IS_ONCE_PER_CUSTOMER = 'spy_sales_discount_code.is_once_per_customer';

    /**
     * the column name for the is_refundable field
     */
    public const COL_IS_REFUNDABLE = 'spy_sales_discount_code.is_refundable';

    /**
     * the column name for the is_reusable field
     */
    public const COL_IS_REUSABLE = 'spy_sales_discount_code.is_reusable';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_discount_code.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_discount_code.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesDiscountCode', 'FkSalesDiscount', 'Code', 'CodepoolName', 'IsOncePerCustomer', 'IsRefundable', 'IsReusable', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesDiscountCode', 'fkSalesDiscount', 'code', 'codepoolName', 'isOncePerCustomer', 'isRefundable', 'isReusable', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE, SpySalesDiscountCodeTableMap::COL_FK_SALES_DISCOUNT, SpySalesDiscountCodeTableMap::COL_CODE, SpySalesDiscountCodeTableMap::COL_CODEPOOL_NAME, SpySalesDiscountCodeTableMap::COL_IS_ONCE_PER_CUSTOMER, SpySalesDiscountCodeTableMap::COL_IS_REFUNDABLE, SpySalesDiscountCodeTableMap::COL_IS_REUSABLE, SpySalesDiscountCodeTableMap::COL_CREATED_AT, SpySalesDiscountCodeTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_discount_code', 'fk_sales_discount', 'code', 'codepool_name', 'is_once_per_customer', 'is_refundable', 'is_reusable', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesDiscountCode' => 0, 'FkSalesDiscount' => 1, 'Code' => 2, 'CodepoolName' => 3, 'IsOncePerCustomer' => 4, 'IsRefundable' => 5, 'IsReusable' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idSalesDiscountCode' => 0, 'fkSalesDiscount' => 1, 'code' => 2, 'codepoolName' => 3, 'isOncePerCustomer' => 4, 'isRefundable' => 5, 'isReusable' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE => 0, SpySalesDiscountCodeTableMap::COL_FK_SALES_DISCOUNT => 1, SpySalesDiscountCodeTableMap::COL_CODE => 2, SpySalesDiscountCodeTableMap::COL_CODEPOOL_NAME => 3, SpySalesDiscountCodeTableMap::COL_IS_ONCE_PER_CUSTOMER => 4, SpySalesDiscountCodeTableMap::COL_IS_REFUNDABLE => 5, SpySalesDiscountCodeTableMap::COL_IS_REUSABLE => 6, SpySalesDiscountCodeTableMap::COL_CREATED_AT => 7, SpySalesDiscountCodeTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_sales_discount_code' => 0, 'fk_sales_discount' => 1, 'code' => 2, 'codepool_name' => 3, 'is_once_per_customer' => 4, 'is_refundable' => 5, 'is_reusable' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesDiscountCode' => 'ID_SALES_DISCOUNT_CODE',
        'SpySalesDiscountCode.IdSalesDiscountCode' => 'ID_SALES_DISCOUNT_CODE',
        'idSalesDiscountCode' => 'ID_SALES_DISCOUNT_CODE',
        'spySalesDiscountCode.idSalesDiscountCode' => 'ID_SALES_DISCOUNT_CODE',
        'SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE' => 'ID_SALES_DISCOUNT_CODE',
        'COL_ID_SALES_DISCOUNT_CODE' => 'ID_SALES_DISCOUNT_CODE',
        'id_sales_discount_code' => 'ID_SALES_DISCOUNT_CODE',
        'spy_sales_discount_code.id_sales_discount_code' => 'ID_SALES_DISCOUNT_CODE',
        'FkSalesDiscount' => 'FK_SALES_DISCOUNT',
        'SpySalesDiscountCode.FkSalesDiscount' => 'FK_SALES_DISCOUNT',
        'fkSalesDiscount' => 'FK_SALES_DISCOUNT',
        'spySalesDiscountCode.fkSalesDiscount' => 'FK_SALES_DISCOUNT',
        'SpySalesDiscountCodeTableMap::COL_FK_SALES_DISCOUNT' => 'FK_SALES_DISCOUNT',
        'COL_FK_SALES_DISCOUNT' => 'FK_SALES_DISCOUNT',
        'fk_sales_discount' => 'FK_SALES_DISCOUNT',
        'spy_sales_discount_code.fk_sales_discount' => 'FK_SALES_DISCOUNT',
        'Code' => 'CODE',
        'SpySalesDiscountCode.Code' => 'CODE',
        'code' => 'CODE',
        'spySalesDiscountCode.code' => 'CODE',
        'SpySalesDiscountCodeTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'spy_sales_discount_code.code' => 'CODE',
        'CodepoolName' => 'CODEPOOL_NAME',
        'SpySalesDiscountCode.CodepoolName' => 'CODEPOOL_NAME',
        'codepoolName' => 'CODEPOOL_NAME',
        'spySalesDiscountCode.codepoolName' => 'CODEPOOL_NAME',
        'SpySalesDiscountCodeTableMap::COL_CODEPOOL_NAME' => 'CODEPOOL_NAME',
        'COL_CODEPOOL_NAME' => 'CODEPOOL_NAME',
        'codepool_name' => 'CODEPOOL_NAME',
        'spy_sales_discount_code.codepool_name' => 'CODEPOOL_NAME',
        'IsOncePerCustomer' => 'IS_ONCE_PER_CUSTOMER',
        'SpySalesDiscountCode.IsOncePerCustomer' => 'IS_ONCE_PER_CUSTOMER',
        'isOncePerCustomer' => 'IS_ONCE_PER_CUSTOMER',
        'spySalesDiscountCode.isOncePerCustomer' => 'IS_ONCE_PER_CUSTOMER',
        'SpySalesDiscountCodeTableMap::COL_IS_ONCE_PER_CUSTOMER' => 'IS_ONCE_PER_CUSTOMER',
        'COL_IS_ONCE_PER_CUSTOMER' => 'IS_ONCE_PER_CUSTOMER',
        'is_once_per_customer' => 'IS_ONCE_PER_CUSTOMER',
        'spy_sales_discount_code.is_once_per_customer' => 'IS_ONCE_PER_CUSTOMER',
        'IsRefundable' => 'IS_REFUNDABLE',
        'SpySalesDiscountCode.IsRefundable' => 'IS_REFUNDABLE',
        'isRefundable' => 'IS_REFUNDABLE',
        'spySalesDiscountCode.isRefundable' => 'IS_REFUNDABLE',
        'SpySalesDiscountCodeTableMap::COL_IS_REFUNDABLE' => 'IS_REFUNDABLE',
        'COL_IS_REFUNDABLE' => 'IS_REFUNDABLE',
        'is_refundable' => 'IS_REFUNDABLE',
        'spy_sales_discount_code.is_refundable' => 'IS_REFUNDABLE',
        'IsReusable' => 'IS_REUSABLE',
        'SpySalesDiscountCode.IsReusable' => 'IS_REUSABLE',
        'isReusable' => 'IS_REUSABLE',
        'spySalesDiscountCode.isReusable' => 'IS_REUSABLE',
        'SpySalesDiscountCodeTableMap::COL_IS_REUSABLE' => 'IS_REUSABLE',
        'COL_IS_REUSABLE' => 'IS_REUSABLE',
        'is_reusable' => 'IS_REUSABLE',
        'spy_sales_discount_code.is_reusable' => 'IS_REUSABLE',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesDiscountCode.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesDiscountCode.createdAt' => 'CREATED_AT',
        'SpySalesDiscountCodeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_discount_code.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesDiscountCode.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesDiscountCode.updatedAt' => 'UPDATED_AT',
        'SpySalesDiscountCodeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_discount_code.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_discount_code');
        $this->setPhpName('SpySalesDiscountCode');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscountCode');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_discount_code_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_discount_code', 'IdSalesDiscountCode', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_discount', 'FkSalesDiscount', 'INTEGER', 'spy_sales_discount', 'id_sales_discount', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('codepool_name', 'CodepoolName', 'VARCHAR', true, 255, null);
        $this->addColumn('is_once_per_customer', 'IsOncePerCustomer', 'BOOLEAN', false, 1, true);
        $this->addColumn('is_refundable', 'IsRefundable', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_reusable', 'IsReusable', 'BOOLEAN', false, 1, false);
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
        $this->addRelation('Discount', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesDiscount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_discount',
    1 => ':id_sales_discount',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesDiscountCode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesDiscountCodeTableMap::CLASS_DEFAULT : SpySalesDiscountCodeTableMap::OM_CLASS;
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
     * @return array (SpySalesDiscountCode object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesDiscountCodeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesDiscountCodeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesDiscountCodeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesDiscountCodeTableMap::OM_CLASS;
            /** @var SpySalesDiscountCode $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesDiscountCodeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesDiscountCodeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesDiscountCodeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesDiscountCode $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesDiscountCodeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_FK_SALES_DISCOUNT);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_CODE);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_CODEPOOL_NAME);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_IS_ONCE_PER_CUSTOMER);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_IS_REFUNDABLE);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_IS_REUSABLE);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesDiscountCodeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_discount_code');
            $criteria->addSelectColumn($alias . '.fk_sales_discount');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.codepool_name');
            $criteria->addSelectColumn($alias . '.is_once_per_customer');
            $criteria->addSelectColumn($alias . '.is_refundable');
            $criteria->addSelectColumn($alias . '.is_reusable');
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
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_FK_SALES_DISCOUNT);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_CODE);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_CODEPOOL_NAME);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_IS_ONCE_PER_CUSTOMER);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_IS_REFUNDABLE);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_IS_REUSABLE);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesDiscountCodeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_discount_code');
            $criteria->removeSelectColumn($alias . '.fk_sales_discount');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.codepool_name');
            $criteria->removeSelectColumn($alias . '.is_once_per_customer');
            $criteria->removeSelectColumn($alias . '.is_refundable');
            $criteria->removeSelectColumn($alias . '.is_reusable');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesDiscountCodeTableMap::DATABASE_NAME)->getTable(SpySalesDiscountCodeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesDiscountCode or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesDiscountCode object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesDiscountCodeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesDiscountCode) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesDiscountCodeTableMap::DATABASE_NAME);
            $criteria->add(SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE, (array) $values, Criteria::IN);
        }

        $query = SpySalesDiscountCodeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesDiscountCodeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesDiscountCodeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_discount_code table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesDiscountCodeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesDiscountCode or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesDiscountCode object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesDiscountCodeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesDiscountCode object
        }

        if ($criteria->containsKey(SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE) && $criteria->keyContainsValue(SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesDiscountCodeTableMap::COL_ID_SALES_DISCOUNT_CODE.')');
        }


        // Set the correct dbName
        $query = SpySalesDiscountCodeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
