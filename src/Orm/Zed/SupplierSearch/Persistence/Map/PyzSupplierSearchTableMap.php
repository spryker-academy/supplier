<?php

namespace Orm\Zed\SupplierSearch\Persistence\Map;

use Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearch;
use Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearchQuery;
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
 * This class defines the structure of the 'pyz_supplier_search' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PyzSupplierSearchTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SupplierSearch.Persistence.Map.PyzSupplierSearchTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pyz_supplier_search';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PyzSupplierSearch';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SupplierSearch\\Persistence\\PyzSupplierSearch';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SupplierSearch.Persistence.PyzSupplierSearch';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_supplier_search field
     */
    public const COL_ID_SUPPLIER_SEARCH = 'pyz_supplier_search.id_supplier_search';

    /**
     * the column name for the fk_supplier field
     */
    public const COL_FK_SUPPLIER = 'pyz_supplier_search.fk_supplier';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'pyz_supplier_search.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'pyz_supplier_search.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'pyz_supplier_search.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'pyz_supplier_search.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'pyz_supplier_search.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSupplierSearch', 'FkSupplier', 'Data', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSupplierSearch', 'fkSupplier', 'data', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [PyzSupplierSearchTableMap::COL_ID_SUPPLIER_SEARCH, PyzSupplierSearchTableMap::COL_FK_SUPPLIER, PyzSupplierSearchTableMap::COL_DATA, PyzSupplierSearchTableMap::COL_ALIAS_KEYS, PyzSupplierSearchTableMap::COL_KEY, PyzSupplierSearchTableMap::COL_CREATED_AT, PyzSupplierSearchTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_supplier_search', 'fk_supplier', 'data', 'alias_keys', 'key', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdSupplierSearch' => 0, 'FkSupplier' => 1, 'Data' => 2, 'AliasKeys' => 3, 'Key' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idSupplierSearch' => 0, 'fkSupplier' => 1, 'data' => 2, 'aliasKeys' => 3, 'key' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [PyzSupplierSearchTableMap::COL_ID_SUPPLIER_SEARCH => 0, PyzSupplierSearchTableMap::COL_FK_SUPPLIER => 1, PyzSupplierSearchTableMap::COL_DATA => 2, PyzSupplierSearchTableMap::COL_ALIAS_KEYS => 3, PyzSupplierSearchTableMap::COL_KEY => 4, PyzSupplierSearchTableMap::COL_CREATED_AT => 5, PyzSupplierSearchTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_supplier_search' => 0, 'fk_supplier' => 1, 'data' => 2, 'alias_keys' => 3, 'key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSupplierSearch' => 'ID_SUPPLIER_SEARCH',
        'PyzSupplierSearch.IdSupplierSearch' => 'ID_SUPPLIER_SEARCH',
        'idSupplierSearch' => 'ID_SUPPLIER_SEARCH',
        'pyzSupplierSearch.idSupplierSearch' => 'ID_SUPPLIER_SEARCH',
        'PyzSupplierSearchTableMap::COL_ID_SUPPLIER_SEARCH' => 'ID_SUPPLIER_SEARCH',
        'COL_ID_SUPPLIER_SEARCH' => 'ID_SUPPLIER_SEARCH',
        'id_supplier_search' => 'ID_SUPPLIER_SEARCH',
        'pyz_supplier_search.id_supplier_search' => 'ID_SUPPLIER_SEARCH',
        'FkSupplier' => 'FK_SUPPLIER',
        'PyzSupplierSearch.FkSupplier' => 'FK_SUPPLIER',
        'fkSupplier' => 'FK_SUPPLIER',
        'pyzSupplierSearch.fkSupplier' => 'FK_SUPPLIER',
        'PyzSupplierSearchTableMap::COL_FK_SUPPLIER' => 'FK_SUPPLIER',
        'COL_FK_SUPPLIER' => 'FK_SUPPLIER',
        'fk_supplier' => 'FK_SUPPLIER',
        'pyz_supplier_search.fk_supplier' => 'FK_SUPPLIER',
        'Data' => 'DATA',
        'PyzSupplierSearch.Data' => 'DATA',
        'data' => 'DATA',
        'pyzSupplierSearch.data' => 'DATA',
        'PyzSupplierSearchTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'pyz_supplier_search.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'PyzSupplierSearch.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'pyzSupplierSearch.aliasKeys' => 'ALIAS_KEYS',
        'PyzSupplierSearchTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'pyz_supplier_search.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'PyzSupplierSearch.Key' => 'KEY',
        'key' => 'KEY',
        'pyzSupplierSearch.key' => 'KEY',
        'PyzSupplierSearchTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'pyz_supplier_search.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'PyzSupplierSearch.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'pyzSupplierSearch.createdAt' => 'CREATED_AT',
        'PyzSupplierSearchTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'pyz_supplier_search.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'PyzSupplierSearch.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'pyzSupplierSearch.updatedAt' => 'UPDATED_AT',
        'PyzSupplierSearchTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'pyz_supplier_search.updated_at' => 'UPDATED_AT',
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
        $this->setName('pyz_supplier_search');
        $this->setPhpName('PyzSupplierSearch');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\SupplierSearch\\Persistence\\PyzSupplierSearch');
        $this->setPackage('src.Orm.Zed.SupplierSearch.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('pyz_supplier_search_pk_seq');
        // columns
        $this->addPrimaryKey('id_supplier_search', 'IdSupplierSearch', 'BIGINT', true, null, null);
        $this->addColumn('fk_supplier', 'FkSupplier', 'INTEGER', true, null, null);
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
            'synchronization' => ['resource' => ['value' => 'supplier'], 'queue_group' => ['value' => 'sync.search.supplier'], 'queue_pool' => NULL, 'key_suffix_column' => ['value' => 'fk_supplier'], 'params' => ['value' => '{"type":"supplier"}']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSupplierSearch', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PyzSupplierSearchTableMap::CLASS_DEFAULT : PyzSupplierSearchTableMap::OM_CLASS;
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
     * @return array (PyzSupplierSearch object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PyzSupplierSearchTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PyzSupplierSearchTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PyzSupplierSearchTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PyzSupplierSearchTableMap::OM_CLASS;
            /** @var PyzSupplierSearch $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PyzSupplierSearchTableMap::addInstanceToPool($obj, $key);
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
            $key = PyzSupplierSearchTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PyzSupplierSearchTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PyzSupplierSearch $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PyzSupplierSearchTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_ID_SUPPLIER_SEARCH);
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_FK_SUPPLIER);
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_DATA);
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_KEY);
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PyzSupplierSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_supplier_search');
            $criteria->addSelectColumn($alias . '.fk_supplier');
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
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_ID_SUPPLIER_SEARCH);
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_FK_SUPPLIER);
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_DATA);
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_KEY);
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PyzSupplierSearchTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_supplier_search');
            $criteria->removeSelectColumn($alias . '.fk_supplier');
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
        return Propel::getServiceContainer()->getDatabaseMap(PyzSupplierSearchTableMap::DATABASE_NAME)->getTable(PyzSupplierSearchTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PyzSupplierSearch or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PyzSupplierSearch object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierSearchTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearch) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PyzSupplierSearchTableMap::DATABASE_NAME);
            $criteria->add(PyzSupplierSearchTableMap::COL_ID_SUPPLIER_SEARCH, (array) $values, Criteria::IN);
        }

        $query = PyzSupplierSearchQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PyzSupplierSearchTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PyzSupplierSearchTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pyz_supplier_search table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PyzSupplierSearchQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PyzSupplierSearch or Criteria object.
     *
     * @param mixed $criteria Criteria or PyzSupplierSearch object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierSearchTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PyzSupplierSearch object
        }


        // Set the correct dbName
        $query = PyzSupplierSearchQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
