<?php

namespace Orm\Zed\ProductAlternative\Persistence\Map;

use Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative;
use Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery;
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
 * This class defines the structure of the 'spy_product_alternative' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductAlternativeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductAlternative.Persistence.Map.SpyProductAlternativeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_alternative';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductAlternative';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductAlternative\\Persistence\\SpyProductAlternative';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductAlternative.Persistence.SpyProductAlternative';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_product_alternative field
     */
    public const COL_ID_PRODUCT_ALTERNATIVE = 'spy_product_alternative.id_product_alternative';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_alternative.fk_product';

    /**
     * the column name for the fk_product_abstract_alternative field
     */
    public const COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE = 'spy_product_alternative.fk_product_abstract_alternative';

    /**
     * the column name for the fk_product_concrete_alternative field
     */
    public const COL_FK_PRODUCT_CONCRETE_ALTERNATIVE = 'spy_product_alternative.fk_product_concrete_alternative';

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
        self::TYPE_PHPNAME       => ['IdProductAlternative', 'FkProduct', 'FkProductAbstractAlternative', 'FkProductConcreteAlternative', ],
        self::TYPE_CAMELNAME     => ['idProductAlternative', 'fkProduct', 'fkProductAbstractAlternative', 'fkProductConcreteAlternative', ],
        self::TYPE_COLNAME       => [SpyProductAlternativeTableMap::COL_ID_PRODUCT_ALTERNATIVE, SpyProductAlternativeTableMap::COL_FK_PRODUCT, SpyProductAlternativeTableMap::COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE, SpyProductAlternativeTableMap::COL_FK_PRODUCT_CONCRETE_ALTERNATIVE, ],
        self::TYPE_FIELDNAME     => ['id_product_alternative', 'fk_product', 'fk_product_abstract_alternative', 'fk_product_concrete_alternative', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['IdProductAlternative' => 0, 'FkProduct' => 1, 'FkProductAbstractAlternative' => 2, 'FkProductConcreteAlternative' => 3, ],
        self::TYPE_CAMELNAME     => ['idProductAlternative' => 0, 'fkProduct' => 1, 'fkProductAbstractAlternative' => 2, 'fkProductConcreteAlternative' => 3, ],
        self::TYPE_COLNAME       => [SpyProductAlternativeTableMap::COL_ID_PRODUCT_ALTERNATIVE => 0, SpyProductAlternativeTableMap::COL_FK_PRODUCT => 1, SpyProductAlternativeTableMap::COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE => 2, SpyProductAlternativeTableMap::COL_FK_PRODUCT_CONCRETE_ALTERNATIVE => 3, ],
        self::TYPE_FIELDNAME     => ['id_product_alternative' => 0, 'fk_product' => 1, 'fk_product_abstract_alternative' => 2, 'fk_product_concrete_alternative' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductAlternative' => 'ID_PRODUCT_ALTERNATIVE',
        'SpyProductAlternative.IdProductAlternative' => 'ID_PRODUCT_ALTERNATIVE',
        'idProductAlternative' => 'ID_PRODUCT_ALTERNATIVE',
        'spyProductAlternative.idProductAlternative' => 'ID_PRODUCT_ALTERNATIVE',
        'SpyProductAlternativeTableMap::COL_ID_PRODUCT_ALTERNATIVE' => 'ID_PRODUCT_ALTERNATIVE',
        'COL_ID_PRODUCT_ALTERNATIVE' => 'ID_PRODUCT_ALTERNATIVE',
        'id_product_alternative' => 'ID_PRODUCT_ALTERNATIVE',
        'spy_product_alternative.id_product_alternative' => 'ID_PRODUCT_ALTERNATIVE',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductAlternative.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductAlternative.fkProduct' => 'FK_PRODUCT',
        'SpyProductAlternativeTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_alternative.fk_product' => 'FK_PRODUCT',
        'FkProductAbstractAlternative' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'SpyProductAlternative.FkProductAbstractAlternative' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'fkProductAbstractAlternative' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'spyProductAlternative.fkProductAbstractAlternative' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'SpyProductAlternativeTableMap::COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'fk_product_abstract_alternative' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'spy_product_alternative.fk_product_abstract_alternative' => 'FK_PRODUCT_ABSTRACT_ALTERNATIVE',
        'FkProductConcreteAlternative' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'SpyProductAlternative.FkProductConcreteAlternative' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'fkProductConcreteAlternative' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'spyProductAlternative.fkProductConcreteAlternative' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'SpyProductAlternativeTableMap::COL_FK_PRODUCT_CONCRETE_ALTERNATIVE' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'COL_FK_PRODUCT_CONCRETE_ALTERNATIVE' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'fk_product_concrete_alternative' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
        'spy_product_alternative.fk_product_concrete_alternative' => 'FK_PRODUCT_CONCRETE_ALTERNATIVE',
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
        $this->setName('spy_product_alternative');
        $this->setPhpName('SpyProductAlternative');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductAlternative\\Persistence\\SpyProductAlternative');
        $this->setPackage('src.Orm.Zed.ProductAlternative.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_alternative_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_alternative', 'IdProductAlternative', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addForeignKey('fk_product_abstract_alternative', 'FkProductAbstractAlternative', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', false, null, null);
        $this->addForeignKey('fk_product_concrete_alternative', 'FkProductConcreteAlternative', 'INTEGER', 'spy_product', 'id_product', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ProductConcrete', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('ProductAbstractAlternative', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract_alternative',
    1 => ':id_product_abstract',
  ),
), null, null, null, false);
        $this->addRelation('ProductConcreteAlternative', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_concrete_alternative',
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
            'event' => ['spy_product_alternative_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductAlternative', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductAlternativeTableMap::CLASS_DEFAULT : SpyProductAlternativeTableMap::OM_CLASS;
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
     * @return array (SpyProductAlternative object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductAlternativeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductAlternativeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductAlternativeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductAlternativeTableMap::OM_CLASS;
            /** @var SpyProductAlternative $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductAlternativeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductAlternativeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductAlternativeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductAlternative $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductAlternativeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductAlternativeTableMap::COL_ID_PRODUCT_ALTERNATIVE);
            $criteria->addSelectColumn(SpyProductAlternativeTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductAlternativeTableMap::COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE);
            $criteria->addSelectColumn(SpyProductAlternativeTableMap::COL_FK_PRODUCT_CONCRETE_ALTERNATIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_alternative');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_product_abstract_alternative');
            $criteria->addSelectColumn($alias . '.fk_product_concrete_alternative');
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
            $criteria->removeSelectColumn(SpyProductAlternativeTableMap::COL_ID_PRODUCT_ALTERNATIVE);
            $criteria->removeSelectColumn(SpyProductAlternativeTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductAlternativeTableMap::COL_FK_PRODUCT_ABSTRACT_ALTERNATIVE);
            $criteria->removeSelectColumn(SpyProductAlternativeTableMap::COL_FK_PRODUCT_CONCRETE_ALTERNATIVE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_alternative');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract_alternative');
            $criteria->removeSelectColumn($alias . '.fk_product_concrete_alternative');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductAlternativeTableMap::DATABASE_NAME)->getTable(SpyProductAlternativeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductAlternative or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductAlternative object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAlternativeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductAlternativeTableMap::DATABASE_NAME);
            $criteria->add(SpyProductAlternativeTableMap::COL_ID_PRODUCT_ALTERNATIVE, (array) $values, Criteria::IN);
        }

        $query = SpyProductAlternativeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductAlternativeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductAlternativeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_alternative table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductAlternativeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductAlternative or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductAlternative object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAlternativeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductAlternative object
        }


        // Set the correct dbName
        $query = SpyProductAlternativeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
