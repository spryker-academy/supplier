<?php

namespace Orm\Zed\PriceProduct\Persistence\Map;

use Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery;
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
 * This class defines the structure of the 'spy_price_product_store' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductStoreTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProduct.Persistence.Map.SpyPriceProductStoreTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_store';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductStore';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductStore';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProduct.Persistence.SpyPriceProductStore';

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
     * the column name for the id_price_product_store field
     */
    public const COL_ID_PRICE_PRODUCT_STORE = 'spy_price_product_store.id_price_product_store';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_price_product_store.fk_currency';

    /**
     * the column name for the fk_price_product field
     */
    public const COL_FK_PRICE_PRODUCT = 'spy_price_product_store.fk_price_product';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_price_product_store.fk_store';

    /**
     * the column name for the gross_price field
     */
    public const COL_GROSS_PRICE = 'spy_price_product_store.gross_price';

    /**
     * the column name for the net_price field
     */
    public const COL_NET_PRICE = 'spy_price_product_store.net_price';

    /**
     * the column name for the price_data field
     */
    public const COL_PRICE_DATA = 'spy_price_product_store.price_data';

    /**
     * the column name for the price_data_checksum field
     */
    public const COL_PRICE_DATA_CHECKSUM = 'spy_price_product_store.price_data_checksum';

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
        self::TYPE_PHPNAME       => ['IdPriceProductStore', 'FkCurrency', 'FkPriceProduct', 'FkStore', 'GrossPrice', 'NetPrice', 'PriceData', 'PriceDataChecksum', ],
        self::TYPE_CAMELNAME     => ['idPriceProductStore', 'fkCurrency', 'fkPriceProduct', 'fkStore', 'grossPrice', 'netPrice', 'priceData', 'priceDataChecksum', ],
        self::TYPE_COLNAME       => [SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE, SpyPriceProductStoreTableMap::COL_FK_CURRENCY, SpyPriceProductStoreTableMap::COL_FK_PRICE_PRODUCT, SpyPriceProductStoreTableMap::COL_FK_STORE, SpyPriceProductStoreTableMap::COL_GROSS_PRICE, SpyPriceProductStoreTableMap::COL_NET_PRICE, SpyPriceProductStoreTableMap::COL_PRICE_DATA, SpyPriceProductStoreTableMap::COL_PRICE_DATA_CHECKSUM, ],
        self::TYPE_FIELDNAME     => ['id_price_product_store', 'fk_currency', 'fk_price_product', 'fk_store', 'gross_price', 'net_price', 'price_data', 'price_data_checksum', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductStore' => 0, 'FkCurrency' => 1, 'FkPriceProduct' => 2, 'FkStore' => 3, 'GrossPrice' => 4, 'NetPrice' => 5, 'PriceData' => 6, 'PriceDataChecksum' => 7, ],
        self::TYPE_CAMELNAME     => ['idPriceProductStore' => 0, 'fkCurrency' => 1, 'fkPriceProduct' => 2, 'fkStore' => 3, 'grossPrice' => 4, 'netPrice' => 5, 'priceData' => 6, 'priceDataChecksum' => 7, ],
        self::TYPE_COLNAME       => [SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE => 0, SpyPriceProductStoreTableMap::COL_FK_CURRENCY => 1, SpyPriceProductStoreTableMap::COL_FK_PRICE_PRODUCT => 2, SpyPriceProductStoreTableMap::COL_FK_STORE => 3, SpyPriceProductStoreTableMap::COL_GROSS_PRICE => 4, SpyPriceProductStoreTableMap::COL_NET_PRICE => 5, SpyPriceProductStoreTableMap::COL_PRICE_DATA => 6, SpyPriceProductStoreTableMap::COL_PRICE_DATA_CHECKSUM => 7, ],
        self::TYPE_FIELDNAME     => ['id_price_product_store' => 0, 'fk_currency' => 1, 'fk_price_product' => 2, 'fk_store' => 3, 'gross_price' => 4, 'net_price' => 5, 'price_data' => 6, 'price_data_checksum' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductStore' => 'ID_PRICE_PRODUCT_STORE',
        'SpyPriceProductStore.IdPriceProductStore' => 'ID_PRICE_PRODUCT_STORE',
        'idPriceProductStore' => 'ID_PRICE_PRODUCT_STORE',
        'spyPriceProductStore.idPriceProductStore' => 'ID_PRICE_PRODUCT_STORE',
        'SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE' => 'ID_PRICE_PRODUCT_STORE',
        'COL_ID_PRICE_PRODUCT_STORE' => 'ID_PRICE_PRODUCT_STORE',
        'id_price_product_store' => 'ID_PRICE_PRODUCT_STORE',
        'spy_price_product_store.id_price_product_store' => 'ID_PRICE_PRODUCT_STORE',
        'FkCurrency' => 'FK_CURRENCY',
        'SpyPriceProductStore.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spyPriceProductStore.fkCurrency' => 'FK_CURRENCY',
        'SpyPriceProductStoreTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_price_product_store.fk_currency' => 'FK_CURRENCY',
        'FkPriceProduct' => 'FK_PRICE_PRODUCT',
        'SpyPriceProductStore.FkPriceProduct' => 'FK_PRICE_PRODUCT',
        'fkPriceProduct' => 'FK_PRICE_PRODUCT',
        'spyPriceProductStore.fkPriceProduct' => 'FK_PRICE_PRODUCT',
        'SpyPriceProductStoreTableMap::COL_FK_PRICE_PRODUCT' => 'FK_PRICE_PRODUCT',
        'COL_FK_PRICE_PRODUCT' => 'FK_PRICE_PRODUCT',
        'fk_price_product' => 'FK_PRICE_PRODUCT',
        'spy_price_product_store.fk_price_product' => 'FK_PRICE_PRODUCT',
        'FkStore' => 'FK_STORE',
        'SpyPriceProductStore.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyPriceProductStore.fkStore' => 'FK_STORE',
        'SpyPriceProductStoreTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_price_product_store.fk_store' => 'FK_STORE',
        'GrossPrice' => 'GROSS_PRICE',
        'SpyPriceProductStore.GrossPrice' => 'GROSS_PRICE',
        'grossPrice' => 'GROSS_PRICE',
        'spyPriceProductStore.grossPrice' => 'GROSS_PRICE',
        'SpyPriceProductStoreTableMap::COL_GROSS_PRICE' => 'GROSS_PRICE',
        'COL_GROSS_PRICE' => 'GROSS_PRICE',
        'gross_price' => 'GROSS_PRICE',
        'spy_price_product_store.gross_price' => 'GROSS_PRICE',
        'NetPrice' => 'NET_PRICE',
        'SpyPriceProductStore.NetPrice' => 'NET_PRICE',
        'netPrice' => 'NET_PRICE',
        'spyPriceProductStore.netPrice' => 'NET_PRICE',
        'SpyPriceProductStoreTableMap::COL_NET_PRICE' => 'NET_PRICE',
        'COL_NET_PRICE' => 'NET_PRICE',
        'net_price' => 'NET_PRICE',
        'spy_price_product_store.net_price' => 'NET_PRICE',
        'PriceData' => 'PRICE_DATA',
        'SpyPriceProductStore.PriceData' => 'PRICE_DATA',
        'priceData' => 'PRICE_DATA',
        'spyPriceProductStore.priceData' => 'PRICE_DATA',
        'SpyPriceProductStoreTableMap::COL_PRICE_DATA' => 'PRICE_DATA',
        'COL_PRICE_DATA' => 'PRICE_DATA',
        'price_data' => 'PRICE_DATA',
        'spy_price_product_store.price_data' => 'PRICE_DATA',
        'PriceDataChecksum' => 'PRICE_DATA_CHECKSUM',
        'SpyPriceProductStore.PriceDataChecksum' => 'PRICE_DATA_CHECKSUM',
        'priceDataChecksum' => 'PRICE_DATA_CHECKSUM',
        'spyPriceProductStore.priceDataChecksum' => 'PRICE_DATA_CHECKSUM',
        'SpyPriceProductStoreTableMap::COL_PRICE_DATA_CHECKSUM' => 'PRICE_DATA_CHECKSUM',
        'COL_PRICE_DATA_CHECKSUM' => 'PRICE_DATA_CHECKSUM',
        'price_data_checksum' => 'PRICE_DATA_CHECKSUM',
        'spy_price_product_store.price_data_checksum' => 'PRICE_DATA_CHECKSUM',
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
        $this->setName('spy_price_product_store');
        $this->setPhpName('SpyPriceProductStore');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductStore');
        $this->setPackage('src.Orm.Zed.PriceProduct.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_store_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_store', 'IdPriceProductStore', 'BIGINT', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
        $this->addForeignKey('fk_price_product', 'FkPriceProduct', 'INTEGER', 'spy_price_product', 'id_price_product', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', false, null, null);
        $this->addColumn('gross_price', 'GrossPrice', 'INTEGER', false, null, null);
        $this->addColumn('net_price', 'NetPrice', 'INTEGER', false, null, null);
        $this->addColumn('price_data', 'PriceData', 'LONGVARCHAR', false, null, null);
        $this->addColumn('price_data_checksum', 'PriceDataChecksum', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        $this->addRelation('PriceProduct', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_product',
    1 => ':id_price_product',
  ),
), null, null, null, false);
        $this->addRelation('PriceProductDefault', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductDefault', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_product_store',
    1 => ':id_price_product_store',
  ),
), 'CASCADE', null, 'PriceProductDefaults', false);
        $this->addRelation('PriceProductMerchantRelationship', '\\Orm\\Zed\\PriceProductMerchantRelationship\\Persistence\\SpyPriceProductMerchantRelationship', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_product_store',
    1 => ':id_price_product_store',
  ),
), null, null, 'PriceProductMerchantRelationships', false);
        $this->addRelation('SpyPriceProductOffer', '\\Orm\\Zed\\PriceProductOffer\\Persistence\\SpyPriceProductOffer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_price_product_store',
    1 => ':id_price_product_store',
  ),
), null, null, 'SpyPriceProductOffers', false);
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
            'event' => ['spy_price_product_store_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_price_product_store     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyPriceProductDefaultTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductStore', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductStoreTableMap::CLASS_DEFAULT : SpyPriceProductStoreTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductStore object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductStoreTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductStoreTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductStoreTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductStoreTableMap::OM_CLASS;
            /** @var SpyPriceProductStore $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductStoreTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductStoreTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductStoreTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductStore $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductStoreTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_FK_PRICE_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_GROSS_PRICE);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_NET_PRICE);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_PRICE_DATA);
            $criteria->addSelectColumn(SpyPriceProductStoreTableMap::COL_PRICE_DATA_CHECKSUM);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_store');
            $criteria->addSelectColumn($alias . '.fk_currency');
            $criteria->addSelectColumn($alias . '.fk_price_product');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.gross_price');
            $criteria->addSelectColumn($alias . '.net_price');
            $criteria->addSelectColumn($alias . '.price_data');
            $criteria->addSelectColumn($alias . '.price_data_checksum');
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
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_FK_PRICE_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_GROSS_PRICE);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_NET_PRICE);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_PRICE_DATA);
            $criteria->removeSelectColumn(SpyPriceProductStoreTableMap::COL_PRICE_DATA_CHECKSUM);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_store');
            $criteria->removeSelectColumn($alias . '.fk_currency');
            $criteria->removeSelectColumn($alias . '.fk_price_product');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.gross_price');
            $criteria->removeSelectColumn($alias . '.net_price');
            $criteria->removeSelectColumn($alias . '.price_data');
            $criteria->removeSelectColumn($alias . '.price_data_checksum');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductStoreTableMap::DATABASE_NAME)->getTable(SpyPriceProductStoreTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductStore or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductStore object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductStoreTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProduct\Persistence\SpyPriceProductStore) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductStoreTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductStoreQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductStoreTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductStoreTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_store table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductStoreQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductStore or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductStore object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductStoreTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductStore object
        }

        if ($criteria->containsKey(SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE) && $criteria->keyContainsValue(SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductStoreTableMap::COL_ID_PRICE_PRODUCT_STORE.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductStoreQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
