<?php

namespace Orm\Zed\Supplier\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplier as ChildPyzMerchantToSupplier;
use Orm\Zed\Supplier\Persistence\PyzMerchantToSupplierQuery as ChildPyzMerchantToSupplierQuery;
use Orm\Zed\Supplier\Persistence\Map\PyzMerchantToSupplierTableMap;
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
 * Base class that represents a query for the `pyz_merchant_to_supplier` table.
 *
 * @method     ChildPyzMerchantToSupplierQuery orderByFkMerchant($order = Criteria::ASC) Order by the fk_merchant column
 * @method     ChildPyzMerchantToSupplierQuery orderByFkSupplier($order = Criteria::ASC) Order by the fk_supplier column
 *
 * @method     ChildPyzMerchantToSupplierQuery groupByFkMerchant() Group by the fk_merchant column
 * @method     ChildPyzMerchantToSupplierQuery groupByFkSupplier() Group by the fk_supplier column
 *
 * @method     ChildPyzMerchantToSupplierQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPyzMerchantToSupplierQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPyzMerchantToSupplierQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPyzMerchantToSupplierQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPyzMerchantToSupplierQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPyzMerchantToSupplierQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPyzMerchantToSupplierQuery leftJoinSpyMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildPyzMerchantToSupplierQuery rightJoinSpyMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildPyzMerchantToSupplierQuery innerJoinSpyMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchant relation
 *
 * @method     ChildPyzMerchantToSupplierQuery joinWithSpyMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildPyzMerchantToSupplierQuery leftJoinWithSpyMerchant() Adds a LEFT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildPyzMerchantToSupplierQuery rightJoinWithSpyMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildPyzMerchantToSupplierQuery innerJoinWithSpyMerchant() Adds a INNER JOIN clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildPyzMerchantToSupplierQuery leftJoinPyzSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the PyzSupplier relation
 * @method     ChildPyzMerchantToSupplierQuery rightJoinPyzSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PyzSupplier relation
 * @method     ChildPyzMerchantToSupplierQuery innerJoinPyzSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the PyzSupplier relation
 *
 * @method     ChildPyzMerchantToSupplierQuery joinWithPyzSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PyzSupplier relation
 *
 * @method     ChildPyzMerchantToSupplierQuery leftJoinWithPyzSupplier() Adds a LEFT JOIN clause and with to the query using the PyzSupplier relation
 * @method     ChildPyzMerchantToSupplierQuery rightJoinWithPyzSupplier() Adds a RIGHT JOIN clause and with to the query using the PyzSupplier relation
 * @method     ChildPyzMerchantToSupplierQuery innerJoinWithPyzSupplier() Adds a INNER JOIN clause and with to the query using the PyzSupplier relation
 *
 * @method     \Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\Supplier\Persistence\PyzSupplierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPyzMerchantToSupplier|null findOne(?ConnectionInterface $con = null) Return the first ChildPyzMerchantToSupplier matching the query
 * @method     ChildPyzMerchantToSupplier findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPyzMerchantToSupplier matching the query, or a new ChildPyzMerchantToSupplier object populated from the query conditions when no match is found
 *
 * @method     ChildPyzMerchantToSupplier|null findOneByFkMerchant(int $fk_merchant) Return the first ChildPyzMerchantToSupplier filtered by the fk_merchant column
 * @method     ChildPyzMerchantToSupplier|null findOneByFkSupplier(int $fk_supplier) Return the first ChildPyzMerchantToSupplier filtered by the fk_supplier column
 *
 * @method     ChildPyzMerchantToSupplier requirePk($key, ?ConnectionInterface $con = null) Return the ChildPyzMerchantToSupplier by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzMerchantToSupplier requireOne(?ConnectionInterface $con = null) Return the first ChildPyzMerchantToSupplier matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzMerchantToSupplier requireOneByFkMerchant(int $fk_merchant) Return the first ChildPyzMerchantToSupplier filtered by the fk_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPyzMerchantToSupplier requireOneByFkSupplier(int $fk_supplier) Return the first ChildPyzMerchantToSupplier filtered by the fk_supplier column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPyzMerchantToSupplier[]|Collection find(?ConnectionInterface $con = null) Return ChildPyzMerchantToSupplier objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPyzMerchantToSupplier> find(?ConnectionInterface $con = null) Return ChildPyzMerchantToSupplier objects based on current ModelCriteria
 *
 * @method     ChildPyzMerchantToSupplier[]|Collection findByFkMerchant(int|array<int> $fk_merchant) Return ChildPyzMerchantToSupplier objects filtered by the fk_merchant column
 * @psalm-method Collection&\Traversable<ChildPyzMerchantToSupplier> findByFkMerchant(int|array<int> $fk_merchant) Return ChildPyzMerchantToSupplier objects filtered by the fk_merchant column
 * @method     ChildPyzMerchantToSupplier[]|Collection findByFkSupplier(int|array<int> $fk_supplier) Return ChildPyzMerchantToSupplier objects filtered by the fk_supplier column
 * @psalm-method Collection&\Traversable<ChildPyzMerchantToSupplier> findByFkSupplier(int|array<int> $fk_supplier) Return ChildPyzMerchantToSupplier objects filtered by the fk_supplier column
 *
 * @method     ChildPyzMerchantToSupplier[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPyzMerchantToSupplier> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PyzMerchantToSupplierQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Supplier\Persistence\Base\PyzMerchantToSupplierQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Supplier\\Persistence\\PyzMerchantToSupplier', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPyzMerchantToSupplierQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPyzMerchantToSupplierQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPyzMerchantToSupplierQuery) {
            return $criteria;
        }
        $query = new ChildPyzMerchantToSupplierQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$fk_merchant, $fk_supplier] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPyzMerchantToSupplier|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = PyzMerchantToSupplierTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildPyzMerchantToSupplier A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT fk_merchant, fk_supplier FROM pyz_merchant_to_supplier WHERE fk_merchant = :p0 AND fk_supplier = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPyzMerchantToSupplier $obj */
            $obj = new ChildPyzMerchantToSupplier();
            $obj->hydrate($row);
            PyzMerchantToSupplierTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildPyzMerchantToSupplier|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
                $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $fkMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $fkMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $fkMerchant, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSupplier Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSupplier_Between(array $fkSupplier)
    {
        return $this->filterByFkSupplier($fkSupplier, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSuppliers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSupplier_In(array $fkSuppliers)
    {
        return $this->filterByFkSupplier($fkSuppliers, Criteria::IN);
    }

    /**
     * Filter the query on the fk_supplier column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSupplier(1234); // WHERE fk_supplier = 1234
     * $query->filterByFkSupplier(array(12, 34), Criteria::IN); // WHERE fk_supplier IN (12, 34)
     * $query->filterByFkSupplier(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_supplier > 12
     * </code>
     *
     * @see       filterByPyzSupplier()
     *
     * @param     mixed $fkSupplier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSupplier($fkSupplier = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSupplier)) {
            $useMinMax = false;
            if (isset($fkSupplier['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $fkSupplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSupplier['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $fkSupplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSupplier of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $fkSupplier, $comparison);

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
                ->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $spyMerchant->getIdMerchant(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT, $spyMerchant->toKeyValue('PrimaryKey', 'IdMerchant'), $comparison);

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
     * Filter the query by a related \Orm\Zed\Supplier\Persistence\PyzSupplier object
     *
     * @param \Orm\Zed\Supplier\Persistence\PyzSupplier|ObjectCollection $pyzSupplier The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPyzSupplier($pyzSupplier, ?string $comparison = null)
    {
        if ($pyzSupplier instanceof \Orm\Zed\Supplier\Persistence\PyzSupplier) {
            return $this
                ->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $pyzSupplier->getIdSupplier(), $comparison);
        } elseif ($pyzSupplier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER, $pyzSupplier->toKeyValue('PrimaryKey', 'IdSupplier'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPyzSupplier() only accepts arguments of type \Orm\Zed\Supplier\Persistence\PyzSupplier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PyzSupplier relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPyzSupplier(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PyzSupplier');

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
            $this->addJoinObject($join, 'PyzSupplier');
        }

        return $this;
    }

    /**
     * Use the PyzSupplier relation PyzSupplier object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery A secondary query class using the current class as primary query
     */
    public function usePyzSupplierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPyzSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PyzSupplier', '\Orm\Zed\Supplier\Persistence\PyzSupplierQuery');
    }

    /**
     * Use the PyzSupplier relation PyzSupplier object
     *
     * @param callable(\Orm\Zed\Supplier\Persistence\PyzSupplierQuery):\Orm\Zed\Supplier\Persistence\PyzSupplierQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPyzSupplierQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePyzSupplierQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to PyzSupplier table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the EXISTS statement
     */
    public function usePyzSupplierExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useExistsQuery('PyzSupplier', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to PyzSupplier table for a NOT EXISTS query.
     *
     * @see usePyzSupplierExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the NOT EXISTS statement
     */
    public function usePyzSupplierNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useExistsQuery('PyzSupplier', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to PyzSupplier table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the IN statement
     */
    public function useInPyzSupplierQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useInQuery('PyzSupplier', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to PyzSupplier table for a NOT IN query.
     *
     * @see usePyzSupplierInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Supplier\Persistence\PyzSupplierQuery The inner query object of the NOT IN statement
     */
    public function useNotInPyzSupplierQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Supplier\Persistence\PyzSupplierQuery */
        $q = $this->useInQuery('PyzSupplier', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildPyzMerchantToSupplier $pyzMerchantToSupplier Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pyzMerchantToSupplier = null)
    {
        if ($pyzMerchantToSupplier) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PyzMerchantToSupplierTableMap::COL_FK_MERCHANT), $pyzMerchantToSupplier->getFkMerchant(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PyzMerchantToSupplierTableMap::COL_FK_SUPPLIER), $pyzMerchantToSupplier->getFkSupplier(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
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
     * Deletes all rows from the pyz_merchant_to_supplier table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzMerchantToSupplierTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PyzMerchantToSupplierTableMap::clearInstancePool();
            PyzMerchantToSupplierTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PyzMerchantToSupplierTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PyzMerchantToSupplierTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PyzMerchantToSupplierTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PyzMerchantToSupplierTableMap::clearRelatedInstancePool();

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
