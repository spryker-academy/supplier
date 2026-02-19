<?php

namespace Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\Map;

use Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\SpyPriceProductAbstractMerchantRelationshipStorage;
use Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\SpyPriceProductAbstractMerchantRelationshipStorageQuery;
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
 * This class defines the structure of the 'spy_price_product_abstract_merchant_relationship_storage' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductAbstractMerchantRelationshipStorageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductMerchantRelationshipStorage.Persistence.Map.SpyPriceProductAbstractMerchantRelationshipStorageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_abstract_merchant_relationship_storage';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductAbstractMerchantRelationshipStorage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductMerchantRelationshipStorage\\Persistence\\SpyPriceProductAbstractMerchantRelationshipStorage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductMerchantRelationshipStorage.Persistence.SpyPriceProductAbstractMerchantRelationshipStorage';

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
     * the column name for the id_price_product_abstract_merchant_relationship_storage field
     */
    public const COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE = 'spy_price_product_abstract_merchant_relationship_storage.id_price_product_abstract_merchant_relationship_storage';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_price_product_abstract_merchant_relationship_storage.key';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_price_product_abstract_merchant_relationship_storage.fk_product_abstract';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_price_product_abstract_merchant_relationship_storage.fk_company_business_unit';

    /**
     * the column name for the data field
     */
    public const COL_DATA = 'spy_price_product_abstract_merchant_relationship_storage.data';

    /**
     * the column name for the price_key field
     */
    public const COL_PRICE_KEY = 'spy_price_product_abstract_merchant_relationship_storage.price_key';

    /**
     * the column name for the alias_keys field
     */
    public const COL_ALIAS_KEYS = 'spy_price_product_abstract_merchant_relationship_storage.alias_keys';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_price_product_abstract_merchant_relationship_storage.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_price_product_abstract_merchant_relationship_storage.updated_at';

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
        self::TYPE_PHPNAME       => ['IdPriceProductAbstractMerchantRelationshipStorage', 'Key', 'FkProductAbstract', 'FkCompanyBusinessUnit', 'Data', 'PriceKey', 'AliasKeys', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idPriceProductAbstractMerchantRelationshipStorage', 'key', 'fkProductAbstract', 'fkCompanyBusinessUnit', 'data', 'priceKey', 'aliasKeys', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_KEY, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_PRODUCT_ABSTRACT, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_DATA, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_PRICE_KEY, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_CREATED_AT, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_price_product_abstract_merchant_relationship_storage', 'key', 'fk_product_abstract', 'fk_company_business_unit', 'data', 'price_key', 'alias_keys', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductAbstractMerchantRelationshipStorage' => 0, 'Key' => 1, 'FkProductAbstract' => 2, 'FkCompanyBusinessUnit' => 3, 'Data' => 4, 'PriceKey' => 5, 'AliasKeys' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idPriceProductAbstractMerchantRelationshipStorage' => 0, 'key' => 1, 'fkProductAbstract' => 2, 'fkCompanyBusinessUnit' => 3, 'data' => 4, 'priceKey' => 5, 'aliasKeys' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE => 0, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_KEY => 1, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_PRODUCT_ABSTRACT => 2, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 3, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_DATA => 4, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_PRICE_KEY => 5, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS => 6, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_CREATED_AT => 7, SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_price_product_abstract_merchant_relationship_storage' => 0, 'key' => 1, 'fk_product_abstract' => 2, 'fk_company_business_unit' => 3, 'data' => 4, 'price_key' => 5, 'alias_keys' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductAbstractMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'SpyPriceProductAbstractMerchantRelationshipStorage.IdPriceProductAbstractMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'idPriceProductAbstractMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'spyPriceProductAbstractMerchantRelationshipStorage.idPriceProductAbstractMerchantRelationshipStorage' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'id_price_product_abstract_merchant_relationship_storage' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'spy_price_product_abstract_merchant_relationship_storage.id_price_product_abstract_merchant_relationship_storage' => 'ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE',
        'Key' => 'KEY',
        'SpyPriceProductAbstractMerchantRelationshipStorage.Key' => 'KEY',
        'key' => 'KEY',
        'spyPriceProductAbstractMerchantRelationshipStorage.key' => 'KEY',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_price_product_abstract_merchant_relationship_storage.key' => 'KEY',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductAbstractMerchantRelationshipStorage.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyPriceProductAbstractMerchantRelationshipStorage.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_price_product_abstract_merchant_relationship_storage.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyPriceProductAbstractMerchantRelationshipStorage.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyPriceProductAbstractMerchantRelationshipStorage.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_price_product_abstract_merchant_relationship_storage.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'Data' => 'DATA',
        'SpyPriceProductAbstractMerchantRelationshipStorage.Data' => 'DATA',
        'data' => 'DATA',
        'spyPriceProductAbstractMerchantRelationshipStorage.data' => 'DATA',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_DATA' => 'DATA',
        'COL_DATA' => 'DATA',
        'spy_price_product_abstract_merchant_relationship_storage.data' => 'DATA',
        'PriceKey' => 'PRICE_KEY',
        'SpyPriceProductAbstractMerchantRelationshipStorage.PriceKey' => 'PRICE_KEY',
        'priceKey' => 'PRICE_KEY',
        'spyPriceProductAbstractMerchantRelationshipStorage.priceKey' => 'PRICE_KEY',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_PRICE_KEY' => 'PRICE_KEY',
        'COL_PRICE_KEY' => 'PRICE_KEY',
        'price_key' => 'PRICE_KEY',
        'spy_price_product_abstract_merchant_relationship_storage.price_key' => 'PRICE_KEY',
        'AliasKeys' => 'ALIAS_KEYS',
        'SpyPriceProductAbstractMerchantRelationshipStorage.AliasKeys' => 'ALIAS_KEYS',
        'aliasKeys' => 'ALIAS_KEYS',
        'spyPriceProductAbstractMerchantRelationshipStorage.aliasKeys' => 'ALIAS_KEYS',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'COL_ALIAS_KEYS' => 'ALIAS_KEYS',
        'alias_keys' => 'ALIAS_KEYS',
        'spy_price_product_abstract_merchant_relationship_storage.alias_keys' => 'ALIAS_KEYS',
        'CreatedAt' => 'CREATED_AT',
        'SpyPriceProductAbstractMerchantRelationshipStorage.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyPriceProductAbstractMerchantRelationshipStorage.createdAt' => 'CREATED_AT',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_price_product_abstract_merchant_relationship_storage.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyPriceProductAbstractMerchantRelationshipStorage.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyPriceProductAbstractMerchantRelationshipStorage.updatedAt' => 'UPDATED_AT',
        'SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_price_product_abstract_merchant_relationship_storage.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_price_product_abstract_merchant_relationship_storage');
        $this->setPhpName('SpyPriceProductAbstractMerchantRelationshipStorage');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\PriceProductMerchantRelationshipStorage\\Persistence\\SpyPriceProductAbstractMerchantRelationshipStorage');
        $this->setPackage('src.Orm.Zed.PriceProductMerchantRelationshipStorage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_merchant_relationship_abstract_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_abstract_merchant_relationship_storage', 'IdPriceProductAbstractMerchantRelationshipStorage', 'BIGINT', true, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('fk_product_abstract', 'FkProductAbstract', 'INTEGER', true, null, null);
        $this->addColumn('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'LONGVARCHAR', false, null, null);
        $this->addColumn('price_key', 'PriceKey', 'VARCHAR', true, 1024, null);
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
            'synchronization' => ['resource' => ['value' => 'price_product_abstract_merchant_relationship'], 'queue_group' => ['value' => 'sync.storage.price'], 'queue_pool' => NULL, 'key_suffix_column' => ['value' => 'price_key']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductAbstractMerchantRelationshipStorage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductAbstractMerchantRelationshipStorageTableMap::CLASS_DEFAULT : SpyPriceProductAbstractMerchantRelationshipStorageTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductAbstractMerchantRelationshipStorage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductAbstractMerchantRelationshipStorageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductAbstractMerchantRelationshipStorageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductAbstractMerchantRelationshipStorageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductAbstractMerchantRelationshipStorageTableMap::OM_CLASS;
            /** @var SpyPriceProductAbstractMerchantRelationshipStorage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductAbstractMerchantRelationshipStorageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductAbstractMerchantRelationshipStorageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductAbstractMerchantRelationshipStorageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductAbstractMerchantRelationshipStorage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductAbstractMerchantRelationshipStorageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_DATA);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_PRICE_KEY);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_abstract_merchant_relationship_storage');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.price_key');
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
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_DATA);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_PRICE_KEY);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ALIAS_KEYS);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_abstract_merchant_relationship_storage');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
            $criteria->removeSelectColumn($alias . '.data');
            $criteria->removeSelectColumn($alias . '.price_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::DATABASE_NAME)->getTable(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductAbstractMerchantRelationshipStorage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductAbstractMerchantRelationshipStorage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductMerchantRelationshipStorage\Persistence\SpyPriceProductAbstractMerchantRelationshipStorage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductAbstractMerchantRelationshipStorageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductAbstractMerchantRelationshipStorageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductAbstractMerchantRelationshipStorageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_abstract_merchant_relationship_storage table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductAbstractMerchantRelationshipStorageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductAbstractMerchantRelationshipStorage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductAbstractMerchantRelationshipStorage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductAbstractMerchantRelationshipStorage object
        }

        if ($criteria->containsKey(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE) && $criteria->keyContainsValue(SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductAbstractMerchantRelationshipStorageTableMap::COL_ID_PRICE_PRODUCT_ABSTRACT_MERCHANT_RELATIONSHIP_STORAGE.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductAbstractMerchantRelationshipStorageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
