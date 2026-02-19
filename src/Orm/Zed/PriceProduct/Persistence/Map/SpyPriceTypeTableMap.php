<?php

namespace Orm\Zed\PriceProduct\Persistence\Map;

use Orm\Zed\PriceProduct\Persistence\SpyPriceType;
use Orm\Zed\PriceProduct\Persistence\SpyPriceTypeQuery;
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
 * This class defines the structure of the 'spy_price_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProduct.Persistence.Map.SpyPriceTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProduct.Persistence.SpyPriceType';

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
     * the column name for the id_price_type field
     */
    public const COL_ID_PRICE_TYPE = 'spy_price_type.id_price_type';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_price_type.name';

    /**
     * the column name for the price_mode_configuration field
     */
    public const COL_PRICE_MODE_CONFIGURATION = 'spy_price_type.price_mode_configuration';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the price_mode_configuration field */
    public const COL_PRICE_MODE_CONFIGURATION_NET_MODE = 'NET_MODE';
    public const COL_PRICE_MODE_CONFIGURATION_GROSS_MODE = 'GROSS_MODE';
    public const COL_PRICE_MODE_CONFIGURATION_BOTH = 'BOTH';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdPriceType', 'Name', 'PriceModeConfiguration', ],
        self::TYPE_CAMELNAME     => ['idPriceType', 'name', 'priceModeConfiguration', ],
        self::TYPE_COLNAME       => [SpyPriceTypeTableMap::COL_ID_PRICE_TYPE, SpyPriceTypeTableMap::COL_NAME, SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION, ],
        self::TYPE_FIELDNAME     => ['id_price_type', 'name', 'price_mode_configuration', ],
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
        self::TYPE_PHPNAME       => ['IdPriceType' => 0, 'Name' => 1, 'PriceModeConfiguration' => 2, ],
        self::TYPE_CAMELNAME     => ['idPriceType' => 0, 'name' => 1, 'priceModeConfiguration' => 2, ],
        self::TYPE_COLNAME       => [SpyPriceTypeTableMap::COL_ID_PRICE_TYPE => 0, SpyPriceTypeTableMap::COL_NAME => 1, SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION => 2, ],
        self::TYPE_FIELDNAME     => ['id_price_type' => 0, 'name' => 1, 'price_mode_configuration' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceType' => 'ID_PRICE_TYPE',
        'SpyPriceType.IdPriceType' => 'ID_PRICE_TYPE',
        'idPriceType' => 'ID_PRICE_TYPE',
        'spyPriceType.idPriceType' => 'ID_PRICE_TYPE',
        'SpyPriceTypeTableMap::COL_ID_PRICE_TYPE' => 'ID_PRICE_TYPE',
        'COL_ID_PRICE_TYPE' => 'ID_PRICE_TYPE',
        'id_price_type' => 'ID_PRICE_TYPE',
        'spy_price_type.id_price_type' => 'ID_PRICE_TYPE',
        'Name' => 'NAME',
        'SpyPriceType.Name' => 'NAME',
        'name' => 'NAME',
        'spyPriceType.name' => 'NAME',
        'SpyPriceTypeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_price_type.name' => 'NAME',
        'PriceModeConfiguration' => 'PRICE_MODE_CONFIGURATION',
        'SpyPriceType.PriceModeConfiguration' => 'PRICE_MODE_CONFIGURATION',
        'priceModeConfiguration' => 'PRICE_MODE_CONFIGURATION',
        'spyPriceType.priceModeConfiguration' => 'PRICE_MODE_CONFIGURATION',
        'SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION' => 'PRICE_MODE_CONFIGURATION',
        'COL_PRICE_MODE_CONFIGURATION' => 'PRICE_MODE_CONFIGURATION',
        'price_mode_configuration' => 'PRICE_MODE_CONFIGURATION',
        'spy_price_type.price_mode_configuration' => 'PRICE_MODE_CONFIGURATION',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION => [
                            self::COL_PRICE_MODE_CONFIGURATION_NET_MODE,
            self::COL_PRICE_MODE_CONFIGURATION_GROSS_MODE,
            self::COL_PRICE_MODE_CONFIGURATION_BOTH,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('spy_price_type');
        $this->setPhpName('SpyPriceType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceType');
        $this->setPackage('src.Orm.Zed.PriceProduct.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_type', 'IdPriceType', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('price_mode_configuration', 'PriceModeConfiguration', 'ENUM', false, null, null);
        $this->getColumn('price_mode_configuration')->setValueSet(array (
  0 => 'NET_MODE',
  1 => 'GROSS_MODE',
  2 => 'BOTH',
));
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PriceProduct', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_type',
    1 => ':id_price_type',
  ),
), null, null, 'PriceProducts', false);
        $this->addRelation('PriceProductSchedule', '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_type',
    1 => ':id_price_type',
  ),
), null, null, 'PriceProductSchedules', false);
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
            'event' => ['spy_price_type_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceType', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceTypeTableMap::CLASS_DEFAULT : SpyPriceTypeTableMap::OM_CLASS;
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
     * @return array (SpyPriceType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceTypeTableMap::OM_CLASS;
            /** @var SpyPriceType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceTypeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceTypeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceTypeTableMap::COL_ID_PRICE_TYPE);
            $criteria->addSelectColumn(SpyPriceTypeTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_type');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.price_mode_configuration');
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
            $criteria->removeSelectColumn(SpyPriceTypeTableMap::COL_ID_PRICE_TYPE);
            $criteria->removeSelectColumn(SpyPriceTypeTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_type');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.price_mode_configuration');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceTypeTableMap::DATABASE_NAME)->getTable(SpyPriceTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceType object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProduct\Persistence\SpyPriceType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceTypeTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceTypeTableMap::COL_ID_PRICE_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpyPriceTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceType object
        }

        if ($criteria->containsKey(SpyPriceTypeTableMap::COL_ID_PRICE_TYPE) && $criteria->keyContainsValue(SpyPriceTypeTableMap::COL_ID_PRICE_TYPE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceTypeTableMap::COL_ID_PRICE_TYPE.')');
        }


        // Set the correct dbName
        $query = SpyPriceTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
