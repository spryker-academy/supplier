<?php

namespace Orm\Zed\ProductImage\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ProductImage\Persistence\SpyProductImage as ChildSpyProductImage;
use Orm\Zed\ProductImage\Persistence\SpyProductImageQuery as ChildSpyProductImageQuery;
use Orm\Zed\ProductImage\Persistence\Map\SpyProductImageTableMap;
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
 * Base class that represents a query for the `spy_product_image` table.
 *
 * @method     ChildSpyProductImageQuery orderByIdProductImage($order = Criteria::ASC) Order by the id_product_image column
 * @method     ChildSpyProductImageQuery orderByAltTextLarge($order = Criteria::ASC) Order by the alt_text_large column
 * @method     ChildSpyProductImageQuery orderByAltTextSmall($order = Criteria::ASC) Order by the alt_text_small column
 * @method     ChildSpyProductImageQuery orderByExternalUrlLarge($order = Criteria::ASC) Order by the external_url_large column
 * @method     ChildSpyProductImageQuery orderByExternalUrlSmall($order = Criteria::ASC) Order by the external_url_small column
 * @method     ChildSpyProductImageQuery orderByProductImageKey($order = Criteria::ASC) Order by the product_image_key column
 * @method     ChildSpyProductImageQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductImageQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductImageQuery groupByIdProductImage() Group by the id_product_image column
 * @method     ChildSpyProductImageQuery groupByAltTextLarge() Group by the alt_text_large column
 * @method     ChildSpyProductImageQuery groupByAltTextSmall() Group by the alt_text_small column
 * @method     ChildSpyProductImageQuery groupByExternalUrlLarge() Group by the external_url_large column
 * @method     ChildSpyProductImageQuery groupByExternalUrlSmall() Group by the external_url_small column
 * @method     ChildSpyProductImageQuery groupByProductImageKey() Group by the product_image_key column
 * @method     ChildSpyProductImageQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductImageQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductImageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductImageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductImageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductImageQuery leftJoinSpyProductImageSetToProductImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductImageSetToProductImage relation
 * @method     ChildSpyProductImageQuery rightJoinSpyProductImageSetToProductImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductImageSetToProductImage relation
 * @method     ChildSpyProductImageQuery innerJoinSpyProductImageSetToProductImage($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductImageSetToProductImage relation
 *
 * @method     ChildSpyProductImageQuery joinWithSpyProductImageSetToProductImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductImageSetToProductImage relation
 *
 * @method     ChildSpyProductImageQuery leftJoinWithSpyProductImageSetToProductImage() Adds a LEFT JOIN clause and with to the query using the SpyProductImageSetToProductImage relation
 * @method     ChildSpyProductImageQuery rightJoinWithSpyProductImageSetToProductImage() Adds a RIGHT JOIN clause and with to the query using the SpyProductImageSetToProductImage relation
 * @method     ChildSpyProductImageQuery innerJoinWithSpyProductImageSetToProductImage() Adds a INNER JOIN clause and with to the query using the SpyProductImageSetToProductImage relation
 *
 * @method     \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductImage|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductImage matching the query
 * @method     ChildSpyProductImage findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductImage matching the query, or a new ChildSpyProductImage object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductImage|null findOneByIdProductImage(int $id_product_image) Return the first ChildSpyProductImage filtered by the id_product_image column
 * @method     ChildSpyProductImage|null findOneByAltTextLarge(string $alt_text_large) Return the first ChildSpyProductImage filtered by the alt_text_large column
 * @method     ChildSpyProductImage|null findOneByAltTextSmall(string $alt_text_small) Return the first ChildSpyProductImage filtered by the alt_text_small column
 * @method     ChildSpyProductImage|null findOneByExternalUrlLarge(string $external_url_large) Return the first ChildSpyProductImage filtered by the external_url_large column
 * @method     ChildSpyProductImage|null findOneByExternalUrlSmall(string $external_url_small) Return the first ChildSpyProductImage filtered by the external_url_small column
 * @method     ChildSpyProductImage|null findOneByProductImageKey(string $product_image_key) Return the first ChildSpyProductImage filtered by the product_image_key column
 * @method     ChildSpyProductImage|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductImage filtered by the created_at column
 * @method     ChildSpyProductImage|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductImage filtered by the updated_at column
 *
 * @method     ChildSpyProductImage requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductImage requireOneByIdProductImage(int $id_product_image) Return the first ChildSpyProductImage filtered by the id_product_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByAltTextLarge(string $alt_text_large) Return the first ChildSpyProductImage filtered by the alt_text_large column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByAltTextSmall(string $alt_text_small) Return the first ChildSpyProductImage filtered by the alt_text_small column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByExternalUrlLarge(string $external_url_large) Return the first ChildSpyProductImage filtered by the external_url_large column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByExternalUrlSmall(string $external_url_small) Return the first ChildSpyProductImage filtered by the external_url_small column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByProductImageKey(string $product_image_key) Return the first ChildSpyProductImage filtered by the product_image_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductImage filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductImage requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductImage filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductImage[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductImage objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> find(?ConnectionInterface $con = null) Return ChildSpyProductImage objects based on current ModelCriteria
 *
 * @method     ChildSpyProductImage[]|Collection findByIdProductImage(int|array<int> $id_product_image) Return ChildSpyProductImage objects filtered by the id_product_image column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByIdProductImage(int|array<int> $id_product_image) Return ChildSpyProductImage objects filtered by the id_product_image column
 * @method     ChildSpyProductImage[]|Collection findByAltTextLarge(string|array<string> $alt_text_large) Return ChildSpyProductImage objects filtered by the alt_text_large column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByAltTextLarge(string|array<string> $alt_text_large) Return ChildSpyProductImage objects filtered by the alt_text_large column
 * @method     ChildSpyProductImage[]|Collection findByAltTextSmall(string|array<string> $alt_text_small) Return ChildSpyProductImage objects filtered by the alt_text_small column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByAltTextSmall(string|array<string> $alt_text_small) Return ChildSpyProductImage objects filtered by the alt_text_small column
 * @method     ChildSpyProductImage[]|Collection findByExternalUrlLarge(string|array<string> $external_url_large) Return ChildSpyProductImage objects filtered by the external_url_large column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByExternalUrlLarge(string|array<string> $external_url_large) Return ChildSpyProductImage objects filtered by the external_url_large column
 * @method     ChildSpyProductImage[]|Collection findByExternalUrlSmall(string|array<string> $external_url_small) Return ChildSpyProductImage objects filtered by the external_url_small column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByExternalUrlSmall(string|array<string> $external_url_small) Return ChildSpyProductImage objects filtered by the external_url_small column
 * @method     ChildSpyProductImage[]|Collection findByProductImageKey(string|array<string> $product_image_key) Return ChildSpyProductImage objects filtered by the product_image_key column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByProductImageKey(string|array<string> $product_image_key) Return ChildSpyProductImage objects filtered by the product_image_key column
 * @method     ChildSpyProductImage[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductImage objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductImage objects filtered by the created_at column
 * @method     ChildSpyProductImage[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductImage objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductImage> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductImage objects filtered by the updated_at column
 *
 * @method     ChildSpyProductImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductImage> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductImageQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductImage\Persistence\Base\SpyProductImageQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductImageQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductImageQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductImageQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductImageQuery();
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
     * @return ChildSpyProductImage|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductImageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_image, alt_text_large, alt_text_small, external_url_large, external_url_small, product_image_key, created_at, updated_at FROM spy_product_image WHERE id_product_image = :p0';
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
            /** @var ChildSpyProductImage $obj */
            $obj = new ChildSpyProductImage();
            $obj->hydrate($row);
            SpyProductImageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductImage|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductImage Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductImage_Between(array $idProductImage)
    {
        return $this->filterByIdProductImage($idProductImage, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductImages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductImage_In(array $idProductImages)
    {
        return $this->filterByIdProductImage($idProductImages, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_image column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductImage(1234); // WHERE id_product_image = 1234
     * $query->filterByIdProductImage(array(12, 34), Criteria::IN); // WHERE id_product_image IN (12, 34)
     * $query->filterByIdProductImage(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_image > 12
     * </code>
     *
     * @param     mixed $idProductImage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductImage($idProductImage = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductImage)) {
            $useMinMax = false;
            if (isset($idProductImage['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $idProductImage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductImage['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $idProductImage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductImage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $idProductImage, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $altTextLarges Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAltTextLarge_In(array $altTextLarges)
    {
        return $this->filterByAltTextLarge($altTextLarges, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $altTextLarge Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAltTextLarge_Like($altTextLarge)
    {
        return $this->filterByAltTextLarge($altTextLarge, Criteria::LIKE);
    }

    /**
     * Filter the query on the alt_text_large column
     *
     * Example usage:
     * <code>
     * $query->filterByAltTextLarge('fooValue');   // WHERE alt_text_large = 'fooValue'
     * $query->filterByAltTextLarge('%fooValue%', Criteria::LIKE); // WHERE alt_text_large LIKE '%fooValue%'
     * $query->filterByAltTextLarge([1, 'foo'], Criteria::IN); // WHERE alt_text_large IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $altTextLarge The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAltTextLarge($altTextLarge = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $altTextLarge = str_replace('*', '%', $altTextLarge);
        }

        if (is_array($altTextLarge) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$altTextLarge of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_ALT_TEXT_LARGE, $altTextLarge, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $altTextSmalls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAltTextSmall_In(array $altTextSmalls)
    {
        return $this->filterByAltTextSmall($altTextSmalls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $altTextSmall Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAltTextSmall_Like($altTextSmall)
    {
        return $this->filterByAltTextSmall($altTextSmall, Criteria::LIKE);
    }

    /**
     * Filter the query on the alt_text_small column
     *
     * Example usage:
     * <code>
     * $query->filterByAltTextSmall('fooValue');   // WHERE alt_text_small = 'fooValue'
     * $query->filterByAltTextSmall('%fooValue%', Criteria::LIKE); // WHERE alt_text_small LIKE '%fooValue%'
     * $query->filterByAltTextSmall([1, 'foo'], Criteria::IN); // WHERE alt_text_small IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $altTextSmall The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAltTextSmall($altTextSmall = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $altTextSmall = str_replace('*', '%', $altTextSmall);
        }

        if (is_array($altTextSmall) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$altTextSmall of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_ALT_TEXT_SMALL, $altTextSmall, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $externalUrlLarges Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrlLarge_In(array $externalUrlLarges)
    {
        return $this->filterByExternalUrlLarge($externalUrlLarges, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $externalUrlLarge Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrlLarge_Like($externalUrlLarge)
    {
        return $this->filterByExternalUrlLarge($externalUrlLarge, Criteria::LIKE);
    }

    /**
     * Filter the query on the external_url_large column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalUrlLarge('fooValue');   // WHERE external_url_large = 'fooValue'
     * $query->filterByExternalUrlLarge('%fooValue%', Criteria::LIKE); // WHERE external_url_large LIKE '%fooValue%'
     * $query->filterByExternalUrlLarge([1, 'foo'], Criteria::IN); // WHERE external_url_large IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $externalUrlLarge The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByExternalUrlLarge($externalUrlLarge = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $externalUrlLarge = str_replace('*', '%', $externalUrlLarge);
        }

        if (is_array($externalUrlLarge) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$externalUrlLarge of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_EXTERNAL_URL_LARGE, $externalUrlLarge, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $externalUrlSmalls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrlSmall_In(array $externalUrlSmalls)
    {
        return $this->filterByExternalUrlSmall($externalUrlSmalls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $externalUrlSmall Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExternalUrlSmall_Like($externalUrlSmall)
    {
        return $this->filterByExternalUrlSmall($externalUrlSmall, Criteria::LIKE);
    }

    /**
     * Filter the query on the external_url_small column
     *
     * Example usage:
     * <code>
     * $query->filterByExternalUrlSmall('fooValue');   // WHERE external_url_small = 'fooValue'
     * $query->filterByExternalUrlSmall('%fooValue%', Criteria::LIKE); // WHERE external_url_small LIKE '%fooValue%'
     * $query->filterByExternalUrlSmall([1, 'foo'], Criteria::IN); // WHERE external_url_small IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $externalUrlSmall The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByExternalUrlSmall($externalUrlSmall = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $externalUrlSmall = str_replace('*', '%', $externalUrlSmall);
        }

        if (is_array($externalUrlSmall) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$externalUrlSmall of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_EXTERNAL_URL_SMALL, $externalUrlSmall, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $productImageKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductImageKey_In(array $productImageKeys)
    {
        return $this->filterByProductImageKey($productImageKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $productImageKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductImageKey_Like($productImageKey)
    {
        return $this->filterByProductImageKey($productImageKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the product_image_key column
     *
     * Example usage:
     * <code>
     * $query->filterByProductImageKey('fooValue');   // WHERE product_image_key = 'fooValue'
     * $query->filterByProductImageKey('%fooValue%', Criteria::LIKE); // WHERE product_image_key LIKE '%fooValue%'
     * $query->filterByProductImageKey([1, 'foo'], Criteria::IN); // WHERE product_image_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $productImageKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProductImageKey($productImageKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $productImageKey = str_replace('*', '%', $productImageKey);
        }

        if (is_array($productImageKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$productImageKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_PRODUCT_IMAGE_KEY, $productImageKey, $comparison);

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
                $this->addUsingAlias(SpyProductImageTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductImageTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductImageTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductImageTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductImageTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage object
     *
     * @param \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage|ObjectCollection $spyProductImageSetToProductImage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductImageSetToProductImage($spyProductImageSetToProductImage, ?string $comparison = null)
    {
        if ($spyProductImageSetToProductImage instanceof \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage) {
            $this
                ->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $spyProductImageSetToProductImage->getFkProductImage(), $comparison);

            return $this;
        } elseif ($spyProductImageSetToProductImage instanceof ObjectCollection) {
            $this
                ->useSpyProductImageSetToProductImageQuery()
                ->filterByPrimaryKeys($spyProductImageSetToProductImage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductImageSetToProductImage() only accepts arguments of type \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductImageSetToProductImage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductImageSetToProductImage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductImageSetToProductImage');

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
            $this->addJoinObject($join, 'SpyProductImageSetToProductImage');
        }

        return $this;
    }

    /**
     * Use the SpyProductImageSetToProductImage relation SpyProductImageSetToProductImage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductImageSetToProductImageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductImageSetToProductImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductImageSetToProductImage', '\Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery');
    }

    /**
     * Use the SpyProductImageSetToProductImage relation SpyProductImageSetToProductImage object
     *
     * @param callable(\Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery):\Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductImageSetToProductImageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductImageSetToProductImageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductImageSetToProductImage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductImageSetToProductImageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery */
        $q = $this->useExistsQuery('SpyProductImageSetToProductImage', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductImageSetToProductImage table for a NOT EXISTS query.
     *
     * @see useSpyProductImageSetToProductImageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductImageSetToProductImageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery */
        $q = $this->useExistsQuery('SpyProductImageSetToProductImage', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductImageSetToProductImage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery The inner query object of the IN statement
     */
    public function useInSpyProductImageSetToProductImageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery */
        $q = $this->useInQuery('SpyProductImageSetToProductImage', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductImageSetToProductImage table for a NOT IN query.
     *
     * @see useSpyProductImageSetToProductImageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductImageSetToProductImageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductImage\Persistence\SpyProductImageSetToProductImageQuery */
        $q = $this->useInQuery('SpyProductImageSetToProductImage', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductImage $spyProductImage Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductImage = null)
    {
        if ($spyProductImage) {
            $this->addUsingAlias(SpyProductImageTableMap::COL_ID_PRODUCT_IMAGE, $spyProductImage->getIdProductImage(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductImageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductImageTableMap::clearInstancePool();
            SpyProductImageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductImageTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductImageTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductImageTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductImageTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductImageTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductImageTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductImageTableMap::COL_CREATED_AT);

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
