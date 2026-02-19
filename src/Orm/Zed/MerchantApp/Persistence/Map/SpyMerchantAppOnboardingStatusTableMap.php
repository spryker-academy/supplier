<?php

namespace Orm\Zed\MerchantApp\Persistence\Map;

use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery;
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
 * This class defines the structure of the 'spy_merchant_app_onboarding_status' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantAppOnboardingStatusTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantApp.Persistence.Map.SpyMerchantAppOnboardingStatusTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_app_onboarding_status';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantAppOnboardingStatus';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboardingStatus';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantApp.Persistence.SpyMerchantAppOnboardingStatus';

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
     * the column name for the id_merchant_app_onboarding_status field
     */
    public const COL_ID_MERCHANT_APP_ONBOARDING_STATUS = 'spy_merchant_app_onboarding_status.id_merchant_app_onboarding_status';

    /**
     * the column name for the fk_merchant_app_onboarding field
     */
    public const COL_FK_MERCHANT_APP_ONBOARDING = 'spy_merchant_app_onboarding_status.fk_merchant_app_onboarding';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_merchant_app_onboarding_status.merchant_reference';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_merchant_app_onboarding_status.status';

    /**
     * the column name for the additional_info field
     */
    public const COL_ADDITIONAL_INFO = 'spy_merchant_app_onboarding_status.additional_info';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_app_onboarding_status.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_app_onboarding_status.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchantAppOnboardingStatus', 'FkMerchantAppOnboarding', 'MerchantReference', 'Status', 'AdditionalInfo', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantAppOnboardingStatus', 'fkMerchantAppOnboarding', 'merchantReference', 'status', 'additionalInfo', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS, SpyMerchantAppOnboardingStatusTableMap::COL_FK_MERCHANT_APP_ONBOARDING, SpyMerchantAppOnboardingStatusTableMap::COL_MERCHANT_REFERENCE, SpyMerchantAppOnboardingStatusTableMap::COL_STATUS, SpyMerchantAppOnboardingStatusTableMap::COL_ADDITIONAL_INFO, SpyMerchantAppOnboardingStatusTableMap::COL_CREATED_AT, SpyMerchantAppOnboardingStatusTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_app_onboarding_status', 'fk_merchant_app_onboarding', 'merchant_reference', 'status', 'additional_info', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantAppOnboardingStatus' => 0, 'FkMerchantAppOnboarding' => 1, 'MerchantReference' => 2, 'Status' => 3, 'AdditionalInfo' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idMerchantAppOnboardingStatus' => 0, 'fkMerchantAppOnboarding' => 1, 'merchantReference' => 2, 'status' => 3, 'additionalInfo' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS => 0, SpyMerchantAppOnboardingStatusTableMap::COL_FK_MERCHANT_APP_ONBOARDING => 1, SpyMerchantAppOnboardingStatusTableMap::COL_MERCHANT_REFERENCE => 2, SpyMerchantAppOnboardingStatusTableMap::COL_STATUS => 3, SpyMerchantAppOnboardingStatusTableMap::COL_ADDITIONAL_INFO => 4, SpyMerchantAppOnboardingStatusTableMap::COL_CREATED_AT => 5, SpyMerchantAppOnboardingStatusTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_merchant_app_onboarding_status' => 0, 'fk_merchant_app_onboarding' => 1, 'merchant_reference' => 2, 'status' => 3, 'additional_info' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantAppOnboardingStatus' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'SpyMerchantAppOnboardingStatus.IdMerchantAppOnboardingStatus' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'idMerchantAppOnboardingStatus' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'spyMerchantAppOnboardingStatus.idMerchantAppOnboardingStatus' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'COL_ID_MERCHANT_APP_ONBOARDING_STATUS' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'id_merchant_app_onboarding_status' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'spy_merchant_app_onboarding_status.id_merchant_app_onboarding_status' => 'ID_MERCHANT_APP_ONBOARDING_STATUS',
        'FkMerchantAppOnboarding' => 'FK_MERCHANT_APP_ONBOARDING',
        'SpyMerchantAppOnboardingStatus.FkMerchantAppOnboarding' => 'FK_MERCHANT_APP_ONBOARDING',
        'fkMerchantAppOnboarding' => 'FK_MERCHANT_APP_ONBOARDING',
        'spyMerchantAppOnboardingStatus.fkMerchantAppOnboarding' => 'FK_MERCHANT_APP_ONBOARDING',
        'SpyMerchantAppOnboardingStatusTableMap::COL_FK_MERCHANT_APP_ONBOARDING' => 'FK_MERCHANT_APP_ONBOARDING',
        'COL_FK_MERCHANT_APP_ONBOARDING' => 'FK_MERCHANT_APP_ONBOARDING',
        'fk_merchant_app_onboarding' => 'FK_MERCHANT_APP_ONBOARDING',
        'spy_merchant_app_onboarding_status.fk_merchant_app_onboarding' => 'FK_MERCHANT_APP_ONBOARDING',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpyMerchantAppOnboardingStatus.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spyMerchantAppOnboardingStatus.merchantReference' => 'MERCHANT_REFERENCE',
        'SpyMerchantAppOnboardingStatusTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_merchant_app_onboarding_status.merchant_reference' => 'MERCHANT_REFERENCE',
        'Status' => 'STATUS',
        'SpyMerchantAppOnboardingStatus.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyMerchantAppOnboardingStatus.status' => 'STATUS',
        'SpyMerchantAppOnboardingStatusTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_merchant_app_onboarding_status.status' => 'STATUS',
        'AdditionalInfo' => 'ADDITIONAL_INFO',
        'SpyMerchantAppOnboardingStatus.AdditionalInfo' => 'ADDITIONAL_INFO',
        'additionalInfo' => 'ADDITIONAL_INFO',
        'spyMerchantAppOnboardingStatus.additionalInfo' => 'ADDITIONAL_INFO',
        'SpyMerchantAppOnboardingStatusTableMap::COL_ADDITIONAL_INFO' => 'ADDITIONAL_INFO',
        'COL_ADDITIONAL_INFO' => 'ADDITIONAL_INFO',
        'additional_info' => 'ADDITIONAL_INFO',
        'spy_merchant_app_onboarding_status.additional_info' => 'ADDITIONAL_INFO',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantAppOnboardingStatus.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantAppOnboardingStatus.createdAt' => 'CREATED_AT',
        'SpyMerchantAppOnboardingStatusTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_app_onboarding_status.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantAppOnboardingStatus.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantAppOnboardingStatus.updatedAt' => 'UPDATED_AT',
        'SpyMerchantAppOnboardingStatusTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_app_onboarding_status.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant_app_onboarding_status');
        $this->setPhpName('SpyMerchantAppOnboardingStatus');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboardingStatus');
        $this->setPackage('src.Orm.Zed.MerchantApp.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_app_onboarding_status_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_app_onboarding_status', 'IdMerchantAppOnboardingStatus', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_merchant_app_onboarding', 'FkMerchantAppOnboarding', 'INTEGER', 'spy_merchant_app_onboarding', 'id_merchant_app_onboarding', true, null, null);
        $this->addForeignKey('merchant_reference', 'MerchantReference', 'VARCHAR', 'spy_merchant', 'merchant_reference', true, 128, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 36, null);
        $this->addColumn('additional_info', 'AdditionalInfo', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('SpyMerchantAppOnboarding', '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboarding', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_app_onboarding',
    1 => ':id_merchant_app_onboarding',
  ),
), null, null, null, false);
        $this->addRelation('SpyMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantAppOnboardingStatus', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantAppOnboardingStatusTableMap::CLASS_DEFAULT : SpyMerchantAppOnboardingStatusTableMap::OM_CLASS;
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
     * @return array (SpyMerchantAppOnboardingStatus object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantAppOnboardingStatusTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantAppOnboardingStatusTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantAppOnboardingStatusTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantAppOnboardingStatusTableMap::OM_CLASS;
            /** @var SpyMerchantAppOnboardingStatus $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantAppOnboardingStatusTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantAppOnboardingStatusTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantAppOnboardingStatusTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantAppOnboardingStatus $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantAppOnboardingStatusTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_FK_MERCHANT_APP_ONBOARDING);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_ADDITIONAL_INFO);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_app_onboarding_status');
            $criteria->addSelectColumn($alias . '.fk_merchant_app_onboarding');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.additional_info');
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
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_FK_MERCHANT_APP_ONBOARDING);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_ADDITIONAL_INFO);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingStatusTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_app_onboarding_status');
            $criteria->removeSelectColumn($alias . '.fk_merchant_app_onboarding');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.additional_info');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantAppOnboardingStatusTableMap::DATABASE_NAME)->getTable(SpyMerchantAppOnboardingStatusTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantAppOnboardingStatus or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantAppOnboardingStatus object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingStatusTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantAppOnboardingStatusTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantAppOnboardingStatusQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantAppOnboardingStatusTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantAppOnboardingStatusTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_app_onboarding_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantAppOnboardingStatusQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantAppOnboardingStatus or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantAppOnboardingStatus object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingStatusTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantAppOnboardingStatus object
        }

        if ($criteria->containsKey(SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS) && $criteria->keyContainsValue(SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantAppOnboardingStatusTableMap::COL_ID_MERCHANT_APP_ONBOARDING_STATUS.')');
        }


        // Set the correct dbName
        $query = SpyMerchantAppOnboardingStatusQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
