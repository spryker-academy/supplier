<?php

namespace Orm\Zed\FileManager\Persistence\Map;

use Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery;
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
 * This class defines the structure of the 'spy_file_directory_localized_attributes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyFileDirectoryLocalizedAttributesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.FileManager.Persistence.Map.SpyFileDirectoryLocalizedAttributesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_file_directory_localized_attributes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyFileDirectoryLocalizedAttributes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectoryLocalizedAttributes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.FileManager.Persistence.SpyFileDirectoryLocalizedAttributes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_file_directory_localized_attributes field
     */
    public const COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES = 'spy_file_directory_localized_attributes.id_file_directory_localized_attributes';

    /**
     * the column name for the fk_file_directory field
     */
    public const COL_FK_FILE_DIRECTORY = 'spy_file_directory_localized_attributes.fk_file_directory';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_file_directory_localized_attributes.fk_locale';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'spy_file_directory_localized_attributes.title';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_file_directory_localized_attributes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_file_directory_localized_attributes.updated_at';

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
        self::TYPE_PHPNAME       => ['IdFileDirectoryLocalizedAttributes', 'FkFileDirectory', 'FkLocale', 'Title', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idFileDirectoryLocalizedAttributes', 'fkFileDirectory', 'fkLocale', 'title', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES, SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_FILE_DIRECTORY, SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_LOCALE, SpyFileDirectoryLocalizedAttributesTableMap::COL_TITLE, SpyFileDirectoryLocalizedAttributesTableMap::COL_CREATED_AT, SpyFileDirectoryLocalizedAttributesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_file_directory_localized_attributes', 'fk_file_directory', 'fk_locale', 'title', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdFileDirectoryLocalizedAttributes' => 0, 'FkFileDirectory' => 1, 'FkLocale' => 2, 'Title' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idFileDirectoryLocalizedAttributes' => 0, 'fkFileDirectory' => 1, 'fkLocale' => 2, 'title' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES => 0, SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_FILE_DIRECTORY => 1, SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_LOCALE => 2, SpyFileDirectoryLocalizedAttributesTableMap::COL_TITLE => 3, SpyFileDirectoryLocalizedAttributesTableMap::COL_CREATED_AT => 4, SpyFileDirectoryLocalizedAttributesTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_file_directory_localized_attributes' => 0, 'fk_file_directory' => 1, 'fk_locale' => 2, 'title' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdFileDirectoryLocalizedAttributes' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'SpyFileDirectoryLocalizedAttributes.IdFileDirectoryLocalizedAttributes' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'idFileDirectoryLocalizedAttributes' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'spyFileDirectoryLocalizedAttributes.idFileDirectoryLocalizedAttributes' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'id_file_directory_localized_attributes' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'spy_file_directory_localized_attributes.id_file_directory_localized_attributes' => 'ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES',
        'FkFileDirectory' => 'FK_FILE_DIRECTORY',
        'SpyFileDirectoryLocalizedAttributes.FkFileDirectory' => 'FK_FILE_DIRECTORY',
        'fkFileDirectory' => 'FK_FILE_DIRECTORY',
        'spyFileDirectoryLocalizedAttributes.fkFileDirectory' => 'FK_FILE_DIRECTORY',
        'SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_FILE_DIRECTORY' => 'FK_FILE_DIRECTORY',
        'COL_FK_FILE_DIRECTORY' => 'FK_FILE_DIRECTORY',
        'fk_file_directory' => 'FK_FILE_DIRECTORY',
        'spy_file_directory_localized_attributes.fk_file_directory' => 'FK_FILE_DIRECTORY',
        'FkLocale' => 'FK_LOCALE',
        'SpyFileDirectoryLocalizedAttributes.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyFileDirectoryLocalizedAttributes.fkLocale' => 'FK_LOCALE',
        'SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_file_directory_localized_attributes.fk_locale' => 'FK_LOCALE',
        'Title' => 'TITLE',
        'SpyFileDirectoryLocalizedAttributes.Title' => 'TITLE',
        'title' => 'TITLE',
        'spyFileDirectoryLocalizedAttributes.title' => 'TITLE',
        'SpyFileDirectoryLocalizedAttributesTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'spy_file_directory_localized_attributes.title' => 'TITLE',
        'CreatedAt' => 'CREATED_AT',
        'SpyFileDirectoryLocalizedAttributes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyFileDirectoryLocalizedAttributes.createdAt' => 'CREATED_AT',
        'SpyFileDirectoryLocalizedAttributesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_file_directory_localized_attributes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyFileDirectoryLocalizedAttributes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyFileDirectoryLocalizedAttributes.updatedAt' => 'UPDATED_AT',
        'SpyFileDirectoryLocalizedAttributesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_file_directory_localized_attributes.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_file_directory_localized_attributes');
        $this->setPhpName('SpyFileDirectoryLocalizedAttributes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectoryLocalizedAttributes');
        $this->setPackage('src.Orm.Zed.FileManager.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_file_directory_localized_attributes_pk_seq');
        // columns
        $this->addPrimaryKey('id_file_directory_localized_attributes', 'IdFileDirectoryLocalizedAttributes', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_file_directory', 'FkFileDirectory', 'INTEGER', 'spy_file_directory', 'id_file_directory', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyFileDirectory', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_file_directory',
    1 => ':id_file_directory',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
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
            'event' => ['spy_file_directory_localized_attributes_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdFileDirectoryLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyFileDirectoryLocalizedAttributesTableMap::CLASS_DEFAULT : SpyFileDirectoryLocalizedAttributesTableMap::OM_CLASS;
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
     * @return array (SpyFileDirectoryLocalizedAttributes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyFileDirectoryLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyFileDirectoryLocalizedAttributesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyFileDirectoryLocalizedAttributesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyFileDirectoryLocalizedAttributesTableMap::OM_CLASS;
            /** @var SpyFileDirectoryLocalizedAttributes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyFileDirectoryLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyFileDirectoryLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyFileDirectoryLocalizedAttributesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyFileDirectoryLocalizedAttributes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyFileDirectoryLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES);
            $criteria->addSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_FILE_DIRECTORY);
            $criteria->addSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_TITLE);
            $criteria->addSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_file_directory_localized_attributes');
            $criteria->addSelectColumn($alias . '.fk_file_directory');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.title');
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
            $criteria->removeSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_FILE_DIRECTORY);
            $criteria->removeSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_TITLE);
            $criteria->removeSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyFileDirectoryLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_file_directory_localized_attributes');
            $criteria->removeSelectColumn($alias . '.fk_file_directory');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.title');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyFileDirectoryLocalizedAttributesTableMap::DATABASE_NAME)->getTable(SpyFileDirectoryLocalizedAttributesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyFileDirectoryLocalizedAttributes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyFileDirectoryLocalizedAttributes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileDirectoryLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyFileDirectoryLocalizedAttributesTableMap::DATABASE_NAME);
            $criteria->add(SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES, (array) $values, Criteria::IN);
        }

        $query = SpyFileDirectoryLocalizedAttributesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyFileDirectoryLocalizedAttributesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyFileDirectoryLocalizedAttributesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_file_directory_localized_attributes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyFileDirectoryLocalizedAttributesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyFileDirectoryLocalizedAttributes or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyFileDirectoryLocalizedAttributes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileDirectoryLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyFileDirectoryLocalizedAttributes object
        }

        if ($criteria->containsKey(SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES) && $criteria->keyContainsValue(SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyFileDirectoryLocalizedAttributesTableMap::COL_ID_FILE_DIRECTORY_LOCALIZED_ATTRIBUTES.')');
        }


        // Set the correct dbName
        $query = SpyFileDirectoryLocalizedAttributesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
