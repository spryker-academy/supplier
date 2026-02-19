<?php

namespace Orm\Zed\CmsSlotStorage\Persistence\Map;

use Orm\Zed\CmsSlotStorage\Persistence\SpyCmsSlotStorage;
use Orm\Zed\CmsSlotStorage\Persistence\SpyCmsSlotStorageQuery;
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
 * This class defines the structure of the 'spy_cms_slot_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsSlotStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsSlotStorage.Persistence.Map.SpyCmsSlotStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_slot_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsSlotStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsSlotStorage\\Persistence\\SpyCmsSlotStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsSlotStorage.Persistence.SpyCmsSlotStorage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_cms_slot_storage field
     */
    public const COL_ID_CMS_SLOT_STORAGE = 'spy_cms_slot_storage.id_cms_slot_storage';

    /**
     * the column name for the cms_slot_key field
     */
    public const COL_CMS_SLOT_KEY = 'spy_cms_slot_storage.cms_slot_key';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_cms_slot_storage.data';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_cms_slot_storage.key';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_cms_slot_storage.alias_keys';

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
        self::TYPE_PHPNAME       => ['IdCmsSlotStorage', 'CmsSlotKey', 'Data', 'Key', 'AliasKeys', ],
        self::TYPE_CAMELNAME     => ['idCmsSlotStorage', 'cmsSlotKey', 'data', 'key', 'aliasKeys', ],
        self::TYPE_COLNAME       => [SpyCmsSlotStorageTableMap::COL_ID_CMS_SLOT_STORAGE, SpyCmsSlotStorageTableMap::COL_CMS_SLOT_KEY, SpyCmsSlotStorageTableMap::COL_DATA, SpyCmsSlotStorageTableMap::COL_KEY, SpyCmsSlotStorageTableMap::COL_ALIAS_KEYS, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot_storage', 'cms_slot_key', 'data', 'key', 'alias_keys', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['IdCmsSlotStorage' => 0, 'CmsSlotKey' => 1, 'Data' => 2, 'Key' => 3, 'AliasKeys' => 4, ],
        self::TYPE_CAMELNAME     => ['idCmsSlotStorage' => 0, 'cmsSlotKey' => 1, 'data' => 2, 'key' => 3, 'aliasKeys' => 4, ],
        self::TYPE_COLNAME       => [SpyCmsSlotStorageTableMap::COL_ID_CMS_SLOT_STORAGE => 0, SpyCmsSlotStorageTableMap::COL_CMS_SLOT_KEY => 1, SpyCmsSlotStorageTableMap::COL_DATA => 2, SpyCmsSlotStorageTableMap::COL_KEY => 3, SpyCmsSlotStorageTableMap::COL_ALIAS_KEYS => 4, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot_storage' => 0, 'cms_slot_key' => 1, 'data' => 2, 'key' => 3, 'alias_keys' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsSlotStorage' => 'ID_CMS_SLOT_STORAGE',
        'SpyCmsSlotStorage.IdCmsSlotStorage' => 'ID_CMS_SLOT_STORAGE',
        'idCmsSlotStorage' => 'ID_CMS_SLOT_STORAGE',
        'spyCmsSlotStorage.idCmsSlotStorage' => 'ID_CMS_SLOT_STORAGE',
        'SpyCmsSlotStorageTableMap::COL_ID_CMS_SLOT_STORAGE' => 'ID_CMS_SLOT_STORAGE',
        'COL_ID_CMS_SLOT_STORAGE' => 'ID_CMS_SLOT_STORAGE',
        'id_cms_slot_storage' => 'ID_CMS_SLOT_STORAGE',
        'spy_cms_slot_storage.id_cms_slot_storage' => 'ID_CMS_SLOT_STORAGE',
        'CmsSlotKey' => 'CMS_SLOT_KEY',
        'SpyCmsSlotStorage.CmsSlotKey' => 'CMS_SLOT_KEY',
        'cmsSlotKey' => 'CMS_SLOT_KEY',
        'spyCmsSlotStorage.cmsSlotKey' => 'CMS_SLOT_KEY',
        'SpyCmsSlotStorageTableMap::COL_CMS_SLOT_KEY' => 'CMS_SLOT_KEY',
        'COL_CMS_SLOT_KEY' => 'CMS_SLOT_KEY',
        'cms_slot_key' => 'CMS_SLOT_KEY',
        'spy_cms_slot_storage.cms_slot_key' => 'CMS_SLOT_KEY',
        'Data' => 'DATA',
        'SpyCmsSlotStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyCmsSlotStorage.data' => 'DATA',
        'SpyCmsSlotStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_cms_slot_storage.data' => 'DATA',
        'Key' => 'KEY',
        'SpyCmsSlotStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyCmsSlotStorage.key' => 'KEY',
        'SpyCmsSlotStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_cms_slot_storage.key' => 'KEY',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyCmsSlotStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyCmsSlotStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyCmsSlotStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_cms_slot_storage.alias_keys' => 'ALIAS_KEYS',
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
        $this->setName('spy_cms_slot_storage');
        $this->setPhpName('SpyCmsSlotStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CmsSlotStorage\\Persistence\\SpyCmsSlotStorage');
        $this->setPackage('src.Orm.Zed.CmsSlotStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_slot_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_slot_storage', 'IdCmsSlotStorage', 'INTEGER', true, null, null);
        $this->addColumn('cms_slot_key', 'CmsSlotKey', 'VARCHAR', true, 255, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 1024, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'cms_slot'], 'queue_group' => ['value' => 'sync.storage.cms'], 'queue_pool' => ['value' => 'synchronizationPool'], 'key_suffix_column' => ['value' => 'cms_slot_key']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsSlotStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsSlotStorageTableMap::CLASS_DEFAULT : SpyCmsSlotStorageTableMap::OM_CLASS;
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
     * @return array (SpyCmsSlotStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsSlotStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsSlotStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsSlotStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsSlotStorageTableMap::OM_CLASS;
            /** @var SpyCmsSlotStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsSlotStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsSlotStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsSlotStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsSlotStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsSlotStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsSlotStorageTableMap::COL_ID_CMS_SLOT_STORAGE);
            $criteria->addSelectColumn(SpyCmsSlotStorageTableMap::COL_CMS_SLOT_KEY);
            $criteria->addSelectColumn(SpyCmsSlotStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyCmsSlotStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCmsSlotStorageTableMap::COL_ALIAS_KEYS);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_slot_storage');
            $criteria->addSelectColumn($alias . '.cms_slot_key');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.alias_keys');
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
            $criteria->removeSelectColumn(SpyCmsSlotStorageTableMap::COL_ID_CMS_SLOT_STORAGE);
            $criteria->removeSelectColumn(SpyCmsSlotStorageTableMap::COL_CMS_SLOT_KEY);
            $criteria->removeSelectColumn(SpyCmsSlotStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyCmsSlotStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCmsSlotStorageTableMap::COL_ALIAS_KEYS);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_slot_storage');
            $criteria->removeSelectColumn($alias . '.cms_slot_key');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.alias_keys');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsSlotStorageTableMap::DATABASE_NAME)->getTable(SpyCmsSlotStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsSlotStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsSlotStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsSlotStorage\Persistence\SpyCmsSlotStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsSlotStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsSlotStorageTableMap::COL_ID_CMS_SLOT_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCmsSlotStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsSlotStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsSlotStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_slot_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsSlotStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsSlotStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsSlotStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsSlotStorage object
        }


        // Set the correct dbName
        $query = SpyCmsSlotStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
