<?php

namespace Orm\Zed\Product\Persistence\Base;

use \DateTime;
use \Exception;
use \PDO;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery;
use Orm\Zed\CmsBlockProductConnector\Persistence\Base\SpyCmsBlockProductConnector as BaseSpyCmsBlockProductConnector;
use Orm\Zed\CmsBlockProductConnector\Persistence\Map\SpyCmsBlockProductConnectorTableMap;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery;
use Orm\Zed\MerchantProduct\Persistence\Base\SpyMerchantProductAbstract as BaseSpyMerchantProductAbstract;
use Orm\Zed\MerchantProduct\Persistence\Map\SpyMerchantProductAbstractTableMap;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\Base\SpyPriceProductMerchantRelationship as BaseSpyPriceProductMerchantRelationship;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\Map\SpyPriceProductMerchantRelationshipTableMap;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery;
use Orm\Zed\PriceProductSchedule\Persistence\Base\SpyPriceProductSchedule as BaseSpyPriceProductSchedule;
use Orm\Zed\PriceProductSchedule\Persistence\Map\SpyPriceProductScheduleTableMap;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProduct;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery;
use Orm\Zed\PriceProduct\Persistence\Base\SpyPriceProduct as BaseSpyPriceProduct;
use Orm\Zed\PriceProduct\Persistence\Map\SpyPriceProductTableMap;
use Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative;
use Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery;
use Orm\Zed\ProductAlternative\Persistence\Base\SpyProductAlternative as BaseSpyProductAlternative;
use Orm\Zed\ProductAlternative\Persistence\Map\SpyProductAlternativeTableMap;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategory;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Orm\Zed\ProductCategory\Persistence\Base\SpyProductCategory as BaseSpyProductCategory;
use Orm\Zed\ProductCategory\Persistence\Map\SpyProductCategoryTableMap;
use Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission;
use Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery;
use Orm\Zed\ProductCustomerPermission\Persistence\Base\SpyProductCustomerPermission as BaseSpyProductCustomerPermission;
use Orm\Zed\ProductCustomerPermission\Persistence\Map\SpyProductCustomerPermissionTableMap;
use Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup;
use Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery;
use Orm\Zed\ProductGroup\Persistence\Base\SpyProductAbstractGroup as BaseSpyProductAbstractGroup;
use Orm\Zed\ProductGroup\Persistence\Map\SpyProductAbstractGroupTableMap;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
use Orm\Zed\ProductImage\Persistence\Base\SpyProductImageSet as BaseSpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageSetTableMap;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery;
use Orm\Zed\ProductLabel\Persistence\Base\SpyProductLabelProductAbstract as BaseSpyProductLabelProductAbstract;
use Orm\Zed\ProductLabel\Persistence\Map\SpyProductLabelProductAbstractTableMap;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery;
use Orm\Zed\ProductMeasurementUnit\Persistence\Base\SpyProductMeasurementBaseUnit as BaseSpyProductMeasurementBaseUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\Map\SpyProductMeasurementBaseUnitTableMap;
use Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery;
use Orm\Zed\ProductOption\Persistence\Base\SpyProductAbstractProductOptionGroup as BaseSpyProductAbstractProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\Map\SpyProductAbstractProductOptionGroupTableMap;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery;
use Orm\Zed\ProductRelation\Persistence\Base\SpyProductRelation as BaseSpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\Base\SpyProductRelationProductAbstract as BaseSpyProductRelationProductAbstract;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationProductAbstractTableMap;
use Orm\Zed\ProductRelation\Persistence\Map\SpyProductRelationTableMap;
use Orm\Zed\ProductReview\Persistence\SpyProductReview;
use Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery;
use Orm\Zed\ProductReview\Persistence\Base\SpyProductReview as BaseSpyProductReview;
use Orm\Zed\ProductReview\Persistence\Map\SpyProductReviewTableMap;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery;
use Orm\Zed\ProductSet\Persistence\Base\SpyProductAbstractSet as BaseSpyProductAbstractSet;
use Orm\Zed\ProductSet\Persistence\Map\SpyProductAbstractSetTableMap;
use Orm\Zed\Product\Persistence\SpyProduct as ChildSpyProduct;
use Orm\Zed\Product\Persistence\SpyProductAbstract as ChildSpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes as ChildSpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery as ChildSpyProductAbstractLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery as ChildSpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractStore as ChildSpyProductAbstractStore;
use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery as ChildSpyProductAbstractStoreQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery as ChildSpyProductQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractLocalizedAttributesTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractStoreTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
use Orm\Zed\Tax\Persistence\SpyTaxSetQuery;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\Url\Persistence\Base\SpyUrl as BaseSpyUrl;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;

/**
 * Base class that represents a row from the 'spy_product_abstract' table.
 *
 *
 *
 * @package    propel.generator.src.Orm.Zed.Product.Persistence.Base
 */
