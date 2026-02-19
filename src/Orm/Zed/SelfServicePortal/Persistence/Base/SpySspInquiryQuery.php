<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUser;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry as ChildSpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery as ChildSpySspInquiryQuery;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspInquiryTableMap;
use Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState;
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
 * Base class that represents a query for the `spy_ssp_inquiry` table.
 *
 * @method     ChildSpySspInquiryQuery orderByIdSspInquiry($order = Criteria::ASC) Order by the id_ssp_inquiry column
 * @method     ChildSpySspInquiryQuery orderByReference($order = Criteria::ASC) Order by the reference column
 * @method     ChildSpySspInquiryQuery orderByFkCompanyUser($order = Criteria::ASC) Order by the fk_company_user column
 * @method     ChildSpySspInquiryQuery orderBySubject($order = Criteria::ASC) Order by the subject column
 * @method     ChildSpySspInquiryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSpySspInquiryQuery orderByFkStateMachineItemState($order = Criteria::ASC) Order by the fk_state_machine_item_state column
 * @method     ChildSpySspInquiryQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildSpySspInquiryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySspInquiryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySspInquiryQuery groupByIdSspInquiry() Group by the id_ssp_inquiry column
 * @method     ChildSpySspInquiryQuery groupByReference() Group by the reference column
 * @method     ChildSpySspInquiryQuery groupByFkCompanyUser() Group by the fk_company_user column
 * @method     ChildSpySspInquiryQuery groupBySubject() Group by the subject column
 * @method     ChildSpySspInquiryQuery groupByDescription() Group by the description column
 * @method     ChildSpySspInquiryQuery groupByFkStateMachineItemState() Group by the fk_state_machine_item_state column
 * @method     ChildSpySspInquiryQuery groupByType() Group by the type column
 * @method     ChildSpySspInquiryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySspInquiryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySspInquiryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySspInquiryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySspInquiryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySspInquiryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySspInquiryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySspInquiryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySspInquiryQuery leftJoinSpyCompanyUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCompanyUser relation
 * @method     ChildSpySspInquiryQuery rightJoinSpyCompanyUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCompanyUser relation
 * @method     ChildSpySspInquiryQuery innerJoinSpyCompanyUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCompanyUser relation
 *
 * @method     ChildSpySspInquiryQuery joinWithSpyCompanyUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCompanyUser relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinWithSpyCompanyUser() Adds a LEFT JOIN clause and with to the query using the SpyCompanyUser relation
 * @method     ChildSpySspInquiryQuery rightJoinWithSpyCompanyUser() Adds a RIGHT JOIN clause and with to the query using the SpyCompanyUser relation
 * @method     ChildSpySspInquiryQuery innerJoinWithSpyCompanyUser() Adds a INNER JOIN clause and with to the query using the SpyCompanyUser relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinStateMachineItemState($relationAlias = null) Adds a LEFT JOIN clause to the query using the StateMachineItemState relation
 * @method     ChildSpySspInquiryQuery rightJoinStateMachineItemState($relationAlias = null) Adds a RIGHT JOIN clause to the query using the StateMachineItemState relation
 * @method     ChildSpySspInquiryQuery innerJoinStateMachineItemState($relationAlias = null) Adds a INNER JOIN clause to the query using the StateMachineItemState relation
 *
 * @method     ChildSpySspInquiryQuery joinWithStateMachineItemState($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the StateMachineItemState relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinWithStateMachineItemState() Adds a LEFT JOIN clause and with to the query using the StateMachineItemState relation
 * @method     ChildSpySspInquiryQuery rightJoinWithStateMachineItemState() Adds a RIGHT JOIN clause and with to the query using the StateMachineItemState relation
 * @method     ChildSpySspInquiryQuery innerJoinWithStateMachineItemState() Adds a INNER JOIN clause and with to the query using the StateMachineItemState relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinSpySspInquiryFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquiryFile relation
 * @method     ChildSpySspInquiryQuery rightJoinSpySspInquiryFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquiryFile relation
 * @method     ChildSpySspInquiryQuery innerJoinSpySspInquiryFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquiryFile relation
 *
 * @method     ChildSpySspInquiryQuery joinWithSpySspInquiryFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquiryFile relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinWithSpySspInquiryFile() Adds a LEFT JOIN clause and with to the query using the SpySspInquiryFile relation
 * @method     ChildSpySspInquiryQuery rightJoinWithSpySspInquiryFile() Adds a RIGHT JOIN clause and with to the query using the SpySspInquiryFile relation
 * @method     ChildSpySspInquiryQuery innerJoinWithSpySspInquiryFile() Adds a INNER JOIN clause and with to the query using the SpySspInquiryFile relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinSpySspInquirySalesOrder($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySspInquiryQuery rightJoinSpySspInquirySalesOrder($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySspInquiryQuery innerJoinSpySspInquirySalesOrder($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquirySalesOrder relation
 *
 * @method     ChildSpySspInquiryQuery joinWithSpySspInquirySalesOrder($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquirySalesOrder relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinWithSpySspInquirySalesOrder() Adds a LEFT JOIN clause and with to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySspInquiryQuery rightJoinWithSpySspInquirySalesOrder() Adds a RIGHT JOIN clause and with to the query using the SpySspInquirySalesOrder relation
 * @method     ChildSpySspInquiryQuery innerJoinWithSpySspInquirySalesOrder() Adds a INNER JOIN clause and with to the query using the SpySspInquirySalesOrder relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinSpySspInquirySspAsset($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspInquirySspAsset relation
 * @method     ChildSpySspInquiryQuery rightJoinSpySspInquirySspAsset($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspInquirySspAsset relation
 * @method     ChildSpySspInquiryQuery innerJoinSpySspInquirySspAsset($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspInquirySspAsset relation
 *
 * @method     ChildSpySspInquiryQuery joinWithSpySspInquirySspAsset($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspInquirySspAsset relation
 *
 * @method     ChildSpySspInquiryQuery leftJoinWithSpySspInquirySspAsset() Adds a LEFT JOIN clause and with to the query using the SpySspInquirySspAsset relation
 * @method     ChildSpySspInquiryQuery rightJoinWithSpySspInquirySspAsset() Adds a RIGHT JOIN clause and with to the query using the SpySspInquirySspAsset relation
 * @method     ChildSpySspInquiryQuery innerJoinWithSpySspInquirySspAsset() Adds a INNER JOIN clause and with to the query using the SpySspInquirySspAsset relation
 *
 * @method     \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery|\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySspInquiry|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySspInquiry matching the query
 * @method     ChildSpySspInquiry findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySspInquiry matching the query, or a new ChildSpySspInquiry object populated from the query conditions when no match is found
 *
 * @method     ChildSpySspInquiry|null findOneByIdSspInquiry(int $id_ssp_inquiry) Return the first ChildSpySspInquiry filtered by the id_ssp_inquiry column
 * @method     ChildSpySspInquiry|null findOneByReference(string $reference) Return the first ChildSpySspInquiry filtered by the reference column
 * @method     ChildSpySspInquiry|null findOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpySspInquiry filtered by the fk_company_user column
 * @method     ChildSpySspInquiry|null findOneBySubject(string $subject) Return the first ChildSpySspInquiry filtered by the subject column
 * @method     ChildSpySspInquiry|null findOneByDescription(string $description) Return the first ChildSpySspInquiry filtered by the description column
 * @method     ChildSpySspInquiry|null findOneByFkStateMachineItemState(int $fk_state_machine_item_state) Return the first ChildSpySspInquiry filtered by the fk_state_machine_item_state column
 * @method     ChildSpySspInquiry|null findOneByType(string $type) Return the first ChildSpySspInquiry filtered by the type column
 * @method     ChildSpySspInquiry|null findOneByCreatedAt(string $created_at) Return the first ChildSpySspInquiry filtered by the created_at column
 * @method     ChildSpySspInquiry|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySspInquiry filtered by the updated_at column
 *
 * @method     ChildSpySspInquiry requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySspInquiry by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOne(?ConnectionInterface $con = null) Return the first ChildSpySspInquiry matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySspInquiry requireOneByIdSspInquiry(int $id_ssp_inquiry) Return the first ChildSpySspInquiry filtered by the id_ssp_inquiry column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByReference(string $reference) Return the first ChildSpySspInquiry filtered by the reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByFkCompanyUser(int $fk_company_user) Return the first ChildSpySspInquiry filtered by the fk_company_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneBySubject(string $subject) Return the first ChildSpySspInquiry filtered by the subject column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByDescription(string $description) Return the first ChildSpySspInquiry filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByFkStateMachineItemState(int $fk_state_machine_item_state) Return the first ChildSpySspInquiry filtered by the fk_state_machine_item_state column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByType(string $type) Return the first ChildSpySspInquiry filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByCreatedAt(string $created_at) Return the first ChildSpySspInquiry filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspInquiry requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySspInquiry filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySspInquiry[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySspInquiry objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> find(?ConnectionInterface $con = null) Return ChildSpySspInquiry objects based on current ModelCriteria
 *
 * @method     ChildSpySspInquiry[]|Collection findByIdSspInquiry(int|array<int> $id_ssp_inquiry) Return ChildSpySspInquiry objects filtered by the id_ssp_inquiry column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByIdSspInquiry(int|array<int> $id_ssp_inquiry) Return ChildSpySspInquiry objects filtered by the id_ssp_inquiry column
 * @method     ChildSpySspInquiry[]|Collection findByReference(string|array<string> $reference) Return ChildSpySspInquiry objects filtered by the reference column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByReference(string|array<string> $reference) Return ChildSpySspInquiry objects filtered by the reference column
 * @method     ChildSpySspInquiry[]|Collection findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpySspInquiry objects filtered by the fk_company_user column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByFkCompanyUser(int|array<int> $fk_company_user) Return ChildSpySspInquiry objects filtered by the fk_company_user column
 * @method     ChildSpySspInquiry[]|Collection findBySubject(string|array<string> $subject) Return ChildSpySspInquiry objects filtered by the subject column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findBySubject(string|array<string> $subject) Return ChildSpySspInquiry objects filtered by the subject column
 * @method     ChildSpySspInquiry[]|Collection findByDescription(string|array<string> $description) Return ChildSpySspInquiry objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByDescription(string|array<string> $description) Return ChildSpySspInquiry objects filtered by the description column
 * @method     ChildSpySspInquiry[]|Collection findByFkStateMachineItemState(int|array<int> $fk_state_machine_item_state) Return ChildSpySspInquiry objects filtered by the fk_state_machine_item_state column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByFkStateMachineItemState(int|array<int> $fk_state_machine_item_state) Return ChildSpySspInquiry objects filtered by the fk_state_machine_item_state column
 * @method     ChildSpySspInquiry[]|Collection findByType(string|array<string> $type) Return ChildSpySspInquiry objects filtered by the type column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByType(string|array<string> $type) Return ChildSpySspInquiry objects filtered by the type column
 * @method     ChildSpySspInquiry[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySspInquiry objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByCreatedAt(string|array<string> $created_at) Return ChildSpySspInquiry objects filtered by the created_at column
 * @method     ChildSpySspInquiry[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySspInquiry objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySspInquiry> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySspInquiry objects filtered by the updated_at column
 *
 * @method     ChildSpySspInquiry[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySspInquiry> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySspInquiryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SelfServicePortal\Persistence\Base\SpySspInquiryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquiry', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySspInquiryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySspInquiryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySspInquiryQuery) {
            return $criteria;
        }
        $query = new ChildSpySspInquiryQuery();
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
     * @return ChildSpySspInquiry|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySspInquiryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySspInquiry A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_ssp_inquiry, reference, fk_company_user, subject, description, fk_state_machine_item_state, type, created_at, updated_at FROM spy_ssp_inquiry WHERE id_ssp_inquiry = :p0';
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
            /** @var ChildSpySspInquiry $obj */
            $obj = new ChildSpySspInquiry();
            $obj->hydrate($row);
            SpySspInquiryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySspInquiry|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSspInquiry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSspInquiry_Between(array $idSspInquiry)
    {
        return $this->filterByIdSspInquiry($idSspInquiry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSspInquirys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSspInquiry_In(array $idSspInquirys)
    {
        return $this->filterByIdSspInquiry($idSspInquirys, Criteria::IN);
    }

    /**
     * Filter the query on the id_ssp_inquiry column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSspInquiry(1234); // WHERE id_ssp_inquiry = 1234
     * $query->filterByIdSspInquiry(array(12, 34), Criteria::IN); // WHERE id_ssp_inquiry IN (12, 34)
     * $query->filterByIdSspInquiry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_ssp_inquiry > 12
     * </code>
     *
     * @param     mixed $idSspInquiry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSspInquiry($idSspInquiry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSspInquiry)) {
            $useMinMax = false;
            if (isset($idSspInquiry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $idSspInquiry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSspInquiry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $idSspInquiry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSspInquiry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $idSspInquiry, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $references Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReference_In(array $references)
    {
        return $this->filterByReference($references, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $reference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReference_Like($reference)
    {
        return $this->filterByReference($reference, Criteria::LIKE);
    }

    /**
     * Filter the query on the reference column
     *
     * Example usage:
     * <code>
     * $query->filterByReference('fooValue');   // WHERE reference = 'fooValue'
     * $query->filterByReference('%fooValue%', Criteria::LIKE); // WHERE reference LIKE '%fooValue%'
     * $query->filterByReference([1, 'foo'], Criteria::IN); // WHERE reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $reference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByReference($reference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $reference = str_replace('*', '%', $reference);
        }

        if (is_array($reference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$reference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_REFERENCE, $reference, $comparison);

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
     * @see       filterBySpyCompanyUser()
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
                $this->addUsingAlias(SpySspInquiryTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCompanyUser['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_FK_COMPANY_USER, $fkCompanyUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCompanyUser of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_FK_COMPANY_USER, $fkCompanyUser, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $subjects Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubject_In(array $subjects)
    {
        return $this->filterBySubject($subjects, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $subject Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySubject_Like($subject)
    {
        return $this->filterBySubject($subject, Criteria::LIKE);
    }

    /**
     * Filter the query on the subject column
     *
     * Example usage:
     * <code>
     * $query->filterBySubject('fooValue');   // WHERE subject = 'fooValue'
     * $query->filterBySubject('%fooValue%', Criteria::LIKE); // WHERE subject LIKE '%fooValue%'
     * $query->filterBySubject([1, 'foo'], Criteria::IN); // WHERE subject IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $subject The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySubject($subject = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $subject = str_replace('*', '%', $subject);
        }

        if (is_array($subject) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$subject of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_SUBJECT, $subject, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $descriptions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription_In(array $descriptions)
    {
        return $this->filterByDescription($descriptions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $description Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription_Like($description)
    {
        return $this->filterByDescription($description, Criteria::LIKE);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription([1, 'foo'], Criteria::IN); // WHERE description IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDescription($description = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $description = str_replace('*', '%', $description);
        }

        if (is_array($description) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$description of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_DESCRIPTION, $description, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkStateMachineItemState Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineItemState_Between(array $fkStateMachineItemState)
    {
        return $this->filterByFkStateMachineItemState($fkStateMachineItemState, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkStateMachineItemStates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStateMachineItemState_In(array $fkStateMachineItemStates)
    {
        return $this->filterByFkStateMachineItemState($fkStateMachineItemStates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_state_machine_item_state column
     *
     * Example usage:
     * <code>
     * $query->filterByFkStateMachineItemState(1234); // WHERE fk_state_machine_item_state = 1234
     * $query->filterByFkStateMachineItemState(array(12, 34), Criteria::IN); // WHERE fk_state_machine_item_state IN (12, 34)
     * $query->filterByFkStateMachineItemState(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_state_machine_item_state > 12
     * </code>
     *
     * @see       filterByStateMachineItemState()
     *
     * @param     mixed $fkStateMachineItemState The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkStateMachineItemState($fkStateMachineItemState = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkStateMachineItemState)) {
            $useMinMax = false;
            if (isset($fkStateMachineItemState['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $fkStateMachineItemState['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkStateMachineItemState['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $fkStateMachineItemState['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkStateMachineItemState of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $fkStateMachineItemState, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $types Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_In(array $types)
    {
        return $this->filterByType($types, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $type Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByType_Like($type)
    {
        return $this->filterByType($type, Criteria::LIKE);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * $query->filterByType([1, 'foo'], Criteria::IN); // WHERE type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByType($type = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $type = str_replace('*', '%', $type);
        }

        if (is_array($type) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$type of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_TYPE, $type, $comparison);

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
                $this->addUsingAlias(SpySspInquiryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpySspInquiryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspInquiryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspInquiryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
    public function filterBySpyCompanyUser($spyCompanyUser, ?string $comparison = null)
    {
        if ($spyCompanyUser instanceof \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser) {
            return $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->getIdCompanyUser(), $comparison);
        } elseif ($spyCompanyUser instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_FK_COMPANY_USER, $spyCompanyUser->toKeyValue('PrimaryKey', 'IdCompanyUser'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCompanyUser() only accepts arguments of type \Orm\Zed\CompanyUser\Persistence\SpyCompanyUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCompanyUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCompanyUser(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCompanyUser');

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
            $this->addJoinObject($join, 'SpyCompanyUser');
        }

        return $this;
    }

    /**
     * Use the SpyCompanyUser relation SpyCompanyUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery A secondary query class using the current class as primary query
     */
    public function useSpyCompanyUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCompanyUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCompanyUser', '\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery');
    }

    /**
     * Use the SpyCompanyUser relation SpyCompanyUser object
     *
     * @param callable(\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery):\Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCompanyUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCompanyUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCompanyUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the EXISTS statement
     */
    public function useSpyCompanyUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUser table for a NOT EXISTS query.
     *
     * @see useSpyCompanyUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCompanyUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useExistsQuery('SpyCompanyUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the IN statement
     */
    public function useInSpyCompanyUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCompanyUser table for a NOT IN query.
     *
     * @see useSpyCompanyUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCompanyUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery */
        $q = $this->useInQuery('SpyCompanyUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState object
     *
     * @param \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState|ObjectCollection $spyStateMachineItemState The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStateMachineItemState($spyStateMachineItemState, ?string $comparison = null)
    {
        if ($spyStateMachineItemState instanceof \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState) {
            return $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $spyStateMachineItemState->getIdStateMachineItemState(), $comparison);
        } elseif ($spyStateMachineItemState instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, $spyStateMachineItemState->toKeyValue('PrimaryKey', 'IdStateMachineItemState'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStateMachineItemState() only accepts arguments of type \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemState or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the StateMachineItemState relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStateMachineItemState(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('StateMachineItemState');

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
            $this->addJoinObject($join, 'StateMachineItemState');
        }

        return $this;
    }

    /**
     * Use the StateMachineItemState relation SpyStateMachineItemState object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery A secondary query class using the current class as primary query
     */
    public function useStateMachineItemStateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStateMachineItemState($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'StateMachineItemState', '\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery');
    }

    /**
     * Use the StateMachineItemState relation SpyStateMachineItemState object
     *
     * @param callable(\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery):\Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStateMachineItemStateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStateMachineItemStateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the StateMachineItemState relation to the SpyStateMachineItemState table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the EXISTS statement
     */
    public function useStateMachineItemStateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useExistsQuery('StateMachineItemState', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the StateMachineItemState relation to the SpyStateMachineItemState table for a NOT EXISTS query.
     *
     * @see useStateMachineItemStateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the NOT EXISTS statement
     */
    public function useStateMachineItemStateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useExistsQuery('StateMachineItemState', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the StateMachineItemState relation to the SpyStateMachineItemState table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the IN statement
     */
    public function useInStateMachineItemStateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useInQuery('StateMachineItemState', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the StateMachineItemState relation to the SpyStateMachineItemState table for a NOT IN query.
     *
     * @see useStateMachineItemStateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery The inner query object of the NOT IN statement
     */
    public function useNotInStateMachineItemStateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\StateMachine\Persistence\SpyStateMachineItemStateQuery */
        $q = $this->useInQuery('StateMachineItemState', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile|ObjectCollection $spySspInquiryFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquiryFile($spySspInquiryFile, ?string $comparison = null)
    {
        if ($spySspInquiryFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile) {
            $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $spySspInquiryFile->getFkSspInquiry(), $comparison);

            return $this;
        } elseif ($spySspInquiryFile instanceof ObjectCollection) {
            $this
                ->useSpySspInquiryFileQuery()
                ->filterByPrimaryKeys($spySspInquiryFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquiryFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquiryFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquiryFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquiryFile');

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
            $this->addJoinObject($join, 'SpySspInquiryFile');
        }

        return $this;
    }

    /**
     * Use the SpySspInquiryFile relation SpySspInquiryFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquiryFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspInquiryFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquiryFile', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery');
    }

    /**
     * Use the SpySspInquiryFile relation SpySspInquiryFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquiryFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquiryFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquiryFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquiryFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useExistsQuery('SpySspInquiryFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquiryFile table for a NOT EXISTS query.
     *
     * @see useSpySspInquiryFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquiryFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useExistsQuery('SpySspInquiryFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquiryFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the IN statement
     */
    public function useInSpySspInquiryFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useInQuery('SpySspInquiryFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquiryFile table for a NOT IN query.
     *
     * @see useSpySspInquiryFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquiryFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryFileQuery */
        $q = $this->useInQuery('SpySspInquiryFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder|ObjectCollection $spySspInquirySalesOrder the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquirySalesOrder($spySspInquirySalesOrder, ?string $comparison = null)
    {
        if ($spySspInquirySalesOrder instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder) {
            $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $spySspInquirySalesOrder->getFkSspInquiry(), $comparison);

            return $this;
        } elseif ($spySspInquirySalesOrder instanceof ObjectCollection) {
            $this
                ->useSpySspInquirySalesOrderQuery()
                ->filterByPrimaryKeys($spySspInquirySalesOrder->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquirySalesOrder() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrder or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquirySalesOrder relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquirySalesOrder(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquirySalesOrder');

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
            $this->addJoinObject($join, 'SpySspInquirySalesOrder');
        }

        return $this;
    }

    /**
     * Use the SpySspInquirySalesOrder relation SpySspInquirySalesOrder object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquirySalesOrderQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspInquirySalesOrder($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquirySalesOrder', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery');
    }

    /**
     * Use the SpySspInquirySalesOrder relation SpySspInquirySalesOrder object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquirySalesOrderQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquirySalesOrderQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquirySalesOrderExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useExistsQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for a NOT EXISTS query.
     *
     * @see useSpySspInquirySalesOrderExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquirySalesOrderNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useExistsQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the IN statement
     */
    public function useInSpySspInquirySalesOrderQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useInQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySalesOrder table for a NOT IN query.
     *
     * @see useSpySspInquirySalesOrderInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquirySalesOrderQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySalesOrderQuery */
        $q = $this->useInQuery('SpySspInquirySalesOrder', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset|ObjectCollection $spySspInquirySspAsset the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspInquirySspAsset($spySspInquirySspAsset, ?string $comparison = null)
    {
        if ($spySspInquirySspAsset instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset) {
            $this
                ->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $spySspInquirySspAsset->getFkSspInquiry(), $comparison);

            return $this;
        } elseif ($spySspInquirySspAsset instanceof ObjectCollection) {
            $this
                ->useSpySspInquirySspAssetQuery()
                ->filterByPrimaryKeys($spySspInquirySspAsset->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspInquirySspAsset() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAsset or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspInquirySspAsset relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspInquirySspAsset(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspInquirySspAsset');

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
            $this->addJoinObject($join, 'SpySspInquirySspAsset');
        }

        return $this;
    }

    /**
     * Use the SpySspInquirySspAsset relation SpySspInquirySspAsset object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery A secondary query class using the current class as primary query
     */
    public function useSpySspInquirySspAssetQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspInquirySspAsset($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspInquirySspAsset', '\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery');
    }

    /**
     * Use the SpySspInquirySspAsset relation SpySspInquirySspAsset object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspInquirySspAssetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspInquirySspAssetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspInquirySspAsset table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery The inner query object of the EXISTS statement
     */
    public function useSpySspInquirySspAssetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery */
        $q = $this->useExistsQuery('SpySspInquirySspAsset', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySspAsset table for a NOT EXISTS query.
     *
     * @see useSpySspInquirySspAssetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspInquirySspAssetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery */
        $q = $this->useExistsQuery('SpySspInquirySspAsset', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySspAsset table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery The inner query object of the IN statement
     */
    public function useInSpySspInquirySspAssetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery */
        $q = $this->useInQuery('SpySspInquirySspAsset', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspInquirySspAsset table for a NOT IN query.
     *
     * @see useSpySspInquirySspAssetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspInquirySspAssetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspInquirySspAssetQuery */
        $q = $this->useInQuery('SpySspInquirySspAsset', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySspInquiry $spySspInquiry Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySspInquiry = null)
    {
        if ($spySspInquiry) {
            $this->addUsingAlias(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, $spySspInquiry->getIdSspInquiry(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_ssp_inquiry table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySspInquiryTableMap::clearInstancePool();
            SpySspInquiryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySspInquiryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySspInquiryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySspInquiryTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpySspInquiryTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySspInquiryTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySspInquiryTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySspInquiryTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpySspInquiryTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySspInquiryTableMap::COL_CREATED_AT);

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
