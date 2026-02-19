<?php

namespace Orm\Zed\MerchantCommission\Persistence\Map;

use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery;
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
 * This class defines the structure of the 'spy_merchant_commission_store' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantCommissionStoreTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantCommission.Persistence.Map.SpyMerchantCommissionStoreTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_commission_store';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantCommissionStore';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionStore';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantCommission.Persistence.SpyMerchantCommissionStore';

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
     * the column name for the id_merchant_commission_store field
     */
    public const COL_ID_MERCHANT_COMMISSION_STORE = 'spy_merchant_commission_store.id_merchant_commission_store';

    /**
     * the column name for the fk_merchant_commission field
     */
    public const COL_FK_MERCHANT_COMMISSION = 'spy_merchant_commission_store.fk_merchant_commission';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_merchant_commission_store.fk_store';

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
        self::TYPE_PHPNAME       => ['IdMerchantCommissionStore', 'FkMerchantCommission', 'FkStore', ],
        self::TYPE_CAMELNAME     => ['idMerchantCommissionStore', 'fkMerchantCommission', 'fkStore', ],
        self::TYPE_COLNAME       => [SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE, SpyMerchantCommissionStoreTableMap::COL_FK_MERCHANT_COMMISSION, SpyMerchantCommissionStoreTableMap::COL_FK_STORE, ],
        self::TYPE_FIELDNAME     => ['id_merchant_commission_store', 'fk_merchant_commission', 'fk_store', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantCommissionStore' => 0, 'FkMerchantCommission' => 1, 'FkStore' => 2, ],
        self::TYPE_CAMELNAME     => ['idMerchantCommissionStore' => 0, 'fkMerchantCommission' => 1, 'fkStore' => 2, ],
        self::TYPE_COLNAME       => [SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE => 0, SpyMerchantCommissionStoreTableMap::COL_FK_MERCHANT_COMMISSION => 1, SpyMerchantCommissionStoreTableMap::COL_FK_STORE => 2, ],
        self::TYPE_FIELDNAME     => ['id_merchant_commission_store' => 0, 'fk_merchant_commission' => 1, 'fk_store' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantCommissionStore' => 'ID_MERCHANT_COMMISSION_STORE',
        'SpyMerchantCommissionStore.IdMerchantCommissionStore' => 'ID_MERCHANT_COMMISSION_STORE',
        'idMerchantCommissionStore' => 'ID_MERCHANT_COMMISSION_STORE',
        'spyMerchantCommissionStore.idMerchantCommissionStore' => 'ID_MERCHANT_COMMISSION_STORE',
        'SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE' => 'ID_MERCHANT_COMMISSION_STORE',
        'COL_ID_MERCHANT_COMMISSION_STORE' => 'ID_MERCHANT_COMMISSION_STORE',
        'id_merchant_commission_store' => 'ID_MERCHANT_COMMISSION_STORE',
        'spy_merchant_commission_store.id_merchant_commission_store' => 'ID_MERCHANT_COMMISSION_STORE',
        'FkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'SpyMerchantCommissionStore.FkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'fkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'spyMerchantCommissionStore.fkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'SpyMerchantCommissionStoreTableMap::COL_FK_MERCHANT_COMMISSION' => 'FK_MERCHANT_COMMISSION',
        'COL_FK_MERCHANT_COMMISSION' => 'FK_MERCHANT_COMMISSION',
        'fk_merchant_commission' => 'FK_MERCHANT_COMMISSION',
        'spy_merchant_commission_store.fk_merchant_commission' => 'FK_MERCHANT_COMMISSION',
        'FkStore' => 'FK_STORE',
        'SpyMerchantCommissionStore.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyMerchantCommissionStore.fkStore' => 'FK_STORE',
        'SpyMerchantCommissionStoreTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_merchant_commission_store.fk_store' => 'FK_STORE',
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
        $this->setName('spy_merchant_commission_store');
        $this->setPhpName('SpyMerchantCommissionStore');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionStore');
        $this->setPackage('src.Orm.Zed.MerchantCommission.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_commission_store_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_commission_store', 'IdMerchantCommissionStore', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_merchant_commission', 'FkMerchantCommission', 'INTEGER', 'spy_merchant_commission', 'id_merchant_commission', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('MerchantCommission', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommission', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_commission',
    1 => ':id_merchant_commission',
  ),
), null, null, null, false);
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantCommissionStore', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantCommissionStoreTableMap::CLASS_DEFAULT : SpyMerchantCommissionStoreTableMap::OM_CLASS;
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
     * @return array (SpyMerchantCommissionStore object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantCommissionStoreTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantCommissionStoreTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantCommissionStoreTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantCommissionStoreTableMap::OM_CLASS;
            /** @var SpyMerchantCommissionStore $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantCommissionStoreTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantCommissionStoreTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantCommissionStoreTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantCommissionStore $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantCommissionStoreTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE);
            $criteria->addSelectColumn(SpyMerchantCommissionStoreTableMap::COL_FK_MERCHANT_COMMISSION);
            $criteria->addSelectColumn(SpyMerchantCommissionStoreTableMap::COL_FK_STORE);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_commission_store');
            $criteria->addSelectColumn($alias . '.fk_merchant_commission');
            $criteria->addSelectColumn($alias . '.fk_store');
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
            $criteria->removeSelectColumn(SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE);
            $criteria->removeSelectColumn(SpyMerchantCommissionStoreTableMap::COL_FK_MERCHANT_COMMISSION);
            $criteria->removeSelectColumn(SpyMerchantCommissionStoreTableMap::COL_FK_STORE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_commission_store');
            $criteria->removeSelectColumn($alias . '.fk_merchant_commission');
            $criteria->removeSelectColumn($alias . '.fk_store');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantCommissionStoreTableMap::DATABASE_NAME)->getTable(SpyMerchantCommissionStoreTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantCommissionStore or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantCommissionStore object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionStoreTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantCommissionStoreTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantCommissionStoreQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantCommissionStoreTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantCommissionStoreTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_commission_store table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantCommissionStoreQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantCommissionStore or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantCommissionStore object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionStoreTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantCommissionStore object
        }

        if ($criteria->containsKey(SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE) && $criteria->keyContainsValue(SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantCommissionStoreTableMap::COL_ID_MERCHANT_COMMISSION_STORE.')');
        }


        // Set the correct dbName
        $query = SpyMerchantCommissionStoreQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
