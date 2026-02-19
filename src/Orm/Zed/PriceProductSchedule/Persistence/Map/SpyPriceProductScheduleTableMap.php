<?php

namespace Orm\Zed\PriceProductSchedule\Persistence\Map;

use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery;
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
 * This class defines the structure of the 'spy_price_product_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductSchedule.Persistence.Map.SpyPriceProductScheduleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_schedule';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductSchedule';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductSchedule.Persistence.SpyPriceProductSchedule';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id_price_product_schedule field
     */
    public const COL_ID_PRICE_PRODUCT_SCHEDULE = 'spy_price_product_schedule.id_price_product_schedule';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_price_product_schedule.fk_currency';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_price_product_schedule.fk_store';

    /**
     * the column name for the fk_price_type field
     */
    public const COL_FK_PRICE_TYPE = 'spy_price_product_schedule.fk_price_type';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_price_product_schedule.fk_product';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_price_product_schedule.fk_product_abstract';

    /**
     * the column name for the fk_price_product_schedule_list field
     */
    public const COL_FK_PRICE_PRODUCT_SCHEDULE_LIST = 'spy_price_product_schedule.fk_price_product_schedule_list';

    /**
     * the column name for the net_price field
     */
    public const COL_NET_PRICE = 'spy_price_product_schedule.net_price';

    /**
     * the column name for the gross_price field
     */
    public const COL_GROSS_PRICE = 'spy_price_product_schedule.gross_price';

    /**
     * the column name for the price_data field
     */
    public const COL_PRICE_DATA = 'spy_price_product_schedule.price_data';

    /**
     * the column name for the active_from field
     */
    public const COL_ACTIVE_FROM = 'spy_price_product_schedule.active_from';

    /**
     * the column name for the active_to field
     */
    public const COL_ACTIVE_TO = 'spy_price_product_schedule.active_to';

    /**
     * the column name for the is_current field
     */
    public const COL_IS_CURRENT = 'spy_price_product_schedule.is_current';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_price_product_schedule.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_price_product_schedule.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPriceProductSchedule', 'FkCurrency', 'FkStore', 'FkPriceType', 'FkProduct', 'FkProductAbstract', 'FkPriceProductScheduleList', 'NetPrice', 'GrossPrice', 'PriceData', 'ActiveFrom', 'ActiveTo', 'IsCurrent', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPriceProductSchedule', 'fkCurrency', 'fkStore', 'fkPriceType', 'fkProduct', 'fkProductAbstract', 'fkPriceProductScheduleList', 'netPrice', 'grossPrice', 'priceData', 'activeFrom', 'activeTo', 'isCurrent', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE, SpyPriceProductScheduleTableMap::COL_FK_CURRENCY, SpyPriceProductScheduleTableMap::COL_FK_STORE, SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE, SpyPriceProductScheduleTableMap::COL_FK_PRODUCT, SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT, SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST, SpyPriceProductScheduleTableMap::COL_NET_PRICE, SpyPriceProductScheduleTableMap::COL_GROSS_PRICE, SpyPriceProductScheduleTableMap::COL_PRICE_DATA, SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM, SpyPriceProductScheduleTableMap::COL_ACTIVE_TO, SpyPriceProductScheduleTableMap::COL_IS_CURRENT, SpyPriceProductScheduleTableMap::COL_CREATED_AT, SpyPriceProductScheduleTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_price_product_schedule', 'fk_currency', 'fk_store', 'fk_price_type', 'fk_product', 'fk_product_abstract', 'fk_price_product_schedule_list', 'net_price', 'gross_price', 'price_data', 'active_from', 'active_to', 'is_current', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
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
        self::TYPE_PHPNAME       => ['IdPriceProductSchedule' => 0, 'FkCurrency' => 1, 'FkStore' => 2, 'FkPriceType' => 3, 'FkProduct' => 4, 'FkProductAbstract' => 5, 'FkPriceProductScheduleList' => 6, 'NetPrice' => 7, 'GrossPrice' => 8, 'PriceData' => 9, 'ActiveFrom' => 10, 'ActiveTo' => 11, 'IsCurrent' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ],
        self::TYPE_CAMELNAME     => ['idPriceProductSchedule' => 0, 'fkCurrency' => 1, 'fkStore' => 2, 'fkPriceType' => 3, 'fkProduct' => 4, 'fkProductAbstract' => 5, 'fkPriceProductScheduleList' => 6, 'netPrice' => 7, 'grossPrice' => 8, 'priceData' => 9, 'activeFrom' => 10, 'activeTo' => 11, 'isCurrent' => 12, 'createdAt' => 13, 'updatedAt' => 14, ],
        self::TYPE_COLNAME       => [SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE => 0, SpyPriceProductScheduleTableMap::COL_FK_CURRENCY => 1, SpyPriceProductScheduleTableMap::COL_FK_STORE => 2, SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE => 3, SpyPriceProductScheduleTableMap::COL_FK_PRODUCT => 4, SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT => 5, SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST => 6, SpyPriceProductScheduleTableMap::COL_NET_PRICE => 7, SpyPriceProductScheduleTableMap::COL_GROSS_PRICE => 8, SpyPriceProductScheduleTableMap::COL_PRICE_DATA => 9, SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM => 10, SpyPriceProductScheduleTableMap::COL_ACTIVE_TO => 11, SpyPriceProductScheduleTableMap::COL_IS_CURRENT => 12, SpyPriceProductScheduleTableMap::COL_CREATED_AT => 13, SpyPriceProductScheduleTableMap::COL_UPDATED_AT => 14, ],
        self::TYPE_FIELDNAME     => ['id_price_product_schedule' => 0, 'fk_currency' => 1, 'fk_store' => 2, 'fk_price_type' => 3, 'fk_product' => 4, 'fk_product_abstract' => 5, 'fk_price_product_schedule_list' => 6, 'net_price' => 7, 'gross_price' => 8, 'price_data' => 9, 'active_from' => 10, 'active_to' => 11, 'is_current' => 12, 'created_at' => 13, 'updated_at' => 14, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductSchedule' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'SpyPriceProductSchedule.IdPriceProductSchedule' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'idPriceProductSchedule' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'spyPriceProductSchedule.idPriceProductSchedule' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'COL_ID_PRICE_PRODUCT_SCHEDULE' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'id_price_product_schedule' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'spy_price_product_schedule.id_price_product_schedule' => 'ID_PRICE_PRODUCT_SCHEDULE',
        'FkCurrency' => 'FK_CURRENCY',
        'SpyPriceProductSchedule.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spyPriceProductSchedule.fkCurrency' => 'FK_CURRENCY',
        'SpyPriceProductScheduleTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_price_product_schedule.fk_currency' => 'FK_CURRENCY',
        'FkStore' => 'FK_STORE',
        'SpyPriceProductSchedule.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyPriceProductSchedule.fkStore' => 'FK_STORE',
        'SpyPriceProductScheduleTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_price_product_schedule.fk_store' => 'FK_STORE',
        'FkPriceType' => 'FK_PRICE_TYPE',
        'SpyPriceProductSchedule.FkPriceType' => 'FK_PRICE_TYPE',
        'fkPriceType' => 'FK_PRICE_TYPE',
        'spyPriceProductSchedule.fkPriceType' => 'FK_PRICE_TYPE',
        'SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE' => 'FK_PRICE_TYPE',
        'COL_FK_PRICE_TYPE' => 'FK_PRICE_TYPE',
        'fk_price_type' => 'FK_PRICE_TYPE',
        'spy_price_product_schedule.fk_price_type' => 'FK_PRICE_TYPE',
        'FkProduct' => 'FK_PRODUCT',
        'SpyPriceProductSchedule.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyPriceProductSchedule.fkProduct' => 'FK_PRODUCT',
        'SpyPriceProductScheduleTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_price_product_schedule.fk_product' => 'FK_PRODUCT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductSchedule.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyPriceProductSchedule.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_price_product_schedule.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkPriceProductScheduleList' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'SpyPriceProductSchedule.FkPriceProductScheduleList' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'fkPriceProductScheduleList' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'spyPriceProductSchedule.fkPriceProductScheduleList' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'COL_FK_PRICE_PRODUCT_SCHEDULE_LIST' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'fk_price_product_schedule_list' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'spy_price_product_schedule.fk_price_product_schedule_list' => 'FK_PRICE_PRODUCT_SCHEDULE_LIST',
        'NetPrice' => 'NET_PRICE',
        'SpyPriceProductSchedule.NetPrice' => 'NET_PRICE',
        'netPrice' => 'NET_PRICE',
        'spyPriceProductSchedule.netPrice' => 'NET_PRICE',
        'SpyPriceProductScheduleTableMap::COL_NET_PRICE' => 'NET_PRICE',
        'COL_NET_PRICE' => 'NET_PRICE',
        'net_price' => 'NET_PRICE',
        'spy_price_product_schedule.net_price' => 'NET_PRICE',
        'GrossPrice' => 'GROSS_PRICE',
        'SpyPriceProductSchedule.GrossPrice' => 'GROSS_PRICE',
        'grossPrice' => 'GROSS_PRICE',
        'spyPriceProductSchedule.grossPrice' => 'GROSS_PRICE',
        'SpyPriceProductScheduleTableMap::COL_GROSS_PRICE' => 'GROSS_PRICE',
        'COL_GROSS_PRICE' => 'GROSS_PRICE',
        'gross_price' => 'GROSS_PRICE',
        'spy_price_product_schedule.gross_price' => 'GROSS_PRICE',
        'PriceData' => 'PRICE_DATA',
        'SpyPriceProductSchedule.PriceData' => 'PRICE_DATA',
        'priceData' => 'PRICE_DATA',
        'spyPriceProductSchedule.priceData' => 'PRICE_DATA',
        'SpyPriceProductScheduleTableMap::COL_PRICE_DATA' => 'PRICE_DATA',
        'COL_PRICE_DATA' => 'PRICE_DATA',
        'price_data' => 'PRICE_DATA',
        'spy_price_product_schedule.price_data' => 'PRICE_DATA',
        'ActiveFrom' => 'ACTIVE_FROM',
        'SpyPriceProductSchedule.ActiveFrom' => 'ACTIVE_FROM',
        'activeFrom' => 'ACTIVE_FROM',
        'spyPriceProductSchedule.activeFrom' => 'ACTIVE_FROM',
        'SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM' => 'ACTIVE_FROM',
        'COL_ACTIVE_FROM' => 'ACTIVE_FROM',
        'active_from' => 'ACTIVE_FROM',
        'spy_price_product_schedule.active_from' => 'ACTIVE_FROM',
        'ActiveTo' => 'ACTIVE_TO',
        'SpyPriceProductSchedule.ActiveTo' => 'ACTIVE_TO',
        'activeTo' => 'ACTIVE_TO',
        'spyPriceProductSchedule.activeTo' => 'ACTIVE_TO',
        'SpyPriceProductScheduleTableMap::COL_ACTIVE_TO' => 'ACTIVE_TO',
        'COL_ACTIVE_TO' => 'ACTIVE_TO',
        'active_to' => 'ACTIVE_TO',
        'spy_price_product_schedule.active_to' => 'ACTIVE_TO',
        'IsCurrent' => 'IS_CURRENT',
        'SpyPriceProductSchedule.IsCurrent' => 'IS_CURRENT',
        'isCurrent' => 'IS_CURRENT',
        'spyPriceProductSchedule.isCurrent' => 'IS_CURRENT',
        'SpyPriceProductScheduleTableMap::COL_IS_CURRENT' => 'IS_CURRENT',
        'COL_IS_CURRENT' => 'IS_CURRENT',
        'is_current' => 'IS_CURRENT',
        'spy_price_product_schedule.is_current' => 'IS_CURRENT',
        'CreatedAt' => 'CREATED_AT',
        'SpyPriceProductSchedule.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPriceProductSchedule.createdAt' => 'CREATED_AT',
        'SpyPriceProductScheduleTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_price_product_schedule.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPriceProductSchedule.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPriceProductSchedule.updatedAt' => 'UPDATED_AT',
        'SpyPriceProductScheduleTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_price_product_schedule.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_price_product_schedule');
        $this->setPhpName('SpyPriceProductSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule');
        $this->setPackage('src.Orm.Zed.PriceProductSchedule.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_schedule_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_schedule', 'IdPriceProductSchedule', 'BIGINT', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', true, null, null);
        $this->addForeignKey('fk_price_type', 'FkPriceType', 'INTEGER', 'spy_price_type', 'id_price_type', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', false, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', false, null, null);
        $this->addForeignKey('fk_price_product_schedule_list', 'FkPriceProductScheduleList', 'BIGINT', 'spy_price_product_schedule_list', 'id_price_product_schedule_list', true, null, null);
        $this->addColumn('net_price', 'NetPrice', 'INTEGER', false, null, null);
        $this->addColumn('gross_price', 'GrossPrice', 'INTEGER', false, null, null);
        $this->addColumn('price_data', 'PriceData', 'LONGVARCHAR', false, null, null);
        $this->addColumn('active_from', 'ActiveFrom', 'TIMESTAMP', true, null, null);
        $this->addColumn('active_to', 'ActiveTo', 'TIMESTAMP', true, null, null);
        $this->addColumn('is_current', 'IsCurrent', 'BOOLEAN', true, 1, false);
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
        $this->addRelation('Product', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('ProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
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
        $this->addRelation('PriceType', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_type',
    1 => ':id_price_type',
  ),
), null, null, null, false);
        $this->addRelation('PriceProductScheduleList', '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductScheduleList', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_product_schedule_list',
    1 => ':id_price_product_schedule_list',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdPriceProductSchedule', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductScheduleTableMap::CLASS_DEFAULT : SpyPriceProductScheduleTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductSchedule object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductScheduleTableMap::OM_CLASS;
            /** @var SpyPriceProductSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_NET_PRICE);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_GROSS_PRICE);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_PRICE_DATA);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_ACTIVE_TO);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_IS_CURRENT);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPriceProductScheduleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_schedule');
            $criteria->addSelectColumn($alias . '.fk_currency');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.fk_price_type');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_price_product_schedule_list');
            $criteria->addSelectColumn($alias . '.net_price');
            $criteria->addSelectColumn($alias . '.gross_price');
            $criteria->addSelectColumn($alias . '.price_data');
            $criteria->addSelectColumn($alias . '.active_from');
            $criteria->addSelectColumn($alias . '.active_to');
            $criteria->addSelectColumn($alias . '.is_current');
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
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRICE_TYPE);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_FK_PRICE_PRODUCT_SCHEDULE_LIST);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_NET_PRICE);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_GROSS_PRICE);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_PRICE_DATA);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_ACTIVE_FROM);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_ACTIVE_TO);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_IS_CURRENT);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPriceProductScheduleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_schedule');
            $criteria->removeSelectColumn($alias . '.fk_currency');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.fk_price_type');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_price_product_schedule_list');
            $criteria->removeSelectColumn($alias . '.net_price');
            $criteria->removeSelectColumn($alias . '.gross_price');
            $criteria->removeSelectColumn($alias . '.price_data');
            $criteria->removeSelectColumn($alias . '.active_from');
            $criteria->removeSelectColumn($alias . '.active_to');
            $criteria->removeSelectColumn($alias . '.is_current');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductScheduleTableMap::DATABASE_NAME)->getTable(SpyPriceProductScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductSchedule or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductScheduleTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductSchedule or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductSchedule object
        }

        if ($criteria->containsKey(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE) && $criteria->keyContainsValue(SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductScheduleTableMap::COL_ID_PRICE_PRODUCT_SCHEDULE.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
