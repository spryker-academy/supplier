<?php

namespace Orm\Zed\PriceProductSchedule\Persistence\Map;

use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleList;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleListQuery;
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
 * This class defines the structure of the 'spy_price_product_schedule_list' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductScheduleListTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductSchedule.Persistence.Map.SpyPriceProductScheduleListTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_schedule_list';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductScheduleList';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductScheduleList';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductSchedule.Persistence.SpyPriceProductScheduleList';

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
     * the column name for the id_price_product_schedule_list field
     */
    public const COL_ID_PRICE_PRODUCT_SCHEDULE_LIST = 'spy_price_product_schedule_list.id_price_product_schedule_list';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_price_product_schedule_list.name';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_price_product_schedule_list.is_active';

    /**
     * the column name for the fk_user field
     */
    public const COL_FK_USER = 'spy_price_product_schedule_list.fk_user';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_price_product_schedule_list.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_price_product_schedule_list.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPriceProductScheduleList', 'Name', 'IsActive', 'FkUser', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPriceProductScheduleList', 'name', 'isActive', 'fkUser', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST, SpyPriceProductScheduleListTableMap::COL_NAME, SpyPriceProductScheduleListTableMap::COL_IS_ACTIVE, SpyPriceProductScheduleListTableMap::COL_FK_USER, SpyPriceProductScheduleListTableMap::COL_CREATED_AT, SpyPriceProductScheduleListTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_price_product_schedule_list', 'name', 'is_active', 'fk_user', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductScheduleList' => 0, 'Name' => 1, 'IsActive' => 2, 'FkUser' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idPriceProductScheduleList' => 0, 'name' => 1, 'isActive' => 2, 'fkUser' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST => 0, SpyPriceProductScheduleListTableMap::COL_NAME => 1, SpyPriceProductScheduleListTableMap::COL_IS_ACTIVE => 2, SpyPriceProductScheduleListTableMap::COL_FK_USER => 3, SpyPriceProductScheduleListTableMap::COL_CREATED_AT => 4, SpyPriceProductScheduleListTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_price_product_schedule_list' => 0, 'name' => 1, 'is_active' => 2, 'fk_user' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductScheduleList' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'SpyPriceProductScheduleList.IdPriceProductScheduleList' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'idPriceProductScheduleList' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'spyPriceProductScheduleList.idPriceProductScheduleList' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'COL_ID_PRICE_PRODUCT_SCHEDULE_LIST' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'id_price_product_schedule_list' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'spy_price_product_schedule_list.id_price_product_schedule_list' => 'ID_PRICE_PRODUCT_SCHEDULE_LIST',
        'Name' => 'NAME',
        'SpyPriceProductScheduleList.Name' => 'NAME',
        'name' => 'NAME',
        'spyPriceProductScheduleList.name' => 'NAME',
        'SpyPriceProductScheduleListTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_price_product_schedule_list.name' => 'NAME',
        'IsActive' => 'IS_ACTIVE',
        'SpyPriceProductScheduleList.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyPriceProductScheduleList.isActive' => 'IS_ACTIVE',
        'SpyPriceProductScheduleListTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_price_product_schedule_list.is_active' => 'IS_ACTIVE',
        'FkUser' => 'FK_USER',
        'SpyPriceProductScheduleList.FkUser' => 'FK_USER',
        'fkUser' => 'FK_USER',
        'spyPriceProductScheduleList.fkUser' => 'FK_USER',
        'SpyPriceProductScheduleListTableMap::COL_FK_USER' => 'FK_USER',
        'COL_FK_USER' => 'FK_USER',
        'fk_user' => 'FK_USER',
        'spy_price_product_schedule_list.fk_user' => 'FK_USER',
        'CreatedAt' => 'CREATED_AT',
        'SpyPriceProductScheduleList.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPriceProductScheduleList.createdAt' => 'CREATED_AT',
        'SpyPriceProductScheduleListTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_price_product_schedule_list.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPriceProductScheduleList.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPriceProductScheduleList.updatedAt' => 'UPDATED_AT',
        'SpyPriceProductScheduleListTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_price_product_schedule_list.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_price_product_schedule_list');
        $this->setPhpName('SpyPriceProductScheduleList');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductScheduleList');
        $this->setPackage('src.Orm.Zed.PriceProductSchedule.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_schedule_list_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_schedule_list', 'IdPriceProductScheduleList', 'BIGINT', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, false);
        $this->addForeignKey('fk_user', 'FkUser', 'INTEGER', 'spy_user', 'id_user', false, null, null);
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
        $this->addRelation('User', '\\Orm\\Zed\\User\\Persistence\\SpyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_user',
    1 => ':id_user',
  ),
), null, null, null, false);
        $this->addRelation('PriceProductSchedule', '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_product_schedule_list',
    1 => ':id_price_product_schedule_list',
  ),
), null, null, 'PriceProductSchedules', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductScheduleList', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductScheduleListTableMap::CLASS_DEFAULT : SpyPriceProductScheduleListTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductScheduleList object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductScheduleListTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductScheduleListTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductScheduleListTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductScheduleListTableMap::OM_CLASS;
            /** @var SpyPriceProductScheduleList $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductScheduleListTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductScheduleListTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductScheduleListTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductScheduleList $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductScheduleListTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST);
            $criteria->addSelectColumn(SpyPriceProductScheduleListTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyPriceProductScheduleListTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyPriceProductScheduleListTableMap::COL_FK_USER);
            $criteria->addSelectColumn(SpyPriceProductScheduleListTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPriceProductScheduleListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_schedule_list');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.fk_user');
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
            $criteria->removeSelectColumn(SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST);
            $criteria->removeSelectColumn(SpyPriceProductScheduleListTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyPriceProductScheduleListTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyPriceProductScheduleListTableMap::COL_FK_USER);
            $criteria->removeSelectColumn(SpyPriceProductScheduleListTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPriceProductScheduleListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_schedule_list');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.fk_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductScheduleListTableMap::DATABASE_NAME)->getTable(SpyPriceProductScheduleListTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductScheduleList or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductScheduleList object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductScheduleListTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleList) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductScheduleListTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductScheduleListQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductScheduleListTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductScheduleListTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_schedule_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductScheduleListQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductScheduleList or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductScheduleList object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductScheduleListTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductScheduleList object
        }

        if ($criteria->containsKey(SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST) && $criteria->keyContainsValue(SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductScheduleListTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE_LIST.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductScheduleListQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
