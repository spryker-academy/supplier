<?php

namespace Orm\Zed\Product\Persistence\Map;

use Orm\Zed\ProductSearch\Persistence\Map\SpyProductSearchAttributeMapTableMap;
use Orm\Zed\Product\Persistence\SpyProductAttributeKey;
use Orm\Zed\Product\Persistence\SpyProductAttributeKeyQuery;
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
 * This class defines the structure of the 'spy_product_attribute_key' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductAttributeKeyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Product.Persistence.Map.SpyProductAttributeKeyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_attribute_key';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductAttributeKey';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Product\\Persistence\\SpyProductAttributeKey';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Product.Persistence.SpyProductAttributeKey';

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
     * the column name for the id_product_attribute_key field
     */
    public const COL_ID_PRODUCT_ATTRIBUTE_KEY = 'spy_product_attribute_key.id_product_attribute_key';

    /**
     * the column name for the is_super field
     */
    public const COL_IS_SUPER = 'spy_product_attribute_key.is_super';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_attribute_key.key';

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
        self::TYPE_PHPNAME       => ['IdProductAttributeKey', 'IsSuper', 'Key', ],
        self::TYPE_CAMELNAME     => ['idProductAttributeKey', 'isSuper', 'key', ],
        self::TYPE_COLNAME       => [SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY, SpyProductAttributeKeyTableMap::COL_IS_SUPER, SpyProductAttributeKeyTableMap::COL_KEY, ],
        self::TYPE_FIELDNAME     => ['id_product_attribute_key', 'is_super', 'key', ],
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
        self::TYPE_PHPNAME       => ['IdProductAttributeKey' => 0, 'IsSuper' => 1, 'Key' => 2, ],
        self::TYPE_CAMELNAME     => ['idProductAttributeKey' => 0, 'isSuper' => 1, 'key' => 2, ],
        self::TYPE_COLNAME       => [SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY => 0, SpyProductAttributeKeyTableMap::COL_IS_SUPER => 1, SpyProductAttributeKeyTableMap::COL_KEY => 2, ],
        self::TYPE_FIELDNAME     => ['id_product_attribute_key' => 0, 'is_super' => 1, 'key' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductAttributeKey' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'SpyProductAttributeKey.IdProductAttributeKey' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'idProductAttributeKey' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'spyProductAttributeKey.idProductAttributeKey' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'COL_ID_PRODUCT_ATTRIBUTE_KEY' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'id_product_attribute_key' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'spy_product_attribute_key.id_product_attribute_key' => 'ID_PRODUCT_ATTRIBUTE_KEY',
        'IsSuper' => 'IS_SUPER',
        'SpyProductAttributeKey.IsSuper' => 'IS_SUPER',
        'isSuper' => 'IS_SUPER',
        'spyProductAttributeKey.isSuper' => 'IS_SUPER',
        'SpyProductAttributeKeyTableMap::COL_IS_SUPER' => 'IS_SUPER',
        'COL_IS_SUPER' => 'IS_SUPER',
        'is_super' => 'IS_SUPER',
        'spy_product_attribute_key.is_super' => 'IS_SUPER',
        'Key' => 'KEY',
        'SpyProductAttributeKey.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductAttributeKey.key' => 'KEY',
        'SpyProductAttributeKeyTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_attribute_key.key' => 'KEY',
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
        $this->setName('spy_product_attribute_key');
        $this->setPhpName('SpyProductAttributeKey');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Product\\Persistence\\SpyProductAttributeKey');
        $this->setPackage('src.Orm.Zed.Product.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_attribute_key_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_attribute_key', 'IdProductAttributeKey', 'INTEGER', true, null, null);
        $this->addColumn('is_super', 'IsSuper', 'BOOLEAN', true, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyProductManagementAttribute', '\\Orm\\Zed\\ProductAttribute\\Persistence\\SpyProductManagementAttribute', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_attribute_key',
    1 => ':id_product_attribute_key',
  ),
), null, null, 'SpyProductManagementAttributes', false);
        $this->addRelation('SpyProductSearchAttributeMap', '\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearchAttributeMap', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_attribute_key',
    1 => ':id_product_attribute_key',
  ),
), 'CASCADE', null, 'SpyProductSearchAttributeMaps', false);
        $this->addRelation('SpyProductSearchAttribute', '\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearchAttribute', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_attribute_key',
    1 => ':id_product_attribute_key',
  ),
), null, null, 'SpyProductSearchAttributes', false);
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
            'event' => ['spy_product_attribute_key_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_product_attribute_key     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyProductSearchAttributeMapTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductAttributeKeyTableMap::CLASS_DEFAULT : SpyProductAttributeKeyTableMap::OM_CLASS;
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
     * @return array (SpyProductAttributeKey object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductAttributeKeyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductAttributeKeyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductAttributeKeyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductAttributeKeyTableMap::OM_CLASS;
            /** @var SpyProductAttributeKey $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductAttributeKeyTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductAttributeKeyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductAttributeKeyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductAttributeKey $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductAttributeKeyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY);
            $criteria->addSelectColumn(SpyProductAttributeKeyTableMap::COL_IS_SUPER);
            $criteria->addSelectColumn(SpyProductAttributeKeyTableMap::COL_KEY);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_attribute_key');
            $criteria->addSelectColumn($alias . '.is_super');
            $criteria->addSelectColumn($alias . '.key');
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
            $criteria->removeSelectColumn(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY);
            $criteria->removeSelectColumn(SpyProductAttributeKeyTableMap::COL_IS_SUPER);
            $criteria->removeSelectColumn(SpyProductAttributeKeyTableMap::COL_KEY);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_attribute_key');
            $criteria->removeSelectColumn($alias . '.is_super');
            $criteria->removeSelectColumn($alias . '.key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductAttributeKeyTableMap::DATABASE_NAME)->getTable(SpyProductAttributeKeyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductAttributeKey or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductAttributeKey object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAttributeKeyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Product\Persistence\SpyProductAttributeKey) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductAttributeKeyTableMap::DATABASE_NAME);
            $criteria->add(SpyProductAttributeKeyTableMap::COL_ID_PRODUCT_ATTRIBUTE_KEY, (array) $values, Criteria::IN);
        }

        $query = SpyProductAttributeKeyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductAttributeKeyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductAttributeKeyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_attribute_key table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductAttributeKeyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductAttributeKey or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductAttributeKey object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAttributeKeyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductAttributeKey object
        }


        // Set the correct dbName
        $query = SpyProductAttributeKeyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
