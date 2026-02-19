<?php

namespace Orm\Zed\ProductPackagingUnit\Persistence\Map;

use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitTypeQuery;
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
 * This class defines the structure of the 'spy_product_packaging_unit_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductPackagingUnitTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductPackagingUnit.Persistence.Map.SpyProductPackagingUnitTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_packaging_unit_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductPackagingUnitType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnitType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductPackagingUnit.Persistence.SpyProductPackagingUnitType';

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
     * the column name for the id_product_packaging_unit_type field
     */
    public const COL_ID_PRODUCT_PACKAGING_UNIT_TYPE = 'spy_product_packaging_unit_type.id_product_packaging_unit_type';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_packaging_unit_type.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_packaging_unit_type.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_packaging_unit_type.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductPackagingUnitType', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductPackagingUnitType', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE, SpyProductPackagingUnitTypeTableMap::COL_NAME, SpyProductPackagingUnitTypeTableMap::COL_CREATED_AT, SpyProductPackagingUnitTypeTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_packaging_unit_type', 'name', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductPackagingUnitType' => 0, 'Name' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, ],
        self::TYPE_CAMELNAME     => ['idProductPackagingUnitType' => 0, 'name' => 1, 'createdAt' => 2, 'updatedAt' => 3, ],
        self::TYPE_COLNAME       => [SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE => 0, SpyProductPackagingUnitTypeTableMap::COL_NAME => 1, SpyProductPackagingUnitTypeTableMap::COL_CREATED_AT => 2, SpyProductPackagingUnitTypeTableMap::COL_UPDATED_AT => 3, ],
        self::TYPE_FIELDNAME     => ['id_product_packaging_unit_type' => 0, 'name' => 1, 'created_at' => 2, 'updated_at' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductPackagingUnitType' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'SpyProductPackagingUnitType.IdProductPackagingUnitType' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'idProductPackagingUnitType' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'spyProductPackagingUnitType.idProductPackagingUnitType' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'COL_ID_PRODUCT_PACKAGING_UNIT_TYPE' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'id_product_packaging_unit_type' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'spy_product_packaging_unit_type.id_product_packaging_unit_type' => 'ID_PRODUCT_PACKAGING_UNIT_TYPE',
        'Name' => 'NAME',
        'SpyProductPackagingUnitType.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductPackagingUnitType.name' => 'NAME',
        'SpyProductPackagingUnitTypeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_packaging_unit_type.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductPackagingUnitType.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductPackagingUnitType.createdAt' => 'CREATED_AT',
        'SpyProductPackagingUnitTypeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_packaging_unit_type.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductPackagingUnitType.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductPackagingUnitType.updatedAt' => 'UPDATED_AT',
        'SpyProductPackagingUnitTypeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_packaging_unit_type.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_packaging_unit_type');
        $this->setPhpName('SpyProductPackagingUnitType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnitType');
        $this->setPackage('src.Orm.Zed.ProductPackagingUnit.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_packaging_unit_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_packaging_unit_type', 'IdProductPackagingUnitType', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyProductPackagingUnit', '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_packaging_unit_type',
    1 => ':id_product_packaging_unit_type',
  ),
), null, null, 'SpyProductPackagingUnits', false);
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
            'event' => ['spy_product_packaging_unit_type_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductPackagingUnitType', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductPackagingUnitTypeTableMap::CLASS_DEFAULT : SpyProductPackagingUnitTypeTableMap::OM_CLASS;
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
     * @return array (SpyProductPackagingUnitType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductPackagingUnitTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductPackagingUnitTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductPackagingUnitTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductPackagingUnitTypeTableMap::OM_CLASS;
            /** @var SpyProductPackagingUnitType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductPackagingUnitTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductPackagingUnitTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductPackagingUnitTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductPackagingUnitType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductPackagingUnitTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE);
            $criteria->addSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_packaging_unit_type');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTypeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_packaging_unit_type');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductPackagingUnitTypeTableMap::DATABASE_NAME)->getTable(SpyProductPackagingUnitTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductPackagingUnitType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductPackagingUnitType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductPackagingUnitTypeTableMap::DATABASE_NAME);
            $criteria->add(SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpyProductPackagingUnitTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductPackagingUnitTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductPackagingUnitTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_packaging_unit_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductPackagingUnitTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductPackagingUnitType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductPackagingUnitType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductPackagingUnitType object
        }

        if ($criteria->containsKey(SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE) && $criteria->keyContainsValue(SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductPackagingUnitTypeTableMap::COL_ID_PRODUCT_PACKAGING_UNIT_TYPE.')');
        }


        // Set the correct dbName
        $query = SpyProductPackagingUnitTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
