<?php

namespace Orm\Zed\Product\Persistence\Map;

use Orm\Zed\PriceProductMerchantRelationship\Persistence\Map\SpyPriceProductMerchantRelationshipTableMap;
use Orm\Zed\ProductBundle\Persistence\Map\SpyProductBundleTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListProductConcreteTableMap;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery;
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
 * This class defines the structure of the 'spy_product' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Product.Persistence.Map.SpyProductTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProduct';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Product\\Persistence\\SpyProduct';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Product.Persistence.SpyProduct';

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
     * the column name for the id_product field
     */
    public const COL_ID_PRODUCT = 'spy_product.id_product';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product.fk_product_abstract';

    /**
     * the column name for the attributes field
     */
    public const COL_ATTRIBUTES = 'spy_product.attributes';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_product.is_active';

    /**
     * the column name for the is_quantity_splittable field
     */
    public const COL_IS_QUANTITY_SPLITTABLE = 'spy_product.is_quantity_splittable';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_product.sku';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProduct', 'FkProductAbstract', 'Attributes', 'IsActive', 'IsQuantitySplittable', 'Sku', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProduct', 'fkProductAbstract', 'attributes', 'isActive', 'isQuantitySplittable', 'sku', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductTableMap::COL_ID_PRODUCT, SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductTableMap::COL_ATTRIBUTES, SpyProductTableMap::COL_IS_ACTIVE, SpyProductTableMap::COL_IS_QUANTITY_SPLITTABLE, SpyProductTableMap::COL_SKU, SpyProductTableMap::COL_CREATED_AT, SpyProductTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product', 'fk_product_abstract', 'attributes', 'is_active', 'is_quantity_splittable', 'sku', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProduct' => 0, 'FkProductAbstract' => 1, 'Attributes' => 2, 'IsActive' => 3, 'IsQuantitySplittable' => 4, 'Sku' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idProduct' => 0, 'fkProductAbstract' => 1, 'attributes' => 2, 'isActive' => 3, 'isQuantitySplittable' => 4, 'sku' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyProductTableMap::COL_ID_PRODUCT => 0, SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT => 1, SpyProductTableMap::COL_ATTRIBUTES => 2, SpyProductTableMap::COL_IS_ACTIVE => 3, SpyProductTableMap::COL_IS_QUANTITY_SPLITTABLE => 4, SpyProductTableMap::COL_SKU => 5, SpyProductTableMap::COL_CREATED_AT => 6, SpyProductTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_product' => 0, 'fk_product_abstract' => 1, 'attributes' => 2, 'is_active' => 3, 'is_quantity_splittable' => 4, 'sku' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProduct' => 'ID_PRODUCT',
        'SpyProduct.IdProduct' => 'ID_PRODUCT',
        'idProduct' => 'ID_PRODUCT',
        'spyProduct.idProduct' => 'ID_PRODUCT',
        'SpyProductTableMap::COL_ID_PRODUCT' => 'ID_PRODUCT',
        'COL_ID_PRODUCT' => 'ID_PRODUCT',
        'id_product' => 'ID_PRODUCT',
        'spy_product.id_product' => 'ID_PRODUCT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProduct.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProduct.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'Attributes' => 'ATTRIBUTES',
        'SpyProduct.Attributes' => 'ATTRIBUTES',
        'attributes' => 'ATTRIBUTES',
        'spyProduct.attributes' => 'ATTRIBUTES',
        'SpyProductTableMap::COL_ATTRIBUTES' => 'ATTRIBUTES',
        'COL_ATTRIBUTES' => 'ATTRIBUTES',
        'spy_product.attributes' => 'ATTRIBUTES',
        'IsActive' => 'IS_ACTIVE',
        'SpyProduct.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyProduct.isActive' => 'IS_ACTIVE',
        'SpyProductTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_product.is_active' => 'IS_ACTIVE',
        'IsQuantitySplittable' => 'IS_QUANTITY_SPLITTABLE',
        'SpyProduct.IsQuantitySplittable' => 'IS_QUANTITY_SPLITTABLE',
        'isQuantitySplittable' => 'IS_QUANTITY_SPLITTABLE',
        'spyProduct.isQuantitySplittable' => 'IS_QUANTITY_SPLITTABLE',
        'SpyProductTableMap::COL_IS_QUANTITY_SPLITTABLE' => 'IS_QUANTITY_SPLITTABLE',
        'COL_IS_QUANTITY_SPLITTABLE' => 'IS_QUANTITY_SPLITTABLE',
        'is_quantity_splittable' => 'IS_QUANTITY_SPLITTABLE',
        'spy_product.is_quantity_splittable' => 'IS_QUANTITY_SPLITTABLE',
        'Sku' => 'SKU',
        'SpyProduct.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyProduct.sku' => 'SKU',
        'SpyProductTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_product.sku' => 'SKU',
        'CreatedAt' => 'CREATED_AT',
        'SpyProduct.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProduct.createdAt' => 'CREATED_AT',
        'SpyProductTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProduct.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProduct.updatedAt' => 'UPDATED_AT',
        'SpyProductTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product');
        $this->setPhpName('SpyProduct');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Product\\Persistence\\SpyProduct');
        $this->setPackage('src.Orm.Zed.Product.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_pk_seq');
        // columns
        $this->addPrimaryKey('id_product', 'IdProduct', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
        $this->addColumn('attributes', 'Attributes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, true);
        $this->addColumn('is_quantity_splittable', 'IsQuantitySplittable', 'BOOLEAN', true, 1, true);
        $this->addColumn('sku', 'Sku', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, null, false);
        $this->addRelation('PriceProduct', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'PriceProducts', false);
        $this->addRelation('PriceProductMerchantRelationship', '\\Orm\\Zed\\PriceProductMerchantRelationship\\Persistence\\SpyPriceProductMerchantRelationship', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), 'CASCADE', null, 'PriceProductMerchantRelationships', false);
        $this->addRelation('PriceProductSchedule', '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'PriceProductSchedules', false);
        $this->addRelation('SpyProductLocalizedAttributes', '\\Orm\\Zed\\Product\\Persistence\\SpyProductLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), 'CASCADE', 'CASCADE', 'SpyProductLocalizedAttributess', false);
        $this->addRelation('SpyProductAlternativeRelatedByFkProduct', '\\Orm\\Zed\\ProductAlternative\\Persistence\\SpyProductAlternative', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductAlternativesRelatedByFkProduct', false);
        $this->addRelation('SpyProductAlternativeRelatedByFkProductConcreteAlternative', '\\Orm\\Zed\\ProductAlternative\\Persistence\\SpyProductAlternative', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_concrete_alternative',
    1 => ':id_product',
  ),
), null, null, 'SpyProductAlternativesRelatedByFkProductConcreteAlternative', false);
        $this->addRelation('BundledProduct', '\\Orm\\Zed\\ProductBundle\\Persistence\\SpyProductBundle', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_bundled_product',
    1 => ':id_product',
  ),
), 'CASCADE', 'CASCADE', 'BundledProducts', false);
        $this->addRelation('SpyProductBundleRelatedByFkProduct', '\\Orm\\Zed\\ProductBundle\\Persistence\\SpyProductBundle', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), 'CASCADE', 'CASCADE', 'SpyProductBundlesRelatedByFkProduct', false);
        $this->addRelation('SpyProductConfiguration', '\\Orm\\Zed\\ProductConfiguration\\Persistence\\SpyProductConfiguration', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductConfigurations', false);
        $this->addRelation('SpyProductDiscontinued', '\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinued', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductDiscontinueds', false);
        $this->addRelation('SpyProductImageSet', '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSet', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductImageSets', false);
        $this->addRelation('SpyProductListProductConcrete', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductListProductConcrete', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), 'CASCADE', null, 'SpyProductListProductConcretes', false);
        $this->addRelation('SpyProductMeasurementSalesUnit', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductMeasurementSalesUnits', false);
        $this->addRelation('SpyProductPackagingUnitRelatedByFkProduct', '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductPackagingUnitsRelatedByFkProduct', false);
        $this->addRelation('SpyProductPackagingUnitRelatedByFkLeadProduct', '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_lead_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductPackagingUnitsRelatedByFkLeadProduct', false);
        $this->addRelation('SpyProductQuantity', '\\Orm\\Zed\\ProductQuantity\\Persistence\\SpyProductQuantity', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductQuantities', false);
        $this->addRelation('SpyProductSearch', '\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearch', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductSearches', false);
        $this->addRelation('SpyProductValidity', '\\Orm\\Zed\\ProductValidity\\Persistence\\SpyProductValidity', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductValidities', false);
        $this->addRelation('SpyProductShipmentType', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyProductShipmentType', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'SpyProductShipmentTypes', false);
        $this->addRelation('ProductToProductClass', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyProductToProductClass', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'ProductToProductClasses', false);
        $this->addRelation('StockProduct', '\\Orm\\Zed\\Stock\\Persistence\\SpyStockProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, 'StockProducts', false);
        $this->addRelation('SpyProductList', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SpyProductLists');
        $this->addRelation('SpyShipmentType', '\\Orm\\Zed\\ShipmentType\\Persistence\\SpyShipmentType', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SpyShipmentTypes');
        $this->addRelation('ProductClass', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyProductClass', RelationMap::MANY_TO_MANY, array(), null, null, 'ProductClasses');
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
            'event' => ['spy_product_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_product     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyPriceProductMerchantRelationshipTableMap::clearInstancePool();
        SpyProductLocalizedAttributesTableMap::clearInstancePool();
        SpyProductBundleTableMap::clearInstancePool();
        SpyProductListProductConcreteTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProduct', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductTableMap::CLASS_DEFAULT : SpyProductTableMap::OM_CLASS;
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
     * @return array (SpyProduct object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductTableMap::OM_CLASS;
            /** @var SpyProduct $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProduct $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductTableMap::COL_ID_PRODUCT);
            $criteria->addSelectColumn(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductTableMap::COL_ATTRIBUTES);
            $criteria->addSelectColumn(SpyProductTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyProductTableMap::COL_IS_QUANTITY_SPLITTABLE);
            $criteria->addSelectColumn(SpyProductTableMap::COL_SKU);
            $criteria->addSelectColumn(SpyProductTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.attributes');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_quantity_splittable');
            $criteria->addSelectColumn($alias . '.sku');
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
            $criteria->removeSelectColumn(SpyProductTableMap::COL_ID_PRODUCT);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_IS_QUANTITY_SPLITTABLE);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.attributes');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_quantity_splittable');
            $criteria->removeSelectColumn($alias . '.sku');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductTableMap::DATABASE_NAME)->getTable(SpyProductTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProduct or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProduct object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Product\Persistence\SpyProduct) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductTableMap::DATABASE_NAME);
            $criteria->add(SpyProductTableMap::COL_ID_PRODUCT, (array) $values, Criteria::IN);
        }

        $query = SpyProductQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProduct or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProduct object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProduct object
        }


        // Set the correct dbName
        $query = SpyProductQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
