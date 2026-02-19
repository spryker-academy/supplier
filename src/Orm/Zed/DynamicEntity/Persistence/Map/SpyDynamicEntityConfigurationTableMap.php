<?php

namespace Orm\Zed\DynamicEntity\Persistence\Map;

use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration;
use Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfigurationQuery;
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
 * This class defines the structure of the 'spy_dynamic_entity_configuration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDynamicEntityConfigurationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.DynamicEntity.Persistence.Map.SpyDynamicEntityConfigurationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_dynamic_entity_configuration';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDynamicEntityConfiguration';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfiguration';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.DynamicEntity.Persistence.SpyDynamicEntityConfiguration';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_dynamic_entity_configuration field
     */
    public const COL_ID_DYNAMIC_ENTITY_CONFIGURATION = 'spy_dynamic_entity_configuration.id_dynamic_entity_configuration';

    /**
     * the column name for the table_alias field
     */
    public const COL_TABLE_ALIAS = 'spy_dynamic_entity_configuration.table_alias';

    /**
     * the column name for the table_name field
     */
    public const COL_TABLE_NAME = 'spy_dynamic_entity_configuration.table_name';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_dynamic_entity_configuration.is_active';

    /**
     * the column name for the definition field
     */
    public const COL_DEFINITION = 'spy_dynamic_entity_configuration.definition';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_dynamic_entity_configuration.type';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_dynamic_entity_configuration.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_dynamic_entity_configuration.updated_at';

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
        self::TYPE_PHPNAME       => ['IdDynamicEntityConfiguration', 'TableAlias', 'TableName', 'IsActive', 'Definition', 'Type', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idDynamicEntityConfiguration', 'tableAlias', 'tableName', 'isActive', 'definition', 'type', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS, SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME, SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE, SpyDynamicEntityConfigurationTableMap::COL_DEFINITION, SpyDynamicEntityConfigurationTableMap::COL_TYPE, SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT, SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_dynamic_entity_configuration', 'table_alias', 'table_name', 'is_active', 'definition', 'type', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdDynamicEntityConfiguration' => 0, 'TableAlias' => 1, 'TableName' => 2, 'IsActive' => 3, 'Definition' => 4, 'Type' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idDynamicEntityConfiguration' => 0, 'tableAlias' => 1, 'tableName' => 2, 'isActive' => 3, 'definition' => 4, 'type' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION => 0, SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS => 1, SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME => 2, SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE => 3, SpyDynamicEntityConfigurationTableMap::COL_DEFINITION => 4, SpyDynamicEntityConfigurationTableMap::COL_TYPE => 5, SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT => 6, SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_dynamic_entity_configuration' => 0, 'table_alias' => 1, 'table_name' => 2, 'is_active' => 3, 'definition' => 4, 'type' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDynamicEntityConfiguration' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'SpyDynamicEntityConfiguration.IdDynamicEntityConfiguration' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'idDynamicEntityConfiguration' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'spyDynamicEntityConfiguration.idDynamicEntityConfiguration' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'COL_ID_DYNAMIC_ENTITY_CONFIGURATION' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'id_dynamic_entity_configuration' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'spy_dynamic_entity_configuration.id_dynamic_entity_configuration' => 'ID_DYNAMIC_ENTITY_CONFIGURATION',
        'TableAlias' => 'TABLE_ALIAS',
        'SpyDynamicEntityConfiguration.TableAlias' => 'TABLE_ALIAS',
        'tableAlias' => 'TABLE_ALIAS',
        'spyDynamicEntityConfiguration.tableAlias' => 'TABLE_ALIAS',
        'SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS' => 'TABLE_ALIAS',
        'COL_TABLE_ALIAS' => 'TABLE_ALIAS',
        'table_alias' => 'TABLE_ALIAS',
        'spy_dynamic_entity_configuration.table_alias' => 'TABLE_ALIAS',
        'TableName' => 'TABLE_NAME',
        'SpyDynamicEntityConfiguration.TableName' => 'TABLE_NAME',
        'tableName' => 'TABLE_NAME',
        'spyDynamicEntityConfiguration.tableName' => 'TABLE_NAME',
        'SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME' => 'TABLE_NAME',
        'COL_TABLE_NAME' => 'TABLE_NAME',
        'table_name' => 'TABLE_NAME',
        'spy_dynamic_entity_configuration.table_name' => 'TABLE_NAME',
        'IsActive' => 'IS_ACTIVE',
        'SpyDynamicEntityConfiguration.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyDynamicEntityConfiguration.isActive' => 'IS_ACTIVE',
        'SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_dynamic_entity_configuration.is_active' => 'IS_ACTIVE',
        'Definition' => 'DEFINITION',
        'SpyDynamicEntityConfiguration.Definition' => 'DEFINITION',
        'definition' => 'DEFINITION',
        'spyDynamicEntityConfiguration.definition' => 'DEFINITION',
        'SpyDynamicEntityConfigurationTableMap::COL_DEFINITION' => 'DEFINITION',
        'COL_DEFINITION' => 'DEFINITION',
        'spy_dynamic_entity_configuration.definition' => 'DEFINITION',
        'Type' => 'TYPE',
        'SpyDynamicEntityConfiguration.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyDynamicEntityConfiguration.type' => 'TYPE',
        'SpyDynamicEntityConfigurationTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_dynamic_entity_configuration.type' => 'TYPE',
        'CreatedAt' => 'CREATED_AT',
        'SpyDynamicEntityConfiguration.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyDynamicEntityConfiguration.createdAt' => 'CREATED_AT',
        'SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_dynamic_entity_configuration.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyDynamicEntityConfiguration.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyDynamicEntityConfiguration.updatedAt' => 'UPDATED_AT',
        'SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_dynamic_entity_configuration.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_dynamic_entity_configuration');
        $this->setPhpName('SpyDynamicEntityConfiguration');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfiguration');
        $this->setPackage('src.Orm.Zed.DynamicEntity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_dynamic_entity_configuration_pk_seq');
        // columns
        $this->addPrimaryKey('id_dynamic_entity_configuration', 'IdDynamicEntityConfiguration', 'INTEGER', true, null, null);
        $this->addColumn('table_alias', 'TableAlias', 'VARCHAR', true, 255, null);
        $this->addColumn('table_name', 'TableName', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, false);
        $this->addColumn('definition', 'Definition', 'LONGVARCHAR', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyDynamicEntityConfigurationRelationRelatedByFkParentDynamicEntityConfiguration', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_parent_dynamic_entity_configuration',
    1 => ':id_dynamic_entity_configuration',
  ),
), null, null, 'SpyDynamicEntityConfigurationRelationsRelatedByFkParentDynamicEntityConfiguration', false);
        $this->addRelation('SpyDynamicEntityConfigurationRelationRelatedByFkChildDynamicEntityConfiguration', '\\Orm\\Zed\\DynamicEntity\\Persistence\\SpyDynamicEntityConfigurationRelation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_child_dynamic_entity_configuration',
    1 => ':id_dynamic_entity_configuration',
  ),
), null, null, 'SpyDynamicEntityConfigurationRelationsRelatedByFkChildDynamicEntityConfiguration', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDynamicEntityConfiguration', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDynamicEntityConfigurationTableMap::CLASS_DEFAULT : SpyDynamicEntityConfigurationTableMap::OM_CLASS;
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
     * @return array (SpyDynamicEntityConfiguration object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDynamicEntityConfigurationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDynamicEntityConfigurationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDynamicEntityConfigurationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDynamicEntityConfigurationTableMap::OM_CLASS;
            /** @var SpyDynamicEntityConfiguration $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDynamicEntityConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDynamicEntityConfigurationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDynamicEntityConfigurationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDynamicEntityConfiguration $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDynamicEntityConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_DEFINITION);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_dynamic_entity_configuration');
            $criteria->addSelectColumn($alias . '.table_alias');
            $criteria->addSelectColumn($alias . '.table_name');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.definition');
            $criteria->addSelectColumn($alias . '.type');
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
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_TABLE_ALIAS);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_TABLE_NAME);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_DEFINITION);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyDynamicEntityConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_dynamic_entity_configuration');
            $criteria->removeSelectColumn($alias . '.table_alias');
            $criteria->removeSelectColumn($alias . '.table_name');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.definition');
            $criteria->removeSelectColumn($alias . '.type');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME)->getTable(SpyDynamicEntityConfigurationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDynamicEntityConfiguration or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDynamicEntityConfiguration object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\DynamicEntity\Persistence\SpyDynamicEntityConfiguration) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
            $criteria->add(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION, (array) $values, Criteria::IN);
        }

        $query = SpyDynamicEntityConfigurationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDynamicEntityConfigurationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDynamicEntityConfigurationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_dynamic_entity_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDynamicEntityConfigurationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDynamicEntityConfiguration or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDynamicEntityConfiguration object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDynamicEntityConfigurationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDynamicEntityConfiguration object
        }

        if ($criteria->containsKey(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION) && $criteria->keyContainsValue(SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDynamicEntityConfigurationTableMap::COL_ID_DYNAMIC_ENTITY_CONFIGURATION.')');
        }


        // Set the correct dbName
        $query = SpyDynamicEntityConfigurationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
