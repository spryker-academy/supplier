<?php

namespace Orm\Zed\ProductCategoryFilter\Persistence\Map;

use Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter;
use Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery;
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
 * This class defines the structure of the 'spy_product_category_filter' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductCategoryFilterTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductCategoryFilter.Persistence.Map.SpyProductCategoryFilterTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_category_filter';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductCategoryFilter';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductCategoryFilter\\Persistence\\SpyProductCategoryFilter';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductCategoryFilter.Persistence.SpyProductCategoryFilter';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_product_category_filter field
     */
    public const COL_ID_PRODUCT_CATEGORY_FILTER = 'spy_product_category_filter.id_product_category_filter';

    /**
     * the column name for the fk_category field
     */
    public const COL_FK_CATEGORY = 'spy_product_category_filter.fk_category';

    /**
     * the column name for the filter_data field
     */
    public const COL_FILTER_DATA = 'spy_product_category_filter.filter_data';

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
        self::TYPE_PHPNAME       => ['IdProductCategoryFilter', 'FkCategory', 'FilterData', ],
        self::TYPE_CAMELNAME     => ['idProductCategoryFilter', 'fkCategory', 'filterData', ],
        self::TYPE_COLNAME       => [SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER, SpyProductCategoryFilterTableMap::COL_FK_CATEGORY, SpyProductCategoryFilterTableMap::COL_FILTER_DATA, ],
        self::TYPE_FIELDNAME     => ['id_product_category_filter', 'fk_category', 'filter_data', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['IdProductCategoryFilter' => 0, 'FkCategory' => 1, 'FilterData' => 2, ],
        self::TYPE_CAMELNAME     => ['idProductCategoryFilter' => 0, 'fkCategory' => 1, 'filterData' => 2, ],
        self::TYPE_COLNAME       => [SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER => 0, SpyProductCategoryFilterTableMap::COL_FK_CATEGORY => 1, SpyProductCategoryFilterTableMap::COL_FILTER_DATA => 2, ],
        self::TYPE_FIELDNAME     => ['id_product_category_filter' => 0, 'fk_category' => 1, 'filter_data' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductCategoryFilter' => 'ID_PRODUCT_CATEGORY_FILTER',
        'SpyProductCategoryFilter.IdProductCategoryFilter' => 'ID_PRODUCT_CATEGORY_FILTER',
        'idProductCategoryFilter' => 'ID_PRODUCT_CATEGORY_FILTER',
        'spyProductCategoryFilter.idProductCategoryFilter' => 'ID_PRODUCT_CATEGORY_FILTER',
        'SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER' => 'ID_PRODUCT_CATEGORY_FILTER',
        'COL_ID_PRODUCT_CATEGORY_FILTER' => 'ID_PRODUCT_CATEGORY_FILTER',
        'id_product_category_filter' => 'ID_PRODUCT_CATEGORY_FILTER',
        'spy_product_category_filter.id_product_category_filter' => 'ID_PRODUCT_CATEGORY_FILTER',
        'FkCategory' => 'FK_CATEGORY',
        'SpyProductCategoryFilter.FkCategory' => 'FK_CATEGORY',
        'fkCategory' => 'FK_CATEGORY',
        'spyProductCategoryFilter.fkCategory' => 'FK_CATEGORY',
        'SpyProductCategoryFilterTableMap::COL_FK_CATEGORY' => 'FK_CATEGORY',
        'COL_FK_CATEGORY' => 'FK_CATEGORY',
        'fk_category' => 'FK_CATEGORY',
        'spy_product_category_filter.fk_category' => 'FK_CATEGORY',
        'FilterData' => 'FILTER_DATA',
        'SpyProductCategoryFilter.FilterData' => 'FILTER_DATA',
        'filterData' => 'FILTER_DATA',
        'spyProductCategoryFilter.filterData' => 'FILTER_DATA',
        'SpyProductCategoryFilterTableMap::COL_FILTER_DATA' => 'FILTER_DATA',
        'COL_FILTER_DATA' => 'FILTER_DATA',
        'filter_data' => 'FILTER_DATA',
        'spy_product_category_filter.filter_data' => 'FILTER_DATA',
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
        $this->setName('spy_product_category_filter');
        $this->setPhpName('SpyProductCategoryFilter');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductCategoryFilter\\Persistence\\SpyProductCategoryFilter');
        $this->setPackage('src.Orm.Zed.ProductCategoryFilter.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_category_filter_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_category_filter', 'IdProductCategoryFilter', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_category', 'FkCategory', 'INTEGER', 'spy_category', 'id_category', false, null, null);
        $this->addColumn('filter_data', 'FilterData', 'LONGVARCHAR', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCategory', '\\Orm\\Zed\\Category\\Persistence\\SpyCategory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
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
            'event' => ['spy_product_category_filter_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductCategoryFilter', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductCategoryFilterTableMap::CLASS_DEFAULT : SpyProductCategoryFilterTableMap::OM_CLASS;
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
     * @return array (SpyProductCategoryFilter object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductCategoryFilterTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductCategoryFilterTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductCategoryFilterTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductCategoryFilterTableMap::OM_CLASS;
            /** @var SpyProductCategoryFilter $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductCategoryFilterTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductCategoryFilterTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductCategoryFilterTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductCategoryFilter $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductCategoryFilterTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER);
            $criteria->addSelectColumn(SpyProductCategoryFilterTableMap::COL_FK_CATEGORY);
            $criteria->addSelectColumn(SpyProductCategoryFilterTableMap::COL_FILTER_DATA);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_category_filter');
            $criteria->addSelectColumn($alias . '.fk_category');
            $criteria->addSelectColumn($alias . '.filter_data');
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
            $criteria->removeSelectColumn(SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER);
            $criteria->removeSelectColumn(SpyProductCategoryFilterTableMap::COL_FK_CATEGORY);
            $criteria->removeSelectColumn(SpyProductCategoryFilterTableMap::COL_FILTER_DATA);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_category_filter');
            $criteria->removeSelectColumn($alias . '.fk_category');
            $criteria->removeSelectColumn($alias . '.filter_data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductCategoryFilterTableMap::DATABASE_NAME)->getTable(SpyProductCategoryFilterTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductCategoryFilter or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductCategoryFilter object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductCategoryFilterTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductCategoryFilterTableMap::DATABASE_NAME);
            $criteria->add(SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER, (array) $values, Criteria::IN);
        }

        $query = SpyProductCategoryFilterQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductCategoryFilterTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductCategoryFilterTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_category_filter table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductCategoryFilterQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductCategoryFilter or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductCategoryFilter object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductCategoryFilterTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductCategoryFilter object
        }

        if ($criteria->containsKey(SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER) && $criteria->keyContainsValue(SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductCategoryFilterTableMap::COL_ID_PRODUCT_CATEGORY_FILTER.')');
        }


        // Set the correct dbName
        $query = SpyProductCategoryFilterQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
