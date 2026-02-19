<?php

namespace Orm\Zed\ApiKey\Persistence\Map;

use Orm\Zed\ApiKey\Persistence\SpyApiKey;
use Orm\Zed\ApiKey\Persistence\SpyApiKeyQuery;
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
 * This class defines the structure of the 'spy_api_key' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyApiKeyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ApiKey.Persistence.Map.SpyApiKeyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_api_key';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyApiKey';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ApiKey\\Persistence\\SpyApiKey';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ApiKey.Persistence.SpyApiKey';

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
     * the column name for the id_api_key field
     */
    public const COL_ID_API_KEY = 'spy_api_key.id_api_key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_api_key.name';

    /**
     * the column name for the key_hash field
     */
    public const COL_KEY_HASH = 'spy_api_key.key_hash';

    /**
     * the column name for the scopes field
     */
    public const COL_SCOPES = 'spy_api_key.scopes';

    /**
     * the column name for the created_by field
     */
    public const COL_CREATED_BY = 'spy_api_key.created_by';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_api_key.valid_to';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_api_key.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_api_key.updated_at';

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
        self::TYPE_PHPNAME       => ['IdApiKey', 'Name', 'KeyHash', 'Scopes', 'CreatedBy', 'ValidTo', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idApiKey', 'name', 'keyHash', 'scopes', 'createdBy', 'validTo', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyApiKeyTableMap::COL_ID_API_KEY, SpyApiKeyTableMap::COL_NAME, SpyApiKeyTableMap::COL_KEY_HASH, SpyApiKeyTableMap::COL_SCOPES, SpyApiKeyTableMap::COL_CREATED_BY, SpyApiKeyTableMap::COL_VALID_TO, SpyApiKeyTableMap::COL_CREATED_AT, SpyApiKeyTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_api_key', 'name', 'key_hash', 'scopes', 'created_by', 'valid_to', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdApiKey' => 0, 'Name' => 1, 'KeyHash' => 2, 'Scopes' => 3, 'CreatedBy' => 4, 'ValidTo' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idApiKey' => 0, 'name' => 1, 'keyHash' => 2, 'scopes' => 3, 'createdBy' => 4, 'validTo' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyApiKeyTableMap::COL_ID_API_KEY => 0, SpyApiKeyTableMap::COL_NAME => 1, SpyApiKeyTableMap::COL_KEY_HASH => 2, SpyApiKeyTableMap::COL_SCOPES => 3, SpyApiKeyTableMap::COL_CREATED_BY => 4, SpyApiKeyTableMap::COL_VALID_TO => 5, SpyApiKeyTableMap::COL_CREATED_AT => 6, SpyApiKeyTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_api_key' => 0, 'name' => 1, 'key_hash' => 2, 'scopes' => 3, 'created_by' => 4, 'valid_to' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdApiKey' => 'ID_API_KEY',
        'SpyApiKey.IdApiKey' => 'ID_API_KEY',
        'idApiKey' => 'ID_API_KEY',
        'spyApiKey.idApiKey' => 'ID_API_KEY',
        'SpyApiKeyTableMap::COL_ID_API_KEY' => 'ID_API_KEY',
        'COL_ID_API_KEY' => 'ID_API_KEY',
        'id_api_key' => 'ID_API_KEY',
        'spy_api_key.id_api_key' => 'ID_API_KEY',
        'Name' => 'NAME',
        'SpyApiKey.Name' => 'NAME',
        'name' => 'NAME',
        'spyApiKey.name' => 'NAME',
        'SpyApiKeyTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_api_key.name' => 'NAME',
        'KeyHash' => 'KEY_HASH',
        'SpyApiKey.KeyHash' => 'KEY_HASH',
        'keyHash' => 'KEY_HASH',
        'spyApiKey.keyHash' => 'KEY_HASH',
        'SpyApiKeyTableMap::COL_KEY_HASH' => 'KEY_HASH',
        'COL_KEY_HASH' => 'KEY_HASH',
        'key_hash' => 'KEY_HASH',
        'spy_api_key.key_hash' => 'KEY_HASH',
        'Scopes' => 'SCOPES',
        'SpyApiKey.Scopes' => 'SCOPES',
        'scopes' => 'SCOPES',
        'spyApiKey.scopes' => 'SCOPES',
        'SpyApiKeyTableMap::COL_SCOPES' => 'SCOPES',
        'COL_SCOPES' => 'SCOPES',
        'spy_api_key.scopes' => 'SCOPES',
        'CreatedBy' => 'CREATED_BY',
        'SpyApiKey.CreatedBy' => 'CREATED_BY',
        'createdBy' => 'CREATED_BY',
        'spyApiKey.createdBy' => 'CREATED_BY',
        'SpyApiKeyTableMap::COL_CREATED_BY' => 'CREATED_BY',
        'COL_CREATED_BY' => 'CREATED_BY',
        'created_by' => 'CREATED_BY',
        'spy_api_key.created_by' => 'CREATED_BY',
        'ValidTo' => 'VALID_TO',
        'SpyApiKey.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyApiKey.validTo' => 'VALID_TO',
        'SpyApiKeyTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_api_key.valid_to' => 'VALID_TO',
        'CreatedAt' => 'CREATED_AT',
        'SpyApiKey.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyApiKey.createdAt' => 'CREATED_AT',
        'SpyApiKeyTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_api_key.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyApiKey.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyApiKey.updatedAt' => 'UPDATED_AT',
        'SpyApiKeyTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_api_key.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_api_key');
        $this->setPhpName('SpyApiKey');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ApiKey\\Persistence\\SpyApiKey');
        $this->setPackage('src.Orm.Zed.ApiKey.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_api_key_pk_seq');
        // columns
        $this->addPrimaryKey('id_api_key', 'IdApiKey', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('key_hash', 'KeyHash', 'VARCHAR', true, 64, null);
        $this->addColumn('scopes', 'Scopes', 'VARCHAR', false, 1024, null);
        $this->addForeignKey('created_by', 'CreatedBy', 'INTEGER', 'spy_user', 'id_user', true, null, null);
        $this->addColumn('valid_to', 'ValidTo', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('User', '\\Orm\\Zed\\User\\Persistence\\SpyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':created_by',
    1 => ':id_user',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdApiKey', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyApiKeyTableMap::CLASS_DEFAULT : SpyApiKeyTableMap::OM_CLASS;
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
     * @return array (SpyApiKey object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyApiKeyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyApiKeyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyApiKeyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyApiKeyTableMap::OM_CLASS;
            /** @var SpyApiKey $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyApiKeyTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyApiKeyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyApiKeyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyApiKey $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyApiKeyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_ID_API_KEY);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_KEY_HASH);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_SCOPES);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_CREATED_BY);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_VALID_TO);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyApiKeyTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_api_key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.key_hash');
            $criteria->addSelectColumn($alias . '.scopes');
            $criteria->addSelectColumn($alias . '.created_by');
            $criteria->addSelectColumn($alias . '.valid_to');
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
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_ID_API_KEY);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_KEY_HASH);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_SCOPES);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_CREATED_BY);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_VALID_TO);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyApiKeyTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_api_key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.key_hash');
            $criteria->removeSelectColumn($alias . '.scopes');
            $criteria->removeSelectColumn($alias . '.created_by');
            $criteria->removeSelectColumn($alias . '.valid_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyApiKeyTableMap::DATABASE_NAME)->getTable(SpyApiKeyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyApiKey or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyApiKey object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyApiKeyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ApiKey\Persistence\SpyApiKey) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyApiKeyTableMap::DATABASE_NAME);
            $criteria->add(SpyApiKeyTableMap::COL_ID_API_KEY, (array) $values, Criteria::IN);
        }

        $query = SpyApiKeyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyApiKeyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyApiKeyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_api_key table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyApiKeyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyApiKey or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyApiKey object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyApiKeyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyApiKey object
        }

        if ($criteria->containsKey(SpyApiKeyTableMap::COL_ID_API_KEY) && $criteria->keyContainsValue(SpyApiKeyTableMap::COL_ID_API_KEY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyApiKeyTableMap::COL_ID_API_KEY.')');
        }


        // Set the correct dbName
        $query = SpyApiKeyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
