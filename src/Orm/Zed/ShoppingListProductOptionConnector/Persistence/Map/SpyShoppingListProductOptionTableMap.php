<?php

namespace Orm\Zed\ShoppingListProductOptionConnector\Persistence\Map;

use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery;
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
 * This class defines the structure of the 'spy_shopping_list_product_option' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShoppingListProductOptionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShoppingListProductOptionConnector.Persistence.Map.SpyShoppingListProductOptionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shopping_list_product_option';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShoppingListProductOption';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShoppingListProductOptionConnector\\Persistence\\SpyShoppingListProductOption';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShoppingListProductOptionConnector.Persistence.SpyShoppingListProductOption';

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
     * the column name for the id_shopping_list_item_product_option field
     */
    public const COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION = 'spy_shopping_list_product_option.id_shopping_list_item_product_option';

    /**
     * the column name for the fk_product_option_value field
     */
    public const COL_FK_PRODUCT_OPTION_VALUE = 'spy_shopping_list_product_option.fk_product_option_value';

    /**
     * the column name for the fk_shopping_list_item field
     */
    public const COL_FK_SHOPPING_LIST_ITEM = 'spy_shopping_list_product_option.fk_shopping_list_item';

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
        self::TYPE_PHPNAME       => ['IdShoppingListItemProductOption', 'FkProductOptionValue', 'FkShoppingListItem', ],
        self::TYPE_CAMELNAME     => ['idShoppingListItemProductOption', 'fkProductOptionValue', 'fkShoppingListItem', ],
        self::TYPE_COLNAME       => [SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE, SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_item_product_option', 'fk_product_option_value', 'fk_shopping_list_item', ],
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
        self::TYPE_PHPNAME       => ['IdShoppingListItemProductOption' => 0, 'FkProductOptionValue' => 1, 'FkShoppingListItem' => 2, ],
        self::TYPE_CAMELNAME     => ['idShoppingListItemProductOption' => 0, 'fkProductOptionValue' => 1, 'fkShoppingListItem' => 2, ],
        self::TYPE_COLNAME       => [SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION => 0, SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE => 1, SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM => 2, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_item_product_option' => 0, 'fk_product_option_value' => 1, 'fk_shopping_list_item' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShoppingListItemProductOption' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'SpyShoppingListProductOption.IdShoppingListItemProductOption' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'idShoppingListItemProductOption' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'spyShoppingListProductOption.idShoppingListItemProductOption' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'id_shopping_list_item_product_option' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'spy_shopping_list_product_option.id_shopping_list_item_product_option' => 'ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION',
        'FkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'SpyShoppingListProductOption.FkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'fkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'spyShoppingListProductOption.fkProductOptionValue' => 'FK_PRODUCT_OPTION_VALUE',
        'SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE' => 'FK_PRODUCT_OPTION_VALUE',
        'COL_FK_PRODUCT_OPTION_VALUE' => 'FK_PRODUCT_OPTION_VALUE',
        'fk_product_option_value' => 'FK_PRODUCT_OPTION_VALUE',
        'spy_shopping_list_product_option.fk_product_option_value' => 'FK_PRODUCT_OPTION_VALUE',
        'FkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'SpyShoppingListProductOption.FkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'fkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'spyShoppingListProductOption.fkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM' => 'FK_SHOPPING_LIST_ITEM',
        'COL_FK_SHOPPING_LIST_ITEM' => 'FK_SHOPPING_LIST_ITEM',
        'fk_shopping_list_item' => 'FK_SHOPPING_LIST_ITEM',
        'spy_shopping_list_product_option.fk_shopping_list_item' => 'FK_SHOPPING_LIST_ITEM',
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
        $this->setName('spy_shopping_list_product_option');
        $this->setPhpName('SpyShoppingListProductOption');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ShoppingListProductOptionConnector\\Persistence\\SpyShoppingListProductOption');
        $this->setPackage('src.Orm.Zed.ShoppingListProductOptionConnector.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shopping_list_product_option_pk_seq');
        // columns
        $this->addPrimaryKey('id_shopping_list_item_product_option', 'IdShoppingListItemProductOption', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_option_value', 'FkProductOptionValue', 'INTEGER', 'spy_product_option_value', 'id_product_option_value', true, null, null);
        $this->addForeignKey('fk_shopping_list_item', 'FkShoppingListItem', 'INTEGER', 'spy_shopping_list_item', 'id_shopping_list_item', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyShoppingListItem', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shopping_list_item',
    1 => ':id_shopping_list_item',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductOptionValue', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValue', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_option_value',
    1 => ':id_product_option_value',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShoppingListItemProductOption', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShoppingListProductOptionTableMap::CLASS_DEFAULT : SpyShoppingListProductOptionTableMap::OM_CLASS;
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
     * @return array (SpyShoppingListProductOption object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShoppingListProductOptionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShoppingListProductOptionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShoppingListProductOptionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShoppingListProductOptionTableMap::OM_CLASS;
            /** @var SpyShoppingListProductOption $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShoppingListProductOptionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShoppingListProductOptionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShoppingListProductOptionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShoppingListProductOption $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShoppingListProductOptionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION);
            $criteria->addSelectColumn(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE);
            $criteria->addSelectColumn(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM);
        } else {
            $criteria->addSelectColumn($alias . '.id_shopping_list_item_product_option');
            $criteria->addSelectColumn($alias . '.fk_product_option_value');
            $criteria->addSelectColumn($alias . '.fk_shopping_list_item');
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
            $criteria->removeSelectColumn(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION);
            $criteria->removeSelectColumn(SpyShoppingListProductOptionTableMap::COL_FK_PRODUCT_OPTION_VALUE);
            $criteria->removeSelectColumn(SpyShoppingListProductOptionTableMap::COL_FK_SHOPPING_LIST_ITEM);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shopping_list_item_product_option');
            $criteria->removeSelectColumn($alias . '.fk_product_option_value');
            $criteria->removeSelectColumn($alias . '.fk_shopping_list_item');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShoppingListProductOptionTableMap::DATABASE_NAME)->getTable(SpyShoppingListProductOptionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShoppingListProductOption or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShoppingListProductOption object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListProductOptionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShoppingListProductOptionTableMap::DATABASE_NAME);
            $criteria->add(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION, (array) $values, Criteria::IN);
        }

        $query = SpyShoppingListProductOptionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShoppingListProductOptionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShoppingListProductOptionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shopping_list_product_option table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShoppingListProductOptionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShoppingListProductOption or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShoppingListProductOption object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListProductOptionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShoppingListProductOption object
        }

        if ($criteria->containsKey(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION) && $criteria->keyContainsValue(SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShoppingListProductOptionTableMap::COL_ID_SHOPPING_LIST_ITEM_PRODUCT_OPTION.')');
        }


        // Set the correct dbName
        $query = SpyShoppingListProductOptionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
