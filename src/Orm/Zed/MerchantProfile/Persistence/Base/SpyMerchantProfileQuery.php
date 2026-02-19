<?php

namespace Orm\Zed\MerchantProfile\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile as ChildSpyMerchantProfile;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery as ChildSpyMerchantProfileQuery;
use Orm\Zed\MerchantProfile\Persistence\Map\SpyMerchantProfileTableMap;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
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
 * Base class that represents a query for the `spy_merchant_profile` table.
 *
 * @method     ChildSpyMerchantProfileQuery orderByIdMerchantProfile($order = Criteria::ASC) Order by the id_merchant_profile column
 * @method     ChildSpyMerchantProfileQuery orderByContactPersonRole($order = Criteria::ASC) Order by the contact_person_role column
 * @method     ChildSpyMerchantProfileQuery orderByContactPersonTitle($order = Criteria::ASC) Order by the contact_person_title column
 * @method     ChildSpyMerchantProfileQuery orderByContactPersonFirstName($order = Criteria::ASC) Order by the contact_person_first_name column
 * @method     ChildSpyMerchantProfileQuery orderByContactPersonLastName($order = Criteria::ASC) Order by the contact_person_last_name column
 * @method     ChildSpyMerchantProfileQuery orderByContactPersonPhone($order = Criteria::ASC) Order by the contact_person_phone column
 * @method     ChildSpyMerchantProfileQuery orderByLogoUrl($order = Criteria::ASC) Order by the logo_url column
 * @method     ChildSpyMerchantProfileQuery orderByPublicEmail($order = Criteria::ASC) Order by the public_email column
 * @method     ChildSpyMerchantProfileQuery orderByPublicPhone($order = Criteria::ASC) Order by the public_phone column
 * @method     ChildSpyMerchantProfileQuery orderByFaxNumber($order = Criteria::ASC) Order by the fax_number column
 * @method     ChildSpyMerchantProfileQuery orderByDescriptionGlossaryKey($order = Criteria::ASC) Order by the description_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByBannerUrlGlossaryKey($order = Criteria::ASC) Order by the banner_url_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByDeliveryTimeGlossaryKey($order = Criteria::ASC) Order by the delivery_time_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByTermsConditionsGlossaryKey($order = Criteria::ASC) Order by the terms_conditions_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByCancellationPolicyGlossaryKey($order = Criteria::ASC) Order by the cancellation_policy_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByImprintGlossaryKey($order = Criteria::ASC) Order by the imprint_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByDataPrivacyGlossaryKey($order = Criteria::ASC) Order by the data_privacy_glossary_key column
 * @method     ChildSpyMerchantProfileQuery orderByFkMerchant($order = Criteria::ASC) Order by the fk_merchant column
 *
 * @method     ChildSpyMerchantProfileQuery groupByIdMerchantProfile() Group by the id_merchant_profile column
 * @method     ChildSpyMerchantProfileQuery groupByContactPersonRole() Group by the contact_person_role column
 * @method     ChildSpyMerchantProfileQuery groupByContactPersonTitle() Group by the contact_person_title column
 * @method     ChildSpyMerchantProfileQuery groupByContactPersonFirstName() Group by the contact_person_first_name column
 * @method     ChildSpyMerchantProfileQuery groupByContactPersonLastName() Group by the contact_person_last_name column
 * @method     ChildSpyMerchantProfileQuery groupByContactPersonPhone() Group by the contact_person_phone column
 * @method     ChildSpyMerchantProfileQuery groupByLogoUrl() Group by the logo_url column
 * @method     ChildSpyMerchantProfileQuery groupByPublicEmail() Group by the public_email column
 * @method     ChildSpyMerchantProfileQuery groupByPublicPhone() Group by the public_phone column
 * @method     ChildSpyMerchantProfileQuery groupByFaxNumber() Group by the fax_number column
 * @method     ChildSpyMerchantProfileQuery groupByDescriptionGlossaryKey() Group by the description_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByBannerUrlGlossaryKey() Group by the banner_url_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByDeliveryTimeGlossaryKey() Group by the delivery_time_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByTermsConditionsGlossaryKey() Group by the terms_conditions_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByCancellationPolicyGlossaryKey() Group by the cancellation_policy_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByImprintGlossaryKey() Group by the imprint_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByDataPrivacyGlossaryKey() Group by the data_privacy_glossary_key column
 * @method     ChildSpyMerchantProfileQuery groupByFkMerchant() Group by the fk_merchant column
 *
 * @method     ChildSpyMerchantProfileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantProfileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantProfileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantProfileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantProfileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantProfileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantProfileQuery leftJoinSpyMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyMerchantProfileQuery rightJoinSpyMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyMerchantProfileQuery innerJoinSpyMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchant relation
 *
 * @method     ChildSpyMerchantProfileQuery joinWithSpyMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyMerchantProfileQuery leftJoinWithSpyMerchant() Adds a LEFT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyMerchantProfileQuery rightJoinWithSpyMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyMerchantProfileQuery innerJoinWithSpyMerchant() Adds a INNER JOIN clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyMerchantProfileQuery leftJoinSpyMerchantProfileAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyMerchantProfileQuery rightJoinSpyMerchantProfileAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyMerchantProfileQuery innerJoinSpyMerchantProfileAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantProfileAddress relation
 *
 * @method     ChildSpyMerchantProfileQuery joinWithSpyMerchantProfileAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantProfileAddress relation
 *
 * @method     ChildSpyMerchantProfileQuery leftJoinWithSpyMerchantProfileAddress() Adds a LEFT JOIN clause and with to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyMerchantProfileQuery rightJoinWithSpyMerchantProfileAddress() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantProfileAddress relation
 * @method     ChildSpyMerchantProfileQuery innerJoinWithSpyMerchantProfileAddress() Adds a INNER JOIN clause and with to the query using the SpyMerchantProfileAddress relation
 *
 * @method     \Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantProfile|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantProfile matching the query
 * @method     ChildSpyMerchantProfile findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantProfile matching the query, or a new ChildSpyMerchantProfile object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantProfile|null findOneByIdMerchantProfile(int $id_merchant_profile) Return the first ChildSpyMerchantProfile filtered by the id_merchant_profile column
 * @method     ChildSpyMerchantProfile|null findOneByContactPersonRole(string $contact_person_role) Return the first ChildSpyMerchantProfile filtered by the contact_person_role column
 * @method     ChildSpyMerchantProfile|null findOneByContactPersonTitle(int $contact_person_title) Return the first ChildSpyMerchantProfile filtered by the contact_person_title column
 * @method     ChildSpyMerchantProfile|null findOneByContactPersonFirstName(string $contact_person_first_name) Return the first ChildSpyMerchantProfile filtered by the contact_person_first_name column
 * @method     ChildSpyMerchantProfile|null findOneByContactPersonLastName(string $contact_person_last_name) Return the first ChildSpyMerchantProfile filtered by the contact_person_last_name column
 * @method     ChildSpyMerchantProfile|null findOneByContactPersonPhone(string $contact_person_phone) Return the first ChildSpyMerchantProfile filtered by the contact_person_phone column
 * @method     ChildSpyMerchantProfile|null findOneByLogoUrl(string $logo_url) Return the first ChildSpyMerchantProfile filtered by the logo_url column
 * @method     ChildSpyMerchantProfile|null findOneByPublicEmail(string $public_email) Return the first ChildSpyMerchantProfile filtered by the public_email column
 * @method     ChildSpyMerchantProfile|null findOneByPublicPhone(string $public_phone) Return the first ChildSpyMerchantProfile filtered by the public_phone column
 * @method     ChildSpyMerchantProfile|null findOneByFaxNumber(string $fax_number) Return the first ChildSpyMerchantProfile filtered by the fax_number column
 * @method     ChildSpyMerchantProfile|null findOneByDescriptionGlossaryKey(string $description_glossary_key) Return the first ChildSpyMerchantProfile filtered by the description_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByBannerUrlGlossaryKey(string $banner_url_glossary_key) Return the first ChildSpyMerchantProfile filtered by the banner_url_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByDeliveryTimeGlossaryKey(string $delivery_time_glossary_key) Return the first ChildSpyMerchantProfile filtered by the delivery_time_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByTermsConditionsGlossaryKey(string $terms_conditions_glossary_key) Return the first ChildSpyMerchantProfile filtered by the terms_conditions_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByCancellationPolicyGlossaryKey(string $cancellation_policy_glossary_key) Return the first ChildSpyMerchantProfile filtered by the cancellation_policy_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByImprintGlossaryKey(string $imprint_glossary_key) Return the first ChildSpyMerchantProfile filtered by the imprint_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByDataPrivacyGlossaryKey(string $data_privacy_glossary_key) Return the first ChildSpyMerchantProfile filtered by the data_privacy_glossary_key column
 * @method     ChildSpyMerchantProfile|null findOneByFkMerchant(int $fk_merchant) Return the first ChildSpyMerchantProfile filtered by the fk_merchant column
 *
 * @method     ChildSpyMerchantProfile requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantProfile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantProfile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantProfile requireOneByIdMerchantProfile(int $id_merchant_profile) Return the first ChildSpyMerchantProfile filtered by the id_merchant_profile column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByContactPersonRole(string $contact_person_role) Return the first ChildSpyMerchantProfile filtered by the contact_person_role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByContactPersonTitle(int $contact_person_title) Return the first ChildSpyMerchantProfile filtered by the contact_person_title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByContactPersonFirstName(string $contact_person_first_name) Return the first ChildSpyMerchantProfile filtered by the contact_person_first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByContactPersonLastName(string $contact_person_last_name) Return the first ChildSpyMerchantProfile filtered by the contact_person_last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByContactPersonPhone(string $contact_person_phone) Return the first ChildSpyMerchantProfile filtered by the contact_person_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByLogoUrl(string $logo_url) Return the first ChildSpyMerchantProfile filtered by the logo_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByPublicEmail(string $public_email) Return the first ChildSpyMerchantProfile filtered by the public_email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByPublicPhone(string $public_phone) Return the first ChildSpyMerchantProfile filtered by the public_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByFaxNumber(string $fax_number) Return the first ChildSpyMerchantProfile filtered by the fax_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByDescriptionGlossaryKey(string $description_glossary_key) Return the first ChildSpyMerchantProfile filtered by the description_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByBannerUrlGlossaryKey(string $banner_url_glossary_key) Return the first ChildSpyMerchantProfile filtered by the banner_url_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByDeliveryTimeGlossaryKey(string $delivery_time_glossary_key) Return the first ChildSpyMerchantProfile filtered by the delivery_time_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByTermsConditionsGlossaryKey(string $terms_conditions_glossary_key) Return the first ChildSpyMerchantProfile filtered by the terms_conditions_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByCancellationPolicyGlossaryKey(string $cancellation_policy_glossary_key) Return the first ChildSpyMerchantProfile filtered by the cancellation_policy_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByImprintGlossaryKey(string $imprint_glossary_key) Return the first ChildSpyMerchantProfile filtered by the imprint_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByDataPrivacyGlossaryKey(string $data_privacy_glossary_key) Return the first ChildSpyMerchantProfile filtered by the data_privacy_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantProfile requireOneByFkMerchant(int $fk_merchant) Return the first ChildSpyMerchantProfile filtered by the fk_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantProfile[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantProfile objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> find(?ConnectionInterface $con = null) Return ChildSpyMerchantProfile objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantProfile[]|Collection findByIdMerchantProfile(int|array<int> $id_merchant_profile) Return ChildSpyMerchantProfile objects filtered by the id_merchant_profile column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByIdMerchantProfile(int|array<int> $id_merchant_profile) Return ChildSpyMerchantProfile objects filtered by the id_merchant_profile column
 * @method     ChildSpyMerchantProfile[]|Collection findByContactPersonRole(string|array<string> $contact_person_role) Return ChildSpyMerchantProfile objects filtered by the contact_person_role column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByContactPersonRole(string|array<string> $contact_person_role) Return ChildSpyMerchantProfile objects filtered by the contact_person_role column
 * @method     ChildSpyMerchantProfile[]|Collection findByContactPersonTitle(int|array<int> $contact_person_title) Return ChildSpyMerchantProfile objects filtered by the contact_person_title column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByContactPersonTitle(int|array<int> $contact_person_title) Return ChildSpyMerchantProfile objects filtered by the contact_person_title column
 * @method     ChildSpyMerchantProfile[]|Collection findByContactPersonFirstName(string|array<string> $contact_person_first_name) Return ChildSpyMerchantProfile objects filtered by the contact_person_first_name column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByContactPersonFirstName(string|array<string> $contact_person_first_name) Return ChildSpyMerchantProfile objects filtered by the contact_person_first_name column
 * @method     ChildSpyMerchantProfile[]|Collection findByContactPersonLastName(string|array<string> $contact_person_last_name) Return ChildSpyMerchantProfile objects filtered by the contact_person_last_name column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByContactPersonLastName(string|array<string> $contact_person_last_name) Return ChildSpyMerchantProfile objects filtered by the contact_person_last_name column
 * @method     ChildSpyMerchantProfile[]|Collection findByContactPersonPhone(string|array<string> $contact_person_phone) Return ChildSpyMerchantProfile objects filtered by the contact_person_phone column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByContactPersonPhone(string|array<string> $contact_person_phone) Return ChildSpyMerchantProfile objects filtered by the contact_person_phone column
 * @method     ChildSpyMerchantProfile[]|Collection findByLogoUrl(string|array<string> $logo_url) Return ChildSpyMerchantProfile objects filtered by the logo_url column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByLogoUrl(string|array<string> $logo_url) Return ChildSpyMerchantProfile objects filtered by the logo_url column
 * @method     ChildSpyMerchantProfile[]|Collection findByPublicEmail(string|array<string> $public_email) Return ChildSpyMerchantProfile objects filtered by the public_email column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByPublicEmail(string|array<string> $public_email) Return ChildSpyMerchantProfile objects filtered by the public_email column
 * @method     ChildSpyMerchantProfile[]|Collection findByPublicPhone(string|array<string> $public_phone) Return ChildSpyMerchantProfile objects filtered by the public_phone column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByPublicPhone(string|array<string> $public_phone) Return ChildSpyMerchantProfile objects filtered by the public_phone column
 * @method     ChildSpyMerchantProfile[]|Collection findByFaxNumber(string|array<string> $fax_number) Return ChildSpyMerchantProfile objects filtered by the fax_number column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByFaxNumber(string|array<string> $fax_number) Return ChildSpyMerchantProfile objects filtered by the fax_number column
 * @method     ChildSpyMerchantProfile[]|Collection findByDescriptionGlossaryKey(string|array<string> $description_glossary_key) Return ChildSpyMerchantProfile objects filtered by the description_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByDescriptionGlossaryKey(string|array<string> $description_glossary_key) Return ChildSpyMerchantProfile objects filtered by the description_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByBannerUrlGlossaryKey(string|array<string> $banner_url_glossary_key) Return ChildSpyMerchantProfile objects filtered by the banner_url_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByBannerUrlGlossaryKey(string|array<string> $banner_url_glossary_key) Return ChildSpyMerchantProfile objects filtered by the banner_url_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByDeliveryTimeGlossaryKey(string|array<string> $delivery_time_glossary_key) Return ChildSpyMerchantProfile objects filtered by the delivery_time_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByDeliveryTimeGlossaryKey(string|array<string> $delivery_time_glossary_key) Return ChildSpyMerchantProfile objects filtered by the delivery_time_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByTermsConditionsGlossaryKey(string|array<string> $terms_conditions_glossary_key) Return ChildSpyMerchantProfile objects filtered by the terms_conditions_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByTermsConditionsGlossaryKey(string|array<string> $terms_conditions_glossary_key) Return ChildSpyMerchantProfile objects filtered by the terms_conditions_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByCancellationPolicyGlossaryKey(string|array<string> $cancellation_policy_glossary_key) Return ChildSpyMerchantProfile objects filtered by the cancellation_policy_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByCancellationPolicyGlossaryKey(string|array<string> $cancellation_policy_glossary_key) Return ChildSpyMerchantProfile objects filtered by the cancellation_policy_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByImprintGlossaryKey(string|array<string> $imprint_glossary_key) Return ChildSpyMerchantProfile objects filtered by the imprint_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByImprintGlossaryKey(string|array<string> $imprint_glossary_key) Return ChildSpyMerchantProfile objects filtered by the imprint_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByDataPrivacyGlossaryKey(string|array<string> $data_privacy_glossary_key) Return ChildSpyMerchantProfile objects filtered by the data_privacy_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByDataPrivacyGlossaryKey(string|array<string> $data_privacy_glossary_key) Return ChildSpyMerchantProfile objects filtered by the data_privacy_glossary_key column
 * @method     ChildSpyMerchantProfile[]|Collection findByFkMerchant(int|array<int> $fk_merchant) Return ChildSpyMerchantProfile objects filtered by the fk_merchant column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantProfile> findByFkMerchant(int|array<int> $fk_merchant) Return ChildSpyMerchantProfile objects filtered by the fk_merchant column
 *
 * @method     ChildSpyMerchantProfile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantProfile> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantProfileQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantProfile\Persistence\Base\SpyMerchantProfileQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfile', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantProfileQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantProfileQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantProfileQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantProfileQuery();
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
     * @return ChildSpyMerchantProfile|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantProfileTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchantProfile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_merchant_profile`, `contact_person_role`, `contact_person_title`, `contact_person_first_name`, `contact_person_last_name`, `contact_person_phone`, `logo_url`, `public_email`, `public_phone`, `fax_number`, `description_glossary_key`, `banner_url_glossary_key`, `delivery_time_glossary_key`, `terms_conditions_glossary_key`, `cancellation_policy_glossary_key`, `imprint_glossary_key`, `data_privacy_glossary_key`, `fk_merchant` FROM `spy_merchant_profile` WHERE `id_merchant_profile` = :p0';
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
            /** @var ChildSpyMerchantProfile $obj */
            $obj = new ChildSpyMerchantProfile();
            $obj->hydrate($row);
            SpyMerchantProfileTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchantProfile|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantProfile Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantProfile_Between(array $idMerchantProfile)
    {
        return $this->filterByIdMerchantProfile($idMerchantProfile, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantProfiles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantProfile_In(array $idMerchantProfiles)
    {
        return $this->filterByIdMerchantProfile($idMerchantProfiles, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_profile column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantProfile(1234); // WHERE id_merchant_profile = 1234
     * $query->filterByIdMerchantProfile(array(12, 34), Criteria::IN); // WHERE id_merchant_profile IN (12, 34)
     * $query->filterByIdMerchantProfile(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_profile > 12
     * </code>
     *
     * @param     mixed $idMerchantProfile The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantProfile($idMerchantProfile = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantProfile)) {
            $useMinMax = false;
            if (isset($idMerchantProfile['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $idMerchantProfile['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantProfile['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $idMerchantProfile['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantProfile of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $idMerchantProfile, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $contactPersonRoles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonRole_In(array $contactPersonRoles)
    {
        return $this->filterByContactPersonRole($contactPersonRoles, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $contactPersonRole Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonRole_Like($contactPersonRole)
    {
        return $this->filterByContactPersonRole($contactPersonRole, Criteria::LIKE);
    }

    /**
     * Filter the query on the contact_person_role column
     *
     * Example usage:
     * <code>
     * $query->filterByContactPersonRole('fooValue');   // WHERE contact_person_role = 'fooValue'
     * $query->filterByContactPersonRole('%fooValue%', Criteria::LIKE); // WHERE contact_person_role LIKE '%fooValue%'
     * $query->filterByContactPersonRole([1, 'foo'], Criteria::IN); // WHERE contact_person_role IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $contactPersonRole The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByContactPersonRole($contactPersonRole = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $contactPersonRole = str_replace('*', '%', $contactPersonRole);
        }

        if (is_array($contactPersonRole) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$contactPersonRole of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE, $contactPersonRole, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $contactPersonTitles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonTitle_In(array $contactPersonTitles)
    {
        return $this->filterByContactPersonTitle($contactPersonTitles, Criteria::IN);
    }

    /**
     * Filter the query on the contact_person_title column
     *
     * @param     mixed $contactPersonTitle The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByContactPersonTitle($contactPersonTitle = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpyMerchantProfileTableMap::getValueSet(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE);
        if (is_scalar($contactPersonTitle)) {
            if (!in_array($contactPersonTitle, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $contactPersonTitle));
            }
            $contactPersonTitle = array_search($contactPersonTitle, $valueSet);
        } elseif (is_array($contactPersonTitle)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($contactPersonTitle as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $contactPersonTitle = $convertedValues;
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE, $contactPersonTitle, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $contactPersonFirstNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonFirstName_In(array $contactPersonFirstNames)
    {
        return $this->filterByContactPersonFirstName($contactPersonFirstNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $contactPersonFirstName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonFirstName_Like($contactPersonFirstName)
    {
        return $this->filterByContactPersonFirstName($contactPersonFirstName, Criteria::LIKE);
    }

    /**
     * Filter the query on the contact_person_first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByContactPersonFirstName('fooValue');   // WHERE contact_person_first_name = 'fooValue'
     * $query->filterByContactPersonFirstName('%fooValue%', Criteria::LIKE); // WHERE contact_person_first_name LIKE '%fooValue%'
     * $query->filterByContactPersonFirstName([1, 'foo'], Criteria::IN); // WHERE contact_person_first_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $contactPersonFirstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByContactPersonFirstName($contactPersonFirstName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $contactPersonFirstName = str_replace('*', '%', $contactPersonFirstName);
        }

        if (is_array($contactPersonFirstName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$contactPersonFirstName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME, $contactPersonFirstName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $contactPersonLastNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonLastName_In(array $contactPersonLastNames)
    {
        return $this->filterByContactPersonLastName($contactPersonLastNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $contactPersonLastName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonLastName_Like($contactPersonLastName)
    {
        return $this->filterByContactPersonLastName($contactPersonLastName, Criteria::LIKE);
    }

    /**
     * Filter the query on the contact_person_last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByContactPersonLastName('fooValue');   // WHERE contact_person_last_name = 'fooValue'
     * $query->filterByContactPersonLastName('%fooValue%', Criteria::LIKE); // WHERE contact_person_last_name LIKE '%fooValue%'
     * $query->filterByContactPersonLastName([1, 'foo'], Criteria::IN); // WHERE contact_person_last_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $contactPersonLastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByContactPersonLastName($contactPersonLastName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $contactPersonLastName = str_replace('*', '%', $contactPersonLastName);
        }

        if (is_array($contactPersonLastName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$contactPersonLastName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME, $contactPersonLastName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $contactPersonPhones Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonPhone_In(array $contactPersonPhones)
    {
        return $this->filterByContactPersonPhone($contactPersonPhones, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $contactPersonPhone Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByContactPersonPhone_Like($contactPersonPhone)
    {
        return $this->filterByContactPersonPhone($contactPersonPhone, Criteria::LIKE);
    }

    /**
     * Filter the query on the contact_person_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByContactPersonPhone('fooValue');   // WHERE contact_person_phone = 'fooValue'
     * $query->filterByContactPersonPhone('%fooValue%', Criteria::LIKE); // WHERE contact_person_phone LIKE '%fooValue%'
     * $query->filterByContactPersonPhone([1, 'foo'], Criteria::IN); // WHERE contact_person_phone IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $contactPersonPhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByContactPersonPhone($contactPersonPhone = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $contactPersonPhone = str_replace('*', '%', $contactPersonPhone);
        }

        if (is_array($contactPersonPhone) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$contactPersonPhone of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE, $contactPersonPhone, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $logoUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLogoUrl_In(array $logoUrls)
    {
        return $this->filterByLogoUrl($logoUrls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $logoUrl Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLogoUrl_Like($logoUrl)
    {
        return $this->filterByLogoUrl($logoUrl, Criteria::LIKE);
    }

    /**
     * Filter the query on the logo_url column
     *
     * Example usage:
     * <code>
     * $query->filterByLogoUrl('fooValue');   // WHERE logo_url = 'fooValue'
     * $query->filterByLogoUrl('%fooValue%', Criteria::LIKE); // WHERE logo_url LIKE '%fooValue%'
     * $query->filterByLogoUrl([1, 'foo'], Criteria::IN); // WHERE logo_url IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $logoUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLogoUrl($logoUrl = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $logoUrl = str_replace('*', '%', $logoUrl);
        }

        if (is_array($logoUrl) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$logoUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_LOGO_URL, $logoUrl, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $publicEmails Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPublicEmail_In(array $publicEmails)
    {
        return $this->filterByPublicEmail($publicEmails, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $publicEmail Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPublicEmail_Like($publicEmail)
    {
        return $this->filterByPublicEmail($publicEmail, Criteria::LIKE);
    }

    /**
     * Filter the query on the public_email column
     *
     * Example usage:
     * <code>
     * $query->filterByPublicEmail('fooValue');   // WHERE public_email = 'fooValue'
     * $query->filterByPublicEmail('%fooValue%', Criteria::LIKE); // WHERE public_email LIKE '%fooValue%'
     * $query->filterByPublicEmail([1, 'foo'], Criteria::IN); // WHERE public_email IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $publicEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPublicEmail($publicEmail = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $publicEmail = str_replace('*', '%', $publicEmail);
        }

        if (is_array($publicEmail) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$publicEmail of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL, $publicEmail, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $publicPhones Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPublicPhone_In(array $publicPhones)
    {
        return $this->filterByPublicPhone($publicPhones, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $publicPhone Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPublicPhone_Like($publicPhone)
    {
        return $this->filterByPublicPhone($publicPhone, Criteria::LIKE);
    }

    /**
     * Filter the query on the public_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPublicPhone('fooValue');   // WHERE public_phone = 'fooValue'
     * $query->filterByPublicPhone('%fooValue%', Criteria::LIKE); // WHERE public_phone LIKE '%fooValue%'
     * $query->filterByPublicPhone([1, 'foo'], Criteria::IN); // WHERE public_phone IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $publicPhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPublicPhone($publicPhone = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $publicPhone = str_replace('*', '%', $publicPhone);
        }

        if (is_array($publicPhone) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$publicPhone of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_PUBLIC_PHONE, $publicPhone, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $faxNumbers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFaxNumber_In(array $faxNumbers)
    {
        return $this->filterByFaxNumber($faxNumbers, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $faxNumber Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFaxNumber_Like($faxNumber)
    {
        return $this->filterByFaxNumber($faxNumber, Criteria::LIKE);
    }

    /**
     * Filter the query on the fax_number column
     *
     * Example usage:
     * <code>
     * $query->filterByFaxNumber('fooValue');   // WHERE fax_number = 'fooValue'
     * $query->filterByFaxNumber('%fooValue%', Criteria::LIKE); // WHERE fax_number LIKE '%fooValue%'
     * $query->filterByFaxNumber([1, 'foo'], Criteria::IN); // WHERE fax_number IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $faxNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFaxNumber($faxNumber = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $faxNumber = str_replace('*', '%', $faxNumber);
        }

        if (is_array($faxNumber) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$faxNumber of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_FAX_NUMBER, $faxNumber, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $descriptionGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescriptionGlossaryKey_In(array $descriptionGlossaryKeys)
    {
        return $this->filterByDescriptionGlossaryKey($descriptionGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $descriptionGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescriptionGlossaryKey_Like($descriptionGlossaryKey)
    {
        return $this->filterByDescriptionGlossaryKey($descriptionGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the description_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByDescriptionGlossaryKey('fooValue');   // WHERE description_glossary_key = 'fooValue'
     * $query->filterByDescriptionGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE description_glossary_key LIKE '%fooValue%'
     * $query->filterByDescriptionGlossaryKey([1, 'foo'], Criteria::IN); // WHERE description_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $descriptionGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDescriptionGlossaryKey($descriptionGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $descriptionGlossaryKey = str_replace('*', '%', $descriptionGlossaryKey);
        }

        if (is_array($descriptionGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$descriptionGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY, $descriptionGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $bannerUrlGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBannerUrlGlossaryKey_In(array $bannerUrlGlossaryKeys)
    {
        return $this->filterByBannerUrlGlossaryKey($bannerUrlGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $bannerUrlGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByBannerUrlGlossaryKey_Like($bannerUrlGlossaryKey)
    {
        return $this->filterByBannerUrlGlossaryKey($bannerUrlGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the banner_url_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByBannerUrlGlossaryKey('fooValue');   // WHERE banner_url_glossary_key = 'fooValue'
     * $query->filterByBannerUrlGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE banner_url_glossary_key LIKE '%fooValue%'
     * $query->filterByBannerUrlGlossaryKey([1, 'foo'], Criteria::IN); // WHERE banner_url_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $bannerUrlGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByBannerUrlGlossaryKey($bannerUrlGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $bannerUrlGlossaryKey = str_replace('*', '%', $bannerUrlGlossaryKey);
        }

        if (is_array($bannerUrlGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$bannerUrlGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY, $bannerUrlGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $deliveryTimeGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeliveryTimeGlossaryKey_In(array $deliveryTimeGlossaryKeys)
    {
        return $this->filterByDeliveryTimeGlossaryKey($deliveryTimeGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $deliveryTimeGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDeliveryTimeGlossaryKey_Like($deliveryTimeGlossaryKey)
    {
        return $this->filterByDeliveryTimeGlossaryKey($deliveryTimeGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the delivery_time_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTimeGlossaryKey('fooValue');   // WHERE delivery_time_glossary_key = 'fooValue'
     * $query->filterByDeliveryTimeGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE delivery_time_glossary_key LIKE '%fooValue%'
     * $query->filterByDeliveryTimeGlossaryKey([1, 'foo'], Criteria::IN); // WHERE delivery_time_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $deliveryTimeGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDeliveryTimeGlossaryKey($deliveryTimeGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $deliveryTimeGlossaryKey = str_replace('*', '%', $deliveryTimeGlossaryKey);
        }

        if (is_array($deliveryTimeGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$deliveryTimeGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY, $deliveryTimeGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $termsConditionsGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTermsConditionsGlossaryKey_In(array $termsConditionsGlossaryKeys)
    {
        return $this->filterByTermsConditionsGlossaryKey($termsConditionsGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $termsConditionsGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTermsConditionsGlossaryKey_Like($termsConditionsGlossaryKey)
    {
        return $this->filterByTermsConditionsGlossaryKey($termsConditionsGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the terms_conditions_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByTermsConditionsGlossaryKey('fooValue');   // WHERE terms_conditions_glossary_key = 'fooValue'
     * $query->filterByTermsConditionsGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE terms_conditions_glossary_key LIKE '%fooValue%'
     * $query->filterByTermsConditionsGlossaryKey([1, 'foo'], Criteria::IN); // WHERE terms_conditions_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $termsConditionsGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTermsConditionsGlossaryKey($termsConditionsGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $termsConditionsGlossaryKey = str_replace('*', '%', $termsConditionsGlossaryKey);
        }

        if (is_array($termsConditionsGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$termsConditionsGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY, $termsConditionsGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $cancellationPolicyGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCancellationPolicyGlossaryKey_In(array $cancellationPolicyGlossaryKeys)
    {
        return $this->filterByCancellationPolicyGlossaryKey($cancellationPolicyGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $cancellationPolicyGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCancellationPolicyGlossaryKey_Like($cancellationPolicyGlossaryKey)
    {
        return $this->filterByCancellationPolicyGlossaryKey($cancellationPolicyGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the cancellation_policy_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByCancellationPolicyGlossaryKey('fooValue');   // WHERE cancellation_policy_glossary_key = 'fooValue'
     * $query->filterByCancellationPolicyGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE cancellation_policy_glossary_key LIKE '%fooValue%'
     * $query->filterByCancellationPolicyGlossaryKey([1, 'foo'], Criteria::IN); // WHERE cancellation_policy_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $cancellationPolicyGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCancellationPolicyGlossaryKey($cancellationPolicyGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $cancellationPolicyGlossaryKey = str_replace('*', '%', $cancellationPolicyGlossaryKey);
        }

        if (is_array($cancellationPolicyGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$cancellationPolicyGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY, $cancellationPolicyGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $imprintGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImprintGlossaryKey_In(array $imprintGlossaryKeys)
    {
        return $this->filterByImprintGlossaryKey($imprintGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $imprintGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImprintGlossaryKey_Like($imprintGlossaryKey)
    {
        return $this->filterByImprintGlossaryKey($imprintGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the imprint_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByImprintGlossaryKey('fooValue');   // WHERE imprint_glossary_key = 'fooValue'
     * $query->filterByImprintGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE imprint_glossary_key LIKE '%fooValue%'
     * $query->filterByImprintGlossaryKey([1, 'foo'], Criteria::IN); // WHERE imprint_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $imprintGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByImprintGlossaryKey($imprintGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $imprintGlossaryKey = str_replace('*', '%', $imprintGlossaryKey);
        }

        if (is_array($imprintGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$imprintGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY, $imprintGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $dataPrivacyGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataPrivacyGlossaryKey_In(array $dataPrivacyGlossaryKeys)
    {
        return $this->filterByDataPrivacyGlossaryKey($dataPrivacyGlossaryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $dataPrivacyGlossaryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDataPrivacyGlossaryKey_Like($dataPrivacyGlossaryKey)
    {
        return $this->filterByDataPrivacyGlossaryKey($dataPrivacyGlossaryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the data_privacy_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByDataPrivacyGlossaryKey('fooValue');   // WHERE data_privacy_glossary_key = 'fooValue'
     * $query->filterByDataPrivacyGlossaryKey('%fooValue%', Criteria::LIKE); // WHERE data_privacy_glossary_key LIKE '%fooValue%'
     * $query->filterByDataPrivacyGlossaryKey([1, 'foo'], Criteria::IN); // WHERE data_privacy_glossary_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $dataPrivacyGlossaryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDataPrivacyGlossaryKey($dataPrivacyGlossaryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $dataPrivacyGlossaryKey = str_replace('*', '%', $dataPrivacyGlossaryKey);
        }

        if (is_array($dataPrivacyGlossaryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$dataPrivacyGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY, $dataPrivacyGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchant Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchant_Between(array $fkMerchant)
    {
        return $this->filterByFkMerchant($fkMerchant, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchants Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchant_In(array $fkMerchants)
    {
        return $this->filterByFkMerchant($fkMerchants, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchant(1234); // WHERE fk_merchant = 1234
     * $query->filterByFkMerchant(array(12, 34), Criteria::IN); // WHERE fk_merchant IN (12, 34)
     * $query->filterByFkMerchant(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant > 12
     * </code>
     *
     * @see       filterBySpyMerchant()
     *
     * @param     mixed $fkMerchant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchant($fkMerchant = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchant)) {
            $useMinMax = false;
            if (isset($fkMerchant['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileTableMap::COL_FK_MERCHANT, $fkMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantProfileTableMap::COL_FK_MERCHANT, $fkMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantProfileTableMap::COL_FK_MERCHANT, $fkMerchant, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchant|ObjectCollection $spyMerchant The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchant($spyMerchant, ?string $comparison = null)
    {
        if ($spyMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) {
            return $this
                ->addUsingAlias(SpyMerchantProfileTableMap::COL_FK_MERCHANT, $spyMerchant->getIdMerchant(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantProfileTableMap::COL_FK_MERCHANT, $spyMerchant->toKeyValue('PrimaryKey', 'IdMerchant'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchant');

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
            $this->addJoinObject($join, 'SpyMerchant');
        }

        return $this;
    }

    /**
     * Use the SpyMerchant relation SpyMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchant', '\Orm\Zed\Merchant\Persistence\SpyMerchantQuery');
    }

    /**
     * Use the SpyMerchant relation SpyMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('SpyMerchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for a NOT EXISTS query.
     *
     * @see useSpyMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('SpyMerchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('SpyMerchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchant table for a NOT IN query.
     *
     * @see useSpyMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('SpyMerchant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress object
     *
     * @param \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress|ObjectCollection $spyMerchantProfileAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantProfileAddress($spyMerchantProfileAddress, ?string $comparison = null)
    {
        if ($spyMerchantProfileAddress instanceof \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress) {
            $this
                ->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $spyMerchantProfileAddress->getFkMerchantProfile(), $comparison);

            return $this;
        } elseif ($spyMerchantProfileAddress instanceof ObjectCollection) {
            $this
                ->useSpyMerchantProfileAddressQuery()
                ->filterByPrimaryKeys($spyMerchantProfileAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantProfileAddress() only accepts arguments of type \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantProfileAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantProfileAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantProfileAddress');

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
            $this->addJoinObject($join, 'SpyMerchantProfileAddress');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantProfileAddress relation SpyMerchantProfileAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantProfileAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantProfileAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantProfileAddress', '\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery');
    }

    /**
     * Use the SpyMerchantProfileAddress relation SpyMerchantProfileAddress object
     *
     * @param callable(\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery):\Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantProfileAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantProfileAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantProfileAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useExistsQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for a NOT EXISTS query.
     *
     * @see useSpyMerchantProfileAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantProfileAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useExistsQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantProfileAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useInQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantProfileAddress table for a NOT IN query.
     *
     * @see useSpyMerchantProfileAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantProfileAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery */
        $q = $this->useInQuery('SpyMerchantProfileAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchantProfile $spyMerchantProfile Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantProfile = null)
    {
        if ($spyMerchantProfile) {
            $this->addUsingAlias(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, $spyMerchantProfile->getIdMerchantProfile(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant_profile table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantProfileTableMap::clearInstancePool();
            SpyMerchantProfileTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantProfileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantProfileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantProfileTableMap::clearRelatedInstancePool();

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