abstract class SpyProductAbstract implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\Orm\\Zed\\Product\\Persistence\\Map\\SpyProductAbstractTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the id_product_abstract field.
     *
     * @var        int
     */
    protected $id_product_abstract;

    /**
     * The value for the fk_tax_set field.
     *
     * @var        int|null
     */
    protected $fk_tax_set;

    /**
     * The value for the approval_status field.
     * The current approval status of an entity, e.g., a product or offer.
     * @var        string|null
     */
    protected $approval_status;

    /**
     * The value for the attributes field.
     * A set of key-value pairs describing a product or entity.
     * @var        string
     */
    protected $attributes;

    /**
     * The value for the color_code field.
     *
     * @var        string|null
     */
    protected $color_code;

    /**
     * The value for the new_from field.
     * The date from which a product is considered 'new'.
     * @var        DateTime|null
     */
    protected $new_from;

    /**
     * The value for the new_to field.
     * The date until which a product is considered 'new'.
     * @var        DateTime|null
     */
    protected $new_to;

    /**
     * The value for the sku field.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @var        string
     */
    protected $sku;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        SpyTaxSet
     */
    protected $aSpyTaxSet;

    /**
     * @var        ObjectCollection|SpyCmsBlockProductConnector[] Collection to store aggregation of SpyCmsBlockProductConnector objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockProductConnector> Collection to store aggregation of SpyCmsBlockProductConnector objects.
     */
    protected $collSpyCmsBlockProductConnectors;
    protected $collSpyCmsBlockProductConnectorsPartial;

    /**
     * @var        ObjectCollection|SpyMerchantProductAbstract[] Collection to store aggregation of SpyMerchantProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProductAbstract> Collection to store aggregation of SpyMerchantProductAbstract objects.
     */
    protected $collSpyMerchantProductAbstracts;
    protected $collSpyMerchantProductAbstractsPartial;

    /**
     * @var        ObjectCollection|SpyPriceProduct[] Collection to store aggregation of SpyPriceProduct objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProduct> Collection to store aggregation of SpyPriceProduct objects.
     */
    protected $collPriceProducts;
    protected $collPriceProductsPartial;

    /**
     * @var        ObjectCollection|SpyPriceProductMerchantRelationship[] Collection to store aggregation of SpyPriceProductMerchantRelationship objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductMerchantRelationship> Collection to store aggregation of SpyPriceProductMerchantRelationship objects.
     */
    protected $collPriceProductMerchantRelationships;
    protected $collPriceProductMerchantRelationshipsPartial;

    /**
     * @var        ObjectCollection|SpyPriceProductSchedule[] Collection to store aggregation of SpyPriceProductSchedule objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductSchedule> Collection to store aggregation of SpyPriceProductSchedule objects.
     */
    protected $collPriceProductSchedules;
    protected $collPriceProductSchedulesPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductAbstractLocalizedAttributes[] Collection to store aggregation of ChildSpyProductAbstractLocalizedAttributes objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractLocalizedAttributes> Collection to store aggregation of ChildSpyProductAbstractLocalizedAttributes objects.
     */
    protected $collSpyProductAbstractLocalizedAttributess;
    protected $collSpyProductAbstractLocalizedAttributessPartial;

    /**
     * @var        ObjectCollection|ChildSpyProductAbstractStore[] Collection to store aggregation of ChildSpyProductAbstractStore objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractStore> Collection to store aggregation of ChildSpyProductAbstractStore objects.
     */
    protected $collSpyProductAbstractStores;
    protected $collSpyProductAbstractStoresPartial;

    /**
     * @var        ObjectCollection|ChildSpyProduct[] Collection to store aggregation of ChildSpyProduct objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProduct> Collection to store aggregation of ChildSpyProduct objects.
     */
    protected $collSpyProducts;
    protected $collSpyProductsPartial;

    /**
     * @var        ObjectCollection|SpyProductAlternative[] Collection to store aggregation of SpyProductAlternative objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAlternative> Collection to store aggregation of SpyProductAlternative objects.
     */
    protected $collSpyProductAlternatives;
    protected $collSpyProductAlternativesPartial;

    /**
     * @var        ObjectCollection|SpyProductCategory[] Collection to store aggregation of SpyProductCategory objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCategory> Collection to store aggregation of SpyProductCategory objects.
     */
    protected $collSpyProductCategories;
    protected $collSpyProductCategoriesPartial;

    /**
     * @var        ObjectCollection|SpyProductCustomerPermission[] Collection to store aggregation of SpyProductCustomerPermission objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCustomerPermission> Collection to store aggregation of SpyProductCustomerPermission objects.
     */
    protected $collSpyProductCustomerPermissions;
    protected $collSpyProductCustomerPermissionsPartial;

    /**
     * @var        ObjectCollection|SpyProductAbstractGroup[] Collection to store aggregation of SpyProductAbstractGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractGroup> Collection to store aggregation of SpyProductAbstractGroup objects.
     */
    protected $collSpyProductAbstractGroups;
    protected $collSpyProductAbstractGroupsPartial;

    /**
     * @var        ObjectCollection|SpyProductImageSet[] Collection to store aggregation of SpyProductImageSet objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductImageSet> Collection to store aggregation of SpyProductImageSet objects.
     */
    protected $collSpyProductImageSets;
    protected $collSpyProductImageSetsPartial;

    /**
     * @var        ObjectCollection|SpyProductLabelProductAbstract[] Collection to store aggregation of SpyProductLabelProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLabelProductAbstract> Collection to store aggregation of SpyProductLabelProductAbstract objects.
     */
    protected $collSpyProductLabelProductAbstracts;
    protected $collSpyProductLabelProductAbstractsPartial;

    /**
     * @var        ObjectCollection|SpyProductMeasurementBaseUnit[] Collection to store aggregation of SpyProductMeasurementBaseUnit objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductMeasurementBaseUnit> Collection to store aggregation of SpyProductMeasurementBaseUnit objects.
     */
    protected $collSpyProductMeasurementBaseUnits;
    protected $collSpyProductMeasurementBaseUnitsPartial;

    /**
     * @var        ObjectCollection|SpyProductAbstractProductOptionGroup[] Collection to store aggregation of SpyProductAbstractProductOptionGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractProductOptionGroup> Collection to store aggregation of SpyProductAbstractProductOptionGroup objects.
     */
    protected $collSpyProductAbstractProductOptionGroups;
    protected $collSpyProductAbstractProductOptionGroupsPartial;

    /**
     * @var        ObjectCollection|SpyProductRelation[] Collection to store aggregation of SpyProductRelation objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductRelation> Collection to store aggregation of SpyProductRelation objects.
     */
    protected $collSpyProductRelations;
    protected $collSpyProductRelationsPartial;

    /**
     * @var        ObjectCollection|SpyProductRelationProductAbstract[] Collection to store aggregation of SpyProductRelationProductAbstract objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductRelationProductAbstract> Collection to store aggregation of SpyProductRelationProductAbstract objects.
     */
    protected $collSpyProductRelationProductAbstracts;
    protected $collSpyProductRelationProductAbstractsPartial;

    /**
     * @var        ObjectCollection|SpyProductReview[] Collection to store aggregation of SpyProductReview objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductReview> Collection to store aggregation of SpyProductReview objects.
     */
    protected $collSpyProductReviews;
    protected $collSpyProductReviewsPartial;

    /**
     * @var        ObjectCollection|SpyProductAbstractSet[] Collection to store aggregation of SpyProductAbstractSet objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractSet> Collection to store aggregation of SpyProductAbstractSet objects.
     */
    protected $collSpyProductAbstractSets;
    protected $collSpyProductAbstractSetsPartial;

    /**
     * @var        ObjectCollection|SpyUrl[] Collection to store aggregation of SpyUrl objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl> Collection to store aggregation of SpyUrl objects.
     */
    protected $collSpyUrls;
    protected $collSpyUrlsPartial;

    /**
     * @var        ObjectCollection|SpyProductOptionGroup[] Cross Collection to store aggregation of SpyProductOptionGroup objects.
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOptionGroup> Cross Collection to store aggregation of SpyProductOptionGroup objects.
     */
    protected $collSpyProductOptionGroups;

    /**
     * @var bool
     */
    protected $collSpyProductOptionGroupsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    // event behavior

    /**
     * @var string
     */
    private $_eventName;

    /**
     * @var bool
     */
    private $_isModified;

    /**
     * @var array
     */
    private $_modifiedColumns;

    /**
     * @var array
     */
    private $_initialValues;

    /**
     * @var bool
     */
    private $_isEventDisabled;

    /**
     * @var array
     */
    private $_foreignKeys = [
        'spy_product_abstract.fk_tax_set' => 'fk_tax_set',
    ];

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductOptionGroup[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductOptionGroup>
     */
    protected $spyProductOptionGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyCmsBlockProductConnector[]
     * @phpstan-var ObjectCollection&\Traversable<SpyCmsBlockProductConnector>
     */
    protected $spyCmsBlockProductConnectorsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyMerchantProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<SpyMerchantProductAbstract>
     */
    protected $spyMerchantProductAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPriceProduct[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProduct>
     */
    protected $priceProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPriceProductMerchantRelationship[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductMerchantRelationship>
     */
    protected $priceProductMerchantRelationshipsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyPriceProductSchedule[]
     * @phpstan-var ObjectCollection&\Traversable<SpyPriceProductSchedule>
     */
    protected $priceProductSchedulesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductAbstractLocalizedAttributes[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractLocalizedAttributes>
     */
    protected $spyProductAbstractLocalizedAttributessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProductAbstractStore[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProductAbstractStore>
     */
    protected $spyProductAbstractStoresScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSpyProduct[]
     * @phpstan-var ObjectCollection&\Traversable<ChildSpyProduct>
     */
    protected $spyProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAlternative[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAlternative>
     */
    protected $spyProductAlternativesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductCategory[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCategory>
     */
    protected $spyProductCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductCustomerPermission[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductCustomerPermission>
     */
    protected $spyProductCustomerPermissionsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAbstractGroup[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractGroup>
     */
    protected $spyProductAbstractGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductImageSet[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductImageSet>
     */
    protected $spyProductImageSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductLabelProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductLabelProductAbstract>
     */
    protected $spyProductLabelProductAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductMeasurementBaseUnit[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductMeasurementBaseUnit>
     */
    protected $spyProductMeasurementBaseUnitsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAbstractProductOptionGroup[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractProductOptionGroup>
     */
    protected $spyProductAbstractProductOptionGroupsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductRelation[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductRelation>
     */
    protected $spyProductRelationsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductRelationProductAbstract[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductRelationProductAbstract>
     */
    protected $spyProductRelationProductAbstractsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductReview[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductReview>
     */
    protected $spyProductReviewsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyProductAbstractSet[]
     * @phpstan-var ObjectCollection&\Traversable<SpyProductAbstractSet>
     */
    protected $spyProductAbstractSetsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|SpyUrl[]
     * @phpstan-var ObjectCollection&\Traversable<SpyUrl>
     */
    protected $spyUrlsScheduledForDeletion = null;

    /**
     * Initializes internal state of Orm\Zed\Product\Persistence\Base\SpyProductAbstract object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>SpyProductAbstract</code> instance.  If
     * <code>obj</code> is an instance of <code>SpyProductAbstract</code>, delegates to
     * <code>equals(SpyProductAbstract)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return mixed
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_product_abstract] column value.
     *
     * @return int
     */
    public function getIdProductAbstract()
    {
        return $this->id_product_abstract;
    }

    /**
     * Get the [fk_tax_set] column value.
     *
     * @return int|null
     */
    public function getFkTaxSet()
    {
        return $this->fk_tax_set;
    }

    /**
     * Get the [approval_status] column value.
     * The current approval status of an entity, e.g., a product or offer.
     * @return string|null
     */
    public function getApprovalStatus()
    {
        return $this->approval_status;
    }

    /**
     * Get the [attributes] column value.
     * A set of key-value pairs describing a product or entity.
     * @return string
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get the [color_code] column value.
     *
     * @return string|null
     */
    public function getColorCode()
    {
        return $this->color_code;
    }

    /**
     * Get the [optionally formatted] temporal [new_from] column value.
     * The date from which a product is considered 'new'.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getNewFrom($format = null)
    {
        if ($format === null) {
            return $this->new_from;
        } else {
            return $this->new_from instanceof \DateTimeInterface ? $this->new_from->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [new_to] column value.
     * The date until which a product is considered 'new'.
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getNewTo($format = null)
    {
        if ($format === null) {
            return $this->new_to;
        } else {
            return $this->new_to instanceof \DateTimeInterface ? $this->new_to->format($format) : null;
        }
    }

    /**
     * Get the [sku] column value.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = null)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = null)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id_product_abstract] column.
     *
     * @param int $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setIdProductAbstract($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->id_product_abstract !== $v) {
            $this->id_product_abstract = $v;
            $this->modifiedColumns[SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [fk_tax_set] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFkTaxSet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->fk_tax_set !== $v) {
            $this->fk_tax_set = $v;
            $this->modifiedColumns[SpyProductAbstractTableMap::COL_FK_TAX_SET] = true;
        }

        if ($this->aSpyTaxSet !== null && $this->aSpyTaxSet->getIdTaxSet() !== $v) {
            $this->aSpyTaxSet = null;
        }

        return $this;
    }

    /**
     * Set the value of [approval_status] column.
     * The current approval status of an entity, e.g., a product or offer.
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setApprovalStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->approval_status !== $v) {
            $this->approval_status = $v;
            $this->modifiedColumns[SpyProductAbstractTableMap::COL_APPROVAL_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [attributes] column.
     * A set of key-value pairs describing a product or entity.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setAttributes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->attributes !== $v) {
            $this->attributes = $v;
            $this->modifiedColumns[SpyProductAbstractTableMap::COL_ATTRIBUTES] = true;
        }

        return $this;
    }

    /**
     * Set the value of [color_code] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setColorCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->color_code !== $v) {
            $this->color_code = $v;
            $this->modifiedColumns[SpyProductAbstractTableMap::COL_COLOR_CODE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [new_from] column to a normalized version of the date/time value specified.
     * The date from which a product is considered 'new'.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setNewFrom($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->new_from !== null || $dt !== null) {
            if ($this->new_from === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->new_from->format("Y-m-d H:i:s.u")) {
                $this->new_from = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyProductAbstractTableMap::COL_NEW_FROM] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [new_to] column to a normalized version of the date/time value specified.
     * The date until which a product is considered 'new'.
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setNewTo($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->new_to !== null || $dt !== null) {
            if ($this->new_to === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->new_to->format("Y-m-d H:i:s.u")) {
                $this->new_to = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyProductAbstractTableMap::COL_NEW_TO] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [sku] column.
     * The Stock Keeping Unit, a unique identifier for a concrete product.
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        // When this is true we will not check for value equality as we need to be able to set a value for this field
        // to its initial value and have the column marked as modified. This is relevant for update cases when
        // we create an instance of an entity manually.
        // @see \Spryker\Zed\Kernel\Persistence\EntityManager\TransferToEntityMapper::mapEntity()
        $hasDefaultValue = false;

        if (($this->isNew() && $hasDefaultValue) || $this->sku !== $v) {
            $this->sku = $v;
            $this->modifiedColumns[SpyProductAbstractTableMap::COL_SKU] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyProductAbstractTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[SpyProductAbstractTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SpyProductAbstractTableMap::translateFieldName('IdProductAbstract', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_product_abstract = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SpyProductAbstractTableMap::translateFieldName('FkTaxSet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->fk_tax_set = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SpyProductAbstractTableMap::translateFieldName('ApprovalStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->approval_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SpyProductAbstractTableMap::translateFieldName('Attributes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->attributes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : SpyProductAbstractTableMap::translateFieldName('ColorCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->color_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : SpyProductAbstractTableMap::translateFieldName('NewFrom', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->new_from = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : SpyProductAbstractTableMap::translateFieldName('NewTo', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->new_to = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : SpyProductAbstractTableMap::translateFieldName('Sku', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sku = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : SpyProductAbstractTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : SpyProductAbstractTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = SpyProductAbstractTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
        if ($this->aSpyTaxSet !== null && $this->fk_tax_set !== $this->aSpyTaxSet->getIdTaxSet()) {
            $this->aSpyTaxSet = null;
        }
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSpyProductAbstractQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aSpyTaxSet = null;
            $this->collSpyCmsBlockProductConnectors = null;

            $this->collSpyMerchantProductAbstracts = null;

            $this->collPriceProducts = null;

            $this->collPriceProductMerchantRelationships = null;

            $this->collPriceProductSchedules = null;

            $this->collSpyProductAbstractLocalizedAttributess = null;

            $this->collSpyProductAbstractStores = null;

            $this->collSpyProducts = null;

            $this->collSpyProductAlternatives = null;

            $this->collSpyProductCategories = null;

            $this->collSpyProductCustomerPermissions = null;

            $this->collSpyProductAbstractGroups = null;

            $this->collSpyProductImageSets = null;

            $this->collSpyProductLabelProductAbstracts = null;

            $this->collSpyProductMeasurementBaseUnits = null;

            $this->collSpyProductAbstractProductOptionGroups = null;

            $this->collSpyProductRelations = null;

            $this->collSpyProductRelationProductAbstracts = null;

            $this->collSpyProductReviews = null;

            $this->collSpyProductAbstractSets = null;

            $this->collSpyUrls = null;

            $this->collSpyProductOptionGroups = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see SpyProductAbstract::setDeleted()
     * @see SpyProductAbstract::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSpyProductAbstractQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                // event behavior

                $this->addDeleteEventToMemory();

                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            // event behavior

            $this->prepareSaveEventName();

            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $time = time();
                $highPrecision = \Propel\Runtime\Util\PropelDateTime::createHighPrecision();
                if (!$this->isColumnModified(SpyProductAbstractTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt($highPrecision);
                }
                if (!$this->isColumnModified(SpyProductAbstractTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt($highPrecision);
                }
                // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
                // phpcs:ignoreFile
                /**
                 * @var string|null $action
                 */
                /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
                $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
                if ($aclEntityFacade->isActive()) {
                    $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
                    $aclEntityMetadataConfigRequestTransfer->setModelName(get_class($this));
                    $aclEntityMetadataConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
                    if (!in_array(get_class($this), $aclEntityMetadataConfigTransfer->getAclEntityAllowList())) {
                        $this->getPersistenceFactory()
                            ->createAclModelDirector($aclEntityMetadataConfigTransfer)
                            ->inspectCreate($this);
                    }
                }

            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(SpyProductAbstractTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(\Propel\Runtime\Util\PropelDateTime::createHighPrecision());
                }
                // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
                // phpcs:ignoreFile
                /**
                 * @var string|null $action
                 */
                /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
                $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
                if ($aclEntityFacade->isActive()) {
                    $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
                    $aclEntityMetadataConfigRequestTransfer->setModelName(get_class($this));
                    $aclEntityMetadataConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
                    if (!in_array(get_class($this), $aclEntityMetadataConfigTransfer->getAclEntityAllowList())) {
                        $this->getPersistenceFactory()
                            ->createAclModelDirector($aclEntityMetadataConfigTransfer)
                            ->inspectUpdate($this);
                    }
                }

            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                // event behavior

                if ($affectedRows) {
                    $this->addSaveEventToMemory();
                }

                SpyProductAbstractTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Code to be run after persisting the object
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

    }

    /**
     * Code to be run after updating the object in database
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

    }

    /**
     * Code to be run after deleting the object in database
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aSpyTaxSet !== null) {
                if ($this->aSpyTaxSet->isModified() || $this->aSpyTaxSet->isNew()) {
                    $affectedRows += $this->aSpyTaxSet->save($con);
                }
                $this->setSpyTaxSet($this->aSpyTaxSet);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->spyProductOptionGroupsScheduledForDeletion !== null) {
                if (!$this->spyProductOptionGroupsScheduledForDeletion->isEmpty()) {
                    $pks = [];
                    foreach ($this->spyProductOptionGroupsScheduledForDeletion as $entry) {
                        $entryPk = [];

                        $entryPk[0] = $this->getIdProductAbstract();
                        $entryPk[1] = $entry->getIdProductOptionGroup();
                        $pks[] = $entryPk;
                    }

                    \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->spyProductOptionGroupsScheduledForDeletion = null;
                }

            }

            if ($this->collSpyProductOptionGroups) {
                foreach ($this->collSpyProductOptionGroups as $spyProductOptionGroup) {
                    if (!$spyProductOptionGroup->isDeleted() && ($spyProductOptionGroup->isNew() || $spyProductOptionGroup->isModified())) {
                        $spyProductOptionGroup->save($con);
                    }
                }
            }


            if ($this->spyCmsBlockProductConnectorsScheduledForDeletion !== null) {
                if (!$this->spyCmsBlockProductConnectorsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery::create()
                        ->filterByPrimaryKeys($this->spyCmsBlockProductConnectorsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyCmsBlockProductConnectorsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyCmsBlockProductConnectors !== null) {
                foreach ($this->collSpyCmsBlockProductConnectors as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyMerchantProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyMerchantProductAbstractsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery::create()
                        ->filterByPrimaryKeys($this->spyMerchantProductAbstractsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyMerchantProductAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyMerchantProductAbstracts !== null) {
                foreach ($this->collSpyMerchantProductAbstracts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->priceProductsScheduledForDeletion !== null) {
                if (!$this->priceProductsScheduledForDeletion->isEmpty()) {
                    foreach ($this->priceProductsScheduledForDeletion as $priceProduct) {
                        // need to save related object because we set the relation to null
                        $priceProduct->save($con);
                    }
                    $this->priceProductsScheduledForDeletion = null;
                }
            }

            if ($this->collPriceProducts !== null) {
                foreach ($this->collPriceProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->priceProductMerchantRelationshipsScheduledForDeletion !== null) {
                if (!$this->priceProductMerchantRelationshipsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery::create()
                        ->filterByPrimaryKeys($this->priceProductMerchantRelationshipsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->priceProductMerchantRelationshipsScheduledForDeletion = null;
                }
            }

            if ($this->collPriceProductMerchantRelationships !== null) {
                foreach ($this->collPriceProductMerchantRelationships as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->priceProductSchedulesScheduledForDeletion !== null) {
                if (!$this->priceProductSchedulesScheduledForDeletion->isEmpty()) {
                    foreach ($this->priceProductSchedulesScheduledForDeletion as $priceProductSchedule) {
                        // need to save related object because we set the relation to null
                        $priceProductSchedule->save($con);
                    }
                    $this->priceProductSchedulesScheduledForDeletion = null;
                }
            }

            if ($this->collPriceProductSchedules !== null) {
                foreach ($this->collPriceProductSchedules as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractLocalizedAttributessScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractLocalizedAttributessScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractLocalizedAttributessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractLocalizedAttributessScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractLocalizedAttributess !== null) {
                foreach ($this->collSpyProductAbstractLocalizedAttributess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractStoresScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractStoresScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractStoresScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractStoresScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractStores !== null) {
                foreach ($this->collSpyProductAbstractStores as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductsScheduledForDeletion !== null) {
                if (!$this->spyProductsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Product\Persistence\SpyProductQuery::create()
                        ->filterByPrimaryKeys($this->spyProductsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProducts !== null) {
                foreach ($this->collSpyProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAlternativesScheduledForDeletion !== null) {
                if (!$this->spyProductAlternativesScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductAlternativesScheduledForDeletion as $spyProductAlternative) {
                        // need to save related object because we set the relation to null
                        $spyProductAlternative->save($con);
                    }
                    $this->spyProductAlternativesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAlternatives !== null) {
                foreach ($this->collSpyProductAlternatives as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductCategoriesScheduledForDeletion !== null) {
                if (!$this->spyProductCategoriesScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery::create()
                        ->filterByPrimaryKeys($this->spyProductCategoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductCategories !== null) {
                foreach ($this->collSpyProductCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductCustomerPermissionsScheduledForDeletion !== null) {
                if (!$this->spyProductCustomerPermissionsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery::create()
                        ->filterByPrimaryKeys($this->spyProductCustomerPermissionsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductCustomerPermissionsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductCustomerPermissions !== null) {
                foreach ($this->collSpyProductCustomerPermissions as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractGroupsScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractGroupsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractGroups !== null) {
                foreach ($this->collSpyProductAbstractGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductImageSetsScheduledForDeletion !== null) {
                if (!$this->spyProductImageSetsScheduledForDeletion->isEmpty()) {
                    foreach ($this->spyProductImageSetsScheduledForDeletion as $spyProductImageSet) {
                        // need to save related object because we set the relation to null
                        $spyProductImageSet->save($con);
                    }
                    $this->spyProductImageSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductImageSets !== null) {
                foreach ($this->collSpyProductImageSets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductLabelProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyProductLabelProductAbstractsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery::create()
                        ->filterByPrimaryKeys($this->spyProductLabelProductAbstractsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductLabelProductAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductLabelProductAbstracts !== null) {
                foreach ($this->collSpyProductLabelProductAbstracts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductMeasurementBaseUnitsScheduledForDeletion !== null) {
                if (!$this->spyProductMeasurementBaseUnitsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery::create()
                        ->filterByPrimaryKeys($this->spyProductMeasurementBaseUnitsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductMeasurementBaseUnitsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductMeasurementBaseUnits !== null) {
                foreach ($this->collSpyProductMeasurementBaseUnits as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractProductOptionGroupsScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractProductOptionGroupsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractProductOptionGroupsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractProductOptionGroupsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractProductOptionGroups !== null) {
                foreach ($this->collSpyProductAbstractProductOptionGroups as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductRelationsScheduledForDeletion !== null) {
                if (!$this->spyProductRelationsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery::create()
                        ->filterByPrimaryKeys($this->spyProductRelationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductRelationsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductRelations !== null) {
                foreach ($this->collSpyProductRelations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductRelationProductAbstractsScheduledForDeletion !== null) {
                if (!$this->spyProductRelationProductAbstractsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery::create()
                        ->filterByPrimaryKeys($this->spyProductRelationProductAbstractsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductRelationProductAbstractsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductRelationProductAbstracts !== null) {
                foreach ($this->collSpyProductRelationProductAbstracts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductReviewsScheduledForDeletion !== null) {
                if (!$this->spyProductReviewsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery::create()
                        ->filterByPrimaryKeys($this->spyProductReviewsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductReviewsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductReviews !== null) {
                foreach ($this->collSpyProductReviews as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyProductAbstractSetsScheduledForDeletion !== null) {
                if (!$this->spyProductAbstractSetsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery::create()
                        ->filterByPrimaryKeys($this->spyProductAbstractSetsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyProductAbstractSetsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyProductAbstractSets !== null) {
                foreach ($this->collSpyProductAbstractSets as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->spyUrlsScheduledForDeletion !== null) {
                if (!$this->spyUrlsScheduledForDeletion->isEmpty()) {
                    \Orm\Zed\Url\Persistence\SpyUrlQuery::create()
                        ->filterByPrimaryKeys($this->spyUrlsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->spyUrlsScheduledForDeletion = null;
                }
            }

            if ($this->collSpyUrls !== null) {
                foreach ($this->collSpyUrls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;

        $this->modifiedColumns[SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT] = true;

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)) {
            $modifiedColumns[':p' . $index++]  = 'id_product_abstract';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_FK_TAX_SET)) {
            $modifiedColumns[':p' . $index++]  = 'fk_tax_set';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_APPROVAL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'approval_status';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_ATTRIBUTES)) {
            $modifiedColumns[':p' . $index++]  = 'attributes';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_COLOR_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'color_code';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_NEW_FROM)) {
            $modifiedColumns[':p' . $index++]  = 'new_from';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_NEW_TO)) {
            $modifiedColumns[':p' . $index++]  = 'new_to';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_SKU)) {
            $modifiedColumns[':p' . $index++]  = 'sku';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO spy_product_abstract (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_product_abstract':
                        $stmt->bindValue($identifier, $this->id_product_abstract, PDO::PARAM_INT);

                        break;
                    case 'fk_tax_set':
                        $stmt->bindValue($identifier, $this->fk_tax_set, PDO::PARAM_INT);

                        break;
                    case 'approval_status':
                        $stmt->bindValue($identifier, $this->approval_status, PDO::PARAM_STR);

                        break;
                    case 'attributes':
                        $stmt->bindValue($identifier, $this->attributes, PDO::PARAM_STR);

                        break;
                    case 'color_code':
                        $stmt->bindValue($identifier, $this->color_code, PDO::PARAM_STR);

                        break;
                    case 'new_from':
                        $stmt->bindValue($identifier, $this->new_from ? $this->new_from->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'new_to':
                        $stmt->bindValue($identifier, $this->new_to ? $this->new_to->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'sku':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);

                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId('spy_product_abstract_pk_seq');
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        if ($pk !== null) {
            $this->setIdProductAbstract($pk);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_FIELDNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyProductAbstractTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdProductAbstract();

            case 1:
                return $this->getFkTaxSet();

            case 2:
                return $this->getApprovalStatus();

            case 3:
                return $this->getAttributes();

            case 4:
                return $this->getColorCode();

            case 5:
                return $this->getNewFrom();

            case 6:
                return $this->getNewTo();

            case 7:
                return $this->getSku();

            case 8:
                return $this->getCreatedAt();

            case 9:
                return $this->getUpdatedAt();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_FIELDNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_FIELDNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['SpyProductAbstract'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['SpyProductAbstract'][$this->hashCode()] = true;
        $keys = SpyProductAbstractTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getIdProductAbstract(),
            $keys[1] => $this->getFkTaxSet(),
            $keys[2] => $this->getApprovalStatus(),
            $keys[3] => $this->getAttributes(),
            $keys[4] => $this->getColorCode(),
            $keys[5] => $this->getNewFrom(),
            $keys[6] => $this->getNewTo(),
            $keys[7] => $this->getSku(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aSpyTaxSet) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyTaxSet';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_tax_set';
                        break;
                    default:
                        $key = 'SpyTaxSet';
                }

                $result[$key] = $this->aSpyTaxSet->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collSpyCmsBlockProductConnectors) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyCmsBlockProductConnectors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_cms_block_product_connectors';
                        break;
                    default:
                        $key = 'SpyCmsBlockProductConnectors';
                }

                $result[$key] = $this->collSpyCmsBlockProductConnectors->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyMerchantProductAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyMerchantProductAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_merchant_product_abstracts';
                        break;
                    default:
                        $key = 'SpyMerchantProductAbstracts';
                }

                $result[$key] = $this->collSpyMerchantProductAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPriceProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProducts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_products';
                        break;
                    default:
                        $key = 'PriceProducts';
                }

                $result[$key] = $this->collPriceProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPriceProductMerchantRelationships) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProductMerchantRelationships';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_product_merchant_relationships';
                        break;
                    default:
                        $key = 'PriceProductMerchantRelationships';
                }

                $result[$key] = $this->collPriceProductMerchantRelationships->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPriceProductSchedules) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyPriceProductSchedules';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_price_product_schedules';
                        break;
                    default:
                        $key = 'PriceProductSchedules';
                }

                $result[$key] = $this->collPriceProductSchedules->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractLocalizedAttributess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractLocalizedAttributess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_localized_attributess';
                        break;
                    default:
                        $key = 'SpyProductAbstractLocalizedAttributess';
                }

                $result[$key] = $this->collSpyProductAbstractLocalizedAttributess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractStores) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractStores';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_stores';
                        break;
                    default:
                        $key = 'SpyProductAbstractStores';
                }

                $result[$key] = $this->collSpyProductAbstractStores->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProducts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_products';
                        break;
                    default:
                        $key = 'SpyProducts';
                }

                $result[$key] = $this->collSpyProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAlternatives) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAlternatives';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_alternatives';
                        break;
                    default:
                        $key = 'SpyProductAlternatives';
                }

                $result[$key] = $this->collSpyProductAlternatives->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductCategories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductCategories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_categories';
                        break;
                    default:
                        $key = 'SpyProductCategories';
                }

                $result[$key] = $this->collSpyProductCategories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductCustomerPermissions) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductCustomerPermissions';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_customer_permissions';
                        break;
                    default:
                        $key = 'SpyProductCustomerPermissions';
                }

                $result[$key] = $this->collSpyProductCustomerPermissions->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_groups';
                        break;
                    default:
                        $key = 'SpyProductAbstractGroups';
                }

                $result[$key] = $this->collSpyProductAbstractGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductImageSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductImageSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_image_sets';
                        break;
                    default:
                        $key = 'SpyProductImageSets';
                }

                $result[$key] = $this->collSpyProductImageSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductLabelProductAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductLabelProductAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_label_product_abstracts';
                        break;
                    default:
                        $key = 'SpyProductLabelProductAbstracts';
                }

                $result[$key] = $this->collSpyProductLabelProductAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductMeasurementBaseUnits) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductMeasurementBaseUnits';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_measurement_base_units';
                        break;
                    default:
                        $key = 'SpyProductMeasurementBaseUnits';
                }

                $result[$key] = $this->collSpyProductMeasurementBaseUnits->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractProductOptionGroups) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractProductOptionGroups';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_product_option_groups';
                        break;
                    default:
                        $key = 'SpyProductAbstractProductOptionGroups';
                }

                $result[$key] = $this->collSpyProductAbstractProductOptionGroups->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductRelations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductRelations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_relations';
                        break;
                    default:
                        $key = 'SpyProductRelations';
                }

                $result[$key] = $this->collSpyProductRelations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductRelationProductAbstracts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductRelationProductAbstracts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_relation_product_abstracts';
                        break;
                    default:
                        $key = 'SpyProductRelationProductAbstracts';
                }

                $result[$key] = $this->collSpyProductRelationProductAbstracts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductReviews) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductReviews';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_reviews';
                        break;
                    default:
                        $key = 'SpyProductReviews';
                }

                $result[$key] = $this->collSpyProductReviews->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyProductAbstractSets) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyProductAbstractSets';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_product_abstract_sets';
                        break;
                    default:
                        $key = 'SpyProductAbstractSets';
                }

                $result[$key] = $this->collSpyProductAbstractSets->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSpyUrls) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'spyUrls';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'spy_urls';
                        break;
                    default:
                        $key = 'SpyUrls';
                }

                $result[$key] = $this->collSpyUrls->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_FIELDNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_FIELDNAME)
    {
        $pos = SpyProductAbstractTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdProductAbstract($value);
                break;
            case 1:
                $this->setFkTaxSet($value);
                break;
            case 2:
                $this->setApprovalStatus($value);
                break;
            case 3:
                $this->setAttributes($value);
                break;
            case 4:
                $this->setColorCode($value);
                break;
            case 5:
                $this->setNewFrom($value);
                break;
            case 6:
                $this->setNewTo($value);
                break;
            case 7:
                $this->setSku($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_FIELDNAME)
    {
        $keys = SpyProductAbstractTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdProductAbstract($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFkTaxSet($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setApprovalStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAttributes($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setColorCode($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setNewFrom($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNewTo($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSku($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCreatedAt($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUpdatedAt($arr[$keys[9]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_FIELDNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_FIELDNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(SpyProductAbstractTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT)) {
            $criteria->add(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $this->id_product_abstract);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_FK_TAX_SET)) {
            $criteria->add(SpyProductAbstractTableMap::COL_FK_TAX_SET, $this->fk_tax_set);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_APPROVAL_STATUS)) {
            $criteria->add(SpyProductAbstractTableMap::COL_APPROVAL_STATUS, $this->approval_status);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_ATTRIBUTES)) {
            $criteria->add(SpyProductAbstractTableMap::COL_ATTRIBUTES, $this->attributes);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_COLOR_CODE)) {
            $criteria->add(SpyProductAbstractTableMap::COL_COLOR_CODE, $this->color_code);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_NEW_FROM)) {
            $criteria->add(SpyProductAbstractTableMap::COL_NEW_FROM, $this->new_from);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_NEW_TO)) {
            $criteria->add(SpyProductAbstractTableMap::COL_NEW_TO, $this->new_to);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_SKU)) {
            $criteria->add(SpyProductAbstractTableMap::COL_SKU, $this->sku);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_CREATED_AT)) {
            $criteria->add(SpyProductAbstractTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(SpyProductAbstractTableMap::COL_UPDATED_AT)) {
            $criteria->add(SpyProductAbstractTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildSpyProductAbstractQuery::create();
        $criteria->add(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $this->id_product_abstract);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdProductAbstract();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdProductAbstract();
    }

    /**
     * Generic method to set the primary key (id_product_abstract column).
     *
     * @param int|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setIdProductAbstract($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getIdProductAbstract();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \Orm\Zed\Product\Persistence\SpyProductAbstract (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setFkTaxSet($this->getFkTaxSet());
        $copyObj->setApprovalStatus($this->getApprovalStatus());
        $copyObj->setAttributes($this->getAttributes());
        $copyObj->setColorCode($this->getColorCode());
        $copyObj->setNewFrom($this->getNewFrom());
        $copyObj->setNewTo($this->getNewTo());
        $copyObj->setSku($this->getSku());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSpyCmsBlockProductConnectors() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyCmsBlockProductConnector($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyMerchantProductAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyMerchantProductAbstract($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPriceProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPriceProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPriceProductMerchantRelationships() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPriceProductMerchantRelationship($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPriceProductSchedules() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPriceProductSchedule($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractLocalizedAttributess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractLocalizedAttributes($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractStores() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractStore($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAlternatives() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAlternative($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductCustomerPermissions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductCustomerPermission($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductImageSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductImageSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductLabelProductAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductLabelProductAbstract($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductMeasurementBaseUnits() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductMeasurementBaseUnit($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractProductOptionGroups() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractProductOptionGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductRelations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductRelation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductRelationProductAbstracts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductRelationProductAbstract($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductReviews() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductReview($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyProductAbstractSets() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyProductAbstractSet($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSpyUrls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSpyUrl($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdProductAbstract(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstract Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a SpyTaxSet object.
     *
     * @param SpyTaxSet|null $v
     * @return $this The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setSpyTaxSet(SpyTaxSet $v = null)
    {
        if ($v === null) {
            $this->setFkTaxSet(NULL);
        } else {
            $this->setFkTaxSet($v->getIdTaxSet());
        }

        $this->aSpyTaxSet = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the SpyTaxSet object, it will not be re-added.
        if ($v !== null) {
            $v->addSpyProductAbstract($this);
        }


        return $this;
    }


    /**
     * Get the associated SpyTaxSet object
     *
     * @param ConnectionInterface $con Optional Connection object.
     * @return SpyTaxSet|null The associated SpyTaxSet object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyTaxSet(?ConnectionInterface $con = null)
    {
        if ($this->aSpyTaxSet === null && ($this->fk_tax_set != 0)) {
            $this->aSpyTaxSet = SpyTaxSetQuery::create()->findPk($this->fk_tax_set, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSpyTaxSet->addSpyProductAbstracts($this);
             */
        }

        return $this->aSpyTaxSet;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('SpyCmsBlockProductConnector' === $relationName) {
            $this->initSpyCmsBlockProductConnectors();
            return;
        }
        if ('SpyMerchantProductAbstract' === $relationName) {
            $this->initSpyMerchantProductAbstracts();
            return;
        }
        if ('PriceProduct' === $relationName) {
            $this->initPriceProducts();
            return;
        }
        if ('PriceProductMerchantRelationship' === $relationName) {
            $this->initPriceProductMerchantRelationships();
            return;
        }
        if ('PriceProductSchedule' === $relationName) {
            $this->initPriceProductSchedules();
            return;
        }
        if ('SpyProductAbstractLocalizedAttributes' === $relationName) {
            $this->initSpyProductAbstractLocalizedAttributess();
            return;
        }
        if ('SpyProductAbstractStore' === $relationName) {
            $this->initSpyProductAbstractStores();
            return;
        }
        if ('SpyProduct' === $relationName) {
            $this->initSpyProducts();
            return;
        }
        if ('SpyProductAlternative' === $relationName) {
            $this->initSpyProductAlternatives();
            return;
        }
        if ('SpyProductCategory' === $relationName) {
            $this->initSpyProductCategories();
            return;
        }
        if ('SpyProductCustomerPermission' === $relationName) {
            $this->initSpyProductCustomerPermissions();
            return;
        }
        if ('SpyProductAbstractGroup' === $relationName) {
            $this->initSpyProductAbstractGroups();
            return;
        }
        if ('SpyProductImageSet' === $relationName) {
            $this->initSpyProductImageSets();
            return;
        }
        if ('SpyProductLabelProductAbstract' === $relationName) {
            $this->initSpyProductLabelProductAbstracts();
            return;
        }
        if ('SpyProductMeasurementBaseUnit' === $relationName) {
            $this->initSpyProductMeasurementBaseUnits();
            return;
        }
        if ('SpyProductAbstractProductOptionGroup' === $relationName) {
            $this->initSpyProductAbstractProductOptionGroups();
            return;
        }
        if ('SpyProductRelation' === $relationName) {
            $this->initSpyProductRelations();
            return;
        }
        if ('SpyProductRelationProductAbstract' === $relationName) {
            $this->initSpyProductRelationProductAbstracts();
            return;
        }
        if ('SpyProductReview' === $relationName) {
            $this->initSpyProductReviews();
            return;
        }
        if ('SpyProductAbstractSet' === $relationName) {
            $this->initSpyProductAbstractSets();
            return;
        }
        if ('SpyUrl' === $relationName) {
            $this->initSpyUrls();
            return;
        }
    }

    /**
     * Clears out the collSpyCmsBlockProductConnectors collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyCmsBlockProductConnectors()
     */
    public function clearSpyCmsBlockProductConnectors()
    {
        $this->collSpyCmsBlockProductConnectors = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyCmsBlockProductConnectors collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyCmsBlockProductConnectors($v = true): void
    {
        $this->collSpyCmsBlockProductConnectorsPartial = $v;
    }

    /**
     * Initializes the collSpyCmsBlockProductConnectors collection.
     *
     * By default this just sets the collSpyCmsBlockProductConnectors collection to an empty array (like clearcollSpyCmsBlockProductConnectors());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyCmsBlockProductConnectors(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyCmsBlockProductConnectors && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyCmsBlockProductConnectorTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyCmsBlockProductConnectors = new $collectionClassName;
        $this->collSpyCmsBlockProductConnectors->setModel('\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector');
    }

    /**
     * Gets an array of SpyCmsBlockProductConnector objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyCmsBlockProductConnector[] List of SpyCmsBlockProductConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockProductConnector> List of SpyCmsBlockProductConnector objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyCmsBlockProductConnectors(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyCmsBlockProductConnectorsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockProductConnectors || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyCmsBlockProductConnectors) {
                    $this->initSpyCmsBlockProductConnectors();
                } else {
                    $collectionClassName = SpyCmsBlockProductConnectorTableMap::getTableMap()->getCollectionClassName();

                    $collSpyCmsBlockProductConnectors = new $collectionClassName;
                    $collSpyCmsBlockProductConnectors->setModel('\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector');

                    return $collSpyCmsBlockProductConnectors;
                }
            } else {
                $collSpyCmsBlockProductConnectors = SpyCmsBlockProductConnectorQuery::create(null, $criteria)
                    ->filterByProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyCmsBlockProductConnectorsPartial && count($collSpyCmsBlockProductConnectors)) {
                        $this->initSpyCmsBlockProductConnectors(false);

                        foreach ($collSpyCmsBlockProductConnectors as $obj) {
                            if (false == $this->collSpyCmsBlockProductConnectors->contains($obj)) {
                                $this->collSpyCmsBlockProductConnectors->append($obj);
                            }
                        }

                        $this->collSpyCmsBlockProductConnectorsPartial = true;
                    }

                    return $collSpyCmsBlockProductConnectors;
                }

                if ($partial && $this->collSpyCmsBlockProductConnectors) {
                    foreach ($this->collSpyCmsBlockProductConnectors as $obj) {
                        if ($obj->isNew()) {
                            $collSpyCmsBlockProductConnectors[] = $obj;
                        }
                    }
                }

                $this->collSpyCmsBlockProductConnectors = $collSpyCmsBlockProductConnectors;
                $this->collSpyCmsBlockProductConnectorsPartial = false;
            }
        }

        return $this->collSpyCmsBlockProductConnectors;
    }

    /**
     * Sets a collection of SpyCmsBlockProductConnector objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyCmsBlockProductConnectors A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyCmsBlockProductConnectors(Collection $spyCmsBlockProductConnectors, ?ConnectionInterface $con = null)
    {
        /** @var SpyCmsBlockProductConnector[] $spyCmsBlockProductConnectorsToDelete */
        $spyCmsBlockProductConnectorsToDelete = $this->getSpyCmsBlockProductConnectors(new Criteria(), $con)->diff($spyCmsBlockProductConnectors);


        $this->spyCmsBlockProductConnectorsScheduledForDeletion = $spyCmsBlockProductConnectorsToDelete;

        foreach ($spyCmsBlockProductConnectorsToDelete as $spyCmsBlockProductConnectorRemoved) {
            $spyCmsBlockProductConnectorRemoved->setProductAbstract(null);
        }

        $this->collSpyCmsBlockProductConnectors = null;
        foreach ($spyCmsBlockProductConnectors as $spyCmsBlockProductConnector) {
            $this->addSpyCmsBlockProductConnector($spyCmsBlockProductConnector);
        }

        $this->collSpyCmsBlockProductConnectors = $spyCmsBlockProductConnectors;
        $this->collSpyCmsBlockProductConnectorsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyCmsBlockProductConnector objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyCmsBlockProductConnector objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyCmsBlockProductConnectors(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyCmsBlockProductConnectorsPartial && !$this->isNew();
        if (null === $this->collSpyCmsBlockProductConnectors || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyCmsBlockProductConnectors) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyCmsBlockProductConnectors());
            }

            $query = SpyCmsBlockProductConnectorQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyCmsBlockProductConnectors);
    }

    /**
     * Method called to associate a SpyCmsBlockProductConnector object to this object
     * through the SpyCmsBlockProductConnector foreign key attribute.
     *
     * @param SpyCmsBlockProductConnector $l SpyCmsBlockProductConnector
     * @return $this The current object (for fluent API support)
     */
    public function addSpyCmsBlockProductConnector(SpyCmsBlockProductConnector $l)
    {
        if ($this->collSpyCmsBlockProductConnectors === null) {
            $this->initSpyCmsBlockProductConnectors();
            $this->collSpyCmsBlockProductConnectorsPartial = true;
        }

        if (!$this->collSpyCmsBlockProductConnectors->contains($l)) {
            $this->doAddSpyCmsBlockProductConnector($l);

            if ($this->spyCmsBlockProductConnectorsScheduledForDeletion and $this->spyCmsBlockProductConnectorsScheduledForDeletion->contains($l)) {
                $this->spyCmsBlockProductConnectorsScheduledForDeletion->remove($this->spyCmsBlockProductConnectorsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyCmsBlockProductConnector $spyCmsBlockProductConnector The SpyCmsBlockProductConnector object to add.
     */
    protected function doAddSpyCmsBlockProductConnector(SpyCmsBlockProductConnector $spyCmsBlockProductConnector): void
    {
        $this->collSpyCmsBlockProductConnectors[]= $spyCmsBlockProductConnector;
        $spyCmsBlockProductConnector->setProductAbstract($this);
    }

    /**
     * @param SpyCmsBlockProductConnector $spyCmsBlockProductConnector The SpyCmsBlockProductConnector object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyCmsBlockProductConnector(SpyCmsBlockProductConnector $spyCmsBlockProductConnector)
    {
        if ($this->getSpyCmsBlockProductConnectors()->contains($spyCmsBlockProductConnector)) {
            $pos = $this->collSpyCmsBlockProductConnectors->search($spyCmsBlockProductConnector);
            $this->collSpyCmsBlockProductConnectors->remove($pos);
            if (null === $this->spyCmsBlockProductConnectorsScheduledForDeletion) {
                $this->spyCmsBlockProductConnectorsScheduledForDeletion = clone $this->collSpyCmsBlockProductConnectors;
                $this->spyCmsBlockProductConnectorsScheduledForDeletion->clear();
            }
            $this->spyCmsBlockProductConnectorsScheduledForDeletion[]= clone $spyCmsBlockProductConnector;
            $spyCmsBlockProductConnector->setProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyCmsBlockProductConnectors from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyCmsBlockProductConnector[] List of SpyCmsBlockProductConnector objects
     * @phpstan-return ObjectCollection&\Traversable<SpyCmsBlockProductConnector}> List of SpyCmsBlockProductConnector objects
     */
    public function getSpyCmsBlockProductConnectorsJoinCmsBlock(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyCmsBlockProductConnectorQuery::create(null, $criteria);
        $query->joinWith('CmsBlock', $joinBehavior);

        return $this->getSpyCmsBlockProductConnectors($query, $con);
    }

    /**
     * Clears out the collSpyMerchantProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyMerchantProductAbstracts()
     */
    public function clearSpyMerchantProductAbstracts()
    {
        $this->collSpyMerchantProductAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyMerchantProductAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyMerchantProductAbstracts($v = true): void
    {
        $this->collSpyMerchantProductAbstractsPartial = $v;
    }

    /**
     * Initializes the collSpyMerchantProductAbstracts collection.
     *
     * By default this just sets the collSpyMerchantProductAbstracts collection to an empty array (like clearcollSpyMerchantProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyMerchantProductAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyMerchantProductAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyMerchantProductAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyMerchantProductAbstracts = new $collectionClassName;
        $this->collSpyMerchantProductAbstracts->setModel('\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract');
    }

    /**
     * Gets an array of SpyMerchantProductAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyMerchantProductAbstract[] List of SpyMerchantProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProductAbstract> List of SpyMerchantProductAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyMerchantProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyMerchantProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyMerchantProductAbstracts) {
                    $this->initSpyMerchantProductAbstracts();
                } else {
                    $collectionClassName = SpyMerchantProductAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collSpyMerchantProductAbstracts = new $collectionClassName;
                    $collSpyMerchantProductAbstracts->setModel('\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract');

                    return $collSpyMerchantProductAbstracts;
                }
            } else {
                $collSpyMerchantProductAbstracts = SpyMerchantProductAbstractQuery::create(null, $criteria)
                    ->filterByProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyMerchantProductAbstractsPartial && count($collSpyMerchantProductAbstracts)) {
                        $this->initSpyMerchantProductAbstracts(false);

                        foreach ($collSpyMerchantProductAbstracts as $obj) {
                            if (false == $this->collSpyMerchantProductAbstracts->contains($obj)) {
                                $this->collSpyMerchantProductAbstracts->append($obj);
                            }
                        }

                        $this->collSpyMerchantProductAbstractsPartial = true;
                    }

                    return $collSpyMerchantProductAbstracts;
                }

                if ($partial && $this->collSpyMerchantProductAbstracts) {
                    foreach ($this->collSpyMerchantProductAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyMerchantProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyMerchantProductAbstracts = $collSpyMerchantProductAbstracts;
                $this->collSpyMerchantProductAbstractsPartial = false;
            }
        }

        return $this->collSpyMerchantProductAbstracts;
    }

    /**
     * Sets a collection of SpyMerchantProductAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyMerchantProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyMerchantProductAbstracts(Collection $spyMerchantProductAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var SpyMerchantProductAbstract[] $spyMerchantProductAbstractsToDelete */
        $spyMerchantProductAbstractsToDelete = $this->getSpyMerchantProductAbstracts(new Criteria(), $con)->diff($spyMerchantProductAbstracts);


        $this->spyMerchantProductAbstractsScheduledForDeletion = $spyMerchantProductAbstractsToDelete;

        foreach ($spyMerchantProductAbstractsToDelete as $spyMerchantProductAbstractRemoved) {
            $spyMerchantProductAbstractRemoved->setProductAbstract(null);
        }

        $this->collSpyMerchantProductAbstracts = null;
        foreach ($spyMerchantProductAbstracts as $spyMerchantProductAbstract) {
            $this->addSpyMerchantProductAbstract($spyMerchantProductAbstract);
        }

        $this->collSpyMerchantProductAbstracts = $spyMerchantProductAbstracts;
        $this->collSpyMerchantProductAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyMerchantProductAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyMerchantProductAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyMerchantProductAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyMerchantProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyMerchantProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyMerchantProductAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyMerchantProductAbstracts());
            }

            $query = SpyMerchantProductAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyMerchantProductAbstracts);
    }

    /**
     * Method called to associate a SpyMerchantProductAbstract object to this object
     * through the SpyMerchantProductAbstract foreign key attribute.
     *
     * @param SpyMerchantProductAbstract $l SpyMerchantProductAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addSpyMerchantProductAbstract(SpyMerchantProductAbstract $l)
    {
        if ($this->collSpyMerchantProductAbstracts === null) {
            $this->initSpyMerchantProductAbstracts();
            $this->collSpyMerchantProductAbstractsPartial = true;
        }

        if (!$this->collSpyMerchantProductAbstracts->contains($l)) {
            $this->doAddSpyMerchantProductAbstract($l);

            if ($this->spyMerchantProductAbstractsScheduledForDeletion and $this->spyMerchantProductAbstractsScheduledForDeletion->contains($l)) {
                $this->spyMerchantProductAbstractsScheduledForDeletion->remove($this->spyMerchantProductAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyMerchantProductAbstract $spyMerchantProductAbstract The SpyMerchantProductAbstract object to add.
     */
    protected function doAddSpyMerchantProductAbstract(SpyMerchantProductAbstract $spyMerchantProductAbstract): void
    {
        $this->collSpyMerchantProductAbstracts[]= $spyMerchantProductAbstract;
        $spyMerchantProductAbstract->setProductAbstract($this);
    }

    /**
     * @param SpyMerchantProductAbstract $spyMerchantProductAbstract The SpyMerchantProductAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyMerchantProductAbstract(SpyMerchantProductAbstract $spyMerchantProductAbstract)
    {
        if ($this->getSpyMerchantProductAbstracts()->contains($spyMerchantProductAbstract)) {
            $pos = $this->collSpyMerchantProductAbstracts->search($spyMerchantProductAbstract);
            $this->collSpyMerchantProductAbstracts->remove($pos);
            if (null === $this->spyMerchantProductAbstractsScheduledForDeletion) {
                $this->spyMerchantProductAbstractsScheduledForDeletion = clone $this->collSpyMerchantProductAbstracts;
                $this->spyMerchantProductAbstractsScheduledForDeletion->clear();
            }
            $this->spyMerchantProductAbstractsScheduledForDeletion[]= clone $spyMerchantProductAbstract;
            $spyMerchantProductAbstract->setProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyMerchantProductAbstracts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyMerchantProductAbstract[] List of SpyMerchantProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyMerchantProductAbstract}> List of SpyMerchantProductAbstract objects
     */
    public function getSpyMerchantProductAbstractsJoinMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyMerchantProductAbstractQuery::create(null, $criteria);
        $query->joinWith('Merchant', $joinBehavior);

        return $this->getSpyMerchantProductAbstracts($query, $con);
    }

    /**
     * Clears out the collPriceProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPriceProducts()
     */
    public function clearPriceProducts()
    {
        $this->collPriceProducts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPriceProducts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPriceProducts($v = true): void
    {
        $this->collPriceProductsPartial = $v;
    }

    /**
     * Initializes the collPriceProducts collection.
     *
     * By default this just sets the collPriceProducts collection to an empty array (like clearcollPriceProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPriceProducts(bool $overrideExisting = true): void
    {
        if (null !== $this->collPriceProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPriceProductTableMap::getTableMap()->getCollectionClassName();

        $this->collPriceProducts = new $collectionClassName;
        $this->collPriceProducts->setModel('\Orm\Zed\PriceProduct\Persistence\SpyPriceProduct');
    }

    /**
     * Gets an array of SpyPriceProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPriceProduct[] List of SpyPriceProduct objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProduct> List of SpyPriceProduct objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPriceProductsPartial && !$this->isNew();
        if (null === $this->collPriceProducts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPriceProducts) {
                    $this->initPriceProducts();
                } else {
                    $collectionClassName = SpyPriceProductTableMap::getTableMap()->getCollectionClassName();

                    $collPriceProducts = new $collectionClassName;
                    $collPriceProducts->setModel('\Orm\Zed\PriceProduct\Persistence\SpyPriceProduct');

                    return $collPriceProducts;
                }
            } else {
                $collPriceProducts = SpyPriceProductQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPriceProductsPartial && count($collPriceProducts)) {
                        $this->initPriceProducts(false);

                        foreach ($collPriceProducts as $obj) {
                            if (false == $this->collPriceProducts->contains($obj)) {
                                $this->collPriceProducts->append($obj);
                            }
                        }

                        $this->collPriceProductsPartial = true;
                    }

                    return $collPriceProducts;
                }

                if ($partial && $this->collPriceProducts) {
                    foreach ($this->collPriceProducts as $obj) {
                        if ($obj->isNew()) {
                            $collPriceProducts[] = $obj;
                        }
                    }
                }

                $this->collPriceProducts = $collPriceProducts;
                $this->collPriceProductsPartial = false;
            }
        }

        return $this->collPriceProducts;
    }

    /**
     * Sets a collection of SpyPriceProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $priceProducts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPriceProducts(Collection $priceProducts, ?ConnectionInterface $con = null)
    {
        /** @var SpyPriceProduct[] $priceProductsToDelete */
        $priceProductsToDelete = $this->getPriceProducts(new Criteria(), $con)->diff($priceProducts);


        $this->priceProductsScheduledForDeletion = $priceProductsToDelete;

        foreach ($priceProductsToDelete as $priceProductRemoved) {
            $priceProductRemoved->setSpyProductAbstract(null);
        }

        $this->collPriceProducts = null;
        foreach ($priceProducts as $priceProduct) {
            $this->addPriceProduct($priceProduct);
        }

        $this->collPriceProducts = $priceProducts;
        $this->collPriceProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPriceProduct objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPriceProduct objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPriceProducts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPriceProductsPartial && !$this->isNew();
        if (null === $this->collPriceProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPriceProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPriceProducts());
            }

            $query = SpyPriceProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collPriceProducts);
    }

    /**
     * Method called to associate a SpyPriceProduct object to this object
     * through the SpyPriceProduct foreign key attribute.
     *
     * @param SpyPriceProduct $l SpyPriceProduct
     * @return $this The current object (for fluent API support)
     */
    public function addPriceProduct(SpyPriceProduct $l)
    {
        if ($this->collPriceProducts === null) {
            $this->initPriceProducts();
            $this->collPriceProductsPartial = true;
        }

        if (!$this->collPriceProducts->contains($l)) {
            $this->doAddPriceProduct($l);

            if ($this->priceProductsScheduledForDeletion and $this->priceProductsScheduledForDeletion->contains($l)) {
                $this->priceProductsScheduledForDeletion->remove($this->priceProductsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPriceProduct $priceProduct The SpyPriceProduct object to add.
     */
    protected function doAddPriceProduct(SpyPriceProduct $priceProduct): void
    {
        $this->collPriceProducts[]= $priceProduct;
        $priceProduct->setSpyProductAbstract($this);
    }

    /**
     * @param SpyPriceProduct $priceProduct The SpyPriceProduct object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePriceProduct(SpyPriceProduct $priceProduct)
    {
        if ($this->getPriceProducts()->contains($priceProduct)) {
            $pos = $this->collPriceProducts->search($priceProduct);
            $this->collPriceProducts->remove($pos);
            if (null === $this->priceProductsScheduledForDeletion) {
                $this->priceProductsScheduledForDeletion = clone $this->collPriceProducts;
                $this->priceProductsScheduledForDeletion->clear();
            }
            $this->priceProductsScheduledForDeletion[]= $priceProduct;
            $priceProduct->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProducts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProduct[] List of SpyPriceProduct objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProduct}> List of SpyPriceProduct objects
     */
    public function getPriceProductsJoinProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getPriceProducts($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProducts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProduct[] List of SpyPriceProduct objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProduct}> List of SpyPriceProduct objects
     */
    public function getPriceProductsJoinPriceType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductQuery::create(null, $criteria);
        $query->joinWith('PriceType', $joinBehavior);

        return $this->getPriceProducts($query, $con);
    }

    /**
     * Clears out the collPriceProductMerchantRelationships collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPriceProductMerchantRelationships()
     */
    public function clearPriceProductMerchantRelationships()
    {
        $this->collPriceProductMerchantRelationships = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPriceProductMerchantRelationships collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPriceProductMerchantRelationships($v = true): void
    {
        $this->collPriceProductMerchantRelationshipsPartial = $v;
    }

    /**
     * Initializes the collPriceProductMerchantRelationships collection.
     *
     * By default this just sets the collPriceProductMerchantRelationships collection to an empty array (like clearcollPriceProductMerchantRelationships());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPriceProductMerchantRelationships(bool $overrideExisting = true): void
    {
        if (null !== $this->collPriceProductMerchantRelationships && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPriceProductMerchantRelationshipTableMap::getTableMap()->getCollectionClassName();

        $this->collPriceProductMerchantRelationships = new $collectionClassName;
        $this->collPriceProductMerchantRelationships->setModel('\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship');
    }

    /**
     * Gets an array of SpyPriceProductMerchantRelationship objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPriceProductMerchantRelationship[] List of SpyPriceProductMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductMerchantRelationship> List of SpyPriceProductMerchantRelationship objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceProductMerchantRelationships(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPriceProductMerchantRelationshipsPartial && !$this->isNew();
        if (null === $this->collPriceProductMerchantRelationships || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPriceProductMerchantRelationships) {
                    $this->initPriceProductMerchantRelationships();
                } else {
                    $collectionClassName = SpyPriceProductMerchantRelationshipTableMap::getTableMap()->getCollectionClassName();

                    $collPriceProductMerchantRelationships = new $collectionClassName;
                    $collPriceProductMerchantRelationships->setModel('\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship');

                    return $collPriceProductMerchantRelationships;
                }
            } else {
                $collPriceProductMerchantRelationships = SpyPriceProductMerchantRelationshipQuery::create(null, $criteria)
                    ->filterByProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPriceProductMerchantRelationshipsPartial && count($collPriceProductMerchantRelationships)) {
                        $this->initPriceProductMerchantRelationships(false);

                        foreach ($collPriceProductMerchantRelationships as $obj) {
                            if (false == $this->collPriceProductMerchantRelationships->contains($obj)) {
                                $this->collPriceProductMerchantRelationships->append($obj);
                            }
                        }

                        $this->collPriceProductMerchantRelationshipsPartial = true;
                    }

                    return $collPriceProductMerchantRelationships;
                }

                if ($partial && $this->collPriceProductMerchantRelationships) {
                    foreach ($this->collPriceProductMerchantRelationships as $obj) {
                        if ($obj->isNew()) {
                            $collPriceProductMerchantRelationships[] = $obj;
                        }
                    }
                }

                $this->collPriceProductMerchantRelationships = $collPriceProductMerchantRelationships;
                $this->collPriceProductMerchantRelationshipsPartial = false;
            }
        }

        return $this->collPriceProductMerchantRelationships;
    }

    /**
     * Sets a collection of SpyPriceProductMerchantRelationship objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $priceProductMerchantRelationships A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPriceProductMerchantRelationships(Collection $priceProductMerchantRelationships, ?ConnectionInterface $con = null)
    {
        /** @var SpyPriceProductMerchantRelationship[] $priceProductMerchantRelationshipsToDelete */
        $priceProductMerchantRelationshipsToDelete = $this->getPriceProductMerchantRelationships(new Criteria(), $con)->diff($priceProductMerchantRelationships);


        $this->priceProductMerchantRelationshipsScheduledForDeletion = $priceProductMerchantRelationshipsToDelete;

        foreach ($priceProductMerchantRelationshipsToDelete as $priceProductMerchantRelationshipRemoved) {
            $priceProductMerchantRelationshipRemoved->setProductAbstract(null);
        }

        $this->collPriceProductMerchantRelationships = null;
        foreach ($priceProductMerchantRelationships as $priceProductMerchantRelationship) {
            $this->addPriceProductMerchantRelationship($priceProductMerchantRelationship);
        }

        $this->collPriceProductMerchantRelationships = $priceProductMerchantRelationships;
        $this->collPriceProductMerchantRelationshipsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPriceProductMerchantRelationship objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPriceProductMerchantRelationship objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPriceProductMerchantRelationships(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPriceProductMerchantRelationshipsPartial && !$this->isNew();
        if (null === $this->collPriceProductMerchantRelationships || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPriceProductMerchantRelationships) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPriceProductMerchantRelationships());
            }

            $query = SpyPriceProductMerchantRelationshipQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstract($this)
                ->count($con);
        }

        return count($this->collPriceProductMerchantRelationships);
    }

    /**
     * Method called to associate a SpyPriceProductMerchantRelationship object to this object
     * through the SpyPriceProductMerchantRelationship foreign key attribute.
     *
     * @param SpyPriceProductMerchantRelationship $l SpyPriceProductMerchantRelationship
     * @return $this The current object (for fluent API support)
     */
    public function addPriceProductMerchantRelationship(SpyPriceProductMerchantRelationship $l)
    {
        if ($this->collPriceProductMerchantRelationships === null) {
            $this->initPriceProductMerchantRelationships();
            $this->collPriceProductMerchantRelationshipsPartial = true;
        }

        if (!$this->collPriceProductMerchantRelationships->contains($l)) {
            $this->doAddPriceProductMerchantRelationship($l);

            if ($this->priceProductMerchantRelationshipsScheduledForDeletion and $this->priceProductMerchantRelationshipsScheduledForDeletion->contains($l)) {
                $this->priceProductMerchantRelationshipsScheduledForDeletion->remove($this->priceProductMerchantRelationshipsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPriceProductMerchantRelationship $priceProductMerchantRelationship The SpyPriceProductMerchantRelationship object to add.
     */
    protected function doAddPriceProductMerchantRelationship(SpyPriceProductMerchantRelationship $priceProductMerchantRelationship): void
    {
        $this->collPriceProductMerchantRelationships[]= $priceProductMerchantRelationship;
        $priceProductMerchantRelationship->setProductAbstract($this);
    }

    /**
     * @param SpyPriceProductMerchantRelationship $priceProductMerchantRelationship The SpyPriceProductMerchantRelationship object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePriceProductMerchantRelationship(SpyPriceProductMerchantRelationship $priceProductMerchantRelationship)
    {
        if ($this->getPriceProductMerchantRelationships()->contains($priceProductMerchantRelationship)) {
            $pos = $this->collPriceProductMerchantRelationships->search($priceProductMerchantRelationship);
            $this->collPriceProductMerchantRelationships->remove($pos);
            if (null === $this->priceProductMerchantRelationshipsScheduledForDeletion) {
                $this->priceProductMerchantRelationshipsScheduledForDeletion = clone $this->collPriceProductMerchantRelationships;
                $this->priceProductMerchantRelationshipsScheduledForDeletion->clear();
            }
            $this->priceProductMerchantRelationshipsScheduledForDeletion[]= $priceProductMerchantRelationship;
            $priceProductMerchantRelationship->setProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductMerchantRelationships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductMerchantRelationship[] List of SpyPriceProductMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductMerchantRelationship}> List of SpyPriceProductMerchantRelationship objects
     */
    public function getPriceProductMerchantRelationshipsJoinPriceProductStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductMerchantRelationshipQuery::create(null, $criteria);
        $query->joinWith('PriceProductStore', $joinBehavior);

        return $this->getPriceProductMerchantRelationships($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductMerchantRelationships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductMerchantRelationship[] List of SpyPriceProductMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductMerchantRelationship}> List of SpyPriceProductMerchantRelationship objects
     */
    public function getPriceProductMerchantRelationshipsJoinMerchantRelationship(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductMerchantRelationshipQuery::create(null, $criteria);
        $query->joinWith('MerchantRelationship', $joinBehavior);

        return $this->getPriceProductMerchantRelationships($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductMerchantRelationships from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductMerchantRelationship[] List of SpyPriceProductMerchantRelationship objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductMerchantRelationship}> List of SpyPriceProductMerchantRelationship objects
     */
    public function getPriceProductMerchantRelationshipsJoinProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductMerchantRelationshipQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getPriceProductMerchantRelationships($query, $con);
    }

    /**
     * Clears out the collPriceProductSchedules collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addPriceProductSchedules()
     */
    public function clearPriceProductSchedules()
    {
        $this->collPriceProductSchedules = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collPriceProductSchedules collection loaded partially.
     *
     * @return void
     */
    public function resetPartialPriceProductSchedules($v = true): void
    {
        $this->collPriceProductSchedulesPartial = $v;
    }

    /**
     * Initializes the collPriceProductSchedules collection.
     *
     * By default this just sets the collPriceProductSchedules collection to an empty array (like clearcollPriceProductSchedules());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPriceProductSchedules(bool $overrideExisting = true): void
    {
        if (null !== $this->collPriceProductSchedules && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyPriceProductScheduleTableMap::getTableMap()->getCollectionClassName();

        $this->collPriceProductSchedules = new $collectionClassName;
        $this->collPriceProductSchedules->setModel('\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule');
    }

    /**
     * Gets an array of SpyPriceProductSchedule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule> List of SpyPriceProductSchedule objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getPriceProductSchedules(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collPriceProductSchedulesPartial && !$this->isNew();
        if (null === $this->collPriceProductSchedules || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPriceProductSchedules) {
                    $this->initPriceProductSchedules();
                } else {
                    $collectionClassName = SpyPriceProductScheduleTableMap::getTableMap()->getCollectionClassName();

                    $collPriceProductSchedules = new $collectionClassName;
                    $collPriceProductSchedules->setModel('\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule');

                    return $collPriceProductSchedules;
                }
            } else {
                $collPriceProductSchedules = SpyPriceProductScheduleQuery::create(null, $criteria)
                    ->filterByProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPriceProductSchedulesPartial && count($collPriceProductSchedules)) {
                        $this->initPriceProductSchedules(false);

                        foreach ($collPriceProductSchedules as $obj) {
                            if (false == $this->collPriceProductSchedules->contains($obj)) {
                                $this->collPriceProductSchedules->append($obj);
                            }
                        }

                        $this->collPriceProductSchedulesPartial = true;
                    }

                    return $collPriceProductSchedules;
                }

                if ($partial && $this->collPriceProductSchedules) {
                    foreach ($this->collPriceProductSchedules as $obj) {
                        if ($obj->isNew()) {
                            $collPriceProductSchedules[] = $obj;
                        }
                    }
                }

                $this->collPriceProductSchedules = $collPriceProductSchedules;
                $this->collPriceProductSchedulesPartial = false;
            }
        }

        return $this->collPriceProductSchedules;
    }

    /**
     * Sets a collection of SpyPriceProductSchedule objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $priceProductSchedules A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setPriceProductSchedules(Collection $priceProductSchedules, ?ConnectionInterface $con = null)
    {
        /** @var SpyPriceProductSchedule[] $priceProductSchedulesToDelete */
        $priceProductSchedulesToDelete = $this->getPriceProductSchedules(new Criteria(), $con)->diff($priceProductSchedules);


        $this->priceProductSchedulesScheduledForDeletion = $priceProductSchedulesToDelete;

        foreach ($priceProductSchedulesToDelete as $priceProductScheduleRemoved) {
            $priceProductScheduleRemoved->setProductAbstract(null);
        }

        $this->collPriceProductSchedules = null;
        foreach ($priceProductSchedules as $priceProductSchedule) {
            $this->addPriceProductSchedule($priceProductSchedule);
        }

        $this->collPriceProductSchedules = $priceProductSchedules;
        $this->collPriceProductSchedulesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyPriceProductSchedule objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyPriceProductSchedule objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countPriceProductSchedules(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collPriceProductSchedulesPartial && !$this->isNew();
        if (null === $this->collPriceProductSchedules || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPriceProductSchedules) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPriceProductSchedules());
            }

            $query = SpyPriceProductScheduleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstract($this)
                ->count($con);
        }

        return count($this->collPriceProductSchedules);
    }

    /**
     * Method called to associate a SpyPriceProductSchedule object to this object
     * through the SpyPriceProductSchedule foreign key attribute.
     *
     * @param SpyPriceProductSchedule $l SpyPriceProductSchedule
     * @return $this The current object (for fluent API support)
     */
    public function addPriceProductSchedule(SpyPriceProductSchedule $l)
    {
        if ($this->collPriceProductSchedules === null) {
            $this->initPriceProductSchedules();
            $this->collPriceProductSchedulesPartial = true;
        }

        if (!$this->collPriceProductSchedules->contains($l)) {
            $this->doAddPriceProductSchedule($l);

            if ($this->priceProductSchedulesScheduledForDeletion and $this->priceProductSchedulesScheduledForDeletion->contains($l)) {
                $this->priceProductSchedulesScheduledForDeletion->remove($this->priceProductSchedulesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyPriceProductSchedule $priceProductSchedule The SpyPriceProductSchedule object to add.
     */
    protected function doAddPriceProductSchedule(SpyPriceProductSchedule $priceProductSchedule): void
    {
        $this->collPriceProductSchedules[]= $priceProductSchedule;
        $priceProductSchedule->setProductAbstract($this);
    }

    /**
     * @param SpyPriceProductSchedule $priceProductSchedule The SpyPriceProductSchedule object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removePriceProductSchedule(SpyPriceProductSchedule $priceProductSchedule)
    {
        if ($this->getPriceProductSchedules()->contains($priceProductSchedule)) {
            $pos = $this->collPriceProductSchedules->search($priceProductSchedule);
            $this->collPriceProductSchedules->remove($pos);
            if (null === $this->priceProductSchedulesScheduledForDeletion) {
                $this->priceProductSchedulesScheduledForDeletion = clone $this->collPriceProductSchedules;
                $this->priceProductSchedulesScheduledForDeletion->clear();
            }
            $this->priceProductSchedulesScheduledForDeletion[]= $priceProductSchedule;
            $priceProductSchedule->setProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinCurrency(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('Currency', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('Store', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinPriceType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('PriceType', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related PriceProductSchedules from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyPriceProductSchedule[] List of SpyPriceProductSchedule objects
     * @phpstan-return ObjectCollection&\Traversable<SpyPriceProductSchedule}> List of SpyPriceProductSchedule objects
     */
    public function getPriceProductSchedulesJoinPriceProductScheduleList(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyPriceProductScheduleQuery::create(null, $criteria);
        $query->joinWith('PriceProductScheduleList', $joinBehavior);

        return $this->getPriceProductSchedules($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractLocalizedAttributess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractLocalizedAttributess()
     */
    public function clearSpyProductAbstractLocalizedAttributess()
    {
        $this->collSpyProductAbstractLocalizedAttributess = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractLocalizedAttributess collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractLocalizedAttributess($v = true): void
    {
        $this->collSpyProductAbstractLocalizedAttributessPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractLocalizedAttributess collection.
     *
     * By default this just sets the collSpyProductAbstractLocalizedAttributess collection to an empty array (like clearcollSpyProductAbstractLocalizedAttributess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractLocalizedAttributess(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractLocalizedAttributess && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractLocalizedAttributess = new $collectionClassName;
        $this->collSpyProductAbstractLocalizedAttributess->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes');
    }

    /**
     * Gets an array of ChildSpyProductAbstractLocalizedAttributes objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductAbstractLocalizedAttributes[] List of ChildSpyProductAbstractLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractLocalizedAttributes> List of ChildSpyProductAbstractLocalizedAttributes objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractLocalizedAttributess(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractLocalizedAttributess) {
                    $this->initSpyProductAbstractLocalizedAttributess();
                } else {
                    $collectionClassName = SpyProductAbstractLocalizedAttributesTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractLocalizedAttributess = new $collectionClassName;
                    $collSpyProductAbstractLocalizedAttributess->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes');

                    return $collSpyProductAbstractLocalizedAttributess;
                }
            } else {
                $collSpyProductAbstractLocalizedAttributess = ChildSpyProductAbstractLocalizedAttributesQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractLocalizedAttributessPartial && count($collSpyProductAbstractLocalizedAttributess)) {
                        $this->initSpyProductAbstractLocalizedAttributess(false);

                        foreach ($collSpyProductAbstractLocalizedAttributess as $obj) {
                            if (false == $this->collSpyProductAbstractLocalizedAttributess->contains($obj)) {
                                $this->collSpyProductAbstractLocalizedAttributess->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractLocalizedAttributessPartial = true;
                    }

                    return $collSpyProductAbstractLocalizedAttributess;
                }

                if ($partial && $this->collSpyProductAbstractLocalizedAttributess) {
                    foreach ($this->collSpyProductAbstractLocalizedAttributess as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractLocalizedAttributess[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractLocalizedAttributess = $collSpyProductAbstractLocalizedAttributess;
                $this->collSpyProductAbstractLocalizedAttributessPartial = false;
            }
        }

        return $this->collSpyProductAbstractLocalizedAttributess;
    }

    /**
     * Sets a collection of ChildSpyProductAbstractLocalizedAttributes objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractLocalizedAttributess A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractLocalizedAttributess(Collection $spyProductAbstractLocalizedAttributess, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductAbstractLocalizedAttributes[] $spyProductAbstractLocalizedAttributessToDelete */
        $spyProductAbstractLocalizedAttributessToDelete = $this->getSpyProductAbstractLocalizedAttributess(new Criteria(), $con)->diff($spyProductAbstractLocalizedAttributess);


        $this->spyProductAbstractLocalizedAttributessScheduledForDeletion = $spyProductAbstractLocalizedAttributessToDelete;

        foreach ($spyProductAbstractLocalizedAttributessToDelete as $spyProductAbstractLocalizedAttributesRemoved) {
            $spyProductAbstractLocalizedAttributesRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductAbstractLocalizedAttributess = null;
        foreach ($spyProductAbstractLocalizedAttributess as $spyProductAbstractLocalizedAttributes) {
            $this->addSpyProductAbstractLocalizedAttributes($spyProductAbstractLocalizedAttributes);
        }

        $this->collSpyProductAbstractLocalizedAttributess = $spyProductAbstractLocalizedAttributess;
        $this->collSpyProductAbstractLocalizedAttributessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductAbstractLocalizedAttributes objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductAbstractLocalizedAttributes objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractLocalizedAttributess(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractLocalizedAttributessPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractLocalizedAttributess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractLocalizedAttributess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractLocalizedAttributess());
            }

            $query = ChildSpyProductAbstractLocalizedAttributesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractLocalizedAttributess);
    }

    /**
     * Method called to associate a ChildSpyProductAbstractLocalizedAttributes object to this object
     * through the ChildSpyProductAbstractLocalizedAttributes foreign key attribute.
     *
     * @param ChildSpyProductAbstractLocalizedAttributes $l ChildSpyProductAbstractLocalizedAttributes
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractLocalizedAttributes(ChildSpyProductAbstractLocalizedAttributes $l)
    {
        if ($this->collSpyProductAbstractLocalizedAttributess === null) {
            $this->initSpyProductAbstractLocalizedAttributess();
            $this->collSpyProductAbstractLocalizedAttributessPartial = true;
        }

        if (!$this->collSpyProductAbstractLocalizedAttributess->contains($l)) {
            $this->doAddSpyProductAbstractLocalizedAttributes($l);

            if ($this->spyProductAbstractLocalizedAttributessScheduledForDeletion and $this->spyProductAbstractLocalizedAttributessScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractLocalizedAttributessScheduledForDeletion->remove($this->spyProductAbstractLocalizedAttributessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes The ChildSpyProductAbstractLocalizedAttributes object to add.
     */
    protected function doAddSpyProductAbstractLocalizedAttributes(ChildSpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes): void
    {
        $this->collSpyProductAbstractLocalizedAttributess[]= $spyProductAbstractLocalizedAttributes;
        $spyProductAbstractLocalizedAttributes->setSpyProductAbstract($this);
    }

    /**
     * @param ChildSpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes The ChildSpyProductAbstractLocalizedAttributes object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractLocalizedAttributes(ChildSpyProductAbstractLocalizedAttributes $spyProductAbstractLocalizedAttributes)
    {
        if ($this->getSpyProductAbstractLocalizedAttributess()->contains($spyProductAbstractLocalizedAttributes)) {
            $pos = $this->collSpyProductAbstractLocalizedAttributess->search($spyProductAbstractLocalizedAttributes);
            $this->collSpyProductAbstractLocalizedAttributess->remove($pos);
            if (null === $this->spyProductAbstractLocalizedAttributessScheduledForDeletion) {
                $this->spyProductAbstractLocalizedAttributessScheduledForDeletion = clone $this->collSpyProductAbstractLocalizedAttributess;
                $this->spyProductAbstractLocalizedAttributessScheduledForDeletion->clear();
            }
            $this->spyProductAbstractLocalizedAttributessScheduledForDeletion[]= clone $spyProductAbstractLocalizedAttributes;
            $spyProductAbstractLocalizedAttributes->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAbstractLocalizedAttributess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductAbstractLocalizedAttributes[] List of ChildSpyProductAbstractLocalizedAttributes objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractLocalizedAttributes}> List of ChildSpyProductAbstractLocalizedAttributes objects
     */
    public function getSpyProductAbstractLocalizedAttributessJoinLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductAbstractLocalizedAttributesQuery::create(null, $criteria);
        $query->joinWith('Locale', $joinBehavior);

        return $this->getSpyProductAbstractLocalizedAttributess($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractStores collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractStores()
     */
    public function clearSpyProductAbstractStores()
    {
        $this->collSpyProductAbstractStores = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractStores collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractStores($v = true): void
    {
        $this->collSpyProductAbstractStoresPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractStores collection.
     *
     * By default this just sets the collSpyProductAbstractStores collection to an empty array (like clearcollSpyProductAbstractStores());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractStores(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractStores && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractStoreTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractStores = new $collectionClassName;
        $this->collSpyProductAbstractStores->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractStore');
    }

    /**
     * Gets an array of ChildSpyProductAbstractStore objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProductAbstractStore[] List of ChildSpyProductAbstractStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractStore> List of ChildSpyProductAbstractStore objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractStores(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractStores || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractStores) {
                    $this->initSpyProductAbstractStores();
                } else {
                    $collectionClassName = SpyProductAbstractStoreTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractStores = new $collectionClassName;
                    $collSpyProductAbstractStores->setModel('\Orm\Zed\Product\Persistence\SpyProductAbstractStore');

                    return $collSpyProductAbstractStores;
                }
            } else {
                $collSpyProductAbstractStores = ChildSpyProductAbstractStoreQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractStoresPartial && count($collSpyProductAbstractStores)) {
                        $this->initSpyProductAbstractStores(false);

                        foreach ($collSpyProductAbstractStores as $obj) {
                            if (false == $this->collSpyProductAbstractStores->contains($obj)) {
                                $this->collSpyProductAbstractStores->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractStoresPartial = true;
                    }

                    return $collSpyProductAbstractStores;
                }

                if ($partial && $this->collSpyProductAbstractStores) {
                    foreach ($this->collSpyProductAbstractStores as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractStores[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractStores = $collSpyProductAbstractStores;
                $this->collSpyProductAbstractStoresPartial = false;
            }
        }

        return $this->collSpyProductAbstractStores;
    }

    /**
     * Sets a collection of ChildSpyProductAbstractStore objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractStores A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractStores(Collection $spyProductAbstractStores, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProductAbstractStore[] $spyProductAbstractStoresToDelete */
        $spyProductAbstractStoresToDelete = $this->getSpyProductAbstractStores(new Criteria(), $con)->diff($spyProductAbstractStores);


        $this->spyProductAbstractStoresScheduledForDeletion = $spyProductAbstractStoresToDelete;

        foreach ($spyProductAbstractStoresToDelete as $spyProductAbstractStoreRemoved) {
            $spyProductAbstractStoreRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductAbstractStores = null;
        foreach ($spyProductAbstractStores as $spyProductAbstractStore) {
            $this->addSpyProductAbstractStore($spyProductAbstractStore);
        }

        $this->collSpyProductAbstractStores = $spyProductAbstractStores;
        $this->collSpyProductAbstractStoresPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProductAbstractStore objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProductAbstractStore objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractStores(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractStoresPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractStores || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractStores) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractStores());
            }

            $query = ChildSpyProductAbstractStoreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractStores);
    }

    /**
     * Method called to associate a ChildSpyProductAbstractStore object to this object
     * through the ChildSpyProductAbstractStore foreign key attribute.
     *
     * @param ChildSpyProductAbstractStore $l ChildSpyProductAbstractStore
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractStore(ChildSpyProductAbstractStore $l)
    {
        if ($this->collSpyProductAbstractStores === null) {
            $this->initSpyProductAbstractStores();
            $this->collSpyProductAbstractStoresPartial = true;
        }

        if (!$this->collSpyProductAbstractStores->contains($l)) {
            $this->doAddSpyProductAbstractStore($l);

            if ($this->spyProductAbstractStoresScheduledForDeletion and $this->spyProductAbstractStoresScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractStoresScheduledForDeletion->remove($this->spyProductAbstractStoresScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProductAbstractStore $spyProductAbstractStore The ChildSpyProductAbstractStore object to add.
     */
    protected function doAddSpyProductAbstractStore(ChildSpyProductAbstractStore $spyProductAbstractStore): void
    {
        $this->collSpyProductAbstractStores[]= $spyProductAbstractStore;
        $spyProductAbstractStore->setSpyProductAbstract($this);
    }

    /**
     * @param ChildSpyProductAbstractStore $spyProductAbstractStore The ChildSpyProductAbstractStore object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractStore(ChildSpyProductAbstractStore $spyProductAbstractStore)
    {
        if ($this->getSpyProductAbstractStores()->contains($spyProductAbstractStore)) {
            $pos = $this->collSpyProductAbstractStores->search($spyProductAbstractStore);
            $this->collSpyProductAbstractStores->remove($pos);
            if (null === $this->spyProductAbstractStoresScheduledForDeletion) {
                $this->spyProductAbstractStoresScheduledForDeletion = clone $this->collSpyProductAbstractStores;
                $this->spyProductAbstractStoresScheduledForDeletion->clear();
            }
            $this->spyProductAbstractStoresScheduledForDeletion[]= clone $spyProductAbstractStore;
            $spyProductAbstractStore->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAbstractStores from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSpyProductAbstractStore[] List of ChildSpyProductAbstractStore objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProductAbstractStore}> List of ChildSpyProductAbstractStore objects
     */
    public function getSpyProductAbstractStoresJoinSpyStore(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSpyProductAbstractStoreQuery::create(null, $criteria);
        $query->joinWith('SpyStore', $joinBehavior);

        return $this->getSpyProductAbstractStores($query, $con);
    }

    /**
     * Clears out the collSpyProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProducts()
     */
    public function clearSpyProducts()
    {
        $this->collSpyProducts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProducts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProducts($v = true): void
    {
        $this->collSpyProductsPartial = $v;
    }

    /**
     * Initializes the collSpyProducts collection.
     *
     * By default this just sets the collSpyProducts collection to an empty array (like clearcollSpyProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProducts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProducts = new $collectionClassName;
        $this->collSpyProducts->setModel('\Orm\Zed\Product\Persistence\SpyProduct');
    }

    /**
     * Gets an array of ChildSpyProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSpyProduct[] List of ChildSpyProduct objects
     * @phpstan-return ObjectCollection&\Traversable<ChildSpyProduct> List of ChildSpyProduct objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProducts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductsPartial && !$this->isNew();
        if (null === $this->collSpyProducts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProducts) {
                    $this->initSpyProducts();
                } else {
                    $collectionClassName = SpyProductTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProducts = new $collectionClassName;
                    $collSpyProducts->setModel('\Orm\Zed\Product\Persistence\SpyProduct');

                    return $collSpyProducts;
                }
            } else {
                $collSpyProducts = ChildSpyProductQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductsPartial && count($collSpyProducts)) {
                        $this->initSpyProducts(false);

                        foreach ($collSpyProducts as $obj) {
                            if (false == $this->collSpyProducts->contains($obj)) {
                                $this->collSpyProducts->append($obj);
                            }
                        }

                        $this->collSpyProductsPartial = true;
                    }

                    return $collSpyProducts;
                }

                if ($partial && $this->collSpyProducts) {
                    foreach ($this->collSpyProducts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProducts[] = $obj;
                        }
                    }
                }

                $this->collSpyProducts = $collSpyProducts;
                $this->collSpyProductsPartial = false;
            }
        }

        return $this->collSpyProducts;
    }

    /**
     * Sets a collection of ChildSpyProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProducts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProducts(Collection $spyProducts, ?ConnectionInterface $con = null)
    {
        /** @var ChildSpyProduct[] $spyProductsToDelete */
        $spyProductsToDelete = $this->getSpyProducts(new Criteria(), $con)->diff($spyProducts);


        $this->spyProductsScheduledForDeletion = $spyProductsToDelete;

        foreach ($spyProductsToDelete as $spyProductRemoved) {
            $spyProductRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProducts = null;
        foreach ($spyProducts as $spyProduct) {
            $this->addSpyProduct($spyProduct);
        }

        $this->collSpyProducts = $spyProducts;
        $this->collSpyProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SpyProduct objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related SpyProduct objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProducts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductsPartial && !$this->isNew();
        if (null === $this->collSpyProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProducts());
            }

            $query = ChildSpyProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProducts);
    }

    /**
     * Method called to associate a ChildSpyProduct object to this object
     * through the ChildSpyProduct foreign key attribute.
     *
     * @param ChildSpyProduct $l ChildSpyProduct
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProduct(ChildSpyProduct $l)
    {
        if ($this->collSpyProducts === null) {
            $this->initSpyProducts();
            $this->collSpyProductsPartial = true;
        }

        if (!$this->collSpyProducts->contains($l)) {
            $this->doAddSpyProduct($l);

            if ($this->spyProductsScheduledForDeletion and $this->spyProductsScheduledForDeletion->contains($l)) {
                $this->spyProductsScheduledForDeletion->remove($this->spyProductsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSpyProduct $spyProduct The ChildSpyProduct object to add.
     */
    protected function doAddSpyProduct(ChildSpyProduct $spyProduct): void
    {
        $this->collSpyProducts[]= $spyProduct;
        $spyProduct->setSpyProductAbstract($this);
    }

    /**
     * @param ChildSpyProduct $spyProduct The ChildSpyProduct object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProduct(ChildSpyProduct $spyProduct)
    {
        if ($this->getSpyProducts()->contains($spyProduct)) {
            $pos = $this->collSpyProducts->search($spyProduct);
            $this->collSpyProducts->remove($pos);
            if (null === $this->spyProductsScheduledForDeletion) {
                $this->spyProductsScheduledForDeletion = clone $this->collSpyProducts;
                $this->spyProductsScheduledForDeletion->clear();
            }
            $this->spyProductsScheduledForDeletion[]= clone $spyProduct;
            $spyProduct->setSpyProductAbstract(null);
        }

        return $this;
    }

    /**
     * Clears out the collSpyProductAlternatives collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAlternatives()
     */
    public function clearSpyProductAlternatives()
    {
        $this->collSpyProductAlternatives = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAlternatives collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAlternatives($v = true): void
    {
        $this->collSpyProductAlternativesPartial = $v;
    }

    /**
     * Initializes the collSpyProductAlternatives collection.
     *
     * By default this just sets the collSpyProductAlternatives collection to an empty array (like clearcollSpyProductAlternatives());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAlternatives(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAlternatives && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAlternativeTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAlternatives = new $collectionClassName;
        $this->collSpyProductAlternatives->setModel('\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative');
    }

    /**
     * Gets an array of SpyProductAlternative objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductAlternative[] List of SpyProductAlternative objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAlternative> List of SpyProductAlternative objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAlternatives(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAlternativesPartial && !$this->isNew();
        if (null === $this->collSpyProductAlternatives || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAlternatives) {
                    $this->initSpyProductAlternatives();
                } else {
                    $collectionClassName = SpyProductAlternativeTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAlternatives = new $collectionClassName;
                    $collSpyProductAlternatives->setModel('\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative');

                    return $collSpyProductAlternatives;
                }
            } else {
                $collSpyProductAlternatives = SpyProductAlternativeQuery::create(null, $criteria)
                    ->filterByProductAbstractAlternative($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAlternativesPartial && count($collSpyProductAlternatives)) {
                        $this->initSpyProductAlternatives(false);

                        foreach ($collSpyProductAlternatives as $obj) {
                            if (false == $this->collSpyProductAlternatives->contains($obj)) {
                                $this->collSpyProductAlternatives->append($obj);
                            }
                        }

                        $this->collSpyProductAlternativesPartial = true;
                    }

                    return $collSpyProductAlternatives;
                }

                if ($partial && $this->collSpyProductAlternatives) {
                    foreach ($this->collSpyProductAlternatives as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAlternatives[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAlternatives = $collSpyProductAlternatives;
                $this->collSpyProductAlternativesPartial = false;
            }
        }

        return $this->collSpyProductAlternatives;
    }

    /**
     * Sets a collection of SpyProductAlternative objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAlternatives A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAlternatives(Collection $spyProductAlternatives, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductAlternative[] $spyProductAlternativesToDelete */
        $spyProductAlternativesToDelete = $this->getSpyProductAlternatives(new Criteria(), $con)->diff($spyProductAlternatives);


        $this->spyProductAlternativesScheduledForDeletion = $spyProductAlternativesToDelete;

        foreach ($spyProductAlternativesToDelete as $spyProductAlternativeRemoved) {
            $spyProductAlternativeRemoved->setProductAbstractAlternative(null);
        }

        $this->collSpyProductAlternatives = null;
        foreach ($spyProductAlternatives as $spyProductAlternative) {
            $this->addSpyProductAlternative($spyProductAlternative);
        }

        $this->collSpyProductAlternatives = $spyProductAlternatives;
        $this->collSpyProductAlternativesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductAlternative objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductAlternative objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAlternatives(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAlternativesPartial && !$this->isNew();
        if (null === $this->collSpyProductAlternatives || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAlternatives) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAlternatives());
            }

            $query = SpyProductAlternativeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstractAlternative($this)
                ->count($con);
        }

        return count($this->collSpyProductAlternatives);
    }

    /**
     * Method called to associate a SpyProductAlternative object to this object
     * through the SpyProductAlternative foreign key attribute.
     *
     * @param SpyProductAlternative $l SpyProductAlternative
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAlternative(SpyProductAlternative $l)
    {
        if ($this->collSpyProductAlternatives === null) {
            $this->initSpyProductAlternatives();
            $this->collSpyProductAlternativesPartial = true;
        }

        if (!$this->collSpyProductAlternatives->contains($l)) {
            $this->doAddSpyProductAlternative($l);

            if ($this->spyProductAlternativesScheduledForDeletion and $this->spyProductAlternativesScheduledForDeletion->contains($l)) {
                $this->spyProductAlternativesScheduledForDeletion->remove($this->spyProductAlternativesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductAlternative $spyProductAlternative The SpyProductAlternative object to add.
     */
    protected function doAddSpyProductAlternative(SpyProductAlternative $spyProductAlternative): void
    {
        $this->collSpyProductAlternatives[]= $spyProductAlternative;
        $spyProductAlternative->setProductAbstractAlternative($this);
    }

    /**
     * @param SpyProductAlternative $spyProductAlternative The SpyProductAlternative object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAlternative(SpyProductAlternative $spyProductAlternative)
    {
        if ($this->getSpyProductAlternatives()->contains($spyProductAlternative)) {
            $pos = $this->collSpyProductAlternatives->search($spyProductAlternative);
            $this->collSpyProductAlternatives->remove($pos);
            if (null === $this->spyProductAlternativesScheduledForDeletion) {
                $this->spyProductAlternativesScheduledForDeletion = clone $this->collSpyProductAlternatives;
                $this->spyProductAlternativesScheduledForDeletion->clear();
            }
            $this->spyProductAlternativesScheduledForDeletion[]= $spyProductAlternative;
            $spyProductAlternative->setProductAbstractAlternative(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAlternatives from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAlternative[] List of SpyProductAlternative objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAlternative}> List of SpyProductAlternative objects
     */
    public function getSpyProductAlternativesJoinProductConcrete(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAlternativeQuery::create(null, $criteria);
        $query->joinWith('ProductConcrete', $joinBehavior);

        return $this->getSpyProductAlternatives($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAlternatives from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAlternative[] List of SpyProductAlternative objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAlternative}> List of SpyProductAlternative objects
     */
    public function getSpyProductAlternativesJoinProductConcreteAlternative(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAlternativeQuery::create(null, $criteria);
        $query->joinWith('ProductConcreteAlternative', $joinBehavior);

        return $this->getSpyProductAlternatives($query, $con);
    }

    /**
     * Clears out the collSpyProductCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductCategories()
     */
    public function clearSpyProductCategories()
    {
        $this->collSpyProductCategories = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductCategories collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductCategories($v = true): void
    {
        $this->collSpyProductCategoriesPartial = $v;
    }

    /**
     * Initializes the collSpyProductCategories collection.
     *
     * By default this just sets the collSpyProductCategories collection to an empty array (like clearcollSpyProductCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductCategories(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductCategories && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductCategoryTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductCategories = new $collectionClassName;
        $this->collSpyProductCategories->setModel('\Orm\Zed\ProductCategory\Persistence\SpyProductCategory');
    }

    /**
     * Gets an array of SpyProductCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductCategory[] List of SpyProductCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCategory> List of SpyProductCategory objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductCategories(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyProductCategories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductCategories) {
                    $this->initSpyProductCategories();
                } else {
                    $collectionClassName = SpyProductCategoryTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductCategories = new $collectionClassName;
                    $collSpyProductCategories->setModel('\Orm\Zed\ProductCategory\Persistence\SpyProductCategory');

                    return $collSpyProductCategories;
                }
            } else {
                $collSpyProductCategories = SpyProductCategoryQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductCategoriesPartial && count($collSpyProductCategories)) {
                        $this->initSpyProductCategories(false);

                        foreach ($collSpyProductCategories as $obj) {
                            if (false == $this->collSpyProductCategories->contains($obj)) {
                                $this->collSpyProductCategories->append($obj);
                            }
                        }

                        $this->collSpyProductCategoriesPartial = true;
                    }

                    return $collSpyProductCategories;
                }

                if ($partial && $this->collSpyProductCategories) {
                    foreach ($this->collSpyProductCategories as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductCategories[] = $obj;
                        }
                    }
                }

                $this->collSpyProductCategories = $collSpyProductCategories;
                $this->collSpyProductCategoriesPartial = false;
            }
        }

        return $this->collSpyProductCategories;
    }

    /**
     * Sets a collection of SpyProductCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductCategories A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductCategories(Collection $spyProductCategories, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductCategory[] $spyProductCategoriesToDelete */
        $spyProductCategoriesToDelete = $this->getSpyProductCategories(new Criteria(), $con)->diff($spyProductCategories);


        $this->spyProductCategoriesScheduledForDeletion = $spyProductCategoriesToDelete;

        foreach ($spyProductCategoriesToDelete as $spyProductCategoryRemoved) {
            $spyProductCategoryRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductCategories = null;
        foreach ($spyProductCategories as $spyProductCategory) {
            $this->addSpyProductCategory($spyProductCategory);
        }

        $this->collSpyProductCategories = $spyProductCategories;
        $this->collSpyProductCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductCategory objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductCategory objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductCategories(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductCategoriesPartial && !$this->isNew();
        if (null === $this->collSpyProductCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductCategories());
            }

            $query = SpyProductCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductCategories);
    }

    /**
     * Method called to associate a SpyProductCategory object to this object
     * through the SpyProductCategory foreign key attribute.
     *
     * @param SpyProductCategory $l SpyProductCategory
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductCategory(SpyProductCategory $l)
    {
        if ($this->collSpyProductCategories === null) {
            $this->initSpyProductCategories();
            $this->collSpyProductCategoriesPartial = true;
        }

        if (!$this->collSpyProductCategories->contains($l)) {
            $this->doAddSpyProductCategory($l);

            if ($this->spyProductCategoriesScheduledForDeletion and $this->spyProductCategoriesScheduledForDeletion->contains($l)) {
                $this->spyProductCategoriesScheduledForDeletion->remove($this->spyProductCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductCategory $spyProductCategory The SpyProductCategory object to add.
     */
    protected function doAddSpyProductCategory(SpyProductCategory $spyProductCategory): void
    {
        $this->collSpyProductCategories[]= $spyProductCategory;
        $spyProductCategory->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductCategory $spyProductCategory The SpyProductCategory object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductCategory(SpyProductCategory $spyProductCategory)
    {
        if ($this->getSpyProductCategories()->contains($spyProductCategory)) {
            $pos = $this->collSpyProductCategories->search($spyProductCategory);
            $this->collSpyProductCategories->remove($pos);
            if (null === $this->spyProductCategoriesScheduledForDeletion) {
                $this->spyProductCategoriesScheduledForDeletion = clone $this->collSpyProductCategories;
                $this->spyProductCategoriesScheduledForDeletion->clear();
            }
            $this->spyProductCategoriesScheduledForDeletion[]= clone $spyProductCategory;
            $spyProductCategory->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductCategories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductCategory[] List of SpyProductCategory objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCategory}> List of SpyProductCategory objects
     */
    public function getSpyProductCategoriesJoinSpyCategory(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductCategoryQuery::create(null, $criteria);
        $query->joinWith('SpyCategory', $joinBehavior);

        return $this->getSpyProductCategories($query, $con);
    }

    /**
     * Clears out the collSpyProductCustomerPermissions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductCustomerPermissions()
     */
    public function clearSpyProductCustomerPermissions()
    {
        $this->collSpyProductCustomerPermissions = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductCustomerPermissions collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductCustomerPermissions($v = true): void
    {
        $this->collSpyProductCustomerPermissionsPartial = $v;
    }

    /**
     * Initializes the collSpyProductCustomerPermissions collection.
     *
     * By default this just sets the collSpyProductCustomerPermissions collection to an empty array (like clearcollSpyProductCustomerPermissions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductCustomerPermissions(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductCustomerPermissions && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductCustomerPermissionTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductCustomerPermissions = new $collectionClassName;
        $this->collSpyProductCustomerPermissions->setModel('\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission');
    }

    /**
     * Gets an array of SpyProductCustomerPermission objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductCustomerPermission[] List of SpyProductCustomerPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCustomerPermission> List of SpyProductCustomerPermission objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductCustomerPermissions(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductCustomerPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyProductCustomerPermissions || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductCustomerPermissions) {
                    $this->initSpyProductCustomerPermissions();
                } else {
                    $collectionClassName = SpyProductCustomerPermissionTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductCustomerPermissions = new $collectionClassName;
                    $collSpyProductCustomerPermissions->setModel('\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission');

                    return $collSpyProductCustomerPermissions;
                }
            } else {
                $collSpyProductCustomerPermissions = SpyProductCustomerPermissionQuery::create(null, $criteria)
                    ->filterByProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductCustomerPermissionsPartial && count($collSpyProductCustomerPermissions)) {
                        $this->initSpyProductCustomerPermissions(false);

                        foreach ($collSpyProductCustomerPermissions as $obj) {
                            if (false == $this->collSpyProductCustomerPermissions->contains($obj)) {
                                $this->collSpyProductCustomerPermissions->append($obj);
                            }
                        }

                        $this->collSpyProductCustomerPermissionsPartial = true;
                    }

                    return $collSpyProductCustomerPermissions;
                }

                if ($partial && $this->collSpyProductCustomerPermissions) {
                    foreach ($this->collSpyProductCustomerPermissions as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductCustomerPermissions[] = $obj;
                        }
                    }
                }

                $this->collSpyProductCustomerPermissions = $collSpyProductCustomerPermissions;
                $this->collSpyProductCustomerPermissionsPartial = false;
            }
        }

        return $this->collSpyProductCustomerPermissions;
    }

    /**
     * Sets a collection of SpyProductCustomerPermission objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductCustomerPermissions A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductCustomerPermissions(Collection $spyProductCustomerPermissions, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductCustomerPermission[] $spyProductCustomerPermissionsToDelete */
        $spyProductCustomerPermissionsToDelete = $this->getSpyProductCustomerPermissions(new Criteria(), $con)->diff($spyProductCustomerPermissions);


        $this->spyProductCustomerPermissionsScheduledForDeletion = $spyProductCustomerPermissionsToDelete;

        foreach ($spyProductCustomerPermissionsToDelete as $spyProductCustomerPermissionRemoved) {
            $spyProductCustomerPermissionRemoved->setProductAbstract(null);
        }

        $this->collSpyProductCustomerPermissions = null;
        foreach ($spyProductCustomerPermissions as $spyProductCustomerPermission) {
            $this->addSpyProductCustomerPermission($spyProductCustomerPermission);
        }

        $this->collSpyProductCustomerPermissions = $spyProductCustomerPermissions;
        $this->collSpyProductCustomerPermissionsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductCustomerPermission objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductCustomerPermission objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductCustomerPermissions(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductCustomerPermissionsPartial && !$this->isNew();
        if (null === $this->collSpyProductCustomerPermissions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductCustomerPermissions) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductCustomerPermissions());
            }

            $query = SpyProductCustomerPermissionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductCustomerPermissions);
    }

    /**
     * Method called to associate a SpyProductCustomerPermission object to this object
     * through the SpyProductCustomerPermission foreign key attribute.
     *
     * @param SpyProductCustomerPermission $l SpyProductCustomerPermission
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductCustomerPermission(SpyProductCustomerPermission $l)
    {
        if ($this->collSpyProductCustomerPermissions === null) {
            $this->initSpyProductCustomerPermissions();
            $this->collSpyProductCustomerPermissionsPartial = true;
        }

        if (!$this->collSpyProductCustomerPermissions->contains($l)) {
            $this->doAddSpyProductCustomerPermission($l);

            if ($this->spyProductCustomerPermissionsScheduledForDeletion and $this->spyProductCustomerPermissionsScheduledForDeletion->contains($l)) {
                $this->spyProductCustomerPermissionsScheduledForDeletion->remove($this->spyProductCustomerPermissionsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductCustomerPermission $spyProductCustomerPermission The SpyProductCustomerPermission object to add.
     */
    protected function doAddSpyProductCustomerPermission(SpyProductCustomerPermission $spyProductCustomerPermission): void
    {
        $this->collSpyProductCustomerPermissions[]= $spyProductCustomerPermission;
        $spyProductCustomerPermission->setProductAbstract($this);
    }

    /**
     * @param SpyProductCustomerPermission $spyProductCustomerPermission The SpyProductCustomerPermission object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductCustomerPermission(SpyProductCustomerPermission $spyProductCustomerPermission)
    {
        if ($this->getSpyProductCustomerPermissions()->contains($spyProductCustomerPermission)) {
            $pos = $this->collSpyProductCustomerPermissions->search($spyProductCustomerPermission);
            $this->collSpyProductCustomerPermissions->remove($pos);
            if (null === $this->spyProductCustomerPermissionsScheduledForDeletion) {
                $this->spyProductCustomerPermissionsScheduledForDeletion = clone $this->collSpyProductCustomerPermissions;
                $this->spyProductCustomerPermissionsScheduledForDeletion->clear();
            }
            $this->spyProductCustomerPermissionsScheduledForDeletion[]= clone $spyProductCustomerPermission;
            $spyProductCustomerPermission->setProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductCustomerPermissions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductCustomerPermission[] List of SpyProductCustomerPermission objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductCustomerPermission}> List of SpyProductCustomerPermission objects
     */
    public function getSpyProductCustomerPermissionsJoinCustomer(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductCustomerPermissionQuery::create(null, $criteria);
        $query->joinWith('Customer', $joinBehavior);

        return $this->getSpyProductCustomerPermissions($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractGroups()
     */
    public function clearSpyProductAbstractGroups()
    {
        $this->collSpyProductAbstractGroups = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractGroups collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractGroups($v = true): void
    {
        $this->collSpyProductAbstractGroupsPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractGroups collection.
     *
     * By default this just sets the collSpyProductAbstractGroups collection to an empty array (like clearcollSpyProductAbstractGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractGroups(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractGroups && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractGroups = new $collectionClassName;
        $this->collSpyProductAbstractGroups->setModel('\Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup');
    }

    /**
     * Gets an array of SpyProductAbstractGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductAbstractGroup[] List of SpyProductAbstractGroup objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractGroup> List of SpyProductAbstractGroup objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractGroups) {
                    $this->initSpyProductAbstractGroups();
                } else {
                    $collectionClassName = SpyProductAbstractGroupTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractGroups = new $collectionClassName;
                    $collSpyProductAbstractGroups->setModel('\Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup');

                    return $collSpyProductAbstractGroups;
                }
            } else {
                $collSpyProductAbstractGroups = SpyProductAbstractGroupQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractGroupsPartial && count($collSpyProductAbstractGroups)) {
                        $this->initSpyProductAbstractGroups(false);

                        foreach ($collSpyProductAbstractGroups as $obj) {
                            if (false == $this->collSpyProductAbstractGroups->contains($obj)) {
                                $this->collSpyProductAbstractGroups->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractGroupsPartial = true;
                    }

                    return $collSpyProductAbstractGroups;
                }

                if ($partial && $this->collSpyProductAbstractGroups) {
                    foreach ($this->collSpyProductAbstractGroups as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractGroups = $collSpyProductAbstractGroups;
                $this->collSpyProductAbstractGroupsPartial = false;
            }
        }

        return $this->collSpyProductAbstractGroups;
    }

    /**
     * Sets a collection of SpyProductAbstractGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractGroups(Collection $spyProductAbstractGroups, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductAbstractGroup[] $spyProductAbstractGroupsToDelete */
        $spyProductAbstractGroupsToDelete = $this->getSpyProductAbstractGroups(new Criteria(), $con)->diff($spyProductAbstractGroups);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductAbstractGroupsScheduledForDeletion = clone $spyProductAbstractGroupsToDelete;

        foreach ($spyProductAbstractGroupsToDelete as $spyProductAbstractGroupRemoved) {
            $spyProductAbstractGroupRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductAbstractGroups = null;
        foreach ($spyProductAbstractGroups as $spyProductAbstractGroup) {
            $this->addSpyProductAbstractGroup($spyProductAbstractGroup);
        }

        $this->collSpyProductAbstractGroups = $spyProductAbstractGroups;
        $this->collSpyProductAbstractGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductAbstractGroup objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductAbstractGroup objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractGroups(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractGroups());
            }

            $query = SpyProductAbstractGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractGroups);
    }

    /**
     * Method called to associate a SpyProductAbstractGroup object to this object
     * through the SpyProductAbstractGroup foreign key attribute.
     *
     * @param SpyProductAbstractGroup $l SpyProductAbstractGroup
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractGroup(SpyProductAbstractGroup $l)
    {
        if ($this->collSpyProductAbstractGroups === null) {
            $this->initSpyProductAbstractGroups();
            $this->collSpyProductAbstractGroupsPartial = true;
        }

        if (!$this->collSpyProductAbstractGroups->contains($l)) {
            $this->doAddSpyProductAbstractGroup($l);

            if ($this->spyProductAbstractGroupsScheduledForDeletion and $this->spyProductAbstractGroupsScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractGroupsScheduledForDeletion->remove($this->spyProductAbstractGroupsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductAbstractGroup $spyProductAbstractGroup The SpyProductAbstractGroup object to add.
     */
    protected function doAddSpyProductAbstractGroup(SpyProductAbstractGroup $spyProductAbstractGroup): void
    {
        $this->collSpyProductAbstractGroups[]= $spyProductAbstractGroup;
        $spyProductAbstractGroup->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductAbstractGroup $spyProductAbstractGroup The SpyProductAbstractGroup object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractGroup(SpyProductAbstractGroup $spyProductAbstractGroup)
    {
        if ($this->getSpyProductAbstractGroups()->contains($spyProductAbstractGroup)) {
            $pos = $this->collSpyProductAbstractGroups->search($spyProductAbstractGroup);
            $this->collSpyProductAbstractGroups->remove($pos);
            if (null === $this->spyProductAbstractGroupsScheduledForDeletion) {
                $this->spyProductAbstractGroupsScheduledForDeletion = clone $this->collSpyProductAbstractGroups;
                $this->spyProductAbstractGroupsScheduledForDeletion->clear();
            }
            $this->spyProductAbstractGroupsScheduledForDeletion[]= clone $spyProductAbstractGroup;
            $spyProductAbstractGroup->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAbstractGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAbstractGroup[] List of SpyProductAbstractGroup objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractGroup}> List of SpyProductAbstractGroup objects
     */
    public function getSpyProductAbstractGroupsJoinSpyProductGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAbstractGroupQuery::create(null, $criteria);
        $query->joinWith('SpyProductGroup', $joinBehavior);

        return $this->getSpyProductAbstractGroups($query, $con);
    }

    /**
     * Clears out the collSpyProductImageSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductImageSets()
     */
    public function clearSpyProductImageSets()
    {
        $this->collSpyProductImageSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductImageSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductImageSets($v = true): void
    {
        $this->collSpyProductImageSetsPartial = $v;
    }

    /**
     * Initializes the collSpyProductImageSets collection.
     *
     * By default this just sets the collSpyProductImageSets collection to an empty array (like clearcollSpyProductImageSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductImageSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductImageSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductImageSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductImageSets = new $collectionClassName;
        $this->collSpyProductImageSets->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSet');
    }

    /**
     * Gets an array of SpyProductImageSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet> List of SpyProductImageSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductImageSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductImageSets) {
                    $this->initSpyProductImageSets();
                } else {
                    $collectionClassName = SpyProductImageSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductImageSets = new $collectionClassName;
                    $collSpyProductImageSets->setModel('\Orm\Zed\ProductImage\Persistence\SpyProductImageSet');

                    return $collSpyProductImageSets;
                }
            } else {
                $collSpyProductImageSets = SpyProductImageSetQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductImageSetsPartial && count($collSpyProductImageSets)) {
                        $this->initSpyProductImageSets(false);

                        foreach ($collSpyProductImageSets as $obj) {
                            if (false == $this->collSpyProductImageSets->contains($obj)) {
                                $this->collSpyProductImageSets->append($obj);
                            }
                        }

                        $this->collSpyProductImageSetsPartial = true;
                    }

                    return $collSpyProductImageSets;
                }

                if ($partial && $this->collSpyProductImageSets) {
                    foreach ($this->collSpyProductImageSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductImageSets[] = $obj;
                        }
                    }
                }

                $this->collSpyProductImageSets = $collSpyProductImageSets;
                $this->collSpyProductImageSetsPartial = false;
            }
        }

        return $this->collSpyProductImageSets;
    }

    /**
     * Sets a collection of SpyProductImageSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductImageSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductImageSets(Collection $spyProductImageSets, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductImageSet[] $spyProductImageSetsToDelete */
        $spyProductImageSetsToDelete = $this->getSpyProductImageSets(new Criteria(), $con)->diff($spyProductImageSets);


        $this->spyProductImageSetsScheduledForDeletion = $spyProductImageSetsToDelete;

        foreach ($spyProductImageSetsToDelete as $spyProductImageSetRemoved) {
            $spyProductImageSetRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductImageSets = null;
        foreach ($spyProductImageSets as $spyProductImageSet) {
            $this->addSpyProductImageSet($spyProductImageSet);
        }

        $this->collSpyProductImageSets = $spyProductImageSets;
        $this->collSpyProductImageSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductImageSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductImageSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductImageSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductImageSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductImageSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductImageSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductImageSets());
            }

            $query = SpyProductImageSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductImageSets);
    }

    /**
     * Method called to associate a SpyProductImageSet object to this object
     * through the SpyProductImageSet foreign key attribute.
     *
     * @param SpyProductImageSet $l SpyProductImageSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductImageSet(SpyProductImageSet $l)
    {
        if ($this->collSpyProductImageSets === null) {
            $this->initSpyProductImageSets();
            $this->collSpyProductImageSetsPartial = true;
        }

        if (!$this->collSpyProductImageSets->contains($l)) {
            $this->doAddSpyProductImageSet($l);

            if ($this->spyProductImageSetsScheduledForDeletion and $this->spyProductImageSetsScheduledForDeletion->contains($l)) {
                $this->spyProductImageSetsScheduledForDeletion->remove($this->spyProductImageSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductImageSet $spyProductImageSet The SpyProductImageSet object to add.
     */
    protected function doAddSpyProductImageSet(SpyProductImageSet $spyProductImageSet): void
    {
        $this->collSpyProductImageSets[]= $spyProductImageSet;
        $spyProductImageSet->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductImageSet $spyProductImageSet The SpyProductImageSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductImageSet(SpyProductImageSet $spyProductImageSet)
    {
        if ($this->getSpyProductImageSets()->contains($spyProductImageSet)) {
            $pos = $this->collSpyProductImageSets->search($spyProductImageSet);
            $this->collSpyProductImageSets->remove($pos);
            if (null === $this->spyProductImageSetsScheduledForDeletion) {
                $this->spyProductImageSetsScheduledForDeletion = clone $this->collSpyProductImageSets;
                $this->spyProductImageSetsScheduledForDeletion->clear();
            }
            $this->spyProductImageSetsScheduledForDeletion[]= $spyProductImageSet;
            $spyProductImageSet->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyConfigurableBundleTemplate(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyConfigurableBundleTemplate', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProduct(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProduct', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductImageSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductImageSet[] List of SpyProductImageSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductImageSet}> List of SpyProductImageSet objects
     */
    public function getSpyProductImageSetsJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductImageSetQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyProductImageSets($query, $con);
    }

    /**
     * Clears out the collSpyProductLabelProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductLabelProductAbstracts()
     */
    public function clearSpyProductLabelProductAbstracts()
    {
        $this->collSpyProductLabelProductAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductLabelProductAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductLabelProductAbstracts($v = true): void
    {
        $this->collSpyProductLabelProductAbstractsPartial = $v;
    }

    /**
     * Initializes the collSpyProductLabelProductAbstracts collection.
     *
     * By default this just sets the collSpyProductLabelProductAbstracts collection to an empty array (like clearcollSpyProductLabelProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductLabelProductAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductLabelProductAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductLabelProductAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductLabelProductAbstracts = new $collectionClassName;
        $this->collSpyProductLabelProductAbstracts->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract');
    }

    /**
     * Gets an array of SpyProductLabelProductAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductLabelProductAbstract[] List of SpyProductLabelProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLabelProductAbstract> List of SpyProductLabelProductAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductLabelProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductLabelProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductLabelProductAbstracts) {
                    $this->initSpyProductLabelProductAbstracts();
                } else {
                    $collectionClassName = SpyProductLabelProductAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductLabelProductAbstracts = new $collectionClassName;
                    $collSpyProductLabelProductAbstracts->setModel('\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract');

                    return $collSpyProductLabelProductAbstracts;
                }
            } else {
                $collSpyProductLabelProductAbstracts = SpyProductLabelProductAbstractQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductLabelProductAbstractsPartial && count($collSpyProductLabelProductAbstracts)) {
                        $this->initSpyProductLabelProductAbstracts(false);

                        foreach ($collSpyProductLabelProductAbstracts as $obj) {
                            if (false == $this->collSpyProductLabelProductAbstracts->contains($obj)) {
                                $this->collSpyProductLabelProductAbstracts->append($obj);
                            }
                        }

                        $this->collSpyProductLabelProductAbstractsPartial = true;
                    }

                    return $collSpyProductLabelProductAbstracts;
                }

                if ($partial && $this->collSpyProductLabelProductAbstracts) {
                    foreach ($this->collSpyProductLabelProductAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductLabelProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyProductLabelProductAbstracts = $collSpyProductLabelProductAbstracts;
                $this->collSpyProductLabelProductAbstractsPartial = false;
            }
        }

        return $this->collSpyProductLabelProductAbstracts;
    }

    /**
     * Sets a collection of SpyProductLabelProductAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductLabelProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductLabelProductAbstracts(Collection $spyProductLabelProductAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductLabelProductAbstract[] $spyProductLabelProductAbstractsToDelete */
        $spyProductLabelProductAbstractsToDelete = $this->getSpyProductLabelProductAbstracts(new Criteria(), $con)->diff($spyProductLabelProductAbstracts);


        $this->spyProductLabelProductAbstractsScheduledForDeletion = $spyProductLabelProductAbstractsToDelete;

        foreach ($spyProductLabelProductAbstractsToDelete as $spyProductLabelProductAbstractRemoved) {
            $spyProductLabelProductAbstractRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductLabelProductAbstracts = null;
        foreach ($spyProductLabelProductAbstracts as $spyProductLabelProductAbstract) {
            $this->addSpyProductLabelProductAbstract($spyProductLabelProductAbstract);
        }

        $this->collSpyProductLabelProductAbstracts = $spyProductLabelProductAbstracts;
        $this->collSpyProductLabelProductAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductLabelProductAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductLabelProductAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductLabelProductAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductLabelProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductLabelProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductLabelProductAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductLabelProductAbstracts());
            }

            $query = SpyProductLabelProductAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductLabelProductAbstracts);
    }

    /**
     * Method called to associate a SpyProductLabelProductAbstract object to this object
     * through the SpyProductLabelProductAbstract foreign key attribute.
     *
     * @param SpyProductLabelProductAbstract $l SpyProductLabelProductAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductLabelProductAbstract(SpyProductLabelProductAbstract $l)
    {
        if ($this->collSpyProductLabelProductAbstracts === null) {
            $this->initSpyProductLabelProductAbstracts();
            $this->collSpyProductLabelProductAbstractsPartial = true;
        }

        if (!$this->collSpyProductLabelProductAbstracts->contains($l)) {
            $this->doAddSpyProductLabelProductAbstract($l);

            if ($this->spyProductLabelProductAbstractsScheduledForDeletion and $this->spyProductLabelProductAbstractsScheduledForDeletion->contains($l)) {
                $this->spyProductLabelProductAbstractsScheduledForDeletion->remove($this->spyProductLabelProductAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductLabelProductAbstract $spyProductLabelProductAbstract The SpyProductLabelProductAbstract object to add.
     */
    protected function doAddSpyProductLabelProductAbstract(SpyProductLabelProductAbstract $spyProductLabelProductAbstract): void
    {
        $this->collSpyProductLabelProductAbstracts[]= $spyProductLabelProductAbstract;
        $spyProductLabelProductAbstract->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductLabelProductAbstract $spyProductLabelProductAbstract The SpyProductLabelProductAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductLabelProductAbstract(SpyProductLabelProductAbstract $spyProductLabelProductAbstract)
    {
        if ($this->getSpyProductLabelProductAbstracts()->contains($spyProductLabelProductAbstract)) {
            $pos = $this->collSpyProductLabelProductAbstracts->search($spyProductLabelProductAbstract);
            $this->collSpyProductLabelProductAbstracts->remove($pos);
            if (null === $this->spyProductLabelProductAbstractsScheduledForDeletion) {
                $this->spyProductLabelProductAbstractsScheduledForDeletion = clone $this->collSpyProductLabelProductAbstracts;
                $this->spyProductLabelProductAbstractsScheduledForDeletion->clear();
            }
            $this->spyProductLabelProductAbstractsScheduledForDeletion[]= clone $spyProductLabelProductAbstract;
            $spyProductLabelProductAbstract->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductLabelProductAbstracts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductLabelProductAbstract[] List of SpyProductLabelProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductLabelProductAbstract}> List of SpyProductLabelProductAbstract objects
     */
    public function getSpyProductLabelProductAbstractsJoinSpyProductLabel(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductLabelProductAbstractQuery::create(null, $criteria);
        $query->joinWith('SpyProductLabel', $joinBehavior);

        return $this->getSpyProductLabelProductAbstracts($query, $con);
    }

    /**
     * Clears out the collSpyProductMeasurementBaseUnits collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductMeasurementBaseUnits()
     */
    public function clearSpyProductMeasurementBaseUnits()
    {
        $this->collSpyProductMeasurementBaseUnits = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductMeasurementBaseUnits collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductMeasurementBaseUnits($v = true): void
    {
        $this->collSpyProductMeasurementBaseUnitsPartial = $v;
    }

    /**
     * Initializes the collSpyProductMeasurementBaseUnits collection.
     *
     * By default this just sets the collSpyProductMeasurementBaseUnits collection to an empty array (like clearcollSpyProductMeasurementBaseUnits());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductMeasurementBaseUnits(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductMeasurementBaseUnits && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductMeasurementBaseUnitTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductMeasurementBaseUnits = new $collectionClassName;
        $this->collSpyProductMeasurementBaseUnits->setModel('\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit');
    }

    /**
     * Gets an array of SpyProductMeasurementBaseUnit objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductMeasurementBaseUnit[] List of SpyProductMeasurementBaseUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductMeasurementBaseUnit> List of SpyProductMeasurementBaseUnit objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductMeasurementBaseUnits(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductMeasurementBaseUnitsPartial && !$this->isNew();
        if (null === $this->collSpyProductMeasurementBaseUnits || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductMeasurementBaseUnits) {
                    $this->initSpyProductMeasurementBaseUnits();
                } else {
                    $collectionClassName = SpyProductMeasurementBaseUnitTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductMeasurementBaseUnits = new $collectionClassName;
                    $collSpyProductMeasurementBaseUnits->setModel('\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit');

                    return $collSpyProductMeasurementBaseUnits;
                }
            } else {
                $collSpyProductMeasurementBaseUnits = SpyProductMeasurementBaseUnitQuery::create(null, $criteria)
                    ->filterByProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductMeasurementBaseUnitsPartial && count($collSpyProductMeasurementBaseUnits)) {
                        $this->initSpyProductMeasurementBaseUnits(false);

                        foreach ($collSpyProductMeasurementBaseUnits as $obj) {
                            if (false == $this->collSpyProductMeasurementBaseUnits->contains($obj)) {
                                $this->collSpyProductMeasurementBaseUnits->append($obj);
                            }
                        }

                        $this->collSpyProductMeasurementBaseUnitsPartial = true;
                    }

                    return $collSpyProductMeasurementBaseUnits;
                }

                if ($partial && $this->collSpyProductMeasurementBaseUnits) {
                    foreach ($this->collSpyProductMeasurementBaseUnits as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductMeasurementBaseUnits[] = $obj;
                        }
                    }
                }

                $this->collSpyProductMeasurementBaseUnits = $collSpyProductMeasurementBaseUnits;
                $this->collSpyProductMeasurementBaseUnitsPartial = false;
            }
        }

        return $this->collSpyProductMeasurementBaseUnits;
    }

    /**
     * Sets a collection of SpyProductMeasurementBaseUnit objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductMeasurementBaseUnits A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductMeasurementBaseUnits(Collection $spyProductMeasurementBaseUnits, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductMeasurementBaseUnit[] $spyProductMeasurementBaseUnitsToDelete */
        $spyProductMeasurementBaseUnitsToDelete = $this->getSpyProductMeasurementBaseUnits(new Criteria(), $con)->diff($spyProductMeasurementBaseUnits);


        $this->spyProductMeasurementBaseUnitsScheduledForDeletion = $spyProductMeasurementBaseUnitsToDelete;

        foreach ($spyProductMeasurementBaseUnitsToDelete as $spyProductMeasurementBaseUnitRemoved) {
            $spyProductMeasurementBaseUnitRemoved->setProductAbstract(null);
        }

        $this->collSpyProductMeasurementBaseUnits = null;
        foreach ($spyProductMeasurementBaseUnits as $spyProductMeasurementBaseUnit) {
            $this->addSpyProductMeasurementBaseUnit($spyProductMeasurementBaseUnit);
        }

        $this->collSpyProductMeasurementBaseUnits = $spyProductMeasurementBaseUnits;
        $this->collSpyProductMeasurementBaseUnitsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductMeasurementBaseUnit objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductMeasurementBaseUnit objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductMeasurementBaseUnits(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductMeasurementBaseUnitsPartial && !$this->isNew();
        if (null === $this->collSpyProductMeasurementBaseUnits || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductMeasurementBaseUnits) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductMeasurementBaseUnits());
            }

            $query = SpyProductMeasurementBaseUnitQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductMeasurementBaseUnits);
    }

    /**
     * Method called to associate a SpyProductMeasurementBaseUnit object to this object
     * through the SpyProductMeasurementBaseUnit foreign key attribute.
     *
     * @param SpyProductMeasurementBaseUnit $l SpyProductMeasurementBaseUnit
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductMeasurementBaseUnit(SpyProductMeasurementBaseUnit $l)
    {
        if ($this->collSpyProductMeasurementBaseUnits === null) {
            $this->initSpyProductMeasurementBaseUnits();
            $this->collSpyProductMeasurementBaseUnitsPartial = true;
        }

        if (!$this->collSpyProductMeasurementBaseUnits->contains($l)) {
            $this->doAddSpyProductMeasurementBaseUnit($l);

            if ($this->spyProductMeasurementBaseUnitsScheduledForDeletion and $this->spyProductMeasurementBaseUnitsScheduledForDeletion->contains($l)) {
                $this->spyProductMeasurementBaseUnitsScheduledForDeletion->remove($this->spyProductMeasurementBaseUnitsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductMeasurementBaseUnit $spyProductMeasurementBaseUnit The SpyProductMeasurementBaseUnit object to add.
     */
    protected function doAddSpyProductMeasurementBaseUnit(SpyProductMeasurementBaseUnit $spyProductMeasurementBaseUnit): void
    {
        $this->collSpyProductMeasurementBaseUnits[]= $spyProductMeasurementBaseUnit;
        $spyProductMeasurementBaseUnit->setProductAbstract($this);
    }

    /**
     * @param SpyProductMeasurementBaseUnit $spyProductMeasurementBaseUnit The SpyProductMeasurementBaseUnit object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductMeasurementBaseUnit(SpyProductMeasurementBaseUnit $spyProductMeasurementBaseUnit)
    {
        if ($this->getSpyProductMeasurementBaseUnits()->contains($spyProductMeasurementBaseUnit)) {
            $pos = $this->collSpyProductMeasurementBaseUnits->search($spyProductMeasurementBaseUnit);
            $this->collSpyProductMeasurementBaseUnits->remove($pos);
            if (null === $this->spyProductMeasurementBaseUnitsScheduledForDeletion) {
                $this->spyProductMeasurementBaseUnitsScheduledForDeletion = clone $this->collSpyProductMeasurementBaseUnits;
                $this->spyProductMeasurementBaseUnitsScheduledForDeletion->clear();
            }
            $this->spyProductMeasurementBaseUnitsScheduledForDeletion[]= clone $spyProductMeasurementBaseUnit;
            $spyProductMeasurementBaseUnit->setProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductMeasurementBaseUnits from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductMeasurementBaseUnit[] List of SpyProductMeasurementBaseUnit objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductMeasurementBaseUnit}> List of SpyProductMeasurementBaseUnit objects
     */
    public function getSpyProductMeasurementBaseUnitsJoinProductMeasurementUnit(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductMeasurementBaseUnitQuery::create(null, $criteria);
        $query->joinWith('ProductMeasurementUnit', $joinBehavior);

        return $this->getSpyProductMeasurementBaseUnits($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractProductOptionGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractProductOptionGroups()
     */
    public function clearSpyProductAbstractProductOptionGroups()
    {
        $this->collSpyProductAbstractProductOptionGroups = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractProductOptionGroups collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractProductOptionGroups($v = true): void
    {
        $this->collSpyProductAbstractProductOptionGroupsPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractProductOptionGroups collection.
     *
     * By default this just sets the collSpyProductAbstractProductOptionGroups collection to an empty array (like clearcollSpyProductAbstractProductOptionGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractProductOptionGroups(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractProductOptionGroups && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractProductOptionGroups = new $collectionClassName;
        $this->collSpyProductAbstractProductOptionGroups->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup');
    }

    /**
     * Gets an array of SpyProductAbstractProductOptionGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductAbstractProductOptionGroup[] List of SpyProductAbstractProductOptionGroup objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractProductOptionGroup> List of SpyProductAbstractProductOptionGroup objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractProductOptionGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractProductOptionGroups) {
                    $this->initSpyProductAbstractProductOptionGroups();
                } else {
                    $collectionClassName = SpyProductAbstractProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractProductOptionGroups = new $collectionClassName;
                    $collSpyProductAbstractProductOptionGroups->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup');

                    return $collSpyProductAbstractProductOptionGroups;
                }
            } else {
                $collSpyProductAbstractProductOptionGroups = SpyProductAbstractProductOptionGroupQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractProductOptionGroupsPartial && count($collSpyProductAbstractProductOptionGroups)) {
                        $this->initSpyProductAbstractProductOptionGroups(false);

                        foreach ($collSpyProductAbstractProductOptionGroups as $obj) {
                            if (false == $this->collSpyProductAbstractProductOptionGroups->contains($obj)) {
                                $this->collSpyProductAbstractProductOptionGroups->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractProductOptionGroupsPartial = true;
                    }

                    return $collSpyProductAbstractProductOptionGroups;
                }

                if ($partial && $this->collSpyProductAbstractProductOptionGroups) {
                    foreach ($this->collSpyProductAbstractProductOptionGroups as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractProductOptionGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractProductOptionGroups = $collSpyProductAbstractProductOptionGroups;
                $this->collSpyProductAbstractProductOptionGroupsPartial = false;
            }
        }

        return $this->collSpyProductAbstractProductOptionGroups;
    }

    /**
     * Sets a collection of SpyProductAbstractProductOptionGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractProductOptionGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractProductOptionGroups(Collection $spyProductAbstractProductOptionGroups, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductAbstractProductOptionGroup[] $spyProductAbstractProductOptionGroupsToDelete */
        $spyProductAbstractProductOptionGroupsToDelete = $this->getSpyProductAbstractProductOptionGroups(new Criteria(), $con)->diff($spyProductAbstractProductOptionGroups);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->spyProductAbstractProductOptionGroupsScheduledForDeletion = clone $spyProductAbstractProductOptionGroupsToDelete;

        foreach ($spyProductAbstractProductOptionGroupsToDelete as $spyProductAbstractProductOptionGroupRemoved) {
            $spyProductAbstractProductOptionGroupRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductAbstractProductOptionGroups = null;
        foreach ($spyProductAbstractProductOptionGroups as $spyProductAbstractProductOptionGroup) {
            $this->addSpyProductAbstractProductOptionGroup($spyProductAbstractProductOptionGroup);
        }

        $this->collSpyProductAbstractProductOptionGroups = $spyProductAbstractProductOptionGroups;
        $this->collSpyProductAbstractProductOptionGroupsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductAbstractProductOptionGroup objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductAbstractProductOptionGroup objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractProductOptionGroups(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractProductOptionGroups) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractProductOptionGroups());
            }

            $query = SpyProductAbstractProductOptionGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractProductOptionGroups);
    }

    /**
     * Method called to associate a SpyProductAbstractProductOptionGroup object to this object
     * through the SpyProductAbstractProductOptionGroup foreign key attribute.
     *
     * @param SpyProductAbstractProductOptionGroup $l SpyProductAbstractProductOptionGroup
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractProductOptionGroup(SpyProductAbstractProductOptionGroup $l)
    {
        if ($this->collSpyProductAbstractProductOptionGroups === null) {
            $this->initSpyProductAbstractProductOptionGroups();
            $this->collSpyProductAbstractProductOptionGroupsPartial = true;
        }

        if (!$this->collSpyProductAbstractProductOptionGroups->contains($l)) {
            $this->doAddSpyProductAbstractProductOptionGroup($l);

            if ($this->spyProductAbstractProductOptionGroupsScheduledForDeletion and $this->spyProductAbstractProductOptionGroupsScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractProductOptionGroupsScheduledForDeletion->remove($this->spyProductAbstractProductOptionGroupsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup The SpyProductAbstractProductOptionGroup object to add.
     */
    protected function doAddSpyProductAbstractProductOptionGroup(SpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup): void
    {
        $this->collSpyProductAbstractProductOptionGroups[]= $spyProductAbstractProductOptionGroup;
        $spyProductAbstractProductOptionGroup->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup The SpyProductAbstractProductOptionGroup object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractProductOptionGroup(SpyProductAbstractProductOptionGroup $spyProductAbstractProductOptionGroup)
    {
        if ($this->getSpyProductAbstractProductOptionGroups()->contains($spyProductAbstractProductOptionGroup)) {
            $pos = $this->collSpyProductAbstractProductOptionGroups->search($spyProductAbstractProductOptionGroup);
            $this->collSpyProductAbstractProductOptionGroups->remove($pos);
            if (null === $this->spyProductAbstractProductOptionGroupsScheduledForDeletion) {
                $this->spyProductAbstractProductOptionGroupsScheduledForDeletion = clone $this->collSpyProductAbstractProductOptionGroups;
                $this->spyProductAbstractProductOptionGroupsScheduledForDeletion->clear();
            }
            $this->spyProductAbstractProductOptionGroupsScheduledForDeletion[]= clone $spyProductAbstractProductOptionGroup;
            $spyProductAbstractProductOptionGroup->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAbstractProductOptionGroups from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAbstractProductOptionGroup[] List of SpyProductAbstractProductOptionGroup objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractProductOptionGroup}> List of SpyProductAbstractProductOptionGroup objects
     */
    public function getSpyProductAbstractProductOptionGroupsJoinSpyProductOptionGroup(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAbstractProductOptionGroupQuery::create(null, $criteria);
        $query->joinWith('SpyProductOptionGroup', $joinBehavior);

        return $this->getSpyProductAbstractProductOptionGroups($query, $con);
    }

    /**
     * Clears out the collSpyProductRelations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductRelations()
     */
    public function clearSpyProductRelations()
    {
        $this->collSpyProductRelations = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductRelations collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductRelations($v = true): void
    {
        $this->collSpyProductRelationsPartial = $v;
    }

    /**
     * Initializes the collSpyProductRelations collection.
     *
     * By default this just sets the collSpyProductRelations collection to an empty array (like clearcollSpyProductRelations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductRelations(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductRelations && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductRelationTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductRelations = new $collectionClassName;
        $this->collSpyProductRelations->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelation');
    }

    /**
     * Gets an array of SpyProductRelation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductRelation[] List of SpyProductRelation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductRelation> List of SpyProductRelation objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductRelations(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductRelationsPartial && !$this->isNew();
        if (null === $this->collSpyProductRelations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductRelations) {
                    $this->initSpyProductRelations();
                } else {
                    $collectionClassName = SpyProductRelationTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductRelations = new $collectionClassName;
                    $collSpyProductRelations->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelation');

                    return $collSpyProductRelations;
                }
            } else {
                $collSpyProductRelations = SpyProductRelationQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductRelationsPartial && count($collSpyProductRelations)) {
                        $this->initSpyProductRelations(false);

                        foreach ($collSpyProductRelations as $obj) {
                            if (false == $this->collSpyProductRelations->contains($obj)) {
                                $this->collSpyProductRelations->append($obj);
                            }
                        }

                        $this->collSpyProductRelationsPartial = true;
                    }

                    return $collSpyProductRelations;
                }

                if ($partial && $this->collSpyProductRelations) {
                    foreach ($this->collSpyProductRelations as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductRelations[] = $obj;
                        }
                    }
                }

                $this->collSpyProductRelations = $collSpyProductRelations;
                $this->collSpyProductRelationsPartial = false;
            }
        }

        return $this->collSpyProductRelations;
    }

    /**
     * Sets a collection of SpyProductRelation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductRelations A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductRelations(Collection $spyProductRelations, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductRelation[] $spyProductRelationsToDelete */
        $spyProductRelationsToDelete = $this->getSpyProductRelations(new Criteria(), $con)->diff($spyProductRelations);


        $this->spyProductRelationsScheduledForDeletion = $spyProductRelationsToDelete;

        foreach ($spyProductRelationsToDelete as $spyProductRelationRemoved) {
            $spyProductRelationRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductRelations = null;
        foreach ($spyProductRelations as $spyProductRelation) {
            $this->addSpyProductRelation($spyProductRelation);
        }

        $this->collSpyProductRelations = $spyProductRelations;
        $this->collSpyProductRelationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductRelation objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductRelation objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductRelations(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductRelationsPartial && !$this->isNew();
        if (null === $this->collSpyProductRelations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductRelations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductRelations());
            }

            $query = SpyProductRelationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductRelations);
    }

    /**
     * Method called to associate a SpyProductRelation object to this object
     * through the SpyProductRelation foreign key attribute.
     *
     * @param SpyProductRelation $l SpyProductRelation
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductRelation(SpyProductRelation $l)
    {
        if ($this->collSpyProductRelations === null) {
            $this->initSpyProductRelations();
            $this->collSpyProductRelationsPartial = true;
        }

        if (!$this->collSpyProductRelations->contains($l)) {
            $this->doAddSpyProductRelation($l);

            if ($this->spyProductRelationsScheduledForDeletion and $this->spyProductRelationsScheduledForDeletion->contains($l)) {
                $this->spyProductRelationsScheduledForDeletion->remove($this->spyProductRelationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductRelation $spyProductRelation The SpyProductRelation object to add.
     */
    protected function doAddSpyProductRelation(SpyProductRelation $spyProductRelation): void
    {
        $this->collSpyProductRelations[]= $spyProductRelation;
        $spyProductRelation->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductRelation $spyProductRelation The SpyProductRelation object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductRelation(SpyProductRelation $spyProductRelation)
    {
        if ($this->getSpyProductRelations()->contains($spyProductRelation)) {
            $pos = $this->collSpyProductRelations->search($spyProductRelation);
            $this->collSpyProductRelations->remove($pos);
            if (null === $this->spyProductRelationsScheduledForDeletion) {
                $this->spyProductRelationsScheduledForDeletion = clone $this->collSpyProductRelations;
                $this->spyProductRelationsScheduledForDeletion->clear();
            }
            $this->spyProductRelationsScheduledForDeletion[]= clone $spyProductRelation;
            $spyProductRelation->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductRelations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductRelation[] List of SpyProductRelation objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductRelation}> List of SpyProductRelation objects
     */
    public function getSpyProductRelationsJoinSpyProductRelationType(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductRelationQuery::create(null, $criteria);
        $query->joinWith('SpyProductRelationType', $joinBehavior);

        return $this->getSpyProductRelations($query, $con);
    }

    /**
     * Clears out the collSpyProductRelationProductAbstracts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductRelationProductAbstracts()
     */
    public function clearSpyProductRelationProductAbstracts()
    {
        $this->collSpyProductRelationProductAbstracts = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductRelationProductAbstracts collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductRelationProductAbstracts($v = true): void
    {
        $this->collSpyProductRelationProductAbstractsPartial = $v;
    }

    /**
     * Initializes the collSpyProductRelationProductAbstracts collection.
     *
     * By default this just sets the collSpyProductRelationProductAbstracts collection to an empty array (like clearcollSpyProductRelationProductAbstracts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductRelationProductAbstracts(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductRelationProductAbstracts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductRelationProductAbstractTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductRelationProductAbstracts = new $collectionClassName;
        $this->collSpyProductRelationProductAbstracts->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract');
    }

    /**
     * Gets an array of SpyProductRelationProductAbstract objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductRelationProductAbstract[] List of SpyProductRelationProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductRelationProductAbstract> List of SpyProductRelationProductAbstract objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductRelationProductAbstracts(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductRelationProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductRelationProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductRelationProductAbstracts) {
                    $this->initSpyProductRelationProductAbstracts();
                } else {
                    $collectionClassName = SpyProductRelationProductAbstractTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductRelationProductAbstracts = new $collectionClassName;
                    $collSpyProductRelationProductAbstracts->setModel('\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract');

                    return $collSpyProductRelationProductAbstracts;
                }
            } else {
                $collSpyProductRelationProductAbstracts = SpyProductRelationProductAbstractQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductRelationProductAbstractsPartial && count($collSpyProductRelationProductAbstracts)) {
                        $this->initSpyProductRelationProductAbstracts(false);

                        foreach ($collSpyProductRelationProductAbstracts as $obj) {
                            if (false == $this->collSpyProductRelationProductAbstracts->contains($obj)) {
                                $this->collSpyProductRelationProductAbstracts->append($obj);
                            }
                        }

                        $this->collSpyProductRelationProductAbstractsPartial = true;
                    }

                    return $collSpyProductRelationProductAbstracts;
                }

                if ($partial && $this->collSpyProductRelationProductAbstracts) {
                    foreach ($this->collSpyProductRelationProductAbstracts as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductRelationProductAbstracts[] = $obj;
                        }
                    }
                }

                $this->collSpyProductRelationProductAbstracts = $collSpyProductRelationProductAbstracts;
                $this->collSpyProductRelationProductAbstractsPartial = false;
            }
        }

        return $this->collSpyProductRelationProductAbstracts;
    }

    /**
     * Sets a collection of SpyProductRelationProductAbstract objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductRelationProductAbstracts A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductRelationProductAbstracts(Collection $spyProductRelationProductAbstracts, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductRelationProductAbstract[] $spyProductRelationProductAbstractsToDelete */
        $spyProductRelationProductAbstractsToDelete = $this->getSpyProductRelationProductAbstracts(new Criteria(), $con)->diff($spyProductRelationProductAbstracts);


        $this->spyProductRelationProductAbstractsScheduledForDeletion = $spyProductRelationProductAbstractsToDelete;

        foreach ($spyProductRelationProductAbstractsToDelete as $spyProductRelationProductAbstractRemoved) {
            $spyProductRelationProductAbstractRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductRelationProductAbstracts = null;
        foreach ($spyProductRelationProductAbstracts as $spyProductRelationProductAbstract) {
            $this->addSpyProductRelationProductAbstract($spyProductRelationProductAbstract);
        }

        $this->collSpyProductRelationProductAbstracts = $spyProductRelationProductAbstracts;
        $this->collSpyProductRelationProductAbstractsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductRelationProductAbstract objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductRelationProductAbstract objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductRelationProductAbstracts(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductRelationProductAbstractsPartial && !$this->isNew();
        if (null === $this->collSpyProductRelationProductAbstracts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductRelationProductAbstracts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductRelationProductAbstracts());
            }

            $query = SpyProductRelationProductAbstractQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductRelationProductAbstracts);
    }

    /**
     * Method called to associate a SpyProductRelationProductAbstract object to this object
     * through the SpyProductRelationProductAbstract foreign key attribute.
     *
     * @param SpyProductRelationProductAbstract $l SpyProductRelationProductAbstract
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductRelationProductAbstract(SpyProductRelationProductAbstract $l)
    {
        if ($this->collSpyProductRelationProductAbstracts === null) {
            $this->initSpyProductRelationProductAbstracts();
            $this->collSpyProductRelationProductAbstractsPartial = true;
        }

        if (!$this->collSpyProductRelationProductAbstracts->contains($l)) {
            $this->doAddSpyProductRelationProductAbstract($l);

            if ($this->spyProductRelationProductAbstractsScheduledForDeletion and $this->spyProductRelationProductAbstractsScheduledForDeletion->contains($l)) {
                $this->spyProductRelationProductAbstractsScheduledForDeletion->remove($this->spyProductRelationProductAbstractsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductRelationProductAbstract $spyProductRelationProductAbstract The SpyProductRelationProductAbstract object to add.
     */
    protected function doAddSpyProductRelationProductAbstract(SpyProductRelationProductAbstract $spyProductRelationProductAbstract): void
    {
        $this->collSpyProductRelationProductAbstracts[]= $spyProductRelationProductAbstract;
        $spyProductRelationProductAbstract->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductRelationProductAbstract $spyProductRelationProductAbstract The SpyProductRelationProductAbstract object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductRelationProductAbstract(SpyProductRelationProductAbstract $spyProductRelationProductAbstract)
    {
        if ($this->getSpyProductRelationProductAbstracts()->contains($spyProductRelationProductAbstract)) {
            $pos = $this->collSpyProductRelationProductAbstracts->search($spyProductRelationProductAbstract);
            $this->collSpyProductRelationProductAbstracts->remove($pos);
            if (null === $this->spyProductRelationProductAbstractsScheduledForDeletion) {
                $this->spyProductRelationProductAbstractsScheduledForDeletion = clone $this->collSpyProductRelationProductAbstracts;
                $this->spyProductRelationProductAbstractsScheduledForDeletion->clear();
            }
            $this->spyProductRelationProductAbstractsScheduledForDeletion[]= clone $spyProductRelationProductAbstract;
            $spyProductRelationProductAbstract->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductRelationProductAbstracts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductRelationProductAbstract[] List of SpyProductRelationProductAbstract objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductRelationProductAbstract}> List of SpyProductRelationProductAbstract objects
     */
    public function getSpyProductRelationProductAbstractsJoinSpyProductRelation(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductRelationProductAbstractQuery::create(null, $criteria);
        $query->joinWith('SpyProductRelation', $joinBehavior);

        return $this->getSpyProductRelationProductAbstracts($query, $con);
    }

    /**
     * Clears out the collSpyProductReviews collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductReviews()
     */
    public function clearSpyProductReviews()
    {
        $this->collSpyProductReviews = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductReviews collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductReviews($v = true): void
    {
        $this->collSpyProductReviewsPartial = $v;
    }

    /**
     * Initializes the collSpyProductReviews collection.
     *
     * By default this just sets the collSpyProductReviews collection to an empty array (like clearcollSpyProductReviews());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductReviews(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductReviews && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductReviewTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductReviews = new $collectionClassName;
        $this->collSpyProductReviews->setModel('\Orm\Zed\ProductReview\Persistence\SpyProductReview');
    }

    /**
     * Gets an array of SpyProductReview objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductReview[] List of SpyProductReview objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductReview> List of SpyProductReview objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductReviews(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductReviewsPartial && !$this->isNew();
        if (null === $this->collSpyProductReviews || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductReviews) {
                    $this->initSpyProductReviews();
                } else {
                    $collectionClassName = SpyProductReviewTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductReviews = new $collectionClassName;
                    $collSpyProductReviews->setModel('\Orm\Zed\ProductReview\Persistence\SpyProductReview');

                    return $collSpyProductReviews;
                }
            } else {
                $collSpyProductReviews = SpyProductReviewQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductReviewsPartial && count($collSpyProductReviews)) {
                        $this->initSpyProductReviews(false);

                        foreach ($collSpyProductReviews as $obj) {
                            if (false == $this->collSpyProductReviews->contains($obj)) {
                                $this->collSpyProductReviews->append($obj);
                            }
                        }

                        $this->collSpyProductReviewsPartial = true;
                    }

                    return $collSpyProductReviews;
                }

                if ($partial && $this->collSpyProductReviews) {
                    foreach ($this->collSpyProductReviews as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductReviews[] = $obj;
                        }
                    }
                }

                $this->collSpyProductReviews = $collSpyProductReviews;
                $this->collSpyProductReviewsPartial = false;
            }
        }

        return $this->collSpyProductReviews;
    }

    /**
     * Sets a collection of SpyProductReview objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductReviews A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductReviews(Collection $spyProductReviews, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductReview[] $spyProductReviewsToDelete */
        $spyProductReviewsToDelete = $this->getSpyProductReviews(new Criteria(), $con)->diff($spyProductReviews);


        $this->spyProductReviewsScheduledForDeletion = $spyProductReviewsToDelete;

        foreach ($spyProductReviewsToDelete as $spyProductReviewRemoved) {
            $spyProductReviewRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductReviews = null;
        foreach ($spyProductReviews as $spyProductReview) {
            $this->addSpyProductReview($spyProductReview);
        }

        $this->collSpyProductReviews = $spyProductReviews;
        $this->collSpyProductReviewsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductReview objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductReview objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductReviews(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductReviewsPartial && !$this->isNew();
        if (null === $this->collSpyProductReviews || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductReviews) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductReviews());
            }

            $query = SpyProductReviewQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductReviews);
    }

    /**
     * Method called to associate a SpyProductReview object to this object
     * through the SpyProductReview foreign key attribute.
     *
     * @param SpyProductReview $l SpyProductReview
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductReview(SpyProductReview $l)
    {
        if ($this->collSpyProductReviews === null) {
            $this->initSpyProductReviews();
            $this->collSpyProductReviewsPartial = true;
        }

        if (!$this->collSpyProductReviews->contains($l)) {
            $this->doAddSpyProductReview($l);

            if ($this->spyProductReviewsScheduledForDeletion and $this->spyProductReviewsScheduledForDeletion->contains($l)) {
                $this->spyProductReviewsScheduledForDeletion->remove($this->spyProductReviewsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductReview $spyProductReview The SpyProductReview object to add.
     */
    protected function doAddSpyProductReview(SpyProductReview $spyProductReview): void
    {
        $this->collSpyProductReviews[]= $spyProductReview;
        $spyProductReview->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductReview $spyProductReview The SpyProductReview object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductReview(SpyProductReview $spyProductReview)
    {
        if ($this->getSpyProductReviews()->contains($spyProductReview)) {
            $pos = $this->collSpyProductReviews->search($spyProductReview);
            $this->collSpyProductReviews->remove($pos);
            if (null === $this->spyProductReviewsScheduledForDeletion) {
                $this->spyProductReviewsScheduledForDeletion = clone $this->collSpyProductReviews;
                $this->spyProductReviewsScheduledForDeletion->clear();
            }
            $this->spyProductReviewsScheduledForDeletion[]= clone $spyProductReview;
            $spyProductReview->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductReviews from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductReview[] List of SpyProductReview objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductReview}> List of SpyProductReview objects
     */
    public function getSpyProductReviewsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductReviewQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyProductReviews($query, $con);
    }

    /**
     * Clears out the collSpyProductAbstractSets collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyProductAbstractSets()
     */
    public function clearSpyProductAbstractSets()
    {
        $this->collSpyProductAbstractSets = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyProductAbstractSets collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyProductAbstractSets($v = true): void
    {
        $this->collSpyProductAbstractSetsPartial = $v;
    }

    /**
     * Initializes the collSpyProductAbstractSets collection.
     *
     * By default this just sets the collSpyProductAbstractSets collection to an empty array (like clearcollSpyProductAbstractSets());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyProductAbstractSets(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyProductAbstractSets && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyProductAbstractSetTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductAbstractSets = new $collectionClassName;
        $this->collSpyProductAbstractSets->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet');
    }

    /**
     * Gets an array of SpyProductAbstractSet objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyProductAbstractSet[] List of SpyProductAbstractSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractSet> List of SpyProductAbstractSet objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyProductAbstractSets(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductAbstractSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractSets || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductAbstractSets) {
                    $this->initSpyProductAbstractSets();
                } else {
                    $collectionClassName = SpyProductAbstractSetTableMap::getTableMap()->getCollectionClassName();

                    $collSpyProductAbstractSets = new $collectionClassName;
                    $collSpyProductAbstractSets->setModel('\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet');

                    return $collSpyProductAbstractSets;
                }
            } else {
                $collSpyProductAbstractSets = SpyProductAbstractSetQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyProductAbstractSetsPartial && count($collSpyProductAbstractSets)) {
                        $this->initSpyProductAbstractSets(false);

                        foreach ($collSpyProductAbstractSets as $obj) {
                            if (false == $this->collSpyProductAbstractSets->contains($obj)) {
                                $this->collSpyProductAbstractSets->append($obj);
                            }
                        }

                        $this->collSpyProductAbstractSetsPartial = true;
                    }

                    return $collSpyProductAbstractSets;
                }

                if ($partial && $this->collSpyProductAbstractSets) {
                    foreach ($this->collSpyProductAbstractSets as $obj) {
                        if ($obj->isNew()) {
                            $collSpyProductAbstractSets[] = $obj;
                        }
                    }
                }

                $this->collSpyProductAbstractSets = $collSpyProductAbstractSets;
                $this->collSpyProductAbstractSetsPartial = false;
            }
        }

        return $this->collSpyProductAbstractSets;
    }

    /**
     * Sets a collection of SpyProductAbstractSet objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductAbstractSets A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductAbstractSets(Collection $spyProductAbstractSets, ?ConnectionInterface $con = null)
    {
        /** @var SpyProductAbstractSet[] $spyProductAbstractSetsToDelete */
        $spyProductAbstractSetsToDelete = $this->getSpyProductAbstractSets(new Criteria(), $con)->diff($spyProductAbstractSets);


        $this->spyProductAbstractSetsScheduledForDeletion = $spyProductAbstractSetsToDelete;

        foreach ($spyProductAbstractSetsToDelete as $spyProductAbstractSetRemoved) {
            $spyProductAbstractSetRemoved->setSpyProductAbstract(null);
        }

        $this->collSpyProductAbstractSets = null;
        foreach ($spyProductAbstractSets as $spyProductAbstractSet) {
            $this->addSpyProductAbstractSet($spyProductAbstractSet);
        }

        $this->collSpyProductAbstractSets = $spyProductAbstractSets;
        $this->collSpyProductAbstractSetsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyProductAbstractSet objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyProductAbstractSet objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyProductAbstractSets(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductAbstractSetsPartial && !$this->isNew();
        if (null === $this->collSpyProductAbstractSets || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductAbstractSets) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyProductAbstractSets());
            }

            $query = SpyProductAbstractSetQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProductAbstract($this)
                ->count($con);
        }

        return count($this->collSpyProductAbstractSets);
    }

    /**
     * Method called to associate a SpyProductAbstractSet object to this object
     * through the SpyProductAbstractSet foreign key attribute.
     *
     * @param SpyProductAbstractSet $l SpyProductAbstractSet
     * @return $this The current object (for fluent API support)
     */
    public function addSpyProductAbstractSet(SpyProductAbstractSet $l)
    {
        if ($this->collSpyProductAbstractSets === null) {
            $this->initSpyProductAbstractSets();
            $this->collSpyProductAbstractSetsPartial = true;
        }

        if (!$this->collSpyProductAbstractSets->contains($l)) {
            $this->doAddSpyProductAbstractSet($l);

            if ($this->spyProductAbstractSetsScheduledForDeletion and $this->spyProductAbstractSetsScheduledForDeletion->contains($l)) {
                $this->spyProductAbstractSetsScheduledForDeletion->remove($this->spyProductAbstractSetsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyProductAbstractSet $spyProductAbstractSet The SpyProductAbstractSet object to add.
     */
    protected function doAddSpyProductAbstractSet(SpyProductAbstractSet $spyProductAbstractSet): void
    {
        $this->collSpyProductAbstractSets[]= $spyProductAbstractSet;
        $spyProductAbstractSet->setSpyProductAbstract($this);
    }

    /**
     * @param SpyProductAbstractSet $spyProductAbstractSet The SpyProductAbstractSet object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyProductAbstractSet(SpyProductAbstractSet $spyProductAbstractSet)
    {
        if ($this->getSpyProductAbstractSets()->contains($spyProductAbstractSet)) {
            $pos = $this->collSpyProductAbstractSets->search($spyProductAbstractSet);
            $this->collSpyProductAbstractSets->remove($pos);
            if (null === $this->spyProductAbstractSetsScheduledForDeletion) {
                $this->spyProductAbstractSetsScheduledForDeletion = clone $this->collSpyProductAbstractSets;
                $this->spyProductAbstractSetsScheduledForDeletion->clear();
            }
            $this->spyProductAbstractSetsScheduledForDeletion[]= clone $spyProductAbstractSet;
            $spyProductAbstractSet->setSpyProductAbstract(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyProductAbstractSets from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyProductAbstractSet[] List of SpyProductAbstractSet objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductAbstractSet}> List of SpyProductAbstractSet objects
     */
    public function getSpyProductAbstractSetsJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyProductAbstractSetQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyProductAbstractSets($query, $con);
    }

    /**
     * Clears out the collSpyUrls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addSpyUrls()
     */
    public function clearSpyUrls()
    {
        $this->collSpyUrls = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collSpyUrls collection loaded partially.
     *
     * @return void
     */
    public function resetPartialSpyUrls($v = true): void
    {
        $this->collSpyUrlsPartial = $v;
    }

    /**
     * Initializes the collSpyUrls collection.
     *
     * By default this just sets the collSpyUrls collection to an empty array (like clearcollSpyUrls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSpyUrls(bool $overrideExisting = true): void
    {
        if (null !== $this->collSpyUrls && !$overrideExisting) {
            return;
        }

        $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyUrls = new $collectionClassName;
        $this->collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');
    }

    /**
     * Gets an array of SpyUrl objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl> List of SpyUrl objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getSpyUrls(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyUrls) {
                    $this->initSpyUrls();
                } else {
                    $collectionClassName = SpyUrlTableMap::getTableMap()->getCollectionClassName();

                    $collSpyUrls = new $collectionClassName;
                    $collSpyUrls->setModel('\Orm\Zed\Url\Persistence\SpyUrl');

                    return $collSpyUrls;
                }
            } else {
                $collSpyUrls = SpyUrlQuery::create(null, $criteria)
                    ->filterBySpyProduct($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSpyUrlsPartial && count($collSpyUrls)) {
                        $this->initSpyUrls(false);

                        foreach ($collSpyUrls as $obj) {
                            if (false == $this->collSpyUrls->contains($obj)) {
                                $this->collSpyUrls->append($obj);
                            }
                        }

                        $this->collSpyUrlsPartial = true;
                    }

                    return $collSpyUrls;
                }

                if ($partial && $this->collSpyUrls) {
                    foreach ($this->collSpyUrls as $obj) {
                        if ($obj->isNew()) {
                            $collSpyUrls[] = $obj;
                        }
                    }
                }

                $this->collSpyUrls = $collSpyUrls;
                $this->collSpyUrlsPartial = false;
            }
        }

        return $this->collSpyUrls;
    }

    /**
     * Sets a collection of SpyUrl objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyUrls A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyUrls(Collection $spyUrls, ?ConnectionInterface $con = null)
    {
        /** @var SpyUrl[] $spyUrlsToDelete */
        $spyUrlsToDelete = $this->getSpyUrls(new Criteria(), $con)->diff($spyUrls);


        $this->spyUrlsScheduledForDeletion = $spyUrlsToDelete;

        foreach ($spyUrlsToDelete as $spyUrlRemoved) {
            $spyUrlRemoved->setSpyProduct(null);
        }

        $this->collSpyUrls = null;
        foreach ($spyUrls as $spyUrl) {
            $this->addSpyUrl($spyUrl);
        }

        $this->collSpyUrls = $spyUrls;
        $this->collSpyUrlsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BaseSpyUrl objects.
     *
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related BaseSpyUrl objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countSpyUrls(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyUrlsPartial && !$this->isNew();
        if (null === $this->collSpyUrls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyUrls) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSpyUrls());
            }

            $query = SpyUrlQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySpyProduct($this)
                ->count($con);
        }

        return count($this->collSpyUrls);
    }

    /**
     * Method called to associate a SpyUrl object to this object
     * through the SpyUrl foreign key attribute.
     *
     * @param SpyUrl $l SpyUrl
     * @return $this The current object (for fluent API support)
     */
    public function addSpyUrl(SpyUrl $l)
    {
        if ($this->collSpyUrls === null) {
            $this->initSpyUrls();
            $this->collSpyUrlsPartial = true;
        }

        if (!$this->collSpyUrls->contains($l)) {
            $this->doAddSpyUrl($l);

            if ($this->spyUrlsScheduledForDeletion and $this->spyUrlsScheduledForDeletion->contains($l)) {
                $this->spyUrlsScheduledForDeletion->remove($this->spyUrlsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to add.
     */
    protected function doAddSpyUrl(SpyUrl $spyUrl): void
    {
        $this->collSpyUrls[]= $spyUrl;
        $spyUrl->setSpyProduct($this);
    }

    /**
     * @param SpyUrl $spyUrl The SpyUrl object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeSpyUrl(SpyUrl $spyUrl)
    {
        if ($this->getSpyUrls()->contains($spyUrl)) {
            $pos = $this->collSpyUrls->search($spyUrl);
            $this->collSpyUrls->remove($pos);
            if (null === $this->spyUrlsScheduledForDeletion) {
                $this->spyUrlsScheduledForDeletion = clone $this->collSpyUrls;
                $this->spyUrlsScheduledForDeletion->clear();
            }
            $this->spyUrlsScheduledForDeletion[]= $spyUrl;
            $spyUrl->setSpyProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyCategoryNode(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyCategoryNode', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinCmsPage(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('CmsPage', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyMerchant(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyMerchant', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyProductSet(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyProductSet', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyLocale(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyLocale', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this SpyProductAbstract is new, it will return
     * an empty collection; or if this SpyProductAbstract has previously
     * been saved, it will retrieve related SpyUrls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in SpyProductAbstract.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @param string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|SpyUrl[] List of SpyUrl objects
     * @phpstan-return ObjectCollection&\Traversable<SpyUrl}> List of SpyUrl objects
     */
    public function getSpyUrlsJoinSpyUrlRedirect(?Criteria $criteria = null, ?ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = SpyUrlQuery::create(null, $criteria);
        $query->joinWith('SpyUrlRedirect', $joinBehavior);

        return $this->getSpyUrls($query, $con);
    }

    /**
     * Clears out the collSpyProductOptionGroups collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSpyProductOptionGroups()
     */
    public function clearSpyProductOptionGroups()
    {
        $this->collSpyProductOptionGroups = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the collSpyProductOptionGroups crossRef collection.
     *
     * By default this just sets the collSpyProductOptionGroups collection to an empty collection (like clearSpyProductOptionGroups());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initSpyProductOptionGroups()
    {
        $collectionClassName = SpyProductAbstractProductOptionGroupTableMap::getTableMap()->getCollectionClassName();

        $this->collSpyProductOptionGroups = new $collectionClassName;
        $this->collSpyProductOptionGroupsPartial = true;
        $this->collSpyProductOptionGroups->setModel('\Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup');
    }

    /**
     * Checks if the collSpyProductOptionGroups collection is loaded.
     *
     * @return bool
     */
    public function isSpyProductOptionGroupsLoaded(): bool
    {
        return null !== $this->collSpyProductOptionGroups;
    }

    /**
     * Gets a collection of SpyProductOptionGroup objects related by a many-to-many relationship
     * to the current object by way of the spy_product_abstract_product_option_group cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSpyProductAbstract is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param ConnectionInterface $con Optional connection object
     *
     * @return ObjectCollection|SpyProductOptionGroup[] List of SpyProductOptionGroup objects
     * @phpstan-return ObjectCollection&\Traversable<SpyProductOptionGroup> List of SpyProductOptionGroup objects
     */
    public function getSpyProductOptionGroups(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collSpyProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collSpyProductOptionGroups) {
                    $this->initSpyProductOptionGroups();
                }
            } else {

                $query = SpyProductOptionGroupQuery::create(null, $criteria)
                    ->filterBySpyProductAbstract($this);
                $collSpyProductOptionGroups = $query->find($con);
                if (null !== $criteria) {
                    return $collSpyProductOptionGroups;
                }

                if ($partial && $this->collSpyProductOptionGroups) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->collSpyProductOptionGroups as $obj) {
                        if (!$collSpyProductOptionGroups->contains($obj)) {
                            $collSpyProductOptionGroups[] = $obj;
                        }
                    }
                }

                $this->collSpyProductOptionGroups = $collSpyProductOptionGroups;
                $this->collSpyProductOptionGroupsPartial = false;
            }
        }

        return $this->collSpyProductOptionGroups;
    }

    /**
     * Sets a collection of SpyProductOptionGroup objects related by a many-to-many relationship
     * to the current object by way of the spy_product_abstract_product_option_group cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $spyProductOptionGroups A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setSpyProductOptionGroups(Collection $spyProductOptionGroups, ?ConnectionInterface $con = null)
    {
        $this->clearSpyProductOptionGroups();
        $currentSpyProductOptionGroups = $this->getSpyProductOptionGroups();

        $spyProductOptionGroupsScheduledForDeletion = $currentSpyProductOptionGroups->diff($spyProductOptionGroups);

        foreach ($spyProductOptionGroupsScheduledForDeletion as $toDelete) {
            $this->removeSpyProductOptionGroup($toDelete);
        }

        foreach ($spyProductOptionGroups as $spyProductOptionGroup) {
            if (!$currentSpyProductOptionGroups->contains($spyProductOptionGroup)) {
                $this->doAddSpyProductOptionGroup($spyProductOptionGroup);
            }
        }

        $this->collSpyProductOptionGroupsPartial = false;
        $this->collSpyProductOptionGroups = $spyProductOptionGroups;

        return $this;
    }

    /**
     * Gets the number of SpyProductOptionGroup objects related by a many-to-many relationship
     * to the current object by way of the spy_product_abstract_product_option_group cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param bool $distinct Set to true to force count distinct
     * @param ConnectionInterface $con Optional connection object
     *
     * @return int The number of related SpyProductOptionGroup objects
     */
    public function countSpyProductOptionGroups(?Criteria $criteria = null, $distinct = false, ?ConnectionInterface $con = null): int
    {
        $partial = $this->collSpyProductOptionGroupsPartial && !$this->isNew();
        if (null === $this->collSpyProductOptionGroups || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSpyProductOptionGroups) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getSpyProductOptionGroups());
                }

                $query = SpyProductOptionGroupQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBySpyProductAbstract($this)
                    ->count($con);
            }
        } else {
            return count($this->collSpyProductOptionGroups);
        }
    }

    /**
     * Associate a SpyProductOptionGroup to this object
     * through the spy_product_abstract_product_option_group cross reference table.
     *
     * @param SpyProductOptionGroup $spyProductOptionGroup
     * @return ChildSpyProductAbstract The current object (for fluent API support)
     */
    public function addSpyProductOptionGroup(SpyProductOptionGroup $spyProductOptionGroup)
    {
        if ($this->collSpyProductOptionGroups === null) {
            $this->initSpyProductOptionGroups();
        }

        if (!$this->getSpyProductOptionGroups()->contains($spyProductOptionGroup)) {
            // only add it if the **same** object is not already associated
            $this->collSpyProductOptionGroups->push($spyProductOptionGroup);
            $this->doAddSpyProductOptionGroup($spyProductOptionGroup);
        }

        return $this;
    }

    /**
     *
     * @param SpyProductOptionGroup $spyProductOptionGroup
     */
    protected function doAddSpyProductOptionGroup(SpyProductOptionGroup $spyProductOptionGroup)
    {
        $spyProductAbstractProductOptionGroup = new SpyProductAbstractProductOptionGroup();

        $spyProductAbstractProductOptionGroup->setSpyProductOptionGroup($spyProductOptionGroup);

        $spyProductAbstractProductOptionGroup->setSpyProductAbstract($this);

        $this->addSpyProductAbstractProductOptionGroup($spyProductAbstractProductOptionGroup);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if (!$spyProductOptionGroup->isSpyProductAbstractsLoaded()) {
            $spyProductOptionGroup->initSpyProductAbstracts();
            $spyProductOptionGroup->getSpyProductAbstracts()->push($this);
        } elseif (!$spyProductOptionGroup->getSpyProductAbstracts()->contains($this)) {
            $spyProductOptionGroup->getSpyProductAbstracts()->push($this);
        }

    }

    /**
     * Remove spyProductOptionGroup of this object
     * through the spy_product_abstract_product_option_group cross reference table.
     *
     * @param SpyProductOptionGroup $spyProductOptionGroup
     * @return ChildSpyProductAbstract The current object (for fluent API support)
     */
    public function removeSpyProductOptionGroup(SpyProductOptionGroup $spyProductOptionGroup)
    {
        if ($this->getSpyProductOptionGroups()->contains($spyProductOptionGroup)) {
            $spyProductAbstractProductOptionGroup = new SpyProductAbstractProductOptionGroup();
            $spyProductAbstractProductOptionGroup->setSpyProductOptionGroup($spyProductOptionGroup);
            if ($spyProductOptionGroup->isSpyProductAbstractsLoaded()) {
                //remove the back reference if available
                $spyProductOptionGroup->getSpyProductAbstracts()->removeObject($this);
            }

            $spyProductAbstractProductOptionGroup->setSpyProductAbstract($this);
            $this->removeSpyProductAbstractProductOptionGroup(clone $spyProductAbstractProductOptionGroup);
            $spyProductAbstractProductOptionGroup->clear();

            $this->collSpyProductOptionGroups->remove($this->collSpyProductOptionGroups->search($spyProductOptionGroup));

            if (null === $this->spyProductOptionGroupsScheduledForDeletion) {
                $this->spyProductOptionGroupsScheduledForDeletion = clone $this->collSpyProductOptionGroups;
                $this->spyProductOptionGroupsScheduledForDeletion->clear();
            }

            $this->spyProductOptionGroupsScheduledForDeletion->push($spyProductOptionGroup);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
     */
    public function clear()
    {
        if (null !== $this->aSpyTaxSet) {
            $this->aSpyTaxSet->removeSpyProductAbstract($this);
        }
        $this->id_product_abstract = null;
        $this->fk_tax_set = null;
        $this->approval_status = null;
        $this->attributes = null;
        $this->color_code = null;
        $this->new_from = null;
        $this->new_to = null;
        $this->sku = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collSpyCmsBlockProductConnectors) {
                foreach ($this->collSpyCmsBlockProductConnectors as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyMerchantProductAbstracts) {
                foreach ($this->collSpyMerchantProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPriceProducts) {
                foreach ($this->collPriceProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPriceProductMerchantRelationships) {
                foreach ($this->collPriceProductMerchantRelationships as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPriceProductSchedules) {
                foreach ($this->collPriceProductSchedules as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractLocalizedAttributess) {
                foreach ($this->collSpyProductAbstractLocalizedAttributess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractStores) {
                foreach ($this->collSpyProductAbstractStores as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProducts) {
                foreach ($this->collSpyProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAlternatives) {
                foreach ($this->collSpyProductAlternatives as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductCategories) {
                foreach ($this->collSpyProductCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductCustomerPermissions) {
                foreach ($this->collSpyProductCustomerPermissions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractGroups) {
                foreach ($this->collSpyProductAbstractGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductImageSets) {
                foreach ($this->collSpyProductImageSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductLabelProductAbstracts) {
                foreach ($this->collSpyProductLabelProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductMeasurementBaseUnits) {
                foreach ($this->collSpyProductMeasurementBaseUnits as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractProductOptionGroups) {
                foreach ($this->collSpyProductAbstractProductOptionGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductRelations) {
                foreach ($this->collSpyProductRelations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductRelationProductAbstracts) {
                foreach ($this->collSpyProductRelationProductAbstracts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductReviews) {
                foreach ($this->collSpyProductReviews as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductAbstractSets) {
                foreach ($this->collSpyProductAbstractSets as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyUrls) {
                foreach ($this->collSpyUrls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSpyProductOptionGroups) {
                foreach ($this->collSpyProductOptionGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSpyCmsBlockProductConnectors = null;
        $this->collSpyMerchantProductAbstracts = null;
        $this->collPriceProducts = null;
        $this->collPriceProductMerchantRelationships = null;
        $this->collPriceProductSchedules = null;
        $this->collSpyProductAbstractLocalizedAttributess = null;
        $this->collSpyProductAbstractStores = null;
        $this->collSpyProducts = null;
        $this->collSpyProductAlternatives = null;
        $this->collSpyProductCategories = null;
        $this->collSpyProductCustomerPermissions = null;
        $this->collSpyProductAbstractGroups = null;
        $this->collSpyProductImageSets = null;
        $this->collSpyProductLabelProductAbstracts = null;
        $this->collSpyProductMeasurementBaseUnits = null;
        $this->collSpyProductAbstractProductOptionGroups = null;
        $this->collSpyProductRelations = null;
        $this->collSpyProductRelationProductAbstracts = null;
        $this->collSpyProductReviews = null;
        $this->collSpyProductAbstractSets = null;
        $this->collSpyUrls = null;
        $this->collSpyProductOptionGroups = null;
        $this->aSpyTaxSet = null;
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SpyProductAbstractTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[SpyProductAbstractTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    // event behavior

    /**
     * @return void
     */
    protected function prepareSaveEventName()
    {
        if ($this->isNew()) {
            $this->_eventName = 'Entity.spy_product_abstract.create';
        } else {
            $this->_eventName = 'Entity.spy_product_abstract.update';
        }

        $this->_modifiedColumns = $this->getModifiedColumns();
        $this->_isModified = $this->isModified();
    }

    /**
     * @return void
     */
    public function disableEvent()
    {
        $this->_isEventDisabled = true;
    }

    /**
     * @return void
     */
    public function enableEvent()
    {
        $this->_isEventDisabled = false;
    }

    /**
     * @return void
     */
    protected function addSaveEventToMemory()
    {
        if ($this->_isEventDisabled) {
            return;
        }

        if ($this->_eventName !== 'Entity.spy_product_abstract.create') {
            if (!$this->_isModified) {
                return;
            }

            if (!$this->isEventColumnsModified()) {
                return;
            }
        }

        $data = [
            'name' => 'spy_product_abstract',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => $this->_eventName,
            'foreignKeys' => $this->getForeignKeys(),
            'modifiedColumns' => $this->_modifiedColumns,
            'originalValues' => $this->getOriginalValues(),
            'additionalValues' => $this->getAdditionalValues(),
        ];

        $this->saveEventBehaviorEntityChange($data);

        unset($this->_eventName);
        unset($this->_modifiedColumns);
        unset($this->_isModified);
    }

    /**
     * @return void
     */
    protected function addDeleteEventToMemory()
    {
        if ($this->_isEventDisabled) {
            return;
        }

        $data = [
            'name' => 'spy_product_abstract',
            'id' => !is_array($this->getPrimaryKey()) ? $this->getPrimaryKey() : null,
            'event' => 'Entity.spy_product_abstract.delete',
            'foreignKeys' => $this->getForeignKeys(),
            'additionalValues' => $this->getAdditionalValues(),
        ];

        $this->saveEventBehaviorEntityChange($data);
    }

    /**
     * @return array
     */
    protected function getForeignKeys()
    {
        $foreignKeysWithValue = [];
        foreach ($this->_foreignKeys as $key => $value) {
            $foreignKeysWithValue[$key] = $this->getByName($value);
        }

        return $foreignKeysWithValue;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    protected function saveEventBehaviorEntityChange(array $data)
    {
        $encodedData = json_encode($data);
        $dataLength = strlen($encodedData);

        if ($dataLength > 256 * 1024) {
            $warningMessage = sprintf(
                '%s event message data size (%d KB) exceeds the allowable limit of %d KB. Please reduce the event message size or it might disrupt P&S process.',
                ($data['event'] ?? ''),
                $dataLength / 1024,
                256,
            );

            $this->log($warningMessage, \Propel\Runtime\Propel::LOG_WARNING);
        }

        $isInstancePoolingDisabledSuccessfully = \Propel\Runtime\Propel::disableInstancePooling();

        $spyEventBehaviorEntityChange = new \Orm\Zed\EventBehavior\Persistence\SpyEventBehaviorEntityChange();
        $spyEventBehaviorEntityChange->setData($encodedData);
        $spyEventBehaviorEntityChange->setProcessId(\Spryker\Zed\Kernel\RequestIdentifier::getRequestId());
        $spyEventBehaviorEntityChange->save();

        if ($isInstancePoolingDisabledSuccessfully) {
            \Propel\Runtime\Propel::enableInstancePooling();
        }
    }

    /**
     * @return bool
     */
    protected function isEventColumnsModified()
    {
        /* There is a wildcard(*) property for this event */
        return true;
    }

    /**
     * @return array
     */
    protected function getOriginalValueColumnNames(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getOriginalValues(): array
    {
        if ($this->isNew()) {
            return [];
        }

        $originalValues = [];
        foreach ($this->_modifiedColumns as $modifiedColumn) {
            if (!in_array($modifiedColumn, $this->getOriginalValueColumnNames())) {
                continue;
            }

            $before = $this->_initialValues[$modifiedColumn];
            $field = str_replace('spy_product_abstract.', '', $modifiedColumn);
            $after = $this->$field;

            if ($before !== $after) {
                $originalValues[$modifiedColumn] = $before;
            }
        }

        return $originalValues;
    }

    /**
     * @return array
     */
    protected function getAdditionalValueColumnNames(): array
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getAdditionalValues(): array
    {
        $additionalValues = [];
        foreach ($this->getAdditionalValueColumnNames() as $additionalValueColumnName) {
            $field = str_replace('spy_product_abstract.', '', $additionalValueColumnName);
            $additionalValues[$additionalValueColumnName] = $this->$field;
        }

        return $additionalValues;
    }

    /**
     * @param string $xmlValue
     * @param string $column
     *
     * @return array|bool|\DateTime|float|int|object
     */
    protected function getPhpType($xmlValue, $column)
    {
        $columnType = SpyProductAbstractTableMap::getTableMap()->getColumn($column)->getType();
        if (in_array(strtoupper($columnType), ['INTEGER', 'TINYINT', 'SMALLINT'])) {
            $xmlValue = (int) $xmlValue;
        } else if (in_array(strtoupper($columnType), ['REAL', 'FLOAT', 'DOUBLE', 'BINARY', 'VARBINARY', 'LONGVARBINARY'])) {
            $xmlValue = (double) $xmlValue;
        } else if (strtoupper($columnType) === 'ARRAY') {
            $xmlValue = (array) $xmlValue;
        } else if (strtoupper($columnType) === 'BOOLEAN') {
            $xmlValue = filter_var($xmlValue,  FILTER_VALIDATE_BOOLEAN);
        } else if (strtoupper($columnType) === 'OBJECT') {
            $xmlValue = (object) $xmlValue;
        } else if (in_array(strtoupper($columnType), ['DATE', 'TIME', 'TIMESTAMP', 'BU_DATE', 'BU_TIMESTAMP'])) {
            $xmlValue = \DateTime::createFromFormat('Y-m-d H:i:s', $xmlValue);
        }

        return $xmlValue;
    }

    // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
    // phpcs:ignoreFile
    /**
     * @return \Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory
     */
    protected function getPersistenceFactory(): \Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory
    {
        return (new \Spryker\Zed\Kernel\ClassResolver\Persistence\PersistenceFactoryResolver())
            ->resolve(\Spryker\Zed\AclEntity\Persistence\AclEntityPersistenceFactory::class);
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
                return true;
    }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
                return true;
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
