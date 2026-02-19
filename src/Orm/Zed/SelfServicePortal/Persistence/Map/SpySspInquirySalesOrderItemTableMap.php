<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItemQuery;
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
 * This class defines the structure of the 'spy_ssp_inquiry_sales_order_item' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySspInquirySalesOrderItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpySspInquirySalesOrderItemTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_ssp_inquiry_sales_order_item';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySspInquirySalesOrderItem';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquirySalesOrderItem';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpySspInquirySalesOrderItem';

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
     * the column name for the id_ssp_inquiry_sales_order_item field
     */
    public const COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM = 'spy_ssp_inquiry_sales_order_item.id_ssp_inquiry_sales_order_item';

    /**
     * the column name for the fk_ssp_inquiry_sales_order field
     */
    public const COL_FK_SSP_INQUIRY_SALES_ORDER = 'spy_ssp_inquiry_sales_order_item.fk_ssp_inquiry_sales_order';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_ssp_inquiry_sales_order_item.fk_sales_order_item';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_ssp_inquiry_sales_order_item.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_ssp_inquiry_sales_order_item.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_ssp_inquiry_sales_order_item.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSspInquirySalesOrderItem', 'FkSspInquirySalesOrder', 'FkSalesOrderItem', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSspInquirySalesOrderItem', 'fkSspInquirySalesOrder', 'fkSalesOrderItem', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySspInquirySalesOrderItemTableMap::COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM, SpySspInquirySalesOrderItemTableMap::COL_FK_SSP_INQUIRY_SALES_ORDER, SpySspInquirySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM, SpySspInquirySalesOrderItemTableMap::COL_UUID, SpySspInquirySalesOrderItemTableMap::COL_CREATED_AT, SpySspInquirySalesOrderItemTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_ssp_inquiry_sales_order_item', 'fk_ssp_inquiry_sales_order', 'fk_sales_order_item', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSspInquirySalesOrderItem' => 0, 'FkSspInquirySalesOrder' => 1, 'FkSalesOrderItem' => 2, 'Uuid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idSspInquirySalesOrderItem' => 0, 'fkSspInquirySalesOrder' => 1, 'fkSalesOrderItem' => 2, 'uuid' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpySspInquirySalesOrderItemTableMap::COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM => 0, SpySspInquirySalesOrderItemTableMap::COL_FK_SSP_INQUIRY_SALES_ORDER => 1, SpySspInquirySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM => 2, SpySspInquirySalesOrderItemTableMap::COL_UUID => 3, SpySspInquirySalesOrderItemTableMap::COL_CREATED_AT => 4, SpySspInquirySalesOrderItemTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_ssp_inquiry_sales_order_item' => 0, 'fk_ssp_inquiry_sales_order' => 1, 'fk_sales_order_item' => 2, 'uuid' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSspInquirySalesOrderItem' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'SpySspInquirySalesOrderItem.IdSspInquirySalesOrderItem' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'idSspInquirySalesOrderItem' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'spySspInquirySalesOrderItem.idSspInquirySalesOrderItem' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'SpySspInquirySalesOrderItemTableMap::COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'id_ssp_inquiry_sales_order_item' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'spy_ssp_inquiry_sales_order_item.id_ssp_inquiry_sales_order_item' => 'ID_SSP_INQUIRY_SALES_ORDER_ITEM',
        'FkSspInquirySalesOrder' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'SpySspInquirySalesOrderItem.FkSspInquirySalesOrder' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'fkSspInquirySalesOrder' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'spySspInquirySalesOrderItem.fkSspInquirySalesOrder' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'SpySspInquirySalesOrderItemTableMap::COL_FK_SSP_INQUIRY_SALES_ORDER' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'COL_FK_SSP_INQUIRY_SALES_ORDER' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'fk_ssp_inquiry_sales_order' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'spy_ssp_inquiry_sales_order_item.fk_ssp_inquiry_sales_order' => 'FK_SSP_INQUIRY_SALES_ORDER',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySspInquirySalesOrderItem.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySspInquirySalesOrderItem.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySspInquirySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_ssp_inquiry_sales_order_item.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'Uuid' => 'UUID',
        'SpySspInquirySalesOrderItem.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spySspInquirySalesOrderItem.uuid' => 'UUID',
        'SpySspInquirySalesOrderItemTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_ssp_inquiry_sales_order_item.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpySspInquirySalesOrderItem.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySspInquirySalesOrderItem.createdAt' => 'CREATED_AT',
        'SpySspInquirySalesOrderItemTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_ssp_inquiry_sales_order_item.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySspInquirySalesOrderItem.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySspInquirySalesOrderItem.updatedAt' => 'UPDATED_AT',
        'SpySspInquirySalesOrderItemTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_ssp_inquiry_sales_order_item.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_ssp_inquiry_sales_order_item');
        $this->setPhpName('SpySspInquirySalesOrderItem');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquirySalesOrderItem');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_ssp_inquiry_sales_order_item_pk_seq');
        // columns
        $this->addPrimaryKey('id_ssp_inquiry_sales_order_item', 'IdSspInquirySalesOrderItem', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_ssp_inquiry_sales_order', 'FkSspInquirySalesOrder', 'INTEGER', 'spy_ssp_inquiry_sales_order', 'id_ssp_inquiry_sales_order', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
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
        $this->addRelation('SpySspInquirySalesOrder', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquirySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_ssp_inquiry_sales_order',
    1 => ':id_ssp_inquiry_sales_order',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_ssp_inquiry_sales_order_item'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSspInquirySalesOrderItem', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySspInquirySalesOrderItemTableMap::CLASS_DEFAULT : SpySspInquirySalesOrderItemTableMap::OM_CLASS;
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
     * @return array (SpySspInquirySalesOrderItem object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySspInquirySalesOrderItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySspInquirySalesOrderItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySspInquirySalesOrderItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySspInquirySalesOrderItemTableMap::OM_CLASS;
            /** @var SpySspInquirySalesOrderItem $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySspInquirySalesOrderItemTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySspInquirySalesOrderItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySspInquirySalesOrderItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySspInquirySalesOrderItem $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySspInquirySalesOrderItemTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_FK_SSP_INQUIRY_SALES_ORDER);
            $criteria->addSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_UUID);
            $criteria->addSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_ssp_inquiry_sales_order_item');
            $criteria->addSelectColumn($alias . '.fk_ssp_inquiry_sales_order');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
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
            $criteria->removeSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_FK_SSP_INQUIRY_SALES_ORDER);
            $criteria->removeSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySspInquirySalesOrderItemTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_ssp_inquiry_sales_order_item');
            $criteria->removeSelectColumn($alias . '.fk_ssp_inquiry_sales_order');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySspInquirySalesOrderItemTableMap::DATABASE_NAME)->getTable(SpySspInquirySalesOrderItemTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySspInquirySalesOrderItem or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySspInquirySalesOrderItem object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquirySalesOrderItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderItem) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySspInquirySalesOrderItemTableMap::DATABASE_NAME);
            $criteria->add(SpySspInquirySalesOrderItemTableMap::COL_ID_SSP_INQUIRY_SALES_ORDER_ITEM, (array) $values, Criteria::IN);
        }

        $query = SpySspInquirySalesOrderItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySspInquirySalesOrderItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySspInquirySalesOrderItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_ssp_inquiry_sales_order_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySspInquirySalesOrderItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySspInquirySalesOrderItem or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySspInquirySalesOrderItem object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquirySalesOrderItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySspInquirySalesOrderItem object
        }


        // Set the correct dbName
        $query = SpySspInquirySalesOrderItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
