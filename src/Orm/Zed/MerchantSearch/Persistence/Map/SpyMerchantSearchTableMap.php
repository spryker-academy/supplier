<?php

namespace Orm\Zed\MerchantSearch\Persistence\Map;

use Orm\Zed\MerchantSearch\Persistence\SpyMerchantSearch;
use Orm\Zed\MerchantSearch\Persistence\SpyMerchantSearchQuery;
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
 * This class defines the structure of the 'spy_merchant_search' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantSearchTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantSearch.Persistence.Map.SpyMerchantSearchTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_search';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantSearch';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantSearch\\Persistence\\SpyMerchantSearch';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantSearch.Persistence.SpyMerchantSearch';

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
     * the column name for the id_merchant_search field
     */
    public const COL_ID_MERCHANT_SEARCH = 'spy_merchant_search.id_merchant_search';

    /**
     * the column name for the fk_merchant field
     */
    public const COL_FK_MERCHANT = 'spy_merchant_search.fk_merchant';

    /**
     * the column name for the structured_data field
     */
    public const COL_STRUCTURED_DATA = 'spy_merchant_search.structured_data';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_merchant_search.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_merchant_search.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_merchant_search.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_search.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_search.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchantSearch', 'FkMerchant', 'StructuredData', 'Data', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantSearch', 'fkMerchant', 'structuredData', 'data', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH, SpyMerchantSearchTableMap::COL_FK_MERCHANT, SpyMerchantSearchTableMap::COL_STRUCTURED_DATA, SpyMerchantSearchTableMap::COL_DATA, SpyMerchantSearchTableMap::COL_ALIAS_KEYS, SpyMerchantSearchTableMap::COL_KEY, SpyMerchantSearchTableMap::COL_CREATED_AT, SpyMerchantSearchTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_search', 'fk_merchant', 'structured_data', 'data', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantSearch' => 0, 'FkMerchant' => 1, 'StructuredData' => 2, 'Data' => 3, 'AliasKeys' => 4, 'Key' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idMerchantSearch' => 0, 'fkMerchant' => 1, 'structuredData' => 2, 'data' => 3, 'aliasKeys' => 4, 'key' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH => 0, SpyMerchantSearchTableMap::COL_FK_MERCHANT => 1, SpyMerchantSearchTableMap::COL_STRUCTURED_DATA => 2, SpyMerchantSearchTableMap::COL_DATA => 3, SpyMerchantSearchTableMap::COL_ALIAS_KEYS => 4, SpyMerchantSearchTableMap::COL_KEY => 5, SpyMerchantSearchTableMap::COL_CREATED_AT => 6, SpyMerchantSearchTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_merchant_search' => 0, 'fk_merchant' => 1, 'structured_data' => 2, 'data' => 3, 'alias_keys' => 4, 'key' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantSearch' => 'ID_MERCHANT_SEARCH',
        'SpyMerchantSearch.IdMerchantSearch' => 'ID_MERCHANT_SEARCH',
        'idMerchantSearch' => 'ID_MERCHANT_SEARCH',
        'spyMerchantSearch.idMerchantSearch' => 'ID_MERCHANT_SEARCH',
        'SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH' => 'ID_MERCHANT_SEARCH',
        'COL_ID_MERCHANT_SEARCH' => 'ID_MERCHANT_SEARCH',
        'id_merchant_search' => 'ID_MERCHANT_SEARCH',
        'spy_merchant_search.id_merchant_search' => 'ID_MERCHANT_SEARCH',
        'FkMerchant' => 'FK_MERCHANT',
        'SpyMerchantSearch.FkMerchant' => 'FK_MERCHANT',
        'fkMerchant' => 'FK_MERCHANT',
        'spyMerchantSearch.fkMerchant' => 'FK_MERCHANT',
        'SpyMerchantSearchTableMap::COL_FK_MERCHANT' => 'FK_MERCHANT',
        'COL_FK_MERCHANT' => 'FK_MERCHANT',
        'fk_merchant' => 'FK_MERCHANT',
        'spy_merchant_search.fk_merchant' => 'FK_MERCHANT',
        'StructuredData' => 'STRUCTURED_DATA',
        'SpyMerchantSearch.StructuredData' => 'STRUCTURED_DATA',
        'structuredData' => 'STRUCTURED_DATA',
        'spyMerchantSearch.structuredData' => 'STRUCTURED_DATA',
        'SpyMerchantSearchTableMap::COL_STRUCTURED_DATA' => 'STRUCTURED_DATA',
        'COL_STRUCTURED_DATA' => 'STRUCTURED_DATA',
        'structured_data' => 'STRUCTURED_DATA',
        'spy_merchant_search.structured_data' => 'STRUCTURED_DATA',
        'Data' => 'DATA',
        'SpyMerchantSearch.Data' => 'DATA',
        'data' => 'DATA',
        'spyMerchantSearch.data' => 'DATA',
        'SpyMerchantSearchTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_merchant_search.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyMerchantSearch.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyMerchantSearch.aliasKeys' => 'ALIAS_KEYS',
        'SpyMerchantSearchTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_merchant_search.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyMerchantSearch.Key' => 'KEY',
        'key' => 'KEY',
        'spyMerchantSearch.key' => 'KEY',
        'SpyMerchantSearchTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_merchant_search.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantSearch.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantSearch.createdAt' => 'CREATED_AT',
        'SpyMerchantSearchTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_search.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantSearch.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantSearch.updatedAt' => 'UPDATED_AT',
        'SpyMerchantSearchTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_search.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant_search');
        $this->setPhpName('SpyMerchantSearch');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\MerchantSearch\\Persistence\\SpyMerchantSearch');
        $this->setPackage('src.Orm.Zed.MerchantSearch.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_search_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_search', 'IdMerchantSearch', 'BIGINT', true, null, null);
        $this->addColumn('fk_merchant', 'FkMerchant', 'INTEGER', true, null, null);
        $this->addColumn('structured_data', 'StructuredData', 'LONGVARCHAR', true, null, null);
        $this->addColumn('data', 'Data', 'CLOB', false, null, null);
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
            'synchronization' => ['resource' => ['value' => 'merchant'], 'queue_group' => ['value' => 'sync.search.merchant'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'fk_merchant'], 'params' => ['value' => '{"type":"merchant"}']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantSearch', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantSearchTableMap::CLASS_DEFAULT : SpyMerchantSearchTableMap::OM_CLASS;
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
     * @return array (SpyMerchantSearch object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantSearchTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantSearchTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantSearchTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantSearchTableMap::OM_CLASS;
            /** @var SpyMerchantSearch $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantSearchTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantSearchTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantSearchTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantSearch $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantSearchTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_FK_MERCHANT);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_STRUCTURED_DATA);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_search');
            $criteria->addSelectColumn($alias . '.fk_merchant');
            $criteria->addSelectColumn($alias . '.structured_data');
            $criteria->addSelectColumn($alias . '.data');
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
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_FK_MERCHANT);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_STRUCTURED_DATA);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_search');
            $criteria->removeSelectColumn($alias . '.fk_merchant');
            $criteria->removeSelectColumn($alias . '.structured_data');
            $criteria->removeSelectColumn($alias . '.data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantSearchTableMap::DATABASE_NAME)->getTable(SpyMerchantSearchTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantSearch or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantSearch object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSearchTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantSearch\Persistence\SpyMerchantSearch) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantSearchTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantSearchQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantSearchTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantSearchTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_search table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantSearchQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantSearch or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantSearch object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantSearchTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantSearch object
        }

        if ($criteria->containsKey(SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH) && $criteria->keyContainsValue(SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantSearchTableMap::COL_ID_MERCHANT_SEARCH.')');
        }


        // Set the correct dbName
        $query = SpyMerchantSearchQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
