<?php

namespace Orm\Zed\TaxApp\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\TaxApp\Persistence\SpyTaxIdValidationHistory as ChildSpyTaxIdValidationHistory;
use Orm\Zed\TaxApp\Persistence\SpyTaxIdValidationHistoryQuery as ChildSpyTaxIdValidationHistoryQuery;
use Orm\Zed\TaxApp\Persistence\Map\SpyTaxIdValidationHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\PropelOrm\Business\Model\Formatter\TypeAwareSimpleArrayFormatter;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria as SprykerCriteria;
use Spryker\Zed\PropelReplicationCache\Business\PropelReplicationCacheFacade;
use Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException;

/**
 * Base class that represents a query for the `spy_tax_id_validation_history` table.
 *
 * @method     ChildSpyTaxIdValidationHistoryQuery orderByIdTaxIdValidationHistory($order = Criteria::ASC) Order by the id_tax_id_validation_history column
 * @method     ChildSpyTaxIdValidationHistoryQuery orderByTaxId($order = Criteria::ASC) Order by the tax_id column
 * @method     ChildSpyTaxIdValidationHistoryQuery orderByIsValid($order = Criteria::ASC) Order by the is_valid column
 * @method     ChildSpyTaxIdValidationHistoryQuery orderByCountryCode($order = Criteria::ASC) Order by the country_code column
 * @method     ChildSpyTaxIdValidationHistoryQuery orderByResponseData($order = Criteria::ASC) Order by the response_data column
 * @method     ChildSpyTaxIdValidationHistoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 *
 * @method     ChildSpyTaxIdValidationHistoryQuery groupByIdTaxIdValidationHistory() Group by the id_tax_id_validation_history column
 * @method     ChildSpyTaxIdValidationHistoryQuery groupByTaxId() Group by the tax_id column
 * @method     ChildSpyTaxIdValidationHistoryQuery groupByIsValid() Group by the is_valid column
 * @method     ChildSpyTaxIdValidationHistoryQuery groupByCountryCode() Group by the country_code column
 * @method     ChildSpyTaxIdValidationHistoryQuery groupByResponseData() Group by the response_data column
 * @method     ChildSpyTaxIdValidationHistoryQuery groupByCreatedAt() Group by the created_at column
 *
 * @method     ChildSpyTaxIdValidationHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyTaxIdValidationHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyTaxIdValidationHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyTaxIdValidationHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyTaxIdValidationHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyTaxIdValidationHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyTaxIdValidationHistory|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyTaxIdValidationHistory matching the query
 * @method     ChildSpyTaxIdValidationHistory findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyTaxIdValidationHistory matching the query, or a new ChildSpyTaxIdValidationHistory object populated from the query conditions when no match is found
 *
 * @method     ChildSpyTaxIdValidationHistory|null findOneByIdTaxIdValidationHistory(int $id_tax_id_validation_history) Return the first ChildSpyTaxIdValidationHistory filtered by the id_tax_id_validation_history column
 * @method     ChildSpyTaxIdValidationHistory|null findOneByTaxId(string $tax_id) Return the first ChildSpyTaxIdValidationHistory filtered by the tax_id column
 * @method     ChildSpyTaxIdValidationHistory|null findOneByIsValid(boolean $is_valid) Return the first ChildSpyTaxIdValidationHistory filtered by the is_valid column
 * @method     ChildSpyTaxIdValidationHistory|null findOneByCountryCode(string $country_code) Return the first ChildSpyTaxIdValidationHistory filtered by the country_code column
 * @method     ChildSpyTaxIdValidationHistory|null findOneByResponseData(string $response_data) Return the first ChildSpyTaxIdValidationHistory filtered by the response_data column
 * @method     ChildSpyTaxIdValidationHistory|null findOneByCreatedAt(string $created_at) Return the first ChildSpyTaxIdValidationHistory filtered by the created_at column
 *
 * @method     ChildSpyTaxIdValidationHistory requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyTaxIdValidationHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTaxIdValidationHistory requireOne(?ConnectionInterface $con = null) Return the first ChildSpyTaxIdValidationHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyTaxIdValidationHistory requireOneByIdTaxIdValidationHistory(int $id_tax_id_validation_history) Return the first ChildSpyTaxIdValidationHistory filtered by the id_tax_id_validation_history column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTaxIdValidationHistory requireOneByTaxId(string $tax_id) Return the first ChildSpyTaxIdValidationHistory filtered by the tax_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTaxIdValidationHistory requireOneByIsValid(boolean $is_valid) Return the first ChildSpyTaxIdValidationHistory filtered by the is_valid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTaxIdValidationHistory requireOneByCountryCode(string $country_code) Return the first ChildSpyTaxIdValidationHistory filtered by the country_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTaxIdValidationHistory requireOneByResponseData(string $response_data) Return the first ChildSpyTaxIdValidationHistory filtered by the response_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyTaxIdValidationHistory requireOneByCreatedAt(string $created_at) Return the first ChildSpyTaxIdValidationHistory filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyTaxIdValidationHistory[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyTaxIdValidationHistory objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> find(?ConnectionInterface $con = null) Return ChildSpyTaxIdValidationHistory objects based on current ModelCriteria
 *
 * @method     ChildSpyTaxIdValidationHistory[]|Collection findByIdTaxIdValidationHistory(int|array<int> $id_tax_id_validation_history) Return ChildSpyTaxIdValidationHistory objects filtered by the id_tax_id_validation_history column
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> findByIdTaxIdValidationHistory(int|array<int> $id_tax_id_validation_history) Return ChildSpyTaxIdValidationHistory objects filtered by the id_tax_id_validation_history column
 * @method     ChildSpyTaxIdValidationHistory[]|Collection findByTaxId(string|array<string> $tax_id) Return ChildSpyTaxIdValidationHistory objects filtered by the tax_id column
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> findByTaxId(string|array<string> $tax_id) Return ChildSpyTaxIdValidationHistory objects filtered by the tax_id column
 * @method     ChildSpyTaxIdValidationHistory[]|Collection findByIsValid(boolean|array<boolean> $is_valid) Return ChildSpyTaxIdValidationHistory objects filtered by the is_valid column
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> findByIsValid(boolean|array<boolean> $is_valid) Return ChildSpyTaxIdValidationHistory objects filtered by the is_valid column
 * @method     ChildSpyTaxIdValidationHistory[]|Collection findByCountryCode(string|array<string> $country_code) Return ChildSpyTaxIdValidationHistory objects filtered by the country_code column
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> findByCountryCode(string|array<string> $country_code) Return ChildSpyTaxIdValidationHistory objects filtered by the country_code column
 * @method     ChildSpyTaxIdValidationHistory[]|Collection findByResponseData(string|array<string> $response_data) Return ChildSpyTaxIdValidationHistory objects filtered by the response_data column
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> findByResponseData(string|array<string> $response_data) Return ChildSpyTaxIdValidationHistory objects filtered by the response_data column
 * @method     ChildSpyTaxIdValidationHistory[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyTaxIdValidationHistory objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyTaxIdValidationHistory> findByCreatedAt(string|array<string> $created_at) Return ChildSpyTaxIdValidationHistory objects filtered by the created_at column
 *
 * @method     ChildSpyTaxIdValidationHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyTaxIdValidationHistory> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyTaxIdValidationHistoryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\TaxApp\Persistence\Base\SpyTaxIdValidationHistoryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\TaxApp\\Persistence\\SpyTaxIdValidationHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyTaxIdValidationHistoryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyTaxIdValidationHistoryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyTaxIdValidationHistoryQuery) {
            return $criteria;
        }
        $query = new ChildSpyTaxIdValidationHistoryQuery();
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
     * @return ChildSpyTaxIdValidationHistory|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyTaxIdValidationHistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyTaxIdValidationHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_tax_id_validation_history`, `tax_id`, `is_valid`, `country_code`, `response_data`, `created_at` FROM `spy_tax_id_validation_history` WHERE `id_tax_id_validation_history` = :p0';
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
            /** @var ChildSpyTaxIdValidationHistory $obj */
            $obj = new ChildSpyTaxIdValidationHistory();
            $obj->hydrate($row);
            SpyTaxIdValidationHistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyTaxIdValidationHistory|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idTaxIdValidationHistory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdTaxIdValidationHistory_Between(array $idTaxIdValidationHistory)
    {
        return $this->filterByIdTaxIdValidationHistory($idTaxIdValidationHistory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idTaxIdValidationHistorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdTaxIdValidationHistory_In(array $idTaxIdValidationHistorys)
    {
        return $this->filterByIdTaxIdValidationHistory($idTaxIdValidationHistorys, Criteria::IN);
    }

    /**
     * Filter the query on the id_tax_id_validation_history column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTaxIdValidationHistory(1234); // WHERE id_tax_id_validation_history = 1234
     * $query->filterByIdTaxIdValidationHistory(array(12, 34), Criteria::IN); // WHERE id_tax_id_validation_history IN (12, 34)
     * $query->filterByIdTaxIdValidationHistory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_tax_id_validation_history > 12
     * </code>
     *
     * @param     mixed $idTaxIdValidationHistory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdTaxIdValidationHistory($idTaxIdValidationHistory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idTaxIdValidationHistory)) {
            $useMinMax = false;
            if (isset($idTaxIdValidationHistory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, $idTaxIdValidationHistory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTaxIdValidationHistory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, $idTaxIdValidationHistory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idTaxIdValidationHistory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, $idTaxIdValidationHistory, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $taxIds Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxId_In(array $taxIds)
    {
        return $this->filterByTaxId($taxIds, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $taxId Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTaxId_Like($taxId)
    {
        return $this->filterByTaxId($taxId, Criteria::LIKE);
    }

    /**
     * Filter the query on the tax_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTaxId('fooValue');   // WHERE tax_id = 'fooValue'
     * $query->filterByTaxId('%fooValue%', Criteria::LIKE); // WHERE tax_id LIKE '%fooValue%'
     * $query->filterByTaxId([1, 'foo'], Criteria::IN); // WHERE tax_id IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $taxId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByTaxId($taxId = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $taxId = str_replace('*', '%', $taxId);
        }

        if (is_array($taxId) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$taxId of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_TAX_ID, $taxId, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_valid column
     *
     * Example usage:
     * <code>
     * $query->filterByIsValid(true); // WHERE is_valid = true
     * $query->filterByIsValid('yes'); // WHERE is_valid = true
     * </code>
     *
     * @param     bool|string $isValid The value to use as filter.
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
    public function filterByIsValid($isValid = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isValid)) {
            $isValid = in_array(strtolower($isValid), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_IS_VALID, $isValid, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $countryCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountryCode_In(array $countryCodes)
    {
        return $this->filterByCountryCode($countryCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $countryCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountryCode_Like($countryCode)
    {
        return $this->filterByCountryCode($countryCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the country_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryCode('fooValue');   // WHERE country_code = 'fooValue'
     * $query->filterByCountryCode('%fooValue%', Criteria::LIKE); // WHERE country_code LIKE '%fooValue%'
     * $query->filterByCountryCode([1, 'foo'], Criteria::IN); // WHERE country_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $countryCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCountryCode($countryCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $countryCode = str_replace('*', '%', $countryCode);
        }

        if (is_array($countryCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$countryCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_COUNTRY_CODE, $countryCode, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $responseDatas Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResponseData_In(array $responseDatas)
    {
        return $this->filterByResponseData($responseDatas, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $responseData Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResponseData_Like($responseData)
    {
        return $this->filterByResponseData($responseData, Criteria::LIKE);
    }

    /**
     * Filter the query on the response_data column
     *
     * Example usage:
     * <code>
     * $query->filterByResponseData('fooValue');   // WHERE response_data = 'fooValue'
     * $query->filterByResponseData('%fooValue%', Criteria::LIKE); // WHERE response_data LIKE '%fooValue%'
     * $query->filterByResponseData([1, 'foo'], Criteria::IN); // WHERE response_data IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $responseData The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByResponseData($responseData = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $responseData = str_replace('*', '%', $responseData);
        }

        if (is_array($responseData) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$responseData of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_RESPONSE_DATA, $responseData, $comparison);

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
                $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $query;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyTaxIdValidationHistory $spyTaxIdValidationHistory Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyTaxIdValidationHistory = null)
    {
        if ($spyTaxIdValidationHistory) {
            $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_ID_TAX_ID_VALIDATION_HISTORY, $spyTaxIdValidationHistory->getIdTaxIdValidationHistory(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_tax_id_validation_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyTaxIdValidationHistoryTableMap::clearInstancePool();
            SpyTaxIdValidationHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyTaxIdValidationHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyTaxIdValidationHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyTaxIdValidationHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyTaxIdValidationHistoryTableMap::COL_CREATED_AT);

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
