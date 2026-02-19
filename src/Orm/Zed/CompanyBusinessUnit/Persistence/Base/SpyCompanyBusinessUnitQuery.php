<?php

namespace Orm\Zed\CompanyBusinessUnit\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit as ChildSpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery as ChildSpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationship;
use Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit;
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
 * Base class that represents a query for the `spy_company_business_unit` table.
 *
 * @method     ChildSpyCompanyBusinessUnitQuery orderByIdCompanyBusinessUnit($order = Criteria::ASC) Order by the id_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByFkCompany($order = Criteria::ASC) Order by the fk_company column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByFkParentCompanyBusinessUnit($order = Criteria::ASC) Order by the fk_parent_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByBic($order = Criteria::ASC) Order by the bic column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByDefaultBillingAddress($order = Criteria::ASC) Order by the default_billing_address column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByExternalUrl($order = Criteria::ASC) Order by the external_url column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByIban($order = Criteria::ASC) Order by the iban column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildSpyCompanyBusinessUnitQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 *
 * @method     ChildSpyCompanyBusinessUnitQuery groupByIdCompanyBusinessUnit() Group by the id_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByFkCompany() Group by the fk_company column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByFkParentCompanyBusinessUnit() Group by the fk_parent_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByBic() Group by the bic column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByDefaultBillingAddress() Group by the default_billing_address column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByEmail() Group by the email column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByExternalUrl() Group by the external_url column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByIban() Group by the iban column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByKey() Group by the key column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByName() Group by the name column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByPhone() Group by the phone column
 * @method     ChildSpyCompanyBusinessUnitQuery groupByUuid() Group by the uuid column
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinParentCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the ParentCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinParentCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ParentCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinParentCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the ParentCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithParentCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ParentCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithParentCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the ParentCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithParentCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the ParentCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithParentCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the ParentCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinCompanyBusinessUnitDefaultBillingAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinCompanyBusinessUnitDefaultBillingAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinCompanyBusinessUnitDefaultBillingAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithCompanyBusinessUnitDefaultBillingAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithCompanyBusinessUnitDefaultBillingAddress() Adds a LEFT JOIN clause and with to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithCompanyBusinessUnitDefaultBillingAddress() Adds a RIGHT JOIN clause and with to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithCompanyBusinessUnitDefaultBillingAddress() Adds a INNER JOIN clause and with to the query using the CompanyBusinessUnitDefaultBillingAddress relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinChildrenCompanyBusinessUnits($relationAlias = null) Adds a LEFT JOIN clause to the query using the ChildrenCompanyBusinessUnits relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinChildrenCompanyBusinessUnits($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ChildrenCompanyBusinessUnits relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinChildrenCompanyBusinessUnits($relationAlias = null) Adds a INNER JOIN clause to the query using the ChildrenCompanyBusinessUnits relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithChildrenCompanyBusinessUnits($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ChildrenCompanyBusinessUnits relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithChildrenCompanyBusinessUnits() Adds a LEFT JOIN clause and with to the query using the ChildrenCompanyBusinessUnits relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithChildrenCompanyBusinessUnits() Adds a RIGHT JOIN clause and with to the query using the ChildrenCompanyBusinessUnits relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithChildrenCompanyBusinessUnits() Adds a INNER JOIN clause and with to the query using the ChildrenCompanyBusinessUnits relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyCompanyBusinessUnitFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyCompanyBusinessUnitFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyCompanyBusinessUnitFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyCompanyBusinessUnitFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyBusinessUnitFile relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyCompanyBusinessUnitFile() Adds a LEFT JOIN clause and with to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyCompanyBusinessUnitFile() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyBusinessUnitFile relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyCompanyBusinessUnitFile() Adds a INNER JOIN clause and with to the query using the SpyCompanyBusinessUnitFile relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyCompanyUnitAddressToCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyCompanyUnitAddressToCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyCompanyUnitAddressToCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyCompanyUnitAddressToCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyUser relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyUser relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyUser relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyUser relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithCompanyUser() Adds a LEFT JOIN clause and with to the query using the CompanyUser relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithCompanyUser() Adds a RIGHT JOIN clause and with to the query using the CompanyUser relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithCompanyUser() Adds a INNER JOIN clause and with to the query using the CompanyUser relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyCompanyUserInvitation($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyCompanyUserInvitation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyCompanyUserInvitation($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUserInvitation relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyCompanyUserInvitation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUserInvitation relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyCompanyUserInvitation() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyCompanyUserInvitation() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUserInvitation relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyCompanyUserInvitation() Adds a INNER JOIN clause and with to the query using the SpyCompanyUserInvitation relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyMerchantRelationRequest($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyMerchantRelationRequest($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyMerchantRelationRequest($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyMerchantRelationRequest($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyMerchantRelationRequest() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyMerchantRelationRequest() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyMerchantRelationRequest() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationRequest relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyMerchantRelationRequestToCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyMerchantRelationRequestToCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyMerchantRelationRequestToCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyMerchantRelationRequestToCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyMerchantRelationship($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyMerchantRelationship($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyMerchantRelationship($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyMerchantRelationship($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyMerchantRelationship() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyMerchantRelationship() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationship relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyMerchantRelationship() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationship relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyMerchantRelationshipToCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyMerchantRelationshipToCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyMerchantRelationshipToCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyMerchantRelationshipToCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyMerchantRelationshipToCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyMerchantRelationshipToCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyMerchantRelationshipToCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpyShoppingListCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpyShoppingListCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpyShoppingListCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpyShoppingListCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpyShoppingListCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpyShoppingListCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpyShoppingListCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyShoppingListCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpySspAsset($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspAsset relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpySspAsset($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspAsset relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpySspAsset($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspAsset relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpySspAsset($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspAsset relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpySspAsset() Adds a LEFT JOIN clause and with to the query using the SpySspAsset relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpySspAsset() Adds a RIGHT JOIN clause and with to the query using the SpySspAsset relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpySspAsset() Adds a INNER JOIN clause and with to the query using the SpySspAsset relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinSpySspAssetToCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspAssetToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinSpySspAssetToCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspAssetToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinSpySspAssetToCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspAssetToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery joinWithSpySspAssetToCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspAssetToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyBusinessUnitQuery leftJoinWithSpySspAssetToCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpySspAssetToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery rightJoinWithSpySspAssetToCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpySspAssetToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyBusinessUnitQuery innerJoinWithSpySspAssetToCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpySspAssetToCompanyBusinessUnit relation
 *
 * @method     \Orm\Zed\Company\Persistence\SpyCompanyQuery|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery|\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery|\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery|\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery|\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery|\Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery|\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery|\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery|\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipQuery|\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery|\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCompanyBusinessUnit|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyBusinessUnit matching the query
 * @method     ChildSpyCompanyBusinessUnit findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCompanyBusinessUnit matching the query, or a new ChildSpyCompanyBusinessUnit object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCompanyBusinessUnit|null findOneByIdCompanyBusinessUnit(int $id_company_business_unit) Return the first ChildSpyCompanyBusinessUnit filtered by the id_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyBusinessUnit filtered by the fk_company column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByFkParentCompanyBusinessUnit(int $fk_parent_company_business_unit) Return the first ChildSpyCompanyBusinessUnit filtered by the fk_parent_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByBic(string $bic) Return the first ChildSpyCompanyBusinessUnit filtered by the bic column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByDefaultBillingAddress(int $default_billing_address) Return the first ChildSpyCompanyBusinessUnit filtered by the default_billing_address column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByEmail(string $email) Return the first ChildSpyCompanyBusinessUnit filtered by the email column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByExternalUrl(string $external_url) Return the first ChildSpyCompanyBusinessUnit filtered by the external_url column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByIban(string $iban) Return the first ChildSpyCompanyBusinessUnit filtered by the iban column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByKey(string $key) Return the first ChildSpyCompanyBusinessUnit filtered by the key column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByName(string $name) Return the first ChildSpyCompanyBusinessUnit filtered by the name column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByPhone(string $phone) Return the first ChildSpyCompanyBusinessUnit filtered by the phone column
 * @method     ChildSpyCompanyBusinessUnit|null findOneByUuid(string $uuid) Return the first ChildSpyCompanyBusinessUnit filtered by the uuid column
 *
 * @method     ChildSpyCompanyBusinessUnit requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCompanyBusinessUnit by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyBusinessUnit matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyBusinessUnit requireOneByIdCompanyBusinessUnit(int $id_company_business_unit) Return the first ChildSpyCompanyBusinessUnit filtered by the id_company_business_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyBusinessUnit filtered by the fk_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByFkParentCompanyBusinessUnit(int $fk_parent_company_business_unit) Return the first ChildSpyCompanyBusinessUnit filtered by the fk_parent_company_business_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByBic(string $bic) Return the first ChildSpyCompanyBusinessUnit filtered by the bic column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByDefaultBillingAddress(int $default_billing_address) Return the first ChildSpyCompanyBusinessUnit filtered by the default_billing_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByEmail(string $email) Return the first ChildSpyCompanyBusinessUnit filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByExternalUrl(string $external_url) Return the first ChildSpyCompanyBusinessUnit filtered by the external_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByIban(string $iban) Return the first ChildSpyCompanyBusinessUnit filtered by the iban column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByKey(string $key) Return the first ChildSpyCompanyBusinessUnit filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByName(string $name) Return the first ChildSpyCompanyBusinessUnit filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByPhone(string $phone) Return the first ChildSpyCompanyBusinessUnit filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyBusinessUnit requireOneByUuid(string $uuid) Return the first ChildSpyCompanyBusinessUnit filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyBusinessUnit[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCompanyBusinessUnit objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> find(?ConnectionInterface $con = null) Return ChildSpyCompanyBusinessUnit objects based on current ModelCriteria
 *
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByIdCompanyBusinessUnit(int|array<int> $id_company_business_unit) Return ChildSpyCompanyBusinessUnit objects filtered by the id_company_business_unit column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByIdCompanyBusinessUnit(int|array<int> $id_company_business_unit) Return ChildSpyCompanyBusinessUnit objects filtered by the id_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyBusinessUnit objects filtered by the fk_company column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyBusinessUnit objects filtered by the fk_company column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByFkParentCompanyBusinessUnit(int|array<int> $fk_parent_company_business_unit) Return ChildSpyCompanyBusinessUnit objects filtered by the fk_parent_company_business_unit column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByFkParentCompanyBusinessUnit(int|array<int> $fk_parent_company_business_unit) Return ChildSpyCompanyBusinessUnit objects filtered by the fk_parent_company_business_unit column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByBic(string|array<string> $bic) Return ChildSpyCompanyBusinessUnit objects filtered by the bic column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByBic(string|array<string> $bic) Return ChildSpyCompanyBusinessUnit objects filtered by the bic column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByDefaultBillingAddress(int|array<int> $default_billing_address) Return ChildSpyCompanyBusinessUnit objects filtered by the default_billing_address column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByDefaultBillingAddress(int|array<int> $default_billing_address) Return ChildSpyCompanyBusinessUnit objects filtered by the default_billing_address column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByEmail(string|array<string> $email) Return ChildSpyCompanyBusinessUnit objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByEmail(string|array<string> $email) Return ChildSpyCompanyBusinessUnit objects filtered by the email column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByExternalUrl(string|array<string> $external_url) Return ChildSpyCompanyBusinessUnit objects filtered by the external_url column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByExternalUrl(string|array<string> $external_url) Return ChildSpyCompanyBusinessUnit objects filtered by the external_url column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByIban(string|array<string> $iban) Return ChildSpyCompanyBusinessUnit objects filtered by the iban column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByIban(string|array<string> $iban) Return ChildSpyCompanyBusinessUnit objects filtered by the iban column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByKey(string|array<string> $key) Return ChildSpyCompanyBusinessUnit objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByKey(string|array<string> $key) Return ChildSpyCompanyBusinessUnit objects filtered by the key column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByName(string|array<string> $name) Return ChildSpyCompanyBusinessUnit objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByName(string|array<string> $name) Return ChildSpyCompanyBusinessUnit objects filtered by the name column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByPhone(string|array<string> $phone) Return ChildSpyCompanyBusinessUnit objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByPhone(string|array<string> $phone) Return ChildSpyCompanyBusinessUnit objects filtered by the phone column
 * @method     ChildSpyCompanyBusinessUnit[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyCompanyBusinessUnit objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyBusinessUnit> findByUuid(string|array<string> $uuid) Return ChildSpyCompanyBusinessUnit objects filtered by the uuid column
 *
 * @method     ChildSpyCompanyBusinessUnit[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCompanyBusinessUnit> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCompanyBusinessUnitQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CompanyBusinessUnit\Persistence\Base\SpyCompanyBusinessUnitQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCompanyBusinessUnitQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCompanyBusinessUnitQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCompanyBusinessUnitQuery) {
            return $criteria;
        }
        $query = new ChildSpyCompanyBusinessUnitQuery();
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
     * @return ChildSpyCompanyBusinessUnit|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCompanyBusinessUnitTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCompanyBusinessUnit A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_company_business_unit`, `fk_company`, `fk_parent_company_business_unit`, `bic`, `default_billing_address`, `email`, `external_url`, `iban`, `key`, `name`, `phone`, `uuid` FROM `spy_company_business_unit` WHERE `id_company_business_unit` = :p0';
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
            /** @var ChildSpyCompanyBusinessUnit $obj */
            $obj = new ChildSpyCompanyBusinessUnit();
            $obj->hydrate($row);
            SpyCompanyBusinessUnitTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCompanyBusinessUnit|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCompanyBusinessUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyBusinessUnit_Between(array $idCompanyBusinessUnit)
    {
        return $this->filterByIdCompanyBusinessUnit($idCompanyBusinessUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCompanyBusinessUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyBusinessUnit_In(array $idCompanyBusinessUnits)
    {
        return $this->filterByIdCompanyBusinessUnit($idCompanyBusinessUnits, Criteria::IN);
    }

    /**
     * Filter the query on the id_company_business_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompanyBusinessUnit(1234); // WHERE id_company_business_unit = 1234
     * $query->filterByIdCompanyBusinessUnit(array(12, 34), Criteria::IN); // WHERE id_company_business_unit IN (12, 34)
     * $query->filterByIdCompanyBusinessUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_company_business_unit > 12
     * </code>
     *
     * @param     mixed $idCompanyBusinessUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCompanyBusinessUnit($idCompanyBusinessUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCompanyBusinessUnit)) {
            $useMinMax = false;
            if (isset($idCompanyBusinessUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $idCompanyBusinessUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompanyBusinessUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $idCompanyBusinessUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCompanyBusinessUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $idCompanyBusinessUnit, $comparison);

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
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, $fkCompany['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompany['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, $fkCompany['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompany of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, $fkCompany, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkParentCompanyBusinessUnit Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentCompanyBusinessUnit_Between(array $fkParentCompanyBusinessUnit)
    {
        return $this->filterByFkParentCompanyBusinessUnit($fkParentCompanyBusinessUnit, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkParentCompanyBusinessUnits Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentCompanyBusinessUnit_In(array $fkParentCompanyBusinessUnits)
    {
        return $this->filterByFkParentCompanyBusinessUnit($fkParentCompanyBusinessUnits, Criteria::IN);
    }

    /**
     * Filter the query on the fk_parent_company_business_unit column
     *
     * Example usage:
     * <code>
     * $query->filterByFkParentCompanyBusinessUnit(1234); // WHERE fk_parent_company_business_unit = 1234
     * $query->filterByFkParentCompanyBusinessUnit(array(12, 34), Criteria::IN); // WHERE fk_parent_company_business_unit IN (12, 34)
     * $query->filterByFkParentCompanyBusinessUnit(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_parent_company_business_unit > 12
     * </code>
     *
     * @see       filterByParentCompanyBusinessUnit()
     *
     * @param     mixed $fkParentCompanyBusinessUnit The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkParentCompanyBusinessUnit($fkParentCompanyBusinessUnit = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkParentCompanyBusinessUnit)) {
            $useMinMax = false;
            if (isset($fkParentCompanyBusinessUnit['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, $fkParentCompanyBusinessUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkParentCompanyBusinessUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, $fkParentCompanyBusinessUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkParentCompanyBusinessUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, $fkParentCompanyBusinessUnit, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $bics Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBic_In(array $bics)
    {
        return $this->filterByBic($bics, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $bic Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBic_Like($bic)
    {
        return $this->filterByBic($bic, Criteria::LIKE);
    }

    /**
     * Filter the query on the bic column
     *
     * Example usage:
     * <code>
     * $query->filterByBic('fooValue');   // WHERE bic = 'fooValue'
     * $query->filterByBic('%fooValue%', Criteria::LIKE); // WHERE bic LIKE '%fooValue%'
     * $query->filterByBic([1, 'foo'], Criteria::IN); // WHERE bic IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $bic The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByBic($bic = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $bic = str_replace('*', '%', $bic);
        }

        if (is_array($bic) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$bic of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_BIC, $bic, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $defaultBillingAddress Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultBillingAddress_Between(array $defaultBillingAddress)
    {
        return $this->filterByDefaultBillingAddress($defaultBillingAddress, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $defaultBillingAddresss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDefaultBillingAddress_In(array $defaultBillingAddresss)
    {
        return $this->filterByDefaultBillingAddress($defaultBillingAddresss, Criteria::IN);
    }

    /**
     * Filter the query on the default_billing_address column
     *
     * Example usage:
     * <code>
     * $query->filterByDefaultBillingAddress(1234); // WHERE default_billing_address = 1234
     * $query->filterByDefaultBillingAddress(array(12, 34), Criteria::IN); // WHERE default_billing_address IN (12, 34)
     * $query->filterByDefaultBillingAddress(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE default_billing_address > 12
     * </code>
     *
     * @see       filterByCompanyBusinessUnitDefaultBillingAddress()
     *
     * @param     mixed $defaultBillingAddress The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDefaultBillingAddress($defaultBillingAddress = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($defaultBillingAddress)) {
            $useMinMax = false;
            if (isset($defaultBillingAddress['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $defaultBillingAddress['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($defaultBillingAddress['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $defaultBillingAddress['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$defaultBillingAddress of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $defaultBillingAddress, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_EMAIL, $email, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $externalUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrl_In(array $externalUrls)
    {
        return $this->filterByExternalUrl($externalUrls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $externalUrl Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrl_Like($externalUrl)
    {
        return $this->filterByExternalUrl($externalUrl, Criteria::LIKE);
    }

    /**
     * Filter the query on the external_url column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalUrl('fooValue');   // WHERE external_url = 'fooValue'
     * $query->filterByExternalUrl('%fooValue%', Criteria::LIKE); // WHERE external_url LIKE '%fooValue%'
     * $query->filterByExternalUrl([1, 'foo'], Criteria::IN); // WHERE external_url IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $externalUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByExternalUrl($externalUrl = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $externalUrl = str_replace('*', '%', $externalUrl);
        }

        if (is_array($externalUrl) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$externalUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL, $externalUrl, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $ibans Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIban_In(array $ibans)
    {
        return $this->filterByIban($ibans, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $iban Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIban_Like($iban)
    {
        return $this->filterByIban($iban, Criteria::LIKE);
    }

    /**
     * Filter the query on the iban column
     *
     * Example usage:
     * <code>
     * $query->filterByIban('fooValue');   // WHERE iban = 'fooValue'
     * $query->filterByIban('%fooValue%', Criteria::LIKE); // WHERE iban LIKE '%fooValue%'
     * $query->filterByIban([1, 'foo'], Criteria::IN); // WHERE iban IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $iban The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIban($iban = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $iban = str_replace('*', '%', $iban);
        }

        if (is_array($iban) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$iban of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_IBAN, $iban, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $phones Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone_In(array $phones)
    {
        return $this->filterByPhone($phones, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $phone Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone_Like($phone)
    {
        return $this->filterByPhone($phone, Criteria::LIKE);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone([1, 'foo'], Criteria::IN); // WHERE phone IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPhone($phone = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $phone = str_replace('*', '%', $phone);
        }

        if (is_array($phone) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$phone of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_PHONE, $phone, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_UUID, $uuid, $comparison);

        return $query;
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
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, $spyCompany->getIdCompany(), $comparison);
        } elseif ($spyCompany instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, $spyCompany->toKeyValue('PrimaryKey', 'IdCompany'), $comparison);

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
     * Filter the query by a related \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit object
     *
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit|ObjectCollection $spyCompanyBusinessUnit The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParentCompanyBusinessUnit($spyCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnit instanceof \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit) {
            return $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->getIdCompanyBusinessUnit(), $comparison);
        } elseif ($spyCompanyBusinessUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->toKeyValue('PrimaryKey', 'IdCompanyBusinessUnit'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByParentCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ParentCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinParentCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ParentCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'ParentCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the ParentCompanyBusinessUnit relation SpyCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useParentCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinParentCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ParentCompanyBusinessUnit', '\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery');
    }

    /**
     * Use the ParentCompanyBusinessUnit relation SpyCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery):\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withParentCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useParentCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ParentCompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useParentCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('ParentCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ParentCompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useParentCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useParentCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('ParentCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ParentCompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInParentCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('ParentCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ParentCompanyBusinessUnit relation to the SpyCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useParentCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInParentCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('ParentCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress object
     *
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress|ObjectCollection $spyCompanyUnitAddress The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyBusinessUnitDefaultBillingAddress($spyCompanyUnitAddress, ?string $comparison = null)
    {
        if ($spyCompanyUnitAddress instanceof \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress) {
            return $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $spyCompanyUnitAddress->getIdCompanyUnitAddress(), $comparison);
        } elseif ($spyCompanyUnitAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, $spyCompanyUnitAddress->toKeyValue('PrimaryKey', 'IdCompanyUnitAddress'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCompanyBusinessUnitDefaultBillingAddress() only accepts arguments of type \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyBusinessUnitDefaultBillingAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyBusinessUnitDefaultBillingAddress(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyBusinessUnitDefaultBillingAddress');

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
            $this->addJoinObject($join, 'CompanyBusinessUnitDefaultBillingAddress');
        }

        return $this;
    }

    /**
     * Use the CompanyBusinessUnitDefaultBillingAddress relation SpyCompanyUnitAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery A secondary query class using the current class as primary query
     */
    public function useCompanyBusinessUnitDefaultBillingAddressQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompanyBusinessUnitDefaultBillingAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyBusinessUnitDefaultBillingAddress', '\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery');
    }

    /**
     * Use the CompanyBusinessUnitDefaultBillingAddress relation SpyCompanyUnitAddress object
     *
     * @param callable(\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery):\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyBusinessUnitDefaultBillingAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompanyBusinessUnitDefaultBillingAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyBusinessUnitDefaultBillingAddress relation to the SpyCompanyUnitAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the EXISTS statement
     */
    public function useCompanyBusinessUnitDefaultBillingAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useExistsQuery('CompanyBusinessUnitDefaultBillingAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyBusinessUnitDefaultBillingAddress relation to the SpyCompanyUnitAddress table for a NOT EXISTS query.
     *
     * @see useCompanyBusinessUnitDefaultBillingAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyBusinessUnitDefaultBillingAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useExistsQuery('CompanyBusinessUnitDefaultBillingAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyBusinessUnitDefaultBillingAddress relation to the SpyCompanyUnitAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the IN statement
     */
    public function useInCompanyBusinessUnitDefaultBillingAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useInQuery('CompanyBusinessUnitDefaultBillingAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyBusinessUnitDefaultBillingAddress relation to the SpyCompanyUnitAddress table for a NOT IN query.
     *
     * @see useCompanyBusinessUnitDefaultBillingAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyBusinessUnitDefaultBillingAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery */
        $q = $this->useInQuery('CompanyBusinessUnitDefaultBillingAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit object
     *
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit|ObjectCollection $spyCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChildrenCompanyBusinessUnits($spyCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnit instanceof \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->getFkParentCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useChildrenCompanyBusinessUnitsQuery()
                ->filterByPrimaryKeys($spyCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByChildrenCompanyBusinessUnits() only accepts arguments of type \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ChildrenCompanyBusinessUnits relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinChildrenCompanyBusinessUnits(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ChildrenCompanyBusinessUnits');

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
            $this->addJoinObject($join, 'ChildrenCompanyBusinessUnits');
        }

        return $this;
    }

    /**
     * Use the ChildrenCompanyBusinessUnits relation SpyCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useChildrenCompanyBusinessUnitsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinChildrenCompanyBusinessUnits($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ChildrenCompanyBusinessUnits', '\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery');
    }

    /**
     * Use the ChildrenCompanyBusinessUnits relation SpyCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery):\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withChildrenCompanyBusinessUnitsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useChildrenCompanyBusinessUnitsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ChildrenCompanyBusinessUnits relation to the SpyCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useChildrenCompanyBusinessUnitsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('ChildrenCompanyBusinessUnits', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ChildrenCompanyBusinessUnits relation to the SpyCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useChildrenCompanyBusinessUnitsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useChildrenCompanyBusinessUnitsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('ChildrenCompanyBusinessUnits', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ChildrenCompanyBusinessUnits relation to the SpyCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInChildrenCompanyBusinessUnitsQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('ChildrenCompanyBusinessUnits', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ChildrenCompanyBusinessUnits relation to the SpyCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useChildrenCompanyBusinessUnitsInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInChildrenCompanyBusinessUnitsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('ChildrenCompanyBusinessUnits', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile|ObjectCollection $spyCompanyBusinessUnitFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyBusinessUnitFile($spyCompanyBusinessUnitFile, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnitFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnitFile->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyCompanyBusinessUnitFile instanceof ObjectCollection) {
            $this
                ->useSpyCompanyBusinessUnitFileQuery()
                ->filterByPrimaryKeys($spyCompanyBusinessUnitFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyBusinessUnitFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyBusinessUnitFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyBusinessUnitFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyBusinessUnitFile');

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
            $this->addJoinObject($join, 'SpyCompanyBusinessUnitFile');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyBusinessUnitFile relation SpyCompanyBusinessUnitFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyBusinessUnitFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyBusinessUnitFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyBusinessUnitFile', '\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery');
    }

    /**
     * Use the SpyCompanyBusinessUnitFile relation SpyCompanyBusinessUnitFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyBusinessUnitFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyBusinessUnitFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyBusinessUnitFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useExistsQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for a NOT EXISTS query.
     *
     * @see useSpyCompanyBusinessUnitFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyBusinessUnitFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useExistsQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyBusinessUnitFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useInQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnitFile table for a NOT IN query.
     *
     * @see useSpyCompanyBusinessUnitFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyBusinessUnitFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery */
        $q = $this->useInQuery('SpyCompanyBusinessUnitFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit object
     *
     * @param \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit|ObjectCollection $spyCompanyUnitAddressToCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyUnitAddressToCompanyBusinessUnit($spyCompanyUnitAddressToCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyCompanyUnitAddressToCompanyBusinessUnit instanceof \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyCompanyUnitAddressToCompanyBusinessUnit->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyCompanyUnitAddressToCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useSpyCompanyUnitAddressToCompanyBusinessUnitQuery()
                ->filterByPrimaryKeys($spyCompanyUnitAddressToCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUnitAddressToCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUnitAddressToCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUnitAddressToCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'SpyCompanyUnitAddressToCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUnitAddressToCompanyBusinessUnit relation SpyCompanyUnitAddressToCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUnitAddressToCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUnitAddressToCompanyBusinessUnit', '\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery');
    }

    /**
     * Use the SpyCompanyUnitAddressToCompanyBusinessUnit relation SpyCompanyUnitAddressToCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery):\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUnitAddressToCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUnitAddressToCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressToCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUnitAddressToCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyCompanyUnitAddressToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressToCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUnitAddressToCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUnitAddressToCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyCompanyUnitAddressToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressToCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUnitAddressToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyCompanyUnitAddressToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressToCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useSpyCompanyUnitAddressToCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUnitAddressToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyCompanyUnitAddressToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser object
     *
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser|ObjectCollection $spyCompanyUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyUser($spyCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyUser instanceof \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyCompanyUser->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyCompanyUser instanceof ObjectCollection) {
            $this
                ->useCompanyUserQuery()
                ->filterByPrimaryKeys($spyCompanyUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByCompanyUser() only accepts arguments of type \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CompanyUser');

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
            $this->addJoinObject($join, 'CompanyUser');
        }

        return $this;
    }

    /**
     * Use the CompanyUser relation SpyCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useCompanyUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CompanyUser', '\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery');
    }

    /**
     * Use the CompanyUser relation SpyCompanyUser object
     *
     * @param callable(\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery):\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('CompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for a NOT EXISTS query.
     *
     * @see useCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('CompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the IN statement
     */
    public function useInCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('CompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CompanyUser relation to the SpyCompanyUser table for a NOT IN query.
     *
     * @see useCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('CompanyUser', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyCompanyUserInvitation->getFkCompanyBusinessUnit(), $comparison);

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
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyMerchantRelationRequest->getFkCompanyBusinessUnit(), $comparison);

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
     * Filter the query by a related \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit object
     *
     * @param \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit|ObjectCollection $spyMerchantRelationRequestToCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRelationRequestToCompanyBusinessUnit($spyMerchantRelationRequestToCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyMerchantRelationRequestToCompanyBusinessUnit instanceof \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyMerchantRelationRequestToCompanyBusinessUnit->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyMerchantRelationRequestToCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRelationRequestToCompanyBusinessUnitQuery()
                ->filterByPrimaryKeys($spyMerchantRelationRequestToCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRelationRequestToCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRelationRequestToCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRelationRequestToCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'SpyMerchantRelationRequestToCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRelationRequestToCompanyBusinessUnit relation SpyMerchantRelationRequestToCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRelationRequestToCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRelationRequestToCompanyBusinessUnit', '\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery');
    }

    /**
     * Use the SpyMerchantRelationRequestToCompanyBusinessUnit relation SpyMerchantRelationRequestToCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery):\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRelationRequestToCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRelationRequestToCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRelationRequestToCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRelationRequestToCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationRequestToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationRequestToCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRelationRequestToCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRelationRequestToCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationRequestToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationRequestToCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRelationRequestToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyMerchantRelationRequestToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationRequestToCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useSpyMerchantRelationRequestToCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRelationRequestToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyMerchantRelationRequestToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyMerchantRelationship->getFkCompanyBusinessUnit(), $comparison);

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
     * Filter the query by a related \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit object
     *
     * @param \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit|ObjectCollection $spyMerchantRelationshipToCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantRelationshipToCompanyBusinessUnit($spyMerchantRelationshipToCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyMerchantRelationshipToCompanyBusinessUnit instanceof \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyMerchantRelationshipToCompanyBusinessUnit->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyMerchantRelationshipToCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useSpyMerchantRelationshipToCompanyBusinessUnitQuery()
                ->filterByPrimaryKeys($spyMerchantRelationshipToCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantRelationshipToCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantRelationshipToCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantRelationshipToCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantRelationshipToCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'SpyMerchantRelationshipToCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantRelationshipToCompanyBusinessUnit relation SpyMerchantRelationshipToCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantRelationshipToCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantRelationshipToCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantRelationshipToCompanyBusinessUnit', '\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery');
    }

    /**
     * Use the SpyMerchantRelationshipToCompanyBusinessUnit relation SpyMerchantRelationshipToCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery):\Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantRelationshipToCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantRelationshipToCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantRelationshipToCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantRelationshipToCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationshipToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationshipToCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useSpyMerchantRelationshipToCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantRelationshipToCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyMerchantRelationshipToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationshipToCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantRelationshipToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyMerchantRelationshipToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantRelationshipToCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useSpyMerchantRelationshipToCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantRelationshipToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantRelationship\Persistence\SpyMerchantRelationshipToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyMerchantRelationshipToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit object
     *
     * @param \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit|ObjectCollection $spyShoppingListCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListCompanyBusinessUnit($spyShoppingListCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyShoppingListCompanyBusinessUnit instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyShoppingListCompanyBusinessUnit->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spyShoppingListCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useSpyShoppingListCompanyBusinessUnitQuery()
                ->filterByPrimaryKeys($spyShoppingListCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'SpyShoppingListCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListCompanyBusinessUnit relation SpyShoppingListCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListCompanyBusinessUnit', '\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery');
    }

    /**
     * Use the SpyShoppingListCompanyBusinessUnit relation SpyShoppingListCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery):\Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyShoppingListCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyShoppingListCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyShoppingListCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useSpyShoppingListCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyShoppingListCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset|ObjectCollection $spySspAsset the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspAsset($spySspAsset, ?string $comparison = null)
    {
        if ($spySspAsset instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spySspAsset->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spySspAsset instanceof ObjectCollection) {
            $this
                ->useSpySspAssetQuery()
                ->filterByPrimaryKeys($spySspAsset->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspAsset() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspAsset relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspAsset(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspAsset');

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
            $this->addJoinObject($join, 'SpySspAsset');
        }

        return $this;
    }

    /**
     * Use the SpySspAsset relation SpySspAsset object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery A secondary query class using the current class as primary query
     */
    public function useSpySspAssetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpySspAsset($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspAsset', '\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery');
    }

    /**
     * Use the SpySspAsset relation SpySspAsset object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspAssetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpySspAssetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspAsset table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the EXISTS statement
     */
    public function useSpySspAssetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useExistsQuery('SpySspAsset', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspAsset table for a NOT EXISTS query.
     *
     * @see useSpySspAssetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspAssetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useExistsQuery('SpySspAsset', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspAsset table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the IN statement
     */
    public function useInSpySspAssetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useInQuery('SpySspAsset', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspAsset table for a NOT IN query.
     *
     * @see useSpySspAssetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspAssetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery */
        $q = $this->useInQuery('SpySspAsset', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit|ObjectCollection $spySspAssetToCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspAssetToCompanyBusinessUnit($spySspAssetToCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spySspAssetToCompanyBusinessUnit instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spySspAssetToCompanyBusinessUnit->getFkCompanyBusinessUnit(), $comparison);

            return $this;
        } elseif ($spySspAssetToCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useSpySspAssetToCompanyBusinessUnitQuery()
                ->filterByPrimaryKeys($spySspAssetToCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspAssetToCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspAssetToCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspAssetToCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspAssetToCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'SpySspAssetToCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the SpySspAssetToCompanyBusinessUnit relation SpySspAssetToCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpySspAssetToCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspAssetToCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspAssetToCompanyBusinessUnit', '\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery');
    }

    /**
     * Use the SpySspAssetToCompanyBusinessUnit relation SpySspAssetToCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspAssetToCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspAssetToCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspAssetToCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpySspAssetToCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpySspAssetToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspAssetToCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useSpySspAssetToCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspAssetToCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpySspAssetToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspAssetToCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInSpySspAssetToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpySspAssetToCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspAssetToCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useSpySspAssetToCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspAssetToCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpySspAssetToCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCompanyBusinessUnit $spyCompanyBusinessUnit Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCompanyBusinessUnit = null)
    {
        if ($spyCompanyBusinessUnit) {
            $this->addUsingAlias(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->getIdCompanyBusinessUnit(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_company_business_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCompanyBusinessUnitTableMap::clearInstancePool();
            SpyCompanyBusinessUnitTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCompanyBusinessUnitTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCompanyBusinessUnitTableMap::clearRelatedInstancePool();

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
