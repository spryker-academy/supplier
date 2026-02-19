<?php

namespace Orm\Zed\Category\Persistence\Map;

use Orm\Zed\Category\Persistence\SpyCategoryClosureTable;
use Orm\Zed\Category\Persistence\SpyCategoryClosureTableQuery;
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
 * This class defines the structure of the 'spy_category_closure_table' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCategoryClosureTableTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Category.Persistence.Map.SpyCategoryClosureTableTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_category_closure_table';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCategoryClosureTable';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryClosureTable';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Category.Persistence.SpyCategoryClosureTable';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_category_closure_table field
     */
    public const COL_ID_CATEGORY_CLOSURE_TABLE = 'spy_category_closure_table.id_category_closure_table';

    /**
     * the column name for the fk_category_node field
     */
    public const COL_FK_CATEGORY_NODE = 'spy_category_closure_table.fk_category_node';

    /**
     * the column name for the fk_category_node_descendant field
     */
    public const COL_FK_CATEGORY_NODE_DESCENDANT = 'spy_category_closure_table.fk_category_node_descendant';

    /**
     * the column name for the depth field
     */
    public const COL_DEPTH = 'spy_category_closure_table.depth';

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
        self::TYPE_PHPNAME       => ['IdCategoryClosureTable', 'FkCategoryNode', 'FkCategoryNodeDescendant', 'Depth', ],
        self::TYPE_CAMELNAME     => ['idCategoryClosureTable', 'fkCategoryNode', 'fkCategoryNodeDescendant', 'depth', ],
        self::TYPE_COLNAME       => [SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE, SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT, SpyCategoryClosureTableTableMap::COL_DEPTH, ],
        self::TYPE_FIELDNAME     => ['id_category_closure_table', 'fk_category_node', 'fk_category_node_descendant', 'depth', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['IdCategoryClosureTable' => 0, 'FkCategoryNode' => 1, 'FkCategoryNodeDescendant' => 2, 'Depth' => 3, ],
        self::TYPE_CAMELNAME     => ['idCategoryClosureTable' => 0, 'fkCategoryNode' => 1, 'fkCategoryNodeDescendant' => 2, 'depth' => 3, ],
        self::TYPE_COLNAME       => [SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE => 0, SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE => 1, SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT => 2, SpyCategoryClosureTableTableMap::COL_DEPTH => 3, ],
        self::TYPE_FIELDNAME     => ['id_category_closure_table' => 0, 'fk_category_node' => 1, 'fk_category_node_descendant' => 2, 'depth' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCategoryClosureTable' => 'ID_CATEGORY_CLOSURE_TABLE',
        'SpyCategoryClosureTable.IdCategoryClosureTable' => 'ID_CATEGORY_CLOSURE_TABLE',
        'idCategoryClosureTable' => 'ID_CATEGORY_CLOSURE_TABLE',
        'spyCategoryClosureTable.idCategoryClosureTable' => 'ID_CATEGORY_CLOSURE_TABLE',
        'SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE' => 'ID_CATEGORY_CLOSURE_TABLE',
        'COL_ID_CATEGORY_CLOSURE_TABLE' => 'ID_CATEGORY_CLOSURE_TABLE',
        'id_category_closure_table' => 'ID_CATEGORY_CLOSURE_TABLE',
        'spy_category_closure_table.id_category_closure_table' => 'ID_CATEGORY_CLOSURE_TABLE',
        'FkCategoryNode' => 'FK_CATEGORY_NODE',
        'SpyCategoryClosureTable.FkCategoryNode' => 'FK_CATEGORY_NODE',
        'fkCategoryNode' => 'FK_CATEGORY_NODE',
        'spyCategoryClosureTable.fkCategoryNode' => 'FK_CATEGORY_NODE',
        'SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE' => 'FK_CATEGORY_NODE',
        'COL_FK_CATEGORY_NODE' => 'FK_CATEGORY_NODE',
        'fk_category_node' => 'FK_CATEGORY_NODE',
        'spy_category_closure_table.fk_category_node' => 'FK_CATEGORY_NODE',
        'FkCategoryNodeDescendant' => 'FK_CATEGORY_NODE_DESCENDANT',
        'SpyCategoryClosureTable.FkCategoryNodeDescendant' => 'FK_CATEGORY_NODE_DESCENDANT',
        'fkCategoryNodeDescendant' => 'FK_CATEGORY_NODE_DESCENDANT',
        'spyCategoryClosureTable.fkCategoryNodeDescendant' => 'FK_CATEGORY_NODE_DESCENDANT',
        'SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT' => 'FK_CATEGORY_NODE_DESCENDANT',
        'COL_FK_CATEGORY_NODE_DESCENDANT' => 'FK_CATEGORY_NODE_DESCENDANT',
        'fk_category_node_descendant' => 'FK_CATEGORY_NODE_DESCENDANT',
        'spy_category_closure_table.fk_category_node_descendant' => 'FK_CATEGORY_NODE_DESCENDANT',
        'Depth' => 'DEPTH',
        'SpyCategoryClosureTable.Depth' => 'DEPTH',
        'depth' => 'DEPTH',
        'spyCategoryClosureTable.depth' => 'DEPTH',
        'SpyCategoryClosureTableTableMap::COL_DEPTH' => 'DEPTH',
        'COL_DEPTH' => 'DEPTH',
        'spy_category_closure_table.depth' => 'DEPTH',
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
        $this->setName('spy_category_closure_table');
        $this->setPhpName('SpyCategoryClosureTable');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Category\\Persistence\\SpyCategoryClosureTable');
        $this->setPackage('src.Orm.Zed.Category.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_category_closure_table_pk_seq');
        // columns
        $this->addPrimaryKey('id_category_closure_table', 'IdCategoryClosureTable', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_category_node', 'FkCategoryNode', 'INTEGER', 'spy_category_node', 'id_category_node', true, null, null);
        $this->addForeignKey('fk_category_node_descendant', 'FkCategoryNodeDescendant', 'INTEGER', 'spy_category_node', 'id_category_node', true, null, null);
        $this->addColumn('depth', 'Depth', 'INTEGER', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Node', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryNode', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category_node',
    1 => ':id_category_node',
  ),
), null, null, null, false);
        $this->addRelation('DescendantNode', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryNode', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category_node_descendant',
    1 => ':id_category_node',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCategoryClosureTable', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCategoryClosureTableTableMap::CLASS_DEFAULT : SpyCategoryClosureTableTableMap::OM_CLASS;
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
     * @return array (SpyCategoryClosureTable object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCategoryClosureTableTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCategoryClosureTableTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCategoryClosureTableTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCategoryClosureTableTableMap::OM_CLASS;
            /** @var SpyCategoryClosureTable $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCategoryClosureTableTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCategoryClosureTableTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCategoryClosureTableTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCategoryClosureTable $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCategoryClosureTableTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE);
            $criteria->addSelectColumn(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE);
            $criteria->addSelectColumn(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT);
            $criteria->addSelectColumn(SpyCategoryClosureTableTableMap::COL_DEPTH);
        } else {
            $criteria->addSelectColumn($alias . '.id_category_closure_table');
            $criteria->addSelectColumn($alias . '.fk_category_node');
            $criteria->addSelectColumn($alias . '.fk_category_node_descendant');
            $criteria->addSelectColumn($alias . '.depth');
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
            $criteria->removeSelectColumn(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE);
            $criteria->removeSelectColumn(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE);
            $criteria->removeSelectColumn(SpyCategoryClosureTableTableMap::COL_FK_CATEGORY_NODE_DESCENDANT);
            $criteria->removeSelectColumn(SpyCategoryClosureTableTableMap::COL_DEPTH);
        } else {
            $criteria->removeSelectColumn($alias . '.id_category_closure_table');
            $criteria->removeSelectColumn($alias . '.fk_category_node');
            $criteria->removeSelectColumn($alias . '.fk_category_node_descendant');
            $criteria->removeSelectColumn($alias . '.depth');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCategoryClosureTableTableMap::DATABASE_NAME)->getTable(SpyCategoryClosureTableTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCategoryClosureTable or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCategoryClosureTable object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryClosureTableTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Category\Persistence\SpyCategoryClosureTable) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCategoryClosureTableTableMap::DATABASE_NAME);
            $criteria->add(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE, (array) $values, Criteria::IN);
        }

        $query = SpyCategoryClosureTableQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCategoryClosureTableTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCategoryClosureTableTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_category_closure_table table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCategoryClosureTableQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCategoryClosureTable or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCategoryClosureTable object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryClosureTableTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCategoryClosureTable object
        }

        if ($criteria->containsKey(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE) && $criteria->keyContainsValue(SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCategoryClosureTableTableMap::COL_ID_CATEGORY_CLOSURE_TABLE.')');
        }


        // Set the correct dbName
        $query = SpyCategoryClosureTableQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
