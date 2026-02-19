<?php

namespace Orm\Zed\MerchantApp\Persistence\Map;

use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboarding;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingQuery;
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
 * This class defines the structure of the 'spy_merchant_app_onboarding' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantAppOnboardingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantApp.Persistence.Map.SpyMerchantAppOnboardingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_app_onboarding';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantAppOnboarding';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboarding';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantApp.Persistence.SpyMerchantAppOnboarding';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_merchant_app_onboarding field
     */
    public const COL_ID_MERCHANT_APP_ONBOARDING = 'spy_merchant_app_onboarding.id_merchant_app_onboarding';

    /**
     * the column name for the onboarding_url field
     */
    public const COL_ONBOARDING_URL = 'spy_merchant_app_onboarding.onboarding_url';

    /**
     * the column name for the onboarding_strategy field
     */
    public const COL_ONBOARDING_STRATEGY = 'spy_merchant_app_onboarding.onboarding_strategy';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_merchant_app_onboarding.type';

    /**
     * the column name for the app_name field
     */
    public const COL_APP_NAME = 'spy_merchant_app_onboarding.app_name';

    /**
     * the column name for the app_identifier field
     */
    public const COL_APP_IDENTIFIER = 'spy_merchant_app_onboarding.app_identifier';

    /**
     * the column name for the additional_content field
     */
    public const COL_ADDITIONAL_CONTENT = 'spy_merchant_app_onboarding.additional_content';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_app_onboarding.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_app_onboarding.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the onboarding_strategy field */
    public const COL_ONBOARDING_STRATEGY_IFRAME = 'iframe';
    public const COL_ONBOARDING_STRATEGY_REDIRECT = 'redirect';
    public const COL_ONBOARDING_STRATEGY_API = 'api';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdMerchantAppOnboarding', 'OnboardingUrl', 'OnboardingStrategy', 'Type', 'AppName', 'AppIdentifier', 'AdditionalContent', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantAppOnboarding', 'onboardingUrl', 'onboardingStrategy', 'type', 'appName', 'appIdentifier', 'additionalContent', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL, SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY, SpyMerchantAppOnboardingTableMap::COL_TYPE, SpyMerchantAppOnboardingTableMap::COL_APP_NAME, SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER, SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT, SpyMerchantAppOnboardingTableMap::COL_CREATED_AT, SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_app_onboarding', 'onboarding_url', 'onboarding_strategy', 'type', 'app_name', 'app_identifier', 'additional_content', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantAppOnboarding' => 0, 'OnboardingUrl' => 1, 'OnboardingStrategy' => 2, 'Type' => 3, 'AppName' => 4, 'AppIdentifier' => 5, 'AdditionalContent' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idMerchantAppOnboarding' => 0, 'onboardingUrl' => 1, 'onboardingStrategy' => 2, 'type' => 3, 'appName' => 4, 'appIdentifier' => 5, 'additionalContent' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING => 0, SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL => 1, SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY => 2, SpyMerchantAppOnboardingTableMap::COL_TYPE => 3, SpyMerchantAppOnboardingTableMap::COL_APP_NAME => 4, SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER => 5, SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT => 6, SpyMerchantAppOnboardingTableMap::COL_CREATED_AT => 7, SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_merchant_app_onboarding' => 0, 'onboarding_url' => 1, 'onboarding_strategy' => 2, 'type' => 3, 'app_name' => 4, 'app_identifier' => 5, 'additional_content' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantAppOnboarding' => 'ID_MERCHANT_APP_ONBOARDING',
        'SpyMerchantAppOnboarding.IdMerchantAppOnboarding' => 'ID_MERCHANT_APP_ONBOARDING',
        'idMerchantAppOnboarding' => 'ID_MERCHANT_APP_ONBOARDING',
        'spyMerchantAppOnboarding.idMerchantAppOnboarding' => 'ID_MERCHANT_APP_ONBOARDING',
        'SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING' => 'ID_MERCHANT_APP_ONBOARDING',
        'COL_ID_MERCHANT_APP_ONBOARDING' => 'ID_MERCHANT_APP_ONBOARDING',
        'id_merchant_app_onboarding' => 'ID_MERCHANT_APP_ONBOARDING',
        'spy_merchant_app_onboarding.id_merchant_app_onboarding' => 'ID_MERCHANT_APP_ONBOARDING',
        'OnboardingUrl' => 'ONBOARDING_URL',
        'SpyMerchantAppOnboarding.OnboardingUrl' => 'ONBOARDING_URL',
        'onboardingUrl' => 'ONBOARDING_URL',
        'spyMerchantAppOnboarding.onboardingUrl' => 'ONBOARDING_URL',
        'SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL' => 'ONBOARDING_URL',
        'COL_ONBOARDING_URL' => 'ONBOARDING_URL',
        'onboarding_url' => 'ONBOARDING_URL',
        'spy_merchant_app_onboarding.onboarding_url' => 'ONBOARDING_URL',
        'OnboardingStrategy' => 'ONBOARDING_STRATEGY',
        'SpyMerchantAppOnboarding.OnboardingStrategy' => 'ONBOARDING_STRATEGY',
        'onboardingStrategy' => 'ONBOARDING_STRATEGY',
        'spyMerchantAppOnboarding.onboardingStrategy' => 'ONBOARDING_STRATEGY',
        'SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY' => 'ONBOARDING_STRATEGY',
        'COL_ONBOARDING_STRATEGY' => 'ONBOARDING_STRATEGY',
        'onboarding_strategy' => 'ONBOARDING_STRATEGY',
        'spy_merchant_app_onboarding.onboarding_strategy' => 'ONBOARDING_STRATEGY',
        'Type' => 'TYPE',
        'SpyMerchantAppOnboarding.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyMerchantAppOnboarding.type' => 'TYPE',
        'SpyMerchantAppOnboardingTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_merchant_app_onboarding.type' => 'TYPE',
        'AppName' => 'APP_NAME',
        'SpyMerchantAppOnboarding.AppName' => 'APP_NAME',
        'appName' => 'APP_NAME',
        'spyMerchantAppOnboarding.appName' => 'APP_NAME',
        'SpyMerchantAppOnboardingTableMap::COL_APP_NAME' => 'APP_NAME',
        'COL_APP_NAME' => 'APP_NAME',
        'app_name' => 'APP_NAME',
        'spy_merchant_app_onboarding.app_name' => 'APP_NAME',
        'AppIdentifier' => 'APP_IDENTIFIER',
        'SpyMerchantAppOnboarding.AppIdentifier' => 'APP_IDENTIFIER',
        'appIdentifier' => 'APP_IDENTIFIER',
        'spyMerchantAppOnboarding.appIdentifier' => 'APP_IDENTIFIER',
        'SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER' => 'APP_IDENTIFIER',
        'COL_APP_IDENTIFIER' => 'APP_IDENTIFIER',
        'app_identifier' => 'APP_IDENTIFIER',
        'spy_merchant_app_onboarding.app_identifier' => 'APP_IDENTIFIER',
        'AdditionalContent' => 'ADDITIONAL_CONTENT',
        'SpyMerchantAppOnboarding.AdditionalContent' => 'ADDITIONAL_CONTENT',
        'additionalContent' => 'ADDITIONAL_CONTENT',
        'spyMerchantAppOnboarding.additionalContent' => 'ADDITIONAL_CONTENT',
        'SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT' => 'ADDITIONAL_CONTENT',
        'COL_ADDITIONAL_CONTENT' => 'ADDITIONAL_CONTENT',
        'additional_content' => 'ADDITIONAL_CONTENT',
        'spy_merchant_app_onboarding.additional_content' => 'ADDITIONAL_CONTENT',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantAppOnboarding.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantAppOnboarding.createdAt' => 'CREATED_AT',
        'SpyMerchantAppOnboardingTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_app_onboarding.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantAppOnboarding.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantAppOnboarding.updatedAt' => 'UPDATED_AT',
        'SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_app_onboarding.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY => [
                            self::COL_ONBOARDING_STRATEGY_IFRAME,
            self::COL_ONBOARDING_STRATEGY_REDIRECT,
            self::COL_ONBOARDING_STRATEGY_API,
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
        $this->setName('spy_merchant_app_onboarding');
        $this->setPhpName('SpyMerchantAppOnboarding');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboarding');
        $this->setPackage('src.Orm.Zed.MerchantApp.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_app_onboarding_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_app_onboarding', 'IdMerchantAppOnboarding', 'INTEGER', true, null, null);
        $this->addColumn('onboarding_url', 'OnboardingUrl', 'VARCHAR', true, 255, null);
        $this->addColumn('onboarding_strategy', 'OnboardingStrategy', 'ENUM', true, null, null);
        $this->getColumn('onboarding_strategy')->setValueSet(array (
  0 => 'iframe',
  1 => 'redirect',
  2 => 'api',
));
        $this->addColumn('type', 'Type', 'VARCHAR', true, 128, null);
        $this->addColumn('app_name', 'AppName', 'VARCHAR', true, 255, null);
        $this->addForeignKey('app_identifier', 'AppIdentifier', 'VARCHAR', 'spy_app_config', 'app_identifier', true, 36, null);
        $this->addColumn('additional_content', 'AdditionalContent', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('SpyAppConfig', '\\Orm\\Zed\\KernelApp\\Persistence\\SpyAppConfig', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':app_identifier',
    1 => ':app_identifier',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyMerchantAppOnboardingStatus', '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboardingStatus', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_app_onboarding',
    1 => ':id_merchant_app_onboarding',
  ),
), null, null, 'SpyMerchantAppOnboardingStatuses', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantAppOnboarding', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantAppOnboardingTableMap::CLASS_DEFAULT : SpyMerchantAppOnboardingTableMap::OM_CLASS;
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
     * @return array (SpyMerchantAppOnboarding object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantAppOnboardingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantAppOnboardingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantAppOnboardingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantAppOnboardingTableMap::OM_CLASS;
            /** @var SpyMerchantAppOnboarding $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantAppOnboardingTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantAppOnboardingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantAppOnboardingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantAppOnboarding $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantAppOnboardingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_APP_NAME);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_app_onboarding');
            $criteria->addSelectColumn($alias . '.onboarding_url');
            $criteria->addSelectColumn($alias . '.onboarding_strategy');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.app_name');
            $criteria->addSelectColumn($alias . '.app_identifier');
            $criteria->addSelectColumn($alias . '.additional_content');
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
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_URL);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ONBOARDING_STRATEGY);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_APP_NAME);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_APP_IDENTIFIER);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_ADDITIONAL_CONTENT);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantAppOnboardingTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_app_onboarding');
            $criteria->removeSelectColumn($alias . '.onboarding_url');
            $criteria->removeSelectColumn($alias . '.onboarding_strategy');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.app_name');
            $criteria->removeSelectColumn($alias . '.app_identifier');
            $criteria->removeSelectColumn($alias . '.additional_content');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantAppOnboardingTableMap::DATABASE_NAME)->getTable(SpyMerchantAppOnboardingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantAppOnboarding or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantAppOnboarding object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboarding) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantAppOnboardingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantAppOnboardingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantAppOnboardingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_app_onboarding table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantAppOnboardingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantAppOnboarding or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantAppOnboarding object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantAppOnboardingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantAppOnboarding object
        }

        if ($criteria->containsKey(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING) && $criteria->keyContainsValue(SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantAppOnboardingTableMap::COL_ID_MERCHANT_APP_ONBOARDING.')');
        }


        // Set the correct dbName
        $query = SpyMerchantAppOnboardingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
