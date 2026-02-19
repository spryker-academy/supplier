<?php

namespace Orm\Zed\ShoppingList\Persistence\Map;

use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery;
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
 * This class defines the structure of the 'spy_shopping_list_company_business_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShoppingListCompanyBusinessUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShoppingList.Persistence.Map.SpyShoppingListCompanyBusinessUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shopping_list_company_business_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShoppingListCompanyBusinessUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShoppingList.Persistence.SpyShoppingListCompanyBusinessUnit';

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
     * the column name for the id_shopping_list_company_business_unit field
     */
    public const COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT = 'spy_shopping_list_company_business_unit.id_shopping_list_company_business_unit';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_shopping_list_company_business_unit.fk_company_business_unit';

    /**
     * the column name for the fk_shopping_list field
     */
    public const COL_FK_SHOPPING_LIST = 'spy_shopping_list_company_business_unit.fk_shopping_list';

    /**
     * the column name for the fk_shopping_list_permission_group field
     */
    public const COL_FK_SHOPPING_LIST_PERMISSION_GROUP = 'spy_shopping_list_company_business_unit.fk_shopping_list_permission_group';

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
        self::TYPE_PHPNAME       => ['IdShoppingListCompanyBusinessUnit', 'FkCompanyBusinessUnit', 'FkShoppingList', 'FkShoppingListPermissionGroup', ],
        self::TYPE_CAMELNAME     => ['idShoppingListCompanyBusinessUnit', 'fkCompanyBusinessUnit', 'fkShoppingList', 'fkShoppingListPermissionGroup', ],
        self::TYPE_COLNAME       => [SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT, SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST, SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_company_business_unit', 'fk_company_business_unit', 'fk_shopping_list', 'fk_shopping_list_permission_group', ],
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
        self::TYPE_PHPNAME       => ['IdShoppingListCompanyBusinessUnit' => 0, 'FkCompanyBusinessUnit' => 1, 'FkShoppingList' => 2, 'FkShoppingListPermissionGroup' => 3, ],
        self::TYPE_CAMELNAME     => ['idShoppingListCompanyBusinessUnit' => 0, 'fkCompanyBusinessUnit' => 1, 'fkShoppingList' => 2, 'fkShoppingListPermissionGroup' => 3, ],
        self::TYPE_COLNAME       => [SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT => 0, SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 1, SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST => 2, SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP => 3, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_company_business_unit' => 0, 'fk_company_business_unit' => 1, 'fk_shopping_list' => 2, 'fk_shopping_list_permission_group' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShoppingListCompanyBusinessUnit' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'SpyShoppingListCompanyBusinessUnit.IdShoppingListCompanyBusinessUnit' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'idShoppingListCompanyBusinessUnit' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'spyShoppingListCompanyBusinessUnit.idShoppingListCompanyBusinessUnit' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'id_shopping_list_company_business_unit' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'spy_shopping_list_company_business_unit.id_shopping_list_company_business_unit' => 'ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyShoppingListCompanyBusinessUnit.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyShoppingListCompanyBusinessUnit.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_shopping_list_company_business_unit.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'FkShoppingList' => 'FK_SHOPPING_LIST',
        'SpyShoppingListCompanyBusinessUnit.FkShoppingList' => 'FK_SHOPPING_LIST',
        'fkShoppingList' => 'FK_SHOPPING_LIST',
        'spyShoppingListCompanyBusinessUnit.fkShoppingList' => 'FK_SHOPPING_LIST',
        'SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST' => 'FK_SHOPPING_LIST',
        'COL_FK_SHOPPING_LIST' => 'FK_SHOPPING_LIST',
        'fk_shopping_list' => 'FK_SHOPPING_LIST',
        'spy_shopping_list_company_business_unit.fk_shopping_list' => 'FK_SHOPPING_LIST',
        'FkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'SpyShoppingListCompanyBusinessUnit.FkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'fkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'spyShoppingListCompanyBusinessUnit.fkShoppingListPermissionGroup' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'COL_FK_SHOPPING_LIST_PERMISSION_GROUP' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'fk_shopping_list_permission_group' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
        'spy_shopping_list_company_business_unit.fk_shopping_list_permission_group' => 'FK_SHOPPING_LIST_PERMISSION_GROUP',
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
        $this->setName('spy_shopping_list_company_business_unit');
        $this->setPhpName('SpyShoppingListCompanyBusinessUnit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnit');
        $this->setPackage('src.Orm.Zed.ShoppingList.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shopping_list_company_business_unit_pk_seq');
        // columns
        $this->addPrimaryKey('id_shopping_list_company_business_unit', 'IdShoppingListCompanyBusinessUnit', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', true, null, null);
        $this->addForeignKey('fk_shopping_list', 'FkShoppingList', 'INTEGER', 'spy_shopping_list', 'id_shopping_list', true, null, null);
        $this->addForeignKey('fk_shopping_list_permission_group', 'FkShoppingListPermissionGroup', 'INTEGER', 'spy_shopping_list_permission_group', 'id_shopping_list_permission_group', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
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
        $this->addRelation('SpyShoppingListCompanyBusinessUnitBlacklist', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnitBlacklist', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shopping_list_company_business_unit',
    1 => ':id_shopping_list_company_business_unit',
  ),
), null, null, 'SpyShoppingListCompanyBusinessUnitBlacklists', false);
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
            'event' => ['spy_shopping_list_company_business_unit_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShoppingListCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShoppingListCompanyBusinessUnitTableMap::CLASS_DEFAULT : SpyShoppingListCompanyBusinessUnitTableMap::OM_CLASS;
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
     * @return array (SpyShoppingListCompanyBusinessUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShoppingListCompanyBusinessUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShoppingListCompanyBusinessUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShoppingListCompanyBusinessUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShoppingListCompanyBusinessUnitTableMap::OM_CLASS;
            /** @var SpyShoppingListCompanyBusinessUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShoppingListCompanyBusinessUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShoppingListCompanyBusinessUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShoppingListCompanyBusinessUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShoppingListCompanyBusinessUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShoppingListCompanyBusinessUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST);
            $criteria->addSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP);
        } else {
            $criteria->addSelectColumn($alias . '.id_shopping_list_company_business_unit');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
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
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST);
            $criteria->removeSelectColumn(SpyShoppingListCompanyBusinessUnitTableMap::COL_FK_SHOPPING_LIST_PERMISSION_GROUP);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shopping_list_company_business_unit');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME)->getTable(SpyShoppingListCompanyBusinessUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShoppingListCompanyBusinessUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShoppingListCompanyBusinessUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);
            $criteria->add(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT, (array) $values, Criteria::IN);
        }

        $query = SpyShoppingListCompanyBusinessUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShoppingListCompanyBusinessUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShoppingListCompanyBusinessUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shopping_list_company_business_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShoppingListCompanyBusinessUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShoppingListCompanyBusinessUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShoppingListCompanyBusinessUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShoppingListCompanyBusinessUnit object
        }

        if ($criteria->containsKey(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT) && $criteria->keyContainsValue(SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShoppingListCompanyBusinessUnitTableMap::COL_ID_SHOPPING_LIST_COMPANY_BUSINESS_UNIT.')');
        }


        // Set the correct dbName
        $query = SpyShoppingListCompanyBusinessUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
