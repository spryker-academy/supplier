<?php

namespace Orm\Zed\AclEntity\Persistence\Map;

use Orm\Zed\AclEntity\Persistence\SpyAclEntityRule;
use Orm\Zed\AclEntity\Persistence\SpyAclEntityRuleQuery;
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
 * This class defines the structure of the 'spy_acl_entity_rule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAclEntityRuleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.AclEntity.Persistence.Map.SpyAclEntityRuleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_acl_entity_rule';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAclEntityRule';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntityRule';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.AclEntity.Persistence.SpyAclEntityRule';

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
     * the column name for the id_acl_entity_rule field
     */
    public const COL_ID_ACL_ENTITY_RULE = 'spy_acl_entity_rule.id_acl_entity_rule';

    /**
     * the column name for the fk_acl_entity_segment field
     */
    public const COL_FK_ACL_ENTITY_SEGMENT = 'spy_acl_entity_rule.fk_acl_entity_segment';

    /**
     * the column name for the fk_acl_role field
     */
    public const COL_FK_ACL_ROLE = 'spy_acl_entity_rule.fk_acl_role';

    /**
     * the column name for the entity field
     */
    public const COL_ENTITY = 'spy_acl_entity_rule.entity';

    /**
     * the column name for the permission_mask field
     */
    public const COL_PERMISSION_MASK = 'spy_acl_entity_rule.permission_mask';

    /**
     * the column name for the scope field
     */
    public const COL_SCOPE = 'spy_acl_entity_rule.scope';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the scope field */
    public const COL_SCOPE_GLOBAL = 'global';
    public const COL_SCOPE_SEGMENT = 'segment';
    public const COL_SCOPE_INHERITED = 'inherited';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdAclEntityRule', 'FkAclEntitySegment', 'FkAclRole', 'Entity', 'PermissionMask', 'Scope', ],
        self::TYPE_CAMELNAME     => ['idAclEntityRule', 'fkAclEntitySegment', 'fkAclRole', 'entity', 'permissionMask', 'scope', ],
        self::TYPE_COLNAME       => [SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT, SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE, SpyAclEntityRuleTableMap::COL_ENTITY, SpyAclEntityRuleTableMap::COL_PERMISSION_MASK, SpyAclEntityRuleTableMap::COL_SCOPE, ],
        self::TYPE_FIELDNAME     => ['id_acl_entity_rule', 'fk_acl_entity_segment', 'fk_acl_role', 'entity', 'permission_mask', 'scope', ],
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
        self::TYPE_PHPNAME       => ['IdAclEntityRule' => 0, 'FkAclEntitySegment' => 1, 'FkAclRole' => 2, 'Entity' => 3, 'PermissionMask' => 4, 'Scope' => 5, ],
        self::TYPE_CAMELNAME     => ['idAclEntityRule' => 0, 'fkAclEntitySegment' => 1, 'fkAclRole' => 2, 'entity' => 3, 'permissionMask' => 4, 'scope' => 5, ],
        self::TYPE_COLNAME       => [SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE => 0, SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT => 1, SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE => 2, SpyAclEntityRuleTableMap::COL_ENTITY => 3, SpyAclEntityRuleTableMap::COL_PERMISSION_MASK => 4, SpyAclEntityRuleTableMap::COL_SCOPE => 5, ],
        self::TYPE_FIELDNAME     => ['id_acl_entity_rule' => 0, 'fk_acl_entity_segment' => 1, 'fk_acl_role' => 2, 'entity' => 3, 'permission_mask' => 4, 'scope' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAclEntityRule' => 'ID_ACL_ENTITY_RULE',
        'SpyAclEntityRule.IdAclEntityRule' => 'ID_ACL_ENTITY_RULE',
        'idAclEntityRule' => 'ID_ACL_ENTITY_RULE',
        'spyAclEntityRule.idAclEntityRule' => 'ID_ACL_ENTITY_RULE',
        'SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE' => 'ID_ACL_ENTITY_RULE',
        'COL_ID_ACL_ENTITY_RULE' => 'ID_ACL_ENTITY_RULE',
        'id_acl_entity_rule' => 'ID_ACL_ENTITY_RULE',
        'spy_acl_entity_rule.id_acl_entity_rule' => 'ID_ACL_ENTITY_RULE',
        'FkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'SpyAclEntityRule.FkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'fkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'spyAclEntityRule.fkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT' => 'FK_ACL_ENTITY_SEGMENT',
        'COL_FK_ACL_ENTITY_SEGMENT' => 'FK_ACL_ENTITY_SEGMENT',
        'fk_acl_entity_segment' => 'FK_ACL_ENTITY_SEGMENT',
        'spy_acl_entity_rule.fk_acl_entity_segment' => 'FK_ACL_ENTITY_SEGMENT',
        'FkAclRole' => 'FK_ACL_ROLE',
        'SpyAclEntityRule.FkAclRole' => 'FK_ACL_ROLE',
        'fkAclRole' => 'FK_ACL_ROLE',
        'spyAclEntityRule.fkAclRole' => 'FK_ACL_ROLE',
        'SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE' => 'FK_ACL_ROLE',
        'COL_FK_ACL_ROLE' => 'FK_ACL_ROLE',
        'fk_acl_role' => 'FK_ACL_ROLE',
        'spy_acl_entity_rule.fk_acl_role' => 'FK_ACL_ROLE',
        'Entity' => 'ENTITY',
        'SpyAclEntityRule.Entity' => 'ENTITY',
        'entity' => 'ENTITY',
        'spyAclEntityRule.entity' => 'ENTITY',
        'SpyAclEntityRuleTableMap::COL_ENTITY' => 'ENTITY',
        'COL_ENTITY' => 'ENTITY',
        'spy_acl_entity_rule.entity' => 'ENTITY',
        'PermissionMask' => 'PERMISSION_MASK',
        'SpyAclEntityRule.PermissionMask' => 'PERMISSION_MASK',
        'permissionMask' => 'PERMISSION_MASK',
        'spyAclEntityRule.permissionMask' => 'PERMISSION_MASK',
        'SpyAclEntityRuleTableMap::COL_PERMISSION_MASK' => 'PERMISSION_MASK',
        'COL_PERMISSION_MASK' => 'PERMISSION_MASK',
        'permission_mask' => 'PERMISSION_MASK',
        'spy_acl_entity_rule.permission_mask' => 'PERMISSION_MASK',
        'Scope' => 'SCOPE',
        'SpyAclEntityRule.Scope' => 'SCOPE',
        'scope' => 'SCOPE',
        'spyAclEntityRule.scope' => 'SCOPE',
        'SpyAclEntityRuleTableMap::COL_SCOPE' => 'SCOPE',
        'COL_SCOPE' => 'SCOPE',
        'spy_acl_entity_rule.scope' => 'SCOPE',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyAclEntityRuleTableMap::COL_SCOPE => [
                            self::COL_SCOPE_GLOBAL,
            self::COL_SCOPE_SEGMENT,
            self::COL_SCOPE_INHERITED,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('spy_acl_entity_rule');
        $this->setPhpName('SpyAclEntityRule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntityRule');
        $this->setPackage('src.Orm.Zed.AclEntity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_acl_entity_rule_pk_seq');
        // columns
        $this->addPrimaryKey('id_acl_entity_rule', 'IdAclEntityRule', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_acl_entity_segment', 'FkAclEntitySegment', 'INTEGER', 'spy_acl_entity_segment', 'id_acl_entity_segment', false, null, null);
        $this->addForeignKey('fk_acl_role', 'FkAclRole', 'INTEGER', 'spy_acl_role', 'id_acl_role', true, null, null);
        $this->addColumn('entity', 'Entity', 'VARCHAR', true, 255, null);
        $this->addColumn('permission_mask', 'PermissionMask', 'INTEGER', true, null, null);
        $this->addColumn('scope', 'Scope', 'ENUM', true, null, null);
        $this->getColumn('scope')->setValueSet(array (
  0 => 'global',
  1 => 'segment',
  2 => 'inherited',
));
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyAclRole', '\\Orm\\Zed\\Acl\\Persistence\\SpyAclRole', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_acl_role',
    1 => ':id_acl_role',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyAclEntitySegment', '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntitySegment', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_acl_entity_segment',
    1 => ':id_acl_entity_segment',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAclEntityRule', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAclEntityRuleTableMap::CLASS_DEFAULT : SpyAclEntityRuleTableMap::OM_CLASS;
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
     * @return array (SpyAclEntityRule object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAclEntityRuleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAclEntityRuleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAclEntityRuleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAclEntityRuleTableMap::OM_CLASS;
            /** @var SpyAclEntityRule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAclEntityRuleTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAclEntityRuleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAclEntityRuleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAclEntityRule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAclEntityRuleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE);
            $criteria->addSelectColumn(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT);
            $criteria->addSelectColumn(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE);
            $criteria->addSelectColumn(SpyAclEntityRuleTableMap::COL_ENTITY);
            $criteria->addSelectColumn(SpyAclEntityRuleTableMap::COL_PERMISSION_MASK);
            $criteria->addSelectColumn(SpyAclEntityRuleTableMap::COL_SCOPE);
        } else {
            $criteria->addSelectColumn($alias . '.id_acl_entity_rule');
            $criteria->addSelectColumn($alias . '.fk_acl_entity_segment');
            $criteria->addSelectColumn($alias . '.fk_acl_role');
            $criteria->addSelectColumn($alias . '.entity');
            $criteria->addSelectColumn($alias . '.permission_mask');
            $criteria->addSelectColumn($alias . '.scope');
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
            $criteria->removeSelectColumn(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE);
            $criteria->removeSelectColumn(SpyAclEntityRuleTableMap::COL_FK_ACL_ENTITY_SEGMENT);
            $criteria->removeSelectColumn(SpyAclEntityRuleTableMap::COL_FK_ACL_ROLE);
            $criteria->removeSelectColumn(SpyAclEntityRuleTableMap::COL_ENTITY);
            $criteria->removeSelectColumn(SpyAclEntityRuleTableMap::COL_PERMISSION_MASK);
            $criteria->removeSelectColumn(SpyAclEntityRuleTableMap::COL_SCOPE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_acl_entity_rule');
            $criteria->removeSelectColumn($alias . '.fk_acl_entity_segment');
            $criteria->removeSelectColumn($alias . '.fk_acl_role');
            $criteria->removeSelectColumn($alias . '.entity');
            $criteria->removeSelectColumn($alias . '.permission_mask');
            $criteria->removeSelectColumn($alias . '.scope');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAclEntityRuleTableMap::DATABASE_NAME)->getTable(SpyAclEntityRuleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAclEntityRule or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAclEntityRule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntityRuleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\AclEntity\Persistence\SpyAclEntityRule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAclEntityRuleTableMap::DATABASE_NAME);
            $criteria->add(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE, (array) $values, Criteria::IN);
        }

        $query = SpyAclEntityRuleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAclEntityRuleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAclEntityRuleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_acl_entity_rule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAclEntityRuleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAclEntityRule or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAclEntityRule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntityRuleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAclEntityRule object
        }

        if ($criteria->containsKey(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE) && $criteria->keyContainsValue(SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAclEntityRuleTableMap::COL_ID_ACL_ENTITY_RULE.')');
        }


        // Set the correct dbName
        $query = SpyAclEntityRuleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
