<?php

namespace Orm\Zed\FileManager\Persistence\Map;

use Orm\Zed\FileManager\Persistence\SpyFileDirectory;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery;
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
 * This class defines the structure of the 'spy_file_directory' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyFileDirectoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.FileManager.Persistence.Map.SpyFileDirectoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_file_directory';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyFileDirectory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.FileManager.Persistence.SpyFileDirectory';

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
     * the column name for the id_file_directory field
     */
    public const COL_ID_FILE_DIRECTORY = 'spy_file_directory.id_file_directory';

    /**
     * the column name for the fk_parent_file_directory field
     */
    public const COL_FK_PARENT_FILE_DIRECTORY = 'spy_file_directory.fk_parent_file_directory';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_file_directory.is_active';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_file_directory.name';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'spy_file_directory.position';

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
        self::TYPE_PHPNAME       => ['IdFileDirectory', 'FkParentFileDirectory', 'IsActive', 'Name', 'Position', ],
        self::TYPE_CAMELNAME     => ['idFileDirectory', 'fkParentFileDirectory', 'isActive', 'name', 'position', ],
        self::TYPE_COLNAME       => [SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY, SpyFileDirectoryTableMap::COL_IS_ACTIVE, SpyFileDirectoryTableMap::COL_NAME, SpyFileDirectoryTableMap::COL_POSITION, ],
        self::TYPE_FIELDNAME     => ['id_file_directory', 'fk_parent_file_directory', 'is_active', 'name', 'position', ],
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
        self::TYPE_PHPNAME       => ['IdFileDirectory' => 0, 'FkParentFileDirectory' => 1, 'IsActive' => 2, 'Name' => 3, 'Position' => 4, ],
        self::TYPE_CAMELNAME     => ['idFileDirectory' => 0, 'fkParentFileDirectory' => 1, 'isActive' => 2, 'name' => 3, 'position' => 4, ],
        self::TYPE_COLNAME       => [SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY => 0, SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY => 1, SpyFileDirectoryTableMap::COL_IS_ACTIVE => 2, SpyFileDirectoryTableMap::COL_NAME => 3, SpyFileDirectoryTableMap::COL_POSITION => 4, ],
        self::TYPE_FIELDNAME     => ['id_file_directory' => 0, 'fk_parent_file_directory' => 1, 'is_active' => 2, 'name' => 3, 'position' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdFileDirectory' => 'ID_FILE_DIRECTORY',
        'SpyFileDirectory.IdFileDirectory' => 'ID_FILE_DIRECTORY',
        'idFileDirectory' => 'ID_FILE_DIRECTORY',
        'spyFileDirectory.idFileDirectory' => 'ID_FILE_DIRECTORY',
        'SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY' => 'ID_FILE_DIRECTORY',
        'COL_ID_FILE_DIRECTORY' => 'ID_FILE_DIRECTORY',
        'id_file_directory' => 'ID_FILE_DIRECTORY',
        'spy_file_directory.id_file_directory' => 'ID_FILE_DIRECTORY',
        'FkParentFileDirectory' => 'FK_PARENT_FILE_DIRECTORY',
        'SpyFileDirectory.FkParentFileDirectory' => 'FK_PARENT_FILE_DIRECTORY',
        'fkParentFileDirectory' => 'FK_PARENT_FILE_DIRECTORY',
        'spyFileDirectory.fkParentFileDirectory' => 'FK_PARENT_FILE_DIRECTORY',
        'SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY' => 'FK_PARENT_FILE_DIRECTORY',
        'COL_FK_PARENT_FILE_DIRECTORY' => 'FK_PARENT_FILE_DIRECTORY',
        'fk_parent_file_directory' => 'FK_PARENT_FILE_DIRECTORY',
        'spy_file_directory.fk_parent_file_directory' => 'FK_PARENT_FILE_DIRECTORY',
        'IsActive' => 'IS_ACTIVE',
        'SpyFileDirectory.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyFileDirectory.isActive' => 'IS_ACTIVE',
        'SpyFileDirectoryTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_file_directory.is_active' => 'IS_ACTIVE',
        'Name' => 'NAME',
        'SpyFileDirectory.Name' => 'NAME',
        'name' => 'NAME',
        'spyFileDirectory.name' => 'NAME',
        'SpyFileDirectoryTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_file_directory.name' => 'NAME',
        'Position' => 'POSITION',
        'SpyFileDirectory.Position' => 'POSITION',
        'position' => 'POSITION',
        'spyFileDirectory.position' => 'POSITION',
        'SpyFileDirectoryTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'spy_file_directory.position' => 'POSITION',
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
        $this->setName('spy_file_directory');
        $this->setPhpName('SpyFileDirectory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectory');
        $this->setPackage('src.Orm.Zed.FileManager.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_file_directory_pk_seq');
        // columns
        $this->addPrimaryKey('id_file_directory', 'IdFileDirectory', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_parent_file_directory', 'FkParentFileDirectory', 'INTEGER', 'spy_file_directory', 'id_file_directory', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, true);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ParentFileDirectory', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_parent_file_directory',
    1 => ':id_file_directory',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyFile', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_file_directory',
    1 => ':id_file_directory',
  ),
), null, null, 'SpyFiles', false);
        $this->addRelation('ChildrenFileDirectory', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_parent_file_directory',
    1 => ':id_file_directory',
  ),
), 'CASCADE', null, 'ChildrenFileDirectories', false);
        $this->addRelation('SpyFileDirectoryLocalizedAttributes', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectoryLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_file_directory',
    1 => ':id_file_directory',
  ),
), 'CASCADE', null, 'SpyFileDirectoryLocalizedAttributess', false);
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
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_file_directory     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyFileDirectoryTableMap::clearInstancePool();
        SpyFileDirectoryLocalizedAttributesTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdFileDirectory', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyFileDirectoryTableMap::CLASS_DEFAULT : SpyFileDirectoryTableMap::OM_CLASS;
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
     * @return array (SpyFileDirectory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyFileDirectoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyFileDirectoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyFileDirectoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyFileDirectoryTableMap::OM_CLASS;
            /** @var SpyFileDirectory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyFileDirectoryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyFileDirectoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyFileDirectoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyFileDirectory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyFileDirectoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY);
            $criteria->addSelectColumn(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY);
            $criteria->addSelectColumn(SpyFileDirectoryTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyFileDirectoryTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyFileDirectoryTableMap::COL_POSITION);
        } else {
            $criteria->addSelectColumn($alias . '.id_file_directory');
            $criteria->addSelectColumn($alias . '.fk_parent_file_directory');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.position');
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
            $criteria->removeSelectColumn(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY);
            $criteria->removeSelectColumn(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY);
            $criteria->removeSelectColumn(SpyFileDirectoryTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyFileDirectoryTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyFileDirectoryTableMap::COL_POSITION);
        } else {
            $criteria->removeSelectColumn($alias . '.id_file_directory');
            $criteria->removeSelectColumn($alias . '.fk_parent_file_directory');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.position');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyFileDirectoryTableMap::DATABASE_NAME)->getTable(SpyFileDirectoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyFileDirectory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyFileDirectory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileDirectoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyFileDirectoryTableMap::DATABASE_NAME);
            $criteria->add(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, (array) $values, Criteria::IN);
        }

        $query = SpyFileDirectoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyFileDirectoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyFileDirectoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_file_directory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyFileDirectoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyFileDirectory or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyFileDirectory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileDirectoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyFileDirectory object
        }

        if ($criteria->containsKey(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY) && $criteria->keyContainsValue(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY.')');
        }


        // Set the correct dbName
        $query = SpyFileDirectoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
