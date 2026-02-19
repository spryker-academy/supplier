<?php

namespace Orm\Zed\CompanyUnitAddress\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress as ChildSpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery as ChildSpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Orm\Zed\Company\Persistence\SpyCompany;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyRegion;
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
 * Base class that represents a query for the `spy_company_unit_address` table.
 *
 * @method     ChildSpyCompanyUnitAddressQuery orderByIdCompanyUnitAddress($order = Criteria::ASC) Order by the id_company_unit_address column
 * @method     ChildSpyCompanyUnitAddressQuery orderByFkCompany($order = Criteria::ASC) Order by the fk_company column
 * @method     ChildSpyCompanyUnitAddressQuery orderByFkCountry($order = Criteria::ASC) Order by the fk_country column
 * @method     ChildSpyCompanyUnitAddressQuery orderByFkRegion($order = Criteria::ASC) Order by the fk_region column
 * @method     ChildSpyCompanyUnitAddressQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method     ChildSpyCompanyUnitAddressQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method     ChildSpyCompanyUnitAddressQuery orderByAddress3($order = Criteria::ASC) Order by the address3 column
 * @method     ChildSpyCompanyUnitAddressQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildSpyCompanyUnitAddressQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildSpyCompanyUnitAddressQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyCompanyUnitAddressQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildSpyCompanyUnitAddressQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpyCompanyUnitAddressQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 *
 * @method     ChildSpyCompanyUnitAddressQuery groupByIdCompanyUnitAddress() Group by the id_company_unit_address column
 * @method     ChildSpyCompanyUnitAddressQuery groupByFkCompany() Group by the fk_company column
 * @method     ChildSpyCompanyUnitAddressQuery groupByFkCountry() Group by the fk_country column
 * @method     ChildSpyCompanyUnitAddressQuery groupByFkRegion() Group by the fk_region column
 * @method     ChildSpyCompanyUnitAddressQuery groupByAddress1() Group by the address1 column
 * @method     ChildSpyCompanyUnitAddressQuery groupByAddress2() Group by the address2 column
 * @method     ChildSpyCompanyUnitAddressQuery groupByAddress3() Group by the address3 column
 * @method     ChildSpyCompanyUnitAddressQuery groupByCity() Group by the city column
 * @method     ChildSpyCompanyUnitAddressQuery groupByComment() Group by the comment column
 * @method     ChildSpyCompanyUnitAddressQuery groupByKey() Group by the key column
 * @method     ChildSpyCompanyUnitAddressQuery groupByPhone() Group by the phone column
 * @method     ChildSpyCompanyUnitAddressQuery groupByUuid() Group by the uuid column
 * @method     ChildSpyCompanyUnitAddressQuery groupByZipCode() Group by the zip_code column
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCompanyUnitAddressQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCompanyUnitAddressQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery joinWithCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Country relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWithCountry() Adds a LEFT JOIN clause and with to the query using the Country relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWithCountry() Adds a RIGHT JOIN clause and with to the query using the Country relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWithCountry() Adds a INNER JOIN clause and with to the query using the Country relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery joinWithRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Region relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWithRegion() Adds a LEFT JOIN clause and with to the query using the Region relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWithRegion() Adds a RIGHT JOIN clause and with to the query using the Region relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWithRegion() Adds a INNER JOIN clause and with to the query using the Region relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinCompany($relationAlias = null) Adds a LEFT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinCompany($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Company relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinCompany($relationAlias = null) Adds a INNER JOIN clause to the query using the Company relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery joinWithCompany($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWithCompany() Adds a LEFT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWithCompany() Adds a RIGHT JOIN clause and with to the query using the Company relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWithCompany() Adds a INNER JOIN clause and with to the query using the Company relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinSpyCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinSpyCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinSpyCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery joinWithSpyCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWithSpyCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWithSpyCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWithSpyCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinSpyCompanyUnitAddressToCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery joinWithSpyCompanyUnitAddressToCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWithSpyCompanyUnitAddressToCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWithSpyCompanyUnitAddressToCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWithSpyCompanyUnitAddressToCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyCompanyUnitAddressToCompanyBusinessUnit relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinSpyCompanyUnitAddressLabelToCompanyUnitAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinSpyCompanyUnitAddressLabelToCompanyUnitAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinSpyCompanyUnitAddressLabelToCompanyUnitAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery joinWithSpyCompanyUnitAddressLabelToCompanyUnitAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 *
 * @method     ChildSpyCompanyUnitAddressQuery leftJoinWithSpyCompanyUnitAddressLabelToCompanyUnitAddress() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 * @method     ChildSpyCompanyUnitAddressQuery rightJoinWithSpyCompanyUnitAddressLabelToCompanyUnitAddress() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 * @method     ChildSpyCompanyUnitAddressQuery innerJoinWithSpyCompanyUnitAddressLabelToCompanyUnitAddress() Adds a INNER JOIN clause and with to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
 *
 * @method     \Orm\Zed\Country\Persistence\SpyCountryQuery|\Orm\Zed\Country\Persistence\SpyRegionQuery|\Orm\Zed\Company\Persistence\SpyCompanyQuery|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery|\Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressToCompanyBusinessUnitQuery|\Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCompanyUnitAddress|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyUnitAddress matching the query
 * @method     ChildSpyCompanyUnitAddress findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCompanyUnitAddress matching the query, or a new ChildSpyCompanyUnitAddress object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCompanyUnitAddress|null findOneByIdCompanyUnitAddress(int $id_company_unit_address) Return the first ChildSpyCompanyUnitAddress filtered by the id_company_unit_address column
 * @method     ChildSpyCompanyUnitAddress|null findOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyUnitAddress filtered by the fk_company column
 * @method     ChildSpyCompanyUnitAddress|null findOneByFkCountry(int $fk_country) Return the first ChildSpyCompanyUnitAddress filtered by the fk_country column
 * @method     ChildSpyCompanyUnitAddress|null findOneByFkRegion(int $fk_region) Return the first ChildSpyCompanyUnitAddress filtered by the fk_region column
 * @method     ChildSpyCompanyUnitAddress|null findOneByAddress1(string $address1) Return the first ChildSpyCompanyUnitAddress filtered by the address1 column
 * @method     ChildSpyCompanyUnitAddress|null findOneByAddress2(string $address2) Return the first ChildSpyCompanyUnitAddress filtered by the address2 column
 * @method     ChildSpyCompanyUnitAddress|null findOneByAddress3(string $address3) Return the first ChildSpyCompanyUnitAddress filtered by the address3 column
 * @method     ChildSpyCompanyUnitAddress|null findOneByCity(string $city) Return the first ChildSpyCompanyUnitAddress filtered by the city column
 * @method     ChildSpyCompanyUnitAddress|null findOneByComment(string $comment) Return the first ChildSpyCompanyUnitAddress filtered by the comment column
 * @method     ChildSpyCompanyUnitAddress|null findOneByKey(string $key) Return the first ChildSpyCompanyUnitAddress filtered by the key column
 * @method     ChildSpyCompanyUnitAddress|null findOneByPhone(string $phone) Return the first ChildSpyCompanyUnitAddress filtered by the phone column
 * @method     ChildSpyCompanyUnitAddress|null findOneByUuid(string $uuid) Return the first ChildSpyCompanyUnitAddress filtered by the uuid column
 * @method     ChildSpyCompanyUnitAddress|null findOneByZipCode(string $zip_code) Return the first ChildSpyCompanyUnitAddress filtered by the zip_code column
 *
 * @method     ChildSpyCompanyUnitAddress requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCompanyUnitAddress by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCompanyUnitAddress matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyUnitAddress requireOneByIdCompanyUnitAddress(int $id_company_unit_address) Return the first ChildSpyCompanyUnitAddress filtered by the id_company_unit_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByFkCompany(int $fk_company) Return the first ChildSpyCompanyUnitAddress filtered by the fk_company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByFkCountry(int $fk_country) Return the first ChildSpyCompanyUnitAddress filtered by the fk_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByFkRegion(int $fk_region) Return the first ChildSpyCompanyUnitAddress filtered by the fk_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByAddress1(string $address1) Return the first ChildSpyCompanyUnitAddress filtered by the address1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByAddress2(string $address2) Return the first ChildSpyCompanyUnitAddress filtered by the address2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByAddress3(string $address3) Return the first ChildSpyCompanyUnitAddress filtered by the address3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByCity(string $city) Return the first ChildSpyCompanyUnitAddress filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByComment(string $comment) Return the first ChildSpyCompanyUnitAddress filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByKey(string $key) Return the first ChildSpyCompanyUnitAddress filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByPhone(string $phone) Return the first ChildSpyCompanyUnitAddress filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByUuid(string $uuid) Return the first ChildSpyCompanyUnitAddress filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCompanyUnitAddress requireOneByZipCode(string $zip_code) Return the first ChildSpyCompanyUnitAddress filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCompanyUnitAddress[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCompanyUnitAddress objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> find(?ConnectionInterface $con = null) Return ChildSpyCompanyUnitAddress objects based on current ModelCriteria
 *
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByIdCompanyUnitAddress(int|array<int> $id_company_unit_address) Return ChildSpyCompanyUnitAddress objects filtered by the id_company_unit_address column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByIdCompanyUnitAddress(int|array<int> $id_company_unit_address) Return ChildSpyCompanyUnitAddress objects filtered by the id_company_unit_address column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyUnitAddress objects filtered by the fk_company column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByFkCompany(int|array<int> $fk_company) Return ChildSpyCompanyUnitAddress objects filtered by the fk_company column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByFkCountry(int|array<int> $fk_country) Return ChildSpyCompanyUnitAddress objects filtered by the fk_country column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByFkCountry(int|array<int> $fk_country) Return ChildSpyCompanyUnitAddress objects filtered by the fk_country column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByFkRegion(int|array<int> $fk_region) Return ChildSpyCompanyUnitAddress objects filtered by the fk_region column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByFkRegion(int|array<int> $fk_region) Return ChildSpyCompanyUnitAddress objects filtered by the fk_region column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByAddress1(string|array<string> $address1) Return ChildSpyCompanyUnitAddress objects filtered by the address1 column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByAddress1(string|array<string> $address1) Return ChildSpyCompanyUnitAddress objects filtered by the address1 column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByAddress2(string|array<string> $address2) Return ChildSpyCompanyUnitAddress objects filtered by the address2 column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByAddress2(string|array<string> $address2) Return ChildSpyCompanyUnitAddress objects filtered by the address2 column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByAddress3(string|array<string> $address3) Return ChildSpyCompanyUnitAddress objects filtered by the address3 column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByAddress3(string|array<string> $address3) Return ChildSpyCompanyUnitAddress objects filtered by the address3 column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByCity(string|array<string> $city) Return ChildSpyCompanyUnitAddress objects filtered by the city column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByCity(string|array<string> $city) Return ChildSpyCompanyUnitAddress objects filtered by the city column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByComment(string|array<string> $comment) Return ChildSpyCompanyUnitAddress objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByComment(string|array<string> $comment) Return ChildSpyCompanyUnitAddress objects filtered by the comment column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByKey(string|array<string> $key) Return ChildSpyCompanyUnitAddress objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByKey(string|array<string> $key) Return ChildSpyCompanyUnitAddress objects filtered by the key column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByPhone(string|array<string> $phone) Return ChildSpyCompanyUnitAddress objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByPhone(string|array<string> $phone) Return ChildSpyCompanyUnitAddress objects filtered by the phone column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyCompanyUnitAddress objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByUuid(string|array<string> $uuid) Return ChildSpyCompanyUnitAddress objects filtered by the uuid column
 * @method     ChildSpyCompanyUnitAddress[]|Collection findByZipCode(string|array<string> $zip_code) Return ChildSpyCompanyUnitAddress objects filtered by the zip_code column
 * @psalm-method Collection&\Traversable<ChildSpyCompanyUnitAddress> findByZipCode(string|array<string> $zip_code) Return ChildSpyCompanyUnitAddress objects filtered by the zip_code column
 *
 * @method     ChildSpyCompanyUnitAddress[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCompanyUnitAddress> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCompanyUnitAddressQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddressQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddress', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCompanyUnitAddressQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCompanyUnitAddressQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCompanyUnitAddressQuery) {
            return $criteria;
        }
        $query = new ChildSpyCompanyUnitAddressQuery();
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
     * @return ChildSpyCompanyUnitAddress|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCompanyUnitAddressTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCompanyUnitAddress A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_company_unit_address`, `fk_company`, `fk_country`, `fk_region`, `address1`, `address2`, `address3`, `city`, `comment`, `key`, `phone`, `uuid`, `zip_code` FROM `spy_company_unit_address` WHERE `id_company_unit_address` = :p0';
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
            /** @var ChildSpyCompanyUnitAddress $obj */
            $obj = new ChildSpyCompanyUnitAddress();
            $obj->hydrate($row);
            SpyCompanyUnitAddressTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCompanyUnitAddress|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCompanyUnitAddress Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyUnitAddress_Between(array $idCompanyUnitAddress)
    {
        return $this->filterByIdCompanyUnitAddress($idCompanyUnitAddress, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCompanyUnitAddresss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCompanyUnitAddress_In(array $idCompanyUnitAddresss)
    {
        return $this->filterByIdCompanyUnitAddress($idCompanyUnitAddresss, Criteria::IN);
    }

    /**
     * Filter the query on the id_company_unit_address column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCompanyUnitAddress(1234); // WHERE id_company_unit_address = 1234
     * $query->filterByIdCompanyUnitAddress(array(12, 34), Criteria::IN); // WHERE id_company_unit_address IN (12, 34)
     * $query->filterByIdCompanyUnitAddress(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_company_unit_address > 12
     * </code>
     *
     * @param     mixed $idCompanyUnitAddress The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCompanyUnitAddress($idCompanyUnitAddress = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCompanyUnitAddress)) {
            $useMinMax = false;
            if (isset($idCompanyUnitAddress['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $idCompanyUnitAddress['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCompanyUnitAddress['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $idCompanyUnitAddress['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCompanyUnitAddress of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $idCompanyUnitAddress, $comparison);

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
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, $fkCompany['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompany['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, $fkCompany['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompany of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, $fkCompany, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCountry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_Between(array $fkCountry)
    {
        return $this->filterByFkCountry($fkCountry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCountrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_In(array $fkCountrys)
    {
        return $this->filterByFkCountry($fkCountrys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_country column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCountry(1234); // WHERE fk_country = 1234
     * $query->filterByFkCountry(array(12, 34), Criteria::IN); // WHERE fk_country IN (12, 34)
     * $query->filterByFkCountry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_country > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $fkCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCountry($fkCountry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCountry)) {
            $useMinMax = false;
            if (isset($fkCountry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, $fkCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCountry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, $fkCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCountry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, $fkCountry, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkRegion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkRegion_Between(array $fkRegion)
    {
        return $this->filterByFkRegion($fkRegion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkRegions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkRegion_In(array $fkRegions)
    {
        return $this->filterByFkRegion($fkRegions, Criteria::IN);
    }

    /**
     * Filter the query on the fk_region column
     *
     * Example usage:
     * <code>
     * $query->filterByFkRegion(1234); // WHERE fk_region = 1234
     * $query->filterByFkRegion(array(12, 34), Criteria::IN); // WHERE fk_region IN (12, 34)
     * $query->filterByFkRegion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_region > 12
     * </code>
     *
     * @see       filterByRegion()
     *
     * @param     mixed $fkRegion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkRegion($fkRegion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkRegion)) {
            $useMinMax = false;
            if (isset($fkRegion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_REGION, $fkRegion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkRegion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_REGION, $fkRegion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkRegion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_REGION, $fkRegion, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address1s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_In(array $address1s)
    {
        return $this->filterByAddress1($address1s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address1 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_Like($address1)
    {
        return $this->filterByAddress1($address1, Criteria::LIKE);
    }

    /**
     * Filter the query on the address1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%', Criteria::LIKE); // WHERE address1 LIKE '%fooValue%'
     * $query->filterByAddress1([1, 'foo'], Criteria::IN); // WHERE address1 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress1($address1 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address1 = str_replace('*', '%', $address1);
        }

        if (is_array($address1) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address1 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ADDRESS1, $address1, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address2s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_In(array $address2s)
    {
        return $this->filterByAddress2($address2s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address2 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_Like($address2)
    {
        return $this->filterByAddress2($address2, Criteria::LIKE);
    }

    /**
     * Filter the query on the address2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%', Criteria::LIKE); // WHERE address2 LIKE '%fooValue%'
     * $query->filterByAddress2([1, 'foo'], Criteria::IN); // WHERE address2 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress2($address2 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address2 = str_replace('*', '%', $address2);
        }

        if (is_array($address2) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address2 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ADDRESS2, $address2, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address3s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_In(array $address3s)
    {
        return $this->filterByAddress3($address3s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address3 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_Like($address3)
    {
        return $this->filterByAddress3($address3, Criteria::LIKE);
    }

    /**
     * Filter the query on the address3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress3('fooValue');   // WHERE address3 = 'fooValue'
     * $query->filterByAddress3('%fooValue%', Criteria::LIKE); // WHERE address3 LIKE '%fooValue%'
     * $query->filterByAddress3([1, 'foo'], Criteria::IN); // WHERE address3 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress3($address3 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address3 = str_replace('*', '%', $address3);
        }

        if (is_array($address3) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address3 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ADDRESS3, $address3, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $citys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_In(array $citys)
    {
        return $this->filterByCity($citys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $city Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_Like($city)
    {
        return $this->filterByCity($city, Criteria::LIKE);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * $query->filterByCity([1, 'foo'], Criteria::IN); // WHERE city IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCity($city = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $city = str_replace('*', '%', $city);
        }

        if (is_array($city) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$city of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_CITY, $city, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $comments Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment_In(array $comments)
    {
        return $this->filterByComment($comments, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $comment Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment_Like($comment)
    {
        return $this->filterByComment($comment, Criteria::LIKE);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * $query->filterByComment([1, 'foo'], Criteria::IN); // WHERE comment IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $comment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByComment($comment = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $comment = str_replace('*', '%', $comment);
        }

        if (is_array($comment) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$comment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_COMMENT, $comment, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_KEY, $key, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_PHONE, $phone, $comparison);

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

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_UUID, $uuid, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $zipCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_In(array $zipCodes)
    {
        return $this->filterByZipCode($zipCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $zipCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_Like($zipCode)
    {
        return $this->filterByZipCode($zipCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%', Criteria::LIKE); // WHERE zip_code LIKE '%fooValue%'
     * $query->filterByZipCode([1, 'foo'], Criteria::IN); // WHERE zip_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $zipCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByZipCode($zipCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $zipCode = str_replace('*', '%', $zipCode);
        }

        if (is_array($zipCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$zipCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ZIP_CODE, $zipCode, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyCountry object
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountry|ObjectCollection $spyCountry The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountry($spyCountry, ?string $comparison = null)
    {
        if ($spyCountry instanceof \Orm\Zed\Country\Persistence\SpyCountry) {
            return $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, $spyCountry->getIdCountry(), $comparison);
        } elseif ($spyCountry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, $spyCountry->toKeyValue('PrimaryKey', 'IdCountry'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyCountry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCountry(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation SpyCountry object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\Orm\Zed\Country\Persistence\SpyCountryQuery');
    }

    /**
     * Use the Country relation SpyCountry object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyCountryQuery):\Orm\Zed\Country\Persistence\SpyCountryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCountryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCountryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Country relation to the SpyCountry table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the EXISTS statement
     */
    public function useCountryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useExistsQuery('Country', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Country relation to the SpyCountry table for a NOT EXISTS query.
     *
     * @see useCountryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT EXISTS statement
     */
    public function useCountryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useExistsQuery('Country', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Country relation to the SpyCountry table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the IN statement
     */
    public function useInCountryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useInQuery('Country', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Country relation to the SpyCountry table for a NOT IN query.
     *
     * @see useCountryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT IN statement
     */
    public function useNotInCountryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useInQuery('Country', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyRegion object
     *
     * @param \Orm\Zed\Country\Persistence\SpyRegion|ObjectCollection $spyRegion The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($spyRegion, ?string $comparison = null)
    {
        if ($spyRegion instanceof \Orm\Zed\Country\Persistence\SpyRegion) {
            return $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_REGION, $spyRegion->getIdRegion(), $comparison);
        } elseif ($spyRegion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_REGION, $spyRegion->toKeyValue('PrimaryKey', 'IdRegion'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByRegion() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyRegion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Region relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRegion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Region');

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
            $this->addJoinObject($join, 'Region');
        }

        return $this;
    }

    /**
     * Use the Region relation SpyRegion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery A secondary query class using the current class as primary query
     */
    public function useRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Region', '\Orm\Zed\Country\Persistence\SpyRegionQuery');
    }

    /**
     * Use the Region relation SpyRegion object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyRegionQuery):\Orm\Zed\Country\Persistence\SpyRegionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRegionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useRegionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Region relation to the SpyRegion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the EXISTS statement
     */
    public function useRegionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useExistsQuery('Region', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Region relation to the SpyRegion table for a NOT EXISTS query.
     *
     * @see useRegionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT EXISTS statement
     */
    public function useRegionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useExistsQuery('Region', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Region relation to the SpyRegion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the IN statement
     */
    public function useInRegionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useInQuery('Region', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Region relation to the SpyRegion table for a NOT IN query.
     *
     * @see useRegionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT IN statement
     */
    public function useNotInRegionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useInQuery('Region', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, $spyCompany->getIdCompany(), $comparison);
        } elseif ($spyCompany instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, $spyCompany->toKeyValue('PrimaryKey', 'IdCompany'), $comparison);

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
    public function joinCompany(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useCompanyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * @param \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit|ObjectCollection $spyCompanyBusinessUnit the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyBusinessUnit($spyCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnit instanceof \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit) {
            $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $spyCompanyBusinessUnit->getDefaultBillingAddress(), $comparison);

            return $this;
        } elseif ($spyCompanyBusinessUnit instanceof ObjectCollection) {
            $this
                ->useSpyCompanyBusinessUnitQuery()
                ->filterByPrimaryKeys($spyCompanyBusinessUnit->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyBusinessUnit() only accepts arguments of type \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyBusinessUnit relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyBusinessUnit');

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
            $this->addJoinObject($join, 'SpyCompanyBusinessUnit');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyBusinessUnit relation SpyCompanyBusinessUnit object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCompanyBusinessUnit($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyBusinessUnit', '\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery');
    }

    /**
     * Use the SpyCompanyBusinessUnit relation SpyCompanyBusinessUnit object
     *
     * @param callable(\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery):\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyBusinessUnitQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyBusinessUnitQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnit table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyBusinessUnitExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnit table for a NOT EXISTS query.
     *
     * @see useSpyCompanyBusinessUnitExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyBusinessUnitNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useExistsQuery('SpyCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnit table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyCompanyBusinessUnit', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyBusinessUnit table for a NOT IN query.
     *
     * @see useSpyCompanyBusinessUnitInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyBusinessUnitQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery */
        $q = $this->useInQuery('SpyCompanyBusinessUnit', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $spyCompanyUnitAddressToCompanyBusinessUnit->getFkCompanyUnitAddress(), $comparison);

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
     * Filter the query by a related \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress object
     *
     * @param \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress|ObjectCollection $spyCompanyUnitAddressLabelToCompanyUnitAddress the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCompanyUnitAddressLabelToCompanyUnitAddress($spyCompanyUnitAddressLabelToCompanyUnitAddress, ?string $comparison = null)
    {
        if ($spyCompanyUnitAddressLabelToCompanyUnitAddress instanceof \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress) {
            $this
                ->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $spyCompanyUnitAddressLabelToCompanyUnitAddress->getFkCompanyUnitAddress(), $comparison);

            return $this;
        } elseif ($spyCompanyUnitAddressLabelToCompanyUnitAddress instanceof ObjectCollection) {
            $this
                ->useSpyCompanyUnitAddressLabelToCompanyUnitAddressQuery()
                ->filterByPrimaryKeys($spyCompanyUnitAddressLabelToCompanyUnitAddress->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUnitAddressLabelToCompanyUnitAddress() only accepts arguments of type \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUnitAddressLabelToCompanyUnitAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUnitAddressLabelToCompanyUnitAddress');

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
            $this->addJoinObject($join, 'SpyCompanyUnitAddressLabelToCompanyUnitAddress');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation SpyCompanyUnitAddressLabelToCompanyUnitAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUnitAddressLabelToCompanyUnitAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCompanyUnitAddressLabelToCompanyUnitAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUnitAddressLabelToCompanyUnitAddress', '\Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery');
    }

    /**
     * Use the SpyCompanyUnitAddressLabelToCompanyUnitAddress relation SpyCompanyUnitAddressLabelToCompanyUnitAddress object
     *
     * @param callable(\Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery):\Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUnitAddressLabelToCompanyUnitAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUnitAddressLabelToCompanyUnitAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressLabelToCompanyUnitAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUnitAddressLabelToCompanyUnitAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery */
        $q = $this->useExistsQuery('SpyCompanyUnitAddressLabelToCompanyUnitAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressLabelToCompanyUnitAddress table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUnitAddressLabelToCompanyUnitAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUnitAddressLabelToCompanyUnitAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery */
        $q = $this->useExistsQuery('SpyCompanyUnitAddressLabelToCompanyUnitAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressLabelToCompanyUnitAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUnitAddressLabelToCompanyUnitAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery */
        $q = $this->useInQuery('SpyCompanyUnitAddressLabelToCompanyUnitAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUnitAddressLabelToCompanyUnitAddress table for a NOT IN query.
     *
     * @see useSpyCompanyUnitAddressLabelToCompanyUnitAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUnitAddressLabelToCompanyUnitAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUnitAddressLabel\Persistence\SpyCompanyUnitAddressLabelToCompanyUnitAddressQuery */
        $q = $this->useInQuery('SpyCompanyUnitAddressLabelToCompanyUnitAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCompanyUnitAddress $spyCompanyUnitAddress Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCompanyUnitAddress = null)
    {
        if ($spyCompanyUnitAddress) {
            $this->addUsingAlias(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, $spyCompanyUnitAddress->getIdCompanyUnitAddress(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_company_unit_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCompanyUnitAddressTableMap::clearInstancePool();
            SpyCompanyUnitAddressTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCompanyUnitAddressTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCompanyUnitAddressTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCompanyUnitAddressTableMap::clearRelatedInstancePool();

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
