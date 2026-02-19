<?php

namespace Orm\Zed\ShoppingList\Persistence\Map;

use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery;
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
 * This class defines the structure of the 'spy_shopping_list_company_business_unit_blacklist' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShoppingListCompanyBusinessUnitBlacklistTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShoppingList.Persistence.Map.SpyShoppingListCompanyBusinessUnitBlacklistTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shopping_list_company_business_unit_blacklist';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShoppingListCompanyBusinessUnitBlacklist';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnitBlacklist';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShoppingList.Persistence.SpyShoppingListCompanyBusinessUnitBlacklist';

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
     * the column name for the id_shopping_list_company_business_unit_blacklist field
     */
    public const COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST = 'spy_shopping_list_company_business_unit_blacklist.id_shopping_list_company_business_unit_blacklist';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_shopping_list_company_business_unit_blacklist.fk_company_user';

    /**
     * the column name for the fk_shopping_list_company_business_unit field
     */
    public const COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT = 'spy_shopping_list_company_business_unit_blacklist.fk_shopping_list_company_business_unit';

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
        self::TYPE_PHPNAME       => ['IdShoppingListCompanyBusinessUnitBlacklist', 'FkCompanyUser', 'FkShoppingListCompanyBusinessUnit', ],
        self::TYPE_CAMELNAME     => ['idShoppingListCompanyBusinessUnitBlacklist', 'fkCompanyUser', 'fkShoppingListCompanyBusinessUnit', ],
        self::TYPE_COLNAME       => [SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST, SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_COMPANY_USER, SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_company_business_unit_blacklist', 'fk_company_user', 'fk_shopping_list_company_business_unit', ],
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
        self::TYPE_PHPNAME       => ['IdShoppingListCompanyBusinessUnitBlacklist' => 0, 'FkCompanyUser' => 1, 'FkShoppingListCompanyBusinessUnit' => 2, ],
        self::TYPE_CAMELNAME     => ['idShoppingListCompanyBusinessUnitBlacklist' => 0, 'fkCompanyUser' => 1, 'fkShoppingListCompanyBusinessUnit' => 2, ],
        self::TYPE_COLNAME       => [SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST => 0, SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_COMPANY_USER => 1, SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT => 2, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_company_business_unit_blacklist' => 0, 'fk_company_user' => 1, 'fk_shopping_list_company_business_unit' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShoppingListCompanyBusinessUnitBlacklist' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'SpyShoppingListCompanyBusinessUnitBlacklist.IdShoppingListCompanyBusinessUnitBlacklist' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'idShoppingListCompanyBusinessUnitBlacklist' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'spyShoppingListCompanyBusinessUnitBlacklist.idShoppingListCompanyBusinessUnitBlacklist' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'id_shopping_list_company_business_unit_blacklist' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'spy_shopping_list_company_business_unit_blacklist.id_shopping_list_company_business_unit_blacklist' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyShoppingListCompanyBusinessUnitBlacklist.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyShoppingListCompanyBusinessUnitBlacklist.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_shopping_list_company_business_unit_blacklist.fk_company_user' => 'FK_COMPANY_USER',
        'FkShoppingListCompanyBusinessUnit' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'SpyShoppingListCompanyBusinessUnitBlacklist.FkShoppingListCompanyBusinessUnit' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'fkShoppingListCompanyBusinessUnit' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'spyShoppingListCompanyBusinessUnitBlacklist.fkShoppingListCompanyBusinessUnit' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'fk_shopping_list_company_business_unit' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'spy_shopping_list_company_business_unit_blacklist.fk_shopping_list_company_business_unit' => 'FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
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
        $this->setName('spy_shopping_list_company_business_unit_blacklist');
        $this->setPhpName('SpyShoppingListCompanyBusinessUnitBlacklist');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnitBlacklist');
        $this->setPackage('src.Orm.Zed.ShoppingList.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shopping_list_company_business_unit_blacklist_pk_seq');
        // columns
        $this->addPrimaryKey('id_shopping_list_company_business_unit_blacklist', 'IdShoppingListCompanyBusinessUnitBlacklist', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addForeignKey('fk_shopping_list_company_business_unit', 'FkShoppingListCompanyBusinessUnit', 'INTEGER', 'spy_shopping_list_company_business_unit', 'id_shopping_list_company_business_unit', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyShoppingListCompanyBusinessUnit', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shopping_list_company_business_unit',
    1 => ':id_shopping_list_company_business_unit',
  ),
), null, null, null, false);
        $this->addRelation('SpyCompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user',
    1 => ':id_company_user',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShoppingListCompanyBusinessUnitBlacklist', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShoppingListCompanyBusinessUnitBlacklistTableMap::CLASS_DEFAULT : SpyShoppingListCompanyBusinessUnitBlacklistTableMap::OM_CLASS;
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
     * @return array (SpyShoppingListCompanyBusinessUnitBlacklist object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShoppingListCompanyBusinessUnitBlacklistTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::OM_CLASS;
            /** @var SpyShoppingListCompanyBusinessUnitBlacklist $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShoppingListCompanyBusinessUnitBlacklistTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShoppingListCompanyBusinessUnitBlacklistTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShoppingListCompanyBusinessUnitBlacklist $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShoppingListCompanyBusinessUnitBlacklistTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST);
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT);
        } else {
            $criteria->addSelectColumn($alias . '.id_shopping_list_company_business_unit_blacklist');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.fk_shopping_list_company_business_unit');
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
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST);
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_FK_SHOPPING_LIST_COMPANY_BUSINESS_UNIT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shopping_list_company_business_unit_blacklist');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.fk_shopping_list_company_business_unit');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::DATABASE_NAME)->getTable(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShoppingListCompanyBusinessUnitBlacklist or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShoppingListCompanyBusinessUnitBlacklist object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::DATABASE_NAME);
            $criteria->add(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST, (array) $values, Criteria::IN);
        }

        $query = SpyShoppingListCompanyBusinessUnitBlacklistQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShoppingListCompanyBusinessUnitBlacklistTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShoppingListCompanyBusinessUnitBlacklistTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shopping_list_company_business_unit_blacklist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShoppingListCompanyBusinessUnitBlacklistQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShoppingListCompanyBusinessUnitBlacklist or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShoppingListCompanyBusinessUnitBlacklist object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShoppingListCompanyBusinessUnitBlacklist object
        }

        if ($criteria->containsKey(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST) && $criteria->keyContainsValue(SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShoppingListCompanyBusinessUnitBlacklistTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT_BLACKLIST.')');
        }


        // Set the correct dbName
        $query = SpyShoppingListCompanyBusinessUnitBlacklistQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
