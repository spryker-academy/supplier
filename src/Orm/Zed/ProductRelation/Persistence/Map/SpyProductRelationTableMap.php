<?php

namespace Orm\Zed\ProductRelation\Persistence\Map;

use Orm\Zed\ProductRelation\Persistence\SpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery;
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
 * This class defines the structure of the 'spy_product_relation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductRelationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductRelation.Persistence.Map.SpyProductRelationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_relation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductRelation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductRelation.Persistence.SpyProductRelation';

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
     * the column name for the id_product_relation field
     */
    public const COL_ID_PRODUCT_RELATION = 'spy_product_relation.id_product_relation';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product_relation.fk_product_abstract';

    /**
     * the column name for the fk_product_relation_type field
     */
    public const COL_FK_PRODUCT_RELATION_TYPE = 'spy_product_relation.fk_product_relation_type';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_product_relation.is_active';

    /**
     * the column name for the is_rebuild_scheduled field
     */
    public const COL_IS_REBUILD_SCHEDULED = 'spy_product_relation.is_rebuild_scheduled';

    /**
     * the column name for the product_relation_key field
     */
    public const COL_PRODUCT_RELATION_KEY = 'spy_product_relation.product_relation_key';

    /**
     * the column name for the query_set_data field
     */
    public const COL_QUERY_SET_DATA = 'spy_product_relation.query_set_data';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_relation.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_relation.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductRelation', 'FkProductAbstract', 'FkProductRelationType', 'IsActive', 'IsRebuildScheduled', 'ProductRelationKey', 'QuerySetData', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductRelation', 'fkProductAbstract', 'fkProductRelationType', 'isActive', 'isRebuildScheduled', 'productRelationKey', 'querySetData', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE, SpyProductRelationTableMap::COL_IS_ACTIVE, SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED, SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY, SpyProductRelationTableMap::COL_QUERY_SET_DATA, SpyProductRelationTableMap::COL_CREATED_AT, SpyProductRelationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_relation', 'fk_product_abstract', 'fk_product_relation_type', 'is_active', 'is_rebuild_scheduled', 'product_relation_key', 'query_set_data', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductRelation' => 0, 'FkProductAbstract' => 1, 'FkProductRelationType' => 2, 'IsActive' => 3, 'IsRebuildScheduled' => 4, 'ProductRelationKey' => 5, 'QuerySetData' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idProductRelation' => 0, 'fkProductAbstract' => 1, 'fkProductRelationType' => 2, 'isActive' => 3, 'isRebuildScheduled' => 4, 'productRelationKey' => 5, 'querySetData' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION => 0, SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT => 1, SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE => 2, SpyProductRelationTableMap::COL_IS_ACTIVE => 3, SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED => 4, SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY => 5, SpyProductRelationTableMap::COL_QUERY_SET_DATA => 6, SpyProductRelationTableMap::COL_CREATED_AT => 7, SpyProductRelationTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_product_relation' => 0, 'fk_product_abstract' => 1, 'fk_product_relation_type' => 2, 'is_active' => 3, 'is_rebuild_scheduled' => 4, 'product_relation_key' => 5, 'query_set_data' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductRelation' => 'ID_PRODUCT_RELATION',
        'SpyProductRelation.IdProductRelation' => 'ID_PRODUCT_RELATION',
        'idProductRelation' => 'ID_PRODUCT_RELATION',
        'spyProductRelation.idProductRelation' => 'ID_PRODUCT_RELATION',
        'SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION' => 'ID_PRODUCT_RELATION',
        'COL_ID_PRODUCT_RELATION' => 'ID_PRODUCT_RELATION',
        'id_product_relation' => 'ID_PRODUCT_RELATION',
        'spy_product_relation.id_product_relation' => 'ID_PRODUCT_RELATION',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductRelation.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProductRelation.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product_relation.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkProductRelationType' => 'FK_PRODUCT_RELATION_TYPE',
        'SpyProductRelation.FkProductRelationType' => 'FK_PRODUCT_RELATION_TYPE',
        'fkProductRelationType' => 'FK_PRODUCT_RELATION_TYPE',
        'spyProductRelation.fkProductRelationType' => 'FK_PRODUCT_RELATION_TYPE',
        'SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE' => 'FK_PRODUCT_RELATION_TYPE',
        'COL_FK_PRODUCT_RELATION_TYPE' => 'FK_PRODUCT_RELATION_TYPE',
        'fk_product_relation_type' => 'FK_PRODUCT_RELATION_TYPE',
        'spy_product_relation.fk_product_relation_type' => 'FK_PRODUCT_RELATION_TYPE',
        'IsActive' => 'IS_ACTIVE',
        'SpyProductRelation.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyProductRelation.isActive' => 'IS_ACTIVE',
        'SpyProductRelationTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_product_relation.is_active' => 'IS_ACTIVE',
        'IsRebuildScheduled' => 'IS_REBUILD_SCHEDULED',
        'SpyProductRelation.IsRebuildScheduled' => 'IS_REBUILD_SCHEDULED',
        'isRebuildScheduled' => 'IS_REBUILD_SCHEDULED',
        'spyProductRelation.isRebuildScheduled' => 'IS_REBUILD_SCHEDULED',
        'SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED' => 'IS_REBUILD_SCHEDULED',
        'COL_IS_REBUILD_SCHEDULED' => 'IS_REBUILD_SCHEDULED',
        'is_rebuild_scheduled' => 'IS_REBUILD_SCHEDULED',
        'spy_product_relation.is_rebuild_scheduled' => 'IS_REBUILD_SCHEDULED',
        'ProductRelationKey' => 'PRODUCT_RELATION_KEY',
        'SpyProductRelation.ProductRelationKey' => 'PRODUCT_RELATION_KEY',
        'productRelationKey' => 'PRODUCT_RELATION_KEY',
        'spyProductRelation.productRelationKey' => 'PRODUCT_RELATION_KEY',
        'SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY' => 'PRODUCT_RELATION_KEY',
        'COL_PRODUCT_RELATION_KEY' => 'PRODUCT_RELATION_KEY',
        'product_relation_key' => 'PRODUCT_RELATION_KEY',
        'spy_product_relation.product_relation_key' => 'PRODUCT_RELATION_KEY',
        'QuerySetData' => 'QUERY_SET_DATA',
        'SpyProductRelation.QuerySetData' => 'QUERY_SET_DATA',
        'querySetData' => 'QUERY_SET_DATA',
        'spyProductRelation.querySetData' => 'QUERY_SET_DATA',
        'SpyProductRelationTableMap::COL_QUERY_SET_DATA' => 'QUERY_SET_DATA',
        'COL_QUERY_SET_DATA' => 'QUERY_SET_DATA',
        'query_set_data' => 'QUERY_SET_DATA',
        'spy_product_relation.query_set_data' => 'QUERY_SET_DATA',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductRelation.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductRelation.createdAt' => 'CREATED_AT',
        'SpyProductRelationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_relation.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductRelation.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductRelation.updatedAt' => 'UPDATED_AT',
        'SpyProductRelationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_relation.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_relation');
        $this->setPhpName('SpyProductRelation');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelation');
        $this->setPackage('src.Orm.Zed.ProductRelation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_relation_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_relation', 'IdProductRelation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
        $this->addForeignKey('fk_product_relation_type', 'FkProductRelationType', 'INTEGER', 'spy_product_relation_type', 'id_product_relation_type', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, true);
        $this->addColumn('is_rebuild_scheduled', 'IsRebuildScheduled', 'BOOLEAN', true, 1, false);
        $this->addColumn('product_relation_key', 'ProductRelationKey', 'VARCHAR', false, 255, null);
        $this->addColumn('query_set_data', 'QuerySetData', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductRelationType', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelationType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_relation_type',
    1 => ':id_product_relation_type',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductRelationProductAbstract', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelationProductAbstract', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_relation',
    1 => ':id_product_relation',
  ),
), null, null, 'SpyProductRelationProductAbstracts', false);
        $this->addRelation('ProductRelationStore', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelationStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_relation',
    1 => ':id_product_relation',
  ),
), null, null, 'ProductRelationStores', false);
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
            'event' => ['spy_product_relation_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductRelation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductRelationTableMap::CLASS_DEFAULT : SpyProductRelationTableMap::OM_CLASS;
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
     * @return array (SpyProductRelation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductRelationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductRelationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductRelationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductRelationTableMap::OM_CLASS;
            /** @var SpyProductRelation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductRelationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductRelationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductRelationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductRelation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductRelationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_QUERY_SET_DATA);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductRelationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_relation');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_product_relation_type');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_rebuild_scheduled');
            $criteria->addSelectColumn($alias . '.product_relation_key');
            $criteria->addSelectColumn($alias . '.query_set_data');
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
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_FK_PRODUCT_RELATION_TYPE);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_IS_REBUILD_SCHEDULED);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_PRODUCT_RELATION_KEY);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_QUERY_SET_DATA);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductRelationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_relation');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_product_relation_type');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_rebuild_scheduled');
            $criteria->removeSelectColumn($alias . '.product_relation_key');
            $criteria->removeSelectColumn($alias . '.query_set_data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductRelationTableMap::DATABASE_NAME)->getTable(SpyProductRelationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductRelation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductRelation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductRelationTableMap::DATABASE_NAME);
            $criteria->add(SpyProductRelationTableMap::COL_ID_PRODUCT_RELATION, (array) $values, Criteria::IN);
        }

        $query = SpyProductRelationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductRelationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductRelationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_relation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductRelationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductRelation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductRelation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductRelation object
        }


        // Set the correct dbName
        $query = SpyProductRelationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
