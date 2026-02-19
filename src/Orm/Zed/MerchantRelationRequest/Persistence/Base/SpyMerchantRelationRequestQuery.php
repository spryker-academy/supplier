<?php

namespace Orm\Zed\MerchantRelationRequest\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest as ChildSpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery as ChildSpyMerchantRelationRequestQuery;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
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
 * Base class that represents a query for the `spy_merchant_relation_request` table.
 *
 * @method     ChildSpyMerchantRelationRequestQuery orderByIdMerchantRelationRequest($order = Criteria::ASC) Order by the id_merchant_relation_request column
 * @method     ChildSpyMerchantRelationRequestQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpyMerchantRelationRequestQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSpyMerchantRelationRequestQuery orderByIsSplitEnabled($order = Criteria::ASC) Order by the is_split_enabled column
 * @method     ChildSpyMerchantRelationRequestQuery orderByRequestNote($order = Criteria::ASC) Order by the request_note column
 * @method     ChildSpyMerchantRelationRequestQuery orderByDecisionNote($order = Criteria::ASC) Order by the decision_note column
 * @method     ChildSpyMerchantRelationRequestQuery orderByFkCompanyUser($order = Criteria::ASC) Order by the fk_company_user column
 * @method     ChildSpyMerchantRelationRequestQuery orderByFkMerchant($order = Criteria::ASC) Order by the fk_merchant column
 * @method     ChildSpyMerchantRelationRequestQuery orderByFkCompanyBusinessUnit($order = Criteria::ASC) Order by the fk_company_business_unit column
 * @method     ChildSpyMerchantRelationRequestQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyMerchantRelationRequestQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyMerchantRelationRequestQuery groupByIdMerchantRelationRequest() Group by the id_merchant_relation_request column
 * @method     ChildSpyMerchantRelationRequestQuery groupByUuid() Group by the uuid column
 * @method     ChildSpyMerchantRelationRequestQuery groupByStatus() Group by the status column
 * @method     ChildSpyMerchantRelationRequestQuery groupByIsSplitEnabled() Group by the is_split_enabled column
 * @method     ChildSpyMerchantRelationRequestQuery groupByRequestNote() Group by the request_note column
 * @method     ChildSpyMerchantRelationRequestQuery groupByDecisionNote() Group by the decision_note column
 * @method     ChildSpyMerchantRelationRequestQuery groupByFkCompanyUser() Group by the fk_company_user column
 * @method     ChildSpyMerchantRelationRequestQuery groupByFkMerchant() Group by the fk_merchant column
 * @method     ChildSpyMerchantRelationRequestQuery groupByFkCompanyBusinessUnit() Group by the fk_company_business_unit column
 * @method     ChildSpyMerchantRelationRequestQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyMerchantRelationRequestQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantRelationRequestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantRelationRequestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyUser relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyUser relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyUser relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery joinWithCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyUser relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinWithCompanyUser() Adds a LEFT JOIN clause and with to the query using the CompanyUser relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinWithCompanyUser() Adds a RIGHT JOIN clause and with to the query using the CompanyUser relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinWithCompanyUser() Adds a INNER JOIN clause and with to the query using the CompanyUser relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Merchant relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Merchant relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the Merchant relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery joinWithMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Merchant relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinWithMerchant() Adds a LEFT JOIN clause and with to the query using the Merchant relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinWithMerchant() Adds a RIGHT JOIN clause and with to the query using the Merchant relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinWithMerchant() Adds a INNER JOIN clause and with to the query using the Merchant relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the CompanyBusinessUnit relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery joinWithCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CompanyBusinessUnit relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinWithCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinWithCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the CompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinWithCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the CompanyBusinessUnit relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinSpyMerchantRelationRequestToCompanyBusinessUnit($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery joinWithSpyMerchantRelationRequestToCompanyBusinessUnit($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 *
 * @method     ChildSpyMerchantRelationRequestQuery leftJoinWithSpyMerchantRelationRequestToCompanyBusinessUnit() Adds a LEFT JOIN clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery rightJoinWithSpyMerchantRelationRequestToCompanyBusinessUnit() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 * @method     ChildSpyMerchantRelationRequestQuery innerJoinWithSpyMerchantRelationRequestToCompanyBusinessUnit() Adds a INNER JOIN clause and with to the query using the SpyMerchantRelationRequestToCompanyBusinessUnit relation
 *
 * @method     \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery|\Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery|\Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantRelationRequest|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantRelationRequest matching the query
 * @method     ChildSpyMerchantRelationRequest findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantRelationRequest matching the query, or a new ChildSpyMerchantRelationRequest object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantRelationRequest|null findOneByIdMerchantRelationRequest(int $id_merchant_relation_request) Return the first ChildSpyMerchantRelationRequest filtered by the id_merchant_relation_request column
 * @method     ChildSpyMerchantRelationRequest|null findOneByUuid(string $uuid) Return the first ChildSpyMerchantRelationRequest filtered by the uuid column
 * @method     ChildSpyMerchantRelationRequest|null findOneByStatus(string $status) Return the first ChildSpyMerchantRelationRequest filtered by the status column
 * @method     ChildSpyMerchantRelationRequest|null findOneByIsSplitEnabled(boolean $is_split_enabled) Return the first ChildSpyMerchantRelationRequest filtered by the is_split_enabled column
 * @method     ChildSpyMerchantRelationRequest|null findOneByRequestNote(string $request_note) Return the first ChildSpyMerchantRelationRequest filtered by the request_note column
 * @method     ChildSpyMerchantRelationRequest|null findOneByDecisionNote(string $decision_note) Return the first ChildSpyMerchantRelationRequest filtered by the decision_note column
 * @method     ChildSpyMerchantRelationRequest|null findOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpyMerchantRelationRequest filtered by the fk_company_user column
 * @method     ChildSpyMerchantRelationRequest|null findOneByFkMerchant(int $fk_merchant) Return the first ChildSpyMerchantRelationRequest filtered by the fk_merchant column
 * @method     ChildSpyMerchantRelationRequest|null findOneByFkCompanyBusinessUnit(int $fk_company_business_unit) Return the first ChildSpyMerchantRelationRequest filtered by the fk_company_business_unit column
 * @method     ChildSpyMerchantRelationRequest|null findOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantRelationRequest filtered by the created_at column
 * @method     ChildSpyMerchantRelationRequest|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantRelationRequest filtered by the updated_at column
 *
 * @method     ChildSpyMerchantRelationRequest requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantRelationRequest by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantRelationRequest matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantRelationRequest requireOneByIdMerchantRelationRequest(int $id_merchant_relation_request) Return the first ChildSpyMerchantRelationRequest filtered by the id_merchant_relation_request column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByUuid(string $uuid) Return the first ChildSpyMerchantRelationRequest filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByStatus(string $status) Return the first ChildSpyMerchantRelationRequest filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByIsSplitEnabled(boolean $is_split_enabled) Return the first ChildSpyMerchantRelationRequest filtered by the is_split_enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByRequestNote(string $request_note) Return the first ChildSpyMerchantRelationRequest filtered by the request_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByDecisionNote(string $decision_note) Return the first ChildSpyMerchantRelationRequest filtered by the decision_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpyMerchantRelationRequest filtered by the fk_company_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByFkMerchant(int $fk_merchant) Return the first ChildSpyMerchantRelationRequest filtered by the fk_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByFkCompanyBusinessUnit(int $fk_company_business_unit) Return the first ChildSpyMerchantRelationRequest filtered by the fk_company_business_unit column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantRelationRequest filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantRelationRequest requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantRelationRequest filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantRelationRequest[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantRelationRequest objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> find(?ConnectionInterface $con = null) Return ChildSpyMerchantRelationRequest objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByIdMerchantRelationRequest(int|array<int> $id_merchant_relation_request) Return ChildSpyMerchantRelationRequest objects filtered by the id_merchant_relation_request column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByIdMerchantRelationRequest(int|array<int> $id_merchant_relation_request) Return ChildSpyMerchantRelationRequest objects filtered by the id_merchant_relation_request column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyMerchantRelationRequest objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByUuid(string|array<string> $uuid) Return ChildSpyMerchantRelationRequest objects filtered by the uuid column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByStatus(string|array<string> $status) Return ChildSpyMerchantRelationRequest objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByStatus(string|array<string> $status) Return ChildSpyMerchantRelationRequest objects filtered by the status column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByIsSplitEnabled(boolean|array<boolean> $is_split_enabled) Return ChildSpyMerchantRelationRequest objects filtered by the is_split_enabled column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByIsSplitEnabled(boolean|array<boolean> $is_split_enabled) Return ChildSpyMerchantRelationRequest objects filtered by the is_split_enabled column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByRequestNote(string|array<string> $request_note) Return ChildSpyMerchantRelationRequest objects filtered by the request_note column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByRequestNote(string|array<string> $request_note) Return ChildSpyMerchantRelationRequest objects filtered by the request_note column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByDecisionNote(string|array<string> $decision_note) Return ChildSpyMerchantRelationRequest objects filtered by the decision_note column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByDecisionNote(string|array<string> $decision_note) Return ChildSpyMerchantRelationRequest objects filtered by the decision_note column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpyMerchantRelationRequest objects filtered by the fk_company_user column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpyMerchantRelationRequest objects filtered by the fk_company_user column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByFkMerchant(int|array<int> $fk_merchant) Return ChildSpyMerchantRelationRequest objects filtered by the fk_merchant column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByFkMerchant(int|array<int> $fk_merchant) Return ChildSpyMerchantRelationRequest objects filtered by the fk_merchant column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByFkCompanyBusinessUnit(int|array<int> $fk_company_business_unit) Return ChildSpyMerchantRelationRequest objects filtered by the fk_company_business_unit column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByFkCompanyBusinessUnit(int|array<int> $fk_company_business_unit) Return ChildSpyMerchantRelationRequest objects filtered by the fk_company_business_unit column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantRelationRequest objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantRelationRequest objects filtered by the created_at column
 * @method     ChildSpyMerchantRelationRequest[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantRelationRequest objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantRelationRequest> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantRelationRequest objects filtered by the updated_at column
 *
 * @method     ChildSpyMerchantRelationRequest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantRelationRequest> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantRelationRequestQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantRelationRequest\Persistence\Base\SpyMerchantRelationRequestQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantRelationRequestQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantRelationRequestQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantRelationRequestQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantRelationRequestQuery();
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
     * @return ChildSpyMerchantRelationRequest|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantRelationRequestTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchantRelationRequest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_merchant_relation_request, uuid, status, is_split_enabled, request_note, decision_note, fk_company_user, fk_merchant, fk_company_business_unit, created_at, updated_at FROM spy_merchant_relation_request WHERE id_merchant_relation_request = :p0';
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
            /** @var ChildSpyMerchantRelationRequest $obj */
            $obj = new ChildSpyMerchantRelationRequest();
            $obj->hydrate($row);
            SpyMerchantRelationRequestTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchantRelationRequest|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantRelationRequest Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantRelationRequest_Between(array $idMerchantRelationRequest)
    {
        return $this->filterByIdMerchantRelationRequest($idMerchantRelationRequest, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantRelationRequests Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantRelationRequest_In(array $idMerchantRelationRequests)
    {
        return $this->filterByIdMerchantRelationRequest($idMerchantRelationRequests, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_relation_request column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantRelationRequest(1234); // WHERE id_merchant_relation_request = 1234
     * $query->filterByIdMerchantRelationRequest(array(12, 34), Criteria::IN); // WHERE id_merchant_relation_request IN (12, 34)
     * $query->filterByIdMerchantRelationRequest(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_relation_request > 12
     * </code>
     *
     * @param     mixed $idMerchantRelationRequest The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantRelationRequest($idMerchantRelationRequest = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantRelationRequest)) {
            $useMinMax = false;
            if (isset($idMerchantRelationRequest['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $idMerchantRelationRequest['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantRelationRequest['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $idMerchantRelationRequest['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantRelationRequest of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $idMerchantRelationRequest, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_UUID, $uuid, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_STATUS, $status, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_split_enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSplitEnabled(true); // WHERE is_split_enabled = true
     * $query->filterByIsSplitEnabled('yes'); // WHERE is_split_enabled = true
     * </code>
     *
     * @param     bool|string $isSplitEnabled The value to use as filter.
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
    public function filterByIsSplitEnabled($isSplitEnabled = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isSplitEnabled)) {
            $isSplitEnabled = in_array(strtolower($isSplitEnabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED, $isSplitEnabled, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $requestNotes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestNote_In(array $requestNotes)
    {
        return $this->filterByRequestNote($requestNotes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $requestNote Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRequestNote_Like($requestNote)
    {
        return $this->filterByRequestNote($requestNote, Criteria::LIKE);
    }

    /**
     * Filter the query on the request_note column
     *
     * Example usage:
     * <code>
     * $query->filterByRequestNote('fooValue');   // WHERE request_note = 'fooValue'
     * $query->filterByRequestNote('%fooValue%', Criteria::LIKE); // WHERE request_note LIKE '%fooValue%'
     * $query->filterByRequestNote([1, 'foo'], Criteria::IN); // WHERE request_note IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $requestNote The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByRequestNote($requestNote = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $requestNote = str_replace('*', '%', $requestNote);
        }

        if (is_array($requestNote) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$requestNote of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE, $requestNote, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $decisionNotes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDecisionNote_In(array $decisionNotes)
    {
        return $this->filterByDecisionNote($decisionNotes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $decisionNote Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDecisionNote_Like($decisionNote)
    {
        return $this->filterByDecisionNote($decisionNote, Criteria::LIKE);
    }

    /**
     * Filter the query on the decision_note column
     *
     * Example usage:
     * <code>
     * $query->filterByDecisionNote('fooValue');   // WHERE decision_note = 'fooValue'
     * $query->filterByDecisionNote('%fooValue%', Criteria::LIKE); // WHERE decision_note LIKE '%fooValue%'
     * $query->filterByDecisionNote([1, 'foo'], Criteria::IN); // WHERE decision_note IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $decisionNote The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDecisionNote($decisionNote = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $decisionNote = str_replace('*', '%', $decisionNote);
        }

        if (is_array($decisionNote) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$decisionNote of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE, $decisionNote, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCompanyUser Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyUser_Between(array $fkCompanyUser)
    {
        return $this->filterByFkCompanyUser($fkCompanyUser, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCompanyUsers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCompanyUser_In(array $fkCompanyUsers)
    {
        return $this->filterByFkCompanyUser($fkCompanyUsers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_company_user column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCompanyUser(1234); // WHERE fk_company_user = 1234
     * $query->filterByFkCompanyUser(array(12, 34), Criteria::IN); // WHERE fk_company_user IN (12, 34)
     * $query->filterByFkCompanyUser(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_company_user > 12
     * </code>
     *
     * @see       filterByCompanyUser()
     *
     * @param     mixed $fkCompanyUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCompanyUser($fkCompanyUser = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCompanyUser)) {
            $useMinMax = false;
            if (isset($fkCompanyUser['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, $fkCompanyUser, $comparison);

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
     * @see       filterByMerchant()
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
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, $fkMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, $fkMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, $fkMerchant, $comparison);

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
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $fkCompanyBusinessUnit['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyBusinessUnit['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $fkCompanyBusinessUnit['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyBusinessUnit of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $fkCompanyBusinessUnit, $comparison);

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
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser object
     *
     * @param \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser|ObjectCollection $spyCompanyUser The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompanyUser($spyCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyUser instanceof \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser) {
            return $this
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->getIdCompanyUser(), $comparison);
        } elseif ($spyCompanyUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->toKeyValue('PrimaryKey', 'IdCompanyUser'), $comparison);

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
    public function joinCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useCompanyUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
     * Filter the query by a related \Orm\Zed\Merchant\Persistence\SpyMerchant object
     *
     * @param \Orm\Zed\Merchant\Persistence\SpyMerchant|ObjectCollection $spyMerchant The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchant($spyMerchant, ?string $comparison = null)
    {
        if ($spyMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) {
            return $this
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, $spyMerchant->getIdMerchant(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, $spyMerchant->toKeyValue('PrimaryKey', 'IdMerchant'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Merchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Merchant');

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
            $this->addJoinObject($join, 'Merchant');
        }

        return $this;
    }

    /**
     * Use the Merchant relation SpyMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery A secondary query class using the current class as primary query
     */
    public function useMerchantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Merchant', '\Orm\Zed\Merchant\Persistence\SpyMerchantQuery');
    }

    /**
     * Use the Merchant relation SpyMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the EXISTS statement
     */
    public function useMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('Merchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for a NOT EXISTS query.
     *
     * @see useMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('Merchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the IN statement
     */
    public function useInMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('Merchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for a NOT IN query.
     *
     * @see useMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('Merchant', $modelAlias, $queryClass, 'NOT IN');
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
    public function filterByCompanyBusinessUnit($spyCompanyBusinessUnit, ?string $comparison = null)
    {
        if ($spyCompanyBusinessUnit instanceof \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit) {
            return $this
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->getIdCompanyBusinessUnit(), $comparison);
        } elseif ($spyCompanyBusinessUnit instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, $spyCompanyBusinessUnit->toKeyValue('PrimaryKey', 'IdCompanyBusinessUnit'), $comparison);

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
    public function joinCompanyBusinessUnit(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
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
    public function useCompanyBusinessUnitQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
        ?string $joinType = Criteria::INNER_JOIN
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
                ->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $spyMerchantRelationRequestToCompanyBusinessUnit->getFkMerchantRelationRequest(), $comparison);

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
     * Exclude object from result
     *
     * @param ChildSpyMerchantRelationRequest $spyMerchantRelationRequest Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantRelationRequest = null)
    {
        if ($spyMerchantRelationRequest) {
            $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, $spyMerchantRelationRequest->getIdMerchantRelationRequest(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant_relation_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantRelationRequestTableMap::clearInstancePool();
            SpyMerchantRelationRequestTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantRelationRequestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantRelationRequestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantRelationRequestTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantRelationRequestTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyMerchantRelationRequestTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantRelationRequestTableMap::COL_CREATED_AT);

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
