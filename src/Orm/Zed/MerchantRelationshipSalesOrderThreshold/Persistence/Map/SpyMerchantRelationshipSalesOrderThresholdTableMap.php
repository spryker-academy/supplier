<?php

namespace Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\Map;

use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold;
use Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThresholdQuery;
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
 * This class defines the structure of the 'spy_merchant_relationship_sales_order_threshold' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantRelationshipSalesOrderThresholdTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantRelationshipSalesOrderThreshold.Persistence.Map.SpyMerchantRelationshipSalesOrderThresholdTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_relationship_sales_order_threshold';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantRelationshipSalesOrderThreshold';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantRelationshipSalesOrderThreshold\\Persistence\\SpyMerchantRelationshipSalesOrderThreshold';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantRelationshipSalesOrderThreshold.Persistence.SpyMerchantRelationshipSalesOrderThreshold';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_merchant_relationship_sales_order_threshold field
     */
    public const COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD = 'spy_merchant_relationship_sales_order_threshold.id_merchant_relationship_sales_order_threshold';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_merchant_relationship_sales_order_threshold.fk_currency';

    /**
     * the column name for the fk_merchant_relationship field
     */
    public const COL_FK_MERCHANT_RELATIONSHIP = 'spy_merchant_relationship_sales_order_threshold.fk_merchant_relationship';

    /**
     * the column name for the fk_sales_order_threshold_type field
     */
    public const COL_FK_SALES_ORDER_THRESHOLD_TYPE = 'spy_merchant_relationship_sales_order_threshold.fk_sales_order_threshold_type';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_merchant_relationship_sales_order_threshold.fk_store';

    /**
     * the column name for the fee field
     */
    public const COL_FEE = 'spy_merchant_relationship_sales_order_threshold.fee';

    /**
     * the column name for the message_glossary_key field
     */
    public const COL_MESSAGE_GLOSSARY_KEY = 'spy_merchant_relationship_sales_order_threshold.message_glossary_key';

    /**
     * the column name for the threshold field
     */
    public const COL_THRESHOLD = 'spy_merchant_relationship_sales_order_threshold.threshold';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_relationship_sales_order_threshold.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_relationship_sales_order_threshold.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchantRelationshipSalesOrderThreshold', 'FkCurrency', 'FkMerchantRelationship', 'FkSalesOrderThresholdType', 'FkStore', 'Fee', 'MessageGlossaryKey', 'Threshold', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantRelationshipSalesOrderThreshold', 'fkCurrency', 'fkMerchantRelationship', 'fkSalesOrderThresholdType', 'fkStore', 'fee', 'messageGlossaryKey', 'threshold', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_relationship_sales_order_threshold', 'fk_currency', 'fk_merchant_relationship', 'fk_sales_order_threshold_type', 'fk_store', 'fee', 'message_glossary_key', 'threshold', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantRelationshipSalesOrderThreshold' => 0, 'FkCurrency' => 1, 'FkMerchantRelationship' => 2, 'FkSalesOrderThresholdType' => 3, 'FkStore' => 4, 'Fee' => 5, 'MessageGlossaryKey' => 6, 'Threshold' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idMerchantRelationshipSalesOrderThreshold' => 0, 'fkCurrency' => 1, 'fkMerchantRelationship' => 2, 'fkSalesOrderThresholdType' => 3, 'fkStore' => 4, 'fee' => 5, 'messageGlossaryKey' => 6, 'threshold' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD => 0, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY => 1, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP => 2, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE => 3, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE => 4, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE => 5, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY => 6, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD => 7, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT => 8, SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_merchant_relationship_sales_order_threshold' => 0, 'fk_currency' => 1, 'fk_merchant_relationship' => 2, 'fk_sales_order_threshold_type' => 3, 'fk_store' => 4, 'fee' => 5, 'message_glossary_key' => 6, 'threshold' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantRelationshipSalesOrderThreshold' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'SpyMerchantRelationshipSalesOrderThreshold.IdMerchantRelationshipSalesOrderThreshold' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'idMerchantRelationshipSalesOrderThreshold' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'spyMerchantRelationshipSalesOrderThreshold.idMerchantRelationshipSalesOrderThreshold' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'id_merchant_relationship_sales_order_threshold' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'spy_merchant_relationship_sales_order_threshold.id_merchant_relationship_sales_order_threshold' => 'ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD',
        'FkCurrency' => 'FK_CURRENCY',
        'SpyMerchantRelationshipSalesOrderThreshold.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spyMerchantRelationshipSalesOrderThreshold.fkCurrency' => 'FK_CURRENCY',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_merchant_relationship_sales_order_threshold.fk_currency' => 'FK_CURRENCY',
        'FkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'SpyMerchantRelationshipSalesOrderThreshold.FkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'fkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'spyMerchantRelationshipSalesOrderThreshold.fkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP' => 'FK_MERCHANT_RELATIONSHIP',
        'COL_FK_MERCHANT_RELATIONSHIP' => 'FK_MERCHANT_RELATIONSHIP',
        'fk_merchant_relationship' => 'FK_MERCHANT_RELATIONSHIP',
        'spy_merchant_relationship_sales_order_threshold.fk_merchant_relationship' => 'FK_MERCHANT_RELATIONSHIP',
        'FkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'SpyMerchantRelationshipSalesOrderThreshold.FkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'fkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'spyMerchantRelationshipSalesOrderThreshold.fkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'COL_FK_SALES_ORDER_THRESHOLD_TYPE' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'fk_sales_order_threshold_type' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'spy_merchant_relationship_sales_order_threshold.fk_sales_order_threshold_type' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'FkStore' => 'FK_STORE',
        'SpyMerchantRelationshipSalesOrderThreshold.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyMerchantRelationshipSalesOrderThreshold.fkStore' => 'FK_STORE',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_merchant_relationship_sales_order_threshold.fk_store' => 'FK_STORE',
        'Fee' => 'FEE',
        'SpyMerchantRelationshipSalesOrderThreshold.Fee' => 'FEE',
        'fee' => 'FEE',
        'spyMerchantRelationshipSalesOrderThreshold.fee' => 'FEE',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE' => 'FEE',
        'COL_FEE' => 'FEE',
        'spy_merchant_relationship_sales_order_threshold.fee' => 'FEE',
        'MessageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'SpyMerchantRelationshipSalesOrderThreshold.MessageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'messageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'spyMerchantRelationshipSalesOrderThreshold.messageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY' => 'MESSAGE_GLOSSARY_KEY',
        'COL_MESSAGE_GLOSSARY_KEY' => 'MESSAGE_GLOSSARY_KEY',
        'message_glossary_key' => 'MESSAGE_GLOSSARY_KEY',
        'spy_merchant_relationship_sales_order_threshold.message_glossary_key' => 'MESSAGE_GLOSSARY_KEY',
        'Threshold' => 'THRESHOLD',
        'SpyMerchantRelationshipSalesOrderThreshold.Threshold' => 'THRESHOLD',
        'threshold' => 'THRESHOLD',
        'spyMerchantRelationshipSalesOrderThreshold.threshold' => 'THRESHOLD',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD' => 'THRESHOLD',
        'COL_THRESHOLD' => 'THRESHOLD',
        'spy_merchant_relationship_sales_order_threshold.threshold' => 'THRESHOLD',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantRelationshipSalesOrderThreshold.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantRelationshipSalesOrderThreshold.createdAt' => 'CREATED_AT',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_relationship_sales_order_threshold.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantRelationshipSalesOrderThreshold.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantRelationshipSalesOrderThreshold.updatedAt' => 'UPDATED_AT',
        'SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_relationship_sales_order_threshold.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant_relationship_sales_order_threshold');
        $this->setPhpName('SpyMerchantRelationshipSalesOrderThreshold');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\MerchantRelationshipSalesOrderThreshold\\Persistence\\SpyMerchantRelationshipSalesOrderThreshold');
        $this->setPackage('src.Orm.Zed.MerchantRelationshipSalesOrderThreshold.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_merchant_relationship_sales_order_threshold_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_relationship_sales_order_threshold', 'IdMerchantRelationshipSalesOrderThreshold', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
        $this->addForeignKey('fk_merchant_relationship', 'FkMerchantRelationship', 'INTEGER', 'spy_merchant_relationship', 'id_merchant_relationship', true, null, null);
        $this->addForeignKey('fk_sales_order_threshold_type', 'FkSalesOrderThresholdType', 'INTEGER', 'spy_sales_order_threshold_type', 'id_sales_order_threshold_type', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', true, null, null);
        $this->addColumn('fee', 'Fee', 'INTEGER', false, null, null);
        $this->addColumn('message_glossary_key', 'MessageGlossaryKey', 'VARCHAR', true, 255, null);
        $this->addColumn('threshold', 'Threshold', 'INTEGER', true, null, null);
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
        $this->addRelation('MerchantRelationship', '\\Orm\\Zed\\MerchantRelationship\\Persistence\\SpyMerchantRelationship', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_relationship',
    1 => ':id_merchant_relationship',
  ),
), null, null, null, false);
        $this->addRelation('SalesOrderThresholdType', '\\Orm\\Zed\\SalesOrderThreshold\\Persistence\\SpySalesOrderThresholdType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_threshold_type',
    1 => ':id_sales_order_threshold_type',
  ),
), null, null, null, false);
        $this->addRelation('Currency', '\\Orm\\Zed\\Currency\\Persistence\\SpyCurrency', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_currency',
    1 => ':id_currency',
  ),
), null, null, null, false);
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantRelationshipSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantRelationshipSalesOrderThresholdTableMap::CLASS_DEFAULT : SpyMerchantRelationshipSalesOrderThresholdTableMap::OM_CLASS;
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
     * @return array (SpyMerchantRelationshipSalesOrderThreshold object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantRelationshipSalesOrderThresholdTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantRelationshipSalesOrderThresholdTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantRelationshipSalesOrderThresholdTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantRelationshipSalesOrderThresholdTableMap::OM_CLASS;
            /** @var SpyMerchantRelationshipSalesOrderThreshold $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantRelationshipSalesOrderThresholdTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantRelationshipSalesOrderThresholdTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantRelationshipSalesOrderThresholdTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantRelationshipSalesOrderThreshold $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantRelationshipSalesOrderThresholdTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_relationship_sales_order_threshold');
            $criteria->addSelectColumn($alias . '.fk_currency');
            $criteria->addSelectColumn($alias . '.fk_merchant_relationship');
            $criteria->addSelectColumn($alias . '.fk_sales_order_threshold_type');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.fee');
            $criteria->addSelectColumn($alias . '.message_glossary_key');
            $criteria->addSelectColumn($alias . '.threshold');
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
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_MERCHANT_RELATIONSHIP);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_FEE);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_THRESHOLD);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_relationship_sales_order_threshold');
            $criteria->removeSelectColumn($alias . '.fk_currency');
            $criteria->removeSelectColumn($alias . '.fk_merchant_relationship');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_threshold_type');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.fee');
            $criteria->removeSelectColumn($alias . '.message_glossary_key');
            $criteria->removeSelectColumn($alias . '.threshold');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME)->getTable(SpyMerchantRelationshipSalesOrderThresholdTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantRelationshipSalesOrderThreshold or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantRelationshipSalesOrderThreshold object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantRelationshipSalesOrderThreshold\Persistence\SpyMerchantRelationshipSalesOrderThreshold) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantRelationshipSalesOrderThresholdTableMap::COL_ID_MERCHANT_RELATIONSHIP_SALES_ORDER_THRESHOLD, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantRelationshipSalesOrderThresholdQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantRelationshipSalesOrderThresholdTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantRelationshipSalesOrderThresholdTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_relationship_sales_order_threshold table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantRelationshipSalesOrderThresholdQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantRelationshipSalesOrderThreshold or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantRelationshipSalesOrderThreshold object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationshipSalesOrderThresholdTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantRelationshipSalesOrderThreshold object
        }


        // Set the correct dbName
        $query = SpyMerchantRelationshipSalesOrderThresholdQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
