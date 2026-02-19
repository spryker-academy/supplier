<?php

namespace Orm\Zed\ProductMeasurementUnit\Persistence\Map;

use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery;
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
 * This class defines the structure of the 'spy_product_measurement_base_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductMeasurementBaseUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductMeasurementUnit.Persistence.Map.SpyProductMeasurementBaseUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_measurement_base_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductMeasurementBaseUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementBaseUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductMeasurementUnit.Persistence.SpyProductMeasurementBaseUnit';

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
     * the column name for the id_product_measurement_base_unit field
     */
    public const COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT = 'spy_product_measurement_base_unit.id_product_measurement_base_unit';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product_measurement_base_unit.fk_product_abstract';

    /**
     * the column name for the fk_product_measurement_unit field
     */
    public const COL_FK_PRODUCT_MEASUREMENT_UNIT = 'spy_product_measurement_base_unit.fk_product_measurement_unit';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_measurement_base_unit.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_measurement_base_unit.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductMeasurementBaseUnit', 'FkProductAbstract', 'FkProductMeasurementUnit', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductMeasurementBaseUnit', 'fkProductAbstract', 'fkProductMeasurementUnit', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT, SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_measurement_base_unit', 'fk_product_abstract', 'fk_product_measurement_unit', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductMeasurementBaseUnit' => 0, 'FkProductAbstract' => 1, 'FkProductMeasurementUnit' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idProductMeasurementBaseUnit' => 0, 'fkProductAbstract' => 1, 'fkProductMeasurementUnit' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT => 0, SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT => 1, SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT => 2, SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT => 3, SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_product_measurement_base_unit' => 0, 'fk_product_abstract' => 1, 'fk_product_measurement_unit' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductMeasurementBaseUnit' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'SpyProductMeasurementBaseUnit.IdProductMeasurementBaseUnit' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'idProductMeasurementBaseUnit' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'spyProductMeasurementBaseUnit.idProductMeasurementBaseUnit' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'id_product_measurement_base_unit' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'spy_product_measurement_base_unit.id_product_measurement_base_unit' => 'ID_PRODUCT_MEASUREMENT_BASE_UNIT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductMeasurementBaseUnit.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProductMeasurementBaseUnit.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product_measurement_base_unit.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'SpyProductMeasurementBaseUnit.FkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'fkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'spyProductMeasurementBaseUnit.fkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'COL_FK_PRODUCT_MEASUREMENT_UNIT' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'fk_product_measurement_unit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'spy_product_measurement_base_unit.fk_product_measurement_unit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductMeasurementBaseUnit.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductMeasurementBaseUnit.createdAt' => 'CREATED_AT',
        'SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_measurement_base_unit.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductMeasurementBaseUnit.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductMeasurementBaseUnit.updatedAt' => 'UPDATED_AT',
        'SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_measurement_base_unit.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_measurement_base_unit');
        $this->setPhpName('SpyProductMeasurementBaseUnit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementBaseUnit');
        $this->setPackage('src.Orm.Zed.ProductMeasurementUnit.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_measurement_base_unit_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_measurement_base_unit', 'IdProductMeasurementBaseUnit', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
        $this->addForeignKey('fk_product_measurement_unit', 'FkProductMeasurementUnit', 'INTEGER', 'spy_product_measurement_unit', 'id_product_measurement_unit', true, null, null);
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
        $this->addRelation('ProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, null, false);
        $this->addRelation('ProductMeasurementUnit', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_measurement_unit',
    1 => ':id_product_measurement_unit',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductMeasurementSalesUnit', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_measurement_base_unit',
    1 => ':id_product_measurement_base_unit',
  ),
), null, null, 'SpyProductMeasurementSalesUnits', false);
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
            'event' => ['spy_product_measurement_base_unit_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductMeasurementBaseUnit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductMeasurementBaseUnitTableMap::CLASS_DEFAULT : SpyProductMeasurementBaseUnitTableMap::OM_CLASS;
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
     * @return array (SpyProductMeasurementBaseUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductMeasurementBaseUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductMeasurementBaseUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductMeasurementBaseUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductMeasurementBaseUnitTableMap::OM_CLASS;
            /** @var SpyProductMeasurementBaseUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductMeasurementBaseUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductMeasurementBaseUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductMeasurementBaseUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductMeasurementBaseUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductMeasurementBaseUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT);
            $criteria->addSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT);
            $criteria->addSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_measurement_base_unit');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_product_measurement_unit');
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
            $criteria->removeSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT);
            $criteria->removeSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT);
            $criteria->removeSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductMeasurementBaseUnitTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_measurement_base_unit');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_product_measurement_unit');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME)->getTable(SpyProductMeasurementBaseUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductMeasurementBaseUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductMeasurementBaseUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME);
            $criteria->add(SpyProductMeasurementBaseUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_BASE_UNIT, (array) $values, Criteria::IN);
        }

        $query = SpyProductMeasurementBaseUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductMeasurementBaseUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductMeasurementBaseUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_measurement_base_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductMeasurementBaseUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductMeasurementBaseUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductMeasurementBaseUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementBaseUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductMeasurementBaseUnit object
        }


        // Set the correct dbName
        $query = SpyProductMeasurementBaseUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
