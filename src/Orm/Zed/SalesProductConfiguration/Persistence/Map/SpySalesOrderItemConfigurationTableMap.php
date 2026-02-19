<?php

namespace Orm\Zed\SalesProductConfiguration\Persistence\Map;

use Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration;
use Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfigurationQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_configuration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemConfigurationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesProductConfiguration.Persistence.Map.SpySalesOrderItemConfigurationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_configuration';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemConfiguration';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesProductConfiguration\\Persistence\\SpySalesOrderItemConfiguration';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesProductConfiguration.Persistence.SpySalesOrderItemConfiguration';

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
     * the column name for the id_sales_order_item_configuration field
     */
    public const COL_ID_SALES_ORDER_ITEM_CONFIGURATION = 'spy_sales_order_item_configuration.id_sales_order_item_configuration';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_item_configuration.fk_sales_order_item';

    /**
     * the column name for the display_data field
     */
    public const COL_DISPLAY_DATA = 'spy_sales_order_item_configuration.display_data';

    /**
     * the column name for the configuration field
     */
    public const COL_CONFIGURATION = 'spy_sales_order_item_configuration.configuration';

    /**
     * the column name for the configurator_key field
     */
    public const COL_CONFIGURATOR_KEY = 'spy_sales_order_item_configuration.configurator_key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_item_configuration.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_item_configuration.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemConfiguration', 'FkSalesOrderItem', 'DisplayData', 'Configuration', 'ConfiguratorKey', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemConfiguration', 'fkSalesOrderItem', 'displayData', 'configuration', 'configuratorKey', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION, SpySalesOrderItemConfigurationTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderItemConfigurationTableMap::COL_DISPLAY_DATA, SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATION, SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATOR_KEY, SpySalesOrderItemConfigurationTableMap::COL_CREATED_AT, SpySalesOrderItemConfigurationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_configuration', 'fk_sales_order_item', 'display_data', 'configuration', 'configurator_key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemConfiguration' => 0, 'FkSalesOrderItem' => 1, 'DisplayData' => 2, 'Configuration' => 3, 'ConfiguratorKey' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemConfiguration' => 0, 'fkSalesOrderItem' => 1, 'displayData' => 2, 'configuration' => 3, 'configuratorKey' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION => 0, SpySalesOrderItemConfigurationTableMap::COL_FK_SALES_ORDER_ITEM => 1, SpySalesOrderItemConfigurationTableMap::COL_DISPLAY_DATA => 2, SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATION => 3, SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATOR_KEY => 4, SpySalesOrderItemConfigurationTableMap::COL_CREATED_AT => 5, SpySalesOrderItemConfigurationTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_configuration' => 0, 'fk_sales_order_item' => 1, 'display_data' => 2, 'configuration' => 3, 'configurator_key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderItemConfiguration' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'SpySalesOrderItemConfiguration.IdSalesOrderItemConfiguration' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'idSalesOrderItemConfiguration' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'spySalesOrderItemConfiguration.idSalesOrderItemConfiguration' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'COL_ID_SALES_ORDER_ITEM_CONFIGURATION' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'id_sales_order_item_configuration' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'spy_sales_order_item_configuration.id_sales_order_item_configuration' => 'ID_SALES_ORDER_ITEM_CONFIGURATION',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemConfiguration.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderItemConfiguration.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemConfigurationTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_item_configuration.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'DisplayData' => 'DISPLAY_DATA',
        'SpySalesOrderItemConfiguration.DisplayData' => 'DISPLAY_DATA',
        'displayData' => 'DISPLAY_DATA',
        'spySalesOrderItemConfiguration.displayData' => 'DISPLAY_DATA',
        'SpySalesOrderItemConfigurationTableMap::COL_DISPLAY_DATA' => 'DISPLAY_DATA',
        'COL_DISPLAY_DATA' => 'DISPLAY_DATA',
        'display_data' => 'DISPLAY_DATA',
        'spy_sales_order_item_configuration.display_data' => 'DISPLAY_DATA',
        'Configuration' => 'CONFIGURATION',
        'SpySalesOrderItemConfiguration.Configuration' => 'CONFIGURATION',
        'configuration' => 'CONFIGURATION',
        'spySalesOrderItemConfiguration.configuration' => 'CONFIGURATION',
        'SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATION' => 'CONFIGURATION',
        'COL_CONFIGURATION' => 'CONFIGURATION',
        'spy_sales_order_item_configuration.configuration' => 'CONFIGURATION',
        'ConfiguratorKey' => 'CONFIGURATOR_KEY',
        'SpySalesOrderItemConfiguration.ConfiguratorKey' => 'CONFIGURATOR_KEY',
        'configuratorKey' => 'CONFIGURATOR_KEY',
        'spySalesOrderItemConfiguration.configuratorKey' => 'CONFIGURATOR_KEY',
        'SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATOR_KEY' => 'CONFIGURATOR_KEY',
        'COL_CONFIGURATOR_KEY' => 'CONFIGURATOR_KEY',
        'configurator_key' => 'CONFIGURATOR_KEY',
        'spy_sales_order_item_configuration.configurator_key' => 'CONFIGURATOR_KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderItemConfiguration.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderItemConfiguration.createdAt' => 'CREATED_AT',
        'SpySalesOrderItemConfigurationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_item_configuration.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemConfiguration.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderItemConfiguration.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemConfigurationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_item_configuration.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_item_configuration');
        $this->setPhpName('SpySalesOrderItemConfiguration');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesProductConfiguration\\Persistence\\SpySalesOrderItemConfiguration');
        $this->setPackage('src.Orm.Zed.SalesProductConfiguration.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_item_configuration_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_item_configuration', 'IdSalesOrderItemConfiguration', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('display_data', 'DisplayData', 'CLOB', false, null, null);
        $this->addColumn('configuration', 'Configuration', 'CLOB', false, null, null);
        $this->addColumn('configurator_key', 'ConfiguratorKey', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpySalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_item',
    1 => ':id_sales_order_item',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderItemConfiguration', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderItemConfigurationTableMap::CLASS_DEFAULT : SpySalesOrderItemConfigurationTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemConfiguration object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemConfigurationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemConfigurationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemConfigurationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemConfigurationTableMap::OM_CLASS;
            /** @var SpySalesOrderItemConfiguration $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemConfigurationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemConfigurationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemConfiguration $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemConfigurationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION);
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_DISPLAY_DATA);
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATION);
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATOR_KEY);
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_item_configuration');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.display_data');
            $criteria->addSelectColumn($alias . '.configuration');
            $criteria->addSelectColumn($alias . '.configurator_key');
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
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION);
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_DISPLAY_DATA);
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATION);
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_CONFIGURATOR_KEY);
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemConfigurationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_item_configuration');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.display_data');
            $criteria->removeSelectColumn($alias . '.configuration');
            $criteria->removeSelectColumn($alias . '.configurator_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemConfigurationTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemConfigurationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemConfiguration or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemConfiguration object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemConfigurationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesProductConfiguration\Persistence\SpySalesOrderItemConfiguration) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemConfigurationTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderItemConfigurationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemConfigurationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemConfigurationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_configuration table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemConfigurationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemConfiguration or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemConfiguration object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemConfigurationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemConfiguration object
        }

        if ($criteria->containsKey(SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION) && $criteria->keyContainsValue(SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderItemConfigurationTableMap::COL_ID_SALES_ORDER_ITEM_CONFIGURATION.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderItemConfigurationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
