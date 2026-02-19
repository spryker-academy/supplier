<?php

namespace Orm\Zed\ProductBundle\Persistence\Map;

use Orm\Zed\ProductBundle\Persistence\SpyProductBundle;
use Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery;
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
 * This class defines the structure of the 'spy_product_bundle' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductBundleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductBundle.Persistence.Map.SpyProductBundleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_bundle';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductBundle';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductBundle\\Persistence\\SpyProductBundle';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductBundle.Persistence.SpyProductBundle';

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
     * the column name for the id_product_bundle field
     */
    public const COL_ID_PRODUCT_BUNDLE = 'spy_product_bundle.id_product_bundle';

    /**
     * the column name for the fk_bundled_product field
     */
    public const COL_FK_BUNDLED_PRODUCT = 'spy_product_bundle.fk_bundled_product';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_bundle.fk_product';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'spy_product_bundle.quantity';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_bundle.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_bundle.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductBundle', 'FkBundledProduct', 'FkProduct', 'Quantity', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductBundle', 'fkBundledProduct', 'fkProduct', 'quantity', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductBundleTableMap::COL_ID_PRODUCT_BUNDLE, SpyProductBundleTableMap::COL_FK_BUNDLED_PRODUCT, SpyProductBundleTableMap::COL_FK_PRODUCT, SpyProductBundleTableMap::COL_QUANTITY, SpyProductBundleTableMap::COL_CREATED_AT, SpyProductBundleTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_bundle', 'fk_bundled_product', 'fk_product', 'quantity', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductBundle' => 0, 'FkBundledProduct' => 1, 'FkProduct' => 2, 'Quantity' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idProductBundle' => 0, 'fkBundledProduct' => 1, 'fkProduct' => 2, 'quantity' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyProductBundleTableMap::COL_ID_PRODUCT_BUNDLE => 0, SpyProductBundleTableMap::COL_FK_BUNDLED_PRODUCT => 1, SpyProductBundleTableMap::COL_FK_PRODUCT => 2, SpyProductBundleTableMap::COL_QUANTITY => 3, SpyProductBundleTableMap::COL_CREATED_AT => 4, SpyProductBundleTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_product_bundle' => 0, 'fk_bundled_product' => 1, 'fk_product' => 2, 'quantity' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductBundle' => 'ID_PRODUCT_BUNDLE',
        'SpyProductBundle.IdProductBundle' => 'ID_PRODUCT_BUNDLE',
        'idProductBundle' => 'ID_PRODUCT_BUNDLE',
        'spyProductBundle.idProductBundle' => 'ID_PRODUCT_BUNDLE',
        'SpyProductBundleTableMap::COL_ID_PRODUCT_BUNDLE' => 'ID_PRODUCT_BUNDLE',
        'COL_ID_PRODUCT_BUNDLE' => 'ID_PRODUCT_BUNDLE',
        'id_product_bundle' => 'ID_PRODUCT_BUNDLE',
        'spy_product_bundle.id_product_bundle' => 'ID_PRODUCT_BUNDLE',
        'FkBundledProduct' => 'FK_BUNDLED_PRODUCT',
        'SpyProductBundle.FkBundledProduct' => 'FK_BUNDLED_PRODUCT',
        'fkBundledProduct' => 'FK_BUNDLED_PRODUCT',
        'spyProductBundle.fkBundledProduct' => 'FK_BUNDLED_PRODUCT',
        'SpyProductBundleTableMap::COL_FK_BUNDLED_PRODUCT' => 'FK_BUNDLED_PRODUCT',
        'COL_FK_BUNDLED_PRODUCT' => 'FK_BUNDLED_PRODUCT',
        'fk_bundled_product' => 'FK_BUNDLED_PRODUCT',
        'spy_product_bundle.fk_bundled_product' => 'FK_BUNDLED_PRODUCT',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductBundle.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductBundle.fkProduct' => 'FK_PRODUCT',
        'SpyProductBundleTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_bundle.fk_product' => 'FK_PRODUCT',
        'Quantity' => 'QUANTITY',
        'SpyProductBundle.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'spyProductBundle.quantity' => 'QUANTITY',
        'SpyProductBundleTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'spy_product_bundle.quantity' => 'QUANTITY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductBundle.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductBundle.createdAt' => 'CREATED_AT',
        'SpyProductBundleTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_bundle.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductBundle.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductBundle.updatedAt' => 'UPDATED_AT',
        'SpyProductBundleTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_bundle.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_bundle');
        $this->setPhpName('SpyProductBundle');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductBundle\\Persistence\\SpyProductBundle');
        $this->setPackage('src.Orm.Zed.ProductBundle.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_bundle_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_bundle', 'IdProductBundle', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_bundled_product', 'FkBundledProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, 1);
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
        $this->addRelation('BundledProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_bundled_product',
    1 => ':id_product',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('SpyProductRelatedByFkProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
            'event' => ['spy_product_bundle_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductBundle', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductBundleTableMap::CLASS_DEFAULT : SpyProductBundleTableMap::OM_CLASS;
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
     * @return array (SpyProductBundle object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductBundleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductBundleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductBundleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductBundleTableMap::OM_CLASS;
            /** @var SpyProductBundle $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductBundleTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductBundleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductBundleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductBundle $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductBundleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductBundleTableMap::COL_ID_PRODUCT_BUNDLE);
            $criteria->addSelectColumn(SpyProductBundleTableMap::COL_FK_BUNDLED_PRODUCT);
            $criteria->addSelectColumn(SpyProductBundleTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductBundleTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(SpyProductBundleTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductBundleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_bundle');
            $criteria->addSelectColumn($alias . '.fk_bundled_product');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.quantity');
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
            $criteria->removeSelectColumn(SpyProductBundleTableMap::COL_ID_PRODUCT_BUNDLE);
            $criteria->removeSelectColumn(SpyProductBundleTableMap::COL_FK_BUNDLED_PRODUCT);
            $criteria->removeSelectColumn(SpyProductBundleTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductBundleTableMap::COL_QUANTITY);
            $criteria->removeSelectColumn(SpyProductBundleTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductBundleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_bundle');
            $criteria->removeSelectColumn($alias . '.fk_bundled_product');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.quantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductBundleTableMap::DATABASE_NAME)->getTable(SpyProductBundleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductBundle or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductBundle object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductBundleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductBundle\Persistence\SpyProductBundle) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductBundleTableMap::DATABASE_NAME);
            $criteria->add(SpyProductBundleTableMap::COL_ID_PRODUCT_BUNDLE, (array) $values, Criteria::IN);
        }

        $query = SpyProductBundleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductBundleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductBundleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_bundle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductBundleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductBundle or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductBundle object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductBundleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductBundle object
        }


        // Set the correct dbName
        $query = SpyProductBundleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
