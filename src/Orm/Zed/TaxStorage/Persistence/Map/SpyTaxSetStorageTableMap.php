<?php

namespace Orm\Zed\TaxStorage\Persistence\Map;

use Orm\Zed\TaxStorage\Persistence\SpyTaxSetStorage;
use Orm\Zed\TaxStorage\Persistence\SpyTaxSetStorageQuery;
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
 * This class defines the structure of the 'spy_tax_set_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyTaxSetStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.TaxStorage.Persistence.Map.SpyTaxSetStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_tax_set_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyTaxSetStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\TaxStorage\\Persistence\\SpyTaxSetStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.TaxStorage.Persistence.SpyTaxSetStorage';

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
     * the column name for the id_tax_set_storage field
     */
    public const COL_ID_TAX_SET_STORAGE = 'spy_tax_set_storage.id_tax_set_storage';

    /**
     * the column name for the fk_tax_set field
     */
    public const COL_FK_TAX_SET = 'spy_tax_set_storage.fk_tax_set';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_tax_set_storage.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_tax_set_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_tax_set_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_tax_set_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_tax_set_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdTaxSetStorage', 'FkTaxSet', 'Data', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idTaxSetStorage', 'fkTaxSet', 'data', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE, SpyTaxSetStorageTableMap::COL_FK_TAX_SET, SpyTaxSetStorageTableMap::COL_DATA, SpyTaxSetStorageTableMap::COL_ALIAS_KEYS, SpyTaxSetStorageTableMap::COL_KEY, SpyTaxSetStorageTableMap::COL_CREATED_AT, SpyTaxSetStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_tax_set_storage', 'fk_tax_set', 'data', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdTaxSetStorage' => 0, 'FkTaxSet' => 1, 'Data' => 2, 'AliasKeys' => 3, 'Key' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idTaxSetStorage' => 0, 'fkTaxSet' => 1, 'data' => 2, 'aliasKeys' => 3, 'key' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE => 0, SpyTaxSetStorageTableMap::COL_FK_TAX_SET => 1, SpyTaxSetStorageTableMap::COL_DATA => 2, SpyTaxSetStorageTableMap::COL_ALIAS_KEYS => 3, SpyTaxSetStorageTableMap::COL_KEY => 4, SpyTaxSetStorageTableMap::COL_CREATED_AT => 5, SpyTaxSetStorageTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_tax_set_storage' => 0, 'fk_tax_set' => 1, 'data' => 2, 'alias_keys' => 3, 'key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdTaxSetStorage' => 'ID_TAX_SET_STORAGE',
        'SpyTaxSetStorage.IdTaxSetStorage' => 'ID_TAX_SET_STORAGE',
        'idTaxSetStorage' => 'ID_TAX_SET_STORAGE',
        'spyTaxSetStorage.idTaxSetStorage' => 'ID_TAX_SET_STORAGE',
        'SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE' => 'ID_TAX_SET_STORAGE',
        'COL_ID_TAX_SET_STORAGE' => 'ID_TAX_SET_STORAGE',
        'id_tax_set_storage' => 'ID_TAX_SET_STORAGE',
        'spy_tax_set_storage.id_tax_set_storage' => 'ID_TAX_SET_STORAGE',
        'FkTaxSet' => 'FK_TAX_SET',
        'SpyTaxSetStorage.FkTaxSet' => 'FK_TAX_SET',
        'fkTaxSet' => 'FK_TAX_SET',
        'spyTaxSetStorage.fkTaxSet' => 'FK_TAX_SET',
        'SpyTaxSetStorageTableMap::COL_FK_TAX_SET' => 'FK_TAX_SET',
        'COL_FK_TAX_SET' => 'FK_TAX_SET',
        'fk_tax_set' => 'FK_TAX_SET',
        'spy_tax_set_storage.fk_tax_set' => 'FK_TAX_SET',
        'Data' => 'DATA',
        'SpyTaxSetStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyTaxSetStorage.data' => 'DATA',
        'SpyTaxSetStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_tax_set_storage.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyTaxSetStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyTaxSetStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyTaxSetStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_tax_set_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyTaxSetStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyTaxSetStorage.key' => 'KEY',
        'SpyTaxSetStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_tax_set_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyTaxSetStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyTaxSetStorage.createdAt' => 'CREATED_AT',
        'SpyTaxSetStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_tax_set_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyTaxSetStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyTaxSetStorage.updatedAt' => 'UPDATED_AT',
        'SpyTaxSetStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_tax_set_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_tax_set_storage');
        $this->setPhpName('SpyTaxSetStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\TaxStorage\\Persistence\\SpyTaxSetStorage');
        $this->setPackage('src.Orm.Zed.TaxStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_tax_set_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_tax_set_storage', 'IdTaxSetStorage', 'INTEGER', true, null, null);
        $this->addColumn('fk_tax_set', 'FkTaxSet', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
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
            'synchronization' => ['resource' => ['value' => 'tax_set'], 'queue_group' => ['value' => 'sync.storage.tax_set'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'fk_tax_set']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdTaxSetStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyTaxSetStorageTableMap::CLASS_DEFAULT : SpyTaxSetStorageTableMap::OM_CLASS;
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
     * @return array (SpyTaxSetStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyTaxSetStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyTaxSetStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyTaxSetStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyTaxSetStorageTableMap::OM_CLASS;
            /** @var SpyTaxSetStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyTaxSetStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyTaxSetStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyTaxSetStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyTaxSetStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyTaxSetStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE);
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_FK_TAX_SET);
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyTaxSetStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_tax_set_storage');
            $criteria->addSelectColumn($alias . '.fk_tax_set');
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
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE);
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_FK_TAX_SET);
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyTaxSetStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_tax_set_storage');
            $criteria->removeSelectColumn($alias . '.fk_tax_set');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyTaxSetStorageTableMap::DATABASE_NAME)->getTable(SpyTaxSetStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyTaxSetStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyTaxSetStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxSetStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\TaxStorage\Persistence\SpyTaxSetStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyTaxSetStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyTaxSetStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyTaxSetStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyTaxSetStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_tax_set_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyTaxSetStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyTaxSetStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyTaxSetStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxSetStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyTaxSetStorage object
        }

        if ($criteria->containsKey(SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE) && $criteria->keyContainsValue(SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyTaxSetStorageTableMap::COL_ID_TAX_SET_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyTaxSetStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
