<?php

namespace Orm\Zed\Merchant\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant;
use Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule;
use Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule;
use Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstract;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\MerchantStock\Persistence\SpyMerchantStock;
use Orm\Zed\MerchantUser\Persistence\SpyMerchantUser;
use Orm\Zed\Merchant\Persistence\SpyMerchant as ChildSpyMerchant;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery as ChildSpyMerchantQuery;
use Orm\Zed\Merchant\Persistence\Map\SpyMerchantTableMap;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout;
use Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier;
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
 * Base class that represents a query for the `spy_merchant` table.
 *
 * @method     ChildSpyMerchantQuery orderByIdMerchant($order = Criteria::ASC) Order by the id_merchant column
 * @method     ChildSpyMerchantQuery orderByFkStateMachineProcess($order = Criteria::ASC) Order by the fk_state_machine_process column
 * @method     ChildSpyMerchantQuery orderByDefaultProductAbstractApprovalStatus($order = Criteria::ASC) Order by the default_product_abstract_approval_status column
 * @method     ChildSpyMerchantQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildSpyMerchantQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyMerchantQuery orderByIsOpenForRelationRequest($order = Criteria::ASC) Order by the is_open_for_relation_request column
 * @method     ChildSpyMerchantQuery orderByMerchantReference($order = Criteria::ASC) Order by the merchant_reference column
 * @method     ChildSpyMerchantQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyMerchantQuery orderByRegistrationNumber($order = Criteria::ASC) Order by the registration_number column
 * @method     ChildSpyMerchantQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSpyMerchantQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyMerchantQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyMerchantQuery groupByIdMerchant() Group by the id_merchant column
 * @method     ChildSpyMerchantQuery groupByFkStateMachineProcess() Group by the fk_state_machine_process column
 * @method     ChildSpyMerchantQuery groupByDefaultProductAbstractApprovalStatus() Group by the default_product_abstract_approval_status column
 * @method     ChildSpyMerchantQuery groupByEmail() Group by the email column
 * @method     ChildSpyMerchantQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyMerchantQuery groupByIsOpenForRelationRequest() Group by the is_open_for_relation_request column
 * @method     ChildSpyMerchantQuery groupByMerchantReference() Group by the merchant_reference column
 * @method     ChildSpyMerchantQuery groupByName() Group by the name column
 * @method     ChildSpyMerchantQuery groupByRegistrationNumber() Group by the registration_number column
 * @method     ChildSpyMerchantQuery groupByStatus() Group by the status column
 * @method     ChildSpyMerchantQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyMerchantQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyMerchantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyStateMachineProcess($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyStateMachineProcess relation
 * @method     ChildSpyMerchantQuery rightJoinSpyStateMachineProcess($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyStateMachineProcess relation
 * @method     ChildSpyMerchantQuery innerJoinSpyStateMachineProcess($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyStateMachineProcess relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyStateMachineProcess($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyStateMachineProcess relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyStateMachineProcess() Adds a LEFT JOIN clause and with to the query using the SpyStateMachineProcess relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyStateMachineProcess() Adds a RIGHT JOIN clause and with to the query using the SpyStateMachineProcess relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyStateMachineProcess() Adds a INNER JOIN clause and with to the query using the SpyStateMachineProcess relation
 *
 * @method     ChildSpyMerchantQuery leftJoinPyzMerchantToSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the PyzMerchantToSupplier relation
 * @method     ChildSpyMerchantQuery rightJoinPyzMerchantToSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PyzMerchantToSupplier relation
 * @method     ChildSpyMerchantQuery innerJoinPyzMerchantToSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the PyzMerchantToSupplier relation
 *
 * @method     ChildSpyMerchantQuery joinWithPyzMerchantToSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PyzMerchantToSupplier relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithPyzMerchantToSupplier() Adds a LEFT JOIN clause and with to the query using the PyzMerchantToSupplier relation
 * @method     ChildSpyMerchantQuery rightJoinWithPyzMerchantToSupplier() Adds a RIGHT JOIN clause and with to the query using the PyzMerchantToSupplier relation
 * @method     ChildSpyMerchantQuery innerJoinWithPyzMerchantToSupplier() Adds a INNER JOIN clause and with to the query using the PyzMerchantToSupplier relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantStore relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantStore relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantStore relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantStore relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantStore() Adds a LEFT JOIN clause and with to the query using the SpyMerchantStore relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantStore() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantStore relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantStore() Adds a INNER JOIN clause and with to the query using the SpyMerchantStore relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantAppOnboardingStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantAppOnboardingStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantAppOnboardingStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantAppOnboardingStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantAppOnboardingStatus() Adds a LEFT JOIN clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantAppOnboardingStatus() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantAppOnboardingStatus() Adds a INNER JOIN clause and with to the query using the SpyMerchantAppOnboardingStatus relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantCategory relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantCategory relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantCategory relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantCategory relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantCategory() Adds a LEFT JOIN clause and with to the query using the SpyMerchantCategory relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantCategory() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantCategory relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantCategory() Adds a INNER JOIN clause and with to the query using the SpyMerchantCategory relation
 *
 * @method     ChildSpyMerchantQuery leftJoinMerchantCommission($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantQuery rightJoinMerchantCommission($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantQuery innerJoinMerchantCommission($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommission relation
 *
 * @method     ChildSpyMerchantQuery joinWithMerchantCommission($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommission relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithMerchantCommission() Adds a LEFT JOIN clause and with to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantQuery rightJoinWithMerchantCommission() Adds a RIGHT JOIN clause and with to the query using the MerchantCommission relation
 * @method     ChildSpyMerchantQuery innerJoinWithMerchantCommission() Adds a INNER JOIN clause and with to the query using the MerchantCommission relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantOpeningHoursWeekdaySchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantOpeningHoursWeekdaySchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantOpeningHoursWeekdaySchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantOpeningHoursWeekdaySchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantOpeningHoursWeekdaySchedule() Adds a LEFT JOIN clause and with to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantOpeningHoursWeekdaySchedule() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantOpeningHoursWeekdaySchedule() Adds a INNER JOIN clause and with to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantOpeningHoursDateSchedule($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantOpeningHoursDateSchedule relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantOpeningHoursDateSchedule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantOpeningHoursDateSchedule relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantOpeningHoursDateSchedule($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantOpeningHoursDateSchedule relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantOpeningHoursDateSchedule($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantOpeningHoursDateSchedule relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantOpeningHoursDateSchedule() Adds a LEFT JOIN clause and with to the query using the SpyMerchantOpeningHoursDateSchedule relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantOpeningHoursDateSchedule() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantOpeningHoursDateSchedule relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantOpeningHoursDateSchedule() Adds a INNER JOIN clause and with to the query using the SpyMerchantOpeningHoursDateSchedule relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantProductAbstract($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantProductAbstract($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantProductAbstract($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProductAbstract relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantProductAbstract($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProductAbstract relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantProductAbstract() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantProductAbstract() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProductAbstract relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantProductAbstract() Adds a INNER JOIN clause and with to the query using the SpyMerchantProductAbstract relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantProfile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantProfile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantProfile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProfile relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantProfile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProfile relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantProfile() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantProfile() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProfile relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantProfile() Adds a INNER JOIN clause and with to the query using the SpyMerchantProfile relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantRelationRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantRelationRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantRelationRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantRelationRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantRelationRequest() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantRelationRequest() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantRelationRequest() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantRelationship($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantRelationship($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantRelationship($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantRelationship($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantRelationship() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantRelationship() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantRelationship() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantStock relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantStock relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantStock($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantStock relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantStock relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantStock() Adds a LEFT JOIN clause and with to the query using the SpyMerchantStock relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantStock() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantStock relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantStock() Adds a INNER JOIN clause and with to the query using the SpyMerchantStock relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyMerchantUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantUser relation
 * @method     ChildSpyMerchantQuery rightJoinSpyMerchantUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantUser relation
 * @method     ChildSpyMerchantQuery innerJoinSpyMerchantUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantUser relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyMerchantUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantUser relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyMerchantUser() Adds a LEFT JOIN clause and with to the query using the SpyMerchantUser relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyMerchantUser() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantUser relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyMerchantUser() Adds a INNER JOIN clause and with to the query using the SpyMerchantUser relation
 *
 * @method     ChildSpyMerchantQuery leftJoinProductOffer($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOffer relation
 * @method     ChildSpyMerchantQuery rightJoinProductOffer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOffer relation
 * @method     ChildSpyMerchantQuery innerJoinProductOffer($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOffer relation
 *
 * @method     ChildSpyMerchantQuery joinWithProductOffer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOffer relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithProductOffer() Adds a LEFT JOIN clause and with to the query using the ProductOffer relation
 * @method     ChildSpyMerchantQuery rightJoinWithProductOffer() Adds a RIGHT JOIN clause and with to the query using the ProductOffer relation
 * @method     ChildSpyMerchantQuery innerJoinWithProductOffer() Adds a INNER JOIN clause and with to the query using the ProductOffer relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpySalesPaymentMerchantPayout($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpyMerchantQuery rightJoinSpySalesPaymentMerchantPayout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpyMerchantQuery innerJoinSpySalesPaymentMerchantPayout($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpySalesPaymentMerchantPayout($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesPaymentMerchantPayout relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpySalesPaymentMerchantPayout() Adds a LEFT JOIN clause and with to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpySalesPaymentMerchantPayout() Adds a RIGHT JOIN clause and with to the query using the SpySalesPaymentMerchantPayout relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpySalesPaymentMerchantPayout() Adds a INNER JOIN clause and with to the query using the SpySalesPaymentMerchantPayout relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpySalesPaymentMerchantPayoutReversal($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpyMerchantQuery rightJoinSpySalesPaymentMerchantPayoutReversal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpyMerchantQuery innerJoinSpySalesPaymentMerchantPayoutReversal($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpySalesPaymentMerchantPayoutReversal($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpySalesPaymentMerchantPayoutReversal() Adds a LEFT JOIN clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpySalesPaymentMerchantPayoutReversal() Adds a RIGHT JOIN clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpySalesPaymentMerchantPayoutReversal() Adds a INNER JOIN clause and with to the query using the SpySalesPaymentMerchantPayoutReversal relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyUrl($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyMerchantQuery rightJoinSpyUrl($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUrl relation
 * @method     ChildSpyMerchantQuery innerJoinSpyUrl($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUrl relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyUrl($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyUrl() Adds a LEFT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyUrl() Adds a RIGHT JOIN clause and with to the query using the SpyUrl relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyUrl() Adds a INNER JOIN clause and with to the query using the SpyUrl relation
 *
 * @method     ChildSpyMerchantQuery leftJoinSpyAclEntitySegmentMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyMerchantQuery rightJoinSpyAclEntitySegmentMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyMerchantQuery innerJoinSpyAclEntitySegmentMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
 *
 * @method     ChildSpyMerchantQuery joinWithSpyAclEntitySegmentMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyAclEntitySegmentMerchant relation
 *
 * @method     ChildSpyMerchantQuery leftJoinWithSpyAclEntitySegmentMerchant() Adds a LEFT JOIN clause and with to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyMerchantQuery rightJoinWithSpyAclEntitySegmentMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyAclEntitySegmentMerchant relation
 * @method     ChildSpyMerchantQuery innerJoinWithSpyAclEntitySegmentMerchant() Adds a INNER JOIN clause and with to the query using the SpyAclEntitySegmentMerchant relation
 *
 * @method     \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery|\Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery|\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery|\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery|\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery|\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery|\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery|\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery|\Orm\Zed\MerchantProduct\Persistence\SpyMerchantProductAbstractQuery|\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery|\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery|\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery|\Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery|\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery|\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery|\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery|\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery|\Orm\Zed\Url\Persistence\SpyUrlQuery|\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchant|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchant matching the query
 * @method     ChildSpyMerchant findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchant matching the query, or a new ChildSpyMerchant object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchant|null findOneByIdMerchant(int $id_merchant) Return the first ChildSpyMerchant filtered by the id_merchant column
 * @method     ChildSpyMerchant|null findOneByFkStateMachineProcess(int $fk_state_machine_process) Return the first ChildSpyMerchant filtered by the fk_state_machine_process column
 * @method     ChildSpyMerchant|null findOneByDefaultProductAbstractApprovalStatus(string $default_product_abstract_approval_status) Return the first ChildSpyMerchant filtered by the default_product_abstract_approval_status column
 * @method     ChildSpyMerchant|null findOneByEmail(string $email) Return the first ChildSpyMerchant filtered by the email column
 * @method     ChildSpyMerchant|null findOneByIsActive(boolean $is_active) Return the first ChildSpyMerchant filtered by the is_active column
 * @method     ChildSpyMerchant|null findOneByIsOpenForRelationRequest(boolean $is_open_for_relation_request) Return the first ChildSpyMerchant filtered by the is_open_for_relation_request column
 * @method     ChildSpyMerchant|null findOneByMerchantReference(string $merchant_reference) Return the first ChildSpyMerchant filtered by the merchant_reference column
 * @method     ChildSpyMerchant|null findOneByName(string $name) Return the first ChildSpyMerchant filtered by the name column
 * @method     ChildSpyMerchant|null findOneByRegistrationNumber(string $registration_number) Return the first ChildSpyMerchant filtered by the registration_number column
 * @method     ChildSpyMerchant|null findOneByStatus(string $status) Return the first ChildSpyMerchant filtered by the status column
 * @method     ChildSpyMerchant|null findOneByCreatedAt(string $created_at) Return the first ChildSpyMerchant filtered by the created_at column
 * @method     ChildSpyMerchant|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchant filtered by the updated_at column
 *
 * @method     ChildSpyMerchant requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchant by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchant matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchant requireOneByIdMerchant(int $id_merchant) Return the first ChildSpyMerchant filtered by the id_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByFkStateMachineProcess(int $fk_state_machine_process) Return the first ChildSpyMerchant filtered by the fk_state_machine_process column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByDefaultProductAbstractApprovalStatus(string $default_product_abstract_approval_status) Return the first ChildSpyMerchant filtered by the default_product_abstract_approval_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByEmail(string $email) Return the first ChildSpyMerchant filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByIsActive(boolean $is_active) Return the first ChildSpyMerchant filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByIsOpenForRelationRequest(boolean $is_open_for_relation_request) Return the first ChildSpyMerchant filtered by the is_open_for_relation_request column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByMerchantReference(string $merchant_reference) Return the first ChildSpyMerchant filtered by the merchant_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByName(string $name) Return the first ChildSpyMerchant filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByRegistrationNumber(string $registration_number) Return the first ChildSpyMerchant filtered by the registration_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByStatus(string $status) Return the first ChildSpyMerchant filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByCreatedAt(string $created_at) Return the first ChildSpyMerchant filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchant requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchant filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchant[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchant objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> find(?ConnectionInterface $con = null) Return ChildSpyMerchant objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchant[]|Collection findByIdMerchant(int|array<int> $id_merchant) Return ChildSpyMerchant objects filtered by the id_merchant column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByIdMerchant(int|array<int> $id_merchant) Return ChildSpyMerchant objects filtered by the id_merchant column
 * @method     ChildSpyMerchant[]|Collection findByFkStateMachineProcess(int|array<int> $fk_state_machine_process) Return ChildSpyMerchant objects filtered by the fk_state_machine_process column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByFkStateMachineProcess(int|array<int> $fk_state_machine_process) Return ChildSpyMerchant objects filtered by the fk_state_machine_process column
 * @method     ChildSpyMerchant[]|Collection findByDefaultProductAbstractApprovalStatus(string|array<string> $default_product_abstract_approval_status) Return ChildSpyMerchant objects filtered by the default_product_abstract_approval_status column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByDefaultProductAbstractApprovalStatus(string|array<string> $default_product_abstract_approval_status) Return ChildSpyMerchant objects filtered by the default_product_abstract_approval_status column
 * @method     ChildSpyMerchant[]|Collection findByEmail(string|array<string> $email) Return ChildSpyMerchant objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByEmail(string|array<string> $email) Return ChildSpyMerchant objects filtered by the email column
 * @method     ChildSpyMerchant[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyMerchant objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyMerchant objects filtered by the is_active column
 * @method     ChildSpyMerchant[]|Collection findByIsOpenForRelationRequest(boolean|array<boolean> $is_open_for_relation_request) Return ChildSpyMerchant objects filtered by the is_open_for_relation_request column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByIsOpenForRelationRequest(boolean|array<boolean> $is_open_for_relation_request) Return ChildSpyMerchant objects filtered by the is_open_for_relation_request column
 * @method     ChildSpyMerchant[]|Collection findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpyMerchant objects filtered by the merchant_reference column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpyMerchant objects filtered by the merchant_reference column
 * @method     ChildSpyMerchant[]|Collection findByName(string|array<string> $name) Return ChildSpyMerchant objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByName(string|array<string> $name) Return ChildSpyMerchant objects filtered by the name column
 * @method     ChildSpyMerchant[]|Collection findByRegistrationNumber(string|array<string> $registration_number) Return ChildSpyMerchant objects filtered by the registration_number column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByRegistrationNumber(string|array<string> $registration_number) Return ChildSpyMerchant objects filtered by the registration_number column
 * @method     ChildSpyMerchant[]|Collection findByStatus(string|array<string> $status) Return ChildSpyMerchant objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByStatus(string|array<string> $status) Return ChildSpyMerchant objects filtered by the status column
 * @method     ChildSpyMerchant[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchant objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchant objects filtered by the created_at column
 * @method     ChildSpyMerchant[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchant objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchant> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchant objects filtered by the updated_at column
 *
 * @method     ChildSpyMerchant[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchant> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Merchant\Persistence\Base\SpyMerchantQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantQuery();
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
     * @return ChildSpyMerchant|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchant A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_merchant`, `fk_state_machine_process`, `default_product_abstract_approval_status`, `email`, `is_active`, `is_open_for_relation_request`, `merchant_reference`, `name`, `registration_number`, `status`, `created_at`, `updated_at` FROM `spy_merchant` WHERE `id_merchant` = :p0';
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
            /** @var ChildSpyMerchant $obj */
            $obj = new ChildSpyMerchant();
            $obj->hydrate($row);
            SpyMerchantTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchant|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchant Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchant_Between(array $idMerchant)
    {
        return $this->filterByIdMerchant($idMerchant, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchants Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchant_In(array $idMerchants)
    {
        return $this->filterByIdMerchant($idMerchants, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchant(1234); // WHERE id_merchant = 1234
     * $query->filterByIdMerchant(array(12, 34), Criteria::IN); // WHERE id_merchant IN (12, 34)
     * $query->filterByIdMerchant(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant > 12
     * </code>
     *
     * @param     mixed $idMerchant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchant($idMerchant = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchant)) {
            $useMinMax = false;
            if (isset($idMerchant['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $idMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $idMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $idMerchant, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkStateMachineProcess Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineProcess_Between(array $fkStateMachineProcess)
    {
        return $this->filterByFkStateMachineProcess($fkStateMachineProcess, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkStateMachineProcesss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineProcess_In(array $fkStateMachineProcesss)
    {
        return $this->filterByFkStateMachineProcess($fkStateMachineProcesss, Criteria::IN);
    }

    /**
     * Filter the query on the fk_state_machine_process column
     *
     * Example usage:
     * <code>
     * $query->filterByFkStateMachineProcess(1234); // WHERE fk_state_machine_process = 1234
     * $query->filterByFkStateMachineProcess(array(12, 34), Criteria::IN); // WHERE fk_state_machine_process IN (12, 34)
     * $query->filterByFkStateMachineProcess(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_state_machine_process > 12
     * </code>
     *
     * @see       filterBySpyStateMachineProcess()
     *
     * @param     mixed $fkStateMachineProcess The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkStateMachineProcess($fkStateMachineProcess = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkStateMachineProcess)) {
            $useMinMax = false;
            if (isset($fkStateMachineProcess['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkStateMachineProcess['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkStateMachineProcess of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, $fkStateMachineProcess, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $defaultProductAbstractApprovalStatuss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultProductAbstractApprovalStatus_In(array $defaultProductAbstractApprovalStatuss)
    {
        return $this->filterByDefaultProductAbstractApprovalStatus($defaultProductAbstractApprovalStatuss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $defaultProductAbstractApprovalStatus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultProductAbstractApprovalStatus_Like($defaultProductAbstractApprovalStatus)
    {
        return $this->filterByDefaultProductAbstractApprovalStatus($defaultProductAbstractApprovalStatus, Criteria::LIKE);
    }

    /**
     * Filter the query on the default_product_abstract_approval_status column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultProductAbstractApprovalStatus('fooValue');   // WHERE default_product_abstract_approval_status = 'fooValue'
     * $query->filterByDefaultProductAbstractApprovalStatus('%fooValue%', Criteria::LIKE); // WHERE default_product_abstract_approval_status LIKE '%fooValue%'
     * $query->filterByDefaultProductAbstractApprovalStatus([1, 'foo'], Criteria::IN); // WHERE default_product_abstract_approval_status IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $defaultProductAbstractApprovalStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDefaultProductAbstractApprovalStatus($defaultProductAbstractApprovalStatus = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $defaultProductAbstractApprovalStatus = str_replace('*', '%', $defaultProductAbstractApprovalStatus);
        }

        if (is_array($defaultProductAbstractApprovalStatus) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$defaultProductAbstractApprovalStatus of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS, $defaultProductAbstractApprovalStatus, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $emails Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail_In(array $emails)
    {
        return $this->filterByEmail($emails, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $email Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail_Like($email)
    {
        return $this->filterByEmail($email, Criteria::LIKE);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail([1, 'foo'], Criteria::IN); // WHERE email IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByEmail($email = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $email = str_replace('*', '%', $email);
        }

        if (is_array($email) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$email of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_EMAIL, $email, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_open_for_relation_request column
     *
     * Example usage:
     * <code>
     * $query->filterByIsOpenForRelationRequest(true); // WHERE is_open_for_relation_request = true
     * $query->filterByIsOpenForRelationRequest('yes'); // WHERE is_open_for_relation_request = true
     * </code>
     *
     * @param     bool|string $isOpenForRelationRequest The value to use as filter.
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
    public function filterByIsOpenForRelationRequest($isOpenForRelationRequest = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isOpenForRelationRequest)) {
            $isOpenForRelationRequest = in_array(strtolower($isOpenForRelationRequest), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST, $isOpenForRelationRequest, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_In(array $merchantReferences)
    {
        return $this->filterByMerchantReference($merchantReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $merchantReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_Like($merchantReference)
    {
        return $this->filterByMerchantReference($merchantReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the merchant_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantReference('fooValue');   // WHERE merchant_reference = 'fooValue'
     * $query->filterByMerchantReference('%fooValue%', Criteria::LIKE); // WHERE merchant_reference LIKE '%fooValue%'
     * $query->filterByMerchantReference([1, 'foo'], Criteria::IN); // WHERE merchant_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $merchantReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantReference($merchantReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $merchantReference = str_replace('*', '%', $merchantReference);
        }

        if (is_array($merchantReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$merchantReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_MERCHANT_REFERENCE, $merchantReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $names Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_In(array $names)
    {
        return $this->filterByName($names, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $name Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName_Like($name)
    {
        return $this->filterByName($name, Criteria::LIKE);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName([1, 'foo'], Criteria::IN); // WHERE name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByName($name = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $name = str_replace('*', '%', $name);
        }

        if (is_array($name) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$name of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $registrationNumbers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistrationNumber_In(array $registrationNumbers)
    {
        return $this->filterByRegistrationNumber($registrationNumbers, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $registrationNumber Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistrationNumber_Like($registrationNumber)
    {
        return $this->filterByRegistrationNumber($registrationNumber, Criteria::LIKE);
    }

    /**
     * Filter the query on the registration_number column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistrationNumber('fooValue');   // WHERE registration_number = 'fooValue'
     * $query->filterByRegistrationNumber('%fooValue%', Criteria::LIKE); // WHERE registration_number LIKE '%fooValue%'
     * $query->filterByRegistrationNumber([1, 'foo'], Criteria::IN); // WHERE registration_number IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $registrationNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRegistrationNumber($registrationNumber = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $registrationNumber = str_replace('*', '%', $registrationNumber);
        }

        if (is_array($registrationNumber) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$registrationNumber of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_REGISTRATION_NUMBER, $registrationNumber, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $statuss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus_In(array $statuss)
    {
        return $this->filterByStatus($statuss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $status Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus_Like($status)
    {
        return $this->filterByStatus($status, Criteria::LIKE);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus([1, 'foo'], Criteria::IN); // WHERE status IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByStatus($status = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $status = str_replace('*', '%', $status);
        }

        if (is_array($status) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$status of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_STATUS, $status, $comparison);

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
                $this->addUsingAlias(SpyMerchantTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyMerchantTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess|ObjectCollection $spyStateMachineProcess The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyStateMachineProcess($spyStateMachineProcess, ?string $comparison = null)
    {
        if ($spyStateMachineProcess instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess) {
            return $this
                ->addUsingAlias(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, $spyStateMachineProcess->getIdStateMachineProcess(), $comparison);
        } elseif ($spyStateMachineProcess instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, $spyStateMachineProcess->toKeyValue('PrimaryKey', 'IdStateMachineProcess'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyStateMachineProcess() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcess or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyStateMachineProcess relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyStateMachineProcess(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyStateMachineProcess');

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
            $this->addJoinObject($join, 'SpyStateMachineProcess');
        }

        return $this;
    }

    /**
     * Use the SpyStateMachineProcess relation SpyStateMachineProcess object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery A secondary query class using the current class as primary query
     */
    public function useSpyStateMachineProcessQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyStateMachineProcess($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyStateMachineProcess', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery');
    }

    /**
     * Use the SpyStateMachineProcess relation SpyStateMachineProcess object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyStateMachineProcessQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyStateMachineProcessQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyStateMachineProcess table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the EXISTS statement
     */
    public function useSpyStateMachineProcessExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useExistsQuery('SpyStateMachineProcess', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyStateMachineProcess table for a NOT EXISTS query.
     *
     * @see useSpyStateMachineProcessExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyStateMachineProcessNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useExistsQuery('SpyStateMachineProcess', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyStateMachineProcess table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the IN statement
     */
    public function useInSpyStateMachineProcessQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useInQuery('SpyStateMachineProcess', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyStateMachineProcess table for a NOT IN query.
     *
     * @see useSpyStateMachineProcessInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyStateMachineProcessQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineProcessQuery */
        $q = $this->useInQuery('SpyStateMachineProcess', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier object
     *
     * @param \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier|ObjectCollection $pyzMerchantToSupplier the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPyzMerchantToSupplier($pyzMerchantToSupplier, ?string $comparison = null)
    {
        if ($pyzMerchantToSupplier instanceof \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $pyzMerchantToSupplier->getFkMerchant(), $comparison);

            return $this;
        } elseif ($pyzMerchantToSupplier instanceof ObjectCollection) {
            $this
                ->usePyzMerchantToSupplierQuery()
                ->filterByPrimaryKeys($pyzMerchantToSupplier->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPyzMerchantToSupplier() only accepts arguments of type \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PyzMerchantToSupplier relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPyzMerchantToSupplier(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PyzMerchantToSupplier');

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
            $this->addJoinObject($join, 'PyzMerchantToSupplier');
        }

        return $this;
    }

    /**
     * Use the PyzMerchantToSupplier relation PyzMerchantToSupplier object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery A secondary query class using the current class as primary query
     */
    public function usePyzMerchantToSupplierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPyzMerchantToSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PyzMerchantToSupplier', '\Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery');
    }

    /**
     * Use the PyzMerchantToSupplier relation PyzMerchantToSupplier object
     *
     * @param callable(\Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery):\Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPyzMerchantToSupplierQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePyzMerchantToSupplierQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PyzMerchantToSupplier table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery The inner query object of the EXISTS statement
     */
    public function usePyzMerchantToSupplierExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery */
        $q = $this->useExistsQuery('PyzMerchantToSupplier', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PyzMerchantToSupplier table for a NOT EXISTS query.
     *
     * @see usePyzMerchantToSupplierExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery The inner query object of the NOT EXISTS statement
     */
    public function usePyzMerchantToSupplierNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery */
        $q = $this->useExistsQuery('PyzMerchantToSupplier', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PyzMerchantToSupplier table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery The inner query object of the IN statement
     */
    public function useInPyzMerchantToSupplierQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery */
        $q = $this->useInQuery('PyzMerchantToSupplier', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PyzMerchantToSupplier table for a NOT IN query.
     *
     * @see usePyzMerchantToSupplierInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery The inner query object of the NOT IN statement
     */
    public function useNotInPyzMerchantToSupplierQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery */
        $q = $this->useInQuery('PyzMerchantToSupplier', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchantStore object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchantStore|ObjectCollection $spyMerchantStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantStore($spyMerchantStore, ?string $comparison = null)
    {
        if ($spyMerchantStore instanceof \Orm\Zed\Merchant\Persistence\SpyMerchantStore) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantStore->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantStore instanceof ObjectCollection) {
            $this
                ->useSpyMerchantStoreQuery()
                ->filterByPrimaryKeys($spyMerchantStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantStore() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchantStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantStore');

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
            $this->addJoinObject($join, 'SpyMerchantStore');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantStore relation SpyMerchantStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantStore', '\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery');
    }

    /**
     * Use the SpyMerchantStore relation SpyMerchantStore object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useExistsQuery('SpyMerchantStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStore table for a NOT EXISTS query.
     *
     * @see useSpyMerchantStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useExistsQuery('SpyMerchantStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useInQuery('SpyMerchantStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStore table for a NOT IN query.
     *
     * @see useSpyMerchantStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantStoreQuery */
        $q = $this->useInQuery('SpyMerchantStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus object
     *
     * @param \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus|ObjectCollection $spyMerchantAppOnboardingStatus the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantAppOnboardingStatus($spyMerchantAppOnboardingStatus, ?string $comparison = null)
    {
        if ($spyMerchantAppOnboardingStatus instanceof \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_MERCHANT_REFERENCE, $spyMerchantAppOnboardingStatus->getMerchantReference(), $comparison);

            return $this;
        } elseif ($spyMerchantAppOnboardingStatus instanceof ObjectCollection) {
            $this
                ->useSpyMerchantAppOnboardingStatusQuery()
                ->filterByPrimaryKeys($spyMerchantAppOnboardingStatus->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantAppOnboardingStatus() only accepts arguments of type \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantAppOnboardingStatus relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantAppOnboardingStatus(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantAppOnboardingStatus');

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
            $this->addJoinObject($join, 'SpyMerchantAppOnboardingStatus');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantAppOnboardingStatus relation SpyMerchantAppOnboardingStatus object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantAppOnboardingStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantAppOnboardingStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantAppOnboardingStatus', '\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery');
    }

    /**
     * Use the SpyMerchantAppOnboardingStatus relation SpyMerchantAppOnboardingStatus object
     *
     * @param callable(\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery):\Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantAppOnboardingStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantAppOnboardingStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantAppOnboardingStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useExistsQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for a NOT EXISTS query.
     *
     * @see useSpyMerchantAppOnboardingStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantAppOnboardingStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useExistsQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantAppOnboardingStatusQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useInQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantAppOnboardingStatus table for a NOT IN query.
     *
     * @see useSpyMerchantAppOnboardingStatusInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantAppOnboardingStatusQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantApp\Persistence\SpyMerchantAppOnboardingStatusQuery */
        $q = $this->useInQuery('SpyMerchantAppOnboardingStatus', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory object
     *
     * @param \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory|ObjectCollection $spyMerchantCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantCategory($spyMerchantCategory, ?string $comparison = null)
    {
        if ($spyMerchantCategory instanceof \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantCategory->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantCategory instanceof ObjectCollection) {
            $this
                ->useSpyMerchantCategoryQuery()
                ->filterByPrimaryKeys($spyMerchantCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantCategory() only accepts arguments of type \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantCategory');

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
            $this->addJoinObject($join, 'SpyMerchantCategory');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantCategory relation SpyMerchantCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantCategory', '\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery');
    }

    /**
     * Use the SpyMerchantCategory relation SpyMerchantCategory object
     *
     * @param callable(\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery):\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useExistsQuery('SpyMerchantCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantCategory table for a NOT EXISTS query.
     *
     * @see useSpyMerchantCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useExistsQuery('SpyMerchantCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useInQuery('SpyMerchantCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantCategory table for a NOT IN query.
     *
     * @see useSpyMerchantCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useInQuery('SpyMerchantCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant|ObjectCollection $spyMerchantCommissionMerchant the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommission($spyMerchantCommissionMerchant, ?string $comparison = null)
    {
        if ($spyMerchantCommissionMerchant instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantCommissionMerchant->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantCommissionMerchant instanceof ObjectCollection) {
            $this
                ->useMerchantCommissionQuery()
                ->filterByPrimaryKeys($spyMerchantCommissionMerchant->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommission() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommission relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommission(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommission');

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
            $this->addJoinObject($join, 'MerchantCommission');
        }

        return $this;
    }

    /**
     * Use the MerchantCommission relation SpyMerchantCommissionMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommission($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommission', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery');
    }

    /**
     * Use the MerchantCommission relation SpyMerchantCommissionMerchant object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useExistsQuery('MerchantCommission', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionMerchant table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useExistsQuery('MerchantCommission', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useInQuery('MerchantCommission', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommission relation to the SpyMerchantCommissionMerchant table for a NOT IN query.
     *
     * @see useMerchantCommissionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useInQuery('MerchantCommission', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule object
     *
     * @param \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule|ObjectCollection $spyMerchantOpeningHoursWeekdaySchedule the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantOpeningHoursWeekdaySchedule($spyMerchantOpeningHoursWeekdaySchedule, ?string $comparison = null)
    {
        if ($spyMerchantOpeningHoursWeekdaySchedule instanceof \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantOpeningHoursWeekdaySchedule->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantOpeningHoursWeekdaySchedule instanceof ObjectCollection) {
            $this
                ->useSpyMerchantOpeningHoursWeekdayScheduleQuery()
                ->filterByPrimaryKeys($spyMerchantOpeningHoursWeekdaySchedule->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantOpeningHoursWeekdaySchedule() only accepts arguments of type \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdaySchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantOpeningHoursWeekdaySchedule relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantOpeningHoursWeekdaySchedule(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantOpeningHoursWeekdaySchedule');

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
            $this->addJoinObject($join, 'SpyMerchantOpeningHoursWeekdaySchedule');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantOpeningHoursWeekdaySchedule relation SpyMerchantOpeningHoursWeekdaySchedule object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantOpeningHoursWeekdayScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantOpeningHoursWeekdaySchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantOpeningHoursWeekdaySchedule', '\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery');
    }

    /**
     * Use the SpyMerchantOpeningHoursWeekdaySchedule relation SpyMerchantOpeningHoursWeekdaySchedule object
     *
     * @param callable(\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery):\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantOpeningHoursWeekdayScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantOpeningHoursWeekdayScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursWeekdaySchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantOpeningHoursWeekdayScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery */
        $q = $this->useExistsQuery('SpyMerchantOpeningHoursWeekdaySchedule', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursWeekdaySchedule table for a NOT EXISTS query.
     *
     * @see useSpyMerchantOpeningHoursWeekdayScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantOpeningHoursWeekdayScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery */
        $q = $this->useExistsQuery('SpyMerchantOpeningHoursWeekdaySchedule', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursWeekdaySchedule table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantOpeningHoursWeekdayScheduleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery */
        $q = $this->useInQuery('SpyMerchantOpeningHoursWeekdaySchedule', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursWeekdaySchedule table for a NOT IN query.
     *
     * @see useSpyMerchantOpeningHoursWeekdayScheduleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantOpeningHoursWeekdayScheduleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursWeekdayScheduleQuery */
        $q = $this->useInQuery('SpyMerchantOpeningHoursWeekdaySchedule', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule object
     *
     * @param \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule|ObjectCollection $spyMerchantOpeningHoursDateSchedule the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantOpeningHoursDateSchedule($spyMerchantOpeningHoursDateSchedule, ?string $comparison = null)
    {
        if ($spyMerchantOpeningHoursDateSchedule instanceof \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantOpeningHoursDateSchedule->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantOpeningHoursDateSchedule instanceof ObjectCollection) {
            $this
                ->useSpyMerchantOpeningHoursDateScheduleQuery()
                ->filterByPrimaryKeys($spyMerchantOpeningHoursDateSchedule->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantOpeningHoursDateSchedule() only accepts arguments of type \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateSchedule or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantOpeningHoursDateSchedule relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantOpeningHoursDateSchedule(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantOpeningHoursDateSchedule');

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
            $this->addJoinObject($join, 'SpyMerchantOpeningHoursDateSchedule');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantOpeningHoursDateSchedule relation SpyMerchantOpeningHoursDateSchedule object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantOpeningHoursDateScheduleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantOpeningHoursDateSchedule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantOpeningHoursDateSchedule', '\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery');
    }

    /**
     * Use the SpyMerchantOpeningHoursDateSchedule relation SpyMerchantOpeningHoursDateSchedule object
     *
     * @param callable(\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery):\Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantOpeningHoursDateScheduleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantOpeningHoursDateScheduleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursDateSchedule table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantOpeningHoursDateScheduleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery */
        $q = $this->useExistsQuery('SpyMerchantOpeningHoursDateSchedule', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursDateSchedule table for a NOT EXISTS query.
     *
     * @see useSpyMerchantOpeningHoursDateScheduleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantOpeningHoursDateScheduleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery */
        $q = $this->useExistsQuery('SpyMerchantOpeningHoursDateSchedule', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursDateSchedule table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantOpeningHoursDateScheduleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery */
        $q = $this->useInQuery('SpyMerchantOpeningHoursDateSchedule', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantOpeningHoursDateSchedule table for a NOT IN query.
     *
     * @see useSpyMerchantOpeningHoursDateScheduleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantOpeningHoursDateScheduleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantOpeningHours\Persistence\SpyMerchantOpeningHoursDateScheduleQuery */
        $q = $this->useInQuery('SpyMerchantOpeningHoursDateSchedule', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantProductAbstract->getFkMerchant(), $comparison);

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
     * Filter the query by a related \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile object
     *
     * @param \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile|ObjectCollection $spyMerchantProfile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantProfile($spyMerchantProfile, ?string $comparison = null)
    {
        if ($spyMerchantProfile instanceof \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantProfile->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantProfile instanceof ObjectCollection) {
            $this
                ->useSpyMerchantProfileQuery()
                ->filterByPrimaryKeys($spyMerchantProfile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantProfile() only accepts arguments of type \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantProfile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantProfile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantProfile');

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
            $this->addJoinObject($join, 'SpyMerchantProfile');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantProfile relation SpyMerchantProfile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantProfileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantProfile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantProfile', '\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery');
    }

    /**
     * Use the SpyMerchantProfile relation SpyMerchantProfile object
     *
     * @param callable(\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery):\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantProfileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantProfileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantProfile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantProfileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useExistsQuery('SpyMerchantProfile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfile table for a NOT EXISTS query.
     *
     * @see useSpyMerchantProfileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantProfileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useExistsQuery('SpyMerchantProfile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantProfileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useInQuery('SpyMerchantProfile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfile table for a NOT IN query.
     *
     * @see useSpyMerchantProfileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantProfileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery */
        $q = $this->useInQuery('SpyMerchantProfile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest object
     *
     * @param \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest|ObjectCollection $spyMerchantRelationRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRelationRequest($spyMerchantRelationRequest, ?string $comparison = null)
    {
        if ($spyMerchantRelationRequest instanceof \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantRelationRequest->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantRelationRequest instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRelationRequestQuery()
                ->filterByPrimaryKeys($spyMerchantRelationRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRelationRequest() only accepts arguments of type \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRelationRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRelationRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRelationRequest');

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
            $this->addJoinObject($join, 'SpyMerchantRelationRequest');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRelationRequest relation SpyMerchantRelationRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRelationRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRelationRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRelationRequest', '\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery');
    }

    /**
     * Use the SpyMerchantRelationRequest relation SpyMerchantRelationRequest object
     *
     * @param callable(\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery):\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRelationRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRelationRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRelationRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRelationRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationRequest table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRelationRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRelationRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRelationRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery */
        $q = $this->useInQuery('SpyMerchantRelationRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationRequest table for a NOT IN query.
     *
     * @see useSpyMerchantRelationRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRelationRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery */
        $q = $this->useInQuery('SpyMerchantRelationRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship object
     *
     * @param \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship|ObjectCollection $spyMerchantRelationship the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRelationship($spyMerchantRelationship, ?string $comparison = null)
    {
        if ($spyMerchantRelationship instanceof \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantRelationship->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantRelationship instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRelationshipQuery()
                ->filterByPrimaryKeys($spyMerchantRelationship->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRelationship() only accepts arguments of type \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRelationship relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRelationship(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRelationship');

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
            $this->addJoinObject($join, 'SpyMerchantRelationship');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRelationship relation SpyMerchantRelationship object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRelationshipQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRelationship($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRelationship', '\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery');
    }

    /**
     * Use the SpyMerchantRelationship relation SpyMerchantRelationship object
     *
     * @param callable(\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery):\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRelationshipQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRelationshipQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRelationshipExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationship', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRelationshipExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRelationshipNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationship', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRelationshipQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useInQuery('SpyMerchantRelationship', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationship table for a NOT IN query.
     *
     * @see useSpyMerchantRelationshipInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRelationshipQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery */
        $q = $this->useInQuery('SpyMerchantRelationship', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantStock\Persistence\SpyMerchantStock object
     *
     * @param \Orm\Zed\MerchantStock\Persistence\SpyMerchantStock|ObjectCollection $spyMerchantStock the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantStock($spyMerchantStock, ?string $comparison = null)
    {
        if ($spyMerchantStock instanceof \Orm\Zed\MerchantStock\Persistence\SpyMerchantStock) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantStock->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantStock instanceof ObjectCollection) {
            $this
                ->useSpyMerchantStockQuery()
                ->filterByPrimaryKeys($spyMerchantStock->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantStock() only accepts arguments of type \Orm\Zed\MerchantStock\Persistence\SpyMerchantStock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantStock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantStock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantStock');

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
            $this->addJoinObject($join, 'SpyMerchantStock');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantStock relation SpyMerchantStock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantStock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantStock', '\Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery');
    }

    /**
     * Use the SpyMerchantStock relation SpyMerchantStock object
     *
     * @param callable(\Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery):\Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantStockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantStockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantStock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantStockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery */
        $q = $this->useExistsQuery('SpyMerchantStock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStock table for a NOT EXISTS query.
     *
     * @see useSpyMerchantStockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantStockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery */
        $q = $this->useExistsQuery('SpyMerchantStock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantStockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery */
        $q = $this->useInQuery('SpyMerchantStock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantStock table for a NOT IN query.
     *
     * @see useSpyMerchantStockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantStockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantStock\Persistence\SpyMerchantStockQuery */
        $q = $this->useInQuery('SpyMerchantStock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser object
     *
     * @param \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser|ObjectCollection $spyMerchantUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantUser($spyMerchantUser, ?string $comparison = null)
    {
        if ($spyMerchantUser instanceof \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchantUser->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyMerchantUser instanceof ObjectCollection) {
            $this
                ->useSpyMerchantUserQuery()
                ->filterByPrimaryKeys($spyMerchantUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantUser() only accepts arguments of type \Orm\Zed\MerchantUser\Persistence\SpyMerchantUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantUser');

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
            $this->addJoinObject($join, 'SpyMerchantUser');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantUser relation SpyMerchantUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantUser', '\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery');
    }

    /**
     * Use the SpyMerchantUser relation SpyMerchantUser object
     *
     * @param callable(\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery):\Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useExistsQuery('SpyMerchantUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantUser table for a NOT EXISTS query.
     *
     * @see useSpyMerchantUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useExistsQuery('SpyMerchantUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useInQuery('SpyMerchantUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantUser table for a NOT IN query.
     *
     * @see useSpyMerchantUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantUser\Persistence\SpyMerchantUserQuery */
        $q = $this->useInQuery('SpyMerchantUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOffer\Persistence\SpyProductOffer object
     *
     * @param \Orm\Zed\ProductOffer\Persistence\SpyProductOffer|ObjectCollection $spyProductOffer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOffer($spyProductOffer, ?string $comparison = null)
    {
        if ($spyProductOffer instanceof \Orm\Zed\ProductOffer\Persistence\SpyProductOffer) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_MERCHANT_REFERENCE, $spyProductOffer->getMerchantReference(), $comparison);

            return $this;
        } elseif ($spyProductOffer instanceof ObjectCollection) {
            $this
                ->useProductOfferQuery()
                ->filterByPrimaryKeys($spyProductOffer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOffer() only accepts arguments of type \Orm\Zed\ProductOffer\Persistence\SpyProductOffer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOffer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOffer(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOffer');

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
            $this->addJoinObject($join, 'ProductOffer');
        }

        return $this;
    }

    /**
     * Use the ProductOffer relation SpyProductOffer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery A secondary query class using the current class as primary query
     */
    public function useProductOfferQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProductOffer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOffer', '\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery');
    }

    /**
     * Use the ProductOffer relation SpyProductOffer object
     *
     * @param callable(\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery):\Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOfferQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useProductOfferQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the EXISTS statement
     */
    public function useProductOfferExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useExistsQuery('ProductOffer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for a NOT EXISTS query.
     *
     * @see useProductOfferExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOfferNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useExistsQuery('ProductOffer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the IN statement
     */
    public function useInProductOfferQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useInQuery('ProductOffer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOffer relation to the SpyProductOffer table for a NOT IN query.
     *
     * @see useProductOfferInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOfferQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery */
        $q = $this->useInQuery('ProductOffer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout object
     *
     * @param \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout|ObjectCollection $spySalesPaymentMerchantPayout the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesPaymentMerchantPayout($spySalesPaymentMerchantPayout, ?string $comparison = null)
    {
        if ($spySalesPaymentMerchantPayout instanceof \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_MERCHANT_REFERENCE, $spySalesPaymentMerchantPayout->getMerchantReference(), $comparison);

            return $this;
        } elseif ($spySalesPaymentMerchantPayout instanceof ObjectCollection) {
            $this
                ->useSpySalesPaymentMerchantPayoutQuery()
                ->filterByPrimaryKeys($spySalesPaymentMerchantPayout->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesPaymentMerchantPayout() only accepts arguments of type \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayout or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesPaymentMerchantPayout relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesPaymentMerchantPayout(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesPaymentMerchantPayout');

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
            $this->addJoinObject($join, 'SpySalesPaymentMerchantPayout');
        }

        return $this;
    }

    /**
     * Use the SpySalesPaymentMerchantPayout relation SpySalesPaymentMerchantPayout object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesPaymentMerchantPayoutQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySalesPaymentMerchantPayout($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesPaymentMerchantPayout', '\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery');
    }

    /**
     * Use the SpySalesPaymentMerchantPayout relation SpySalesPaymentMerchantPayout object
     *
     * @param callable(\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery):\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesPaymentMerchantPayoutQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySalesPaymentMerchantPayoutQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for a NOT EXISTS query.
     *
     * @see useSpySalesPaymentMerchantPayoutExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the IN statement
     */
    public function useInSpySalesPaymentMerchantPayoutQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayout table for a NOT IN query.
     *
     * @see useSpySalesPaymentMerchantPayoutInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesPaymentMerchantPayoutQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayout', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal object
     *
     * @param \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal|ObjectCollection $spySalesPaymentMerchantPayoutReversal the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySalesPaymentMerchantPayoutReversal($spySalesPaymentMerchantPayoutReversal, ?string $comparison = null)
    {
        if ($spySalesPaymentMerchantPayoutReversal instanceof \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_MERCHANT_REFERENCE, $spySalesPaymentMerchantPayoutReversal->getMerchantReference(), $comparison);

            return $this;
        } elseif ($spySalesPaymentMerchantPayoutReversal instanceof ObjectCollection) {
            $this
                ->useSpySalesPaymentMerchantPayoutReversalQuery()
                ->filterByPrimaryKeys($spySalesPaymentMerchantPayoutReversal->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySalesPaymentMerchantPayoutReversal() only accepts arguments of type \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversal or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySalesPaymentMerchantPayoutReversal relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySalesPaymentMerchantPayoutReversal(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySalesPaymentMerchantPayoutReversal');

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
            $this->addJoinObject($join, 'SpySalesPaymentMerchantPayoutReversal');
        }

        return $this;
    }

    /**
     * Use the SpySalesPaymentMerchantPayoutReversal relation SpySalesPaymentMerchantPayoutReversal object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery A secondary query class using the current class as primary query
     */
    public function useSpySalesPaymentMerchantPayoutReversalQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySalesPaymentMerchantPayoutReversal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySalesPaymentMerchantPayoutReversal', '\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery');
    }

    /**
     * Use the SpySalesPaymentMerchantPayoutReversal relation SpySalesPaymentMerchantPayoutReversal object
     *
     * @param callable(\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery):\Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySalesPaymentMerchantPayoutReversalQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySalesPaymentMerchantPayoutReversalQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutReversalExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for a NOT EXISTS query.
     *
     * @see useSpySalesPaymentMerchantPayoutReversalExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySalesPaymentMerchantPayoutReversalNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useExistsQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the IN statement
     */
    public function useInSpySalesPaymentMerchantPayoutReversalQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySalesPaymentMerchantPayoutReversal table for a NOT IN query.
     *
     * @see useSpySalesPaymentMerchantPayoutReversalInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySalesPaymentMerchantPayoutReversalQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SalesPaymentMerchant\Persistence\SpySalesPaymentMerchantPayoutReversalQuery */
        $q = $this->useInQuery('SpySalesPaymentMerchantPayoutReversal', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyUrl->getFkResourceMerchant(), $comparison);

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
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant|ObjectCollection $spyAclEntitySegmentMerchant the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyAclEntitySegmentMerchant($spyAclEntitySegmentMerchant, ?string $comparison = null)
    {
        if ($spyAclEntitySegmentMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant) {
            $this
                ->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyAclEntitySegmentMerchant->getFkMerchant(), $comparison);

            return $this;
        } elseif ($spyAclEntitySegmentMerchant instanceof ObjectCollection) {
            $this
                ->useSpyAclEntitySegmentMerchantQuery()
                ->filterByPrimaryKeys($spyAclEntitySegmentMerchant->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyAclEntitySegmentMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyAclEntitySegmentMerchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyAclEntitySegmentMerchant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyAclEntitySegmentMerchant');

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
            $this->addJoinObject($join, 'SpyAclEntitySegmentMerchant');
        }

        return $this;
    }

    /**
     * Use the SpyAclEntitySegmentMerchant relation SpyAclEntitySegmentMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery A secondary query class using the current class as primary query
     */
    public function useSpyAclEntitySegmentMerchantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyAclEntitySegmentMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyAclEntitySegmentMerchant', '\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery');
    }

    /**
     * Use the SpyAclEntitySegmentMerchant relation SpyAclEntitySegmentMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyAclEntitySegmentMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyAclEntitySegmentMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the EXISTS statement
     */
    public function useSpyAclEntitySegmentMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for a NOT EXISTS query.
     *
     * @see useSpyAclEntitySegmentMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyAclEntitySegmentMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useExistsQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the IN statement
     */
    public function useInSpyAclEntitySegmentMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useInQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyAclEntitySegmentMerchant table for a NOT IN query.
     *
     * @see useSpyAclEntitySegmentMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyAclEntitySegmentMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyAclEntitySegmentMerchantQuery */
        $q = $this->useInQuery('SpyAclEntitySegmentMerchant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchant $spyMerchant Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchant = null)
    {
        if ($spyMerchant) {
            $this->addUsingAlias(SpyMerchantTableMap::COL_ID_MERCHANT, $spyMerchant->getIdMerchant(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantTableMap::clearInstancePool();
            SpyMerchantTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyMerchantTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyMerchantTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantTableMap::COL_CREATED_AT);

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
