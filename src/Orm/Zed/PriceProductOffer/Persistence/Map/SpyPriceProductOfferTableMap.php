<?php

namespace Orm\Zed\PriceProductOffer\Persistence\Map;

use Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer;
use Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery;
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
 * This class defines the structure of the 'spy_price_product_offer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductOfferTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductOffer.Persistence.Map.SpyPriceProductOfferTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_offer';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductOffer';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductOffer\\Persistence\\SpyPriceProductOffer';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductOffer.Persistence.SpyPriceProductOffer';

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
     * the column name for the id_price_product_offer field
     */
    public const COL_ID_PRICE_PRODUCT_OFFER = 'spy_price_product_offer.id_price_product_offer';

    /**
     * the column name for the fk_price_product_store field
     */
    public const COL_FK_PRICE_PRODUCT_STORE = 'spy_price_product_offer.fk_price_product_store';

    /**
     * the column name for the fk_product_offer field
     */
    public const COL_FK_PRODUCT_OFFER = 'spy_price_product_offer.fk_product_offer';

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
        self::TYPE_PHPNAME       => ['IdPriceProductOffer', 'FkPriceProductStore', 'FkProductOffer', ],
        self::TYPE_CAMELNAME     => ['idPriceProductOffer', 'fkPriceProductStore', 'fkProductOffer', ],
        self::TYPE_COLNAME       => [SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER, SpyPriceProductOfferTableMap::COL_FK_PRICE_PRODUCT_STORE, SpyPriceProductOfferTableMap::COL_FK_PRODUCT_OFFER, ],
        self::TYPE_FIELDNAME     => ['id_price_product_offer', 'fk_price_product_store', 'fk_product_offer', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductOffer' => 0, 'FkPriceProductStore' => 1, 'FkProductOffer' => 2, ],
        self::TYPE_CAMELNAME     => ['idPriceProductOffer' => 0, 'fkPriceProductStore' => 1, 'fkProductOffer' => 2, ],
        self::TYPE_COLNAME       => [SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER => 0, SpyPriceProductOfferTableMap::COL_FK_PRICE_PRODUCT_STORE => 1, SpyPriceProductOfferTableMap::COL_FK_PRODUCT_OFFER => 2, ],
        self::TYPE_FIELDNAME     => ['id_price_product_offer' => 0, 'fk_price_product_store' => 1, 'fk_product_offer' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductOffer' => 'ID_PRICE_PRODUCT_OFFER',
        'SpyPriceProductOffer.IdPriceProductOffer' => 'ID_PRICE_PRODUCT_OFFER',
        'idPriceProductOffer' => 'ID_PRICE_PRODUCT_OFFER',
        'spyPriceProductOffer.idPriceProductOffer' => 'ID_PRICE_PRODUCT_OFFER',
        'SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER' => 'ID_PRICE_PRODUCT_OFFER',
        'COL_ID_PRICE_PRODUCT_OFFER' => 'ID_PRICE_PRODUCT_OFFER',
        'id_price_product_offer' => 'ID_PRICE_PRODUCT_OFFER',
        'spy_price_product_offer.id_price_product_offer' => 'ID_PRICE_PRODUCT_OFFER',
        'FkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'SpyPriceProductOffer.FkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'fkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'spyPriceProductOffer.fkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'SpyPriceProductOfferTableMap::COL_FK_PRICE_PRODUCT_STORE' => 'FK_PRICE_PRODUCT_STORE',
        'COL_FK_PRICE_PRODUCT_STORE' => 'FK_PRICE_PRODUCT_STORE',
        'fk_price_product_store' => 'FK_PRICE_PRODUCT_STORE',
        'spy_price_product_offer.fk_price_product_store' => 'FK_PRICE_PRODUCT_STORE',
        'FkProductOffer' => 'FK_PRODUCT_OFFER',
        'SpyPriceProductOffer.FkProductOffer' => 'FK_PRODUCT_OFFER',
        'fkProductOffer' => 'FK_PRODUCT_OFFER',
        'spyPriceProductOffer.fkProductOffer' => 'FK_PRODUCT_OFFER',
        'SpyPriceProductOfferTableMap::COL_FK_PRODUCT_OFFER' => 'FK_PRODUCT_OFFER',
        'COL_FK_PRODUCT_OFFER' => 'FK_PRODUCT_OFFER',
        'fk_product_offer' => 'FK_PRODUCT_OFFER',
        'spy_price_product_offer.fk_product_offer' => 'FK_PRODUCT_OFFER',
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
        $this->setName('spy_price_product_offer');
        $this->setPhpName('SpyPriceProductOffer');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\PriceProductOffer\\Persistence\\SpyPriceProductOffer');
        $this->setPackage('src.Orm.Zed.PriceProductOffer.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_offer_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_offer', 'IdPriceProductOffer', 'BIGINT', true, null, null);
        $this->addForeignKey('fk_price_product_store', 'FkPriceProductStore', 'BIGINT', 'spy_price_product_store', 'id_price_product_store', true, null, null);
        $this->addForeignKey('fk_product_offer', 'FkProductOffer', 'INTEGER', 'spy_product_offer', 'id_product_offer', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyProductOffer', '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyPriceProductStore', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_product_store',
    1 => ':id_price_product_store',
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
            'event' => ['spy_price_product_offer_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductOffer', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductOfferTableMap::CLASS_DEFAULT : SpyPriceProductOfferTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductOffer object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductOfferTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductOfferTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductOfferTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductOfferTableMap::OM_CLASS;
            /** @var SpyPriceProductOffer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductOfferTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductOfferTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductOfferTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductOffer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductOfferTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER);
            $criteria->addSelectColumn(SpyPriceProductOfferTableMap::COL_FK_PRICE_PRODUCT_STORE);
            $criteria->addSelectColumn(SpyPriceProductOfferTableMap::COL_FK_PRODUCT_OFFER);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_offer');
            $criteria->addSelectColumn($alias . '.fk_price_product_store');
            $criteria->addSelectColumn($alias . '.fk_product_offer');
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
            $criteria->removeSelectColumn(SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER);
            $criteria->removeSelectColumn(SpyPriceProductOfferTableMap::COL_FK_PRICE_PRODUCT_STORE);
            $criteria->removeSelectColumn(SpyPriceProductOfferTableMap::COL_FK_PRODUCT_OFFER);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_offer');
            $criteria->removeSelectColumn($alias . '.fk_price_product_store');
            $criteria->removeSelectColumn($alias . '.fk_product_offer');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductOfferTableMap::DATABASE_NAME)->getTable(SpyPriceProductOfferTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductOffer or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductOffer object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductOfferTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductOfferTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductOfferQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductOfferTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductOfferTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_offer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductOfferQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductOffer or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductOffer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductOfferTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductOffer object
        }

        if ($criteria->containsKey(SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER) && $criteria->keyContainsValue(SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductOfferTableMap::COL_ID_PRICE_PRODUCT_OFFER.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductOfferQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
