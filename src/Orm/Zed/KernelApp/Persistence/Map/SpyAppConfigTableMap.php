<?php

namespace Orm\Zed\KernelApp\Persistence\Map;

use Orm\Zed\KernelApp\Persistence\SpyAppConfig;
use Orm\Zed\KernelApp\Persistence\SpyAppConfigQuery;
use Orm\Zed\MerchantApp\Persistence\Map\SpyMerchantAppOnboardingTableMap;
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
 * This class defines the structure of the 'spy_app_config' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAppConfigTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.KernelApp.Persistence.Map.SpyAppConfigTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_app_config';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAppConfig';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\KernelApp\\Persistence\\SpyAppConfig';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.KernelApp.Persistence.SpyAppConfig';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_app_config field
     */
    public const COL_ID_APP_CONFIG = 'spy_app_config.id_app_config';

    /**
     * the column name for the app_identifier field
     */
    public const COL_APP_IDENTIFIER = 'spy_app_config.app_identifier';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_app_config.status';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_app_config.is_active';

    /**
     * the column name for the config field
     */
    public const COL_CONFIG = 'spy_app_config.config';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_app_config.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_app_config.updated_at';

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
        self::TYPE_PHPNAME       => ['IdAppConfig', 'AppIdentifier', 'Status', 'IsActive', 'Config', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idAppConfig', 'appIdentifier', 'status', 'isActive', 'config', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyAppConfigTableMap::COL_ID_APP_CONFIG, SpyAppConfigTableMap::COL_APP_IDENTIFIER, SpyAppConfigTableMap::COL_STATUS, SpyAppConfigTableMap::COL_IS_ACTIVE, SpyAppConfigTableMap::COL_CONFIG, SpyAppConfigTableMap::COL_CREATED_AT, SpyAppConfigTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_app_config', 'app_identifier', 'status', 'is_active', 'config', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdAppConfig' => 0, 'AppIdentifier' => 1, 'Status' => 2, 'IsActive' => 3, 'Config' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idAppConfig' => 0, 'appIdentifier' => 1, 'status' => 2, 'isActive' => 3, 'config' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyAppConfigTableMap::COL_ID_APP_CONFIG => 0, SpyAppConfigTableMap::COL_APP_IDENTIFIER => 1, SpyAppConfigTableMap::COL_STATUS => 2, SpyAppConfigTableMap::COL_IS_ACTIVE => 3, SpyAppConfigTableMap::COL_CONFIG => 4, SpyAppConfigTableMap::COL_CREATED_AT => 5, SpyAppConfigTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_app_config' => 0, 'app_identifier' => 1, 'status' => 2, 'is_active' => 3, 'config' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAppConfig' => 'ID_APP_CONFIG',
        'SpyAppConfig.IdAppConfig' => 'ID_APP_CONFIG',
        'idAppConfig' => 'ID_APP_CONFIG',
        'spyAppConfig.idAppConfig' => 'ID_APP_CONFIG',
        'SpyAppConfigTableMap::COL_ID_APP_CONFIG' => 'ID_APP_CONFIG',
        'COL_ID_APP_CONFIG' => 'ID_APP_CONFIG',
        'id_app_config' => 'ID_APP_CONFIG',
        'spy_app_config.id_app_config' => 'ID_APP_CONFIG',
        'AppIdentifier' => 'APP_IDENTIFIER',
        'SpyAppConfig.AppIdentifier' => 'APP_IDENTIFIER',
        'appIdentifier' => 'APP_IDENTIFIER',
        'spyAppConfig.appIdentifier' => 'APP_IDENTIFIER',
        'SpyAppConfigTableMap::COL_APP_IDENTIFIER' => 'APP_IDENTIFIER',
        'COL_APP_IDENTIFIER' => 'APP_IDENTIFIER',
        'app_identifier' => 'APP_IDENTIFIER',
        'spy_app_config.app_identifier' => 'APP_IDENTIFIER',
        'Status' => 'STATUS',
        'SpyAppConfig.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyAppConfig.status' => 'STATUS',
        'SpyAppConfigTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_app_config.status' => 'STATUS',
        'IsActive' => 'IS_ACTIVE',
        'SpyAppConfig.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyAppConfig.isActive' => 'IS_ACTIVE',
        'SpyAppConfigTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_app_config.is_active' => 'IS_ACTIVE',
        'Config' => 'CONFIG',
        'SpyAppConfig.Config' => 'CONFIG',
        'config' => 'CONFIG',
        'spyAppConfig.config' => 'CONFIG',
        'SpyAppConfigTableMap::COL_CONFIG' => 'CONFIG',
        'COL_CONFIG' => 'CONFIG',
        'spy_app_config.config' => 'CONFIG',
        'CreatedAt' => 'CREATED_AT',
        'SpyAppConfig.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyAppConfig.createdAt' => 'CREATED_AT',
        'SpyAppConfigTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_app_config.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyAppConfig.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyAppConfig.updatedAt' => 'UPDATED_AT',
        'SpyAppConfigTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_app_config.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_app_config');
        $this->setPhpName('SpyAppConfig');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\KernelApp\\Persistence\\SpyAppConfig');
        $this->setPackage('src.Orm.Zed.KernelApp.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_app_config_pk_seq');
        // columns
        $this->addPrimaryKey('id_app_config', 'IdAppConfig', 'INTEGER', true, null, null);
        $this->addColumn('app_identifier', 'AppIdentifier', 'VARCHAR', true, 36, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 64, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, true);
        $this->addColumn('config', 'Config', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('SpyMerchantAppOnboarding', '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboarding', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':app_identifier',
    1 => ':app_identifier',
  ),
), 'CASCADE', null, 'SpyMerchantAppOnboardings', false);
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
     * Method to invalidate the instance pool of all tables related to spy_app_config     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantAppOnboardingTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAppConfig', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAppConfigTableMap::CLASS_DEFAULT : SpyAppConfigTableMap::OM_CLASS;
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
     * @return array (SpyAppConfig object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAppConfigTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAppConfigTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAppConfigTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAppConfigTableMap::OM_CLASS;
            /** @var SpyAppConfig $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAppConfigTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAppConfigTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAppConfigTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAppConfig $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAppConfigTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_ID_APP_CONFIG);
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_APP_IDENTIFIER);
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_CONFIG);
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyAppConfigTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_app_config');
            $criteria->addSelectColumn($alias . '.app_identifier');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.config');
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
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_ID_APP_CONFIG);
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_APP_IDENTIFIER);
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_CONFIG);
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyAppConfigTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_app_config');
            $criteria->removeSelectColumn($alias . '.app_identifier');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.config');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAppConfigTableMap::DATABASE_NAME)->getTable(SpyAppConfigTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAppConfig or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAppConfig object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAppConfigTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\KernelApp\Persistence\SpyAppConfig) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAppConfigTableMap::DATABASE_NAME);
            $criteria->add(SpyAppConfigTableMap::COL_ID_APP_CONFIG, (array) $values, Criteria::IN);
        }

        $query = SpyAppConfigQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAppConfigTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAppConfigTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_app_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAppConfigQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAppConfig or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAppConfig object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAppConfigTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAppConfig object
        }

        if ($criteria->containsKey(SpyAppConfigTableMap::COL_ID_APP_CONFIG) && $criteria->keyContainsValue(SpyAppConfigTableMap::COL_ID_APP_CONFIG) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAppConfigTableMap::COL_ID_APP_CONFIG.')');
        }


        // Set the correct dbName
        $query = SpyAppConfigQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
