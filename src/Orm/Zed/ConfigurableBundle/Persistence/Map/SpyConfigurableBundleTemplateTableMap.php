<?php

namespace Orm\Zed\ConfigurableBundle\Persistence\Map;

use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateQuery;
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
 * This class defines the structure of the 'spy_configurable_bundle_template' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyConfigurableBundleTemplateTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ConfigurableBundle.Persistence.Map.SpyConfigurableBundleTemplateTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_configurable_bundle_template';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyConfigurableBundleTemplate';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplate';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ConfigurableBundle.Persistence.SpyConfigurableBundleTemplate';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_configurable_bundle_template field
     */
    public const COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE = 'spy_configurable_bundle_template.id_configurable_bundle_template';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_configurable_bundle_template.is_active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_configurable_bundle_template.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_configurable_bundle_template.name';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_configurable_bundle_template.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_configurable_bundle_template.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_configurable_bundle_template.updated_at';

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
        self::TYPE_PHPNAME       => ['IdConfigurableBundleTemplate', 'IsActive', 'Key', 'Name', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idConfigurableBundleTemplate', 'isActive', 'key', 'name', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE, SpyConfigurableBundleTemplateTableMap::COL_IS_ACTIVE, SpyConfigurableBundleTemplateTableMap::COL_KEY, SpyConfigurableBundleTemplateTableMap::COL_NAME, SpyConfigurableBundleTemplateTableMap::COL_UUID, SpyConfigurableBundleTemplateTableMap::COL_CREATED_AT, SpyConfigurableBundleTemplateTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_configurable_bundle_template', 'is_active', 'key', 'name', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdConfigurableBundleTemplate' => 0, 'IsActive' => 1, 'Key' => 2, 'Name' => 3, 'Uuid' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idConfigurableBundleTemplate' => 0, 'isActive' => 1, 'key' => 2, 'name' => 3, 'uuid' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE => 0, SpyConfigurableBundleTemplateTableMap::COL_IS_ACTIVE => 1, SpyConfigurableBundleTemplateTableMap::COL_KEY => 2, SpyConfigurableBundleTemplateTableMap::COL_NAME => 3, SpyConfigurableBundleTemplateTableMap::COL_UUID => 4, SpyConfigurableBundleTemplateTableMap::COL_CREATED_AT => 5, SpyConfigurableBundleTemplateTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_configurable_bundle_template' => 0, 'is_active' => 1, 'key' => 2, 'name' => 3, 'uuid' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdConfigurableBundleTemplate' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'SpyConfigurableBundleTemplate.IdConfigurableBundleTemplate' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'idConfigurableBundleTemplate' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'spyConfigurableBundleTemplate.idConfigurableBundleTemplate' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'id_configurable_bundle_template' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'spy_configurable_bundle_template.id_configurable_bundle_template' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE',
        'IsActive' => 'IS_ACTIVE',
        'SpyConfigurableBundleTemplate.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyConfigurableBundleTemplate.isActive' => 'IS_ACTIVE',
        'SpyConfigurableBundleTemplateTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_configurable_bundle_template.is_active' => 'IS_ACTIVE',
        'Key' => 'KEY',
        'SpyConfigurableBundleTemplate.Key' => 'KEY',
        'key' => 'KEY',
        'spyConfigurableBundleTemplate.key' => 'KEY',
        'SpyConfigurableBundleTemplateTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_configurable_bundle_template.key' => 'KEY',
        'Name' => 'NAME',
        'SpyConfigurableBundleTemplate.Name' => 'NAME',
        'name' => 'NAME',
        'spyConfigurableBundleTemplate.name' => 'NAME',
        'SpyConfigurableBundleTemplateTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_configurable_bundle_template.name' => 'NAME',
        'Uuid' => 'UUID',
        'SpyConfigurableBundleTemplate.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyConfigurableBundleTemplate.uuid' => 'UUID',
        'SpyConfigurableBundleTemplateTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_configurable_bundle_template.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyConfigurableBundleTemplate.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyConfigurableBundleTemplate.createdAt' => 'CREATED_AT',
        'SpyConfigurableBundleTemplateTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_configurable_bundle_template.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyConfigurableBundleTemplate.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyConfigurableBundleTemplate.updatedAt' => 'UPDATED_AT',
        'SpyConfigurableBundleTemplateTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_configurable_bundle_template.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_configurable_bundle_template');
        $this->setPhpName('SpyConfigurableBundleTemplate');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplate');
        $this->setPackage('src.Orm.Zed.ConfigurableBundle.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_configurable_bundle_template_pk_seq');
        // columns
        $this->addPrimaryKey('id_configurable_bundle_template', 'IdConfigurableBundleTemplate', 'INTEGER', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyConfigurableBundleTemplateSlot', '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplateSlot', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_configurable_bundle_template',
    1 => ':id_configurable_bundle_template',
  ),
), null, null, 'SpyConfigurableBundleTemplateSlots', false);
        $this->addRelation('SpyProductImageSet', '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSet', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_resource_configurable_bundle_template',
    1 => ':id_configurable_bundle_template',
  ),
), null, null, 'SpyProductImageSets', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_configurable_bundle_template'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_configurable_bundle_template_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdConfigurableBundleTemplate', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyConfigurableBundleTemplateTableMap::CLASS_DEFAULT : SpyConfigurableBundleTemplateTableMap::OM_CLASS;
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
     * @return array (SpyConfigurableBundleTemplate object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyConfigurableBundleTemplateTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyConfigurableBundleTemplateTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyConfigurableBundleTemplateTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyConfigurableBundleTemplateTableMap::OM_CLASS;
            /** @var SpyConfigurableBundleTemplate $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyConfigurableBundleTemplateTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyConfigurableBundleTemplateTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyConfigurableBundleTemplateTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyConfigurableBundleTemplate $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyConfigurableBundleTemplateTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_configurable_bundle_template');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_configurable_bundle_template');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyConfigurableBundleTemplateTableMap::DATABASE_NAME)->getTable(SpyConfigurableBundleTemplateTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyConfigurableBundleTemplate or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyConfigurableBundleTemplate object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyConfigurableBundleTemplateTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplate) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyConfigurableBundleTemplateTableMap::DATABASE_NAME);
            $criteria->add(SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE, (array) $values, Criteria::IN);
        }

        $query = SpyConfigurableBundleTemplateQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyConfigurableBundleTemplateTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyConfigurableBundleTemplateTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_configurable_bundle_template table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyConfigurableBundleTemplateQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyConfigurableBundleTemplate or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyConfigurableBundleTemplate object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyConfigurableBundleTemplateTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyConfigurableBundleTemplate object
        }

        if ($criteria->containsKey(SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE) && $criteria->keyContainsValue(SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyConfigurableBundleTemplateTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE.')');
        }


        // Set the correct dbName
        $query = SpyConfigurableBundleTemplateQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
