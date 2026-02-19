<?php

namespace Orm\Zed\ShoppingList\Persistence\Map;

use Orm\Zed\ShoppingList\Persistence\SpyShoppingList;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery;
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
 * This class defines the structure of the 'spy_shopping_list' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShoppingListTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShoppingList.Persistence.Map.SpyShoppingListTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shopping_list';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShoppingList';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingList';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShoppingList.Persistence.SpyShoppingList';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_shopping_list field
     */
    public const COL_ID_SHOPPING_LIST = 'spy_shopping_list.id_shopping_list';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_shopping_list.customer_reference';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_shopping_list.description';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_shopping_list.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_shopping_list.name';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_shopping_list.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_shopping_list.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_shopping_list.updated_at';

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
        self::TYPE_PHPNAME       => ['IdShoppingList', 'CustomerReference', 'Description', 'Key', 'Name', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idShoppingList', 'customerReference', 'description', 'key', 'name', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyShoppingListTableMap::COL_ID_SHOPPING_LIST, SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE, SpyShoppingListTableMap::COL_DESCRIPTION, SpyShoppingListTableMap::COL_KEY, SpyShoppingListTableMap::COL_NAME, SpyShoppingListTableMap::COL_UUID, SpyShoppingListTableMap::COL_CREATED_AT, SpyShoppingListTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list', 'customer_reference', 'description', 'key', 'name', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdShoppingList' => 0, 'CustomerReference' => 1, 'Description' => 2, 'Key' => 3, 'Name' => 4, 'Uuid' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idShoppingList' => 0, 'customerReference' => 1, 'description' => 2, 'key' => 3, 'name' => 4, 'uuid' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyShoppingListTableMap::COL_ID_SHOPPING_LIST => 0, SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE => 1, SpyShoppingListTableMap::COL_DESCRIPTION => 2, SpyShoppingListTableMap::COL_KEY => 3, SpyShoppingListTableMap::COL_NAME => 4, SpyShoppingListTableMap::COL_UUID => 5, SpyShoppingListTableMap::COL_CREATED_AT => 6, SpyShoppingListTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list' => 0, 'customer_reference' => 1, 'description' => 2, 'key' => 3, 'name' => 4, 'uuid' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShoppingList' => 'ID_SHOPPING_LIST',
        'SpyShoppingList.IdShoppingList' => 'ID_SHOPPING_LIST',
        'idShoppingList' => 'ID_SHOPPING_LIST',
        'spyShoppingList.idShoppingList' => 'ID_SHOPPING_LIST',
        'SpyShoppingListTableMap::COL_ID_SHOPPING_LIST' => 'ID_SHOPPING_LIST',
        'COL_ID_SHOPPING_LIST' => 'ID_SHOPPING_LIST',
        'id_shopping_list' => 'ID_SHOPPING_LIST',
        'spy_shopping_list.id_shopping_list' => 'ID_SHOPPING_LIST',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpyShoppingList.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spyShoppingList.customerReference' => 'CUSTOMER_REFERENCE',
        'SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_shopping_list.customer_reference' => 'CUSTOMER_REFERENCE',
        'Description' => 'DESCRIPTION',
        'SpyShoppingList.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyShoppingList.description' => 'DESCRIPTION',
        'SpyShoppingListTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_shopping_list.description' => 'DESCRIPTION',
        'Key' => 'KEY',
        'SpyShoppingList.Key' => 'KEY',
        'key' => 'KEY',
        'spyShoppingList.key' => 'KEY',
        'SpyShoppingListTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_shopping_list.key' => 'KEY',
        'Name' => 'NAME',
        'SpyShoppingList.Name' => 'NAME',
        'name' => 'NAME',
        'spyShoppingList.name' => 'NAME',
        'SpyShoppingListTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_shopping_list.name' => 'NAME',
        'Uuid' => 'UUID',
        'SpyShoppingList.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyShoppingList.uuid' => 'UUID',
        'SpyShoppingListTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_shopping_list.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyShoppingList.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyShoppingList.createdAt' => 'CREATED_AT',
        'SpyShoppingListTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_shopping_list.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyShoppingList.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyShoppingList.updatedAt' => 'UPDATED_AT',
        'SpyShoppingListTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_shopping_list.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_shopping_list');
        $this->setPhpName('SpyShoppingList');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingList');
        $this->setPackage('src.Orm.Zed.ShoppingList.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shopping_list_pk_seq');
        // columns
        $this->addPrimaryKey('id_shopping_list', 'IdShoppingList', 'INTEGER', true, null, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
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
        $this->addRelation('SpyShoppingListItem', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shopping_list',
    1 => ':id_shopping_list',
  ),
), null, null, 'SpyShoppingListItems', false);
        $this->addRelation('SpyShoppingListCompanyUser', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shopping_list',
    1 => ':id_shopping_list',
  ),
), null, null, 'SpyShoppingListCompanyUsers', false);
        $this->addRelation('SpyShoppingListCompanyBusinessUnit', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_shopping_list',
    1 => ':id_shopping_list',
  ),
), null, null, 'SpyShoppingListCompanyBusinessUnits', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_shopping_list.customer_reference'],
            'event' => ['spy_shopping_list_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShoppingList', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShoppingListTableMap::CLASS_DEFAULT : SpyShoppingListTableMap::OM_CLASS;
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
     * @return array (SpyShoppingList object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShoppingListTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShoppingListTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShoppingListTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShoppingListTableMap::OM_CLASS;
            /** @var SpyShoppingList $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShoppingListTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShoppingListTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShoppingListTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShoppingList $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShoppingListTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyShoppingListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_shopping_list');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyShoppingListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shopping_list');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShoppingListTableMap::DATABASE_NAME)->getTable(SpyShoppingListTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShoppingList or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShoppingList object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingList) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShoppingListTableMap::DATABASE_NAME);
            $criteria->add(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST, (array) $values, Criteria::IN);
        }

        $query = SpyShoppingListQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShoppingListTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShoppingListTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shopping_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShoppingListQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShoppingList or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShoppingList object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShoppingList object
        }

        if ($criteria->containsKey(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST) && $criteria->keyContainsValue(SpyShoppingListTableMap::COL_ID_SHOPPING_LIST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShoppingListTableMap::COL_ID_SHOPPING_LIST.')');
        }


        // Set the correct dbName
        $query = SpyShoppingListQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
