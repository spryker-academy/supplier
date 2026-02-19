<?php

namespace Orm\Zed\Product\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship;
use Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductSchedule;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProduct;
use Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative;
use Orm\Zed\ProductBundle\Persistence\SpyProductBundle;
use Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration;
use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit;
use Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearch;
use Orm\Zed\ProductValidity\Persistence\SpyProductValidity;
use Orm\Zed\Product\Persistence\SpyProduct as ChildSpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery as ChildSpyProductQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType;
use Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClass;
use Orm\Zed\Stock\Persistence\SpyStockProduct;
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
 * Base class that represents a query for the `spy_product` table.
 *
 * @method     ChildSpyProductQuery orderByIdProduct($order = Criteria::ASC) Order by the id_product column
 * @method     ChildSpyProductQuery orderByFkProductAbstract($order = Criteria::ASC) Order by the fk_product_abstract column
 * @method     ChildSpyProductQuery orderByAttributes($order = Criteria::ASC) Order by the attributes column
 * @method     ChildSpyProductQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyProductQuery orderByIsQuantitySplittable($order = Criteria::ASC) Order by the is_quantity_splittable column
 * @method     ChildSpyProductQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildSpyProductQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductQuery groupByIdProduct() Group by the id_product column
 * @method     ChildSpyProductQuery groupByFkProductAbstract() Group by the fk_product_abstract column
 * @method     ChildSpyProductQuery groupByAttributes() Group by the attributes column
 * @method     ChildSpyProductQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyProductQuery groupByIsQuantitySplittable() Group by the is_quantity_splittable column
 * @method     ChildSpyProductQuery groupBySku() Group by the sku column
 * @method     ChildSpyProductQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductQuery rightJoinSpyProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductQuery innerJoinSpyProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstract relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstract relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstract relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyProductAbstract relation
 *
 * @method     ChildSpyProductQuery leftJoinPriceProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProduct relation
 * @method     ChildSpyProductQuery rightJoinPriceProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProduct relation
 * @method     ChildSpyProductQuery innerJoinPriceProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProduct relation
 *
 * @method     ChildSpyProductQuery joinWithPriceProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithPriceProduct() Adds a LEFT JOIN clause and with to the query using the PriceProduct relation
 * @method     ChildSpyProductQuery rightJoinWithPriceProduct() Adds a RIGHT JOIN clause and with to the query using the PriceProduct relation
 * @method     ChildSpyProductQuery innerJoinWithPriceProduct() Adds a INNER JOIN clause and with to the query using the PriceProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinPriceProductMerchantRelationship($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductQuery rightJoinPriceProductMerchantRelationship($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductQuery innerJoinPriceProductMerchantRelationship($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProductMerchantRelationship relation
 *
 * @method     ChildSpyProductQuery joinWithPriceProductMerchantRelationship($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProductMerchantRelationship relation
 *
 * @method     ChildSpyProductQuery leftJoinWithPriceProductMerchantRelationship() Adds a LEFT JOIN clause and with to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductQuery rightJoinWithPriceProductMerchantRelationship() Adds a RIGHT JOIN clause and with to the query using the PriceProductMerchantRelationship relation
 * @method     ChildSpyProductQuery innerJoinWithPriceProductMerchantRelationship() Adds a INNER JOIN clause and with to the query using the PriceProductMerchantRelationship relation
 *
 * @method     ChildSpyProductQuery leftJoinPriceProductSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductQuery rightJoinPriceProductSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductQuery innerJoinPriceProductSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyProductQuery joinWithPriceProductSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyProductQuery leftJoinWithPriceProductSchedule() Adds a LEFT JOIN clause and with to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductQuery rightJoinWithPriceProductSchedule() Adds a RIGHT JOIN clause and with to the query using the PriceProductSchedule relation
 * @method     ChildSpyProductQuery innerJoinWithPriceProductSchedule() Adds a INNER JOIN clause and with to the query using the PriceProductSchedule relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyProductQuery rightJoinSpyProductLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyProductQuery innerJoinSpyProductLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductLocalizedAttributes relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductLocalizedAttributes relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyProductLocalizedAttributes relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductAlternativeRelatedByFkProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAlternativeRelatedByFkProduct relation
 * @method     ChildSpyProductQuery rightJoinSpyProductAlternativeRelatedByFkProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAlternativeRelatedByFkProduct relation
 * @method     ChildSpyProductQuery innerJoinSpyProductAlternativeRelatedByFkProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAlternativeRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductAlternativeRelatedByFkProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAlternativeRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductAlternativeRelatedByFkProduct() Adds a LEFT JOIN clause and with to the query using the SpyProductAlternativeRelatedByFkProduct relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductAlternativeRelatedByFkProduct() Adds a RIGHT JOIN clause and with to the query using the SpyProductAlternativeRelatedByFkProduct relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductAlternativeRelatedByFkProduct() Adds a INNER JOIN clause and with to the query using the SpyProductAlternativeRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductAlternativeRelatedByFkProductConcreteAlternative($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 * @method     ChildSpyProductQuery rightJoinSpyProductAlternativeRelatedByFkProductConcreteAlternative($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 * @method     ChildSpyProductQuery innerJoinSpyProductAlternativeRelatedByFkProductConcreteAlternative($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductAlternativeRelatedByFkProductConcreteAlternative($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductAlternativeRelatedByFkProductConcreteAlternative() Adds a LEFT JOIN clause and with to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductAlternativeRelatedByFkProductConcreteAlternative() Adds a RIGHT JOIN clause and with to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductAlternativeRelatedByFkProductConcreteAlternative() Adds a INNER JOIN clause and with to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
 *
 * @method     ChildSpyProductQuery leftJoinBundledProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the BundledProduct relation
 * @method     ChildSpyProductQuery rightJoinBundledProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BundledProduct relation
 * @method     ChildSpyProductQuery innerJoinBundledProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the BundledProduct relation
 *
 * @method     ChildSpyProductQuery joinWithBundledProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BundledProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithBundledProduct() Adds a LEFT JOIN clause and with to the query using the BundledProduct relation
 * @method     ChildSpyProductQuery rightJoinWithBundledProduct() Adds a RIGHT JOIN clause and with to the query using the BundledProduct relation
 * @method     ChildSpyProductQuery innerJoinWithBundledProduct() Adds a INNER JOIN clause and with to the query using the BundledProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductBundleRelatedByFkProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductBundleRelatedByFkProduct relation
 * @method     ChildSpyProductQuery rightJoinSpyProductBundleRelatedByFkProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductBundleRelatedByFkProduct relation
 * @method     ChildSpyProductQuery innerJoinSpyProductBundleRelatedByFkProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductBundleRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductBundleRelatedByFkProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductBundleRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductBundleRelatedByFkProduct() Adds a LEFT JOIN clause and with to the query using the SpyProductBundleRelatedByFkProduct relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductBundleRelatedByFkProduct() Adds a RIGHT JOIN clause and with to the query using the SpyProductBundleRelatedByFkProduct relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductBundleRelatedByFkProduct() Adds a INNER JOIN clause and with to the query using the SpyProductBundleRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductConfiguration($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductConfiguration relation
 * @method     ChildSpyProductQuery rightJoinSpyProductConfiguration($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductConfiguration relation
 * @method     ChildSpyProductQuery innerJoinSpyProductConfiguration($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductConfiguration relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductConfiguration($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductConfiguration relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductConfiguration() Adds a LEFT JOIN clause and with to the query using the SpyProductConfiguration relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductConfiguration() Adds a RIGHT JOIN clause and with to the query using the SpyProductConfiguration relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductConfiguration() Adds a INNER JOIN clause and with to the query using the SpyProductConfiguration relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductDiscontinued($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductDiscontinued relation
 * @method     ChildSpyProductQuery rightJoinSpyProductDiscontinued($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductDiscontinued relation
 * @method     ChildSpyProductQuery innerJoinSpyProductDiscontinued($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductDiscontinued relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductDiscontinued($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductDiscontinued relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductDiscontinued() Adds a LEFT JOIN clause and with to the query using the SpyProductDiscontinued relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductDiscontinued() Adds a RIGHT JOIN clause and with to the query using the SpyProductDiscontinued relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductDiscontinued() Adds a INNER JOIN clause and with to the query using the SpyProductDiscontinued relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductImageSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductQuery rightJoinSpyProductImageSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductQuery innerJoinSpyProductImageSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductImageSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductImageSet() Adds a LEFT JOIN clause and with to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductImageSet() Adds a RIGHT JOIN clause and with to the query using the SpyProductImageSet relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductImageSet() Adds a INNER JOIN clause and with to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductListProductConcrete($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductQuery rightJoinSpyProductListProductConcrete($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductQuery innerJoinSpyProductListProductConcrete($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductListProductConcrete relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductListProductConcrete($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductListProductConcrete relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductListProductConcrete() Adds a LEFT JOIN clause and with to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductListProductConcrete() Adds a RIGHT JOIN clause and with to the query using the SpyProductListProductConcrete relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductListProductConcrete() Adds a INNER JOIN clause and with to the query using the SpyProductListProductConcrete relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductMeasurementSalesUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductQuery rightJoinSpyProductMeasurementSalesUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductQuery innerJoinSpyProductMeasurementSalesUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductMeasurementSalesUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductMeasurementSalesUnit relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductMeasurementSalesUnit() Adds a LEFT JOIN clause and with to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductMeasurementSalesUnit() Adds a RIGHT JOIN clause and with to the query using the SpyProductMeasurementSalesUnit relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductMeasurementSalesUnit() Adds a INNER JOIN clause and with to the query using the SpyProductMeasurementSalesUnit relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductPackagingUnitRelatedByFkProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 * @method     ChildSpyProductQuery rightJoinSpyProductPackagingUnitRelatedByFkProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 * @method     ChildSpyProductQuery innerJoinSpyProductPackagingUnitRelatedByFkProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductPackagingUnitRelatedByFkProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductPackagingUnitRelatedByFkProduct() Adds a LEFT JOIN clause and with to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductPackagingUnitRelatedByFkProduct() Adds a RIGHT JOIN clause and with to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductPackagingUnitRelatedByFkProduct() Adds a INNER JOIN clause and with to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductPackagingUnitRelatedByFkLeadProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 * @method     ChildSpyProductQuery rightJoinSpyProductPackagingUnitRelatedByFkLeadProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 * @method     ChildSpyProductQuery innerJoinSpyProductPackagingUnitRelatedByFkLeadProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductPackagingUnitRelatedByFkLeadProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductPackagingUnitRelatedByFkLeadProduct() Adds a LEFT JOIN clause and with to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductPackagingUnitRelatedByFkLeadProduct() Adds a RIGHT JOIN clause and with to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductPackagingUnitRelatedByFkLeadProduct() Adds a INNER JOIN clause and with to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductQuantity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductQuantity relation
 * @method     ChildSpyProductQuery rightJoinSpyProductQuantity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductQuantity relation
 * @method     ChildSpyProductQuery innerJoinSpyProductQuantity($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductQuantity relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductQuantity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductQuantity relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductQuantity() Adds a LEFT JOIN clause and with to the query using the SpyProductQuantity relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductQuantity() Adds a RIGHT JOIN clause and with to the query using the SpyProductQuantity relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductQuantity() Adds a INNER JOIN clause and with to the query using the SpyProductQuantity relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductSearch($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductSearch relation
 * @method     ChildSpyProductQuery rightJoinSpyProductSearch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductSearch relation
 * @method     ChildSpyProductQuery innerJoinSpyProductSearch($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductSearch relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductSearch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductSearch relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductSearch() Adds a LEFT JOIN clause and with to the query using the SpyProductSearch relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductSearch() Adds a RIGHT JOIN clause and with to the query using the SpyProductSearch relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductSearch() Adds a INNER JOIN clause and with to the query using the SpyProductSearch relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductValidity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductValidity relation
 * @method     ChildSpyProductQuery rightJoinSpyProductValidity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductValidity relation
 * @method     ChildSpyProductQuery innerJoinSpyProductValidity($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductValidity relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductValidity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductValidity relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductValidity() Adds a LEFT JOIN clause and with to the query using the SpyProductValidity relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductValidity() Adds a RIGHT JOIN clause and with to the query using the SpyProductValidity relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductValidity() Adds a INNER JOIN clause and with to the query using the SpyProductValidity relation
 *
 * @method     ChildSpyProductQuery leftJoinSpyProductShipmentType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductShipmentType relation
 * @method     ChildSpyProductQuery rightJoinSpyProductShipmentType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductShipmentType relation
 * @method     ChildSpyProductQuery innerJoinSpyProductShipmentType($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductShipmentType relation
 *
 * @method     ChildSpyProductQuery joinWithSpyProductShipmentType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductShipmentType relation
 *
 * @method     ChildSpyProductQuery leftJoinWithSpyProductShipmentType() Adds a LEFT JOIN clause and with to the query using the SpyProductShipmentType relation
 * @method     ChildSpyProductQuery rightJoinWithSpyProductShipmentType() Adds a RIGHT JOIN clause and with to the query using the SpyProductShipmentType relation
 * @method     ChildSpyProductQuery innerJoinWithSpyProductShipmentType() Adds a INNER JOIN clause and with to the query using the SpyProductShipmentType relation
 *
 * @method     ChildSpyProductQuery leftJoinProductToProductClass($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductToProductClass relation
 * @method     ChildSpyProductQuery rightJoinProductToProductClass($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductToProductClass relation
 * @method     ChildSpyProductQuery innerJoinProductToProductClass($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductToProductClass relation
 *
 * @method     ChildSpyProductQuery joinWithProductToProductClass($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductToProductClass relation
 *
 * @method     ChildSpyProductQuery leftJoinWithProductToProductClass() Adds a LEFT JOIN clause and with to the query using the ProductToProductClass relation
 * @method     ChildSpyProductQuery rightJoinWithProductToProductClass() Adds a RIGHT JOIN clause and with to the query using the ProductToProductClass relation
 * @method     ChildSpyProductQuery innerJoinWithProductToProductClass() Adds a INNER JOIN clause and with to the query using the ProductToProductClass relation
 *
 * @method     ChildSpyProductQuery leftJoinStockProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the StockProduct relation
 * @method     ChildSpyProductQuery rightJoinStockProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StockProduct relation
 * @method     ChildSpyProductQuery innerJoinStockProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the StockProduct relation
 *
 * @method     ChildSpyProductQuery joinWithStockProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StockProduct relation
 *
 * @method     ChildSpyProductQuery leftJoinWithStockProduct() Adds a LEFT JOIN clause and with to the query using the StockProduct relation
 * @method     ChildSpyProductQuery rightJoinWithStockProduct() Adds a RIGHT JOIN clause and with to the query using the StockProduct relation
 * @method     ChildSpyProductQuery innerJoinWithStockProduct() Adds a INNER JOIN clause and with to the query using the StockProduct relation
 *
 * @method     \Orm\Zed\Product\Persistence\SpyProductAbstractQuery|\Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery|\Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery|\Orm\Zed\PriceProductSchedule\Persistence\SpyPriceProductScheduleQuery|\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery|\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery|\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery|\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery|\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery|\Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery|\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery|\Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery|\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery|\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery|\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery|\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery|\Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery|\Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery|\Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery|\Orm\Zed\Stock\Persistence\SpyStockProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProduct|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProduct matching the query
 * @method     ChildSpyProduct findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProduct matching the query, or a new ChildSpyProduct object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProduct|null findOneByIdProduct(int $id_product) Return the first ChildSpyProduct filtered by the id_product column
 * @method     ChildSpyProduct|null findOneByFkProductAbstract(int $fk_product_abstract) Return the first ChildSpyProduct filtered by the fk_product_abstract column
 * @method     ChildSpyProduct|null findOneByAttributes(string $attributes) Return the first ChildSpyProduct filtered by the attributes column
 * @method     ChildSpyProduct|null findOneByIsActive(boolean $is_active) Return the first ChildSpyProduct filtered by the is_active column
 * @method     ChildSpyProduct|null findOneByIsQuantitySplittable(boolean $is_quantity_splittable) Return the first ChildSpyProduct filtered by the is_quantity_splittable column
 * @method     ChildSpyProduct|null findOneBySku(string $sku) Return the first ChildSpyProduct filtered by the sku column
 * @method     ChildSpyProduct|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProduct filtered by the created_at column
 * @method     ChildSpyProduct|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProduct filtered by the updated_at column
 *
 * @method     ChildSpyProduct requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProduct requireOneByIdProduct(int $id_product) Return the first ChildSpyProduct filtered by the id_product column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneByFkProductAbstract(int $fk_product_abstract) Return the first ChildSpyProduct filtered by the fk_product_abstract column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneByAttributes(string $attributes) Return the first ChildSpyProduct filtered by the attributes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneByIsActive(boolean $is_active) Return the first ChildSpyProduct filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneByIsQuantitySplittable(boolean $is_quantity_splittable) Return the first ChildSpyProduct filtered by the is_quantity_splittable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneBySku(string $sku) Return the first ChildSpyProduct filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneByCreatedAt(string $created_at) Return the first ChildSpyProduct filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProduct requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProduct filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProduct[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProduct objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProduct> find(?ConnectionInterface $con = null) Return ChildSpyProduct objects based on current ModelCriteria
 *
 * @method     ChildSpyProduct[]|Collection findByIdProduct(int|array<int> $id_product) Return ChildSpyProduct objects filtered by the id_product column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByIdProduct(int|array<int> $id_product) Return ChildSpyProduct objects filtered by the id_product column
 * @method     ChildSpyProduct[]|Collection findByFkProductAbstract(int|array<int> $fk_product_abstract) Return ChildSpyProduct objects filtered by the fk_product_abstract column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByFkProductAbstract(int|array<int> $fk_product_abstract) Return ChildSpyProduct objects filtered by the fk_product_abstract column
 * @method     ChildSpyProduct[]|Collection findByAttributes(string|array<string> $attributes) Return ChildSpyProduct objects filtered by the attributes column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByAttributes(string|array<string> $attributes) Return ChildSpyProduct objects filtered by the attributes column
 * @method     ChildSpyProduct[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyProduct objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyProduct objects filtered by the is_active column
 * @method     ChildSpyProduct[]|Collection findByIsQuantitySplittable(boolean|array<boolean> $is_quantity_splittable) Return ChildSpyProduct objects filtered by the is_quantity_splittable column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByIsQuantitySplittable(boolean|array<boolean> $is_quantity_splittable) Return ChildSpyProduct objects filtered by the is_quantity_splittable column
 * @method     ChildSpyProduct[]|Collection findBySku(string|array<string> $sku) Return ChildSpyProduct objects filtered by the sku column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findBySku(string|array<string> $sku) Return ChildSpyProduct objects filtered by the sku column
 * @method     ChildSpyProduct[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProduct objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProduct objects filtered by the created_at column
 * @method     ChildSpyProduct[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProduct objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProduct> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProduct objects filtered by the updated_at column
 *
 * @method     ChildSpyProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProduct> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Product\Persistence\Base\SpyProductQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductQuery();
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
     * @return ChildSpyProduct|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_product`, `fk_product_abstract`, `attributes`, `is_active`, `is_quantity_splittable`, `sku`, `created_at`, `updated_at` FROM `spy_product` WHERE `id_product` = :p0';
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
            /** @var ChildSpyProduct $obj */
            $obj = new ChildSpyProduct();
            $obj->hydrate($row);
            SpyProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProduct|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProduct Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProduct_Between(array $idProduct)
    {
        return $this->filterByIdProduct($idProduct, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProducts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProduct_In(array $idProducts)
    {
        return $this->filterByIdProduct($idProducts, Criteria::IN);
    }

    /**
     * Filter the query on the id_product column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProduct(1234); // WHERE id_product = 1234
     * $query->filterByIdProduct(array(12, 34), Criteria::IN); // WHERE id_product IN (12, 34)
     * $query->filterByIdProduct(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product > 12
     * </code>
     *
     * @param     mixed $idProduct The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProduct($idProduct = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProduct)) {
            $useMinMax = false;
            if (isset($idProduct['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $idProduct['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProduct['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $idProduct['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProduct of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $idProduct, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkProductAbstract Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductAbstract_Between(array $fkProductAbstract)
    {
        return $this->filterByFkProductAbstract($fkProductAbstract, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkProductAbstracts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkProductAbstract_In(array $fkProductAbstracts)
    {
        return $this->filterByFkProductAbstract($fkProductAbstracts, Criteria::IN);
    }

    /**
     * Filter the query on the fk_product_abstract column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProductAbstract(1234); // WHERE fk_product_abstract = 1234
     * $query->filterByFkProductAbstract(array(12, 34), Criteria::IN); // WHERE fk_product_abstract IN (12, 34)
     * $query->filterByFkProductAbstract(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_product_abstract > 12
     * </code>
     *
     * @see       filterBySpyProductAbstract()
     *
     * @param     mixed $fkProductAbstract The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkProductAbstract($fkProductAbstract = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkProductAbstract)) {
            $useMinMax = false;
            if (isset($fkProductAbstract['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkProductAbstract['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkProductAbstract of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT, $fkProductAbstract, $comparison);

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

        $query = $this->addUsingAlias(SpyProductTableMap::COL_ATTRIBUTES, $attributes, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_active column
     *
     * Example usage:
     * <code>
     * $query->filterByIsActive(true); // WHERE is_active = true
     * $query->filterByIsActive('yes'); // WHERE is_active = true
     * </code>
     *
     * @param     bool|string $isActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIsActive($isActive = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isActive)) {
            $isActive = in_array(strtolower($isActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyProductTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_quantity_splittable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsQuantitySplittable(true); // WHERE is_quantity_splittable = true
     * $query->filterByIsQuantitySplittable('yes'); // WHERE is_quantity_splittable = true
     * </code>
     *
     * @param     bool|string $isQuantitySplittable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIsQuantitySplittable($isQuantitySplittable = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isQuantitySplittable)) {
            $isQuantitySplittable = in_array(strtolower($isQuantitySplittable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyProductTableMap::COL_IS_QUANTITY_SPLITTABLE, $isQuantitySplittable, $comparison);

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

        $query = $this->addUsingAlias(SpyProductTableMap::COL_SKU, $sku, $comparison);

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
                $this->addUsingAlias(SpyProductTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductAbstract object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract|ObjectCollection $spyProductAbstract The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductAbstract($spyProductAbstract, ?string $comparison = null)
    {
        if ($spyProductAbstract instanceof \Orm\Zed\Product\Persistence\SpyProductAbstract) {
            return $this
                ->addUsingAlias(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT, $spyProductAbstract->getIdProductAbstract(), $comparison);
        } elseif ($spyProductAbstract instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT, $spyProductAbstract->toKeyValue('PrimaryKey', 'IdProductAbstract'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAbstract() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAbstract relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAbstract(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAbstract');

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
            $this->addJoinObject($join, 'SpyProductAbstract');
        }

        return $this;
    }

    /**
     * Use the SpyProductAbstract relation SpyProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAbstractQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAbstract($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAbstract', '\Orm\Zed\Product\Persistence\SpyProductAbstractQuery');
    }

    /**
     * Use the SpyProductAbstract relation SpyProductAbstract object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAbstractQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAbstractQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAbstractExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductAbstract', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyProductAbstractExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAbstractNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProductAbstract', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyProductAbstractQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('SpyProductAbstract', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductAbstract table for a NOT IN query.
     *
     * @see useSpyProductAbstractInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAbstractQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('SpyProductAbstract', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyPriceProduct->getFkProduct(), $comparison);

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
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyPriceProductMerchantRelationship->getFkProduct(), $comparison);

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
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyPriceProductSchedule->getFkProduct(), $comparison);

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
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes|ObjectCollection $spyProductLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductLocalizedAttributes($spyProductLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyProductLocalizedAttributes instanceof \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductLocalizedAttributes->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyProductLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyProductLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductLocalizedAttributes() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyProductLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyProductLocalizedAttributes relation SpyProductLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductLocalizedAttributes', '\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery');
    }

    /**
     * Use the SpyProductLocalizedAttributes relation SpyProductLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery):\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyProductLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyProductLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyProductLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyProductLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyProductLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyProductLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyProductLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterBySpyProductAlternativeRelatedByFkProduct($spyProductAlternative, ?string $comparison = null)
    {
        if ($spyProductAlternative instanceof \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductAlternative->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductAlternative instanceof ObjectCollection) {
            $this
                ->useSpyProductAlternativeRelatedByFkProductQuery()
                ->filterByPrimaryKeys($spyProductAlternative->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAlternativeRelatedByFkProduct() only accepts arguments of type \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAlternativeRelatedByFkProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAlternativeRelatedByFkProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAlternativeRelatedByFkProduct');

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
            $this->addJoinObject($join, 'SpyProductAlternativeRelatedByFkProduct');
        }

        return $this;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProduct relation SpyProductAlternative object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAlternativeRelatedByFkProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductAlternativeRelatedByFkProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAlternativeRelatedByFkProduct', '\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery');
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProduct relation SpyProductAlternative object
     *
     * @param callable(\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery):\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAlternativeRelatedByFkProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAlternativeRelatedByFkProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProduct relation to the SpyProductAlternative table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAlternativeRelatedByFkProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useExistsQuery('SpyProductAlternativeRelatedByFkProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProduct relation to the SpyProductAlternative table for a NOT EXISTS query.
     *
     * @see useSpyProductAlternativeRelatedByFkProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAlternativeRelatedByFkProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useExistsQuery('SpyProductAlternativeRelatedByFkProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProduct relation to the SpyProductAlternative table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the IN statement
     */
    public function useInSpyProductAlternativeRelatedByFkProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useInQuery('SpyProductAlternativeRelatedByFkProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProduct relation to the SpyProductAlternative table for a NOT IN query.
     *
     * @see useSpyProductAlternativeRelatedByFkProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAlternativeRelatedByFkProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useInQuery('SpyProductAlternativeRelatedByFkProduct', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterBySpyProductAlternativeRelatedByFkProductConcreteAlternative($spyProductAlternative, ?string $comparison = null)
    {
        if ($spyProductAlternative instanceof \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductAlternative->getFkProductConcreteAlternative(), $comparison);

            return $this;
        } elseif ($spyProductAlternative instanceof ObjectCollection) {
            $this
                ->useSpyProductAlternativeRelatedByFkProductConcreteAlternativeQuery()
                ->filterByPrimaryKeys($spyProductAlternative->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductAlternativeRelatedByFkProductConcreteAlternative() only accepts arguments of type \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternative or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductAlternativeRelatedByFkProductConcreteAlternative(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductAlternativeRelatedByFkProductConcreteAlternative');

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
            $this->addJoinObject($join, 'SpyProductAlternativeRelatedByFkProductConcreteAlternative');
        }

        return $this;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation SpyProductAlternative object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductAlternativeRelatedByFkProductConcreteAlternativeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductAlternativeRelatedByFkProductConcreteAlternative($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductAlternativeRelatedByFkProductConcreteAlternative', '\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery');
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation SpyProductAlternative object
     *
     * @param callable(\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery):\Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductAlternativeRelatedByFkProductConcreteAlternativeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductAlternativeRelatedByFkProductConcreteAlternativeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation to the SpyProductAlternative table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductAlternativeRelatedByFkProductConcreteAlternativeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useExistsQuery('SpyProductAlternativeRelatedByFkProductConcreteAlternative', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation to the SpyProductAlternative table for a NOT EXISTS query.
     *
     * @see useSpyProductAlternativeRelatedByFkProductConcreteAlternativeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductAlternativeRelatedByFkProductConcreteAlternativeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useExistsQuery('SpyProductAlternativeRelatedByFkProductConcreteAlternative', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation to the SpyProductAlternative table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the IN statement
     */
    public function useInSpyProductAlternativeRelatedByFkProductConcreteAlternativeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useInQuery('SpyProductAlternativeRelatedByFkProductConcreteAlternative', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyProductAlternativeRelatedByFkProductConcreteAlternative relation to the SpyProductAlternative table for a NOT IN query.
     *
     * @see useSpyProductAlternativeRelatedByFkProductConcreteAlternativeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductAlternativeRelatedByFkProductConcreteAlternativeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAlternative\Persistence\SpyProductAlternativeQuery */
        $q = $this->useInQuery('SpyProductAlternativeRelatedByFkProductConcreteAlternative', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductBundle\Persistence\SpyProductBundle object
     *
     * @param \Orm\Zed\ProductBundle\Persistence\SpyProductBundle|ObjectCollection $spyProductBundle the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBundledProduct($spyProductBundle, ?string $comparison = null)
    {
        if ($spyProductBundle instanceof \Orm\Zed\ProductBundle\Persistence\SpyProductBundle) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductBundle->getFkBundledProduct(), $comparison);

            return $this;
        } elseif ($spyProductBundle instanceof ObjectCollection) {
            $this
                ->useBundledProductQuery()
                ->filterByPrimaryKeys($spyProductBundle->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByBundledProduct() only accepts arguments of type \Orm\Zed\ProductBundle\Persistence\SpyProductBundle or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BundledProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinBundledProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BundledProduct');

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
            $this->addJoinObject($join, 'BundledProduct');
        }

        return $this;
    }

    /**
     * Use the BundledProduct relation SpyProductBundle object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery A secondary query class using the current class as primary query
     */
    public function useBundledProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBundledProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BundledProduct', '\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery');
    }

    /**
     * Use the BundledProduct relation SpyProductBundle object
     *
     * @param callable(\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery):\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBundledProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBundledProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the BundledProduct relation to the SpyProductBundle table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the EXISTS statement
     */
    public function useBundledProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useExistsQuery('BundledProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the BundledProduct relation to the SpyProductBundle table for a NOT EXISTS query.
     *
     * @see useBundledProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the NOT EXISTS statement
     */
    public function useBundledProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useExistsQuery('BundledProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the BundledProduct relation to the SpyProductBundle table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the IN statement
     */
    public function useInBundledProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useInQuery('BundledProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the BundledProduct relation to the SpyProductBundle table for a NOT IN query.
     *
     * @see useBundledProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the NOT IN statement
     */
    public function useNotInBundledProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useInQuery('BundledProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductBundle\Persistence\SpyProductBundle object
     *
     * @param \Orm\Zed\ProductBundle\Persistence\SpyProductBundle|ObjectCollection $spyProductBundle the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductBundleRelatedByFkProduct($spyProductBundle, ?string $comparison = null)
    {
        if ($spyProductBundle instanceof \Orm\Zed\ProductBundle\Persistence\SpyProductBundle) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductBundle->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductBundle instanceof ObjectCollection) {
            $this
                ->useSpyProductBundleRelatedByFkProductQuery()
                ->filterByPrimaryKeys($spyProductBundle->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductBundleRelatedByFkProduct() only accepts arguments of type \Orm\Zed\ProductBundle\Persistence\SpyProductBundle or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductBundleRelatedByFkProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductBundleRelatedByFkProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductBundleRelatedByFkProduct');

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
            $this->addJoinObject($join, 'SpyProductBundleRelatedByFkProduct');
        }

        return $this;
    }

    /**
     * Use the SpyProductBundleRelatedByFkProduct relation SpyProductBundle object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductBundleRelatedByFkProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductBundleRelatedByFkProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductBundleRelatedByFkProduct', '\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery');
    }

    /**
     * Use the SpyProductBundleRelatedByFkProduct relation SpyProductBundle object
     *
     * @param callable(\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery):\Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductBundleRelatedByFkProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductBundleRelatedByFkProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyProductBundleRelatedByFkProduct relation to the SpyProductBundle table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductBundleRelatedByFkProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useExistsQuery('SpyProductBundleRelatedByFkProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyProductBundleRelatedByFkProduct relation to the SpyProductBundle table for a NOT EXISTS query.
     *
     * @see useSpyProductBundleRelatedByFkProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductBundleRelatedByFkProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useExistsQuery('SpyProductBundleRelatedByFkProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyProductBundleRelatedByFkProduct relation to the SpyProductBundle table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the IN statement
     */
    public function useInSpyProductBundleRelatedByFkProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useInQuery('SpyProductBundleRelatedByFkProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyProductBundleRelatedByFkProduct relation to the SpyProductBundle table for a NOT IN query.
     *
     * @see useSpyProductBundleRelatedByFkProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductBundleRelatedByFkProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductBundle\Persistence\SpyProductBundleQuery */
        $q = $this->useInQuery('SpyProductBundleRelatedByFkProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration object
     *
     * @param \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration|ObjectCollection $spyProductConfiguration the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductConfiguration($spyProductConfiguration, ?string $comparison = null)
    {
        if ($spyProductConfiguration instanceof \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductConfiguration->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductConfiguration instanceof ObjectCollection) {
            $this
                ->useSpyProductConfigurationQuery()
                ->filterByPrimaryKeys($spyProductConfiguration->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductConfiguration() only accepts arguments of type \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfiguration or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductConfiguration relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductConfiguration(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductConfiguration');

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
            $this->addJoinObject($join, 'SpyProductConfiguration');
        }

        return $this;
    }

    /**
     * Use the SpyProductConfiguration relation SpyProductConfiguration object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductConfigurationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductConfiguration($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductConfiguration', '\Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery');
    }

    /**
     * Use the SpyProductConfiguration relation SpyProductConfiguration object
     *
     * @param callable(\Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery):\Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductConfigurationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductConfigurationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductConfiguration table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductConfigurationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery */
        $q = $this->useExistsQuery('SpyProductConfiguration', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductConfiguration table for a NOT EXISTS query.
     *
     * @see useSpyProductConfigurationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductConfigurationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery */
        $q = $this->useExistsQuery('SpyProductConfiguration', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductConfiguration table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery The inner query object of the IN statement
     */
    public function useInSpyProductConfigurationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery */
        $q = $this->useInQuery('SpyProductConfiguration', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductConfiguration table for a NOT IN query.
     *
     * @see useSpyProductConfigurationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductConfigurationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductConfiguration\Persistence\SpyProductConfigurationQuery */
        $q = $this->useInQuery('SpyProductConfiguration', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued object
     *
     * @param \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued|ObjectCollection $spyProductDiscontinued the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductDiscontinued($spyProductDiscontinued, ?string $comparison = null)
    {
        if ($spyProductDiscontinued instanceof \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductDiscontinued->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductDiscontinued instanceof ObjectCollection) {
            $this
                ->useSpyProductDiscontinuedQuery()
                ->filterByPrimaryKeys($spyProductDiscontinued->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductDiscontinued() only accepts arguments of type \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinued or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductDiscontinued relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductDiscontinued(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductDiscontinued');

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
            $this->addJoinObject($join, 'SpyProductDiscontinued');
        }

        return $this;
    }

    /**
     * Use the SpyProductDiscontinued relation SpyProductDiscontinued object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductDiscontinuedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductDiscontinued($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductDiscontinued', '\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery');
    }

    /**
     * Use the SpyProductDiscontinued relation SpyProductDiscontinued object
     *
     * @param callable(\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery):\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductDiscontinuedQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductDiscontinuedQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductDiscontinued table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductDiscontinuedExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery */
        $q = $this->useExistsQuery('SpyProductDiscontinued', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductDiscontinued table for a NOT EXISTS query.
     *
     * @see useSpyProductDiscontinuedExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductDiscontinuedNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery */
        $q = $this->useExistsQuery('SpyProductDiscontinued', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductDiscontinued table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery The inner query object of the IN statement
     */
    public function useInSpyProductDiscontinuedQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery */
        $q = $this->useInQuery('SpyProductDiscontinued', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductDiscontinued table for a NOT IN query.
     *
     * @see useSpyProductDiscontinuedInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductDiscontinuedQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedQuery */
        $q = $this->useInQuery('SpyProductDiscontinued', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductImageSet->getFkProduct(), $comparison);

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
     * Filter the query by a related \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete object
     *
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete|ObjectCollection $spyProductListProductConcrete the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductListProductConcrete($spyProductListProductConcrete, ?string $comparison = null)
    {
        if ($spyProductListProductConcrete instanceof \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductListProductConcrete->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductListProductConcrete instanceof ObjectCollection) {
            $this
                ->useSpyProductListProductConcreteQuery()
                ->filterByPrimaryKeys($spyProductListProductConcrete->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductListProductConcrete() only accepts arguments of type \Orm\Zed\ProductList\Persistence\SpyProductListProductConcrete or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductListProductConcrete relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductListProductConcrete(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductListProductConcrete');

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
            $this->addJoinObject($join, 'SpyProductListProductConcrete');
        }

        return $this;
    }

    /**
     * Use the SpyProductListProductConcrete relation SpyProductListProductConcrete object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductListProductConcreteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductListProductConcrete($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductListProductConcrete', '\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery');
    }

    /**
     * Use the SpyProductListProductConcrete relation SpyProductListProductConcrete object
     *
     * @param callable(\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery):\Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductListProductConcreteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductListProductConcreteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductListProductConcreteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useExistsQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for a NOT EXISTS query.
     *
     * @see useSpyProductListProductConcreteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductListProductConcreteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useExistsQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the IN statement
     */
    public function useInSpyProductListProductConcreteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useInQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductListProductConcrete table for a NOT IN query.
     *
     * @see useSpyProductListProductConcreteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductListProductConcreteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListProductConcreteQuery */
        $q = $this->useInQuery('SpyProductListProductConcrete', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit object
     *
     * @param \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit|ObjectCollection $spyProductMeasurementSalesUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductMeasurementSalesUnit($spyProductMeasurementSalesUnit, ?string $comparison = null)
    {
        if ($spyProductMeasurementSalesUnit instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductMeasurementSalesUnit->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductMeasurementSalesUnit instanceof ObjectCollection) {
            $this
                ->useSpyProductMeasurementSalesUnitQuery()
                ->filterByPrimaryKeys($spyProductMeasurementSalesUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductMeasurementSalesUnit() only accepts arguments of type \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductMeasurementSalesUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductMeasurementSalesUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductMeasurementSalesUnit');

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
            $this->addJoinObject($join, 'SpyProductMeasurementSalesUnit');
        }

        return $this;
    }

    /**
     * Use the SpyProductMeasurementSalesUnit relation SpyProductMeasurementSalesUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductMeasurementSalesUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductMeasurementSalesUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductMeasurementSalesUnit', '\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery');
    }

    /**
     * Use the SpyProductMeasurementSalesUnit relation SpyProductMeasurementSalesUnit object
     *
     * @param callable(\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery):\Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductMeasurementSalesUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductMeasurementSalesUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for a NOT EXISTS query.
     *
     * @see useSpyProductMeasurementSalesUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductMeasurementSalesUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useExistsQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the IN statement
     */
    public function useInSpyProductMeasurementSalesUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductMeasurementSalesUnit table for a NOT IN query.
     *
     * @see useSpyProductMeasurementSalesUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductMeasurementSalesUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery */
        $q = $this->useInQuery('SpyProductMeasurementSalesUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit object
     *
     * @param \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit|ObjectCollection $spyProductPackagingUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductPackagingUnitRelatedByFkProduct($spyProductPackagingUnit, ?string $comparison = null)
    {
        if ($spyProductPackagingUnit instanceof \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductPackagingUnit->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductPackagingUnit instanceof ObjectCollection) {
            $this
                ->useSpyProductPackagingUnitRelatedByFkProductQuery()
                ->filterByPrimaryKeys($spyProductPackagingUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductPackagingUnitRelatedByFkProduct() only accepts arguments of type \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductPackagingUnitRelatedByFkProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductPackagingUnitRelatedByFkProduct');

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
            $this->addJoinObject($join, 'SpyProductPackagingUnitRelatedByFkProduct');
        }

        return $this;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkProduct relation SpyProductPackagingUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductPackagingUnitRelatedByFkProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductPackagingUnitRelatedByFkProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductPackagingUnitRelatedByFkProduct', '\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery');
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkProduct relation SpyProductPackagingUnit object
     *
     * @param callable(\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery):\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductPackagingUnitRelatedByFkProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductPackagingUnitRelatedByFkProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkProduct relation to the SpyProductPackagingUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductPackagingUnitRelatedByFkProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useExistsQuery('SpyProductPackagingUnitRelatedByFkProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkProduct relation to the SpyProductPackagingUnit table for a NOT EXISTS query.
     *
     * @see useSpyProductPackagingUnitRelatedByFkProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductPackagingUnitRelatedByFkProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useExistsQuery('SpyProductPackagingUnitRelatedByFkProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkProduct relation to the SpyProductPackagingUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the IN statement
     */
    public function useInSpyProductPackagingUnitRelatedByFkProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useInQuery('SpyProductPackagingUnitRelatedByFkProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkProduct relation to the SpyProductPackagingUnit table for a NOT IN query.
     *
     * @see useSpyProductPackagingUnitRelatedByFkProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductPackagingUnitRelatedByFkProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useInQuery('SpyProductPackagingUnitRelatedByFkProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit object
     *
     * @param \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit|ObjectCollection $spyProductPackagingUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductPackagingUnitRelatedByFkLeadProduct($spyProductPackagingUnit, ?string $comparison = null)
    {
        if ($spyProductPackagingUnit instanceof \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductPackagingUnit->getFkLeadProduct(), $comparison);

            return $this;
        } elseif ($spyProductPackagingUnit instanceof ObjectCollection) {
            $this
                ->useSpyProductPackagingUnitRelatedByFkLeadProductQuery()
                ->filterByPrimaryKeys($spyProductPackagingUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductPackagingUnitRelatedByFkLeadProduct() only accepts arguments of type \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductPackagingUnitRelatedByFkLeadProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductPackagingUnitRelatedByFkLeadProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductPackagingUnitRelatedByFkLeadProduct');

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
            $this->addJoinObject($join, 'SpyProductPackagingUnitRelatedByFkLeadProduct');
        }

        return $this;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkLeadProduct relation SpyProductPackagingUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductPackagingUnitRelatedByFkLeadProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductPackagingUnitRelatedByFkLeadProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductPackagingUnitRelatedByFkLeadProduct', '\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery');
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkLeadProduct relation SpyProductPackagingUnit object
     *
     * @param callable(\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery):\Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductPackagingUnitRelatedByFkLeadProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductPackagingUnitRelatedByFkLeadProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkLeadProduct relation to the SpyProductPackagingUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductPackagingUnitRelatedByFkLeadProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useExistsQuery('SpyProductPackagingUnitRelatedByFkLeadProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkLeadProduct relation to the SpyProductPackagingUnit table for a NOT EXISTS query.
     *
     * @see useSpyProductPackagingUnitRelatedByFkLeadProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductPackagingUnitRelatedByFkLeadProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useExistsQuery('SpyProductPackagingUnitRelatedByFkLeadProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkLeadProduct relation to the SpyProductPackagingUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the IN statement
     */
    public function useInSpyProductPackagingUnitRelatedByFkLeadProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useInQuery('SpyProductPackagingUnitRelatedByFkLeadProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyProductPackagingUnitRelatedByFkLeadProduct relation to the SpyProductPackagingUnit table for a NOT IN query.
     *
     * @see useSpyProductPackagingUnitRelatedByFkLeadProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductPackagingUnitRelatedByFkLeadProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery */
        $q = $this->useInQuery('SpyProductPackagingUnitRelatedByFkLeadProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity object
     *
     * @param \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity|ObjectCollection $spyProductQuantity the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductQuantity($spyProductQuantity, ?string $comparison = null)
    {
        if ($spyProductQuantity instanceof \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductQuantity->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductQuantity instanceof ObjectCollection) {
            $this
                ->useSpyProductQuantityQuery()
                ->filterByPrimaryKeys($spyProductQuantity->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductQuantity() only accepts arguments of type \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductQuantity relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductQuantity(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductQuantity');

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
            $this->addJoinObject($join, 'SpyProductQuantity');
        }

        return $this;
    }

    /**
     * Use the SpyProductQuantity relation SpyProductQuantity object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductQuantityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductQuantity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductQuantity', '\Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery');
    }

    /**
     * Use the SpyProductQuantity relation SpyProductQuantity object
     *
     * @param callable(\Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery):\Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductQuantityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductQuantityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductQuantity table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductQuantityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery */
        $q = $this->useExistsQuery('SpyProductQuantity', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductQuantity table for a NOT EXISTS query.
     *
     * @see useSpyProductQuantityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductQuantityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery */
        $q = $this->useExistsQuery('SpyProductQuantity', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductQuantity table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery The inner query object of the IN statement
     */
    public function useInSpyProductQuantityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery */
        $q = $this->useInQuery('SpyProductQuantity', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductQuantity table for a NOT IN query.
     *
     * @see useSpyProductQuantityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductQuantityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductQuantity\Persistence\SpyProductQuantityQuery */
        $q = $this->useInQuery('SpyProductQuantity', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductSearch\Persistence\SpyProductSearch object
     *
     * @param \Orm\Zed\ProductSearch\Persistence\SpyProductSearch|ObjectCollection $spyProductSearch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductSearch($spyProductSearch, ?string $comparison = null)
    {
        if ($spyProductSearch instanceof \Orm\Zed\ProductSearch\Persistence\SpyProductSearch) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductSearch->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductSearch instanceof ObjectCollection) {
            $this
                ->useSpyProductSearchQuery()
                ->filterByPrimaryKeys($spyProductSearch->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductSearch() only accepts arguments of type \Orm\Zed\ProductSearch\Persistence\SpyProductSearch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductSearch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductSearch(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductSearch');

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
            $this->addJoinObject($join, 'SpyProductSearch');
        }

        return $this;
    }

    /**
     * Use the SpyProductSearch relation SpyProductSearch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductSearchQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductSearch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductSearch', '\Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery');
    }

    /**
     * Use the SpyProductSearch relation SpyProductSearch object
     *
     * @param callable(\Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery):\Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductSearchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductSearchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductSearch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductSearchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery */
        $q = $this->useExistsQuery('SpyProductSearch', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductSearch table for a NOT EXISTS query.
     *
     * @see useSpyProductSearchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductSearchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery */
        $q = $this->useExistsQuery('SpyProductSearch', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductSearch table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery The inner query object of the IN statement
     */
    public function useInSpyProductSearchQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery */
        $q = $this->useInQuery('SpyProductSearch', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductSearch table for a NOT IN query.
     *
     * @see useSpyProductSearchInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductSearchQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery */
        $q = $this->useInQuery('SpyProductSearch', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductValidity\Persistence\SpyProductValidity object
     *
     * @param \Orm\Zed\ProductValidity\Persistence\SpyProductValidity|ObjectCollection $spyProductValidity the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductValidity($spyProductValidity, ?string $comparison = null)
    {
        if ($spyProductValidity instanceof \Orm\Zed\ProductValidity\Persistence\SpyProductValidity) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductValidity->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductValidity instanceof ObjectCollection) {
            $this
                ->useSpyProductValidityQuery()
                ->filterByPrimaryKeys($spyProductValidity->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductValidity() only accepts arguments of type \Orm\Zed\ProductValidity\Persistence\SpyProductValidity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductValidity relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductValidity(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductValidity');

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
            $this->addJoinObject($join, 'SpyProductValidity');
        }

        return $this;
    }

    /**
     * Use the SpyProductValidity relation SpyProductValidity object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductValidityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductValidity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductValidity', '\Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery');
    }

    /**
     * Use the SpyProductValidity relation SpyProductValidity object
     *
     * @param callable(\Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery):\Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductValidityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductValidityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductValidity table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductValidityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery */
        $q = $this->useExistsQuery('SpyProductValidity', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductValidity table for a NOT EXISTS query.
     *
     * @see useSpyProductValidityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductValidityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery */
        $q = $this->useExistsQuery('SpyProductValidity', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductValidity table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery The inner query object of the IN statement
     */
    public function useInSpyProductValidityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery */
        $q = $this->useInQuery('SpyProductValidity', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductValidity table for a NOT IN query.
     *
     * @see useSpyProductValidityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductValidityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductValidity\Persistence\SpyProductValidityQuery */
        $q = $this->useInQuery('SpyProductValidity', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType|ObjectCollection $spyProductShipmentType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductShipmentType($spyProductShipmentType, ?string $comparison = null)
    {
        if ($spyProductShipmentType instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductShipmentType->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductShipmentType instanceof ObjectCollection) {
            $this
                ->useSpyProductShipmentTypeQuery()
                ->filterByPrimaryKeys($spyProductShipmentType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductShipmentType() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductShipmentType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductShipmentType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductShipmentType');

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
            $this->addJoinObject($join, 'SpyProductShipmentType');
        }

        return $this;
    }

    /**
     * Use the SpyProductShipmentType relation SpyProductShipmentType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductShipmentTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductShipmentType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductShipmentType', '\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery');
    }

    /**
     * Use the SpyProductShipmentType relation SpyProductShipmentType object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductShipmentTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductShipmentTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductShipmentType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductShipmentTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useExistsQuery('SpyProductShipmentType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductShipmentType table for a NOT EXISTS query.
     *
     * @see useSpyProductShipmentTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductShipmentTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useExistsQuery('SpyProductShipmentType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductShipmentType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the IN statement
     */
    public function useInSpyProductShipmentTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useInQuery('SpyProductShipmentType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductShipmentType table for a NOT IN query.
     *
     * @see useSpyProductShipmentTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductShipmentTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductShipmentTypeQuery */
        $q = $this->useInQuery('SpyProductShipmentType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClass object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClass|ObjectCollection $spyProductToProductClass the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductToProductClass($spyProductToProductClass, ?string $comparison = null)
    {
        if ($spyProductToProductClass instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClass) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProductToProductClass->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyProductToProductClass instanceof ObjectCollection) {
            $this
                ->useProductToProductClassQuery()
                ->filterByPrimaryKeys($spyProductToProductClass->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductToProductClass() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClass or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductToProductClass relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductToProductClass(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductToProductClass');

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
            $this->addJoinObject($join, 'ProductToProductClass');
        }

        return $this;
    }

    /**
     * Use the ProductToProductClass relation SpyProductToProductClass object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery A secondary query class using the current class as primary query
     */
    public function useProductToProductClassQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductToProductClass($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductToProductClass', '\Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery');
    }

    /**
     * Use the ProductToProductClass relation SpyProductToProductClass object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductToProductClassQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductToProductClassQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductToProductClass relation to the SpyProductToProductClass table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery The inner query object of the EXISTS statement
     */
    public function useProductToProductClassExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery */
        $q = $this->useExistsQuery('ProductToProductClass', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductToProductClass relation to the SpyProductToProductClass table for a NOT EXISTS query.
     *
     * @see useProductToProductClassExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductToProductClassNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery */
        $q = $this->useExistsQuery('ProductToProductClass', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductToProductClass relation to the SpyProductToProductClass table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery The inner query object of the IN statement
     */
    public function useInProductToProductClassQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery */
        $q = $this->useInQuery('ProductToProductClass', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductToProductClass relation to the SpyProductToProductClass table for a NOT IN query.
     *
     * @see useProductToProductClassInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductToProductClassQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyProductToProductClassQuery */
        $q = $this->useInQuery('ProductToProductClass', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Stock\Persistence\SpyStockProduct object
     *
     * @param \Orm\Zed\Stock\Persistence\SpyStockProduct|ObjectCollection $spyStockProduct the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStockProduct($spyStockProduct, ?string $comparison = null)
    {
        if ($spyStockProduct instanceof \Orm\Zed\Stock\Persistence\SpyStockProduct) {
            $this
                ->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyStockProduct->getFkProduct(), $comparison);

            return $this;
        } elseif ($spyStockProduct instanceof ObjectCollection) {
            $this
                ->useStockProductQuery()
                ->filterByPrimaryKeys($spyStockProduct->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStockProduct() only accepts arguments of type \Orm\Zed\Stock\Persistence\SpyStockProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StockProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStockProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StockProduct');

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
            $this->addJoinObject($join, 'StockProduct');
        }

        return $this;
    }

    /**
     * Use the StockProduct relation SpyStockProduct object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery A secondary query class using the current class as primary query
     */
    public function useStockProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinStockProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StockProduct', '\Orm\Zed\Stock\Persistence\SpyStockProductQuery');
    }

    /**
     * Use the StockProduct relation SpyStockProduct object
     *
     * @param callable(\Orm\Zed\Stock\Persistence\SpyStockProductQuery):\Orm\Zed\Stock\Persistence\SpyStockProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStockProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useStockProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StockProduct relation to the SpyStockProduct table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery The inner query object of the EXISTS statement
     */
    public function useStockProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockProductQuery */
        $q = $this->useExistsQuery('StockProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StockProduct relation to the SpyStockProduct table for a NOT EXISTS query.
     *
     * @see useStockProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery The inner query object of the NOT EXISTS statement
     */
    public function useStockProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockProductQuery */
        $q = $this->useExistsQuery('StockProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StockProduct relation to the SpyStockProduct table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery The inner query object of the IN statement
     */
    public function useInStockProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockProductQuery */
        $q = $this->useInQuery('StockProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StockProduct relation to the SpyStockProduct table for a NOT IN query.
     *
     * @see useStockProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery The inner query object of the NOT IN statement
     */
    public function useNotInStockProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Stock\Persistence\SpyStockProductQuery */
        $q = $this->useInQuery('StockProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProductList object
     * using the spy_product_list_product_concrete table as cross reference
     *
     * @param SpyProductList $spyProductList the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductList($spyProductList, string $comparison = null)
    {
        $this
            ->useSpyProductListProductConcreteQuery()
            ->filterBySpyProductList($spyProductList, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Filter the query by a related SpyShipmentType object
     * using the spy_product_shipment_type table as cross reference
     *
     * @param SpyShipmentType $spyShipmentType the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShipmentType($spyShipmentType, string $comparison = null)
    {
        $this
            ->useSpyProductShipmentTypeQuery()
            ->filterBySpyShipmentType($spyShipmentType, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Filter the query by a related SpyProductClass object
     * using the spy_product_to_product_class table as cross reference
     *
     * @param SpyProductClass $spyProductClass the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductClass($spyProductClass, string $comparison = null)
    {
        $this
            ->useProductToProductClassQuery()
            ->filterByProductClass($spyProductClass, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProduct $spyProduct Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProduct = null)
    {
        if ($spyProduct) {
            $this->addUsingAlias(SpyProductTableMap::COL_ID_PRODUCT, $spyProduct->getIdProduct(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductTableMap::clearInstancePool();
            SpyProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductTableMap::COL_CREATED_AT);

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
