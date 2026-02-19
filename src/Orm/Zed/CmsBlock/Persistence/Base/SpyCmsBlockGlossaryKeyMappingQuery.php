<?php

namespace Orm\Zed\CmsBlock\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMapping as ChildSpyCmsBlockGlossaryKeyMapping;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockGlossaryKeyMappingQuery as ChildSpyCmsBlockGlossaryKeyMappingQuery;
use Orm\Zed\CmsBlock\Persistence\Map\SpyCmsBlockGlossaryKeyMappingTableMap;
use Orm\Zed\Glossary\Persistence\SpyGlossaryKey;
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
 * Base class that represents a query for the `spy_cms_block_glossary_key_mapping` table.
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery orderByIdCmsBlockGlossaryKeyMapping($order = Criteria::ASC) Order by the id_cms_block_glossary_key_mapping column
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery orderByFkCmsBlock($order = Criteria::ASC) Order by the fk_cms_block column
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery orderByFkGlossaryKey($order = Criteria::ASC) Order by the fk_glossary_key column
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery orderByPlaceholder($order = Criteria::ASC) Order by the placeholder column
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery groupByIdCmsBlockGlossaryKeyMapping() Group by the id_cms_block_glossary_key_mapping column
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery groupByFkCmsBlock() Group by the fk_cms_block column
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery groupByFkGlossaryKey() Group by the fk_glossary_key column
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery groupByPlaceholder() Group by the placeholder column
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery leftJoinCmsBlock($relationAlias = null) Adds a LEFT JOIN clause to the query using the CmsBlock relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery rightJoinCmsBlock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CmsBlock relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery innerJoinCmsBlock($relationAlias = null) Adds a INNER JOIN clause to the query using the CmsBlock relation
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery joinWithCmsBlock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CmsBlock relation
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery leftJoinWithCmsBlock() Adds a LEFT JOIN clause and with to the query using the CmsBlock relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery rightJoinWithCmsBlock() Adds a RIGHT JOIN clause and with to the query using the CmsBlock relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery innerJoinWithCmsBlock() Adds a INNER JOIN clause and with to the query using the CmsBlock relation
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery leftJoinGlossaryKey($relationAlias = null) Adds a LEFT JOIN clause to the query using the GlossaryKey relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery rightJoinGlossaryKey($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GlossaryKey relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery innerJoinGlossaryKey($relationAlias = null) Adds a INNER JOIN clause to the query using the GlossaryKey relation
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery joinWithGlossaryKey($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GlossaryKey relation
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery leftJoinWithGlossaryKey() Adds a LEFT JOIN clause and with to the query using the GlossaryKey relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery rightJoinWithGlossaryKey() Adds a RIGHT JOIN clause and with to the query using the GlossaryKey relation
 * @method     ChildSpyCmsBlockGlossaryKeyMappingQuery innerJoinWithGlossaryKey() Adds a INNER JOIN clause and with to the query using the GlossaryKey relation
 *
 * @method     \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery|\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsBlockGlossaryKeyMapping matching the query
 * @method     ChildSpyCmsBlockGlossaryKeyMapping findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCmsBlockGlossaryKeyMapping matching the query, or a new ChildSpyCmsBlockGlossaryKeyMapping object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping|null findOneByIdCmsBlockGlossaryKeyMapping(int $id_cms_block_glossary_key_mapping) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the id_cms_block_glossary_key_mapping column
 * @method     ChildSpyCmsBlockGlossaryKeyMapping|null findOneByFkCmsBlock(int $fk_cms_block) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the fk_cms_block column
 * @method     ChildSpyCmsBlockGlossaryKeyMapping|null findOneByFkGlossaryKey(int $fk_glossary_key) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the fk_glossary_key column
 * @method     ChildSpyCmsBlockGlossaryKeyMapping|null findOneByPlaceholder(string $placeholder) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the placeholder column
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCmsBlockGlossaryKeyMapping by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlockGlossaryKeyMapping requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCmsBlockGlossaryKeyMapping matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping requireOneByIdCmsBlockGlossaryKeyMapping(int $id_cms_block_glossary_key_mapping) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the id_cms_block_glossary_key_mapping column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlockGlossaryKeyMapping requireOneByFkCmsBlock(int $fk_cms_block) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the fk_cms_block column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlockGlossaryKeyMapping requireOneByFkGlossaryKey(int $fk_glossary_key) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the fk_glossary_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCmsBlockGlossaryKeyMapping requireOneByPlaceholder(string $placeholder) Return the first ChildSpyCmsBlockGlossaryKeyMapping filtered by the placeholder column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCmsBlockGlossaryKeyMapping objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> find(?ConnectionInterface $con = null) Return ChildSpyCmsBlockGlossaryKeyMapping objects based on current ModelCriteria
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping[]|Collection findByIdCmsBlockGlossaryKeyMapping(int|array<int> $id_cms_block_glossary_key_mapping) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the id_cms_block_glossary_key_mapping column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> findByIdCmsBlockGlossaryKeyMapping(int|array<int> $id_cms_block_glossary_key_mapping) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the id_cms_block_glossary_key_mapping column
 * @method     ChildSpyCmsBlockGlossaryKeyMapping[]|Collection findByFkCmsBlock(int|array<int> $fk_cms_block) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the fk_cms_block column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> findByFkCmsBlock(int|array<int> $fk_cms_block) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the fk_cms_block column
 * @method     ChildSpyCmsBlockGlossaryKeyMapping[]|Collection findByFkGlossaryKey(int|array<int> $fk_glossary_key) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the fk_glossary_key column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> findByFkGlossaryKey(int|array<int> $fk_glossary_key) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the fk_glossary_key column
 * @method     ChildSpyCmsBlockGlossaryKeyMapping[]|Collection findByPlaceholder(string|array<string> $placeholder) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the placeholder column
 * @psalm-method Collection&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> findByPlaceholder(string|array<string> $placeholder) Return ChildSpyCmsBlockGlossaryKeyMapping objects filtered by the placeholder column
 *
 * @method     ChildSpyCmsBlockGlossaryKeyMapping[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCmsBlockGlossaryKeyMapping> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCmsBlockGlossaryKeyMappingQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\CmsBlock\Persistence\Base\SpyCmsBlockGlossaryKeyMappingQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlockGlossaryKeyMapping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCmsBlockGlossaryKeyMappingQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCmsBlockGlossaryKeyMappingQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCmsBlockGlossaryKeyMappingQuery) {
            return $criteria;
        }
        $query = new ChildSpyCmsBlockGlossaryKeyMappingQuery();
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
     * @return ChildSpyCmsBlockGlossaryKeyMapping|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCmsBlockGlossaryKeyMappingTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCmsBlockGlossaryKeyMapping A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_cms_block_glossary_key_mapping, fk_cms_block, fk_glossary_key, placeholder FROM spy_cms_block_glossary_key_mapping WHERE id_cms_block_glossary_key_mapping = :p0';
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
            /** @var ChildSpyCmsBlockGlossaryKeyMapping $obj */
            $obj = new ChildSpyCmsBlockGlossaryKeyMapping();
            $obj->hydrate($row);
            SpyCmsBlockGlossaryKeyMappingTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCmsBlockGlossaryKeyMapping|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_ID_CMS_BLOCK_GLOSSARY_KEY_MAPPING, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_ID_CMS_BLOCK_GLOSSARY_KEY_MAPPING, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCmsBlockGlossaryKeyMapping Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsBlockGlossaryKeyMapping_Between(array $idCmsBlockGlossaryKeyMapping)
    {
        return $this->filterByIdCmsBlockGlossaryKeyMapping($idCmsBlockGlossaryKeyMapping, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCmsBlockGlossaryKeyMappings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCmsBlockGlossaryKeyMapping_In(array $idCmsBlockGlossaryKeyMappings)
    {
        return $this->filterByIdCmsBlockGlossaryKeyMapping($idCmsBlockGlossaryKeyMappings, Criteria::IN);
    }

    /**
     * Filter the query on the id_cms_block_glossary_key_mapping column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCmsBlockGlossaryKeyMapping(1234); // WHERE id_cms_block_glossary_key_mapping = 1234
     * $query->filterByIdCmsBlockGlossaryKeyMapping(array(12, 34), Criteria::IN); // WHERE id_cms_block_glossary_key_mapping IN (12, 34)
     * $query->filterByIdCmsBlockGlossaryKeyMapping(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_cms_block_glossary_key_mapping > 12
     * </code>
     *
     * @param     mixed $idCmsBlockGlossaryKeyMapping The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCmsBlockGlossaryKeyMapping($idCmsBlockGlossaryKeyMapping = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCmsBlockGlossaryKeyMapping)) {
            $useMinMax = false;
            if (isset($idCmsBlockGlossaryKeyMapping['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_ID_CMS_BLOCK_GLOSSARY_KEY_MAPPING, $idCmsBlockGlossaryKeyMapping['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCmsBlockGlossaryKeyMapping['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_ID_CMS_BLOCK_GLOSSARY_KEY_MAPPING, $idCmsBlockGlossaryKeyMapping['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCmsBlockGlossaryKeyMapping of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_ID_CMS_BLOCK_GLOSSARY_KEY_MAPPING, $idCmsBlockGlossaryKeyMapping, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCmsBlock Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsBlock_Between(array $fkCmsBlock)
    {
        return $this->filterByFkCmsBlock($fkCmsBlock, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCmsBlocks Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCmsBlock_In(array $fkCmsBlocks)
    {
        return $this->filterByFkCmsBlock($fkCmsBlocks, Criteria::IN);
    }

    /**
     * Filter the query on the fk_cms_block column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCmsBlock(1234); // WHERE fk_cms_block = 1234
     * $query->filterByFkCmsBlock(array(12, 34), Criteria::IN); // WHERE fk_cms_block IN (12, 34)
     * $query->filterByFkCmsBlock(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_cms_block > 12
     * </code>
     *
     * @see       filterByCmsBlock()
     *
     * @param     mixed $fkCmsBlock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCmsBlock($fkCmsBlock = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCmsBlock)) {
            $useMinMax = false;
            if (isset($fkCmsBlock['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_CMS_BLOCK, $fkCmsBlock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCmsBlock['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_CMS_BLOCK, $fkCmsBlock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCmsBlock of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_CMS_BLOCK, $fkCmsBlock, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkGlossaryKey Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkGlossaryKey_Between(array $fkGlossaryKey)
    {
        return $this->filterByFkGlossaryKey($fkGlossaryKey, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkGlossaryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkGlossaryKey_In(array $fkGlossaryKeys)
    {
        return $this->filterByFkGlossaryKey($fkGlossaryKeys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_glossary_key column
     *
     * Example usage:
     * <code>
     * $query->filterByFkGlossaryKey(1234); // WHERE fk_glossary_key = 1234
     * $query->filterByFkGlossaryKey(array(12, 34), Criteria::IN); // WHERE fk_glossary_key IN (12, 34)
     * $query->filterByFkGlossaryKey(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_glossary_key > 12
     * </code>
     *
     * @see       filterByGlossaryKey()
     *
     * @param     mixed $fkGlossaryKey The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkGlossaryKey($fkGlossaryKey = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkGlossaryKey)) {
            $useMinMax = false;
            if (isset($fkGlossaryKey['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY, $fkGlossaryKey['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkGlossaryKey['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY, $fkGlossaryKey['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkGlossaryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY, $fkGlossaryKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $placeholders Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaceholder_In(array $placeholders)
    {
        return $this->filterByPlaceholder($placeholders, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $placeholder Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPlaceholder_Like($placeholder)
    {
        return $this->filterByPlaceholder($placeholder, Criteria::LIKE);
    }

    /**
     * Filter the query on the placeholder column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaceholder('fooValue');   // WHERE placeholder = 'fooValue'
     * $query->filterByPlaceholder('%fooValue%', Criteria::LIKE); // WHERE placeholder LIKE '%fooValue%'
     * $query->filterByPlaceholder([1, 'foo'], Criteria::IN); // WHERE placeholder IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $placeholder The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPlaceholder($placeholder = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $placeholder = str_replace('*', '%', $placeholder);
        }

        if (is_array($placeholder) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$placeholder of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_PLACEHOLDER, $placeholder, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock object
     *
     * @param \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock|ObjectCollection $spyCmsBlock The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmsBlock($spyCmsBlock, ?string $comparison = null)
    {
        if ($spyCmsBlock instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock) {
            return $this
                ->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_CMS_BLOCK, $spyCmsBlock->getIdCmsBlock(), $comparison);
        } elseif ($spyCmsBlock instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_CMS_BLOCK, $spyCmsBlock->toKeyValue('PrimaryKey', 'IdCmsBlock'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCmsBlock() only accepts arguments of type \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CmsBlock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCmsBlock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CmsBlock');

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
            $this->addJoinObject($join, 'CmsBlock');
        }

        return $this;
    }

    /**
     * Use the CmsBlock relation SpyCmsBlock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery A secondary query class using the current class as primary query
     */
    public function useCmsBlockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCmsBlock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CmsBlock', '\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery');
    }

    /**
     * Use the CmsBlock relation SpyCmsBlock object
     *
     * @param callable(\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery):\Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCmsBlockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCmsBlockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the EXISTS statement
     */
    public function useCmsBlockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useExistsQuery('CmsBlock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for a NOT EXISTS query.
     *
     * @see useCmsBlockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the NOT EXISTS statement
     */
    public function useCmsBlockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useExistsQuery('CmsBlock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the IN statement
     */
    public function useInCmsBlockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useInQuery('CmsBlock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CmsBlock relation to the SpyCmsBlock table for a NOT IN query.
     *
     * @see useCmsBlockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery The inner query object of the NOT IN statement
     */
    public function useNotInCmsBlockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery */
        $q = $this->useInQuery('CmsBlock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Glossary\Persistence\SpyGlossaryKey object
     *
     * @param \Orm\Zed\Glossary\Persistence\SpyGlossaryKey|ObjectCollection $spyGlossaryKey The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGlossaryKey($spyGlossaryKey, ?string $comparison = null)
    {
        if ($spyGlossaryKey instanceof \Orm\Zed\Glossary\Persistence\SpyGlossaryKey) {
            return $this
                ->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY, $spyGlossaryKey->getIdGlossaryKey(), $comparison);
        } elseif ($spyGlossaryKey instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY, $spyGlossaryKey->toKeyValue('PrimaryKey', 'IdGlossaryKey'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGlossaryKey() only accepts arguments of type \Orm\Zed\Glossary\Persistence\SpyGlossaryKey or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GlossaryKey relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGlossaryKey(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GlossaryKey');

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
            $this->addJoinObject($join, 'GlossaryKey');
        }

        return $this;
    }

    /**
     * Use the GlossaryKey relation SpyGlossaryKey object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery A secondary query class using the current class as primary query
     */
    public function useGlossaryKeyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGlossaryKey($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GlossaryKey', '\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery');
    }

    /**
     * Use the GlossaryKey relation SpyGlossaryKey object
     *
     * @param callable(\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery):\Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGlossaryKeyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGlossaryKeyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the GlossaryKey relation to the SpyGlossaryKey table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery The inner query object of the EXISTS statement
     */
    public function useGlossaryKeyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery */
        $q = $this->useExistsQuery('GlossaryKey', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the GlossaryKey relation to the SpyGlossaryKey table for a NOT EXISTS query.
     *
     * @see useGlossaryKeyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery The inner query object of the NOT EXISTS statement
     */
    public function useGlossaryKeyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery */
        $q = $this->useExistsQuery('GlossaryKey', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the GlossaryKey relation to the SpyGlossaryKey table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery The inner query object of the IN statement
     */
    public function useInGlossaryKeyQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery */
        $q = $this->useInQuery('GlossaryKey', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the GlossaryKey relation to the SpyGlossaryKey table for a NOT IN query.
     *
     * @see useGlossaryKeyInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery The inner query object of the NOT IN statement
     */
    public function useNotInGlossaryKeyQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Glossary\Persistence\SpyGlossaryKeyQuery */
        $q = $this->useInQuery('GlossaryKey', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCmsBlockGlossaryKeyMapping $spyCmsBlockGlossaryKeyMapping Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCmsBlockGlossaryKeyMapping = null)
    {
        if ($spyCmsBlockGlossaryKeyMapping) {
            $this->addUsingAlias(SpyCmsBlockGlossaryKeyMappingTableMap::COL_ID_CMS_BLOCK_GLOSSARY_KEY_MAPPING, $spyCmsBlockGlossaryKeyMapping->getIdCmsBlockGlossaryKeyMapping(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_cms_block_glossary_key_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockGlossaryKeyMappingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCmsBlockGlossaryKeyMappingTableMap::clearInstancePool();
            SpyCmsBlockGlossaryKeyMappingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockGlossaryKeyMappingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCmsBlockGlossaryKeyMappingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCmsBlockGlossaryKeyMappingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCmsBlockGlossaryKeyMappingTableMap::clearRelatedInstancePool();

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
