<?php

namespace Orm\Zed\Company\Persistence\Map;

use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
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
 * This class defines the structure of the 'spy_company' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Company.Persistence.Map.SpyCompanyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompany';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Company\\Persistence\\SpyCompany';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Company.Persistence.SpyCompany';

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
     * the column name for the id_company field
     */
    public const COL_ID_COMPANY = 'spy_company.id_company';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_company.is_active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_company.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_company.name';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_company.status';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_company.uuid';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the status field */
    public const COL_STATUS_PENDING = 'pending';
    public const COL_STATUS_APPROVED = 'approved';
    public const COL_STATUS_DENIED = 'denied';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdCompany', 'IsActive', 'Key', 'Name', 'Status', 'Uuid', ],
        self::TYPE_CAMELNAME     => ['idCompany', 'isActive', 'key', 'name', 'status', 'uuid', ],
        self::TYPE_COLNAME       => [SpyCompanyTableMap::COL_ID_COMPANY, SpyCompanyTableMap::COL_IS_ACTIVE, SpyCompanyTableMap::COL_KEY, SpyCompanyTableMap::COL_NAME, SpyCompanyTableMap::COL_STATUS, SpyCompanyTableMap::COL_UUID, ],
        self::TYPE_FIELDNAME     => ['id_company', 'is_active', 'key', 'name', 'status', 'uuid', ],
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
        self::TYPE_PHPNAME       => ['IdCompany' => 0, 'IsActive' => 1, 'Key' => 2, 'Name' => 3, 'Status' => 4, 'Uuid' => 5, ],
        self::TYPE_CAMELNAME     => ['idCompany' => 0, 'isActive' => 1, 'key' => 2, 'name' => 3, 'status' => 4, 'uuid' => 5, ],
        self::TYPE_COLNAME       => [SpyCompanyTableMap::COL_ID_COMPANY => 0, SpyCompanyTableMap::COL_IS_ACTIVE => 1, SpyCompanyTableMap::COL_KEY => 2, SpyCompanyTableMap::COL_NAME => 3, SpyCompanyTableMap::COL_STATUS => 4, SpyCompanyTableMap::COL_UUID => 5, ],
        self::TYPE_FIELDNAME     => ['id_company' => 0, 'is_active' => 1, 'key' => 2, 'name' => 3, 'status' => 4, 'uuid' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompany' => 'ID_COMPANY',
        'SpyCompany.IdCompany' => 'ID_COMPANY',
        'idCompany' => 'ID_COMPANY',
        'spyCompany.idCompany' => 'ID_COMPANY',
        'SpyCompanyTableMap::COL_ID_COMPANY' => 'ID_COMPANY',
        'COL_ID_COMPANY' => 'ID_COMPANY',
        'id_company' => 'ID_COMPANY',
        'spy_company.id_company' => 'ID_COMPANY',
        'IsActive' => 'IS_ACTIVE',
        'SpyCompany.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyCompany.isActive' => 'IS_ACTIVE',
        'SpyCompanyTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_company.is_active' => 'IS_ACTIVE',
        'Key' => 'KEY',
        'SpyCompany.Key' => 'KEY',
        'key' => 'KEY',
        'spyCompany.key' => 'KEY',
        'SpyCompanyTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_company.key' => 'KEY',
        'Name' => 'NAME',
        'SpyCompany.Name' => 'NAME',
        'name' => 'NAME',
        'spyCompany.name' => 'NAME',
        'SpyCompanyTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_company.name' => 'NAME',
        'Status' => 'STATUS',
        'SpyCompany.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyCompany.status' => 'STATUS',
        'SpyCompanyTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_company.status' => 'STATUS',
        'Uuid' => 'UUID',
        'SpyCompany.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyCompany.uuid' => 'UUID',
        'SpyCompanyTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_company.uuid' => 'UUID',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyCompanyTableMap::COL_STATUS => [
                            self::COL_STATUS_PENDING,
            self::COL_STATUS_APPROVED,
            self::COL_STATUS_DENIED,
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
        $this->setName('spy_company');
        $this->setPhpName('SpyCompany');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Company\\Persistence\\SpyCompany');
        $this->setPackage('src.Orm.Zed.Company.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_company_pk_seq');
        // columns
        $this->addPrimaryKey('id_company', 'IdCompany', 'INTEGER', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'ENUM', true, 8, 'pending');
        $this->getColumn('status')->setValueSet(array (
  0 => 'pending',
  1 => 'approved',
  2 => 'denied',
));
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCompanyStore', '\\Orm\\Zed\\Company\\Persistence\\SpyCompanyStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, 'SpyCompanyStores', false);
        $this->addRelation('CompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, 'CompanyBusinessUnits', false);
        $this->addRelation('CompanyRole', '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRole', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, 'CompanyRoles', false);
        $this->addRelation('CompanyUnitAddress', '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, 'CompanyUnitAddresses', false);
        $this->addRelation('CompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, 'CompanyUsers', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_company'],
            'event' => ['spy_company_is_active' => ['column' => 'is_active'], 'spy_company_status' => ['column' => 'status']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCompany', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCompanyTableMap::CLASS_DEFAULT : SpyCompanyTableMap::OM_CLASS;
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
     * @return array (SpyCompany object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyTableMap::OM_CLASS;
            /** @var SpyCompany $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompany $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyTableMap::COL_ID_COMPANY);
            $criteria->addSelectColumn(SpyCompanyTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyCompanyTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCompanyTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCompanyTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyCompanyTableMap::COL_UUID);
        } else {
            $criteria->addSelectColumn($alias . '.id_company');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyCompanyTableMap::COL_ID_COMPANY);
            $criteria->removeSelectColumn(SpyCompanyTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyCompanyTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCompanyTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCompanyTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyCompanyTableMap::COL_UUID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyTableMap::DATABASE_NAME)->getTable(SpyCompanyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompany or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompany object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Company\Persistence\SpyCompany) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyTableMap::DATABASE_NAME);
            $criteria->add(SpyCompanyTableMap::COL_ID_COMPANY, (array) $values, Criteria::IN);
        }

        $query = SpyCompanyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompany or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompany object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompany object
        }

        if ($criteria->containsKey(SpyCompanyTableMap::COL_ID_COMPANY) && $criteria->keyContainsValue(SpyCompanyTableMap::COL_ID_COMPANY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCompanyTableMap::COL_ID_COMPANY.')');
        }


        // Set the correct dbName
        $query = SpyCompanyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
