<?php

namespace Orm\Zed\PriceProduct\Persistence\Map;

use Orm\Zed\PriceProduct\Persistence\SpyPriceProductDefault;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductDefaultQuery;
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
 * This class defines the structure of the 'spy_price_product_default' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductDefaultTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProduct.Persistence.Map.SpyPriceProductDefaultTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_default';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductDefault';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductDefault';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProduct.Persistence.SpyPriceProductDefault';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 2;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 2;

    /**
     * the column name for the id_price_product_default field
     */
    public const COL_ID_PRICE_PRODUCT_DEFAULT = 'spy_price_product_default.id_price_product_default';

    /**
     * the column name for the fk_price_product_store field
     */
    public const COL_FK_PRICE_PRODUCT_STORE = 'spy_price_product_default.fk_price_product_store';

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
        self::TYPE_PHPNAME       => ['IdPriceProductDefault', 'FkPriceProductStore', ],
        self::TYPE_CAMELNAME     => ['idPriceProductDefault', 'fkPriceProductStore', ],
        self::TYPE_COLNAME       => [SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT, SpyPriceProductDefaultTableMap::COL_FK_PRICE_PRODUCT_STORE, ],
        self::TYPE_FIELDNAME     => ['id_price_product_default', 'fk_price_product_store', ],
        self::TYPE_NUM           => [0, 1, ]
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
        self::TYPE_PHPNAME       => ['IdPriceProductDefault' => 0, 'FkPriceProductStore' => 1, ],
        self::TYPE_CAMELNAME     => ['idPriceProductDefault' => 0, 'fkPriceProductStore' => 1, ],
        self::TYPE_COLNAME       => [SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT => 0, SpyPriceProductDefaultTableMap::COL_FK_PRICE_PRODUCT_STORE => 1, ],
        self::TYPE_FIELDNAME     => ['id_price_product_default' => 0, 'fk_price_product_store' => 1, ],
        self::TYPE_NUM           => [0, 1, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductDefault' => 'ID_PRICE_PRODUCT_DEFAULT',
        'SpyPriceProductDefault.IdPriceProductDefault' => 'ID_PRICE_PRODUCT_DEFAULT',
        'idPriceProductDefault' => 'ID_PRICE_PRODUCT_DEFAULT',
        'spyPriceProductDefault.idPriceProductDefault' => 'ID_PRICE_PRODUCT_DEFAULT',
        'SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT' => 'ID_PRICE_PRODUCT_DEFAULT',
        'COL_ID_PRICE_PRODUCT_DEFAULT' => 'ID_PRICE_PRODUCT_DEFAULT',
        'id_price_product_default' => 'ID_PRICE_PRODUCT_DEFAULT',
        'spy_price_product_default.id_price_product_default' => 'ID_PRICE_PRODUCT_DEFAULT',
        'FkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'SpyPriceProductDefault.FkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'fkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'spyPriceProductDefault.fkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'SpyPriceProductDefaultTableMap::COL_FK_PRICE_PRODUCT_STORE' => 'FK_PRICE_PRODUCT_STORE',
        'COL_FK_PRICE_PRODUCT_STORE' => 'FK_PRICE_PRODUCT_STORE',
        'fk_price_product_store' => 'FK_PRICE_PRODUCT_STORE',
        'spy_price_product_default.fk_price_product_store' => 'FK_PRICE_PRODUCT_STORE',
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
        $this->setName('spy_price_product_default');
        $this->setPhpName('SpyPriceProductDefault');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductDefault');
        $this->setPackage('src.Orm.Zed.PriceProduct.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_default_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_default', 'IdPriceProductDefault', 'BIGINT', true, null, null);
        $this->addForeignKey('fk_price_product_store', 'FkPriceProductStore', 'BIGINT', 'spy_price_product_store', 'id_price_product_store', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PriceProductStore', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_product_store',
    1 => ':id_price_product_store',
  ),
), 'CASCADE', null, null, false);
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
            'event' => ['spy_price_product_default_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdPriceProductDefault', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductDefaultTableMap::CLASS_DEFAULT : SpyPriceProductDefaultTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductDefault object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductDefaultTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductDefaultTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductDefaultTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductDefaultTableMap::OM_CLASS;
            /** @var SpyPriceProductDefault $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductDefaultTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductDefaultTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductDefaultTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductDefault $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductDefaultTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT);
            $criteria->addSelectColumn(SpyPriceProductDefaultTableMap::COL_FK_PRICE_PRODUCT_STORE);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_default');
            $criteria->addSelectColumn($alias . '.fk_price_product_store');
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
            $criteria->removeSelectColumn(SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT);
            $criteria->removeSelectColumn(SpyPriceProductDefaultTableMap::COL_FK_PRICE_PRODUCT_STORE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_default');
            $criteria->removeSelectColumn($alias . '.fk_price_product_store');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductDefaultTableMap::DATABASE_NAME)->getTable(SpyPriceProductDefaultTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductDefault or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductDefault object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductDefaultTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProduct\Persistence\SpyPriceProductDefault) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductDefaultTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductDefaultQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductDefaultTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductDefaultTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_default table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductDefaultQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductDefault or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductDefault object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductDefaultTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductDefault object
        }

        if ($criteria->containsKey(SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT) && $criteria->keyContainsValue(SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductDefaultTableMap::COL_ID_PRICE_PRODUCT_DEFAULT.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductDefaultQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
