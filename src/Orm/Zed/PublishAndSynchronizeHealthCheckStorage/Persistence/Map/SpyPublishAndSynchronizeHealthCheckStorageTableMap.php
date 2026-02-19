<?php

namespace Orm\Zed\PublishAndSynchronizeHealthCheckStorage\Persistence\Map;

use Orm\Zed\PublishAndSynchronizeHealthCheckStorage\Persistence\SpyPublishAndSynchronizeHealthCheckStorage;
use Orm\Zed\PublishAndSynchronizeHealthCheckStorage\Persistence\SpyPublishAndSynchronizeHealthCheckStorageQuery;
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
 * This class defines the structure of the 'spy_publish_and_synchronize_health_check_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPublishAndSynchronizeHealthCheckStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PublishAndSynchronizeHealthCheckStorage.Persistence.Map.SpyPublishAndSynchronizeHealthCheckStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_publish_and_synchronize_health_check_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPublishAndSynchronizeHealthCheckStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PublishAndSynchronizeHealthCheckStorage\\Persistence\\SpyPublishAndSynchronizeHealthCheckStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PublishAndSynchronizeHealthCheckStorage.Persistence.SpyPublishAndSynchronizeHealthCheckStorage';

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
     * the column name for the id_publish_and_synchronize_health_check_storage field
     */
    public const COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE = 'spy_publish_and_synchronize_health_check_storage.id_publish_and_synchronize_health_check_storage';

    /**
     * the column name for the fk_publish_and_synchronize_health_check field
     */
    public const COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK = 'spy_publish_and_synchronize_health_check_storage.fk_publish_and_synchronize_health_check';

    /**
     * the column name for the health_check_key field
     */
    public const COL_HEALTH_CHECK_KEY = 'spy_publish_and_synchronize_health_check_storage.health_check_key';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_publish_and_synchronize_health_check_storage.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_publish_and_synchronize_health_check_storage.alias_keys';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_publish_and_synchronize_health_check_storage.key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_publish_and_synchronize_health_check_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_publish_and_synchronize_health_check_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPublishAndSynchronizeHealthCheckStorage', 'FkPublishAndSynchronizeHealthCheck', 'HealthCheckKey', 'Data', 'AliasKeys', 'Key', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPublishAndSynchronizeHealthCheckStorage', 'fkPublishAndSynchronizeHealthCheck', 'healthCheckKey', 'data', 'aliasKeys', 'key', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_HEALTH_CHECK_KEY, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_DATA, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ALIAS_KEYS, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_KEY, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_CREATED_AT, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_publish_and_synchronize_health_check_storage', 'fk_publish_and_synchronize_health_check', 'health_check_key', 'data', 'alias_keys', 'key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPublishAndSynchronizeHealthCheckStorage' => 0, 'FkPublishAndSynchronizeHealthCheck' => 1, 'HealthCheckKey' => 2, 'Data' => 3, 'AliasKeys' => 4, 'Key' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idPublishAndSynchronizeHealthCheckStorage' => 0, 'fkPublishAndSynchronizeHealthCheck' => 1, 'healthCheckKey' => 2, 'data' => 3, 'aliasKeys' => 4, 'key' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE => 0, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK => 1, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_HEALTH_CHECK_KEY => 2, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_DATA => 3, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ALIAS_KEYS => 4, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_KEY => 5, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_CREATED_AT => 6, SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_publish_and_synchronize_health_check_storage' => 0, 'fk_publish_and_synchronize_health_check' => 1, 'health_check_key' => 2, 'data' => 3, 'alias_keys' => 4, 'key' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPublishAndSynchronizeHealthCheckStorage' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'SpyPublishAndSynchronizeHealthCheckStorage.IdPublishAndSynchronizeHealthCheckStorage' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'idPublishAndSynchronizeHealthCheckStorage' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'spyPublishAndSynchronizeHealthCheckStorage.idPublishAndSynchronizeHealthCheckStorage' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'id_publish_and_synchronize_health_check_storage' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'spy_publish_and_synchronize_health_check_storage.id_publish_and_synchronize_health_check_storage' => 'ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE',
        'FkPublishAndSynchronizeHealthCheck' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'SpyPublishAndSynchronizeHealthCheckStorage.FkPublishAndSynchronizeHealthCheck' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'fkPublishAndSynchronizeHealthCheck' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'spyPublishAndSynchronizeHealthCheckStorage.fkPublishAndSynchronizeHealthCheck' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'fk_publish_and_synchronize_health_check' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'spy_publish_and_synchronize_health_check_storage.fk_publish_and_synchronize_health_check' => 'FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK',
        'HealthCheckKey' => 'HEALTH_CHECK_KEY',
        'SpyPublishAndSynchronizeHealthCheckStorage.HealthCheckKey' => 'HEALTH_CHECK_KEY',
        'healthCheckKey' => 'HEALTH_CHECK_KEY',
        'spyPublishAndSynchronizeHealthCheckStorage.healthCheckKey' => 'HEALTH_CHECK_KEY',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_HEALTH_CHECK_KEY' => 'HEALTH_CHECK_KEY',
        'COL_HEALTH_CHECK_KEY' => 'HEALTH_CHECK_KEY',
        'health_check_key' => 'HEALTH_CHECK_KEY',
        'spy_publish_and_synchronize_health_check_storage.health_check_key' => 'HEALTH_CHECK_KEY',
        'Data' => 'DATA',
        'SpyPublishAndSynchronizeHealthCheckStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyPublishAndSynchronizeHealthCheckStorage.data' => 'DATA',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_publish_and_synchronize_health_check_storage.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyPublishAndSynchronizeHealthCheckStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyPublishAndSynchronizeHealthCheckStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_publish_and_synchronize_health_check_storage.alias_keys' => 'ALIAS_KEYS',
        'Key' => 'KEY',
        'SpyPublishAndSynchronizeHealthCheckStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyPublishAndSynchronizeHealthCheckStorage.key' => 'KEY',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_publish_and_synchronize_health_check_storage.key' => 'KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyPublishAndSynchronizeHealthCheckStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPublishAndSynchronizeHealthCheckStorage.createdAt' => 'CREATED_AT',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_publish_and_synchronize_health_check_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPublishAndSynchronizeHealthCheckStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPublishAndSynchronizeHealthCheckStorage.updatedAt' => 'UPDATED_AT',
        'SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_publish_and_synchronize_health_check_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_publish_and_synchronize_health_check_storage');
        $this->setPhpName('SpyPublishAndSynchronizeHealthCheckStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\PublishAndSynchronizeHealthCheckStorage\\Persistence\\SpyPublishAndSynchronizeHealthCheckStorage');
        $this->setPackage('src.Orm.Zed.PublishAndSynchronizeHealthCheckStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_publish_and_synchronize_health_check_storage_pk_seq');
        // columns
        $this->addPrimaryKey('id_publish_and_synchronize_health_check_storage', 'IdPublishAndSynchronizeHealthCheckStorage', 'BIGINT', true, null, null);
        $this->addColumn('fk_publish_and_synchronize_health_check', 'FkPublishAndSynchronizeHealthCheck', 'INTEGER', true, null, null);
        $this->addColumn('health_check_key', 'HealthCheckKey', 'VARCHAR', true, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'publish_and_synchronize_health_check'], 'queue_group' => ['value' => 'sync.storage.publish_and_synchronize_health_check'], 'queue_pool' => NULL, 'key_suffix_column' => ['value' => 'health_check_key']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPublishAndSynchronizeHealthCheckStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPublishAndSynchronizeHealthCheckStorageTableMap::CLASS_DEFAULT : SpyPublishAndSynchronizeHealthCheckStorageTableMap::OM_CLASS;
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
     * @return array (SpyPublishAndSynchronizeHealthCheckStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPublishAndSynchronizeHealthCheckStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPublishAndSynchronizeHealthCheckStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPublishAndSynchronizeHealthCheckStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPublishAndSynchronizeHealthCheckStorageTableMap::OM_CLASS;
            /** @var SpyPublishAndSynchronizeHealthCheckStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPublishAndSynchronizeHealthCheckStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPublishAndSynchronizeHealthCheckStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPublishAndSynchronizeHealthCheckStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPublishAndSynchronizeHealthCheckStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPublishAndSynchronizeHealthCheckStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_HEALTH_CHECK_KEY);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_publish_and_synchronize_health_check_storage');
            $criteria->addSelectColumn($alias . '.fk_publish_and_synchronize_health_check');
            $criteria->addSelectColumn($alias . '.health_check_key');
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
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_FK_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_HEALTH_CHECK_KEY);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_publish_and_synchronize_health_check_storage');
            $criteria->removeSelectColumn($alias . '.fk_publish_and_synchronize_health_check');
            $criteria->removeSelectColumn($alias . '.health_check_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPublishAndSynchronizeHealthCheckStorageTableMap::DATABASE_NAME)->getTable(SpyPublishAndSynchronizeHealthCheckStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPublishAndSynchronizeHealthCheckStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPublishAndSynchronizeHealthCheckStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPublishAndSynchronizeHealthCheckStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PublishAndSynchronizeHealthCheckStorage\Persistence\SpyPublishAndSynchronizeHealthCheckStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPublishAndSynchronizeHealthCheckStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyPublishAndSynchronizeHealthCheckStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPublishAndSynchronizeHealthCheckStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPublishAndSynchronizeHealthCheckStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_publish_and_synchronize_health_check_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPublishAndSynchronizeHealthCheckStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPublishAndSynchronizeHealthCheckStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPublishAndSynchronizeHealthCheckStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPublishAndSynchronizeHealthCheckStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPublishAndSynchronizeHealthCheckStorage object
        }

        if ($criteria->containsKey(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE) && $criteria->keyContainsValue(SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPublishAndSynchronizeHealthCheckStorageTableMap::COL_ID_PUBLISH_AND_SYNCHRONIZE_HEALTH_CHECK_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyPublishAndSynchronizeHealthCheckStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
