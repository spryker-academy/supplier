<?php

namespace Orm\Zed\Locale\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet;
use Orm\Zed\Category\Persistence\SpyCategoryAttribute;
use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes;
use Orm\Zed\Content\Persistence\SpyContentLocalized;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes;
use Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes;
use Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation;
use Orm\Zed\Locale\Persistence\SpyLocale as ChildSpyLocale;
use Orm\Zed\Locale\Persistence\SpyLocaleQuery as ChildSpyLocaleQuery;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes;
use Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation;
use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes;
use Orm\Zed\ProductReview\Persistence\SpyProductReview;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearch;
use Orm\Zed\ProductSet\Persistence\SpyProductSetData;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductLocalizedAttributes;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Orm\Zed\Store\Persistence\SpyStore;
use Orm\Zed\Touch\Persistence\SpyTouchSearch;
use Orm\Zed\Touch\Persistence\SpyTouchStorage;
use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\User\Persistence\SpyUser;
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
 * Base class that represents a query for the `spy_locale` table.
 *
 * @method     ChildSpyLocaleQuery orderByIdLocale($order = Criteria::ASC) Order by the id_locale column
 * @method     ChildSpyLocaleQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyLocaleQuery orderByLocaleName($order = Criteria::ASC) Order by the locale_name column
 *
 * @method     ChildSpyLocaleQuery groupByIdLocale() Group by the id_locale column
 * @method     ChildSpyLocaleQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyLocaleQuery groupByLocaleName() Group by the locale_name column
 *
 * @method     ChildSpyLocaleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyLocaleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyLocaleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyLocaleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyLocaleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyLocaleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyAvailabilityNotificationSubscription($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyLocaleQuery rightJoinSpyAvailabilityNotificationSubscription($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyLocaleQuery innerJoinSpyAvailabilityNotificationSubscription($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyAvailabilityNotificationSubscription($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyAvailabilityNotificationSubscription() Adds a LEFT JOIN clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyAvailabilityNotificationSubscription() Adds a RIGHT JOIN clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyAvailabilityNotificationSubscription() Adds a INNER JOIN clause and with to the query using the SpyAvailabilityNotificationSubscription relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyCategoryAttribute($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryAttribute relation
 * @method     ChildSpyLocaleQuery rightJoinSpyCategoryAttribute($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryAttribute relation
 * @method     ChildSpyLocaleQuery innerJoinSpyCategoryAttribute($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryAttribute relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyCategoryAttribute($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryAttribute relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyCategoryAttribute() Adds a LEFT JOIN clause and with to the query using the SpyCategoryAttribute relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyCategoryAttribute() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryAttribute relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyCategoryAttribute() Adds a INNER JOIN clause and with to the query using the SpyCategoryAttribute relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyCategoryImageSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyLocaleQuery rightJoinSpyCategoryImageSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyLocaleQuery innerJoinSpyCategoryImageSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyCategoryImageSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyCategoryImageSet() Adds a LEFT JOIN clause and with to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyCategoryImageSet() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyCategoryImageSet() Adds a INNER JOIN clause and with to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyCmsPageLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsPageLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyCmsPageLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsPageLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyCmsPageLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsPageLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyCmsPageLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsPageLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyCmsPageLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyCmsPageLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyCmsPageLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyCmsPageLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyCmsPageLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyCmsPageLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyContentLocalized($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyContentLocalized relation
 * @method     ChildSpyLocaleQuery rightJoinSpyContentLocalized($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyContentLocalized relation
 * @method     ChildSpyLocaleQuery innerJoinSpyContentLocalized($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyContentLocalized relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyContentLocalized($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyContentLocalized relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyContentLocalized() Adds a LEFT JOIN clause and with to the query using the SpyContentLocalized relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyContentLocalized() Adds a RIGHT JOIN clause and with to the query using the SpyContentLocalized relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyContentLocalized() Adds a INNER JOIN clause and with to the query using the SpyContentLocalized relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery rightJoinSpyCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery innerJoinSpyCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCustomer relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCustomer relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyCustomer() Adds a LEFT JOIN clause and with to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyCustomer() Adds a RIGHT JOIN clause and with to the query using the SpyCustomer relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyCustomer() Adds a INNER JOIN clause and with to the query using the SpyCustomer relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyFileLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyFileLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyFileLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyFileLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyFileLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyFileLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyFileLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyFileLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyFileLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyFileLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyFileLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyFileDirectoryLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyFileDirectoryLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyFileDirectoryLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyFileDirectoryLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyFileDirectoryLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyFileDirectoryLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyFileDirectoryLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyGlossaryTranslation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery rightJoinSpyGlossaryTranslation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery innerJoinSpyGlossaryTranslation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyGlossaryTranslation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyGlossaryTranslation() Adds a LEFT JOIN clause and with to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyGlossaryTranslation() Adds a RIGHT JOIN clause and with to the query using the SpyGlossaryTranslation relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyGlossaryTranslation() Adds a INNER JOIN clause and with to the query using the SpyGlossaryTranslation relation
 *
 * @method     ChildSpyLocaleQuery leftJoinLocaleStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the LocaleStore relation
 * @method     ChildSpyLocaleQuery rightJoinLocaleStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LocaleStore relation
 * @method     ChildSpyLocaleQuery innerJoinLocaleStore($relationAlias = null) Adds a INNER JOIN clause to the query using the LocaleStore relation
 *
 * @method     ChildSpyLocaleQuery joinWithLocaleStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the LocaleStore relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithLocaleStore() Adds a LEFT JOIN clause and with to the query using the LocaleStore relation
 * @method     ChildSpyLocaleQuery rightJoinWithLocaleStore() Adds a RIGHT JOIN clause and with to the query using the LocaleStore relation
 * @method     ChildSpyLocaleQuery innerJoinWithLocaleStore() Adds a INNER JOIN clause and with to the query using the LocaleStore relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyNavigationNodeLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyNavigationNodeLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyNavigationNodeLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyNavigationNodeLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductAbstractLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductAbstractLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductAbstractLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductAbstractLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductAbstractLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductAbstractLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductAbstractLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductAbstractLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyProductAbstractLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyProductLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyProductLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductManagementAttributeValueTranslation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductManagementAttributeValueTranslation relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductManagementAttributeValueTranslation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductManagementAttributeValueTranslation relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductManagementAttributeValueTranslation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductManagementAttributeValueTranslation relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductManagementAttributeValueTranslation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductManagementAttributeValueTranslation relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductManagementAttributeValueTranslation() Adds a LEFT JOIN clause and with to the query using the SpyProductManagementAttributeValueTranslation relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductManagementAttributeValueTranslation() Adds a RIGHT JOIN clause and with to the query using the SpyProductManagementAttributeValueTranslation relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductManagementAttributeValueTranslation() Adds a INNER JOIN clause and with to the query using the SpyProductManagementAttributeValueTranslation relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductDiscontinuedNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductDiscontinuedNote relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductDiscontinuedNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductDiscontinuedNote relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductDiscontinuedNote($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductDiscontinuedNote relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductDiscontinuedNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductDiscontinuedNote relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductDiscontinuedNote() Adds a LEFT JOIN clause and with to the query using the SpyProductDiscontinuedNote relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductDiscontinuedNote() Adds a RIGHT JOIN clause and with to the query using the SpyProductDiscontinuedNote relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductDiscontinuedNote() Adds a INNER JOIN clause and with to the query using the SpyProductDiscontinuedNote relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductImageSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductImageSet relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductImageSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductImageSet relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductImageSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductImageSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductImageSet() Adds a LEFT JOIN clause and with to the query using the SpyProductImageSet relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductImageSet() Adds a RIGHT JOIN clause and with to the query using the SpyProductImageSet relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductImageSet() Adds a INNER JOIN clause and with to the query using the SpyProductImageSet relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductLabelLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductLabelLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductLabelLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductLabelLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductLabelLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductLabelLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductLabelLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductLabelLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductLabelLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyProductLabelLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductLabelLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyProductLabelLocalizedAttributes relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductLabelLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyProductLabelLocalizedAttributes relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductReview relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductReview relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductReview($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductReview relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductReview($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductReview relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductReview() Adds a LEFT JOIN clause and with to the query using the SpyProductReview relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductReview() Adds a RIGHT JOIN clause and with to the query using the SpyProductReview relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductReview() Adds a INNER JOIN clause and with to the query using the SpyProductReview relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductSearch($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductSearch relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductSearch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductSearch relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductSearch($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductSearch relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductSearch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductSearch relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductSearch() Adds a LEFT JOIN clause and with to the query using the SpyProductSearch relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductSearch() Adds a RIGHT JOIN clause and with to the query using the SpyProductSearch relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductSearch() Adds a INNER JOIN clause and with to the query using the SpyProductSearch relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyProductSetData($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductSetData relation
 * @method     ChildSpyLocaleQuery rightJoinSpyProductSetData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductSetData relation
 * @method     ChildSpyLocaleQuery innerJoinSpyProductSetData($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductSetData relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyProductSetData($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductSetData relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyProductSetData() Adds a LEFT JOIN clause and with to the query using the SpyProductSetData relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyProductSetData() Adds a RIGHT JOIN clause and with to the query using the SpyProductSetData relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyProductSetData() Adds a INNER JOIN clause and with to the query using the SpyProductSetData relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpySalesOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesOrder relation
 * @method     ChildSpyLocaleQuery rightJoinSpySalesOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesOrder relation
 * @method     ChildSpyLocaleQuery innerJoinSpySalesOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesOrder relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpySalesOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesOrder relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpySalesOrder() Adds a LEFT JOIN clause and with to the query using the SpySalesOrder relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpySalesOrder() Adds a RIGHT JOIN clause and with to the query using the SpySalesOrder relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpySalesOrder() Adds a INNER JOIN clause and with to the query using the SpySalesOrder relation
 *
 * @method     ChildSpyLocaleQuery leftJoinStoreDefault($relationAlias = null) Adds a LEFT JOIN clause to the query using the StoreDefault relation
 * @method     ChildSpyLocaleQuery rightJoinStoreDefault($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StoreDefault relation
 * @method     ChildSpyLocaleQuery innerJoinStoreDefault($relationAlias = null) Adds a INNER JOIN clause to the query using the StoreDefault relation
 *
 * @method     ChildSpyLocaleQuery joinWithStoreDefault($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StoreDefault relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithStoreDefault() Adds a LEFT JOIN clause and with to the query using the StoreDefault relation
 * @method     ChildSpyLocaleQuery rightJoinWithStoreDefault() Adds a RIGHT JOIN clause and with to the query using the StoreDefault relation
 * @method     ChildSpyLocaleQuery innerJoinWithStoreDefault() Adds a INNER JOIN clause and with to the query using the StoreDefault relation
 *
 * @method     ChildSpyLocaleQuery leftJoinTouchStorage($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery rightJoinTouchStorage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery innerJoinTouchStorage($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchStorage relation
 *
 * @method     ChildSpyLocaleQuery joinWithTouchStorage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithTouchStorage() Adds a LEFT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery rightJoinWithTouchStorage() Adds a RIGHT JOIN clause and with to the query using the TouchStorage relation
 * @method     ChildSpyLocaleQuery innerJoinWithTouchStorage() Adds a INNER JOIN clause and with to the query using the TouchStorage relation
 *
 * @method     ChildSpyLocaleQuery leftJoinTouchSearch($relationAlias = null) Adds a LEFT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery rightJoinTouchSearch($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery innerJoinTouchSearch($relationAlias = null) Adds a INNER JOIN clause to the query using the TouchSearch relation
 *
 * @method     ChildSpyLocaleQuery joinWithTouchSearch($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the TouchSearch relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithTouchSearch() Adds a LEFT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery rightJoinWithTouchSearch() Adds a RIGHT JOIN clause and with to the query using the TouchSearch relation
 * @method     ChildSpyLocaleQuery innerJoinWithTouchSearch() Adds a INNER JOIN clause and with to the query using the TouchSearch relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyUrl($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyLocaleQuery rightJoinSpyUrl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyLocaleQuery innerJoinSpyUrl($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUrl relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyUrl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyUrl() Adds a LEFT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyUrl() Adds a RIGHT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyUrl() Adds a INNER JOIN clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyLocaleQuery leftJoinSpyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUser relation
 * @method     ChildSpyLocaleQuery rightJoinSpyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUser relation
 * @method     ChildSpyLocaleQuery innerJoinSpyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUser relation
 *
 * @method     ChildSpyLocaleQuery joinWithSpyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUser relation
 *
 * @method     ChildSpyLocaleQuery leftJoinWithSpyUser() Adds a LEFT JOIN clause and with to the query using the SpyUser relation
 * @method     ChildSpyLocaleQuery rightJoinWithSpyUser() Adds a RIGHT JOIN clause and with to the query using the SpyUser relation
 * @method     ChildSpyLocaleQuery innerJoinWithSpyUser() Adds a INNER JOIN clause and with to the query using the SpyUser relation
 *
 * @method     \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery|\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery|\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery|\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery|\Orm\Zed\Content\Persistence\SpyContentLocalizedQuery|\Orm\Zed\Customer\Persistence\SpyCustomerQuery|\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery|\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery|\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery|\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery|\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery|\Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery|\Orm\Zed\Product\Persistence\SpyProductLocalizedAttributesQuery|\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery|\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery|\Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery|\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery|\Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery|\Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery|\Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderQuery|\Orm\Zed\Store\Persistence\SpyStoreQuery|\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery|\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery|\Orm\Zed\Url\Persistence\SpyUrlQuery|\Orm\Zed\User\Persistence\SpyUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyLocale|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyLocale matching the query
 * @method     ChildSpyLocale findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyLocale matching the query, or a new ChildSpyLocale object populated from the query conditions when no match is found
 *
 * @method     ChildSpyLocale|null findOneByIdLocale(int $id_locale) Return the first ChildSpyLocale filtered by the id_locale column
 * @method     ChildSpyLocale|null findOneByIsActive(boolean $is_active) Return the first ChildSpyLocale filtered by the is_active column
 * @method     ChildSpyLocale|null findOneByLocaleName(string $locale_name) Return the first ChildSpyLocale filtered by the locale_name column
 *
 * @method     ChildSpyLocale requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyLocale by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyLocale requireOne(?ConnectionInterface $con = null) Return the first ChildSpyLocale matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyLocale requireOneByIdLocale(int $id_locale) Return the first ChildSpyLocale filtered by the id_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyLocale requireOneByIsActive(boolean $is_active) Return the first ChildSpyLocale filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyLocale requireOneByLocaleName(string $locale_name) Return the first ChildSpyLocale filtered by the locale_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyLocale[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyLocale objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyLocale> find(?ConnectionInterface $con = null) Return ChildSpyLocale objects based on current ModelCriteria
 *
 * @method     ChildSpyLocale[]|Collection findByIdLocale(int|array<int> $id_locale) Return ChildSpyLocale objects filtered by the id_locale column
 * @psalm-method Collection&\Traversable<ChildSpyLocale> findByIdLocale(int|array<int> $id_locale) Return ChildSpyLocale objects filtered by the id_locale column
 * @method     ChildSpyLocale[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyLocale objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyLocale> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyLocale objects filtered by the is_active column
 * @method     ChildSpyLocale[]|Collection findByLocaleName(string|array<string> $locale_name) Return ChildSpyLocale objects filtered by the locale_name column
 * @psalm-method Collection&\Traversable<ChildSpyLocale> findByLocaleName(string|array<string> $locale_name) Return ChildSpyLocale objects filtered by the locale_name column
 *
 * @method     ChildSpyLocale[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyLocale> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyLocaleQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Locale\Persistence\Base\SpyLocaleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyLocaleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyLocaleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyLocaleQuery) {
            return $criteria;
        }
        $query = new ChildSpyLocaleQuery();
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
     * @return ChildSpyLocale|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyLocaleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyLocale A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_locale, is_active, locale_name FROM spy_locale WHERE id_locale = :p0';
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
            /** @var ChildSpyLocale $obj */
            $obj = new ChildSpyLocale();
            $obj->hydrate($row);
            SpyLocaleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyLocale|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idLocale Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdLocale_Between(array $idLocale)
    {
        return $this->filterByIdLocale($idLocale, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idLocales Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdLocale_In(array $idLocales)
    {
        return $this->filterByIdLocale($idLocales, Criteria::IN);
    }

    /**
     * Filter the query on the id_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByIdLocale(1234); // WHERE id_locale = 1234
     * $query->filterByIdLocale(array(12, 34), Criteria::IN); // WHERE id_locale IN (12, 34)
     * $query->filterByIdLocale(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_locale > 12
     * </code>
     *
     * @param     mixed $idLocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdLocale($idLocale = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idLocale)) {
            $useMinMax = false;
            if (isset($idLocale['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $idLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $idLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $idLocale, $comparison);

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

        $query = $this->addUsingAlias(SpyLocaleTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $localeNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocaleName_In(array $localeNames)
    {
        return $this->filterByLocaleName($localeNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $localeName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocaleName_Like($localeName)
    {
        return $this->filterByLocaleName($localeName, Criteria::LIKE);
    }

    /**
     * Filter the query on the locale_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLocaleName('fooValue');   // WHERE locale_name = 'fooValue'
     * $query->filterByLocaleName('%fooValue%', Criteria::LIKE); // WHERE locale_name LIKE '%fooValue%'
     * $query->filterByLocaleName([1, 'foo'], Criteria::IN); // WHERE locale_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $localeName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLocaleName($localeName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $localeName = str_replace('*', '%', $localeName);
        }

        if (is_array($localeName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$localeName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyLocaleTableMap::COL_LOCALE_NAME, $localeName, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription object
     *
     * @param \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription|ObjectCollection $spyAvailabilityNotificationSubscription the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAvailabilityNotificationSubscription($spyAvailabilityNotificationSubscription, ?string $comparison = null)
    {
        if ($spyAvailabilityNotificationSubscription instanceof \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyAvailabilityNotificationSubscription->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyAvailabilityNotificationSubscription instanceof ObjectCollection) {
            $this
                ->useSpyAvailabilityNotificationSubscriptionQuery()
                ->filterByPrimaryKeys($spyAvailabilityNotificationSubscription->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAvailabilityNotificationSubscription() only accepts arguments of type \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscription or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAvailabilityNotificationSubscription relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAvailabilityNotificationSubscription(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAvailabilityNotificationSubscription');

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
            $this->addJoinObject($join, 'SpyAvailabilityNotificationSubscription');
        }

        return $this;
    }

    /**
     * Use the SpyAvailabilityNotificationSubscription relation SpyAvailabilityNotificationSubscription object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery A secondary query class using the current class as primary query
     */
    public function useSpyAvailabilityNotificationSubscriptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAvailabilityNotificationSubscription($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAvailabilityNotificationSubscription', '\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery');
    }

    /**
     * Use the SpyAvailabilityNotificationSubscription relation SpyAvailabilityNotificationSubscription object
     *
     * @param callable(\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery):\Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAvailabilityNotificationSubscriptionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAvailabilityNotificationSubscriptionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the EXISTS statement
     */
    public function useSpyAvailabilityNotificationSubscriptionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useExistsQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for a NOT EXISTS query.
     *
     * @see useSpyAvailabilityNotificationSubscriptionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAvailabilityNotificationSubscriptionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useExistsQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the IN statement
     */
    public function useInSpyAvailabilityNotificationSubscriptionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useInQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAvailabilityNotificationSubscription table for a NOT IN query.
     *
     * @see useSpyAvailabilityNotificationSubscriptionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAvailabilityNotificationSubscriptionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\AvailabilityNotification\Persistence\SpyAvailabilityNotificationSubscriptionQuery */
        $q = $this->useInQuery('SpyAvailabilityNotificationSubscription', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryAttribute object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryAttribute|ObjectCollection $spyCategoryAttribute the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryAttribute($spyCategoryAttribute, ?string $comparison = null)
    {
        if ($spyCategoryAttribute instanceof \Orm\Zed\Category\Persistence\SpyCategoryAttribute) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyCategoryAttribute->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyCategoryAttribute instanceof ObjectCollection) {
            $this
                ->useSpyCategoryAttributeQuery()
                ->filterByPrimaryKeys($spyCategoryAttribute->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryAttribute() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryAttribute or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryAttribute relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryAttribute(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryAttribute');

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
            $this->addJoinObject($join, 'SpyCategoryAttribute');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryAttribute relation SpyCategoryAttribute object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryAttributeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCategoryAttribute($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryAttribute', '\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery');
    }

    /**
     * Use the SpyCategoryAttribute relation SpyCategoryAttribute object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery):\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryAttributeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryAttributeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryAttribute table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryAttributeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useExistsQuery('SpyCategoryAttribute', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryAttribute table for a NOT EXISTS query.
     *
     * @see useSpyCategoryAttributeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryAttributeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useExistsQuery('SpyCategoryAttribute', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryAttribute table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryAttributeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useInQuery('SpyCategoryAttribute', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryAttribute table for a NOT IN query.
     *
     * @see useSpyCategoryAttributeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryAttributeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useInQuery('SpyCategoryAttribute', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet object
     *
     * @param \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet|ObjectCollection $spyCategoryImageSet the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryImageSet($spyCategoryImageSet, ?string $comparison = null)
    {
        if ($spyCategoryImageSet instanceof \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyCategoryImageSet->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyCategoryImageSet instanceof ObjectCollection) {
            $this
                ->useSpyCategoryImageSetQuery()
                ->filterByPrimaryKeys($spyCategoryImageSet->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryImageSet() only accepts arguments of type \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryImageSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryImageSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryImageSet');

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
            $this->addJoinObject($join, 'SpyCategoryImageSet');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryImageSet relation SpyCategoryImageSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryImageSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCategoryImageSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryImageSet', '\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery');
    }

    /**
     * Use the SpyCategoryImageSet relation SpyCategoryImageSet object
     *
     * @param callable(\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery):\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryImageSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryImageSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryImageSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useExistsQuery('SpyCategoryImageSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for a NOT EXISTS query.
     *
     * @see useSpyCategoryImageSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryImageSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useExistsQuery('SpyCategoryImageSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryImageSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useInQuery('SpyCategoryImageSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for a NOT IN query.
     *
     * @see useSpyCategoryImageSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryImageSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useInQuery('SpyCategoryImageSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes object
     *
     * @param \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes|ObjectCollection $spyCmsPageLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsPageLocalizedAttributes($spyCmsPageLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyCmsPageLocalizedAttributes instanceof \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyCmsPageLocalizedAttributes->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyCmsPageLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyCmsPageLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyCmsPageLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsPageLocalizedAttributes() only accepts arguments of type \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsPageLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsPageLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsPageLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyCmsPageLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyCmsPageLocalizedAttributes relation SpyCmsPageLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsPageLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsPageLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsPageLocalizedAttributes', '\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery');
    }

    /**
     * Use the SpyCmsPageLocalizedAttributes relation SpyCmsPageLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery):\Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsPageLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsPageLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsPageLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsPageLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyCmsPageLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsPageLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyCmsPageLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsPageLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyCmsPageLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsPageLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyCmsPageLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyCmsPageLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsPageLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyCmsPageLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsPageLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyCmsPageLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Content\Persistence\SpyContentLocalized object
     *
     * @param \Orm\Zed\Content\Persistence\SpyContentLocalized|ObjectCollection $spyContentLocalized the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyContentLocalized($spyContentLocalized, ?string $comparison = null)
    {
        if ($spyContentLocalized instanceof \Orm\Zed\Content\Persistence\SpyContentLocalized) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyContentLocalized->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyContentLocalized instanceof ObjectCollection) {
            $this
                ->useSpyContentLocalizedQuery()
                ->filterByPrimaryKeys($spyContentLocalized->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyContentLocalized() only accepts arguments of type \Orm\Zed\Content\Persistence\SpyContentLocalized or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyContentLocalized relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyContentLocalized(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyContentLocalized');

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
            $this->addJoinObject($join, 'SpyContentLocalized');
        }

        return $this;
    }

    /**
     * Use the SpyContentLocalized relation SpyContentLocalized object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery A secondary query class using the current class as primary query
     */
    public function useSpyContentLocalizedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyContentLocalized($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyContentLocalized', '\Orm\Zed\Content\Persistence\SpyContentLocalizedQuery');
    }

    /**
     * Use the SpyContentLocalized relation SpyContentLocalized object
     *
     * @param callable(\Orm\Zed\Content\Persistence\SpyContentLocalizedQuery):\Orm\Zed\Content\Persistence\SpyContentLocalizedQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyContentLocalizedQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyContentLocalizedQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyContentLocalized table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery The inner query object of the EXISTS statement
     */
    public function useSpyContentLocalizedExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery */
        $q = $this->useExistsQuery('SpyContentLocalized', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyContentLocalized table for a NOT EXISTS query.
     *
     * @see useSpyContentLocalizedExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyContentLocalizedNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery */
        $q = $this->useExistsQuery('SpyContentLocalized', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyContentLocalized table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery The inner query object of the IN statement
     */
    public function useInSpyContentLocalizedQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery */
        $q = $this->useInQuery('SpyContentLocalized', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyContentLocalized table for a NOT IN query.
     *
     * @see useSpyContentLocalizedInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyContentLocalizedQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Content\Persistence\SpyContentLocalizedQuery */
        $q = $this->useInQuery('SpyContentLocalized', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomer object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|ObjectCollection $spyCustomer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCustomer($spyCustomer, ?string $comparison = null)
    {
        if ($spyCustomer instanceof \Orm\Zed\Customer\Persistence\SpyCustomer) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyCustomer->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyCustomer instanceof ObjectCollection) {
            $this
                ->useSpyCustomerQuery()
                ->filterByPrimaryKeys($spyCustomer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCustomer() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCustomer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCustomer(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCustomer');

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
            $this->addJoinObject($join, 'SpyCustomer');
        }

        return $this;
    }

    /**
     * Use the SpyCustomer relation SpyCustomer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery A secondary query class using the current class as primary query
     */
    public function useSpyCustomerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCustomer', '\Orm\Zed\Customer\Persistence\SpyCustomerQuery');
    }

    /**
     * Use the SpyCustomer relation SpyCustomer object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerQuery):\Orm\Zed\Customer\Persistence\SpyCustomerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCustomerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCustomerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCustomer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the EXISTS statement
     */
    public function useSpyCustomerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useExistsQuery('SpyCustomer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCustomer table for a NOT EXISTS query.
     *
     * @see useSpyCustomerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCustomerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useExistsQuery('SpyCustomer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCustomer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the IN statement
     */
    public function useInSpyCustomerQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useInQuery('SpyCustomer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCustomer table for a NOT IN query.
     *
     * @see useSpyCustomerInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCustomerQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useInQuery('SpyCustomer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes|ObjectCollection $spyFileLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyFileLocalizedAttributes($spyFileLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyFileLocalizedAttributes instanceof \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyFileLocalizedAttributes->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyFileLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyFileLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyFileLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyFileLocalizedAttributes() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyFileLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyFileLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyFileLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyFileLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyFileLocalizedAttributes relation SpyFileLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyFileLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyFileLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyFileLocalizedAttributes', '\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery');
    }

    /**
     * Use the SpyFileLocalizedAttributes relation SpyFileLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery):\Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyFileLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyFileLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyFileLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyFileLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyFileLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyFileLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyFileLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyFileLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyFileLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes|ObjectCollection $spyFileDirectoryLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyFileDirectoryLocalizedAttributes($spyFileDirectoryLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyFileDirectoryLocalizedAttributes instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyFileDirectoryLocalizedAttributes->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyFileDirectoryLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyFileDirectoryLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyFileDirectoryLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyFileDirectoryLocalizedAttributes() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyFileDirectoryLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyFileDirectoryLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyFileDirectoryLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyFileDirectoryLocalizedAttributes relation SpyFileDirectoryLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyFileDirectoryLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyFileDirectoryLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyFileDirectoryLocalizedAttributes', '\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery');
    }

    /**
     * Use the SpyFileDirectoryLocalizedAttributes relation SpyFileDirectoryLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery):\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyFileDirectoryLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyFileDirectoryLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyFileDirectoryLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyFileDirectoryLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyFileDirectoryLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyFileDirectoryLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyFileDirectoryLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyFileDirectoryLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation object
     *
     * @param \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation|ObjectCollection $spyGlossaryTranslation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyGlossaryTranslation($spyGlossaryTranslation, ?string $comparison = null)
    {
        if ($spyGlossaryTranslation instanceof \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyGlossaryTranslation->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyGlossaryTranslation instanceof ObjectCollection) {
            $this
                ->useSpyGlossaryTranslationQuery()
                ->filterByPrimaryKeys($spyGlossaryTranslation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyGlossaryTranslation() only accepts arguments of type \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyGlossaryTranslation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyGlossaryTranslation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyGlossaryTranslation');

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
            $this->addJoinObject($join, 'SpyGlossaryTranslation');
        }

        return $this;
    }

    /**
     * Use the SpyGlossaryTranslation relation SpyGlossaryTranslation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery A secondary query class using the current class as primary query
     */
    public function useSpyGlossaryTranslationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyGlossaryTranslation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyGlossaryTranslation', '\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery');
    }

    /**
     * Use the SpyGlossaryTranslation relation SpyGlossaryTranslation object
     *
     * @param callable(\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery):\Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyGlossaryTranslationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyGlossaryTranslationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyGlossaryTranslation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery The inner query object of the EXISTS statement
     */
    public function useSpyGlossaryTranslationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery */
        $q = $this->useExistsQuery('SpyGlossaryTranslation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyGlossaryTranslation table for a NOT EXISTS query.
     *
     * @see useSpyGlossaryTranslationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyGlossaryTranslationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery */
        $q = $this->useExistsQuery('SpyGlossaryTranslation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyGlossaryTranslation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery The inner query object of the IN statement
     */
    public function useInSpyGlossaryTranslationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery */
        $q = $this->useInQuery('SpyGlossaryTranslation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyGlossaryTranslation table for a NOT IN query.
     *
     * @see useSpyGlossaryTranslationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyGlossaryTranslationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryTranslationQuery */
        $q = $this->useInQuery('SpyGlossaryTranslation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Locale\Persistence\SpyLocaleStore object
     *
     * @param \Orm\Zed\Locale\Persistence\SpyLocaleStore|ObjectCollection $spyLocaleStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLocaleStore($spyLocaleStore, ?string $comparison = null)
    {
        if ($spyLocaleStore instanceof \Orm\Zed\Locale\Persistence\SpyLocaleStore) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyLocaleStore->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyLocaleStore instanceof ObjectCollection) {
            $this
                ->useLocaleStoreQuery()
                ->filterByPrimaryKeys($spyLocaleStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByLocaleStore() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocaleStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LocaleStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinLocaleStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LocaleStore');

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
            $this->addJoinObject($join, 'LocaleStore');
        }

        return $this;
    }

    /**
     * Use the LocaleStore relation SpyLocaleStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery A secondary query class using the current class as primary query
     */
    public function useLocaleStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocaleStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LocaleStore', '\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery');
    }

    /**
     * Use the LocaleStore relation SpyLocaleStore object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery):\Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLocaleStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLocaleStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the EXISTS statement
     */
    public function useLocaleStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useExistsQuery('LocaleStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for a NOT EXISTS query.
     *
     * @see useLocaleStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useLocaleStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useExistsQuery('LocaleStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the IN statement
     */
    public function useInLocaleStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useInQuery('LocaleStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the LocaleStore relation to the SpyLocaleStore table for a NOT IN query.
     *
     * @see useLocaleStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInLocaleStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleStoreQuery */
        $q = $this->useInQuery('LocaleStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes object
     *
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes|ObjectCollection $spyNavigationNodeLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyNavigationNodeLocalizedAttributes($spyNavigationNodeLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyNavigationNodeLocalizedAttributes instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyNavigationNodeLocalizedAttributes->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyNavigationNodeLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyNavigationNodeLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyNavigationNodeLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyNavigationNodeLocalizedAttributes() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNavigationNodeLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNavigationNodeLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyNavigationNodeLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyNavigationNodeLocalizedAttributes relation SpyNavigationNodeLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyNavigationNodeLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyNavigationNodeLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNavigationNodeLocalizedAttributes', '\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery');
    }

    /**
     * Use the SpyNavigationNodeLocalizedAttributes relation SpyNavigationNodeLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNavigationNodeLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyNavigationNodeLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyNavigationNodeLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyNavigationNodeLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNavigationNodeLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyNavigationNodeLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyNavigationNodeLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNavigationNodeLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductAbstractLocalizedAttributes->getFkLocale(), $comparison);

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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductLocalizedAttributes->getFkLocale(), $comparison);

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
     * Filter the query by a related \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation object
     *
     * @param \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation|ObjectCollection $spyProductManagementAttributeValueTranslation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductManagementAttributeValueTranslation($spyProductManagementAttributeValueTranslation, ?string $comparison = null)
    {
        if ($spyProductManagementAttributeValueTranslation instanceof \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductManagementAttributeValueTranslation->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyProductManagementAttributeValueTranslation instanceof ObjectCollection) {
            $this
                ->useSpyProductManagementAttributeValueTranslationQuery()
                ->filterByPrimaryKeys($spyProductManagementAttributeValueTranslation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductManagementAttributeValueTranslation() only accepts arguments of type \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductManagementAttributeValueTranslation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductManagementAttributeValueTranslation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductManagementAttributeValueTranslation');

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
            $this->addJoinObject($join, 'SpyProductManagementAttributeValueTranslation');
        }

        return $this;
    }

    /**
     * Use the SpyProductManagementAttributeValueTranslation relation SpyProductManagementAttributeValueTranslation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductManagementAttributeValueTranslationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductManagementAttributeValueTranslation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductManagementAttributeValueTranslation', '\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery');
    }

    /**
     * Use the SpyProductManagementAttributeValueTranslation relation SpyProductManagementAttributeValueTranslation object
     *
     * @param callable(\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery):\Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductManagementAttributeValueTranslationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductManagementAttributeValueTranslationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductManagementAttributeValueTranslation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductManagementAttributeValueTranslationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery */
        $q = $this->useExistsQuery('SpyProductManagementAttributeValueTranslation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductManagementAttributeValueTranslation table for a NOT EXISTS query.
     *
     * @see useSpyProductManagementAttributeValueTranslationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductManagementAttributeValueTranslationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery */
        $q = $this->useExistsQuery('SpyProductManagementAttributeValueTranslation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductManagementAttributeValueTranslation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery The inner query object of the IN statement
     */
    public function useInSpyProductManagementAttributeValueTranslationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery */
        $q = $this->useInQuery('SpyProductManagementAttributeValueTranslation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductManagementAttributeValueTranslation table for a NOT IN query.
     *
     * @see useSpyProductManagementAttributeValueTranslationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductManagementAttributeValueTranslationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductAttribute\Persistence\SpyProductManagementAttributeValueTranslationQuery */
        $q = $this->useInQuery('SpyProductManagementAttributeValueTranslation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote object
     *
     * @param \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote|ObjectCollection $spyProductDiscontinuedNote the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductDiscontinuedNote($spyProductDiscontinuedNote, ?string $comparison = null)
    {
        if ($spyProductDiscontinuedNote instanceof \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductDiscontinuedNote->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyProductDiscontinuedNote instanceof ObjectCollection) {
            $this
                ->useSpyProductDiscontinuedNoteQuery()
                ->filterByPrimaryKeys($spyProductDiscontinuedNote->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductDiscontinuedNote() only accepts arguments of type \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductDiscontinuedNote relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductDiscontinuedNote(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductDiscontinuedNote');

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
            $this->addJoinObject($join, 'SpyProductDiscontinuedNote');
        }

        return $this;
    }

    /**
     * Use the SpyProductDiscontinuedNote relation SpyProductDiscontinuedNote object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductDiscontinuedNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductDiscontinuedNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductDiscontinuedNote', '\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery');
    }

    /**
     * Use the SpyProductDiscontinuedNote relation SpyProductDiscontinuedNote object
     *
     * @param callable(\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery):\Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductDiscontinuedNoteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductDiscontinuedNoteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductDiscontinuedNote table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductDiscontinuedNoteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery */
        $q = $this->useExistsQuery('SpyProductDiscontinuedNote', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductDiscontinuedNote table for a NOT EXISTS query.
     *
     * @see useSpyProductDiscontinuedNoteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductDiscontinuedNoteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery */
        $q = $this->useExistsQuery('SpyProductDiscontinuedNote', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductDiscontinuedNote table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery The inner query object of the IN statement
     */
    public function useInSpyProductDiscontinuedNoteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery */
        $q = $this->useInQuery('SpyProductDiscontinuedNote', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductDiscontinuedNote table for a NOT IN query.
     *
     * @see useSpyProductDiscontinuedNoteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductDiscontinuedNoteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery */
        $q = $this->useInQuery('SpyProductDiscontinuedNote', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductImageSet->getFkLocale(), $comparison);

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
     * Filter the query by a related \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes object
     *
     * @param \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes|ObjectCollection $spyProductLabelLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductLabelLocalizedAttributes($spyProductLabelLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyProductLabelLocalizedAttributes instanceof \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductLabelLocalizedAttributes->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyProductLabelLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyProductLabelLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyProductLabelLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductLabelLocalizedAttributes() only accepts arguments of type \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductLabelLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductLabelLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductLabelLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyProductLabelLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyProductLabelLocalizedAttributes relation SpyProductLabelLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductLabelLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductLabelLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductLabelLocalizedAttributes', '\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery');
    }

    /**
     * Use the SpyProductLabelLocalizedAttributes relation SpyProductLabelLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery):\Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductLabelLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductLabelLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductLabelLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductLabelLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyProductLabelLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductLabelLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyProductLabelLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductLabelLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyProductLabelLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductLabelLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyProductLabelLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyProductLabelLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductLabelLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyProductLabelLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductLabelLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyProductLabelLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductReview->getFkLocale(), $comparison);

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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductSearch->getFkLocale(), $comparison);

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
     * Filter the query by a related \Orm\Zed\ProductSet\Persistence\SpyProductSetData object
     *
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductSetData|ObjectCollection $spyProductSetData the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductSetData($spyProductSetData, ?string $comparison = null)
    {
        if ($spyProductSetData instanceof \Orm\Zed\ProductSet\Persistence\SpyProductSetData) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyProductSetData->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyProductSetData instanceof ObjectCollection) {
            $this
                ->useSpyProductSetDataQuery()
                ->filterByPrimaryKeys($spyProductSetData->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductSetData() only accepts arguments of type \Orm\Zed\ProductSet\Persistence\SpyProductSetData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductSetData relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductSetData(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductSetData');

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
            $this->addJoinObject($join, 'SpyProductSetData');
        }

        return $this;
    }

    /**
     * Use the SpyProductSetData relation SpyProductSetData object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductSetDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductSetData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductSetData', '\Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery');
    }

    /**
     * Use the SpyProductSetData relation SpyProductSetData object
     *
     * @param callable(\Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery):\Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductSetDataQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductSetDataQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductSetData table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductSetDataExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery */
        $q = $this->useExistsQuery('SpyProductSetData', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductSetData table for a NOT EXISTS query.
     *
     * @see useSpyProductSetDataExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductSetDataNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery */
        $q = $this->useExistsQuery('SpyProductSetData', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductSetData table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery The inner query object of the IN statement
     */
    public function useInSpyProductSetDataQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery */
        $q = $this->useInQuery('SpyProductSetData', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductSetData table for a NOT IN query.
     *
     * @see useSpyProductSetDataInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductSetDataQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery */
        $q = $this->useInQuery('SpyProductSetData', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrder object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder|ObjectCollection $spySalesOrder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesOrder($spySalesOrder, ?string $comparison = null)
    {
        if ($spySalesOrder instanceof \Orm\Zed\Sales\Persistence\SpySalesOrder) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spySalesOrder->getFkLocale(), $comparison);

            return $this;
        } elseif ($spySalesOrder instanceof ObjectCollection) {
            $this
                ->useSpySalesOrderQuery()
                ->filterByPrimaryKeys($spySalesOrder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesOrder() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesOrder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesOrder(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesOrder');

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
            $this->addJoinObject($join, 'SpySalesOrder');
        }

        return $this;
    }

    /**
     * Use the SpySalesOrder relation SpySalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesOrderQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySalesOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesOrder', '\Orm\Zed\Sales\Persistence\SpySalesOrderQuery');
    }

    /**
     * Use the SpySalesOrder relation SpySalesOrder object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySalesOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('SpySalesOrder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrder table for a NOT EXISTS query.
     *
     * @see useSpySalesOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useExistsQuery('SpySalesOrder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the IN statement
     */
    public function useInSpySalesOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('SpySalesOrder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesOrder table for a NOT IN query.
     *
     * @see useSpySalesOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderQuery */
        $q = $this->useInQuery('SpySalesOrder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Store\Persistence\SpyStore object
     *
     * @param \Orm\Zed\Store\Persistence\SpyStore|ObjectCollection $spyStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStoreDefault($spyStore, ?string $comparison = null)
    {
        if ($spyStore instanceof \Orm\Zed\Store\Persistence\SpyStore) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyStore->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyStore instanceof ObjectCollection) {
            $this
                ->useStoreDefaultQuery()
                ->filterByPrimaryKeys($spyStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByStoreDefault() only accepts arguments of type \Orm\Zed\Store\Persistence\SpyStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StoreDefault relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStoreDefault(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StoreDefault');

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
            $this->addJoinObject($join, 'StoreDefault');
        }

        return $this;
    }

    /**
     * Use the StoreDefault relation SpyStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery A secondary query class using the current class as primary query
     */
    public function useStoreDefaultQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStoreDefault($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StoreDefault', '\Orm\Zed\Store\Persistence\SpyStoreQuery');
    }

    /**
     * Use the StoreDefault relation SpyStore object
     *
     * @param callable(\Orm\Zed\Store\Persistence\SpyStoreQuery):\Orm\Zed\Store\Persistence\SpyStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStoreDefaultQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStoreDefaultQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StoreDefault relation to the SpyStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the EXISTS statement
     */
    public function useStoreDefaultExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useExistsQuery('StoreDefault', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StoreDefault relation to the SpyStore table for a NOT EXISTS query.
     *
     * @see useStoreDefaultExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useStoreDefaultNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useExistsQuery('StoreDefault', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StoreDefault relation to the SpyStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the IN statement
     */
    public function useInStoreDefaultQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useInQuery('StoreDefault', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StoreDefault relation to the SpyStore table for a NOT IN query.
     *
     * @see useStoreDefaultInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInStoreDefaultQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useInQuery('StoreDefault', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Touch\Persistence\SpyTouchStorage object
     *
     * @param \Orm\Zed\Touch\Persistence\SpyTouchStorage|ObjectCollection $spyTouchStorage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouchStorage($spyTouchStorage, ?string $comparison = null)
    {
        if ($spyTouchStorage instanceof \Orm\Zed\Touch\Persistence\SpyTouchStorage) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyTouchStorage->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyTouchStorage instanceof ObjectCollection) {
            $this
                ->useTouchStorageQuery()
                ->filterByPrimaryKeys($spyTouchStorage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTouchStorage() only accepts arguments of type \Orm\Zed\Touch\Persistence\SpyTouchStorage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TouchStorage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTouchStorage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TouchStorage');

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
            $this->addJoinObject($join, 'TouchStorage');
        }

        return $this;
    }

    /**
     * Use the TouchStorage relation SpyTouchStorage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery A secondary query class using the current class as primary query
     */
    public function useTouchStorageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTouchStorage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TouchStorage', '\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery');
    }

    /**
     * Use the TouchStorage relation SpyTouchStorage object
     *
     * @param callable(\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery):\Orm\Zed\Touch\Persistence\SpyTouchStorageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTouchStorageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTouchStorageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the EXISTS statement
     */
    public function useTouchStorageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useExistsQuery('TouchStorage', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for a NOT EXISTS query.
     *
     * @see useTouchStorageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the NOT EXISTS statement
     */
    public function useTouchStorageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useExistsQuery('TouchStorage', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the IN statement
     */
    public function useInTouchStorageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useInQuery('TouchStorage', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TouchStorage relation to the SpyTouchStorage table for a NOT IN query.
     *
     * @see useTouchStorageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery The inner query object of the NOT IN statement
     */
    public function useNotInTouchStorageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchStorageQuery */
        $q = $this->useInQuery('TouchStorage', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Touch\Persistence\SpyTouchSearch object
     *
     * @param \Orm\Zed\Touch\Persistence\SpyTouchSearch|ObjectCollection $spyTouchSearch the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTouchSearch($spyTouchSearch, ?string $comparison = null)
    {
        if ($spyTouchSearch instanceof \Orm\Zed\Touch\Persistence\SpyTouchSearch) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyTouchSearch->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyTouchSearch instanceof ObjectCollection) {
            $this
                ->useTouchSearchQuery()
                ->filterByPrimaryKeys($spyTouchSearch->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByTouchSearch() only accepts arguments of type \Orm\Zed\Touch\Persistence\SpyTouchSearch or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TouchSearch relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinTouchSearch(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TouchSearch');

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
            $this->addJoinObject($join, 'TouchSearch');
        }

        return $this;
    }

    /**
     * Use the TouchSearch relation SpyTouchSearch object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery A secondary query class using the current class as primary query
     */
    public function useTouchSearchQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTouchSearch($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TouchSearch', '\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery');
    }

    /**
     * Use the TouchSearch relation SpyTouchSearch object
     *
     * @param callable(\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery):\Orm\Zed\Touch\Persistence\SpyTouchSearchQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTouchSearchQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTouchSearchQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the EXISTS statement
     */
    public function useTouchSearchExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useExistsQuery('TouchSearch', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for a NOT EXISTS query.
     *
     * @see useTouchSearchExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the NOT EXISTS statement
     */
    public function useTouchSearchNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useExistsQuery('TouchSearch', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the IN statement
     */
    public function useInTouchSearchQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useInQuery('TouchSearch', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the TouchSearch relation to the SpyTouchSearch table for a NOT IN query.
     *
     * @see useTouchSearchInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery The inner query object of the NOT IN statement
     */
    public function useNotInTouchSearchQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Touch\Persistence\SpyTouchSearchQuery */
        $q = $this->useInQuery('TouchSearch', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyUrl->getFkLocale(), $comparison);

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
    public function joinSpyUrl(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useSpyUrlQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \Orm\Zed\User\Persistence\SpyUser object
     *
     * @param \Orm\Zed\User\Persistence\SpyUser|ObjectCollection $spyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUser($spyUser, ?string $comparison = null)
    {
        if ($spyUser instanceof \Orm\Zed\User\Persistence\SpyUser) {
            $this
                ->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyUser->getFkLocale(), $comparison);

            return $this;
        } elseif ($spyUser instanceof ObjectCollection) {
            $this
                ->useSpyUserQuery()
                ->filterByPrimaryKeys($spyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyUser() only accepts arguments of type \Orm\Zed\User\Persistence\SpyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyUser(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyUser');

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
            $this->addJoinObject($join, 'SpyUser');
        }

        return $this;
    }

    /**
     * Use the SpyUser relation SpyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\User\Persistence\SpyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyUser', '\Orm\Zed\User\Persistence\SpyUserQuery');
    }

    /**
     * Use the SpyUser relation SpyUser object
     *
     * @param callable(\Orm\Zed\User\Persistence\SpyUserQuery):\Orm\Zed\User\Persistence\SpyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\User\Persistence\SpyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\User\Persistence\SpyUserQuery */
        $q = $this->useExistsQuery('SpyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyUser table for a NOT EXISTS query.
     *
     * @see useSpyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\User\Persistence\SpyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\User\Persistence\SpyUserQuery */
        $q = $this->useExistsQuery('SpyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\User\Persistence\SpyUserQuery The inner query object of the IN statement
     */
    public function useInSpyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\User\Persistence\SpyUserQuery */
        $q = $this->useInQuery('SpyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyUser table for a NOT IN query.
     *
     * @see useSpyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\User\Persistence\SpyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\User\Persistence\SpyUserQuery */
        $q = $this->useInQuery('SpyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyLocale $spyLocale Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyLocale = null)
    {
        if ($spyLocale) {
            $this->addUsingAlias(SpyLocaleTableMap::COL_ID_LOCALE, $spyLocale->getIdLocale(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_locale table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyLocaleTableMap::clearInstancePool();
            SpyLocaleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyLocaleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyLocaleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyLocaleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyLocaleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
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
