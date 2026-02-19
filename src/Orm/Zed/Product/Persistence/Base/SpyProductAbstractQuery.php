<?php

namespace Orm\Zed\Product\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProduct;
use Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategory;
use Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission;
use Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit;
use Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelation;
use Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract;
use Orm\Zed\ProductReview\Persistence\SpyProductReview;
use Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet;
use Orm\Zed\Product\Persistence\SpyProductAbstract as ChildSpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery as ChildSpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductAbstractTableMap;
use Orm\Zed\Tax\Persistence\SpyTaxSet;
use Orm\Zed\Url\Persistence\SpyUrl;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_product_abstract` table.
 *
 * @method     ChildSpyProductAbstractQuery orderByIdProductAbstract($order = Criteria::ASC) Order by the id_product_abstract column
 * @method     ChildSpyProductAbstractQuery orderByFkTaxSet($order = Criteria::ASC) Order by the fk_tax_set column
 * @method     ChildSpyProductAbstractQuery orderByApprovalStatus($order = Criteria::ASC) Order by the approval_status column
 * @method     ChildSpyProductAbstractQuery orderByAttributes($order = Criteria::ASC) Order by the attributes column
 * @method     ChildSpyProductAbstractQuery orderByColorCode($order = Criteria::ASC) Order by the color_code column
 * @method     ChildSpyProductAbstractQuery orderByNewFrom($order = Criteria::ASC) Order by the new_from column
 * @method     ChildSpyProductAbstractQuery orderByNewTo($order = Criteria::ASC) Order by the new_to column
 * @method     ChildSpyProductAbstractQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildSpyProductAbstractQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductAbstractQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductAbstractQuery groupByIdProductAbstract() Group by the id_product_abstract column
 * @method     ChildSpyProductAbstractQuery groupByFkTaxSet() Group by the fk_tax_set column
 * @method     ChildSpyProductAbstractQuery groupByApprovalStatus() Group by the approval_status column
 * @method     ChildSpyProductAbstractQuery groupByAttributes() Group by the attributes column
 * @method     ChildSpyProductAbstractQuery groupByColorCode() Group by the color_code column
 * @method     ChildSpyProductAbstractQuery groupByNewFrom() Group by the new_from column
 * @method     ChildSpyProductAbstractQuery groupByNewTo() Group by the new_to column
 * @method     ChildSpyProductAbstractQuery groupBySku() Group by the sku column
 * @method     ChildSpyProductAbstractQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductAbstractQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductAbstractQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductAbstractQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductAbstractQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductAbstractQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductAbstractQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyTaxSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyTaxSet relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyTaxSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyTaxSet relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyTaxSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyTaxSet relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyTaxSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyTaxSet relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyTaxSet() Adds a LEFT JOIN clause and with to the query using the SpyTaxSet relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyTaxSet() Adds a RIGHT JOIN clause and with to the query using the SpyTaxSet relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyTaxSet() Adds a INNER JOIN clause and with to the query using the SpyTaxSet relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyCmsBlockProductConnector($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyCmsBlockProductConnector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyCmsBlockProductConnector($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockProductConnector relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyCmsBlockProductConnector($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockProductConnector relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyCmsBlockProductConnector() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyCmsBlockProductConnector() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockProductConnector relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyCmsBlockProductConnector() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockProductConnector relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyMerchantProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyMerchantProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyMerchantProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyMerchantProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyMerchantProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyMerchantProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyMerchantProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyMerchantProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinPriceProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProduct relation
 * @method     ChildSpyProductAbstractQuery rightJoinPriceProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProduct relation
 * @method     ChildSpyProductAbstractQuery innerJoinPriceProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProduct relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithPriceProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProduct relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithPriceProduct() Adds a LEFT JOIN clause and with to the query using the PriceProduct relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithPriceProduct() Adds a RIGHT JOIN clause and with to the query using the PriceProduct relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithPriceProduct() Adds a INNER JOIN clause and with to the query using the PriceProduct relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinPriceProductMerchantRelationship($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductAbstractQuery rightJoinPriceProductMerchantRelationship($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductAbstractQuery innerJoinPriceProductMerchantRelationship($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProductMerchantRelationship relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithPriceProductMerchantRelationship($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProductMerchantRelationship relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithPriceProductMerchantRelationship() Adds a LEFT JOIN clause and with to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithPriceProductMerchantRelationship() Adds a RIGHT JOIN clause and with to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithPriceProductMerchantRelationship() Adds a INNER JOIN clause and with to the query using the PriceProductMerchantRelationship relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinPriceProductSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductAbstractQuery rightJoinPriceProductSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductAbstractQuery innerJoinPriceProductSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithPriceProductSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithPriceProductSchedule() Adds a LEFT JOIN clause and with to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithPriceProductSchedule() Adds a RIGHT JOIN clause and with to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithPriceProductSchedule() Adds a INNER JOIN clause and with to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductAbstractLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductAbstractLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductAbstractLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductAbstractLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductAbstractLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductAbstractLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductAbstractLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductAbstractStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductAbstractStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductAbstractStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractStore relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductAbstractStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractStore relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductAbstractStore() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductAbstractStore() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractStore relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductAbstractStore() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractStore relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProduct relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProduct relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProduct relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProduct relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProduct() Adds a LEFT JOIN clause and with to the query using the SpyProduct relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProduct() Adds a RIGHT JOIN clause and with to the query using the SpyProduct relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProduct() Adds a INNER JOIN clause and with to the query using the SpyProduct relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductAlternative($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAlternative relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductAlternative($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAlternative relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductAlternative($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAlternative relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductAlternative($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAlternative relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductAlternative() Adds a LEFT JOIN clause and with to the query using the SpyProductAlternative relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductAlternative() Adds a RIGHT JOIN clause and with to the query using the SpyProductAlternative relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductAlternative() Adds a INNER JOIN clause and with to the query using the SpyProductAlternative relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductCategory relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductCategory relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductCategory relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductCategory relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductCategory() Adds a LEFT JOIN clause and with to the query using the SpyProductCategory relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductCategory() Adds a RIGHT JOIN clause and with to the query using the SpyProductCategory relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductCategory() Adds a INNER JOIN clause and with to the query using the SpyProductCategory relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductCustomerPermission($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductCustomerPermission relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductCustomerPermission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductCustomerPermission relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductCustomerPermission($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductCustomerPermission relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductCustomerPermission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductCustomerPermission relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductCustomerPermission() Adds a LEFT JOIN clause and with to the query using the SpyProductCustomerPermission relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductCustomerPermission() Adds a RIGHT JOIN clause and with to the query using the SpyProductCustomerPermission relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductCustomerPermission() Adds a INNER JOIN clause and with to the query using the SpyProductCustomerPermission relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductAbstractGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractGroup relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductAbstractGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractGroup relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductAbstractGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractGroup relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductAbstractGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractGroup relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductAbstractGroup() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractGroup relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductAbstractGroup() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractGroup relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductAbstractGroup() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractGroup relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductImageSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductImageSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductImageSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductImageSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductImageSet() Adds a LEFT JOIN clause and with to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductImageSet() Adds a RIGHT JOIN clause and with to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductImageSet() Adds a INNER JOIN clause and with to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductLabelProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductLabelProductAbstract relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductLabelProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductLabelProductAbstract relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductLabelProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductLabelProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductLabelProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductLabelProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductLabelProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyProductLabelProductAbstract relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductLabelProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyProductLabelProductAbstract relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductLabelProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyProductLabelProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductMeasurementBaseUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductMeasurementBaseUnit relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductMeasurementBaseUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductMeasurementBaseUnit relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductMeasurementBaseUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductMeasurementBaseUnit relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductMeasurementBaseUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductMeasurementBaseUnit relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductMeasurementBaseUnit() Adds a LEFT JOIN clause and with to the query using the SpyProductMeasurementBaseUnit relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductMeasurementBaseUnit() Adds a RIGHT JOIN clause and with to the query using the SpyProductMeasurementBaseUnit relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductMeasurementBaseUnit() Adds a INNER JOIN clause and with to the query using the SpyProductMeasurementBaseUnit relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductAbstractProductOptionGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductAbstractProductOptionGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductAbstractProductOptionGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductAbstractProductOptionGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductAbstractProductOptionGroup() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductAbstractProductOptionGroup() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductAbstractProductOptionGroup() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractProductOptionGroup relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductRelation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductRelation relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductRelation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductRelation relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductRelation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductRelation relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductRelation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductRelation relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductRelation() Adds a LEFT JOIN clause and with to the query using the SpyProductRelation relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductRelation() Adds a RIGHT JOIN clause and with to the query using the SpyProductRelation relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductRelation() Adds a INNER JOIN clause and with to the query using the SpyProductRelation relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductRelationProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductRelationProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductRelationProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductRelationProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductRelationProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductRelationProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductRelationProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductRelationProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyProductRelationProductAbstract relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductRelationProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyProductRelationProductAbstract relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductReview relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductReview relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductReview($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductReview relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductReview($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductReview relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductReview() Adds a LEFT JOIN clause and with to the query using the SpyProductReview relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductReview() Adds a RIGHT JOIN clause and with to the query using the SpyProductReview relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductReview() Adds a INNER JOIN clause and with to the query using the SpyProductReview relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyProductAbstractSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractSet relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyProductAbstractSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractSet relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyProductAbstractSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractSet relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyProductAbstractSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractSet relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyProductAbstractSet() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractSet relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyProductAbstractSet() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractSet relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyProductAbstractSet() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractSet relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinSpyUrl($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyProductAbstractQuery rightJoinSpyUrl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyProductAbstractQuery innerJoinSpyUrl($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUrl relation
 *
 * @method     ChildSpyProductAbstractQuery joinWithSpyUrl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyProductAbstractQuery leftJoinWithSpyUrl() Adds a LEFT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyProductAbstractQuery rightJoinWithSpyUrl() Adds a RIGHT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyProductAbstractQuery innerJoinWithSpyUrl() Adds a INNER JOIN clause and with to the query using the SpyUrl relation
 *
 * @method     \Orm\Zed\Tax\Persistence\SpyTaxSetQuery|\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery|\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery|\Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery|\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery|\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery|\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery|\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery|\Orm\Zed\Product\Persistence\SpyProductQuery|\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery|\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery|\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery|\Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery|\Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery|\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery|\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery|\Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery|\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery|\Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery|\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery|\Orm\Zed\Url\Persistence\SpyUrlQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductAbstract|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductAbstract matching the query
 * @method     ChildSpyProductAbstract findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductAbstract matching the query, or a new ChildSpyProductAbstract object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductAbstract|null findOneByIdProductAbstract(int $id_product_abstract) Return the first ChildSpyProductAbstract filtered by the id_product_abstract column
 * @method     ChildSpyProductAbstract|null findOneByFkTaxSet(int $fk_tax_set) Return the first ChildSpyProductAbstract filtered by the fk_tax_set column
 * @method     ChildSpyProductAbstract|null findOneByApprovalStatus(string $approval_status) Return the first ChildSpyProductAbstract filtered by the approval_status column
 * @method     ChildSpyProductAbstract|null findOneByAttributes(string $attributes) Return the first ChildSpyProductAbstract filtered by the attributes column
 * @method     ChildSpyProductAbstract|null findOneByColorCode(string $color_code) Return the first ChildSpyProductAbstract filtered by the color_code column
 * @method     ChildSpyProductAbstract|null findOneByNewFrom(string $new_from) Return the first ChildSpyProductAbstract filtered by the new_from column
 * @method     ChildSpyProductAbstract|null findOneByNewTo(string $new_to) Return the first ChildSpyProductAbstract filtered by the new_to column
 * @method     ChildSpyProductAbstract|null findOneBySku(string $sku) Return the first ChildSpyProductAbstract filtered by the sku column
 * @method     ChildSpyProductAbstract|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductAbstract filtered by the created_at column
 * @method     ChildSpyProductAbstract|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductAbstract filtered by the updated_at column
 *
 * @method     ChildSpyProductAbstract requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductAbstract by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductAbstract matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductAbstract requireOneByIdProductAbstract(int $id_product_abstract) Return the first ChildSpyProductAbstract filtered by the id_product_abstract column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByFkTaxSet(int $fk_tax_set) Return the first ChildSpyProductAbstract filtered by the fk_tax_set column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByApprovalStatus(string $approval_status) Return the first ChildSpyProductAbstract filtered by the approval_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByAttributes(string $attributes) Return the first ChildSpyProductAbstract filtered by the attributes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByColorCode(string $color_code) Return the first ChildSpyProductAbstract filtered by the color_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByNewFrom(string $new_from) Return the first ChildSpyProductAbstract filtered by the new_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByNewTo(string $new_to) Return the first ChildSpyProductAbstract filtered by the new_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneBySku(string $sku) Return the first ChildSpyProductAbstract filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductAbstract filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductAbstract requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductAbstract filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductAbstract[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductAbstract objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> find(?ConnectionInterface $con = null) Return ChildSpyProductAbstract objects based on current ModelCriteria
 *
 * @method     ChildSpyProductAbstract[]|Collection findByIdProductAbstract(int|array<int> $id_product_abstract) Return ChildSpyProductAbstract objects filtered by the id_product_abstract column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByIdProductAbstract(int|array<int> $id_product_abstract) Return ChildSpyProductAbstract objects filtered by the id_product_abstract column
 * @method     ChildSpyProductAbstract[]|Collection findByFkTaxSet(int|array<int> $fk_tax_set) Return ChildSpyProductAbstract objects filtered by the fk_tax_set column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByFkTaxSet(int|array<int> $fk_tax_set) Return ChildSpyProductAbstract objects filtered by the fk_tax_set column
 * @method     ChildSpyProductAbstract[]|Collection findByApprovalStatus(string|array<string> $approval_status) Return ChildSpyProductAbstract objects filtered by the approval_status column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByApprovalStatus(string|array<string> $approval_status) Return ChildSpyProductAbstract objects filtered by the approval_status column
 * @method     ChildSpyProductAbstract[]|Collection findByAttributes(string|array<string> $attributes) Return ChildSpyProductAbstract objects filtered by the attributes column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByAttributes(string|array<string> $attributes) Return ChildSpyProductAbstract objects filtered by the attributes column
 * @method     ChildSpyProductAbstract[]|Collection findByColorCode(string|array<string> $color_code) Return ChildSpyProductAbstract objects filtered by the color_code column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByColorCode(string|array<string> $color_code) Return ChildSpyProductAbstract objects filtered by the color_code column
 * @method     ChildSpyProductAbstract[]|Collection findByNewFrom(string|array<string> $new_from) Return ChildSpyProductAbstract objects filtered by the new_from column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByNewFrom(string|array<string> $new_from) Return ChildSpyProductAbstract objects filtered by the new_from column
 * @method     ChildSpyProductAbstract[]|Collection findByNewTo(string|array<string> $new_to) Return ChildSpyProductAbstract objects filtered by the new_to column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByNewTo(string|array<string> $new_to) Return ChildSpyProductAbstract objects filtered by the new_to column
 * @method     ChildSpyProductAbstract[]|Collection findBySku(string|array<string> $sku) Return ChildSpyProductAbstract objects filtered by the sku column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findBySku(string|array<string> $sku) Return ChildSpyProductAbstract objects filtered by the sku column
 * @method     ChildSpyProductAbstract[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductAbstract objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductAbstract objects filtered by the created_at column
 * @method     ChildSpyProductAbstract[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductAbstract objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductAbstract> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductAbstract objects filtered by the updated_at column
 *
 * @method     ChildSpyProductAbstract[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductAbstract> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductAbstractQuery extends ModelCriteria
{

    /**
     * @var bool
     */
    protected $isForUpdateEnabled = false;

    /**
     * @deprecated Use {@link \Propel\Runtime\ActiveQuery\Criteria::lockForUpdate()} instead.
     *
     * @param bool $isForUpdateEnabled
     *
     * @return $this The primary criteria object
     */
    public function forUpdate($isForUpdateEnabled)
    {
        $this->isForUpdateEnabled = $isForUpdateEnabled;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function createSelectSql(&$params): string
    {
        $sql = parent::createSelectSql($params);
        if ($this->isForUpdateEnabled) {
            $sql .= ' FOR UPDATE';
        }

        return $sql;
    }

    /**
     * Clear the conditions to allow the reuse of the query object.
     * The ModelCriteria's Model and alias 'all the properties set by construct) will remain.
     *
     * @return $this The primary criteria object
     */
    public function clear()
    {
        parent::clear();

        $this->isSelfSelected = false;
        $this->forUpdate(false);

        return $this;
    }


    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postUpdate(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * @param int $affectedRows
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int|null
     */
    protected function postDelete(int $affectedRows, ConnectionInterface $con): ?int
    {
        $class = get_class($this);
        PropelReplicationCacheFacade::getInstance()->setKey($class);

        return null;
    }

    /**
     * Issue a SELECT query based on the current ModelCriteria
     * and format the list of results with the current formatter
     * By default, returns an array of model objects
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\ObjectCollection|\Propel\Runtime\ActiveRecord\ActiveRecordInterface[]|mixed the list of results, formatted by the current formatter
     */
    public function find(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::find($con);
    }

    /**
     * Issue a SELECT ... LIMIT 1 query based on the current ModelCriteria
     * and format the result with the current formatter
     * By default, returns a model object.
     *
     * Does not work with ->with()s containing one-to-many relations.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return mixed the result, formatted by the current formatter
     */
    public function findOne(?ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::findOne($con);
    }

    /**
     * Issue an existence check on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return bool column existence
     */
    public function exists(?ConnectionInterface $con = null): bool
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }

        return parent::exists($con);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function configureSelectColumns(): void
    {
        if (!$this->select) {
            return;
        }

        if ($this->formatter === null) {
            $this->setFormatter(new TypeAwareSimpleArrayFormatter());
        }

        parent::configureSelectColumns();
     }
        protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Orm\Zed\Product\Persistence\Base\SpyProductAbstractQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductAbstractQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductAbstractQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductAbstractQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductAbstractQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSpyProductAbstract|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SpyProductAbstractTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSpyProductAbstract A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_abstract, fk_tax_set, approval_status, attributes, color_code, new_from, new_to, sku, created_at, updated_at FROM spy_product_abstract WHERE id_product_abstract = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSpyProductAbstract $obj */
            $obj = new ChildSpyProductAbstract();
            $obj->hydrate($row);
            SpyProductAbstractTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildSpyProductAbstract|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return    Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        $class = get_class($this);
        $mustUseWriteContext = PropelReplicationCacheFacade::getInstance()->hasKey($class);

        if ($mustUseWriteContext) {
            $con = Propel::getWriteConnection($this->getDbName());
        } elseif ($con === null) {
            $con = Propel::getReadConnection($this->getDbName());
        }


        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }

        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductAbstract Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductAbstract_Between(array $idProductAbstract)
    {
        return $this->filterByIdProductAbstract($idProductAbstract, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductAbstracts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductAbstract_In(array $idProductAbstracts)
    {
        return $this->filterByIdProductAbstract($idProductAbstracts, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_abstract column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductAbstract(1234); // WHERE id_product_abstract = 1234
     * $query->filterByIdProductAbstract(array(12, 34), Criteria::IN); // WHERE id_product_abstract IN (12, 34)
     * $query->filterByIdProductAbstract(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_abstract > 12
     * </code>
     *
     * @param     mixed $idProductAbstract The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductAbstract($idProductAbstract = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductAbstract)) {
            $useMinMax = false;
            if (isset($idProductAbstract['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $idProductAbstract['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductAbstract['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $idProductAbstract['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductAbstract of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $idProductAbstract, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkTaxSet Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTaxSet_Between(array $fkTaxSet)
    {
        return $this->filterByFkTaxSet($fkTaxSet, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkTaxSets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkTaxSet_In(array $fkTaxSets)
    {
        return $this->filterByFkTaxSet($fkTaxSets, Criteria::IN);
    }

    /**
     * Filter the query on the fk_tax_set column
     *
     * Example usage:
     * <code>
     * $query->filterByFkTaxSet(1234); // WHERE fk_tax_set = 1234
     * $query->filterByFkTaxSet(array(12, 34), Criteria::IN); // WHERE fk_tax_set IN (12, 34)
     * $query->filterByFkTaxSet(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_tax_set > 12
     * </code>
     *
     * @see       filterBySpyTaxSet()
     *
     * @param     mixed $fkTaxSet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkTaxSet($fkTaxSet = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkTaxSet)) {
            $useMinMax = false;
            if (isset($fkTaxSet['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_FK_TAX_SET, $fkTaxSet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkTaxSet['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_FK_TAX_SET, $fkTaxSet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkTaxSet of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_FK_TAX_SET, $fkTaxSet, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $approvalStatuss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovalStatus_In(array $approvalStatuss)
    {
        return $this->filterByApprovalStatus($approvalStatuss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $approvalStatus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovalStatus_Like($approvalStatus)
    {
        return $this->filterByApprovalStatus($approvalStatus, Criteria::LIKE);
    }

    /**
     * Filter the query on the approval_status column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovalStatus('fooValue');   // WHERE approval_status = 'fooValue'
     * $query->filterByApprovalStatus('%fooValue%', Criteria::LIKE); // WHERE approval_status LIKE '%fooValue%'
     * $query->filterByApprovalStatus([1, 'foo'], Criteria::IN); // WHERE approval_status IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $approvalStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByApprovalStatus($approvalStatus = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $approvalStatus = str_replace('*', '%', $approvalStatus);
        }

        if (is_array($approvalStatus) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$approvalStatus of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_APPROVAL_STATUS, $approvalStatus, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $attributess Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttributes_In(array $attributess)
    {
        return $this->filterByAttributes($attributess, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $attributes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttributes_Like($attributes)
    {
        return $this->filterByAttributes($attributes, Criteria::LIKE);
    }

    /**
     * Filter the query on the attributes column
     *
     * Example usage:
     * <code>
     * $query->filterByAttributes('fooValue');   // WHERE attributes = 'fooValue'
     * $query->filterByAttributes('%fooValue%', Criteria::LIKE); // WHERE attributes LIKE '%fooValue%'
     * $query->filterByAttributes([1, 'foo'], Criteria::IN); // WHERE attributes IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $attributes The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAttributes($attributes = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $attributes = str_replace('*', '%', $attributes);
        }

        if (is_array($attributes) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$attributes of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_ATTRIBUTES, $attributes, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $colorCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByColorCode_In(array $colorCodes)
    {
        return $this->filterByColorCode($colorCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $colorCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByColorCode_Like($colorCode)
    {
        return $this->filterByColorCode($colorCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the color_code column
     *
     * Example usage:
     * <code>
     * $query->filterByColorCode('fooValue');   // WHERE color_code = 'fooValue'
     * $query->filterByColorCode('%fooValue%', Criteria::LIKE); // WHERE color_code LIKE '%fooValue%'
     * $query->filterByColorCode([1, 'foo'], Criteria::IN); // WHERE color_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $colorCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByColorCode($colorCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $colorCode = str_replace('*', '%', $colorCode);
        }

        if (is_array($colorCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$colorCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_COLOR_CODE, $colorCode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $newFrom Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewFrom_Between(array $newFrom)
    {
        return $this->filterByNewFrom($newFrom, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $newFroms Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewFrom_In(array $newFroms)
    {
        return $this->filterByNewFrom($newFroms, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $newFrom Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewFrom_Like($newFrom)
    {
        return $this->filterByNewFrom($newFrom, Criteria::LIKE);
    }

    /**
     * Filter the query on the new_from column
     *
     * Example usage:
     * <code>
     * $query->filterByNewFrom('2011-03-14'); // WHERE new_from = '2011-03-14'
     * $query->filterByNewFrom('now'); // WHERE new_from = '2011-03-14'
     * $query->filterByNewFrom(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE new_from > '2011-03-13'
     * </code>
     *
     * @param     mixed $newFrom The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNewFrom($newFrom = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($newFrom)) {
            $useMinMax = false;
            if (isset($newFrom['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_NEW_FROM, $newFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newFrom['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_NEW_FROM, $newFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$newFrom of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_NEW_FROM, $newFrom, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $newTo Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewTo_Between(array $newTo)
    {
        return $this->filterByNewTo($newTo, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $newTos Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewTo_In(array $newTos)
    {
        return $this->filterByNewTo($newTos, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $newTo Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNewTo_Like($newTo)
    {
        return $this->filterByNewTo($newTo, Criteria::LIKE);
    }

    /**
     * Filter the query on the new_to column
     *
     * Example usage:
     * <code>
     * $query->filterByNewTo('2011-03-14'); // WHERE new_to = '2011-03-14'
     * $query->filterByNewTo('now'); // WHERE new_to = '2011-03-14'
     * $query->filterByNewTo(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE new_to > '2011-03-13'
     * </code>
     *
     * @param     mixed $newTo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByNewTo($newTo = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($newTo)) {
            $useMinMax = false;
            if (isset($newTo['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_NEW_TO, $newTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($newTo['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_NEW_TO, $newTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$newTo of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_NEW_TO, $newTo, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $skus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_In(array $skus)
    {
        return $this->filterBySku($skus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $sku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_Like($sku)
    {
        return $this->filterBySku($sku, Criteria::LIKE);
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%', Criteria::LIKE); // WHERE sku LIKE '%fooValue%'
     * $query->filterBySku([1, 'foo'], Criteria::IN); // WHERE sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $sku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySku($sku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $sku = str_replace('*', '%', $sku);
        }

        if (is_array($sku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$sku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_SKU, $sku, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $createdAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Between(array $createdAt)
    {
        return $this->filterByCreatedAt($createdAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $createdAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_In(array $createdAts)
    {
        return $this->filterByCreatedAt($createdAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $createdAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt_Like($createdAt)
    {
        return $this->filterByCreatedAt($createdAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCreatedAt($createdAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $updatedAt Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Between(array $updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $updatedAts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_In(array $updatedAts)
    {
        return $this->filterByUpdatedAt($updatedAts, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $updatedAt Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt_Like($updatedAt)
    {
        return $this->filterByUpdatedAt($updatedAt, Criteria::LIKE);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductAbstractTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductAbstractTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Tax\Persistence\SpyTaxSet object
     *
     * @param \Orm\Zed\Tax\Persistence\SpyTaxSet|ObjectCollection $spyTaxSet The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyTaxSet($spyTaxSet, ?string $comparison = null)
    {
        if ($spyTaxSet instanceof \Orm\Zed\Tax\Persistence\SpyTaxSet) {
            return $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_FK_TAX_SET, $spyTaxSet->getIdTaxSet(), $comparison);
        } elseif ($spyTaxSet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_FK_TAX_SET, $spyTaxSet->toKeyValue('PrimaryKey', 'IdTaxSet'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyTaxSet() only accepts arguments of type \Orm\Zed\Tax\Persistence\SpyTaxSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyTaxSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyTaxSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyTaxSet');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyTaxSet');
        }

        return $this;
    }

    /**
     * Use the SpyTaxSet relation SpyTaxSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyTaxSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyTaxSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyTaxSet', '\Orm\Zed\Tax\Persistence\SpyTaxSetQuery');
    }

    /**
     * Use the SpyTaxSet relation SpyTaxSet object
     *
     * @param callable(\Orm\Zed\Tax\Persistence\SpyTaxSetQuery):\Orm\Zed\Tax\Persistence\SpyTaxSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyTaxSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyTaxSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyTaxSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyTaxSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useExistsQuery('SpyTaxSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyTaxSet table for a NOT EXISTS query.
     *
     * @see useSpyTaxSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyTaxSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useExistsQuery('SpyTaxSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyTaxSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the IN statement
     */
    public function useInSpyTaxSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useInQuery('SpyTaxSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyTaxSet table for a NOT IN query.
     *
     * @see useSpyTaxSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Tax\Persistence\SpyTaxSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyTaxSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Tax\Persistence\SpyTaxSetQuery */
        $q = $this->useInQuery('SpyTaxSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector object
     *
     * @param \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector|ObjectCollection $spyCmsBlockProductConnector the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockProductConnector($spyCmsBlockProductConnector, ?string $comparison = null)
    {
        if ($spyCmsBlockProductConnector instanceof \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyCmsBlockProductConnector->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyCmsBlockProductConnector instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockProductConnectorQuery()
                ->filterByPrimaryKeys($spyCmsBlockProductConnector->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockProductConnector() only accepts arguments of type \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockProductConnector relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockProductConnector(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockProductConnector');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyCmsBlockProductConnector');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockProductConnector relation SpyCmsBlockProductConnector object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockProductConnectorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockProductConnector($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockProductConnector', '\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery');
    }

    /**
     * Use the SpyCmsBlockProductConnector relation SpyCmsBlockProductConnector object
     *
     * @param callable(\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery):\Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockProductConnectorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockProductConnectorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockProductConnectorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockProductConnectorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockProductConnectorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockProductConnectorQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockProductConnector table for a NOT IN query.
     *
     * @see useSpyCmsBlockProductConnectorInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockProductConnectorQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockProductConnector', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract object
     *
     * @param \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract|ObjectCollection $spyMerchantProductAbstract the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantProductAbstract($spyMerchantProductAbstract, ?string $comparison = null)
    {
        if ($spyMerchantProductAbstract instanceof \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyMerchantProductAbstract->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyMerchantProductAbstract instanceof ObjectCollection) {
            $this
                ->useSpyMerchantProductAbstractQuery()
                ->filterByPrimaryKeys($spyMerchantProductAbstract->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantProductAbstract() only accepts arguments of type \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantProductAbstract');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyMerchantProductAbstract');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantProductAbstract relation SpyMerchantProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantProductAbstract', '\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery');
    }

    /**
     * Use the SpyMerchantProductAbstract relation SpyMerchantProductAbstract object
     *
     * @param callable(\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery):\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery */
        $q = $this->useExistsQuery('SpyMerchantProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyMerchantProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery */
        $q = $this->useExistsQuery('SpyMerchantProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery */
        $q = $this->useInQuery('SpyMerchantProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProductAbstract table for a NOT IN query.
     *
     * @see useSpyMerchantProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery */
        $q = $this->useInQuery('SpyMerchantProductAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\PriceProduct\Persistence\SpyPriceProduct object
     *
     * @param \Orm\Zed\PriceProduct\Persistence\SpyPriceProduct|ObjectCollection $spyPriceProduct the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceProduct($spyPriceProduct, ?string $comparison = null)
    {
        if ($spyPriceProduct instanceof \Orm\Zed\PriceProduct\Persistence\SpyPriceProduct) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyPriceProduct->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyPriceProduct instanceof ObjectCollection) {
            $this
                ->usePriceProductQuery()
                ->filterByPrimaryKeys($spyPriceProduct->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPriceProduct() only accepts arguments of type \Orm\Zed\PriceProduct\Persistence\SpyPriceProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PriceProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPriceProduct(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PriceProduct');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PriceProduct');
        }

        return $this;
    }

    /**
     * Use the PriceProduct relation SpyPriceProduct object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery A secondary query class using the current class as primary query
     */
    public function usePriceProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPriceProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PriceProduct', '\Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery');
    }

    /**
     * Use the PriceProduct relation SpyPriceProduct object
     *
     * @param callable(\Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery):\Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPriceProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePriceProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PriceProduct relation to the SpyPriceProduct table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery The inner query object of the EXISTS statement
     */
    public function usePriceProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery */
        $q = $this->useExistsQuery('PriceProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PriceProduct relation to the SpyPriceProduct table for a NOT EXISTS query.
     *
     * @see usePriceProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery The inner query object of the NOT EXISTS statement
     */
    public function usePriceProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery */
        $q = $this->useExistsQuery('PriceProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PriceProduct relation to the SpyPriceProduct table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery The inner query object of the IN statement
     */
    public function useInPriceProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery */
        $q = $this->useInQuery('PriceProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PriceProduct relation to the SpyPriceProduct table for a NOT IN query.
     *
     * @see usePriceProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery The inner query object of the NOT IN statement
     */
    public function useNotInPriceProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery */
        $q = $this->useInQuery('PriceProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship object
     *
     * @param \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship|ObjectCollection $spyPriceProductMerchantRelationship the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceProductMerchantRelationship($spyPriceProductMerchantRelationship, ?string $comparison = null)
    {
        if ($spyPriceProductMerchantRelationship instanceof \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyPriceProductMerchantRelationship->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyPriceProductMerchantRelationship instanceof ObjectCollection) {
            $this
                ->usePriceProductMerchantRelationshipQuery()
                ->filterByPrimaryKeys($spyPriceProductMerchantRelationship->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPriceProductMerchantRelationship() only accepts arguments of type \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PriceProductMerchantRelationship relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPriceProductMerchantRelationship(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PriceProductMerchantRelationship');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PriceProductMerchantRelationship');
        }

        return $this;
    }

    /**
     * Use the PriceProductMerchantRelationship relation SpyPriceProductMerchantRelationship object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery A secondary query class using the current class as primary query
     */
    public function usePriceProductMerchantRelationshipQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPriceProductMerchantRelationship($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PriceProductMerchantRelationship', '\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery');
    }

    /**
     * Use the PriceProductMerchantRelationship relation SpyPriceProductMerchantRelationship object
     *
     * @param callable(\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery):\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPriceProductMerchantRelationshipQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePriceProductMerchantRelationshipQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PriceProductMerchantRelationship relation to the SpyPriceProductMerchantRelationship table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery The inner query object of the EXISTS statement
     */
    public function usePriceProductMerchantRelationshipExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery */
        $q = $this->useExistsQuery('PriceProductMerchantRelationship', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PriceProductMerchantRelationship relation to the SpyPriceProductMerchantRelationship table for a NOT EXISTS query.
     *
     * @see usePriceProductMerchantRelationshipExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery The inner query object of the NOT EXISTS statement
     */
    public function usePriceProductMerchantRelationshipNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery */
        $q = $this->useExistsQuery('PriceProductMerchantRelationship', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PriceProductMerchantRelationship relation to the SpyPriceProductMerchantRelationship table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery The inner query object of the IN statement
     */
    public function useInPriceProductMerchantRelationshipQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery */
        $q = $this->useInQuery('PriceProductMerchantRelationship', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PriceProductMerchantRelationship relation to the SpyPriceProductMerchantRelationship table for a NOT IN query.
     *
     * @see usePriceProductMerchantRelationshipInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery The inner query object of the NOT IN statement
     */
    public function useNotInPriceProductMerchantRelationshipQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery */
        $q = $this->useInQuery('PriceProductMerchantRelationship', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule object
     *
     * @param \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule|ObjectCollection $spyPriceProductSchedule the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriceProductSchedule($spyPriceProductSchedule, ?string $comparison = null)
    {
        if ($spyPriceProductSchedule instanceof \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyPriceProductSchedule->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyPriceProductSchedule instanceof ObjectCollection) {
            $this
                ->usePriceProductScheduleQuery()
                ->filterByPrimaryKeys($spyPriceProductSchedule->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPriceProductSchedule() only accepts arguments of type \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PriceProductSchedule relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPriceProductSchedule(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PriceProductSchedule');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PriceProductSchedule');
        }

        return $this;
    }

    /**
     * Use the PriceProductSchedule relation SpyPriceProductSchedule object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery A secondary query class using the current class as primary query
     */
    public function usePriceProductScheduleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPriceProductSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PriceProductSchedule', '\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery');
    }

    /**
     * Use the PriceProductSchedule relation SpyPriceProductSchedule object
     *
     * @param callable(\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery):\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPriceProductScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePriceProductScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the EXISTS statement
     */
    public function usePriceProductScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useExistsQuery('PriceProductSchedule', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for a NOT EXISTS query.
     *
     * @see usePriceProductScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function usePriceProductScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useExistsQuery('PriceProductSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the IN statement
     */
    public function useInPriceProductScheduleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useInQuery('PriceProductSchedule', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the PriceProductSchedule relation to the SpyPriceProductSchedule table for a NOT IN query.
     *
     * @see usePriceProductScheduleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery The inner query object of the NOT IN statement
     */
    public function useNotInPriceProductScheduleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery */
        $q = $this->useInQuery('PriceProductSchedule', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes|ObjectCollection $spyProductAbstractLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractLocalizedAttributes($spyProductAbstractLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyProductAbstractLocalizedAttributes instanceof \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAbstractLocalizedAttributes->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductAbstractLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyProductAbstractLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractLocalizedAttributes() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractLocalizedAttributes');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductAbstractLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractLocalizedAttributes relation SpyProductAbstractLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractLocalizedAttributes', '\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery');
    }

    /**
     * Use the SpyProductAbstractLocalizedAttributes relation SpyProductAbstractLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyProductAbstractLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyProductAbstractLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyProductAbstractLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyProductAbstractLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyProductAbstractLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductAbstractStore object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstractStore|ObjectCollection $spyProductAbstractStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractStore($spyProductAbstractStore, ?string $comparison = null)
    {
        if ($spyProductAbstractStore instanceof \Orm\Zed\Product\Persistence\SpyProductAbstractStore) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAbstractStore->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductAbstractStore instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractStoreQuery()
                ->filterByPrimaryKeys($spyProductAbstractStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractStore() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstractStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractStore');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductAbstractStore');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractStore relation SpyProductAbstractStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractStore', '\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery');
    }

    /**
     * Use the SpyProductAbstractStore relation SpyProductAbstractStore object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useExistsQuery('SpyProductAbstractStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useExistsQuery('SpyProductAbstractStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useInQuery('SpyProductAbstractStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractStore table for a NOT IN query.
     *
     * @see useSpyProductAbstractStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery */
        $q = $this->useInQuery('SpyProductAbstractStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProduct object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProduct|ObjectCollection $spyProduct the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProduct($spyProduct, ?string $comparison = null)
    {
        if ($spyProduct instanceof \Orm\Zed\Product\Persistence\SpyProduct) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProduct->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProduct instanceof ObjectCollection) {
            $this
                ->useSpyProductQuery()
                ->filterByPrimaryKeys($spyProduct->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProduct() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProduct');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProduct');
        }

        return $this;
    }

    /**
     * Use the SpyProduct relation SpyProduct object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProduct', '\Orm\Zed\Product\Persistence\SpyProductQuery');
    }

    /**
     * Use the SpyProduct relation SpyProduct object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductQuery):\Orm\Zed\Product\Persistence\SpyProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProduct table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useExistsQuery('SpyProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProduct table for a NOT EXISTS query.
     *
     * @see useSpyProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useExistsQuery('SpyProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProduct table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the IN statement
     */
    public function useInSpyProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useInQuery('SpyProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProduct table for a NOT IN query.
     *
     * @see useSpyProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductQuery */
        $q = $this->useInQuery('SpyProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative object
     *
     * @param \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative|ObjectCollection $spyProductAlternative the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAlternative($spyProductAlternative, ?string $comparison = null)
    {
        if ($spyProductAlternative instanceof \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAlternative->getFkProductAbstractAlternative(), $comparison);

            return $this;
        } elseif ($spyProductAlternative instanceof ObjectCollection) {
            $this
                ->useSpyProductAlternativeQuery()
                ->filterByPrimaryKeys($spyProductAlternative->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAlternative() only accepts arguments of type \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAlternative relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAlternative(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAlternative');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductAlternative');
        }

        return $this;
    }

    /**
     * Use the SpyProductAlternative relation SpyProductAlternative object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAlternativeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductAlternative($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAlternative', '\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery');
    }

    /**
     * Use the SpyProductAlternative relation SpyProductAlternative object
     *
     * @param callable(\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery):\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAlternativeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAlternativeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAlternative table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAlternativeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useExistsQuery('SpyProductAlternative', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAlternative table for a NOT EXISTS query.
     *
     * @see useSpyProductAlternativeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAlternativeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useExistsQuery('SpyProductAlternative', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAlternative table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the IN statement
     */
    public function useInSpyProductAlternativeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useInQuery('SpyProductAlternative', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAlternative table for a NOT IN query.
     *
     * @see useSpyProductAlternativeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAlternativeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useInQuery('SpyProductAlternative', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductCategory\Persistence\SpyProductCategory object
     *
     * @param \Orm\Zed\ProductCategory\Persistence\SpyProductCategory|ObjectCollection $spyProductCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductCategory($spyProductCategory, ?string $comparison = null)
    {
        if ($spyProductCategory instanceof \Orm\Zed\ProductCategory\Persistence\SpyProductCategory) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductCategory->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductCategory instanceof ObjectCollection) {
            $this
                ->useSpyProductCategoryQuery()
                ->filterByPrimaryKeys($spyProductCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductCategory() only accepts arguments of type \Orm\Zed\ProductCategory\Persistence\SpyProductCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductCategory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductCategory');
        }

        return $this;
    }

    /**
     * Use the SpyProductCategory relation SpyProductCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductCategory', '\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery');
    }

    /**
     * Use the SpyProductCategory relation SpyProductCategory object
     *
     * @param callable(\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery):\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useExistsQuery('SpyProductCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductCategory table for a NOT EXISTS query.
     *
     * @see useSpyProductCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useExistsQuery('SpyProductCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the IN statement
     */
    public function useInSpyProductCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useInQuery('SpyProductCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductCategory table for a NOT IN query.
     *
     * @see useSpyProductCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useInQuery('SpyProductCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission object
     *
     * @param \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission|ObjectCollection $spyProductCustomerPermission the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductCustomerPermission($spyProductCustomerPermission, ?string $comparison = null)
    {
        if ($spyProductCustomerPermission instanceof \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductCustomerPermission->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductCustomerPermission instanceof ObjectCollection) {
            $this
                ->useSpyProductCustomerPermissionQuery()
                ->filterByPrimaryKeys($spyProductCustomerPermission->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductCustomerPermission() only accepts arguments of type \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermission or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductCustomerPermission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductCustomerPermission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductCustomerPermission');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductCustomerPermission');
        }

        return $this;
    }

    /**
     * Use the SpyProductCustomerPermission relation SpyProductCustomerPermission object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductCustomerPermissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductCustomerPermission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductCustomerPermission', '\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery');
    }

    /**
     * Use the SpyProductCustomerPermission relation SpyProductCustomerPermission object
     *
     * @param callable(\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery):\Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductCustomerPermissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductCustomerPermissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductCustomerPermission table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductCustomerPermissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery */
        $q = $this->useExistsQuery('SpyProductCustomerPermission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductCustomerPermission table for a NOT EXISTS query.
     *
     * @see useSpyProductCustomerPermissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductCustomerPermissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery */
        $q = $this->useExistsQuery('SpyProductCustomerPermission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductCustomerPermission table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery The inner query object of the IN statement
     */
    public function useInSpyProductCustomerPermissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery */
        $q = $this->useInQuery('SpyProductCustomerPermission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductCustomerPermission table for a NOT IN query.
     *
     * @see useSpyProductCustomerPermissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductCustomerPermissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCustomerPermission\Persistence\SpyProductCustomerPermissionQuery */
        $q = $this->useInQuery('SpyProductCustomerPermission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup object
     *
     * @param \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup|ObjectCollection $spyProductAbstractGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractGroup($spyProductAbstractGroup, ?string $comparison = null)
    {
        if ($spyProductAbstractGroup instanceof \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAbstractGroup->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductAbstractGroup instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractGroupQuery()
                ->filterByPrimaryKeys($spyProductAbstractGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractGroup() only accepts arguments of type \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractGroup');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductAbstractGroup');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractGroup relation SpyProductAbstractGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractGroup', '\Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery');
    }

    /**
     * Use the SpyProductAbstractGroup relation SpyProductAbstractGroup object
     *
     * @param callable(\Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery):\Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery */
        $q = $this->useExistsQuery('SpyProductAbstractGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractGroup table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery */
        $q = $this->useExistsQuery('SpyProductAbstractGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery */
        $q = $this->useInQuery('SpyProductAbstractGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractGroup table for a NOT IN query.
     *
     * @see useSpyProductAbstractGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductGroup\Persistence\SpyProductAbstractGroupQuery */
        $q = $this->useInQuery('SpyProductAbstractGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductImage\Persistence\SpyProductImageSet object
     *
     * @param \Orm\Zed\ProductImage\Persistence\SpyProductImageSet|ObjectCollection $spyProductImageSet the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductImageSet($spyProductImageSet, ?string $comparison = null)
    {
        if ($spyProductImageSet instanceof \Orm\Zed\ProductImage\Persistence\SpyProductImageSet) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductImageSet->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductImageSet instanceof ObjectCollection) {
            $this
                ->useSpyProductImageSetQuery()
                ->filterByPrimaryKeys($spyProductImageSet->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductImageSet() only accepts arguments of type \Orm\Zed\ProductImage\Persistence\SpyProductImageSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductImageSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductImageSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductImageSet');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductImageSet');
        }

        return $this;
    }

    /**
     * Use the SpyProductImageSet relation SpyProductImageSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductImageSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductImageSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductImageSet', '\Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery');
    }

    /**
     * Use the SpyProductImageSet relation SpyProductImageSet object
     *
     * @param callable(\Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery):\Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductImageSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductImageSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductImageSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductImageSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery */
        $q = $this->useExistsQuery('SpyProductImageSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductImageSet table for a NOT EXISTS query.
     *
     * @see useSpyProductImageSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductImageSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery */
        $q = $this->useExistsQuery('SpyProductImageSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductImageSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery The inner query object of the IN statement
     */
    public function useInSpyProductImageSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery */
        $q = $this->useInQuery('SpyProductImageSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductImageSet table for a NOT IN query.
     *
     * @see useSpyProductImageSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductImageSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery */
        $q = $this->useInQuery('SpyProductImageSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract object
     *
     * @param \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract|ObjectCollection $spyProductLabelProductAbstract the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductLabelProductAbstract($spyProductLabelProductAbstract, ?string $comparison = null)
    {
        if ($spyProductLabelProductAbstract instanceof \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductLabelProductAbstract->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductLabelProductAbstract instanceof ObjectCollection) {
            $this
                ->useSpyProductLabelProductAbstractQuery()
                ->filterByPrimaryKeys($spyProductLabelProductAbstract->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductLabelProductAbstract() only accepts arguments of type \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductLabelProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductLabelProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductLabelProductAbstract');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductLabelProductAbstract');
        }

        return $this;
    }

    /**
     * Use the SpyProductLabelProductAbstract relation SpyProductLabelProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductLabelProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductLabelProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductLabelProductAbstract', '\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery');
    }

    /**
     * Use the SpyProductLabelProductAbstract relation SpyProductLabelProductAbstract object
     *
     * @param callable(\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery):\Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductLabelProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductLabelProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductLabelProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductLabelProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductLabelProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductLabelProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyProductLabelProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductLabelProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductLabelProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductLabelProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyProductLabelProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery */
        $q = $this->useInQuery('SpyProductLabelProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductLabelProductAbstract table for a NOT IN query.
     *
     * @see useSpyProductLabelProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductLabelProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelProductAbstractQuery */
        $q = $this->useInQuery('SpyProductLabelProductAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit|ObjectCollection $spyProductMeasurementBaseUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductMeasurementBaseUnit($spyProductMeasurementBaseUnit, ?string $comparison = null)
    {
        if ($spyProductMeasurementBaseUnit instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductMeasurementBaseUnit->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductMeasurementBaseUnit instanceof ObjectCollection) {
            $this
                ->useSpyProductMeasurementBaseUnitQuery()
                ->filterByPrimaryKeys($spyProductMeasurementBaseUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductMeasurementBaseUnit() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductMeasurementBaseUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductMeasurementBaseUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductMeasurementBaseUnit');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductMeasurementBaseUnit');
        }

        return $this;
    }

    /**
     * Use the SpyProductMeasurementBaseUnit relation SpyProductMeasurementBaseUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductMeasurementBaseUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductMeasurementBaseUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductMeasurementBaseUnit', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery');
    }

    /**
     * Use the SpyProductMeasurementBaseUnit relation SpyProductMeasurementBaseUnit object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductMeasurementBaseUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductMeasurementBaseUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductMeasurementBaseUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductMeasurementBaseUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementBaseUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementBaseUnit table for a NOT EXISTS query.
     *
     * @see useSpyProductMeasurementBaseUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductMeasurementBaseUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementBaseUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementBaseUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the IN statement
     */
    public function useInSpyProductMeasurementBaseUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useInQuery('SpyProductMeasurementBaseUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementBaseUnit table for a NOT IN query.
     *
     * @see useSpyProductMeasurementBaseUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductMeasurementBaseUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementBaseUnitQuery */
        $q = $this->useInQuery('SpyProductMeasurementBaseUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup object
     *
     * @param \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup|ObjectCollection $spyProductAbstractProductOptionGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractProductOptionGroup($spyProductAbstractProductOptionGroup, ?string $comparison = null)
    {
        if ($spyProductAbstractProductOptionGroup instanceof \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAbstractProductOptionGroup->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductAbstractProductOptionGroup instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractProductOptionGroupQuery()
                ->filterByPrimaryKeys($spyProductAbstractProductOptionGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractProductOptionGroup() only accepts arguments of type \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractProductOptionGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractProductOptionGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractProductOptionGroup');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductAbstractProductOptionGroup');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractProductOptionGroup relation SpyProductAbstractProductOptionGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractProductOptionGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractProductOptionGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractProductOptionGroup', '\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery');
    }

    /**
     * Use the SpyProductAbstractProductOptionGroup relation SpyProductAbstractProductOptionGroup object
     *
     * @param callable(\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery):\Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractProductOptionGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractProductOptionGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractProductOptionGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractProductOptionGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractProductOptionGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useExistsQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractProductOptionGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useInQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractProductOptionGroup table for a NOT IN query.
     *
     * @see useSpyProductAbstractProductOptionGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractProductOptionGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOption\Persistence\SpyProductAbstractProductOptionGroupQuery */
        $q = $this->useInQuery('SpyProductAbstractProductOptionGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductRelation\Persistence\SpyProductRelation object
     *
     * @param \Orm\Zed\ProductRelation\Persistence\SpyProductRelation|ObjectCollection $spyProductRelation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductRelation($spyProductRelation, ?string $comparison = null)
    {
        if ($spyProductRelation instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelation) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductRelation->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductRelation instanceof ObjectCollection) {
            $this
                ->useSpyProductRelationQuery()
                ->filterByPrimaryKeys($spyProductRelation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductRelation() only accepts arguments of type \Orm\Zed\ProductRelation\Persistence\SpyProductRelation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductRelation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductRelation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductRelation');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductRelation');
        }

        return $this;
    }

    /**
     * Use the SpyProductRelation relation SpyProductRelation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductRelationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductRelation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductRelation', '\Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery');
    }

    /**
     * Use the SpyProductRelation relation SpyProductRelation object
     *
     * @param callable(\Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery):\Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductRelationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductRelationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductRelation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductRelationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery */
        $q = $this->useExistsQuery('SpyProductRelation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelation table for a NOT EXISTS query.
     *
     * @see useSpyProductRelationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductRelationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery */
        $q = $this->useExistsQuery('SpyProductRelation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductRelation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery The inner query object of the IN statement
     */
    public function useInSpyProductRelationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery */
        $q = $this->useInQuery('SpyProductRelation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelation table for a NOT IN query.
     *
     * @see useSpyProductRelationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductRelationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationQuery */
        $q = $this->useInQuery('SpyProductRelation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract object
     *
     * @param \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract|ObjectCollection $spyProductRelationProductAbstract the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductRelationProductAbstract($spyProductRelationProductAbstract, ?string $comparison = null)
    {
        if ($spyProductRelationProductAbstract instanceof \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductRelationProductAbstract->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductRelationProductAbstract instanceof ObjectCollection) {
            $this
                ->useSpyProductRelationProductAbstractQuery()
                ->filterByPrimaryKeys($spyProductRelationProductAbstract->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductRelationProductAbstract() only accepts arguments of type \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductRelationProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductRelationProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductRelationProductAbstract');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductRelationProductAbstract');
        }

        return $this;
    }

    /**
     * Use the SpyProductRelationProductAbstract relation SpyProductRelationProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductRelationProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductRelationProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductRelationProductAbstract', '\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery');
    }

    /**
     * Use the SpyProductRelationProductAbstract relation SpyProductRelationProductAbstract object
     *
     * @param callable(\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery):\Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductRelationProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductRelationProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductRelationProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyProductRelationProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductRelationProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyProductRelationProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useInQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductRelationProductAbstract table for a NOT IN query.
     *
     * @see useSpyProductRelationProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductRelationProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductRelation\Persistence\SpyProductRelationProductAbstractQuery */
        $q = $this->useInQuery('SpyProductRelationProductAbstract', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductReview\Persistence\SpyProductReview object
     *
     * @param \Orm\Zed\ProductReview\Persistence\SpyProductReview|ObjectCollection $spyProductReview the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductReview($spyProductReview, ?string $comparison = null)
    {
        if ($spyProductReview instanceof \Orm\Zed\ProductReview\Persistence\SpyProductReview) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductReview->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductReview instanceof ObjectCollection) {
            $this
                ->useSpyProductReviewQuery()
                ->filterByPrimaryKeys($spyProductReview->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductReview() only accepts arguments of type \Orm\Zed\ProductReview\Persistence\SpyProductReview or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductReview relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductReview(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductReview');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductReview');
        }

        return $this;
    }

    /**
     * Use the SpyProductReview relation SpyProductReview object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductReviewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductReview($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductReview', '\Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery');
    }

    /**
     * Use the SpyProductReview relation SpyProductReview object
     *
     * @param callable(\Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery):\Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductReviewQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductReviewQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductReview table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductReviewExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery */
        $q = $this->useExistsQuery('SpyProductReview', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductReview table for a NOT EXISTS query.
     *
     * @see useSpyProductReviewExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductReviewNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery */
        $q = $this->useExistsQuery('SpyProductReview', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductReview table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery The inner query object of the IN statement
     */
    public function useInSpyProductReviewQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery */
        $q = $this->useInQuery('SpyProductReview', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductReview table for a NOT IN query.
     *
     * @see useSpyProductReviewInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductReviewQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery */
        $q = $this->useInQuery('SpyProductReview', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet object
     *
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet|ObjectCollection $spyProductAbstractSet the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstractSet($spyProductAbstractSet, ?string $comparison = null)
    {
        if ($spyProductAbstractSet instanceof \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAbstractSet->getFkProductAbstract(), $comparison);

            return $this;
        } elseif ($spyProductAbstractSet instanceof ObjectCollection) {
            $this
                ->useSpyProductAbstractSetQuery()
                ->filterByPrimaryKeys($spyProductAbstractSet->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstractSet() only accepts arguments of type \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstractSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstractSet(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstractSet');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyProductAbstractSet');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstractSet relation SpyProductAbstractSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractSetQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstractSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstractSet', '\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery');
    }

    /**
     * Use the SpyProductAbstractSet relation SpyProductAbstractSet object
     *
     * @param callable(\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery):\Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstractSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery */
        $q = $this->useExistsQuery('SpyProductAbstractSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractSet table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery */
        $q = $this->useExistsQuery('SpyProductAbstractSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery */
        $q = $this->useInQuery('SpyProductAbstractSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstractSet table for a NOT IN query.
     *
     * @see useSpyProductAbstractSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductAbstractSetQuery */
        $q = $this->useInQuery('SpyProductAbstractSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Url\Persistence\SpyUrl object
     *
     * @param \Orm\Zed\Url\Persistence\SpyUrl|ObjectCollection $spyUrl the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUrl($spyUrl, ?string $comparison = null)
    {
        if ($spyUrl instanceof \Orm\Zed\Url\Persistence\SpyUrl) {
            $this
                ->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyUrl->getFkResourceProductAbstract(), $comparison);

            return $this;
        } elseif ($spyUrl instanceof ObjectCollection) {
            $this
                ->useSpyUrlQuery()
                ->filterByPrimaryKeys($spyUrl->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyUrl() only accepts arguments of type \Orm\Zed\Url\Persistence\SpyUrl or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyUrl relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyUrl(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyUrl');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SpyUrl');
        }

        return $this;
    }

    /**
     * Use the SpyUrl relation SpyUrl object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery A secondary query class using the current class as primary query
     */
    public function useSpyUrlQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyUrl($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyUrl', '\Orm\Zed\Url\Persistence\SpyUrlQuery');
    }

    /**
     * Use the SpyUrl relation SpyUrl object
     *
     * @param callable(\Orm\Zed\Url\Persistence\SpyUrlQuery):\Orm\Zed\Url\Persistence\SpyUrlQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyUrlQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyUrlQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyUrl table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the EXISTS statement
     */
    public function useSpyUrlExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useExistsQuery('SpyUrl', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyUrl table for a NOT EXISTS query.
     *
     * @see useSpyUrlExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyUrlNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useExistsQuery('SpyUrl', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyUrl table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the IN statement
     */
    public function useInSpyUrlQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useInQuery('SpyUrl', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyUrl table for a NOT IN query.
     *
     * @see useSpyUrlInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyUrlQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlQuery */
        $q = $this->useInQuery('SpyUrl', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProductOptionGroup object
     * using the spy_product_abstract_product_option_group table as cross reference
     *
     * @param SpyProductOptionGroup $spyProductOptionGroup the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOptionGroup($spyProductOptionGroup, string $comparison = null)
    {
        $this
            ->useSpyProductAbstractProductOptionGroupQuery()
            ->filterBySpyProductOptionGroup($spyProductOptionGroup, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductAbstract $spyProductAbstract Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductAbstract = null)
    {
        if ($spyProductAbstract) {
            $this->addUsingAlias(SpyProductAbstractTableMap::COL_ID_PRODUCT_ABSTRACT, $spyProductAbstract->getIdProductAbstract(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every SELECT statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     */
    protected function basePreSelect(ConnectionInterface $con): void
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnSelectQuery($this);
            }
        }


        $this->preSelect($con);
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param ConnectionInterface $con The connection object used by the query
     * @return int|null
     */
    protected function basePreDelete(ConnectionInterface $con): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnDeleteQuery($this);
            }
        }


        return $this->preDelete($con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param array $values The associative array of columns and values for the update
     * @param ConnectionInterface $con The connection object used by the query
     * @param bool $forceIndividualSaves If false (default), the resulting call is a Criteria::doUpdate(), otherwise it is a series of save() calls on all the found objects
     *
     * @return int|null
     */
    protected function basePreUpdate(&$values, ConnectionInterface $con, $forceIndividualSaves = false): ?int
    {
        // \Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior behavior
        // phpcs:ignoreFile
        /**
         * @var string|null $action
         */
        /** @var \Spryker\Zed\AclEntity\Business\AclEntityFacadeInterface $aclEntityFacade */
        $aclEntityFacade = \Spryker\Zed\Kernel\Locator::getInstance()->aclEntity()->facade();
        if ($aclEntityFacade->isActive() && !$this->isSegmentQuery()) {
            $aclEntityMetadataConfigRequestTransfer = new \Generated\Shared\Transfer\AclEntityMetadataConfigRequestTransfer();
            $aclEntityMetadataConfigRequestTransfer->setModelName($this->getModelName());
            $aclEntityConfigTransfer = $aclEntityFacade->getAclEntityMetadataConfig(true, $aclEntityMetadataConfigRequestTransfer);
            if (!in_array($this->getModelName(), $aclEntityConfigTransfer->getAclEntityAllowList())) {
                $this->getPersistenceFactory()
                    ->createAclQueryDirector($aclEntityConfigTransfer)
                    ->applyAclRuleOnUpdateQuery($this);
            }
        }


        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Deletes all rows from the spy_product_abstract table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductAbstractTableMap::clearInstancePool();
            SpyProductAbstractTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductAbstractTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductAbstractTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductAbstractTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(SpyProductAbstractTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductAbstractTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductAbstractTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductAbstractTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(SpyProductAbstractTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductAbstractTableMap::COL_CREATED_AT);

        return $this;
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
    // phpcs:ignoreFile
    /**
     * @return bool
     */
    protected function isSegmentQuery(): bool
    {
        $segmentTableTemplate = sprintf(
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::CONNECTOR_CLASS_TEMPLATE,
            \Spryker\Service\AclEntity\SegmentConnectorGenerator\SegmentConnectorGenerator::ENTITY_PREFIX_DEFAULT,
            ''
        );

        return strpos($this->getModelShortName(), $segmentTableTemplate) === 0;
    }

}
