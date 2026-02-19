<?php

namespace Orm\Zed\FileManager\Persistence\Map;

use Orm\Zed\FileManager\Persistence\SpyMimeType;
use Orm\Zed\FileManager\Persistence\SpyMimeTypeQuery;
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
 * This class defines the structure of the 'spy_mime_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMimeTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.FileManager.Persistence.Map.SpyMimeTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_mime_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMimeType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\FileManager\\Persistence\\SpyMimeType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.FileManager.Persistence.SpyMimeType';

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
     * the column name for the id_mime_type field
     */
    public const COL_ID_MIME_TYPE = 'spy_mime_type.id_mime_type';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'spy_mime_type.comment';

    /**
     * the column name for the extensions field
     */
    public const COL_EXTENSIONS = 'spy_mime_type.extensions';

    /**
     * the column name for the is_allowed field
     */
    public const COL_IS_ALLOWED = 'spy_mime_type.is_allowed';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_mime_type.name';

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
        self::TYPE_PHPNAME       => ['IdMimeType', 'Comment', 'Extensions', 'IsAllowed', 'Name', ],
        self::TYPE_CAMELNAME     => ['idMimeType', 'comment', 'extensions', 'isAllowed', 'name', ],
        self::TYPE_COLNAME       => [SpyMimeTypeTableMap::COL_ID_MIME_TYPE, SpyMimeTypeTableMap::COL_COMMENT, SpyMimeTypeTableMap::COL_EXTENSIONS, SpyMimeTypeTableMap::COL_IS_ALLOWED, SpyMimeTypeTableMap::COL_NAME, ],
        self::TYPE_FIELDNAME     => ['id_mime_type', 'comment', 'extensions', 'is_allowed', 'name', ],
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
        self::TYPE_PHPNAME       => ['IdMimeType' => 0, 'Comment' => 1, 'Extensions' => 2, 'IsAllowed' => 3, 'Name' => 4, ],
        self::TYPE_CAMELNAME     => ['idMimeType' => 0, 'comment' => 1, 'extensions' => 2, 'isAllowed' => 3, 'name' => 4, ],
        self::TYPE_COLNAME       => [SpyMimeTypeTableMap::COL_ID_MIME_TYPE => 0, SpyMimeTypeTableMap::COL_COMMENT => 1, SpyMimeTypeTableMap::COL_EXTENSIONS => 2, SpyMimeTypeTableMap::COL_IS_ALLOWED => 3, SpyMimeTypeTableMap::COL_NAME => 4, ],
        self::TYPE_FIELDNAME     => ['id_mime_type' => 0, 'comment' => 1, 'extensions' => 2, 'is_allowed' => 3, 'name' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMimeType' => 'ID_MIME_TYPE',
        'SpyMimeType.IdMimeType' => 'ID_MIME_TYPE',
        'idMimeType' => 'ID_MIME_TYPE',
        'spyMimeType.idMimeType' => 'ID_MIME_TYPE',
        'SpyMimeTypeTableMap::COL_ID_MIME_TYPE' => 'ID_MIME_TYPE',
        'COL_ID_MIME_TYPE' => 'ID_MIME_TYPE',
        'id_mime_type' => 'ID_MIME_TYPE',
        'spy_mime_type.id_mime_type' => 'ID_MIME_TYPE',
        'Comment' => 'COMMENT',
        'SpyMimeType.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'spyMimeType.comment' => 'COMMENT',
        'SpyMimeTypeTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'spy_mime_type.comment' => 'COMMENT',
        'Extensions' => 'EXTENSIONS',
        'SpyMimeType.Extensions' => 'EXTENSIONS',
        'extensions' => 'EXTENSIONS',
        'spyMimeType.extensions' => 'EXTENSIONS',
        'SpyMimeTypeTableMap::COL_EXTENSIONS' => 'EXTENSIONS',
        'COL_EXTENSIONS' => 'EXTENSIONS',
        'spy_mime_type.extensions' => 'EXTENSIONS',
        'IsAllowed' => 'IS_ALLOWED',
        'SpyMimeType.IsAllowed' => 'IS_ALLOWED',
        'isAllowed' => 'IS_ALLOWED',
        'spyMimeType.isAllowed' => 'IS_ALLOWED',
        'SpyMimeTypeTableMap::COL_IS_ALLOWED' => 'IS_ALLOWED',
        'COL_IS_ALLOWED' => 'IS_ALLOWED',
        'is_allowed' => 'IS_ALLOWED',
        'spy_mime_type.is_allowed' => 'IS_ALLOWED',
        'Name' => 'NAME',
        'SpyMimeType.Name' => 'NAME',
        'name' => 'NAME',
        'spyMimeType.name' => 'NAME',
        'SpyMimeTypeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_mime_type.name' => 'NAME',
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
        $this->setName('spy_mime_type');
        $this->setPhpName('SpyMimeType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\FileManager\\Persistence\\SpyMimeType');
        $this->setPackage('src.Orm.Zed.FileManager.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_mime_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_mime_type', 'IdMimeType', 'INTEGER', true, null, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('extensions', 'Extensions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('is_allowed', 'IsAllowed', 'BOOLEAN', true, 1, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMimeType', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMimeTypeTableMap::CLASS_DEFAULT : SpyMimeTypeTableMap::OM_CLASS;
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
     * @return array (SpyMimeType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMimeTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMimeTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMimeTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMimeTypeTableMap::OM_CLASS;
            /** @var SpyMimeType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMimeTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMimeTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMimeTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMimeType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMimeTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMimeTypeTableMap::COL_ID_MIME_TYPE);
            $criteria->addSelectColumn(SpyMimeTypeTableMap::COL_COMMENT);
            $criteria->addSelectColumn(SpyMimeTypeTableMap::COL_EXTENSIONS);
            $criteria->addSelectColumn(SpyMimeTypeTableMap::COL_IS_ALLOWED);
            $criteria->addSelectColumn(SpyMimeTypeTableMap::COL_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_mime_type');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.extensions');
            $criteria->addSelectColumn($alias . '.is_allowed');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyMimeTypeTableMap::COL_ID_MIME_TYPE);
            $criteria->removeSelectColumn(SpyMimeTypeTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(SpyMimeTypeTableMap::COL_EXTENSIONS);
            $criteria->removeSelectColumn(SpyMimeTypeTableMap::COL_IS_ALLOWED);
            $criteria->removeSelectColumn(SpyMimeTypeTableMap::COL_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_mime_type');
            $criteria->removeSelectColumn($alias . '.comment');
            $criteria->removeSelectColumn($alias . '.extensions');
            $criteria->removeSelectColumn($alias . '.is_allowed');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMimeTypeTableMap::DATABASE_NAME)->getTable(SpyMimeTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMimeType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMimeType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMimeTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\FileManager\Persistence\SpyMimeType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMimeTypeTableMap::DATABASE_NAME);
            $criteria->add(SpyMimeTypeTableMap::COL_ID_MIME_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpyMimeTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMimeTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMimeTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_mime_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMimeTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMimeType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMimeType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMimeTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMimeType object
        }

        if ($criteria->containsKey(SpyMimeTypeTableMap::COL_ID_MIME_TYPE) && $criteria->keyContainsValue(SpyMimeTypeTableMap::COL_ID_MIME_TYPE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMimeTypeTableMap::COL_ID_MIME_TYPE.')');
        }


        // Set the correct dbName
        $query = SpyMimeTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
