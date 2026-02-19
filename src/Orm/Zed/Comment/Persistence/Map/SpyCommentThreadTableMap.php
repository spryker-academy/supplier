<?php

namespace Orm\Zed\Comment\Persistence\Map;

use Orm\Zed\Comment\Persistence\SpyCommentThread;
use Orm\Zed\Comment\Persistence\SpyCommentThreadQuery;
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
 * This class defines the structure of the 'spy_comment_thread' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCommentThreadTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Comment.Persistence.Map.SpyCommentThreadTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_comment_thread';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCommentThread';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Comment\\Persistence\\SpyCommentThread';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Comment.Persistence.SpyCommentThread';

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
     * the column name for the id_comment_thread field
     */
    public const COL_ID_COMMENT_THREAD = 'spy_comment_thread.id_comment_thread';

    /**
     * the column name for the owner_id field
     */
    public const COL_OWNER_ID = 'spy_comment_thread.owner_id';

    /**
     * the column name for the owner_type field
     */
    public const COL_OWNER_TYPE = 'spy_comment_thread.owner_type';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_comment_thread.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_comment_thread.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_comment_thread.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCommentThread', 'OwnerId', 'OwnerType', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCommentThread', 'ownerId', 'ownerType', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCommentThreadTableMap::COL_ID_COMMENT_THREAD, SpyCommentThreadTableMap::COL_OWNER_ID, SpyCommentThreadTableMap::COL_OWNER_TYPE, SpyCommentThreadTableMap::COL_UUID, SpyCommentThreadTableMap::COL_CREATED_AT, SpyCommentThreadTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_comment_thread', 'owner_id', 'owner_type', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCommentThread' => 0, 'OwnerId' => 1, 'OwnerType' => 2, 'Uuid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idCommentThread' => 0, 'ownerId' => 1, 'ownerType' => 2, 'uuid' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyCommentThreadTableMap::COL_ID_COMMENT_THREAD => 0, SpyCommentThreadTableMap::COL_OWNER_ID => 1, SpyCommentThreadTableMap::COL_OWNER_TYPE => 2, SpyCommentThreadTableMap::COL_UUID => 3, SpyCommentThreadTableMap::COL_CREATED_AT => 4, SpyCommentThreadTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_comment_thread' => 0, 'owner_id' => 1, 'owner_type' => 2, 'uuid' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCommentThread' => 'ID_COMMENT_THREAD',
        'SpyCommentThread.IdCommentThread' => 'ID_COMMENT_THREAD',
        'idCommentThread' => 'ID_COMMENT_THREAD',
        'spyCommentThread.idCommentThread' => 'ID_COMMENT_THREAD',
        'SpyCommentThreadTableMap::COL_ID_COMMENT_THREAD' => 'ID_COMMENT_THREAD',
        'COL_ID_COMMENT_THREAD' => 'ID_COMMENT_THREAD',
        'id_comment_thread' => 'ID_COMMENT_THREAD',
        'spy_comment_thread.id_comment_thread' => 'ID_COMMENT_THREAD',
        'OwnerId' => 'OWNER_ID',
        'SpyCommentThread.OwnerId' => 'OWNER_ID',
        'ownerId' => 'OWNER_ID',
        'spyCommentThread.ownerId' => 'OWNER_ID',
        'SpyCommentThreadTableMap::COL_OWNER_ID' => 'OWNER_ID',
        'COL_OWNER_ID' => 'OWNER_ID',
        'owner_id' => 'OWNER_ID',
        'spy_comment_thread.owner_id' => 'OWNER_ID',
        'OwnerType' => 'OWNER_TYPE',
        'SpyCommentThread.OwnerType' => 'OWNER_TYPE',
        'ownerType' => 'OWNER_TYPE',
        'spyCommentThread.ownerType' => 'OWNER_TYPE',
        'SpyCommentThreadTableMap::COL_OWNER_TYPE' => 'OWNER_TYPE',
        'COL_OWNER_TYPE' => 'OWNER_TYPE',
        'owner_type' => 'OWNER_TYPE',
        'spy_comment_thread.owner_type' => 'OWNER_TYPE',
        'Uuid' => 'UUID',
        'SpyCommentThread.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyCommentThread.uuid' => 'UUID',
        'SpyCommentThreadTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_comment_thread.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyCommentThread.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCommentThread.createdAt' => 'CREATED_AT',
        'SpyCommentThreadTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_comment_thread.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCommentThread.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCommentThread.updatedAt' => 'UPDATED_AT',
        'SpyCommentThreadTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_comment_thread.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_comment_thread');
        $this->setPhpName('SpyCommentThread');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Comment\\Persistence\\SpyCommentThread');
        $this->setPackage('src.Orm.Zed.Comment.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_comment_thread_pk_seq');
        // columns
        $this->addPrimaryKey('id_comment_thread', 'IdCommentThread', 'INTEGER', true, null, null);
        $this->addColumn('owner_id', 'OwnerId', 'INTEGER', true, null, null);
        $this->addColumn('owner_type', 'OwnerType', 'VARCHAR', true, 64, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
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
        $this->addRelation('SpyComment', '\\Orm\\Zed\\Comment\\Persistence\\SpyComment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_comment_thread',
    1 => ':id_comment_thread',
  ),
), null, null, 'SpyComments', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'owner_type.owner_id'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCommentThread', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCommentThreadTableMap::CLASS_DEFAULT : SpyCommentThreadTableMap::OM_CLASS;
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
     * @return array (SpyCommentThread object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCommentThreadTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCommentThreadTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCommentThreadTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCommentThreadTableMap::OM_CLASS;
            /** @var SpyCommentThread $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCommentThreadTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCommentThreadTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCommentThreadTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCommentThread $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCommentThreadTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCommentThreadTableMap::COL_ID_COMMENT_THREAD);
            $criteria->addSelectColumn(SpyCommentThreadTableMap::COL_OWNER_ID);
            $criteria->addSelectColumn(SpyCommentThreadTableMap::COL_OWNER_TYPE);
            $criteria->addSelectColumn(SpyCommentThreadTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyCommentThreadTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCommentThreadTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_comment_thread');
            $criteria->addSelectColumn($alias . '.owner_id');
            $criteria->addSelectColumn($alias . '.owner_type');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyCommentThreadTableMap::COL_ID_COMMENT_THREAD);
            $criteria->removeSelectColumn(SpyCommentThreadTableMap::COL_OWNER_ID);
            $criteria->removeSelectColumn(SpyCommentThreadTableMap::COL_OWNER_TYPE);
            $criteria->removeSelectColumn(SpyCommentThreadTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyCommentThreadTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCommentThreadTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_comment_thread');
            $criteria->removeSelectColumn($alias . '.owner_id');
            $criteria->removeSelectColumn($alias . '.owner_type');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCommentThreadTableMap::DATABASE_NAME)->getTable(SpyCommentThreadTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCommentThread or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCommentThread object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCommentThreadTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Comment\Persistence\SpyCommentThread) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCommentThreadTableMap::DATABASE_NAME);
            $criteria->add(SpyCommentThreadTableMap::COL_ID_COMMENT_THREAD, (array) $values, Criteria::IN);
        }

        $query = SpyCommentThreadQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCommentThreadTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCommentThreadTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_comment_thread table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCommentThreadQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCommentThread or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCommentThread object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCommentThreadTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCommentThread object
        }


        // Set the correct dbName
        $query = SpyCommentThreadQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
