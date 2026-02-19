<?php

namespace Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\Map;

use Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\SpyPriceProductConcreteMerchantRelationshipStorage;
use Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\SpyPriceProductConcreteMerchantRelationshipStorageQuery;
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
 * This class defines the structure of the 'spy_price_product_concrete_merchant_relationship_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductConcreteMerchantRelationshipStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductMerchantRelationshipStorage.Persistence.Map.SpyPriceProductConcreteMerchantRelationshipStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_concrete_merchant_relationship_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductConcreteMerchantRelationshipStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductMerchantRelationshipStorage\\Persistence\\SpyPriceProductConcreteMerchantRelationshipStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductMerchantRelationshipStorage.Persistence.SpyPriceProductConcreteMerchantRelationshipStorage';

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
     * the column name for the id_price_product_concrete_merchant_relationship_storage field
     */
    public const COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE = 'spy_price_product_concrete_merchant_relationship_storage.id_price_product_concrete_merchant_relationship_storage';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_price_product_concrete_merchant_relationship_storage.key';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_price_product_concrete_merchant_relationship_storage.fk_product';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_price_product_concrete_merchant_relationship_storage.fk_company_business_unit';

    /**
     * the column name for the price_key field
     */
    public const COL_PRICE_KEY = 'spy_price_product_concrete_merchant_relationship_storage.price_key';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_price_product_concrete_merchant_relationship_storage.data';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_price_product_concrete_merchant_relationship_storage.alias_keys';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_price_product_concrete_merchant_relationship_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_price_product_concrete_merchant_relationship_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPriceProductConcreteMerchantRelationshipStorage', 'Key', 'FkProduct', 'FkCompanyBusinessUnit', 'PriceKey', 'Data', 'AliasKeys', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPriceProductConcreteMerchantRelationshipStorage', 'key', 'fkProduct', 'fkCompanyBusinessUnit', 'priceKey', 'data', 'aliasKeys', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_KEY, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_PRODUCT, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_PRICE_KEY, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_DATA, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_CREATED_AT, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_price_product_concrete_merchant_relationship_storage', 'key', 'fk_product', 'fk_company_business_unit', 'price_key', 'data', 'alias_keys', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductConcreteMerchantRelationshipStorage' => 0, 'Key' => 1, 'FkProduct' => 2, 'FkCompanyBusinessUnit' => 3, 'PriceKey' => 4, 'Data' => 5, 'AliasKeys' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idPriceProductConcreteMerchantRelationshipStorage' => 0, 'key' => 1, 'fkProduct' => 2, 'fkCompanyBusinessUnit' => 3, 'priceKey' => 4, 'data' => 5, 'aliasKeys' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE => 0, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_KEY => 1, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_PRODUCT => 2, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 3, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_PRICE_KEY => 4, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_DATA => 5, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS => 6, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_CREATED_AT => 7, SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_price_product_concrete_merchant_relationship_storage' => 0, 'key' => 1, 'fk_product' => 2, 'fk_company_business_unit' => 3, 'price_key' => 4, 'data' => 5, 'alias_keys' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductConcreteMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'SpyPriceProductConcreteMerchantRelationshipStorage.IdPriceProductConcreteMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'idPriceProductConcreteMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'spyPriceProductConcreteMerchantRelationshipStorage.idPriceProductConcreteMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'id_price_product_concrete_merchant_relationship_storage' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'spy_price_product_concrete_merchant_relationship_storage.id_price_product_concrete_merchant_relationship_storage' => 'ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE',
        'Key' => 'KEY',
        'SpyPriceProductConcreteMerchantRelationshipStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyPriceProductConcreteMerchantRelationshipStorage.key' => 'KEY',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_price_product_concrete_merchant_relationship_storage.key' => 'KEY',
        'FkProduct' => 'FK_PRODUCT',
        'SpyPriceProductConcreteMerchantRelationshipStorage.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyPriceProductConcreteMerchantRelationshipStorage.fkProduct' => 'FK_PRODUCT',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_price_product_concrete_merchant_relationship_storage.fk_product' => 'FK_PRODUCT',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyPriceProductConcreteMerchantRelationshipStorage.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyPriceProductConcreteMerchantRelationshipStorage.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_price_product_concrete_merchant_relationship_storage.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'PriceKey' => 'PRICE_KEY',
        'SpyPriceProductConcreteMerchantRelationshipStorage.PriceKey' => 'PRICE_KEY',
        'priceKey' => 'PRICE_KEY',
        'spyPriceProductConcreteMerchantRelationshipStorage.priceKey' => 'PRICE_KEY',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_PRICE_KEY' => 'PRICE_KEY',
        'COL_PRICE_KEY' => 'PRICE_KEY',
        'price_key' => 'PRICE_KEY',
        'spy_price_product_concrete_merchant_relationship_storage.price_key' => 'PRICE_KEY',
        'Data' => 'DATA',
        'SpyPriceProductConcreteMerchantRelationshipStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyPriceProductConcreteMerchantRelationshipStorage.data' => 'DATA',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_price_product_concrete_merchant_relationship_storage.data' => 'DATA',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyPriceProductConcreteMerchantRelationshipStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyPriceProductConcreteMerchantRelationshipStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_price_product_concrete_merchant_relationship_storage.alias_keys' => 'ALIAS_KEYS',
        'CreatedAt' => 'CREATED_AT',
        'SpyPriceProductConcreteMerchantRelationshipStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPriceProductConcreteMerchantRelationshipStorage.createdAt' => 'CREATED_AT',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_price_product_concrete_merchant_relationship_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPriceProductConcreteMerchantRelationshipStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPriceProductConcreteMerchantRelationshipStorage.updatedAt' => 'UPDATED_AT',
        'SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_price_product_concrete_merchant_relationship_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_price_product_concrete_merchant_relationship_storage');
        $this->setPhpName('SpyPriceProductConcreteMerchantRelationshipStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\PriceProductMerchantRelationshipStorage\\Persistence\\SpyPriceProductConcreteMerchantRelationshipStorage');
        $this->setPackage('src.Orm.Zed.PriceProductMerchantRelationshipStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_concrete_merchant_relationship_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_concrete_merchant_relationship_storage', 'IdPriceProductConcreteMerchantRelationshipStorage', 'BIGINT', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('fk_product', 'FkProduct', 'INTEGER', true, null, null);
        $this->addColumn('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', true, null, null);
        $this->addColumn('price_key', 'PriceKey', 'VARCHAR', true, 1024, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        $this->addColumn('alias_keys', 'AliasKeys', 'VARCHAR', false, 255, null);
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
            'synchronization' => ['resource' => ['value' => 'price_product_concrete_merchant_relationship'], 'queue_group' => ['value' => 'sync.storage.price'], 'queue_pool' => NULL, 'key_suffix_column' => ['value' => 'price_key']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductConcreteMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductConcreteMerchantRelationshipStorageTableMap::CLASS_DEFAULT : SpyPriceProductConcreteMerchantRelationshipStorageTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductConcreteMerchantRelationshipStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductConcreteMerchantRelationshipStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductConcreteMerchantRelationshipStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductConcreteMerchantRelationshipStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductConcreteMerchantRelationshipStorageTableMap::OM_CLASS;
            /** @var SpyPriceProductConcreteMerchantRelationshipStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductConcreteMerchantRelationshipStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductConcreteMerchantRelationshipStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductConcreteMerchantRelationshipStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductConcreteMerchantRelationshipStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductConcreteMerchantRelationshipStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_PRICE_KEY);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_concrete_merchant_relationship_storage');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
            $criteria->addSelectColumn($alias . '.price_key');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.alias_keys');
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
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_PRICE_KEY);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_concrete_merchant_relationship_storage');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
            $criteria->removeSelectColumn($alias . '.price_key');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.alias_keys');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::DATABASE_NAME)->getTable(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductConcreteMerchantRelationshipStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductConcreteMerchantRelationshipStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\SpyPriceProductConcreteMerchantRelationshipStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductConcreteMerchantRelationshipStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductConcreteMerchantRelationshipStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductConcreteMerchantRelationshipStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_concrete_merchant_relationship_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductConcreteMerchantRelationshipStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductConcreteMerchantRelationshipStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductConcreteMerchantRelationshipStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductConcreteMerchantRelationshipStorage object
        }

        if ($criteria->containsKey(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE) && $criteria->keyContainsValue(SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductConcreteMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_CONCRETE_MERCHANT_RELATIONSHIP_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductConcreteMerchantRelationshipStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
