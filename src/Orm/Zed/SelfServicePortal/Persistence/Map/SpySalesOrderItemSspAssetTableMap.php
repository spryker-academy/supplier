<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAssetQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_ssp_asset' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemSspAssetTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpySalesOrderItemSspAssetTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_ssp_asset';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemSspAsset';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySalesOrderItemSspAsset';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpySalesOrderItemSspAsset';

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
     * the column name for the id_sales_order_item_ssp_asset field
     */
    public const COL_ID_SALES_ORDER_ITEM_SSP_ASSET = 'spy_sales_order_item_ssp_asset.id_sales_order_item_ssp_asset';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_item_ssp_asset.fk_sales_order_item';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_sales_order_item_ssp_asset.name';

    /**
     * the column name for the reference field
     */
    public const COL_REFERENCE = 'spy_sales_order_item_ssp_asset.reference';

    /**
     * the column name for the serial_number field
     */
    public const COL_SERIAL_NUMBER = 'spy_sales_order_item_ssp_asset.serial_number';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_item_ssp_asset.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_item_ssp_asset.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemSspAsset', 'FkSalesOrderItem', 'Name', 'Reference', 'SerialNumber', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemSspAsset', 'fkSalesOrderItem', 'name', 'reference', 'serialNumber', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET, SpySalesOrderItemSspAssetTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderItemSspAssetTableMap::COL_NAME, SpySalesOrderItemSspAssetTableMap::COL_REFERENCE, SpySalesOrderItemSspAssetTableMap::COL_SERIAL_NUMBER, SpySalesOrderItemSspAssetTableMap::COL_CREATED_AT, SpySalesOrderItemSspAssetTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_ssp_asset', 'fk_sales_order_item', 'name', 'reference', 'serial_number', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemSspAsset' => 0, 'FkSalesOrderItem' => 1, 'Name' => 2, 'Reference' => 3, 'SerialNumber' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemSspAsset' => 0, 'fkSalesOrderItem' => 1, 'name' => 2, 'reference' => 3, 'serialNumber' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET => 0, SpySalesOrderItemSspAssetTableMap::COL_FK_SALES_ORDER_ITEM => 1, SpySalesOrderItemSspAssetTableMap::COL_NAME => 2, SpySalesOrderItemSspAssetTableMap::COL_REFERENCE => 3, SpySalesOrderItemSspAssetTableMap::COL_SERIAL_NUMBER => 4, SpySalesOrderItemSspAssetTableMap::COL_CREATED_AT => 5, SpySalesOrderItemSspAssetTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_ssp_asset' => 0, 'fk_sales_order_item' => 1, 'name' => 2, 'reference' => 3, 'serial_number' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderItemSspAsset' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'SpySalesOrderItemSspAsset.IdSalesOrderItemSspAsset' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'idSalesOrderItemSspAsset' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'spySalesOrderItemSspAsset.idSalesOrderItemSspAsset' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'COL_ID_SALES_ORDER_ITEM_SSP_ASSET' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'id_sales_order_item_ssp_asset' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'spy_sales_order_item_ssp_asset.id_sales_order_item_ssp_asset' => 'ID_SALES_ORDER_ITEM_SSP_ASSET',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemSspAsset.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderItemSspAsset.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemSspAssetTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_item_ssp_asset.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'Name' => 'NAME',
        'SpySalesOrderItemSspAsset.Name' => 'NAME',
        'name' => 'NAME',
        'spySalesOrderItemSspAsset.name' => 'NAME',
        'SpySalesOrderItemSspAssetTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_sales_order_item_ssp_asset.name' => 'NAME',
        'Reference' => 'REFERENCE',
        'SpySalesOrderItemSspAsset.Reference' => 'REFERENCE',
        'reference' => 'REFERENCE',
        'spySalesOrderItemSspAsset.reference' => 'REFERENCE',
        'SpySalesOrderItemSspAssetTableMap::COL_REFERENCE' => 'REFERENCE',
        'COL_REFERENCE' => 'REFERENCE',
        'spy_sales_order_item_ssp_asset.reference' => 'REFERENCE',
        'SerialNumber' => 'SERIAL_NUMBER',
        'SpySalesOrderItemSspAsset.SerialNumber' => 'SERIAL_NUMBER',
        'serialNumber' => 'SERIAL_NUMBER',
        'spySalesOrderItemSspAsset.serialNumber' => 'SERIAL_NUMBER',
        'SpySalesOrderItemSspAssetTableMap::COL_SERIAL_NUMBER' => 'SERIAL_NUMBER',
        'COL_SERIAL_NUMBER' => 'SERIAL_NUMBER',
        'serial_number' => 'SERIAL_NUMBER',
        'spy_sales_order_item_ssp_asset.serial_number' => 'SERIAL_NUMBER',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderItemSspAsset.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderItemSspAsset.createdAt' => 'CREATED_AT',
        'SpySalesOrderItemSspAssetTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_item_ssp_asset.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemSspAsset.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderItemSspAsset.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemSspAssetTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_item_ssp_asset.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_item_ssp_asset');
        $this->setPhpName('SpySalesOrderItemSspAsset');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySalesOrderItemSspAsset');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_item_ssp_asset_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_item_ssp_asset', 'IdSalesOrderItemSspAsset', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', true, 255, null);
        $this->addColumn('serial_number', 'SerialNumber', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SalesOrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderItemSspAsset', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderItemSspAssetTableMap::CLASS_DEFAULT : SpySalesOrderItemSspAssetTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemSspAsset object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemSspAssetTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemSspAssetTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemSspAssetTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemSspAssetTableMap::OM_CLASS;
            /** @var SpySalesOrderItemSspAsset $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemSspAssetTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemSspAssetTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemSspAssetTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemSspAsset $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemSspAssetTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET);
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_REFERENCE);
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_SERIAL_NUMBER);
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_item_ssp_asset');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.reference');
            $criteria->addSelectColumn($alias . '.serial_number');
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
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET);
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_REFERENCE);
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_SERIAL_NUMBER);
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemSspAssetTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_item_ssp_asset');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.reference');
            $criteria->removeSelectColumn($alias . '.serial_number');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemSspAssetTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemSspAssetTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemSspAsset or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemSspAsset object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemSspAssetTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySalesOrderItemSspAsset) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemSspAssetTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderItemSspAssetQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemSspAssetTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemSspAssetTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_ssp_asset table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemSspAssetQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemSspAsset or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemSspAsset object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemSspAssetTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemSspAsset object
        }

        if ($criteria->containsKey(SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET) && $criteria->keyContainsValue(SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderItemSspAssetTableMap::COL_ID_SALES_ORDER_ITEM_SSP_ASSET.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderItemSspAssetQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
