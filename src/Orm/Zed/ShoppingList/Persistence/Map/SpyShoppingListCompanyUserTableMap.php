<?php

namespace Orm\Zed\ShoppingList\Persistence\Map;

use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery;
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
 * This class defines the structure of the 'spy_shopping_list_company_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShoppingListCompanyUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShoppingList.Persistence.Map.SpyShoppingListCompanyUserTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shopping_list_company_user';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShoppingListCompanyUser';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyUser';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShoppingList.Persistence.SpyShoppingListCompanyUser';

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
     * the column name for the id_shopping_list_company_user field
     */
    public const COL_ID_SHOPPING_LIST_COMPANY_USER = 'spy_shopping_list_company_user.id_shopping_list_company_user';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_shopping_list_company_user.fk_company_user';

    /**
     * the column name for the fk_shopping_list field
     */
    public const COL_FK_SHOPPING_LIST = 'spy_shopping_list_company_user.fk_shopping_list';

    /**
     * the column name for the fk_shopping_list_permission_group field
     */
    public const COL_FK_SHOPPING_LIST_PERMISSION_GROUP = 'spy_shopping_list_company_user.fk_shopping_list_permission_group';

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
        self::TYPE_PHPNAME       => ['IdShoppingListCompanyUser', 'FkCompanyUser', 'FkShoppingList', 'FkShoppingListPermissionGroup', ],
        self::TYPE_CAMELNAME     => ['idShoppingListCompanyUser', 'fkCompanyUser', 'fkShoppingList', 'fkShoppingListPermissionGroup', ],
        self::TYPE_COLNAME       => [SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER, SpyShoppingListCompanyUserTableMap::COL_FK_COMPANY_USER, SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST, SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_company_user', 'fk_company_user', 'fk_shopping_list', 'fk_shopping_list_permission_group', ],
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
        self::TYPE_PHPNAME       => ['IdShoppingListCompanyUser' => 0, 'FkCompanyUser' => 1, 'FkShoppingList' => 2, 'FkShoppingListPermissionGroup' => 3, ],
        self::TYPE_CAMELNAME     => ['idShoppingListCompanyUser' => 0, 'fkCompanyUser' => 1, 'fkShoppingList' => 2, 'fkShoppingListPermissionGroup' => 3, ],
        self::TYPE_COLNAME       => [SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER => 0, SpyShoppingListCompanyUserTableMap::COL_FK_COMPANY_USER => 1, SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST => 2, SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP => 3, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_company_user' => 0, 'fk_company_user' => 1, 'fk_shopping_list' => 2, 'fk_shopping_list_permission_group' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShoppingListCompanyUser' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'SpyShoppingListCompanyUser.IdShoppingListCompanyUser' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'idShoppingListCompanyUser' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'spyShoppingListCompanyUser.idShoppingListCompanyUser' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'COL_ID_SHOPPING_LIST_COMPANY_USER' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'id_shopping_list_company_user' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'spy_shopping_list_company_user.id_shopping_list_company_user' => 'ID_SHOPPING_LIST_COMPANY_USER',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyShoppingListCompanyUser.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyShoppingListCompanyUser.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyShoppingListCompanyUserTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_shopping_list_company_user.fk_company_user' => 'FK_COMPANY_USER',
        'FkShoppingList' => 'FK_SHOPPING_LIST',
        'SpyShoppingListCompanyUser.FkShoppingList' => 'FK_SHOPPING_LIST',
        'fkShoppingList' => 'FK_SHOPPING_LIST',
        'spyShoppingListCompanyUser.fkShoppingList' => 'FK_SHOPPING_LIST',
        'SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST' => 'FK_SHOPPING_LIST',
        'COL_FK_SHOPPING_LIST' => 'FK_SHOPPING_LIST',
        'fk_shopping_list' => 'FK_SHOPPING_LIST',
        'spy_shopping_list_company_user.fk_shopping_list' => 'FK_SHOPPING_LIST',
        'FkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'SpyShoppingListCompanyUser.FkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'fkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'spyShoppingListCompanyUser.fkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'COL_FK_SHOPPING_LIST_PERMISSION_GROUP' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'fk_shopping_list_permission_group' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'spy_shopping_list_company_user.fk_shopping_list_permission_group' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
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
        $this->setName('spy_shopping_list_company_user');
        $this->setPhpName('SpyShoppingListCompanyUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyUser');
        $this->setPackage('src.Orm.Zed.ShoppingList.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shopping_list_company_user_pk_seq');
        // columns
        $this->addPrimaryKey('id_shopping_list_company_user', 'IdShoppingListCompanyUser', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addForeignKey('fk_shopping_list', 'FkShoppingList', 'INTEGER', 'spy_shopping_list', 'id_shopping_list', false, null, null);
        $this->addForeignKey('fk_shopping_list_permission_group', 'FkShoppingListPermissionGroup', 'INTEGER', 'spy_shopping_list_permission_group', 'id_shopping_list_permission_group', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user',
    1 => ':id_company_user',
  ),
), null, null, null, false);
        $this->addRelation('SpyShoppingList', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingList', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shopping_list',
    1 => ':id_shopping_list',
  ),
), null, null, null, false);
        $this->addRelation('SpyShoppingListPermissionGroup', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListPermissionGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shopping_list_permission_group',
    1 => ':id_shopping_list_permission_group',
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
            'event' => ['spy_shopping_list_company_user_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShoppingListCompanyUser', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShoppingListCompanyUserTableMap::CLASS_DEFAULT : SpyShoppingListCompanyUserTableMap::OM_CLASS;
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
     * @return array (SpyShoppingListCompanyUser object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShoppingListCompanyUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShoppingListCompanyUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShoppingListCompanyUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShoppingListCompanyUserTableMap::OM_CLASS;
            /** @var SpyShoppingListCompanyUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShoppingListCompanyUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShoppingListCompanyUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShoppingListCompanyUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShoppingListCompanyUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShoppingListCompanyUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER);
            $criteria->addSelectColumn(SpyShoppingListCompanyUserTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST);
            $criteria->addSelectColumn(SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP);
        } else {
            $criteria->addSelectColumn($alias . '.id_shopping_list_company_user');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.fk_shopping_list');
            $criteria->addSelectColumn($alias . '.fk_shopping_list_permission_group');
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
            $criteria->removeSelectColumn(SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER);
            $criteria->removeSelectColumn(SpyShoppingListCompanyUserTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST);
            $criteria->removeSelectColumn(SpyShoppingListCompanyUserTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shopping_list_company_user');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.fk_shopping_list');
            $criteria->removeSelectColumn($alias . '.fk_shopping_list_permission_group');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShoppingListCompanyUserTableMap::DATABASE_NAME)->getTable(SpyShoppingListCompanyUserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShoppingListCompanyUser or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShoppingListCompanyUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShoppingListCompanyUserTableMap::DATABASE_NAME);
            $criteria->add(SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER, (array) $values, Criteria::IN);
        }

        $query = SpyShoppingListCompanyUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShoppingListCompanyUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShoppingListCompanyUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shopping_list_company_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShoppingListCompanyUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShoppingListCompanyUser or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShoppingListCompanyUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShoppingListCompanyUser object
        }

        if ($criteria->containsKey(SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER) && $criteria->keyContainsValue(SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShoppingListCompanyUserTableMap::COL_ID_SHOPPING_LIST_COMPANY_USER.')');
        }


        // Set the correct dbName
        $query = SpyShoppingListCompanyUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
