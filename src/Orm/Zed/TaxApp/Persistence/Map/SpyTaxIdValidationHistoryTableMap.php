<?php

namespace Orm\Zed\TaxApp\Persistence\Map;

use Orm\Zed\TaxApp\Persistence\SpyTaxIdValidationHistory;
use Orm\Zed\TaxApp\Persistence\SpyTaxIdValidationHistoryQuery;
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
 * This class defines the structure of the 'spy_tax_id_validation_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyTaxIdValidationHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.TaxApp.Persistence.Map.SpyTaxIdValidationHistoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_tax_id_validation_history';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyTaxIdValidationHistory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\TaxApp\\Persistence\\SpyTaxIdValidationHistory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.TaxApp.Persistence.SpyTaxIdValidationHistory';

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
     * the column name for the id_tax_id_validation_history field
     */
    public const COL_ID_TAX_ID_VALIDATION_HISTORY = 'spy_tax_id_validation_history.id_tax_id_validation_history';

    /**
     * the column name for the tax_id field
     */
    public const COL_TAX_ID = 'spy_tax_id_validation_history.tax_id';

    /**
     * the column name for the is_valid field
     */
    public const COL_IS_VALID = 'spy_tax_id_validation_history.is_valid';

    /**
     * the column name for the country_code field
     */
    public const COL_COUNTRY_CODE = 'spy_tax_id_validation_history.country_code';

    /**
     * the column name for the response_data field
     */
    public const COL_RESPONSE_DATA = 'spy_tax_id_validation_history.response_data';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_tax_id_validation_history.created_at';

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
        self::TYPE_PHPNAME       => ['IdTaxIdValidationHistory', 'TaxId', 'IsValid', 'CountryCode', 'ResponseData', 'CreatedAt', ],
        self::TYPE_CAMELNAME     => ['idTaxIdValidationHistory', 'taxId', 'isValid', 'countryCode', 'responseData', 'createdAt', ],
        self::TYPE_COLNAME       => [SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, SpyTaxIdValidationHistoryTableMap::COL_TAX_ID, SpyTaxIdValidationHistoryTableMap::COL_IS_VALID, SpyTaxIdValidationHistoryTableMap::COL_COUNTRY_CODE, SpyTaxIdValidationHistoryTableMap::COL_RESPONSE_DATA, SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_tax_id_validation_history', 'tax_id', 'is_valid', 'country_code', 'response_data', 'created_at', ],
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
        self::TYPE_PHPNAME       => ['IdTaxIdValidationHistory' => 0, 'TaxId' => 1, 'IsValid' => 2, 'CountryCode' => 3, 'ResponseData' => 4, 'CreatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idTaxIdValidationHistory' => 0, 'taxId' => 1, 'isValid' => 2, 'countryCode' => 3, 'responseData' => 4, 'createdAt' => 5, ],
        self::TYPE_COLNAME       => [SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY => 0, SpyTaxIdValidationHistoryTableMap::COL_TAX_ID => 1, SpyTaxIdValidationHistoryTableMap::COL_IS_VALID => 2, SpyTaxIdValidationHistoryTableMap::COL_COUNTRY_CODE => 3, SpyTaxIdValidationHistoryTableMap::COL_RESPONSE_DATA => 4, SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_tax_id_validation_history' => 0, 'tax_id' => 1, 'is_valid' => 2, 'country_code' => 3, 'response_data' => 4, 'created_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdTaxIdValidationHistory' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'SpyTaxIdValidationHistory.IdTaxIdValidationHistory' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'idTaxIdValidationHistory' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'spyTaxIdValidationHistory.idTaxIdValidationHistory' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'COL_ID_TAX_ID_VALIDATION_HISTORY' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'id_tax_id_validation_history' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'spy_tax_id_validation_history.id_tax_id_validation_history' => 'ID_TAX_ID_VALIDATION_HISTORY',
        'TaxId' => 'TAX_ID',
        'SpyTaxIdValidationHistory.TaxId' => 'TAX_ID',
        'taxId' => 'TAX_ID',
        'spyTaxIdValidationHistory.taxId' => 'TAX_ID',
        'SpyTaxIdValidationHistoryTableMap::COL_TAX_ID' => 'TAX_ID',
        'COL_TAX_ID' => 'TAX_ID',
        'tax_id' => 'TAX_ID',
        'spy_tax_id_validation_history.tax_id' => 'TAX_ID',
        'IsValid' => 'IS_VALID',
        'SpyTaxIdValidationHistory.IsValid' => 'IS_VALID',
        'isValid' => 'IS_VALID',
        'spyTaxIdValidationHistory.isValid' => 'IS_VALID',
        'SpyTaxIdValidationHistoryTableMap::COL_IS_VALID' => 'IS_VALID',
        'COL_IS_VALID' => 'IS_VALID',
        'is_valid' => 'IS_VALID',
        'spy_tax_id_validation_history.is_valid' => 'IS_VALID',
        'CountryCode' => 'COUNTRY_CODE',
        'SpyTaxIdValidationHistory.CountryCode' => 'COUNTRY_CODE',
        'countryCode' => 'COUNTRY_CODE',
        'spyTaxIdValidationHistory.countryCode' => 'COUNTRY_CODE',
        'SpyTaxIdValidationHistoryTableMap::COL_COUNTRY_CODE' => 'COUNTRY_CODE',
        'COL_COUNTRY_CODE' => 'COUNTRY_CODE',
        'country_code' => 'COUNTRY_CODE',
        'spy_tax_id_validation_history.country_code' => 'COUNTRY_CODE',
        'ResponseData' => 'RESPONSE_DATA',
        'SpyTaxIdValidationHistory.ResponseData' => 'RESPONSE_DATA',
        'responseData' => 'RESPONSE_DATA',
        'spyTaxIdValidationHistory.responseData' => 'RESPONSE_DATA',
        'SpyTaxIdValidationHistoryTableMap::COL_RESPONSE_DATA' => 'RESPONSE_DATA',
        'COL_RESPONSE_DATA' => 'RESPONSE_DATA',
        'response_data' => 'RESPONSE_DATA',
        'spy_tax_id_validation_history.response_data' => 'RESPONSE_DATA',
        'CreatedAt' => 'CREATED_AT',
        'SpyTaxIdValidationHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyTaxIdValidationHistory.createdAt' => 'CREATED_AT',
        'SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_tax_id_validation_history.created_at' => 'CREATED_AT',
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
        $this->setName('spy_tax_id_validation_history');
        $this->setPhpName('SpyTaxIdValidationHistory');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\TaxApp\\Persistence\\SpyTaxIdValidationHistory');
        $this->setPackage('src.Orm.Zed.TaxApp.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_tax_id_validation_history_pk_seq');
        // columns
        $this->addPrimaryKey('id_tax_id_validation_history', 'IdTaxIdValidationHistory', 'INTEGER', true, null, null);
        $this->addColumn('tax_id', 'TaxId', 'VARCHAR', true, 255, null);
        $this->addColumn('is_valid', 'IsValid', 'BOOLEAN', true, 1, true);
        $this->addColumn('country_code', 'CountryCode', 'VARCHAR', false, 3, null);
        $this->addColumn('response_data', 'ResponseData', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'true', 'is_timestamp' => 'true'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdTaxIdValidationHistory', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyTaxIdValidationHistoryTableMap::CLASS_DEFAULT : SpyTaxIdValidationHistoryTableMap::OM_CLASS;
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
     * @return array (SpyTaxIdValidationHistory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyTaxIdValidationHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyTaxIdValidationHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyTaxIdValidationHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyTaxIdValidationHistoryTableMap::OM_CLASS;
            /** @var SpyTaxIdValidationHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyTaxIdValidationHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyTaxIdValidationHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyTaxIdValidationHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyTaxIdValidationHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyTaxIdValidationHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY);
            $criteria->addSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_TAX_ID);
            $criteria->addSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_IS_VALID);
            $criteria->addSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_COUNTRY_CODE);
            $criteria->addSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_RESPONSE_DATA);
            $criteria->addSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_tax_id_validation_history');
            $criteria->addSelectColumn($alias . '.tax_id');
            $criteria->addSelectColumn($alias . '.is_valid');
            $criteria->addSelectColumn($alias . '.country_code');
            $criteria->addSelectColumn($alias . '.response_data');
            $criteria->addSelectColumn($alias . '.created_at');
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
            $criteria->removeSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY);
            $criteria->removeSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_TAX_ID);
            $criteria->removeSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_IS_VALID);
            $criteria->removeSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_COUNTRY_CODE);
            $criteria->removeSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_RESPONSE_DATA);
            $criteria->removeSelectColumn(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_tax_id_validation_history');
            $criteria->removeSelectColumn($alias . '.tax_id');
            $criteria->removeSelectColumn($alias . '.is_valid');
            $criteria->removeSelectColumn($alias . '.country_code');
            $criteria->removeSelectColumn($alias . '.response_data');
            $criteria->removeSelectColumn($alias . '.created_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME)->getTable(SpyTaxIdValidationHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyTaxIdValidationHistory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyTaxIdValidationHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\TaxApp\Persistence\SpyTaxIdValidationHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME);
            $criteria->add(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, (array) $values, Criteria::IN);
        }

        $query = SpyTaxIdValidationHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyTaxIdValidationHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyTaxIdValidationHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_tax_id_validation_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyTaxIdValidationHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyTaxIdValidationHistory or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyTaxIdValidationHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyTaxIdValidationHistory object
        }

        if ($criteria->containsKey(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY) && $criteria->keyContainsValue(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY.')');
        }


        // Set the correct dbName
        $query = SpyTaxIdValidationHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
