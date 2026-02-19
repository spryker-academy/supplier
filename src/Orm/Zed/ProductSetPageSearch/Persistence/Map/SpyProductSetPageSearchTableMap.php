<?php

namespace Orm\Zed\ProductSetPageSearch\Persistence\Map;

use Orm\Zed\ProductSetPageSearch\Persistence\SpyProductSetPageSearch;
use Orm\Zed\ProductSetPageSearch\Persistence\SpyProductSetPageSearchQuery;
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
 * This class defines the structure of the 'spy_product_set_page_search' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductSetPageSearchTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductSetPageSearch.Persistence.Map.SpyProductSetPageSearchTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_set_page_search';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductSetPageSearch';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductSetPageSearch\\Persistence\\SpyProductSetPageSearch';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductSetPageSearch.Persistence.SpyProductSetPageSearch';

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
     * the column name for the id_product_set_page_search field
     */
    public const COL_ID_PRODUCT_SET_PAGE_SEARCH = 'spy_product_set_page_search.id_product_set_page_search';

    /**
     * the column name for the fk_product_set field
     */
    public const COL_FK_PRODUCT_SET = 'spy_product_set_page_search.fk_product_set';

    /**
     * the column name for the structured_data field
     */
    public const COL_STRUCTURED_DATA = 'spy_product_set_page_search.structured_data';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_product_set_page_search.data';

    /**
     * the column name for the locale field
     */
    public const COL_LOCALE = 'spy_product_set_page_search.locale';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_product_set_page_search.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_set_page_search.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_set_page_search.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_set_page_search.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductSetPageSearch', 'FkProductSet', 'StructuredData', 'Data', 'Locale', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductSetPageSearch', 'fkProductSet', 'structuredData', 'data', 'locale', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH, SpyProductSetPageSearchTableMap::COL_FK_PRODUCT_SET, SpyProductSetPageSearchTableMap::COL_STRUCTURED_DATA, SpyProductSetPageSearchTableMap::COL_DATA, SpyProductSetPageSearchTableMap::COL_LOCALE, SpyProductSetPageSearchTableMap::COL_ALIAS_KEYS, SpyProductSetPageSearchTableMap::COL_KEY, SpyProductSetPageSearchTableMap::COL_CREATED_AT, SpyProductSetPageSearchTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_set_page_search', 'fk_product_set', 'structured_data', 'data', 'locale', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductSetPageSearch' => 0, 'FkProductSet' => 1, 'StructuredData' => 2, 'Data' => 3, 'Locale' => 4, 'AliasKeys' => 5, 'Key' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idProductSetPageSearch' => 0, 'fkProductSet' => 1, 'structuredData' => 2, 'data' => 3, 'locale' => 4, 'aliasKeys' => 5, 'key' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH => 0, SpyProductSetPageSearchTableMap::COL_FK_PRODUCT_SET => 1, SpyProductSetPageSearchTableMap::COL_STRUCTURED_DATA => 2, SpyProductSetPageSearchTableMap::COL_DATA => 3, SpyProductSetPageSearchTableMap::COL_LOCALE => 4, SpyProductSetPageSearchTableMap::COL_ALIAS_KEYS => 5, SpyProductSetPageSearchTableMap::COL_KEY => 6, SpyProductSetPageSearchTableMap::COL_CREATED_AT => 7, SpyProductSetPageSearchTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_product_set_page_search' => 0, 'fk_product_set' => 1, 'structured_data' => 2, 'data' => 3, 'locale' => 4, 'alias_keys' => 5, 'key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductSetPageSearch' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'SpyProductSetPageSearch.IdProductSetPageSearch' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'idProductSetPageSearch' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'spyProductSetPageSearch.idProductSetPageSearch' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'COL_ID_PRODUCT_SET_PAGE_SEARCH' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'id_product_set_page_search' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'spy_product_set_page_search.id_product_set_page_search' => 'ID_PRODUCT_SET_PAGE_SEARCH',
        'FkProductSet' => 'FK_PRODUCT_SET',
        'SpyProductSetPageSearch.FkProductSet' => 'FK_PRODUCT_SET',
        'fkProductSet' => 'FK_PRODUCT_SET',
        'spyProductSetPageSearch.fkProductSet' => 'FK_PRODUCT_SET',
        'SpyProductSetPageSearchTableMap::COL_FK_PRODUCT_SET' => 'FK_PRODUCT_SET',
        'COL_FK_PRODUCT_SET' => 'FK_PRODUCT_SET',
        'fk_product_set' => 'FK_PRODUCT_SET',
        'spy_product_set_page_search.fk_product_set' => 'FK_PRODUCT_SET',
        'StructuredData' => 'STRUCTURED_DATA',
        'SpyProductSetPageSearch.StructuredData' => 'STRUCTURED_DATA',
        'structuredData' => 'STRUCTURED_DATA',
        'spyProductSetPageSearch.structuredData' => 'STRUCTURED_DATA',
        'SpyProductSetPageSearchTableMap::COL_STRUCTURED_DATA' => 'STRUCTURED_DATA',
        'COL_STRUCTURED_DATA' => 'STRUCTURED_DATA',
        'structured_data' => 'STRUCTURED_DATA',
        'spy_product_set_page_search.structured_data' => 'STRUCTURED_DATA',
        'Data' => 'DATA',
        'SpyProductSetPageSearch.Data' => 'DATA',
        'data' => 'DATA',
        'spyProductSetPageSearch.data' => 'DATA',
        'SpyProductSetPageSearchTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_product_set_page_search.data' => 'DATA',
        'Locale' => 'LOCALE',
        'SpyProductSetPageSearch.Locale' => 'LOCALE',
        'locale' => 'LOCALE',
        'spyProductSetPageSearch.locale' => 'LOCALE',
        'SpyProductSetPageSearchTableMap::COL_LOCALE' => 'LOCALE',
        'COL_LOCALE' => 'LOCALE',
        'spy_product_set_page_search.locale' => 'LOCALE',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyProductSetPageSearch.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyProductSetPageSearch.aliasKeys' => 'ALIAS_KEYS',
        'SpyProductSetPageSearchTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_product_set_page_search.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyProductSetPageSearch.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductSetPageSearch.key' => 'KEY',
        'SpyProductSetPageSearchTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_set_page_search.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductSetPageSearch.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductSetPageSearch.createdAt' => 'CREATED_AT',
        'SpyProductSetPageSearchTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_set_page_search.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductSetPageSearch.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductSetPageSearch.updatedAt' => 'UPDATED_AT',
        'SpyProductSetPageSearchTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_set_page_search.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_set_page_search');
        $this->setPhpName('SpyProductSetPageSearch');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductSetPageSearch\\Persistence\\SpyProductSetPageSearch');
        $this->setPackage('src.Orm.Zed.ProductSetPageSearch.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_set_page_search_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_set_page_search', 'IdProductSetPageSearch', 'BIGINT', true, null, null);
        $this->addColumn('fk_product_set', 'FkProductSet', 'INTEGER', true, null, null);
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
            'synchronization' => ['resource' => ['value' => 'product_set'], 'queue_group' => ['value' => 'sync.search.product'], 'queue_pool' => ['value' => 'synchronizationPool'], 'locale' => ['required' => 'true'], 'key_suffix_column' => ['value' => 'fk_product_set'], 'params' => ['value' => '{"type":"page"}']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductSetPageSearch', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductSetPageSearchTableMap::CLASS_DEFAULT : SpyProductSetPageSearchTableMap::OM_CLASS;
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
     * @return array (SpyProductSetPageSearch object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductSetPageSearchTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductSetPageSearchTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductSetPageSearchTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductSetPageSearchTableMap::OM_CLASS;
            /** @var SpyProductSetPageSearch $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductSetPageSearchTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductSetPageSearchTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductSetPageSearchTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductSetPageSearch $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductSetPageSearchTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_FK_PRODUCT_SET);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_STRUCTURED_DATA);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_LOCALE);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductSetPageSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_set_page_search');
            $criteria->addSelectColumn($alias . '.fk_product_set');
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
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_FK_PRODUCT_SET);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_STRUCTURED_DATA);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_LOCALE);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductSetPageSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_set_page_search');
            $criteria->removeSelectColumn($alias . '.fk_product_set');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductSetPageSearchTableMap::DATABASE_NAME)->getTable(SpyProductSetPageSearchTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductSetPageSearch or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductSetPageSearch object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSetPageSearchTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductSetPageSearch\Persistence\SpyProductSetPageSearch) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductSetPageSearchTableMap::DATABASE_NAME);
            $criteria->add(SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH, (array) $values, Criteria::IN);
        }

        $query = SpyProductSetPageSearchQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductSetPageSearchTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductSetPageSearchTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_set_page_search table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductSetPageSearchQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductSetPageSearch or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductSetPageSearch object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSetPageSearchTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductSetPageSearch object
        }

        if ($criteria->containsKey(SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH) && $criteria->keyContainsValue(SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductSetPageSearchTableMap::COL_ID_PRODUCT_SET_PAGE_SEARCH.')');
        }


        // Set the correct dbName
        $query = SpyProductSetPageSearchQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
