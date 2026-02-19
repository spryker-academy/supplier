<?php

namespace Orm\Zed\SalesReturnSearch\Persistence\Map;

use Orm\Zed\SalesReturnSearch\Persistence\SpySalesReturnReasonSearch;
use Orm\Zed\SalesReturnSearch\Persistence\SpySalesReturnReasonSearchQuery;
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
 * This class defines the structure of the 'spy_sales_return_reason_search' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesReturnReasonSearchTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesReturnSearch.Persistence.Map.SpySalesReturnReasonSearchTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_return_reason_search';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesReturnReasonSearch';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesReturnSearch\\Persistence\\SpySalesReturnReasonSearch';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesReturnSearch.Persistence.SpySalesReturnReasonSearch';

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
     * the column name for the id_sales_return_reason_search field
     */
    public const COL_ID_SALES_RETURN_REASON_SEARCH = 'spy_sales_return_reason_search.id_sales_return_reason_search';

    /**
     * the column name for the fk_sales_return_reason field
     */
    public const COL_FK_SALES_RETURN_REASON = 'spy_sales_return_reason_search.fk_sales_return_reason';

    /**
     * the column name for the structured_data field
     */
    public const COL_STRUCTURED_DATA = 'spy_sales_return_reason_search.structured_data';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_sales_return_reason_search.data';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_sales_return_reason_search.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_sales_return_reason_search.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_sales_return_reason_search.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_return_reason_search.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_return_reason_search.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesReturnReasonSearch', 'FkSalesReturnReason', 'StructuredData', 'Data', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesReturnReasonSearch', 'fkSalesReturnReason', 'structuredData', 'data', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH, SpySalesReturnReasonSearchTableMap::COL_FK_SALES_RETURN_REASON, SpySalesReturnReasonSearchTableMap::COL_STRUCTURED_DATA, SpySalesReturnReasonSearchTableMap::COL_DATA, SpySalesReturnReasonSearchTableMap::COL_LOCALE, SpySalesReturnReasonSearchTableMap::COL_ALIAS_KEYS, SpySalesReturnReasonSearchTableMap::COL_KEY, SpySalesReturnReasonSearchTableMap::COL_CREATED_AT, SpySalesReturnReasonSearchTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_return_reason_search', 'fk_sales_return_reason', 'structured_data', 'data', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesReturnReasonSearch' => 0, 'FkSalesReturnReason' => 1, 'StructuredData' => 2, 'Data' => 3, 'Locale' => 4, 'AliasKeys' => 5, 'Key' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idSalesReturnReasonSearch' => 0, 'fkSalesReturnReason' => 1, 'structuredData' => 2, 'data' => 3, 'locale' => 4, 'aliasKeys' => 5, 'key' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH => 0, SpySalesReturnReasonSearchTableMap::COL_FK_SALES_RETURN_REASON => 1, SpySalesReturnReasonSearchTableMap::COL_STRUCTURED_DATA => 2, SpySalesReturnReasonSearchTableMap::COL_DATA => 3, SpySalesReturnReasonSearchTableMap::COL_LOCALE => 4, SpySalesReturnReasonSearchTableMap::COL_ALIAS_KEYS => 5, SpySalesReturnReasonSearchTableMap::COL_KEY => 6, SpySalesReturnReasonSearchTableMap::COL_CREATED_AT => 7, SpySalesReturnReasonSearchTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_sales_return_reason_search' => 0, 'fk_sales_return_reason' => 1, 'structured_data' => 2, 'data' => 3, 'locale' => 4, 'alias_keys' => 5, 'key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesReturnReasonSearch' => 'ID_SALES_RETURN_REASON_SEARCH',
        'SpySalesReturnReasonSearch.IdSalesReturnReasonSearch' => 'ID_SALES_RETURN_REASON_SEARCH',
        'idSalesReturnReasonSearch' => 'ID_SALES_RETURN_REASON_SEARCH',
        'spySalesReturnReasonSearch.idSalesReturnReasonSearch' => 'ID_SALES_RETURN_REASON_SEARCH',
        'SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH' => 'ID_SALES_RETURN_REASON_SEARCH',
        'COL_ID_SALES_RETURN_REASON_SEARCH' => 'ID_SALES_RETURN_REASON_SEARCH',
        'id_sales_return_reason_search' => 'ID_SALES_RETURN_REASON_SEARCH',
        'spy_sales_return_reason_search.id_sales_return_reason_search' => 'ID_SALES_RETURN_REASON_SEARCH',
        'FkSalesReturnReason' => 'FK_SALES_RETURN_REASON',
        'SpySalesReturnReasonSearch.FkSalesReturnReason' => 'FK_SALES_RETURN_REASON',
        'fkSalesReturnReason' => 'FK_SALES_RETURN_REASON',
        'spySalesReturnReasonSearch.fkSalesReturnReason' => 'FK_SALES_RETURN_REASON',
        'SpySalesReturnReasonSearchTableMap::COL_FK_SALES_RETURN_REASON' => 'FK_SALES_RETURN_REASON',
        'COL_FK_SALES_RETURN_REASON' => 'FK_SALES_RETURN_REASON',
        'fk_sales_return_reason' => 'FK_SALES_RETURN_REASON',
        'spy_sales_return_reason_search.fk_sales_return_reason' => 'FK_SALES_RETURN_REASON',
        'StructuredData' => 'STRUCTURED_DATA',
        'SpySalesReturnReasonSearch.StructuredData' => 'STRUCTURED_DATA',
        'structuredData' => 'STRUCTURED_DATA',
        'spySalesReturnReasonSearch.structuredData' => 'STRUCTURED_DATA',
        'SpySalesReturnReasonSearchTableMap::COL_STRUCTURED_DATA' => 'STRUCTURED_DATA',
        'COL_STRUCTURED_DATA' => 'STRUCTURED_DATA',
        'structured_data' => 'STRUCTURED_DATA',
        'spy_sales_return_reason_search.structured_data' => 'STRUCTURED_DATA',
        'Data' => 'DATA',
        'SpySalesReturnReasonSearch.Data' => 'DATA',
        'data' => 'DATA',
        'spySalesReturnReasonSearch.data' => 'DATA',
        'SpySalesReturnReasonSearchTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_sales_return_reason_search.data' => 'DATA',
        'Locale' => 'LOCALE',
        'SpySalesReturnReasonSearch.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spySalesReturnReasonSearch.locale' => 'LOCALE',
        'SpySalesReturnReasonSearchTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_sales_return_reason_search.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpySalesReturnReasonSearch.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spySalesReturnReasonSearch.aliasKeys' => 'ALIAS_KEYS',
        'SpySalesReturnReasonSearchTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_sales_return_reason_search.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpySalesReturnReasonSearch.Key' => 'KEY',
        'key' => 'KEY',
        'spySalesReturnReasonSearch.key' => 'KEY',
        'SpySalesReturnReasonSearchTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_sales_return_reason_search.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesReturnReasonSearch.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesReturnReasonSearch.createdAt' => 'CREATED_AT',
        'SpySalesReturnReasonSearchTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_return_reason_search.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesReturnReasonSearch.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesReturnReasonSearch.updatedAt' => 'UPDATED_AT',
        'SpySalesReturnReasonSearchTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_return_reason_search.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_return_reason_search');
        $this->setPhpName('SpySalesReturnReasonSearch');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\SalesReturnSearch\\Persistence\\SpySalesReturnReasonSearch');
        $this->setPackage('src.Orm.Zed.SalesReturnSearch.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_return_reason_search_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_return_reason_search', 'IdSalesReturnReasonSearch', 'BIGINT', true, null, null);
        $this->addColumn('fk_sales_return_reason', 'FkSalesReturnReason', 'INTEGER', true, null, null);
        $this->addColumn('structured_data', 'StructuredData', 'LONGVARCHAR', true, null, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
        $this->addColumn('locale', 'Locale', 'VARCHAR', true, 16, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'return_reason'], 'queue_group' => ['value' => 'sync.search.return'], 'queue_pool' => ['value' => 'synchronizationPool'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'fk_sales_return_reason'], 'params' => ['value' => '{"type":"return_reason"}']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdSalesReturnReasonSearch', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesReturnReasonSearchTableMap::CLASS_DEFAULT : SpySalesReturnReasonSearchTableMap::OM_CLASS;
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
     * @return array (SpySalesReturnReasonSearch object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesReturnReasonSearchTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesReturnReasonSearchTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesReturnReasonSearchTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesReturnReasonSearchTableMap::OM_CLASS;
            /** @var SpySalesReturnReasonSearch $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesReturnReasonSearchTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesReturnReasonSearchTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesReturnReasonSearchTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesReturnReasonSearch $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesReturnReasonSearchTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_FK_SALES_RETURN_REASON);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_STRUCTURED_DATA);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_DATA);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_KEY);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesReturnReasonSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_return_reason_search');
            $criteria->addSelectColumn($alias . '.fk_sales_return_reason');
            $criteria->addSelectColumn($alias . '.structured_data');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.locale');
            $criteria->addSelectColumn($alias . '.alias_keys');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_FK_SALES_RETURN_REASON);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_STRUCTURED_DATA);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesReturnReasonSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_return_reason_search');
            $criteria->removeSelectColumn($alias . '.fk_sales_return_reason');
            $criteria->removeSelectColumn($alias . '.structured_data');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.locale');
            $criteria->removeSelectColumn($alias . '.alias_keys');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesReturnReasonSearchTableMap::DATABASE_NAME)->getTable(SpySalesReturnReasonSearchTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesReturnReasonSearch or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesReturnReasonSearch object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesReturnReasonSearchTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesReturnSearch\Persistence\SpySalesReturnReasonSearch) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesReturnReasonSearchTableMap::DATABASE_NAME);
            $criteria->add(SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH, (array) $values, Criteria::IN);
        }

        $query = SpySalesReturnReasonSearchQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesReturnReasonSearchTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesReturnReasonSearchTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_return_reason_search table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesReturnReasonSearchQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesReturnReasonSearch or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesReturnReasonSearch object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesReturnReasonSearchTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesReturnReasonSearch object
        }

        if ($criteria->containsKey(SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH) && $criteria->keyContainsValue(SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesReturnReasonSearchTableMap::COL_ID_SALES_RETURN_REASON_SEARCH.')');
        }


        // Set the correct dbName
        $query = SpySalesReturnReasonSearchQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
