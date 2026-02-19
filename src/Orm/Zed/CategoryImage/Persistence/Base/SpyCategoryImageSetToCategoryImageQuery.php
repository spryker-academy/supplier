<?php

namespace Orm\Zed\CategoryImage\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetToCategoryImage as ChildSpyCategoryImageSetToCategoryImage;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetToCategoryImageQuery as ChildSpyCategoryImageSetToCategoryImageQuery;
use Orm\Zed\CategoryImage\Persistence\Map\SpyCategoryImageSetToCategoryImageTableMap;
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
 * Base class that represents a query for the `spy_category_image_set_to_category_image` table.
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery orderByIdCategoryImageSetToCategoryImage($order = Criteria::ASC) Order by the id_category_image_set_to_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery orderByFkCategoryImage($order = Criteria::ASC) Order by the fk_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery orderByFkCategoryImageSet($order = Criteria::ASC) Order by the fk_category_image_set column
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery orderBySortOrder($order = Criteria::ASC) Order by the sort_order column
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery groupByIdCategoryImageSetToCategoryImage() Group by the id_category_image_set_to_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery groupByFkCategoryImage() Group by the fk_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery groupByFkCategoryImageSet() Group by the fk_category_image_set column
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery groupBySortOrder() Group by the sort_order column
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery leftJoinSpyCategoryImageSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery rightJoinSpyCategoryImageSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery innerJoinSpyCategoryImageSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery joinWithSpyCategoryImageSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery leftJoinWithSpyCategoryImageSet() Adds a LEFT JOIN clause and with to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery rightJoinWithSpyCategoryImageSet() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery innerJoinWithSpyCategoryImageSet() Adds a INNER JOIN clause and with to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery leftJoinSpyCategoryImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryImage relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery rightJoinSpyCategoryImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryImage relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery innerJoinSpyCategoryImage($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryImage relation
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery joinWithSpyCategoryImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryImage relation
 *
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery leftJoinWithSpyCategoryImage() Adds a LEFT JOIN clause and with to the query using the SpyCategoryImage relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery rightJoinWithSpyCategoryImage() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryImage relation
 * @method     ChildSpyCategoryImageSetToCategoryImageQuery innerJoinWithSpyCategoryImage() Adds a INNER JOIN clause and with to the query using the SpyCategoryImage relation
 *
 * @method     \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery|\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCategoryImageSetToCategoryImage matching the query
 * @method     ChildSpyCategoryImageSetToCategoryImage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCategoryImageSetToCategoryImage matching the query, or a new ChildSpyCategoryImageSetToCategoryImage object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage|null findOneByIdCategoryImageSetToCategoryImage(int $id_category_image_set_to_category_image) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the id_category_image_set_to_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImage|null findOneByFkCategoryImage(int $fk_category_image) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the fk_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImage|null findOneByFkCategoryImageSet(int $fk_category_image_set) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the fk_category_image_set column
 * @method     ChildSpyCategoryImageSetToCategoryImage|null findOneBySortOrder(int $sort_order) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the sort_order column
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCategoryImageSetToCategoryImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryImageSetToCategoryImage requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCategoryImageSetToCategoryImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage requireOneByIdCategoryImageSetToCategoryImage(int $id_category_image_set_to_category_image) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the id_category_image_set_to_category_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryImageSetToCategoryImage requireOneByFkCategoryImage(int $fk_category_image) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the fk_category_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryImageSetToCategoryImage requireOneByFkCategoryImageSet(int $fk_category_image_set) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the fk_category_image_set column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategoryImageSetToCategoryImage requireOneBySortOrder(int $sort_order) Return the first ChildSpyCategoryImageSetToCategoryImage filtered by the sort_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCategoryImageSetToCategoryImage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCategoryImageSetToCategoryImage> find(?ConnectionInterface $con = null) Return ChildSpyCategoryImageSetToCategoryImage objects based on current ModelCriteria
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage[]|Collection findByIdCategoryImageSetToCategoryImage(int|array<int> $id_category_image_set_to_category_image) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the id_category_image_set_to_category_image column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryImageSetToCategoryImage> findByIdCategoryImageSetToCategoryImage(int|array<int> $id_category_image_set_to_category_image) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the id_category_image_set_to_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImage[]|Collection findByFkCategoryImage(int|array<int> $fk_category_image) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the fk_category_image column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryImageSetToCategoryImage> findByFkCategoryImage(int|array<int> $fk_category_image) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the fk_category_image column
 * @method     ChildSpyCategoryImageSetToCategoryImage[]|Collection findByFkCategoryImageSet(int|array<int> $fk_category_image_set) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the fk_category_image_set column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryImageSetToCategoryImage> findByFkCategoryImageSet(int|array<int> $fk_category_image_set) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the fk_category_image_set column
 * @method     ChildSpyCategoryImageSetToCategoryImage[]|Collection findBySortOrder(int|array<int> $sort_order) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the sort_order column
 * @psalm-method Collection&\Traversable<ChildSpyCategoryImageSetToCategoryImage> findBySortOrder(int|array<int> $sort_order) Return ChildSpyCategoryImageSetToCategoryImage objects filtered by the sort_order column
 *
 * @method     ChildSpyCategoryImageSetToCategoryImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCategoryImageSetToCategoryImage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCategoryImageSetToCategoryImageQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CategoryImage\Persistence\Base\SpyCategoryImageSetToCategoryImageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CategoryImage\\Persistence\\SpyCategoryImageSetToCategoryImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCategoryImageSetToCategoryImageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCategoryImageSetToCategoryImageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCategoryImageSetToCategoryImageQuery) {
            return $criteria;
        }
        $query = new ChildSpyCategoryImageSetToCategoryImageQuery();
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
     * @return ChildSpyCategoryImageSetToCategoryImage|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCategoryImageSetToCategoryImageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCategoryImageSetToCategoryImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_category_image_set_to_category_image, fk_category_image, fk_category_image_set, sort_order FROM spy_category_image_set_to_category_image WHERE id_category_image_set_to_category_image = :p0';
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
            /** @var ChildSpyCategoryImageSetToCategoryImage $obj */
            $obj = new ChildSpyCategoryImageSetToCategoryImage();
            $obj->hydrate($row);
            SpyCategoryImageSetToCategoryImageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCategoryImageSetToCategoryImage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCategoryImageSetToCategoryImage Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategoryImageSetToCategoryImage_Between(array $idCategoryImageSetToCategoryImage)
    {
        return $this->filterByIdCategoryImageSetToCategoryImage($idCategoryImageSetToCategoryImage, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCategoryImageSetToCategoryImages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategoryImageSetToCategoryImage_In(array $idCategoryImageSetToCategoryImages)
    {
        return $this->filterByIdCategoryImageSetToCategoryImage($idCategoryImageSetToCategoryImages, Criteria::IN);
    }

    /**
     * Filter the query on the id_category_image_set_to_category_image column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCategoryImageSetToCategoryImage(1234); // WHERE id_category_image_set_to_category_image = 1234
     * $query->filterByIdCategoryImageSetToCategoryImage(array(12, 34), Criteria::IN); // WHERE id_category_image_set_to_category_image IN (12, 34)
     * $query->filterByIdCategoryImageSetToCategoryImage(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_category_image_set_to_category_image > 12
     * </code>
     *
     * @param     mixed $idCategoryImageSetToCategoryImage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCategoryImageSetToCategoryImage($idCategoryImageSetToCategoryImage = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCategoryImageSetToCategoryImage)) {
            $useMinMax = false;
            if (isset($idCategoryImageSetToCategoryImage['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, $idCategoryImageSetToCategoryImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCategoryImageSetToCategoryImage['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, $idCategoryImageSetToCategoryImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCategoryImageSetToCategoryImage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, $idCategoryImageSetToCategoryImage, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCategoryImage Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryImage_Between(array $fkCategoryImage)
    {
        return $this->filterByFkCategoryImage($fkCategoryImage, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCategoryImages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryImage_In(array $fkCategoryImages)
    {
        return $this->filterByFkCategoryImage($fkCategoryImages, Criteria::IN);
    }

    /**
     * Filter the query on the fk_category_image column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategoryImage(1234); // WHERE fk_category_image = 1234
     * $query->filterByFkCategoryImage(array(12, 34), Criteria::IN); // WHERE fk_category_image IN (12, 34)
     * $query->filterByFkCategoryImage(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_category_image > 12
     * </code>
     *
     * @see       filterBySpyCategoryImage()
     *
     * @param     mixed $fkCategoryImage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCategoryImage($fkCategoryImage = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCategoryImage)) {
            $useMinMax = false;
            if (isset($fkCategoryImage['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE, $fkCategoryImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategoryImage['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE, $fkCategoryImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCategoryImage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE, $fkCategoryImage, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCategoryImageSet Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryImageSet_Between(array $fkCategoryImageSet)
    {
        return $this->filterByFkCategoryImageSet($fkCategoryImageSet, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCategoryImageSets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryImageSet_In(array $fkCategoryImageSets)
    {
        return $this->filterByFkCategoryImageSet($fkCategoryImageSets, Criteria::IN);
    }

    /**
     * Filter the query on the fk_category_image_set column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategoryImageSet(1234); // WHERE fk_category_image_set = 1234
     * $query->filterByFkCategoryImageSet(array(12, 34), Criteria::IN); // WHERE fk_category_image_set IN (12, 34)
     * $query->filterByFkCategoryImageSet(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_category_image_set > 12
     * </code>
     *
     * @see       filterBySpyCategoryImageSet()
     *
     * @param     mixed $fkCategoryImageSet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCategoryImageSet($fkCategoryImageSet = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCategoryImageSet)) {
            $useMinMax = false;
            if (isset($fkCategoryImageSet['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET, $fkCategoryImageSet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategoryImageSet['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET, $fkCategoryImageSet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCategoryImageSet of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET, $fkCategoryImageSet, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $sortOrder Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySortOrder_Between(array $sortOrder)
    {
        return $this->filterBySortOrder($sortOrder, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $sortOrders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySortOrder_In(array $sortOrders)
    {
        return $this->filterBySortOrder($sortOrders, Criteria::IN);
    }

    /**
     * Filter the query on the sort_order column
     *
     * Example usage:
     * <code>
     * $query->filterBySortOrder(1234); // WHERE sort_order = 1234
     * $query->filterBySortOrder(array(12, 34), Criteria::IN); // WHERE sort_order IN (12, 34)
     * $query->filterBySortOrder(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE sort_order > 12
     * </code>
     *
     * @param     mixed $sortOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySortOrder($sortOrder = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($sortOrder)) {
            $useMinMax = false;
            if (isset($sortOrder['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER, $sortOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortOrder['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER, $sortOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$sortOrder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER, $sortOrder, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet object
     *
     * @param \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet|ObjectCollection $spyCategoryImageSet The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryImageSet($spyCategoryImageSet, ?string $comparison = null)
    {
        if ($spyCategoryImageSet instanceof \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet) {
            return $this
                ->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET, $spyCategoryImageSet->getIdCategoryImageSet(), $comparison);
        } elseif ($spyCategoryImageSet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET, $spyCategoryImageSet->toKeyValue('PrimaryKey', 'IdCategoryImageSet'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryImageSet() only accepts arguments of type \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryImageSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryImageSet(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryImageSet');

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
            $this->addJoinObject($join, 'SpyCategoryImageSet');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryImageSet relation SpyCategoryImageSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryImageSetQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCategoryImageSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryImageSet', '\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery');
    }

    /**
     * Use the SpyCategoryImageSet relation SpyCategoryImageSet object
     *
     * @param callable(\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery):\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryImageSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryImageSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryImageSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useExistsQuery('SpyCategoryImageSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for a NOT EXISTS query.
     *
     * @see useSpyCategoryImageSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryImageSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useExistsQuery('SpyCategoryImageSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryImageSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useInQuery('SpyCategoryImageSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImageSet table for a NOT IN query.
     *
     * @see useSpyCategoryImageSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryImageSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery */
        $q = $this->useInQuery('SpyCategoryImageSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CategoryImage\Persistence\SpyCategoryImage object
     *
     * @param \Orm\Zed\CategoryImage\Persistence\SpyCategoryImage|ObjectCollection $spyCategoryImage The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryImage($spyCategoryImage, ?string $comparison = null)
    {
        if ($spyCategoryImage instanceof \Orm\Zed\CategoryImage\Persistence\SpyCategoryImage) {
            return $this
                ->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE, $spyCategoryImage->getIdCategoryImage(), $comparison);
        } elseif ($spyCategoryImage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE, $spyCategoryImage->toKeyValue('PrimaryKey', 'IdCategoryImage'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryImage() only accepts arguments of type \Orm\Zed\CategoryImage\Persistence\SpyCategoryImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryImage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryImage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryImage');

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
            $this->addJoinObject($join, 'SpyCategoryImage');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryImage relation SpyCategoryImage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCategoryImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryImage', '\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery');
    }

    /**
     * Use the SpyCategoryImage relation SpyCategoryImage object
     *
     * @param callable(\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery):\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryImageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryImageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryImage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryImageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery */
        $q = $this->useExistsQuery('SpyCategoryImage', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImage table for a NOT EXISTS query.
     *
     * @see useSpyCategoryImageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryImageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery */
        $q = $this->useExistsQuery('SpyCategoryImage', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryImageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery */
        $q = $this->useInQuery('SpyCategoryImage', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryImage table for a NOT IN query.
     *
     * @see useSpyCategoryImageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryImageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageQuery */
        $q = $this->useInQuery('SpyCategoryImage', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCategoryImageSetToCategoryImage $spyCategoryImageSetToCategoryImage Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCategoryImageSetToCategoryImage = null)
    {
        if ($spyCategoryImageSetToCategoryImage) {
            $this->addUsingAlias(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, $spyCategoryImageSetToCategoryImage->getIdCategoryImageSetToCategoryImage(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_category_image_set_to_category_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCategoryImageSetToCategoryImageTableMap::clearInstancePool();
            SpyCategoryImageSetToCategoryImageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCategoryImageSetToCategoryImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCategoryImageSetToCategoryImageTableMap::clearRelatedInstancePool();

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
