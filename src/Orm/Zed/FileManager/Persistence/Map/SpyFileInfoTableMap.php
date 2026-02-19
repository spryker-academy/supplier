<?php

namespace Orm\Zed\FileManager\Persistence\Map;

use Orm\Zed\FileManager\Persistence\SpyFileInfo;
use Orm\Zed\FileManager\Persistence\SpyFileInfoQuery;
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
 * This class defines the structure of the 'spy_file_info' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyFileInfoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.FileManager.Persistence.Map.SpyFileInfoTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_file_info';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyFileInfo';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileInfo';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.FileManager.Persistence.SpyFileInfo';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id_file_info field
     */
    public const COL_ID_FILE_INFO = 'spy_file_info.id_file_info';

    /**
     * the column name for the fk_file field
     */
    public const COL_FK_FILE = 'spy_file_info.fk_file';

    /**
     * the column name for the extension field
     */
    public const COL_EXTENSION = 'spy_file_info.extension';

    /**
     * the column name for the size field
     */
    public const COL_SIZE = 'spy_file_info.size';

    /**
     * the column name for the storage_file_name field
     */
    public const COL_STORAGE_FILE_NAME = 'spy_file_info.storage_file_name';

    /**
     * the column name for the storage_name field
     */
    public const COL_STORAGE_NAME = 'spy_file_info.storage_name';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_file_info.type';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'spy_file_info.version';

    /**
     * the column name for the version_name field
     */
    public const COL_VERSION_NAME = 'spy_file_info.version_name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_file_info.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_file_info.updated_at';

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
        self::TYPE_PHPNAME       => ['IdFileInfo', 'FkFile', 'Extension', 'Size', 'StorageFileName', 'StorageName', 'Type', 'Version', 'VersionName', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idFileInfo', 'fkFile', 'extension', 'size', 'storageFileName', 'storageName', 'type', 'version', 'versionName', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyFileInfoTableMap::COL_ID_FILE_INFO, SpyFileInfoTableMap::COL_FK_FILE, SpyFileInfoTableMap::COL_EXTENSION, SpyFileInfoTableMap::COL_SIZE, SpyFileInfoTableMap::COL_STORAGE_FILE_NAME, SpyFileInfoTableMap::COL_STORAGE_NAME, SpyFileInfoTableMap::COL_TYPE, SpyFileInfoTableMap::COL_VERSION, SpyFileInfoTableMap::COL_VERSION_NAME, SpyFileInfoTableMap::COL_CREATED_AT, SpyFileInfoTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_file_info', 'fk_file', 'extension', 'size', 'storage_file_name', 'storage_name', 'type', 'version', 'version_name', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['IdFileInfo' => 0, 'FkFile' => 1, 'Extension' => 2, 'Size' => 3, 'StorageFileName' => 4, 'StorageName' => 5, 'Type' => 6, 'Version' => 7, 'VersionName' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idFileInfo' => 0, 'fkFile' => 1, 'extension' => 2, 'size' => 3, 'storageFileName' => 4, 'storageName' => 5, 'type' => 6, 'version' => 7, 'versionName' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyFileInfoTableMap::COL_ID_FILE_INFO => 0, SpyFileInfoTableMap::COL_FK_FILE => 1, SpyFileInfoTableMap::COL_EXTENSION => 2, SpyFileInfoTableMap::COL_SIZE => 3, SpyFileInfoTableMap::COL_STORAGE_FILE_NAME => 4, SpyFileInfoTableMap::COL_STORAGE_NAME => 5, SpyFileInfoTableMap::COL_TYPE => 6, SpyFileInfoTableMap::COL_VERSION => 7, SpyFileInfoTableMap::COL_VERSION_NAME => 8, SpyFileInfoTableMap::COL_CREATED_AT => 9, SpyFileInfoTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_file_info' => 0, 'fk_file' => 1, 'extension' => 2, 'size' => 3, 'storage_file_name' => 4, 'storage_name' => 5, 'type' => 6, 'version' => 7, 'version_name' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdFileInfo' => 'ID_FILE_INFO',
        'SpyFileInfo.IdFileInfo' => 'ID_FILE_INFO',
        'idFileInfo' => 'ID_FILE_INFO',
        'spyFileInfo.idFileInfo' => 'ID_FILE_INFO',
        'SpyFileInfoTableMap::COL_ID_FILE_INFO' => 'ID_FILE_INFO',
        'COL_ID_FILE_INFO' => 'ID_FILE_INFO',
        'id_file_info' => 'ID_FILE_INFO',
        'spy_file_info.id_file_info' => 'ID_FILE_INFO',
        'FkFile' => 'FK_FILE',
        'SpyFileInfo.FkFile' => 'FK_FILE',
        'fkFile' => 'FK_FILE',
        'spyFileInfo.fkFile' => 'FK_FILE',
        'SpyFileInfoTableMap::COL_FK_FILE' => 'FK_FILE',
        'COL_FK_FILE' => 'FK_FILE',
        'fk_file' => 'FK_FILE',
        'spy_file_info.fk_file' => 'FK_FILE',
        'Extension' => 'EXTENSION',
        'SpyFileInfo.Extension' => 'EXTENSION',
        'extension' => 'EXTENSION',
        'spyFileInfo.extension' => 'EXTENSION',
        'SpyFileInfoTableMap::COL_EXTENSION' => 'EXTENSION',
        'COL_EXTENSION' => 'EXTENSION',
        'spy_file_info.extension' => 'EXTENSION',
        'Size' => 'SIZE',
        'SpyFileInfo.Size' => 'SIZE',
        'size' => 'SIZE',
        'spyFileInfo.size' => 'SIZE',
        'SpyFileInfoTableMap::COL_SIZE' => 'SIZE',
        'COL_SIZE' => 'SIZE',
        'spy_file_info.size' => 'SIZE',
        'StorageFileName' => 'STORAGE_FILE_NAME',
        'SpyFileInfo.StorageFileName' => 'STORAGE_FILE_NAME',
        'storageFileName' => 'STORAGE_FILE_NAME',
        'spyFileInfo.storageFileName' => 'STORAGE_FILE_NAME',
        'SpyFileInfoTableMap::COL_STORAGE_FILE_NAME' => 'STORAGE_FILE_NAME',
        'COL_STORAGE_FILE_NAME' => 'STORAGE_FILE_NAME',
        'storage_file_name' => 'STORAGE_FILE_NAME',
        'spy_file_info.storage_file_name' => 'STORAGE_FILE_NAME',
        'StorageName' => 'STORAGE_NAME',
        'SpyFileInfo.StorageName' => 'STORAGE_NAME',
        'storageName' => 'STORAGE_NAME',
        'spyFileInfo.storageName' => 'STORAGE_NAME',
        'SpyFileInfoTableMap::COL_STORAGE_NAME' => 'STORAGE_NAME',
        'COL_STORAGE_NAME' => 'STORAGE_NAME',
        'storage_name' => 'STORAGE_NAME',
        'spy_file_info.storage_name' => 'STORAGE_NAME',
        'Type' => 'TYPE',
        'SpyFileInfo.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyFileInfo.type' => 'TYPE',
        'SpyFileInfoTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_file_info.type' => 'TYPE',
        'Version' => 'VERSION',
        'SpyFileInfo.Version' => 'VERSION',
        'version' => 'VERSION',
        'spyFileInfo.version' => 'VERSION',
        'SpyFileInfoTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'spy_file_info.version' => 'VERSION',
        'VersionName' => 'VERSION_NAME',
        'SpyFileInfo.VersionName' => 'VERSION_NAME',
        'versionName' => 'VERSION_NAME',
        'spyFileInfo.versionName' => 'VERSION_NAME',
        'SpyFileInfoTableMap::COL_VERSION_NAME' => 'VERSION_NAME',
        'COL_VERSION_NAME' => 'VERSION_NAME',
        'version_name' => 'VERSION_NAME',
        'spy_file_info.version_name' => 'VERSION_NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyFileInfo.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyFileInfo.createdAt' => 'CREATED_AT',
        'SpyFileInfoTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_file_info.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyFileInfo.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyFileInfo.updatedAt' => 'UPDATED_AT',
        'SpyFileInfoTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_file_info.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_file_info');
        $this->setPhpName('SpyFileInfo');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\FileManager\\Persistence\\SpyFileInfo');
        $this->setPackage('src.Orm.Zed.FileManager.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_file_info_pk_seq');
        // columns
        $this->addPrimaryKey('id_file_info', 'IdFileInfo', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_file', 'FkFile', 'INTEGER', 'spy_file', 'id_file', true, null, null);
        $this->addColumn('extension', 'Extension', 'VARCHAR', true, 255, null);
        $this->addColumn('size', 'Size', 'INTEGER', true, null, null);
        $this->addColumn('storage_file_name', 'StorageFileName', 'VARCHAR', false, 255, null);
        $this->addColumn('storage_name', 'StorageName', 'VARCHAR', false, 255, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 255, null);
        $this->addColumn('version', 'Version', 'INTEGER', true, null, null);
        $this->addColumn('version_name', 'VersionName', 'VARCHAR', true, 255, null);
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
        $this->addRelation('File', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_file',
    1 => ':id_file',
  ),
), 'CASCADE', null, null, false);
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
            'event' => ['spy_file_info_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdFileInfo', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyFileInfoTableMap::CLASS_DEFAULT : SpyFileInfoTableMap::OM_CLASS;
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
     * @return array (SpyFileInfo object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyFileInfoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyFileInfoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyFileInfoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyFileInfoTableMap::OM_CLASS;
            /** @var SpyFileInfo $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyFileInfoTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyFileInfoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyFileInfoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyFileInfo $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyFileInfoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_ID_FILE_INFO);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_FK_FILE);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_EXTENSION);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_SIZE);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_STORAGE_FILE_NAME);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_STORAGE_NAME);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_VERSION);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_VERSION_NAME);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyFileInfoTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_file_info');
            $criteria->addSelectColumn($alias . '.fk_file');
            $criteria->addSelectColumn($alias . '.extension');
            $criteria->addSelectColumn($alias . '.size');
            $criteria->addSelectColumn($alias . '.storage_file_name');
            $criteria->addSelectColumn($alias . '.storage_name');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_name');
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
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_ID_FILE_INFO);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_FK_FILE);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_EXTENSION);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_SIZE);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_STORAGE_FILE_NAME);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_STORAGE_NAME);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_VERSION);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_VERSION_NAME);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyFileInfoTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_file_info');
            $criteria->removeSelectColumn($alias . '.fk_file');
            $criteria->removeSelectColumn($alias . '.extension');
            $criteria->removeSelectColumn($alias . '.size');
            $criteria->removeSelectColumn($alias . '.storage_file_name');
            $criteria->removeSelectColumn($alias . '.storage_name');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyFileInfoTableMap::DATABASE_NAME)->getTable(SpyFileInfoTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyFileInfo or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyFileInfo object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileInfoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\FileManager\Persistence\SpyFileInfo) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyFileInfoTableMap::DATABASE_NAME);
            $criteria->add(SpyFileInfoTableMap::COL_ID_FILE_INFO, (array) $values, Criteria::IN);
        }

        $query = SpyFileInfoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyFileInfoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyFileInfoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_file_info table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyFileInfoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyFileInfo or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyFileInfo object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileInfoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyFileInfo object
        }

        if ($criteria->containsKey(SpyFileInfoTableMap::COL_ID_FILE_INFO) && $criteria->keyContainsValue(SpyFileInfoTableMap::COL_ID_FILE_INFO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyFileInfoTableMap::COL_ID_FILE_INFO.')');
        }


        // Set the correct dbName
        $query = SpyFileInfoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
