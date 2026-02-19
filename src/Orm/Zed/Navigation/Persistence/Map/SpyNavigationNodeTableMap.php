<?php

namespace Orm\Zed\Navigation\Persistence\Map;

use Orm\Zed\Navigation\Persistence\SpyNavigationNode;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeQuery;
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
 * This class defines the structure of the 'spy_navigation_node' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyNavigationNodeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Navigation.Persistence.Map.SpyNavigationNodeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_navigation_node';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyNavigationNode';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Navigation.Persistence.SpyNavigationNode';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_navigation_node field
     */
    public const COL_ID_NAVIGATION_NODE = 'spy_navigation_node.id_navigation_node';

    /**
     * the column name for the fk_navigation field
     */
    public const COL_FK_NAVIGATION = 'spy_navigation_node.fk_navigation';

    /**
     * the column name for the fk_parent_navigation_node field
     */
    public const COL_FK_PARENT_NAVIGATION_NODE = 'spy_navigation_node.fk_parent_navigation_node';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_navigation_node.is_active';

    /**
     * the column name for the node_key field
     */
    public const COL_NODE_KEY = 'spy_navigation_node.node_key';

    /**
     * the column name for the node_type field
     */
    public const COL_NODE_TYPE = 'spy_navigation_node.node_type';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'spy_navigation_node.position';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_navigation_node.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_navigation_node.valid_to';

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
        self::TYPE_PHPNAME       => ['IdNavigationNode', 'FkNavigation', 'FkParentNavigationNode', 'IsActive', 'NodeKey', 'NodeType', 'Position', 'ValidFrom', 'ValidTo', ],
        self::TYPE_CAMELNAME     => ['idNavigationNode', 'fkNavigation', 'fkParentNavigationNode', 'isActive', 'nodeKey', 'nodeType', 'position', 'validFrom', 'validTo', ],
        self::TYPE_COLNAME       => [SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, SpyNavigationNodeTableMap::COL_FK_NAVIGATION, SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE, SpyNavigationNodeTableMap::COL_IS_ACTIVE, SpyNavigationNodeTableMap::COL_NODE_KEY, SpyNavigationNodeTableMap::COL_NODE_TYPE, SpyNavigationNodeTableMap::COL_POSITION, SpyNavigationNodeTableMap::COL_VALID_FROM, SpyNavigationNodeTableMap::COL_VALID_TO, ],
        self::TYPE_FIELDNAME     => ['id_navigation_node', 'fk_navigation', 'fk_parent_navigation_node', 'is_active', 'node_key', 'node_type', 'position', 'valid_from', 'valid_to', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['IdNavigationNode' => 0, 'FkNavigation' => 1, 'FkParentNavigationNode' => 2, 'IsActive' => 3, 'NodeKey' => 4, 'NodeType' => 5, 'Position' => 6, 'ValidFrom' => 7, 'ValidTo' => 8, ],
        self::TYPE_CAMELNAME     => ['idNavigationNode' => 0, 'fkNavigation' => 1, 'fkParentNavigationNode' => 2, 'isActive' => 3, 'nodeKey' => 4, 'nodeType' => 5, 'position' => 6, 'validFrom' => 7, 'validTo' => 8, ],
        self::TYPE_COLNAME       => [SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE => 0, SpyNavigationNodeTableMap::COL_FK_NAVIGATION => 1, SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE => 2, SpyNavigationNodeTableMap::COL_IS_ACTIVE => 3, SpyNavigationNodeTableMap::COL_NODE_KEY => 4, SpyNavigationNodeTableMap::COL_NODE_TYPE => 5, SpyNavigationNodeTableMap::COL_POSITION => 6, SpyNavigationNodeTableMap::COL_VALID_FROM => 7, SpyNavigationNodeTableMap::COL_VALID_TO => 8, ],
        self::TYPE_FIELDNAME     => ['id_navigation_node' => 0, 'fk_navigation' => 1, 'fk_parent_navigation_node' => 2, 'is_active' => 3, 'node_key' => 4, 'node_type' => 5, 'position' => 6, 'valid_from' => 7, 'valid_to' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdNavigationNode' => 'ID_NAVIGATION_NODE',
        'SpyNavigationNode.IdNavigationNode' => 'ID_NAVIGATION_NODE',
        'idNavigationNode' => 'ID_NAVIGATION_NODE',
        'spyNavigationNode.idNavigationNode' => 'ID_NAVIGATION_NODE',
        'SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE' => 'ID_NAVIGATION_NODE',
        'COL_ID_NAVIGATION_NODE' => 'ID_NAVIGATION_NODE',
        'id_navigation_node' => 'ID_NAVIGATION_NODE',
        'spy_navigation_node.id_navigation_node' => 'ID_NAVIGATION_NODE',
        'FkNavigation' => 'FK_NAVIGATION',
        'SpyNavigationNode.FkNavigation' => 'FK_NAVIGATION',
        'fkNavigation' => 'FK_NAVIGATION',
        'spyNavigationNode.fkNavigation' => 'FK_NAVIGATION',
        'SpyNavigationNodeTableMap::COL_FK_NAVIGATION' => 'FK_NAVIGATION',
        'COL_FK_NAVIGATION' => 'FK_NAVIGATION',
        'fk_navigation' => 'FK_NAVIGATION',
        'spy_navigation_node.fk_navigation' => 'FK_NAVIGATION',
        'FkParentNavigationNode' => 'FK_PARENT_NAVIGATION_NODE',
        'SpyNavigationNode.FkParentNavigationNode' => 'FK_PARENT_NAVIGATION_NODE',
        'fkParentNavigationNode' => 'FK_PARENT_NAVIGATION_NODE',
        'spyNavigationNode.fkParentNavigationNode' => 'FK_PARENT_NAVIGATION_NODE',
        'SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE' => 'FK_PARENT_NAVIGATION_NODE',
        'COL_FK_PARENT_NAVIGATION_NODE' => 'FK_PARENT_NAVIGATION_NODE',
        'fk_parent_navigation_node' => 'FK_PARENT_NAVIGATION_NODE',
        'spy_navigation_node.fk_parent_navigation_node' => 'FK_PARENT_NAVIGATION_NODE',
        'IsActive' => 'IS_ACTIVE',
        'SpyNavigationNode.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyNavigationNode.isActive' => 'IS_ACTIVE',
        'SpyNavigationNodeTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_navigation_node.is_active' => 'IS_ACTIVE',
        'NodeKey' => 'NODE_KEY',
        'SpyNavigationNode.NodeKey' => 'NODE_KEY',
        'nodeKey' => 'NODE_KEY',
        'spyNavigationNode.nodeKey' => 'NODE_KEY',
        'SpyNavigationNodeTableMap::COL_NODE_KEY' => 'NODE_KEY',
        'COL_NODE_KEY' => 'NODE_KEY',
        'node_key' => 'NODE_KEY',
        'spy_navigation_node.node_key' => 'NODE_KEY',
        'NodeType' => 'NODE_TYPE',
        'SpyNavigationNode.NodeType' => 'NODE_TYPE',
        'nodeType' => 'NODE_TYPE',
        'spyNavigationNode.nodeType' => 'NODE_TYPE',
        'SpyNavigationNodeTableMap::COL_NODE_TYPE' => 'NODE_TYPE',
        'COL_NODE_TYPE' => 'NODE_TYPE',
        'node_type' => 'NODE_TYPE',
        'spy_navigation_node.node_type' => 'NODE_TYPE',
        'Position' => 'POSITION',
        'SpyNavigationNode.Position' => 'POSITION',
        'position' => 'POSITION',
        'spyNavigationNode.position' => 'POSITION',
        'SpyNavigationNodeTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'spy_navigation_node.position' => 'POSITION',
        'ValidFrom' => 'VALID_FROM',
        'SpyNavigationNode.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyNavigationNode.validFrom' => 'VALID_FROM',
        'SpyNavigationNodeTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_navigation_node.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyNavigationNode.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyNavigationNode.validTo' => 'VALID_TO',
        'SpyNavigationNodeTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_navigation_node.valid_to' => 'VALID_TO',
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
        $this->setName('spy_navigation_node');
        $this->setPhpName('SpyNavigationNode');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode');
        $this->setPackage('src.Orm.Zed.Navigation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_navigation_node_pk_seq');
        // columns
        $this->addPrimaryKey('id_navigation_node', 'IdNavigationNode', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_navigation', 'FkNavigation', 'INTEGER', 'spy_navigation', 'id_navigation', true, null, null);
        $this->addForeignKey('fk_parent_navigation_node', 'FkParentNavigationNode', 'INTEGER', 'spy_navigation_node', 'id_navigation_node', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, true);
        $this->addColumn('node_key', 'NodeKey', 'VARCHAR', false, 32, null);
        $this->addColumn('node_type', 'NodeType', 'VARCHAR', false, 255, null);
        $this->addColumn('position', 'Position', 'INTEGER', false, null, null);
        $this->addColumn('valid_from', 'ValidFrom', 'TIMESTAMP', false, null, null);
        $this->addColumn('valid_to', 'ValidTo', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ParentNavigationNode', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_parent_navigation_node',
    1 => ':id_navigation_node',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyNavigation', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_navigation',
    1 => ':id_navigation',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('ChildrenNavigationNode', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_parent_navigation_node',
    1 => ':id_navigation_node',
  ),
), 'CASCADE', null, 'ChildrenNavigationNodes', false);
        $this->addRelation('SpyNavigationNodeLocalizedAttributes', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNodeLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_navigation_node',
    1 => ':id_navigation_node',
  ),
), 'CASCADE', null, 'SpyNavigationNodeLocalizedAttributess', false);
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
            'event' => ['spy_navigation_node-all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_navigation_node     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyNavigationNodeTableMap::clearInstancePool();
        SpyNavigationNodeLocalizedAttributesTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdNavigationNode', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyNavigationNodeTableMap::CLASS_DEFAULT : SpyNavigationNodeTableMap::OM_CLASS;
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
     * @return array (SpyNavigationNode object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyNavigationNodeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyNavigationNodeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyNavigationNodeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyNavigationNodeTableMap::OM_CLASS;
            /** @var SpyNavigationNode $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyNavigationNodeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyNavigationNodeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyNavigationNodeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyNavigationNode $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyNavigationNodeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_FK_NAVIGATION);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_NODE_KEY);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_NODE_TYPE);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_POSITION);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyNavigationNodeTableMap::COL_VALID_TO);
        } else {
            $criteria->addSelectColumn($alias . '.id_navigation_node');
            $criteria->addSelectColumn($alias . '.fk_navigation');
            $criteria->addSelectColumn($alias . '.fk_parent_navigation_node');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.node_key');
            $criteria->addSelectColumn($alias . '.node_type');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.valid_from');
            $criteria->addSelectColumn($alias . '.valid_to');
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
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_FK_NAVIGATION);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_FK_PARENT_NAVIGATION_NODE);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_NODE_KEY);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_NODE_TYPE);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_POSITION);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyNavigationNodeTableMap::COL_VALID_TO);
        } else {
            $criteria->removeSelectColumn($alias . '.id_navigation_node');
            $criteria->removeSelectColumn($alias . '.fk_navigation');
            $criteria->removeSelectColumn($alias . '.fk_parent_navigation_node');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.node_key');
            $criteria->removeSelectColumn($alias . '.node_type');
            $criteria->removeSelectColumn($alias . '.position');
            $criteria->removeSelectColumn($alias . '.valid_from');
            $criteria->removeSelectColumn($alias . '.valid_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyNavigationNodeTableMap::DATABASE_NAME)->getTable(SpyNavigationNodeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyNavigationNode or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyNavigationNode object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNode) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyNavigationNodeTableMap::DATABASE_NAME);
            $criteria->add(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE, (array) $values, Criteria::IN);
        }

        $query = SpyNavigationNodeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyNavigationNodeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyNavigationNodeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_navigation_node table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyNavigationNodeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyNavigationNode or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyNavigationNode object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyNavigationNode object
        }

        if ($criteria->containsKey(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE) && $criteria->keyContainsValue(SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyNavigationNodeTableMap::COL_ID_NAVIGATION_NODE.')');
        }


        // Set the correct dbName
        $query = SpyNavigationNodeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
