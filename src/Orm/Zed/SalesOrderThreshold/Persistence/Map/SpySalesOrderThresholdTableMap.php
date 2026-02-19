<?php

namespace Orm\Zed\SalesOrderThreshold\Persistence\Map;

use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold;
use Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThresholdQuery;
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
 * This class defines the structure of the 'spy_sales_order_threshold' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderThresholdTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesOrderThreshold.Persistence.Map.SpySalesOrderThresholdTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_threshold';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderThreshold';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesOrderThreshold\\Persistence\\SpySalesOrderThreshold';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesOrderThreshold.Persistence.SpySalesOrderThreshold';

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
     * the column name for the id_sales_order_threshold field
     */
    public const COL_ID_SALES_ORDER_THRESHOLD = 'spy_sales_order_threshold.id_sales_order_threshold';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_sales_order_threshold.fk_currency';

    /**
     * the column name for the fk_sales_order_threshold_type field
     */
    public const COL_FK_SALES_ORDER_THRESHOLD_TYPE = 'spy_sales_order_threshold.fk_sales_order_threshold_type';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_sales_order_threshold.fk_store';

    /**
     * the column name for the fee field
     */
    public const COL_FEE = 'spy_sales_order_threshold.fee';

    /**
     * the column name for the message_glossary_key field
     */
    public const COL_MESSAGE_GLOSSARY_KEY = 'spy_sales_order_threshold.message_glossary_key';

    /**
     * the column name for the threshold field
     */
    public const COL_THRESHOLD = 'spy_sales_order_threshold.threshold';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_threshold.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_threshold.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderThreshold', 'FkCurrency', 'FkSalesOrderThresholdType', 'FkStore', 'Fee', 'MessageGlossaryKey', 'Threshold', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderThreshold', 'fkCurrency', 'fkSalesOrderThresholdType', 'fkStore', 'fee', 'messageGlossaryKey', 'threshold', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderThresholdTableMap::COL_ID_SALES_ORDER_THRESHOLD, SpySalesOrderThresholdTableMap::COL_FK_CURRENCY, SpySalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE, SpySalesOrderThresholdTableMap::COL_FK_STORE, SpySalesOrderThresholdTableMap::COL_FEE, SpySalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY, SpySalesOrderThresholdTableMap::COL_THRESHOLD, SpySalesOrderThresholdTableMap::COL_CREATED_AT, SpySalesOrderThresholdTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_threshold', 'fk_currency', 'fk_sales_order_threshold_type', 'fk_store', 'fee', 'message_glossary_key', 'threshold', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderThreshold' => 0, 'FkCurrency' => 1, 'FkSalesOrderThresholdType' => 2, 'FkStore' => 3, 'Fee' => 4, 'MessageGlossaryKey' => 5, 'Threshold' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderThreshold' => 0, 'fkCurrency' => 1, 'fkSalesOrderThresholdType' => 2, 'fkStore' => 3, 'fee' => 4, 'messageGlossaryKey' => 5, 'threshold' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpySalesOrderThresholdTableMap::COL_ID_SALES_ORDER_THRESHOLD => 0, SpySalesOrderThresholdTableMap::COL_FK_CURRENCY => 1, SpySalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE => 2, SpySalesOrderThresholdTableMap::COL_FK_STORE => 3, SpySalesOrderThresholdTableMap::COL_FEE => 4, SpySalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY => 5, SpySalesOrderThresholdTableMap::COL_THRESHOLD => 6, SpySalesOrderThresholdTableMap::COL_CREATED_AT => 7, SpySalesOrderThresholdTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_threshold' => 0, 'fk_currency' => 1, 'fk_sales_order_threshold_type' => 2, 'fk_store' => 3, 'fee' => 4, 'message_glossary_key' => 5, 'threshold' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderThreshold' => 'ID_SALES_ORDER_THRESHOLD',
        'SpySalesOrderThreshold.IdSalesOrderThreshold' => 'ID_SALES_ORDER_THRESHOLD',
        'idSalesOrderThreshold' => 'ID_SALES_ORDER_THRESHOLD',
        'spySalesOrderThreshold.idSalesOrderThreshold' => 'ID_SALES_ORDER_THRESHOLD',
        'SpySalesOrderThresholdTableMap::COL_ID_SALES_ORDER_THRESHOLD' => 'ID_SALES_ORDER_THRESHOLD',
        'COL_ID_SALES_ORDER_THRESHOLD' => 'ID_SALES_ORDER_THRESHOLD',
        'id_sales_order_threshold' => 'ID_SALES_ORDER_THRESHOLD',
        'spy_sales_order_threshold.id_sales_order_threshold' => 'ID_SALES_ORDER_THRESHOLD',
        'FkCurrency' => 'FK_CURRENCY',
        'SpySalesOrderThreshold.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spySalesOrderThreshold.fkCurrency' => 'FK_CURRENCY',
        'SpySalesOrderThresholdTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_sales_order_threshold.fk_currency' => 'FK_CURRENCY',
        'FkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'SpySalesOrderThreshold.FkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'fkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'spySalesOrderThreshold.fkSalesOrderThresholdType' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'SpySalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'COL_FK_SALES_ORDER_THRESHOLD_TYPE' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'fk_sales_order_threshold_type' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'spy_sales_order_threshold.fk_sales_order_threshold_type' => 'FK_SALES_ORDER_THRESHOLD_TYPE',
        'FkStore' => 'FK_STORE',
        'SpySalesOrderThreshold.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spySalesOrderThreshold.fkStore' => 'FK_STORE',
        'SpySalesOrderThresholdTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_sales_order_threshold.fk_store' => 'FK_STORE',
        'Fee' => 'FEE',
        'SpySalesOrderThreshold.Fee' => 'FEE',
        'fee' => 'FEE',
        'spySalesOrderThreshold.fee' => 'FEE',
        'SpySalesOrderThresholdTableMap::COL_FEE' => 'FEE',
        'COL_FEE' => 'FEE',
        'spy_sales_order_threshold.fee' => 'FEE',
        'MessageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'SpySalesOrderThreshold.MessageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'messageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'spySalesOrderThreshold.messageGlossaryKey' => 'MESSAGE_GLOSSARY_KEY',
        'SpySalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY' => 'MESSAGE_GLOSSARY_KEY',
        'COL_MESSAGE_GLOSSARY_KEY' => 'MESSAGE_GLOSSARY_KEY',
        'message_glossary_key' => 'MESSAGE_GLOSSARY_KEY',
        'spy_sales_order_threshold.message_glossary_key' => 'MESSAGE_GLOSSARY_KEY',
        'Threshold' => 'THRESHOLD',
        'SpySalesOrderThreshold.Threshold' => 'THRESHOLD',
        'threshold' => 'THRESHOLD',
        'spySalesOrderThreshold.threshold' => 'THRESHOLD',
        'SpySalesOrderThresholdTableMap::COL_THRESHOLD' => 'THRESHOLD',
        'COL_THRESHOLD' => 'THRESHOLD',
        'spy_sales_order_threshold.threshold' => 'THRESHOLD',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderThreshold.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderThreshold.createdAt' => 'CREATED_AT',
        'SpySalesOrderThresholdTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_threshold.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderThreshold.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderThreshold.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderThresholdTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_threshold.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_threshold');
        $this->setPhpName('SpySalesOrderThreshold');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\SalesOrderThreshold\\Persistence\\SpySalesOrderThreshold');
        $this->setPackage('src.Orm.Zed.SalesOrderThreshold.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_sales_order_threshold_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_threshold', 'IdSalesOrderThreshold', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderThreshold', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderThresholdTableMap::CLASS_DEFAULT : SpySalesOrderThresholdTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderThreshold object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderThresholdTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderThresholdTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderThresholdTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderThresholdTableMap::OM_CLASS;
            /** @var SpySalesOrderThreshold $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderThresholdTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderThresholdTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderThresholdTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderThreshold $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderThresholdTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_ID_SALES_ORDER_THRESHOLD);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_FEE);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_THRESHOLD);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderThresholdTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_threshold');
            $criteria->addSelectColumn($alias . '.fk_currency');
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
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_ID_SALES_ORDER_THRESHOLD);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_FK_SALES_ORDER_THRESHOLD_TYPE);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_FEE);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_MESSAGE_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_THRESHOLD);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderThresholdTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_threshold');
            $criteria->removeSelectColumn($alias . '.fk_currency');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderThresholdTableMap::DATABASE_NAME)->getTable(SpySalesOrderThresholdTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderThreshold or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderThreshold object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderThresholdTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesOrderThreshold\Persistence\SpySalesOrderThreshold) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderThresholdTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderThresholdTableMap::COL_ID_SALES_ORDER_THRESHOLD, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderThresholdQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderThresholdTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderThresholdTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_threshold table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderThresholdQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderThreshold or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderThreshold object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderThresholdTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderThreshold object
        }


        // Set the correct dbName
        $query = SpySalesOrderThresholdQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
