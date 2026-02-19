<?php

namespace Orm\Zed\Payment\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType as ChildSpySalesPaymentMethodType;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodTypeQuery as ChildSpySalesPaymentMethodTypeQuery;
use Orm\Zed\Payment\Persistence\Map\SpySalesPaymentMethodTypeTableMap;
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
 * Base class that represents a query for the `spy_sales_payment_method_type` table.
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery orderByIdSalesPaymentMethodType($order = Criteria::ASC) Order by the id_sales_payment_method_type column
 * @method     ChildSpySalesPaymentMethodTypeQuery orderByPaymentMethod($order = Criteria::ASC) Order by the payment_method column
 * @method     ChildSpySalesPaymentMethodTypeQuery orderByPaymentProvider($order = Criteria::ASC) Order by the payment_provider column
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery groupByIdSalesPaymentMethodType() Group by the id_sales_payment_method_type column
 * @method     ChildSpySalesPaymentMethodTypeQuery groupByPaymentMethod() Group by the payment_method column
 * @method     ChildSpySalesPaymentMethodTypeQuery groupByPaymentProvider() Group by the payment_provider column
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySalesPaymentMethodTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySalesPaymentMethodTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySalesPaymentMethodTypeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySalesPaymentMethodTypeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery leftJoinSalesPaymentMethodType($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesPaymentMethodType relation
 * @method     ChildSpySalesPaymentMethodTypeQuery rightJoinSalesPaymentMethodType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesPaymentMethodType relation
 * @method     ChildSpySalesPaymentMethodTypeQuery innerJoinSalesPaymentMethodType($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesPaymentMethodType relation
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery joinWithSalesPaymentMethodType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesPaymentMethodType relation
 *
 * @method     ChildSpySalesPaymentMethodTypeQuery leftJoinWithSalesPaymentMethodType() Adds a LEFT JOIN clause and with to the query using the SalesPaymentMethodType relation
 * @method     ChildSpySalesPaymentMethodTypeQuery rightJoinWithSalesPaymentMethodType() Adds a RIGHT JOIN clause and with to the query using the SalesPaymentMethodType relation
 * @method     ChildSpySalesPaymentMethodTypeQuery innerJoinWithSalesPaymentMethodType() Adds a INNER JOIN clause and with to the query using the SalesPaymentMethodType relation
 *
 * @method     \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySalesPaymentMethodType|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySalesPaymentMethodType matching the query
 * @method     ChildSpySalesPaymentMethodType findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySalesPaymentMethodType matching the query, or a new ChildSpySalesPaymentMethodType object populated from the query conditions when no match is found
 *
 * @method     ChildSpySalesPaymentMethodType|null findOneByIdSalesPaymentMethodType(int $id_sales_payment_method_type) Return the first ChildSpySalesPaymentMethodType filtered by the id_sales_payment_method_type column
 * @method     ChildSpySalesPaymentMethodType|null findOneByPaymentMethod(string $payment_method) Return the first ChildSpySalesPaymentMethodType filtered by the payment_method column
 * @method     ChildSpySalesPaymentMethodType|null findOneByPaymentProvider(string $payment_provider) Return the first ChildSpySalesPaymentMethodType filtered by the payment_provider column
 *
 * @method     ChildSpySalesPaymentMethodType requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySalesPaymentMethodType by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMethodType requireOne(?ConnectionInterface $con = null) Return the first ChildSpySalesPaymentMethodType matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesPaymentMethodType requireOneByIdSalesPaymentMethodType(int $id_sales_payment_method_type) Return the first ChildSpySalesPaymentMethodType filtered by the id_sales_payment_method_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMethodType requireOneByPaymentMethod(string $payment_method) Return the first ChildSpySalesPaymentMethodType filtered by the payment_method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesPaymentMethodType requireOneByPaymentProvider(string $payment_provider) Return the first ChildSpySalesPaymentMethodType filtered by the payment_provider column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesPaymentMethodType[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySalesPaymentMethodType objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMethodType> find(?ConnectionInterface $con = null) Return ChildSpySalesPaymentMethodType objects based on current ModelCriteria
 *
 * @method     ChildSpySalesPaymentMethodType[]|Collection findByIdSalesPaymentMethodType(int|array<int> $id_sales_payment_method_type) Return ChildSpySalesPaymentMethodType objects filtered by the id_sales_payment_method_type column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMethodType> findByIdSalesPaymentMethodType(int|array<int> $id_sales_payment_method_type) Return ChildSpySalesPaymentMethodType objects filtered by the id_sales_payment_method_type column
 * @method     ChildSpySalesPaymentMethodType[]|Collection findByPaymentMethod(string|array<string> $payment_method) Return ChildSpySalesPaymentMethodType objects filtered by the payment_method column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMethodType> findByPaymentMethod(string|array<string> $payment_method) Return ChildSpySalesPaymentMethodType objects filtered by the payment_method column
 * @method     ChildSpySalesPaymentMethodType[]|Collection findByPaymentProvider(string|array<string> $payment_provider) Return ChildSpySalesPaymentMethodType objects filtered by the payment_provider column
 * @psalm-method Collection&\Traversable<ChildSpySalesPaymentMethodType> findByPaymentProvider(string|array<string> $payment_provider) Return ChildSpySalesPaymentMethodType objects filtered by the payment_provider column
 *
 * @method     ChildSpySalesPaymentMethodType[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySalesPaymentMethodType> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySalesPaymentMethodTypeQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Payment\Persistence\Base\SpySalesPaymentMethodTypeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Payment\\Persistence\\SpySalesPaymentMethodType', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySalesPaymentMethodTypeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySalesPaymentMethodTypeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySalesPaymentMethodTypeQuery) {
            return $criteria;
        }
        $query = new ChildSpySalesPaymentMethodTypeQuery();
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
     * @return ChildSpySalesPaymentMethodType|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySalesPaymentMethodTypeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySalesPaymentMethodType A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sales_payment_method_type, payment_method, payment_provider FROM spy_sales_payment_method_type WHERE id_sales_payment_method_type = :p0';
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
            /** @var ChildSpySalesPaymentMethodType $obj */
            $obj = new ChildSpySalesPaymentMethodType();
            $obj->hydrate($row);
            SpySalesPaymentMethodTypeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySalesPaymentMethodType|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSalesPaymentMethodType Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesPaymentMethodType_Between(array $idSalesPaymentMethodType)
    {
        return $this->filterByIdSalesPaymentMethodType($idSalesPaymentMethodType, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSalesPaymentMethodTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesPaymentMethodType_In(array $idSalesPaymentMethodTypes)
    {
        return $this->filterByIdSalesPaymentMethodType($idSalesPaymentMethodTypes, Criteria::IN);
    }

    /**
     * Filter the query on the id_sales_payment_method_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSalesPaymentMethodType(1234); // WHERE id_sales_payment_method_type = 1234
     * $query->filterByIdSalesPaymentMethodType(array(12, 34), Criteria::IN); // WHERE id_sales_payment_method_type IN (12, 34)
     * $query->filterByIdSalesPaymentMethodType(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sales_payment_method_type > 12
     * </code>
     *
     * @param     mixed $idSalesPaymentMethodType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSalesPaymentMethodType($idSalesPaymentMethodType = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSalesPaymentMethodType)) {
            $useMinMax = false;
            if (isset($idSalesPaymentMethodType['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $idSalesPaymentMethodType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSalesPaymentMethodType['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $idSalesPaymentMethodType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSalesPaymentMethodType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $idSalesPaymentMethodType, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paymentMethods Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMethod_In(array $paymentMethods)
    {
        return $this->filterByPaymentMethod($paymentMethods, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $paymentMethod Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentMethod_Like($paymentMethod)
    {
        return $this->filterByPaymentMethod($paymentMethod, Criteria::LIKE);
    }

    /**
     * Filter the query on the payment_method column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentMethod('fooValue');   // WHERE payment_method = 'fooValue'
     * $query->filterByPaymentMethod('%fooValue%', Criteria::LIKE); // WHERE payment_method LIKE '%fooValue%'
     * $query->filterByPaymentMethod([1, 'foo'], Criteria::IN); // WHERE payment_method IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $paymentMethod The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPaymentMethod($paymentMethod = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $paymentMethod = str_replace('*', '%', $paymentMethod);
        }

        if (is_array($paymentMethod) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$paymentMethod of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_METHOD, $paymentMethod, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $paymentProviders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentProvider_In(array $paymentProviders)
    {
        return $this->filterByPaymentProvider($paymentProviders, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $paymentProvider Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPaymentProvider_Like($paymentProvider)
    {
        return $this->filterByPaymentProvider($paymentProvider, Criteria::LIKE);
    }

    /**
     * Filter the query on the payment_provider column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentProvider('fooValue');   // WHERE payment_provider = 'fooValue'
     * $query->filterByPaymentProvider('%fooValue%', Criteria::LIKE); // WHERE payment_provider LIKE '%fooValue%'
     * $query->filterByPaymentProvider([1, 'foo'], Criteria::IN); // WHERE payment_provider IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $paymentProvider The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPaymentProvider($paymentProvider = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $paymentProvider = str_replace('*', '%', $paymentProvider);
        }

        if (is_array($paymentProvider) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$paymentProvider of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_PROVIDER, $paymentProvider, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Payment\Persistence\SpySalesPayment object
     *
     * @param \Orm\Zed\Payment\Persistence\SpySalesPayment|ObjectCollection $spySalesPayment the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesPaymentMethodType($spySalesPayment, ?string $comparison = null)
    {
        if ($spySalesPayment instanceof \Orm\Zed\Payment\Persistence\SpySalesPayment) {
            $this
                ->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $spySalesPayment->getFkSalesPaymentMethodType(), $comparison);

            return $this;
        } elseif ($spySalesPayment instanceof ObjectCollection) {
            $this
                ->useSalesPaymentMethodTypeQuery()
                ->filterByPrimaryKeys($spySalesPayment->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySalesPaymentMethodType() only accepts arguments of type \Orm\Zed\Payment\Persistence\SpySalesPayment or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesPaymentMethodType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesPaymentMethodType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesPaymentMethodType');

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
            $this->addJoinObject($join, 'SalesPaymentMethodType');
        }

        return $this;
    }

    /**
     * Use the SalesPaymentMethodType relation SpySalesPayment object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery A secondary query class using the current class as primary query
     */
    public function useSalesPaymentMethodTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalesPaymentMethodType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesPaymentMethodType', '\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery');
    }

    /**
     * Use the SalesPaymentMethodType relation SpySalesPayment object
     *
     * @param callable(\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery):\Orm\Zed\Payment\Persistence\SpySalesPaymentQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesPaymentMethodTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalesPaymentMethodTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesPaymentMethodType relation to the SpySalesPayment table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the EXISTS statement
     */
    public function useSalesPaymentMethodTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useExistsQuery('SalesPaymentMethodType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesPaymentMethodType relation to the SpySalesPayment table for a NOT EXISTS query.
     *
     * @see useSalesPaymentMethodTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesPaymentMethodTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useExistsQuery('SalesPaymentMethodType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesPaymentMethodType relation to the SpySalesPayment table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the IN statement
     */
    public function useInSalesPaymentMethodTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useInQuery('SalesPaymentMethodType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesPaymentMethodType relation to the SpySalesPayment table for a NOT IN query.
     *
     * @see useSalesPaymentMethodTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesPaymentMethodTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Payment\Persistence\SpySalesPaymentQuery */
        $q = $this->useInQuery('SalesPaymentMethodType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySalesPaymentMethodType $spySalesPaymentMethodType Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySalesPaymentMethodType = null)
    {
        if ($spySalesPaymentMethodType) {
            $this->addUsingAlias(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, $spySalesPaymentMethodType->getIdSalesPaymentMethodType(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_sales_payment_method_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySalesPaymentMethodTypeTableMap::clearInstancePool();
            SpySalesPaymentMethodTypeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySalesPaymentMethodTypeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySalesPaymentMethodTypeTableMap::clearRelatedInstancePool();

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
