<?php

namespace Orm\Zed\DynamicEntity\Persistence\Map;

use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelationQuery;
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
 * This class defines the structure of the 'spy_dynamic_entity_configuration_relation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDynamicEntityConfigurationRelationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.DynamicEntity.Persistence.Map.SpyDynamicEntityConfigurationRelationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_dynamic_entity_configuration_relation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDynamicEntityConfigurationRelation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.DynamicEntity.Persistence.SpyDynamicEntityConfigurationRelation';

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
     * the column name for the id_dynamic_entity_configuration_relation field
     */
    public const COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION = 'spy_dynamic_entity_configuration_relation.id_dynamic_entity_configuration_relation';

    /**
     * the column name for the fk_parent_dynamic_entity_configuration field
     */
    public const COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION = 'spy_dynamic_entity_configuration_relation.fk_parent_dynamic_entity_configuration';

    /**
     * the column name for the fk_child_dynamic_entity_configuration field
     */
    public const COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION = 'spy_dynamic_entity_configuration_relation.fk_child_dynamic_entity_configuration';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_dynamic_entity_configuration_relation.name';

    /**
     * the column name for the is_editable field
     */
    public const COL_IS_EDITABLE = 'spy_dynamic_entity_configuration_relation.is_editable';

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
        self::TYPE_PHPNAME       => ['IdDynamicEntityConfigurationRelation', 'FkParentDynamicEntityConfiguration', 'FkChildDynamicEntityConfiguration', 'Name', 'IsEditable', ],
        self::TYPE_CAMELNAME     => ['idDynamicEntityConfigurationRelation', 'fkParentDynamicEntityConfiguration', 'fkChildDynamicEntityConfiguration', 'name', 'isEditable', ],
        self::TYPE_COLNAME       => [SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION, SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION, SpyDynamicEntityConfigurationRelationTableMap::COL_NAME, SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE, ],
        self::TYPE_FIELDNAME     => ['id_dynamic_entity_configuration_relation', 'fk_parent_dynamic_entity_configuration', 'fk_child_dynamic_entity_configuration', 'name', 'is_editable', ],
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
        self::TYPE_PHPNAME       => ['IdDynamicEntityConfigurationRelation' => 0, 'FkParentDynamicEntityConfiguration' => 1, 'FkChildDynamicEntityConfiguration' => 2, 'Name' => 3, 'IsEditable' => 4, ],
        self::TYPE_CAMELNAME     => ['idDynamicEntityConfigurationRelation' => 0, 'fkParentDynamicEntityConfiguration' => 1, 'fkChildDynamicEntityConfiguration' => 2, 'name' => 3, 'isEditable' => 4, ],
        self::TYPE_COLNAME       => [SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION => 0, SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION => 1, SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION => 2, SpyDynamicEntityConfigurationRelationTableMap::COL_NAME => 3, SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE => 4, ],
        self::TYPE_FIELDNAME     => ['id_dynamic_entity_configuration_relation' => 0, 'fk_parent_dynamic_entity_configuration' => 1, 'fk_child_dynamic_entity_configuration' => 2, 'name' => 3, 'is_editable' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDynamicEntityConfigurationRelation' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'SpyDynamicEntityConfigurationRelation.IdDynamicEntityConfigurationRelation' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'idDynamicEntityConfigurationRelation' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'spyDynamicEntityConfigurationRelation.idDynamicEntityConfigurationRelation' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'id_dynamic_entity_configuration_relation' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'spy_dynamic_entity_configuration_relation.id_dynamic_entity_configuration_relation' => 'ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION',
        'FkParentDynamicEntityConfiguration' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'SpyDynamicEntityConfigurationRelation.FkParentDynamicEntityConfiguration' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'fkParentDynamicEntityConfiguration' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'spyDynamicEntityConfigurationRelation.fkParentDynamicEntityConfiguration' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'fk_parent_dynamic_entity_configuration' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'spy_dynamic_entity_configuration_relation.fk_parent_dynamic_entity_configuration' => 'FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION',
        'FkChildDynamicEntityConfiguration' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'SpyDynamicEntityConfigurationRelation.FkChildDynamicEntityConfiguration' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'fkChildDynamicEntityConfiguration' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'spyDynamicEntityConfigurationRelation.fkChildDynamicEntityConfiguration' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'fk_child_dynamic_entity_configuration' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'spy_dynamic_entity_configuration_relation.fk_child_dynamic_entity_configuration' => 'FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION',
        'Name' => 'NAME',
        'SpyDynamicEntityConfigurationRelation.Name' => 'NAME',
        'name' => 'NAME',
        'spyDynamicEntityConfigurationRelation.name' => 'NAME',
        'SpyDynamicEntityConfigurationRelationTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_dynamic_entity_configuration_relation.name' => 'NAME',
        'IsEditable' => 'IS_EDITABLE',
        'SpyDynamicEntityConfigurationRelation.IsEditable' => 'IS_EDITABLE',
        'isEditable' => 'IS_EDITABLE',
        'spyDynamicEntityConfigurationRelation.isEditable' => 'IS_EDITABLE',
        'SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE' => 'IS_EDITABLE',
        'COL_IS_EDITABLE' => 'IS_EDITABLE',
        'is_editable' => 'IS_EDITABLE',
        'spy_dynamic_entity_configuration_relation.is_editable' => 'IS_EDITABLE',
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
        $this->setName('spy_dynamic_entity_configuration_relation');
        $this->setPhpName('SpyDynamicEntityConfigurationRelation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation');
        $this->setPackage('src.Orm.Zed.DynamicEntity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_dynamic_entity_configuration_relation_pk_seq');
        // columns
        $this->addPrimaryKey('id_dynamic_entity_configuration_relation', 'IdDynamicEntityConfigurationRelation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_parent_dynamic_entity_configuration', 'FkParentDynamicEntityConfiguration', 'INTEGER', 'spy_dynamic_entity_configuration', 'id_dynamic_entity_configuration', true, null, null);
        $this->addForeignKey('fk_child_dynamic_entity_configuration', 'FkChildDynamicEntityConfiguration', 'INTEGER', 'spy_dynamic_entity_configuration', 'id_dynamic_entity_configuration', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('is_editable', 'IsEditable', 'BOOLEAN', true, 1, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyDynamicEntityConfigurationRelatedByFkParentDynamicEntityConfiguration', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfiguration', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_parent_dynamic_entity_configuration',
    1 => ':id_dynamic_entity_configuration',
  ),
), null, null, null, false);
        $this->addRelation('SpyDynamicEntityConfigurationRelatedByFkChildDynamicEntityConfiguration', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfiguration', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_child_dynamic_entity_configuration',
    1 => ':id_dynamic_entity_configuration',
  ),
), null, null, null, false);
        $this->addRelation('SpyDynamicEntityConfigurationRelationFieldMapping', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelationFieldMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_dynamic_entity_configuration_relation',
    1 => ':id_dynamic_entity_configuration_relation',
  ),
), null, null, 'SpyDynamicEntityConfigurationRelationFieldMappings', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDynamicEntityConfigurationRelation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDynamicEntityConfigurationRelationTableMap::CLASS_DEFAULT : SpyDynamicEntityConfigurationRelationTableMap::OM_CLASS;
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
     * @return array (SpyDynamicEntityConfigurationRelation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDynamicEntityConfigurationRelationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDynamicEntityConfigurationRelationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDynamicEntityConfigurationRelationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDynamicEntityConfigurationRelationTableMap::OM_CLASS;
            /** @var SpyDynamicEntityConfigurationRelation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDynamicEntityConfigurationRelationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDynamicEntityConfigurationRelationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDynamicEntityConfigurationRelationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDynamicEntityConfigurationRelation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDynamicEntityConfigurationRelationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE);
        } else {
            $criteria->addSelectColumn($alias . '.id_dynamic_entity_configuration_relation');
            $criteria->addSelectColumn($alias . '.fk_parent_dynamic_entity_configuration');
            $criteria->addSelectColumn($alias . '.fk_child_dynamic_entity_configuration');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.is_editable');
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
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_PARENT_DYNAMIC_ENTITY_CONFIGURATION);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_FK_CHILD_DYNAMIC_ENTITY_CONFIGURATION);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationRelationTableMap::COL_IS_EDITABLE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_dynamic_entity_configuration_relation');
            $criteria->removeSelectColumn($alias . '.fk_parent_dynamic_entity_configuration');
            $criteria->removeSelectColumn($alias . '.fk_child_dynamic_entity_configuration');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.is_editable');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME)->getTable(SpyDynamicEntityConfigurationRelationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDynamicEntityConfigurationRelation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDynamicEntityConfigurationRelation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationRelation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
            $criteria->add(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION, (array) $values, Criteria::IN);
        }

        $query = SpyDynamicEntityConfigurationRelationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDynamicEntityConfigurationRelationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDynamicEntityConfigurationRelationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_dynamic_entity_configuration_relation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDynamicEntityConfigurationRelationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDynamicEntityConfigurationRelation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDynamicEntityConfigurationRelation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationRelationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDynamicEntityConfigurationRelation object
        }

        if ($criteria->containsKey(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION) && $criteria->keyContainsValue(SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDynamicEntityConfigurationRelationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION_RELATION.')');
        }


        // Set the correct dbName
        $query = SpyDynamicEntityConfigurationRelationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
