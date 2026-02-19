<?php

namespace Orm\Zed\FileManager\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\FileManager\Persistence\SpyFileDirectory as ChildSpyFileDirectory;
use Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery as ChildSpyFileDirectoryQuery;
use Orm\Zed\FileManager\Persistence\Map\SpyFileDirectoryTableMap;
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
 * Base class that represents a query for the `spy_file_directory` table.
 *
 * @method     ChildSpyFileDirectoryQuery orderByIdFileDirectory($order = Criteria::ASC) Order by the id_file_directory column
 * @method     ChildSpyFileDirectoryQuery orderByFkParentFileDirectory($order = Criteria::ASC) Order by the fk_parent_file_directory column
 * @method     ChildSpyFileDirectoryQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyFileDirectoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyFileDirectoryQuery orderByPosition($order = Criteria::ASC) Order by the position column
 *
 * @method     ChildSpyFileDirectoryQuery groupByIdFileDirectory() Group by the id_file_directory column
 * @method     ChildSpyFileDirectoryQuery groupByFkParentFileDirectory() Group by the fk_parent_file_directory column
 * @method     ChildSpyFileDirectoryQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyFileDirectoryQuery groupByName() Group by the name column
 * @method     ChildSpyFileDirectoryQuery groupByPosition() Group by the position column
 *
 * @method     ChildSpyFileDirectoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyFileDirectoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyFileDirectoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyFileDirectoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyFileDirectoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinParentFileDirectory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ParentFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery rightJoinParentFileDirectory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ParentFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery innerJoinParentFileDirectory($relationAlias = null) Adds a INNER JOIN clause to the query using the ParentFileDirectory relation
 *
 * @method     ChildSpyFileDirectoryQuery joinWithParentFileDirectory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ParentFileDirectory relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinWithParentFileDirectory() Adds a LEFT JOIN clause and with to the query using the ParentFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery rightJoinWithParentFileDirectory() Adds a RIGHT JOIN clause and with to the query using the ParentFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery innerJoinWithParentFileDirectory() Adds a INNER JOIN clause and with to the query using the ParentFileDirectory relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinSpyFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyFile relation
 * @method     ChildSpyFileDirectoryQuery rightJoinSpyFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyFile relation
 * @method     ChildSpyFileDirectoryQuery innerJoinSpyFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyFile relation
 *
 * @method     ChildSpyFileDirectoryQuery joinWithSpyFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyFile relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinWithSpyFile() Adds a LEFT JOIN clause and with to the query using the SpyFile relation
 * @method     ChildSpyFileDirectoryQuery rightJoinWithSpyFile() Adds a RIGHT JOIN clause and with to the query using the SpyFile relation
 * @method     ChildSpyFileDirectoryQuery innerJoinWithSpyFile() Adds a INNER JOIN clause and with to the query using the SpyFile relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinChildrenFileDirectory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ChildrenFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery rightJoinChildrenFileDirectory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ChildrenFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery innerJoinChildrenFileDirectory($relationAlias = null) Adds a INNER JOIN clause to the query using the ChildrenFileDirectory relation
 *
 * @method     ChildSpyFileDirectoryQuery joinWithChildrenFileDirectory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ChildrenFileDirectory relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinWithChildrenFileDirectory() Adds a LEFT JOIN clause and with to the query using the ChildrenFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery rightJoinWithChildrenFileDirectory() Adds a RIGHT JOIN clause and with to the query using the ChildrenFileDirectory relation
 * @method     ChildSpyFileDirectoryQuery innerJoinWithChildrenFileDirectory() Adds a INNER JOIN clause and with to the query using the ChildrenFileDirectory relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinSpyFileDirectoryLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyFileDirectoryQuery rightJoinSpyFileDirectoryLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyFileDirectoryQuery innerJoinSpyFileDirectoryLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
 *
 * @method     ChildSpyFileDirectoryQuery joinWithSpyFileDirectoryLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 *
 * @method     ChildSpyFileDirectoryQuery leftJoinWithSpyFileDirectoryLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyFileDirectoryQuery rightJoinWithSpyFileDirectoryLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 * @method     ChildSpyFileDirectoryQuery innerJoinWithSpyFileDirectoryLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyFileDirectoryLocalizedAttributes relation
 *
 * @method     \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery|\Orm\Zed\FileManager\Persistence\SpyFileQuery|\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery|\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyFileDirectory|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyFileDirectory matching the query
 * @method     ChildSpyFileDirectory findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyFileDirectory matching the query, or a new ChildSpyFileDirectory object populated from the query conditions when no match is found
 *
 * @method     ChildSpyFileDirectory|null findOneByIdFileDirectory(int $id_file_directory) Return the first ChildSpyFileDirectory filtered by the id_file_directory column
 * @method     ChildSpyFileDirectory|null findOneByFkParentFileDirectory(int $fk_parent_file_directory) Return the first ChildSpyFileDirectory filtered by the fk_parent_file_directory column
 * @method     ChildSpyFileDirectory|null findOneByIsActive(boolean $is_active) Return the first ChildSpyFileDirectory filtered by the is_active column
 * @method     ChildSpyFileDirectory|null findOneByName(string $name) Return the first ChildSpyFileDirectory filtered by the name column
 * @method     ChildSpyFileDirectory|null findOneByPosition(int $position) Return the first ChildSpyFileDirectory filtered by the position column
 *
 * @method     ChildSpyFileDirectory requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyFileDirectory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFileDirectory requireOne(?ConnectionInterface $con = null) Return the first ChildSpyFileDirectory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyFileDirectory requireOneByIdFileDirectory(int $id_file_directory) Return the first ChildSpyFileDirectory filtered by the id_file_directory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFileDirectory requireOneByFkParentFileDirectory(int $fk_parent_file_directory) Return the first ChildSpyFileDirectory filtered by the fk_parent_file_directory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFileDirectory requireOneByIsActive(boolean $is_active) Return the first ChildSpyFileDirectory filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFileDirectory requireOneByName(string $name) Return the first ChildSpyFileDirectory filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyFileDirectory requireOneByPosition(int $position) Return the first ChildSpyFileDirectory filtered by the position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyFileDirectory[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyFileDirectory objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyFileDirectory> find(?ConnectionInterface $con = null) Return ChildSpyFileDirectory objects based on current ModelCriteria
 *
 * @method     ChildSpyFileDirectory[]|Collection findByIdFileDirectory(int|array<int> $id_file_directory) Return ChildSpyFileDirectory objects filtered by the id_file_directory column
 * @psalm-method Collection&\Traversable<ChildSpyFileDirectory> findByIdFileDirectory(int|array<int> $id_file_directory) Return ChildSpyFileDirectory objects filtered by the id_file_directory column
 * @method     ChildSpyFileDirectory[]|Collection findByFkParentFileDirectory(int|array<int> $fk_parent_file_directory) Return ChildSpyFileDirectory objects filtered by the fk_parent_file_directory column
 * @psalm-method Collection&\Traversable<ChildSpyFileDirectory> findByFkParentFileDirectory(int|array<int> $fk_parent_file_directory) Return ChildSpyFileDirectory objects filtered by the fk_parent_file_directory column
 * @method     ChildSpyFileDirectory[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyFileDirectory objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyFileDirectory> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyFileDirectory objects filtered by the is_active column
 * @method     ChildSpyFileDirectory[]|Collection findByName(string|array<string> $name) Return ChildSpyFileDirectory objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyFileDirectory> findByName(string|array<string> $name) Return ChildSpyFileDirectory objects filtered by the name column
 * @method     ChildSpyFileDirectory[]|Collection findByPosition(int|array<int> $position) Return ChildSpyFileDirectory objects filtered by the position column
 * @psalm-method Collection&\Traversable<ChildSpyFileDirectory> findByPosition(int|array<int> $position) Return ChildSpyFileDirectory objects filtered by the position column
 *
 * @method     ChildSpyFileDirectory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyFileDirectory> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyFileDirectoryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\FileManager\Persistence\Base\SpyFileDirectoryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\FileManager\\Persistence\\SpyFileDirectory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyFileDirectoryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyFileDirectoryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyFileDirectoryQuery) {
            return $criteria;
        }
        $query = new ChildSpyFileDirectoryQuery();
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
     * @return ChildSpyFileDirectory|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyFileDirectoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyFileDirectory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_file_directory, fk_parent_file_directory, is_active, name, position FROM spy_file_directory WHERE id_file_directory = :p0';
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
            /** @var ChildSpyFileDirectory $obj */
            $obj = new ChildSpyFileDirectory();
            $obj->hydrate($row);
            SpyFileDirectoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyFileDirectory|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idFileDirectory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdFileDirectory_Between(array $idFileDirectory)
    {
        return $this->filterByIdFileDirectory($idFileDirectory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idFileDirectorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdFileDirectory_In(array $idFileDirectorys)
    {
        return $this->filterByIdFileDirectory($idFileDirectorys, Criteria::IN);
    }

    /**
     * Filter the query on the id_file_directory column
     *
     * Example usage:
     * <code>
     * $query->filterByIdFileDirectory(1234); // WHERE id_file_directory = 1234
     * $query->filterByIdFileDirectory(array(12, 34), Criteria::IN); // WHERE id_file_directory IN (12, 34)
     * $query->filterByIdFileDirectory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_file_directory > 12
     * </code>
     *
     * @param     mixed $idFileDirectory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdFileDirectory($idFileDirectory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idFileDirectory)) {
            $useMinMax = false;
            if (isset($idFileDirectory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $idFileDirectory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idFileDirectory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $idFileDirectory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idFileDirectory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $idFileDirectory, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkParentFileDirectory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentFileDirectory_Between(array $fkParentFileDirectory)
    {
        return $this->filterByFkParentFileDirectory($fkParentFileDirectory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkParentFileDirectorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkParentFileDirectory_In(array $fkParentFileDirectorys)
    {
        return $this->filterByFkParentFileDirectory($fkParentFileDirectorys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_parent_file_directory column
     *
     * Example usage:
     * <code>
     * $query->filterByFkParentFileDirectory(1234); // WHERE fk_parent_file_directory = 1234
     * $query->filterByFkParentFileDirectory(array(12, 34), Criteria::IN); // WHERE fk_parent_file_directory IN (12, 34)
     * $query->filterByFkParentFileDirectory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_parent_file_directory > 12
     * </code>
     *
     * @see       filterByParentFileDirectory()
     *
     * @param     mixed $fkParentFileDirectory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkParentFileDirectory($fkParentFileDirectory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkParentFileDirectory)) {
            $useMinMax = false;
            if (isset($fkParentFileDirectory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY, $fkParentFileDirectory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkParentFileDirectory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY, $fkParentFileDirectory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkParentFileDirectory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY, $fkParentFileDirectory, $comparison);

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

        $query = $this->addUsingAlias(SpyFileDirectoryTableMap::COL_IS_ACTIVE, $isActive, $comparison);

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

        $query = $this->addUsingAlias(SpyFileDirectoryTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $position Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition_Between(array $position)
    {
        return $this->filterByPosition($position, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $positions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPosition_In(array $positions)
    {
        return $this->filterByPosition($positions, Criteria::IN);
    }

    /**
     * Filter the query on the position column
     *
     * Example usage:
     * <code>
     * $query->filterByPosition(1234); // WHERE position = 1234
     * $query->filterByPosition(array(12, 34), Criteria::IN); // WHERE position IN (12, 34)
     * $query->filterByPosition(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE position > 12
     * </code>
     *
     * @param     mixed $position The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPosition($position = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($position)) {
            $useMinMax = false;
            if (isset($position['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileDirectoryTableMap::COL_POSITION, $position['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($position['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyFileDirectoryTableMap::COL_POSITION, $position['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$position of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyFileDirectoryTableMap::COL_POSITION, $position, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileDirectory object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileDirectory|ObjectCollection $spyFileDirectory The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByParentFileDirectory($spyFileDirectory, ?string $comparison = null)
    {
        if ($spyFileDirectory instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectory) {
            return $this
                ->addUsingAlias(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY, $spyFileDirectory->getIdFileDirectory(), $comparison);
        } elseif ($spyFileDirectory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyFileDirectoryTableMap::COL_FK_PARENT_FILE_DIRECTORY, $spyFileDirectory->toKeyValue('PrimaryKey', 'IdFileDirectory'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByParentFileDirectory() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileDirectory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ParentFileDirectory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinParentFileDirectory(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ParentFileDirectory');

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
            $this->addJoinObject($join, 'ParentFileDirectory');
        }

        return $this;
    }

    /**
     * Use the ParentFileDirectory relation SpyFileDirectory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery A secondary query class using the current class as primary query
     */
    public function useParentFileDirectoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinParentFileDirectory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ParentFileDirectory', '\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery');
    }

    /**
     * Use the ParentFileDirectory relation SpyFileDirectory object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery):\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withParentFileDirectoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useParentFileDirectoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ParentFileDirectory relation to the SpyFileDirectory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the EXISTS statement
     */
    public function useParentFileDirectoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useExistsQuery('ParentFileDirectory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ParentFileDirectory relation to the SpyFileDirectory table for a NOT EXISTS query.
     *
     * @see useParentFileDirectoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useParentFileDirectoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useExistsQuery('ParentFileDirectory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ParentFileDirectory relation to the SpyFileDirectory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the IN statement
     */
    public function useInParentFileDirectoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useInQuery('ParentFileDirectory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ParentFileDirectory relation to the SpyFileDirectory table for a NOT IN query.
     *
     * @see useParentFileDirectoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInParentFileDirectoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useInQuery('ParentFileDirectory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFile object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFile|ObjectCollection $spyFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyFile($spyFile, ?string $comparison = null)
    {
        if ($spyFile instanceof \Orm\Zed\FileManager\Persistence\SpyFile) {
            $this
                ->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $spyFile->getFkFileDirectory(), $comparison);

            return $this;
        } elseif ($spyFile instanceof ObjectCollection) {
            $this
                ->useSpyFileQuery()
                ->filterByPrimaryKeys($spyFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyFile() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyFile(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyFile');

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
            $this->addJoinObject($join, 'SpyFile');
        }

        return $this;
    }

    /**
     * Use the SpyFile relation SpyFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery A secondary query class using the current class as primary query
     */
    public function useSpyFileQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyFile', '\Orm\Zed\FileManager\Persistence\SpyFileQuery');
    }

    /**
     * Use the SpyFile relation SpyFile object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileQuery):\Orm\Zed\FileManager\Persistence\SpyFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the EXISTS statement
     */
    public function useSpyFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useExistsQuery('SpyFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyFile table for a NOT EXISTS query.
     *
     * @see useSpyFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useExistsQuery('SpyFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the IN statement
     */
    public function useInSpyFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useInQuery('SpyFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyFile table for a NOT IN query.
     *
     * @see useSpyFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useInQuery('SpyFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileDirectory object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileDirectory|ObjectCollection $spyFileDirectory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByChildrenFileDirectory($spyFileDirectory, ?string $comparison = null)
    {
        if ($spyFileDirectory instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectory) {
            $this
                ->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $spyFileDirectory->getFkParentFileDirectory(), $comparison);

            return $this;
        } elseif ($spyFileDirectory instanceof ObjectCollection) {
            $this
                ->useChildrenFileDirectoryQuery()
                ->filterByPrimaryKeys($spyFileDirectory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByChildrenFileDirectory() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileDirectory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ChildrenFileDirectory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinChildrenFileDirectory(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ChildrenFileDirectory');

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
            $this->addJoinObject($join, 'ChildrenFileDirectory');
        }

        return $this;
    }

    /**
     * Use the ChildrenFileDirectory relation SpyFileDirectory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery A secondary query class using the current class as primary query
     */
    public function useChildrenFileDirectoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinChildrenFileDirectory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ChildrenFileDirectory', '\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery');
    }

    /**
     * Use the ChildrenFileDirectory relation SpyFileDirectory object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery):\Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withChildrenFileDirectoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useChildrenFileDirectoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ChildrenFileDirectory relation to the SpyFileDirectory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the EXISTS statement
     */
    public function useChildrenFileDirectoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useExistsQuery('ChildrenFileDirectory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ChildrenFileDirectory relation to the SpyFileDirectory table for a NOT EXISTS query.
     *
     * @see useChildrenFileDirectoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useChildrenFileDirectoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useExistsQuery('ChildrenFileDirectory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ChildrenFileDirectory relation to the SpyFileDirectory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the IN statement
     */
    public function useInChildrenFileDirectoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useInQuery('ChildrenFileDirectory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ChildrenFileDirectory relation to the SpyFileDirectory table for a NOT IN query.
     *
     * @see useChildrenFileDirectoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInChildrenFileDirectoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryQuery */
        $q = $this->useInQuery('ChildrenFileDirectory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes|ObjectCollection $spyFileDirectoryLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyFileDirectoryLocalizedAttributes($spyFileDirectoryLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyFileDirectoryLocalizedAttributes instanceof \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $spyFileDirectoryLocalizedAttributes->getFkFileDirectory(), $comparison);

            return $this;
        } elseif ($spyFileDirectoryLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyFileDirectoryLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyFileDirectoryLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyFileDirectoryLocalizedAttributes() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyFileDirectoryLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyFileDirectoryLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyFileDirectoryLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyFileDirectoryLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyFileDirectoryLocalizedAttributes relation SpyFileDirectoryLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyFileDirectoryLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyFileDirectoryLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyFileDirectoryLocalizedAttributes', '\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery');
    }

    /**
     * Use the SpyFileDirectoryLocalizedAttributes relation SpyFileDirectoryLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery):\Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyFileDirectoryLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyFileDirectoryLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyFileDirectoryLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyFileDirectoryLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyFileDirectoryLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyFileDirectoryLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyFileDirectoryLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyFileDirectoryLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyFileDirectoryLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileDirectoryLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyFileDirectoryLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyFileDirectory $spyFileDirectory Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyFileDirectory = null)
    {
        if ($spyFileDirectory) {
            $this->addUsingAlias(SpyFileDirectoryTableMap::COL_ID_FILE_DIRECTORY, $spyFileDirectory->getIdFileDirectory(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_file_directory table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileDirectoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyFileDirectoryTableMap::clearInstancePool();
            SpyFileDirectoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyFileDirectoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyFileDirectoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyFileDirectoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyFileDirectoryTableMap::clearRelatedInstancePool();

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
