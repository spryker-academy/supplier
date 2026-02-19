<?php

namespace Orm\Zed\CompanyUser\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser as ChildSpyCompanyUser;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery as ChildSpyCompanyUserQuery;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser;
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
 * Base class that represents a query for the `spy_company_user` table.
 *
 * @method     ChildSpyCompanyUserQuery orderByIdCompanyUser($order = Criteria::ASC) Order by the id_company_user column
 * @method     ChildSpyCompanyUserQuery orderByFkCompany($order = Criteria::ASC) Order by the fk_company column
 * @method     ChildSpyCompanyUserQuery orderByFkCompanyBusinessUnit($order = Criteria::ASC) Order by the fk_company_business_unit column
 * @method     ChildSpyCompanyUserQuery orderByFkCustomer($order = Criteria::ASC) Order by the fk_customer column
 * @method     ChildSpyCompanyUserQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyCompanyUserQuery orderByIsDefault($order = Criteria::ASC) Order by the is_default column
 * @method     ChildSpyCompanyUserQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyCompanyUserQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyCompanyUserQuery groupByIdCompanyUser() Group by the id_company_user column
 * @method     ChildSpyCompanyUserQuery groupByFkCompany() Group by the fk_company column
 * @method     ChildSpyCompanyUserQuery groupByFkCompanyBusinessUnit() Group by the fk_company_business_unit column
 * @method     ChildSpyCompanyUserQuery groupByFkCustomer() Group by the fk_customer column
 * @method     ChildSpyCompanyUserQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyCompanyUserQuery groupByIsDefault() Group by the is_default column
 * @method     ChildSpyCompanyUserQuery groupByKey() Group by the key column
 * @method     ChildSpyCompanyUserQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyCompanyUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCompanyUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCompanyUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCompanyUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCompanyUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCompanyUserQuery leftJoinCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyCompanyUserQuery rightJoinCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyCompanyUserQuery innerJoinCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the CompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyUserQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyUserQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinCustomer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Customer relation
 * @method     ChildSpyCompanyUserQuery rightJoinCustomer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Customer relation
 * @method     ChildSpyCompanyUserQuery innerJoinCustomer($relationAlias = null) Adds a INNER JOIN clause to the query using the Customer relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithCustomer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Customer relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithCustomer() Adds a LEFT JOIN clause and with to the query using the Customer relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithCustomer() Adds a RIGHT JOIN clause and with to the query using the Customer relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithCustomer() Adds a INNER JOIN clause and with to the query using the Customer relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyCompanyUserFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyCompanyUserFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyCompanyUserFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUserFile relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyCompanyUserFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUserFile relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyCompanyUserFile() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyCompanyUserFile() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUserFile relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyCompanyUserFile() Adds a INNER JOIN clause and with to the query using the SpyCompanyUserFile relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyCompanyRoleToCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyCompanyRoleToCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyCompanyRoleToCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyCompanyRoleToCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyCompanyRoleToCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyCompanyRoleToCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyCompanyRoleToCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyCompanyRoleToCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyCompanyUserInvitation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyCompanyUserInvitation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyCompanyUserInvitation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUserInvitation relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyCompanyUserInvitation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUserInvitation relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyCompanyUserInvitation() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyCompanyUserInvitation() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyCompanyUserInvitation() Adds a INNER JOIN clause and with to the query using the SpyCompanyUserInvitation relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyQuoteCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyQuoteCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyQuoteCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuoteCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyQuoteCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuoteCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyQuoteCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyQuoteCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyQuoteCompanyUser relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyQuoteCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyQuoteCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyMerchantRelationRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyMerchantRelationRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyMerchantRelationRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyMerchantRelationRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyMerchantRelationRequest() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyMerchantRelationRequest() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyMerchantRelationRequest() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyQuoteApproval($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuoteApproval relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyQuoteApproval($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuoteApproval relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyQuoteApproval($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuoteApproval relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyQuoteApproval($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuoteApproval relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyQuoteApproval() Adds a LEFT JOIN clause and with to the query using the SpyQuoteApproval relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyQuoteApproval() Adds a RIGHT JOIN clause and with to the query using the SpyQuoteApproval relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyQuoteApproval() Adds a INNER JOIN clause and with to the query using the SpyQuoteApproval relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyQuoteRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyQuoteRequest relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyQuoteRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyQuoteRequest relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyQuoteRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyQuoteRequest relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyQuoteRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyQuoteRequest relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyQuoteRequest() Adds a LEFT JOIN clause and with to the query using the SpyQuoteRequest relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyQuoteRequest() Adds a RIGHT JOIN clause and with to the query using the SpyQuoteRequest relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyQuoteRequest() Adds a INNER JOIN clause and with to the query using the SpyQuoteRequest relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpySspInquiry($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquiry relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpySspInquiry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquiry relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpySspInquiry($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquiry relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpySspInquiry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquiry relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpySspInquiry() Adds a LEFT JOIN clause and with to the query using the SpySspInquiry relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpySspInquiry() Adds a RIGHT JOIN clause and with to the query using the SpySspInquiry relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpySspInquiry() Adds a INNER JOIN clause and with to the query using the SpySspInquiry relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyShoppingListCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListCompanyUser relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyShoppingListCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListCompanyUser relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyShoppingListCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyShoppingListCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyShoppingListCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListCompanyUser relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyShoppingListCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListCompanyUser relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyShoppingListCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyShoppingListCompanyUser relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinSpyShoppingListCompanyBusinessUnitBlacklist($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 * @method     ChildSpyCompanyUserQuery rightJoinSpyShoppingListCompanyBusinessUnitBlacklist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 * @method     ChildSpyCompanyUserQuery innerJoinSpyShoppingListCompanyBusinessUnitBlacklist($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 *
 * @method     ChildSpyCompanyUserQuery joinWithSpyShoppingListCompanyBusinessUnitBlacklist($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 *
 * @method     ChildSpyCompanyUserQuery leftJoinWithSpyShoppingListCompanyBusinessUnitBlacklist() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 * @method     ChildSpyCompanyUserQuery rightJoinWithSpyShoppingListCompanyBusinessUnitBlacklist() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 * @method     ChildSpyCompanyUserQuery innerJoinWithSpyShoppingListCompanyBusinessUnitBlacklist() Adds a INNER JOIN clause and with to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
 *
 * @method     \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery|\Orm\Zed\Company\Persistence\SpyCompanyQuery|\Orm\Zed\Customer\Persistence\SpyCustomerQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery|\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery|\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery|\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery|\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery|\Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery|\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery|\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery|\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCompanyUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyUser matching the query
 * @method     ChildSpyCompanyUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCompanyUser matching the query, or a new ChildSpyCompanyUser object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCompanyUser|null findOneByIdCompanyUser(int $id_company_user) Return the first ChildSpyCompanyUser filtered by the id_company_user column
 * @method     ChildSpyCompanyUser|null findOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyUser filtered by the fk_company column
 * @method     ChildSpyCompanyUser|null findOneByFkCompanyBusinessUnit(int $fk_company_business_unit) Return the first ChildSpyCompanyUser filtered by the fk_company_business_unit column
 * @method     ChildSpyCompanyUser|null findOneByFkCustomer(int $fk_customer) Return the first ChildSpyCompanyUser filtered by the fk_customer column
 * @method     ChildSpyCompanyUser|null findOneByIsActive(boolean $is_active) Return the first ChildSpyCompanyUser filtered by the is_active column
 * @method     ChildSpyCompanyUser|null findOneByIsDefault(boolean $is_default) Return the first ChildSpyCompanyUser filtered by the is_default column
 * @method     ChildSpyCompanyUser|null findOneByKey(string $key) Return the first ChildSpyCompanyUser filtered by the key column
 * @method     ChildSpyCompanyUser|null findOneByUuid(string $uuid) Return the first ChildSpyCompanyUser filtered by the uuid column
 *
 * @method     ChildSpyCompanyUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCompanyUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyUser requireOneByIdCompanyUser(int $id_company_user) Return the first ChildSpyCompanyUser filtered by the id_company_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyUser filtered by the fk_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByFkCompanyBusinessUnit(int $fk_company_business_unit) Return the first ChildSpyCompanyUser filtered by the fk_company_business_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByFkCustomer(int $fk_customer) Return the first ChildSpyCompanyUser filtered by the fk_customer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByIsActive(boolean $is_active) Return the first ChildSpyCompanyUser filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByIsDefault(boolean $is_default) Return the first ChildSpyCompanyUser filtered by the is_default column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByKey(string $key) Return the first ChildSpyCompanyUser filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUser requireOneByUuid(string $uuid) Return the first ChildSpyCompanyUser filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCompanyUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> find(?ConnectionInterface $con = null) Return ChildSpyCompanyUser objects based on current ModelCriteria
 *
 * @method     ChildSpyCompanyUser[]|Collection findByIdCompanyUser(int|array<int> $id_company_user) Return ChildSpyCompanyUser objects filtered by the id_company_user column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByIdCompanyUser(int|array<int> $id_company_user) Return ChildSpyCompanyUser objects filtered by the id_company_user column
 * @method     ChildSpyCompanyUser[]|Collection findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyUser objects filtered by the fk_company column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyUser objects filtered by the fk_company column
 * @method     ChildSpyCompanyUser[]|Collection findByFkCompanyBusinessUnit(int|array<int> $fk_company_business_unit) Return ChildSpyCompanyUser objects filtered by the fk_company_business_unit column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByFkCompanyBusinessUnit(int|array<int> $fk_company_business_unit) Return ChildSpyCompanyUser objects filtered by the fk_company_business_unit column
 * @method     ChildSpyCompanyUser[]|Collection findByFkCustomer(int|array<int> $fk_customer) Return ChildSpyCompanyUser objects filtered by the fk_customer column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByFkCustomer(int|array<int> $fk_customer) Return ChildSpyCompanyUser objects filtered by the fk_customer column
 * @method     ChildSpyCompanyUser[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyCompanyUser objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyCompanyUser objects filtered by the is_active column
 * @method     ChildSpyCompanyUser[]|Collection findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyCompanyUser objects filtered by the is_default column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByIsDefault(boolean|array<boolean> $is_default) Return ChildSpyCompanyUser objects filtered by the is_default column
 * @method     ChildSpyCompanyUser[]|Collection findByKey(string|array<string> $key) Return ChildSpyCompanyUser objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByKey(string|array<string> $key) Return ChildSpyCompanyUser objects filtered by the key column
 * @method     ChildSpyCompanyUser[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyCompanyUser objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUser> findByUuid(string|array<string> $uuid) Return ChildSpyCompanyUser objects filtered by the uuid column
 *
 * @method     ChildSpyCompanyUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCompanyUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCompanyUserQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CompanyUser\Persistence\Base\SpyCompanyUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCompanyUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCompanyUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCompanyUserQuery) {
            return $criteria;
        }
        $query = new ChildSpyCompanyUserQuery();
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
     * @return ChildSpyCompanyUser|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCompanyUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCompanyUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_company_user`, `fk_company`, `fk_company_business_unit`, `fk_customer`, `is_active`, `is_default`, `key`, `uuid` FROM `spy_company_user` WHERE `id_company_user` = :p0';
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
            /** @var ChildSpyCompanyUser $obj */
            $obj = new ChildSpyCompanyUser();
            $obj->hydrate($row);
            SpyCompanyUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCompanyUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCompanyUser Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyUser_Between(array $idCompanyUser)
    {
        return $this->filterByIdCompanyUser($idCompanyUser, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCompanyUsers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyUser_In(array $idCompanyUsers)
    {
        return $this->filterByIdCompanyUser($idCompanyUsers, Criteria::IN);
    }

    /**
     * Filter the query on the id_company_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompanyUser(1234); // WHERE id_company_user = 1234
     * $query->filterByIdCompanyUser(array(12, 34), Criteria::IN); // WHERE id_company_user IN (12, 34)
     * $query->filterByIdCompanyUser(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_company_user > 12
     * </code>
     *
     * @param     mixed $idCompanyUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCompanyUser($idCompanyUser = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCompanyUser)) {
            $useMinMax = false;
            if (isset($idCompanyUser['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $idCompanyUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompanyUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $idCompanyUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCompanyUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $idCompanyUser, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCompany Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompany_Between(array $fkCompany)
    {
        return $this->filterByFkCompany($fkCompany, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCompanys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompany_In(array $fkCompanys)
    {
        return $this->filterByFkCompany($fkCompanys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_company column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCompany(1234); // WHERE fk_company = 1234
     * $query->filterByFkCompany(array(12, 34), Criteria::IN); // WHERE fk_company IN (12, 34)
     * $query->filterByFkCompany(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_company > 12
     * </code>
     *
     * @see       filterByCompany()
     *
     * @param     mixed $fkCompany The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCompany($fkCompany = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCompany)) {
            $useMinMax = false;
            if (isset($fkCompany['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY, $fkCompany['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompany['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY, $fkCompany['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompany of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY, $fkCompany, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCompanyBusinessUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyBusinessUnit_Between(array $fkCompanyBusinessUnit)
    {
        return $this->filterByFkCompanyBusinessUnit($fkCompanyBusinessUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCompanyBusinessUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyBusinessUnit_In(array $fkCompanyBusinessUnits)
    {
        return $this->filterByFkCompanyBusinessUnit($fkCompanyBusinessUnits, Criteria::IN);
    }

    /**
     * Filter the query on the fk_company_business_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCompanyBusinessUnit(1234); // WHERE fk_company_business_unit = 1234
     * $query->filterByFkCompanyBusinessUnit(array(12, 34), Criteria::IN); // WHERE fk_company_business_unit IN (12, 34)
     * $query->filterByFkCompanyBusinessUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_company_business_unit > 12
     * </code>
     *
     * @see       filterByCompanyBusinessUnit()
     *
     * @param     mixed $fkCompanyBusinessUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCompanyBusinessUnit($fkCompanyBusinessUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCompanyBusinessUnit)) {
            $useMinMax = false;
            if (isset($fkCompanyBusinessUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $fkCompanyBusinessUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyBusinessUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $fkCompanyBusinessUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyBusinessUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $fkCompanyBusinessUnit, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCustomer Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCustomer_Between(array $fkCustomer)
    {
        return $this->filterByFkCustomer($fkCustomer, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCustomers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCustomer_In(array $fkCustomers)
    {
        return $this->filterByFkCustomer($fkCustomers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_customer column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCustomer(1234); // WHERE fk_customer = 1234
     * $query->filterByFkCustomer(array(12, 34), Criteria::IN); // WHERE fk_customer IN (12, 34)
     * $query->filterByFkCustomer(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_customer > 12
     * </code>
     *
     * @see       filterByCustomer()
     *
     * @param     mixed $fkCustomer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCustomer($fkCustomer = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCustomer)) {
            $useMinMax = false;
            if (isset($fkCustomer['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_CUSTOMER, $fkCustomer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCustomer['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_CUSTOMER, $fkCustomer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCustomer of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_FK_CUSTOMER, $fkCustomer, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_default column
     *
     * Example usage:
     * <code>
     * $query->filterByIsDefault(true); // WHERE is_default = true
     * $query->filterByIsDefault('yes'); // WHERE is_default = true
     * </code>
     *
     * @param     bool|string $isDefault The value to use as filter.
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
    public function filterByIsDefault($isDefault = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isDefault)) {
            $isDefault = in_array(strtolower($isDefault), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_IS_DEFAULT, $isDefault, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $keys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_In(array $keys)
    {
        return $this->filterByKey($keys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $key Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_Like($key)
    {
        return $this->filterByKey($key, Criteria::LIKE);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey([1, 'foo'], Criteria::IN); // WHERE key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $key The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByKey($key = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $key = str_replace('*', '%', $key);
        }

        if (is_array($key) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$key of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUserTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit object
     *
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit|ObjectCollection $spyCompanyBusinessUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyBusinessUnit($spyCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnit instanceof \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit) {
            return $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->getIdCompanyBusinessUnit(), $comparison);
        } elseif ($spyCompanyBusinessUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->toKeyValue('PrimaryKey', 'IdCompanyBusinessUnit'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyBusinessUnit');

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
            $this->addJoinObject($join, 'CompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the CompanyBusinessUnit relation SpyCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyBusinessUnit', '\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery');
    }

    /**
     * Use the CompanyBusinessUnit relation SpyCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery):\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('CompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('CompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('CompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('CompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Company\Persistence\SpyCompany object
     *
     * @param \Orm\Zed\Company\Persistence\SpyCompany|ObjectCollection $spyCompany The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany($spyCompany, ?string $comparison = null)
    {
        if ($spyCompany instanceof \Orm\Zed\Company\Persistence\SpyCompany) {
            return $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY, $spyCompany->getIdCompany(), $comparison);
        } elseif ($spyCompany instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_FK_COMPANY, $spyCompany->toKeyValue('PrimaryKey', 'IdCompany'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompany() only accepts arguments of type \Orm\Zed\Company\Persistence\SpyCompany or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Company relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Company');

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
            $this->addJoinObject($join, 'Company');
        }

        return $this;
    }

    /**
     * Use the Company relation SpyCompany object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery A secondary query class using the current class as primary query
     */
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCompany($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Company', '\Orm\Zed\Company\Persistence\SpyCompanyQuery');
    }

    /**
     * Use the Company relation SpyCompany object
     *
     * @param callable(\Orm\Zed\Company\Persistence\SpyCompanyQuery):\Orm\Zed\Company\Persistence\SpyCompanyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCompanyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Company relation to the SpyCompany table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the EXISTS statement
     */
    public function useCompanyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Company relation to the SpyCompany table for a NOT EXISTS query.
     *
     * @see useCompanyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useExistsQuery('Company', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Company relation to the SpyCompany table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the IN statement
     */
    public function useInCompanyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Company relation to the SpyCompany table for a NOT IN query.
     *
     * @see useCompanyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Company\Persistence\SpyCompanyQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Company\Persistence\SpyCompanyQuery */
        $q = $this->useInQuery('Company', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Customer\Persistence\SpyCustomer object
     *
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer|ObjectCollection $spyCustomer The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCustomer($spyCustomer, ?string $comparison = null)
    {
        if ($spyCustomer instanceof \Orm\Zed\Customer\Persistence\SpyCustomer) {
            return $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_FK_CUSTOMER, $spyCustomer->getIdCustomer(), $comparison);
        } elseif ($spyCustomer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_FK_CUSTOMER, $spyCustomer->toKeyValue('PrimaryKey', 'IdCustomer'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCustomer() only accepts arguments of type \Orm\Zed\Customer\Persistence\SpyCustomer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Customer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCustomer(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Customer');

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
            $this->addJoinObject($join, 'Customer');
        }

        return $this;
    }

    /**
     * Use the Customer relation SpyCustomer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery A secondary query class using the current class as primary query
     */
    public function useCustomerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCustomer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Customer', '\Orm\Zed\Customer\Persistence\SpyCustomerQuery');
    }

    /**
     * Use the Customer relation SpyCustomer object
     *
     * @param callable(\Orm\Zed\Customer\Persistence\SpyCustomerQuery):\Orm\Zed\Customer\Persistence\SpyCustomerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCustomerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCustomerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Customer relation to the SpyCustomer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the EXISTS statement
     */
    public function useCustomerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useExistsQuery('Customer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Customer relation to the SpyCustomer table for a NOT EXISTS query.
     *
     * @see useCustomerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT EXISTS statement
     */
    public function useCustomerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useExistsQuery('Customer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Customer relation to the SpyCustomer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the IN statement
     */
    public function useInCustomerQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useInQuery('Customer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Customer relation to the SpyCustomer table for a NOT IN query.
     *
     * @see useCustomerInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery The inner query object of the NOT IN statement
     */
    public function useNotInCustomerQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Customer\Persistence\SpyCustomerQuery */
        $q = $this->useInQuery('Customer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile|ObjectCollection $spyCompanyUserFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyUserFile($spyCompanyUserFile, ?string $comparison = null)
    {
        if ($spyCompanyUserFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyCompanyUserFile->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyCompanyUserFile instanceof ObjectCollection) {
            $this
                ->useSpyCompanyUserFileQuery()
                ->filterByPrimaryKeys($spyCompanyUserFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUserFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUserFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUserFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUserFile');

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
            $this->addJoinObject($join, 'SpyCompanyUserFile');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUserFile relation SpyCompanyUserFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUserFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyUserFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUserFile', '\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery');
    }

    /**
     * Use the SpyCompanyUserFile relation SpyCompanyUserFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUserFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUserFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUserFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useExistsQuery('SpyCompanyUserFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUserFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUserFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useExistsQuery('SpyCompanyUserFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUserFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useInQuery('SpyCompanyUserFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserFile table for a NOT IN query.
     *
     * @see useSpyCompanyUserFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUserFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyUserFileQuery */
        $q = $this->useInQuery('SpyCompanyUserFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser object
     *
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser|ObjectCollection $spyCompanyRoleToCompanyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyRoleToCompanyUser($spyCompanyRoleToCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyRoleToCompanyUser instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyCompanyRoleToCompanyUser->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyCompanyRoleToCompanyUser instanceof ObjectCollection) {
            $this
                ->useSpyCompanyRoleToCompanyUserQuery()
                ->filterByPrimaryKeys($spyCompanyRoleToCompanyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyRoleToCompanyUser() only accepts arguments of type \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyRoleToCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyRoleToCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyRoleToCompanyUser');

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
            $this->addJoinObject($join, 'SpyCompanyRoleToCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyRoleToCompanyUser relation SpyCompanyRoleToCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyRoleToCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyRoleToCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyRoleToCompanyUser', '\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery');
    }

    /**
     * Use the SpyCompanyRoleToCompanyUser relation SpyCompanyRoleToCompanyUser object
     *
     * @param callable(\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery):\Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyRoleToCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyRoleToCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyRoleToCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyCompanyRoleToCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyRoleToCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyRoleToCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyRoleToCompanyUser table for a NOT IN query.
     *
     * @see useSpyCompanyRoleToCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyRoleToCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyRoleToCompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation object
     *
     * @param \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation|ObjectCollection $spyCompanyUserInvitation the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyUserInvitation($spyCompanyUserInvitation, ?string $comparison = null)
    {
        if ($spyCompanyUserInvitation instanceof \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyCompanyUserInvitation->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyCompanyUserInvitation instanceof ObjectCollection) {
            $this
                ->useSpyCompanyUserInvitationQuery()
                ->filterByPrimaryKeys($spyCompanyUserInvitation->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUserInvitation() only accepts arguments of type \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUserInvitation relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUserInvitation(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUserInvitation');

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
            $this->addJoinObject($join, 'SpyCompanyUserInvitation');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUserInvitation relation SpyCompanyUserInvitation object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUserInvitationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyUserInvitation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUserInvitation', '\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery');
    }

    /**
     * Use the SpyCompanyUserInvitation relation SpyCompanyUserInvitation object
     *
     * @param callable(\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery):\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUserInvitationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUserInvitationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUserInvitation table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUserInvitationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery */
        $q = $this->useExistsQuery('SpyCompanyUserInvitation', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserInvitation table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUserInvitationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUserInvitationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery */
        $q = $this->useExistsQuery('SpyCompanyUserInvitation', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserInvitation table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUserInvitationQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery */
        $q = $this->useInQuery('SpyCompanyUserInvitation', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUserInvitation table for a NOT IN query.
     *
     * @see useSpyCompanyUserInvitationInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUserInvitationQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery */
        $q = $this->useInQuery('SpyCompanyUserInvitation', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser object
     *
     * @param \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser|ObjectCollection $spyQuoteCompanyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuoteCompanyUser($spyQuoteCompanyUser, ?string $comparison = null)
    {
        if ($spyQuoteCompanyUser instanceof \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyQuoteCompanyUser->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyQuoteCompanyUser instanceof ObjectCollection) {
            $this
                ->useSpyQuoteCompanyUserQuery()
                ->filterByPrimaryKeys($spyQuoteCompanyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuoteCompanyUser() only accepts arguments of type \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuoteCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuoteCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuoteCompanyUser');

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
            $this->addJoinObject($join, 'SpyQuoteCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyQuoteCompanyUser relation SpyQuoteCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuoteCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuoteCompanyUser', '\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery');
    }

    /**
     * Use the SpyQuoteCompanyUser relation SpyQuoteCompanyUser object
     *
     * @param callable(\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery):\Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useExistsQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyQuoteCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useExistsQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useInQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteCompanyUser table for a NOT IN query.
     *
     * @see useSpyQuoteCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery */
        $q = $this->useInQuery('SpyQuoteCompanyUser', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyMerchantRelationRequest->getFkCompanyUser(), $comparison);

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
     * Filter the query by a related \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval object
     *
     * @param \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval|ObjectCollection $spyQuoteApproval the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuoteApproval($spyQuoteApproval, ?string $comparison = null)
    {
        if ($spyQuoteApproval instanceof \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyQuoteApproval->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyQuoteApproval instanceof ObjectCollection) {
            $this
                ->useSpyQuoteApprovalQuery()
                ->filterByPrimaryKeys($spyQuoteApproval->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuoteApproval() only accepts arguments of type \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuoteApproval relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuoteApproval(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuoteApproval');

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
            $this->addJoinObject($join, 'SpyQuoteApproval');
        }

        return $this;
    }

    /**
     * Use the SpyQuoteApproval relation SpyQuoteApproval object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteApprovalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuoteApproval($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuoteApproval', '\Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery');
    }

    /**
     * Use the SpyQuoteApproval relation SpyQuoteApproval object
     *
     * @param callable(\Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery):\Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteApprovalQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteApprovalQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuoteApproval table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteApprovalExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery */
        $q = $this->useExistsQuery('SpyQuoteApproval', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteApproval table for a NOT EXISTS query.
     *
     * @see useSpyQuoteApprovalExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteApprovalNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery */
        $q = $this->useExistsQuery('SpyQuoteApproval', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuoteApproval table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteApprovalQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery */
        $q = $this->useInQuery('SpyQuoteApproval', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteApproval table for a NOT IN query.
     *
     * @see useSpyQuoteApprovalInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteApprovalQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery */
        $q = $this->useInQuery('SpyQuoteApproval', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest object
     *
     * @param \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest|ObjectCollection $spyQuoteRequest the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyQuoteRequest($spyQuoteRequest, ?string $comparison = null)
    {
        if ($spyQuoteRequest instanceof \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyQuoteRequest->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyQuoteRequest instanceof ObjectCollection) {
            $this
                ->useSpyQuoteRequestQuery()
                ->filterByPrimaryKeys($spyQuoteRequest->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyQuoteRequest() only accepts arguments of type \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyQuoteRequest relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyQuoteRequest(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyQuoteRequest');

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
            $this->addJoinObject($join, 'SpyQuoteRequest');
        }

        return $this;
    }

    /**
     * Use the SpyQuoteRequest relation SpyQuoteRequest object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery A secondary query class using the current class as primary query
     */
    public function useSpyQuoteRequestQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyQuoteRequest($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyQuoteRequest', '\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery');
    }

    /**
     * Use the SpyQuoteRequest relation SpyQuoteRequest object
     *
     * @param callable(\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery):\Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyQuoteRequestQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyQuoteRequestQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyQuoteRequest table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the EXISTS statement
     */
    public function useSpyQuoteRequestExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useExistsQuery('SpyQuoteRequest', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequest table for a NOT EXISTS query.
     *
     * @see useSpyQuoteRequestExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyQuoteRequestNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useExistsQuery('SpyQuoteRequest', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequest table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the IN statement
     */
    public function useInSpyQuoteRequestQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useInQuery('SpyQuoteRequest', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyQuoteRequest table for a NOT IN query.
     *
     * @see useSpyQuoteRequestInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyQuoteRequestQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery */
        $q = $this->useInQuery('SpyQuoteRequest', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry|ObjectCollection $spySspInquiry the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquiry($spySspInquiry, ?string $comparison = null)
    {
        if ($spySspInquiry instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spySspInquiry->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spySspInquiry instanceof ObjectCollection) {
            $this
                ->useSpySspInquiryQuery()
                ->filterByPrimaryKeys($spySspInquiry->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquiry() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquiry relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquiry(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquiry');

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
            $this->addJoinObject($join, 'SpySspInquiry');
        }

        return $this;
    }

    /**
     * Use the SpySspInquiry relation SpySspInquiry object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquiryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySspInquiry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquiry', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery');
    }

    /**
     * Use the SpySspInquiry relation SpySspInquiry object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquiryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquiryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquiry table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquiryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery */
        $q = $this->useExistsQuery('SpySspInquiry', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquiry table for a NOT EXISTS query.
     *
     * @see useSpySspInquiryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquiryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery */
        $q = $this->useExistsQuery('SpySspInquiry', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquiry table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery The inner query object of the IN statement
     */
    public function useInSpySspInquiryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery */
        $q = $this->useInQuery('SpySspInquiry', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquiry table for a NOT IN query.
     *
     * @see useSpySspInquiryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquiryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery */
        $q = $this->useInQuery('SpySspInquiry', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser object
     *
     * @param \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser|ObjectCollection $spyShoppingListCompanyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListCompanyUser($spyShoppingListCompanyUser, ?string $comparison = null)
    {
        if ($spyShoppingListCompanyUser instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyShoppingListCompanyUser->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyShoppingListCompanyUser instanceof ObjectCollection) {
            $this
                ->useSpyShoppingListCompanyUserQuery()
                ->filterByPrimaryKeys($spyShoppingListCompanyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListCompanyUser() only accepts arguments of type \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListCompanyUser');

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
            $this->addJoinObject($join, 'SpyShoppingListCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListCompanyUser relation SpyShoppingListCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListCompanyUser', '\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery');
    }

    /**
     * Use the SpyShoppingListCompanyUser relation SpyShoppingListCompanyUser object
     *
     * @param callable(\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery):\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery */
        $q = $this->useExistsQuery('SpyShoppingListCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery */
        $q = $this->useExistsQuery('SpyShoppingListCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery */
        $q = $this->useInQuery('SpyShoppingListCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyUser table for a NOT IN query.
     *
     * @see useSpyShoppingListCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyUserQuery */
        $q = $this->useInQuery('SpyShoppingListCompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist object
     *
     * @param \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist|ObjectCollection $spyShoppingListCompanyBusinessUnitBlacklist the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListCompanyBusinessUnitBlacklist($spyShoppingListCompanyBusinessUnitBlacklist, ?string $comparison = null)
    {
        if ($spyShoppingListCompanyBusinessUnitBlacklist instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist) {
            $this
                ->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyShoppingListCompanyBusinessUnitBlacklist->getFkCompanyUser(), $comparison);

            return $this;
        } elseif ($spyShoppingListCompanyBusinessUnitBlacklist instanceof ObjectCollection) {
            $this
                ->useSpyShoppingListCompanyBusinessUnitBlacklistQuery()
                ->filterByPrimaryKeys($spyShoppingListCompanyBusinessUnitBlacklist->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListCompanyBusinessUnitBlacklist() only accepts arguments of type \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklist or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListCompanyBusinessUnitBlacklist relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListCompanyBusinessUnitBlacklist(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListCompanyBusinessUnitBlacklist');

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
            $this->addJoinObject($join, 'SpyShoppingListCompanyBusinessUnitBlacklist');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListCompanyBusinessUnitBlacklist relation SpyShoppingListCompanyBusinessUnitBlacklist object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListCompanyBusinessUnitBlacklistQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListCompanyBusinessUnitBlacklist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListCompanyBusinessUnitBlacklist', '\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery');
    }

    /**
     * Use the SpyShoppingListCompanyBusinessUnitBlacklist relation SpyShoppingListCompanyBusinessUnitBlacklist object
     *
     * @param callable(\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery):\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListCompanyBusinessUnitBlacklistQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListCompanyBusinessUnitBlacklistQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnitBlacklist table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListCompanyBusinessUnitBlacklistExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery */
        $q = $this->useExistsQuery('SpyShoppingListCompanyBusinessUnitBlacklist', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnitBlacklist table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListCompanyBusinessUnitBlacklistExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListCompanyBusinessUnitBlacklistNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery */
        $q = $this->useExistsQuery('SpyShoppingListCompanyBusinessUnitBlacklist', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnitBlacklist table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListCompanyBusinessUnitBlacklistQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery */
        $q = $this->useInQuery('SpyShoppingListCompanyBusinessUnitBlacklist', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnitBlacklist table for a NOT IN query.
     *
     * @see useSpyShoppingListCompanyBusinessUnitBlacklistInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListCompanyBusinessUnitBlacklistQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitBlacklistQuery */
        $q = $this->useInQuery('SpyShoppingListCompanyBusinessUnitBlacklist', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCompanyUser $spyCompanyUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCompanyUser = null)
    {
        if ($spyCompanyUser) {
            $this->addUsingAlias(SpyCompanyUserTableMap::COL_ID_COMPANY_USER, $spyCompanyUser->getIdCompanyUser(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_company_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCompanyUserTableMap::clearInstancePool();
            SpyCompanyUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCompanyUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCompanyUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCompanyUserTableMap::clearRelatedInstancePool();

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
