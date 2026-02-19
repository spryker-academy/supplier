<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadataQuery;
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
 * This class defines the structure of the 'spy_sales_order_item_metadata' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderItemMetadataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesOrderItemMetadataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_item_metadata';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderItemMetadata';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItemMetadata';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesOrderItemMetadata';

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
     * the column name for the id_sales_order_item_metadata field
     */
    public const COL_ID_SALES_ORDER_ITEM_METADATA = 'spy_sales_order_item_metadata.id_sales_order_item_metadata';

    /**
     * the column name for the fk_sales_order_item field
     */
    public const COL_FK_SALES_ORDER_ITEM = 'spy_sales_order_item_metadata.fk_sales_order_item';

    /**
     * the column name for the image field
     */
    public const COL_IMAGE = 'spy_sales_order_item_metadata.image';

    /**
     * the column name for the scheduled_at field
     */
    public const COL_SCHEDULED_AT = 'spy_sales_order_item_metadata.scheduled_at';

    /**
     * the column name for the super_attributes field
     */
    public const COL_SUPER_ATTRIBUTES = 'spy_sales_order_item_metadata.super_attributes';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_item_metadata.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_item_metadata.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemMetadata', 'FkSalesOrderItem', 'Image', 'ScheduledAt', 'SuperAttributes', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemMetadata', 'fkSalesOrderItem', 'image', 'scheduledAt', 'superAttributes', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA, SpySalesOrderItemMetadataTableMap::COL_FK_SALES_ORDER_ITEM, SpySalesOrderItemMetadataTableMap::COL_IMAGE, SpySalesOrderItemMetadataTableMap::COL_SCHEDULED_AT, SpySalesOrderItemMetadataTableMap::COL_SUPER_ATTRIBUTES, SpySalesOrderItemMetadataTableMap::COL_CREATED_AT, SpySalesOrderItemMetadataTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_metadata', 'fk_sales_order_item', 'image', 'scheduled_at', 'super_attributes', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderItemMetadata' => 0, 'FkSalesOrderItem' => 1, 'Image' => 2, 'ScheduledAt' => 3, 'SuperAttributes' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderItemMetadata' => 0, 'fkSalesOrderItem' => 1, 'image' => 2, 'scheduledAt' => 3, 'superAttributes' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA => 0, SpySalesOrderItemMetadataTableMap::COL_FK_SALES_ORDER_ITEM => 1, SpySalesOrderItemMetadataTableMap::COL_IMAGE => 2, SpySalesOrderItemMetadataTableMap::COL_SCHEDULED_AT => 3, SpySalesOrderItemMetadataTableMap::COL_SUPER_ATTRIBUTES => 4, SpySalesOrderItemMetadataTableMap::COL_CREATED_AT => 5, SpySalesOrderItemMetadataTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_item_metadata' => 0, 'fk_sales_order_item' => 1, 'image' => 2, 'scheduled_at' => 3, 'super_attributes' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderItemMetadata' => 'ID_SALES_ORDER_ITEM_METADATA',
        'SpySalesOrderItemMetadata.IdSalesOrderItemMetadata' => 'ID_SALES_ORDER_ITEM_METADATA',
        'idSalesOrderItemMetadata' => 'ID_SALES_ORDER_ITEM_METADATA',
        'spySalesOrderItemMetadata.idSalesOrderItemMetadata' => 'ID_SALES_ORDER_ITEM_METADATA',
        'SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA' => 'ID_SALES_ORDER_ITEM_METADATA',
        'COL_ID_SALES_ORDER_ITEM_METADATA' => 'ID_SALES_ORDER_ITEM_METADATA',
        'id_sales_order_item_metadata' => 'ID_SALES_ORDER_ITEM_METADATA',
        'spy_sales_order_item_metadata.id_sales_order_item_metadata' => 'ID_SALES_ORDER_ITEM_METADATA',
        'FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemMetadata.FkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'spySalesOrderItemMetadata.fkSalesOrderItem' => 'FK_SALES_ORDER_ITEM',
        'SpySalesOrderItemMetadataTableMap::COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'COL_FK_SALES_ORDER_ITEM' => 'FK_SALES_ORDER_ITEM',
        'fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'spy_sales_order_item_metadata.fk_sales_order_item' => 'FK_SALES_ORDER_ITEM',
        'Image' => 'IMAGE',
        'SpySalesOrderItemMetadata.Image' => 'IMAGE',
        'image' => 'IMAGE',
        'spySalesOrderItemMetadata.image' => 'IMAGE',
        'SpySalesOrderItemMetadataTableMap::COL_IMAGE' => 'IMAGE',
        'COL_IMAGE' => 'IMAGE',
        'spy_sales_order_item_metadata.image' => 'IMAGE',
        'ScheduledAt' => 'SCHEDULED_AT',
        'SpySalesOrderItemMetadata.ScheduledAt' => 'SCHEDULED_AT',
        'scheduledAt' => 'SCHEDULED_AT',
        'spySalesOrderItemMetadata.scheduledAt' => 'SCHEDULED_AT',
        'SpySalesOrderItemMetadataTableMap::COL_SCHEDULED_AT' => 'SCHEDULED_AT',
        'COL_SCHEDULED_AT' => 'SCHEDULED_AT',
        'scheduled_at' => 'SCHEDULED_AT',
        'spy_sales_order_item_metadata.scheduled_at' => 'SCHEDULED_AT',
        'SuperAttributes' => 'SUPER_ATTRIBUTES',
        'SpySalesOrderItemMetadata.SuperAttributes' => 'SUPER_ATTRIBUTES',
        'superAttributes' => 'SUPER_ATTRIBUTES',
        'spySalesOrderItemMetadata.superAttributes' => 'SUPER_ATTRIBUTES',
        'SpySalesOrderItemMetadataTableMap::COL_SUPER_ATTRIBUTES' => 'SUPER_ATTRIBUTES',
        'COL_SUPER_ATTRIBUTES' => 'SUPER_ATTRIBUTES',
        'super_attributes' => 'SUPER_ATTRIBUTES',
        'spy_sales_order_item_metadata.super_attributes' => 'SUPER_ATTRIBUTES',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderItemMetadata.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderItemMetadata.createdAt' => 'CREATED_AT',
        'SpySalesOrderItemMetadataTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_item_metadata.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemMetadata.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderItemMetadata.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderItemMetadataTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_item_metadata.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_item_metadata');
        $this->setPhpName('SpySalesOrderItemMetadata');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItemMetadata');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_item_metadata_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_item_metadata', 'IdSalesOrderItemMetadata', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order_item', 'FkSalesOrderItem', 'INTEGER', 'spy_sales_order_item', 'id_sales_order_item', true, null, null);
        $this->addColumn('image', 'Image', 'LONGVARCHAR', false, null, null);
        $this->addColumn('scheduled_at', 'ScheduledAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('super_attributes', 'SuperAttributes', 'LONGVARCHAR', true, null, null);
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
        $this->addRelation('OrderItem', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderItem', RelationMap::MANY_TO_ONE, array (
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderItemMetadata', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderItemMetadataTableMap::CLASS_DEFAULT : SpySalesOrderItemMetadataTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderItemMetadata object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderItemMetadataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderItemMetadataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderItemMetadataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderItemMetadataTableMap::OM_CLASS;
            /** @var SpySalesOrderItemMetadata $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderItemMetadataTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderItemMetadataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderItemMetadataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderItemMetadata $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderItemMetadataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA);
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_IMAGE);
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_SCHEDULED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_SUPER_ATTRIBUTES);
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderItemMetadataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_item_metadata');
            $criteria->addSelectColumn($alias . '.fk_sales_order_item');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.scheduled_at');
            $criteria->addSelectColumn($alias . '.super_attributes');
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
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA);
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_FK_SALES_ORDER_ITEM);
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_IMAGE);
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_SCHEDULED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_SUPER_ATTRIBUTES);
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderItemMetadataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_item_metadata');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_item');
            $criteria->removeSelectColumn($alias . '.image');
            $criteria->removeSelectColumn($alias . '.scheduled_at');
            $criteria->removeSelectColumn($alias . '.super_attributes');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderItemMetadataTableMap::DATABASE_NAME)->getTable(SpySalesOrderItemMetadataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderItemMetadata or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderItemMetadata object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemMetadataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderItemMetadata) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderItemMetadataTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderItemMetadataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderItemMetadataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderItemMetadataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_item_metadata table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderItemMetadataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderItemMetadata or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderItemMetadata object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderItemMetadataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderItemMetadata object
        }

        if ($criteria->containsKey(SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA) && $criteria->keyContainsValue(SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderItemMetadataTableMap::COL_ID_SALES_ORDER_ITEM_METADATA.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderItemMetadataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
