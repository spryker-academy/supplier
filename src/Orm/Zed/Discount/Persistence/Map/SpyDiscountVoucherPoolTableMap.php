<?php

namespace Orm\Zed\Discount\Persistence\Map;

use Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery;
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
 * This class defines the structure of the 'spy_discount_voucher_pool' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDiscountVoucherPoolTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Discount.Persistence.Map.SpyDiscountVoucherPoolTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_discount_voucher_pool';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDiscountVoucherPool';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucherPool';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Discount.Persistence.SpyDiscountVoucherPool';

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
     * the column name for the id_discount_voucher_pool field
     */
    public const COL_ID_DISCOUNT_VOUCHER_POOL = 'spy_discount_voucher_pool.id_discount_voucher_pool';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_discount_voucher_pool.is_active';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_discount_voucher_pool.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_discount_voucher_pool.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_discount_voucher_pool.updated_at';

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
        self::TYPE_PHPNAME       => ['IdDiscountVoucherPool', 'IsActive', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idDiscountVoucherPool', 'isActive', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL, SpyDiscountVoucherPoolTableMap::COL_IS_ACTIVE, SpyDiscountVoucherPoolTableMap::COL_NAME, SpyDiscountVoucherPoolTableMap::COL_CREATED_AT, SpyDiscountVoucherPoolTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_discount_voucher_pool', 'is_active', 'name', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdDiscountVoucherPool' => 0, 'IsActive' => 1, 'Name' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idDiscountVoucherPool' => 0, 'isActive' => 1, 'name' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL => 0, SpyDiscountVoucherPoolTableMap::COL_IS_ACTIVE => 1, SpyDiscountVoucherPoolTableMap::COL_NAME => 2, SpyDiscountVoucherPoolTableMap::COL_CREATED_AT => 3, SpyDiscountVoucherPoolTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_discount_voucher_pool' => 0, 'is_active' => 1, 'name' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDiscountVoucherPool' => 'ID_DISCOUNT_VOUCHER_POOL',
        'SpyDiscountVoucherPool.IdDiscountVoucherPool' => 'ID_DISCOUNT_VOUCHER_POOL',
        'idDiscountVoucherPool' => 'ID_DISCOUNT_VOUCHER_POOL',
        'spyDiscountVoucherPool.idDiscountVoucherPool' => 'ID_DISCOUNT_VOUCHER_POOL',
        'SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL' => 'ID_DISCOUNT_VOUCHER_POOL',
        'COL_ID_DISCOUNT_VOUCHER_POOL' => 'ID_DISCOUNT_VOUCHER_POOL',
        'id_discount_voucher_pool' => 'ID_DISCOUNT_VOUCHER_POOL',
        'spy_discount_voucher_pool.id_discount_voucher_pool' => 'ID_DISCOUNT_VOUCHER_POOL',
        'IsActive' => 'IS_ACTIVE',
        'SpyDiscountVoucherPool.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyDiscountVoucherPool.isActive' => 'IS_ACTIVE',
        'SpyDiscountVoucherPoolTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_discount_voucher_pool.is_active' => 'IS_ACTIVE',
        'Name' => 'NAME',
        'SpyDiscountVoucherPool.Name' => 'NAME',
        'name' => 'NAME',
        'spyDiscountVoucherPool.name' => 'NAME',
        'SpyDiscountVoucherPoolTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_discount_voucher_pool.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyDiscountVoucherPool.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyDiscountVoucherPool.createdAt' => 'CREATED_AT',
        'SpyDiscountVoucherPoolTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_discount_voucher_pool.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyDiscountVoucherPool.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyDiscountVoucherPool.updatedAt' => 'UPDATED_AT',
        'SpyDiscountVoucherPoolTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_discount_voucher_pool.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_discount_voucher_pool');
        $this->setPhpName('SpyDiscountVoucherPool');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucherPool');
        $this->setPackage('src.Orm.Zed.Discount.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_discount_voucher_pool_pk_seq');
        // columns
        $this->addPrimaryKey('id_discount_voucher_pool', 'IdDiscountVoucherPool', 'INTEGER', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, false);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('Discount', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscount', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_discount_voucher_pool',
    1 => ':id_discount_voucher_pool',
  ),
), null, null, 'Discounts', false);
        $this->addRelation('DiscountVoucher', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucher', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_discount_voucher_pool',
    1 => ':id_discount_voucher_pool',
  ),
), null, null, 'DiscountVouchers', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDiscountVoucherPool', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDiscountVoucherPoolTableMap::CLASS_DEFAULT : SpyDiscountVoucherPoolTableMap::OM_CLASS;
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
     * @return array (SpyDiscountVoucherPool object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDiscountVoucherPoolTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDiscountVoucherPoolTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDiscountVoucherPoolTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDiscountVoucherPoolTableMap::OM_CLASS;
            /** @var SpyDiscountVoucherPool $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDiscountVoucherPoolTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDiscountVoucherPoolTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDiscountVoucherPoolTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDiscountVoucherPool $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDiscountVoucherPoolTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL);
            $criteria->addSelectColumn(SpyDiscountVoucherPoolTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyDiscountVoucherPoolTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyDiscountVoucherPoolTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyDiscountVoucherPoolTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_discount_voucher_pool');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL);
            $criteria->removeSelectColumn(SpyDiscountVoucherPoolTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyDiscountVoucherPoolTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyDiscountVoucherPoolTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyDiscountVoucherPoolTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_discount_voucher_pool');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDiscountVoucherPoolTableMap::DATABASE_NAME)->getTable(SpyDiscountVoucherPoolTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDiscountVoucherPool or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDiscountVoucherPool object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountVoucherPoolTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDiscountVoucherPoolTableMap::DATABASE_NAME);
            $criteria->add(SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL, (array) $values, Criteria::IN);
        }

        $query = SpyDiscountVoucherPoolQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDiscountVoucherPoolTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDiscountVoucherPoolTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_discount_voucher_pool table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDiscountVoucherPoolQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDiscountVoucherPool or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDiscountVoucherPool object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountVoucherPoolTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDiscountVoucherPool object
        }

        if ($criteria->containsKey(SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL) && $criteria->keyContainsValue(SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDiscountVoucherPoolTableMap::COL_ID_DISCOUNT_VOUCHER_POOL.')');
        }


        // Set the correct dbName
        $query = SpyDiscountVoucherPoolQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
