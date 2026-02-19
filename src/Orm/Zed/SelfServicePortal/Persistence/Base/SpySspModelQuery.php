<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\FileManager\Persistence\SpyFile;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModel as ChildSpySspModel;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery as ChildSpySspModelQuery;
use Orm\Zed\SelfServicePortal\Persistence\Map\SpySspModelTableMap;
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
 * Base class that represents a query for the `spy_ssp_model` table.
 *
 * @method     ChildSpySspModelQuery orderByIdSspModel($order = Criteria::ASC) Order by the id_ssp_model column
 * @method     ChildSpySspModelQuery orderByFkImageFile($order = Criteria::ASC) Order by the fk_image_file column
 * @method     ChildSpySspModelQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildSpySspModelQuery orderByImageUrl($order = Criteria::ASC) Order by the image_url column
 * @method     ChildSpySspModelQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpySspModelQuery orderByReference($order = Criteria::ASC) Order by the reference column
 * @method     ChildSpySspModelQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySspModelQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySspModelQuery groupByIdSspModel() Group by the id_ssp_model column
 * @method     ChildSpySspModelQuery groupByFkImageFile() Group by the fk_image_file column
 * @method     ChildSpySspModelQuery groupByCode() Group by the code column
 * @method     ChildSpySspModelQuery groupByImageUrl() Group by the image_url column
 * @method     ChildSpySspModelQuery groupByName() Group by the name column
 * @method     ChildSpySspModelQuery groupByReference() Group by the reference column
 * @method     ChildSpySspModelQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySspModelQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySspModelQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySspModelQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySspModelQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySspModelQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySspModelQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySspModelQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySspModelQuery leftJoinFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the File relation
 * @method     ChildSpySspModelQuery rightJoinFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the File relation
 * @method     ChildSpySspModelQuery innerJoinFile($relationAlias = null) Adds a INNER JOIN clause to the query using the File relation
 *
 * @method     ChildSpySspModelQuery joinWithFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the File relation
 *
 * @method     ChildSpySspModelQuery leftJoinWithFile() Adds a LEFT JOIN clause and with to the query using the File relation
 * @method     ChildSpySspModelQuery rightJoinWithFile() Adds a RIGHT JOIN clause and with to the query using the File relation
 * @method     ChildSpySspModelQuery innerJoinWithFile() Adds a INNER JOIN clause and with to the query using the File relation
 *
 * @method     ChildSpySspModelQuery leftJoinSpySspModelToFile($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspModelToFile relation
 * @method     ChildSpySspModelQuery rightJoinSpySspModelToFile($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspModelToFile relation
 * @method     ChildSpySspModelQuery innerJoinSpySspModelToFile($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspModelToFile relation
 *
 * @method     ChildSpySspModelQuery joinWithSpySspModelToFile($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspModelToFile relation
 *
 * @method     ChildSpySspModelQuery leftJoinWithSpySspModelToFile() Adds a LEFT JOIN clause and with to the query using the SpySspModelToFile relation
 * @method     ChildSpySspModelQuery rightJoinWithSpySspModelToFile() Adds a RIGHT JOIN clause and with to the query using the SpySspModelToFile relation
 * @method     ChildSpySspModelQuery innerJoinWithSpySspModelToFile() Adds a INNER JOIN clause and with to the query using the SpySspModelToFile relation
 *
 * @method     ChildSpySspModelQuery leftJoinSpySspModelToProductList($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspModelToProductList relation
 * @method     ChildSpySspModelQuery rightJoinSpySspModelToProductList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspModelToProductList relation
 * @method     ChildSpySspModelQuery innerJoinSpySspModelToProductList($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspModelToProductList relation
 *
 * @method     ChildSpySspModelQuery joinWithSpySspModelToProductList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspModelToProductList relation
 *
 * @method     ChildSpySspModelQuery leftJoinWithSpySspModelToProductList() Adds a LEFT JOIN clause and with to the query using the SpySspModelToProductList relation
 * @method     ChildSpySspModelQuery rightJoinWithSpySspModelToProductList() Adds a RIGHT JOIN clause and with to the query using the SpySspModelToProductList relation
 * @method     ChildSpySspModelQuery innerJoinWithSpySspModelToProductList() Adds a INNER JOIN clause and with to the query using the SpySspModelToProductList relation
 *
 * @method     ChildSpySspModelQuery leftJoinSpySspAssetToSspModel($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpySspAssetToSspModel relation
 * @method     ChildSpySspModelQuery rightJoinSpySspAssetToSspModel($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpySspAssetToSspModel relation
 * @method     ChildSpySspModelQuery innerJoinSpySspAssetToSspModel($relationAlias = null) Adds a INNER JOIN clause to the query using the SpySspAssetToSspModel relation
 *
 * @method     ChildSpySspModelQuery joinWithSpySspAssetToSspModel($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpySspAssetToSspModel relation
 *
 * @method     ChildSpySspModelQuery leftJoinWithSpySspAssetToSspModel() Adds a LEFT JOIN clause and with to the query using the SpySspAssetToSspModel relation
 * @method     ChildSpySspModelQuery rightJoinWithSpySspAssetToSspModel() Adds a RIGHT JOIN clause and with to the query using the SpySspAssetToSspModel relation
 * @method     ChildSpySspModelQuery innerJoinWithSpySspAssetToSspModel() Adds a INNER JOIN clause and with to the query using the SpySspAssetToSspModel relation
 *
 * @method     \Orm\Zed\FileManager\Persistence\SpyFileQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery|\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySspModel|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySspModel matching the query
 * @method     ChildSpySspModel findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySspModel matching the query, or a new ChildSpySspModel object populated from the query conditions when no match is found
 *
 * @method     ChildSpySspModel|null findOneByIdSspModel(int $id_ssp_model) Return the first ChildSpySspModel filtered by the id_ssp_model column
 * @method     ChildSpySspModel|null findOneByFkImageFile(int $fk_image_file) Return the first ChildSpySspModel filtered by the fk_image_file column
 * @method     ChildSpySspModel|null findOneByCode(string $code) Return the first ChildSpySspModel filtered by the code column
 * @method     ChildSpySspModel|null findOneByImageUrl(string $image_url) Return the first ChildSpySspModel filtered by the image_url column
 * @method     ChildSpySspModel|null findOneByName(string $name) Return the first ChildSpySspModel filtered by the name column
 * @method     ChildSpySspModel|null findOneByReference(string $reference) Return the first ChildSpySspModel filtered by the reference column
 * @method     ChildSpySspModel|null findOneByCreatedAt(string $created_at) Return the first ChildSpySspModel filtered by the created_at column
 * @method     ChildSpySspModel|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySspModel filtered by the updated_at column
 *
 * @method     ChildSpySspModel requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySspModel by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOne(?ConnectionInterface $con = null) Return the first ChildSpySspModel matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySspModel requireOneByIdSspModel(int $id_ssp_model) Return the first ChildSpySspModel filtered by the id_ssp_model column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByFkImageFile(int $fk_image_file) Return the first ChildSpySspModel filtered by the fk_image_file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByCode(string $code) Return the first ChildSpySspModel filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByImageUrl(string $image_url) Return the first ChildSpySspModel filtered by the image_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByName(string $name) Return the first ChildSpySspModel filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByReference(string $reference) Return the first ChildSpySspModel filtered by the reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByCreatedAt(string $created_at) Return the first ChildSpySspModel filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySspModel requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySspModel filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySspModel[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySspModel objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySspModel> find(?ConnectionInterface $con = null) Return ChildSpySspModel objects based on current ModelCriteria
 *
 * @method     ChildSpySspModel[]|Collection findByIdSspModel(int|array<int> $id_ssp_model) Return ChildSpySspModel objects filtered by the id_ssp_model column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByIdSspModel(int|array<int> $id_ssp_model) Return ChildSpySspModel objects filtered by the id_ssp_model column
 * @method     ChildSpySspModel[]|Collection findByFkImageFile(int|array<int> $fk_image_file) Return ChildSpySspModel objects filtered by the fk_image_file column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByFkImageFile(int|array<int> $fk_image_file) Return ChildSpySspModel objects filtered by the fk_image_file column
 * @method     ChildSpySspModel[]|Collection findByCode(string|array<string> $code) Return ChildSpySspModel objects filtered by the code column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByCode(string|array<string> $code) Return ChildSpySspModel objects filtered by the code column
 * @method     ChildSpySspModel[]|Collection findByImageUrl(string|array<string> $image_url) Return ChildSpySspModel objects filtered by the image_url column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByImageUrl(string|array<string> $image_url) Return ChildSpySspModel objects filtered by the image_url column
 * @method     ChildSpySspModel[]|Collection findByName(string|array<string> $name) Return ChildSpySspModel objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByName(string|array<string> $name) Return ChildSpySspModel objects filtered by the name column
 * @method     ChildSpySspModel[]|Collection findByReference(string|array<string> $reference) Return ChildSpySspModel objects filtered by the reference column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByReference(string|array<string> $reference) Return ChildSpySspModel objects filtered by the reference column
 * @method     ChildSpySspModel[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySspModel objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByCreatedAt(string|array<string> $created_at) Return ChildSpySspModel objects filtered by the created_at column
 * @method     ChildSpySspModel[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySspModel objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySspModel> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySspModel objects filtered by the updated_at column
 *
 * @method     ChildSpySspModel[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySspModel> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySspModelQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\SelfServicePortal\Persistence\Base\SpySspModelQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModel', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySspModelQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySspModelQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySspModelQuery) {
            return $criteria;
        }
        $query = new ChildSpySspModelQuery();
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
     * @return ChildSpySspModel|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySspModelTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySspModel A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_ssp_model, fk_image_file, code, image_url, name, reference, created_at, updated_at FROM spy_ssp_model WHERE id_ssp_model = :p0';
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
            /** @var ChildSpySspModel $obj */
            $obj = new ChildSpySspModel();
            $obj->hydrate($row);
            SpySspModelTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySspModel|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSspModel Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSspModel_Between(array $idSspModel)
    {
        return $this->filterByIdSspModel($idSspModel, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSspModels Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSspModel_In(array $idSspModels)
    {
        return $this->filterByIdSspModel($idSspModels, Criteria::IN);
    }

    /**
     * Filter the query on the id_ssp_model column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSspModel(1234); // WHERE id_ssp_model = 1234
     * $query->filterByIdSspModel(array(12, 34), Criteria::IN); // WHERE id_ssp_model IN (12, 34)
     * $query->filterByIdSspModel(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_ssp_model > 12
     * </code>
     *
     * @param     mixed $idSspModel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSspModel($idSspModel = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSspModel)) {
            $useMinMax = false;
            if (isset($idSspModel['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $idSspModel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSspModel['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $idSspModel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSspModel of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $idSspModel, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkImageFile Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkImageFile_Between(array $fkImageFile)
    {
        return $this->filterByFkImageFile($fkImageFile, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkImageFiles Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkImageFile_In(array $fkImageFiles)
    {
        return $this->filterByFkImageFile($fkImageFiles, Criteria::IN);
    }

    /**
     * Filter the query on the fk_image_file column
     *
     * Example usage:
     * <code>
     * $query->filterByFkImageFile(1234); // WHERE fk_image_file = 1234
     * $query->filterByFkImageFile(array(12, 34), Criteria::IN); // WHERE fk_image_file IN (12, 34)
     * $query->filterByFkImageFile(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_image_file > 12
     * </code>
     *
     * @see       filterByFile()
     *
     * @param     mixed $fkImageFile The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkImageFile($fkImageFile = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkImageFile)) {
            $useMinMax = false;
            if (isset($fkImageFile['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspModelTableMap::COL_FK_IMAGE_FILE, $fkImageFile['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkImageFile['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspModelTableMap::COL_FK_IMAGE_FILE, $fkImageFile['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkImageFile of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_FK_IMAGE_FILE, $fkImageFile, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $codes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode_In(array $codes)
    {
        return $this->filterByCode($codes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $code Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCode_Like($code)
    {
        return $this->filterByCode($code, Criteria::LIKE);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * $query->filterByCode([1, 'foo'], Criteria::IN); // WHERE code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCode($code = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $code = str_replace('*', '%', $code);
        }

        if (is_array($code) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$code of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_CODE, $code, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $imageUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImageUrl_In(array $imageUrls)
    {
        return $this->filterByImageUrl($imageUrls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $imageUrl Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImageUrl_Like($imageUrl)
    {
        return $this->filterByImageUrl($imageUrl, Criteria::LIKE);
    }

    /**
     * Filter the query on the image_url column
     *
     * Example usage:
     * <code>
     * $query->filterByImageUrl('fooValue');   // WHERE image_url = 'fooValue'
     * $query->filterByImageUrl('%fooValue%', Criteria::LIKE); // WHERE image_url LIKE '%fooValue%'
     * $query->filterByImageUrl([1, 'foo'], Criteria::IN); // WHERE image_url IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $imageUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByImageUrl($imageUrl = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $imageUrl = str_replace('*', '%', $imageUrl);
        }

        if (is_array($imageUrl) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$imageUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_IMAGE_URL, $imageUrl, $comparison);

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

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_NAME, $name, $comparison);

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

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_REFERENCE, $reference, $comparison);

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
                $this->addUsingAlias(SpySspModelTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspModelTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpySspModelTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySspModelTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySspModelTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\FileManager\Persistence\SpyFile object
     *
     * @param \Orm\Zed\FileManager\Persistence\SpyFile|ObjectCollection $spyFile The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFile($spyFile, ?string $comparison = null)
    {
        if ($spyFile instanceof \Orm\Zed\FileManager\Persistence\SpyFile) {
            return $this
                ->addUsingAlias(SpySspModelTableMap::COL_FK_IMAGE_FILE, $spyFile->getIdFile(), $comparison);
        } elseif ($spyFile instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySspModelTableMap::COL_FK_IMAGE_FILE, $spyFile->toKeyValue('PrimaryKey', 'IdFile'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByFile() only accepts arguments of type \Orm\Zed\FileManager\Persistence\SpyFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the File relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinFile(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('File');

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
            $this->addJoinObject($join, 'File');
        }

        return $this;
    }

    /**
     * Use the File relation SpyFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery A secondary query class using the current class as primary query
     */
    public function useFileQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'File', '\Orm\Zed\FileManager\Persistence\SpyFileQuery');
    }

    /**
     * Use the File relation SpyFile object
     *
     * @param callable(\Orm\Zed\FileManager\Persistence\SpyFileQuery):\Orm\Zed\FileManager\Persistence\SpyFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the File relation to the SpyFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the EXISTS statement
     */
    public function useFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useExistsQuery('File', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the File relation to the SpyFile table for a NOT EXISTS query.
     *
     * @see useFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useExistsQuery('File', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the File relation to the SpyFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the IN statement
     */
    public function useInFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useInQuery('File', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the File relation to the SpyFile table for a NOT IN query.
     *
     * @see useFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\FileManager\Persistence\SpyFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\FileManager\Persistence\SpyFileQuery */
        $q = $this->useInQuery('File', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile|ObjectCollection $spySspModelToFile the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspModelToFile($spySspModelToFile, ?string $comparison = null)
    {
        if ($spySspModelToFile instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile) {
            $this
                ->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $spySspModelToFile->getFkSspModel(), $comparison);

            return $this;
        } elseif ($spySspModelToFile instanceof ObjectCollection) {
            $this
                ->useSpySspModelToFileQuery()
                ->filterByPrimaryKeys($spySspModelToFile->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspModelToFile() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFile or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspModelToFile relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspModelToFile(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspModelToFile');

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
            $this->addJoinObject($join, 'SpySspModelToFile');
        }

        return $this;
    }

    /**
     * Use the SpySspModelToFile relation SpySspModelToFile object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery A secondary query class using the current class as primary query
     */
    public function useSpySspModelToFileQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspModelToFile($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspModelToFile', '\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery');
    }

    /**
     * Use the SpySspModelToFile relation SpySspModelToFile object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspModelToFileQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspModelToFileQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspModelToFile table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the EXISTS statement
     */
    public function useSpySspModelToFileExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useExistsQuery('SpySspModelToFile', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToFile table for a NOT EXISTS query.
     *
     * @see useSpySspModelToFileExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspModelToFileNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useExistsQuery('SpySspModelToFile', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspModelToFile table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the IN statement
     */
    public function useInSpySspModelToFileQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useInQuery('SpySspModelToFile', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToFile table for a NOT IN query.
     *
     * @see useSpySspModelToFileInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspModelToFileQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToFileQuery */
        $q = $this->useInQuery('SpySspModelToFile', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList|ObjectCollection $spySspModelToProductList the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspModelToProductList($spySspModelToProductList, ?string $comparison = null)
    {
        if ($spySspModelToProductList instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList) {
            $this
                ->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $spySspModelToProductList->getFkSspModel(), $comparison);

            return $this;
        } elseif ($spySspModelToProductList instanceof ObjectCollection) {
            $this
                ->useSpySspModelToProductListQuery()
                ->filterByPrimaryKeys($spySspModelToProductList->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspModelToProductList() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspModelToProductList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspModelToProductList(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspModelToProductList');

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
            $this->addJoinObject($join, 'SpySspModelToProductList');
        }

        return $this;
    }

    /**
     * Use the SpySspModelToProductList relation SpySspModelToProductList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery A secondary query class using the current class as primary query
     */
    public function useSpySspModelToProductListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspModelToProductList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspModelToProductList', '\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery');
    }

    /**
     * Use the SpySspModelToProductList relation SpySspModelToProductList object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspModelToProductListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspModelToProductListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspModelToProductList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the EXISTS statement
     */
    public function useSpySspModelToProductListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useExistsQuery('SpySspModelToProductList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToProductList table for a NOT EXISTS query.
     *
     * @see useSpySspModelToProductListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspModelToProductListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useExistsQuery('SpySspModelToProductList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspModelToProductList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the IN statement
     */
    public function useInSpySspModelToProductListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useInQuery('SpySspModelToProductList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspModelToProductList table for a NOT IN query.
     *
     * @see useSpySspModelToProductListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspModelToProductListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspModelToProductListQuery */
        $q = $this->useInQuery('SpySspModelToProductList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel object
     *
     * @param \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel|ObjectCollection $spySspAssetToSspModel the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpySspAssetToSspModel($spySspAssetToSspModel, ?string $comparison = null)
    {
        if ($spySspAssetToSspModel instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel) {
            $this
                ->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $spySspAssetToSspModel->getFkSspModel(), $comparison);

            return $this;
        } elseif ($spySspAssetToSspModel instanceof ObjectCollection) {
            $this
                ->useSpySspAssetToSspModelQuery()
                ->filterByPrimaryKeys($spySspAssetToSspModel->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpySspAssetToSspModel() only accepts arguments of type \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModel or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpySspAssetToSspModel relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpySspAssetToSspModel(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpySspAssetToSspModel');

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
            $this->addJoinObject($join, 'SpySspAssetToSspModel');
        }

        return $this;
    }

    /**
     * Use the SpySspAssetToSspModel relation SpySspAssetToSspModel object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery A secondary query class using the current class as primary query
     */
    public function useSpySspAssetToSspModelQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpySspAssetToSspModel($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpySspAssetToSspModel', '\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery');
    }

    /**
     * Use the SpySspAssetToSspModel relation SpySspAssetToSspModel object
     *
     * @param callable(\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery):\Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpySspAssetToSspModelQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpySspAssetToSspModelQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpySspAssetToSspModel table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery The inner query object of the EXISTS statement
     */
    public function useSpySspAssetToSspModelExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery */
        $q = $this->useExistsQuery('SpySspAssetToSspModel', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpySspAssetToSspModel table for a NOT EXISTS query.
     *
     * @see useSpySspAssetToSspModelExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpySspAssetToSspModelNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery */
        $q = $this->useExistsQuery('SpySspAssetToSspModel', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpySspAssetToSspModel table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery The inner query object of the IN statement
     */
    public function useInSpySspAssetToSspModelQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery */
        $q = $this->useInQuery('SpySspAssetToSspModel', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpySspAssetToSspModel table for a NOT IN query.
     *
     * @see useSpySspAssetToSspModelInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpySspAssetToSspModelQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\SelfServicePortal\Persistence\SpySspAssetToSspModelQuery */
        $q = $this->useInQuery('SpySspAssetToSspModel', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySspModel $spySspModel Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySspModel = null)
    {
        if ($spySspModel) {
            $this->addUsingAlias(SpySspModelTableMap::COL_ID_SSP_MODEL, $spySspModel->getIdSspModel(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_ssp_model table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspModelTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySspModelTableMap::clearInstancePool();
            SpySspModelTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspModelTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySspModelTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySspModelTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySspModelTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpySspModelTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySspModelTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySspModelTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySspModelTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpySspModelTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySspModelTableMap::COL_CREATED_AT);

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
