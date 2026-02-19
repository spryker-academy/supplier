<?php

namespace Orm\Zed\AvailabilityNotification\Persistence\Map;

use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery;
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
 * This class defines the structure of the 'spy_availability_notification_subscription' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAvailabilityNotificationSubscriptionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.AvailabilityNotification.Persistence.Map.SpyAvailabilityNotificationSubscriptionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_availability_notification_subscription';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAvailabilityNotificationSubscription';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\AvailabilityNotification\\Persistence\\SpyAvailabilityNotificationSubscription';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.AvailabilityNotification.Persistence.SpyAvailabilityNotificationSubscription';

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
     * the column name for the id_availability_notification_subscription field
     */
    public const COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION = 'spy_availability_notification_subscription.id_availability_notification_subscription';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_availability_notification_subscription.fk_locale';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_availability_notification_subscription.fk_store';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_availability_notification_subscription.customer_reference';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_availability_notification_subscription.email';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_availability_notification_subscription.sku';

    /**
     * the column name for the subscription_key field
     */
    public const COL_SUBSCRIPTION_KEY = 'spy_availability_notification_subscription.subscription_key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_availability_notification_subscription.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_availability_notification_subscription.updated_at';

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
        self::TYPE_PHPNAME       => ['IdAvailabilityNotificationSubscription', 'FkLocale', 'FkStore', 'CustomerReference', 'Email', 'Sku', 'SubscriptionKey', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idAvailabilityNotificationSubscription', 'fkLocale', 'fkStore', 'customerReference', 'email', 'sku', 'subscriptionKey', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyAvailabilityNotificationSubscriptionTableMap::COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION, SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_LOCALE, SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_STORE, SpyAvailabilityNotificationSubscriptionTableMap::COL_CUSTOMER_REFERENCE, SpyAvailabilityNotificationSubscriptionTableMap::COL_EMAIL, SpyAvailabilityNotificationSubscriptionTableMap::COL_SKU, SpyAvailabilityNotificationSubscriptionTableMap::COL_SUBSCRIPTION_KEY, SpyAvailabilityNotificationSubscriptionTableMap::COL_CREATED_AT, SpyAvailabilityNotificationSubscriptionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_availability_notification_subscription', 'fk_locale', 'fk_store', 'customer_reference', 'email', 'sku', 'subscription_key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdAvailabilityNotificationSubscription' => 0, 'FkLocale' => 1, 'FkStore' => 2, 'CustomerReference' => 3, 'Email' => 4, 'Sku' => 5, 'SubscriptionKey' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idAvailabilityNotificationSubscription' => 0, 'fkLocale' => 1, 'fkStore' => 2, 'customerReference' => 3, 'email' => 4, 'sku' => 5, 'subscriptionKey' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyAvailabilityNotificationSubscriptionTableMap::COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION => 0, SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_LOCALE => 1, SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_STORE => 2, SpyAvailabilityNotificationSubscriptionTableMap::COL_CUSTOMER_REFERENCE => 3, SpyAvailabilityNotificationSubscriptionTableMap::COL_EMAIL => 4, SpyAvailabilityNotificationSubscriptionTableMap::COL_SKU => 5, SpyAvailabilityNotificationSubscriptionTableMap::COL_SUBSCRIPTION_KEY => 6, SpyAvailabilityNotificationSubscriptionTableMap::COL_CREATED_AT => 7, SpyAvailabilityNotificationSubscriptionTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_availability_notification_subscription' => 0, 'fk_locale' => 1, 'fk_store' => 2, 'customer_reference' => 3, 'email' => 4, 'sku' => 5, 'subscription_key' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAvailabilityNotificationSubscription' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'SpyAvailabilityNotificationSubscription.IdAvailabilityNotificationSubscription' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'idAvailabilityNotificationSubscription' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'spyAvailabilityNotificationSubscription.idAvailabilityNotificationSubscription' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'id_availability_notification_subscription' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'spy_availability_notification_subscription.id_availability_notification_subscription' => 'ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION',
        'FkLocale' => 'FK_LOCALE',
        'SpyAvailabilityNotificationSubscription.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyAvailabilityNotificationSubscription.fkLocale' => 'FK_LOCALE',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_availability_notification_subscription.fk_locale' => 'FK_LOCALE',
        'FkStore' => 'FK_STORE',
        'SpyAvailabilityNotificationSubscription.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyAvailabilityNotificationSubscription.fkStore' => 'FK_STORE',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_availability_notification_subscription.fk_store' => 'FK_STORE',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpyAvailabilityNotificationSubscription.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spyAvailabilityNotificationSubscription.customerReference' => 'CUSTOMER_REFERENCE',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_availability_notification_subscription.customer_reference' => 'CUSTOMER_REFERENCE',
        'Email' => 'EMAIL',
        'SpyAvailabilityNotificationSubscription.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spyAvailabilityNotificationSubscription.email' => 'EMAIL',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_availability_notification_subscription.email' => 'EMAIL',
        'Sku' => 'SKU',
        'SpyAvailabilityNotificationSubscription.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyAvailabilityNotificationSubscription.sku' => 'SKU',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_availability_notification_subscription.sku' => 'SKU',
        'SubscriptionKey' => 'SUBSCRIPTION_KEY',
        'SpyAvailabilityNotificationSubscription.SubscriptionKey' => 'SUBSCRIPTION_KEY',
        'subscriptionKey' => 'SUBSCRIPTION_KEY',
        'spyAvailabilityNotificationSubscription.subscriptionKey' => 'SUBSCRIPTION_KEY',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_SUBSCRIPTION_KEY' => 'SUBSCRIPTION_KEY',
        'COL_SUBSCRIPTION_KEY' => 'SUBSCRIPTION_KEY',
        'subscription_key' => 'SUBSCRIPTION_KEY',
        'spy_availability_notification_subscription.subscription_key' => 'SUBSCRIPTION_KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyAvailabilityNotificationSubscription.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyAvailabilityNotificationSubscription.createdAt' => 'CREATED_AT',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_availability_notification_subscription.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyAvailabilityNotificationSubscription.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyAvailabilityNotificationSubscription.updatedAt' => 'UPDATED_AT',
        'SpyAvailabilityNotificationSubscriptionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_availability_notification_subscription.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_availability_notification_subscription');
        $this->setPhpName('SpyAvailabilityNotificationSubscription');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\AvailabilityNotification\\Persistence\\SpyAvailabilityNotificationSubscription');
        $this->setPackage('src.Orm.Zed.AvailabilityNotification.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_availability_notification_subscription_pk_seq');
        // columns
        $this->addPrimaryKey('id_availability_notification_subscription', 'IdAvailabilityNotificationSubscription', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', true, null, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
        $this->addColumn('subscription_key', 'SubscriptionKey', 'VARCHAR', true, 150, null);
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
        $this->addRelation('SpyStore', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
  ),
), null, null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAvailabilityNotificationSubscription', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAvailabilityNotificationSubscriptionTableMap::CLASS_DEFAULT : SpyAvailabilityNotificationSubscriptionTableMap::OM_CLASS;
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
     * @return array (SpyAvailabilityNotificationSubscription object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAvailabilityNotificationSubscriptionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAvailabilityNotificationSubscriptionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAvailabilityNotificationSubscriptionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAvailabilityNotificationSubscriptionTableMap::OM_CLASS;
            /** @var SpyAvailabilityNotificationSubscription $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAvailabilityNotificationSubscriptionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAvailabilityNotificationSubscriptionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAvailabilityNotificationSubscriptionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAvailabilityNotificationSubscription $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAvailabilityNotificationSubscriptionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_SKU);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_SUBSCRIPTION_KEY);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_availability_notification_subscription');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.sku');
            $criteria->addSelectColumn($alias . '.subscription_key');
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
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_SUBSCRIPTION_KEY);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyAvailabilityNotificationSubscriptionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_availability_notification_subscription');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.sku');
            $criteria->removeSelectColumn($alias . '.subscription_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAvailabilityNotificationSubscriptionTableMap::DATABASE_NAME)->getTable(SpyAvailabilityNotificationSubscriptionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAvailabilityNotificationSubscription or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAvailabilityNotificationSubscription object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAvailabilityNotificationSubscriptionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAvailabilityNotificationSubscriptionTableMap::DATABASE_NAME);
            $criteria->add(SpyAvailabilityNotificationSubscriptionTableMap::COL_ID_AVAILABILITY_NOTIFICATION_SUBSCRIPTION, (array) $values, Criteria::IN);
        }

        $query = SpyAvailabilityNotificationSubscriptionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAvailabilityNotificationSubscriptionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAvailabilityNotificationSubscriptionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_availability_notification_subscription table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAvailabilityNotificationSubscriptionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAvailabilityNotificationSubscription or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAvailabilityNotificationSubscription object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAvailabilityNotificationSubscriptionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAvailabilityNotificationSubscription object
        }


        // Set the correct dbName
        $query = SpyAvailabilityNotificationSubscriptionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
