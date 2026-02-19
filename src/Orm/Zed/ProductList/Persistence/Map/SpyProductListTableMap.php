<?php

namespace Orm\Zed\ProductList\Persistence\Map;

use Orm\Zed\ProductList\Persistence\SpyProductList;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelToProductListTableMap;
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
 * This class defines the structure of the 'spy_product_list' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductListTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductList.Persistence.Map.SpyProductListTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_list';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductList';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductList.Persistence.SpyProductList';

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
     * the column name for the id_product_list field
     */
    public const COL_ID_PRODUCT_LIST = 'spy_product_list.id_product_list';

    /**
     * the column name for the fk_merchant_relationship field
     */
    public const COL_FK_MERCHANT_RELATIONSHIP = 'spy_product_list.fk_merchant_relationship';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_list.key';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'spy_product_list.title';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_product_list.type';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_list.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_list.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the type field */
    public const COL_TYPE_BLACKLIST = 'blacklist';
    public const COL_TYPE_WHITELIST = 'whitelist';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdProductList', 'FkMerchantRelationship', 'Key', 'Title', 'Type', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductList', 'fkMerchantRelationship', 'key', 'title', 'type', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductListTableMap::COL_ID_PRODUCT_LIST, SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP, SpyProductListTableMap::COL_KEY, SpyProductListTableMap::COL_TITLE, SpyProductListTableMap::COL_TYPE, SpyProductListTableMap::COL_CREATED_AT, SpyProductListTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_list', 'fk_merchant_relationship', 'key', 'title', 'type', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductList' => 0, 'FkMerchantRelationship' => 1, 'Key' => 2, 'Title' => 3, 'Type' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idProductList' => 0, 'fkMerchantRelationship' => 1, 'key' => 2, 'title' => 3, 'type' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyProductListTableMap::COL_ID_PRODUCT_LIST => 0, SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP => 1, SpyProductListTableMap::COL_KEY => 2, SpyProductListTableMap::COL_TITLE => 3, SpyProductListTableMap::COL_TYPE => 4, SpyProductListTableMap::COL_CREATED_AT => 5, SpyProductListTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_product_list' => 0, 'fk_merchant_relationship' => 1, 'key' => 2, 'title' => 3, 'type' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductList' => 'ID_PRODUCT_LIST',
        'SpyProductList.IdProductList' => 'ID_PRODUCT_LIST',
        'idProductList' => 'ID_PRODUCT_LIST',
        'spyProductList.idProductList' => 'ID_PRODUCT_LIST',
        'SpyProductListTableMap::COL_ID_PRODUCT_LIST' => 'ID_PRODUCT_LIST',
        'COL_ID_PRODUCT_LIST' => 'ID_PRODUCT_LIST',
        'id_product_list' => 'ID_PRODUCT_LIST',
        'spy_product_list.id_product_list' => 'ID_PRODUCT_LIST',
        'FkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'SpyProductList.FkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'fkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'spyProductList.fkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP' => 'FK_MERCHANT_RELATIONSHIP',
        'COL_FK_MERCHANT_RELATIONSHIP' => 'FK_MERCHANT_RELATIONSHIP',
        'fk_merchant_relationship' => 'FK_MERCHANT_RELATIONSHIP',
        'spy_product_list.fk_merchant_relationship' => 'FK_MERCHANT_RELATIONSHIP',
        'Key' => 'KEY',
        'SpyProductList.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductList.key' => 'KEY',
        'SpyProductListTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_list.key' => 'KEY',
        'Title' => 'TITLE',
        'SpyProductList.Title' => 'TITLE',
        'title' => 'TITLE',
        'spyProductList.title' => 'TITLE',
        'SpyProductListTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'spy_product_list.title' => 'TITLE',
        'Type' => 'TYPE',
        'SpyProductList.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyProductList.type' => 'TYPE',
        'SpyProductListTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_product_list.type' => 'TYPE',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductList.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductList.createdAt' => 'CREATED_AT',
        'SpyProductListTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_list.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductList.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductList.updatedAt' => 'UPDATED_AT',
        'SpyProductListTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_list.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyProductListTableMap::COL_TYPE => [
                            self::COL_TYPE_BLACKLIST,
            self::COL_TYPE_WHITELIST,
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
        $this->setName('spy_product_list');
        $this->setPhpName('SpyProductList');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList');
        $this->setPackage('src.Orm.Zed.ProductList.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_list_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_list', 'IdProductList', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_merchant_relationship', 'FkMerchantRelationship', 'INTEGER', 'spy_merchant_relationship', 'id_merchant_relationship', false, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 255, null);
        $this->addColumn('type', 'Type', 'ENUM', true, 16, null);
        $this->getColumn('type')->setValueSet(array (
  0 => 'blacklist',
  1 => 'whitelist',
));
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
        $this->addRelation('SpyMerchantRelationship', '\\Orm\\Zed\\MerchantRelationship\\Persistence\\SpyMerchantRelationship', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_relationship',
    1 => ':id_merchant_relationship',
  ),
), null, null, null, false);
        $this->addRelation('SpyConfigurableBundleTemplateSlot', '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplateSlot', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_list',
    1 => ':id_product_list',
  ),
), null, null, 'SpyConfigurableBundleTemplateSlots', false);
        $this->addRelation('SpyProductListProductConcrete', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductListProductConcrete', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_list',
    1 => ':id_product_list',
  ),
), 'CASCADE', null, 'SpyProductListProductConcretes', false);
        $this->addRelation('SpyProductListCategory', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductListCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_list',
    1 => ':id_product_list',
  ),
), 'CASCADE', null, 'SpyProductListCategories', false);
        $this->addRelation('SpySspModelToProductList', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModelToProductList', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_list',
    1 => ':id_product_list',
  ),
), 'CASCADE', null, 'SpySspModelToProductLists', false);
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SpyProducts');
        $this->addRelation('SpyCategory', '\\Orm\\Zed\\Category\\Persistence\\SpyCategory', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SpyCategories');
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
            'event' => ['spy_product_list_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_product_list     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyProductListProductConcreteTableMap::clearInstancePool();
        SpyProductListCategoryTableMap::clearInstancePool();
        SpySspModelToProductListTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductList', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductListTableMap::CLASS_DEFAULT : SpyProductListTableMap::OM_CLASS;
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
     * @return array (SpyProductList object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductListTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductListTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductListTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductListTableMap::OM_CLASS;
            /** @var SpyProductList $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductListTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductListTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductListTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductList $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductListTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductListTableMap::COL_ID_PRODUCT_LIST);
            $criteria->addSelectColumn(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP);
            $criteria->addSelectColumn(SpyProductListTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductListTableMap::COL_TITLE);
            $criteria->addSelectColumn(SpyProductListTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyProductListTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_list');
            $criteria->addSelectColumn($alias . '.fk_merchant_relationship');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.type');
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
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_ID_PRODUCT_LIST);
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_FK_MERCHANT_RELATIONSHIP);
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_TITLE);
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductListTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_list');
            $criteria->removeSelectColumn($alias . '.fk_merchant_relationship');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.title');
            $criteria->removeSelectColumn($alias . '.type');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductListTableMap::DATABASE_NAME)->getTable(SpyProductListTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductList or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductList object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductListTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductList\Persistence\SpyProductList) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductListTableMap::DATABASE_NAME);
            $criteria->add(SpyProductListTableMap::COL_ID_PRODUCT_LIST, (array) $values, Criteria::IN);
        }

        $query = SpyProductListQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductListTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductListTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_list table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductListQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductList or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductList object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductListTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductList object
        }

        if ($criteria->containsKey(SpyProductListTableMap::COL_ID_PRODUCT_LIST) && $criteria->keyContainsValue(SpyProductListTableMap::COL_ID_PRODUCT_LIST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductListTableMap::COL_ID_PRODUCT_LIST.')');
        }


        // Set the correct dbName
        $query = SpyProductListQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
