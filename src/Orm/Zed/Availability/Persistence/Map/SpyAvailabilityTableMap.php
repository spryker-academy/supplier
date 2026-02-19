<?php

namespace Orm\Zed\Availability\Persistence\Map;

use Orm\Zed\Availability\Persistence\SpyAvailability;
use Orm\Zed\Availability\Persistence\SpyAvailabilityQuery;
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
 * This class defines the structure of the 'spy_availability' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAvailabilityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Availability.Persistence.Map.SpyAvailabilityTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_availability';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAvailability';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Availability\\Persistence\\SpyAvailability';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Availability.Persistence.SpyAvailability';

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
     * the column name for the id_availability field
     */
    public const COL_ID_AVAILABILITY = 'spy_availability.id_availability';

    /**
     * the column name for the fk_availability_abstract field
     */
    public const COL_FK_AVAILABILITY_ABSTRACT = 'spy_availability.fk_availability_abstract';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_availability.fk_store';

    /**
     * the column name for the is_never_out_of_stock field
     */
    public const COL_IS_NEVER_OUT_OF_STOCK = 'spy_availability.is_never_out_of_stock';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'spy_availability.quantity';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_availability.sku';

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
        self::TYPE_PHPNAME       => ['IdAvailability', 'FkAvailabilityAbstract', 'FkStore', 'IsNeverOutOfStock', 'Quantity', 'Sku', ],
        self::TYPE_CAMELNAME     => ['idAvailability', 'fkAvailabilityAbstract', 'fkStore', 'isNeverOutOfStock', 'quantity', 'sku', ],
        self::TYPE_COLNAME       => [SpyAvailabilityTableMap::COL_ID_AVAILABILITY, SpyAvailabilityTableMap::COL_FK_AVAILABILITY_ABSTRACT, SpyAvailabilityTableMap::COL_FK_STORE, SpyAvailabilityTableMap::COL_IS_NEVER_OUT_OF_STOCK, SpyAvailabilityTableMap::COL_QUANTITY, SpyAvailabilityTableMap::COL_SKU, ],
        self::TYPE_FIELDNAME     => ['id_availability', 'fk_availability_abstract', 'fk_store', 'is_never_out_of_stock', 'quantity', 'sku', ],
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
        self::TYPE_PHPNAME       => ['IdAvailability' => 0, 'FkAvailabilityAbstract' => 1, 'FkStore' => 2, 'IsNeverOutOfStock' => 3, 'Quantity' => 4, 'Sku' => 5, ],
        self::TYPE_CAMELNAME     => ['idAvailability' => 0, 'fkAvailabilityAbstract' => 1, 'fkStore' => 2, 'isNeverOutOfStock' => 3, 'quantity' => 4, 'sku' => 5, ],
        self::TYPE_COLNAME       => [SpyAvailabilityTableMap::COL_ID_AVAILABILITY => 0, SpyAvailabilityTableMap::COL_FK_AVAILABILITY_ABSTRACT => 1, SpyAvailabilityTableMap::COL_FK_STORE => 2, SpyAvailabilityTableMap::COL_IS_NEVER_OUT_OF_STOCK => 3, SpyAvailabilityTableMap::COL_QUANTITY => 4, SpyAvailabilityTableMap::COL_SKU => 5, ],
        self::TYPE_FIELDNAME     => ['id_availability' => 0, 'fk_availability_abstract' => 1, 'fk_store' => 2, 'is_never_out_of_stock' => 3, 'quantity' => 4, 'sku' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAvailability' => 'ID_AVAILABILITY',
        'SpyAvailability.IdAvailability' => 'ID_AVAILABILITY',
        'idAvailability' => 'ID_AVAILABILITY',
        'spyAvailability.idAvailability' => 'ID_AVAILABILITY',
        'SpyAvailabilityTableMap::COL_ID_AVAILABILITY' => 'ID_AVAILABILITY',
        'COL_ID_AVAILABILITY' => 'ID_AVAILABILITY',
        'id_availability' => 'ID_AVAILABILITY',
        'spy_availability.id_availability' => 'ID_AVAILABILITY',
        'FkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'SpyAvailability.FkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'fkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'spyAvailability.fkAvailabilityAbstract' => 'FK_AVAILABILITY_ABSTRACT',
        'SpyAvailabilityTableMap::COL_FK_AVAILABILITY_ABSTRACT' => 'FK_AVAILABILITY_ABSTRACT',
        'COL_FK_AVAILABILITY_ABSTRACT' => 'FK_AVAILABILITY_ABSTRACT',
        'fk_availability_abstract' => 'FK_AVAILABILITY_ABSTRACT',
        'spy_availability.fk_availability_abstract' => 'FK_AVAILABILITY_ABSTRACT',
        'FkStore' => 'FK_STORE',
        'SpyAvailability.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyAvailability.fkStore' => 'FK_STORE',
        'SpyAvailabilityTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_availability.fk_store' => 'FK_STORE',
        'IsNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'SpyAvailability.IsNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'isNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'spyAvailability.isNeverOutOfStock' => 'IS_NEVER_OUT_OF_STOCK',
        'SpyAvailabilityTableMap::COL_IS_NEVER_OUT_OF_STOCK' => 'IS_NEVER_OUT_OF_STOCK',
        'COL_IS_NEVER_OUT_OF_STOCK' => 'IS_NEVER_OUT_OF_STOCK',
        'is_never_out_of_stock' => 'IS_NEVER_OUT_OF_STOCK',
        'spy_availability.is_never_out_of_stock' => 'IS_NEVER_OUT_OF_STOCK',
        'Quantity' => 'QUANTITY',
        'SpyAvailability.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'spyAvailability.quantity' => 'QUANTITY',
        'SpyAvailabilityTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'spy_availability.quantity' => 'QUANTITY',
        'Sku' => 'SKU',
        'SpyAvailability.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyAvailability.sku' => 'SKU',
        'SpyAvailabilityTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_availability.sku' => 'SKU',
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
        $this->setName('spy_availability');
        $this->setPhpName('SpyAvailability');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Availability\\Persistence\\SpyAvailability');
        $this->setPackage('src.Orm.Zed.Availability.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_availability_pk_seq');
        // columns
        $this->addPrimaryKey('id_availability', 'IdAvailability', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_availability_abstract', 'FkAvailabilityAbstract', 'INTEGER', 'spy_availability_abstract', 'id_availability_abstract', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('is_never_out_of_stock', 'IsNeverOutOfStock', 'BOOLEAN', false, 1, false);
        $this->addColumn('quantity', 'Quantity', 'DECIMAL', true, 20, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyAvailabilityAbstract', '\\Orm\\Zed\\Availability\\Persistence\\SpyAvailabilityAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_availability_abstract',
    1 => ':id_availability_abstract',
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
            'event' => ['spy_availability_is_never_out_of_stock' => ['column' => 'is_never_out_of_stock'], 'spy_availability_quantity' => ['column' => 'quantity'], 'spy_availability_sku' => ['column' => 'sku', 'keep-additional' => 'true']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAvailability', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAvailabilityTableMap::CLASS_DEFAULT : SpyAvailabilityTableMap::OM_CLASS;
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
     * @return array (SpyAvailability object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAvailabilityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAvailabilityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAvailabilityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAvailabilityTableMap::OM_CLASS;
            /** @var SpyAvailability $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAvailabilityTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAvailabilityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAvailabilityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAvailability $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAvailabilityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAvailabilityTableMap::COL_ID_AVAILABILITY);
            $criteria->addSelectColumn(SpyAvailabilityTableMap::COL_FK_AVAILABILITY_ABSTRACT);
            $criteria->addSelectColumn(SpyAvailabilityTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyAvailabilityTableMap::COL_IS_NEVER_OUT_OF_STOCK);
            $criteria->addSelectColumn(SpyAvailabilityTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(SpyAvailabilityTableMap::COL_SKU);
        } else {
            $criteria->addSelectColumn($alias . '.id_availability');
            $criteria->addSelectColumn($alias . '.fk_availability_abstract');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.is_never_out_of_stock');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.sku');
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
            $criteria->removeSelectColumn(SpyAvailabilityTableMap::COL_ID_AVAILABILITY);
            $criteria->removeSelectColumn(SpyAvailabilityTableMap::COL_FK_AVAILABILITY_ABSTRACT);
            $criteria->removeSelectColumn(SpyAvailabilityTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyAvailabilityTableMap::COL_IS_NEVER_OUT_OF_STOCK);
            $criteria->removeSelectColumn(SpyAvailabilityTableMap::COL_QUANTITY);
            $criteria->removeSelectColumn(SpyAvailabilityTableMap::COL_SKU);
        } else {
            $criteria->removeSelectColumn($alias . '.id_availability');
            $criteria->removeSelectColumn($alias . '.fk_availability_abstract');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.is_never_out_of_stock');
            $criteria->removeSelectColumn($alias . '.quantity');
            $criteria->removeSelectColumn($alias . '.sku');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAvailabilityTableMap::DATABASE_NAME)->getTable(SpyAvailabilityTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAvailability or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAvailability object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAvailabilityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Availability\Persistence\SpyAvailability) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAvailabilityTableMap::DATABASE_NAME);
            $criteria->add(SpyAvailabilityTableMap::COL_ID_AVAILABILITY, (array) $values, Criteria::IN);
        }

        $query = SpyAvailabilityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAvailabilityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAvailabilityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_availability table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAvailabilityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAvailability or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAvailability object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAvailabilityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAvailability object
        }

        if ($criteria->containsKey(SpyAvailabilityTableMap::COL_ID_AVAILABILITY) && $criteria->keyContainsValue(SpyAvailabilityTableMap::COL_ID_AVAILABILITY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAvailabilityTableMap::COL_ID_AVAILABILITY.')');
        }


        // Set the correct dbName
        $query = SpyAvailabilityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
