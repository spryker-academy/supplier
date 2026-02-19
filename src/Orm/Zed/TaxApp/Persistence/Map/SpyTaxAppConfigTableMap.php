<?php

namespace Orm\Zed\TaxApp\Persistence\Map;

use Orm\Zed\TaxApp\Persistence\SpyTaxAppConfig;
use Orm\Zed\TaxApp\Persistence\SpyTaxAppConfigQuery;
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
 * This class defines the structure of the 'spy_tax_app_config' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyTaxAppConfigTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.TaxApp.Persistence.Map.SpyTaxAppConfigTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_tax_app_config';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyTaxAppConfig';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\TaxApp\\Persistence\\SpyTaxAppConfig';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.TaxApp.Persistence.SpyTaxAppConfig';

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
     * the column name for the id_tax_app_config field
     */
    public const COL_ID_TAX_APP_CONFIG = 'spy_tax_app_config.id_tax_app_config';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_tax_app_config.fk_store';

    /**
     * the column name for the application_id field
     */
    public const COL_APPLICATION_ID = 'spy_tax_app_config.application_id';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_tax_app_config.is_active';

    /**
     * the column name for the vendor_code field
     */
    public const COL_VENDOR_CODE = 'spy_tax_app_config.vendor_code';

    /**
     * the column name for the api_urls field
     */
    public const COL_API_URLS = 'spy_tax_app_config.api_urls';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_tax_app_config.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_tax_app_config.updated_at';

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
        self::TYPE_PHPNAME       => ['IdTaxAppConfig', 'FkStore', 'ApplicationId', 'IsActive', 'VendorCode', 'ApiUrls', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idTaxAppConfig', 'fkStore', 'applicationId', 'isActive', 'vendorCode', 'apiUrls', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG, SpyTaxAppConfigTableMap::COL_FK_STORE, SpyTaxAppConfigTableMap::COL_APPLICATION_ID, SpyTaxAppConfigTableMap::COL_IS_ACTIVE, SpyTaxAppConfigTableMap::COL_VENDOR_CODE, SpyTaxAppConfigTableMap::COL_API_URLS, SpyTaxAppConfigTableMap::COL_CREATED_AT, SpyTaxAppConfigTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_tax_app_config', 'fk_store', 'application_id', 'is_active', 'vendor_code', 'api_urls', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdTaxAppConfig' => 0, 'FkStore' => 1, 'ApplicationId' => 2, 'IsActive' => 3, 'VendorCode' => 4, 'ApiUrls' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idTaxAppConfig' => 0, 'fkStore' => 1, 'applicationId' => 2, 'isActive' => 3, 'vendorCode' => 4, 'apiUrls' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG => 0, SpyTaxAppConfigTableMap::COL_FK_STORE => 1, SpyTaxAppConfigTableMap::COL_APPLICATION_ID => 2, SpyTaxAppConfigTableMap::COL_IS_ACTIVE => 3, SpyTaxAppConfigTableMap::COL_VENDOR_CODE => 4, SpyTaxAppConfigTableMap::COL_API_URLS => 5, SpyTaxAppConfigTableMap::COL_CREATED_AT => 6, SpyTaxAppConfigTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_tax_app_config' => 0, 'fk_store' => 1, 'application_id' => 2, 'is_active' => 3, 'vendor_code' => 4, 'api_urls' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdTaxAppConfig' => 'ID_TAX_APP_CONFIG',
        'SpyTaxAppConfig.IdTaxAppConfig' => 'ID_TAX_APP_CONFIG',
        'idTaxAppConfig' => 'ID_TAX_APP_CONFIG',
        'spyTaxAppConfig.idTaxAppConfig' => 'ID_TAX_APP_CONFIG',
        'SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG' => 'ID_TAX_APP_CONFIG',
        'COL_ID_TAX_APP_CONFIG' => 'ID_TAX_APP_CONFIG',
        'id_tax_app_config' => 'ID_TAX_APP_CONFIG',
        'spy_tax_app_config.id_tax_app_config' => 'ID_TAX_APP_CONFIG',
        'FkStore' => 'FK_STORE',
        'SpyTaxAppConfig.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyTaxAppConfig.fkStore' => 'FK_STORE',
        'SpyTaxAppConfigTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_tax_app_config.fk_store' => 'FK_STORE',
        'ApplicationId' => 'APPLICATION_ID',
        'SpyTaxAppConfig.ApplicationId' => 'APPLICATION_ID',
        'applicationId' => 'APPLICATION_ID',
        'spyTaxAppConfig.applicationId' => 'APPLICATION_ID',
        'SpyTaxAppConfigTableMap::COL_APPLICATION_ID' => 'APPLICATION_ID',
        'COL_APPLICATION_ID' => 'APPLICATION_ID',
        'application_id' => 'APPLICATION_ID',
        'spy_tax_app_config.application_id' => 'APPLICATION_ID',
        'IsActive' => 'IS_ACTIVE',
        'SpyTaxAppConfig.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyTaxAppConfig.isActive' => 'IS_ACTIVE',
        'SpyTaxAppConfigTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_tax_app_config.is_active' => 'IS_ACTIVE',
        'VendorCode' => 'VENDOR_CODE',
        'SpyTaxAppConfig.VendorCode' => 'VENDOR_CODE',
        'vendorCode' => 'VENDOR_CODE',
        'spyTaxAppConfig.vendorCode' => 'VENDOR_CODE',
        'SpyTaxAppConfigTableMap::COL_VENDOR_CODE' => 'VENDOR_CODE',
        'COL_VENDOR_CODE' => 'VENDOR_CODE',
        'vendor_code' => 'VENDOR_CODE',
        'spy_tax_app_config.vendor_code' => 'VENDOR_CODE',
        'ApiUrls' => 'API_URLS',
        'SpyTaxAppConfig.ApiUrls' => 'API_URLS',
        'apiUrls' => 'API_URLS',
        'spyTaxAppConfig.apiUrls' => 'API_URLS',
        'SpyTaxAppConfigTableMap::COL_API_URLS' => 'API_URLS',
        'COL_API_URLS' => 'API_URLS',
        'api_urls' => 'API_URLS',
        'spy_tax_app_config.api_urls' => 'API_URLS',
        'CreatedAt' => 'CREATED_AT',
        'SpyTaxAppConfig.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyTaxAppConfig.createdAt' => 'CREATED_AT',
        'SpyTaxAppConfigTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_tax_app_config.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyTaxAppConfig.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyTaxAppConfig.updatedAt' => 'UPDATED_AT',
        'SpyTaxAppConfigTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_tax_app_config.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_tax_app_config');
        $this->setPhpName('SpyTaxAppConfig');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\TaxApp\\Persistence\\SpyTaxAppConfig');
        $this->setPackage('src.Orm.Zed.TaxApp.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_tax_app_config_pk_seq');
        // columns
        $this->addPrimaryKey('id_tax_app_config', 'IdTaxAppConfig', 'INTEGER', true, null, null);
        $this->addColumn('fk_store', 'FkStore', 'INTEGER', false, null, null);
        $this->addColumn('application_id', 'ApplicationId', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, true);
        $this->addColumn('vendor_code', 'VendorCode', 'VARCHAR', true, 255, null);
        $this->addColumn('api_urls', 'ApiUrls', 'LONGVARCHAR', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdTaxAppConfig', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyTaxAppConfigTableMap::CLASS_DEFAULT : SpyTaxAppConfigTableMap::OM_CLASS;
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
     * @return array (SpyTaxAppConfig object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyTaxAppConfigTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyTaxAppConfigTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyTaxAppConfigTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyTaxAppConfigTableMap::OM_CLASS;
            /** @var SpyTaxAppConfig $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyTaxAppConfigTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyTaxAppConfigTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyTaxAppConfigTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyTaxAppConfig $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyTaxAppConfigTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_APPLICATION_ID);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_VENDOR_CODE);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_API_URLS);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyTaxAppConfigTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_tax_app_config');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.application_id');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.vendor_code');
            $criteria->addSelectColumn($alias . '.api_urls');
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
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_APPLICATION_ID);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_VENDOR_CODE);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_API_URLS);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyTaxAppConfigTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_tax_app_config');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.application_id');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.vendor_code');
            $criteria->removeSelectColumn($alias . '.api_urls');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyTaxAppConfigTableMap::DATABASE_NAME)->getTable(SpyTaxAppConfigTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyTaxAppConfig or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyTaxAppConfig object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxAppConfigTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\TaxApp\Persistence\SpyTaxAppConfig) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyTaxAppConfigTableMap::DATABASE_NAME);
            $criteria->add(SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG, (array) $values, Criteria::IN);
        }

        $query = SpyTaxAppConfigQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyTaxAppConfigTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyTaxAppConfigTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_tax_app_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyTaxAppConfigQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyTaxAppConfig or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyTaxAppConfig object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxAppConfigTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyTaxAppConfig object
        }

        if ($criteria->containsKey(SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG) && $criteria->keyContainsValue(SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyTaxAppConfigTableMap::COL_ID_TAX_APP_CONFIG.')');
        }


        // Set the correct dbName
        $query = SpyTaxAppConfigQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
