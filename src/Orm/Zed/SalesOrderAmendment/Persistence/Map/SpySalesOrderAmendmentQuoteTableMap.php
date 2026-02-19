<?php

namespace Orm\Zed\SalesOrderAmendment\Persistence\Map;

use Orm\Zed\SalesOrderAmendment\Persistence\SpySalesOrderAmendmentQuote;
use Orm\Zed\SalesOrderAmendment\Persistence\SpySalesOrderAmendmentQuoteQuery;
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
 * This class defines the structure of the 'spy_sales_order_amendment_quote' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderAmendmentQuoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesOrderAmendment.Persistence.Map.SpySalesOrderAmendmentQuoteTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_amendment_quote';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderAmendmentQuote';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesOrderAmendment\\Persistence\\SpySalesOrderAmendmentQuote';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesOrderAmendment.Persistence.SpySalesOrderAmendmentQuote';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_sales_order_amendment_quote field
     */
    public const COL_ID_SALES_ORDER_AMENDMENT_QUOTE = 'spy_sales_order_amendment_quote.id_sales_order_amendment_quote';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_sales_order_amendment_quote.uuid';

    /**
     * the column name for the store field
     */
    public const COL_STORE = 'spy_sales_order_amendment_quote.store';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_sales_order_amendment_quote.customer_reference';

    /**
     * the column name for the amendment_order_reference field
     */
    public const COL_AMENDMENT_ORDER_REFERENCE = 'spy_sales_order_amendment_quote.amendment_order_reference';

    /**
     * the column name for the quote_data field
     */
    public const COL_QUOTE_DATA = 'spy_sales_order_amendment_quote.quote_data';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_amendment_quote.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_amendment_quote.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderAmendmentQuote', 'Uuid', 'Store', 'CustomerReference', 'AmendmentOrderReference', 'QuoteData', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderAmendmentQuote', 'uuid', 'store', 'customerReference', 'amendmentOrderReference', 'quoteData', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE, SpySalesOrderAmendmentQuoteTableMap::COL_UUID, SpySalesOrderAmendmentQuoteTableMap::COL_STORE, SpySalesOrderAmendmentQuoteTableMap::COL_CUSTOMER_REFERENCE, SpySalesOrderAmendmentQuoteTableMap::COL_AMENDMENT_ORDER_REFERENCE, SpySalesOrderAmendmentQuoteTableMap::COL_QUOTE_DATA, SpySalesOrderAmendmentQuoteTableMap::COL_CREATED_AT, SpySalesOrderAmendmentQuoteTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_amendment_quote', 'uuid', 'store', 'customer_reference', 'amendment_order_reference', 'quote_data', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdSalesOrderAmendmentQuote' => 0, 'Uuid' => 1, 'Store' => 2, 'CustomerReference' => 3, 'AmendmentOrderReference' => 4, 'QuoteData' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderAmendmentQuote' => 0, 'uuid' => 1, 'store' => 2, 'customerReference' => 3, 'amendmentOrderReference' => 4, 'quoteData' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE => 0, SpySalesOrderAmendmentQuoteTableMap::COL_UUID => 1, SpySalesOrderAmendmentQuoteTableMap::COL_STORE => 2, SpySalesOrderAmendmentQuoteTableMap::COL_CUSTOMER_REFERENCE => 3, SpySalesOrderAmendmentQuoteTableMap::COL_AMENDMENT_ORDER_REFERENCE => 4, SpySalesOrderAmendmentQuoteTableMap::COL_QUOTE_DATA => 5, SpySalesOrderAmendmentQuoteTableMap::COL_CREATED_AT => 6, SpySalesOrderAmendmentQuoteTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_amendment_quote' => 0, 'uuid' => 1, 'store' => 2, 'customer_reference' => 3, 'amendment_order_reference' => 4, 'quote_data' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderAmendmentQuote' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'SpySalesOrderAmendmentQuote.IdSalesOrderAmendmentQuote' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'idSalesOrderAmendmentQuote' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'spySalesOrderAmendmentQuote.idSalesOrderAmendmentQuote' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'COL_ID_SALES_ORDER_AMENDMENT_QUOTE' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'id_sales_order_amendment_quote' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'spy_sales_order_amendment_quote.id_sales_order_amendment_quote' => 'ID_SALES_ORDER_AMENDMENT_QUOTE',
        'Uuid' => 'UUID',
        'SpySalesOrderAmendmentQuote.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spySalesOrderAmendmentQuote.uuid' => 'UUID',
        'SpySalesOrderAmendmentQuoteTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_sales_order_amendment_quote.uuid' => 'UUID',
        'Store' => 'STORE',
        'SpySalesOrderAmendmentQuote.Store' => 'STORE',
        'store' => 'STORE',
        'spySalesOrderAmendmentQuote.store' => 'STORE',
        'SpySalesOrderAmendmentQuoteTableMap::COL_STORE' => 'STORE',
        'COL_STORE' => 'STORE',
        'spy_sales_order_amendment_quote.store' => 'STORE',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpySalesOrderAmendmentQuote.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spySalesOrderAmendmentQuote.customerReference' => 'CUSTOMER_REFERENCE',
        'SpySalesOrderAmendmentQuoteTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_sales_order_amendment_quote.customer_reference' => 'CUSTOMER_REFERENCE',
        'AmendmentOrderReference' => 'AMENDMENT_ORDER_REFERENCE',
        'SpySalesOrderAmendmentQuote.AmendmentOrderReference' => 'AMENDMENT_ORDER_REFERENCE',
        'amendmentOrderReference' => 'AMENDMENT_ORDER_REFERENCE',
        'spySalesOrderAmendmentQuote.amendmentOrderReference' => 'AMENDMENT_ORDER_REFERENCE',
        'SpySalesOrderAmendmentQuoteTableMap::COL_AMENDMENT_ORDER_REFERENCE' => 'AMENDMENT_ORDER_REFERENCE',
        'COL_AMENDMENT_ORDER_REFERENCE' => 'AMENDMENT_ORDER_REFERENCE',
        'amendment_order_reference' => 'AMENDMENT_ORDER_REFERENCE',
        'spy_sales_order_amendment_quote.amendment_order_reference' => 'AMENDMENT_ORDER_REFERENCE',
        'QuoteData' => 'QUOTE_DATA',
        'SpySalesOrderAmendmentQuote.QuoteData' => 'QUOTE_DATA',
        'quoteData' => 'QUOTE_DATA',
        'spySalesOrderAmendmentQuote.quoteData' => 'QUOTE_DATA',
        'SpySalesOrderAmendmentQuoteTableMap::COL_QUOTE_DATA' => 'QUOTE_DATA',
        'COL_QUOTE_DATA' => 'QUOTE_DATA',
        'quote_data' => 'QUOTE_DATA',
        'spy_sales_order_amendment_quote.quote_data' => 'QUOTE_DATA',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderAmendmentQuote.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderAmendmentQuote.createdAt' => 'CREATED_AT',
        'SpySalesOrderAmendmentQuoteTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_amendment_quote.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderAmendmentQuote.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderAmendmentQuote.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderAmendmentQuoteTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_amendment_quote.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_amendment_quote');
        $this->setPhpName('SpySalesOrderAmendmentQuote');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesOrderAmendment\\Persistence\\SpySalesOrderAmendmentQuote');
        $this->setPackage('src.Orm.Zed.SalesOrderAmendment.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_amendment_quote_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_amendment_quote', 'IdSalesOrderAmendmentQuote', 'INTEGER', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addColumn('store', 'Store', 'VARCHAR', false, 255, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', true, 255, null);
        $this->addColumn('amendment_order_reference', 'AmendmentOrderReference', 'VARCHAR', true, 255, null);
        $this->addColumn('quote_data', 'QuoteData', 'CLOB', true, null, null);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_sales_order_amendment_quote'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderAmendmentQuote', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderAmendmentQuoteTableMap::CLASS_DEFAULT : SpySalesOrderAmendmentQuoteTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderAmendmentQuote object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderAmendmentQuoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderAmendmentQuoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderAmendmentQuoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderAmendmentQuoteTableMap::OM_CLASS;
            /** @var SpySalesOrderAmendmentQuote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderAmendmentQuoteTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderAmendmentQuoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderAmendmentQuoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderAmendmentQuote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderAmendmentQuoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_UUID);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_STORE);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_AMENDMENT_ORDER_REFERENCE);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_QUOTE_DATA);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_amendment_quote');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.store');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.amendment_order_reference');
            $criteria->addSelectColumn($alias . '.quote_data');
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
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_STORE);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_AMENDMENT_ORDER_REFERENCE);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_QUOTE_DATA);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderAmendmentQuoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_amendment_quote');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.store');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.amendment_order_reference');
            $criteria->removeSelectColumn($alias . '.quote_data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderAmendmentQuoteTableMap::DATABASE_NAME)->getTable(SpySalesOrderAmendmentQuoteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderAmendmentQuote or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderAmendmentQuote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAmendmentQuoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesOrderAmendment\Persistence\SpySalesOrderAmendmentQuote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderAmendmentQuoteTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderAmendmentQuoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderAmendmentQuoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderAmendmentQuoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_amendment_quote table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderAmendmentQuoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderAmendmentQuote or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderAmendmentQuote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAmendmentQuoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderAmendmentQuote object
        }

        if ($criteria->containsKey(SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE) && $criteria->keyContainsValue(SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderAmendmentQuoteTableMap::COL_ID_SALES_ORDER_AMENDMENT_QUOTE.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderAmendmentQuoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
