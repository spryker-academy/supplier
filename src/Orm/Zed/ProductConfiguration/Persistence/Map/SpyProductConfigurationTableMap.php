<?php

namespace Orm\Zed\ProductConfiguration\Persistence\Map;

use Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration;
use Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery;
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
 * This class defines the structure of the 'spy_product_configuration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductConfigurationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductConfiguration.Persistence.Map.SpyProductConfigurationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_configuration';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductConfiguration';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductConfiguration\\Persistence\\SpyProductConfiguration';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductConfiguration.Persistence.SpyProductConfiguration';

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
     * the column name for the id_product_configuration field
     */
    public const COL_ID_PRODUCT_CONFIGURATION = 'spy_product_configuration.id_product_configuration';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_configuration.fk_product';

    /**
     * the column name for the configurator_key field
     */
    public const COL_CONFIGURATOR_KEY = 'spy_product_configuration.configurator_key';

    /**
     * the column name for the default_configuration field
     */
    public const COL_DEFAULT_CONFIGURATION = 'spy_product_configuration.default_configuration';

    /**
     * the column name for the default_display_data field
     */
    public const COL_DEFAULT_DISPLAY_DATA = 'spy_product_configuration.default_display_data';

    /**
     * the column name for the is_complete field
     */
    public const COL_IS_COMPLETE = 'spy_product_configuration.is_complete';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_product_configuration.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_configuration.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_configuration.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductConfiguration', 'FkProduct', 'ConfiguratorKey', 'DefaultConfiguration', 'DefaultDisplayData', 'IsComplete', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductConfiguration', 'fkProduct', 'configuratorKey', 'defaultConfiguration', 'defaultDisplayData', 'isComplete', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION, SpyProductConfigurationTableMap::COL_FK_PRODUCT, SpyProductConfigurationTableMap::COL_CONFIGURATOR_KEY, SpyProductConfigurationTableMap::COL_DEFAULT_CONFIGURATION, SpyProductConfigurationTableMap::COL_DEFAULT_DISPLAY_DATA, SpyProductConfigurationTableMap::COL_IS_COMPLETE, SpyProductConfigurationTableMap::COL_UUID, SpyProductConfigurationTableMap::COL_CREATED_AT, SpyProductConfigurationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_configuration', 'fk_product', 'configurator_key', 'default_configuration', 'default_display_data', 'is_complete', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductConfiguration' => 0, 'FkProduct' => 1, 'ConfiguratorKey' => 2, 'DefaultConfiguration' => 3, 'DefaultDisplayData' => 4, 'IsComplete' => 5, 'Uuid' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idProductConfiguration' => 0, 'fkProduct' => 1, 'configuratorKey' => 2, 'defaultConfiguration' => 3, 'defaultDisplayData' => 4, 'isComplete' => 5, 'uuid' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION => 0, SpyProductConfigurationTableMap::COL_FK_PRODUCT => 1, SpyProductConfigurationTableMap::COL_CONFIGURATOR_KEY => 2, SpyProductConfigurationTableMap::COL_DEFAULT_CONFIGURATION => 3, SpyProductConfigurationTableMap::COL_DEFAULT_DISPLAY_DATA => 4, SpyProductConfigurationTableMap::COL_IS_COMPLETE => 5, SpyProductConfigurationTableMap::COL_UUID => 6, SpyProductConfigurationTableMap::COL_CREATED_AT => 7, SpyProductConfigurationTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_product_configuration' => 0, 'fk_product' => 1, 'configurator_key' => 2, 'default_configuration' => 3, 'default_display_data' => 4, 'is_complete' => 5, 'uuid' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductConfiguration' => 'ID_PRODUCT_CONFIGURATION',
        'SpyProductConfiguration.IdProductConfiguration' => 'ID_PRODUCT_CONFIGURATION',
        'idProductConfiguration' => 'ID_PRODUCT_CONFIGURATION',
        'spyProductConfiguration.idProductConfiguration' => 'ID_PRODUCT_CONFIGURATION',
        'SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION' => 'ID_PRODUCT_CONFIGURATION',
        'COL_ID_PRODUCT_CONFIGURATION' => 'ID_PRODUCT_CONFIGURATION',
        'id_product_configuration' => 'ID_PRODUCT_CONFIGURATION',
        'spy_product_configuration.id_product_configuration' => 'ID_PRODUCT_CONFIGURATION',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductConfiguration.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductConfiguration.fkProduct' => 'FK_PRODUCT',
        'SpyProductConfigurationTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_configuration.fk_product' => 'FK_PRODUCT',
        'ConfiguratorKey' => 'CONFIGURATOR_KEY',
        'SpyProductConfiguration.ConfiguratorKey' => 'CONFIGURATOR_KEY',
        'configuratorKey' => 'CONFIGURATOR_KEY',
        'spyProductConfiguration.configuratorKey' => 'CONFIGURATOR_KEY',
        'SpyProductConfigurationTableMap::COL_CONFIGURATOR_KEY' => 'CONFIGURATOR_KEY',
        'COL_CONFIGURATOR_KEY' => 'CONFIGURATOR_KEY',
        'configurator_key' => 'CONFIGURATOR_KEY',
        'spy_product_configuration.configurator_key' => 'CONFIGURATOR_KEY',
        'DefaultConfiguration' => 'DEFAULT_CONFIGURATION',
        'SpyProductConfiguration.DefaultConfiguration' => 'DEFAULT_CONFIGURATION',
        'defaultConfiguration' => 'DEFAULT_CONFIGURATION',
        'spyProductConfiguration.defaultConfiguration' => 'DEFAULT_CONFIGURATION',
        'SpyProductConfigurationTableMap::COL_DEFAULT_CONFIGURATION' => 'DEFAULT_CONFIGURATION',
        'COL_DEFAULT_CONFIGURATION' => 'DEFAULT_CONFIGURATION',
        'default_configuration' => 'DEFAULT_CONFIGURATION',
        'spy_product_configuration.default_configuration' => 'DEFAULT_CONFIGURATION',
        'DefaultDisplayData' => 'DEFAULT_DISPLAY_DATA',
        'SpyProductConfiguration.DefaultDisplayData' => 'DEFAULT_DISPLAY_DATA',
        'defaultDisplayData' => 'DEFAULT_DISPLAY_DATA',
        'spyProductConfiguration.defaultDisplayData' => 'DEFAULT_DISPLAY_DATA',
        'SpyProductConfigurationTableMap::COL_DEFAULT_DISPLAY_DATA' => 'DEFAULT_DISPLAY_DATA',
        'COL_DEFAULT_DISPLAY_DATA' => 'DEFAULT_DISPLAY_DATA',
        'default_display_data' => 'DEFAULT_DISPLAY_DATA',
        'spy_product_configuration.default_display_data' => 'DEFAULT_DISPLAY_DATA',
        'IsComplete' => 'IS_COMPLETE',
        'SpyProductConfiguration.IsComplete' => 'IS_COMPLETE',
        'isComplete' => 'IS_COMPLETE',
        'spyProductConfiguration.isComplete' => 'IS_COMPLETE',
        'SpyProductConfigurationTableMap::COL_IS_COMPLETE' => 'IS_COMPLETE',
        'COL_IS_COMPLETE' => 'IS_COMPLETE',
        'is_complete' => 'IS_COMPLETE',
        'spy_product_configuration.is_complete' => 'IS_COMPLETE',
        'Uuid' => 'UUID',
        'SpyProductConfiguration.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyProductConfiguration.uuid' => 'UUID',
        'SpyProductConfigurationTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_product_configuration.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductConfiguration.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductConfiguration.createdAt' => 'CREATED_AT',
        'SpyProductConfigurationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_configuration.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductConfiguration.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductConfiguration.updatedAt' => 'UPDATED_AT',
        'SpyProductConfigurationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_configuration.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_configuration');
        $this->setPhpName('SpyProductConfiguration');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductConfiguration\\Persistence\\SpyProductConfiguration');
        $this->setPackage('src.Orm.Zed.ProductConfiguration.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_configuration_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_configuration', 'IdProductConfiguration', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addColumn('configurator_key', 'ConfiguratorKey', 'VARCHAR', true, 255, null);
        $this->addColumn('default_configuration', 'DefaultConfiguration', 'CLOB', false, null, null);
        $this->addColumn('default_display_data', 'DefaultDisplayData', 'CLOB', false, null, null);
        $this->addColumn('is_complete', 'IsComplete', 'BOOLEAN', true, 1, false);
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
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_product_configuration'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_product_configuration_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductConfiguration', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductConfigurationTableMap::CLASS_DEFAULT : SpyProductConfigurationTableMap::OM_CLASS;
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
     * @return array (SpyProductConfiguration object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductConfigurationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductConfigurationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductConfigurationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductConfigurationTableMap::OM_CLASS;
            /** @var SpyProductConfiguration $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductConfigurationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductConfigurationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductConfiguration $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_CONFIGURATOR_KEY);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_DEFAULT_CONFIGURATION);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_DEFAULT_DISPLAY_DATA);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_IS_COMPLETE);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_configuration');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.configurator_key');
            $criteria->addSelectColumn($alias . '.default_configuration');
            $criteria->addSelectColumn($alias . '.default_display_data');
            $criteria->addSelectColumn($alias . '.is_complete');
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
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_CONFIGURATOR_KEY);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_DEFAULT_CONFIGURATION);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_DEFAULT_DISPLAY_DATA);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_IS_COMPLETE);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_configuration');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.configurator_key');
            $criteria->removeSelectColumn($alias . '.default_configuration');
            $criteria->removeSelectColumn($alias . '.default_display_data');
            $criteria->removeSelectColumn($alias . '.is_complete');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductConfigurationTableMap::DATABASE_NAME)->getTable(SpyProductConfigurationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductConfiguration or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductConfiguration object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductConfigurationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductConfigurationTableMap::DATABASE_NAME);
            $criteria->add(SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION, (array) $values, Criteria::IN);
        }

        $query = SpyProductConfigurationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductConfigurationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductConfigurationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductConfigurationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductConfiguration or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductConfiguration object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductConfigurationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductConfiguration object
        }

        if ($criteria->containsKey(SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION) && $criteria->keyContainsValue(SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductConfigurationTableMap::COL_ID_PRODUCT_CONFIGURATION.')');
        }


        // Set the correct dbName
        $query = SpyProductConfigurationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
