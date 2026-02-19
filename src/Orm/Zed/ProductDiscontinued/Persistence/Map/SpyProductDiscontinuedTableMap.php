<?php

namespace Orm\Zed\ProductDiscontinued\Persistence\Map;

use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued;
use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery;
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
 * This class defines the structure of the 'spy_product_discontinued' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductDiscontinuedTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductDiscontinued.Persistence.Map.SpyProductDiscontinuedTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_discontinued';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductDiscontinued';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinued';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductDiscontinued.Persistence.SpyProductDiscontinued';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_product_discontinued field
     */
    public const COL_ID_PRODUCT_DISCONTINUED = 'spy_product_discontinued.id_product_discontinued';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_discontinued.fk_product';

    /**
     * the column name for the active_until field
     */
    public const COL_ACTIVE_UNTIL = 'spy_product_discontinued.active_until';

    /**
     * the column name for the discontinued_on field
     */
    public const COL_DISCONTINUED_ON = 'spy_product_discontinued.discontinued_on';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_discontinued.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductDiscontinued', 'FkProduct', 'ActiveUntil', 'DiscontinuedOn', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductDiscontinued', 'fkProduct', 'activeUntil', 'discontinuedOn', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductDiscontinuedTableMap::COL_ID_PRODUCT_DISCONTINUED, SpyProductDiscontinuedTableMap::COL_FK_PRODUCT, SpyProductDiscontinuedTableMap::COL_ACTIVE_UNTIL, SpyProductDiscontinuedTableMap::COL_DISCONTINUED_ON, SpyProductDiscontinuedTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_discontinued', 'fk_product', 'active_until', 'discontinued_on', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['IdProductDiscontinued' => 0, 'FkProduct' => 1, 'ActiveUntil' => 2, 'DiscontinuedOn' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idProductDiscontinued' => 0, 'fkProduct' => 1, 'activeUntil' => 2, 'discontinuedOn' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyProductDiscontinuedTableMap::COL_ID_PRODUCT_DISCONTINUED => 0, SpyProductDiscontinuedTableMap::COL_FK_PRODUCT => 1, SpyProductDiscontinuedTableMap::COL_ACTIVE_UNTIL => 2, SpyProductDiscontinuedTableMap::COL_DISCONTINUED_ON => 3, SpyProductDiscontinuedTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_product_discontinued' => 0, 'fk_product' => 1, 'active_until' => 2, 'discontinued_on' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductDiscontinued' => 'ID_PRODUCT_DISCONTINUED',
        'SpyProductDiscontinued.IdProductDiscontinued' => 'ID_PRODUCT_DISCONTINUED',
        'idProductDiscontinued' => 'ID_PRODUCT_DISCONTINUED',
        'spyProductDiscontinued.idProductDiscontinued' => 'ID_PRODUCT_DISCONTINUED',
        'SpyProductDiscontinuedTableMap::COL_ID_PRODUCT_DISCONTINUED' => 'ID_PRODUCT_DISCONTINUED',
        'COL_ID_PRODUCT_DISCONTINUED' => 'ID_PRODUCT_DISCONTINUED',
        'id_product_discontinued' => 'ID_PRODUCT_DISCONTINUED',
        'spy_product_discontinued.id_product_discontinued' => 'ID_PRODUCT_DISCONTINUED',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductDiscontinued.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductDiscontinued.fkProduct' => 'FK_PRODUCT',
        'SpyProductDiscontinuedTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_discontinued.fk_product' => 'FK_PRODUCT',
        'ActiveUntil' => 'ACTIVE_UNTIL',
        'SpyProductDiscontinued.ActiveUntil' => 'ACTIVE_UNTIL',
        'activeUntil' => 'ACTIVE_UNTIL',
        'spyProductDiscontinued.activeUntil' => 'ACTIVE_UNTIL',
        'SpyProductDiscontinuedTableMap::COL_ACTIVE_UNTIL' => 'ACTIVE_UNTIL',
        'COL_ACTIVE_UNTIL' => 'ACTIVE_UNTIL',
        'active_until' => 'ACTIVE_UNTIL',
        'spy_product_discontinued.active_until' => 'ACTIVE_UNTIL',
        'DiscontinuedOn' => 'DISCONTINUED_ON',
        'SpyProductDiscontinued.DiscontinuedOn' => 'DISCONTINUED_ON',
        'discontinuedOn' => 'DISCONTINUED_ON',
        'spyProductDiscontinued.discontinuedOn' => 'DISCONTINUED_ON',
        'SpyProductDiscontinuedTableMap::COL_DISCONTINUED_ON' => 'DISCONTINUED_ON',
        'COL_DISCONTINUED_ON' => 'DISCONTINUED_ON',
        'discontinued_on' => 'DISCONTINUED_ON',
        'spy_product_discontinued.discontinued_on' => 'DISCONTINUED_ON',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductDiscontinued.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductDiscontinued.updatedAt' => 'UPDATED_AT',
        'SpyProductDiscontinuedTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_discontinued.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_discontinued');
        $this->setPhpName('SpyProductDiscontinued');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinued');
        $this->setPackage('src.Orm.Zed.ProductDiscontinued.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_discontinued_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_discontinued', 'IdProductDiscontinued', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addColumn('active_until', 'ActiveUntil', 'DATE', true, null, null);
        $this->addColumn('discontinued_on', 'DiscontinuedOn', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Product', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductDiscontinuedNote', '\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinuedNote', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_discontinued',
    1 => ':id_product_discontinued',
  ),
), null, null, 'SpyProductDiscontinuedNotes', false);
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
            'timestampable' => ['create_column' => 'discontinued_on', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_product_discontinued_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductDiscontinued', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductDiscontinuedTableMap::CLASS_DEFAULT : SpyProductDiscontinuedTableMap::OM_CLASS;
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
     * @return array (SpyProductDiscontinued object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductDiscontinuedTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductDiscontinuedTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductDiscontinuedTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductDiscontinuedTableMap::OM_CLASS;
            /** @var SpyProductDiscontinued $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductDiscontinuedTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductDiscontinuedTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductDiscontinuedTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductDiscontinued $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductDiscontinuedTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductDiscontinuedTableMap::COL_ID_PRODUCT_DISCONTINUED);
            $criteria->addSelectColumn(SpyProductDiscontinuedTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductDiscontinuedTableMap::COL_ACTIVE_UNTIL);
            $criteria->addSelectColumn(SpyProductDiscontinuedTableMap::COL_DISCONTINUED_ON);
            $criteria->addSelectColumn(SpyProductDiscontinuedTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_discontinued');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.active_until');
            $criteria->addSelectColumn($alias . '.discontinued_on');
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
            $criteria->removeSelectColumn(SpyProductDiscontinuedTableMap::COL_ID_PRODUCT_DISCONTINUED);
            $criteria->removeSelectColumn(SpyProductDiscontinuedTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductDiscontinuedTableMap::COL_ACTIVE_UNTIL);
            $criteria->removeSelectColumn(SpyProductDiscontinuedTableMap::COL_DISCONTINUED_ON);
            $criteria->removeSelectColumn(SpyProductDiscontinuedTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_discontinued');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.active_until');
            $criteria->removeSelectColumn($alias . '.discontinued_on');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductDiscontinuedTableMap::DATABASE_NAME)->getTable(SpyProductDiscontinuedTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductDiscontinued or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductDiscontinued object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductDiscontinuedTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductDiscontinuedTableMap::DATABASE_NAME);
            $criteria->add(SpyProductDiscontinuedTableMap::COL_ID_PRODUCT_DISCONTINUED, (array) $values, Criteria::IN);
        }

        $query = SpyProductDiscontinuedQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductDiscontinuedTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductDiscontinuedTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_discontinued table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductDiscontinuedQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductDiscontinued or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductDiscontinued object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductDiscontinuedTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductDiscontinued object
        }


        // Set the correct dbName
        $query = SpyProductDiscontinuedQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
