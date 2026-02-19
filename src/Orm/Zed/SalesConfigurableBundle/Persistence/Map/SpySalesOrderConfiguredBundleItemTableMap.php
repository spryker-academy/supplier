<?php

namespace Orm\Zed\SalesConfigurableBundle\Persistence\Map;

use Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem;
use Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItemQuery;
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
 * This class defines the structure of the 'spy_sales_order_configured_bundle_item' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderConfiguredBundleItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesConfigurableBundle.Persistence.Map.SpySalesOrderConfiguredBundleItemTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_configured_bundle_item';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderConfiguredBundleItem';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesConfigurableBundle\\Persistence\\SpySalesOrderConfiguredBundleItem';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesConfigurableBundle.Persistence.SpySalesOrderConfiguredBundleItem';

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
     * the column name for the id_sales_order_configured_bundle_item field
     */
    public const COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM = 'spy_sales_order_configured_bundle_item.id_sales_order_configured_bundle_item';

    /**
     * the column name for the fk_sales_order_configured_bundle field
     */
    public const COL_FK_SALES_ORDER_CONFIGURED_BUNDLE = 'spy_sales_order_configured_bundle_item.fk_sales_order_configured_bundle';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_configured_bundle_item.fk_sales_order_item';

    /**
     * the column name for the configurable_bundle_template_slot_uuid field
     */
    public const COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID = 'spy_sales_order_configured_bundle_item.configurable_bundle_template_slot_uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_configured_bundle_item.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_configured_bundle_item.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderConfiguredBundleItem', 'FkSalesOrderConfiguredBundle', 'FkSalesOrderItem', 'ConfigurableBundleTemplateSlotUuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderConfiguredBundleItem', 'fkSalesOrderConfiguredBundle', 'fkSalesOrderItem', 'configurableBundleTemplateSlotUuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM, SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_CONFIGURED_BUNDLE, SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderConfiguredBundleItemTableMap::COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID, SpySalesOrderConfiguredBundleItemTableMap::COL_CREATED_AT, SpySalesOrderConfiguredBundleItemTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_configured_bundle_item', 'fk_sales_order_configured_bundle', 'fk_sales_order_item', 'configurable_bundle_template_slot_uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderConfiguredBundleItem' => 0, 'FkSalesOrderConfiguredBundle' => 1, 'FkSalesOrderItem' => 2, 'ConfigurableBundleTemplateSlotUuid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderConfiguredBundleItem' => 0, 'fkSalesOrderConfiguredBundle' => 1, 'fkSalesOrderItem' => 2, 'configurableBundleTemplateSlotUuid' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM => 0, SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_CONFIGURED_BUNDLE => 1, SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_ITEM => 2, SpySalesOrderConfiguredBundleItemTableMap::COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID => 3, SpySalesOrderConfiguredBundleItemTableMap::COL_CREATED_AT => 4, SpySalesOrderConfiguredBundleItemTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_configured_bundle_item' => 0, 'fk_sales_order_configured_bundle' => 1, 'fk_sales_order_item' => 2, 'configurable_bundle_template_slot_uuid' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderConfiguredBundleItem' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'SpySalesOrderConfiguredBundleItem.IdSalesOrderConfiguredBundleItem' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'idSalesOrderConfiguredBundleItem' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'spySalesOrderConfiguredBundleItem.idSalesOrderConfiguredBundleItem' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'id_sales_order_configured_bundle_item' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'spy_sales_order_configured_bundle_item.id_sales_order_configured_bundle_item' => 'ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM',
        'FkSalesOrderConfiguredBundle' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'SpySalesOrderConfiguredBundleItem.FkSalesOrderConfiguredBundle' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'fkSalesOrderConfiguredBundle' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'spySalesOrderConfiguredBundleItem.fkSalesOrderConfiguredBundle' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_CONFIGURED_BUNDLE' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'COL_FK_SALES_ORDER_CONFIGURED_BUNDLE' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'fk_sales_order_configured_bundle' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'spy_sales_order_configured_bundle_item.fk_sales_order_configured_bundle' => 'FK_SALES_ORDER_CONFIGURED_BUNDLE',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderConfiguredBundleItem.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderConfiguredBundleItem.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_configured_bundle_item.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'ConfigurableBundleTemplateSlotUuid' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'SpySalesOrderConfiguredBundleItem.ConfigurableBundleTemplateSlotUuid' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'configurableBundleTemplateSlotUuid' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'spySalesOrderConfiguredBundleItem.configurableBundleTemplateSlotUuid' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'SpySalesOrderConfiguredBundleItemTableMap::COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'configurable_bundle_template_slot_uuid' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'spy_sales_order_configured_bundle_item.configurable_bundle_template_slot_uuid' => 'CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderConfiguredBundleItem.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderConfiguredBundleItem.createdAt' => 'CREATED_AT',
        'SpySalesOrderConfiguredBundleItemTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_configured_bundle_item.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderConfiguredBundleItem.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderConfiguredBundleItem.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderConfiguredBundleItemTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_configured_bundle_item.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_configured_bundle_item');
        $this->setPhpName('SpySalesOrderConfiguredBundleItem');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesConfigurableBundle\\Persistence\\SpySalesOrderConfiguredBundleItem');
        $this->setPackage('src.Orm.Zed.SalesConfigurableBundle.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_configured_bundle_item_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_configured_bundle_item', 'IdSalesOrderConfiguredBundleItem', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order_configured_bundle', 'FkSalesOrderConfiguredBundle', 'INTEGER', 'spy_sales_order_configured_bundle', 'id_sales_order_configured_bundle', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('configurable_bundle_template_slot_uuid', 'ConfigurableBundleTemplateSlotUuid', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpySalesOrderConfiguredBundle', '\\Orm\\Zed\\SalesConfigurableBundle\\Persistence\\SpySalesOrderConfiguredBundle', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_configured_bundle',
    1 => ':id_sales_order_configured_bundle',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderConfiguredBundleItem', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderConfiguredBundleItemTableMap::CLASS_DEFAULT : SpySalesOrderConfiguredBundleItemTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderConfiguredBundleItem object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderConfiguredBundleItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderConfiguredBundleItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderConfiguredBundleItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderConfiguredBundleItemTableMap::OM_CLASS;
            /** @var SpySalesOrderConfiguredBundleItem $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderConfiguredBundleItemTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderConfiguredBundleItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderConfiguredBundleItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderConfiguredBundleItem $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderConfiguredBundleItemTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM);
            $criteria->addSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_CONFIGURED_BUNDLE);
            $criteria->addSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID);
            $criteria->addSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_configured_bundle_item');
            $criteria->addSelectColumn($alias . '.fk_sales_order_configured_bundle');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.configurable_bundle_template_slot_uuid');
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
            $criteria->removeSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_CONFIGURED_BUNDLE);
            $criteria->removeSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT_UUID);
            $criteria->removeSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderConfiguredBundleItemTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_configured_bundle_item');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_configured_bundle');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.configurable_bundle_template_slot_uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderConfiguredBundleItemTableMap::DATABASE_NAME)->getTable(SpySalesOrderConfiguredBundleItemTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderConfiguredBundleItem or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderConfiguredBundleItem object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderConfiguredBundleItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesConfigurableBundle\Persistence\SpySalesOrderConfiguredBundleItem) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderConfiguredBundleItemTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderConfiguredBundleItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderConfiguredBundleItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderConfiguredBundleItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_configured_bundle_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderConfiguredBundleItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderConfiguredBundleItem or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderConfiguredBundleItem object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderConfiguredBundleItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderConfiguredBundleItem object
        }

        if ($criteria->containsKey(SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM) && $criteria->keyContainsValue(SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderConfiguredBundleItemTableMap::COL_ID_SALES_ORDER_CONFIGURED_BUNDLE_ITEM.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderConfiguredBundleItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
