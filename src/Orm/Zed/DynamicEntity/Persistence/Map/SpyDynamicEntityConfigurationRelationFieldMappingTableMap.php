<?php

namespace Orm\Zed\DynamicEntity\Persistence\Map;

use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMappingQuery;
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
 * This class defines the structure of the 'spy_dynamic_entity_configuration_relation_field_mapping' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDynamicEntityConfigurationRelationFieldMappingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.DynamicEntity.Persistence.Map.SpyDynamicEntityConfigurationRelationFieldMappingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_dynamic_entity_configuration_relation_field_mapping';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDynamicEntityConfigurationRelationFieldMapping';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelationFieldMapping';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.DynamicEntity.Persistence.SpyDynamicEntityConfigurationRelationFieldMapping';

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
     * the column name for the id_dynamic_entity_configuration_relation_field_mapping field
     */
    public const COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING = 'spy_dynamic_entity_configuration_relation_field_mapping.id_dynamic_entity_configuration_relation_field_mapping';

    /**
     * the column name for the fk_dynamic_entity_configuration_relation field
     */
    public const COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION = 'spy_dynamic_entity_configuration_relation_field_mapping.fk_dynamic_entity_configuration_relation';

    /**
     * the column name for the child_field_name field
     */
    public const COL_CHILD_FIELD_NAME = 'spy_dynamic_entity_configuration_relation_field_mapping.child_field_name';

    /**
     * the column name for the parent_field_name field
     */
    public const COL_PARENT_FIELD_NAME = 'spy_dynamic_entity_configuration_relation_field_mapping.parent_field_name';

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
        self::TYPE_PHPNAME       => ['IdDynamicEntityConfigurationRelationFieldMapping', 'FkDynamicEntityConfigurationRelation', 'ChildFieldName', 'ParentFieldName', ],
        self::TYPE_CAMELNAME     => ['idDynamicEntityConfigurationRelationFieldMapping', 'fkDynamicEntityConfigurationRelation', 'childFieldName', 'parentFieldName', ],
        self::TYPE_COLNAME       => [SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION, SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_CHILD_FIELD_NAME, SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_PARENT_FIELD_NAME, ],
        self::TYPE_FIELDNAME     => ['id_dynamic_entity_configuration_relation_field_mapping', 'fk_dynamic_entity_configuration_relation', 'child_field_name', 'parent_field_name', ],
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
        self::TYPE_PHPNAME       => ['IdDynamicEntityConfigurationRelationFieldMapping' => 0, 'FkDynamicEntityConfigurationRelation' => 1, 'ChildFieldName' => 2, 'ParentFieldName' => 3, ],
        self::TYPE_CAMELNAME     => ['idDynamicEntityConfigurationRelationFieldMapping' => 0, 'fkDynamicEntityConfigurationRelation' => 1, 'childFieldName' => 2, 'parentFieldName' => 3, ],
        self::TYPE_COLNAME       => [SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING => 0, SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION => 1, SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_CHILD_FIELD_NAME => 2, SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_PARENT_FIELD_NAME => 3, ],
        self::TYPE_FIELDNAME     => ['id_dynamic_entity_configuration_relation_field_mapping' => 0, 'fk_dynamic_entity_configuration_relation' => 1, 'child_field_name' => 2, 'parent_field_name' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDynamicEntityConfigurationRelationFieldMapping' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'SpyDynamicEntityConfigurationRelationFieldMapping.IdDynamicEntityConfigurationRelationFieldMapping' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'idDynamicEntityConfigurationRelationFieldMapping' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'spyDynamicEntityConfigurationRelationFieldMapping.idDynamicEntityConfigurationRelationFieldMapping' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'id_dynamic_entity_configuration_relation_field_mapping' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'spy_dynamic_entity_configuration_relation_field_mapping.id_dynamic_entity_configuration_relation_field_mapping' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING',
        'FkDynamicEntityConfigurationRelation' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'SpyDynamicEntityConfigurationRelationFieldMapping.FkDynamicEntityConfigurationRelation' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'fkDynamicEntityConfigurationRelation' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'spyDynamicEntityConfigurationRelationFieldMapping.fkDynamicEntityConfigurationRelation' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'fk_dynamic_entity_configuration_relation' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'spy_dynamic_entity_configuration_relation_field_mapping.fk_dynamic_entity_configuration_relation' => 'FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'ChildFieldName' => 'CHILD_FIELD_NAME',
        'SpyDynamicEntityConfigurationRelationFieldMapping.ChildFieldName' => 'CHILD_FIELD_NAME',
        'childFieldName' => 'CHILD_FIELD_NAME',
        'spyDynamicEntityConfigurationRelationFieldMapping.childFieldName' => 'CHILD_FIELD_NAME',
        'SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_CHILD_FIELD_NAME' => 'CHILD_FIELD_NAME',
        'COL_CHILD_FIELD_NAME' => 'CHILD_FIELD_NAME',
        'child_field_name' => 'CHILD_FIELD_NAME',
        'spy_dynamic_entity_configuration_relation_field_mapping.child_field_name' => 'CHILD_FIELD_NAME',
        'ParentFieldName' => 'PARENT_FIELD_NAME',
        'SpyDynamicEntityConfigurationRelationFieldMapping.ParentFieldName' => 'PARENT_FIELD_NAME',
        'parentFieldName' => 'PARENT_FIELD_NAME',
        'spyDynamicEntityConfigurationRelationFieldMapping.parentFieldName' => 'PARENT_FIELD_NAME',
        'SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_PARENT_FIELD_NAME' => 'PARENT_FIELD_NAME',
        'COL_PARENT_FIELD_NAME' => 'PARENT_FIELD_NAME',
        'parent_field_name' => 'PARENT_FIELD_NAME',
        'spy_dynamic_entity_configuration_relation_field_mapping.parent_field_name' => 'PARENT_FIELD_NAME',
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
        $this->setName('spy_dynamic_entity_configuration_relation_field_mapping');
        $this->setPhpName('SpyDynamicEntityConfigurationRelationFieldMapping');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelationFieldMapping');
        $this->setPackage('src.Orm.Zed.DynamicEntity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_dynamic_entity_configuration_relation_field_mapping_pk_seq');
        // columns
        $this->addPrimaryKey('id_dynamic_entity_configuration_relation_field_mapping', 'IdDynamicEntityConfigurationRelationFieldMapping', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_dynamic_entity_configuration_relation', 'FkDynamicEntityConfigurationRelation', 'INTEGER', 'spy_dynamic_entity_configuration_relation', 'id_dynamic_entity_configuration_relation', true, null, null);
        $this->addColumn('child_field_name', 'ChildFieldName', 'VARCHAR', true, 255, null);
        $this->addColumn('parent_field_name', 'ParentFieldName', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyDynamicEntityConfigurationRelation', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_dynamic_entity_configuration_relation',
    1 => ':id_dynamic_entity_configuration_relation',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDynamicEntityConfigurationRelationFieldMapping', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDynamicEntityConfigurationRelationFieldMappingTableMap::CLASS_DEFAULT : SpyDynamicEntityConfigurationRelationFieldMappingTableMap::OM_CLASS;
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
     * @return array (SpyDynamicEntityConfigurationRelationFieldMapping object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDynamicEntityConfigurationRelationFieldMappingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::OM_CLASS;
            /** @var SpyDynamicEntityConfigurationRelationFieldMapping $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDynamicEntityConfigurationRelationFieldMappingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDynamicEntityConfigurationRelationFieldMapping $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDynamicEntityConfigurationRelationFieldMappingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_CHILD_FIELD_NAME);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_PARENT_FIELD_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_dynamic_entity_configuration_relation_field_mapping');
            $criteria->addSelectColumn($alias . '.fk_dynamic_entity_configuration_relation');
            $criteria->addSelectColumn($alias . '.child_field_name');
            $criteria->addSelectColumn($alias . '.parent_field_name');
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
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_FK_DYNAMIC_ENTITY_CONFIGURATION_RELATION);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_CHILD_FIELD_NAME);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_PARENT_FIELD_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_dynamic_entity_configuration_relation_field_mapping');
            $criteria->removeSelectColumn($alias . '.fk_dynamic_entity_configuration_relation');
            $criteria->removeSelectColumn($alias . '.child_field_name');
            $criteria->removeSelectColumn($alias . '.parent_field_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME)->getTable(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDynamicEntityConfigurationRelationFieldMapping or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDynamicEntityConfigurationRelationFieldMapping object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationFieldMapping) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME);
            $criteria->add(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING, (array) $values, Criteria::IN);
        }

        $query = SpyDynamicEntityConfigurationRelationFieldMappingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDynamicEntityConfigurationRelationFieldMappingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDynamicEntityConfigurationRelationFieldMappingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_dynamic_entity_configuration_relation_field_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDynamicEntityConfigurationRelationFieldMappingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDynamicEntityConfigurationRelationFieldMapping or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDynamicEntityConfigurationRelationFieldMapping object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDynamicEntityConfigurationRelationFieldMapping object
        }

        if ($criteria->containsKey(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING) && $criteria->keyContainsValue(SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDynamicEntityConfigurationRelationFieldMappingTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION_FIELD_MAPPING.')');
        }


        // Set the correct dbName
        $query = SpyDynamicEntityConfigurationRelationFieldMappingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
