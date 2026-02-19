<?php

namespace Orm\Zed\Product\Persistence\Map;

use Orm\Zed\CmsBlockProductConnector\Persistence\Map\SpyCmsBlockProductConnectorTableMap;
use Orm\Zed\MerchantProduct\Persistence\Map\SpyMerchantProductAbstractTableMap;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\Map\SpyPriceProductMerchantRelationshipTableMap;
use Orm\Zed\ProductCustomerPermission\Persistence\Map\SpyProductCustomerPermissionTableMap;
use Orm\Zed\ProductGroup\Persistence\Map\SpyProductAbstractGroupTableMap;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductAbstractSetTableMap;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * This class defines the structure of the 'spy_product_abstract' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductAbstractTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Product.Persistence.Map.SpyProductAbstractTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_abstract';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductAbstract';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Product.Persistence.SpyProductAbstract';

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
     * the column name for the id_product_abstract field
     */
    public const COL_ID_PRODUCT_ABSTRACT = 'spy_product_abstract.id_product_abstract';

    /**
     * the column name for the fk_tax_set field
     */
    public const COL_FK_TAX_SET = 'spy_product_abstract.fk_tax_set';

    /**
     * the column name for the approval_status field
     */
    public const COL_APPROVAL_STATUS = 'spy_product_abstract.approval_status';

    /**
     * the column name for the attributes field
     */
    public const COL_ATTRIBUTES = 'spy_product_abstract.attributes';

    /**
     * the column name for the color_code field
     */
    public const COL_COLOR_CODE = 'spy_product_abstract.color_code';

    /**
     * the column name for the new_from field
     */
    public const COL_NEW_FROM = 'spy_product_abstract.new_from';

    /**
     * the column name for the new_to field
     */
    public const COL_NEW_TO = 'spy_product_abstract.new_to';

    /**
     * the column name for the sku field
     */
    public const COL_SKU = 'spy_product_abstract.sku';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_abstract.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_abstract.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductAbstract', 'FkTaxSet', 'ApprovalStatus', 'Attributes', 'ColorCode', 'NewFrom', 'NewTo', 'Sku', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductAbstract', 'fkTaxSet', 'approvalStatus', 'attributes', 'colorCode', 'newFrom', 'newTo', 'sku', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, SpyProductAbstractTableMap::COL_FK_TAX_SET, SpyProductAbstractTableMap::COL_APPROVAL_STATUS, SpyProductAbstractTableMap::COL_ATTRIBUTES, SpyProductAbstractTableMap::COL_COLOR_CODE, SpyProductAbstractTableMap::COL_NEW_FROM, SpyProductAbstractTableMap::COL_NEW_TO, SpyProductAbstractTableMap::COL_SKU, SpyProductAbstractTableMap::COL_CREATED_AT, SpyProductAbstractTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_abstract', 'fk_tax_set', 'approval_status', 'attributes', 'color_code', 'new_from', 'new_to', 'sku', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductAbstract' => 0, 'FkTaxSet' => 1, 'ApprovalStatus' => 2, 'Attributes' => 3, 'ColorCode' => 4, 'NewFrom' => 5, 'NewTo' => 6, 'Sku' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idProductAbstract' => 0, 'fkTaxSet' => 1, 'approvalStatus' => 2, 'attributes' => 3, 'colorCode' => 4, 'newFrom' => 5, 'newTo' => 6, 'sku' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT => 0, SpyProductAbstractTableMap::COL_FK_TAX_SET => 1, SpyProductAbstractTableMap::COL_APPROVAL_STATUS => 2, SpyProductAbstractTableMap::COL_ATTRIBUTES => 3, SpyProductAbstractTableMap::COL_COLOR_CODE => 4, SpyProductAbstractTableMap::COL_NEW_FROM => 5, SpyProductAbstractTableMap::COL_NEW_TO => 6, SpyProductAbstractTableMap::COL_SKU => 7, SpyProductAbstractTableMap::COL_CREATED_AT => 8, SpyProductAbstractTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_product_abstract' => 0, 'fk_tax_set' => 1, 'approval_status' => 2, 'attributes' => 3, 'color_code' => 4, 'new_from' => 5, 'new_to' => 6, 'sku' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductAbstract' => 'ID_PRODUCT_ABSTRACT',
        'SpyProductAbstract.IdProductAbstract' => 'ID_PRODUCT_ABSTRACT',
        'idProductAbstract' => 'ID_PRODUCT_ABSTRACT',
        'spyProductAbstract.idProductAbstract' => 'ID_PRODUCT_ABSTRACT',
        'SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT' => 'ID_PRODUCT_ABSTRACT',
        'COL_ID_PRODUCT_ABSTRACT' => 'ID_PRODUCT_ABSTRACT',
        'id_product_abstract' => 'ID_PRODUCT_ABSTRACT',
        'spy_product_abstract.id_product_abstract' => 'ID_PRODUCT_ABSTRACT',
        'FkTaxSet' => 'FK_TAX_SET',
        'SpyProductAbstract.FkTaxSet' => 'FK_TAX_SET',
        'fkTaxSet' => 'FK_TAX_SET',
        'spyProductAbstract.fkTaxSet' => 'FK_TAX_SET',
        'SpyProductAbstractTableMap::COL_FK_TAX_SET' => 'FK_TAX_SET',
        'COL_FK_TAX_SET' => 'FK_TAX_SET',
        'fk_tax_set' => 'FK_TAX_SET',
        'spy_product_abstract.fk_tax_set' => 'FK_TAX_SET',
        'ApprovalStatus' => 'APPROVAL_STATUS',
        'SpyProductAbstract.ApprovalStatus' => 'APPROVAL_STATUS',
        'approvalStatus' => 'APPROVAL_STATUS',
        'spyProductAbstract.approvalStatus' => 'APPROVAL_STATUS',
        'SpyProductAbstractTableMap::COL_APPROVAL_STATUS' => 'APPROVAL_STATUS',
        'COL_APPROVAL_STATUS' => 'APPROVAL_STATUS',
        'approval_status' => 'APPROVAL_STATUS',
        'spy_product_abstract.approval_status' => 'APPROVAL_STATUS',
        'Attributes' => 'ATTRIBUTES',
        'SpyProductAbstract.Attributes' => 'ATTRIBUTES',
        'attributes' => 'ATTRIBUTES',
        'spyProductAbstract.attributes' => 'ATTRIBUTES',
        'SpyProductAbstractTableMap::COL_ATTRIBUTES' => 'ATTRIBUTES',
        'COL_ATTRIBUTES' => 'ATTRIBUTES',
        'spy_product_abstract.attributes' => 'ATTRIBUTES',
        'ColorCode' => 'COLOR_CODE',
        'SpyProductAbstract.ColorCode' => 'COLOR_CODE',
        'colorCode' => 'COLOR_CODE',
        'spyProductAbstract.colorCode' => 'COLOR_CODE',
        'SpyProductAbstractTableMap::COL_COLOR_CODE' => 'COLOR_CODE',
        'COL_COLOR_CODE' => 'COLOR_CODE',
        'color_code' => 'COLOR_CODE',
        'spy_product_abstract.color_code' => 'COLOR_CODE',
        'NewFrom' => 'NEW_FROM',
        'SpyProductAbstract.NewFrom' => 'NEW_FROM',
        'newFrom' => 'NEW_FROM',
        'spyProductAbstract.newFrom' => 'NEW_FROM',
        'SpyProductAbstractTableMap::COL_NEW_FROM' => 'NEW_FROM',
        'COL_NEW_FROM' => 'NEW_FROM',
        'new_from' => 'NEW_FROM',
        'spy_product_abstract.new_from' => 'NEW_FROM',
        'NewTo' => 'NEW_TO',
        'SpyProductAbstract.NewTo' => 'NEW_TO',
        'newTo' => 'NEW_TO',
        'spyProductAbstract.newTo' => 'NEW_TO',
        'SpyProductAbstractTableMap::COL_NEW_TO' => 'NEW_TO',
        'COL_NEW_TO' => 'NEW_TO',
        'new_to' => 'NEW_TO',
        'spy_product_abstract.new_to' => 'NEW_TO',
        'Sku' => 'SKU',
        'SpyProductAbstract.Sku' => 'SKU',
        'sku' => 'SKU',
        'spyProductAbstract.sku' => 'SKU',
        'SpyProductAbstractTableMap::COL_SKU' => 'SKU',
        'COL_SKU' => 'SKU',
        'spy_product_abstract.sku' => 'SKU',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductAbstract.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductAbstract.createdAt' => 'CREATED_AT',
        'SpyProductAbstractTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_abstract.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductAbstract.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductAbstract.updatedAt' => 'UPDATED_AT',
        'SpyProductAbstractTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_abstract.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_abstract');
        $this->setPhpName('SpyProductAbstract');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract');
        $this->setPackage('src.Orm.Zed.Product.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_abstract_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_abstract', 'IdProductAbstract', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_tax_set', 'FkTaxSet', 'INTEGER', 'spy_tax_set', 'id_tax_set', false, null, null);
        $this->addColumn('approval_status', 'ApprovalStatus', 'VARCHAR', false, 64, null);
        $this->addColumn('attributes', 'Attributes', 'LONGVARCHAR', true, null, null);
        $this->addColumn('color_code', 'ColorCode', 'VARCHAR', false, 8, null);
        $this->addColumn('new_from', 'NewFrom', 'TIMESTAMP', false, null, null);
        $this->addColumn('new_to', 'NewTo', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('SpyTaxSet', '\\Orm\\Zed\\Tax\\Persistence\\SpyTaxSet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_tax_set',
    1 => ':id_tax_set',
  ),
), null, null, null, false);
        $this->addRelation('SpyCmsBlockProductConnector', '\\Orm\\Zed\\CmsBlockProductConnector\\Persistence\\SpyCmsBlockProductConnector', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'SpyCmsBlockProductConnectors', false);
        $this->addRelation('SpyMerchantProductAbstract', '\\Orm\\Zed\\MerchantProduct\\Persistence\\SpyMerchantProductAbstract', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'SpyMerchantProductAbstracts', false);
        $this->addRelation('PriceProduct', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'PriceProducts', false);
        $this->addRelation('PriceProductMerchantRelationship', '\\Orm\\Zed\\PriceProductMerchantRelationship\\Persistence\\SpyPriceProductMerchantRelationship', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'PriceProductMerchantRelationships', false);
        $this->addRelation('PriceProductSchedule', '\\Orm\\Zed\\PriceProductSchedule\\Persistence\\SpyPriceProductSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'PriceProductSchedules', false);
        $this->addRelation('SpyProductAbstractLocalizedAttributes', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstractLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', 'CASCADE', 'SpyProductAbstractLocalizedAttributess', false);
        $this->addRelation('SpyProductAbstractStore', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstractStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductAbstractStores', false);
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProducts', false);
        $this->addRelation('SpyProductAlternative', '\\Orm\\Zed\\ProductAlternative\\Persistence\\SpyProductAlternative', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract_alternative',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductAlternatives', false);
        $this->addRelation('SpyProductCategory', '\\Orm\\Zed\\ProductCategory\\Persistence\\SpyProductCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductCategories', false);
        $this->addRelation('SpyProductCustomerPermission', '\\Orm\\Zed\\ProductCustomerPermission\\Persistence\\SpyProductCustomerPermission', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'SpyProductCustomerPermissions', false);
        $this->addRelation('SpyProductAbstractGroup', '\\Orm\\Zed\\ProductGroup\\Persistence\\SpyProductAbstractGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'SpyProductAbstractGroups', false);
        $this->addRelation('SpyProductImageSet', '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSet', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductImageSets', false);
        $this->addRelation('SpyProductLabelProductAbstract', '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabelProductAbstract', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductLabelProductAbstracts', false);
        $this->addRelation('SpyProductMeasurementBaseUnit', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementBaseUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductMeasurementBaseUnits', false);
        $this->addRelation('SpyProductAbstractProductOptionGroup', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductAbstractProductOptionGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductAbstractProductOptionGroups', false);
        $this->addRelation('SpyProductRelation', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductRelations', false);
        $this->addRelation('SpyProductRelationProductAbstract', '\\Orm\\Zed\\ProductRelation\\Persistence\\SpyProductRelationProductAbstract', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductRelationProductAbstracts', false);
        $this->addRelation('SpyProductReview', '\\Orm\\Zed\\ProductReview\\Persistence\\SpyProductReview', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, 'SpyProductReviews', false);
        $this->addRelation('SpyProductAbstractSet', '\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductAbstractSet', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'SpyProductAbstractSets', false);
        $this->addRelation('SpyUrl', '\\Orm\\Zed\\Url\\Persistence\\SpyUrl', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_resource_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, 'SpyUrls', false);
        $this->addRelation('SpyProductOptionGroup', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionGroup', RelationMap::MANY_TO_MANY, array(), null, null, 'SpyProductOptionGroups');
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
            'event' => ['spy_product_abstract_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_product_abstract     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCmsBlockProductConnectorTableMap::clearInstancePool();
        SpyMerchantProductAbstractTableMap::clearInstancePool();
        SpyPriceProductMerchantRelationshipTableMap::clearInstancePool();
        SpyProductAbstractLocalizedAttributesTableMap::clearInstancePool();
        SpyProductCustomerPermissionTableMap::clearInstancePool();
        SpyProductAbstractGroupTableMap::clearInstancePool();
        SpyProductAbstractSetTableMap::clearInstancePool();
        SpyUrlTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductAbstractTableMap::CLASS_DEFAULT : SpyProductAbstractTableMap::OM_CLASS;
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
     * @return array (SpyProductAbstract object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductAbstractTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductAbstractTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductAbstractTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductAbstractTableMap::OM_CLASS;
            /** @var SpyProductAbstract $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductAbstractTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductAbstractTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductAbstractTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductAbstract $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductAbstractTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_FK_TAX_SET);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_APPROVAL_STATUS);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_ATTRIBUTES);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_COLOR_CODE);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_NEW_FROM);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_NEW_TO);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_SKU);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductAbstractTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_tax_set');
            $criteria->addSelectColumn($alias . '.approval_status');
            $criteria->addSelectColumn($alias . '.attributes');
            $criteria->addSelectColumn($alias . '.color_code');
            $criteria->addSelectColumn($alias . '.new_from');
            $criteria->addSelectColumn($alias . '.new_to');
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
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_FK_TAX_SET);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_APPROVAL_STATUS);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_COLOR_CODE);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_NEW_FROM);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_NEW_TO);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_SKU);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductAbstractTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_tax_set');
            $criteria->removeSelectColumn($alias . '.approval_status');
            $criteria->removeSelectColumn($alias . '.attributes');
            $criteria->removeSelectColumn($alias . '.color_code');
            $criteria->removeSelectColumn($alias . '.new_from');
            $criteria->removeSelectColumn($alias . '.new_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductAbstractTableMap::DATABASE_NAME)->getTable(SpyProductAbstractTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductAbstract or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductAbstract object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Product\Persistence\SpyProductAbstract) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductAbstractTableMap::DATABASE_NAME);
            $criteria->add(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, (array) $values, Criteria::IN);
        }

        $query = SpyProductAbstractQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductAbstractTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductAbstractTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_abstract table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductAbstractQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductAbstract or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductAbstract object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductAbstract object
        }


        // Set the correct dbName
        $query = SpyProductAbstractQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
