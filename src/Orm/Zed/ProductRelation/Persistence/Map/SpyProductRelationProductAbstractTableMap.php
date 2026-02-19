<?php

namespace Orm\Zed\ProductRelation\Persistence\Map;

use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery;
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
 * This class defines the structure of the 'spy_product_relation_product_abstract' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductRelationProductAbstractTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductRelation.Persistence.Map.SpyProductRelationProductAbstractTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_relation_product_abstract';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductRelationProductAbstract';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelationProductAbstract';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductRelation.Persistence.SpyProductRelationProductAbstract';

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
     * the column name for the id_product_relation_product_abstract field
     */
    public const COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT = 'spy_product_relation_product_abstract.id_product_relation_product_abstract';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product_relation_product_abstract.fk_product_abstract';

    /**
     * the column name for the fk_product_relation field
     */
    public const COL_FK_PRODUCT_RELATION = 'spy_product_relation_product_abstract.fk_product_relation';

    /**
     * the column name for the order field
     */
    public const COL_ORDER = 'spy_product_relation_product_abstract.order';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_relation_product_abstract.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_relation_product_abstract.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductRelationProductAbstract', 'FkProductAbstract', 'FkProductRelation', 'Order', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductRelationProductAbstract', 'fkProductAbstract', 'fkProductRelation', 'order', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductRelationProductAbstractTableMap::COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT, SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_RELATION, SpyProductRelationProductAbstractTableMap::COL_ORDER, SpyProductRelationProductAbstractTableMap::COL_CREATED_AT, SpyProductRelationProductAbstractTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_relation_product_abstract', 'fk_product_abstract', 'fk_product_relation', 'order', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductRelationProductAbstract' => 0, 'FkProductAbstract' => 1, 'FkProductRelation' => 2, 'Order' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idProductRelationProductAbstract' => 0, 'fkProductAbstract' => 1, 'fkProductRelation' => 2, 'order' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyProductRelationProductAbstractTableMap::COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT => 0, SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_ABSTRACT => 1, SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_RELATION => 2, SpyProductRelationProductAbstractTableMap::COL_ORDER => 3, SpyProductRelationProductAbstractTableMap::COL_CREATED_AT => 4, SpyProductRelationProductAbstractTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_product_relation_product_abstract' => 0, 'fk_product_abstract' => 1, 'fk_product_relation' => 2, 'order' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductRelationProductAbstract' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'SpyProductRelationProductAbstract.IdProductRelationProductAbstract' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'idProductRelationProductAbstract' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'spyProductRelationProductAbstract.idProductRelationProductAbstract' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'SpyProductRelationProductAbstractTableMap::COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'id_product_relation_product_abstract' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'spy_product_relation_product_abstract.id_product_relation_product_abstract' => 'ID_PRODUCT_RELATION_PRODUCT_ABSTRACT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductRelationProductAbstract.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProductRelationProductAbstract.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product_relation_product_abstract.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkProductRelation' => 'FK_PRODUCT_RELATION',
        'SpyProductRelationProductAbstract.FkProductRelation' => 'FK_PRODUCT_RELATION',
        'fkProductRelation' => 'FK_PRODUCT_RELATION',
        'spyProductRelationProductAbstract.fkProductRelation' => 'FK_PRODUCT_RELATION',
        'SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_RELATION' => 'FK_PRODUCT_RELATION',
        'COL_FK_PRODUCT_RELATION' => 'FK_PRODUCT_RELATION',
        'fk_product_relation' => 'FK_PRODUCT_RELATION',
        'spy_product_relation_product_abstract.fk_product_relation' => 'FK_PRODUCT_RELATION',
        'Order' => 'ORDER',
        'SpyProductRelationProductAbstract.Order' => 'ORDER',
        'order' => 'ORDER',
        'spyProductRelationProductAbstract.order' => 'ORDER',
        'SpyProductRelationProductAbstractTableMap::COL_ORDER' => 'ORDER',
        'COL_ORDER' => 'ORDER',
        'spy_product_relation_product_abstract.order' => 'ORDER',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductRelationProductAbstract.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductRelationProductAbstract.createdAt' => 'CREATED_AT',
        'SpyProductRelationProductAbstractTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_relation_product_abstract.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductRelationProductAbstract.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductRelationProductAbstract.updatedAt' => 'UPDATED_AT',
        'SpyProductRelationProductAbstractTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_relation_product_abstract.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_relation_product_abstract');
        $this->setPhpName('SpyProductRelationProductAbstract');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelationProductAbstract');
        $this->setPackage('src.Orm.Zed.ProductRelation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_rel_prod_abs_type_pk_seq');
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('id_product_relation_product_abstract', 'IdProductRelationProductAbstract', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
        $this->addForeignKey('fk_product_relation', 'FkProductRelation', 'INTEGER', 'spy_product_relation', 'id_product_relation', true, null, null);
        $this->addColumn('order', 'Order', 'INTEGER', true, null, null);
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
        $this->addRelation('SpyProductRelation', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_relation',
    1 => ':id_product_relation',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
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
            'event' => ['spy_product_relation_product_abstract_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductRelationProductAbstract', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductRelationProductAbstractTableMap::CLASS_DEFAULT : SpyProductRelationProductAbstractTableMap::OM_CLASS;
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
     * @return array (SpyProductRelationProductAbstract object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductRelationProductAbstractTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductRelationProductAbstractTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductRelationProductAbstractTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductRelationProductAbstractTableMap::OM_CLASS;
            /** @var SpyProductRelationProductAbstract $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductRelationProductAbstractTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductRelationProductAbstractTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductRelationProductAbstractTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductRelationProductAbstract $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductRelationProductAbstractTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductRelationProductAbstractTableMap::COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_RELATION);
            $criteria->addSelectColumn(SpyProductRelationProductAbstractTableMap::COL_ORDER);
            $criteria->addSelectColumn(SpyProductRelationProductAbstractTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductRelationProductAbstractTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_relation_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_product_relation');
            $criteria->addSelectColumn($alias . '.order');
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
            $criteria->removeSelectColumn(SpyProductRelationProductAbstractTableMap::COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductRelationProductAbstractTableMap::COL_FK_PRODUCT_RELATION);
            $criteria->removeSelectColumn(SpyProductRelationProductAbstractTableMap::COL_ORDER);
            $criteria->removeSelectColumn(SpyProductRelationProductAbstractTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductRelationProductAbstractTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_relation_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_product_relation');
            $criteria->removeSelectColumn($alias . '.order');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductRelationProductAbstractTableMap::DATABASE_NAME)->getTable(SpyProductRelationProductAbstractTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductRelationProductAbstract or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductRelationProductAbstract object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationProductAbstractTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductRelationProductAbstractTableMap::DATABASE_NAME);
            $criteria->add(SpyProductRelationProductAbstractTableMap::COL_ID_PRODUCT_RELATION_PRODUCT_ABSTRACT, (array) $values, Criteria::IN);
        }

        $query = SpyProductRelationProductAbstractQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductRelationProductAbstractTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductRelationProductAbstractTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_relation_product_abstract table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductRelationProductAbstractQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductRelationProductAbstract or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductRelationProductAbstract object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductRelationProductAbstractTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductRelationProductAbstract object
        }


        // Set the correct dbName
        $query = SpyProductRelationProductAbstractQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
